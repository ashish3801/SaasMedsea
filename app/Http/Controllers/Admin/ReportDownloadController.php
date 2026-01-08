<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalDataDNA;
use App\Models\MedicalDataEye;
use App\Models\Registration;
use App\Models\Test;
use App\Models\TestResult;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Return_;
use TCPDF;
use setasign\Fpdi\Tcpdf\Fpdi;



class ReportDownloadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */


    public function store(Request $request)
    {
        // dd($request->all());
        $reportTypes = $request->input('reports');
        $registerId = $request->register_id;

        // if (empty($reportTypes)) {
        //     return response()->json(['error' => 'No reports selected.'], 400);
        // }

        $reportKeys = array_map(function ($type) {
            $base = strtolower(trim(str_replace('_report', '', $type)));
            $base = str_replace('&', 'n', $base); // Replace & with 'and'
            return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $base))));
        }, $reportTypes);

        if (count($reportKeys) === 1) {
            $methodName = $reportKeys[0] . 'Download';

            if (!method_exists($this, $methodName)) {
                throw new \InvalidArgumentException("Invalid report method: $methodName");
            }
            
            $resultData = $this->$methodName($registerId);
            // dd($reportKeys[0]);

            $pdf = Pdf::loadView("reports.{$reportKeys[0]}_report", $resultData)
                ->setPaper('a4', 'portrait')
                ->setOption('margin-top', 2)
                ->setOption('margin-bottom', 2)
                ->setOption('margin-left', 2)
                ->setOption('margin-right', 2)
                ->setOption('enable-remote', true)       // Required for images
                ->setOption('checkbox-syntax', 'print')
                ->setOption('enable-local-file-access', true); 

            return $pdf->stream("{$reportKeys[0]}_report.pdf");

        }else {
            return $this->downloadMultipleReports($reportKeys, $registerId);
        }
        
    }
    public function previewReport(Request $request)
    {
        // dd($request->all());
        return view('reports.samplepdf');
        $reportType = $request->input('reports');
        $registerId = $request->register_id;

        if (count($reportType) == 1) {
            switch ($reportType[0]) {
                case 'ilo_report':
                    $thresholds = [
                        'phencyclidine' => 25,
                        'cocaine' => 300,
                        'amphetamine' => 50,
                        'morphine' => 300,
                        'marijuana' => 100,
                        'barbiturate' => 200,
                        'alcohol' => 56,
                    ];
                    //  dd($request->all());
                    $id = $request->id;
                    $data = Registration::with([
                        'seafarer',
                        'agent',
                        'CBC', // Assuming you want all fields for CBC
                        'Urine', // Replace 'registration_id' with the foreign key in Urine table
                        'Serology',
                        'Eye',
                        'Ear',
                        'USG',
                        'ECG',
                        'DNA',
                        'Physical',
                        'Biochemistry',
                        'Doctor',
                        'Declaration',
                        'Xray',
                        'clinic',
                        'clinic.employee',
                        'Approval',
                        'rank',
                        'Echo',
                        'Stress',
                        'StoolRoutin'
                    ])->with(['DNA' => function ($query) {
                        $columnsToCheck = [
                            'morphine',
                            'barbiturate',
                            'marijuana',
                            'cocaine',
                            'amphetamine',
                            'phencyclidine',
                            'propoxyphene',
                            'methadone',
                            'methaqualone',
                            'cannabinoids',
                            'tricyclic_antidepressants',
                            'alcohol'
                        ];

                        $query->select('*')->addSelect(
                            DB::raw("IF(" . implode(' OR ', array_map(function ($field) {
                                return "$field = 'Positive'";
                            }, $columnsToCheck)) . ", 'Positive', 'Negative') as dna_result")
                        );
                    }])
                        ->where('id', $registerId)
                        ->first();


                    return view('reports.ilo_report', compact('data'));

                    //$view = view('reports.ilo_report', compact('data'))->render();
                    //return response($view)->header('X-Frame-Options', 'ALLOWALL');
                case 'aiv_report':
                    $data = Registration::with('seafarer', 'Approval', 'clinic', 'clinic.employee')
                        ->where('id', $registerId)
                        ->firstOrFail();

                   
                    return view('reports.aiv_report', compact('data'));
                case 'av_report':
                    $data = MedicalDataEye::with('Registration', 'Registration.Approval', 'clinic', 'clinic.employee', 'Registration.Seafarer', 'Registration.rank')
                        ->where('registration_id', $registerId)
                        ->firstOrFail();
                    // dd($data);
                    return view('reports.av_report', compact('data'));
                case 'dna_report':
                    $data = MedicalDataDNA::with('Registration', 'Registration.Approval', 'clinic', 'Registration.Seafarer')
                        ->where('registration_id', $registerId)
                        ->firstOrFail();

                    // return $data;
                    return view('reports.dna_report', compact('data'));
                default:
                    throw new \InvalidArgumentException('Invalid report type specified.');
            }
        } else {
            return redirect()->back()->with('error', 'Please select one report');
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function iloDownload($registerId)
    {
        // dd($registerId);
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);
    
        // dd($data->rank->name);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        // $profileImage = file_exists($profilePath) 
        // ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        // : 'public/assets/img/user-image.png';
        
        $profileImage = file_exists($profilePath) && is_file($profilePath) 
        ? 'data:image/' . pathinfo($profilePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($profilePath))
        : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        
       
        $signatureImage = file_exists($signaturePath) && is_file($signaturePath) 
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
            
        $officeStamp = file_exists($officeStamp) && is_file($officeStamp) 
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        
        $doctorSign = file_exists($doctorSign) && is_file($doctorSign) 
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        function normalizeTestName($name) {
            $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
            return preg_replace('/\s+/', ' ', $normalized); 
        }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }



        $investigations = [
            [
                'blood' => ['id' => 116, 'name' => 'Haemoglobin', 'normal' => '13-16 gm/dl'],
                'urine' => ['id' => 145, 'name' => 'Color'],
                'additional' => ['id' => 156, 'name' => 'X-Ray Chest'],
            ],
            [
                'blood' => ['id' => 117, 'name' => 'Total WBC Count', 'normal' => '4000-11000 cu/mm'],
                'urine' => ['id' => 146, 'name' => 'Specific Gravity'],
                'additional' => ['id' => 160, 'name' => 'Spirometry'],
            ],
            [
                'blood' => ['id' => 118, 'name' => 'Platelets', 'normal' => '1.5-3.5 lacs/mm'],
                'urine' => ['id' => 147, 'name' => 'pH'],
                'additional' => ['id' => 159, 'name' => 'USG (Abd+pelvis)'],
            ],
            [
                'blood' => ['id' => 119, 'name' => 'ESR', 'normal' => '0-15 mm/hr'],
                'urine' => ['id' => 149, 'name' => 'Sugar'],
                'additional' => ['id' => 157, 'name' => 'ECG'],
            ],
            [
                'blood' => ['id' => 125, 'name' => 'SGOT', 'normal' => '0-37 IU/L'],
                'urine' => ['id' => 148, 'name' => 'Albumin'],
                'additional' => ['id' => 158, 'name' => 'TMT Stress TEST'],
            ],
            [
                'blood' => ['id' => 126, 'name' => 'SGPT', 'normal' => '0-37 IU/L'],
                'urine' => ['id' => 150, 'name' => 'Bile Salt'],
                'additional' => ['id' => 159, 'name' => '2D Echo'], // assuming typo fix here
            ],
            [
                'blood' => ['id' => 127, 'name' => 'GGT', 'normal' => '0-49 IU/L'],
                'urine' => ['id' => 151, 'name' => 'Bile Pigments'],
                'additional' => ['id' => 139, 'name' => 'Mantoux Test'],
            ],
            [
                'blood' => ['id' => 128, 'name' => 'S. Cholesterol', 'normal' => '145-250 mg/dl'],
                'urine' => ['id' => 152, 'name' => 'Occult Blood'],
                'additional' => ['id' => 135, 'name' => 'VDRL'],
            ],
            [
                'blood' => ['id' => 129, 'name' => 'S. Triglycerides', 'normal' => '25-160 mg/dl'],
                'urine' => ['id' => 153, 'name' => 'RBC Cells'],
                'additional' => ['id' => 140, 'name' => 'Malarial Parasite'],
            ],
            [
                'blood' => ['id' => 131, 'name' => 'Blood Sugar RBS', 'normal' => '70-140 mg/dl'],
                'urine' => ['id' => 154, 'name' => 'Pus Cells'],
                'additional' => ['id' => 155, 'name' => 'Drugs of Abuse'],
            ],
            [
                'blood' => ['id' => 134, 'name' => 'Blood Urea / BUN', 'normal' => '8-26 mg/dl'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 156, 'name' => 'Stool Routine'], // assuming typo fix
            ],
            [
                'blood' => ['id' => 133, 'name' => 'S. Creatinine', 'normal' => '0.7-1.4 mg/dl'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 136, 'name' => 'HbsAg'],
            ],
            [
                'blood' => ['id' => 132, 'name' => 'HbA1c', 'normal' => '4.0-6.5%'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 141, 'name' => 'HIV I & II'],
            ],
            [
                'blood' => ['id' => 143, 'name' => 'Blood Group'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 135, 'name' => 'VDRL'],
            ],
        ];
        
        // Build map of test results
        $investigationResults = [];
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    $investigationResults[$testId] = $value;
                }
            }
        }
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','investigations', 'investigationResults','profileImage','signatureImage','officeStamp','doctorSign');
    }

    public function aivDownload($registerId)
    {
        // dd($registerId, 'hello peter');
       
        // $data = Registration::with('seafarer', 'clinic', 'clinic.employee')
        //     ->where('id', $registerId)
        //     ->firstOrFail();
            $data = Registration::with([
                'clinic.employee',
                'seafarer',
                'medicalapproval',
            ])->findOrFail($registerId);
            
            $profilePath = public_path('images/' . $data->profile);
            $signaturePath = public_path('images/' . $data->signature);
            $officeStamp = public_path('images/' . $data->employee->stamp_upload);
            $doctorSign = public_path('images/' . $data->employee->sign_upload);
            $clinicLogo = public_path('images/' . $data->clinic->logo_upload);
         
            $profileImage = (file_exists($profilePath) && is_file($profilePath))
                ? 'data:image/' . pathinfo($profilePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($profilePath))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

            $signatureImage = (file_exists($signaturePath) && is_file($signaturePath))
                ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
                
            $officeStamp = file_exists($officeStamp)
                ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
            
            $doctorSign = file_exists($doctorSign)
                ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

            return [
                'data' => $data,
                'profileImage' => $profileImage,
                'signatureImage' => $signatureImage,
                'officeStamp' => $officeStamp,
                'doctorSign' => $doctorSign,
            ];
    }

    public function avDownload($registerId)
    {
        $data = Registration::with([
                'clinic.employee',
                'seafarer',
                'medicalapproval',
            ])->findOrFail($registerId);
            
            $profilePath = public_path('images/' . $data->profile);
            $signaturePath = public_path('images/' . $data->signature);
            $officeStamp = public_path('images/' . $data->employee->stamp_upload);
            $doctorSign = public_path('images/' . $data->employee->sign_upload);
            $clinicLogo = public_path('images/' . $data->clinic->logo_upload);
         
            $profileImage = (file_exists($profilePath) && is_file($profilePath)) 
            ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        
            $signatureImage = (file_exists($signaturePath) && is_file($signaturePath))
                ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
                
            $officeStamp = file_exists($officeStamp)
                ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
            
            $doctorSign = file_exists($doctorSign)
                ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $tests = DB::table('tests')->pluck('name', 'id')->toArray();
    
        $testResults = TestResult::where('registration_id', $registerId)->get();

        
        $testResultMap = [];
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            if (isset($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    $testResultMap[$testId] = $value;
                }
            }
        }
        $testResults = [];
    
        foreach ($testResults as $result) {
            $testName = $tests[$result->test_id] ?? 'Unknown Test';
    
            $testResults[] = [
                'test_name'    => $testName,
                'sub_test'     => $result->sub_test ?? '',
                'right_eye'    => $result->right_eye ?? '-',
                'left_eye'     => $result->left_eye ?? '-',
                'both_eye'     => $result->both_eye ?? '-',
                'result'       => $result->result ?? '-',
            ];
        }
        return [
            'data' => $data,
            'testResultMap' => $testResultMap,
            'tests' =>$tests,
            'profileImage' => $profileImage,
            'signatureImage' => $signatureImage,
            'officeStamp' => $officeStamp,
            'doctorSign' => $doctorSign,
        ];
    }

    public function dnaDownload($registerId)
    {
        $data = Registration::with('clinic', 'Seafarer')->where('id', $registerId)->firstOrFail();
        $cutoffTestIdNamePairs = [
            169 => ['name' => 'PCP (Phencyclidine) (Urine)', 'cutoff' => '25 ngm / ml'],
            166 => ['name' => 'Cocaine (Urine)', 'cutoff' => '300 ngm / ml'],
            164 => ['name' => 'Amphetamine (Urine)', 'cutoff' => '50 ngm / ml'],
            167 => ['name' => 'Opiates (Morphine) (Urine)', 'cutoff' => '300 ngm / ml'],
            165 => ['name' => 'THC / Marijuana (Urine)', 'cutoff' => '100 ngm / ml'],
            168 => ['name' => 'Barbiturates (Urine)', 'cutoff' => '200 ngm / ml'],
            170 => ['name' => 'Alcohol (Blood)', 'cutoff' => '9-56 I.U./L'],
        ];
    
        // dd($cutoffTestIdNamePairs);
        $testResults = TestResult::where('registration_id', $registerId)->get();

        $results = [];

        // Flatten all test values from form_data
        $allTestValues = [];
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data)
                ? json_decode($result->form_data, true)
                : $result->form_data;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $allTestValues[$testId] = $value;
            }
        }

        // Match values to cutoff test list
        foreach ($cutoffTestIdNamePairs as $testId => $info) {
            $results[] = [
                'name' => $info['name'],
                'cutoff' => $info['cutoff'],
                'value' => $allTestValues[$testId] ?? '-',
            ];
        }
        return [
            'data' => $data,
            'results' => $results,
        ];
    }

    private function downloadMultipleReports($reportKeys, $registerId)
    {
        $merger = new Fpdi();
    
        foreach ($reportKeys as $reportKey) {
            $methodName = $reportKey . 'Download';
            $resultData = $this->$methodName($registerId);
    
            $pdfContent = Pdf::loadView("reports.{$reportKey}_report", $resultData)
                ->setPaper('a4', 'portrait')
                ->setOption('margin-top', 2)
                ->setOption('margin-bottom', 2)
                ->setOption('margin-left', 2)
                ->setOption('margin-right', 2)
                ->setOption('enable-remote', true)
                ->setOption('enable-local-file-access', true)
                ->output();
    
            $pageCount = $merger->setSourceFile(
                \setasign\Fpdi\PdfParser\StreamReader::createByString($pdfContent)
            );
    
            for ($i = 1; $i <= $pageCount; $i++) {
                $page = $merger->importPage($i);
                $size = $merger->getTemplateSize($page);
    
                $orientation = $size['orientation'] ?? 'P';
    
                $merger->AddPage(
                    $orientation,
                    [$size['width'], $size['height']]
                );
    
                $merger->SetFillColor(255, 255, 255);
                $merger->Rect(0, 0, $size['width'], $size['height'], 'F');
                $merger->useTemplate($page, 0, 0.1, $size['width'], $size['height'], true);
            }
        }
        
        $pdfData = $merger->Output('pdf');
      
        // return response($pdfData, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => 'inline; filename="combined.pdf"',
        //     'Cache-Control' => 'private, max-age=0, must-revalidate',
        //     'Pragma' => 'public',
        // ]);
        $filename = 'merged_report_' . time() . '.pdf';
        return response()->streamDownload(
            function () use ($pdfData) {
                echo $pdfData;
            },
            $filename,
            [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Content-Length' => strlen($pdfData),
            ]
        );
    }

    protected function createZipArchive(array $pdfs)
    {
       
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            if (!mkdir($tempDir, 0755, true)) {
                throw new \RuntimeException("Failed to create temp directory");
            }
        }

        $zipFileName = 'reports_' . now()->format('Ymd_His') . '.zip';
        $zipPath = $tempDir . '/' . $zipFileName;
        
        $zip = new \ZipArchive();
        $zipStatus = $zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        
        if ($zipStatus !== TRUE) {
            throw new \RuntimeException("Could not create ZIP archive. Error code: " . $zipStatus);
        }

        $tempFiles = [];
        try {
            foreach ($pdfs as $index => $pdf) {
                $tempPdfPath = $tempDir . '/report_' . $index . '_' . uniqid() . '.pdf';
                $pdf->save($tempPdfPath);
                
                if (!file_exists($tempPdfPath)) {
                    throw new \RuntimeException("Failed to save PDF: " . $tempPdfPath);
                }
                
                if (!$zip->addFile($tempPdfPath, 'report_' . ($index + 1) . '.pdf')) {
                    throw new \RuntimeException("Failed to add file to ZIP: " . $tempPdfPath);
                }
                
                $tempFiles[] = $tempPdfPath;
            }
            
            if (!$zip->close()) {
                throw new \RuntimeException("Failed to close ZIP archive");
            }
            
            // Verify the zip file was created
            if (!file_exists($zipPath)) {
                throw new \RuntimeException("ZIP file was not created");
            }
            
            return response()->download($zipPath)->deleteFileAfterSend(true);
            
        } catch (\Exception $e) {
            // Clean up any temporary files
            foreach ($tempFiles as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
            // Delete the zip file if it was partially created
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
            
            throw new \RuntimeException("ZIP creation failed: " . $e->getMessage());
        }
    }
    public function singaporeDownload($registerId)
    {
        // return view('reports.singapore_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'medicalapproval',
            'rank'
        ])->findOrFail($registerId);
        // dd($data);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStampPath = public_path('images/' . $data->employee->stamp_upload);
        $doctorSignPath = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath)
            ? 'data:image/' . pathinfo($profilePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($profilePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $signatureImage = file_exists($signaturePath)
            ? 'data:image/' . pathinfo($signaturePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($signaturePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $officeStamp = file_exists($officeStampPath)
            ? 'data:image/' . pathinfo($officeStampPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($officeStampPath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $doctorSign = file_exists($doctorSignPath)
            ? 'data:image/' . pathinfo($doctorSignPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($doctorSignPath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        return compact('data', 'profileImage', 'signatureImage', 'officeStamp', 'doctorSign');
    }
    public function liberianDownload($registerId)
    {
       
        // return view('reports.liberian_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'medicalapproval',
            
        ])->findOrFail($registerId);
        // dd($data);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStampPath = public_path('images/' . $data->employee->stamp_upload);
        $doctorSignPath = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath)
            ? 'data:image/' . pathinfo($profilePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($profilePath))
            :'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $signatureImage = file_exists($signaturePath)
            ? 'data:image/' . pathinfo($signaturePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($signaturePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $officeStamp = file_exists($officeStampPath)
            ? 'data:image/' . pathinfo($officeStampPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($officeStampPath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $doctorSign = file_exists($doctorSignPath)
            ? 'data:image/' . pathinfo($doctorSignPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($doctorSignPath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        
        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72,
            // Results
            73, 62, 51, 55, 66, 70
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
            194 => 'Upper Extremities',
            195 => 'Lower Extremities',
            202 => 'Speech',
            214 => 'Liberia certificate code',
            171 => 'Details of Medical Examination - Liberia Form',
            
            
            
            
            
            
            
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }

        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','profileImage','signatureImage','officeStamp','doctorSign');
    }
    public function belizeDownload($registerId)
    {
        // return view('reports.belize_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'medicalapproval',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStampPath = public_path('images/' . $data->employee->stamp_upload);
        $doctorSignPath = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath)
            ? 'data:image/' . pathinfo($profilePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($profilePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));

        $signatureImage = file_exists($signaturePath)
            ? 'data:image/' . pathinfo($signaturePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($signaturePath))
            : null;

        $officeStamp = file_exists($officeStampPath)
            ? 'data:image/' . pathinfo($officeStampPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($officeStampPath))
            : null;

        $doctorSign = file_exists($doctorSignPath)
            ? 'data:image/' . pathinfo($doctorSignPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($doctorSignPath))
            : null;
        
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
        
        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $visionAidNotRequired = (
            ($specialTests['by_id'][56] ?? null) === '-' &&
            ($specialTests['by_id'][59] ?? null) === '-' &&
            ($specialTests['by_id'][57] ?? null) === '-' &&
            ($specialTests['by_id'][60] ?? null) === '-'
        );

        return compact('data', 'profileImage', 'signatureImage', 'officeStamp', 'doctorSign','specialTests','visionAidNotRequired');
    }
    public function vanatauDownload($registerId)
    {
        
        // return view('reports.vanatau_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath) 
        ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        : null;
    
        $signatureImage = file_exists($signaturePath)
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : null;
            
        $officeStamp = file_exists($officeStamp)
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : null;
        
        $doctorSign = file_exists($doctorSign)
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : null;
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }
        $cutoffTestIdNamePairs = [];
        $cutoffTestIdNamePairs = [
            169 => ['name' => 'PCP (Phencyclidine) (Urine)', 'cutoff' => '25 ngm / ml'],
            166 => ['name' => 'Cocaine (Urine)', 'cutoff' => '300 ngm / ml'],
            164 => ['name' => 'Amphetamine (Urine)', 'cutoff' => '50 ngm / ml'],
            167 => ['name' => 'Opiates (Morphine) (Urine)', 'cutoff' => '300 ngm / ml'],
            165 => ['name' => 'THC / Marijuana (Urine)', 'cutoff' => '100 ngm / ml'],
            168 => ['name' => 'Barbiturates (Urine)', 'cutoff' => '200 ngm / ml'],
            170 => ['name' => 'Alcohol (Blood)', 'cutoff' => '9-56 I.U./L'],
        ];

        $results = [];
        foreach ($cutoffTestIdNamePairs as $testId => $info) {
            $results[] = [
                'id' => $testId, // Add ID here
                'name' => $info['name'],
                'cutoff' => $info['cutoff'],
                'value' => $allTestValues[$testId] ?? '-',
            ];
        }

        $drugTestMapping = [
            165 => 'THC',
            166 => 'Cocaine',
            169 => 'PCP',
            167 => 'Morphine',
            164 => 'Amphetamine',
            168 => 'Barbiturates',
        ];

        $drugResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($drugTestMapping[$testId])) {
                    $drugResults[$drugTestMapping[$testId]] = $value;
                }
            }
        }

        $eyeTestIds = [
            'right' => [
                'distant_unaided' => 48,
                'near_unaided' => 52,
                'distant_aided' => 56,
                'near_aided' => 59,
            ],
            'left' => [
                'distant_unaided' => 49,
                'near_unaided' => 53,
                'distant_aided' => 57,
                'near_aided' => 60,
            ]
        ];
        $investigations = [];
        $investigationResults = [];
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','eyeTestIds','investigations','cutoffTestIdNamePairs','investigationResults','profileImage','signatureImage','officeStamp','doctorSign','results','drugResults');
    }
    public function marshallDownload($registerId)
    {
        
        // return view('reports.marshall_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath) 
        ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
    
        $signatureImage = file_exists($signaturePath)
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : null;
            
        $officeStamp = file_exists($officeStamp)
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : null;
        
        $doctorSign = file_exists($doctorSign)
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : null;
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }
        $cutoffTestIdNamePairs = [];
        $cutoffTestIdNamePairs = [
            169 => ['name' => 'PCP (Phencyclidine) (Urine)', 'cutoff' => '25 ngm / ml'],
            166 => ['name' => 'Cocaine (Urine)', 'cutoff' => '300 ngm / ml'],
            164 => ['name' => 'Amphetamine (Urine)', 'cutoff' => '50 ngm / ml'],
            167 => ['name' => 'Opiates (Morphine) (Urine)', 'cutoff' => '300 ngm / ml'],
            165 => ['name' => 'THC / Marijuana (Urine)', 'cutoff' => '100 ngm / ml'],
            168 => ['name' => 'Barbiturates (Urine)', 'cutoff' => '200 ngm / ml'],
            170 => ['name' => 'Alcohol (Blood)', 'cutoff' => '9-56 I.U./L'],
        ];

        foreach ($cutoffTestIdNamePairs as $testId => $info) {
            $results[] = [
                'name' => $info['name'],
                'cutoff' => $info['cutoff'],
                'value' => $allTestValues[$testId] ?? '-',
            ];
        }
        $eyeTestIds = [
            'right' => [
                'distant_unaided' => 48,
                'near_unaided' => 52,
                'distant_aided' => 56,
                'near_aided' => 59,
            ],
            'left' => [
                'distant_unaided' => 49,
                'near_unaided' => 53,
                'distant_aided' => 57,
                'near_aided' => 60,
            ]
        ];
        $investigations = [];
        $investigationResults = [];
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','eyeTestIds','investigations','cutoffTestIdNamePairs','investigationResults','profileImage','signatureImage','officeStamp','doctorSign','results');
    }
    public function bahamasDownload($registerId)
    {
        
          $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);
        // dd($data);
        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath) 
        ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
    
        $signatureImage = file_exists($signaturePath)
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : null;
            
        $officeStamp = file_exists($officeStamp)
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : null;
        
        $doctorSign = file_exists($doctorSign)
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : null;
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }



        $investigations = [
            [
                'blood' => ['id' => 116, 'name' => 'Haemoglobin', 'normal' => '13-16 gm/dl'],
                'urine' => ['id' => 145, 'name' => 'Color'],
                'additional' => ['id' => 156, 'name' => 'X-Ray Chest'],
            ],
            [
                'blood' => ['id' => 117, 'name' => 'Total WBC Count', 'normal' => '4000-11000 cu/mm'],
                'urine' => ['id' => 146, 'name' => 'Specific Gravity'],
                'additional' => ['id' => 160, 'name' => 'Spirometry'],
            ],
            [
                'blood' => ['id' => 118, 'name' => 'Platelets', 'normal' => '1.5-3.5 lacs/mm'],
                'urine' => ['id' => 147, 'name' => 'pH'],
                'additional' => ['id' => 159, 'name' => 'USG (Abd+pelvis)'],
            ],
            [
                'blood' => ['id' => 119, 'name' => 'ESR', 'normal' => '0-15 mm/hr'],
                'urine' => ['id' => 149, 'name' => 'Sugar'],
                'additional' => ['id' => 157, 'name' => 'ECG'],
            ],
            [
                'blood' => ['id' => 125, 'name' => 'SGOT', 'normal' => '0-37 IU/L'],
                'urine' => ['id' => 148, 'name' => 'Albumin'],
                'additional' => ['id' => 158, 'name' => 'TMT Stress TEST'],
            ],
            [
                'blood' => ['id' => 126, 'name' => 'SGPT', 'normal' => '0-37 IU/L'],
                'urine' => ['id' => 150, 'name' => 'Bile Salt'],
                'additional' => ['id' => 159, 'name' => '2D Echo'], // assuming typo fix here
            ],
            [
                'blood' => ['id' => 127, 'name' => 'GGT', 'normal' => '0-49 IU/L'],
                'urine' => ['id' => 151, 'name' => 'Bile Pigments'],
                'additional' => ['id' => 139, 'name' => 'Mantoux Test'],
            ],
            [
                'blood' => ['id' => 128, 'name' => 'S. Cholesterol', 'normal' => '145-250 mg/dl'],
                'urine' => ['id' => 152, 'name' => 'Occult Blood'],
                'additional' => ['id' => 135, 'name' => 'VDRL'],
            ],
            [
                'blood' => ['id' => 129, 'name' => 'S. Triglycerides', 'normal' => '25-160 mg/dl'],
                'urine' => ['id' => 153, 'name' => 'RBC Cells'],
                'additional' => ['id' => 140, 'name' => 'Malarial Parasite'],
            ],
            [
                'blood' => ['id' => 131, 'name' => 'Blood Sugar RBS', 'normal' => '70-140 mg/dl'],
                'urine' => ['id' => 154, 'name' => 'Pus Cells'],
                'additional' => ['id' => 155, 'name' => 'Drugs of Abuse'],
            ],
            [
                'blood' => ['id' => 134, 'name' => 'Blood Urea / BUN', 'normal' => '8-26 mg/dl'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 156, 'name' => 'Stool Routine'], // assuming typo fix
            ],
            [
                'blood' => ['id' => 133, 'name' => 'S. Creatinine', 'normal' => '0.7-1.4 mg/dl'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 136, 'name' => 'HbsAg'],
            ],
            [
                'blood' => ['id' => 132, 'name' => 'HbA1c', 'normal' => '4.0-6.5%'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 141, 'name' => 'HIV I & II'],
            ],
            [
                'blood' => ['id' => 143, 'name' => 'Blood Group'],
                'urine' => ['id' => null, 'name' => ''],
                'additional' => ['id' => 135, 'name' => 'VDRL'],
            ],
        ];
        
        // Build map of test results
        $investigationResults = [];
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    $investigationResults[$testId] = $value;
                }
            }
        }
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','investigations', 'investigationResults','profileImage','signatureImage','officeStamp','doctorSign');
    }
    public function ogukDownload($registerId)
    {
        
        // return view('reports.oguk_report');
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath) 
        ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
    
        $signatureImage = file_exists($signaturePath)
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : null;
            
        $officeStamp = file_exists($officeStamp)
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : null;
        
        $doctorSign = file_exists($doctorSign)
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : null;
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }
        $cutoffTestIdNamePairs = [];
        $cutoffTestIdNamePairs = [
            169 => ['name' => 'PCP (Phencyclidine) (Urine)', 'cutoff' => '25 ngm / ml'],
            166 => ['name' => 'Cocaine (Urine)', 'cutoff' => '300 ngm / ml'],
            164 => ['name' => 'Amphetamine (Urine)', 'cutoff' => '50 ngm / ml'],
            167 => ['name' => 'Opiates (Morphine) (Urine)', 'cutoff' => '300 ngm / ml'],
            165 => ['name' => 'THC / Marijuana (Urine)', 'cutoff' => '100 ngm / ml'],
            168 => ['name' => 'Barbiturates (Urine)', 'cutoff' => '200 ngm / ml'],
            170 => ['name' => 'Alcohol (Blood)', 'cutoff' => '9-56 I.U./L'],
        ];

        $results = [];
        foreach ($cutoffTestIdNamePairs as $testId => $info) {
            $results[] = [
                'id' => $testId, // Add ID here
                'name' => $info['name'],
                'cutoff' => $info['cutoff'],
                'value' => $allTestValues[$testId] ?? '-',
            ];
        }

        $drugTestMapping = [
            165 => 'THC',
            166 => 'Cocaine',
            169 => 'PCP',
            167 => 'Morphine',
            164 => 'Amphetamine',
            168 => 'Barbiturates',
        ];

        $drugResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($drugTestMapping[$testId])) {
                    $drugResults[$drugTestMapping[$testId]] = $value;
                }
            }
        }

        $eyeTestIds = [
            'right' => [
                'distant_unaided' => 48,
                'near_unaided' => 52,
                'distant_aided' => 56,
                'near_aided' => 59,
            ],
            'left' => [
                'distant_unaided' => 49,
                'near_unaided' => 53,
                'distant_aided' => 57,
                'near_aided' => 60,
            ]
        ];
        $investigations = [];
        $investigationResults = [];
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','eyeTestIds','investigations','cutoffTestIdNamePairs','investigationResults','profileImage','signatureImage','officeStamp','doctorSign','results','drugResults');
    }
    public function maltaDownload($registerId)
    {
        // return view('reports.malta_report');
         $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = file_exists($profilePath) 
        ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
        : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
    
        $signatureImage = file_exists($signaturePath)
            ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
            : null;
            
        $officeStamp = file_exists($officeStamp)
            ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
            : null;
        
        $doctorSign = file_exists($doctorSign)
            ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
            : null;
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $testResults = TestResult::where('registration_id', $registerId)->get();
       
        $categorizedResults = [];
        $finalResults = [];

        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
            $categoryId = $result->category_id;

            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $testName = $tests[$testId] ?? null;

                if (!$testName) continue;

                if ($categoryId == 2) {
                    $finalResults[$testName]['doctor'] = $value;
                } else {
                    $finalResults[$testName]['candidate'] = $value;
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

        $physicalResults = [];
        
        $physicalTestIds = [
            25 => 'Height',
            26 => 'Weight (in kg)',
            // 27 => 'BMI',
            27 => 'Chest Insp-Exp (cm)',
            28 => 'Blood Pressure (in mm of hg)',
            29 => 'Pulse-Beats/Minute',
            30 => 'Resp-Rate/Minute',
            31 => 'General Condition',
        ];

        $heightCm = null;
        $weightKg = null;

        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                if (isset($physicalTestIds[$testId])) {
                    $physicalResults[$testId] = $value;
                    if ($testId == 25) {  // Height ID
                        $heightCm = $value;
                    }
                    if ($testId == 26) {  // Weight ID
                        $weightKg = $value;
                    }
                }
            }
        }

        if ($heightCm && $weightKg) {
            $heightM = $heightCm / 100; 
            $bmi = $weightKg / ($heightM * $heightM);
            $bmi = round($bmi, 2); 

            $physicalResults['BMI'] = $bmi;
        }

        $specialTests = [];
        $eyeAndEarTestIds = [
            // Right Eye
            48, 52, 56, 59, 63, 67,
            // Left Eye (assuming similar IDs exist)
            49, 53, 57, 60, 64, 68,
            // Right Ear
            74, 75, 76, 77, 78, 79, 80, 81, 89,
            // Left Ear (assuming similar IDs exist)
            82, 83, 84, 85, 86, 87, 88, 90, 91,
            // Color Vision (assuming these IDs)
            70, 71, 72
        ];
        
        foreach ($testResults as $testResult) {
            $formData = is_string($testResult->form_data) ? json_decode($testResult->form_data, true) : $testResult->form_data;
        
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                // Only process special tests (eye/ear/color vision)
                if (in_array($testId, $eyeAndEarTestIds)) {
                    $testName = $tests[$testId] ?? null;
                    if ($testName) {
                        $normalized = normalizeTestName($testName);
                        $specialTests[$normalized] = $value;
                        
                        // Alternative: Store by ID as well for more direct access
                        $specialTests['by_id'][$testId] = $value;
                    }
                }
            }
        }

        $systemTests = [];
        $systemTestIdNamePairs = [
            32 => 'Head and Neck',
            35 => 'Respiratory System',
            38 => 'Eyes',
            41 => 'Cardiovascular System',
            44 => 'Ears / Nose / Throat',
            33 => 'Per Abdomen',
            36 => 'Teeth / Oral Cavity',
            39 => 'Genitourinary System',
            42 => 'Musculo-Skeletal System',
            45 => 'Others',
            34 => 'Nervous System',
            37 => 'Hernia / Hydrocele',
            47 => 'Reflexes',
            40 => 'Varicose Veins',
            43 => 'Skin',
            46 => 'Fissure / Fistula / Piles',
        ];
        
        foreach ($systemTestIdNamePairs as $testId => $testName) {
            $systemTests[$testId] = [
                'name' => $testName,
                'value' => '-', // Default to dash
            ];
        }
        
        foreach ($testResults as $result) {
            $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
        
            if (isset($formData['tests']) && is_array($formData['tests'])) {
                foreach ($formData['tests'] as $testId => $value) {
                    if (isset($systemTests[$testId])) {
                        $systemTests[$testId]['value'] = $value; // Update value only
                    }
                }
            }
        }
        $cutoffTestIdNamePairs = [];
        $cutoffTestIdNamePairs = [
            169 => ['name' => 'PCP (Phencyclidine) (Urine)', 'cutoff' => '25 ngm / ml'],
            166 => ['name' => 'Cocaine (Urine)', 'cutoff' => '300 ngm / ml'],
            164 => ['name' => 'Amphetamine (Urine)', 'cutoff' => '50 ngm / ml'],
            167 => ['name' => 'Opiates (Morphine) (Urine)', 'cutoff' => '300 ngm / ml'],
            165 => ['name' => 'THC / Marijuana (Urine)', 'cutoff' => '100 ngm / ml'],
            168 => ['name' => 'Barbiturates (Urine)', 'cutoff' => '200 ngm / ml'],
            170 => ['name' => 'Alcohol (Blood)', 'cutoff' => '9-56 I.U./L'],
        ];

        foreach ($cutoffTestIdNamePairs as $testId => $info) {
            $results[] = [
                'name' => $info['name'],
                'cutoff' => $info['cutoff'],
                'value' => $allTestValues[$testId] ?? '-',
            ];
        }
        $eyeTestIds = [
            'right' => [
                'distant_unaided' => 48,
                'near_unaided' => 52,
                'distant_aided' => 56,
                'near_aided' => 59,
            ],
            'left' => [
                'distant_unaided' => 49,
                'near_unaided' => 53,
                'distant_aided' => 57,
                'near_aided' => 60,
            ]
        ];
        $investigations = [];
        $investigationResults = [];
        return compact('data', 'categorizedResults','tests','finalResults','physicalResults','specialTests','systemTests','eyeTestIds','investigations','cutoffTestIdNamePairs','investigationResults','profileImage','signatureImage','officeStamp','doctorSign','results');
  
    
    }
    public function dentalDownload($registerId)
    {
        // return view('reports.malta_report');
         $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank', 
            'medicalapproval',
        ])->findOrFail($registerId);

        // dd($data->employee->stamp_upload);
        $profilePath = public_path('images/' . $data->profile);
        $signaturePath = public_path('images/' . $data->signature);
        $officeStamp = public_path('images/' . $data->employee->stamp_upload);
        $doctorSign = public_path('images/' . $data->employee->sign_upload);

        $profileImage = (file_exists($profilePath) && is_file($profilePath)) 
            ? 'data:image/'.pathinfo($profilePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($profilePath))
            : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
        
            $signatureImage = (file_exists($signaturePath) && is_file($signaturePath))
                ? 'data:image/'.pathinfo($signaturePath, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($signaturePath))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
                
            $officeStamp = file_exists($officeStamp)
                ? 'data:image/'.pathinfo($officeStamp, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($officeStamp))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
            
            $doctorSign = file_exists($doctorSign)
                ? 'data:image/'.pathinfo($doctorSign, PATHINFO_EXTENSION).';base64,'.base64_encode(file_get_contents($doctorSign))
                : 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
                
        
        $tests = DB::table('tests')->pluck('name', 'id')->toArray();

        $dentalTests = [
            206 => 'Oral Health Status',
            207 => 'Dental Carries Present',
            208 => 'Carries Experience',
            209 => 'Uncorrected Caries',
            210 => 'Soft Tissue Pathology',
            211 => 'Maloccusion',
            212 => 'Dental Treatment Required',
        ];
        
      
        $testResults = [];
        foreach ($dentalTests as $testId => $testName) {
            $testResults[$testId] = [
                'name' => $testName,
                'value' => '-', // default
            ];
        }
        
        // Get all test results for this registration
        $allTestResults = TestResult::where('registration_id', $registerId)->get();
        
        foreach ($allTestResults as $result) {
            if (!empty($result->form_data)) {
                // Decode only if it's a string
                $formData = is_string($result->form_data) ? json_decode($result->form_data, true) : $result->form_data;
                
                if (!empty($formData['tests'])) {
                    foreach ($formData['tests'] as $testId => $value) {
                        $testId = (int) $testId;
                        if (isset($testResults[$testId])) {
                            $testResults[$testId]['value'] = $value;
                        }
                    }
                }
            }
        }
        // function normalizeTestName($name) {
        //     $normalized = strtolower(preg_replace('/[\/\-]+/', ' ', trim($name)));
        //     return preg_replace('/\s+/', ' ', $normalized); 
        // }

       
        return compact('data','tests','testResults','profileImage','signatureImage','officeStamp','doctorSign');
  
    
    }

    private function quickchartEncode($config)
    {
        $json = json_encode($config, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        
        // Replace all "function(...) { ... }" strings with raw JS functions
        return preg_replace_callback('/"function\s*\([^"]+\}\s*"/', function ($matches) {
            return trim($matches[0], '"');
        }, $json);
    }
    
    private function getBase64Image($path, $fallbackBase64)
    {
        if ($path && file_exists($path) && is_file($path)) {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            return 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($path));
        }
        return 'data:image/png;base64,' . $fallbackBase64;
    }
    
    

    public function audiometryDownload($registerId)
    {
        // Load main data
        $data = Registration::with([
            'clinic.employee',
            'seafarer',
            'rank',
            'medicalapproval',
        ])->findOrFail($registerId);
    
        $defaultImg = base64_encode(file_get_contents(public_path('assets/img/user-image.png')));
    
        $profileImage   = $this->getBase64Image(public_path('images/' . $data->profile), $defaultImg);
        $signatureImage = $this->getBase64Image(public_path('images/' . $data->signature), $defaultImg);
        $officeStamp    = $this->getBase64Image(public_path('images/' . optional($data->employee)->stamp_upload), $defaultImg);
        $doctorSign     = $this->getBase64Image(public_path('images/' . optional($data->employee)->sign_upload), $defaultImg);
    
        // Load test results
        $testResults = TestResult::where('registration_id', $registerId)->get();
        $mergedEarTests = [];
    
        foreach ($testResults as $tr) {
            $formData = is_string($tr->form_data) ? json_decode($tr->form_data, true) : $tr->form_data;
            foreach ($formData['tests'] ?? [] as $testId => $value) {
                $mergedEarTests[$testId] = $value;
            }
        }
    
        // Frequencies used (no 250)
        $freqs = [500, 1000, 2000, 3000, 4000, 6000, 8000];
    
        // Create audiogram-style spaced X-axis
        $xAxis = [];
        foreach ($freqs as $f) {
            $xAxis[] = "";    // blank
            $xAxis[] = $f;    // frequency label
        }
        $xAxis[] = "";       // last blank
    
        // Ear test ID mapping
        $rightIds = [74, 75, 76, 77, 78, 79, 80, 81];
        $leftIds  = [82, 83, 84, 85, 86, 87, 88, 91];
    
        // Raw values
        $rightRaw = array_map(fn($id)=>is_numeric($mergedEarTests[$id]??null)?(int)$mergedEarTests[$id]:null, $rightIds);
        $leftRaw  = array_map(fn($id)=>is_numeric($mergedEarTests[$id]??null)?(int)$mergedEarTests[$id]:null, $leftIds);
    
        // Insert null spacing to match xAxis spacing
        $rightData = [];
        foreach ($rightRaw as $v){ $rightData[] = null; $rightData[] = $v; }
        $rightData[] = null;
    
        $leftData = [];
        foreach ($leftRaw as $v){ $leftData[] = null; $leftData[] = $v; }
        $leftData[] = null;
    
        // ==========================
        //    BASE CHART TEMPLATE
        // ==========================
        $baseChart = [
            "type" => "line",
            "data" => [
                "labels" => $xAxis,
                "datasets" => []
            ],
            "options" => [
                "responsive" => false,
                "maintainAspectRatio" => false,
    
                "scales" => [
                    "y" => [
                        "reverse" => true,
                        "min" => -10,
                        "max" => 120,
                        "ticks" => [
                            "stepSize" => 10
                        ],
                        "grid" => [
                            "color" => "#000000",
                            "lineWidth" => 1,
                        ],
                    ],
                    "x" => [
                        "offset" => true,
                        "grid" => [
                            "display" => true,
                            "color" => "#000000",
                            "lineWidth" => 1,
                            "drawBorder" => true,
                            "drawTicks" => true
                        ]
                    ]
                ],
    
                "elements" => [
                    "line" => [
                        "tension" => 0,
                        "borderWidth" => 2
                    ],
                    "point" => [
                        "radius" => 6,
                        "borderWidth" => 2
                    ]
                ],
    
                "plugins" => [
                    "legend" => ["display" => false],
                    "title" => [
                        "display" => true,
                        "font" => ["size" => 22]
                    ]
                ]
            ]
        ];
    
        // ==========================
        // LEFT EAR (X)
        // ==========================
        $leftChart = $baseChart;
        $leftChart["options"]["plugins"]["title"]["text"] = "LEFT EAR";
    
        $leftChart["data"]["datasets"][] = [
            "data" => $leftData,
            "borderColor" => "blue",
            "pointBorderColor" => "blue",
            "pointBackgroundColor" => "white",
            "pointStyle" => "cross",
            "pointRotation" => 45,
            "borderWidth" => 2,
            "spanGaps" => true,     // <<< FIX: CONNECT POINTS
          
        ];
    
        $leftUrl = "https://quickchart.io/chart?" . http_build_query([
            "v" => "4",
            "w" => 700,
            "h" => 500,
            "c" => json_encode($leftChart)
        ]);
    
        $leftChartImage = "data:image/png;base64," . base64_encode(file_get_contents($leftUrl));
    
        // ==========================
        // RIGHT EAR (O)
        // ==========================
        $rightChart = $baseChart;
        $rightChart["options"]["plugins"]["title"]["text"] = "RIGHT EAR";
    
        $rightChart["data"]["datasets"][] = [
            "data" => $rightData,
            "borderColor" => "red",
            "pointBorderColor" => "red",
            "pointBackgroundColor" => "white",
            "pointStyle" => "circle",
            "borderWidth" => 2,
            "spanGaps" => true,     // <<< FIX: CONNECT POINTS
        ];
    
        $rightUrl = "https://quickchart.io/chart?" . http_build_query([
            "v" => "4",
            "w" => 700,
            "h" => 500,
            "c" => json_encode($rightChart)
        ]);
    
        $rightChartImage = "data:image/png;base64," . base64_encode(file_get_contents($rightUrl));
        
     
        // SPECIAL TESTS
      
        $specialTestIds = [89, 90, 213];   // right / left / advice
        
        $specialTests = [
            'by_id' => []
        ];
        
        foreach ($specialTestIds as $id) {
            $specialTests['by_id'][$id] = $mergedEarTests[$id] ?? 'N/A';
        }
        return compact(
            'data',
            'profileImage',
            'signatureImage',
            'officeStamp',
            'doctorSign',
            'leftChartImage',
            'rightChartImage',
            'specialTests'
        );
    }
    public function iloView($id)
    {
        $data = $this->iloDownload($id);
    
        $pdf = PDF::loadView('reports.ilo_report', $data);
    
        return $pdf->stream('reports.ilo_report');
    }
    public function aivView($id)
    {
        $data = $this->aivDownload($id);
    
        $pdf = PDF::loadView('reports.aiv_report', $data);
    
        return $pdf->stream('reports.aiv_report');
    }
    public function avView($id)
    {
        $data = $this->avDownload($id);
    
        $pdf = PDF::loadView('reports.av_report', $data);
    
        return $pdf->stream('reports.av_report');
    }
    public function dnaView($id)
    {
        $data = $this->dnaDownload($id);
    
        $pdf = PDF::loadView('reports.dna_report', $data);
    
        return $pdf->stream('reports.dna_report');
    }
    public function singaporeView($id)
    {
        $data = $this->singaporeDownload($id);
    
        $pdf = PDF::loadView('reports.singapore_report', $data);
    
        return $pdf->stream('reports.singapore_report');
    }
    public function liberianView($id)
    {
        $data = $this->liberianDownload($id);
    
        $pdf = PDF::loadView('reports.liberian_report', $data);
    
        return $pdf->stream('reports.liberian_report');
    }
    public function belizeView($id)
    {
        $data = $this->belizeDownload($id);
    
        $pdf = PDF::loadView('reports.belize_report', $data);
    
        return $pdf->stream('reports.belize_report');
    }
    public function vanatauView($id)
    {
        $data = $this->vanatauDownload($id);
    
        $pdf = PDF::loadView('reports.vanatau_report', $data);
    
        return $pdf->stream('reports.vanatau_report');
    }
    public function marshallView($id)
    {
        $data = $this->marshallDownload($id);
    
        $pdf = PDF::loadView('reports.marshall_report', $data);
    
        return $pdf->stream('reports.marshall_report');
    }
    public function bahamasView($id)
    {
        $data = $this->bahamasDownload($id);
    
        $pdf = PDF::loadView('reports.bahamas_report', $data);
    
        return $pdf->stream('reports.bahamas_report');
    }
    public function ogukView($id)
    {
        $data = $this->ogukDownload($id);
    
        $pdf = PDF::loadView('reports.oguk_report', $data);
    
        return $pdf->stream('reports.oguk_report');
    }
    public function maltaView($id)
    {
        $data = $this->maltaDownload($id); 
    
        $pdf = PDF::loadView('reports.malta_report', $data);
    
        return $pdf->stream('reports.malta_report');
    }
    public function dentalView($id)
    {
        $data = $this->dentalDownload($id); 
    
        $pdf = PDF::loadView('reports.dental_report', $data);
    
        return $pdf->stream('reports.dental_report');
    }
    public function audiometryView($id)
    {
        $data = $this->audiometryDownload($id); 
    
        $pdf = PDF::loadView('reports.audiometry_report', $data);
    
        return $pdf->stream('reports.audiometry_report');
    }
    public function mergeReportsRaw($reportKeys, $registerId)
    {
        $merger = new \setasign\Fpdi\Fpdi();
    
        foreach ($reportKeys as $reportKey) {
    
            $methodName = $reportKey . 'Download';
            $resultData = $this->$methodName($registerId);
    
            $pdfContent = \Barryvdh\DomPDF\Facade\Pdf::loadView(
                "reports.{$reportKey}_report",
                $resultData
            )
                ->setPaper('a4', 'portrait')
                ->setOption('margin-top', 2)
                ->setOption('margin-bottom', 2)
                ->setOption('margin-left', 2)
                ->setOption('margin-right', 2)
                ->setOption('enable-remote', true)
                ->setOption('enable-local-file-access', true)
                ->output();
    
            $pageCount = $merger->setSourceFile(
                \setasign\Fpdi\PdfParser\StreamReader::createByString($pdfContent)
            );
    
            for ($i = 1; $i <= $pageCount; $i++) {
                $page = $merger->importPage($i);
                $size = $merger->getTemplateSize($page);
    
                $orientation = $size['orientation'] ?? 'P';
    
                $merger->AddPage(
                    $orientation,
                    [$size['width'], $size['height']]
                );
    
                $merger->SetFillColor(255, 255, 255);
                $merger->Rect(0, 0, $size['width'], $size['height'], 'F');
                $merger->useTemplate($page, 0, 0.1, $size['width'], $size['height'], true);
            }
        }
    
        return $merger->Output('S'); // OUTPUT RAW PDF STRING
    }


}