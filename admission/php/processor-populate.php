<?php
    
    include dirname(__FILE__).'/csrf_protection/csrf-token.php';
	include dirname(__FILE__).'/csrf_protection/csrf-class.php';

	if(!isset($_SESSION)){
		$some_name = session_name( "CSBAdmission" );
    	session_start();
	}
    
	include dirname(__FILE__).'/config/config.php';
	include dirname(__FILE__).'/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
		include dirname(__FILE__).'/language/'.$language[$_GET['lang']].'.php';
	} else {
		include dirname(__FILE__).'/language/en.php';
	}

	if(!$_SESSION['userLogin'] && !$_SESSION['userName'] && !isset($_SESSION['userName'])){
				
		timeout();
			
	} else {					
		$time = time();
								
		if($time > $_SESSION['expire']){
			session_destroy();
			timeout();
			exit(0);
		}		
	}

	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (60*60);

	if(strlen(trim($_SESSION['userName'])) == 0) {
		session_destroy();
		timeout();
		die();
	}
		
	$applicationid = strip_tags(trim($_SESSION['userName']));

	$finalapplicationid = htmlspecialchars($applicationid, ENT_QUOTES, 'UTF-8');

	$row_array = array();
	$row_array1 = array();
	$row_array2 = array();
	$row_array3 = array();
	$row_array4 = array();
	$row_array5 = array();
	$row_array6 = array();


	function htmldecode($value) {
		return htmlspecialchars_decode($value, ENT_QUOTES);
	}
	

	if ($mysql == true){
		//Create an array
	    $json_response = array();

	    // always put this as first element to avoid numbering
        array_push($json_response, $baseurl);


		$sqlpersonal = "SELECT * FROM  `users_personal_details` WHERE application_id ='" . $finalapplicationid ."'";

		$selectpersonal = mysql_query($sqlpersonal);

		if ( ! $selectpersonal ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectpersonal, MYSQL_ASSOC)) {
	        $row_array['firstname'] = $row['f_name'];
			$row_array['middlename'] = $row['m_name'];
			$row_array['lastname'] = $row['l_name'];
			$row_array['dob'] = $row['user_dob'];
			$row_array['gender'] = $row['gender'];
			$row_array['bloodgrp'] = $row['blood_group'];
			$row_array['hearaboutcsb'] = $row['hear_abt_csb'];
			$row_array['hearaboutcsbother'] = $row['hear_abt_csb_others'];
	        
	    }

	    //push the values in the array
	    array_push($json_response,$row_array);

	    $contact = "SELECT * FROM  `users_contact_details` WHERE application_id ='" . $finalapplicationid ."'";

		$selectcontact = mysql_query($contact);

		if ( ! $selectcontact ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectcontact, MYSQL_ASSOC)) {
	        $row_array1['email'] = $row['email_id'];
			$row_array1['mobilenumber'] = $row['mobile_number'];
			$row_array1['phonenumber'] = $row['phone_number' ];
			$row_array1['currentaddress1'] = htmldecode($row['current_address_line1']);
			$row_array1['currentaddress2'] = htmldecode($row['current_address_line2']);
			$row_array1['currentaddress3'] = htmldecode($row['current_address_line3']);
			$row_array1['currentcity'] = htmldecode($row['current_address_city' ]);
			$row_array1['currentcountry'] = $row['current_address_country' ];
			$row_array1['currentstate'] = $row['current_address_state' ];
			$row_array1['currentstateother'] = $row['current_address_state_other' ];
			$row_array1['currentzip'] = $row['current_address_pin' ];
			$row_array1['permanentsameascurrent'] = $row['permanent_same_as_current_address' ];
			$row_array1['permanentaddress1'] = htmldecode($row['permanent_address_line1' ]);
			$row_array1['permanentaddress2'] = htmldecode($row['permanent_address_line2' ]);
			$row_array1['permanentaddress3'] = htmldecode($row['permanent_address_line3' ]);
			$row_array1['permanentcity'] = htmldecode($row['permanent_address_city' ]);
			$row_array1['permanentcountry'] = $row['permanent_address_country' ];
			$row_array1['permanentstate'] = $row['permanent_address_state' ];
			$row_array1['permanentstateother'] = $row['permanent_address_state_other' ];
			$row_array1['permanentzip'] = $row['permanent_address_pin' ];
			$row_array1['parentname'] = $row['parent_name' ];
			$row_array1['parentmobile'] = $row['parent_mobile' ];
			$row_array1['parentrelation'] = $row['parent_relation' ];
			$row_array1['parentorganisation'] = $row['parent_organisation' ];
			$row_array1['parentdesignation'] = $row['parent_designation' ];
			$row_array1['parentqualification'] = $row['parent_qualification' ];

	        
	    }

	    //push the values in the array
	    array_push($json_response,$row_array1);



	    $sqlexamscore = "SELECT * FROM  `user_exam_score` WHERE application_id ='" . $finalapplicationid ."'";

		$selectexamscore = mysql_query($sqlexamscore);

		if ( ! $selectexamscore ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectexamscore, MYSQL_ASSOC)) {
	        $row_array2['examscore'] = htmldecode($row['exam_score']);
	    }

	    //push the values in the array
	    array_push($json_response,$row_array2);




	    $sqlrefree = "SELECT * FROM  `users_reference_details` WHERE application_id ='" . $finalapplicationid ."'";

		$selectrefree = mysql_query($sqlrefree);

		if ( ! $selectrefree ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectrefree, MYSQL_ASSOC)) {
	        $row_array3['refreetitle'] = $row['title_of_refree'];
			$row_array3['refreename'] = htmldecode($row['name_of_refree']);
			$row_array3['refreeorganization'] = htmldecode($row['organization']);
			$row_array3['refreedesignation'] = htmldecode($row['designation']);
			$row_array3['refreecontact'] = $row['phone_number'];
			$row_array3['refreeemail'] = $row['email_id'];
			$row_array3['refreeknowing'] = htmldecode($row['capacity_of_knowing']);

	        
	    }

	    //push the values in the array
	    array_push($json_response,$row_array3);


	    $sqladditionalinfo = "SELECT * FROM  `user_additional_info` WHERE application_id ='" . $finalapplicationid ."'";

		$selectadditionalinfo = mysql_query($sqladditionalinfo);

		if ( ! $selectadditionalinfo ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectadditionalinfo, MYSQL_ASSOC)) {
	        $row_array4['aftermbaplan'] = htmldecode($row['after_mba_plan']);
	    }

	    //push the values in the array
	    array_push($json_response,$row_array4);



	    $sqldoc = "SELECT * FROM  `users_documents_uploads` WHERE application_id ='" . $finalapplicationid ."'";

		$selectdoc = mysql_query($sqldoc);

		if ( ! $selectdoc ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectdoc, MYSQL_ASSOC)) {
	        $row_array5['passportphotofake1'] = htmldecode($row['passport_photo']);
	        $row_array5['transcriptsfake1'] = htmldecode($row['academic_transcripts']);
	        $row_array5['resumefake1'] = htmldecode($row['resume']);
	        $row_array5['certificatesfake1'] = htmldecode($row['certificates']);
	        
	    }

	    //push the values in the array
        array_push($json_response,$row_array5);

	    

	    
        $status = "SELECT * FROM  `admission_section_status` WHERE application_id ='" . $finalapplicationid ."'";

		$selectstatus = mysql_query($status);

		if ( ! $selectstatus ) {
		  die('Could not enter data: ' . mysql_error());
		}

	    while ($row = mysql_fetch_array($selectstatus, MYSQL_ASSOC)) {
	        $row_array6['personalstatus'] = $row['personal_details_status'];
			$row_array6['contactstatus'] = $row['contact_details_status'];
			$row_array6['examscorestatus'] = $row['exam_score_details_status'];
			$row_array6['refreestatus'] = $row['reference_details_status'];
			$row_array6['additionalinfostatus'] = $row['additional_details_status'];
			$row_array6['docstatus'] = $row['document_details_status'];
	        
	    }

	    //push the values in the array
        array_push($json_response,$row_array6);



	    echo json_encode($json_response);

	} else {

	}
		
?>
