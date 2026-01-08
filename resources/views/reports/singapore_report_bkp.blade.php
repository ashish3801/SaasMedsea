<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Singapore Annex C Medical Certificate</title>
    <style>
        @page {
        size: A4;
        margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 20px;
        }
        .bordered {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            width: 100%;
            margin-bottom: 10px;
        }
        td, th {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
        }
        .no-border {
            border: none;
        }
        .text-center {
            text-align: center;
        }
        .text-bold {
            font-weight: bold;
        }
        .logo {
            height: 50px;
        }
        .signature {
            height: 50px;
        }
    </style>
</head>
<body>

    <h3 class="text-center">ANNEX C</h3>
    <h2 class="text-center">MARITIME AND PORT AUTHORITY OF SINGAPORE</h2>
    <h3 class="text-center">SEAFARER’S MEDICAL CERTIFICATE</h3>

    <p>This certificate is issued by the undersigned recognized medical practitioner to the named seafarer on behalf of the Maritime and Port Authority of Singapore and meets both the requirements of the International Convention on Standards of Training, Certification and Watchkeeping for Seafarers, 1978, as amended (STCW Convention) and the Maritime Labour Convention, 2006.</p>
{{-- @php
dd($data->seafarer);
@endphp --}}
    <table class="bordered">
        <tr>
            <td>Seafarer’s Name: <i>(Last, first, middle)</i><br>
                <strong>{{ $data->seafarer->l_name ?? '' }}, {{ $data->seafarer->f_name ?? '' }} {{ $data->seafarer->m_name ?? '' }}</strong>
            </td>
            <td>Gender: 
                <strong>
                    {{ $data->seafarer->sex == 1 ? 'Male' : ($data->seafarer->sex == 2 ? 'Female' : 'Not Specified') }}
                </strong>
            </td>

        </tr>
        <tr>
            <td>Date of Birth: <i>(Day/month/year)</i><br>
                <strong>{{ \Carbon\Carbon::parse($data->seafarer->dob)->format('d/m/Y') ?? '' }}</strong>
            </td>
            <td>Nationality: <strong>{{ $data->seafarer->nationality ?? '' }}</strong></td>
        </tr>
        <tr>
            <td colspan="2">Place of Birth: <strong>{{ $data->seafarer->birth_place ?? '' }}</strong></td>
        </tr>
    </table>

    <p class="text-bold">Declaration of the recognized medical practitioner:</p>

    <table class="bordered">
        <tr>
            <th style="width: 5%;">#</th>
            <th>Description</th>
            <th style="width: 5%;">Yes</th>
            <th style="width: 5%;">No</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Identification documents were checked at the point of examination?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Hearing meets the standards in STCW Code Section A-I/9?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Unaided hearing satisfactory?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Visual acuity meets the standards in STCW Code Section A-I/9?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Colour vision meets the standards in STCW Code Section A-I/9?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="4">Date of last colour vision test: __________________________________</td>
        </tr>
        <tr>
            <td>6</td>
            <td>Fit for look-out duty?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Is the seafarer free from any medical condition likely to be aggravated by service at sea or to render the seafarer unfit for such service or endanger the life of person onboard?</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>8</td>
            <td>No limitations or restrictions on fitness?<br>If “no” specify limitations or restrictions</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>9</td>
            <td>Date of examination: <i>(day/month/year)</i><br>
                <strong>{{ \Carbon\Carbon::parse($data->date_of_examination)->format('d/m/Y') ?? '' }}</strong>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td>10</td>
            <td>Expiry of certificate: <i>(day/month/year)</i><br>
                <small>** Maximum two years from date of examination unless the seafarer is under the age of 18</small><br>
                <strong>{{ \Carbon\Carbon::parse($data->expiry_date)->format('d/m/Y') ?? '' }}</strong>
            </td>
            <td colspan="2"></td>
        </tr>
    </table>

    <table class="bordered">
        <tr>
            <td style="width: 33%;">
                Date: <strong>{{ \Carbon\Carbon::parse($data->date_of_examination)->format('d/m/Y') ?? '' }}</strong>
            </td>
            <td style="width: 33%;">
                Signature of Authorised Medical Practitioner:<br>
                @if($doctorSign)
                    <img src="{{ $doctorSign }}" alt="Doctor Signature" class="signature">
                @else
                    ________________________
                @endif
            </td>
            <td style="width: 34%;">
                Medical Practitioner’s Official Stamp:<br>
                <small>(name, licence number, address etc)</small><br>
                @if($officeStamp)
                    <img src="{{ $officeStamp }}" alt="Office Stamp" class="signature">
                @else
                    ________________________
                @endif
            </td>
        </tr>
    </table>

    <p>I have been informed of the content of the certificate and of the right to a review.</p>

    <p>Signature of Seafarer:</p>
    @if($signatureImage)
        <img src="{{ $signatureImage }}" alt="Seafarer Signature" class="signature">
    @else
        __________________________________
    @endif
    <p class="text-center"><small>Page 1 of 1</small></p>

</body>
</html>
