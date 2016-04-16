<?php

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include dirname( __FILE__ ).'/php/config/config.php';
include dirname( __FILE__ ).'/php/config/functions.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include dirname( __FILE__ ).'/php/language/'.$language[$_GET['lang']].'.php';
} else {
	include dirname( __FILE__ ).'/php/language/en.php';
}

if ( !$_GET["email"] && !$_GET["token"] ) {
	redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );
}

if ( $_GET['provider'] ) {
	if ( $social == true ) {
		if ( !$_SESSION['loginProviderDisplayName'] && !$_SESSION['loginProviderID'] ) {

			redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );

		} else {
			$time = time();

			if ( $time > $_SESSION['expire'] ) {
				session_destroy();
				timeout();
			}
		}
	}
}

?>
<!doctype html>
<html>
    <head>

        <?php include dirname( __FILE__ ).'/header.php'; ?>

    </head>

    <body>

		<div class="container">
		    <div class="form-bar" id="activation-form">
                <div class="top-bar bar-orange"></div>
            </div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-twelve">
							<h4><i class="icon-wand"></i><?php echo $lang['activation_form_title']?></h4>
						</div>
					</div>
				</div>
				<div class="section">
					<div class="grid-container">
						<div class="column-twelve">
							<div id="activation-message">
								<?php
if ( isset( $_GET['email'] ) && isset( $_GET['token'] ) ) {

	$useremail = strip_tags( trim( $_GET["email"] ) );
	$emailtoken = strip_tags( trim( $_GET["token"] ) );

	$finaluseremail = htmlspecialchars( $useremail, ENT_QUOTES, 'UTF-8' );
	$finalemailtoken = htmlspecialchars( $emailtoken, ENT_QUOTES, 'UTF-8' );

	$emailtime = date( "Y-m-d H:i:s" );

	$selectexpire = mysql_query( "SELECT * FROM ".$mysqltable_name_4." WHERE login_system_email_activation_token = '".mysql_real_escape_string( $finalemailtoken )."' AND login_system_email_activation_expire > '".mysql_real_escape_string( $emailtime )."'" );
	$resultexpire  = mysql_num_rows( $selectexpire );

	if ( $resultexpire == 1 ) {

		$search = mysql_query( "SELECT login_system_email_activation_useremail, login_system_email_activation_token, login_system_email_activation_status FROM ".$mysqltable_name_4." WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."' AND login_system_email_activation_token = '".mysql_real_escape_string( $finalemailtoken )."' AND login_system_email_activation_status = '0'" );
		$result = mysql_num_rows( $search );

		if ( $result == 1 ) {

			$update = "UPDATE ".$mysqltable_name_4." SET login_system_email_activation_status ='1' WHERE login_system_email_activation_useremail = '".mysql_real_escape_string( $finaluseremail )."' AND login_system_email_activation_token = '".mysql_real_escape_string( $finalemailtoken )."' AND login_system_email_activation_status = '0'";
			$updatequery = mysql_query( $update );

			if ( $updatequery ) {
				echo $lang['activation_successful'];
			} else {
				echo $lang['activation_unsuccessful'];
			}

		} else {
			echo $lang['activation_already_active'];
		}
	} else {
		echo $lang['activation_link_expire'];
	}
} else {
	echo $lang['activation_wrong_link_or_email'];
}
?>
							</div>
						</div>
					</div>
				</div>
				<div class="footer">
					<div class="grid-container">
						<div class="column-twelve">
							<a href="<?php echo $baseurl;?>login.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['activation_link_login']?></a> <span class="black">|</span> <a href="<?php echo $baseurl;?>resend.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['activation_link_resend_activation_token']?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
