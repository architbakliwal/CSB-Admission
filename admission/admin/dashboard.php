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

    <body id="dashboard-body">

	    <?php

			$userInfo = mysql_query( "SELECT login_system_registrations_user_id,application_status FROM ".$admission_users." WHERE login_system_registrations_user_id = '".mysql_real_escape_string( $_SESSION['userLogin'] )."'" );
			$userQuery = mysql_num_rows( $userInfo );

			$user = mysql_fetch_array( $userInfo );

			if ( $user['application_status'] == "Completed" ) {
				redirect( $baseurl.'admin/done.php' );
			} else {
				if ( $registration_closed == 'Y' ) {
					redirect( $baseurl.'admin/thankyou.php' );
					die();
				}
			}

		?>


	    <?php if ( $_SESSION['userLogin'] && $_SESSION['userName'] ) { ?>
		<div class="wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-blue"></div>
			</div>
	        <div class="header dashboard_header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<img src="../images/logo.png"/>
					</div>
			    	<div class="column-twelve">
						<h4><?php echo $lang['dashboard_title'];?></h4>
					</div>
                    <div class="column-nine" style="text-align: left; font-family:'helvetica'; font-weight: bold;">
						<?php echo $lang['application_id'];?><?php echo $_SESSION['userName'];?>
					</div>
					<input type="hidden" id="main-application-id" value="<?php echo $_SESSION['userName'];?>"/>
					<div class="column-two">
						<a href="<?php echo $baseurl;?>admin/password_update.php?lang=<?php echo $_GET['lang'];?>" style="font-family:'helvetica'; font-weight: bold;"><?php echo $lang['dashboard_update_your_password'];?></a>
					</div>
					<div class="column-one">
						<a href="<?php echo $baseurl;?>logout.php?user=<?php echo $user["login_system_registrations_user_id"];?>&lang=<?php echo $_GET['lang'];?>" class="logout" style="font-family:'helvetica'; font-weight: bold;"><?php echo $lang['dashboard_form_logout'];?></a>
					</div>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<div class="column-twelve">
						<div style="display:block"><div class="legend-error" style="background:rgb(242, 38, 19)"></div>Section Incomplete</div>
						<div style="display:block"><div class="legend-error" style="background:rgb(38, 194, 129)"></div>Section Complete</div>
					</div>
					<!-- tabs -->
					<div class="sky-tabs sky-tabs-pos-top-center sky-tabs-response-to-icons">
						<input type="radio" name="sky-tabs" checked id="sky-tab1" class="sky-tab-content-1">
						<label for="sky-tab1">1</label>
						<input type="radio" name="sky-tabs" id="sky-tab2" class="sky-tab-content-2">
						<label for="sky-tab2">2</label>
						<input type="radio" name="sky-tabs" id="sky-tab3" class="sky-tab-content-3">
						<label for="sky-tab3">3</label>
						<input type="radio" name="sky-tabs" id="sky-tab4" class="sky-tab-content-4">
						<label for="sky-tab4">4</label>
						<input type="radio" name="sky-tabs" id="sky-tab5" class="sky-tab-content-5">
						<label for="sky-tab5">5</label>
						<input type="radio" name="sky-tabs" id="sky-tab6" class="sky-tab-content-6">
						<label for="sky-tab6">6</label>
						<input type="radio" name="sky-tabs" id="sky-tab7" class="sky-tab-content-7">
						<label for="sky-tab7">7</label>
						<input type="radio" name="sky-tabs" id="sky-tab8" class="sky-tab-content-8">
						<label for="sky-tab8">8</label>

						</br>

						<span><?php echo $lang['section_personal'];?></span>
						<span><?php echo $lang['section_contact'];?></span>
						<span><?php echo $lang['section_academic'];?></span>
						<span><?php echo $lang['section_workex'];?></span>
						<span><?php echo $lang['section_exam_score'];?></span>
						<span><?php echo $lang['section_reference'];?></span>
						<span><?php echo $lang['section_additional_info'];?></span>
						<span><?php echo $lang['section_docs'];?></span>

						<ul>
							<li class="sky-tab-content-1">
								<?php include 'sections/personal_details.php'; ?>
							</li>

							<li class="sky-tab-content-2">
								<?php include 'sections/contact_details.php'; ?>
							</li>

							<li class="sky-tab-content-3">
								<?php include 'sections/academic_details.php'; ?>
							</li>

							<li class="sky-tab-content-4">
								<?php include 'sections/workex_details.php'; ?>
							</li>

							<li class="sky-tab-content-5">
								<?php include 'sections/exam_details.php'; ?>
							</li>

							<li class="sky-tab-content-6">
								<?php include 'sections/reference_details.php'; ?>
							</li>

							<li class="sky-tab-content-7">
								<?php include 'sections/additional_details.php'; ?>
							</li>

							<li class="sky-tab-content-8">
								<?php include 'sections/document_details.php'; ?>
							</li>
						</ul>
					</div>
					<!--/ tabs -->
					<div class="overlay"></div>
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
		?>

		<div class="wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-blue"></div>
			</div>
			<div class="form">
				<div class="header">
					<div class="grid-container">
						<div class="column-ten">
							<h4><i class="icon-home-3"></i><?php echo $lang['dashboard_title'];?><?php echo $_SESSION['loginProviderID'];?></h4>
						</div>
						<div class="column-two">
							<a href="<?php echo $baseurl;?>logout.php?provider=<?php echo $_GET["provider"];?>&lang=<?php echo $_GET['lang'];?>" class="logout"><?php echo $lang['dashboard_form_logout'];?></a>
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
		</div>
		<?php } ?>

    </body>
</html>
