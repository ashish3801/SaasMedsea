<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cholera Card</title>
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
            <td><h4 style="">INTERNATIONAL CERTIFICATE OF VACCINATION OR REVACCINATION AGAINST CHOLERA</h4>
            </tr>
            <tr><td><h4 class="mp-0" style="">CERTIFICATE INTERNATIONAL DE VACCINATION OU DE REVACCINATION CENTRE LA CHOLERA </h4></div>
            </td>
        </tr>
    </table> 
 
<table style="text-align: left; font-size: 12px; width: 100%;">
    <!-- Certification Line -->
    <tr>
        <td colspan="2">
            <p style="max-width: 200px; padding: 5px;">
                यह प्रमाणित किया जाता है कि</br> This is to certify that  </br>Jesoussigne (e) certifie que
            </p>
        </td>
        <td colspan="2" style="text-align: left; vertical-align: middle;">
            <p style="margin: 0;">
                <span style="font-size: 24px;">}</span>
                <strong>{{ $data->Seafarer->f_name }} {{ $data->Seafarer->m_name }} {{ $data->Seafarer->l_name }}</strong>
            </p>
        </td>
    </tr>

    <!-- Date of Birth & Place of Birth -->
    <tr>
        <td style="text-align: left;">
            जन्म तिथि<br>Date of Birth<br>né(e) le
        </td>
        <td style="vertical-align: middle;">
            <span style="font-size: 24px;">}</span>
            <strong>{{ $data->Seafarer->dob ?? 'N/A' }}</strong>
        </td>
        <td style="text-align: left;">
            जन्म स्थान<br>Place of Birth<br>lieu de naissance
        </td>
        <td style="vertical-align: middle;">
            <span style="font-size: 24px;">}</span>
            <strong>{{ $data->Seafarer->birth_place ?? 'N/A' }}</strong>
        </td>
    </tr>
    
        <tr>
        <td colspan="2">
            <p style="max-width: 200px; padding: 5px;">हस्ताक्षर हैं</br> Whose signature follows </br>don't la signature suit     </p>
        </td>
        <td colspan="2" style="text-align: left; vertical-align: middle;">
            <p style="margin: 0;">
                <span style="font-size: 24px;">}</span>
                <strong>{{ $data->Seafarer->f_name }} {{ $data->Seafarer->m_name }} {{ $data->Seafarer->l_name }}</strong>
            </p>
        </td>
    </tr>
    
      <tr>
        <td colspan="2">
            <p style="max-width: 200px; padding: 5px;">पासपोर्ट नं.</br>Passport No.suit     </p>
        </td>
        <td colspan="2" style="text-align: left; vertical-align: middle;">
            <p style="margin: 0;">
                <span style="font-size: 24px;">}</span>
                <strong>{{ $data->Seafarer->f_name }} {{ $data->Seafarer->m_name }} {{ $data->Seafarer->l_name }}</strong>
            </p>
        </td>
    </tr>
    
       <tr>
        <td colspan="4">
<p style="padding: 5px;">बताई गई तिथि को हैजा के विरुद्ध टीका लगाया गया है या पुनः टीका लगाया गया है</br>has on the date indicated been vaccinated or revaccinated against cholera.</br>
            a eie vaccine(e) ou revaccine(e) contre le cholera a la date indidquee</p>
        </td>
       
    </tr>

</table>


       
   
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
            <td><strong>{{ $data->Seafarer->dob }}</strong></td>
           </td>
           <tr> <td>Place of Birth</td>
            <td><strong>{{ $data->Seafarer->pob }}</strong></td>
            <td></td>
            <td><strong></strong></td>
        </tr></tr>
        
          <tr>
            <td>Sex</td>
            <td><strong>{{ $data->Seafarer->sex }}</strong></td>
            <td></td>
            <td><strong></strong></td>
        </tr>
        
    </table>


            <h4>Dental Examination</h4>
       
    <table class="table">
         
          <tr>
            <th>Test</th>
            <th>Result</th>
        </tr>
        
         <tr>
            <td>Show dental test name</td>
            <td><strong>Show dental test result 207 </strong></strong> </td>
        </tr>
                 <tr>
            <td>Show dental test name</td>
            <td><strong>Show dental test result 208</strong></strong> </td>
        </tr>
        
         <tr>
            <td>Show dental test name</td>
            <td><strong>Show dental test result 209</strong></strong> </td>
        </tr>
        <tr>
            <td>Show dental test name</td>
            <td><strong>Show dental test result 210</strong></strong> </td>
        </tr>
        <tr>
            <td>Show dental test name</td>
            <td><strong>Show dental test result 211</strong></strong> </td>
        </tr>
        
    </table>


<p style="margin-top:50px">ORAL HEALTH STATUS : <Strong>Show here result of test ID 206</Strong></p>
<p>TREATMENT REQUIRED : <Strong>Show here result of test ID 212</Strong></p>


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
