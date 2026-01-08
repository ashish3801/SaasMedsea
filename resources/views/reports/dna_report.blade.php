<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Analysis of Drugs of Abuse & Alcohol</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0px;
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .container {
        
        max-width: 700px;
        margin: 20px auto;
        /* padding: 20px; */
        padding: 20px;
        border: 1px solid #000;
    }
    
    .mp-0 {
          margin: 0;
            padding: 0;
    }
    
    
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .table, .table th, .table td {
        border: 1px solid black;
    }
    .table th, .table td {
        padding: 5px;
        text-align: center;
        font-size: 14px;
    }
    .cutoff {
        font-size: 12px;
        margin-top: 20px;
    }
    .assay-methods {
        margin-top: 10px;
        font-size: 12px;
    }
    .assay-methods ul {
        padding-left: 20px;
        font-size: 12px;
    }
    .footer {
        text-align: right;
        margin-top: 20px;
        font-size: 12px;
    }
</style>
</head>
<body>

<div class="container">
 
 <div style="text-align: center; padding-top: 5px;">
    <table style="text-align: center;">
        <tr style="border: 1pt solid #000">
            <td>
                <p style="margin:2px 2px;"> 
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->clinic->logo))) }}"  alt="Clinic Logo"  style="height: 70px"  >
                </p>
            </td>
            <td>
                <div style="">
                <h2 class="mp-0" style="color: #34427d;">{{ $data->clinic->name }}</h2>
                <p class="mp-0" style="font-size:12px">{{ $data->clinic->add }}</br>{{ $data->clinic->email }} | {{ $data->clinic->phone }} </p> 
                </div>
            </td>
        </tr>
    </table> 
 
            <h4>ANALYSIS OF DRUGS OF ABUSE & ALCOHOL (QUALITATIVE)</h4>
       
    </div>
    @php
          $emp =$data->clinic->employee->first();
    @endphp

    <table style="width:100%; margin-top: 20px; font-size: 15px;">
        <tr>
            <td>Candidate Name</td>
            <td><strong>{{ $data->Seafarer->f_name}} {{ $data->Seafarer->m_name }} {{ $data->Seafarer->l_name }} </strong> </td>
            <td>Date</td>
            <td><strong>{{ $data->Seafarer->created_at ? \Carbon\Carbon::parse($data->Seafarer->created_at)->format('j-M-Y') : '-' }}</strong></td>
        </tr>
        <tr>
            <td>PP / CDC / ID No.</td>
            <td><strong>{{ $data->cdc_no }} /{{ $data->passport_no }}/ {{ $data->indos_no }}</strong></td>
            <td>Serial No.</td>
            <td><strong>{{ $data->id }}</strong></td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>TEST</th>
                <th>CUT OFF VALUE</th>
                <th>RESULT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $test)
                <tr>
                    <td>{{ $test['name'] }}</td>
                    <td>{{ $test['cutoff'] }}</td>
                    <td>{{ $test['value'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cutoff">
        <p>The Cut-off values are based on the recommendations of N.I.D.A. (USA) & S.A.M.H.S.A. (USA) Notes :</p>
        <ol>
            <li>A Positive result indicates only the presence of the drug metabolite above the cut off value. It does not indicate or measure intoxication.</li>
            <li>As with any laboratory test, the result obtained serve only as an aid to diagnosis and should only be interpreted in relation to other clinical and diagnostic findings, along with past and present medical history, medication taken, food and beverages consumed, habits and any other relevant data.</li>
            <li>The above normal values conform to international standards.</li>
        </ol>
    </div>

    <div class="assay-methods">
        <p>The urine analyses for the above drugs are done by any one of the following available Assay methods.</p>
        <ul>
            <li>IMMUNOMETRIC ASSAY (RAPID CHROMATOGRAPHY)</li>
            <li>FPIA (FLUORESCENCE POLARISATION IMMUNO ASSAY)</li>
            <li>ELISA</li>
            <li>RIA (RADIO IMMUNO ASSAY)</li>
            <li>Alcohol test is done by enzymatic method on Auto-analyzer by Blood enzyme assay</li>
        </ul>
    </div>

   @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif
       
    <div class="footer">
        
                <table>
           <tbody>
               <tr>
                   <td><br></td>
                   </tr>
                   <tr>
                       @if(isset($stm))
                     <td style="text-align:center"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->sign_upload))) }}" alt="Doctor Signature"
                    style="width: 100px; height: auto;"><br><span class="bt"> <p>{{  $emp->emp_name }}<br>Medical Examiner</p></td>
                            
                        @else  
                       <td style="text-align:center"><span class="bt"> <p>{{  $emp->emp_name }}<br>Medical Examiner</p></td>
                            
                        @endif
                          
                     @if(isset($stm))
                    <td><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->employee->stamp_upload))) }}" style="width: 100px; height: auto;"></td>
                    
                    @else
                    <td><div class="text-center"></div></td>
                    
                    @endif
                    
                    </tr>
                  
                    </tbody>

        </table>
        
    </div>
</div>

</body>
</html>
