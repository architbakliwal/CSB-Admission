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

$useremail = strip_tags( trim( $_POST["useremail"] ) );
$finaluseremail = htmlspecialchars( $useremail, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'complete-social-register-form' ) ) {
	echo $lang['complete_registration_wrong_security_token'];
} else {

	if ( $_SESSION['loginProviderID'] && $_SESSION['loginProviderDisplayName'] ) {

		$config = dirname( __FILE__ ).'/hybridauth/config.php';
		include dirname( __FILE__ ).'/hybridauth/Hybrid/Auth.php';

		try {

			$hybridauth = new Hybrid_Auth( $config );
			$provider = @ trim( strip_tags( $_GET["provider"] ) );
			$adapter = $hybridauth->getAdapter( $provider );

			$finalemailtoken = md5( uniqid( rand(), true ) );
			$datetime = date( "Y-m-d H:i:s" );
			$expiretokenemail = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

			$duplicate = mysql_query( "SELECT * FROM ".$mysqltable_name_5." WHERE login_system_register_social_networks_email = '".mysql_real_escape_string( $finaluseremail )."'" );
			$result = mysql_num_rows( $duplicate );
			if ( $result == 0 ) {

				$usersuccess = mysql_query( "SELECT login_system_register_social_networks_provider_user_id FROM ".$mysqltable_name_5." WHERE login_system_register_social_networks_provider_user_id = '".mysql_real_escape_string( $_SESSION['loginProviderID'] )."'" );
				$usersql = mysql_num_rows( $usersuccess );

				$updatesuccess = "UPDATE ".$mysqltable_name_5." SET login_system_register_social_networks_email = '".mysql_real_escape_string( $finaluseremail )."', login_system_register_social_networks_date = '".mysql_real_escape_string( $datetime )."' WHERE login_system_register_social_networks_provider_user_id = '".mysql_real_escape_string( $_SESSION['loginProviderID'] )."'";
				$updatesession = mysql_query( $updatesuccess );

				$usersearch = mysql_query( "SELECT login_system_register_social_networks_email FROM ".$mysqltable_name_5." WHERE login_system_register_social_networks_provider_user_id = '".mysql_real_escape_string( $_SESSION['loginProviderID'] )."'" );
				$userquery = mysql_num_rows( $usersearch );

				if ( $userquery ) {
					echo $lang['complete_registration_success'];
					redirect_time( $baseurl.'admin/dashboard.php?provider='.$provider.'&lang='.$_GET['lang'].'' );
				} else {
					echo $lang['complete_registration_error'];
				}

			} else {
				echo $lang['complete_registration_duplicate_email'];
			}
		}
		catch( Exception $e ) {
			switch ( $e->getCode() ) {
			case 0 : $error = $lang['login_social_hybrid_error']; break;
			case 1 : $error = $lang['login_social_hybrid_conf_error_']; break;
			case 2 : $error = $lang['login_social_hybrid_not_conf_provider']; break;
			case 3 : $error = $lang['login_social_hybrid_unknown_provider']; break;
			case 4 : $error = $lang['login_social_hybrid_not_credentials']; break;
			case 5 : $error = $lang['login_social_hybrid_login_failed']; break;
			case 6 : $error = $lang['login_social_hybrid_request_profile_failed'];
				$adapter->logout();
				break;
			case 7 : $error = $lang['login_social_hybrid_not_connected'];
				$adapter->logout();
				break;
			}
		}
	}
}
?>
