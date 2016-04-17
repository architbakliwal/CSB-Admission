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

if ( $_SESSION['userLogin'] && $_SESSION['userName'] ) {
	redirect( $baseurl.'admin/dashboard.php?lang='.$_GET['lang'].'' );
}

?>
<!doctype html>
<html>
    <head>

        <?php include dirname( __FILE__ ).'/header.php'; ?>

    </head>

    <body>

		<div class="container container-small">
		    <div class="form-bar" id="login">
				<div class="top-bar bar-blue"></div>
			</div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-twelve">
							<img src="images/logo.png"/>
						</div>
						<div class="column-twelve">
							<h4><i class="icon-lock-2"></i><?php echo $lang['form_login_title'];?></h4>
						</div>
					</div>
				</div>
				<div class="section">
					<form method="post" action="<?php echo $baseurl;?>php/processor-login.php?lang=<?php echo $_GET['lang'];?>" id="login-form">
						<fieldset>
							<div class="grid-container">
								<div class="column-twelve">
									<?php if ( $error ) {echo $error;} else {echo '<div id="login-message"></div>';}?>
								</div>
								<div class="column-twelve">
									<div class="input-group">
										<?php echo CSRF::make( 'login-form' )->protect();?>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
									    <label for="username" class="group label-input">
										    <i class="icon-user-3"></i>
			                                <input type="text" id="username" name="username" maxlength="30" class="input-right" placeholder="Enter your Application Id">
										</label>
								    </div>
									<div class="input-group-right irequire">
									    <label for="password" class="group label-input">
										    <i class="icon-key"></i>
			                                <input type="password" id="password" name="password" maxlength="30" class="input-right" placeholder="<?php echo $lang['form_login_placeholder_password'];?>">
										</label>
								    </div>
								</div>
								<?php if ( $captcha == true ) { ?>
								<div class="column-six">
                                    <div class="captcha-group">
                                        <div class="captcha center">
										    <img src="<?php echo $baseurl;?>php/captcha/captcha.php" alt="captcha">
									    </div>
                                    </div>
                                </div>
								<div class="column-six">
                                    <div class="captcha-group">
                                        <label for="captcha" class="group label-captcha">
									        <input type="text" name="captcha" class="captcha center" id="captcha" maxlength="6" placeholder="<?php echo $lang['form_login_placeholder_captcha'];?>">
										</label>
                                    </div>
                                </div>
								<?php } ?>
								<div class="column-twelve">
									<button type="submit" id="login-button" class="button button-large button-blue"><?php echo $lang['form_login_button_login'];?></button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="footer">
					<div class="grid-container">
						<div class="column-twelve">
							<a href="<?php echo $baseurl;?>register.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_login_link_register'];?></a> <span class="black">|</span> <a href="<?php echo $baseurl;?>forgot-password.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_login_link_forgot_password'];?></a> <span class="black">|</span> <a href="<?php echo $baseurl;?>resend.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_login_resend_activation_token'];?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
