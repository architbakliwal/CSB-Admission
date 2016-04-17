<?php

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	// session_set_cookie_params( 0, '/', '127.0.0.1' );
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
		<div class="wrapper small-wrapper">
		    <div class="form-bar">
				<div class="top-bar bar-blue"></div>
			</div>
	        <div class="header">
			    <div class="grid-container">
			    	<div class="column-twelve">
						<img src="images/logo.png"/>
					</div>
                    <div class="column-twelve">
						<h2><?php echo $lang['index_title'];?></h2>
					</div>
					<?php
						if ( $registration_closed == 'Y' ) {
							echo '<div class="column-twelve" style="color: red; font-weight: bold;"><p><marquee scrollamount="6">Online Registrations are closed.</marquee></p></div>';
						}
					?>
				</div>
			</div>
			<div class="section">
				<div class="grid-container">
					<!-- <div class="column-twelve">
						<p>Please read the <a href="#" target="_blank">instructions</a> before applying</p>
					</div> -->
					<div class="column-six">
						<div class="box" id="box-1" style="background-color: #103F56;">
							<a href="<?php echo $baseurl;?>login.php?lang=<?php echo $_GET['lang'];?>"><h4>Existing user</h4><i class="icon-lock-2"></i><h4><?php echo $lang['index_login_your_account'];?></h4></a>
						</div>
					</div>
					<div class="column-six">
						<div class="box" id="box-2" style="background-color: #103F56;">
							<a href="<?php echo $baseurl;?>register.php?lang=<?php echo $_GET['lang'];?>"><h4>New user</h4><i class="icon-users"></i><h4><?php echo $lang['index_register_your_account'];?></h4></a>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="grid-container">
					<div class="column-twelve">
						<p><?php echo $lang['index_copyright_info'];?></p>
					</div>
				</div>
            </div>
		</div>
    </body>
</html>
