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

$update_username = strip_tags( trim( $_POST["update_username"] ) );
$update_finalusername = htmlspecialchars( $update_username, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'update-username-form' ) ) {
	echo $lang['update_username_wrong_security_token'];
} else {

	$usersearch = mysql_query( "SELECT * FROM ".$admission_users." WHERE application_id = '".mysql_real_escape_string( $update_finalusername )."'" );
	$userresult = mysql_num_rows( $usersearch );
	$userquery = mysql_fetch_array( $usersearch );

	if ( $userquery && $userquery['login_system_registrations_user_id'] != $_SESSION['userLogin'] ) {

		echo $lang['update_username_already_taken'];

	} else {

		$update1 = "UPDATE ".$admission_users." SET application_id = '".mysql_real_escape_string( $update_finalusername )."' WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery1 = mysql_query( $update1 );

		$update2 = "UPDATE ".$mysqltable_name_2." SET login_system_login_attempts_username = '".mysql_real_escape_string( $update_finalusername )."' WHERE login_system_login_attempts_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery2 = mysql_query( $update2 );

		$update3 = "UPDATE ".$mysqltable_name_3." SET login_system_forgot_password_username = '".mysql_real_escape_string( $update_finalusername )."' WHERE login_system_forgot_password_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery3 = mysql_query( $update3 );

		$update4 = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_username = '".mysql_real_escape_string( $update_finalusername )."' WHERE login_system_email_activation_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery4 = mysql_query( $update4 );

		if ( $updatequery1 && $updatequery2 && $updatequery3 && $updatequery4 ) {
			echo $lang['update_username_successful'];
		} else {
			echo $lang['update_username_unsuccessful'];
		}
	}
}

?>
