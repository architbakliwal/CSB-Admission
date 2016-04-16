<?php

include dirname( __FILE__ ).'/csrf_protection/csrf-token.php';
include dirname( __FILE__ ).'/csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include dirname( __FILE__ ).'/config/config.php';
include dirname( __FILE__ ).'/config/functions.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include dirname( __FILE__ ).'/language/'.$language[$_GET['lang']].'.php';
} else {
	include dirname( __FILE__ ).'/language/en.php';
}

if ( !$_SESSION['userLogin'] && !$_SESSION['userName'] && !isset( $_SESSION['userName'] ) ) {

	timeout();

} else {
	$time = time();

	if ( $time > $_SESSION['expire'] ) {
		session_destroy();
		timeout();
		exit( 0 );
	}
}

$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + ( 60*60 );

if ( strlen( trim( $_SESSION['userName'] ) ) == 0 ) {
	session_destroy();
	timeout();
	die();
}


$applicationid = strip_tags( trim( $_SESSION['userName'] ) );
$tenthinstitutename = strip_tags( trim( $_POST['tenthinstitutename'] ) );
$tenthboard = strip_tags( trim( $_POST['tenthboard'] ) );
$tenthboardothers = strip_tags( trim( $_POST['tenthboardothers'] ) );
$tenthaggregate = strip_tags( trim( $_POST['tenthaggregate'] ) );
$tenthcompletion = strip_tags( trim( $_POST['tenthcompletion'] ) );
$twelfthordiploma = strip_tags( trim( $_POST['twelfthordiploma'] ) );
$twelfthinstitutename = strip_tags( trim( $_POST['twelfthinstitutename'] ) );
$twelfthboard = strip_tags( trim( $_POST['twelfthboard'] ) );
$twelfthboardothers = strip_tags( trim( $_POST['twelfthboardothers'] ) );
$twelfthaggregate = strip_tags( trim( $_POST['twelfthaggregate'] ) );
$twelfthcompletion = strip_tags( trim( $_POST['twelfthcompletion'] ) );
$gradutationcollegename = strip_tags( trim( $_POST['gradutationcollegename'] ) );
$gradutationunversity = strip_tags( trim( $_POST['gradutationunversity'] ) );
$graduationuniversityothers = strip_tags( trim( $_POST['graduationuniversityothers'] ) );
$graduatindegreename = strip_tags( trim( $_POST['graduatindegreename'] ) );
$graduationdiscipline = strip_tags( trim( $_POST['graduationdiscipline'] ) );
$graduationdisciplineother = strip_tags( trim( $_POST['graduationdisciplineother'] ) );
$graduationspecialization = strip_tags( trim( $_POST['graduationspecialization'] ) );
$graduationdegreemode = strip_tags( trim( $_POST['graduationdegreemode'] ) );
$graduationcompleted = strip_tags( trim( $_POST['graduationcompleted'] ) );
$gradationcompletionyear = strip_tags( trim( $_POST['gradationcompletionyear'] ) );
$graduationgpaorpercentage = strip_tags( trim( $_POST['graduationgpaorpercentage'] ) );
$graduationclass = strip_tags( trim( $_POST['graduationclass'] ) );
$graduationpercentage = strip_tags( trim( $_POST['graduationpercentage'] ) );
$graduationgpaobtained = strip_tags( trim( $_POST['graduationgpaobtained'] ) );
$graduationgpamax = strip_tags( trim( $_POST['graduationgpamax'] ) );
$extraacademiccount = strip_tags( trim( $_POST['extraacademiccount'] ) );
$academicachivements = strip_tags( trim( $_POST['academicachivements'] ) );


$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finaltenthinstitutename = htmlspecialchars( $tenthinstitutename, ENT_QUOTES, 'UTF-8' );
$finaltenthboard = htmlspecialchars( $tenthboard, ENT_QUOTES, 'UTF-8' );
$finaltenthboardothers = htmlspecialchars( $tenthboardothers, ENT_QUOTES, 'UTF-8' );
$finaltenthaggregate = htmlspecialchars( $tenthaggregate, ENT_QUOTES, 'UTF-8' );
$finaltenthcompletion = htmlspecialchars( $tenthcompletion, ENT_QUOTES, 'UTF-8' );
$finaltwelfthordiploma = htmlspecialchars( $twelfthordiploma, ENT_QUOTES, 'UTF-8' );
$finaltwelfthinstitutename = htmlspecialchars( $twelfthinstitutename, ENT_QUOTES, 'UTF-8' );
$finaltwelfthboard = htmlspecialchars( $twelfthboard, ENT_QUOTES, 'UTF-8' );
$finaltwelfthboardothers = htmlspecialchars( $twelfthboardothers, ENT_QUOTES, 'UTF-8' );
$finaltwelfthaggregate = htmlspecialchars( $twelfthaggregate, ENT_QUOTES, 'UTF-8' );
$finaltwelfthcompletion = htmlspecialchars( $twelfthcompletion, ENT_QUOTES, 'UTF-8' );
$finalgradutationcollegename = htmlspecialchars( $gradutationcollegename, ENT_QUOTES, 'UTF-8' );
$finalgradutationunversity = htmlspecialchars( $gradutationunversity, ENT_QUOTES, 'UTF-8' );
$finalgraduationuniversityothers = htmlspecialchars( $graduationuniversityothers, ENT_QUOTES, 'UTF-8' );
$finalgraduatindegreename = htmlspecialchars( $graduatindegreename, ENT_QUOTES, 'UTF-8' );
$finalgraduationdiscipline = htmlspecialchars( $graduationdiscipline, ENT_QUOTES, 'UTF-8' );
$finalgraduationdisciplineother = htmlspecialchars( $graduationdisciplineother, ENT_QUOTES, 'UTF-8' );
$finalgraduationspecialization = htmlspecialchars( $graduationspecialization, ENT_QUOTES, 'UTF-8' );
$finalgraduationdegreemode = htmlspecialchars( $graduationdegreemode, ENT_QUOTES, 'UTF-8' );
$finalgraduationcompleted = htmlspecialchars( $graduationcompleted, ENT_QUOTES, 'UTF-8' );
$finalgradationcompletionyear = htmlspecialchars( $gradationcompletionyear, ENT_QUOTES, 'UTF-8' );
$finalgraduationgpaorpercentage = htmlspecialchars( $graduationgpaorpercentage, ENT_QUOTES, 'UTF-8' );
$finalgraduationclass = htmlspecialchars( $graduationclass, ENT_QUOTES, 'UTF-8' );
$finalgraduationpercentage = htmlspecialchars( $graduationpercentage, ENT_QUOTES, 'UTF-8' );
$finalgraduationgpaobtained = htmlspecialchars( $graduationgpaobtained, ENT_QUOTES, 'UTF-8' );
$finalgraduationgpamax = htmlspecialchars( $graduationgpamax, ENT_QUOTES, 'UTF-8' );
$finalextraacademiccount = htmlspecialchars( $extraacademiccount, ENT_QUOTES, 'UTF-8' );
$finalacademicachivements = htmlspecialchars( $academicachivements, ENT_QUOTES, 'UTF-8' );


if ( $mysql == true ) {
	$sqlacademic = "INSERT INTO `csbedu_admission`.`users_academic_details` (`application_id`, `tenth_name_of_institute`, `tenth_board`, `tenth_board_other`, `tenth_aggregate`, `tenth_year_completion`, `is_twelfth_or_diploma`, `twelfth_name_of_institution`, `twelfth_board`, `twelfth_board_other`, `twelfth_aggregate`, `twelfth_year_completion`, `graduation_name_of_college`, `graduation_university`, `graduation_university_other`, `graduation_degree_mode`, `graduation_degree_name`, `graduation_discipline`, `graduation_discipline_other`, `graduation_specialisation`, `graduation_degree_completed`, `graduation_year_completion`, `graduation_grading_system`, `graduation_class`, `graduation_aggregate`, `graduation_gpa_obtained`, `graduation_gpa_max`, `extra_academic_added_count`, `achievements_awards`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( $finaltenthinstitutename )."',
				'".mysql_real_escape_string( $finaltenthboard )."',
				'".mysql_real_escape_string( $finaltenthboardothers )."',
				'".mysql_real_escape_string( $finaltenthaggregate )."',
				'".mysql_real_escape_string( $finaltenthcompletion )."',
				'".mysql_real_escape_string( $finaltwelfthordiploma )."',
				'".mysql_real_escape_string( $finaltwelfthinstitutename )."',
				'".mysql_real_escape_string( $finaltwelfthboard )."',
				'".mysql_real_escape_string( $finaltwelfthboardothers )."',
				'".mysql_real_escape_string( $finaltwelfthaggregate )."',
				'".mysql_real_escape_string( $finaltwelfthcompletion )."',
				'".mysql_real_escape_string( $finalgradutationcollegename )."',
				'".mysql_real_escape_string( $finalgradutationunversity )."',
				'".mysql_real_escape_string( $finalgraduationuniversityothers )."',
				'".mysql_real_escape_string( $finalgraduationdegreemode )."',
				'".mysql_real_escape_string( $finalgraduatindegreename )."',
				'".mysql_real_escape_string( $finalgraduationdiscipline )."',
				'".mysql_real_escape_string( $finalgraduationdisciplineother )."',
				'".mysql_real_escape_string( $finalgraduationspecialization )."',
				'".mysql_real_escape_string( $finalgraduationcompleted )."',
				'".mysql_real_escape_string( $finalgradationcompletionyear )."',
				'".mysql_real_escape_string( $finalgraduationgpaorpercentage )."',
				'".mysql_real_escape_string( $finalgraduationclass )."',
				'".mysql_real_escape_string( $finalgraduationpercentage )."',
				'".mysql_real_escape_string( $finalgraduationgpaobtained )."',
				'".mysql_real_escape_string( $finalgraduationgpamax )."',
				'".mysql_real_escape_string( $finalextraacademiccount )."',
				'".mysql_real_escape_string( $academicachivements )."'
			)
			ON DUPLICATE KEY
			UPDATE
			tenth_name_of_institute = VALUES(tenth_name_of_institute),
			tenth_board = VALUES(tenth_board),
			tenth_board_other = VALUES(tenth_board_other),
			tenth_aggregate = VALUES(tenth_aggregate),
			tenth_year_completion = VALUES(tenth_year_completion),
			is_twelfth_or_diploma = VALUES(is_twelfth_or_diploma),
			twelfth_name_of_institution = VALUES(twelfth_name_of_institution),
			twelfth_board = VALUES(twelfth_board),
			twelfth_board_other = VALUES(twelfth_board_other),
			twelfth_aggregate = VALUES(twelfth_aggregate),
			twelfth_year_completion = VALUES(twelfth_year_completion),
			graduation_name_of_college = VALUES(graduation_name_of_college),
			graduation_university = VALUES(graduation_university),
			graduation_university_other = VALUES(graduation_university_other),
			graduation_degree_mode = VALUES(graduation_degree_mode),
			graduation_degree_name = VALUES(graduation_degree_name),
			graduation_discipline = VALUES(graduation_discipline),
			graduation_discipline_other = VALUES(graduation_discipline_other),
			graduation_specialisation = VALUES(graduation_specialisation),
			graduation_degree_completed = VALUES(graduation_degree_completed),
			graduation_year_completion = VALUES(graduation_year_completion),
			graduation_grading_system = VALUES(graduation_grading_system),
			graduation_class = VALUES(graduation_class),
			graduation_aggregate = VALUES(graduation_aggregate),
			graduation_gpa_obtained = VALUES(graduation_gpa_obtained),
			graduation_gpa_max = VALUES(graduation_gpa_max),
			extra_academic_added_count = VALUES(extra_academic_added_count),
			achievements_awards = VALUES(achievements_awards)
			;";

	$insertacademic = mysql_query( $sqlacademic );

	if ( ! $insertacademic ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	$sqlacademicextradelete = "DELETE FROM added_academic_details WHERE application_id ='" . $finalapplicationid ."'";

	$deleteacademicextra = mysql_query( $sqlacademicextradelete );
	if ( ! $deleteacademicextra ) {
		die( 'Could not enter data: ' . mysql_error() );
	}


	for ( $x=0; $x<$extraacademiccount; $x++ ) {

		if ( $x == 0 ) {
			$y = '';
		} else {
			$y = $x;
		}

		$iacademicextradegreelevel = "academicextradegreelevel{$y}";
		${'academicextradegreelevel' . $y} = strip_tags( trim( $_POST[$iacademicextradegreelevel] ) );
		${'finalacademicextradegreelevel' . $y} = htmlspecialchars( ${'academicextradegreelevel' . $y}, ENT_QUOTES, 'UTF-8' );

		$iacademicextradegreeother = "academicextradegreeother{$y}";
		${'academicextradegreeother' . $y} = strip_tags( trim( $_POST[$iacademicextradegreeother] ) );
		${'finalacademicextradegreeother' . $y} = htmlspecialchars( ${'academicextradegreeother' . $y}, ENT_QUOTES, 'UTF-8' );

		$igradutationcollegenameextra = "gradutationcollegenameextra{$y}";
		${'gradutationcollegenameextra' . $y} = strip_tags( trim( $_POST[$igradutationcollegenameextra] ) );
		${'finalgradutationcollegenameextra' . $y} = htmlspecialchars( ${'gradutationcollegenameextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igradutationunversityextra = "gradutationunversityextra{$y}";
		${'gradutationunversityextra' . $y} = strip_tags( trim( $_POST[$igradutationunversityextra] ) );
		${'finalgradutationunversityextra' . $y} = htmlspecialchars( ${'gradutationunversityextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationuniversityothersextra = "graduationuniversityothersextra{$y}";
		${'graduationuniversityothersextra' . $y} = strip_tags( trim( $_POST[$igraduationuniversityothersextra] ) );
		${'finalgraduationuniversityothersextra' . $y} = htmlspecialchars( ${'graduationuniversityothersextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduatindegreenameextra = "graduatindegreenameextra{$y}";
		${'graduatindegreenameextra' . $y} = strip_tags( trim( $_POST[$igraduatindegreenameextra] ) );
		${'finalgraduatindegreenameextra' . $y} = htmlspecialchars( ${'graduatindegreenameextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationdisciplineextra = "graduationdisciplineextra{$y}";
		${'graduationdisciplineextra' . $y} = strip_tags( trim( $_POST[$igraduationdisciplineextra] ) );
		${'finalgraduationdisciplineextra' . $y} = htmlspecialchars( ${'graduationdisciplineextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationdisciplineotherextra = "graduationdisciplineotherextra{$y}";
		${'graduationdisciplineotherextra' . $y} = strip_tags( trim( $_POST[$igraduationdisciplineotherextra] ) );
		${'finalgraduationdisciplineotherextra' . $y} = htmlspecialchars( ${'graduationdisciplineotherextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationspecializationextra = "graduationspecializationextra{$y}";
		${'graduationspecializationextra' . $y} = strip_tags( trim( $_POST[$igraduatindegreenameextra] ) );
		${'finalgraduationspecializationextra' . $y} = htmlspecialchars( ${'graduationspecializationextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationdegreemodeextra = "graduationdegreemodeextra{$y}";
		${'graduationdegreemodeextra' . $y} = strip_tags( trim( $_POST[$igraduationdegreemodeextra] ) );
		${'finalgraduationdegreemodeextra' . $y} = htmlspecialchars( ${'graduationdegreemodeextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationcompletedextra = "graduationcompletedextra{$y}";
		${'graduationcompletedextra' . $y} = strip_tags( trim( $_POST[$igraduationcompletedextra] ) );
		${'finalgraduationcompletedextra' . $y} = htmlspecialchars( ${'graduationcompletedextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igradationcompletionyearextra = "gradationcompletionyearextra{$y}";
		${'gradationcompletionyearextra' . $y} = strip_tags( trim( $_POST[$igradationcompletionyearextra] ) );
		${'finalgradationcompletionyearextra' . $y} = htmlspecialchars( ${'gradationcompletionyearextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationgpaorpercentageextra = "graduationgpaorpercentageextra{$y}";
		${'graduationgpaorpercentageextra' . $y} = strip_tags( trim( $_POST[$igraduationgpaorpercentageextra] ) );
		${'finalgraduationgpaorpercentageextra' . $y} = htmlspecialchars( ${'graduationgpaorpercentageextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationclassextra = "graduationclassextra{$y}";
		${'graduationclassextra' . $y} = strip_tags( trim( $_POST[$igraduationclassextra] ) );
		${'finalgraduationclassextra' . $y} = htmlspecialchars( ${'graduationclassextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationpercentageextra = "graduationpercentageextra{$y}";
		${'graduationpercentageextra' . $y} = strip_tags( trim( $_POST[$igraduationpercentageextra] ) );
		${'finalgraduationpercentageextra' . $y} = htmlspecialchars( ${'graduationpercentageextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationgpaobtainedextra = "graduationgpaobtainedextra{$y}";
		${'graduationgpaobtainedextra' . $y} = strip_tags( trim( $_POST[$igraduationgpaobtainedextra] ) );
		${'finalgraduationgpaobtainedextra' . $y} = htmlspecialchars( ${'graduationgpaobtainedextra' . $y}, ENT_QUOTES, 'UTF-8' );

		$igraduationgpamaxextra = "graduationgpamaxextra{$y}";
		${'graduationgpamaxextra' . $y} = strip_tags( trim( $_POST[$igraduationgpamaxextra] ) );
		${'finalgraduationgpamaxextra' . $y} = htmlspecialchars( ${'graduationgpamaxextra' . $y}, ENT_QUOTES, 'UTF-8' );


		$sqlacademicextra = "INSERT INTO `csbedu_admission`.`added_academic_details` (`application_id`, `extra_academic_degree_level`, `extra_academic_degree_level_other`, `extra_academic_name_of_college`, `extra_academic_university`, `extra_academic_university_other`, `extra_academic_degree_mode`, `extra_academic_degree_name`, `extra_academic_discipline`, `extra_academic_discipline_other`, `extra_academic_specialisation`, `extra_academic_degree_completed`, `extra_academic_year_completion`, `extra_academic_grading_system`, `extra_academic_class`, `extra_academic_aggregate`, `extra_academic_gpa_obtained`, `extra_academic_gpa_max`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( ${'finalacademicextradegreelevel' . $y} )."',
				'".mysql_real_escape_string( ${'finalacademicextradegreeother' . $y} )."',
				'".mysql_real_escape_string( ${'finalgradutationcollegenameextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgradutationunversityextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationuniversityothersextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduatindegreenameextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationdisciplineextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationdisciplineotherextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationspecializationextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationdegreemodeextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationcompletedextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgradationcompletionyearextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationgpaorpercentageextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationclassextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationpercentageextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationgpaobtainedextra' . $y} )."',
				'".mysql_real_escape_string( ${'finalgraduationgpamaxextra' . $y} )."'
				);";


		$insertacademicextra = mysql_query( $sqlacademicextra );
		if ( ! $insertacademicextra ) {
			die( 'Could not enter data: ' . mysql_error() );
		}

	}

} else {

}

?>
