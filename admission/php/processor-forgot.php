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
$verification = strip_tags( trim( $_POST["captcha"] ) );

$finaluseremail = htmlspecialchars( $useremail, ENT_QUOTES, 'UTF-8' );
$finalverification = htmlspecialchars( $verification, ENT_QUOTES, 'UTF-8' );

if ( !CSRF::check( 'forgot-form' ) ) {
	echo $lang['forgot_wrong_security_token'];
} else {

	$datetime = date( "Y-m-d H:i:s" );

	$searchblock = mysql_query( "SELECT login_system_forgot_password_attempts, login_system_forgot_password_blocked_time FROM ".$mysqltable_name_3." WHERE login_system_forgot_password_useremail = '".mysql_real_escape_string( $finaluseremail )."'" );
	$resultblock = mysql_num_rows( $searchblock );
	$blockResult = mysql_fetch_array( $searchblock );

	$searchid = mysql_query( "SELECT login_system_registrations_user_id FROM ".$admission_users." WHERE email_id = '".mysql_real_escape_string( $finaluseremail )."'" );
	$resultid = mysql_num_rows( $searchid );
	$queryid = mysql_fetch_array( $searchid );

	if ( $SMTP == true ) {
		if ( $mysql == true ) {
			if ( $datetime > $blockResult['login_system_forgot_password_blocked_time'] ) {
				$search = mysql_query( "SELECT application_id, f_name, l_name FROM ".$admission_users." WHERE email_id = '".mysql_real_escape_string( $finaluseremail )."'" );
				$result = mysql_num_rows( $search );
				$resultInfo = mysql_fetch_array( $search );
				$finalusername = $resultInfo['application_id'];
				$finalfirstname = $resultInfo['f_name'];
				$finallastname = $resultInfo['l_name'];
				if ( $result == 1 && $resultInfo ) {

					$language = array( 'en' => 'en', 'pt' => 'pt' );

					if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
						include dirname( __FILE__ ).'/language/'.$language[$_GET['lang']].'.php';
					} else {
						include dirname( __FILE__ ).'/language/en.php';
					}

					$finalpasstoken = md5( uniqid( rand(), true ) );
					$expiretokenpass = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

					if ( $resultblock == 0 ) {

						$sql = "INSERT INTO ".$mysqltable_name_3." (login_system_forgot_password_user_id,login_system_forgot_password_username,login_system_forgot_password_expire,login_system_forgot_password_useremail,login_system_forgot_password_token,login_system_forgot_password_date,login_system_forgot_password_ip,login_system_forgot_password_attempts) VALUES ('".mysql_real_escape_string( $queryid['login_system_registrations_user_id'] )."','".mysql_real_escape_string( $finalusername )."','".mysql_real_escape_string( $expiretokenpass )."','".mysql_real_escape_string( $finaluseremail )."','".mysql_real_escape_string( $finalpasstoken )."','".mysql_real_escape_string( $datetime )."','".mysql_real_escape_string( $finaluserip )."','1')";
						$insert = mysql_query( $sql );

					} else {

						$updatefail= "UPDATE ".$mysqltable_name_3." SET login_system_forgot_password_attempts = login_system_forgot_password_attempts+1, login_system_forgot_password_ip = '".mysql_real_escape_string( $finaluserip )."' ,login_system_forgot_password_expire = '".mysql_real_escape_string( $expiretokenpass )."', login_system_forgot_password_token = '".mysql_real_escape_string( $finalpasstoken )."', login_system_forgot_password_date = '".mysql_real_escape_string( $datetime )."' WHERE login_system_forgot_password_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
						$updatequery = mysql_query( $updatefail );

					}

					if ( $blockResult['login_system_forgot_password_attempts'] == 5 ) {

						$blockedtime = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

						$blocked = "UPDATE ".$mysqltable_name_3." SET login_system_forgot_password_blocked_time = '".mysql_real_escape_string( $blockedtime )."' WHERE login_system_forgot_password_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
						$blockedquery = mysql_query( $blocked );

						echo $lang['forgot_account_locked'];

					} elseif ( $blockResult['login_system_forgot_password_attempts'] >= 6 ) {

						$sqlupdate = "UPDATE ".$mysqltable_name_3." SET login_system_forgot_password_attempts = '0', login_system_forgot_password_blocked_time = '0000-00-00 00:00:00', login_system_forgot_password_ip = '".mysql_real_escape_string( $finaluserip )."', login_system_forgot_password_token = '".mysql_real_escape_string( $finalpasstoken )."', login_system_forgot_password_expire = '".mysql_real_escape_string( $expiretokenpass )."', login_system_forgot_password_date = '".mysql_real_escape_string( $datetime )."'  WHERE login_system_forgot_password_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
						$updatesql = mysql_query( $sqlupdate );

						include dirname( __FILE__ ).'/phpmailer/PHPMailerAutoload.php';
						include dirname( __FILE__ ).'/messages/automessagepass.php';

						$automail = new PHPMailer();
						$automail->IsSMTP();
						$automail->SMTPAuth = true;
						$automail->SMTPSecure = $protocol;
						$automail->Host = $host;
						$automail->Port = $port;
						$automail->Username = $smtpusername;
						$automail->Password = $smtppassword;
						$automail->From = $youremail;
						$automail->FromName = $yourname;
						$automail->isHTML( true );
						$automail->CharSet = "UTF-8";
						$automail->Encoding = "base64";
						$automail->Timeout = 200;
						$automail->ContentType = "text/html";
						$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
						$automail->AddAddress( $finaluseremail );
						$automail->Subject = $lang['forgot_account_subject'];
						$automail->Body = $automessagepass;
						$automail->AltBody = "To view this message, please use an HTML compatible email";

						if ( $automail->Send() ) {
							echo $lang['forgot_successful'];
						} else {
							echo $lang['forgot_unsuccessful'];
						}

					} else {

						include dirname( __FILE__ ).'/phpmailer/PHPMailerAutoload.php';
						include dirname( __FILE__ ).'/messages/automessagepass.php';

						$automail = new PHPMailer();
						$automail->IsSMTP();
						$automail->SMTPAuth = true;
						$automail->SMTPSecure = $protocol;
						$automail->Host = $host;
						$automail->Port = $port;
						$automail->Username = $smtpusername;
						$automail->Password = $smtppassword;
						$automail->From = $youremail;
						$automail->FromName = $yourname;
						$automail->isHTML( true );
						$automail->CharSet = "UTF-8";
						$automail->Encoding = "base64";
						$automail->Timeout = 200;
						$automail->ContentType = "text/html";
						$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
						$automail->AddAddress( $finaluseremail );
						$automail->Subject = $lang['forgot_account_subject'];
						$automail->Body = $automessagepass;
						$automail->AltBody = "To view this message, please use an HTML compatible email";

						if ( $automail->Send() ) {
							echo $lang['forgot_successful'];
						} else {
							echo $lang['forgot_unsuccessful'];
						}
					}
				} else {
					echo $lang['forgot_missing_member'];
				}
			} else {
				echo $lang['forgot_account_still_blocked'];
			}
		} else {
			echo $lang['forgot_failed_connect_with_db'];
		}
	} else {
		echo $lang['forgot_failed_connect_with_smtp'];
	}
}
?>
