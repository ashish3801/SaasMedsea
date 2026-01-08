<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dental Examination report</title>
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
        
    }
    .table, .table th, .table td {
        border: 1px solid black;
    }
    .table th, .table td {
        padding: 5px;
        text-align: center;
        font-size: 15px;
    }

    .footer {
     
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
 
            <h4>REPORT OF DENTAL EXAMINATION</h4>
       
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
                <tr>
            <td>Date of Birth</td>
            <td><strong>{{ Carbon\Carbon::parse($data->Seafarer->dob)->format('d M Y') }}</strong></td>
           </td>
           <tr> <td>Place of Birth</td>
            <td><strong>{{ $data->Seafarer->pob }}</strong></td>
            <td></td>
            <td><strong></strong></td>
        </tr></tr>
        
          <tr>
            <td>Sex</td>
            <td>@if ($data->seafarer->sex == 1)
                    Male
                @else
                    Female
                @endif
            </td>
        </tr>
        
    </table>


            <h4>Dental Examination</h4>
       
    <table class="table">
         
          <tr>
            <th>Test</th>
            <th>Result</th>
        </tr>
        
         <tr>
            <td>Dental Carries Present</td>
            <td><strong>{{ $testResults[207]['value'] ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>Carries Experience</td>
            <td><strong>{{ $testResults[208]['value'] ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>Uncorrected Caries</td>
            <td><strong>{{ $testResults[209]['value'] ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>Soft Tissue Pathology</td>
            <td><strong>{{ $testResults[210]['value'] ?? '-' }}</strong></td>
        </tr>
        <tr>
            <td>Maloccusion</td>
            <td><strong>{{ $testResults[211]['value'] ?? '-' }}</strong></td>
        </tr>
        
    </table>


<p style="margin-top:50px">ORAL HEALTH STATUS : <Strong>{{ $testResults[206]['value'] ?? '-' }}</Strong></p>
<p>TREATMENT REQUIRED : <Strong>{{ $testResults[212]['value'] ?? '-' }}</Strong></p>


   @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif
       

        
                <table>
           <tbody>
          
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
                    <td><div class="text-center" style="width: 100px; height: auto;"></div></td>
                    
                    @endif
                    
                    </tr>
                  
                    </tbody>

        </table>
       
           <div class="footer"> 
      <p>Note:
          <ol>
              <li>Urgent Treatment   (Abscess, nerve Exposure, Advance Disease State include Pain, Infection and Swelling</li>
              <li>Restorative Care   (Amalgams, Composite, Crowns, etc.)</li>
               <li>Preventive Care   (Sealants / Flouride treatment, Prophylaxis)</li>
               <li>Other   (Periodontal / Orthodontic)</li>
               
          </ol>
      </p>
        
        
        
        
        
    </div>
</div>

</body>
</html>
