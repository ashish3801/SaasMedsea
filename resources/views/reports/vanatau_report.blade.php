 @php
    function getTestResult($id, $specialTests) {
        return $specialTests['by_id'][$id] ?? '-';
    }
@endphp
<!DOCTYPE html>
<html>
<head>
  <title>Vanuatu Physical Examination Report</title>
  <style>
    @page {
      size: A4;
      margin: 0;
    }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      font-size: 14px;
    }

    table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
  </style>
</head>
<body style="font-family: Arial, sans-serif; font-size: 14px; margin: 20px;">

  <!-- HEADER -->
  <table border="1" cellspacing="0" cellpadding="8" style="width: 100%; border-collapse: collapse; border:1.2pt solid #0C0C0C;">
    <tr>
      <td colspan="2" style="width: 50%; text-align: center; font-weight: bold;  font-size: 18px; padding: 15px 0px;">
        <span style=" font-size: 14px;">form med1–a</span>
        <br>PHYSICAL EXAMINATION REPORT / CERTIFICATE
      </td>
      <td colspan="2" style="width: 50%; text-align: center; font-weight: bold; font-size: 18px; padding: 15px 0px;">
        REPUBLIC OF VANUATU<br>PORT VILA, VANUATU
      </td>
    </tr>
  </table>

  <p style="font-weight: bold; text-align:left;">INSTRUCTIONS</p>
  <div class="textbox" style="border:1.2pt solid #0C0C0C;">
    <div style="padding-top: 1pt; padding: 4pt; text-indent: 0pt;line-height: 93%;text-align: justify;">
        All applicants for a Vanuatu License or Seaman Identification Book shall be required to have a physical
        examination reported on the Vanuatu Medical Form MED1 by a licensed physician. The completed medical form
        must accompany the application for a License or Seaman&#39;s Identity document. The physical examination
        must be carried out nor more <i>than </i>one year prior to the date of making application. Such proof of
        examination must establish that the applicant is in satisfactory physical condition for the specific duty
        assignment undertaken and is generally in possession of all body faculties necessary in fulfilling the
        requirements of the seafaring profession. In addition, the following minimum requirements shall apply:</div>

    <div style="padding: 4pt;">1) All applicants must have hearing unimpaired for normal sounds.</div>
    <div style="padding: 4pt;">2) All applicants must have average blood pressure, taking age into consideration.</div>
    <div style="padding: 4pt;">3) Applicants afflicted with or having medical histories, including the following shall be disqualified for a license:</div> 
    <div style="padding-left: 12pt;">Epilepsy, insanity, senility, acute alcoholism, tuberculosis, acute venereal disease or neurosyphilis and/or use of narcotics.</div>

    <div style="padding-top: 5pt;padding-bottom: 5pt; padding-left: 4pt;padding-right: 4pt;text-indent: 0pt;text-align: justify; font-weight:bold;">THIS CERTIFICATE ISSUED BY THE AUTHORITY OF  THE DEPUTY COMMISSIONER OF MARITIME AFFAIRS, THE REPUBLIC OF VANUATU AND IN COMPLIANCE WITH THE REQUIREMENTS OF  THE  MARITIME LABOR CONVENTION, 2006  FOR THE MEDICAL  EXAMINATION  OF SEAFARERS. THE MEDICAL  CERTIFICAE SHALL BE VALID FOR NO MORE  THAN TWO (2) YEARS FROM THE  DATE OF THE EXAMINATION FOR THOS OVER  18  YEARS OF AGE AND FOR NO MORE THAN ONE (1) YEAR FOR THOSE UNDER 18 YEARS OF AGE.
    </div>
  </div>

  <p style="font-weight: bold; text-align:left;">I. PARTICUI-ARS OF THE APPUCANT</p>
  <table border="1" cellspacing="0" cellpadding="0" style="width: 100%; border:1.2pt solid #0C0C0C;">
    <tr>
        <td style="padding-left: 4pt;">
            Examination for Duty as (check one)
        </td>
        @php
            $rankCategory = strtolower($data->rank->category ?? '');
        @endphp

        <td colspan="2" style="padding: 8pt;">
            <label>
                <input type="checkbox" {{ $rankCategory == 'master' ? 'checked' : '' }}>
                <span style="margin-bottom: 2px; display: inline-block;">Master</span>
            </label>

            <label>
                <input type="checkbox" {{ $rankCategory == 'navigating officer' ? 'checked' : '' }}>
                <span style="margin-bottom: 2px; display: inline-block;">Navigating Officer</span>
            </label>

            <label>
                <input type="checkbox" {{ $rankCategory == 'engineer' ? 'checked' : '' }}>
                <span style="margin-bottom: 2px; display: inline-block;">Engineer</span>
            </label>

            <label>
                <input type="checkbox" {{ $rankCategory == 'radio officer' ? 'checked' : '' }}>
                <span style="margin-bottom: 2px; display: inline-block;">Radio Officer</span>
            </label>

            <label>
                <input type="checkbox" {{ $rankCategory == 'seaman' ? 'checked' : '' }}>
                <span style="margin-bottom: 2px; display: inline-block;">Seaman</span>
            </label>
        </td>

    </tr>
    <tr>
        <td style="padding-left: 4pt; text-align:center;">
            Last / Family / Surname Name <br />
            <span style="padding-left: 4pt;text-indent: 0pt;text-align: center;"> {{ strtoupper($data->seafarer->l_name ?? '-') }}</span>
        </td>
        <td style=" text-align:center;">
            First I Given Name <br />
            <span style="padding-left: 4pt;text-indent: 0pt;text-align: center;"> {{ strtoupper($data->seafarer->f_name ?? '-') }}</span>
        </td>
        <td style=" text-align:center;">
            Middle Name(s) <br />
            <span style="padding-left: 4pt;text-indent: 0pt;text-align: center;"> {{ strtoupper($data->seafarer->m_name ?? '-') }}</span>
          </td>
        </tr>
        <tr>
          <td style=" text-align:center;">
            Birth Date (MM/DD/YY)
            <p style="padding-top: 1pt;padding-left: 20pt;padding-right: 20pt;text-indent: 0pt;text-align: center;"> {{ \Carbon\Carbon::parse($data->seafarer->dob)->format('m/d/Y') ?? '-' }}</p>
        </td>
        <td colspan="2"  style=" text-align:center;">
          Place of Birth (City &amp; Country)
          <p style=" padding-top: 1pt;padding-left: 20pt;padding-right: 20pt; text-indent: 0pt;text-align: center;">{{ strtoupper($data->seafarer->pob ?? '') }},{{ strtoupper($data->seafarer->boc ?? '') }},</p>
        </td>
    </tr>
  </table>

  <p style="font-weight: bold; text-align:left;">II. GENERAL MEDICAL CONDITION</p>
  <table border="1" cellspacing="0" cellpadding="0" style="width: 100%; border:1.2pt solid #0C0C0C;">
    <tr>
      <td style="padding-left: 4pt; text-align:center;">
        Height <br />
        <span>{{ $physicalResults[25] ?? '-' }}</span>
      </td>
      <td style=" text-align:center;">
        Weight <br />
        <span>{{ $physicalResults[26] ?? '-' }}</span>
      </td>
      <td style=" text-align:center;">
        Blood Pressure <br />
        <span>{{ $physicalResults[28] ?? '-' }}</span>
      </td>
      <td style="padding-left: 4pt; text-align:center;">
        Pulse <br />
        <span>{{ $physicalResults[29] ?? '-' }}</span>
      </td>
      <td style=" text-align:center;" colspan="2">
        Respiration <br />
        <span>{{ $physicalResults[30] ?? '-' }}</span>
      </td>
      <td style=" text-align:center;" colspan="2">
        Genera! Appearance <br />
        <span>{{ $physicalResults[31] ?? '-' }}</span>
      </td>
    </tr>
    @php
        $fit = $data->medicalApproval->is_fit == 1;
        $unfit = $data->medicalApproval->is_fit == 0;
    @endphp

    <tr>
        <td colspan="8" style="width:100%;">
            <table style="width:100%;">
                <tr>
                    <td style="width:50%; border: none; padding: 5px;">
                        Is the applicant suffering from any disease likely to be aggravated
                        by or render him unfit for service at sea or likely to endanger the health of other persons on board?
                    </td>
                    <td style="width:55%; border: none; padding: 5px;">
                        <label style="display: block; margin: 4px 0;">
                            <input type="checkbox"
                                  style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                                  {{ $fit ? 'checked' : '' }}>
                            <span style="vertical-align: middle;">NO</span>

                            <input type="checkbox"
                                  style="width:15px; height:15px; margin-left:20px; margin-right:8px; vertical-align: middle;"
                                  {{ $unfit ? 'checked' : '' }}>
                            <span style="vertical-align: middle;">YES / If YES, enter details below.</span>
                        </label>
                    </td>
                </tr>
            </table>
        </td>
    </tr>


    <tr>
        <td rowspan="3"  style="padding-left: 4px; padding-top: 5px;"> 
          VISION
        </td>
        <td style="padding-left: 4px; padding-top: 5px;">
            Without Glasses <br />
            <span>(Uncorrected)</span>
        </td>
        <td style="padding-left: 4px; padding-top: 5px;">
            Right Eye <br />
            <span>{{ getTestResult(48, $specialTests) }} / {{ getTestResult(52, $specialTests) }}</span>
        </td>
        <td style="padding-left: 4px; padding-top: 5px;">
            Left Eye <br />
            <span>{{ getTestResult(49, $specialTests) }} / {{ getTestResult(53, $specialTests) }}</span>
        </td>
        <td style="padding-left: 4px; padding-top: 5px;">
            With Glasses <br />
            <span>(Corrected)</span>
        </td>
        <td style="padding-left: 4px; padding-top: 5px;">
            Right Eye
            <span>{{ getTestResult(56, $specialTests) }} / {{ getTestResult(59, $specialTests) }}</span>
        </td>
        <td style="padding-left: 4px; padding-top: 5px;" colspan="2">
            Left Eye <br>
            <span>{{ getTestResult(57, $specialTests) }} / {{ getTestResult(60, $specialTests) }}</span>
        </td>
    </tr>
   <tr>
        <td style="padding-left: 4px; padding-top: 5px;">Test Type</td>
        <td colspan="6"> 
            <span style="margin-right: 20px;">
                <input type="checkbox" 
                      style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                      disabled
                      {{ getTestResult(71, $specialTests) ? 'checked' : '' }}>
                Book
            </span> 
            <span>
                <input type="checkbox"
                      style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                      disabled
                      {{ getTestResult(72, $specialTests) ? 'checked' : '' }}>
                Lantern Color
            </span>
        </td>
    </tr>

    <tr>
        <td style="padding-left: 4px; padding-top: 5px;">Color</td>
        <td colspan="6"> 
            @php
                $isColorNormal = strtolower(getTestResult(71, $specialTests)) === 'normal' || 
                                strtolower(getTestResult(72, $specialTests)) === 'normal';
            @endphp

            <span style="margin-right: 15px;">
                <input type="checkbox" 
                      style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                      disabled
                      {{ $isColorNormal ? 'checked' : '' }}>
                Red
            </span> 
            <span style="margin-right: 15px;">
                <input type="checkbox"
                      style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                      disabled
                      {{ $isColorNormal ? 'checked' : '' }}>
                Green
            </span>
            <span>
                <input type="checkbox"
                      style="width:15px; height:15px; margin-right:8px; vertical-align: middle;"
                      disabled
                      {{ $isColorNormal ? 'checked' : '' }}>
                Blue
            </span>
        </td>
    </tr>

    <tr>
        <td style="padding-left: 4px; padding-top: 5px;"  colspan="2">HEARING</td>
        <td style="padding-left: 4px; padding-top: 5px;"> 
          <span>
            Right Ear<br />
            <span> {{ getTestResult(89, $specialTests) ?? '-' }}</span> 
          </span>  
        </td>
        <td style="padding-left: 4px; padding-top: 5px;" colspan="5"> 
          <span>
            Left Ear<br />
            <span> {{ getTestResult(90, $specialTests) ?? '-' }}</span> 
          </span> 
        </td>
    </tr> 
    <tr>
        <td style="padding-left: 5px;" colspan="2">HEAD and NECK</td> 
        <td style="padding-left: 5px;" colspan="6"> 
          {{ $systemTests[32]['value'] ?? '-' }}
        </td>
    </tr> 
    <tr>
        <td style="padding-left: 5px;" colspan="2">HEART (Cardiovascular) </td> 
        <td style="padding-left: 5px;" colspan="6"> 
          {{ $systemTests[45]['value'] ?? '-' }}
        </td>
    </tr> 
    <tr>
        <td style="padding-left: 5px;" colspan="2">LUNGS</td> 
        <td style="padding-left: 5px;" colspan="6"> 
          {{ $systemTests[42]['value'] ?? '-' }}
        </td>
    </tr>
    <tr>
      <td colspan="8" style="width:100%;">
        <table style="width:100%;  border-collapse: collapse;">
          <tr>
            <td style="width:55%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:0pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding: 5px;">
              SPEECH (Radio TelephonelGMDSS Operators only): <br />
              Is speech unimpaired for normal voice communication?
            </td>
            <td style="width:45%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding-left: 5px;">
              
            <label style="display: block; margin: 4px 0;">
              <input type="checkbox" style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
              <span style="vertical-align: middle;">NO</span>
            
              <input type="checkbox" style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
              <span style="vertical-align: middle;">YES</span>
            </label> </td>
          </tr>
        </table>
      </td>
    </tr> 

    <tr>
      <td colspan="8" style="width:100%;">
        <table style="width:100%;  border-collapse: collapse;">
          <tr>
            <td style="width:50%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:0pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding-left: 5px;">
              UPPER EXTREMITIES : <span>NAD</span>
            </td>
            <td style="width:50%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding-left: 5px;">
            LOWER EXTREMITIES : <span>NAD</span>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="8" style="width:100%;">
        <table style="width:100%;  border-collapse: collapse;">
          <tr>
            <td style="width:50%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding-left: 5px;">
              Last Name : <span>{{ $data->seafarer->l_name }}</span>
            </td>
            <td style="width:50%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding-left: 5px;">
            First Name : <span>{{ $data->seafarer->f_name }}</span>
          </tr>
        </table>
      </td>
    </tr> 
  </table>

  <p style="font-weight: bold; text-align:left;"><strong>III. DRUG TESTING</strong> <small>(May be waived with valid test within 1 year)</small></p>
  <table border="1" cellspacing="0" cellpadding="0" style="width: 100%; border:1.2pt solid #0C0C0C;"> 
    <tr>
      <td colspan="8" style="width:100%;">
        <table style="width:100%;  border-collapse: collapse;">
          <tr>
            <td style="width:35%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding: 5px;">TESTS TO BE PERFORMED: </td>
            <td style="width:65%; border-top-style:solid;
      border-top-width:0pt;
      border-left-style:solid;
      border-left-width:1pt;
      border-bottom-style:solid;
      border-bottom-width:0pt;
      border-right-style:
      solid;border-right-width:0pt; padding: 5px;">
                <input type="checkbox" checked  style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                <span style="vertical-align: middle;">THC</span>
                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                <span style="vertical-align: middle;">Cocaine</span>
                <input type="checkbox"  checked ch style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                <span style="vertical-align: middle;">PCP</span>
                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                <span style="vertical-align: middle;">Opiates</span>
                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                <span style="vertical-align: middle;">Amphetamines</span>
            </td>
          </tr>
        </table>
      </td>
    </tr> 
    <tr>
    <td colspan="8" style="width:100%;">
        <table style="width:100%; border-collapse: collapse; border: 1px solid #000;">
            <tr>
                <td style="width:35%; border: 1px solid #000; padding: 5px; vertical-align: top;">RESULTS:</td>
                <td style="width:65%; border: 1px solid #000; padding: 5px;">
                    <table style="width:100%; border-collapse: collapse;">
                        <!-- Header Row -->
                        <tr>
                            <td style="width:66%; border: 1px solid #000; padding: 3px;"></td>
                            <td style="width:17%; border: 1px solid #000; text-align: center; padding: 3px;">NEGATIVE</td>
                            <td style="width:17%; border: 1px solid #000; text-align: center; padding: 3px;">POSITIVE</td>
                        </tr>

                        <!-- Main Tests -->
                        <!-- Cannabinoids -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">CANNABINOIDS as Carboxy - THC</td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['THC'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['THC'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Cocaine -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">COCAINE METABOLITES as Benzoylecgonine</td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Cocaine'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Cocaine'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Phencyclidine -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">PHENCYCLIDINE</td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['PCP'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['PCP'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Opiates Group -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">OPIATES:</td>
                            <td style="border: 1px solid #000; padding: 3px;"></td>
                            <td style="border: 1px solid #000; padding: 3px;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px; padding-left: 20px;">
                                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                                codeine
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($finalResults['Codeine']['candidate'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($finalResults['Codeine']['candidate'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px; padding-left: 20px;">
                                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                                morphine
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Morphine'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Morphine'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Amphetamines Group -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">AMPHETAMINES:</td>
                            <td style="border: 1px solid #000; padding: 3px;"></td>
                            <td style="border: 1px solid #000; padding: 3px;"></td>
                        </tr>
                        <tr>
                             <td style="border: 1px solid #000; padding: 3px; padding-left: 20px;">
                                <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                                amphetamine
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Amphetamine'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($drugResults['Amphetamine'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px; padding-left: 20px;">
                              <input type="checkbox" checked style="width:15px; height:15px; margin-right:8px; vertical-align: middle;">
                              methamphetamine
                          </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($finalResults['Methamphetamine']['candidate'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                            </td>
                            <td style="border: 1px solid #000; text-align: center; padding: 3px;">
                                <input type="checkbox" style="width:15px; height:15px; margin: 0; vertical-align: middle;"
                                    {{ ($finalResults['Methamphetamine']['candidate'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Other Section -->
                        <tr>
                            <td style="border: 1px solid #000; padding: 3px;">OTHER (please specify):</td>
                            <td colspan="2" style="border: 1px solid #000; padding: 3px;">
                                <span style="margin-right: 15px;">Barbiturates</span>
                                <input type="checkbox" style="width:15px; height:15px; vertical-align: middle;"
                                    {{ ($drugResults['Barbiturates'] ?? 'Negative') === 'Negative' ? 'checked' : '' }}>
                                <input type="checkbox" style="width:15px; height:15px; margin-left: 10px; vertical-align: middle;"
                                    {{ ($drugResults['Barbiturates'] ?? 'Negative') === 'Positive' ? 'checked' : '' }}>
                            </td>
                        </tr>

                        <!-- Remarks -->
                        <tr>
                            <td colspan="3" style="border: 1px solid #000; padding: 8px;">
                                REMARKS: <br>
                                <strong style="font-size: 1.1em;">
                                    @php
                                        $positiveFound = collect($drugResults)->contains('Positive');
                                        echo $positiveFound ? 'Drug abuse detected' : 'No drug abuse detected';
                                    @endphp
                                </strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
  </table>

  <p style="font-weight: bold; text-align:left;">IV. PHYSICIAN'S FURTHER COMMENTS</p>
  <table border="0" cellspacing="0" cellpadding="0" style="width:100%;  border:1.2pt solid #0C0C0C;">
    <tr> 
      <td colspan="3" style="padding-left: 5pt;">REMARKS: <br />
        <span>Candidate is physically and mentally fit at present</span>
      </td> 
        
    </tr>
    <tr>  
      <td colspan="3" style="padding-top: 100pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"> 
        &nbsp;&nbsp;
      </td>
    </tr>
  </table> 

  <p style="font-weight: bold; text-align:left;">V. STATEMENT REGARDING APPMCANT’ S FITNESS FOR DUTY</p>
  <div style="border: 1.2pt solid #0F0F0F; padding: 10px; width: fit-content; font-family: Arial, sans-serif; font-size: 9.5pt;">

  <p style="margin: 0 0 10px 0;">I certify that I gave a physical examination to the applicant on 
    <span style="text-decoration: underline;">{{ $data->medicalapproval->issue_date }}</span> @if($data->seafarer->sex == 1)
        he @else she @endif is</p>

  {{-- <p style="margin: 0 0 10px 290pt;">Date of examination (MM/DD/YY)</p> --}}

  <p style="margin: 10px 0; font-family: Arial, sans-serif;">
      {{-- FIT / NOT FIT --}}
      <label>
          <input type="checkbox" 
                style="margin-bottom: -5px; display: inline-block;" 
                name="medical_status" 
                value="FIT" 
                {{ optional($data->medicalapproval)->is_fit ? 'checked' : '' }}>
          FIT
      </label> / 

      <label>
          <input type="checkbox" 
                style="margin-bottom: -5px; display: inline-block;" 
                name="medical_status" 
                value="NOT FIT" 
                {{ optional($data->medicalapproval)->is_fit === 0 ? 'checked' : '' }}>
          NOT FIT
      </label>

      for Set Duty as: &nbsp;&nbsp;

      @php
          $selectedRank = optional($data->rank)->category;
          $ranks = ['MASTER', 'MATE', 'ENGINEER', 'RADIO OFFICER', 'SEAMAN'];
      @endphp

      @foreach($ranks as $rank)
          <label>
              <input type="checkbox" 
                    style="margin-bottom: -5px; display: inline-block;" 
                    name="duty[]" 
                    value="{{ $rank }}" 
                    {{ $selectedRank === $rank ? 'checked' : '' }}>
              {{ $rank }}
          </label>
      @endforeach
  </p>


  <p style="margin: 10px 0;">Name and Address of Physician <br />
    <span>{{ $data->employee->emp_name}} , {{ $data->clinic->add}}</span>
  </p>

  <p style="margin: 10px 0;">Qualifications of Physician<br />
    <span>M.B.B.S</span>
  </p>

  <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
    <tr>
      <td style="border-top: 1px solid black; border-right: 1px solid black; padding: 5px;">
        Physician's Licensing Authority <br />
        <span>Approved by D.G. Shipping Govt. of India No. UK/NAI/01/2021</span>
      </td>
      <td style="border-top: 1px solid black; padding: 5px;">
        Expiration date of current Practitioner's Certificate or License <br />
        <span>{{ $data->medicalapproval->expiry_date }}</span>
      </td>
    </tr>
  </table>

</div>


  <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin-top: 55px;">
    <tr>
      <td style="width:50%; padding: 5px;"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; @if($doctorSign)
                    <img src="{{ $doctorSign }}" style="height: 30px;">@endif  @if($officeStamp)
                    <img src="{{ $officeStamp }}" style="height: 30px;">@endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br /> <span>Physician's Signature</span></td>
      <td style="width:50%; padding: 5px;"> <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->medicalapproval->issue_date }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><br /> <span>DATE</span></td>
    </tr>
  </table>

</body>
</html>
