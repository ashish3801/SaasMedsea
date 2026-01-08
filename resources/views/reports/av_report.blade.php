<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sight Test Certificate</title>
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
      font-size: 15px;
    
    }

        .container {
           width: 96%;
            margin: 15px 0px 0px 11px;
            
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
            padding: 0;
            page-break-inside: avoid;
        }

        .title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
           
        }

        .information-table {
            width: 100%;
            border-collapse: collapse;
            
        }

        .information-table td {
            padding: 5px;
            vertical-align: top;
            font-size: 15px;
            
        }
        
        .bb {
            border-bottom: 1px solid #000;
        }
        .bt {
            border-top: 1px solid #000;
        }

        

        .info-table,
        .test-table {
            font-size: 15px;
            padding: 0px 15px;
        }

        .info-table td {
            padding: 3px;
            vertical-align: top;
            font-size: 15px;
        }

        .test-table,
        .test-table th,
        .test-table td {
            border: 1px solid black;
        }

        .test-table th,
        .test-table td {
            padding: 5px;
            text-align: center;
            
        }

        .certify {
            padding-top: 10px;
            padding-left: 5px;
            font-size: 15px;
           
        }

        .note {
            padding-left: 5px;
            padding-top: 10px;
            font-size: 15px;
            }
        
         .border-rbl{
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
        }
        
        .border-rl{
            border-right: 1px solid #000;
            border-left: 1px solid #000;
        }
        
    </style>
</head>

<body>

    <div class="container">
         <div style="padding-top: 5px;">
    <table style="text-align: center;">
        <tr style="border: 1pt solid #000">
            <td>
                <p style="text-align: center; margin:2px 2px;"> 
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
        @php
            // dd($data->rank->name);
            $rank = $data->rank->first();
            $clinic = $data->clinic->first();
            $emp = $clinic->employee->first();

        @endphp
        
       @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif
          
        
<div class="border-rl" style=padding-bottom:7px;">
         <p style="text-align: right;padding:5px;">Annexure V</p>
        <div class="title">SIGHT TEST CERTIFICATE</div>

        <table class="information-table">
            <tr>
                <td colspan="2" >NEW ENTRY / Periodic</td>
                <td rowspan="8" style="width: 250px;text-align: center; vertical-align: middle; padding: 1px;">
                   
                <div style="position: relative; display: inline-block; width: 100px; height: 100px;">
                @if(!empty($profileImage))
                    <img src="{{ $profileImage }}" alt="User Image" style="max-width: 100%; height: auto; border: 1px solid #ccc;">
                @else
                    <div style="width: 80px; height: 100px; border: 1px solid #ccc; background: #f0f0f0;"></div>
                @endif
                
                @if(isset($stm))
                    <img src="{{ $officeStamp }}" alt="Stamp" style="position: absolute; width: 80px; height:80px; bottom: -30px; left: -25px;">
                @endif
            </div>
          
                </td>
            </tr>
            <tr>
                <td>Reference No.</td>
                <td class="bb"><strong>{{ $data->id }}</strong></td>
            </tr>
            <tr>
                <td>Full Name:</td>
                <td class="bb"><strong>{{ $data->Seafarer->f_name }} {{ $data->Seafarer->m_name }}
                    {{ $data->Seafarer->l_name }}</strong></td>
            </tr>
            <tr>
                <td>Rank:</td>
                <td class="bb"><strong>{{ $data->rank->name }}</strong></td>
            </tr>
            <tr>
                <td>PP / CDC / ID No:</td>
                <td class="bb"><strong>{{ $data->cdc_no }} / {{ $data->passport_no }} /
                    {{ $data->indos_no }}</strong></td>
            </tr>
            <tr>
                <td>Date & Place of birth:</td>
                <td class="bb"><strong>{{ Carbon\Carbon::parse($data->Seafarer->dob)->format('d M Y') }} / {{ $data->Seafarer->pob}}</strong></td>
            </tr>
            <tr>
                <td>Colour of Eyes:</td>
                <td class="bb"><strong>{{ $testResultMap[162] ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td>Identification Notes:</td>
                <td class="bb"><strong>{{ $testResultMap[163] ?? '-' }}</strong></td>
            </tr>
             
        </table>

</div>
<div class="border-rl">
        <table class="test-table">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>Right Eye</th>
                    <th>Left Eye</th>
                    <th>Both Eye</th>
                    <th>Result</th>
                </tr>
            </thead>
            <tbody>
              
            
                <tr>
                    <td rowspan="2">Distant Vision</td>
                    <td>Unaided</td>
                    <td>{{ $testResultMap[48] ?? '-' }}</td> <!-- Right -->
                    <td>{{ $testResultMap[49] ?? '-' }}</td> <!-- Left -->
                    <td>{{ $testResultMap[50] ?? '-' }}</td> <!-- Both -->
                    <td>{{ $testResultMap[51] ?? '-' }}</td> <!-- Result -->
                </tr>
                <tr>
                    <td>Aided</td>
                    <td>{{ $testResultMap[56] ?? '-' }}</td>
                    <td>{{ $testResultMap[57] ?? '-' }}</td>
                    <td>{{ $testResultMap[58] ?? '-' }}</td>
                    <td>{{ $testResultMap[73] ?? '-' }}</td>
                </tr>
            
                <tr>
                    <td rowspan="2">Near Vision</td>
                    <td>Unaided</td>
                    <td>{{ $testResultMap[52] ?? '-' }}</td>
                    <td>{{ $testResultMap[53] ?? '-' }}</td>
                    <td>{{ $testResultMap[54] ?? '-' }}</td>
                    <td>{{ $testResultMap[55] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Aided</td>
                    <td>{{ $testResultMap[59] ?? '-' }}</td>
                    <td>{{ $testResultMap[60] ?? '-' }}</td>
                    <td>{{ $testResultMap[61] ?? '-' }}</td>
                    <td>{{ $testResultMap[62] ?? '-' }}</td>
                </tr>
            
                <tr>
                    <td rowspan="2">Field of Vision</td>
                    <td>Horizontal Plane</td>
                    <td>{{ $testResultMap[63] ?? '-' }}</td>
                    <td>{{ $testResultMap[64] ?? '-' }}</td>
                    <td>{{ $testResultMap[65] ?? '-' }}</td>
                    <td>{{ $testResultMap[66] ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Vertical Plane</td>
                    <td>{{ $testResultMap[67] ?? '-' }}</td>
                    <td>{{ $testResultMap[68] ?? '-' }}</td>
                    <td>{{ $testResultMap[69] ?? '-' }}</td>
                    <td>{{ $testResultMap[70] ?? '-' }}</td>
                </tr>
            
                <tr>
                    <td rowspan="2">Color Vision</td>
                    <td>Ishihara</td>
                    <td colspan="3">{{ $testResultMap[71] ?? '-' }}</td> <!-- Single merged cell -->
                    <td>{{ $testResultMap[71] ?? '-' }}</td> <!-- Result -->
                </tr>
                <tr>
                    <td>Lantern / Others</td>
                    <td colspan="3">{{ $testResultMap[72] ?? '-' }}</td>
                    <td>{{ $testResultMap[72] ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
</div>

<div class="border-rbl">

     <div class="certify">
    I, <strong>{{ $data->employee->emp_name }}</strong>, hereby certify that the above mentioned candidate has met / not met*, the eyesight
    standard for 
    @if($data->seafarer->sex == 1)
        his/<strike>her</strike>
    @else
        <strike>his</strike>/her
    @endif
    * designated rank/<strike>position</strike>* as set out in Annex-II/Annex-III* for seafaring occupation.
</div>

        

        <table class="info-table">
            <tbody>
                <tr>
                    <td><br></td>
                </tr>
                <tr>
                    @if(isset($stm))
                        <td>
                            @if(file_exists(public_path('images/' . $data->profile)) && is_file(public_path('images/' . $data->profile)))
                                <img src="{{ $signatureImage }}" style="width: 120px; height: 50px;">
                            @else
                                <div style="width: 120px; height: 50px;"></div>
                            @endif
                            <span class="bt"><br>Candidate's Signature</span>
                        </td>
                        <td style="text-align:center">
                            @php
                                $doctorSignPath = public_path('images/' . ($data->employee->sign_upload ?? ''));
                            @endphp
                            @if(file_exists($doctorSignPath) && is_file($doctorSignPath))
                                <img src="data:image/{{ pathinfo($doctorSignPath, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($doctorSignPath)) }}" alt="Doctor Signature" style="width: 100px; height: auto;">
                            @else
                                <div style="width: 100px; height: 50px;"></div>
                            @endif
                            <br>
                            <span class="bt">(Signature of the Medical Examiner or</span><br>
                            Examiner of Masters and Mates, MMD)
                        </td>
                    @else
                        <td>
                            <span class="bt"><br>Candidate's Signature</span>
                        </td>
                        <td style="text-align:center">
                            <span class="bt">(Signature of the Medical Examiner or</span><br>
                            Examiner of Masters and Mates, MMD)
                        </td>
                    @endif
                </tr>
                <tr>
                    <td>
                        Dated
                        <span class="bb">
                            {{ optional($data->medicalapproval)->issue_date
                                ? \Carbon\Carbon::parse($data->medicalapproval->issue_date)->format('j-M-Y')
                                : '-' }}
                            at {{ $data->clinic->branch ?? '-' }}
                        </span>
                    </td>
                </tr>
                <tr style="text-align:center">
                    @if(isset($stm))
                        <td>
                            <div class="text-center">
                                @php
                                    $fitLogoPath = public_path('images/fit_logo.jpg');
                                @endphp
                                @if(file_exists($fitLogoPath) && is_file($fitLogoPath))
                                    <img src="data:image/{{ pathinfo($fitLogoPath, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($fitLogoPath)) }}" style="max-width: 35px; height: auto;">
                                @endif
                            </div>
                        </td>
                        <td>
                            @php
                                $stampPath = public_path('images/' . ($data->employee->stamp_upload ?? ''));
                            @endphp
                            @if(file_exists($stampPath) && is_file($stampPath))
                                <img src="data:image/{{ pathinfo($stampPath, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($stampPath)) }}" style="width: 100px; height: auto;">
                            @else
                                <div style="width: 100px; height: 50px;"></div>
                            @endif
                            <br>
                            <span class="bt">Official Stamp of the Medical Examiner</span>
                        </td>
                    @else
                        <td><div class="text-center"></div></td>
                        <td><span class="bt">Official Stamp of the Medical Examiner</span></td>
                    @endif
                </tr>
            </tbody>
        </table>


       

        <div class="note">
            <p>Note:
           <ol type="a" style="padding-left: 20pt; padding-right: 20pt;">
                <li>This certificate is valid for two years from the above date. New entry sight test certificates
                    should be retained by the candidate till his active sea career.</li>
                <li>Seafarer aggrieved by the decision of the Medical Examiner may appeal as per the provision of the
                    M.S. (Medical Examination) Rules, 2000 as amended.</li>
            </ol>
            </p>
        </div>
    </div>

</body>

</html>
