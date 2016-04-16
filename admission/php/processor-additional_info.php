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
$rolemodelinfo = strip_tags( trim( $_POST["rolemodelinfo"] ) );
$failureinfo = strip_tags( trim( $_POST["failureinfo"] ) );
$acheivementasalumnus = strip_tags( trim( $_POST["acheivementasalumnus"] ) );
$supportinfo = strip_tags( trim( $_POST["supportinfo"] ) );

$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finalrolemodelinfo = htmlspecialchars( $rolemodelinfo, ENT_QUOTES, 'UTF-8' );
$finalfailureinfo = htmlspecialchars( $failureinfo, ENT_QUOTES, 'UTF-8' );
$finalacheivementasalumnus = htmlspecialchars( $acheivementasalumnus, ENT_QUOTES, 'UTF-8' );
$finalsupportinfo = htmlspecialchars( $supportinfo, ENT_QUOTES, 'UTF-8' );


if ( $mysql == true ) {
	$sqladditionalinfo = "INSERT INTO `csbedu_admission`.`user_additional_info` (`application_id`, `role_model_info`, `failure_info`, `acheivement_as_alumnus`,`support_info`) VALUES ('".mysql_real_escape_string( $finalapplicationid )."','".mysql_real_escape_string( $finalrolemodelinfo )."','".mysql_real_escape_string( $finalfailureinfo )."','".mysql_real_escape_string( $finalacheivementasalumnus )."','".mysql_real_escape_string( $finalsupportinfo )."')
		ON DUPLICATE KEY
		UPDATE
		role_model_info = VALUES(role_model_info),
		failure_info = VALUES(failure_info),
		acheivement_as_alumnus = VALUES(acheivement_as_alumnus),
		support_info = VALUES(support_info)
		;";

	$insertaddtionalinfo = mysql_query( $sqladditionalinfo );

	if ( ! $insertaddtionalinfo ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

} else {

}

?>
