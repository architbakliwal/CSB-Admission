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
$qualification = strip_tags( trim( $_POST['qualification'] ) );
$institute = strip_tags( trim( $_POST['institute'] ) );
$board = strip_tags( trim( $_POST['board'] ) );
$yearofpassing = strip_tags( trim( $_POST['yearofpassing'] ) );
$aggregate = strip_tags( trim( $_POST['aggregate'] ) );
$extraacademiccount = strip_tags( trim( $_POST['extraacademiccount'] ) );
$academicachivements = strip_tags( trim( $_POST['academicachivements'] ) );


$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finalqualification = htmlspecialchars( $qualification, ENT_QUOTES, 'UTF-8' );
$finalinstitute = htmlspecialchars( $institute, ENT_QUOTES, 'UTF-8' );
$finalboard = htmlspecialchars( $board, ENT_QUOTES, 'UTF-8' );
$finalyearofpassing = htmlspecialchars( $yearofpassing, ENT_QUOTES, 'UTF-8' );
$finalaggregate = htmlspecialchars( $aggregate, ENT_QUOTES, 'UTF-8' );
$finalextraacademiccount = htmlspecialchars( $extraacademiccount, ENT_QUOTES, 'UTF-8' );
$finalacademicachivements = htmlspecialchars( $academicachivements, ENT_QUOTES, 'UTF-8' );


if ( $mysql == true ) {

	$sqlacademicdelete = "DELETE FROM users_academic_details WHERE application_id ='" . $finalapplicationid ."'";

	$deleteacademic = mysql_query( $sqlacademicdelete );
	if ( ! $deleteacademic ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	$sqlacademic = "INSERT INTO `users_academic_details`(`application_id`, `qualification`, `institute`, `board`, `year_of_passing`, `aggregate`, `academic_achivements`, `extra_academic_added_count`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( $finalqualification )."',
				'".mysql_real_escape_string( $finalinstitute )."',
				'".mysql_real_escape_string( $finalboard )."',
				'".mysql_real_escape_string( $finalyearofpassing )."',
				'".mysql_real_escape_string( $finalaggregate )."',
				'".mysql_real_escape_string( $finalacademicachivements )."',
				'".mysql_real_escape_string( $finalextraacademiccount )."'
			);";

	$insertacademic = mysql_query( $sqlacademic );

	if ( ! $insertacademic ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	for ( $x=1; $x<=$finalextraacademiccount; $x++ ) {

		$iqualification = "qualification{$x}";
		$iinstitute = "institute{$x}";
		$iboard = "board{$x}";
		$iyearofpassing = "yearofpassing{$x}";
		$iaggregate = "aggregate{$x}";
		$iacademicachivements = "academicachivements{$x}";

		${'qualification' . $x} = strip_tags( trim( $_POST[$iqualification] ) );
		${'institute' . $x} = strip_tags( trim( $_POST[$iinstitute] ) );
		${'board' . $x} = strip_tags( trim( $_POST[$iboard] ) );
		${'yearofpassing' . $x} = strip_tags( trim( $_POST[$iyearofpassing] ) );
		${'aggregate' . $x} = strip_tags( trim( $_POST[$iaggregate] ) );
		${'academicachivements' . $x} = strip_tags( trim( $_POST[$iacademicachivements] ) );

		${'finalqualification' . $x} = htmlspecialchars( ${'qualification' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalinstitute' . $x} = htmlspecialchars( ${'institute' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalboard' . $x} = htmlspecialchars( ${'board' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalyearofpassing' . $x} = htmlspecialchars( ${'yearofpassing' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalaggregate' . $x} = htmlspecialchars( ${'aggregate' . $x}, ENT_QUOTES, 'UTF-8' );
		${'finalacademicachivements' . $x} = htmlspecialchars( ${'academicachivements' . $x}, ENT_QUOTES, 'UTF-8' );


		$sqlacademicextra = "INSERT INTO `users_academic_details`(`application_id`, `qualification`, `institute`, `board`, `year_of_passing`, `aggregate`, `academic_achivements`, `extra_academic_added_count`) VALUES (
				'".mysql_real_escape_string( $finalapplicationid )."',
				'".mysql_real_escape_string( ${'finalqualification' . $x} )."',
				'".mysql_real_escape_string( ${'finalinstitute' . $x} )."',
				'".mysql_real_escape_string( ${'finalboard' . $x} )."',
				'".mysql_real_escape_string( ${'finalyearofpassing' . $x} )."',
				'".mysql_real_escape_string( ${'finalaggregate' . $x} )."',
				'".mysql_real_escape_string( ${'finalacademicachivements' . $x} )."',
				'".mysql_real_escape_string( $finalextraacademiccount )."'
				);";

		$insertacademicextra = mysql_query( $sqlacademicextra );
		if ( ! $insertacademicextra ) {
			die( 'Could not enter data: ' . mysql_error() );
		}

	}

} else {

}

?>
