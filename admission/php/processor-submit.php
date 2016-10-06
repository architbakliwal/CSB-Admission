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


if ( $mysql == true ) {
	$sqlsubmit = "UPDATE  `csbedu_admission_2017`.`admission_users` SET `application_status` = 'Completed' WHERE application_id ='" . $applicationid ."'";

	$updatesubmit = mysql_query( $sqlsubmit );

	if ( ! $updatesubmit ) {
		die( 'Could not enter data: ' . mysql_error() );
	}


	$sqlcontact = "SELECT * FROM  `admission_users` WHERE application_id ='" . $applicationid ."'";

	$selectcontact = mysql_query( $sqlcontact );

	if ( ! $selectcontact ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	while ( $row = mysql_fetch_array( $selectcontact, MYSQL_ASSOC ) ) {
		$applicantemailid = $row['email_id'];
	}

	include dirname( __FILE__ ).'/phpmailer/PHPMailerAutoload.php';
	include dirname( __FILE__ ).'/messages/automessagesubmit.php';

	$automail = new PHPMailer();
	$automail->IsSMTP();
	$automail->SMTPAuth = true;
	$automail->SMTPSecure = $protocol;
	$automail->Host = $host;
	$automail->Port = $port;
	$automail->Username = $smtpusername;
	$automail->Password = $smtppassword;
	$automail->From = $youremail;
	$automail->FromName = $yourname;
	$automail->isHTML( true );
	$automail->CharSet = "UTF-8";
	$automail->Encoding = "base64";
	$automail->Timeout = 200;
	$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
	$automail->ContentType = "text/html";
	$automail->AddAddress( $applicantemailid );
	$automail->Subject = "Application successfully submitted";
	$automail->Body = $automessagesubmit;
	$automail->AltBody = "To view this message, please use an HTML compatible email";

	$response = array();
	if ( $automail->Send() ) {
    	$response['status'] = 'Y';
	} else {
		$response['status'] = 'N';
	}

	echo json_encode($response);

} else {

}

?>
