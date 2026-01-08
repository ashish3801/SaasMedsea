<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Examination Report</title>
    <style>
        /* General Reset */
        @page {
            margin: -4%;
            padding: -4%;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            max-width: 100%;
            padding: 0;
            border: none;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            /* padding-bottom: 10px; */
            padding-bottom: 5px;
            /* margin-bottom: 20px; */
            /* margin-bottom: 5px; */
        }

        .logo img {
            max-width: 70px;
            margin-right: 20px;
        }

        .title h1 {
            /* font-size: 20px; */
            font-size: 10px;
            margin: 0;
            color: #0074B7;
            text-align: center;
        }

        .title p {
            /* font-size: 14px; */
            font-size: 7px;
            margin: 3px 0;
            text-align: center;
        }

        td p {
            font-size: 5px;
        }

        .report-title {
            text-align: center;
            margin-bottom: 5px;

        }

        .report-title h2 {
            /* font-size: 18px; */
            font-size: 10px;
            text-transform: uppercase;
            margin: 0;
        }

        .report-title p {
            /* font-size: 14px; */
            font-size: 5px;
            margin: 2px 0;
        }

        .details table {
            width: 100%;
            border-collapse: collapse;
        }

        .details td {
            border: 1px solid #000;
            padding: 1px 1px;
            /* font-size: 13px; */
            font-size: 10px;
        }

        .details td strong {
            font-weight: bold;
        }

        .medical-history h3 {
            font-size: 10px;
            /* margin: 0; */
            font-weight: bold;
            /* border-top: 2px solid #000;
            padding-top: 10px; */
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        .history-table th,
        .history-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 1px;
            /* font-size: 13px; */
            font-size: 8px;
        }

        .history-table th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            page-break-inside: avoid;
        }


        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
        }

        th {
            text-align: center;
        }

        .notes-section {
            margin: 5px 0;
            font-weight: bold;
            /* font-size: 14px; */
            font-size: 5px;
        }

        .med-table th,
        .med-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 1px;
            /* font-size: 13px; */
            font-size: 8px;
        }

        .blood-table th,
        .blood-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 0px;
            /* font-size: 13px; */
            font-size: 8px;
        }

        .small-row {
            /* font-size: 11px; */
            font-size: 5px;

        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header" style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ccc;">
            <div class="logo" style="flex: 0 0 100px;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->clinic->logo))) }}"
                     alt="Clinic Logo"
                     style="width: 80px; height: auto;">
            </div>
            <div class="title" style="flex: 1; text-align: center; padding-left: 20px;">
                <h1 style="margin: 0; font-size: 18px;">{{ $data->clinic->name }}</h1>
                <p style="margin: 2px 0; font-size: 12px;">{{ $data->clinic->add }}</p>
            </div>
        </header>

        <div class="report-title">
            <h2>REPORT OF MEDICAL EXAMINATION OF SEAFARERS</h2>
            <p>BY APPROVED MEDICAL EXAMINER OF DG SHIPPING</p>
            <p>(As Per Standards of MLC 2006 and IMS/STCW code 2010 and ILO CONVENTION 147 & D.G. Shipping. Govt. of
                India M.S. Medical rules 2000 with Amendments)</p>
        </div>

        <div class="details">
            
            <table>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $data->seafarer->f_name }}</td>
                    <td><strong>Sex:</strong></td>
                    <td>
                        @if ($data->seafarer->sex == 1)
                            Male
                        @else
                            Female
                        @endif
                    </td>
                    <td><strong>Serial No:</strong></td>
                    <td>{{ $data->seafarer_id }}</td>
                </tr>
                <tr>
                    <td><strong>Date of Birth:</strong></td>
                    <td>{{ $data->seafarer->dob }}</td>
                    <td><strong>PP / CDC / INDOS No.:</strong></td>
                    <td>{{ $data->indos_no }}</td>
                    <td><strong>Rank:</strong></td>
                    <td>{{ $data->rank_id }}</td>
                </tr>
                <tr>
                    <td><strong>Vessel:</strong></td>
                    <td>{{ $data->vessel_name }}</td>
                    <td><strong>Type:</strong></td>
                    <td>{{ $data->vessel_type }}</td>
                    <td><strong>Route:</strong></td>
                    <td>{{ $data->route }}</td>
                </tr>
                <tr>
                    <td><strong>Address:</strong></td>
                    <td colspan="3">{{ $data->address }}</td>
                    <td><strong>Mobile:</strong></td>
                    <td>{{ $data->seafarer->phone_no }}</td>
                </tr>
                <tr>
                    <td><strong>Company Name:</strong></td>
                    <td colspan="5">{{ $data->company_name }}</td>
                </tr>
            </table>
        </div>
        <div class="notes-section">
            MEDICAL HISTORY: Please answer to the following to the best of your knowledge
        </div>
        <div class="medical-history">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Is there any past / present history of any of the following</th>
                        <th>Candidate Declaration<br>Yes/No</th>
                        <th>Doctor Records<br>Yes/No</th>
                        <th>Is there any past / present history of any of the following</th>
                        <th>Candidate Declaration<br>Yes/No</th>
                        <th>Doctor Records<br>Yes/No</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $testPairs = [
                                        [1, 13],
                                        [2, 14],
                                        [3, 15],
                                        [4, 16],
                                        [5, 17],
                                        [6, 18],
                                        [7, 19],
                                        [8, 20],
                                        [9, 21],
                                        [10, 22],
                                        [11, 23],
                                        [12, 24],
                                    ];
                    @endphp

                    @foreach ($testPairs as [$leftId, $rightId])
                        @php
                            $leftName = $tests[$leftId] ?? 'Unknown';
                            $rightName = $tests[$rightId] ?? 'Unknown';
                        @endphp
                        <tr>
                            <td>{{ $leftName }}</td>
                            <td>{{ $finalResults[$leftName]['candidate'] ?? '-' }}</td>
                            <td>{{ $finalResults[$leftName]['doctor'] ?? '-' }}</td>
                            <td>{{ $rightName }}</td>
                            <td>{{ $finalResults[$rightName]['candidate'] ?? '-' }}</td>
                            <td>{{ $finalResults[$rightName]['doctor'] ?? '-' }}</td>
                        </tr>
                    @endforeach
            
                    <tr>
                        <td colspan="6">
                            <strong>Notes:</strong>
                            <p>
                                I hereby certify that the personal declaration & medical history given above is true &
                                accurate to
                                the best of my knowledge & I am aware that this will form the basis of further medical
                                examination & final
                                conclusion on my health status. In the event of any misrepresentation either by
                                statements or by omission,
                                this can lead to termination of service or loss of sickness benefits. I also give
                                consent for conducting an HIV test.
                            </p>
                        </td>
                    </tr>
                </tbody>

            </table>
            <!-- Medical Examination -->
            @php
                $physicalTestIds = [
                    25 => 'Height',
                    26 => 'Weight (in kg)',
                   'BMI' =>'BMI',
                    27 => 'Chest Insp-Exp (cm)',
                    28 => 'Blood Pressure (in mm of hg)',
                    29 => 'Pulse-Beats/Minute',
                    30 => 'Resp-Rate/Minute',
                    31 => 'General Condition',
                ];
            @endphp

            <table class="med-table">
                <tr>
                    @foreach ($physicalTestIds as $id => $name)
                        <th>{{ $name }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($physicalTestIds as $id => $name)
                        <td>{{ $physicalResults[$id] ?? '-' }}</td> 
                    @endforeach
                </tr>
            </table>

            <!-- Vision and Hearing -->
            @php
                // Define test IDs for special tests
                $eyeTestIds = [
                    'right' => [
                        'distant_unaided' => 48,
                        'near_unaided' => 52,
                        'distant_aided' => 56,
                        'near_aided' => 59,
                        'horizontal' => 63,
                        'vertical' => 71
                    ],
                    'left' => [
                        // Assuming similar IDs exist for left eye (replace with actual IDs)
                        'distant_unaided' => 49,
                        'near_unaided' => 53,
                        'distant_aided' => 57,
                        'near_aided' => 60,
                        'horizontal' => 64,
                        'vertical' => 72
                    ],
                    'color' => [
                        'ishihara' => 70, // Replace with actual ID
                        'result' => 71,  // Replace with actual ID
                        'other' => 72     // Replace with actual ID
                    ]
                ];

                $earTestIds = [
                    'right' => [
                        '500' => 74,
                        '1000' => 75,
                        '2000' => 76,
                        '3000' => 77,
                        '4000' => 78,
                        '5000' => 79,
                        '6000' => 80,
                        '8000' => 81,
                        'hearing' => 89
                    ],
                    'left' => [
                        // Assuming similar IDs exist for left ear (replace with actual IDs)
                        '500' => 82,
                        '1000' => 83,
                        '2000' => 84,
                        '3000' => 85,
                        '4000' => 86,
                        '5000' => 91,
                        '6000' => 87,
                        '8000' => 88,
                        'hearing' => 90
                    ]
                ];

                // Helper function to get test result by ID
                function getTestResult($id, $tests, $finalResults) {
                    $testName = $tests[$id] ?? '';
                    return $finalResults[$testName]['candidate'] ?? $finalResults[$testName]['doctor'] ?? '-';
                }
            @endphp

            <table class="med-table">
                <tr>
                    <th>Distant Vision</th>
                    <th>Uncorrected</th>
                    <th>Corrected</th>
                    <th>Field of Vision</th>
                    <th>Auditory</th>
                    <th>Hz</th>
                    <th>500</th>
                    <th>1000</th>
                    <th>2000</th>
                    <th>3000</th>
                    <th>4000</th>
                    <th>5000</th>
                    <th>6000</th>
                    <th>8000</th>
                </tr>
                <tr>
                    <td>Right Eye</td>
                    <td>{{ getTestResult($eyeTestIds['right']['distant_unaided'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($eyeTestIds['right']['distant_aided'], $tests, $finalResults) }}</td>
                    <td>
                        H: {{ getTestResult($eyeTestIds['right']['horizontal'], $tests, $finalResults) }}<br>
                        V: {{ getTestResult($eyeTestIds['right']['vertical'], $tests, $finalResults) }}
                    </td>
                    
                    <td>Right Ear</td>
                    <td>db</td>
                    <td>{{ getTestResult($earTestIds['right']['500'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['1000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['2000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['3000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['4000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['5000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['6000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['right']['8000'], $tests, $finalResults) }}</td>
                </tr>
                <tr>
                    <td>Left Eye</td>
                    <td>{{ getTestResult($eyeTestIds['left']['distant_unaided'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($eyeTestIds['left']['distant_aided'], $tests, $finalResults) }}</td>
                    <td>
                        H: {{ getTestResult($eyeTestIds['left']['horizontal'], $tests, $finalResults) }}<br>
                        V: {{ getTestResult($eyeTestIds['left']['vertical'], $tests, $finalResults) }}
                    </td>
                    
                    <td>Left Ear</td>
                    <td>db</td>
                    <td>{{ getTestResult($earTestIds['left']['500'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['1000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['2000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['3000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['4000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['5000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['6000'], $tests, $finalResults) }}</td>
                    <td>{{ getTestResult($earTestIds['left']['8000'], $tests, $finalResults) }}</td>
                </tr>
                <tr>
                    <td>Colour Vision</td>
                    <td>Ishihara</td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="3">Hearing</td>
                    <td colspan="3">Right ear: {{ getTestResult($earTestIds['right']['hearing'], $tests, $finalResults) }}</td>
                    <td colspan="3">Left ear: {{ getTestResult($earTestIds['left']['hearing'], $tests, $finalResults) }}</td>
                </tr>
                <tr class="small-row">
                    <td></td>
                    <td>Lantern/Other</td>
                    <td></td>
                    <td colspan="2"></td>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                </tr>
            </table>

            <!-- Systemic Examination -->
            <table class="med-table">
                <tr>
                    <th>SYSTEMIC EXAMINATION</th>
                    <th>Normal/Abnormal</th>
                    <th></th>
                    <th></th>
                    <th>Normal/Abnormal</th>
                </tr>
            
                @php
                    $systemTestPairs = [
                        [32, 35], // Head and Neck, Respiratory System
                        [38, 41], // Eyes, Cardiovascular System
                        [44, 33], // Ears / Nose / Throat, Per Abdomen
                        [36, 39], // Teeth / Oral Cavity, Genitourinary System
                        [42, 45], // Musculo-Skeletal System, Others
                        [34, 37], // Nervous System, Hernia / Hydrocele
                        [47, 40], // Reflexes, Varicose Veins
                        [43, 46], // Skin, Fissure / Fistula / Piles
                    ];
                @endphp
            
                @foreach ($systemTestPairs as $index => [$leftId, $rightId])
                    <tr>
                        <td>{{ $systemTests[$leftId]['name'] ?? '-' }}</td>
                        <td>{{ $systemTests[$leftId]['value'] ?? '-' }}</td>
                
                        @if ($index == 0)
                            <td rowspan="8" style="text-align: center; vertical-align: middle;">
                                Is the seafarer free from any medical condition likely to be aggravated by service at sea or to
                                render the seafarer unfit for such service or to endanger the health of other persons onboard?
                
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/fit_logo.jpg'))) }}" style="max-width: 35px; height: auto;">
                                </div>
                            </td>
                        @endif
                
                        <td>{{ $systemTests[$rightId]['name'] ?? '-' }}</td>
                        <td>{{ $systemTests[$rightId]['value'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </table>

            <!-- Investigations Section -->


            <div class="notes-section">
                INVESTIGATIONS
            </div>


            <div>
                <div>
                    <table border="1" class="history-table">
                        <thead>
                            <tr>
                                <th>Blood</th>
                                <th>Result</th>
                                <th>Normal</th>
                                <th>URINE</th>
                                <th>Result</th>
                                <th>Additional Tests</th>
                                <th>Result</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($investigations as $index => $row)
                                <tr>
                                    <td>{{ $row['blood']['name'] ?? '-' }}</td>
                                    <td>
                                        {{ isset($investigationResults[$row['blood']['id']]) 
                                            ? $investigationResults[$row['blood']['id']] 
                                            : '-' }}
                                    </td>
                                    <td>{{ $row['blood']['normal'] ?? '-' }}</td>
            
                                    <td>{{ $row['urine']['name'] ?? '-' }}</td>
                                    <td>
                                        {{ isset($row['urine']['id']) && isset($investigationResults[$row['urine']['id']]) 
                                            ? $investigationResults[$row['urine']['id']] 
                                            : '-' }}
                                    </td>
            
                                    <td>{{ $row['additional']['name'] ?? '-' }}</td>
                                    <td>
                                        {{ isset($row['additional']['id']) && isset($investigationResults[$row['additional']['id']]) 
                                            ? $investigationResults[$row['additional']['id']] 
                                            : '-' }}
                                    </td>
            
                                    @if($index == 0)
                                        <td rowspan="{{ count($investigations) }}" style="text-align: center; padding: 1px;">
                                            <div class="profile-container" style="position: relative; display: inline-block; width: 50px; height: 50px;">
                                                @if(isset($profileImage))
                                                    <img src="{{ $profileImage }}" alt="User Image" style="max-width: 100%; height: auto; border: 1px solid #ccc;">
                                                @else
                                                    <div style="width: 50px; height: 50px; border: 1px solid #ccc; background: #f0f0f0;"></div>
                                                @endif
                                                
                                                @if(isset($signatureImage))
                                                    <img src="{{ $signatureImage }}" alt="Stamp" style="position: absolute; width: 35px; height: 35px; bottom: -15px; left: -11px;">
                                                @endif
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8">
                                    Neu%: {{ $investigationResults[120] ?? '-' }} -
                                    Lymp%: {{ $investigationResults[121] ?? '-' }} -
                                    Eos%: {{ $investigationResults[122] ?? '-' }} -
                                    Mo%: {{ $investigationResults[123] ?? '-' }} -
                                    Ba%: {{ $investigationResults[124] ?? '-' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            




            <!-- Result of Medical Examination -->
            <table class="med-table">
                <tr>
                    <th colspan="6">RESULT OF MEDICAL EXAMINATION</th>
                </tr>
                <tr class="small-row">
                    <td colspan="6">
                        On the basis of history, clinical examination & diagnostic tests, I, Dr. Ajaz Ahmad Khan, hereby
                        declare the examinee has been found medically 
                        <strong>
                            @if($data->medicalApproval?->is_fit === 1)
                                FIT
                            @elseif($data->medicalApproval?->is_fit === 0)
                                UNFIT
                            @else
                                not evaluated
                            @endif
                        </strong>
                    </td>
                </tr>
            </table>

            <!-- Recommendations Section -->
            <table class="med-table">
                <tr>
                    <th colspan="6">Recommendations/Remarks/Restrictions</th>
                </tr>
                <tr class="small-row">
                    <td colspan="6">
                        <strong>LIMITATION:</strong>
                        {{ $data->medicalApproval?->limitation ?? 'None' }}
                    </td>
                </tr>
            </table>

            <!-- Certification Section -->
            <table class="med-table">
                <tr class="small-row">
                    <td colspan="2">
                        I, Dr. Ajaz Ahmad Khan, certify that all information required under annexure E & F of m.s
                        (Medical Examination) Rules 2000 are incorporated in this certificate.
                    </td>
                </tr>
               
                <tr>
                    <!-- First Column: Date of Issue and Candidate Signature -->
                    <td style="text-align: center; vertical-align: middle;">
                        <p style="text-align: left; margin-top: 15px;">
                            Date of Issue: {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? 'N/A' }}
                        </p>
                        <p style="text-align: left;">
                            Date of Expiry: {{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? 'N/A' }}
                        </p>
                        @if(isset($signatureImage))
                            <img src="{{ $signatureImage }}" style="max-width: 30%; height: auto; display: block; margin: 0 auto;">
                        @endif
                        <p>Candidate Signature</p>
                    </td>
                    

                    <!-- Second Column: Official Signature -->
                    <td style="text-align: center; vertical-align: middle; margin-top: 15px;">
                        @if(isset($officeStamp))
                            <img src="{{ $officeStamp }}" style="max-width: 20%; height: auto; display: block; margin: 0 auto;">
                        @endif
                        <p>Official Stamp</p>
                    </td>

                    <!-- Third Column: Approved Doctor -->
                    <td style="text-align: center; vertical-align: middle;">
                        @if(isset($doctorSign))
                            <img src="{{ $doctorSign }}" style="max-width: 30%; height: auto; display: block; margin: 0 auto;">
                        @endif
                            
                        <p>Approved Doctor Signature</p>
                    </td>
                </tr>

            </table>

        </div>
    </div>
    </div>
</body>

</html>
