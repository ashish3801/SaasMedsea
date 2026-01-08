<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Examination Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }
 @page {
      margin: 0;
      padding: 0;
      size: A4 portrait;
    }

    body {
      font-family: "Times New Roman", serif;
      font-size: 12px;
    
    }


        .details table {
            
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

  
        .history-table {
            width: 100%;
            border-collapse: collapse;
            }

        .history-table th,
        .history-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 0pt 1pt;
            font-size: 9px;
        }

        .history-table th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }



        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            page-break-inside: avoid;
        }


       

        th {
            text-align: center;
        }


        .med-table th,
        .med-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 0pt 1pt;
            font-size: 9px;
        }
        
        .res-table th,
        .res-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 0pt 1pt;
            
        }
     

        .blood-table th,
        .blood-table td {
            border: 1px solid #000;
            text-align: left;
            padding: 0pt 1pt;
            font-size: 9px;
        }

        .small-row {
            /* font-size: 11px; */
            font-size: 11px;

        }

    </style>
</head>

<body>
    <div style="width: 98%;">

   <div style="margin-left: 6pt; padding-top: 5px;">
    <table>
        <tr style="border: 1pt solid #000">
            <td>
                <p style="text-align: center; margin:2px 0px;"> 
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->clinic->logo))) }}"  alt="Clinic Logo"  style="height: 70px"  >
                </p>
            </td>
            <td>
                <div style="text-align: center;">
                <h1 style="color: #34427d;">{{ $data->clinic->name }}</h1>
                <p style="">{{ $data->clinic->add }}</p> 
                 <p style="">{{ $data->clinic->email }} | {{ $data->clinic->phone }} </p> 
                </div>
            </td>
        </tr>
    </table> 
   </div>
        <div style="margin-left: 6pt; text-align: center; border-left:1pt solid #000;border-right:1pt solid #000">
            <h4>REPORT OF MEDICAL EXAMINATION OF SEAFARERS BY APPROVED MEDICAL EXAMINER OF DG SHIPPING</h4>
            <p style="font-size:11px;">(As Per Standards of MLC 2006 and IMS/STCW code 2010 and ILO CONVENTION 147 & D.G. Shipping. Govt. of
                India M.S. Medical rules 2000 with Amendments)</p>
        </div>

        <div class="details" style="margin-left: 6pt;">
            
            <table>
                <tr>
                    <td><strong>Name:</strong></td>
                    <td>{{ $data->seafarer->f_name }} {{ $data->seafarer->m_name }} {{ $data->seafarer->l_name }}</td>
                    <td><strong>Sex:</strong></td>
                    <td>
                        @if ($data->seafarer->sex == 1)
                            Male
                        @else
                            Female
                        @endif
                    </td>
                    <td><strong>Serial No:</strong></td>
                    <td>{{ $data->id }}</td>
                </tr>
                <tr>
                    <td><strong>Date of Birth:</strong></td>
                    <td>{{ \Carbon\Carbon::parse($data->seafarer->dob)->format('d-M-Y') }}</td>
                    <td><strong>PP / CDC / INDOS No.:</strong></td>
                    <td>{{ $data->indos_no }}</td>
                    <td><strong>Rank:</strong></td>
                    <td>{{ $data->rank->name }}</td>
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
        <p style="margin-left: 6pt; text-align: center; border-left:1pt solid #000;border-right:1pt solid #000">
            MEDICAL HISTORY: Please answer to the following to the best of your knowledge
        </p>
        <div class="medical-history" style="margin-left: 6pt;">
            <table class="history-table">
                <thead>
                    <tr>
                        <th style="width: 200px;">Is there any past / present history of any of the following</th>
                        <th style="width: 50px;">Candidate Declaration<br>Yes/No</th>
                        <th style="width: 50px;">Doctor Records<br>Yes/No</th>
                        <th style="width: 200px;">Is there any past / present history of any of the following</th>
                        <th style="width: 50px;">Candidate Declaration<br>Yes/No</th>
                        <th style="width: 50px;">Doctor Records<br>Yes/No</th>
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
                            <td style="width: 200px;">{{ $leftName }}</td>
                            <td style="width: 50px;">{{ $finalResults[$leftName]['candidate'] ?? '-' }}</td>
                            <td style="width: 50px;">{{ $finalResults[$leftName]['doctor'] ?? '-' }}</td>
                            <td style="width: 200px;">{{ $rightName }}</td>
                            <td style="width: 50px;">{{ $finalResults[$rightName]['candidate'] ?? '-' }}</td>
                            <td style="width: 50px;">{{ $finalResults[$rightName]['doctor'] ?? '-' }}</td>
                        </tr>
                    @endforeach
            
                    <tr>
                        <td colspan="6"><strong>Notes:</strong></td>
                        </tr>
                        <tr>
                        <td colspan="6">
                            I hereby certify that the personal declaration & medical history given above is true &
                                accurate to
                                the best of my knowledge & I am aware that this will form the basis of further medical
                                examination & final
                                conclusion on my health status. In the event of any misrepresentation either by
                                statements or by omission,
                                this can lead to termination of service or loss of sickness benefits. I also give
                                consent for conducting an HIV test.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"><strong>MEDICAL EXAMINATION</strong></td>
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
                        'vertical' => 67
                    ],
                    'left' => [
                        // Assuming similar IDs exist for left eye (replace with actual IDs)
                        'distant_unaided' => 49,
                        'near_unaided' => 53,
                        'distant_aided' => 57,
                        'near_aided' => 60,
                        'horizontal' => 64,
                        'vertical' => 68
                    ],
                    'color' => [
                        'ishihara' => 71, // Replace with actual ID
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
            
                @php
            $rhv = getTestResult($eyeTestIds['right']['horizontal'], $tests, $finalResults);
            $rvv = getTestResult($eyeTestIds['right']['vertical'], $tests, $finalResults);
            $isnormalrfv = $rhv === 'Normal' && $rvv === 'Normal';
            $lhv = getTestResult($eyeTestIds['left']['horizontal'], $tests, $finalResults);
            $lvv = getTestResult($eyeTestIds['left']['vertical'], $tests, $finalResults);
            $isnormallfv = $lhv === 'Normal' && $lvv === 'Normal';
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
                        {{ $isnormalrfv ? 'Normal' : 'Abnormal'   }}
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
                        {{ $isnormallfv ? 'Normal' : 'Abnormal'   }}
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
                    <td>{{ getTestResult($eyeTestIds['color']['ishihara'], $tests, $finalResults)  }}</td>
                    <td colspan="2"></td>
                    <td colspan="3">Hearing</td>
                    <td colspan="3">Right ear: {{ getTestResult($earTestIds['right']['hearing'], $tests, $finalResults) }}</td>
                    <td colspan="3">Left ear: {{ getTestResult($earTestIds['left']['hearing'], $tests, $finalResults) }}</td>
                </tr>
                <tr class="small-row">
                    <td></td>
                    <td>Lantern/Other</td>
                    <td>{{ getTestResult($eyeTestIds['color']['other'], $tests, $finalResults)  }}</td>
                    <td colspan="2"></td>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                </tr>
            </table>

            <!-- Systemic Examination -->
            <table class="med-table">
                <tr>
                    <th style="width: 100px">SYSTEMIC EXAMINATION</th>
                    <th style="width: 70px">Normal/Abnormal</th>
                    <th style="width: 400px"></th>
                    <th style="width: 100px">SYSTEMIC EXAMINATION</th>
                    <th style="width: 70px">Normal/Abnormal</th>
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
                        <td style="width: 100px">{{ $systemTests[$leftId]['name'] ?? '-' }}</td>
                        <td style="width: 70px">{{ $systemTests[$leftId]['value'] ?? '-' }}</td>
                
                        @if ($index == 0)
                            <td rowspan="8" style="width: 400px; text-align: center; vertical-align: middle;">
                                Is the seafarer free from any medical condition likely to be aggravated by service at sea or to
                                render the seafarer unfit for such service or to endanger the health of other persons onboard?
                
                                <div style="display: flex; justify-content: center; margin-top: 10px;">
                                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/fit_logo.jpg'))) }}" style="max-width: 35px; height: auto;">
                                </div>
                            </td>
                        @endif
                
                        <td style="width: 100px">{{ $systemTests[$rightId]['name'] ?? '-' }}</td>
                        <td style="width: 70px">{{ $systemTests[$rightId]['value'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </table>

            <!-- Investigations Section -->

@if ($data->medicalApproval?->attach_stamp_sign == 1)
    @php $stm = 1; @endphp
@elseif ($data->medicalApproval?->attach_stamp_sign == 0)
    @php $stm = null; @endphp
@else
    @php $stm = null; @endphp
@endif
            
 <table class="history-table">
                        <thead>
                            <tr></tr><th colspan="8" style="text-align:left">INVESTIGATIONS</th></tr>
                            <tr>

                                <th style="width: 90px">Blood</th>
                                <th style="width: 50px">Result</th>
                                <th style="width: 90px">Normal</th>
                                <th style="width: 90px">URINE</th>
                                <th style="width: 50px">Result</th>
                                <th style="width: 90px">Additional Tests</th>
                                <th style="width: 50px">Result</th>
                                <th style="width: 190px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($investigations as $index => $row)
                                <tr>
                                    <td style="width: 90px">{{ $row['blood']['name'] ?? '-' }}</td>
                                    <td style="width: 50px">
                                        {{ isset($investigationResults[$row['blood']['id']]) 
                                            ? $investigationResults[$row['blood']['id']] 
                                            : '-' }}
                                    </td>
                                    <td style="width: 90px">{{ $row['blood']['normal'] ?? '-' }}</td>
            
                                    <td style="width: 90px">{{ $row['urine']['name'] ?? '-' }}</td>
                                    <td style="width: 50px">
                                        {{ isset($row['urine']['id']) && isset($investigationResults[$row['urine']['id']]) 
                                            ? $investigationResults[$row['urine']['id']] 
                                            : '-' }}
                                    </td>
            
                                    <td style="width: 90px">{{ $row['additional']['name'] ?? '-' }}</td>
                                    <td style="width: 50px">
                                        {{ isset($row['additional']['id']) && isset($investigationResults[$row['additional']['id']]) 
                                            ? $investigationResults[$row['additional']['id']] 
                                            : '-' }}
                                    </td>
            
                                    @if($index == 0)
                                        <td rowspan="{{ count($investigations) }}" style="width: 190px;text-align: center; padding: 1px;">
                                            <div class="profile-container" style="position: relative; display: inline-block; width: 100px; height:100px">
                                                @if(isset($profileImage))
                                                    <img src="{{ $profileImage }}" alt="User Image" style="max-width: 100%; height: auto; border: 1px solid #ccc;">
                                                @else
                                                    <div style="width: 80px; border: 1px solid #ccc; background: #f0f0f0;"></div>
                                                @endif
                                                
                                                @if(isset($stm))
                                                    <img src="{{ $officeStamp }}" alt="Stamp" style="position: absolute; width: 80px; height:80px; bottom: -30px; left: -25px;">
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
            




            <!-- Result of Medical Examination -->
            <table class="res-table">
                <tr>
                    <th colspan="6">RESULT OF MEDICAL EXAMINATION</th>
                </tr>
                <tr class="small-row">
                    <td colspan="6">
                        On the basis of history, clinical examination & diagnostic tests, I, <strong>{{ $data->employee->emp_name }}</strong>, hereby
                        declare the examinee has been found medically 
                        <strong>
                            @if($data->medicalApproval?->is_fit == 1)
                                FIT
                            @elseif($data->medicalApproval?->is_fit == 0)
                                UNFIT
                            @elseif($data->medicalApproval?->is_fit == 2)
                                FIT WITH LIMITATION
                            @else
                                not evaluated
                            @endif
                        </strong>
                    </td>
                </tr>
            </table>

            <!-- Recommendations Section -->
            <table class="res-table">
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
            <table class="sign-table" style="border: 1px solid #000">
                <tr class="small-row">
                    <td colspan="4">
                        I, <strong>{{ $data->employee->emp_name }}</strong>, certify that all information required under annexure E & F of m.s
                        (Medical Examination) Rules 2000 are incorporated in this certificate.
                    </td>
                </tr>
               
                <tr style="text-align: center;">
                    <!-- First Column: Date of Issue and Candidate Signature -->
                    <td style="width:150px;">
                        <p style="text-align: left;">
                            Date of Issue: {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? 'N/A' }}
                        </p>
                        <p style="text-align: left;">
                            Date of Expiry: {{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? 'N/A' }}
                        </p>
                    </td>
                      
                    <td style="width:150px;">
                        @if(isset($stm))
                            <img src="{{ $signatureImage }}" style="width: 120px; height: 50px;">
                        @else   <div style="width: 120px; height: 50px;"></div>
                        @endif
                    </td>

                    <!-- Second Column: Official Signature -->
                    <td style="width:150px;">
                        @if(isset($stm))
                            <img src="{{ $officeStamp }}" style="width: 80px; height:80px;">
                            @else   <div style="width: 80px; height: 80px;"></div>
                        @endif
                 
                    </td>

                    <!-- Third Column: Approved Doctor -->
                    <td style="width:150px;">
                        @if(isset($stm))
                            <img src="{{ $doctorSign }}" style="height: 35px;">
                            @else   <div style="width: 100px; height: auto;"></div>
                        @endif
                   
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td></td>
                    <td><p style="font-size: 12px; font-weight: bold; margin-top: 5px;">Candidate Signature</p></td>
                    <td><p style="font-size: 12px; font-weight: bold; margin-top: 5px;">Official Stamp</p></td>
                    <td><p style="font-size: 12px; font-weight: bold; margin-top: 5px;">Approved Doctor Signature</p></td>
                </tr>

            </table>

        </div>
    </div>
    
</body>

</html>
