<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate for Service at Sea</title>
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

       .border-rbl{
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            border-left: 1px solid #000;
        }
        
        .border-rl{
            border-right: 1px solid #000;
            border-left: 1px solid #000;
        }
      
        p {
            font-size: 15px;
        }

        .conditions p,
        .expiry p {
            margin: 0px 0px 5px 0px;
            padding-left: 5px;
        }

         
    </style>
</head>

<body>
    @php
        $emp = $data->clinic->employee->first();
        
    @endphp
    
  
         @if ($data->medicalApproval?->attach_stamp_sign == 1)
    @php $stm = 1; @endphp
@elseif ($data->medicalApproval?->attach_stamp_sign == 0)
    @php $stm = null; @endphp
@else
    @php $stm = null; @endphp
@endif

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
                <h2 style="color: #34427d;">{{ $data->clinic->name }}</h2>
                <p style="">{{ $data->clinic->add }}</p> 
                 <p style="">{{ $data->clinic->email }} | {{ $data->clinic->phone }} </p> 
                </div>
            </td>
        </tr>
    </table> 
   </div>
        <div class="border-rl" style="text-align: center;">
        <p style="text-align: right;padding-right:10px;"><strong>Annexure IV</strong></p>
        <h4>Medical Certificate for Service at Sea</h4>
        <p style="padding-bottom:20px;">(Issued under Authority of Directorate General of Shipping, Govt. of India under Rule 4 of M.S (Medical Examination) Rules,2000 as amended)</p>
        </div>

<table class="border-rbl" style="font-size: 15px; border-collapse: collapse; width: 100%;">
    <!-- Row 1: Full Name -->
    <tr>
        <td colspan="3" style="padding-left: 5px;">
            <strong>{{ $data->Seafarer->f_name }} {{ $data->Seafarer->m_name }} {{ $data->Seafarer->l_name }}</strong>
        </td>
        <td rowspan="8" style="width: 190px; text-align: center; padding: 1px;">
            <div class="profile-container" style="position: relative; display: inline-block; width: 100px; height: 100px;">
                @if(isset($profileImage))
                    <img src="{{ $profileImage }}" alt="User Image" style="max-width: 100%; height: auto; border: 1px solid #ccc;">
                @else
                    <div style="width: 80px; height: 100px; border: 1px solid #ccc; background: #f0f0f0;"></div>
                @endif

                @if(isset($stm))
                    <img src="{{ $officeStamp }}" alt="Stamp" style="position: absolute; width: 80px; height: 80px; bottom: -30px; left: -25px;">
                @endif
            </div>
        </td>
    </tr>

    <!-- Row 2: Label for Full Name -->
    <tr>
        <td colspan="3" style="padding-left: 5px;">
            <span style="border-top: 1px solid #000; display: inline-block;">
                Seafarer's First Name Middle Name Last Name
            </span>
        </td>
    </tr>

    <!-- Spacer Row (optional, can be removed if no extra space needed) -->
    <tr><td colspan="3" style="padding-bottom: 5px;"></td></tr>
    
    <!-- Row 3: DOB, Gender, Nationality + Image -->
    <tr>
        <td style="padding-left: 5px;">
           <strong> {{ $data->Seafarer->dob ? \Carbon\Carbon::parse($data->Seafarer->dob)->format('j-M-Y') : '-' }}</strong>
        </td>
        <td style="padding-left: 5px;">
           <strong> {{ $data->Seafarer->sex == 1 ? 'Male' : 'Female' }}</strong>
        </td>
        <td style="padding-left: 5px;">
           <strong> {{ $data->nationality_id == 1 ? 'Indian' : '' }}</strong>
        </td>
        
    </tr>

    <!-- Row 4: Labels for DOB, Gender, Nationality -->
    <tr>
        <td style="padding-left: 5px;">
            <span style="border-top: 1px solid #000;">Date of Birth (Day/Month/Year)</span>
        </td>
        <td style="padding-left: 5px;">
            <span style="border-top: 1px solid #000;">Gender: Male/Female</span>
        </td>
        <td style="padding-left: 5px;">
            <span style="border-top: 1px solid #000;">Nationality</span>
        </td>
    </tr>

    <!-- Spacer Row (optional, can be removed if no extra space needed) -->
    <tr><td colspan="3" style="padding-bottom: 5px;"></td></tr>
    <!-- Row 5: CDC / Passport / INDOS -->
    <tr>
        <td colspan="4" style="padding-left: 5px;">
           <strong> {{ $data->cdc_no }} / {{ $data->passport_no }} / {{ $data->indos_no }}</strong>
        </td>
    </tr>

    <!-- Row 6: Label for Document Types -->
    <tr>
        <td colspan="4" style="padding-left: 5px;">
            <span style="border-top: 1px solid #000;">
                Number of CDC / Passport / Other valid identification document – with type of document:
            </span>
        </td>
    </tr>

    <!-- Spacer Row (optional, can be removed if no extra space needed) -->
    <tr><td colspan="4" style="padding-bottom: 10px;"></td></tr>

    <!-- Row 7: Medical Examiner Name -->
    <tr>
        <td rowspan="2" style="padding-left: 5px;">Has been examined by</td>
        <td colspan="3" style="padding-left: 5px;">
           <strong> {{ $emp->emp_name }} ({{ $emp->dgs_approval_number }})</strong>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="padding-left: 5px;">
            <span style="border-top: 1px solid #000;">
                (Name of Medical Examiner and Approval Number)
            </span>
        </td>
    </tr>

    <!-- Spacer Row (optional) -->
    <tr><td colspan="4" style="padding-bottom: 10px;"></td></tr>

    <!-- Row 9: Fit for job -->
    <tr>
        <td style="padding-left: 5px;">
            and has been found fit for sea service in the job of:
        </td>
        <td colspan="3" style="padding-left: 5px;">
            <span style="border-bottom: 1px solid #000;"><strong>{{ $data->rank->name ?? $data->rank_id }}</strong></span>
        </td>
    </tr>

    <!-- Bottom spacer -->
    <tr><td colspan="4" style="padding-bottom: 25px;"></td></tr>
</table>

       
        <section class="conditions border-rbl">
            <p>(a) The hearing and sight of the seafarer concerned, and the colour vision in the case of a seafarer to
                be employed in capacities where fitness forthe work to be
                performed is liable to be affected by defective colour vision, are all satisfactory; and
            </p>
            <p>(b) The seafarer concerned is not suffering from any medical condition likely to be aggravated by service
                at sea or to render the seafarer unfit for such service or to
                endanger the health of other persons on board.
            </p>
            <p>(c) The Seafarer compiles with the requirements specified in table A-I/9 of STCW Code (i.e. Minimum in
                service eyesight standards at sea forSeafarers), Table B-I/9 of
                the STCW Code(i.e. Assessment of minimum entry level and in-service physical abilities for Seafarers)
                and Regulation1.2, Standard A-1.2 & Guideline B-1.2 of the
                Maritime Labour Convention 2006.</p>
        </section>

      <table class="border-rbl" style="width: 100%; border-collapse: collapse;">
    <!-- Row 1: Date and Place of Medical Examination -->
    <tr>
        <td style="padding: 5px 10px; text-align: center; vertical-align: middle;">
            <strong>
                {{ $data->created_at ? \Carbon\Carbon::parse($data->created_at)->format('j-M-Y') : '-' }}
                at {{ $data->clinic->branch }}
            </strong>
        </td>
        <td style="padding: 5px; text-align: center; vertical-align: middle;">
            @if(isset($stm))
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $emp->sign_upload))) }}"
                     alt="Signature"
                     style="width: 100px; height: auto;">
            @endif
        </td>
    </tr>

    <!-- Row 2: Labels for Row 1 -->
    <tr>
        <td style="padding-left: 5px; text-align: center;">
            <span style="border-top: 1px solid #000; display: inline-block;">
                (Date and Place of Medical Examination)
            </span>
        </td>
        <td style="padding: 5px; text-align: center;">
            <span style="border-top: 1px solid #000; display: inline-block;">
                Signature of the Medical Examiner
            </span>
        </td>
    </tr>

    <!-- Row 3: Clinic Name and Contact -->
    <tr>
        
        <td style="padding-left: 5px; text-align: center;">
            <strong>{{ $data->id }}</strong><br>
            <span style="border-top: 1px solid #000; display: inline-block;">
                (Serial Number of the Certificate)
            </span>
        </td>
        <td style="padding: 5px; text-align: center;">
            <strong>{{ $data->clinic->name }}</strong><br>{{ $data->clinic->add }}
            Email: {{ $data->clinic->email }} | Phone: {{ $data->clinic->phone_no }}
        </td>
        
    </tr>

    <!-- Row 5: Certificate Expiry -->
    <tr>
        <td style="padding: 5px 5px; vertical-align: middle;">
            This Certificate expires on: <br>
            <strong>
                {{ optional($data->medicalapproval)->expiry_date
                    ? \Carbon\Carbon::parse($data->medicalapproval->expiry_date)->format('j-M-Y')
                    : '-' }}
            </strong>
        </td>

        <td style="padding: 5px; text-align: center; vertical-align: middle;">
            <span style="padding-left: 5px; text-align: center;">
            @if(isset($stm))
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $emp->stamp_upload))) }}"
                     alt="Official Stamp"
                     style="width: 90px; height: 90px;">
            @endif
        </span></br>
            Official Stamp of the Medical Examiner
        </td>
    </tr>
</table>


        <section class="expiry border-rbl">
            <p>*Not more than 2 years from the date of issue, unless the seafarer is under the age of 18, in which case
                the maximum period of validity of the Medical Certificate shall
                be 1 year.</p>
            <p>If the period of validity of the Medical Certificate expires in the course of voyage, the Medical
                Certificate shall continue in force untile the nextport of call where an
                approved Medical Examiner is available and the seafarer can obtain a Medical Certificate, provided that
                period of such extension shall not exceed 3 months.</p>

        </section>
    </div>
</body>

</html>
