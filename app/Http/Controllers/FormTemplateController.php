<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\UserPackage;
use App\Models\Package;
use App\Models\Test;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormTemplateController extends Controller
{
    public function getAvailableTemplates(Request $request)
    {
        $registerId = (int) $request->registerId;
        if (!$registerId) {
            return response()->json(['error' => 'Registration ID is required'], 400);
        }

        // $hasAssignedPackages = UserPackage::where('registration_id', $registerId)
        //     ->whereNotNull('package_id')
        //     ->exists();

        // if (!$hasAssignedPackages) {
        //     return response()->json([
        //         'error' => 'no_packages',
        //         'message' => 'No packages have been assigned yet.'
        //     ]);
        // }

        // $userPackages = UserPackage::with([
        //     'package.categories.tests',
        //     'package.tests',
        //     'test.categories'
        // ])
        // ->where('registration_id', $registerId)
        // ->get();
        // // dd($userPackages);
        // $existingResultsRaw = DB::table('test_results')
        //     ->where('registration_id', $registerId)
        //     ->get();
        
        // $existingResults = [];
        // foreach ($existingResultsRaw as $result) {
        //     $formData = json_decode($result->form_data, true);
        //     if (isset($formData['tests'])) {
        //         foreach ($formData['tests'] as $testId => $value) {
        //             $existingResults[(int)$testId] = $value;
        //             // dd($existingResults);
        //         }
        //     }
        // }
        // $testsByCategory = [];

        // foreach ($userPackages as $userPackage) {
        //     if ($userPackage->package) {
        //         // $packageDetails = json_decode($userPackage->package->test_id, true);
        //         $packageDetails = $userPackage->package->test_id;
        //         $decodedDetails = json_decode($packageDetails, true);
        //         $categories = Category::whereIn('id', array_column($decodedDetails, 'category_id'))->get()->keyBy('id');
                
        //         $allTestIds = [];
        //         foreach ($decodedDetails as $detail) {
        //             $allTestIds = array_merge($allTestIds, $detail['tests']);
        //         }
                
        //         $tests = Test::whereIn('id', $allTestIds)
        //             ->select('id', 'name', 'field_type', 'dropdown_values')
        //             ->get()
        //             ->keyBy('id');
                
        //         foreach ($decodedDetails as $detail) {
        //             $categoryId = $detail['category_id'];
        //             if (isset($categories[$categoryId])) {
        //                 $categoryName = $categories[$categoryId]->name;
                        
        //                 if (!isset($testsByCategory[$categoryName])) {
        //                     $testsByCategory[$categoryName] = [];
        //                 }
                        
        //                 // foreach ($detail['tests'] as $testId) {
        //                 //     if (isset($tests[$testId])) {
        //                 //         $test = $tests[$testId];
        //                 //         $testsByCategory[$categoryName][] = [
        //                 //             'name' => $test->name,
        //                 //             'template' => 'generic_test_form',
        //                 //             'test_id' => $test->id,
        //                 //             'type' => $test->field_type,
        //                 //             // 'values' => $test->field_type === 'dropdown' ? json_decode($test->dropdown_values, true) : null
        //                 //             'values' => $test->field_type === 'dropdown'
        //                 //                 ? (is_string($test->dropdown_values) ? json_decode($test->dropdown_values, true) : $test->dropdown_values)
        //                 //                 : null,
        //                 //             'existing_result' => $existingResults[(int)$test->id] ?? null
        //                 //         ];
        //                 //     }
        //                 // }
        //                 foreach ($detail['tests'] as $testId) {
        //                     if (isset($tests[$testId])) {
        //                         $test = $tests[$testId];
        //                         $dropdownValues = $test->field_type === 'dropdown'
        //                             ? (is_string($test->dropdown_values) ? json_decode($test->dropdown_values, true) : $test->dropdown_values)
        //                             : null;
                        
        //                         $existingResult = $existingResults[(int)$test->id] ?? null;
                        
        //                         // Set default to first dropdown value if no existing result
        //                         if ($test->field_type === 'dropdown' && $existingResult === null && is_array($dropdownValues) && count($dropdownValues) > 0) {
        //                             $existingResult = $dropdownValues[0];
        //                         }
                        
        //                         $testsByCategory[$categoryName][] = [
        //                             'name' => $test->name,
        //                             'template' => 'generic_test_form',
        //                             'test_id' => $test->id,
        //                             'type' => $test->field_type,
        //                             'values' => $dropdownValues,
        //                             'existing_result' => $existingResult
        //                         ];
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }

        // foreach ($testsByCategory as $category => $tests) {
        //     $testsByCategory[$category] = array_values(array_unique($tests, SORT_REGULAR));
        // }
        // // dd($testsByCategory);
        // return response()->json($testsByCategory);

        $userPackage = UserPackage::where('registration_id', $registerId)->first();

        if (!$userPackage || empty($userPackage->package_id)) {
            return response()->json([
                'error' => 'no_packages',
                'message' => 'No packages have been assigned yet.'
            ]);
        }

        $packageIds = is_array($userPackage->package_id)
            ? $userPackage->package_id
            : json_decode($userPackage->package_id, true);

        
        $packages = Package::whereIn('id', $packageIds)->get();

        
        $existingResultsRaw = DB::table('test_results')
            ->where('registration_id', $registerId)
            ->get();

        $existingResults = [];
        foreach ($existingResultsRaw as $result) {
            $formData = json_decode($result->form_data, true);
            if (isset($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    $existingResults[(int)$testId] = $value;
                }
            }
        }

        $testsByCategory = [];

        foreach ($packages as $package) {
            $packageDetails = json_decode($package->test_id, true);

            $categoryIds = array_column($packageDetails, 'category_id');
            $categories = Category::whereIn('id', $categoryIds)->get()->keyBy('id');

            $allTestIds = [];
            foreach ($packageDetails as $detail) {
                $allTestIds = array_merge($allTestIds, $detail['tests']);
            }

            $tests = Test::whereIn('id', $allTestIds)
                ->select('id', 'name', 'field_type', 'dropdown_values','text_value')
                ->get()
                ->keyBy('id');

            foreach ($packageDetails as $detail) {
                $categoryId = $detail['category_id'];
                if (isset($categories[$categoryId])) {
                    $categoryName = $categories[$categoryId]->name;

                    if (!isset($testsByCategory[$categoryName])) {
                        $testsByCategory[$categoryName] = [];
                    }

                    foreach ($detail['tests'] as $testId) {
                        if (isset($tests[$testId])) {
                            $test = $tests[$testId];
                            $dropdownValues = $test->field_type === 'dropdown'
                                ? (is_string($test->dropdown_values) ? json_decode($test->dropdown_values, true) : $test->dropdown_values)
                                : null;

                            $existingResult = $existingResults[(int)$test->id] ?? null;

                            if ($test->field_type === 'dropdown' && $existingResult === null && is_array($dropdownValues) && count($dropdownValues) > 0) {
                                $existingResult = $dropdownValues[0];
                            }
                            
                            if ($test->field_type === 'text' && $existingResult === null && !empty($test->text_value)) {
                                $existingResult = $test->text_value;
                            }

                            $testsByCategory[$categoryName][] = [
                                'name' => $test->name,
                                'template' => 'generic_test_form',
                                'test_id' => $test->id,
                                'type' => $test->field_type,
                                'values' => $dropdownValues,
                                'existing_result' => $existingResult
                            ];
                        }
                    }
                }
            }
        }

        // Deduplicate tests
        foreach ($testsByCategory as $category => $tests) {
            $testsByCategory[$category] = array_values(array_unique($tests, SORT_REGULAR));
        }

        return response()->json($testsByCategory);
    }

    public function loadTemplate($template)
    {
        $registerId = request()->input('register_id');
        $categoryName = request()->input('category_name');
        
       
        if (in_array($template, ['doctors_record_form', 'declaration_record_form', 'dr_approval_form'])) {
            $viewPath = "registration.include.{$template}";
            
            if (!View::exists($viewPath)) {
                return response()->json([
                    'error' => 'Form template not found'
                ], 404);
            }
            
            return view($viewPath, [
                'registrationId' => $registerId,
                'categoryName' => $categoryName
            ]);
        }
        
        
        if ($template === 'generic_test_form') {
            $tests = [];
            
            
            if ($testIds = request()->input('test_ids')) {
                $tests = Test::whereIn('id', $testIds)
                    ->whereHas('categories', function($query) use ($categoryName) {
                        $query->where('name', $categoryName);
                    })
                    ->get()
                    ->map(function($test) {
                        return [
                            'name' => $test->name,
                            'test_id' => $test->id,
                            'type' => $test->field_type,
                            'values' => json_decode($test->dropdown_values, true)
                        ];
                    })
                    ->toArray();
            }
            
            return view('registration.include.generic_test_form', [
                'registrationId' => $registerId,
                'categoryName' => $categoryName,
                'tests' => $tests
            ]);
        }
        
        return response()->json([
            'error' => 'Invalid template type'
        ], 400);
    }
}