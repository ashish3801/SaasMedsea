<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Marshall Island-105M-Medical-Exam-Report</title>
    <style type="text/css">
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
       

         table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 0px;
      margin-bottom: 0px;
    }

    td,
    th {
    
      padding: 1px;
      margin:0px;
      vertical-align: top;
    }
    
            .custom-input {
  background-color: #e6f0ff;
  
}

.mp-0{margin:0px;padding:0px;}

     .page-break {
      page-break-before: always;
      /* Or 'after', depending on your use case */
      break-before: page;
      /* For better compatibility with modern tools */
    }     
    
    </style>
</head>

<body>
    <table style="border-collapse:collapse; margin-left:10pt; margin-right:20pt; margin-top:10pt; width: 96.5%;"
        cellspacing="0">
        <tr>
            <td colspan="6" style="padding-left: 1pt; border: solid 1pt #000;">
                <h1 style="text-align: center;">MEDICAL EXAMINATION REPORT/CERTIFICATE</h1>
                <h2 style="text-align: center;">MARITIME ADMINISTRATOR</h2>
                <h3 style="text-align: center;color:red;">CONFIDENTIAL DOCUMENT</h3>
                <h2 style="text-align: center;">REPUBLIC OF THE MARSHALL ISLANDS</h2>
            </td>
        </tr>

        <tr>
            <td colspan="3"
                style="border: 1pt solid #000;">
                <p style="padding-left: 6pt;">SURNAME</br><span class="custom-input">{{ $data->seafarer->l_name }}</span></p>
            </td>
            <td colspan="3"
                style="border: 1pt solid #000;">
                <p style="padding-left: 6pt;">GIVEN
                    NAME(S)</br><span class="custom-input">{{ $data->seafarer->f_name }} {{ $data->seafarer->m_name }}</span></p>
            </td>
        </tr>

        <tr>
            <td colspan="3"
                style="border: 1pt solid #000;">
                <p style="padding-left: 6pt;">DATE OF BIRTH</p>
                <p>
                <table style="padding-left: 4pt;">
                  @php
                      $dob = \Carbon\Carbon::parse($data->seafarer->dob);
                  @endphp
                    <tr>
                        <td style="padding-right: 10pt;">
                            MONTH <span class="custom-input">{{ $dob->format('M') }}</span>
                        </td>
                        <td style="padding-right: 10pt;">
                            DAY <span class="custom-input">{{ $dob->format('j') }}</span>
                        </td>
                        <td style="padding-right: 10pt;">
                            YEAR <span class="custom-input">{{ $dob->format('Y') }}</span>
                        </td>
                    </tr>
                </table>
                </p>
            </td>
            <td colspan="2"
                style="border: 1pt solid #000;">
                <p style="padding-left: 6pt;">PLACE OF BIRTH</p>
                <p>
                <table style="padding-left: 4pt;text-align: left;">
                    <tr>
                        <td style="width: 50%; padding-right: 4pt;">
                            CITY <span class="custom-input">{{ $data->Seafarer->pob}}</span>
                        </td>
                        <td>
                            COUNTRY <span class="custom-input">{{ $data->nationality_id == 1 ? 'Indian' : '' }}</span>
                        </td>
                    </tr>
                </table>
            </td>
           <td colspan="1"
              style="border-top-style:solid;border-top-width:1pt; border-left-style:solid;border-left-width:1pt; border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
              <p style="padding-left: 6pt;">SEX</p>
              <span style="margin-right: 18px; font-size: 14px;"><input type="checkbox" disabled style="vertical-align: middle;" class="custom-input" {{ $data->seafarer->sex == 1 ? 'checked' : '' }}></span> MALE
              </span>

              <span style="margin-right: 18px; font-size: 14px;"><input type="checkbox" disabled style="vertical-align: middle;" class="custom-input" {{ $data->seafarer->sex == 2 ? 'checked' : '' }}></span> FEMALE
              </span>

          </td>

        </tr>

        <tr>
            <td colspan="3" style="width:251pt;border: 1pt solid #000;">
                <p class="s4" style="padding-left: 6pt;">EXAMINATION FOR DUTY AS:</p>
           <table style="width: 80%; padding-left: 4pt; border: none;">
            <tr>
              <td style="border: none;">MASTER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'master' ? 'checked' : '' }}>
              </td>
            </tr>
            <tr>
              <td style="border: none;">DECK OFFICER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'mate' ? 'checked' : '' }}>
              </td>
              </tr>
            <tr>
              <td style="border: none;">ENGINEERING OFFICER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'engineer' ? 'checked' : '' }}>
              </td>
            </tr>
             <tr>
              <td style="border: none;">RADIO OFFICER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'radio off' ? 'checked' : '' }}>
              </td>
            </tr>
            <tr>
              <td style="border: none;">RATING</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'rating' ? 'checked' : '' }}>
              </td>
            </tr>
          </table>

            </td>
            <td colspan="3"
                style="width:291pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">MAILING
                    ADDRESS OF APPLICANT:</p>
                    <span class="custom-input" style="padding-left: 4pt;"> {{ $data->address }}</span> 
            </td>
        </tr>

        <tr>
            <td colspan="6"
                style="width:542pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">MEDICAL EXAMINATION <span>(SEE REVERSE SIDE FOR MEDICAL REQUIREMENTS) </span>STATE DETAILS ON
                    REVERSE SIDE</p>
            </td>
        </tr>
        @php
          $physicalTestIds = [
                  25 => 'HEIGHT',
                  26 => 'WEIGHT',
                  'BMI' => 'BMI',
                  28 => 'BLOOD PRESSURE',
                  29 => 'PULSE',
                  30 => 'RESPIRATION',
                  31 => 'GENERAL APPEARANCE',
              ];
             
        @endphp
        
        <tr style="height:23pt">
            <td
                style="width:58pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">HEIGHT<br><span class="custom-input">{{ $physicalResults[25] ?? '-' }}</span></p>
            </td>
            <td
                style="width:54pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">WEIGHT<br><span class="custom-input">{{ $physicalResults[26] ?? '-' }}</span></p>
            </td>
            <td
                style="width:91pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">BLOOD PRESSURE<br><span class="custom-input">{{ $physicalResults[28] ?? '-' }}</span></p>
            </td>
            <td
                style="width:84pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">PULSE<br><span class="custom-input">{{ $physicalResults[29] ?? '-' }}</span></p>
            </td>
            <td
                style="width:76pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">RESPIRATION<br><span class="custom-input">{{ $physicalResults[30] ?? '-' }}</span></p>
            </td>
            <td
                style="width:179pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">GENERAL APPEARANCE<br><span class="custom-input">{{ $physicalResults[31] ?? '-' }}</span></p>
            </td>
        </tr>
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
        
    @endphp

        @php
          function getResult($results, $id) {
              return $results[$id] ?? '-';
          }
      @endphp
      @once
          @php
              function getTestResultMarshall($id, $specialTests) {
                  return $specialTests['by_id'][$id] ?? '-';
              }
          @endphp
      @endonce

        <tr style="height:40pt"> 
            <td colspan="4" style="width:287pt; border:1pt solid;">
                <table style="padding-left: 4pt;width: 100%;">
                  <tr>
                    <td style="border: none; width: 33%;">VISION</td>
                    <td style="border: none; width: 33%;">RIGHT EYE</td>
                    <td style="border: none; width: 34%;">LEFT EYE</td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITHOUT GLASSES</td>
                    <td style="border: none;"><span class="custom-input"><u>{{ getTestResultMarshall(48, $specialTests) }} &amp; {{ getTestResultMarshall(52, $specialTests) }}</u></span></td>
                    <td style="border: none;"><span class="custom-input"><u>{{ getTestResultMarshall(49, $specialTests) }} &amp; {{ getTestResultMarshall(53, $specialTests) }}</u></span></td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITH GLASSES</td>
                    <td style="border: none;"><span class="custom-input"><u>{{ getTestResultMarshall(56, $specialTests) }} &amp; {{ getTestResultMarshall(59, $specialTests) }}</u></span></td>
                    <td style="border: none;"><span class="custom-input"><u>{{ getTestResultMarshall(57, $specialTests) }} &amp; {{ getTestResultMarshall(60, $specialTests) }}</u></span></td>
                  </tr>
                </table>
          </td>

            {{-- HEARING --}}
            <td colspan="2"
                style="width:255pt; border:1pt solid;">
                <p style="padding-left:6pt;">HEARING:</p>
                <div style="margin-top:auto;padding-left:6pt;padding-bottom:3pt;">
                   <p style="display:inline;"> RT. EAR 
                    <span class="custom-input"><u>{{ getTestResultMarshall(89, $specialTests) }}</u></span> </p>
                    
                   <p style="margin-left:50px;display:inline;">LEFT EAR 
                    <span class="custom-input"><u>{{ getTestResultMarshall(90, $specialTests) }}</u></span></p>
                </div>
            </td>
        </tr>


        @php
            $test71 = strtolower(getTestResultMarshall(71, $specialTests));
            $test72 = strtolower(getTestResultMarshall(72, $specialTests));
            $isColorTestNormal = $test71 === 'normal' && $test72 === 'normal';
        @endphp

        <tr style="height:18pt">
            <td style="width:542pt; border:1pt solid;" colspan="6">
                <p style="padding-left: 6pt;">
                    COLOR TEST TYPE: BOOK 
                    <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" checked> 
                    LANTERN 
                    <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> 

                    IF COLOR TEST IS NORMAL:
                    <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" disabled {{ $isColorTestNormal ? 'checked' : '' }}> Yes
                    <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" disabled {{ !$isColorTestNormal ? 'checked' : '' }}> No (If “No” explain on page 2)

                  
                </p>
            </td>
        </tr>

        @php
            // Fetch and clean test results
            $val56 = trim(getTestResultMarshall(56, $specialTests));
            $val59 = trim(getTestResultMarshall(59, $specialTests));
            $val57 = trim(getTestResultMarshall(57, $specialTests));
            $val60 = trim(getTestResultMarshall(60, $specialTests));

            // Determine if any of the values are meaningful (not '-' or empty)
            $glassesRequired = ($val56 !== '-' && $val56 !== '') ||
                              ($val59 !== '-' && $val59 !== '') ||
                              ($val57 !== '-' && $val57 !== '') ||
                              ($val60 !== '-' && $val60 !== '');
        @endphp

        <tr>
            <td style="width:542pt;border:1pt solid;" colspan="6">
                <p style="padding-left: 6pt;">ARE GLASSES OR CONTACT LENSES NECESSARY TO MEET THE REQUIRED VISION STANDARD?  YES
                    <input class="custom-input" type="checkbox" 
                          style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" 
                          disabled {{ $glassesRequired ? 'checked' : '' }}> 
                    NO
                    <input class="custom-input" type="checkbox" 
                          style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" 
                          disabled {{ !$glassesRequired ? 'checked' : '' }}>
                </p>
            </td>
        </tr>
        <tr>
            <td style="width:287pt;border: 1pt solid #000;"
                colspan="3">
                <p style="padding-left: 6pt;">HEAD AND NECK<br><span class="custom-input">{{ $systemTests[32]['value'] ?? '-' }}</span></p>
            </td>
            <td style="width:255pt;border: 1pt solid #000;"
                colspan="3">
                <p style="padding-left: 6pt;">HEART (CARDIOVASCULAR)<br><span class="custom-input">{{ $systemTests[45]['value'] ?? '-' }}</span></p>
            </td>
        </tr>

        <tr>
            <td style="width:287pt;border: 1pt solid #000;"
                colspan="3">
                <p style="padding-left: 6pt;">LUNGS<br><span class="custom-input">{{ $systemTests[42]['value'] ?? '-' }}</span></p>
            </td>
            <td style="width:255pt;border: 1pt solid #000;"
                colspan="3">
                <p style="padding-left: 6pt;">
                    SPEECH <span>(DECK/NAVIGATIONAL OFFICER AND RADIO OFFICER)</span></p>
                <p style="padding-left: 6pt;text-indent: 0pt;text-align: left;">IS SPEECH UNIMPAIRED FOR NORMAL VOICE COMMUNICATION?<span class="custom-input">Normal</span></p>

            </td>
        </tr>

        <tr>
            <td style="width:542pt;border: 1pt solid #000;"
                colspan="6">
                <p style="padding-left: 6pt;">EXTREMITIES:
                </p>
                <p style="padding-left: 77pt;">
                    UPPER <u><span class="custom-input">{{ $systemTests[194]['value'] ?? 'Normal' }}</u></span> 
                    LOWER <u><span class="custom-input">{{ $systemTests[195]['value'] ?? 'Normal' }}</u></span>
                    </p>
            </td>
        </tr>

        <tr>
          <td colspan="6"
              style="width:542pt; border-top-style:solid; border-top-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; border-right-style:solid; border-right-width:1pt;">
              <p style="padding-left: 6pt;">
                  IS APPLICANT VACCINATED IN ACCORDANCE WITH WHO RECOMMENDATIONS?
                  YES 
                  <input class="custom-input" type="checkbox" checked
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> 
                  NO 
                  <input class="custom-input" type="checkbox"
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;">
              </p>
          </td>
      </tr>


        <tr>
            <td colspan="6"
                style="width:542pt;border: 1pt solid #000;">
                <p style="padding-left: 6pt;">
                    IS APPLICANT SUFFERING FROM ANY DISEASE LIKELY TO BE AGGRAVATED BY WORKING ABOARD A VESSEL, OR TO
                    RENDER HIM/HER UNFIT FOR SERVICE AT SEA OR LIKELY TO ENDANGER THE HEALTH OF OTHER PERSONS ON BOARD?

                    YES <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;">
                    NO <input class="custom-input" type="checkbox" checked style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;">
                </p>
                <p style="padding-left: 6pt;">IF YES, PLEASE ENTER EXPLANATION IN THE SECTION AT THE BOTTOM OF ON PAGE 2</p>
            </td>
        </tr>

        <tr>
            <td style="width:542pt;border: 1pt solid #000;"
                colspan="6">
                <p style="padding-left: 6pt;">IS APPLICANT TAKING ANY NON-PRESCRIPTION OR PRESCRIPTION MEDICATIONS? YES<input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> NO 
                <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;" checked>
                </p>
            </td>
        </tr>

        <tr>
            <td style="width:542pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="6">
                <p class="mp-0">

 @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif
       
                <table style="padding-left: 6pt;text-indent: 0pt;">
                    
                    <tr>
                         <td style="width: 50%; border: none; text-align: center; ">
                 @if($stm)
                  <img src="{{ $signatureImage }}" alt="Signature" style="height: 50px;">
                @else
                  <div style="border-bottom: 1px solid #000; height: 50px; margin: 0 auto;"></div>
                @endif
                <div style="margin-bottom: 0px;border-top:1px solid #000">SIGNATURE OF APPLICANT</div>
                </td>
                        <td style="width: 25%;text-align: center; ">
                            <div class="custom-input" style="border-bottom: 1px solid #000; width: 120px; margin: 0 auto;">{{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '-' }}</div>
                            <div style="margin-bottom: 0px;">DATE OF EXAM</div>
                        </td>
                        <td style="width: 25%;text-align: center; ">
                          <div class="custom-input" style="border-bottom: 1px solid #000; width: 120px; margin: 0 auto;"> {{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? '-' }}</div>
                            EXPIRY DATE
                        </td>
                    </tr>
                </table>
                </p>


                <p class="mp-0" style="padding-left: 6pt;">THIS SIGNATURE SHOULD BE AFFIXED IN THE PRESENCE OF THE EXAMINING PHYSICIAN.</p>
                 <table>
                      <tr>
            <td style="padding-top: 0px; border: none;">
                <span style="padding-left: 6pt; text-indent: 0pt; text-align: left;">
                    THIS IS TO CERTIFY THAT A PHYSICAL EXAMINATION WAS GIVEN TO:
                </span> </td>
                <td style="padding-top: 0px; border: none;text-align: center;">
                <span class="custom-input" style="text-indent: 0pt; text-align: center;">
                    {{ $data->seafarer->f_name ?? '' }} 
                    {{ $data->seafarer->m_name ?? '' }} 
                    {{ $data->seafarer->l_name ?? '' }}
                  </span>
                  <div style="margin-bottom: 0px;border-top:1px solid #000">NAME OF APPLICANT(SURNAME, GIVEN NAME(S))</div>
                
            </td>
          </tr>
          </table>
          
                <p style="padding-left: 6pt;">THIS APPLICANT IS CERTIFIED FREE OF COMMUNICABLE DISEASE (OR VIRUSES FOR COOKS): YES<input
                        class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> NO
                    <input class="custom-input" type="checkbox" style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"></p>
             
               @php
                  $isFit = $data->medicalApproval->is_fit;
                  $rank = strtolower($data->rank->category ?? '');
                  $restrictions = $data->medicalApproval->restrictions ?? null;
              @endphp

              <p style="padding-left: 6pt;">
                  SEAFARER IS FOUND TO BE
                  {{-- Fit / Not Fit --}}
                  <input class="custom-input" type="checkbox" {{ $isFit ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> FIT / 
                  <input class="custom-input" type="checkbox" {{ !$isFit ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> NOT FIT FOR DUTY AS 

                  {{-- Roles --}}
                  <input class="custom-input" type="checkbox" {{ $rank === 'master' ? 'checked' : '' }}
                      style="margin-bottom: -2pt;vertical-align: middle; width: 10px; font-size:10pt;"> MASTER / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'deck officer' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> DECK OFFICER / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'engineering officer' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> ENGINEERING OFFICER / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'radio officer' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> RADIO OFFICER / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'rating' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> RATING / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'chief cook' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> CHIEF COOK / 
                  <input class="custom-input" type="checkbox" {{ $rank === 'cook' ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> COOK

                  {{-- Restrictions --}}
                  <input class="custom-input" type="checkbox" {{ empty($restrictions) ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> WITHOUT ANY RESTRICTIONS / 
                  <input class="custom-input" type="checkbox" {{ !empty($restrictions) ? 'checked' : '' }}
                      style="margin-bottom: -2pt; vertical-align: middle; width: 10px; font-size:10pt;"> WITH THE FOLLOWING RESTRICTIONS
                      </p>

                <p style="padding-left: 6pt;padding-bottom: 2pt;">
                    RESTRICTIONS: <span class="custom-input">{{$data->medicalapproval->limitation}}</span>
                </p>
            </td>
        </tr>

        <tr style="height:100pt">
            <td style="width:542pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="6">
                <p style="padding-top: 3pt; padding-left: 6pt;">
                    NAME AND DEGREE OF PHYSICIAN <span class="custom-input" style="border-bottom:1px solid #000;">{{ $data->employee->emp_name ?? '-' }} {{ $data->employee->physician->address ?? '-' }}</span></p>
                <p style="padding-top: 3pt; padding-left: 6pt;">ADDRESS <span class="custom-input" style="border-bottom:1px solid #000;"> {{ $data->clinic->add ?? '-' }} </span></p>
                <p style="padding-top: 3pt;padding-left: 6pt;">NAME OF PHYSICIAN&#39;S CERTIFICATING <span class="custom-input" style="border-bottom:1px solid #000;">The Gujarat Medical Council</span></p>
                <p style="padding-top: 3pt;padding-left: 6pt;">DATE OF ISSUE OF PHYSICIAN&#39;S CERTIFICATE <span class="custom-input" style="border-bottom:1px solid #000;">{{ \Carbon\Carbon::parse($data->employee->certificate_issue_date)->format('d/m/Y')  ?? '-' }}</span></p>
                
            </td>
        </tr>
     
        <tr>
            <td style="border-left: 1pt solid #000; border-bottom:1pt solid #000" colspan="4">
                <p style="padding-top: 3pt; padding-left: 6pt;">SIGNATURE OF PHYSICIAN 
                        @if($stm)
                            <img src="{{ $doctorSign }}" style="height: 30px; vertical-align: middle;">
                        @else
                            <div style="border-bottom:1px solid #000;height: 50px; vertical-align: middle;"></div>
                        @endif
                        
                   
                        </p>
                    </td>
                      <td style="text-align:left; border-bottom:1pt solid #000;"> 
                      @if(isset($stm))
                     <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->stamp_upload))) }}" style="width: 80px; height: 80px;">
                    @else
                    @endif</td>
                  
                <td style="text-align:center; border-bottom:1pt solid #000; border-right:1pt solid #000">
                    <p> 
                   
                    <span class="custom-input" style="border-bottom: 1px solid #000;">{{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '-' }}  </span>
                    </br>DATE
                    </p>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <p style="padding-top: 1pt;padding-left: 20pt;padding-right: 20pt; text-align: center; font-size:12px;">This certificate is issued by authority of the Maritime Administrator and in compliance with the requirements of the
                    International Convention on Standards of Training, Certification and Watchkeeping for Seafarers 1978, as amended,
                    and the Maritime Labour Convention, 2006, as amended.</p>
            </td>
        </tr>
<tr>
    <td colspan="6">
<table style="width: 100%; border: none;">
            <tr>
                <td style="width: 33%; border: none; text-align: left; ">
                    <div class="mp-0">Rev.Sep/2024</div>
                </td>
                <td style="width: 33%; border: none; text-align: center; ">
                      <div class="mp-0">1 of 2</div>
                </td>
                <td style="width: 34%; border: none; text-align: right; ">
                <div class="mp-0">MI-105M</div>
                  </td>
            </tr>
</table>
</td>
</tr>
    </table>
           

  <div class="page-break"></div>
  
<div style="margin: 10pt; max-width: 100%; box-sizing: border-box;">
  <div style="border: 1pt solid #000; padding: 10pt; box-sizing: border-box;">
    <p style="text-align: center; font-weight: bold;">MEDICAL REQUIREMENTS</p>
    
    <p style="padding: 3pt 14pt 0; text-indent: 0pt; text-align: justify;">
      All applicants for an officer certificate, Seafarer's Identification and Record Book or certification of special
      qualifications shall be required to have a medical examination reported on this Medical Form completed by a
      certificated physician. The completed medical form must accompany the application for officer’s certificate,
      application for Seafarer's Identification and Record Book, or application for certification of special
      qualifications. This medical examination must be carried out within the 24 months immediately preceding application
      for an officer certificate, certification of special qualifications or a Seafarer’s Identification and Record Book.
      The examination shall be conducted in accordance with RMI MG-7-47-1. Such proof of examination must establish that
      the applicant is in satisfactory physical and mental condition for the specific duty assignment undertaken and is
      generally in possession of all body faculties necessary in fulfilling the requirements of the seafaring profession.
    </p>
    <p style="padding: 6pt 14pt 0; text-indent: 0pt; text-align: justify;">
      In conducting the examination, the certified physician should, where appropriate, examine the seafarer’s previous
      medical records (including vaccinations) and information on occupational history, noting any diseases, including
      alcohol or drug-related problems and/or injuries. In addition, the following minimum requirements shall apply:
    </p>
    <ol type="a" style="padding-left: 40pt; padding-right: 20pt;">
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Hearing</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; All applicants must have hearing unimpaired for normal
          sounds and be capable of hearing a whispered voice in better ear at 15 feet (4.57 m) and in poorer ear at 5 feet
          (1.52 m).</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Eyesight</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Deck officer applicants must have (either with or
          without glasses) at least 20/20 (1.00) vision in one eye and at least 20/40 (0.50) in the other. Applicants for
          deck officer and deck ratings who will serve on vessels of 500 gross tons or more must have normal color
          perception that complies with C.I.E. Standard 1; those serving on vessels less than 500 gross tons must comply
          with C.I.E. Standards 1 or 2.</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Engineer and radio officer applicants must have (either
          with or without glasses) at least 20/30 (0.63) vision in one eye and at least 20/50 (0.40) in the other.
          Applicants for engineering officer or rating and for radio operator must comply with C.I.E. Standards 1, 2, or
          3. Engineer and radio officer applicants must also be able to perceive the colors red, yellow and green.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Dental</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Seafarers must be free from infections of the mouth
          cavity or gums.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Blood Pressure</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; An applicant's blood pressure must fall within an
          average range, taking age into consideration.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Voice</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Deck/Navigational officer applicants and Radio officer
          applicants must have speech which is unimpaired for normal voice communication.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Vaccinations</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; All applicants should be vaccinated according to the
          recommendations provided in the WHO publication, International Travel and Health, Vaccination Requirements and
          Health Advice, and should be given advice by the certified physician on immunizations. If new vaccinations are
          given, these should be recorded.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Diseases or Conditions</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Applicants afflicted with any of the following diseases
          or conditions shall be disqualified: epilepsy, insanity, senility, alcoholism, tuberculosis, acute venereal
          disease or neurosyphilis, AIDS, and/or the use of narcotics.</p>
      </li>
      <li>
        <p style="text-indent: 0pt; text-align: justify;">Physical Requirements</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Applicants for able seafarer, bosun, GP-1, ordinary
          seafarer and junior ordinary seafarer must meet the physical requirements for a deck/navigational officer's
          certificate.</p>
        <p style="margin-left: 20pt; text-align: justify;">&bull; Applicants for fire/watertender, oiler/motor, pump
          technician, electrician, wiper, tanker rating and survival craft/rescue boat crewmember must meet the physical
          requirements for an engineer officer's certificate.</p>
      </li>
    </ol>
  </div>

  <br />

  <div class="textbox" style="border: 0.5pt solid #000000; display: block; min-height: 89pt;">
    <p style="text-align: center;"><strong>IMPORTANT NOTE:</strong></p>
    <p style="padding: 1pt 14pt 0; text-align: justify;">
      A copy of the MI-105M must accompany the application. The applicant must retain the original of the MI-105M as
      evidence of physical qualification while serving on board a vessel.
    </p>
    <p style="padding: 1pt 14pt 0; text-align: justify;">
      An applicant who has been refused a medical certificate or has had a limitation imposed on his/her ability to
      work, shall be given the opportunity to have an additional examination by another medical practitioner or medical
      referee who is independent of the shipowner or of any organization of shipowners or seafarers.
    </p>
    <p style="padding: 1pt 14pt 0; text-align: justify;">
      Medical examination reports shall be marked as and remain confidential, with the applicant having the right to a
      copy of his/her report. The medical examination report shall be used only for determining the fitness of the
      seafarer for work and enhancing health care.
    </p>
  </div>

  <br />

  <div class="textbox" style="border: 0.5pt solid #000000; display: block; min-height: 104.7pt;">
    <p style="text-align: center;">DETAILS OF MEDICAL EXAMINATION</p>
    <p style="padding-left: 13pt; text-align: left;">
      To be completed by examining physician; alternatively, the examining physician may attach an equivalent form. (See
      RMI MG 7-47-1, §3.3).
      
    <p></p>  
      
      
          <div>
        @if(isset($stm))
            <div style="text-align: center;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->sign_upload))) }}" alt="Doctor Signature" style="height: 30px; vertical-align: middle;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->stamp_upload))) }}" alt="Stamp" style="width: 80px; height: 80px;">
                </br><span>
                    {{ $data->employee->emp_name }}<br>Medical Examiner
                </span>
      
                
            </div>
        @else
            <div style="text-align: center;">
                <div>
                    {{ $data->employee->emp_name }}<br>Medical Examiner
                </div>
            </div>
            <div></div>
        @endif
    </div>
    </p>
  </div>

<table style="width: 100%; border: none;">
            <tr>
                <td style="width: 33%; border: none; text-align: left; ">
                    <div class="mp-0">Rev.Mar/2024</div>
                </td>
                <td style="width: 33%; border: none; text-align: center; ">
                      <div class="mp-0">2 of 2</div>
                </td>
                <td style="width: 34%; border: none; text-align: right; ">
                <div class="mp-0">MI-105M</div>
                  </td>
            </tr>
</table>
</div>

</body>

</html>