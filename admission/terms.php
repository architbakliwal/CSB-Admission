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

?>
<!doctype html>
<html>
    <head>

        <?php include dirname( __FILE__ ).'/header.php'; ?>

    </head>

    <body>

		<div class="wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-blue"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<img src="images/logo.png"/>
					</div>
			    	<div class="column-twelve">
						<h4><?php echo $lang['dashboard_title'];?></h4>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="section inner_section" id="academic-clone">
							<form method="post" id="section_done">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
										    <div class="box">
											    <div class="box-header" style="text-align: left;">
												    <h3>Terms & Conditions</h3>
												</div>
												<div class="box-section center" style="text-align: left;">
													<div class="column-twelve" style="margin: 10px 0px;">
														<h4 style="color:black;"><b>Please read the Terms & Conditions before confirming your Online Application</b></h4>
														<ul>
															<li>I hereby certify that I have read and understood all the terms and conditions set forth in this application and all the information I have furnished in this form are true and accurate to the best of my knowledge and belief.</li>
															<li>I understand that any false or misleading statement may result in the permanent refusal of my candidature at CSB. The Institute holds all prerogative rights to take any appropriate action in case of any conflict.</li>
															<li>Fees and Payments: Candidate agrees that his/her credit card(s) will be billed immediately after submission of the application . Fees related requirements are subject to change time to time and the institute holds all rights to take decisions in this regard. There will be no refund for the Application fee once paid.</li>
															<li>Communication: By using this site, you do authorize the Institute to contact you via e-mail, messaging, or any other electronic or non-electronic means of communication.</li>
															<li>Limitation of Liability :The Institute shall have no liability to the candidate for any failure to deliver any expected service or for any delay in doing so that is caused by any event or circumstance beyond reasonable control including, without limitation, breakdown of systems or network access, flood, fire, explosion or accident.</li>
															<li>Limitations of use: You may not use this Application form for any purpose other than the intended purpose.</li>
														</ul>
													</div>
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

    </body>
</html>
