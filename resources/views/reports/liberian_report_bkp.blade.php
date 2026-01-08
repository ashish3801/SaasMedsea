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
      font-family: Arial, sans-serif;
      font-size: 12px;
      margin: 15px;
    }

    h2,
    h3 {
      text-align: center;
      margin: 0;
    }

    h2 {
      margin-bottom: 20px;
      text-transform: uppercase;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 5px;
    }

    td,
    th {
      border: 1px solid #000;
      padding: 4px;
      vertical-align: top;
    }

    .section-header {
      background-color: #d9d9d9;
      font-weight: bold;
      text-align: center;
    }

    .input-cell {
      height: 30px;
    }

    /* .checkbox-label {
      display: inline-flex;
      align-items: center;
      margin-right: 20px;
    } */

    input[type="checkbox"] {
      vertical-align: middle;
      margin-right: 4px;
    }

    .checkbox-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 28px;
      margin-top: 10px;
    }

    .content-box {
      border: 1px solid #000;
      padding: 20px;
      line-height: 1.5;
      margin-top: 20px;
    }

    ol.alpha {
      list-style-type: lower-alpha;
      margin-left: 20px;
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
    .checkbox-label {
      display: inline-flex;
      align-items: center;
      margin-right: 20px;
      cursor: pointer;
    }

    .styled-checkbox {
      opacity: 0;
      position: absolute;
    }

    .checkbox-custom {
      display: inline-block;
      width: 16px;
      height: 16px;
      border: 1px solid #000;
      margin-right: 8px;
      position: relative;
      vertical-align: middle;
    }

    .styled-checkbox:checked + .checkbox-custom::after {
      content: "✔";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      font-size: 14px;
      color: #000;
    }

    .signature-box {
      border-bottom: 1px solid #000;
      width: 150px;
      height: 40px;
      margin-top: 5px;
    }
     body {
        font-family: 'DejaVu Sans', sans-serif;
    }
  </style>
</head>

<body>
  <div style="border: solid 2px #000;">
    <h2>PHYSICAL EXAMINATION REPORT/CERTIFICATE</h2>
    <h3>DEPUTY COMMISSIONER OF MARITIME AFFAIRS - ANNEX 2</h3>
    <h3>THE REPUBLIC OF LIBERIA</h3>


    <table style="width: 100%;">
      <tr>
        <td style="width: 35%;"><strong>LAST NAME OF APPLICANT</strong>
          <br />
          <span style="font-size: 14px; margin-top: 10px;">{{ $data->seafarer->l_name }}</span>
        </td>
        <td style="width: 35%;"><strong>FIRST NAME</strong>
          <br />
          <span style="font-size: 14px; margin-top: 10px;">{{ $data->seafarer->f_name }}</span>
        </td>
        <td style="width: 30%;"><strong>MIDDLE INITIAL</strong>
          <br />
          <span style="margin-top: 10px;">{{ $data->seafarer->m_name }}</span>
        </td>
      </tr>
        @php
              $dob = \Carbon\Carbon::parse($data->seafarer->dob);
          @endphp
      <tr>
      <!-- Date of Birth Block -->
      <td>
        <strong>DATE OF BIRTH</strong>
        <table style="width: 100%; border: none;">
          <tr>
            <td style="border: none;">MONTH</td>
            <td style="border: none;">DAY</td>
            <td style="border: none;">YEAR</td>
          </tr>
          <tr>
            <td style="border: none; font-size: 14px;">{{ $dob->format('F') }}</td>
            <td style="border: none; font-size: 14px;">{{ $dob->format('j') }}</td>
            <td style="border: none; font-size: 14px;">{{ $dob->format('Y') }}</td>
          </tr>
        </table>
      </td>

        <!-- Place of Birth Block -->
        <td>
          <strong>PLACE OF BIRTH</strong>
          <table style="width: 100%; border: none;">
            <tr>
              <td style="border: none;">CITY</td>
              <td style="border: none;">COUNTRY</td>
            </tr>
            <tr>
              <td style="border: none; font-size: 14px;">-</td>
              <td style="border: none; font-size: 14px;">India</td>
            </tr>
          </table>
        </td>

        <!-- Sex Block -->
        <td>
          <strong>SEX</strong>
          <div style="margin-top: 5px;">
            <span style="margin-right: 20px; font-size: 14px;">
              @if($data->seafarer->sex == 1)
                ☑ Male
              @else
                ☐ Male
              @endif
            </span>
            
            <span style="font-size: 14px;">
              @if($data->seafarer->sex == 2)
                ☑ Female
              @else
                ☐ Female
              @endif
            </span>
          </div>
        </td>
      </tr>

      </table>
    <table style="width: 100%;">
      <tr>
        <!-- Examination block -->
        <td style="width: 50%; vertical-align: top;">
          <strong>EXAMINATION FOR DUTY AS:</strong>
          <table style="width: 100%; border: none; margin-top: 5px;">
            <tr>
              <td style="border: none;">MASTER</td>
              <td style="border: none;"><input type="checkbox"></td>
              <td style="border: none;">RATING</td>
              <td style="border: none;"><input type="checkbox"></td>
            </tr>
            <tr>
              <td style="border: none;">MATE</td>
              <td style="border: none;"><input type="checkbox"></td>
              <td style="border: none;">MOU DECK</td>
              <td style="border: none;"><input type="checkbox"></td>
            </tr>
            <tr>
              <td style="border: none;">ENGINEER</td>
              <td style="border: none;"><input type="checkbox"></td>
              <td style="border: none;">MOU ENGINE</td>
              <td style="border: none;"><input type="checkbox"></td>
            </tr>
            <tr>
              <td style="border: none;">RADIO OFF</td>
              <td style="border: none;"><input type="checkbox"></td>
              <td style="border: none;">SUPERNUMERARY</td>
              <td style="border: none;"><input type="checkbox"></td>
            </tr>
          </table>
        </td>

        <!-- Mailing Address block -->
        <td style="width: 50%; vertical-align: top;">
          <strong>MAILING ADDRESS OF APPLICANT:</strong>
          <div style="margin-top: 5px; font-size: 14px;">
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
                    <span style="margin-top: 10px;">
                        {{ $physicalResults[$key] ?? 'N/A' }}
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
    @once
      @php
          function getTestResult($id, $specialTests) {
              return $specialTests['by_id'][$id] ?? '-';
          }
      @endphp
  @endonce
    <table>
      <tr>
        <td>
          <table>
            <tr>
              <td style="border: none;">
                <table style="width: 100%;">
                  <tr>
                    <td style="border: none; width: 20%;">VISION</td>
                    <td style="border: none; width: 20%;">RIGHT EYE</td>
                    <td style="border: none; width: 60%;">LEFT EYE</td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITHOUT GLASSES</td>
                    <td style="border: none;">{{ getTestResult(48, $specialTests) }} / {{ getTestResult(52, $specialTests) }}</td>
                    <td style="border: none;">{{ getTestResult(49, $specialTests) }} / {{ getTestResult(53, $specialTests) }}</td>
                  </tr>
                  <tr>
                    <td style="border: none;">WITH GLASSES</td>
                    <td style="border: none;">{{ getTestResult(56, $specialTests) }} / {{ getTestResult(59, $specialTests) }}</td>
                    <td style="border: none;">{{ getTestResult(57, $specialTests) }} / {{ getTestResult(60, $specialTests) }}</td>
                  </tr>
                </table>


              </td>
            </tr>
            <tr>
              <td style="border: none;">
                <table style="width: 100%;">
                  <tr>
                    <td style="border: none;">
                      DATE OF LAST COLOR VISION TEST(Month/Day/Year):
                      <span style="font-size: 14px; font-weight: bold;">
                        {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '' }}
                      </span>
                      <span style="padding-left: 100px; margin-top:10px;">Testing Required every 6 years</span>
                    </td>
                  </tr>
                  <tr>
                    <td style="border: none;">
                      COLOR VISION MEETSSTANDARDS IN STCW CODE, TABLE A-I/9 ?
                       <label><input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">YES</span></label>
                      <label><input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">NO</span></label>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                COLOR TEST TYPE: BOOK ¨ LANTERN ¨ CHECK IF COLOR TEST IS NORMAL
                <span style="padding-left: 30px;">
                  <input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">YELLOW</span>
                  <input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">RED</span>
                  <input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">GREEN</span>
                  <input type="checkbox"> <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">BLUE</span>
                
                </span>
              </td>
            </tr>
            <tr style="height:22pt">
              <td>
                <span style="text-indent: 0pt; line-height: 9pt; text-align: left;">HEARING:</span>
                <span style="padding-left: 30pt; text-indent: 0pt; line-height: 9pt; text-align: left;">
                  RT. EAR : <span>{{ getTestResult(89, $specialTests) }}</span>
                </span>
                <span style="padding-left: 50px;">
                  LEFT EAR : <span>{{ getTestResult(90, $specialTests) }}</span>
                </span>
              </td>
            </tr>
          </table>

          <table>
            <tr>
              <td style="width: 40%;">
                HEAD AND NECK :<strong>{{ $systemTests[32]['value'] ?? '-' }}</strong>
              </td>
              <td style="width: 60%;">
                HEART (CARDIOVASCULAR): <strong>{{ $systemTests[45]['value'] ?? '-' }}</strong>
              </td>
            </tr>
            <tr>
              <td>
                LUNGS : <strong>{{ $systemTests[42]['value'] ?? '-' }}</strong>
              </td>
              <td>
                SPEECH (DECK/NAVIGATIONAL OFFICER AND RADIO OFFICER) IS SPEECH UNIMPAIRED FOR NORMAL VOICE COMMUNICATION
                ? : <strong>Normal</strong>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <span style="text-indent: 0pt;line-height: 9pt;text-align: left;">EXTREMITIES:</span>
                <span style="padding-top: 4pt;padding-left: 80pt;text-indent: 0pt;text-align: left;">
                  UPPER <span> <strong>Normal</strong> </span>
                  <span style="padding-left: 100pt;">LOWER <span> <strong>Normal</strong></span></span>

                </span>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>

    <table>
      <tr>
        <td style=" border: none;">
          IS APPLICANT SUFFERING FROM ANY DISEASE LIKELY TO BE AGGRAVATED BY, OR TO RENDER HIM UNFIT FOR SERVICE AT SEA
          OR LIKELY
          TO ENDANGER THE HEALTH OF OTHER PERSONS ON BOARD? IF YES, EXPLAIN IN DETAILS OF MEDICAL EXAMINATION ON PAGE 2.
        </td>
      </tr>

      {{-- <tr>
        <td style=" border: none; padding-top:70px;">
          <span style="padding-left: 50pt; text-align: left; margin-top: 50px;">
            SIGNATURE OF APPLICANT </span>
          <span style="padding-left: 50pt; text-align: left; margin-top: 50px;">
            DATE OF EXAM </span>
          <span style="padding-left: 75pt; text-align: left; margin-top: 50px;">
            EXPIRY DATE </span>


          </span>
        </td>
      </tr> --}}

      <!-- Find this section in your code -->
      <tr>
        <td style=" border: none; padding-top:30px;">
          <div style="display: flex; justify-content: space-between; align-items: center; padding: 0 50px;">
            <!-- Signature Section -->
            <div style="text-align: center;">
              <div style="margin-bottom: 5px;">SIGNATURE OF APPLICANT</div>
                    @if($signatureImage)
                        <img src="{{ $signatureImage }}" alt="Signature" style="height: 30px; display: block;">
                    @else
                        <div style="border-bottom: 1px solid #000; width: 150px;">&nbsp;</div>
                    @endif
            </div>

            <!-- Date of Exam -->
            <div style="text-align: center;">
              <div style="margin-bottom: 5px;">DATE OF EXAM</div>
              <div style="border-bottom: 1px solid black; width: 120px; padding: 5px;">
                {{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? 'N/A' }}
              </div>
            </div>

            <!-- Expiry Date -->
            <div style="text-align: center;">
              <div style="margin-bottom: 5px;">EXPIRY DATE</div>
              <div style="border-bottom: 1px solid black; width: 120px; padding: 5px;">
                 {{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? 'N/A' }}
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <td style="padding-top: 15px; border: none;">
          <span style="padding-left: 109pt; text-align: center;"> THIS SIGNATURE SHOULD BE AFFIXED IN THE PRESENCE OF
            THE EXAMINING PHYSICIAN.</span>
        </td>
      </tr>

      <tr>
          <td style="padding-top: 15px; border: none;">
              <p style="padding-left: 7pt; text-indent: 0pt; text-align: left;">
                  THIS IS TO CERTIFY THAT A PHYSICAL EXAMINATION WAS GIVEN TO:
              </p>
              <p style="padding-left: 331pt; text-indent: 0pt; text-align: left;">
                  {{ $data->seafarer->f_name ?? '' }} 
                  {{ $data->seafarer->m_name ?? '' }} 
                  {{ $data->seafarer->l_name ?? '' }}
              </p>
              <p style="padding-left: 331pt; text-indent: 0pt; text-align: left;">
                  (NAME OF APPLICANT)
              </p>
          </td>
      </tr>

     <tr>
    <td style="padding-top: 15px; border: none;">
        @if($data->seafarer->sex == 1)
        <span style="text-decoration: underline;">HE</span>
        @else
        <span style="color: silver;">HE</span>
        @endif
        
        @if($data->seafarer->sex == 2)
        <span style="text-decoration: underline;">SHE</span>
        @else
        <span style="color: silver;">SHE</span>
        @endif
        
        IS FOUND TO BE 
        
        @if($data->medicalApproval->is_fit == 1)
        <span style="text-decoration: underline;">FIT</span>
        @else
        <span style="color: silver;">FIT</span>
        @endif
        
        @if($data->medicalApproval->is_fit == 0)
        <span style="text-decoration: underline;">NOT FIT</span>
        @else
        <span style="color: silver;">NOT FIT</span>
        @endif
        
        FOR DUTY AS A: 
        
        @foreach(['MASTER', 'MATE', 'ENGINEER', 'RADIO OFFICER', 'RATING', 'MOU DECK', 'MOU ENGINE', 'SUPERNUMERARY'] as $role)
            {{-- @if(in_array($role, $data->medicalApproval->approved_roles))
            <span style="text-decoration: underline;">{{ $role }}</span>@if(!$loop->last), @endif
            @else
            <span style="color: silver;">{{ $role }}</span>@if(!$loop->last), @endif
            @endif --}}
        @endforeach.
        
        IF EMPLOYED AS A WATCHSTANDER 
        @if($data->seafarer->gender == 'male')
        <span style="text-decoration: underline;">HE</span>
        @else
        <span style="color: silver;">HE</span>
        @endif
        
        @if($data->seafarer->gender == 'female')
        <span style="text-decoration: underline;">SHE</span>
        @else
        <span style="color: silver;">SHE</span>
        @endif
        
        IS FOUND TO BE 
        
        @if($data->medicalApproval->watchstander_status == 'fit')
        <span style="text-decoration: underline;">FIT</span>
        @else
        <span style="color: silver;">FIT</span>
        @endif
        
        @if($data->medicalApproval->watchstander_status == 'not_fit')
        <span style="text-decoration: underline;">NOT FIT</span>
        @else
        <span style="color: silver;">NOT FIT</span>
        @endif
        
        FOR LOOKOUT DUTIES?
    </td>
</tr>

<table>
    <tr>
        <td style="border: none;" colspan="2">
            NAME AND DEGREE OF PHYSICIAN : 
            <span style="padding-left: 20px;">
                {{ $data->medicalApproval->physician->name ?? 'N/A' }} - 
                {{ $data->medicalApproval->physician->degree ?? '' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            ADDRESS : 
            <span style="padding-left: 20px;">
                {{ $data->medicalApproval->physician->address ?? 'N/A' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            NAME OF PHYSICIAN'S CERTIFICATING AUTHORITY : 
            <span style="padding-left: 20px;">
                {{ $data->medicalApproval->physician->certifying_authority ?? 'N/A' }}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2">
            DATE OF ISSUE OF PHYSICIAN'S CERTIFICATE : 
            <span style="padding-left: 20px;">
                {{-- @if($data->medicalApproval->physician->certificate_issue_date)
                    {{ \Carbon\Carbon::parse($data->medicalApproval->physician->certificate_issue_date)->format('d / m / Y') }}
                @else
                    N/A
                @endif --}}
            </span>
        </td>
    </tr>
    <tr>
        <td style="border: none;">
            SIGNATURE OF PHYSICIAN : 
            <span style="padding-left: 20px;">
                @if($doctorSign)
                    <img src="{{ $doctorSign }}" style="height: 30px;">
                @else
                    N/A
                @endif
            </span>
        </td>
        <td style="border: none;">
            DATE OF EXAMINATION : 
            <span style="padding-left: 20px;">
                {{-- {{ \Carbon\Carbon::parse($data->medicalApproval->issue_date)->format('d / m / Y') ?? 'N/A' }} --}}
            </span>
        </td>
    </tr>
</table>

    <table>
      <tr>
        <td
          style=" border: none; font-size: 12px; padding-left: 30px;  padding-right: 30px; padding-top: 15px; text-align: center; ">
          This certificate is issued by authority of the Deputy Commissioner of Maritime Affairs, R.L. and in compliance
          with the requirements of the Maritime Labour Convention, 2006 for the Medical Examination of Seafarers. The
          Medical Certificate shall be valid for no more than two (2) years from the date of the Examination for those
          over 18 years of age and for no more than one (1) year for those under 18 years of age.</td>
      </tr>
    </table>
  </div>


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
        <td style=" border: none;">(a) All applicants must have hearing unimpaired for normal sounds and be capable of
          hearing a whispered
          voice in the better ear at 15 feet and in the poorer ear at 5 feet.</td>
      </tr>
      <tr>
        <td style=" border: none;">(b) Deck officer applicants must have (either with or without glasses) at least 20/20
          vision in one eye and at
          least 20/40 in the other. If the applicant wears glasses, he must have vision without glasses of at least
          20/160 in both eyes. Deck officer applicants must also have normal color perception and be capable of
          distinguishing the colors red, green, blue and yellow.</td>
      </tr>
      <tr>
        <td style=" border: none;">(c) Engineer and radio officer applicants must have (either with or without glasses)
          at least 20/30 vision in one
          eye and at least 20/50 in the other. If the applicant wears glasses, he must have vision without glasses of at
          least 20/200 in both</td>
      </tr>
      <tr>
        <td style=" border: none;">(d) An applicant's blood pressure must fall within an average range, taking age into
          consideration.</td>
      </tr>
      <tr>
        <td style=" border: none;">(e) Applicants afflicted with any of the following diseases or conditions shall be
          disqualified: epilepsy,
          insanity, senility, alcoholism, tuberculosis, acute venereal disease or neurosyphilis, AIDS and/or the use of
          narcotics.</td>
      </tr>
      <tr>
        <td style=" border: none;">(f) Deck/Navigational officer applicants and Radio officer applicants must have
          speech which is unimpaired
          for normal voice communication.</td>
      </tr>
      <tr>
        <td style=" border: none;">(g) Applicants for able seafarer deck, bosun, GP-1, ordinary seaman and junior
          ordinary seaman must meet
          the physical requirements for a deck/navigational officer's certificate.</td>
      </tr>
      <tr>
        <td style=" border: none;">(h) Applicants for fireman/watertender, oiler/motorman, able seafarer engine pumpman,
          electrician, wiper,
          tankerman and survival craft/rescue boat crewman must meet the physical requirements for an engineer
          officer's certificate.</td>
      </tr>
    </table>



    <div class="exam-section">
      DETAILS OF MEDICAL EXAMINATION <br><small>(To be completed by examining physician)</small>
    </div>

    <table class="exam-details">
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    </table>

  </div>

</body>

</html>