<?php

include dirname( __FILE__ ).'/csrf_protection/csrf-token.php';
include dirname( __FILE__ ).'/csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "VedicaAdmission" );
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
$isworkex = strip_tags( trim( $_POST['isworkex'] ) );
$organizationname = strip_tags( trim( $_POST['organizationname'] ) );
$location = strip_tags( trim( $_POST['location'] ) );
$designation = strip_tags( trim( $_POST['designation'] ) );
$workstarted = strip_tags( trim( $_POST['workstarted'] ) );
$workcompleted = strip_tags( trim( $_POST['workcompleted'] ) );
$ctc = strip_tags( trim( $_POST['ctc'] ) );
$rolesandresponsibility = strip_tags( trim( $_POST['rolesandresponsibility'] ) );
$extraworkexcount = strip_tags( trim( $_POST['extraworkexcount'] ) );
$totalworkex = strip_tags( trim( $_POST['totalworkex'] ) );
$noticeperiod = strip_tags( trim( $_POST['noticeperiod'] ) );



$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finalisworkex = htmlspecialchars( $isworkex, ENT_QUOTES, 'UTF-8' );
$finalorganizationname = htmlspecialchars( $organizationname, ENT_QUOTES, 'UTF-8' );
$finallocation = htmlspecialchars( $location, ENT_QUOTES, 'UTF-8' );
$finaldesignation = htmlspecialchars( $designation, ENT_QUOTES, 'UTF-8' );
$finalworkstarted = htmlspecialchars( $workstarted, ENT_QUOTES, 'UTF-8' );
$finalworkcompleted = htmlspecialchars( $workcompleted, ENT_QUOTES, 'UTF-8' );
$finalctc = htmlspecialchars( $ctc, ENT_QUOTES, 'UTF-8' );
$finalrolesandresponsibility = htmlspecialchars( $rolesandresponsibility, ENT_QUOTES, 'UTF-8' );
$finalextraworkexcount = htmlspecialchars( $extraworkexcount, ENT_QUOTES, 'UTF-8' );
$finaltotalworkex = htmlspecialchars( $totalworkex, ENT_QUOTES, 'UTF-8' );
$finalnoticeperiod = htmlspecialchars( $noticeperiod, ENT_QUOTES, 'UTF-8' );



if ( $mysql == true ) {

	$sqlworkexdelete = "DELETE FROM `users_work_experience_details` WHERE application_id ='" . $finalapplicationid ."'";

	$deleteworkex = mysql_query( $sqlworkexdelete );
	if ( ! $deleteworkex ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	$sqlworkex = "INSERT INTO `users_work_experience_details`(`application_id`, `work_experience`, `name_of_organization`, `location`, `designation`, `started_work_date`, `completed_work_date`, `ctc`, `roles_and_responsibilty`, `extra_workex_count`, `total_work_experience`, `notice_period`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( $finalisworkex )."',
				'".mysql_real_escape_string( $finalorganizationname )."',
				'".mysql_real_escape_string( $finallocation )."',
				'".mysql_real_escape_string( $finaldesignation )."',
				'".mysql_real_escape_string( $finalworkstarted )."',
				'".mysql_real_escape_string( $finalworkcompleted )."',
				'".mysql_real_escape_string( $finalctc )."',
				'".mysql_real_escape_string( $finalrolesandresponsibility )."',
				'".mysql_real_escape_string( $finalextraworkexcount )."',
				'".mysql_real_escape_string( $finaltotalworkex )."',
				'".mysql_real_escape_string( $finalnoticeperiod )."'
			);";

	$insertworkex = mysql_query( $sqlworkex );

	if ( ! $insertworkex ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	for ( $x=1; $x<=$finalextraworkexcount; $x++ ) {

		$iorganizationname = "organizationname{$x}";
		$ilocation = "location{$x}";
		$idesignation = "designation{$x}";
		$iworkstarted = "workstarted{$x}";
		$iworkcompleted = "workcompleted{$x}";
		$ictc = "ctc{$x}";
		$irolesandresponsibility = "rolesandresponsibility{$x}";


		${'organizationname' . $x} = strip_tags( trim( $_POST[$iorganizationname] ) );
		${'location' . $x} = strip_tags( trim( $_POST[$ilocation] ) );
		${'designation' . $x} = strip_tags( trim( $_POST[$idesignation] ) );
		${'workstarted' . $x} = strip_tags( trim( $_POST[$iworkstarted] ) );
		${'workcompleted' . $x} = strip_tags( trim( $_POST[$iworkcompleted] ) );
		${'ctc' . $x} = strip_tags( trim( $_POST[$ictc] ) );
		${'rolesandresponsibility' . $x} = strip_tags( trim( $_POST[$irolesandresponsibility] ) );

		${'finalorganizationname' . $x} = htmlspecialchars( ${'organizationname' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finallocation' . $x} = htmlspecialchars( ${'location' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finaldesignation' . $x} = htmlspecialchars( ${'designation' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalworkstarted' . $x} = htmlspecialchars( ${'workstarted' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalworkcompleted' . $x} = htmlspecialchars( ${'workcompleted' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalctc' . $x} = htmlspecialchars( ${'ctc' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalrolesandresponsibility' . $x} = htmlspecialchars( ${'rolesandresponsibility' . $x}, ENT_QUOTES, 'UTF-8' );


		$sqlworkexextra = "INSERT INTO `users_work_experience_details`(`application_id`, `work_experience`, `name_of_organization`, `location`, `designation`, `started_work_date`, `completed_work_date`, `ctc`, `roles_and_responsibilty`, `extra_workex_count`, `total_work_experience`, `notice_period`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( $finalisworkex )."',
				'".mysql_real_escape_string( ${'finalorganizationname' . $x} )."',
				'".mysql_real_escape_string( ${'finallocation' . $x} )."',
				'".mysql_real_escape_string( ${'finaldesignation' . $x} )."',
				'".mysql_real_escape_string( ${'finalworkstarted' . $x} )."',
				'".mysql_real_escape_string( ${'finalworkcompleted' . $x} )."',
				'".mysql_real_escape_string( ${'finalctc' . $x} )."',
				'".mysql_real_escape_string( ${'finalrolesandresponsibility' . $x} )."',
				'".mysql_real_escape_string( $finalextraworkexcount )."',
				'".mysql_real_escape_string( $finaltotalworkex )."',
				'".mysql_real_escape_string( $finalnoticeperiod )."'
				);";


		$insertworkexextra = mysql_query( $sqlworkexextra );
		if ( ! $insertworkexextra ) {
			die( 'Could not enter data: ' . mysql_error() );
		}

	}

} else {

}

?>
