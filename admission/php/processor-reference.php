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
$refreetitle = strip_tags( trim( $_POST['refreetitle'] ) );
$refreename = strip_tags( trim( $_POST['refreename'] ) );
$refreeorganization = strip_tags( trim( $_POST['refreeorganization'] ) );
$refreedesignation = strip_tags( trim( $_POST['refreedesignation'] ) );
$refreecontact = strip_tags( trim( $_POST['refreecontact'] ) );
$refreeemail = strip_tags( trim( $_POST['refreeemail'] ) );
$refreeknowing = strip_tags( trim( $_POST['refreeknowing'] ) );



$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finalrefreetitle = htmlspecialchars( $refreetitle, ENT_QUOTES, 'UTF-8' );
$finalrefreename = htmlspecialchars( $refreename, ENT_QUOTES, 'UTF-8' );
$finalrefreeorganization = htmlspecialchars( $refreeorganization, ENT_QUOTES, 'UTF-8' );
$finalrefreedesignation = htmlspecialchars( $refreedesignation, ENT_QUOTES, 'UTF-8' );
$finalrefreecontact = htmlspecialchars( $refreecontact, ENT_QUOTES, 'UTF-8' );
$finalrefreeemail = htmlspecialchars( $refreeemail, ENT_QUOTES, 'UTF-8' );
$finalrefreeknowing = htmlspecialchars( $refreeknowing, ENT_QUOTES, 'UTF-8' );



if ( $mysql == true ) {
	$sqlrefree = "INSERT INTO `csbedu_admission_2017`.`users_reference_details` (`application_id`, `title_of_refree`, `name_of_refree`, `organization`, `designation`, `phone_number`, `email_id`, `capacity_of_knowing`) VALUES (
			'".mysql_real_escape_string( $finalapplicationid )."',
			'".mysql_real_escape_string( $finalrefreetitle )."',
			'".mysql_real_escape_string( $finalrefreename )."',
			'".mysql_real_escape_string( $finalrefreeorganization )."',
			'".mysql_real_escape_string( $finalrefreedesignation )."',
			'".mysql_real_escape_string( $finalrefreecontact )."',
			'".mysql_real_escape_string( $finalrefreeemail )."',
			'".mysql_real_escape_string( $finalrefreeknowing )."'
			)
		ON DUPLICATE KEY
		UPDATE
		title_of_refree = VALUES(title_of_refree),
		name_of_refree = VALUES(name_of_refree),
		organization = VALUES(organization),
		designation = VALUES(designation),
		phone_number = VALUES(phone_number),
		email_id = VALUES(email_id),
		capacity_of_knowing = VALUES(capacity_of_knowing)
		;";

	$insertrefree = mysql_query( $sqlrefree );

	if ( ! $insertrefree ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

} else {

}

?>
