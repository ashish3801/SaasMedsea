<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Audiometry test report</title>
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
        margin: 0px;
        padding: 0px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .container {
        
        max-width: 100%;
        margin: 5px;
        padding: 10px;
        /* padding: 20px; */
        
        border: 1px solid #000;
    }
    
    .mp-0 {
          margin: 0;
            padding: 0;
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
        padding: 2px;
        text-align: center;
       
    }

    .footer {
     
        margin-top: 20px;
        font-size: 12px;
    }
     
    .audiogram-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-top: 20px;
      width: 100%;
      gap: 40px;
    }

    .audiogram-box {
      width: 48%;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .audiogram-title {
      font-weight: bold;
      margin-bottom: 10px;
      font-size: 16px;
    }

    .audiogram-table {
      border-collapse: collapse;
      font-size: 12px;
      text-align: center;
    }

    .audiogram-table th,
    .audiogram-table td {
      border: 1px solid #000;
      width: 40px;
      height: 22px;
    }

    /*.vertical-label {*/
    /*  writing-mode: vertical-rl;*/
    /*  transform: rotate(180deg);*/
    /*}*/

    .left-marker {
      color: blue;
      font-weight: bold;
    }

    .right-marker {
      color: red;
      font-weight: bold;
    }
    .symbol-table {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 14px;
    }


</style>
</head>
<body>

<div class="container">
 
  <div style="margin-left: 6pt; padding-top: 5px;">
    <table>
        <tr style="border: 1pt solid #000">
            <td>
                <p style="text-align: center; margin:2px 0px;"> 
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/' . $data->clinic->logo))) }}"  alt="Clinic Logo"  style="height: 70px"  >
                </p>
            </td>
            <td>
                <div style="text-align: center;">
                <h1 style="color: #34427d;">{{ $data->clinic->name }}</h1>
                <p style="">{{ $data->clinic->add }}</p> 
                 <p style="">{{ $data->clinic->email }} | {{ $data->clinic->phone }} </p> 
                </div>
            </td>
        </tr>
    </table> 
   </div>
 
            <h4 style="text-align:center;margin-top:10px;">AUDIOGRAM CHART</h4>
       
    
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
            <td>Reg. No.</td>
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
            <td>Company</td>
            <td><strong>{{ $data->company }}</strong></td>
        </tr>
        
    </table>
    
  <!-- Audiogram Charts -->
<table width="100%" cellspacing="0" cellpadding="0" style="text-align: center; margin-bottom: 20px;">
    <tr>
        <td width="50%">
            <strong>LEFT</strong><br>
            <img src="{{ $leftChartImage }}" alt="Left Ear Chart" width="100%">
        </td>
        <td width="50%">
            <strong>RIGHT</strong><br>
            <img src="{{ $rightChartImage }}" alt="Right Ear Chart" width="100%">
        </td>
    </tr>
</table>

<!-- Symbol Legend + Threshold Info -->
        <table width="100%" cellspacing="0" cellpadding="0">
            <tr>
                <!-- Symbol Key Table -->
                <td width="60%" valign="top">
                    <table class="table symbol-table">
            <tr>
                <th rowspan="2">Ear</th>
                <th colspan="2">Air Conduction</th>
                <th colspan="2">Bone Conduction</th>
                <th rowspan="2">Color Code</th>
            </tr>
            <tr>
                <th>Masked</th>
                <th>Unmasked</th>
                <th>Masked</th>
                <th>Unmasked</th>
            </tr>
            <tr>
                <td><strong>Left</strong></td>
                <td>△</td> <!-- U+25B3 -->
                <td>✖</td> <!-- U+2716 -->
                <td>]</td>
                <td>&lt;</td>
                <td style="color: blue;"><strong>Blue</strong></td>
            </tr>
            <tr>
                <td><strong>Right</strong></td>
                <td>☐</td> <!-- U+2610 -->
                <td>○</td> <!-- U+25CB -->
                <td>[</td>
                <td>&gt;</td>
                <td style="color: red;"><strong>Red</strong></td>
            </tr>
        </table>
        </td>

        <!-- Threshold Summary Table -->
        <td width="40%" valign="top">
            <table class="table" border="1" cellpadding="5" cellspacing="0" style="width: 100%; margin-left: 20px;">
                <tr>
                    <th colspan="3">Threshold in dB</th>
                </tr>
                <tr>
                    <td></td>
                    <td>Left</td>
                    <td>Right</td>
                </tr>
                <tr>
                    <td>Air Conduction</td>
                    <td>Unmasked</td>
                    <td>Unmasked</td>
                </tr>
                <!-- Add more rows dynamically as needed -->
            </table>
        </td>
    </tr>
</table>


<p style="margin-top:20px">
    Right Ear: <strong>{{ $specialTests['by_id'][89] ?? 'N/A' }}</strong><br>
    Left Ear: <strong>{{ $specialTests['by_id'][90] ?? 'N/A' }}</strong><br>
    Advice: <strong>{{ $specialTests['by_id'][213] ?? 'N/A' }}</strong>
</p>


   @if ($data->medicalApproval?->attach_stamp_sign == 1)
       @php $stm = 1; @endphp
       @elseif ($data->medicalApproval?->attach_stamp_sign == 0)
       @php $stm = null; @endphp
       @else
       @php $stm = null; @endphp
       @endif
       

        
                <table style="margin-top:20px">
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
        
       

</div>

</body>
</html>
