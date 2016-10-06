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
$personalstatus = strip_tags( trim( $_POST["personalstatus"] ) );
$contactstatus = strip_tags( trim( $_POST["contactstatus"] ) );
$examscorestatus = strip_tags( trim( $_POST["examscorestatus"] ) );
$refreestatus = strip_tags( trim( $_POST["refreestatus"] ) );
$additionalinfostatus = strip_tags( trim( $_POST["additionalinfostatus"] ) );
$docstatus = strip_tags( trim( $_POST["docstatus"] ) );

$datetime = date( "Y-m-d H:i:s" );

if ( $mysql == true ) {
	$sqlstatus = "INSERT INTO `csbedu_admission_2017`.`admission_section_status` (`application_id`, `personal_details_status`, `contact_details_status`, `exam_score_details_status`, `reference_details_status`, `additional_details_status`, `document_details_status`, `last_update_date`) VALUES (
			'".$applicationid."',
			'".$personalstatus."',
			'".$contactstatus."',
			'".$examscorestatus."',
			'".$refreestatus."',
			'".$additionalinfostatus."',
			'".$docstatus."',
			'".$datetime."'
			)
		ON DUPLICATE KEY
		UPDATE
		personal_details_status = VALUES(personal_details_status),
		contact_details_status = VALUES(contact_details_status),
		exam_score_details_status = VALUES(exam_score_details_status),
		reference_details_status = VALUES(reference_details_status),
		additional_details_status = VALUES(additional_details_status),
		document_details_status = VALUES(document_details_status),
		last_update_date = VALUES(last_update_date)
		;";

	$insertstatus = mysql_query( $sqlstatus );

	if ( ! $insertstatus ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

} else {

}

?>
