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

$update_social_email = strip_tags( trim( $_POST["update_social_useremail"] ) );
$update_final_social_email = htmlspecialchars( $update_social_email, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'update-social-account' ) ) {
	echo $lang['update_social_account_wrong_security_token'];
} else {

	$emailsearch = mysql_query( "SELECT * FROM ".$mysqltable_name_5." WHERE login_system_register_social_networks_email = '".mysql_real_escape_string( $update_final_social_email )."'" );
	$emailresult = mysql_num_rows( $emailsearch );
	$emailquery = mysql_fetch_array( $emailsearch );

	if ( $emailquery && $emailquery['login_system_register_social_networks_provider_user_id'] != $_SESSION['loginProviderID'] ) {

		echo $lang['update_social_account_already_taken'];

	} else {

		$update1 = "UPDATE ".$mysqltable_name_5." SET login_system_register_social_networks_email = '".mysql_real_escape_string( $update_final_social_email )."' WHERE login_system_register_social_networks_provider_user_id = '".mysql_real_escape_string( $_SESSION['loginProviderID'] )."'";
		$updatequery1 = mysql_query( $update1 );

		if ( $updatequery1 ) {
			echo $lang['update_social_account_successful'];
		} else {
			echo $lang['update_social_account_unsuccessful'];
		}
	}
}

?>
