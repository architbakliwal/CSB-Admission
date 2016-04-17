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

if ( $_GET['provider'] ) {
	if ( $social == true ) {
		if ( !$_SESSION['loginProviderDisplayName'] && !$_SESSION['loginProviderID'] ) {

			redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );

		} else {
			$time = time();

			if ( $time > $_SESSION['expire'] ) {
				session_destroy();
				redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );
			}
		}
	}
} else {
	if ( !$_SESSION['userLogin'] && !$_SESSION['userName'] ) {

		redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );

	} else {
		$time = time();

		if ( $time > $_SESSION['expire'] ) {
			session_destroy();
			redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );
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
		    <div class="form-bar" id="complete-social-register">
                <div class="top-bar bar-blue"></div>
            </div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-twelve">
							<h4><i class="icon-envelop-opened"></i><?php echo $lang['form_complete_registration_title'];?></h4>
						</div>
					</div>
				</div>
				<div class="section">
					<form method="post" action="<?php echo $baseurl;?>php/processor-complete-social-register.php?provider=<?php echo $_GET["provider"];?>&lang=<?php echo $_GET['lang'];?>" id="complete-social-register-form">
						<fieldset>
							<div class="grid-container">
								<div class="column-twelve">
									<div id="complete-social-register-message"></div>
								</div>
								<div class="column-twelve">
									<div class="input-group">
										<?php echo CSRF::make( 'complete-social-register-form' )->protect();?>
									</div>
								</div>
								<div class="column-twelve">
									<div class="input-group-right">
										<label for="useremail" class="group label-input">
										    <i class="icon-envelop"></i>
			                                <input type="email" id="useremail" name="useremail" maxlength="70" class="input-right" placeholder="<?php echo $lang['form_complete_registration_placeholder_useremail'];?>">
										</label>
								    </div>
								</div>
								<div class="column-twelve">
									<button type="submit" id="complete-social-register-button" class="button button-large button-blue"><?php echo $lang['form_complete_registration_button'];?></button>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
				<div class="footer">
					<div class="grid-container">
						<div class="column-twelve">
							<a href="<?php echo $baseurl;?>login.php?lang=<?php echo $_GET['lang'];?>"><?php echo $lang['form_complete_registration_link_login'];?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

    </body>
</html>
