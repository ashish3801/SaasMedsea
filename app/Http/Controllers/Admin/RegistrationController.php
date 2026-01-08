<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ReportAssignedMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\BillingCategoryRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RegistrationUpdateRequest;
use App\Models\Agent;
use App\Models\BillingPackage;
use App\Models\Category;
use App\Models\Clinic;
use App\Models\Nationality;
use App\Models\Package;
use App\Models\PackageRegistration;
use App\Models\Rank;
use App\Models\Registration;
use App\Models\Report;
use App\Models\Seafarer;
use App\Models\State;
use App\Models\Test;
use App\Models\UserPackage;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use iio\libmergepdf\Merger;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    use UploadFileTrait;
    /**
     * Display a listing of the resource.
     */
    
    public function index(Request $request)
    {
        $registrations = Registration::with([
            'seafarer:id,f_name,l_name,phone_no',
            'agent:id,name',
        ])
            ->where('is_active', 1)
            ->where('company_id', Auth::user()->company_id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($registrations as $registration) {
            $userPackages = UserPackage::where('registration_id', $registration->id)->get();

            $allReportIds = [];
        
            foreach ($userPackages as $userPackage) {
                $packageIds = json_decode($userPackage->package_id, true);
        
                if (is_array($packageIds)) {
                    $packages = Package::whereIn('id', $packageIds)->get();
        
                    foreach ($packages as $package) {
                        $reportIds = is_string($package->report_id) ? json_decode($package->report_id, true) : ($package->report_id ?? []);
                        if (is_array($reportIds)) {
                            $allReportIds = array_merge($allReportIds, $reportIds);
                        }
                    }
                }
            }

            $allReportIds = array_unique($allReportIds);
            $reportNames = Report::whereIn('id', $allReportIds)->pluck('name');
            $registration->report_names = $reportNames;
        }

        $categories = collect([]);
        $tests = collect([]);
        $registerId = null;
        $packageTestMapping = [];
        // dd($registrations);
        return view('registration.index', compact('registrations', 'categories', 'tests', 'registerId', 'packageTestMapping'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $state = State::with('city:name,id')->select('id', 'name')->where('is_active', 1)->get();
        $nationalities = Nationality::select('name', 'id')->get();
        $agent = Agent::select('name', 'id')->get();
        $clinic = Clinic::with('employee')->select('id', 'name')->where('is_active', 1)->get();
        $ranks = Rank::select('id', 'name')->get();
        $packages = Package::select('id', 'name')->get();

       // $package = BillingPackage::select('id', 'name')->get();
        //   dd($package);
        return view('registration.create_update', compact('state', 'nationalities', 'agent', 'clinic', 'ranks','packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {

        $companyId = Auth::user()->company_id;
        $oldRegistration = Registration::where('cdc_no', $request->cdc_no)
                                        ->orWhere('passport_no', $request->passport_no)
                                        ->orWhere('indos_no', $request->indos_no)
                                        ->first();

        if ($oldRegistration === null) {
            // New user → Create seafarer
            $seafarer = Seafarer::create([
                'company_id' => Auth::user()->company_id,  
                'f_name'     => $request->first_name,
                'm_name'     => $request->middle_name,
                'l_name'     => $request->last_name,
                'phone_no'   => $request->contact_number,
                'email'      => $request->email,
                'dob'        => $request->dob,
                'pob'        => $request->pob,
                'gender'        => $request->gender,
                'created_by' => auth()->id(),
            ]);
        } else {
            // Existing user → fetch and update seafarer
            $seafarer = Seafarer::find($oldRegistration->seafarer_id);
            if ($seafarer) {
                $seafarer->update([
                    'company_id' => Auth::user()->company_id,
                    'f_name'     => $request->first_name,
                    'm_name'     => $request->middle_name,
                    'l_name'     => $request->last_name,
                    'phone_no'   => $request->contact_number,
                    'email'      => $request->email,
                    'dob'        => $request->dob,
                    'pob'        => $request->pob,
                    'gender'        => $request->gender,
                    'created_by' => auth()->id(),
                ]);
            }
        }
    
        // Now create a new registration record for today
        Registration::create([
            'company_id'     => Auth::user()->company_id,
            'indos_no'       => $request->indos_no,
            'seafarer_id'    => $seafarer->id,
            'passport_no'    => $request->passport_no,
            'cdc_no'         => $request->cdc_no,
            'rank_id'        => $request->rank,
            'nationality_id' => $request->nationality,
            'clinic_id'      => $request->clinic,
            'company_name'   => $request->company_name,
            'address'        => $request->address,
            'vessel_name'    => $request->vessel_name,
            'vessel_type'    => $request->vessel_type,
            'route'          => $request->route,
            'referred_by'    => $request->referred_by,
            'employee_id'    => $request->doctor,
            'signature'      => $request->hasFile('signature') ? $this->upload($request->file('signature')) : null,
            'profile'        => $request->hasFile('profile') ? $this->upload($request->file('profile')) : null,
            'created_by'     => auth()->id(),
            'aadhaar_no'     => $request->aadhaar_no,
        ]);
    
        return redirect()->route('registrations.create')->with('success', 'Data Stored Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $registration = Registration::with([
                                        'seafarer',
                                        'agent:id,name',
                                        'employee'
                                    ])->where('id', $id)->firstOrFail();
                                    
        $nationalities = Nationality::select('name', 'id')->get();
        $agent = Agent::select('name', 'id')->get();
        $clinic = Clinic::with('employee')->select('id', 'name')->where('is_active', 1)->get();
        $ranks = Rank::select('id', 'name')->where('is_active', 1)->get();
        $packages = Package::select('id', 'name')->get();
        // dd($registration);
        
        
        
        return view('registration.create_update', compact('registration', 'nationalities', 'agent', 'clinic', 'ranks','packages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegistrationUpdateRequest $request, string $id)
    {
        $registration = Registration::findOrFail($id);
        
        // Step 1: Update the related seafarer
        if ($registration->seafarer) {
            $registration->seafarer->update([
                'f_name'     => $request->first_name,
                'm_name'     => $request->middle_name,
                'l_name'     => $request->last_name,
                'phone_no'   => $request->contact_number,
                'email'      => $request->email,
                'dob'        => $request->dob,
                'pob'            => $request->pob,
                'sex'        => $request->sex,
            ]);
        }
    
        // Step 2: Update registration table
        $registration->update([
            'indos_no'       => $request->indos_no,
            'passport_no'    => $request->passport_no,
            'cdc_no'         => $request->cdc_no,
            'rank_id'        => $request->rank,
            'nationality_id' => $request->nationality,
            'clinic_id'      => $request->clinic,
            'company_name'   => $request->company_name,
            'address'        => $request->address,
            'vessel_name'    => $request->vessel_name,
            'vessel_type'    => $request->vessel_type,
            'route'          => $request->route,
            'referred_by'    => $request->referred_by,
            'signature'      => $request->hasFile('signature') ? $this->upload($request->file('signature')) : $registration->signature,
            'profile'        => $request->hasFile('profile') ? $this->upload($request->file('profile')) : $registration->profile,
            'package_id'     => $request->package_id,
            'created_by'     => auth()->id(),
            'aadhaar_no'     => $request->aadhaar_no,
        ]);
    
        return redirect()->route('registrations.index')->with('success', "Data Updated Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ajaxGet(Request $request)
    {
        // $term = $request->get('term');

        // $registrations = Registration::with('seafarer')
        //     ->where('passport_no', 'LIKE', '%' . $term . '%')
        //     ->orWhere('indos_no', 'LIKE', "%{$term}%")
        //     ->get();

        // // dd($registrations);
        // return response()->json($registrations);
        $term = $request->get('term');
        $type = $request->get('type');
    
        $registrations = Registration::with('seafarer:id,f_name,m_name,l_name,email,phone_no') // Only needed fields
            ->where(function ($query) use ($term) {
                $query->where('passport_no', 'LIKE', "%{$term}%")
                      ->orWhere('indos_no', 'LIKE', "%{$term}%");
            })
            ->get();
        return response()->json($registrations);
    }

    public function packageList($registerId)
    {
        // dd("hello peter");
        $packages = Package::all();
        return response()->json(['packages' => $packages]);
        
    }
    public function testList($registerId)
    {
        // Assuming you have a `Test` model with a relationship to `register_id`
        $tests = Test::all();
        
        return response()->json(['tests' => $tests]);
    }

    public function packageForRegister(Request $request)
    {
        // dd("Hello peter");
        $registerId = (int)$request->registerId;
        $newSelectedPackages = $request->package_ids ?? [];

        if (!$registerId) {
            return response()->json(['error' => 'Invalid registration ID'], 400);
        }
    
        $userPackage = UserPackage::firstOrNew(['registration_id' => $registerId]);

        // Store package_ids as JSON
        $userPackage->package_id = json_encode($newSelectedPackages);
        $userPackage->status = 1;
        $userPackage->save();
    
        return response()->json([
            'message' => 'Package selection updated successfully!',
            'selected_packages' => $newSelectedPackages,
            'redirect_url' => url('/registrations')
        ]);
        // return response()->json(['message' => 'Packages saved successfully!',
        //         'redirect_url' => url('/registrations'),
        
        // ]);
    }
    public function testForRegister(Request $request)
    {
        // dd("Hello peter");
        $registerId = (int) $request->registerId;
        $newSelectedTests = $request->test_ids ?? [];

        // $existingTests = UserPackage::where('registration_id', $registerId)
        //                             ->whereNotNull('test_id')
        //                             ->pluck('test_id', 'id')
        //                             ->toArray();
        $existingTests = UserPackage::whereRaw("CAST(registration_id AS UNSIGNED) = ?", [$registerId])
                                ->whereNotNull('test_id')
                                ->pluck('test_id', 'id')
                                ->toArray();

        $testsToDelete = array_diff($existingTests, $newSelectedTests);
        $testsToInsert = array_diff($newSelectedTests, $existingTests);

        if (!empty($testsToDelete)) {
            // UserPackage::where('registration_id', $registerId)
            //     ->whereIn('test_id', array_map('intval', array_values($testsToDelete)))
            //     ->delete();
            UserPackage::whereRaw("CAST(registration_id AS UNSIGNED) = ?", [$registerId])
                    ->whereIn('test_id', array_values($testsToDelete))
                    ->delete();
        }

        foreach ($testsToInsert as $testId) {
            $existingEntry = UserPackage::where('registration_id', $registerId)
                                        // ->whereNull('test_id')
                                        ->first();

            if ($existingEntry) {
                $existingEntry->update(['test_id' => $testId]);
                Log::info("Updated test ID: $testId for Register ID: $registerId");
            } else {
                UserPackage::create([
                    'registration_id' => $registerId,
                    // 'package_id' => null,
                    'test_id' => $testId,
                    'status' => 1
                ]);
            }
        }

        return response()->json([
            'message' => 'Test selection updated successfully!',
            'selected_tests' => UserPackage::where('registration_id', $registerId)
                                            ->whereNotNull('test_id')
                                            ->pluck('test_id')
                                            ->toArray(),
            'redirect_url' => url('/registrations')
                                            
        ]);
    }
    public function getSelectedOptions(Request $request)
    {
        $registerId = (int)$request->registerId;
        // dd($registerId);

        if (!$registerId) {
         return response()->json(['error' => 'Invalid registration ID'], 400);
        }

        $rawPackageIds = UserPackage::where('registration_id', $registerId)
                                ->whereNotNull('package_id')
                                ->pluck('package_id')
                                ->toArray();
        // dd($selectedPackages);
        $selectedPackages = [];

        foreach ($rawPackageIds as $jsonString) {
            $decoded = json_decode($jsonString, true);

            if (is_array($decoded)) {
                $selectedPackages = array_merge($selectedPackages, $decoded);
            }
        }

        // Optional: ensure all IDs are strings
        $selectedPackages = array_map('strval', array_unique($selectedPackages));

        $selectedTests = UserPackage::where('registration_id', $registerId)
                            ->whereNotNull('test_id')
                            ->pluck('test_id')
                            ->toArray();
        
        return response()->json([
            'selected_packages' => $selectedPackages,
            'selected_tests' => $selectedTests
        ]);
    }

    public function packageDetails($registerId)
    {
        try {
            // Debug log to check registration ID
            Log::info('Fetching package details for registration ID: ' . $registerId);

            // Validate registration ID
            if (!$registerId || !Registration::find($registerId)) {
                Log::error('Invalid registration ID: ' . $registerId);
                return response()->json([
                    'error' => 'Invalid registration ID'
                ], 404);
            }

            $assignedPackages = UserPackage::with(['package.categories', 'package.tests'])
                ->where('registration_id', $registerId)
                ->whereNotNull('package_id')
                ->get();

            // Debug log for assigned packages
            Log::info('Found assigned packages: ' . $assignedPackages->count());
            
            $categoryIds = [];
            $testIds = [];
            $packageTestMapping = [];

            foreach ($assignedPackages as $userPackage) {
                Log::info('Processing Package ID: ' . $userPackage->package_id);
                
                if ($userPackage->package) {
                    // Log package details
                    Log::info('Package name: ' . $userPackage->package->name);
                    
                    // Get categories
                    $packageCategories = $userPackage->package->categories;
                    Log::info('Categories in package: ' . $packageCategories->count());
                    foreach ($packageCategories as $category) {
                        Log::info("Category found - ID: {$category->id}, Name: {$category->name}");
                        $categoryIds[] = $category->id;
                    }
                    
                    // Get tests
                    $packageTests = $userPackage->package->tests;
                    Log::info('Tests in package: ' . $packageTests->count());
                    foreach ($packageTests as $test) {
                        Log::info("Test found - ID: {$test->id}, Name: {$test->name}");
                        $testIds[] = $test->id;
                        
                        // Map tests to their categories
                        foreach ($test->categories as $category) {
                            if (!isset($packageTestMapping[$category->id])) {
                                $packageTestMapping[$category->id] = [];
                            }
                            $packageTestMapping[$category->id][] = $test->id;
                        }
                    }
                    
                    // Include individually assigned tests
                    if ($userPackage->test_id) {
                        Log::info("Including individually assigned test ID: {$userPackage->test_id}");
                        $testIds[] = $userPackage->test_id;
                    }
                } else {
                    Log::warning("Package not found for ID: {$userPackage->package_id}");
                }
            }

            $categoryIds = array_unique($categoryIds);
            $testIds = array_unique($testIds);

            // Debug log for categories and tests
            Log::info('Unique category IDs: ' . implode(', ', $categoryIds));
            Log::info('Unique test IDs: ' . implode(', ', $testIds));

            // Get categories with their tests
            $categories = Category::with(['tests' => function($query) use ($testIds) {
                $query->whereIn('tests.id', $testIds);
            }])->whereIn('id', $categoryIds)->get();

            // Get all tests
            $tests = Test::with(['categories' => function($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            }])->whereIn('id', $testIds)->get();

            // Log category-test relationships
            foreach ($categories as $category) {
                Log::info("Category {$category->name} (ID: {$category->id}):");
                Log::info("- Assigned tests: " . $category->tests->pluck('name')->implode(', '));
                if (isset($packageTestMapping[$category->id])) {
                    Log::info("- Tests from package mapping: " . implode(', ', $packageTestMapping[$category->id]));
                }
            }

            // Final debug log
            Log::info('Found categories: ' . $categories->count());
            Log::info('Found tests: ' . $tests->count());

            // Check if this is an AJAX request
            if (request()->ajax()) {
                return response()->json([
                    'view' => view('registration.modal', compact('categories', 'tests', 'registerId', 'packageTestMapping'))->render(),
                    'categories' => $categories,
                    'tests' => $tests,
                    'packageTestMapping' => $packageTestMapping
                ]);
            }

            // For non-AJAX requests, return the view directly
            return view('registration.modal', compact('categories', 'tests', 'registerId', 'packageTestMapping'));
        } catch (\Exception $e) {
            Log::error('Error in packageDetails: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            
            if (request()->ajax()) {
                return response()->json([
                    'error' => 'An error occurred while processing your request'
                ], 500);
            }
            
            throw $e;
        }
    }
    public function uploadScanDocument(Request $request)
    {
    //   dd($request->all());
        // dd("hello peter");
         $request->validate([
            'docs_1' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:25600', // 25MB max file size
            'docs_2' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:25600', // 25MB max file size
            'docs_3' => 'nullable|file|mimes:pdf,jpeg,png,jpg,doc,docx|max:25600', // 25MB max file size
        ]);

       
        $registration = Registration::findOrFail($request->registration_id);

        
        if ($request->hasFile('docs_1')) {
            $doc1 = $request->file('docs_1');
            $path1 = $doc1->store('documents', 'public');
            $registration->docs_1 = $path1;
        }

      
        if ($request->hasFile('docs_2')) {
            $doc2 = $request->file('docs_2');
            $path2 = $doc2->store('documents', 'public');
            $registration->docs_2 = $path2;
        }
        
         if ($request->hasFile('docs_3')) {
            $doc3 = $request->file('docs_3');
            $path3 = $doc3->store('documents', 'public');
            $registration->docs_3 = $path3;
        }

        
        $registration->save();

       
        return redirect()->route('registrations.index')->with('success', "Documend Uploaded Successfully.");
    }
    public function getDocuments($id)
    {
        $registration = Registration::findOrFail($id);

       return response()->json([
            'docs_1' => $registration->docs_1 ? asset('public/storage/' . $registration->docs_1) : null,
            'docs_2' => $registration->docs_2 ? asset('public/storage/' . $registration->docs_2) : null,
            'docs_3' => $registration->docs_3 ? asset('public/storage/' . $registration->docs_3) : null,
        ]);
    }
    public function deleteDoc(Request $request)
    {
        $request->validate([
            'registration_id' => 'required|integer',
            'doc_key' => 'required|string|in:docs_1,docs_2,docs_3',
        ]);
    
        try {
            $registration = Registration::find($request->registration_id);
    
            if (!$registration) {
                return response()->json([
                    'status' => false,
                    'message' => 'Registration not found.'
                ], 404);
            }
    
            $docColumn = $request->doc_key;
            $filePath = $registration->$docColumn;
    
            if ($filePath && Storage::exists(str_replace('/storage/', 'public/', $filePath))) {
                Storage::delete(str_replace('/storage/', 'public/', $filePath));
            }
    
            // Remove reference from DB
            $registration->$docColumn = null;
            $registration->save();
    
            return response()->json([
                'status' => true,
                'message' => 'Document deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
    public function sendMail(Request $request, $id)
    {
        $registration = Registration::find($id);
    
        if (!$registration || !$registration->seafarer) {
            return response()->json([
                'status' => false,
                'message' => 'Registration not found.'
            ]);
        }
    
        // Selected reports from AJAX
        $selectedReports = $request->reports ?? [];
        
           $selectedReports = array_map(function($r) {

            //  remove "_report"
            $r = str_replace('_report', '', $r);
        
            //  collapse multiple underscores to single "_"
            $r = preg_replace('/_+/', '_', $r);
        
            // trim undesired leading/trailing underscores
            $r = trim($r, '_');
        
            return strtolower($r);
        
        }, $selectedReports);
        
        if (count($selectedReports) === 0) {
            return response()->json([
                'status' => false,
                'message' => 'Please select at least one report.'
            ]);
        }
    
         // Map each checkbox value to its corresponding download route
         $reportRoutes = [
            'ilo'       => 'ilo.view',       
            'aiv'       => 'aiv.view',
            'av'        => 'av.view',
            'dna'       => 'dna.view',
            'singapore' => 'singapore.view',
            'liberian' => 'liberian.view',
            'belize' => 'belize.view',
            'vanatau'   => 'vanatau.view',
            'marshall'   => 'marshall.view',
            'bahamas'   => 'bahamas.view',
            'oguk'   => 'oguk.view',
            'malta'   => 'malta.view',
            'dental'   => 'dental.view',
            'audiometry'   => 'audiometry.view',
        ];

        $links = [];
        foreach ($selectedReports as $report) {
            if (isset($reportRoutes[$report])) {
                $links[$report] = route($reportRoutes[$report], $id); // $id matches {id} in route
            }
        }
      
        // $merger = new Merger();
    
        // foreach ($selectedReports as $report) {
    
        //     $method = $report . "Download";   // example: iloDownload()
        //     $view = "reports." . $report . "_report";  // example: reports.ilo_report
    
        //     if (!method_exists(\App\Http\Controllers\ReportDownloadController::class, $method)) {
        //         continue;
        //     }
    
        //     $controller = new \App\Http\Controllers\ReportDownloadController();
        //     $data = $controller->$method($id);
    
        //     $pdf = Pdf::loadView($view, $data)->output();
    
        //     $merger->addRaw($pdf);
        // }
    
        if (count($selectedReports) === 1) {

            // Mail::to('ashishgpt1994@gmail.com')->send(new ReportAssignedMail($links, null, null));
            Mail::to($registration->seafarer->email)->send(new ReportAssignedMail($links, null, null));
            
            return response()->json([
                'status' => true,
                'message' => 'Email sent successfully!'
            ]);
        }
        
        $controller = new ReportDownloadController();
        $finalPdf = $controller->mergeReportsRaw($selectedReports, $id);
        $fileName = "Reports_" . time() . ".pdf";
        
        $email = $registration->seafarer->email;
        
        Mail::to($email)->send(new ReportAssignedMail($links, $finalPdf, $fileName));
    
        return response()->json([
            'status' => true,
            'message' => 'Email sent successfully!'
        ]);
    }


    
}
