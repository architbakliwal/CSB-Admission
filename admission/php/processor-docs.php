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
$finalapplicationid = htmlspecialchars( $applicationid, ENT_QUOTES, 'UTF-8' );

if ( $mysql == true ) {

	$doc_response = array();
	$errors     = array();

	$sqldoc = "SELECT * FROM  `users_documents_uploads` WHERE application_id ='" . $finalapplicationid ."'";

	$selectdoc = mysql_query( $sqldoc );

	if ( ! $selectdoc ) {
		die( 'Could not select data: ' . mysql_error() );
	}

	while ( $row = mysql_fetch_array( $selectdoc, MYSQL_ASSOC ) ) {
		$finalnamephoto0 = $row['passport_photo'];
		$finalnameresume0 = $row['resume'];
	}

	if ( isset( $_FILES['passportphoto'] ) ) {
		$maxsize    = 409600;
		$acceptable = array(
			'image/jpeg',
			'image/jpg',
			'image/gif',
			'image/png'
		);

		if ( ( $_FILES['passportphoto']['size'] >= $maxsize ) || ( $_FILES["passportphoto"]["size"] == 0 ) ) {
			$errors[] = 'Photo file too large. File must be less than 400 Kb.';
		}

		if ( !( in_array( $_FILES['passportphoto']['type'], $acceptable ) ) && ( !empty( $_FILES["passportphoto"]["type"] ) ) ) {
			$errors[] = 'Invalid file type. Only JPG, GIF and PNG types are accepted for Photo.';
		}

		if ( count( $errors ) === 0 ) {
			$file_basename1 = substr( $_FILES["passportphoto"]["name"], 0, strripos( $_FILES["passportphoto"]["name"], '.' ) );
			$file_extension1 = substr( $_FILES["passportphoto"]["name"], strripos( $_FILES["passportphoto"]["name"], '.' ) );

			$finalnamephoto0 = $file_basename1.$file_extension1;

			// Add a name to Random Files ID
			$finalname1 = $finalapplicationid."_PHOTO".$file_extension1;

			// Move upload files to Folder Directory
			if (!is_dir($physicalpath.'admission-uploads/')) {
			    mkdir($physicalpath.'admission-uploads/', 0777, true);
			}
			move_uploaded_file( $_FILES['passportphoto']['tmp_name'], $physicalpath.'admission-uploads/' .$finalname1 );
		} else {
			$doc_response['status'] = 'F';
			$doc_response['msg'] = $errors;
			/*foreach ( $errors as $error ) {
				echo $error;
			}*/
			echo json_encode($doc_response);

			die(); //Ensure no more processing is done
		}
	}

	if ( isset( $_FILES['resume'] ) ) {
		$maxsize    = 409600;
		$acceptable = array(
			'application/msword',
			'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
			'application/pdf'
		);

		if ( ( $_FILES['resume']['size'] >= $maxsize ) || ( $_FILES["resume"]["size"] == 0 ) ) {
			$errors[] = 'Resume/CV file too large. File must be less than 400 Kb.';
		}

		if ( !( in_array( $_FILES['resume']['type'], $acceptable ) ) && ( !empty( $_FILES["resume"]["type"] ) ) ) {
			$errors[] = 'Invalid file type. Only DOC, DOCX and PDF types are accepted for Resume/CV.';
		}

		if ( count( $errors ) === 0 ) {
			$file_basename1 = substr( $_FILES["resume"]["name"], 0, strripos( $_FILES["resume"]["name"], '.' ) );
			$file_extension1 = substr( $_FILES["resume"]["name"], strripos( $_FILES["resume"]["name"], '.' ) );

			$finalnameresume0 = $file_basename1.$file_extension1;

			// Add a name to Random Files ID
			$finalname1 = $finalapplicationid."_RESUME".$file_extension1;

			if (!is_dir($physicalpath.'admission-uploads/')) {
			    mkdir($physicalpath.'admission-uploads/', 0777, true);
			}
			move_uploaded_file( $_FILES['resume']['tmp_name'], $physicalpath.'admission-uploads/' .$finalname1 );
		} else {
			$doc_response['status'] = 'F';
			$doc_response['msg'] = $errors;
			/*foreach ( $errors as $error ) {
				echo $error;
			}*/
			echo json_encode($doc_response);

			die(); //Ensure no more processing is done
		}
	}

	$sqldocs = "INSERT INTO `users_documents_uploads` (`application_id`, `passport_photo`, `resume`) VALUES (
			'".mysql_real_escape_string( $finalapplicationid )."',
			'".mysql_real_escape_string( $finalnamephoto0 )."',
			'".mysql_real_escape_string( $finalnameresume0 )."'
			)
		ON DUPLICATE KEY
		UPDATE
		passport_photo = VALUES(passport_photo),
		resume = VALUES(resume)
		;";

	$insertdocs = mysql_query( $sqldocs );

	if ( ! $insertdocs ) {
		die( 'Could not enter data: ' . mysql_error() );
	}

	$doc_response['status'] = 'P';
	$doc_response['msg'] = $baseurl;
	echo json_encode($doc_response);

} else {

}

?>
