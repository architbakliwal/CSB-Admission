<?php

// Begin the session
if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

// If the session is not present, set the variable to an error message
if ( !isset( $_SESSION['captcha_id'] ) )
	$str = 'ERROR!';
// Else if it is present, set the variable to the session contents
else
	$str = $_SESSION['captcha_id'];

// Create a random string, leaving out 'o' to avoid confusion with '0'
$char = strtoupper( substr( str_shuffle( 'abcdefghjkmnpqrstuvwxyz' ), 0, 4 ) );

// Concatenate the random string onto the random numbers
$str = rand( 1, 7 ) . rand( 1, 7 ) . $char;

// Set the session contents
$_SESSION['captcha_id'] = $str;

// Set the content type
header( 'Cache-control: no-cache' );

// Set the font
$font = 'fonts/Arial.ttf';

$image = imagecreatetruecolor( 75, 15 ); //Change the numbers to adjust the size of the image
$black = imagecolorallocate( $image, 0, 0, 0 );
$color = imagecolorallocate( $image, 136, 136, 136 );
$white = imagecolorallocate( $image, 255, 255, 255 );

imagefilledrectangle( $image, 0, 0, 399, 99, $white );

// Create an image using our original image and adding the detail
imagettftext( $image, 10, 0, 12, 12, $color, $font, $str );

// Output the image as a png
header( 'Content-type: image/png' );
imagepng( $image );

?>
