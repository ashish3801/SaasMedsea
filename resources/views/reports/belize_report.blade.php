<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Belize Medical Fitness Certificate</title>
    <style>
        @page {
            margin: 0;
            size: A4 portrait;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 1.5cm;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            text-decoration: underline;
            margin: 15px 0;
            font-size: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td,
        th {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: top;
            line-height: 1.4;
        }

        .section-header {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .checkbox-group {
            display: inline-flex;
            align-items: center;
            margin-right: 25px;
        }

        .checkbox-group input[type="checkbox"] {
            width: 14px;
            height: 14px;
            margin-right: 5px;
        }

        .signature-box {
            border-bottom: 1px solid #000;
            display: inline-block;
            width: 200px;
            height: 30px;
            margin-top: 5px;
        }

        .stamp-area {
            border: 1px dashed #666;
            padding: 10px;
            min-height: 80px;
        }
    </style>
</head>

<body>

    <!-- logo -->
    <div style="margin-bottom:18px; text-align:center">
       <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->clinic->logo))) }}"
                     alt="Clinic Logo"
                     style="width: 80px; height: auto;">
    </div>

    
    <table style="width:100%; border-collapse: collapse; font-family: Arial, sans-serif;">

        <!-- Main Title as First Row -->
        <tr>
            <td colspan="4" style="text-align: center; padding: 1em 0">
                <h2 style="margin: 0; text-decoration: none;">
                    MEDICAL FITNESS CERTIFICATE FOR PERSONNEL SERVICE ON BOARD<br>
                    BELIZEAN REGISTERED SHIPS
                </h2>
            </td>
        </tr>

        <!-- Personal Information Rows -->
        <tr>
            <td colspan="2">Last name: <strong>
                    {{ $data->seafarer->l_name }}
                </strong> </Last>
            </td>
            <td colspan="2">Given name(s): <strong>
                    {{ $data->seafarer->f_name }} {{ $data->seafarer->m_name }}
                </strong> </td>
        </tr>

        <!-- row 2 -->
        <tr>
            <td colspan="4">Position Onboard:<strong>
                    {{ $data->rank->name }}
                </strong></td>
        </tr>

        <!-- row 3 -->
        <tr>
            <td style="height: 75px;">Place of Birth (City, Country):<strong>
                    {{ $data->seafarer->birth_place }}
                </strong></td>

            <td style="height: 75px;">Mail address of Applicant (Street, City, Country):<strong>
                    {{ $data->seafarer->address }}
                </strong></td>

            <td style="height: 75px;">Date of Birth <br> <span
                    style="color: #888; font-size: 0.9em; font-style: italic;">
                    (dd/mm/yy):
                </span> <strong>
                    {{ date('d/m/Y', strtotime($data->seafarer->dob)) }}
                </strong></td>

            <td style="height: 75px;">Sex:<strong>
                    <div>
                        <label class="checkbox-group" style="margin: 0px !important">
                            M
                            <input type="checkbox" disabled {{ $data->seafarer->sex == 1 ? 'checked' : '' }}>
                        </label>
                        <label class="checkbox-group">
                            F
                            <input type="checkbox" disabled {{ $data->seafarer->sex == 2 ? 'checked' : '' }}>
                        </label>
                    </div>
                </strong></td>
        </tr>

        <tr>
            <td colspan="4" rowspan="1">
                This Certificate is issued in accordance with the provisions of regulation I/9 of the STCW Convention
                1978 as
                amended, and Regulation 1.2 of the Maritime Labor Convention, 2006
            </td>
        </tr>

        <!-- Section Header for Physician Declaration -->
        <tr>
            <td colspan="4" rowspan="1"
                style="background-color: #f0f0f0; text-align: center; padding: 0.5em; font-weight: bold;">
                DECLARATION OF THE AUTHORIZED PHYSICIAN
            </td>
        </tr>

        <!-- Physician Declaration Rows -->
        <tr>
            <td colspan="3">Confirmation that identification documents were checked at the point of
                examination:</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" checked>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" disabled>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Hearing meets the standards in STCW Code, Section A-1/9?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" checked>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" disabled>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Unaided hearing satisfactory?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" checked>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" disabled>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Visual acuity meets standards in STCW Code, Section A-1/9?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" checked>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" disabled>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Colour vision meets standards in STCW Code, Section A-I/9?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" checked>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" disabled>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">
                <em>
                    The visual test is required every six years
                </em>
                <br> Date of the last colour vision test
            </td>
            <td colspan="1">
                (Day/Month/Year):
                <br>
                <strong>{{  \Carbon\Carbon::parse($data->medicalApproval->issue_date)->format('d/m/Y') }}</strong>
            </td>
        </tr>

        <tr>
            <td colspan="3">Are glasses or contact lenses necessary to meet the required vision standards?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        {{-- <input type="checkbox" disabled> --}}
                        <input type="checkbox" disabled {{ !$visionAidNotRequired ? 'checked' : '' }}>
                    </label>
                    <label class="checkbox-group">
                        No
                        {{-- <input type="checkbox" disabled> --}}
                        <input type="checkbox" disabled {{ $visionAidNotRequired ? 'checked' : '' }}>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Able for watchkeeping?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        {{-- <input type="checkbox" disabled> --}}
                        <input type="checkbox" disabled {{ (strtolower($data->rank->category ?? '') === 'watchkeeper') ? 'checked' : '' }}>
                    </label>
                    <label class="checkbox-group">
                        No
                        {{-- <input type="checkbox" disabled> --}}
                                        <input type="checkbox" disabled {{ (strtolower($data->rank->category ?? '') !== 'watchkeeper') ? 'checked' : '' }}>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Is the applicant taking any non-prescription or prescription medication?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" disabled>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" checked>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="3">Is the seafarer free from any medical condition likely to be aggravated by service
                at sea or to render the seafarer unfit for such service or to endanger the health of
                other persons on board?</td>
            <td colspan="1">
                <div style="width: 150% !important;">
                    <label class="checkbox-group">
                        Yes
                        <input type="checkbox" disabled>
                    </label>
                    <label class="checkbox-group">
                        No
                        <input type="checkbox" checked>
                    </label>
                </div>
            </td>
        </tr>

        <tr>
            <td colspan="4" style="padding-bottom: 1em; border:1px solid #ccc;">
                I hereby declare that I am in knowledge of the contents of the Physical Examination.

                <!-- add some vertical space -->
                <div style="height: 3em;"></div>

                <table style="width:100%; font-family: Arial, sans-serif; border: none; border-collapse: separate;">
                    <tr>
                        <td style="border: none; text-align: center; padding-top: 2em; vertical-align: bottom;">
                            <div style="margin-bottom: 15px;">
                                {{ $data->seafarer->f_name }} {{ $data->seafarer->m_name }} {{ $data->seafarer->l_name }}
                            </div>
                            <div style="border-bottom: 1px solid #000; width: 150px; margin: 0 auto; height: 0;"></div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Name of Applicant
                            </div>
                        </td>
                        <td style="border: none; text-align: center; padding-top: 2em; vertical-align: bottom;">
                            <div style="margin-bottom: 15px;">
                                @if($signatureImage)
                                <img src="{{ $signatureImage }}" style="height: 40px;">
                                @else
                                <div class="signature-box"></div>
                                @endif
                            </div>
                            <div style="border-bottom: 1px solid #000; width: 150px; margin: 0 auto; height: 0;"></div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Signature of Applicant
                            </div>
                        </td>
                        <td style="border: none; text-align: center; padding-top: 2em; vertical-align: bottom;">
                            <div style="margin-bottom: 15px;">
                                {{ date('d/m/Y', strtotime($data->medicalApproval->issue_date)) }}
                            </div>
                            <div style="border-bottom: 1px solid #000; width: 150px; margin: 0 auto; height: 0;"></div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Date:
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Fitness Declaration -->
    <table>
        <tr>
            <td colspan="4" style="padding-bottom: 1em;">
                Circle the appropriate choice:

                <!-- add some vertical space -->
                <div style="height: 3em;"></div>
                @php
                    $sex = $data->seafarer->sex ?? 1;
                    $isFit = $data->medicalapproval->is_fit ?? 0;
                    $hasLimitation = $data->medicalapproval->limitation ?? '-';
                @endphp
                <div>
                    (
                    {!! $sex == 1 ? 'HE <s>SHE</s>' : '<s>HE</s> SHE' !!}
                    ) is found to be (
                    {!! $isFit == 1 ? 'FIT <s>NOT FIT</s>' : '<s>FIT</s> NOT FIT' !!}
                    ) for duty as a (
                    {!! $hasLimitation == 0 ? 'WITHOUT ANY <s>WITH THE FOLLOWING</s>' : '<s>WITHOUT ANY</s> WITH THE FOLLOWING' !!}
                    ) restrictions:
                </div>

                <!-- horizontal lines below the sentence -->
                <div style="margin-top: 1em;">
                    <hr style="margin: 2em 0;">
                    <hr style="margin: 2em 0;">
                    <hr style="margin: 2em 0;">
                </div>

                <div style="height: 3em">
                    Name and Degree of Physician:
                    <span style="text-decoration: underline;">
                        {{ $data->employee->emp_name ?? '' }},
                        {{ $data->employee->degree ?? '' }}
                    </span>
                </div>

                <div style="height: 3em">
                    Full Address:
                    <span style="text-decoration: underline;">
                        {{ $data->clinic->add ?? '' }}
                    </span>
                </div>


                <div style="height: 3em">
                    Name of Physician's certificating authority:
                    <span style="text-decoration: underline;">
                        {{ $data->employee->certifying_authority ?? '' }}
                    </span>
                </div>

                <div style="height: 3em">
                    Issuance of date Certificate:
                    <span style="text-decoration: underline;">
                        {{ date('d/m/Y', strtotime($data->employee->certificate_issue_date)) }}
                    </span>
                </div>

                <table style="width:100%; font-family: Arial, sans-serif; border: none;">
                    <tr>
                        <td style="border-left:none; text-align: center; vertical-align: bottom;">
                            <div style="height:3em"></div>
                            <div style="margin-bottom: 15px;">
                                @if($doctorSign)
                                <img src="{{ $doctorSign }}" style="height: 3em;">
                                @else
                                <div class="signature-box"></div>
                                @endif
                            </div>
                            <div style="border-bottom: 1px solid #000; width: 150px; margin: 0 auto; height: 0;"></div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Signature of Physician
                            </div>
                        </td>
                        <td style="text-align: center; vertical-align: bottom;">
                            <div style="height:3em"></div>
                            <div style="margin-bottom: 15px;">
                                @if($officeStamp)
                                <img src="{{ $officeStamp }}" style="height: 3em;">
                                @endif
                            </div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Stamp of Physician
                            </div>
                        </td>
                        <td style="border-right: none; text-align: center; vertical-align: bottom;">
                            <div style="height:3em"></div>
                            <div style="margin-bottom: 15px;">
                                {{ date('d/m/Y', strtotime($data->medicalApproval->issue_date)) }}
                            </div>
                            <div style="border-bottom: 1px solid #000; width: 150px; margin: 0 auto; height: 0;"></div>
                            <div style="margin-top: 0.5em; font-size: 0.9em; color: #333;">
                                Date:
                            </div>
                        </td>
                    </tr>
                </table>

                <div style="height: 3em">
                    Expiration date Certificate:
                    <span style="text-decoration: underline;">
                        {{ date('d/m/Y', strtotime($data->medicalApproval->expiry_date)) }}
                    </span>
                </div>

                <div style="font-size: 14px; text-align: center;">
                    <em>
                        (This certificate cannot be valid for more than 2 years)
                    </em>
                </div>

                <div>
                    <em>
                        If the period of validity of this certificate expires in the course of the voyage, then the
                        medical certificate shall continue in force until the next port of call where a medical
                        practitioner recognized by IMMARBE is available, provided that this period does not exceed 3
                        months.
                    </em>
                </div>

            </td>
        </tr>
    </table>

    <div>
        <div style="font-size: 16px; text-align: center;">
            <strong>
                IMPORTANT NOTE
            </strong>
        </div>

        <div>
            The original or a certified copy of this certificate must be carried on board in accordance with regulation
            I/2, paragraph 11 of the revised STCW Convention by the seafarer while serving on board of any Belize
            Flag vessel in order to prove that he/she is medically fit to serve in the aforementioned capacity.
        </div>
    </div>

    <div>
        <hr style="border: 1px solid #000; margin-top: 30px;">
    </div>


    <div>
        <div style="font-size: 16px; text-align: center;">
            <strong>
                DETAILS OF MEDICAL EXAMINATION
            </strong> <br>
            <em style="font-size: 14px;">
                <strong>
                    (To be completed by examining physician)
                </strong>
            </em>
        </div>
    </div>
</body>

</html>