<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Singapore Annex C Medical Certificate</title>
    <style>
         @page {
      margin: 0;
      padding: 0;
      size: A4 portrait;
    }

     body {
       font-family: 'DejaVu Sans', sans-serif;
      font-size: 13px;
      margin: 15px;
    }
    
        .dec {
            border: none;
            border-collapse: collapse;
        }
        
        .dec th {
            border: none;
        }
        
        .dec td {
            border: 1px solid #000;
            padding-left: 3px;
        }
        
        table {
            width: 100%;
            margin-bottom: 2px;
        }
        
        
        .hd td {
            border: none;
            padding: 0px;margin:0px;
            vertical-align: top;
        }
        
        
        .signature {
            height: 50px;
        }


    </style>
</head>
<body>


    <table class="hd">
    <tr>
        <td style="vertical-align:middle;text-align:center" rowspan="3">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/flagstate/sin_mpa.png'))) }}" alt="Logo" style="width:100px;">
        </td>
       <td>
           
        </td>
        <td rowspan="3">
            ANNEX C
        </td>
    </tr>
    <tr>
         <td style="text-align: center;">
            <h3 style="padding: 0px;margin:0px;">MARITIME AND PORT AUTHORITY OF SINGAPORE</h3>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;">
            <h3>SEAFARER’S MEDICAL CERTIFICATE</h3>
        </td>
    </tr>
</table>

    
    <p>This certificate is issued by the undersigned recognized medical practitioner to the named seafarer on behalf of the <strong>Maritime and Port Authority of Singapore</strong> and meets both the requirements of the International Convention on Standards of Training, Certification and Watchkeeping for Seafarers, 1978, as amended (STCW Convention) and the Maritime Labour Convention, 2006.</p>

    <table class="dec">
        <tr>
            <td colspan="2">Seafarer’s Name: <i>(Last, first, middle)</i><br>
                <strong>{{ $data->seafarer->l_name ?? '' }}, {{ $data->seafarer->f_name ?? '' }} {{ $data->seafarer->m_name ?? '' }}</strong>
            </td>
            <td>Gender: </br>
                <strong>
                {!! $data->seafarer->sex == 1 ? 'Male/<s>Female</s>*' : ($data->seafarer->sex == 2 ? '<s>Male</s>Female*' : 'Not Specified') !!}
                </strong>
            </td>
        </tr>
        <tr>
            <td>Date of Birth: <i>(Day/month/year)</i><br>
                <strong>{{ \Carbon\Carbon::parse($data->seafarer->dob)->format('d/m/Y') ?? '' }}</strong>
            </td>
            <td>Nationality: </br><strong>{{ $data->nationality_id == 1 ? 'Indian' : '' }}</strong></td>
            <td>Place of Birth: </br><strong>{{ $data->seafarer->pob ?? '' }}</strong></td>
        </tr>
    </table>


    <p>Declaration of the recognized medical practitioner:</p>

    <table class="dec">
        <tr style="border:none;">
            <th style="width: 5%;"></th>
            <th></th>
            <th style="width: 5%;">Yes</th>
            <th style="width: 5%;">No</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Identification documents were checked at the point of examination?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td>2</td>
            <td>Hearing meets the standards in STCW Code Section A-I/9?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td>3</td>
            <td>Unaided hearing satisfactory?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td>4</td>
            <td>Visual acuity meets the standards in STCW Code Section A-I/9?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td>5</td>
            <td>Colour vision meets the standards in STCW Code Section A-I/9?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">Date of last colour vision test:   <strong>{{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '' }}</strong></td>
        </tr>
        <tr>
            <td>6</td>
            <td>Fit for look-out duty?</td>
           @if(strtolower($data->rank->watchkeeper) === 'yes')
                <td>X</td>
            @else
                <td>X</td>
            @endif
            <td></td>
        </tr>
        <tr>
            <td>7</td>
            <td>Is the seafarer free from any medical condition likely to be aggravated by service at sea or to render the seafarer unfit for such service or endanger the life of person onboard?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td>8</td>
            <td>No limitations or restrictions on fitness?</td>
            <td>X</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">If “no” specify limitations or restrictions<br>
                <strong>{{ $data->medicalapproval->limitation ?? '' }}</strong>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td colspan="3">Date of examination: <i>(day/month/year)</i> <strong>{{ \Carbon\Carbon::parse($data->medicalApproval?->issue_date)->format('d/m/Y') ?? '-' }}</strong><br>
                
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td colspan="3">Expiry of certificate: <i>(day/month/year)</i> <strong>{{ \Carbon\Carbon::parse($data->medicalApproval?->expiry_date)->format('d/m/Y') ?? '-' }}</strong><br>
                <small>** Maximum two years from date of examination unless the seafarer is under the age of 18</small><br>
                
            </td>
        </tr>
    </table>
    
    <table style="border:none">
        <tr>
            <td style="width: 25%;">
               <strong>{{ \Carbon\Carbon::parse($data->date_of_examination)->format('d/m/Y') ?? '' }}</strong>
               
            </td>
            <td style="width: 25%;">
                 @if($doctorSign)
                    <img src="{{ $doctorSign }}" alt="Doctor Signature" class="signature">
                @else
                   
                @endif
            </td>
            <td style="width: 50%;">
                @if($officeStamp)
                    <img src="{{ $officeStamp }}" alt="Office Stamp" class="signature" style="width:80px;height:80px;">
                @else
                
                @endif 
                
            </td>
        </tr>
           <tr>
            <td style="width: 10%; border-top:1px solid #000">
               <span >Date: </span>
            </td>
            <td style="width: 45%;border-top:1px solid #000">
                
                <span>Signature of Authorised Medical Practitioner</span>
               
            </td>
            <td style="width: 45%; border-top:1px solid #000">
                <span>Medical Practitioner’s Official Stamp</span><br>
                <small>(name, licence number, address etc)</small>
            </td>
        </tr>
    </table>

    <p>I have been informed of the content of the certificate and of the right to a review.</p>

    @if($signatureImage)
        <img src="{{ $signatureImage }}" alt="Seafarer Signature" class="signature">
    @else
        __________________________________
    @endif
    <p style="width: 200px; border-top:1px solid #000">Signature of Seafarer:</p>
    <p style="width: 150px; font-size:9px">* delete as appropriate</p>
<table style="width: 100%; border: none;">
            <tr>
                <td style="width: 50%; border: none; text-align: left; ">
                    <div class="mp-0">SEAFARER MEDICAL CERTIFICATE - March 2020</div>
                </td>
                <td style="width: 45%; border: none; text-align: left; ">
                      <div class="mp-0">1 of 1</div>
                </td>
                <td style="width: 5%; border: none; text-align: right; ">
                <div class="mp-0"></div>
                  </td>
            </tr>
</table>

</body>
</html>
