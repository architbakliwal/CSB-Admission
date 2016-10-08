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
$difficultdecision = strip_tags( trim( $_POST["difficult_decision"] ) );
$futureplans = strip_tags( trim( $_POST["future_plans"] ) );

$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finaldifficultdecision = htmlspecialchars( $difficultdecision, ENT_QUOTES, 'UTF-8' );
$finalfutureplans = htmlspecialchars( $futureplans, ENT_QUOTES, 'UTF-8' );

if ( $mysql == true ) {
	$sqladditionalinfo = "INSERT INTO `csbedu_admission_2017`.`user_additional_info` (`application_id`, `difficult_decision`, `future_plans`) VALUES ('".mysql_real_escape_string( $finalapplicationid )."','".mysql_real_escape_string( $finaldifficultdecision )."','".mysql_real_escape_string( $finalfutureplans )."')
		ON DUPLICATE KEY
		UPDATE
		difficult_decision = VALUES(difficult_decision),
		future_plans = VALUES(future_plans)
		;";

	$insertaddtionalinfo = mysql_query( $sqladditionalinfo );

	if ( ! $insertaddtionalinfo ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

} else {

}

?>
