<?php

$app_id = $_GET['appId'];

require_once('loaddata_admin.php');

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
        <td class="boldstyle">Blood Group:</td>
        <td colspan="3">$blood_grp</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle" colspan="2">How did you hear of CSB?</td>
        <td colspan="2">$hear_abt_csb</td>
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
    <tr nobr="true">
        <td colspan="4" class="specialrow">Class Xth</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Name of Institute:</td>
        <td>$tenth_name_of_institute</td>
        <td class="boldstyle">Board:</td>
        <td>$tenth_board</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Board others:</td>
        <td>$tenth_board_other</td>
        <td class="boldstyle">Xth aggregate percentage:</td>
        <td>$tenth_aggregate</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Year of completion:</td>
        <td colspan="3">$tenth_year_completion</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Class XIIth / Diploma</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Course:</td>
        <td colspan="3">$is_twelfth_or_diploma</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Name of Institute:</td>
        <td>$twelfth_name_of_institution</td>
        <td class="boldstyle">Board:</td>
        <td>$twelfth_board</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Board others:</td>
        <td>$twelfth_board_other</td>
        <td class="boldstyle">XIIth aggregate percentage:</td>
        <td>$twelfth_aggregate</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Year of completion:</td>
        <td colspan="3">$twelfth_year_completion</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Graduation</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Name of College:</td>
        <td colspan="3">$graduation_name_of_college</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">University name:</td>
        <td>$graduation_university</td>
        <td class="boldstyle">University name others:</td>
        <td>$graduation_university_other</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Degree name:</td>
        <td>$graduation_degree_name</td>
        <td class="boldstyle">Discipline:</td>
        <td>$graduation_discipline</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Discipline other:</td>
        <td>$graduation_discipline_other</td>
        <td class="boldstyle">Specialization:</td>
        <td>$graduation_specialisation</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Graduation degree mode:</td>
        <td>$graduation_degree_mode</td>
        <td class="boldstyle">Degree completed:</td>
        <td>$graduation_degree_completed</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Year of completion:</td>
        <td>$graduation_year_completion</td>
        <td class="boldstyle">Grading system:</td>
        <td>$graduation_grading_system</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Class:</td>
        <td>$graduation_class</td>
        <td class="boldstyle">Final aggregate percentage:</td>
        <td>$graduation_aggregate</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Final GPA obtained:</td>
        <td>$graduation_gpa_obtained</td>
        <td class="boldstyle">Max GPA possible:</td>
        <td>$graduation_gpa_max</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Academic awards, extra curricular achievements and positions of responsibility held</td>
    </tr>
    <tr nobr="true">
        <td colspan="4">$achievements_awards</td>
    </tr>
</table>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

$y = '';
$x = 1;
for($i=0; $i<$extra_academic_added_count; $i++) {

$iacademicextradegreelevel = "academicextradegreelevel{$y}";
$iacademicextradegreeother = "academicextradegreeother{$y}";
$igradutationcollegenameextra = "gradutationcollegenameextra{$y}";
$igradutationunversityextra = "gradutationunversityextra{$y}";
$igraduationuniversityothersextra = "graduationuniversityothersextra{$y}";
$igraduatindegreenameextra = "graduatindegreenameextra{$y}";
$igraduationdisciplineextra = "graduationdisciplineextra{$y}";
$igraduationdisciplineotherextra = "graduationdisciplineotherextra{$y}";
$igraduationspecializationextra = "graduationspecializationextra{$y}";
$igraduationdegreemodeextra = "graduationdegreemodeextra{$y}";
$igraduationcompletedextra = "graduationcompletedextra{$y}";
$igradationcompletionyearextra = "gradationcompletionyearextra{$y}";
$igraduationgpaorpercentageextra = "graduationgpaorpercentageextra{$y}";
$igraduationclassextra = "graduationclassextra{$y}";
$igraduationpercentageextra = "graduationpercentageextra{$y}";
$igraduationgpaobtainedextra = "graduationgpaobtainedextra{$y}";
$igraduationgpamaxextra = "graduationgpamaxextra{$y}";

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
        <td colspan="4" class="specialrow">Additional Academic Qualifications</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Degree level:</td>
        <td>$extra_acads[$iacademicextradegreelevel]</td>
        <td class="boldstyle">Degree level others:</td>
        <td>$extra_acads[$iacademicextradegreeother]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Name of College:</td>
        <td colspan="3">$extra_acads[$igradutationcollegenameextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">University name:</td>
        <td>$extra_acads[$igradutationunversityextra]</td>
        <td class="boldstyle">University name others:</td>
        <td>$extra_acads[$igraduationuniversityothersextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Degree name:</td>
        <td>$extra_acads[$igraduatindegreenameextra]</td>
        <td class="boldstyle">Discipline:</td>
        <td>$extra_acads[$igraduationdisciplineextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Discipline other:</td>
        <td>$extra_acads[$igraduationdisciplineotherextra]</td>
        <td class="boldstyle">Specialization:</td>
        <td>$extra_acads[$igraduationspecializationextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Graduation degree mode:</td>
        <td>$extra_acads[$igraduationdegreemodeextra]</td>
        <td class="boldstyle">Degree completed:</td>
        <td>$extra_acads[$igraduationcompletedextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Year of completion:</td>
        <td>$extra_acads[$igradationcompletionyearextra]</td>
        <td class="boldstyle">Grading system:</td>
        <td>$extra_acads[$igraduationgpaorpercentageextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Class:</td>
        <td>$extra_acads[$igraduationclassextra]</td>
        <td class="boldstyle">Final aggregate percentage:</td>
        <td>$extra_acads[$igraduationpercentageextra]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Final GPA obtained:</td>
        <td>$extra_acads[$igraduationgpaobtainedextra]</td>
        <td class="boldstyle">Max GPA possible:</td>
        <td>$extra_acads[$igraduationgpamaxextra]</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

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
    <tr nobr="true">
        <td class="boldstyle" colspan="2">Do you have any work-experience?</td>
        <td colspan="2">$work_experience</td>
    </tr>
    <tr nobr="true">
        <td colspan="4" class="specialrow">Latest Work Experience</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Employement type:</td>
        <td>$employement_type</td>
        <td class="boldstyle">Name of the organisation:</td>
        <td>$name_of_organization</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Organisation type:</td>
        <td>$organization_type</td>
        <td class="boldstyle">Organisation type others:</td>
        <td>$organization_type_other</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Started work in:</td>
        <td>$started_work_date</td>
        <td class="boldstyle">Completed work in:</td>
        <td>$completed_work_date</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Joined as:</td>
        <td>$joined_as</td>
        <td class="boldstyle">Current designation:</td>
        <td>$current_designation</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Annual remuneration in INR:</td>
        <td colspan="3">$annual_renumeration</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Description of roles and responsibility:</td>
        <td colspan="3">$roles_and_responsibilty</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Total work experience:</td>
        <td colspan="3">$total_work_experience</td>
    </tr>
</table>

EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');

for($i=0; $i<$extra_workex_count; $i++) {
$x = $i + 1;
$iemployementtype = "employementtype{$x}";
$iorganizationname = "organizationname{$x}";
$iorganizationtype = "organizationtype{$x}";
$iorganizationtypeother = "organizationtypeother{$x}";
$iindustrytype = "industrytype{$x}";
$iworkstarted = "workstarted{$x}";
$iworkcompleted = "workcompleted{$x}";
$icomapnyjoinedas = "comapnyjoinedas{$x}";
$icurrentdesignation = "currentdesignation{$x}";
$iannualrenumeration = "annualrenumeration{$x}";
$irolesandresponsibility = "rolesandresponsibility{$x}";


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
        <td colspan="4" class="specialrow">Additional Work Experience</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Employement type:</td>
        <td>$extra_workex[$iemployementtype]</td>
        <td class="boldstyle">Name of the organisation:</td>
        <td>$extra_workex[$iorganizationname]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Organisation type:</td>
        <td>$extra_workex[$iorganizationtype]</td>
        <td class="boldstyle">Organisation type others:</td>
        <td>$extra_workex[$iorganizationtypeother]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Started work in:</td>
        <td>$extra_workex[$iworkstarted]</td>
        <td class="boldstyle">Completed work in:</td>
        <td>$extra_workex[$iworkcompleted]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Joined as:</td>
        <td>$extra_workex[$icomapnyjoinedas]</td>
        <td class="boldstyle">Current designation:</td>
        <td>$extra_workex[$icurrentdesignation]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Annual remuneration in INR:</td>
        <td colspan="3">$extra_workex[$iannualrenumeration]</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Description of roles and responsibility:</td>
        <td colspan="3">$extra_workex[$irolesandresponsibility]</td>
    </tr>
</table>
EOD;

$pdf->writeHTML($tbl, true, false, false, false, '');
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
        <td class="boldstyle">Who is your role model? Explain the reasons behind your choice:</td>
        <td colspan="3">$role_model_info</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">What according to you has been your biggest failure and how did you overcome it?:</td>
        <td colspan="3">$failure_info</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Create a write-up of yourself as an alumnus of CSB alumnus and explain how the programme helped you achieve your career goals:</td>
        <td colspan="3">$acheivement_as_alumnus</td>
    </tr>
    <tr nobr="true">
        <td class="boldstyle">Is there anything else you would like to mention that would add to your candidature for the programme?:</td>
        <td colspan="3">$support_info</td>
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
