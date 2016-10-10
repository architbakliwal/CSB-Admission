<?php

require_once('loaddata.php');

// die();

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('CSBTeam');
$pdf->SetAuthor('CSBTeam');
$pdf->SetTitle($lang['dashboard_title']);
$pdf->SetSubject($lang['dashboard_title']);

// set default header data
$pdf->setPrintHeader(false);

// set header and footer fonts
// $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 10);

$image_file = K_PATH_IMAGES.'logo.jpg';
$pdf->Image($image_file, 0, 15, 0, 0, 'JPG', '', 'M', false, 150, 'C', false, false, 1, false, false, false);

$pdf->Ln(6);

$pdf->writeHTML($lang['dashboard_title'], true, false, false, false, 'C');

$pdf->Ln(1);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------

// NON-BREAKING ROWS (nobr="true")

$tbl = <<<EOD
<style>
    body {
        padding: 40px;
    }
    table {

    }
    table th {
        background-color: #103F56;
        text-align: left;
        font-size: 15px;
        font-weight: bold;
        color: #ffffff;
    }
    table td {
        text-align: left;
    }
    .specialrow {
        background-color:#BFBFBF;
        text-align:left;
        font-size:11px;
        font-weight:bold;
    }
    .tablestyle {

    }
    .boldstyle {
        font-weight: bold;
    }
</style>
<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <td colspan="4" align="left" style="text-align:left; font-size:18px; font-weight:bold; padding:7px;">Application ID: $application_id</td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Personal Details</th>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Name of Applicant:</td>
        <td colspan="3">$f_name $m_name $l_name</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Date of Birth:</td>
        <td>$user_dob</td>
        <td class="boldstyle">Gender:</td>
        <td>$gender</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">How did you hear of CSB?</td>
        <td>$hear_abt_csb</td>
        <td class="boldstyle">Please specify</td>
        <td>$hear_abt_csb_others</td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Contact Details</th>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Email Address:</td>
        <td>$email_id</td>
        <td class="boldstyle">Mobile Number:</td>
        <td>$mobile_number</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Phone Number:</td>
        <td colspan="3">$phone_number</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Current Address</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Address:</td>
        <td colspan="3">$current_address_line1, $current_address_line2, $current_address_line3</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">City:</td>
        <td>$current_address_city</td>
        <td class="boldstyle">Country:</td>
        <td>$current_address_country</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">State:</td>
        <td>$current_address_state</td>
        <td class="boldstyle">State others:</td>
        <td>$current_address_state_other</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Pin/Zip:</td>
        <td colspan="3">$current_address_pin</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Permanent Address</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Same as current:</td>
        <td colspan="3">$permanent_same_as_current_address</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Address:</td>
        <td colspan="3">$permanent_address_line1, $permanent_address_line2, $permanent_address_line3</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">City:</td>
        <td>$permanent_address_city</td>
        <td class="boldstyle">Country:</td>
        <td>$permanent_address_country</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">State:</td>
        <td>$permanent_address_state</td>
        <td class="boldstyle">State others:</td>
        <td>$permanent_address_state_other</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Pin/Zip:</td>
        <td colspan="3">$permanent_address_pin</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Parent’s/Guardian’s Details</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Full Name:</td>
        <td>$parent_name</td>
        <td class="boldstyle">Mobile number:</td>
        <td>$parent_mobile</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Your relation to contact:</td>
        <td>$parent_relation</td>
        <td class="boldstyle">Organisation:</td>
        <td>$parent_organisation</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Designation:</td>
        <td>$parent_designation</td>
        <td class="boldstyle">Academic Qualification:</td>
        <td>$parent_qualification</td>
    </tr>
</table>
<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Academic Qualifications</th>
    </tr>
</table>

EOD;

$pdf->writeHTML($tbl, false, false, false, false, '');

$y = '';
$x = 1;
for($i=0; $i<=$extra_academic_added_count; $i++) {
    $iqualification = "qualification{$y}";
    $iinstitute = "institute{$y}";
    $iboard = "board{$y}";
    $iyearofpassing = "yearofpassing{$y}";
    $iaggregate = "aggregate{$y}";
    $iacademicachivements = "academicachivements{$y}";

    $tbl = <<<EOD
    <style>
        body {
            padding: 40px;
        }
        table {

        }
        table th {
            background-color: #103F56;
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
        }
        table td {
            text-align: left;
        }
        .specialrow {
            background-color:#BFBFBF;
            text-align:left;
            font-size:11px;
            font-weight:bold;
        }
        .tablestyle {

        }
        .boldstyle {
            font-weight: bold;
        }
    </style>
    <table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
        <tr nobr="true">
            <td class="boldstyle">Qualification:</td>
            <td>$acads[$iqualification]</td>
            <td class="boldstyle">Institute:</td>
            <td>$acads[$iinstitute]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Board:</td>
            <td>$acads[$iboard]</td>
            <td class="boldstyle">Year of passing:</td>
            <td>$acads[$iyearofpassing]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Aggregate Marks (% or GPA):</td>
            <td colspan="3">$acads[$iaggregate]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Please enter you academic awards, extra-curricular achievements and positions of responsibility held, if any. (Max 200 words):</td>
            <td colspan="3">$acads[$iacademicachivements]</td>
        </tr>
    </table>

EOD;

    $pdf->writeHTML($tbl, false, false, false, false, '');

    $y = $x;
    $x = $x + 1;
}

$tbl = <<<EOD
<style>
    body {
        padding: 40px;
    }
    table {

    }
    table th {
        background-color: #103F56;
        text-align: left;
        font-size: 15px;
        font-weight: bold;
        color: #ffffff;
    }
    table td {
        text-align: left;
    }
    .specialrow {
        background-color:#BFBFBF;
        text-align:left;
        font-size:11px;
        font-weight:bold;
    }
    .tablestyle {

    }
    .boldstyle {
        font-weight: bold;
    }
</style>
<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Work Experience</th>
    </tr>
</table>
EOD;


$pdf->writeHTML($tbl, false, false, false, false, '');

$y = '';
$x = 1;
for($i=0; $i<=$extra_workex_count; $i++) {
    $iorganizationname = "organizationname{$y}";
    $ilocation = "location{$y}";
    $idesignation = "designation{$y}";
    $iworkstarted = "workstarted{$y}";
    $iworkcompleted = "workcompleted{$y}";
    $ictc = "ctc{$y}";
    $irolesandresponsibility = "rolesandresponsibility{$y}";

    $tbl = <<<EOD
    <style>
        body {
            padding: 40px;
        }
        table {

        }
        table th {
            background-color: #103F56;
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
        }
        table td {
            text-align: left;
        }
        .specialrow {
            background-color:#BFBFBF;
            text-align:left;
            font-size:11px;
            font-weight:bold;
        }
        .tablestyle {

        }
        .boldstyle {
            font-weight: bold;
        }
    </style>
    <table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
        <tr nobr="true">
            <td class="boldstyle">Name of the organisation:</td>
            <td>$workex[$iorganizationname]</td>
            <td class="boldstyle">Location (city):</td>
            <td>$workex[$ilocation]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Designation:</td>
            <td>$workex[$idesignation]</td>
            <td class="boldstyle">Total CTC in INR:</td>
            <td>$workex[$ictc]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Started work in (YYYY-MM-DD):</td>
            <td>$workex[$iworkstarted]</td>
            <td class="boldstyle">Completed work in (YYYY-MM-DD):</td>
            <td>$workex[$iworkcompleted]</td>
        </tr>
        <tr nobr="true">
            <td class="boldstyle">Please give a brief description of your role and achievements in the organisation. (Max 200 words):</td>
            <td colspan="3">$workex[$irolesandresponsibility]</td>
        </tr>
    </table>
EOD;

    $pdf->writeHTML($tbl, false, false, false, false, '');

    $y = $x;
    $x = $x + 1;
}


$tbl = <<<EOD
<style>
    body {
        padding: 40px;
    }
    table {

    }
    table th {
        background-color: #103F56;
        text-align: left;
        font-size: 15px;
        font-weight: bold;
        color: #ffffff;
    }
    table td {
        text-align: left;
    }
    .specialrow {
        background-color:#BFBFBF;
        text-align:left;
        font-size:11px;
        font-weight:bold;
    }
    .tablestyle {

    }
    .boldstyle {
        font-weight: bold;
    }
</style>
<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <td class="boldstyle">Total work experience in months:</td>
        <td>$total_work_ex</td>
        <td class="boldstyle">Current notice period in days:</td>
        <td>$notice_period</td>
    </tr>
</table>
<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Exam Score</th>
    </tr>
    <tr nobr="true">
        <td>$exam_score</td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">References</th>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Title of the refree:</td>
        <td>$title_of_refree</td>
        <td class="boldstyle">Name of the refree:</td>
        <td>$name_of_refree</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Organisation:</td>
        <td>$organization_refree</td>
        <td class="boldstyle">Designation:</td>
        <td>$designation_refree</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Contact number:</td>
        <td>$phone_number_refree</td>
        <td class="boldstyle">Email address:</td>
        <td>$email_id_refree</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">In what capacity does he/she know you?:</td>
        <td colspan="3">$capacity_of_knowing</td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Additional Information</th>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Describe a difficult decision you have made and why it was challenging:</td>
        <td colspan="3">$difficult_decision</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Tell us about your path to business school and your future plans. How will an MBA help you along this journey:</td>
        <td colspan="3">$future_plans</td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Image Uploaded by Candidate</th>
    </tr>
    <tr nobr="true">
        <td colspan="4"><img src="$passport_photo" style="width:80px;height:100px"/></td>
    </tr>
</table>

<table border="1" cellpadding="5" cellspacing="0" align="center" width="100%" class="tablestyle">
    <tr nobr="true">
        <th colspan="4">Declaration</th>
    </tr>
    <tr nobr="true">
        <td colspan="4">I hereby declare that the information given in this application form is complete, true and correct to best of my knowledge. If admitted, I agree to comply with the rules of the institute.</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

// -----------------------------------------------------------------------------
ob_end_clean();
//Close and output PDF document
$pdf->Output($finalapplicationid . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
