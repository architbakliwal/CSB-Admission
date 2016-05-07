<?php

include dirname( __FILE__ ).'/csrf_protection/csrf-token.php';
include dirname( __FILE__ ).'/csrf_protection/csrf-class.php';

if ( !isset( $_SESSION ) ) {
	$some_name = session_name( "CSBAdmission" );
	session_start();
}

include dirname( __FILE__ ).'/config/config.php';
include dirname( __FILE__ ).'/config/functions.php';

$language = array( 'en' => 'en', 'pt' => 'pt' );

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
	include dirname( __FILE__ ).'/language/'.$language[$_GET['lang']].'.php';
} else {
	include dirname( __FILE__ ).'/language/en.php';
}

if ( !$_SESSION['userLogin'] && !$_SESSION['userName'] && !isset( $_SESSION['userName'] ) ) {

	timeout();

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
	timeout();
	die();
}

$applicationid = strip_tags( trim( $_SESSION['userName'] ) );
$firstname = strip_tags( trim( $_POST["firstname"] ) );
$middlename = strip_tags( trim( $_POST["middlename"] ) );
$lastname = strip_tags( trim( $_POST["lastname"] ) );
$dob = strip_tags( trim( $_POST["dob"] ) );
$gender = strip_tags( trim( $_POST["gender"] ) );
$bloodgrp = strip_tags( trim( $_POST["bloodgrp"] ) );
$hearaboutcsb = strip_tags( trim( $_POST["hearaboutcsb"] ) );
$hearaboutcsbother = strip_tags( trim( $_POST["hearaboutcsbother"] ) );


$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );
$finalfirstname = htmlspecialchars( $firstname, ENT_QUOTES, 'UTF-8' );
$finalmiddlename = htmlspecialchars( $middlename, ENT_QUOTES, 'UTF-8' );
$finallastname = htmlspecialchars( $lastname, ENT_QUOTES, 'UTF-8' );
$finaldob = htmlspecialchars( $dob, ENT_QUOTES, 'UTF-8' );
$finalgender = htmlspecialchars( $gender, ENT_QUOTES, 'UTF-8' );
$finalbloodgrp = htmlspecialchars( $bloodgrp, ENT_QUOTES, 'UTF-8' );
$finalhearaboutcsb = htmlspecialchars( $hearaboutcsb, ENT_QUOTES, 'UTF-8' );
$finalhearaboutcsbother = htmlspecialchars( $hearaboutcsbother, ENT_QUOTES, 'UTF-8' );

if ( $finaldob ) {
	$c= date( 'Y' );
	$y= date( 'Y', strtotime( $finaldob ) );
	$finalage = $c-$y;
} else {
	$finalage = '';
}



if ( $mysql == true ) {
	$sqlpersonal = "INSERT INTO `csbedu_admission`.`users_personal_details` (`application_id`, `f_name`, `m_name`, `l_name`,`user_dob`, `age`, `gender`, `blood_group`, `hear_abt_csb`, `hear_abt_csb_others`) VALUES ('".mysql_real_escape_string( $finalapplicationid )."','".mysql_real_escape_string( $finalfirstname )."','".mysql_real_escape_string( $finalmiddlename )."','".mysql_real_escape_string( $finallastname )."','".mysql_real_escape_string( $finaldob )."','".mysql_real_escape_string( $finalage )."','".mysql_real_escape_string( $finalgender )."','".mysql_real_escape_string( $finalbloodgrp )."','".mysql_real_escape_string( $finalhearaboutcsb )."','".mysql_real_escape_string( $finalhearaboutcsbother )."')
		ON DUPLICATE KEY
		UPDATE
		f_name = VALUES(f_name),
		m_name = VALUES(m_name),
		l_name = VALUES(l_name),
		user_dob = VALUES(user_dob),
		age = VALUES(age),
		gender = VALUES(gender),
		blood_group = VALUES(blood_group),
		hear_abt_csb = VALUES(hear_abt_csb),
		hear_abt_csb_others = VALUES(hear_abt_csb_others)
		;";

	$insertpersonal = mysql_query( $sqlpersonal );

	if ( ! $insertpersonal ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

} else {

}

?>
