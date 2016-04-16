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

$user_name = strip_tags( trim( $_POST["username"] ) );
$password = strip_tags( trim( $_POST["password"] ) );
$verification = strip_tags( trim( $_POST["captcha"] ) );

$finalusername = htmlspecialchars( $user_name, ENT_QUOTES, 'UTF-8' );
$finalpassword = htmlspecialchars( $password, ENT_QUOTES, 'UTF-8' );
$finalverification = htmlspecialchars( $verification, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'login-form' ) ) {
	echo $lang['login_wrong_security_token'];
} else {

	$datetime = date( "Y-m-d H:i:s" );

	$userInfo = mysql_query( "SELECT login_system_registrations_user_id, application_id, password, salt FROM ".$admission_users." WHERE application_id = '".mysql_real_escape_string( $finalusername )."'" );
	$userQuery = mysql_num_rows( $userInfo );
	$userSql = mysql_fetch_array( $userInfo );

	$userstatus = mysql_query( "SELECT login_system_email_activation_status FROM ".$mysqltable_name_4." WHERE login_system_email_activation_username = '".mysql_real_escape_string( $finalusername )."'" );
	$userselect = mysql_num_rows( $userstatus );
	$userresult = mysql_fetch_array( $userstatus );

	$infoUser = mysql_query( "SELECT login_system_login_attempts_attempts, login_system_login_attempts_blocked_time FROM ".$mysqltable_name_2." WHERE login_system_login_attempts_username = '".mysql_real_escape_string( $finalusername )."'" );
	$queryUser = mysql_num_rows( $infoUser );
	$sqlUser = mysql_fetch_array( $infoUser );

	if ( $userQuery == 1 ) {

		if ( $userresult['login_system_email_activation_status'] == 1 ) {

			if ( $datetime > $sqlUser['login_system_login_attempts_blocked_time'] ) {

				include dirname( __FILE__ ).'/php-pass-framework/PasswordHash.php';

				$hasher = new PasswordHash( 8, false );
				$finalsalt = $userSql['salt'];
				$database_password = $userSql['password'];
				$check = $hasher->CheckPassword( $finalpassword . $finalsalt . $passwordsalt, $database_password );

				if ( $check ) {

					if ( $queryUser == 0 ) {

						$insertsuccess = "INSERT INTO ".$mysqltable_name_2." (login_system_login_attempts_user_id,login_system_login_attempts_ip,login_system_login_attempts_attempts,login_system_login_attempts_first_date,login_system_login_attempts_date,login_system_login_attempts_username) VALUES ('".mysql_real_escape_string( $userSql['login_system_registrations_user_id'] )."','".mysql_real_escape_string( $finaluserip )."',0,'".mysql_real_escape_string( $datetime )."','".mysql_real_escape_string( $datetime )."','".mysql_real_escape_string( $finalusername )."')";
						$insertquery = mysql_query( $insertsuccess );

					} else {

						$updatesuccess= "UPDATE ".$mysqltable_name_2." SET login_system_login_attempts_attempts = 0, login_system_login_attempts_blocked_time = '0000-00-00 00:00:00', login_system_login_attempts_ip = '".mysql_real_escape_string( $finaluserip )."', login_system_login_attempts_date = '".mysql_real_escape_string( $datetime )."' WHERE login_system_login_attempts_username = '".mysql_real_escape_string( $finalusername )."'";
						$updatequery = mysql_query( $updatesuccess );

					}

					$_SESSION['userLogin'] = $userSql['login_system_registrations_user_id'];
					$_SESSION['userName'] = $userSql['application_id'];

					$_SESSION['start'] = time();
					$_SESSION['expire'] = $_SESSION['start'] + ( 60*60 );

					if ( $_SESSION['userLogin'] ) {

						echo $lang['login_account_success'];
						redirect_time( $baseurl.'admin/dashboard.php?lang='.$_GET['lang'].'' );

					} else {
						echo $lang['login_no_session'];
					}
				} else {

					if ( $sqlUser['login_system_login_attempts_attempts'] >= 3 ) {

						$unlocktime = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

						$blocked = "UPDATE ".$mysqltable_name_2." SET login_system_login_attempts_blocked_time = '".mysql_real_escape_string( $unlocktime )."' WHERE login_system_login_attempts_username = '".mysql_real_escape_string( $finalusername )."'";
						$blockedquery = mysql_query( $blocked );

						echo $lang['login_account_blocked'];

					} else {

						if ( $queryUser == 0 ) {

							$insertfail = "INSERT INTO ".$mysqltable_name_2." (login_system_login_attempts_ip,login_system_login_attempts_attempts,login_system_login_attempts_date,login_system_login_attempts_username) VALUES ('".mysql_real_escape_string( $finaluserip )."',1,'".mysql_real_escape_string( $datetime )."','".mysql_real_escape_string( $finalusername )."')";
							$insertquery = mysql_query( $insertfail );

						} else {

							$updatefail = "UPDATE ".$mysqltable_name_2." SET login_system_login_attempts_attempts = login_system_login_attempts_attempts+1, login_system_login_attempts_ip = '".mysql_real_escape_string( $finaluserip )."', login_system_login_attempts_date = '".mysql_real_escape_string( $datetime )."' WHERE login_system_login_attempts_username = '".mysql_real_escape_string( $finalusername )."'";
							$updatequery = mysql_query( $updatefail );

						}

						echo $lang['login_incorrect_information'];
					}

				}

			} else {
				echo $lang['login_account_still_locked'];
			}
		} else {
			echo $lang['login_account_not_activated'];
		}
	} else {
		echo $lang['login_incorrect_information'];
	}
}
?>
