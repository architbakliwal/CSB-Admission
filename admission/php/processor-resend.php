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

if ( !CSRF::check( 'resend-form' ) ) {
	echo $lang['resend_activation_token_wrong_security_token'];
} else {

	$datetime = date( "Y-m-d H:i:s" );

	$searchblock = mysql_query( "SELECT login_system_email_activation_status, login_system_email_activation_attempts, login_system_email_activation_blocked_time FROM ".$mysqltable_name_4." WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."'" );
	$resultblock = mysql_num_rows( $searchblock );
	$blockResult = mysql_fetch_array( $searchblock );

	if ( $SMTP == true ) {
		if ( $mysql == true ) {
			if ( $blockResult['login_system_email_activation_status'] == 0 ) {
				if ( $datetime > $blockResult['login_system_email_activation_blocked_time'] ) {
					$search = mysql_query( "SELECT * FROM ".$mysqltable_name_4." WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."'" );
					$result = mysql_num_rows( $search );

					$searchuser = mysql_query( "SELECT f_name, l_name, application_id FROM ".$admission_users." WHERE email_id = '".mysql_real_escape_string( $finaluseremail )."'" );
					$resultusercount = mysql_num_rows( $searchuser );
					$resultuser = mysql_fetch_array( $searchuser );

					$finalfirstname = $resultuser['f_name'];
					$finallastname = $resultuser['l_name'];
					$finalusername = $resultuser['application_id'];

					if ( $result == 1 ) {

						$finalemailtoken = md5( uniqid( rand(), true ) );
						$expiretokenemail = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

						$sqlupdate = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_attempts = login_system_email_activation_attempts+1, login_system_email_activation_ip = '".mysql_real_escape_string( $finaluserip )."', login_system_email_activation_token = '".mysql_real_escape_string( $finalemailtoken )."',login_system_email_activation_expire = '".mysql_real_escape_string( $expiretokenemail )."', login_system_email_activation_date = '".mysql_real_escape_string( $datetime )."'  WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
						$updatesql = mysql_query( $sqlupdate );

						if ( $blockResult['login_system_email_activation_attempts'] == 5 ) {

							$blockedtime = date( "Y-m-d H:i:s", strtotime( '+1 hour' ) );

							$blocked = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_blocked_time = '".mysql_real_escape_string( $blockedtime )."' WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
							$blockedquery = mysql_query( $blocked );

							echo $lang['resend_activation_token_account_locked'];

						} elseif ( $blockResult['login_system_email_activation_attempts'] >= 6 ) {

							$sqlupdate = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_attempts = 0, login_system_email_activation_blocked_time = '0000-00-00 00:00:00', login_system_email_activation_ip = '".mysql_real_escape_string( $finaluserip )."', login_system_email_activation_token = '".mysql_real_escape_string( $finalemailtoken )."',login_system_email_activation_expire = '".mysql_real_escape_string( $expiretokenemail )."', login_system_email_activation_date = '".mysql_real_escape_string( $datetime )."'  WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."'";
							$updatesql = mysql_query( $sqlupdate );

							include dirname( __FILE__ ).'/phpmailer/PHPMailerAutoload.php';
							include dirname( __FILE__ ).'/messages/automessageemail.php';

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
							$automail->Subject = $lang['resend_activation_account'];
							$automail->Body = $automessageemail;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ( $automail->Send() ) {
								echo $lang['resend_activation_token_successful'];
								redirect_time( $baseurl.'login.php?lang='.$_GET['lang'].'' );
							} else {
								echo $lang['resend_activation_token_unsuccessful'];
							}

						} else {

							include dirname( __FILE__ ).'/phpmailer/PHPMailerAutoload.php';
							include dirname( __FILE__ ).'/messages/automessageemail.php';

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
							$automail->Subject = $lang['resend_activation_account'];
							$automail->Body = $automessageemail;
							$automail->AltBody = "To view this message, please use an HTML compatible email";

							if ( $automail->Send() ) {
								echo $lang['resend_activation_token_successful'];
								redirect_time( $baseurl.'login.php?lang='.$_GET['lang'].'' );
							} else {
								echo $lang['resend_activation_token_unsuccessful'];
							}
						}
					} else {
						echo $lang['resend_activation_token_missing_member'];
					}
				} else {
					echo $lang['resend_activation_token_account_still_blocked'];
				}
			} else {
				echo $lang['resend_activation_token_account_already_active'];
			}
		} else {
			echo $lang['resend_activation_token_failed_connect_with_db'];
		}
	} else {
		echo $lang['resend_activation_token_failed_connect_with_smtp'];
	}
}
?>
