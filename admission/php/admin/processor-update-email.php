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

$update_email = strip_tags( trim( $_POST["update_email"] ) );
$update_finalemail = htmlspecialchars( $update_email, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'update-email-form' ) ) {
	echo $lang['update_email_wrong_security_token'];
} else {

	$emailsearch = mysql_query( "SELECT * FROM ".$admission_users." WHERE email_id = '".mysql_real_escape_string( $update_finalemail )."'" );
	$emailresult = mysql_num_rows( $emailsearch );
	$emailquery = mysql_fetch_array( $emailsearch );

	if ( $emailquery && $emailquery['login_system_registrations_user_id'] != $_SESSION['userLogin'] ) {

		echo $lang['update_email_already_taken'];

	} else {

		$update1 = "UPDATE ".$admission_users." SET email_id = '".mysql_real_escape_string( $update_finalemail )."' WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery1 = mysql_query( $update1 );

		$update2 = "UPDATE ".$mysqltable_name_3." SET login_system_forgot_password_useremail = '".mysql_real_escape_string( $update_finalemail )."' WHERE login_system_forgot_password_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery2 = mysql_query( $update2 );

		$update3 = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_useremail = '".mysql_real_escape_string( $update_finalemail )."' WHERE login_system_email_activation_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
		$updatequery3 = mysql_query( $update3 );

		if ( $updatequery1 && $updatequery2 && $updatequery3 ) {
			echo $lang['update_email_successful'];
		} else {
			echo $lang['update_email_unsuccessful'];
		}
	}
}

?>
