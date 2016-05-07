<?php

	include '../../../../php/config/config.php';
	include '../../../../php/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
		include '../../../../php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include '../../../../php/language/en.php';
	}

	$applicationid = strip_tags(trim($app_id));
	
	$finalapplicationid = htmlspecialchars($applicationid, ENT_QUOTES, 'UTF-8');
	

	$extra_acads = array();
	$extra_workex = array();

    $userInfo = "SELECT * FROM  `admission_users` WHERE application_id ='" . $finalapplicationid ."'";

	$userQuery = mysql_query($userInfo);

	if ( ! $userQuery ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($userQuery, MYSQL_ASSOC)) {
        $f_name = $row['f_name'];
		$l_name = $row['l_name'];
		$m_name = $row['m_name'];
		$application_id = $row['application_id'];
		$email_id = $row['email_id'];
		$application_status = $row['application_status'];
    }

    /*if($application_status != 'Completed') {
    	redirect($baseurl.'admin/dashboard.php?lang='.$_GET['lang'].'');
    	die();
    }*/


	$sqlpersonal = "SELECT * FROM  `users_personal_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectpersonal = mysql_query($sqlpersonal);

	if ( ! $selectpersonal ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectpersonal, MYSQL_ASSOC)) {
        $f_name = $row['f_name'];
		$l_name = $row['l_name'];
		$m_name = $row['m_name'];
		$user_dob = $row['user_dob'];
		if($user_dob == '0000-00-00') {
			$user_dob = '';
		} else {
			$user_dob = date("d-M-Y", strtotime($user_dob));
		}
		$age = $row['age'];
		$gender = $row['gender'];
		$blood_grp = $row['blood_group'];
		$hear_abt_csb = $row['hear_abt_csb'];
		$hear_abt_csb_others = $row['hear_abt_csb_others'];
    }


    $contact = "SELECT * FROM  `users_contact_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectcontact = mysql_query($contact);

	if ( ! $selectcontact ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectcontact, MYSQL_ASSOC)) {
        $email_id = $row['email_id'];
		$mobile_number = $row['mobile_number'];
		$phone_number = $row['phone_number'];
		$current_address_line1 = $row['current_address_line1'];
		$current_address_line2 = $row['current_address_line2'];
		$current_address_line3 = $row['current_address_line3'];
		$current_address_city = $row['current_address_city'];
		$current_address_state = $row['current_address_state'];
		$current_address_state_other = $row['current_address_state_other'];
		$current_address_country = $row['current_address_country'];
		$current_address_pin = $row['current_address_pin'];
		$permanent_same_as_current_address = $row['permanent_same_as_current_address'];
		$permanent_address_line1 = $row['permanent_address_line1'];
		$permanent_address_line2 = $row['permanent_address_line2'];
		$permanent_address_line3 = $row['permanent_address_line3'];
		$permanent_address_city = $row['permanent_address_city'];
		$permanent_address_state = $row['permanent_address_state'];
		$permanent_address_state_other = $row['permanent_address_state_other'];
		$permanent_address_country = $row['permanent_address_country'];
		$permanent_address_pin = $row['permanent_address_pin'];
		$parent_name = $row['parent_name' ];
		$parent_mobile = $row['parent_mobile' ];
		$parent_relation = $row['parent_relation' ];
		$parent_organisation = $row['parent_organisation' ];
		$parent_designation = $row['parent_designation' ];
		$parent_qualification = $row['parent_qualification' ];
    }

    $sqlexamscore = "SELECT * FROM  `user_exam_score` WHERE application_id ='" . $finalapplicationid ."'";

	$selectexamscore = mysql_query($sqlexamscore);

	if ( ! $selectexamscore ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectexamscore, MYSQL_ASSOC)) {
        $exam_score = $row['exam_score'];
    }


    $sqlrefree = "SELECT * FROM  `users_reference_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectrefree = mysql_query($sqlrefree);

	if ( ! $selectrefree ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectrefree, MYSQL_ASSOC)) {
        $title_of_refree = $row['title_of_refree'];
		$name_of_refree = $row['name_of_refree'];
		$organization_refree = $row['organization'];
		$designation_refree = $row['designation'];
		$phone_number_refree = $row['phone_number'];
		$email_id_refree = $row['email_id'];
		$capacity_of_knowing = $row['capacity_of_knowing'];
    }


    $sqladditionalinfo = "SELECT * FROM  `user_additional_info` WHERE application_id ='" . $finalapplicationid ."'";

	$selectadditionalinfo = mysql_query($sqladditionalinfo);

	if ( ! $selectadditionalinfo ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectadditionalinfo, MYSQL_ASSOC)) {
        $after_mba_plan = $row['after_mba_plan'];
    }


    $sqldoc = "SELECT * FROM  `users_documents_uploads` WHERE application_id ='" . $finalapplicationid ."'";

	$selectdoc = mysql_query($sqldoc);

	if ( ! $selectdoc ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectdoc, MYSQL_ASSOC)) {
		
    }

    $passport_photo = '';
    // $list = glob('images/' . $finalapplicationid . '*');
    $list = glob($physicalpath.'admission-uploads/' . $finalapplicationid . '_PHOTO*');
    
    if(count($list) > 0){
    	usort($list, create_function('$b,$a', 'return filemtime($a) - filemtime($b);'));
		$passport_photo = $list[0];
    }
		
?>
