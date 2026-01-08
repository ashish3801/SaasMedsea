<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MedicalDataApproval;
use App\Models\Registration;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestFormController extends Controller
{
    public function showTestForms($registrationId, $categoryId)
    {
        $category = Category::with('tests')->findOrFail($categoryId);
        $registration = Registration::findOrFail($registrationId);
        
        $existingResults = TestResult::where('registration_id', $registrationId)
            ->where('category_id', $categoryId)
            ->get()
            ->keyBy('test_id');
        
        return view('test-forms', compact('category', 'registration', 'existingResults'));
    }

    public function saveTestResults(Request $request)
    {
        try {
            $validated = $request->validate([
                'register_id' => 'required|exists:registrations,id',
                'category_name' => 'required|string',
                'results' => 'required|array',
            ]);

            // Get the category by name
            // $category = DB::table('categories')->whereRaw('LOWER(REPLACE(name, "-", " ")) = LOWER(?)', [str_replace('-', ' ', $validated['category_name'])])->first();
            $rawInput = $validated['category_name'];
            $processed = preg_replace("/-s-/", "'s ", $rawInput);
            $processed = preg_replace('/\s+/', ' ', $processed);
            $processed = str_replace('D-A', 'D&A', $processed);
            $inputCategory = trim($processed);
            // dd($inputCategory);
            $category = DB::table('categories')
                // ->whereRaw('LOWER(name) = LOWER(?)', [$inputCategory])
                ->whereRaw("REPLACE(LOWER(name), '-', ' ') = REPLACE(LOWER(?), '-', ' ')", [$inputCategory])
                ->first();
            // dd($category);
            if (!$category) {
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found',
                ], 404);
            }

            DB::beginTransaction();
            try {
                // Format the data in key=>value structure
                $formattedData = [
                    'category_id' => $category->id,
                    'tests' => []
                ];

                foreach ($validated['results'] as $result) {
                    preg_match('/results\[(\d+)\]\[result\]/', $result['name'], $matches);
                    if (isset($matches[1])) {
                        $testId = (int) $matches[1];
                        $formattedData['tests'][$testId] = $result['value'];
                    }
                }

                // Save as a single record
                TestResult::updateOrCreate(
                    [
                        'registration_id' => $validated['register_id'],
                        'category_id' => $category->id,
                    ],
                    [
                        'form_data' => $formattedData,
                        'status' => 'completed',
                    ]
                );

                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Test results saved successfully',
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Error saving test results: ' . $e->getMessage(),
                ], 500);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error processing request: ' . $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Save all tests for a registration
     */
    public function saveAllTests(Request $request)
    {
        try {
            $validated = $request->validate([
                'register_id' => 'required|exists:registrations,id',
                'categories_data' => 'required|array',
            ]);
    
            DB::beginTransaction();
            
            $savedCount = 0;
            $totalCategories = count($validated['categories_data']);
            $errors = [];
            $processedCategories = []; // Track processed categories to avoid duplicates
    
            foreach ($validated['categories_data'] as $index => $categoryData) {
                try {
                    $categoryName = $categoryData['category_name'];
                    $results = $categoryData['results'];
    
                    // Skip if we've already processed this category in this request
                    $categoryKey = $categoryName . '_' . $validated['register_id'];
                    if (in_array($categoryKey, $processedCategories)) {
                        $errors[] = "Duplicate category '$categoryName' skipped";
                        continue;
                    }
                    $processedCategories[] = $categoryKey;
    
                    // Process category name
                    $rawInput = $categoryName;
                    $processed = preg_replace("/-s-/", "'s ", $rawInput);
                    $processed = preg_replace('/\s+/', ' ', $processed);
                    $processed = str_replace('D-A', 'D&A', $processed);
                    $inputCategory = trim($processed);
                    
                    \Log::info("Processing category: {$categoryName} -> {$inputCategory}");
                    
                    $category = DB::table('categories')
                        ->whereRaw("REPLACE(LOWER(name), '-', ' ') = REPLACE(LOWER(?), '-', ' ')", [$inputCategory])
                        ->first();
    
                    if (!$category) {
                        $errors[] = "Category '$categoryName' (processed as: '$inputCategory') not found";
                        \Log::warning("Category not found: {$categoryName} -> {$inputCategory}");
                        continue;
                    }
    
                    // Format the data in key=>value structure
                    $formattedData = [
                        'category_id' => $category->id,
                        'tests' => []
                    ];
    
                    foreach ($results as $resultIndex => $result) {
                        // More flexible regex to capture test IDs
                        preg_match('/results\[(\d+)\]\[result\]/', $result['name'], $matches);
                        
                        if (isset($matches[1])) {
                            $testId = (int) $matches[1];
                            $formattedData['tests'][$testId] = $result['value'];
                        } else {
                            // Log if we can't parse a result
                            \Log::warning("Could not parse result name: {$result['name']} for category: {$categoryName}");
                        }
                    }
    
                    // Check if we have any tests data
                    if (empty($formattedData['tests'])) {
                        $errors[] = "No valid test results found for category '$categoryName'";
                        \Log::warning("No valid test results for category: {$categoryName}");
                        continue;
                    }
    
                    \Log::info("Saving category {$categoryName} with " . count($formattedData['tests']) . " tests");
    
                    // Save as a single record
                    $testResult = TestResult::updateOrCreate(
                        [
                            'company_id' => Registration::find($validated['register_id'])->company_id,
                            'registration_id' => $validated['register_id'],
                            'category_id' => $category->id,
                        ],
                        [
                            'form_data' => $formattedData,
                            'status' => 'completed',
                        ]
                    );
    
                    \Log::info("Successfully saved category {$categoryName}, TestResult ID: " . ($testResult->id ?? 'unknown'));
    
                    $savedCount++;
    
                } catch (\Exception $e) {
                    $errorMsg = "Error saving $categoryName at index $index: " . $e->getMessage();
                    $errors[] = $errorMsg;
                    \Log::error($errorMsg);
                    \Log::error($e->getTraceAsString());
                    continue;
                }
            }
    
            DB::commit();
    
            \Log::info("SaveAllTests completed: {$savedCount}/{$totalCategories} categories saved");
    
            if ($savedCount === 0) {
                return response()->json([ 
                    'success' => false,
                    'message' => 'No categories were saved',
                    'errors' => $errors,
                ], 400);
            }
    
            $message = "Successfully saved $savedCount out of $totalCategories categories";
            if (!empty($errors)) {
                $message .= ". Some categories had errors.";
            }
    
            return response()->json([
                'success' => true,
                'message' => $message,
                'saved_count' => $savedCount,
                'total_categories' => $totalCategories,
                'errors' => $errors,
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            \Log::error("Validation error in saveAllTests: " . json_encode($e->errors()));
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing save all request: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getTestResults($registrationId, $categoryId)
    {
        $results = TestResult::with('test')
            ->where('registration_id', $registrationId)
            ->where('category_id', $categoryId)
            ->get();
            
        return response()->json($results);
    }

    public function saveDataApproval(Request $request)
    {
        if ($request->register_id != null) {
            $registration = Registration::findOrFail($request->register_id);

            $data = [
                'registration_id' => $registration->id,
                'is_fit' => $request->is_fit,
                'limitation' => $request->limitation,
                'issue_date' => $request->issue_date,
                'expiry_date' => $request->expiry_date,
                'attach_stamp_sign' => $request->has('attach_stamp_sign') ? 1 : 0,

            ];
            $doctorsRecord = MedicalDataApproval::updateOrCreate(
                [
                    'registration_id' => $registration->id,
                    // 'id' => $request->appId, 
                ],
                $data
            );
        
            return response()->json([
                'success' => true,
                'message' => 'Special test saved successfully!',
                // 'data' => $doctorsRecord,
            ]);
            
        }
    }
    public function fetchDataApproval(Request $request)
    {
        $request->validate([
            'register_id' => 'required|exists:registrations,id'
        ]);

        $data = MedicalDataApproval::where('registration_id', $request->register_id)->first();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
} 