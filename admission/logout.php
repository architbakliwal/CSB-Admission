<?php

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

if ( $_GET['user'] ) {

	session_destroy();
	redirect( $baseurl.'index.php?lang='.$_GET['lang'].'' );

} else {

	if ( $_SESSION['loginProviderID'] && $_SESSION['loginProviderDisplayName'] ) {

		$config = dirname( __FILE__ ).'/php/hybridauth/config.php';
		include dirname( __FILE__ ).'/php/hybridauth/Hybrid/Auth.php';

		try {
			$hybridauth = new Hybrid_Auth( $config );
			$provider = @ trim( strip_tags( $_GET["provider"] ) );
			$adapter = $hybridauth->getAdapter( $provider );
			$adapter->logout();
			$hybridauth->redirect( $baseurl.'index.php?lang='.$_GET['lang'].'' );
		}
		catch( Exception $e ) {
			switch ( $e->getCode() ) {
			case 0 : $error = $lang['logout_social_hybrid_error']; break;
			case 1 : $error = $lang['logout_social_hybrid_conf_error']; break;
			case 2 : $error = $lang['logout_social_hybrid_not_conf_provider']; break;
			case 3 : $error = $lang['logout_social_hybrid_unknown_provider']; break;
			case 4 : $error = $lang['logout_social_hybrid_not_credentials']; break;
			case 5 : $error = $lang['logout_social_hybrid_login_failed']; break;
			case 6 : $error = $lang['logout_social_hybrid_request_profile_failed'];
				$adapter->logout();
				break;
			case 7 : $error = $lang['logout_social_hybrid_not_connected'];
				$adapter->logout();
				break;
			}
		}
	}

}
?>
