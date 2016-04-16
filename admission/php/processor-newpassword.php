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

if ( isset( $_GET['email'] ) && isset( $_GET['token'] ) ) {

	$useremail = strip_tags( trim( $_GET["email"] ) );
	$passtoken = strip_tags( trim( $_GET["token"] ) );

	$finaluseremail = htmlspecialchars( $useremail, ENT_QUOTES, 'UTF-8' );
	$finalpasstoken = htmlspecialchars( $passtoken, ENT_QUOTES, 'UTF-8' );

	$passtime = date( "Y-m-d H:i:s" );

	$selectexpire = mysql_query( "SELECT * FROM ".$mysqltable_name_3." WHERE login_system_forgot_password_token = '".mysql_real_escape_string( $finalpasstoken )."' AND login_system_forgot_password_expire > '".mysql_real_escape_string( $passtime )."'" );
	$resultexpire  = mysql_num_rows( $selectexpire );

	if ( $resultexpire == 1 ) {

		$search = mysql_query( "SELECT login_system_forgot_password_useremail, login_system_forgot_password_token FROM ".$mysqltable_name_3." WHERE login_system_forgot_password_useremail = '".mysql_real_escape_string( $finaluseremail )."' AND login_system_forgot_password_token = '".mysql_real_escape_string( $finalpasstoken )."'" );
		$result = mysql_num_rows( $search );

		if ( $result == 1 ) {

			$newpassword = strip_tags( trim( $_POST["password"] ) );
			$newretypepassword = strip_tags( trim( $_POST["retypepassword"] ) );

			$newfinalpass = htmlspecialchars( $newpassword, ENT_QUOTES, 'UTF-8' );
			$newfinalretypepass = htmlspecialchars( $newretypepassword, ENT_QUOTES, 'UTF-8' );

			if ( !CSRF::check( 'newpassword-form' ) ) {
				echo $lang['new_password_wrong_security_token'];
			} else {

				include dirname( __FILE__ ).'/php-pass-framework/PasswordHash.php';

				$hasher = new PasswordHash( 8, false );
				$finalsalt = hash( 'sha512', uniqid( mt_rand( 1, mt_getrandmax() ), true ) );
				$newpassword = $hasher->HashPassword( $newfinalpass . $finalsalt . $passwordsalt );

				$update = "UPDATE ".$admission_users." SET password = '".mysql_real_escape_string( $newpassword )."', salt = '".mysql_real_escape_string( $finalsalt )."' WHERE email_id = '".mysql_real_escape_string( $finaluseremail )."'";
				$updatequery = mysql_query( $update );

				if ( $updatequery ) {
					echo $lang['new_password_successful'];
				} else {
					echo $lang['new_password_unsuccessful'];
				}
			}
		} else {
			echo $lang['new_password_wrong_link_email_or_token'];
		}
	} else {
		echo $lang['new_password_link_expire'];
	}
} else {
	echo $lang['new_password_wrong_link_or_email'];
}
?>
