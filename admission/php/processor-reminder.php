<?php
    
	include dirname(__FILE__).'/config/config.php';
	include dirname(__FILE__).'/config/functions.php';

	error_reporting(-1);
	
	$language = array('en' => 'en','pt' => 'pt');

	if (isset($_GET['lang']) AND array_key_exists($_GET['lang'], $language)){
		include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/language/en.php';
	}

	if ($mysql == true){
		
		$sqlcontact = "SELECT * FROM  `admission_users` WHERE application_status = 'Draft' AND reminder_email = 'N' ORDER BY `application_id` ASC LIMIT 5";

		$selectcontact = mysql_query($sqlcontact);

		if(! $selectcontact )
		{
		  die('Could not enter data: ' . mysql_error());
		}


		include dirname(__FILE__).'/phpmailer/PHPMailerAutoload.php';							
		include dirname(__FILE__).'/messages/automessagereminder.php';

		while ($row = mysql_fetch_array($selectcontact, MYSQL_ASSOC)) {
			$applicantemailid = $row['email_id'];
			$applicationid = $row['application_id'];			

			$imessage = $automessagereminder;

			echo $imessage;
			// die();
									
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
			$automail->isHTML(true);
			$automail->CharSet = "UTF-8";
			$automail->Encoding = "base64";
			$automail->Timeout = 200;
			$automail->SMTPDebug = 0; // 0 = off (for production use) // 1 = client messages // 2 = client and server messages
			$automail->ContentType = "text/html";
			$automail->AddAddress($applicantemailid);
			$automail->Subject = "Reminder: Applications portal shuts on the 5th of January 2015";
			$automail->Body = $imessage;
			$automail->AltBody = "To view this message, please use an HTML compatible email";
								
			/*if ($automail->Send()) {

				$sqlchangestatus = "UPDATE admission_users SET `reminder_email` = 'Y' WHERE application_id ='" . $applicationid ."'";

				$updatestatus = mysql_query($sqlchangestatus);

				if(! $updatestatus )
				{
				  die('Could not enter data: ' . mysql_error());
				}

				echo 'success';
			} else {
				echo 'error';						
			}*/
		}

	} else {

	}
		
?>