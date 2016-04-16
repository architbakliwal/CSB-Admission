<?php

	include '../php/config/config.php';
	include '../php/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include '../php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include '../php/language/en.php';
	}
	
?>
<!doctype html>
<html>
    <head>

        <meta charset="utf-8">
		<meta name="author" content="<?php echo $lang['website_author'];?>">
		<meta name="description" content="<?php echo $lang['website_description'];?>">
		<meta name="keywords" content="<?php echo $lang['website_keywords'];?>">
		<title><?php echo $lang['website_title'];?></title>

		<!-- Viewport -->

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- Favicon -->

		<link rel="shortcut icon" type="image/png" href="<?php echo $baseurl;?>images/favicon.ico">

		<!-- Css Styles -->

		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/sky-tabs.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/settings.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/sections.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/tooltipster.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/responsive.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $baseurl;?>css/jquery-ui-1.10.4.custom.min.css">

		<!-- Font Link -->

		<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>	

		<!-- jQuery from the google apis -->

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	
    </head>
	
    <body>

		<div class="wrapper"> 
		    <div class="form-bar">
				<div class="top-bar bar-orange"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<h4><?php echo $lang['dashboard_title'];?></h4>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="form">
						<div class="section inner_section" id="">
							<form method="post" id="section_thankyou">
								<fieldset>
									<div class="grid-container">
										<div class="column-twelve">
										    <div class="box">
												<div class="box-section center">
													<div class="column-twelve" style="margin:30px;">
														<h3 style="text-align: center;">Online Registrations are closed for 2016 batch.</h3>
													</div>
													<div class="column-twelve" >
														<p>Please keep checking the website for further updates.</p>
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