<?php

include '../csrf_protection/csrf-token.php';
include '../csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include '../config/config.php';
include '../config/functions.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include '../language/'.$language[$_GET['lang']].'.php';
} else {
	include '../language/en.php';
}

$update_password = strip_tags( trim( $_POST["update_password"] ) );
$update_retypepassword = strip_tags( trim( $_POST["update_retypepassword"] ) );

$update_finalpass = htmlspecialchars( $update_password, ENT_QUOTES, 'UTF-8' );
$update_finalretypepass = htmlspecialchars( $update_retypepassword, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'update-password-form' ) ) {
	echo $lang['update_password_wrong_security_token'];
} else {

	include '../php-pass-framework/PasswordHash.php';

	$hasher = new PasswordHash( 8, false );
	$finalsalt = hash( 'sha512', uniqid( mt_rand( 1, mt_getrandmax() ), true ) );
	$newpassword = $hasher->HashPassword( $update_finalpass . $finalsalt . $passwordsalt );

	$update = "UPDATE ".$admission_users." SET password = '".mysql_real_escape_string( $newpassword )."', salt = '".mysql_real_escape_string( $finalsalt )."' WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
	$updatequery = mysql_query( $update );

	if ( $updatequery ) {
		echo $lang['update_password_successful'];
	} else {
		echo $lang['update_password_unsuccessful'];
	}
}

?>
