<?php
$some_name = session_name( "CSBAdmission" );
session_start();

include '../php/csrf_protection/csrf-token.php';
include '../php/csrf_protection/csrf-class.php';

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

$_SESSION['start'] = time();
$_SESSION['expire'] = $_SESSION['start'] + ( 60*60 );

if ( strlen( trim( $_SESSION['userName'] ) ) == 0 ) {
	session_destroy();
	redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );
	die();
}

?>
<!doctype html>
<html>
    <head>

        <?php include '../header.php'; ?>

    </head>

    <body>

	    <?php if ( $_SESSION['userLogin'] && $_SESSION['userName'] ) { ?>
		<div class="wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-orange"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<h4><?php echo $lang['dashboard_title'];?></h4>
					</div>
                    <div class="column-twelve" style="text-align: left;">
						<?php echo $lang['application_id'];?><?php echo $_SESSION['userName'];?>
					</div>

				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="section inner_section">
							<form method="post" action="<?php echo $baseurl;?>php/processor-submit.php?lang=<?php echo $_GET['lang'];?>" id="section_submit">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
										    <div class="box">
												<div class="box-section center">
													<div class="column-twelve" style="display:none;">
														<input type="text" id="baseurl" value="<?php echo $baseurl;?>"/>
													</div>
													<div class="column-twelve" style="margin:30px;">
														<div class="input-group-right irequire">
															<div class="radio-group">
																<label for="iagree" class="group space-right">
																	<input type="radio" name="iagree" class="" value="Yes" id="Yes">
																	<span class="label space-right">I hereby declare that the information given in this application form is complete, true and correct to best of my knowledge. If admitted, I agree to comply with the rules of the institute.</span>
																</label>
															</div>
														</div>
													</div>
													<div class="column-twelve" style="margin:30px;">
														<div class="column-two">
															<button type="button" id="submit-final" class="button button-large button-orange">Submit</button>
														</div>
													</div>
													<!-- <div class="column-twelve">
														<div class="terms">
															<p><a href="#" target="_blank" style="padding:0px;">Terms & Conditions</a></p>
														</div>
													</div> -->
											    </div>
											</div>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="grid-container">
					<div class="column-twelve">
						<p><?php echo $lang['dashboard_copyright_info'];?></p>
					</div>
				</div>
            </div>
		</div>

		<?php } else { ?>

		<?php
	redirect( $baseurl.'login.php?lang='.$_GET['lang'].'' );
} ?>

    </body>
</html>
