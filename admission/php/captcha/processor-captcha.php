<?php

// Begin the session
if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

// To avoid case conflicts, make the input uppercase and check against the session value
if ( strtoupper( $_GET['captcha'] ) == $_SESSION['captcha_id'] ) {
	echo 'true';
} else {
	echo 'false';
}

?>
