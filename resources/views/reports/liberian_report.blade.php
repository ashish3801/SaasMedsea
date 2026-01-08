<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liberian Examination Report</title>
  <style>
    @page {
      margin: 0;
      padding: 0;
      size: A4 portrait;
    }

     body {
       font-family: 'DejaVu Sans', sans-serif;
      font-size: 12px;
      margin: 15px;
    }
    

    h2,
    h3 {
      text-align: center;
      margin: 0;
    }

    h2 {
      margin-bottom: 0px;
      text-transform: uppercase;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 0px;
      margin-bottom: 0px;
    }

    td,
    th {
      border: 0.5px solid #000;
      padding: 1px;
      margin:0px;
      vertical-align: top;
    }

     table.hd  td, {
      border: none;
    }

     }
     .exam-section {
      border: 1px solid #000;
      text-align: center;
      font-weight: bold;
      padding: 8px;
      background-color: #f0f0ff;
      margin-top: 30px;
    }

    table.exam-details td {
      border: 1px solid #aaa;
      height: 35px;
      background-color: #e6f0ff;
    }


    .overlay-wrapper {
        position: relative;
        width: 100%;
        height: 300px; /* Adjust based on layout needs */
    }

    .exam-details {
        width: 100%;
        height: 100%;
    }

    .signature-stamp-container {
        position: absolute;
        bottom: 30px;
        left: 10px;
        display: flex;
        gap: 20px;
        align-items: flex-end;
    }

    .signature-stamp-container img {
        width: 100px;
        height: auto;
    }

    .signature-label {
        text-align: center;
        font-size: 12px;
    }


    footer {
      text-align: center;
      font-size: 12px;
      margin-top: 40px;
    }


    .page-break {
      page-break-before: always;
      /* Or 'after', depending on your use case */
      break-before: page;
      /* For better compatibility with modern tools */
    }


    .custom-input {
  background-color: #e6f0ff;
  padding-left:1px;
}

.mp-0{margin:0px;padding:0px;}

 
  </style>
</head>

<body>
  <div style="border: solid 1.5px #000;">
      
   <table class="hd" style="text-align: center;">
    <tr>
        <td><h2>PHYSICAL EXAMINATION REPORT/CERTIFICATE</h2></td>
        <td style="vertical-align: bottom;"><span>ANNEX 2</span></td>
    </tr>
    <tr>
        <td><h3>DEPUTY COMMISSIONER OF MARITIME AFFAIRS</h3></td>
        <td style="vertical-align: bottom;"><span>Certificate Code</span></td>
    </tr>
    <tr>
        <td><h3>THE REPUBLIC OF LIBERIA</h3></td>
        <td ><h3 style="margin:2px; border: 1px solid #000; width: 150px; text-align: center;">{{ $systemTests[214]['value'] ?? '-' }}</h3></td>
    </tr>
</table>

    


    <table style="width: 100%;">
      <tr>
        <td style="width: 35%;">LAST NAME OF APPLICANT
          <br />
          <span class="custom-input">{{ $data->seafarer->l_name }}</span>
        </td>
        <td style="width: 35%;">FIRST NAME
          <br />
          <span class="custom-input">{{ $data->seafarer->f_name }}</span>
        </td>
        <td style="width: 30%;">MIDDLE INITIAL
          <br />
         <span class="custom-input">{{ $data->seafarer->m_name }}</span>
        </td>
      </tr>
        @php
              $dob = \Carbon\Carbon::parse($data->seafarer->dob);
          @endphp
      <tr>
      <!-- Date of Birth Block -->
      <td>
        DATE OF BIRTH
        <table style="width: 100%; border: none;">
          <tr>
            <td style="border: none;">MONTH <span class="custom-input">{{ $dob->format('M') }}</span></td>
            <td style="border: none;">DAY <span class="custom-input">{{ $dob->format('j') }}</span></td>
            <td style="border: none;">YEAR <span class="custom-input">{{ $dob->format('Y') }}</span></td>
          </tr>
         </table>
      </td>

        <!-- Place of Birth Block -->
        <td>
          PLACE OF BIRTH
          <table style="width: 100%; border: none;">
            <tr>
              <td style="border: none;">CITY <span class="custom-input">{{ $data->Seafarer->pob}}</span></td>
              <td style="border: none;">COUNTRY <span class="custom-input">{{ $data->nationality_id == 1 ? 'Indian' : '' }}</span></td>
            </tr>
            
          </table>
        </td>

        <!-- Sex Block -->
        <td>
          SEX
          <div style="margin-top: 2px;">
            <span style="margin-right: 18px; font-size: 14px;">
              <input class="custom-input" type="checkbox" disabled {{ $data->seafarer->sex == 1 ? 'checked' : '' }}> Male
            </span>

            <span style="font-size: 14px;">
              <input class="custom-input" type="checkbox" disabled {{ $data->seafarer->sex == 2 ? 'checked' : '' }}> Female
            </span>
          </div>
        </td>

      </tr>

      </table>
    <table style="width: 100%;">
      <tr>
        <!-- Examination block -->
        <td style="width: 50%; vertical-align: top;">
         EXAMINATION FOR DUTY AS:
          <table style="width: 100%; border: none;">
            <tr>
              <td style="border: none;">MASTER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'master' ? 'checked' : '' }}>
              </td>
              <td style="border: none;">RATING</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'rating' ? 'checked' : '' }}>
              </td>
            </tr>
            <tr>
              <td style="border: none;">MATE</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'mate' ? 'checked' : '' }}>
              </td>
              <td style="border: none;">MOU DECK</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'mou deck' ? 'checked' : '' }}>
              </td>
            </tr>
            <tr>
              <td style="border: none;">ENGINEER</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'engineer' ? 'checked' : '' }}>
              </td>
              <td style="border: none;">MOU ENGINE</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'mou engine' ? 'checked' : '' }}>
              </td>
            </tr>
            <tr>
              <td style="border: none;">RADIO OFF</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'radio off' ? 'checked' : '' }}>
              </td>
              <td style="border: none;">SUPERNUMERARY</td>
              <td style="border: none;">
                <input class="custom-input" type="checkbox" disabled {{ strtolower($data->rank->category) === 'supernumerary' ? 'checked' : '' }}>
              </td>
            </tr>
          </table>
        </td>

        <!-- Mailing Address block -->
        <td style="width: 50%; vertical-align: top;">
          MAILING ADDRESS OF APPLICANT:
          <div class="custom-input" style="margin-top: 5px; font-size: 14px;">
            {{ $data->address }}
          </div>
        </td>
      </tr>
    </table>

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

    <table>
        <tr>
            <td colspan="6" style="border: none;">
                MEDICAL EXAMINATION (SEE PAGE 2) STATE DETAILS ON PAGE 2
            </td>
        </tr>
        <tr>
            @foreach ($physicalTestIds as $key => $label)
                <td>
                    {{ strtoupper($label) }}
                    <br />
                    <span class="custom-input" style="margin-top: 10px;">
                        {{ $physicalResults[$key] ?? '-' }}
                    </span>
                </td>
            @endforeach
        </tr>
    </table>
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
            'distant_unaided' => 49,
            'near_unaided' => 53,
            'distant_aided' => 57,
            'near_aided' => 60,
            'horizontal' => 64,
            'vertical' => 72
        ],
        'color' => [
            'ishihara' => 71, // Replace if needed
            'other' => 72,
             'distant_aided' => 73,
            'near_aided' => 62,
            'distant_unaided' => 51,
            'near_unaided' => 55,
            'hv' => 66,
            'vv' => 70
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
@endphp

@once
    @php
        function getTestResultLiberian($id, $specialTests) {
            return strtolower($specialTests['by_id'][$id] ?? '-');
        }
    @endphp
@endonce

@php
    // Color vision check
    $test71 = getTestResultLiberian(71, $specialTests);
    $test72 = getTestResultLiberian(72, $specialTests);
    $isColorTestNormal = $test71 === 'normal' || $test72 === 'normal';

    // Distant vision check
    $test51 = getTestResultLiberian(51, $specialTests);
    $test73 = getTestResultLiberian(73, $specialTests);
    $isDistantNormal = $test51 === 'normal' || $test73 === 'normal';

    // Near vision check
    $test62 = getTestResultLiberian(62, $specialTests);
    $test55 = getTestResultLiberian(55, $specialTests);
    $isNearNormal = $test62 === 'normal' || $test55 === 'normal';

    // Field of vision check (Horizontal and Vertical plane)
    $test66 = getTestResultLiberian(66, $specialTests); // Horizontal
    $test70 = getTestResultLiberian(70, $specialTests); // Vertical
    $isFvNormal = $test66 === 'normal' && $test70 === 'normal';

    // Hearing check (right + left ear)
    $test89 = getTestResultLiberian(89, $specialTests); // Right
    $test90 = getTestResultLiberian(90, $specialTests); // Left
    $isEarNormal = $test89 === 'normal' && $test90 === 'normal';

    // Final lookout duty eligibility
    $isLookoutNormal = $isColorTestNormal  && $isFvNormal && $isEarNormal;
@endphp


  
                <table style="width: 100%;">
                  <tr>
                    <td style="border: none; width: 20%;">VISION</td>
                    <td style="border: none; width: 20%;">RIGHT EYE</td>
                    <td style="border: none; width: 60%;">LEFT EYE</td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITHOUT GLASSES</td>
                    <td style="border: none;"><span class="custom-input">{{ getTestResultLiberian(48, $specialTests) }} &amp; {{ getTestResultLiberian(52, $specialTests) }}</span></td>
                    <td style="border: none;"><span class="custom-input">{{ getTestResultLiberian(49, $specialTests) }} &amp; {{ getTestResultLiberian(53, $specialTests) }}</span></td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITH GLASSES</td>
                    <td style="border: none;"><span class="custom-input">{{ getTestResultLiberian(56, $specialTests) }} &amp; {{ getTestResultLiberian(59, $specialTests) }}</span></td>
                    <td style="border: none;"><span class="custom-input">{{ getTestResultLiberian(57, $specialTests) }} &amp; {{ getTestResultLiberian(60, $specialTests) }}</span></td>
                  </tr>
                </table>

<table style="width: 100%;">
 
             
                  <tr>
                    <td style="border: none;">
                      DATE OF LAST COLOR VISION TEST(Month/Day/Year):
                      <span class="custom-input">
                        {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '' }}
                      </span>
                      <span style="padding-left: 100px; margin-top:10px;">Testing Required every 6 years</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="border: none;">
                      COLOR VISION MEETS STANDARDS IN STCW CODE, TABLE A-I/9?
                      <label>
                        <input class="custom-input" type="checkbox" disabled {{ $isColorTestNormal ? 'checked' : '' }}>
                        <span  style="margin-bottom: 1px; margin-right: 36px; display: inline-block;">YES</span>
                      </label>
                      <label>
                        <input class="custom-input" type="checkbox" disabled {{ !$isColorTestNormal ? 'checked' : '' }}>
                        <span style="margin-bottom: 1px; margin-right: 36px; display: inline-block;">NO</span>
                      </label>
                    </td>

                  </tr>
            
       
             
              <tr><td>
                COLOR TEST TYPE: BOOK <input class="custom-input" style="margin-bottom:-4px" type="checkbox" disabled {{ $test71 ==='normal' ? 'checked' : '' }}> 
                LANTERN <input class="custom-input" style="margin-bottom:-4px" type="checkbox" disabled {{ $test72 ==='normal' ? 'checked' : '' }}> CHECK IF COLOR TEST IS NORMAL
                <span style="padding-left: 10px;">
                  
                  <span>YELLOW</span>
                  <input class="custom-input" style="margin-bottom:-4px" type="checkbox" disabled {{ $isColorTestNormal ? 'checked' : '' }}>
                 
                  <span>RED</span>
                  <input class="custom-input" style="margin-bottom:-4px"  type="checkbox" disabled {{ $isColorTestNormal ? 'checked' : '' }}>
                  
                  <span>GREEN</span>
                  <input  class="custom-input" style="margin-bottom:-4px" type="checkbox" disabled {{ $isColorTestNormal ? 'checked' : '' }}>
                 
                  <span>BLUE</span>
                   <input  class="custom-input" style="margin-bottom:-4px" type="checkbox" disabled {{ $isColorTestNormal ? 'checked' : '' }}>
                </span>
              </td>
            </tr>
            <tr style="height:22pt">
              <td>
                <span style="text-indent: 0pt; line-height: 9pt; text-align: left;">HEARING:</span>
                <span style="padding-left: 30pt; text-indent: 0pt; line-height: 9pt; text-align: left;">
                  RT. EAR : <span class="custom-input">{{ getTestResultLiberian(89, $specialTests) }}</span>
                </span>
                <span style="padding-left: 50px;">
                  LEFT EAR : <span class="custom-input">{{ getTestResultLiberian(90, $specialTests) }}</span>
                </span>
      </td></tr>
    </table>
          <table>
            <tr>
              <td style="width: 50%;">
                HEAD AND NECK :<span class="custom-input">{{ $systemTests[32]['value'] ?? '-' }}</span
              </td>
              <td style="width: 50%;">
                HEART (CARDIOVASCULAR): <span class="custom-input">{{ $systemTests[45]['value'] ?? '-' }}</span>
              </td>
            </tr>
            <tr>
              <td>
                LUNGS : <span class="custom-input">{{ $systemTests[42]['value'] ?? '-' }}</span>
              </td>
              <td>
                SPEECH (DECK/NAVIGATIONAL OFFICER AND RADIO OFFICER) IS SPEECH UNIMPAIRED FOR NORMAL VOICE COMMUNICATION
                ? : <span class="custom-input">{{ $systemTests[202]['value'] ?? '-' }}</span>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <span style="text-indent: 0pt;line-height: 9pt;text-align: left;">EXTREMITIES:</span>
                <span style="padding-top: 4pt;padding-left: 80pt;text-indent: 0pt;text-align: left;">
                  UPPER <span class="custom-input">{{ $systemTests[194]['value'] ?? '-' }}</span>
                  <span style="padding-left: 100pt;">LOWER <span class="custom-input">{{ $systemTests[195]['value'] ?? '-' }}</span></span>

                </span>
              </td>
            </tr>
          </table>
 @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif

    <table>
      <tr>
        <td style=" border: none;">
          IS APPLICANT SUFFERING FROM ANY DISEASE LIKELY TO BE AGGRAVATED BY, OR TO RENDER HIM UNFIT FOR SERVICE AT SEA
          OR LIKELY
          TO ENDANGER THE HEALTH OF OTHER PERSONS ON BOARD? IF YES, EXPLAIN IN DETAILS OF MEDICAL EXAMINATION ON PAGE 2.
        </td>
      </tr>

      <!-- Find this section in your code -->
      <tr>
        <td style="border: none;">
          <table style="width: 100%; border: none;">
            <tr>
              <!-- Signature Section -->
              <td style="width: 33%; border: none; text-align: center; ">
                 @if($signatureImage && $stm)
                  <img src="{{ $signatureImage }}" alt="Signature" style="height: 50px;">
                @else
                  <div style="height: 50px; margin: 0 auto;"></div>
                @endif
                <div style="margin-bottom: 0px;border-top:1px solid #000">SIGNATURE OF APPLICANT</div>
                </td>

              <!-- Date of Exam -->
              <td style="width: 33%; border: none; text-align: center; ">
                 <div class="custom-input" style="border-bottom: 1px solid #000; width: 120px; margin: 0 auto;">
                  {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? 'N/A' }}
                </div>
                <div style="margin-bottom: 0px;">DATE OF EXAM</div>
               
              </td>

              <!-- Expiry Date -->
              <td style="width: 34%; border: none; text-align: center; ">
                <div class="custom-input" style="border-bottom: 1px solid #000; width: 120px; margin: 0 auto;">
                  {{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? 'N/A' }}
                </div>
                <div style="margin-bottom: 0px;">EXPIRY DATE</div>
                
              </td>
            </tr>

          </table>
        </td>
      </tr>
            <tr> <td><span style="padding-left: 109pt; text-align: center;"> THIS SIGNATURE SHOULD BE AFFIXED IN THE PRESENCE OF
            THE EXAMINING PHYSICIAN.</span></td></tr>
          <tr>
              <td>
                  <table>
                      <tr>
            <td style="padding-top: 0px; border: none;">
                <span style="padding-left: 7pt; text-indent: 0pt; text-align: left;">
                    THIS IS TO CERTIFY THAT A PHYSICAL EXAMINATION WAS GIVEN TO:
                </span> </td>
                <td style="padding-top: 0px; border: none;">
                <span class="custom-input" style="text-indent: 0pt; margin-top:-30px;text-align: center;">
                    {{ $data->seafarer->f_name ?? '' }} 
                    {{ $data->seafarer->m_name ?? '' }} 
                    {{ $data->seafarer->l_name ?? '' }}
                </span></br>(NAME OF APPLICANT)
                
            </td>
          </tr>
          </table>
          </td>
          </tr>
     <tr>
        <td style="padding-top: 0px; border: none;">
            {{-- HE / SHE based on sex --}}
            @php
                $sex = $data->seafarer->sex;
                $gender = strtolower($data->seafarer->sex);
                $isFit = $data->medicalApproval->is_fit;
                $watchstanderStatus = strtolower($data->medicalApproval->watchstander_status ?? '');
                $rankName = strtoupper($data->rank->category);
                
            @endphp

            {{-- HE / SHE --}}
            @if($sex == 1)
                <span style="text-decoration: underline;">HE</span>
            @else
                <span style="text-decoration: underline;">SHE</span>
            @endif

            IS FOUND TO BE

            {{-- FIT / NOT FIT --}}
            @if($isFit == 1)
                <span style="text-decoration: underline;">FIT</span>
            
            @else
                <span style="text-decoration: underline;">NOT FIT</span>
            @endif

            FOR DUTY AS A:

            {{-- Roles --}}
            @if(!empty($data->rank->category))
                <span style="text-decoration: underline;">{{ strtoupper($data->rank->category) }}</span>.
            @else
                <span style="color: silver;">[No Rank Assigned]</span>.
            @endif


            IF EMPLOYED AS A WATCHSTANDER

            {{-- HE / SHE again --}}
            @if($gender == 1)
                <span style="text-decoration: underline;">HE</span>
            @else
                <span style="text-decoration: underline;">SHE</span>
            @endif

            IS FOUND TO BE

            {{-- Watchstander FIT / NOT FIT --}}
            @if($isLookoutNormal)
                <span style="text-decoration: underline;">FIT</span>
            @else
                <span style="text-decoration: underline;">NOT FIT</span>
            @endif

            FOR LOOKOUT DUTIES?
            
           
        </td>
    </tr>

 
       
<table>
    <tr>
        <td style="border: none;" colspan="2">
            NAME AND DEGREE OF PHYSICIAN : 
            <span class="custom-input">
                {{ $data->employee->emp_name ?? '-' }} - 
                {{ $data->employee->degree ?? '' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            ADDRESS : 
            <span class="custom-input">
               {{ $data->clinic->add ?? '-' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            NAME OF PHYSICIAN'S CERTIFICATING AUTHORITY : 
            <span class="custom-input">
                {{ $data->employee->certificate_issued_by ?? 'N/A' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            DATE OF ISSUE OF PHYSICIAN'S CERTIFICATE : 
            <span class="custom-input">
                @if($data->employee->certificate_issue_date)
                    {{ \Carbon\Carbon::parse($data->employee->certificate_issue_date)->format('d / m / Y') }}
                @else
                    N/A
                @endif
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;">
            SIGNATURE OF PHYSICIAN : 
            <span>
           
                
                 @if(isset($stm))
                     <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->sign_upload))) }}" alt="Doctor Signature" style="width: 80px; height: 80px;margin:auto">
                    @else
                    <div style="height: 50px; margin: 0 auto;"></div>
                    @endif
                    
                    
            </span>
        </td>
        <td style="border: none;">
           
                 @if(isset($stm))
          
                     <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->stamp_upload))) }}" style="width: 80px; height: 80px;">
                    
                    @else
                  
                    @endif
                    
                     DATE OF EXAMINATION : 
            <span class="custom-input">
                {{ \Carbon\Carbon::parse($data->medicalApproval->issue_date)->format('d / m / Y') ?? 'N/A' }}
            </span>
             
        </td>
    </tr>
</table>

    <table>
      <tr>
        <td
          style=" border: none; font-size: 8px; padding-top: 0px; text-align: center; ">
          This certificate is issued by authority of the Deputy Commissioner of Maritime Affairs, R.L. and in compliance
          with the requirements of the Maritime Labour Convention, 2006 for the Medical Examination of Seafarers. The
          Medical Certificate shall be valid for no more than two (2) years from the date of the Examination for those
          over 18 years of age and for no more than one (1) year for those under 18 years of age.</td>
      </tr>
    </table>
  </div>

<table style="width: 100%; border: none;">
            <tr>
                <td style="width: 33%; border: none; text-align: left; ">
                    <div class="mp-0">RLM-l05M ANNEX 2</div>
                </td>
                <td style="width: 33%; border: none; text-align: center; ">
                      <div class="mp-0">1 of 2</div>
                </td>
                <td style="width: 34%; border: none; text-align: right; ">
                <div class="mp-0">Rev0 - 09/01/2023</div>
                  </td>
            </tr>
</table>
 
  <div class="page-break"></div>

  <div style="border: solid 2px #000;">

    <table style="padding-left: 25px; padding-right: 25px;">
      <tr>
        <td style=" border: none; text-align: center; font-weight: bold;">MEDICALREQUIREMENT</td>
      </tr>
      <tr>
        <td style=" border: none;">All applicants for an officer certificate, Seafarer's Identification and Record Book
          or certification of special
          qualifications shall be required to have a physical examination reported on this Medical Form completed by a
          certificated physician. The completed medical form must accompany the application for officer certificate,
          application
          for seafarer's identity document, or application for certification of special qualifications. This physical
          examination
          must be carried out not more than 12 months prior to the date of making application for an officer
          certificate,
          certification of special qualifications or a seafarer's book. Such proof of examination must establish that
          the applicant
          is in satisfactory physical condition for the specific duty assignment undertaken and is generally in
          possession of
          all body faculties necessary in fulfilling the requirements of the seafaring profession. In addition, the
          following
          minimum requirements shall apply:</td>
      </tr>
      <tr>
        <td style=" border: none;">
            <ol type="a">
            <li> All applicants must have hearing unimpaired for normal sounds and be capable of
          hearing a whispered
          voice in the better ear at 15 feet and in the poorer ear at 5 feet.</li>
    <li> Deck officer applicants must have (either with or without glasses) at least 20/20
          vision in one eye and at
          least 20/40 in the other. If the applicant wears glasses, he must have vision without glasses of at least
          20/160 in both eyes. Deck officer applicants must also have normal color perception and be capable of
          distinguishing the colors red, green, blue and yellow.</li>
    <li>Engineer and radio officer applicants must have (either with or without glasses)
          at least 20/30 vision in one
          eye and at least 20/50 in the other. If the applicant wears glasses, he must have vision without glasses of at
          least 20/200 in both eyes. Engineer and radio officer applicants must also be able to perceive the colors red,
            yellow and green.</li>
   <li> An applicant's blood pressure must fall within an average range, taking age into
          consideration.</li>
   <li> Applicants afflicted with any of the following diseases or conditions shall be
          disqualified: epilepsy,
          insanity, senility, alcoholism, tuberculosis, acute venereal disease or neurosyphilis, AIDS and/or the use of
          narcotics.</li>
     <li> Deck/Navigational officer applicants and Radio officer applicants must have
          speech which is unimpaired
          for normal voice communication.</li>
     <li>Applicants for able seafarer deck, bosun, GP-1, ordinary seaman and junior
          ordinary seaman must meet
          the physical requirements for a deck/navigational officer's certificate.</li>
  <li>Applicants for fireman/watertender, oiler/motorman, able seafarer engine pumpman,
          electrician, wiper,
          tankerman and survival craft/rescue boat crewman must meet the physical requirements for an engineer
          officer's certificate.</li>
          </ol>
          </td>
      </tr>
    </table>



    <div class="exam-section">
      DETAILS OF MEDICAL EXAMINATION <br><small>(To be completed by examining physician)</small>
    </div>

 


<div class="overlay-wrapper">
    <!-- Table Placeholder -->
    <table class="exam-details">
        <tr><td>{{ $systemTests[171]['value'] ?? '-' }}</td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
        <tr><td></td></tr>
    </table>

    <!-- Overlayed Signature + Stamp -->
    <div class="signature-stamp-container">
        @if(isset($stm))
            <div style="text-align: center;">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->sign_upload))) }}" alt="Doctor Signature">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->stamp_upload))) }}" alt="Stamp">
                </br><span class="signature-label">
                    {{ $data->employee->emp_name }}<br>Medical Examiner
                </span>
      
                
            </div>
        @else
            <div style="text-align: center;">
                <div class="signature-label">
                    {{ $data->employee->emp_name }}<br>Medical Examiner
                </div>
            </div>
            <div></div>
        @endif
    </div>
</div>



  </div>
<table style="width: 100%; border: none;">
            <tr>
                <td style="width: 33%; border: none; text-align: left; ">
                    <div class="mp-0">RLM-l05M ANNEX 2</div>
                </td>
                <td style="width: 33%; border: none; text-align: center; ">
                      <div class="mp-0">2 of 2</div>
                </td>
                <td style="width: 34%; border: none; text-align: right; ">
                <div class="mp-0">Rev0 - 09/01/2023</div>
                  </td>
            </tr>
</table>
</body>

</html>