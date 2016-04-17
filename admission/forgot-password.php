<?php

include dirname( __FILE__ ).'/php/csrf_protection/csrf-token.php';
include dirname( __FILE__ ).'/php/csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include dirname( __FILE__ ).'/php/config/config.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include dirname( __FILE__ ).'/php/language/'.$language[$_GET['lang']].'.php';
} else {
	include dirname( __FILE__ ).'/php/language/en.php';
}

?>
<!doctype html>
<html>
    <head>

        <?php include dirname( __FILE__ ).'/header.php'; ?>

    </head>

    <body>

		<div class="container">
		    <div class="form-bar" id="forgot">
                <div class="top-bar bar-blue"></div>
            </div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-twelve">
							<img src="images/logo.png"/>
						</div>
						<div class="column-twelve">
							<h4><i class="icon-key"></i><?php echo $lang['form_forgot_title'];?></h4>
						</div>
					</div>
				</div>
				<div class="section">
					<form method="post" action="<?php echo $baseurl;?>php/processor-forgot.php?lang=<?php echo $_GET['lang'];?>" id="forgot-form">
						<fieldset>
							<div class="grid-container">
								<div class="column-twelve">
									<div id="forgot-message"></div>
								</div>
								<div class="column-twelve">
									<div class="input-group">
										<?php echo CSRF::make( 'forgot-form' )->protect();?>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right irequire">
										<label for="useremail" class="group label-input">
										    <i class="icon-envelop"></i>
			                                <input type="email" id="useremail" name="useremail" maxlength="70" class="input-right" placeholder="<?php echo $lang['form_forgot_placeholder_useremail'];?>">
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
									        <input type="text" name="captcha" class="captcha center" id="captcha" maxlength="6" placeholder="<?php echo $lang['form_forgot_placeholder_captcha'];?>">
										</label>
                                    </div>
                                </div>
								<?php } ?>
								<div class="column-twelve">
									<button type="submit" id="forgot-button" class="button button-large button-blue"><?php echo $lang['form_forgot_button_forgot'];?></button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="footer">
					<div class="grid-container">
						<div class="column-twelve">
							<a href="<?php echo $baseurl;?>login.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_forgot_link_login'];?></a> <span class="black">|</span> <a href="<?php echo $baseurl;?>resend.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_forgot_link_resend_activation_token'];?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
