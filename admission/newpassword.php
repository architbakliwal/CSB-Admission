<?php

include dirname( __FILE__ ).'/php/csrf_protection/csrf-token.php';
include dirname( __FILE__ ).'/php/csrf_protection/csrf-class.php';

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

		<?php

$useremail = strip_tags( trim( $_GET["email"] ) );
$passtoken = strip_tags( trim( $_GET["token"] ) );

$finaluseremail = htmlspecialchars( $useremail, ENT_QUOTES, 'UTF-8' );
$finalpasstoken = htmlspecialchars( $passtoken, ENT_QUOTES, 'UTF-8' );

?>

		<div class="container">
		    <div class="form-bar" id="newpassword">
				<div class="top-bar bar-orange"></div>
			</div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-twelve">
							<img src="images/logo.JPG"/>
						</div>
						<div class="column-twelve">
							<h4><i class="icon-key"></i><?php echo $lang['form_new_password_title'];?></h4>
						</div>
					</div>
				</div>
				<div class="section">
					<form method="post" action="<?php echo $baseurl;?>php/processor-newpassword.php?email=<?php echo $finaluseremail;?>&token=<?php echo $finalpasstoken;?>&lang=<?php echo $_GET['lang'];?>" id="newpassword-form">
						<fieldset>
							<div class="grid-container">
								<div class="column-twelve">
									<div id="newpassword-message"></div>
								</div>
								<div class="column-twelve">
									<div class="input-group">
										<?php echo CSRF::make( 'newpassword-form' )->protect();?>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
									    <label for="password" class="group label-input">
										    <i class="icon-key"></i>
			                                <input type="password" id="password" name="password" maxlength="30" class="input-right" placeholder="<?php echo $lang['form_new_password_placeholder_password'];?>">
										</label>
								    </div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
									    <label for="retypepassword" class="group label-input">
										    <i class="icon-key"></i>
			                                <input type="password" id="retypepassword" name="retypepassword" maxlength="30" class="input-right" placeholder="<?php echo $lang['form_new_password_placeholder_retype_password'];?>">
										</label>
								    </div>
								</div>
								<div class="column-twelve">
									<button type="submit" id="newpassword-button" class="button button-large button-orange"><?php echo $lang['form_new_password_button_new_password'];?></button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="footer">
					<div class="grid-container">
						<div class="column-twelve">
							<a href="<?php echo $baseurl;?>login.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_new_password_link_login'];?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
