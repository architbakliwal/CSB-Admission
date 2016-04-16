<?php

include '../php/csrf_protection/csrf-token.php';
include '../php/csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include '../php/config/config.php';
include '../php/config/functions.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include '../php/language/'.$language[$_GET['lang']].'.php';
} else {
	include '../php/language/en.php';
}

if ( !$_SESSION['userLogin'] && !$_SESSION['userName'] && !isset( $_SESSION['userName'] ) ) {

	redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );

} else {
	$time = time();

	if ( $time > $_SESSION['expire'] ) {
		session_destroy();
		timeout();
		exit( 0 );
	}
}

?>
<!doctype html>
<html>
    <head>

        <?php include '../header.php'; ?>

    </head>

    <body>

	    <?php

$userInfo = mysql_query( "SELECT login_system_registrations_user_id FROM ".$admission_users." WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'" );
$userQuery = mysql_num_rows( $userInfo );

$user = mysql_fetch_array( $userInfo );

?>

		<div class="wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-orange"></div>
			</div>
			<div class="form">
				<div class="header dashboard_header">
					<div class="grid-container">
						<div class="column-twelve">
							<h4><?php echo $lang['dashboard_title'];?></h4>
						</div>
	                    <div class="column-eleven" style="text-align: left;">
							<?php echo $lang['application_id'];?><?php echo $_SESSION['userName'];?>
						</div>
						<div class="column-one">
							<a href="<?php echo $baseurl;?>logout.php?user=<?php echo $user["login_system_registrations_user_id"];?>&lang=<?php echo $_GET['lang'];?>"><?php echo $lang['dashboard_form_logout'];?></a>
						</div>
					</div>
				</div>
				<div class="description">
				    <div class="grid-container">
					    <div class="column-ten">
						    <h4><?php echo $lang['dashboard_subtitle_password'];?></h4>
						</div>
						<div class="column-two">
							<a href="<?php echo $baseurl;?>admin/dashboard.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['dashboard_form_back'];?></a>
						</div>
					</div>
				</div>
				<div class="section">
					<form method="post" action="<?php echo $baseurl;?>php/admin/processor-update-password.php?lang=<?php echo $_GET['lang'];?>" id="update-password-form">
						<fieldset>
							<div class="grid-container">
								<div class="column-twelve">
									<div id="update-password-message"></div>
								</div>
								<div class="column-twelve">
									<div class="input-group">
										<?php echo CSRF::make( 'update-password-form' )->protect();?>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
										<label for="update_password" class="group label-input">
											<i class="icon-key"></i>
											<input type="password" id="update_password" name="update_password" maxlength="30" class="input-right" placeholder="<?php echo $lang['update_password_placeholder_password'];?>">
										</label>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
										<label for="update_retypepassword" class="group label-input">
											<i class="icon-key"></i>
											<input type="password" id="update_retypepassword" name="update_retypepassword" maxlength="30" class="input-right" placeholder="<?php echo $lang['update_password_placeholder_retype_password'];?>">
										</label>
									</div>
								</div>
								<div class="column-twelve">
									<button type="submit" id="update-password-button" class="button button-large button-orange"><?php echo $lang['update_password_button'];?></button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="copyright">
					<div class="grid-container">
						<div class="column-twelve">
							<p><?php echo $lang['dashboard_copyright_info'];?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
