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

$update_firstname = strip_tags( trim( $_POST["update_firstname"] ) );
$update_lastname = strip_tags( trim( $_POST["update_lastname"] ) );

$update_finalfirstname = htmlspecialchars( $update_firstname, ENT_QUOTES, 'UTF-8' );
$update_finallastname = htmlspecialchars( $update_lastname, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'update-account-form' ) ) {
	echo $lang['update_account_wrong_security_token'];
} else {

	$update1 = "UPDATE ".$admission_users." SET f_name = '".mysql_real_escape_string( $update_finalfirstname )."', l_name = '".mysql_real_escape_string( $update_finallastname )."' WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'";
	$updatequery1 = mysql_query( $update1 );

	if ( $updatequery1 ) {
		echo $lang['update_account_successful'];
	} else {
		echo $lang['update_account_unsuccessful'];
	}
}

?>
