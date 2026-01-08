@php
function getTestResult($id, $specialTests) {
return $specialTests['by_id'][$id] ?? '-';
}
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Medical Fitness Certificate (Part A & B)</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        .s1 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 11pt;
        }

        .s2 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s3 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        .s4 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        .s5 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
            vertical-align: -5pt;
        }

        .s6 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s7 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: bold;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s8 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: italic;
            font-weight: normal;
            text-decoration: none;
            font-size: 7.5pt;
        }

        .s9 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 8.5pt;
        }

        .s10 {
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: bold;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l1 {
            padding-left: 0pt;
        }

        #l1>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: Symbol, serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l2 {
            padding-left: 0pt;
            counter-reset: d1 1;
        }

        #l2>li>*:first-child:before {
            counter-increment: d1;
            content: counter(d1, decimal)". ";
            color: black;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
        }

        #l2>li:first-child>*:first-child:before {
            counter-increment: d1 0;
        }

        li {
            display: block;
        }

        #l3 {
            padding-left: 0pt;
        }

        #l3>li>*:first-child:before {
            content: " ";
            color: black;
            font-family: Symbol, serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        li {
            display: block;
        }

        #l4 {
            padding-left: 0pt;
            counter-reset: f1 35;
        }

        #l4>li>*:first-child:before {
            counter-increment: f1;
            content: counter(f1, decimal)". ";
            color: black;
            font-family: Arial, sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 9pt;
        }

        #l4>li:first-child>*:first-child:before {
            counter-increment: f1 0;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }

        .page-break {
            page-break-before: always;
            /* or page-break-after: always; */
            break-before: page;
            /* Modern property */
        }

        @media print {
            .page-break {
                break-before: page;
            }
        }
    </style>


</head>

<body style="font-family: Arial, sans-serif; font-size: 14px; margin: 20px;">

    <table
        style="border-collapse:collapse; margin-left:5.709pt; margin-right:50pt !important; width:96%; margin-top:25px;"
        cellspacing="0">
        <tr style="height:11pt">
            <td style="width:82%;">
                <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">
                <p class="s1"
                    style="padding-top: 2pt;padding-left: 34pt;padding-right: 34pt;text-indent: 0pt;text-align: center; font-size:12pt;">
                    Medical fitness certificate issued in compliance with ILO / IMO guidelines of the medical
                    examinations for seafarers</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </p>
            </td>

            <td style="width:14%;">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                    <img width="150" height="60" data-ghost-classes="bg-color-entity-ghost-background"
                        data-ghost-url="https://static.licdn.com/aero-v1/sc/h/9c8pery4andzj6ohjkjp54ma2" alt=""
                        aria-busy="false"
                        src="https://media.licdn.com/dms/image/v2/D4E03AQHlI9Jh6aEVeA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680245678977?e=2147483647&amp;v=beta&amp;t=8duW5yfL0YjLIgmcUO2gTd8D3YlWkNv9TjQ0B8qKd6Y">
                </p>
            </td>
        </tr>


        <tr style="height:11pt">
            <td style="width:14%;" colspan="2">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">

                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Merchant Shipping
                    Directorate </p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Malta,</p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Centre, Marsa MRS1917, Malta Tel: +356 21250360 / +356 99067197 <br />
                    (AOH) Fax: +356 21241460 E-Mail: applica.stcw@transport.gov.mt</p>
                </p>
            </td>
        </tr>
    </table>

    <p style="text-indent: 0pt; text-align: left"><br /></p>
    <table style="border-collapse: collapse; margin-left: 7.52999pt; width:100%;" cellspacing="0">
        <tr style="height: 26pt">
            <td style="
        width: 463pt;
        border-top-style: solid;
        border-top-width: 2pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;  background-color: #d8d8d8;
      " colspan="3">
                <p class="s1" style="
          padding-top: 6pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    PART A – To be completed by applicant
                </p>
            </td>
        </tr>
        <tr style="height: 35pt">
            <td style="
        width: 154pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Surname (Family Name)
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    PATIL
                </p>
            </td>
            <td style="
        width: 151pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    First Name
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    DIPAK
                </p>
            </td>
            <td style="
        width: 158pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Second Name
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    SURYAKANT
                </p>
            </td>
        </tr>
        <tr style="height: 35pt">
            <td style="
        width: 154pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Date of Birth
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    25/NOV./2025
                </p>
            </td>
            <td style="
        width: 151pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Country of Birth
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    INDIA
                </p>
            </td>
            <td style="
        width: 158pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 4pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Nationality
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    {{ $data->nationality_id == 1 ? 'Indian' : '' }}
                </p>
            </td>
        </tr>
        <tr style="height: 35pt">
            <td style="
        width: 463pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      " colspan="3">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Department
                </p>

                <p class="s3" style="
          padding-top: 10pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Deck </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Engine </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Radio </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Other </span>
                    <span style="margin-bottom: 2px; display: inline-block;">Please specify: </span>
                </p>
            </td>
        </tr>
        <tr style="height: 35pt">
            <td style="
        width: 305pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      " colspan="2">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Passport No. / Discharge Book No. / Identity Card No.
                </p>
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    IND-1453-8556-9985-7851
                </p>
            </td>
            <td style="
        width: 158pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      ">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 4pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Gender
                </p>
                <p class="s3" style="
          padding-top: 6pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    <span style="margin-bottom: 2px; display: inline-block;">Male </span> <input type="checkbox">
                    <span style="margin-bottom: 2px; display: inline-block;">Female </span> <input type="checkbox">
                </p>
            </td>
        </tr>
        <tr style="height: 69pt">
            <td style="
        width: 463pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      " colspan="3">
                <p class="s2" style="
          padding-top: 2pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Address
                </p>
                <p class="s2" style="
          padding-top: 7pt;
          padding-left: 5pt;
          text-indent: 0pt;
          text-align: left;
        ">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                </p>
            </td>
        </tr>



        <tr style="height: 69pt">
            <td style="
        width: 463pt;
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
      " colspan="3">
                <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Applicant`s
                    personal
                    declaration (Assistance should be offered by medical staff)</p>
                <ul>
                    <li>
                        <p class="s3"
                            style="padding-top: 5pt; padding-bottom: 5pt; padding-left: 22pt; text-indent: -17pt;text-align: left;">
                            &bull; Have you ever had any of the following conditions:</p>
                    </li>
                </ul>
            </td>
        </tr>

        <tr class="s3">
            <td style=" 
        border-top-style: solid;
        border-top-width: 1pt;
        border-left-style: solid;
        border-left-width: 1pt;
        border-bottom-style: solid;
        border-bottom-width: 1pt;
        border-right-style: solid;
        border-right-width: 1pt;
        padding-left: 5pt;
      " colspan="3">
                <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; border-collapse: collapse;"
                    class="s2">


                    <tr class="s3">
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 40%;">Condition</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">Yes</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">No</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 40%;">Condition</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">Yes</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">No</th>
                    </tr>


                    <tr class="s3">
                        <td>1. Eye / vision problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>18. Sleep problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>2. High blood pressure</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>19. Do you smoke, use alcohol or drugs?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>3. Heart / vascular disease</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>20. Operation / surgery</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>4. Heart surgery</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>21. Epilepsy / seizures</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>5. Varicose veins / piles</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>22. Dizziness / fainting</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>6. Asthma / bronchitis</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>23. Loss of consciousness</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>7. Blood disorder</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>24. Psychiatric problems</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>8. Diabetes</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>25. Depression</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>9. Thyroid problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>26. Attempted suicide</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>10. Digestive disorder</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>27. Loss of memory</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>11. Kidney problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>28. Balance problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>12. Skin problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>29. Severe headache</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>13. Allergies</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>30. Ear (hearing/tinnitus)/nose/throat problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>14. Infectious / contagious diseases</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>31. Restricted mobility</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>15. Hernia</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>32. Back or joint problem</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>16. Genital disorder</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>33. Amputation</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td>17. Pregnancy</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td>34. Fractures / dislocations</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <p style="padding-top: 0pt;text-indent: 0pt;text-align: left;"><br /></p>
    <table
        style="border-collapse:collapse; margin-left:5.709pt; margin-right:50pt !important; width:96%; margin-top:25px;"
        cellspacing="0">
        <tr style="height:11pt">
            <td style="width:82%;">
                <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">
                <p class="s1"
                    style="padding-top: 2pt;padding-left: 34pt;padding-right: 34pt;text-indent: 0pt;text-align: center; font-size:12pt;">
                    Medical fitness certificate issued in compliance with ILO / IMO guidelines of the medical
                    examinations for seafarers</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </p>
            </td>

            <td style="width:14%;">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                    <img width="150" height="60" data-ghost-classes="bg-color-entity-ghost-background"
                        data-ghost-url="https://static.licdn.com/aero-v1/sc/h/9c8pery4andzj6ohjkjp54ma2" alt=""
                        aria-busy="false"
                        src="https://media.licdn.com/dms/image/v2/D4E03AQHlI9Jh6aEVeA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680245678977?e=2147483647&amp;v=beta&amp;t=8duW5yfL0YjLIgmcUO2gTd8D3YlWkNv9TjQ0B8qKd6Y">
                </p>
            </td>
        </tr>


        <tr style="height:11pt">
            <td style="width:14%;" colspan="2">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">

                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Merchant Shipping
                    Directorate </p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Malta,</p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Centre, Marsa MRS1917, Malta Tel: +356 21250360 / +356 99067197 <br />
                    (AOH) Fax: +356 21241460 E-Mail: applica.stcw@transport.gov.mt</p>
                </p>
            </td>
        </tr>
    </table>

    <table style="border-collapse:collapse;margin-left:7.52999pt; width:100%; padding-top: 10pt;" cellspacing="0">

        <tr style="height:43pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <table border="0" cellspacing="0" cellpadding="0"
                    style=" margin-top: 10pt; width: 100%; border-collapse: collapse;" class="s2">

                    <tr class="s3">
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 90%; padding-left: 5px;">
                            &bull; Additional questions: </th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">Yes</th>
                        <th align="left" valign="middle" style="padding-bottom:7px; width: 5%;">No</th>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">35. Have you ever been signed off as sick or repatriated from a
                            ship?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">36. Have you ever been hospitalized?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">37. Have you ever been declared unfit for sea duty?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">38. Has your medical certificate ever been restricted or revoked?
                        </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">39. Are you aware that you have any medical problems, diseases or
                            illnesses?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>


                    <tr class="s3">
                        <td style="padding-left:5px;">40. Do you feel healthy and fit to perform the duties of your
                            designated position / occupation?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                    <tr class="s3">
                        <td style="padding-left:5px;">41. Are you allergic to any medication?</td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                        <td align="left" valign="middle"><input type="checkbox"> </td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr style="height:43;">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Comments:
                </p>
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">lorenLorem
                    ipsum dolor sit amet consectetur adipisicing elit. Consequuntur, aspernatur facilis reprehenderit ut
                    libero eum molestiae voluptate, </p>
            </td>
        </tr>
        <tr style="height:32pt">
            <td
                style="width:400pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p style="padding-top: 8pt;text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">42. Are you taking any
                    non-prescription or prescription medications?</p>
            </td>
            <td
                style="width:32pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Yes</p>
                <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;text-align: left;"><input
                        type="checkbox"></p>
            </td>
            <td
                style="width:31pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p class="s3" style="padding-top: 2pt;text-indent: 0pt;text-align: center;">No</p>
                <p class="s3" style="padding-top: 2pt;text-indent: 0pt;text-align: center;"><input type="checkbox"></p>
            </td>
        </tr>

        <tr style="height:43pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-top: 2pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">If
                    <i><b>yes</b></i>, please list the medications taken, and the purpose/s and dosage/s:
                </p>
            </td>
        </tr>
        <tr style="height:133pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s4" style="padding-top: 2pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">Applicant
                    must sign personal declaration in the presence of a duly qualified medical practitioner who will be
                    filling PART B of this medical report</p>
                <p class="s3" style="padding-top: 6pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">I hereby
                    certify that the personal declaration above is a true statement to the best of my knowledge.
                    Furthermore, I authorize the release of all my records from any health professionals, health
                    institutions and public authorities to the appointed medical practitioner.</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 67pt;text-indent: 0pt;text-align: left;">Applicant`s Signature</p>
                <p class="s3" style="padding-left: 13pt;text-indent: 0pt;line-height: 10pt;text-align: left;">(Signed in
                    the presence of medical practitioner) <sapn class="s3"
                        style="padding-left: 250pt;text-indent: 0pt;line-height: 10pt;text-align: left;">Date:</sapn>
                </p>

            </td>
        </tr>
    </table>

    <div class="page-break"></div>

    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <table
        style="border-collapse:collapse; margin-left:5.709pt; margin-right:50pt !important; width:96%; margin-top:10px;"
        cellspacing="0">
        <tr style="height:11pt">
            <td style="width:82%;">
                <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">
                <p class="s1"
                    style="padding-top: 2pt;padding-left: 34pt;padding-right: 34pt;text-indent: 0pt;text-align: center; font-size:12pt;">
                    Medical fitness certificate issued in compliance with ILO / IMO guidelines of the medical
                    examinations for seafarers</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </p>
            </td>

            <td style="width:14%;">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                    <img width="150" height="60" data-ghost-classes="bg-color-entity-ghost-background"
                        data-ghost-url="https://static.licdn.com/aero-v1/sc/h/9c8pery4andzj6ohjkjp54ma2" alt=""
                        aria-busy="false"
                        src="https://media.licdn.com/dms/image/v2/D4E03AQHlI9Jh6aEVeA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680245678977?e=2147483647&amp;v=beta&amp;t=8duW5yfL0YjLIgmcUO2gTd8D3YlWkNv9TjQ0B8qKd6Y">
                </p>
            </td>
        </tr>


        <tr style="height:11pt">
            <td style="width:14%;" colspan="2">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">

                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Merchant Shipping
                    Directorate </p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Malta,</p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Centre, Marsa MRS1917, Malta Tel: +356 21250360 / +356 99067197 <br />
                    (AOH) Fax: +356 21241460 E-Mail: applica.stcw@transport.gov.mt</p>
                </p>
            </td>
        </tr>
    </table>


    <p style="padding-top: 5pt;text-indent: 0pt;text-align: left; "><br /></p>
    <table style="border-collapse:collapse;margin-left:5.36999pt; width: 100%;" cellspacing="0">
        <tbody>
            <tr style="height:26pt">
                <td style="width: 463pt; border-top-style: solid; border-top-width: 2pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt;   background-color: #d8d8d8;"
                    colspan="15">
                    <p class="s1" style="padding-top: 6pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">PART B –
                        To be completed by a duly qualified medical practitioner</p>
                </td>
            </tr>
            <tr style="height:16pt">
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Medical
                        Examination</p>
                </td>
            </tr>


            <tr style="height:13pt">
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Height
                    </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 58pt;text-indent: 0pt;text-align: left;">(cm)
                    </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Weight
                    </p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-left: 50pt;text-indent: 0pt;text-align: left;">(kg)
                    </p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Pulse
                        Rate
                    </p>
                </td>
                <td style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="4">
                    <p class="s6" style="padding-top: 1pt;padding-left: 52pt;text-indent: 0pt;text-align: left;">/
                        (minute)
                    </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 4pt;text-indent: 0pt;text-align: center;">Rhythm
                    </p>
                </td>
                <td
                    style="border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td style="width:232pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="4">
                    <p class="s6" style="padding-top: 2pt;padding-left: 74pt;text-indent: 0pt;text-align: left;">Blood
                        pressure (mm HG)</p>
                </td>
                <td style="width:236pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="11">
                    <p class="s6" style="padding-top: 2pt;text-indent: 0pt;text-align: center;">Urinalysis</p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:57pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 15pt;text-indent: 0pt;text-align: left;">
                        Systolic
                    </p>
                </td>
                <td
                    style="width:58pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:61pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 15pt;text-indent: 0pt;text-align: left;">
                        Diastolic
                    </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:39pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Glucose
                    </p>
                </td>
                <td style="width:37pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:41pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 1pt;padding-left: 9pt;text-indent: 0pt;text-align: left;">Protein
                    </p>
                </td>
                <td style="width:38pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:32pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: center;">Blood
                    </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>


            <tr style="height:5pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p style="text-indent: 0pt;text-align: left; height:6px;">&nbsp;</p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p class="s7" style="padding-top: 3pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Sight
                        (Table
                        on the “Minimum in-service eyesight standards for seafarers” is found on page 4 of this medical
                        report)</p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td style="width:115pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Use of
                        glasses or contact lenses:</p>
                </td>
                <td style="width:91pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;"
                    colspan="12">
                    <p class="s6" style="padding-top: 1pt;padding-left: 3pt;text-indent: 0pt;text-align: left;">Yes
                        <input type="checkbox"> No <input type="checkbox">
                    </p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:40pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:268pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="8">
                    <p class="s8" style="padding-top: 1pt;text-indent: 0pt;text-align: center;">Visual acuity</p>
                </td>
                <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="5">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:148pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="5">
                    <p class="s8" style="padding-top: 1pt;text-indent: 0pt;text-align: center;">Visual fields</p>
                </td>
            </tr>


            <tr style="height:13pt">
                <td style="width:40pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:136pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-right: 1pt;text-indent: 0pt;text-align: center;">
                        Unaided</p>
                </td>
                <td style="width:132pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="5">
                    <p class="s6" style="padding-top: 1pt;padding-right: 2pt;text-indent: 0pt;text-align: center;">Aided
                    </p>
                </td>
                <td style="width:148pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="5">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Right
                        eye
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Left eye
                    </p>
                </td>
                <td
                    style="width:48pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">
                        Binocular
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-right: 6pt;text-indent: 0pt;text-align: right;">Right
                        eye
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Left eye
                    </p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">
                        Binocular
                    </p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 2pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Right
                        eye
                    </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-right: 1pt;text-indent: 0pt;text-align: center;">Left
                        eye
                    </p>
                </td>
            </tr>


            <tr style="height:13pt">
                <td
                    style="width:40pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Distant
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:48pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Normal
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>


            <tr style="height:13pt">
                <td
                    style="width:40pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Near</p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:48pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">
                        Defective
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>



            <tr style="height:13pt">
                <td style="width:115pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="2">
                    <p class="s8" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Colour
                        vision <span class="s6">Not tested</span></p>
                </td>
                <td
                    style="width:91pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;">
                    </p>
                    <p class="s6" style="padding-top: 2pt;padding-left: 37pt;text-indent: 0pt;text-align: left;">Normal
                    </p>
                </td>
                <td
                    style="width:13pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:76pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="8">
                    <p style="text-indent: 0pt;text-align: left;">
                    </p>
                    <p class="s6" style="padding-top: 2pt;padding-left: 34pt;text-indent: 0pt;text-align: left;">
                        Doubtful
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 2pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">
                        Defective
                    </p>
                </td>
            </tr>

            <tr style="height:5pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p style="text-indent: 0pt;text-align: left; height:6px;">&nbsp;</p>
                </td>
            </tr>



            <tr style="height:16pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Hearing
                    </p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:262pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="8">
                    <p class="s8" style="padding-top: 1pt;padding-left: 46pt;text-indent: 0pt;text-align: left;">Pure
                        tone
                        and audiometry (threshold values in dB)</p>
                </td>
                <td style="width:12pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    rowspan="4">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:148pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="5">
                    <p class="s8" style="padding-top: 1pt;padding-left: 17pt;text-indent: 0pt;text-align: left;">Speech
                        and
                        whisper test (metres)</p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 9pt;text-indent: 0pt;text-align: left;">500 Hz
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">1000 Hz
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">2000 Hz
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-right: 5pt;text-indent: 0pt;text-align: right;">3000
                        Hz
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">4000 Hz
                    </p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s6" style="padding-top: 1pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">6000 Hz
                    </p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 1pt;padding-left: 12pt;text-indent: 0pt;text-align: left;">Normal
                    </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-right: 1pt;text-indent: 0pt;text-align: center;">
                        Whisper
                    </p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Right
                        ear
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Right
                        ear
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:13pt">
                <td
                    style="width:46pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Left ear
                    </p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:44pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:45pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:47pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s6" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Left ear
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:5pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p style="text-indent: 0pt;text-align: left; height:6px;">&nbsp;</p>
                </td>
            </tr>



            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Normal
                    </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-left: 10pt;text-indent: 0pt;text-align: left;">
                        Abnormal
                    </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p class="s3" style="padding-top: 2pt;padding-left: 8pt;text-indent: 0pt;text-align: left;">Normal
                    </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p class="s3" style="padding-top: 2pt;padding-right: 4pt;text-indent: 0pt;text-align: center;">
                        Abnormal
                    </p>
                </td>
            </tr>


            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">1. Head
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">13. Skin
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">2.
                        Sinuses,
                        nose, throat</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">14.
                        Varicose
                        veins</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">3. Mouth
                        /
                        teeth</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s9" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">15.
                        Vascular
                        (inc. pedal pulses)</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">4. Ears
                        (general)</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">16.
                        Abdomen
                        and viscera</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">5.
                        Tympanic
                        membrane</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">17.
                        Hernia
                    </p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">6. Eyes
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">18. Anus
                        (not rectal exam)</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">7.
                        Ophthalmoscopy</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">19. G-U
                        system</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">8.
                        Pupils
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s9" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">20.
                        Upper
                        and lower extremities</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">9. Eye
                        movement</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">21.
                        Spine
                        (C/S, T/S and L/S)</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">10.
                        Lungs
                        and chest</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">22.
                        Neurologic (full brief)</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">11.
                        Breast
                        examination</p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">23.
                        Psychiatric</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:16pt">
                <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="3">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">12.
                        Heart
                    </p>
                </td>
                <td
                    style="width:43pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:56pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td style="width:135pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="7">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">24.
                        General
                        appearance</p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="2">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="padding-left: 19pt;text-indent: 0pt;text-align: left;"><input type="checkbox"
                            style="padding-bottom: 5pt; width:12pt; height:12pt;"> </p>
                </td>
            </tr>

            <tr style="height:5pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p style="text-indent: 0pt;text-align: left; height:6pt;"><br></p>
                </td>
            </tr>


            <tr style="height:13pt">
                <td style="width:115pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="3">
                    <p class="s4" style="padding-top: 1pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Chest
                        X-ray</p>
                </td>
                <td style="width:91pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt;"
                    colspan="12">
                    <p class="s6" style="padding-top: 1pt;padding-left: 3pt;text-indent: 0pt;text-align: left;">Not
                        performed <input type="checkbox"> Performed on <input type="checkbox"></p>
                </td>
            </tr>


            <tr style="height:27pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p class="s3" style="padding-top: 7pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Results:
                    </p>
                </td>
            </tr>

            <tr style="height:5pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p style="text-indent: 0pt;text-align: left; height:3pt;"><br></p>
                </td>
            </tr>

            <tr style="height:32pt">
                <td style="width:219pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="3">
                    <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Other
                        diagnostic test/s and results:</p>
                    <p class="s3" style="padding-top: 5pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Test:
                    </p>
                </td>
                <td
                    style="width:13pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:76pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="5">
                    <p style="padding-top: 8pt;text-indent: 0pt;text-align: left;"><br></p>
                    <p class="s3" style="padding-left: 12pt;text-indent: 0pt;text-align: left;">Result:</p>
                </td>
                <td
                    style="width:12pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:29pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:18pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td style="width:52pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt"
                    colspan="2">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
                <td
                    style="width:49pt;border-top-style:solid;border-top-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                </td>
            </tr>

            <tr style="height:59pt">
                <td style="width:468pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                    colspan="15">
                    <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Medical
                        practitioner`s comments and assessment for fitness, with reasons for any limitations: &nbsp;
                        &nbsp; </p>
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                    <p style="text-indent: 0pt;text-align: left;"><br></p>
                    <p class="s3" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Vaccination status
                        recorded: &nbsp; &nbsp; Yes <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; No
                        <input type="checkbox">
                    </p>
                </td>
            </tr>


        </tbody>
    </table>


    <div class="page-break"></div>

    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <table
        style="border-collapse:collapse; margin-left:5.709pt; margin-right:50pt !important; width:96%; margin-top:10px;"
        cellspacing="0">
        <tr style="height:11pt">
            <td style="width:82%;">
                <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">
                <p class="s1"
                    style="padding-top: 2pt;padding-left: 34pt;padding-right: 34pt;text-indent: 0pt;text-align: center; font-size:12pt;">
                    Medical fitness certificate issued in compliance with ILO / IMO guidelines of the medical
                    examinations for seafarers</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </p>
            </td>

            <td style="width:14%;">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                    <img width="150" height="60" data-ghost-classes="bg-color-entity-ghost-background"
                        data-ghost-url="https://static.licdn.com/aero-v1/sc/h/9c8pery4andzj6ohjkjp54ma2" alt=""
                        aria-busy="false"
                        src="https://media.licdn.com/dms/image/v2/D4E03AQHlI9Jh6aEVeA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680245678977?e=2147483647&amp;v=beta&amp;t=8duW5yfL0YjLIgmcUO2gTd8D3YlWkNv9TjQ0B8qKd6Y">
                </p>
            </td>
        </tr>


        <tr style="height:11pt">
            <td style="width:14%;" colspan="2">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">

                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Merchant Shipping
                    Directorate </p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Malta,</p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Centre, Marsa MRS1917, Malta Tel: +356 21250360 / +356 99067197 <br />
                    (AOH) Fax: +356 21241460 E-Mail: applica.stcw@transport.gov.mt</p>
                </p>
            </td>
        </tr>
    </table>


    <p style="padding-top: 5pt;text-indent: 0pt;text-align: left; "><br /></p>


    <table style="border-collapse:collapse;margin-left:7.52999pt; width:100%;" cellspacing="0">
        <tr style="height:26pt">
            <td style="width: 463pt; border-top-style: solid; border-top-width: 2pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; background-color: #d8d8d8;"
                colspan="3">
                <p class="s1" style="padding-top: 6pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Medical
                    certificate for service at sea</p>
            </td>
        </tr>

        <tr style="height: 35pt">
            <td
                style=" width: 154pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;  ">
                    Surname (Family Name)
                </p>
                <p class="s2" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    PATIL
                </p>
            </td>
            <td
                style=" width: 151pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    First Name
                </p>
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    DIPAK
                </p>
            </td>
            <td
                style=" width: 158pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    Second Name
                </p>
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    SURYAKANT
                </p>
            </td>
        </tr>
        <tr style="height: 35pt">
            <td
                style=" width: 154pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    Date of Birth
                </p>
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    25/NOV./2025
                </p>
            </td>
            <td
                style=" width: 151pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt;">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    Country of Birth
                </p>
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    INDIA
                </p>
            </td>
            <td
                style=" width: 158pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 4pt; text-indent: 0pt; text-align: left; ">
                    Nationality
                </p>
                <p class="s2" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; "> INDIAN
                </p>
            </td>
        </tr>


        <tr style="height: 35pt">
            <td style=" width: 463pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; "
                colspan="3">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    Department
                </p>

                <p class="s3" style=" padding-top: 10pt; padding-left: 5pt; text-indent: 0pt; text-align: left; ">
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Deck </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Engine </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Radio </span>
                    <input type="checkbox"> <span style="margin-bottom: 2px; display: inline-block;">Other </span>
                    <span style="margin-bottom: 2px; display: inline-block;">Please specify: </span>
                </p>
            </td>
        </tr>

        <tr style="height: 35pt">
            <td style=" width: 305pt; border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt;"
                colspan="2">
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    Passport No. / Discharge Book No. / Identity Card No.
                </p>
                <p class="s2" style=" padding-top: 2pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    IND-1453-8556-9985-7851
                </p>
            </td>
            <td
                style="width: 158pt;border-top-style: solid;border-top-width: 1pt;border-left-style: solid;border-left-width: 1pt;border-bottom-style: solid;border-bottom-width: 1pt;border-right-style: solid;border-right-width: 1pt; ">
                <p class="s2" style=" padding-top: 2pt; padding-left: 4pt; text-indent: 0pt; text-align: left;">
                    Gender
                </p>
                <p class="s3" style=" padding-top: 6pt; padding-left: 5pt; text-indent: 0pt; text-align: left;">
                    <span style="margin-bottom: 2px; display: inline-block;">Male </span> <input type="checkbox">
                    <span style="margin-bottom: 2px; display: inline-block;">Female </span> <input type="checkbox">
                </p>
            </td>
        </tr>

        <tr style="height:5pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Declaration
                    of duly qualified medical practitioner</p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-top: 2pt;padding-right: 9pt;text-indent: 0pt;text-align: right;">Yes &nbsp;
                    &nbsp; &nbsp; &nbsp; No</p>
            </td>
        </tr>


        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block;  text-align: left;">Confirmation
                        that applicant`s identification documents were checked ? </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 294px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block;  text-align: left;">Hearing meets the
                        standards in STCW Code, section A-I/9? </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 350px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block;  text-align: left;">Visual acuity meets
                        standards in STCW Code, section A-I9? </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 350px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block;  text-align: left;">Colour vision meets
                        standards in STCW Code, section A-I9? </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 345px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block; text-align: left;">Visual aid required?
                    </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 565px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block;  text-align: left;">Fit for lookout duties?
                    </span>

                    <span
                        style="margin-top: 5px; padding-top: 5pt; display: inline-block; text-align: right; padding-left: 555px; ">
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>


        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-left: 5pt; text-indent: 0pt;">
                    <span style="margin-bottom: 2px; display: inline-block; padding-right:30px; text-align: left;">Is
                        applicant suffering from any medical condition likely to be aggravated by service at sea or to
                        render the seafarer unfit for such service or to endanger the health of other persons on board?
                        <input type="checkbox"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox">
                    </span>
                </p>
            </td>
        </tr>

        <tr style="height:37pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3"
                    style="padding-top: 2pt;padding-left: 5pt;padding-right: 69pt;text-indent: 0pt;text-align: justify; height:6px;">
                </p>
            </td>
        </tr>
        <tr style="height:27pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s10"
                    style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;line-height: 106%;text-align: left;">This
                    is to certify that I have examined the applicant and that my findings are recorded in this medical
                    report</p>
            </td>
        </tr>
        <tr style="height:69pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Result:</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 37pt;text-indent: 0pt;text-align: left;">
                <p class="s3" style=" padding-top: 6pt; padding-left: 5pt; text-indent: 0pt; text-align: center;">
                    <span style="margin-bottom: 2px; display: inline-block;">Fit for Sea Duty </span> <input
                        type="checkbox"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="margin-bottom: 2px; display: inline-block;">Unfit for Sea Duty </span> <input
                        type="checkbox">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="margin-bottom: 2px; display: inline-block;">**Fit with limitations or restrictions
                    </span> <input type="checkbox">
                </p>
                </p>
                <p style="padding-top: 5pt;text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">**Please specify limitations
                    or restrictions, if any:</p>
            </td>
        </tr>
        <tr style="height:5pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p style="text-indent: 0pt;text-align: left; height: 6pt;"><br /></p>
            </td>
        </tr>
        <tr style="height:54pt">
            <td style="width:238pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="2">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 22pt;text-indent: 0pt;line-height: 10pt;text-align: left;">Signature
                    of duly qualified medical practitioner</p>
            </td>
            <td
                style="width:225pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="text-indent: 0pt;text-align: center;">Applicant`s Signature</p>
                <p class="s3" style="text-indent: 0pt;line-height: 10pt;text-align: center;">(Signed in the presence of
                    medical practitioner)</p>
            </td>
        </tr>
        <tr style="height:53pt">
            <td style="width:238pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="2">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 60pt;text-indent: 0pt;line-height: 10pt;text-align: left;">Medical
                    practitioner`s stamp</p>
            </td>
            <td
                style="width:225pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                <p class="s3" style="padding-left: 70pt;text-indent: 0pt;line-height: 10pt;text-align: left;">Date of
                    Examination</p>
            </td>
        </tr>
        <tr style="height:5pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p style="text-indent: 0pt;text-align: left; height:6px"><br /></p>
            </td>
        </tr>
        <tr style="height:16pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s4" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Validity</p>
            </td>
        </tr>
        <tr style="height:40pt">
            <td style="width:463pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                colspan="3">
                <p class="s2" style="padding-top: 9pt;padding-left: 77pt;text-indent: -72pt;text-align: left;">This
                    medical certificate shall remain valid for a maximum period of two years unless the seafarer is
                    under the age of 18, in which case the maximum period of validity shall be one year.</p>
            </td>
        </tr>
    </table>





    <div class="page-break"></div>

    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <table
        style="border-collapse:collapse; margin-left:5.709pt; margin-right:50pt !important; width:96%; margin-top:10px;"
        cellspacing="0">
        <tr style="height:11pt">
            <td style="width:82%;">
                <p style="padding-top: 1pt;text-indent: 0pt;text-align: center;">
                <p class="s1"
                    style="padding-top: 2pt;padding-left: 34pt;padding-right: 34pt;text-indent: 0pt;text-align: center; font-size:12pt;">
                    Medical fitness certificate issued in compliance with ILO / IMO guidelines of the medical
                    examinations for seafarers</p>
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                </p>
            </td>

            <td style="width:14%;">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">
                    <img width="150" height="60" data-ghost-classes="bg-color-entity-ghost-background"
                        data-ghost-url="https://static.licdn.com/aero-v1/sc/h/9c8pery4andzj6ohjkjp54ma2" alt=""
                        aria-busy="false"
                        src="https://media.licdn.com/dms/image/v2/D4E03AQHlI9Jh6aEVeA/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1680245678977?e=2147483647&amp;v=beta&amp;t=8duW5yfL0YjLIgmcUO2gTd8D3YlWkNv9TjQ0B8qKd6Y">
                </p>
            </td>
        </tr>


        <tr style="height:11pt">
            <td style="width:14%;" colspan="2">
                <p class="s2" style="margin-top: 5pt;padding-left: 1pt;text-indent: 0pt;text-align: center;">

                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Merchant Shipping
                    Directorate </p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Malta,</p>
                <p style="margin-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; font-size:8pt;">Transport
                    Centre, Marsa MRS1917, Malta Tel: +356 21250360 / +356 99067197 <br />
                    (AOH) Fax: +356 21241460 E-Mail: applica.stcw@transport.gov.mt</p>
                </p>
            </td>
        </tr>
    </table>


<table style="border-collapse:collapse;margin-left:7.52999pt; margin-top:60pt; width:100%;" cellspacing="0">
    <tbody>
        <tr>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    STCW
                    Convention
                    regulation </p>
            </td>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Category of seafarer </p>
            </td>
            <td colspan="2" class="s3"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Distance vision Aided </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Near/immediate
                    vision </p>
            </td>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Colour Visual </p>
            </td>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Visual Fields </p>
            </td>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Night
                    blindness*
                </p>
            </td>
            <td rowspan="2"
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Diplopia (double vision)* </p>
            </td>
        </tr>
        <tr>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    One eye </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Other eye </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Both eyes
                    together, aided
                    or unaided </p>
            </td>
        </tr>
        <tr>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    I/11<br />
                    II/1<br />
                    II/2<br />
                    II/3<br />
                    II/4<br />
                    II/5<br />
                    VII/2 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Masters,
                    deck officers
                    and ratings
                    required to
                    undertake
                    look-out
                    duties </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.5<sup>2</sup> </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.5 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required for ship's navigation (e.g.,
                    chart and
                    nautical
                    publication
                    reference, use of
                    bridge
                    instrumentation
                    and equipment,
                    and
                    identification of
                    aids to
                    navigation) </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    See Note 6 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Normal
                    Vision
                    Fields
                </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required to perform all necessary functions in darkness without compromise </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    No significant
                    condition
                    evident </p>
            </td>
        </tr>
        <tr>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    I/11 <br />
                    III/1<br />
                    III/2<br />
                    III/3<br />
                    III/4<br />
                    III/5<br />
                    III/6<br />
                    III/7<br />
                    VII/2 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    All engineer officers, electro-technical ratings and ratings or others forming part

                    of an engine- room watch </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.4<sup>5</sup> </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.4 (See Note 5) </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required to read instruments in close proximity, to operate equipment, and to indentify
                    systems/ components as necessary </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    See Note 7 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Sufficient
                    Vision
                    Fields
                </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required to perform all necessary functions in darkness without compromise </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    No significant
                    condition
                    evident </p>
            </td>
        </tr>
        <tr>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    I/11 <br />
                    IV/2 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    GMDSS Radio operators </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.4 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    0.4 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required to read instruments in close proximity, to operate equipment, and to indentify
                    systems/ components as necessary </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    See Note 7 </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Sufficient
                    Vision
                    Fields
                </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    Vision required to perform all necessary functions in darkness without compromise </p>
            </td>
            <td
                style="border-top-style: solid; border-top-width: 1pt; border-left-style: solid; border-left-width: 1pt; border-bottom-style: solid; border-bottom-width: 1pt; border-right-style: solid; border-right-width: 1pt; ">
                <p class="s3" style="padding-top: 2pt;padding-left: 5pt;text-indent: 0pt;text-align: left; ">
                    No significant
                    condition
                    evident </p>
            </td>
        </tr>
    </tbody>
</table>


    <p class="s2" style="padding-top: 9pt; text-align: left;"><strong>Notes:</strong></p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">1 Values given in Snellen decimal notation.</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">2 A value of at least 0.7 in one eye is recommended to
        reduce the risk of undetected underlying eye disease.</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">3 As defined in the International Recommendations for
        Colour Vision Requirements for Transport by the Commission Internationale de l'Eclairage (CIE-143-2001 including
        any subsequent versions).</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">4 Subject to assessment by a clinical vision specialist
        where indicated by initial examination findings.</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">5 Engine department personnel shall have a combined
        eyesight vision of at least 0.4.</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">6 CIE colour vision standard 1 or 2.</p>
    <p class="s2" style="padding-top: 9pt; text-align: left;">7 CIE colour vision standard 1. 2 or 3.</p>


</body>

</html>