<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bahamas Medical Examination Form</title>
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


        .vision-table {
            border-collapse: collapse;
            width: auto;
            /* let table size to its content */
        }

        .vision-table th,
        .vision-table td {
            border: 1px solid #000;
            padding: 4px 8px;
            text-align: center;
        }

        .vision-table th:first-child {
            text-align: left;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px; max-width: 800px;">
    <!-- Page 1 -->
    <div style="border:1px solid #000; padding:9px; margin-bottom:12px; page-break-after: always;">
        <h2 style="text-align:center; text-decoration:underline">Medical Examination Form</h2>
        <h3 style="color:red; text-align:center">CONFIDENTIAL FORM</h3>

        <div style="margin:15er 0;">
            <label>
                <input type="checkbox">
                <span style="margin-bottom: 2px; margin-right: 36px; display: inline-block;">Pre-sea Exam</span>
            </label>
            <label>
                <input type="checkbox"> <span style="margin-bottom: 2px;display: inline-block;">Periodic Exam
                </span></label><br>

            <div style="margin:0.5em 0">
                Name: <strong> {{ $data->seafarer->f_name ?? '' }} {{ $data->seafarer->m_name ?? '' }} {{ $data->seafarer->l_name ?? '' }}</strong><br>
            </div>
            <div style="margin:0.5em 0">
                DOB: <strong>{{ date('d/m/Y', strtotime($data->seafarer->dob)) }}</strong><br>
            </div>
            <div style="margin:0.5em 0">
                Nationality: <strong>INDIAN</strong><br>
            </div>
            <div style="margin:0.5em 0">
                Address: <strong>{{ $data->address }}</strong><br>
            </div>
            <div style="margin:0.5em 0">
                Passport: <strong>{{ $data->passport_no }}</strong>
            </div>

            {{-- <div style="margin:0.5em 0">
                Passport: <strong>P3278101</strong><br>
            </div> --}}

            <div style="margin:0.5em 0">
                Type of Ship (e.9. container, tanker, passenger, fishing):<strong>_________________</strong><br>
            </div>

            <div style="margin:0.5em 0">
                Trade Area (e.9., coastal, lropical, worldwide):<strong>_________________</strong>
            </div>
        </div>

        <div style="margin: 20px 0;">

            <div>
                <strong>Examinee's Personal Declaration
                </strong> <br>
                <em style="font-size: 12px;">(Assistance should be offered by medical staff)</em>
            </div>

            <table style="width: 100%; border-collapse: collapse; margin: 15px 0px; border: none; padding: 0px 15px;">
                <thead>
                    <tr>
                        <th style="padding: 6px; text-align: left;">Condition</th>
                        <th style="padding: 6px; width: 50px;">Yes</th>
                        <th style="padding: 6px; width: 50px;">No</th>
                        <th style="padding: 6px; text-align: left;">Condition</th>
                        <th style="padding: 6px; width: 50px;">Yes</th>
                        <th style="padding: 6px; width: 50px;">No</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td style="padding: 6px;">1. Eye / Vision problem</td>
                        <td style="text-align: center;">
                            <input type="checkbox">
                        </td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">18. Sleeping problems</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <!-- Row 2 -->
                    <tr>
                        <td style="padding: 6px;">2. High blood pressure</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">19. Do you smoke?</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <!-- Continue adding rows following the same pattern -->
                    <!-- Example for row 3 -->
                    <tr>
                        <td style="padding: 6px;">3. Heart / vascular disease</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">20. Operation / Surgery</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">4. Heart surgery</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">21. Epilepsy / Seizures</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>

                    <tr>
                        <td style="padding: 6px;">5. Varicose veins</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">22. Dizziness / Fainting</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">6. Asth ma/bronchitis</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">23. Loss of Consciousness</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">7. Blocd disorder</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">24. Psychiatric Problems</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">8. Dtabetes</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">25. Depression</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">9. Thyroid problem</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">26. Attempted Suicide</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">10. Digestive disorder</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">27. Loss of Memory</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">11. Kidney problem</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">28. Balance Problem</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">12. Skin problem</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">29. Severe Headaches</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">13. Allergies</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">30. Ear/Nose/Throat Problems</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">14. Infectious / Contagious diseases</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">31. Restricted Mobility</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">15. Hernia</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">32. Back problems</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">16. Centtal ciisorders</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">33. Ampulation</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                    <tr>
                        <td style="padding: 6px;">17. Pregnancy</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                        <td style="padding: 6px;">34. Fractures / Dislocations</td>
                        <td style="text-align: center;"><input type="checkbox"></td>
                        <td style="text-align: center;"><input type="checkbox" checked></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <hr>

        <table style="width:100%; margin: 0px !important; padding: 1em 0em;">
            <!-- Left block -->
            <td colspan="1">
                <span>B103 Rev.04</span>
                <span>Contact:</span>
            </td>

            <!-- Center block -->
            <td colspan="2" style="text-align: center;">
                <strong>Seafarer Medical Examination and Certificate</strong><br>
                <div style="text-align: center;">
                    <a href="stcw@bahamasmaritime.com">stcw@bahamasmaritime.com</a> <br>
                    <a href="mlc@bahamasmaritime.com">mlc@bahamasmaritime.com</a>
                </div>
            </td>

            <!-- Right block -->
            <td colstcn="1">
                <span>Page 19 of 28</span> <br>
                <span>+44 20 7562 1300</span>
            </td>
        </table>
    </div>

    <!-- Page 2 -->
    <div style="border:1px solid #000; padding:20px; margin:15px 0; page-break-after: always;">
        <div>
            <p style="font-style:italic; margin-bottom:10px;">
                If any of the above questions were answered "yes," please give details.
            </p>
            <div style="padding:50px; border:1px solid #ddd;">
                <span>NO</span>
            </div>
        </div>

        <div>
            <table style="width:100%; margin: 0px !important;">
                <h4>Additional Questions</h4>

                <tr>
                    <td style="padding:5px 0; width:70%"></td>
                    <td style="text-align:center">Yes</td>
                    <td style="text-align:center">No</td>
                </tr>

                <!-- Question 35 -->
                <tr>
                    <td style="padding:5px 0; width:70%">35. Have you ever been signed off as sick or repatriated from a
                        ship?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>
                <!-- Question 36 -->
                <tr>
                    <td style="padding:5px 0">36. Have you ever been hospitalized?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>
                <!-- Question 37 -->
                <tr>
                    <td style="padding:5px 0">37. Have you ever been declared unfit for sea duty?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>
                <!-- Question 38 -->
                <tr>
                    <td style="padding:5px 0">38. Has your medical certificate ever been restricted or revoked?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>
                <!-- Question 39 -->
                <tr>
                    <td style="padding:5px 0">39. Are you aware that you have any medical problems, diseases or
                        illnesses?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>
                <!-- Question 40 -->
                <tr>
                    <td style="padding:5px 0">40. Do you feel healthy and fit to perform the duties of your designated
                        position/occupation?</td>
                    <td style="text-align:center"> <input type="checkbox" checked></td>
                    <td style="text-align:center"><input type="checkbox"></td>
                </tr>
                <!-- Question 41 -->
                <tr>
                    <td style="padding:5px 0">41. Are you allergic to any medications?</td>
                    <td style="text-align:center"> <input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox" checked></td>
                </tr>

                <div style="width: 145%;">
                    <p style="font-style:italic; margin-bottom:10px;">
                        Comments
                    </p>
                    <div style="padding:50px; border:1px solid #ddd;">
                        <span>NO</span>
                    </div>
                </div>

                <!-- Question 42 -->
                <tr>
                    <td>42. Are you taking any non-prescription or
                        prescription medications?</td>
                    <td style="text-align:center"><input type="checkbox"></td>
                    <td style="text-align:center"><input type="checkbox"></td>
                </tr>

                <div style="width: 145%;">
                    <p style="font-style:italic">
                        If yes, please list the medications taken and the purpose(s) and dosage(s).
                    </p>
                    <div style="padding:50px; border:1px solid #ddd;">
                        <span>NO</span>
                    </div>
                </div>
            </table>


        </div>

        <hr>

        <table style="width:100%; margin: 0px !important; padding: 1em 0em;">
            <!-- Left block -->
            <td colspan="1">
                <span>B103 Rev.04</span>
                <span>Contact:</span>
            </td>

            <!-- Center block -->
            <td colspan="2" style="text-align: center;">
                <strong>Seafarer Medical Examination and Certificate</strong><br>
                <div style="text-align: center;">
                    <a href="stcw@bahamasmaritime.com">stcw@bahamasmaritime.com</a> <br>
                    <a href="mlc@bahamasmaritime.com">mlc@bahamasmaritime.com</a>
                </div>
            </td>

            <!-- Right block -->
            <td colstcn="1">
                <span>Page 19 of 28</span> <br>
                <span>+44 20 7562 1300</span>
            </td>
        </table>
    </div>

    <!-- Page 3 -->
    <div style="border:1px solid #000; padding:20px; margin:15px 0;">
        <!-- Certification Section -->
        <div style="margin-bottom:15px;">
            <p>I hereby certify that the personal declaration above is a true statement to the best of my knowledge.</p>

            <table>
                <tr>
                    <td colspan="2" style="padding:12px"> Signature of Examinee:
                        <img src="{{ $signatureImage }}" alt="Signature of Examinee" style="max-height: 100px;">
                    </td>
                    <td colspan="2" style="padding:12px">
                        Date: <strong>{{ $data->medicalapproval->issue_date }}</strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="padding:12px">
                        Witnessed By: <u>__________________________</u><br>
                    </td>
                    <td colspan="2" style="padding:12px">
                        Name: <u>__________________________</u>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Authorization Section -->
        <div style="margin-bottom:12px;">
            <p>I hereby authorize the release of all my previous medical records to Dr. {{ $data->employee->emp_name }}</u></p>

            <table>
                <tr>
                    <td colspan="2" style="padding:12px"> Signature of Examinee:
                        <u>___________________</u>
                    </td>
                    <td colspan="2" style="padding:12px">
                        Date: <strong>19 / 02 / 2024</strong>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="padding:12px">
                        Witnessed By: <u>__________________________</u><br>
                    </td>
                    <td colspan="2" style="padding:12px">
                        Name: <u>__________________________</u>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Medical Examination Type -->
        <div style="margin-bottom:20px;">
            <span style="margin-right: 36px; display: inline-block;"> Medical Examination:</span>

            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Pre-sea</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Peroidic</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Other</span>
            </label>
        </div>

        <!-- Vision Table -->
        <div class="vision-container">
            <table>
                <td colspan="2">
                    <!-- Visual Acuity Table -->
                    <table class="vision-table">
                        <thead>
                            <tr>
                                <th rowspan="2">SIGHT</th>
                                <th colspan="6">Visual Acuity</th>
                            </tr>
                            <tr>
                                <th colspan="3">Unaided</th>
                                <th colspan="3">Aided</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Right Eye</th>
                                <th>Left Eye</th>
                                <th>Binocular</th>
                                <th>Right Eye</th>
                                <th>Left Eye</th>
                                <th>Binocular</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Distant</th>
                                <td>6/6</td>
                                <td>6/6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Near</th>
                                <td>6/6</td>
                                <td>6/6</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>

                <td colspan="2">
                    <!-- Visual Fields Table -->
                    <table class="vision-table" style="margin-left: 9px;">
                        <thead>
                            <tr>
                                <th colspan="3">Visual Fields</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Normal</th>
                                <th>Defective</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Right Eye</th>
                                <td><strong>NORMAL</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Left Eye</th>
                                <td><strong>NORMAL</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </table>
        </div>

        <!-- Color Vision Type -->
        <div style="margin:18px 0px;">
            <span style="margin-right: 36px; display: inline-block;"> Color Vision:</span>

            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Not Tested</span>
            </label>
            <label>
                <input type="checkbox" checked>
                <span style="margin-right: 36px; display: inline-block;">Normal</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Doubtful</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Defective</span>
            </label>
        </div>
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
            function getTestResult($id, $tests, $finalResults) {
                $testName = $tests[$id] ?? '';
                return $finalResults[$testName]['candidate'] ?? $finalResults[$testName]['doctor'] ?? '-';
            }
        @endphp
        <table>
            <td colspan="2">
                <table class="vision-table">
                    <thead>
                        <tr>
                            <th rowspan="2">HEARING</th>
                            <th colspan="6">
                                Pure Tone &amp; Audiometry<br>
                                <small>(threshold values in dB)</small>
                            </th>
                        </tr>
                        <tr>
                            <th>500 Hz</th>
                            <th>1,000 Hz</th>
                            <th>2,000 Hz</th>
                            <th>3,000 Hz</th>
                            <th>4,000 Hz</th>
                            <th>6,000 Hz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Right Ear</th>
                            <td>{{ getTestResult($earTestIds['right']['500'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['right']['1000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['right']['2000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['right']['3000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['right']['4000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['right']['6000'], $tests, $finalResults) }}</td>
                        </tr>
                        <tr>
                            <th>Left Ear</th>
                            <td>{{ getTestResult($earTestIds['left']['500'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['left']['1000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['left']['2000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['left']['3000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['left']['4000'], $tests, $finalResults) }}</td>
                            <td>{{ getTestResult($earTestIds['left']['6000'], $tests, $finalResults) }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td colspan="2">
                <!-- Speech & Whisper Test Table -->
                <table class="vision-table" style="margin-left: 9px;">
                    <thead>
                        <tr>
                            <th colspan="3">
                                Speech & Whisper Test<br>
                                <small>(metres)</small>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>Normal</th>
                            <th>Whisper</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Right Ear</th>
                            <td><strong>NORMAL</strong></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Left Ear</th>
                            <td><strong>NORMAL</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </table>

        <!-- Physical Measurements -->
        {{-- <table>
            <tr>
                <td colspan="2" style="padding:9px"> Height: <u>172</u> (cm)
                </td>
                <td colspan="2" style="padding:9px">
                    Weight: <u> 80 </u> (kg)</strong>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Pulse rate: <u>  80  </u> (bpm) 
                </td>
                <td colspan="2" style="padding:9px">
                    Rhythm: <u>  18  </u>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Blood pressure: Systolic: <u> 120 </u> (mm Hg) 
                </td>
                <td colspan="2" style="padding:9px">
                    Diastolic: <u> 80 </u> (mm Hg)<br>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Urinalysis: Glucose: <u> ABSENT </u> 
                </td>
                <td colspan="2" style="padding:9px">
                    Protein: <u> ABSENT </u>
                </td>
            </tr>
        </table> --}}
        @php
            // Helper to format values with fallback
            function showVal($val, $suffix = '', $default = '-') {
                return !empty($val) ? $val . $suffix : $default;
            }
        @endphp

        <table>
            <tr>
                <td colspan="2" style="padding:9px">
                    Height: <u>{{ showVal($physicalResults[25] ?? '-', ' (cm)') }}</u>
                </td>
                <td colspan="2" style="padding:9px">
                    Weight: <u>{{ showVal($physicalResults[26] ?? '-', ' (kg)') }}</u>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Pulse rate: <u>{{ showVal($physicalResults[29] ?? '-', ' (bpm)') }}</u>
                </td>
                <td colspan="2" style="padding:9px">
                    Rhythm: <u>{{ showVal($physicalResults[30] ?? '-') }}</u>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Blood pressure: Systolic<u>{{ showVal($physicalResults[28] ?? '-', ' (mm Hg)') }}</u>
                </td>
                <td colspan="2" style="padding:9px">
                    Diastolic: <u> 80 </u> (mm Hg)<br>
                </td>
            </tr>

            <tr>
                <td colspan="2" style="padding:9px">
                    Urinalysis: Glucose: <u> ABSENT </u> 
                </td>
                <td colspan="2" style="padding:9px">
                    Protein: <u> ABSENT </u>
                </td>
            </tr>
        </table>


        <hr>

        <table style="width:100%; margin: 0px !important; padding: 1em 0em;">
            <!-- Left block -->
            <td colspan="1">
                <span>B103 Rev.04</span>
                <span>Contact:</span>
            </td>

            <!-- Center block -->
            <td colspan="2" style="text-align: center;">
                <strong>Seafarer Medical Examination and Certificate</strong><br>
                <div style="text-align: center;">
                    <a href="stcw@bahamasmaritime.com">stcw@bahamasmaritime.com</a> <br>
                    <a href="mlc@bahamasmaritime.com">mlc@bahamasmaritime.com</a>
                </div>
            </td>

            <!-- Right block -->
            <td colstcn="1">
                <span>Page 19 of 28</span> <br>
                <span>+44 20 7562 1300</span>
            </td>
        </table>
    </div>

    <!-- Page 4 -->
    <div style="padding:10px; margin:10px 0; page-break-inside: always;">
        <table style="width:100%; border-collapse:collapse; margin-top:10px;">
            <!-- Header Row -->
            <tr>
                <th style="padding: 6px; text-align: left;">Name</th>
                <th style="padding: 6px; width: 50px;">Normal / Abnormal</th>
                <th style="padding: 6px; text-align: left;">Name</th>
                <th style="padding: 6px; width: 50px;">Normal / Abnormal</th>
            </tr>

            <!-- Data Rows -->
            <tr>
                <td style="padding:6px;">Head</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Skin</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Sinuses, Nose & Throat</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Varicose Veins</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Mouth / Teeth</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Vascular (inc. pedal pulses)</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Ears (general)</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Abdomen & Viscera</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Tympanic Membrane</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Hernia</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Eyes</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Anus (not rectal exam)</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Ophthalmoscopy</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">G-U System</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Pupils</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Upper & Lower Extremities</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Eye movement</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Spine (C/S: 7/5 & L/s)</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Lungs and chest</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Neurologic (full brief)</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Breast Examination</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">Psychiatric</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
            <tr>
                <td style="padding:6px;">Heart</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
                <td style="padding:6px;">General Appearance</td>
                <td style="text-align:center;"> <input type="checkbox"></td>
            </tr>
        </table>

        <!-- X-Ray Section -->
        <div style="margin:18px 0px;">
            <span style="margin-right: 36px; display: inline-block;"> Chest X-Ray:</span>

            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Not Performed</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Performed</span>
            </label>
            <span></span>
            <span style="margin-right: 36px; display: inline-block;"> 05 / 02 /
                2024</span>
        </div>

        <!-- Test Results -->
        <strong style="text-decoration: underline;">Results:</strong>
        <table style="width:100%; margin-bottom:10px;">
            <tr>
                <th style="width:50%; padding:4px; text-align: left;">Test</th>
                <th style="width:50%; padding:4px; text-align: left;">Result</th>
            </tr>
            <tr>
                <td style="padding:3px;">HAEMOGLOBIN</td>
                <td style="padding:3px;">14.2</td>
            </tr>
            <tr>
                <td style="padding:3px;">WBC</td>
                <td style="padding:3px;">6,900</td>
            </tr>
            <tr>
                <td style="padding:3px;">PLATELETS</td>
                <td style="padding:3px;">1.74</td>
            </tr>
            <tr>
                <td style="padding:3px;">ESR</td>
                <td style="padding:3px;">05</td>
            </tr>
            <tr>
                <td style="padding:3px;">SGOT</td>
                <td style="padding:3px;">34</td>
            </tr>
            <tr>
                <td style="padding:3px;">SGPT</td>
                <td style="padding:3px;">54</td>
            </tr>
            <tr>
                <td style="padding:3px;">X-RAY</td>
                <td style="padding:3px;">WNL</td>
            </tr>
            <tr>
                <td style="padding:3px;">ECG & USG</td>
                <td style="padding:3px;">NORMAL</td>
            </tr>
            <tr>
                <td style="padding:3px;">HIV & HbsAg, HCV</td>
                <td style="padding:3px;">NEGATIVE</td>
            </tr>
            <tr>
                <td style="padding:3px;">DRUG OF ABUSE</td>
                <td style="padding:3px;">NEGATIVE</td>
            </tr>
            <tr>
                <td style="padding:3px;">URINE ROUTINE</td>
                <td style="padding:3px;">NORMAL</td>
            </tr>
        </table>

        <!-- Comments Section -->
        <div style="border:1px solid #000; padding:18px; background-color:#f8f8f8;">
            <h4 style="margin:0 0 10px 0;">Medical practitioner's comments:</h4>
            <p style="margin:0;">
                CANDIDATE IS FIT AT PRESENT. ALL BLOOD INVESTIGATION REPORT AND RADIOLOGICAL REPORT ARE WITHIN NORMAL
                LIMIT
            </p>
        </div>

        <!-- Vaccination status Section -->
        <div style="margin:12px 0px;">
            <span style="margin-right: 36px; display: inline-block;"> Vaccination Status Recorded:</span>

            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Yes</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">No</span>
            </label>
        </div>

        <hr>

        <table style="width:100%; margin: 0px !important; padding: 1em 0em;">
            <!-- Left block -->
            <td colspan="1">
                <span>B103 Rev.04</span>
                <span>Contact:</span>
            </td>

            <!-- Center block -->
            <td colspan="2" style="text-align: center;">
                <strong>Seafarer Medical Examination and Certificate</strong><br>
                <div style="text-align: center;">
                    <a href="stcw@bahamasmaritime.com">stcw@bahamasmaritime.com</a> <br>
                    <a href="mlc@bahamasmaritime.com">mlc@bahamasmaritime.com</a>
                </div>
            </td>

            <!-- Right block -->
            <td colstcn="1">
                <span>Page 19 of 28</span> <br>
                <span>+44 20 7562 1300</span>
            </td>
        </table>
    </div>

    <!-- Page 5 -->
    <div style="border:1px solid #000; padding:20px; margin:15px 0; page-break-inside: avoid;">
        <div>
            <strong>Assessment of Fitness for Service at Sea
            </strong>
        </div>

        <p style="margin-bottom:15px;">On the basis of the examinee's personal declaration, my clinical examination and
            the diagnostic test results recorded above, I declare the examinee medically:</p>

        <!-- Vaccination status Section -->
        <div style="margin:12px 0px;">
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Fit for look-out
                    duty</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Not fit for look-out
                    duty</span>
            </label>
        </div>

        <table border="1" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th></th>
                    <th>Deck Service</th>
                    <th>Engine Service</th>
                    <th>Catering Service</th>
                    <th>Other Services</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fit</td>
                    <td style="text-align: center;"><input type="checkbox" name="deck_fit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="engine_fit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="catering_fit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="other_fit" /></td>
                </tr>
                <tr>
                    <td>Unfit</td>
                    <td style="text-align: center;"><input type="checkbox" name="deck_unfit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="engine_unfit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="catering_unfit" /></td>
                    <td style="text-align: center;"><input type="checkbox" name="other_unfit" /></td>
                </tr>
            </tbody>
        </table>

        <!-- Restriction Section -->
        <div style="margin:18px 0px;">
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">Without restrictions</span>
            </label>
            <label>
                <input type="checkbox">
                <span style="margin-right: 36px; display: inline-block;">With restrictions</span>
            </label>
        </div>

        <div style="width: 145%;">
            <p style="font-style:italic; margin-bottom:10px;">
                Describe Restrictions (e.g., specific positions, type of ship, trade area):
            </p>
            <div style="padding:50px; border:1px solid #ddd;">
                <span>WITHOUT ANY RESTRICTION</span>
            </div>
        </div>

        <div style="width: 145%;">
            <p style="font-style:italic; margin-bottom:10px;">
                Action Taken by Medical Examiner (e.g. referral)
            </p>
            <div style="padding:50px; border:1px solid #ddd;">
            </div>
        </div>

        <table>
            <tr>
                <td colspan="4" style="padding:12px"> Place of Examination:
                    <u>SHANKAR HOSPITAL AND RESEARCH CENTER HALDAWN LUTTRAKHAND_263139</u>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding:12px">
                    Date of Examination: <u>29/01/200</u>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding:12px">
                    Medical Certificate's Date of Examination: <u>29/01/200</u>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding:12px">
                    Signature of Medical Practitioner: <u>Dr. MRAGESH PATNI</u>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding:12px">
                    Name of Medical Practitioner: <u>Click or tap here to enter text.</u>
                </td>
            </tr>

            <tr>
                <td colspan="4" style="padding:12px">
                    Authorized by: <u>Click or tap here to enter text.</u>
                </td>
            </tr>
        </table>
    </div>

    <hr>

    <table style="width:100%; margin: 0px !important; padding: 1em 0em;">
        <!-- Left block -->
        <td colspan="1">
            <span>B103 Rev.04</span>
            <span>Contact:</span>
        </td>

        <!-- Center block -->
        <td colspan="2" style="text-align: center;">
            <strong>Seafarer Medical Examination and Certificate</strong><br>
            <div style="text-align: center;">
                <a href="stcw@bahamasmaritime.com">stcw@bahamasmaritime.com</a> <br>
                <a href="mlc@bahamasmaritime.com">mlc@bahamasmaritime.com</a>
            </div>
        </td>

        <!-- Right block -->
        <td colstcn="1">
            <span>Page 19 of 28</span> <br>
            <span>+44 20 7562 1300</span>
        </td>
    </table>
    </div>
</body>

</html>