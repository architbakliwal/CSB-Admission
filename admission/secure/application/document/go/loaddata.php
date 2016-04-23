<?php

	if(!isset($_SESSION)){
		$some_name = session_name( "CSBAdmission" );
    	session_start();
	}
    
	include '../../../../php/config/config.php';
	include '../../../../php/config/functions.php';
	
	$language = array('en' => 'en','pt' => 'pt');

	if ( isset( $_GET['lang'] ) and array_key_exists( $_GET['lang'], $language ) ) {
		include '../../../../php/language/'.$language[$_GET['lang']].'.php';
	} else {
		include '../../../../php/language/en.php';
	}

	if(!$_SESSION['userLogin'] && !$_SESSION['userName'] && !isset($_SESSION['userName'])){
				
		redirect($baseurl.'login.php?lang='.$_GET['lang'].'');
			
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
		redirect($baseurl.'login.php?lang='.$_GET['lang'].'');
		die();
	}
	$applicationid = strip_tags(trim($_SESSION['userName']));
	
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


    $academic = "SELECT * FROM  `users_academic_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectacademic = mysql_query($academic);

	if ( ! $selectacademic ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectacademic, MYSQL_ASSOC)) {
        $tenth_name_of_institute = $row['tenth_name_of_institute'];
		$tenth_board = $row['tenth_board'];
		$tenth_board_other = $row['tenth_board_other'];
		$tenth_aggregate = $row['tenth_aggregate'];
		$tenth_year_completion = $row['tenth_year_completion'];
		$is_twelfth_or_diploma = $row['is_twelfth_or_diploma'];
		$twelfth_name_of_institution = $row['twelfth_name_of_institution'];
		$twelfth_board = $row['twelfth_board'];
		$twelfth_board_other = $row['twelfth_board_other'];
		$twelfth_aggregate = $row['twelfth_aggregate'];
		$twelfth_year_completion = $row['twelfth_year_completion'];
		$graduation_name_of_college = $row['graduation_name_of_college'];

		$graduation_university = $row['graduation_university'];
		$lookup_graduation_university = "SELECT * FROM  `lookup_graduation_university`";
		$lookup_graduation_university_query = mysql_query($lookup_graduation_university);
		while ($row1 = mysql_fetch_array($lookup_graduation_university_query, MYSQL_ASSOC)) {
			if(intval($graduation_university) == intval($row1['code'])) {
				$graduation_university = $row1['description'];
				break;
			}
		}

		$graduation_university_other = $row['graduation_university_other'];
		$graduation_degree_name = $row['graduation_degree_name'];

		$graduation_discipline = $row['graduation_discipline'];
		$lookup_graduation_discipline = "SELECT * FROM  `lookup_graduation_discipline`";
		$lookup_graduation_discipline_query = mysql_query($lookup_graduation_discipline);
		while ($row2 = mysql_fetch_array($lookup_graduation_discipline_query, MYSQL_ASSOC)) {
			if(intval($graduation_discipline) == intval($row2['code'])) {
				$graduation_discipline = $row2['description'];
				break;
			}
		}

		$graduation_discipline_other = $row['graduation_discipline_other'];
		$graduation_specialisation = $row['graduation_specialisation'];
		$graduation_degree_mode = $row['graduation_degree_mode'];
		$graduation_degree_completed = $row['graduation_degree_completed'];
		$graduation_year_completion = $row['graduation_year_completion'];
		$graduation_grading_system = $row['graduation_grading_system'];
		$graduation_class = $row['graduation_class'];
		$graduation_aggregate = $row['graduation_aggregate'];
		$graduation_gpa_obtained = $row['graduation_gpa_obtained'];
		$graduation_gpa_max = $row['graduation_gpa_max'];
		$extra_academic_added_count = $row['extra_academic_added_count'];
		$achievements_awards = $row['achievements_awards'];
    }


    $academicadd = "SELECT * FROM  `added_academic_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectacademicadd = mysql_query($academicadd);

	if ( ! $selectacademicadd ) {
	  die('Could not enter data: ' . mysql_error());
	}

	$y = '';
	$x = 1;

    while ($row = mysql_fetch_array($selectacademicadd, MYSQL_ASSOC)) {

    	$iacademicextradegreelevel = "academicextradegreelevel{$y}";
		$iacademicextradegreeother = "academicextradegreeother{$y}";
		$igradutationcollegenameextra = "gradutationcollegenameextra{$y}";
		$igradutationunversityextra = "gradutationunversityextra{$y}";
		$igraduationuniversityothersextra = "graduationuniversityothersextra{$y}";
		$igraduatindegreenameextra = "graduatindegreenameextra{$y}";
		$igraduationdisciplineextra = "graduationdisciplineextra{$y}";
		$igraduationdisciplineotherextra = "graduationdisciplineotherextra{$y}";
		$igraduationspecializationextra = "graduationspecializationextra{$y}";
		$igraduationdegreemodeextra = "graduationdegreemodeextra{$y}";
		$igraduationcompletedextra = "graduationcompletedextra{$y}";
		$igradationcompletionyearextra = "gradationcompletionyearextra{$y}";
		$igraduationgpaorpercentageextra = "graduationgpaorpercentageextra{$y}";
		$igraduationclassextra = "graduationclassextra{$y}";
		$igraduationpercentageextra = "graduationpercentageextra{$y}";
		$igraduationgpaobtainedextra = "graduationgpaobtainedextra{$y}";
		$igraduationgpamaxextra = "graduationgpamaxextra{$y}";


		$extra_acads[$iacademicextradegreelevel] = $row['extra_academic_degree_level'];
		$extra_acads[$iacademicextradegreeother] = $row['extra_academic_degree_level_other'];
		$extra_acads[$igradutationcollegenameextra] = $row['extra_academic_name_of_college'];

		$extra_acads[$igradutationunversityextra] = $row['extra_academic_university'];
		$lookup_graduation_university = "SELECT * FROM  `lookup_graduation_university`";
		$lookup_graduation_university_query = mysql_query($lookup_graduation_university);
		while ($row3 = mysql_fetch_array($lookup_graduation_university_query, MYSQL_ASSOC)) {
			if(intval($extra_acads[$igradutationunversityextra]) == intval($row3['code'])) {
				$extra_acads[$igradutationunversityextra] = $row3['description'];
				break;
			}
		}

		$extra_acads[$igraduationuniversityothersextra] = $row['extra_academic_university_other'];
		$extra_acads[$igraduatindegreenameextra] = $row['extra_academic_degree_mode'];

		$extra_acads[$igraduationdisciplineextra] = $row['extra_academic_degree_name'];
		$lookup_graduation_discipline = "SELECT * FROM  `lookup_graduation_discipline`";
		$lookup_graduation_discipline_query = mysql_query($lookup_graduation_discipline);
		while ($row4 = mysql_fetch_array($lookup_graduation_discipline_query, MYSQL_ASSOC)) {
			if(intval($extra_acads[$igraduationdisciplineextra]) == intval($row4['code'])) {
				$extra_acads[$igraduationdisciplineextra] = $row4['description'];
				break;
			}
		}

		$extra_acads[$igraduationdisciplineotherextra] = $row['extra_academic_discipline'];
		$extra_acads[$igraduationspecializationextra] = $row['extra_academic_discipline_other'];
		$extra_acads[$igraduationdegreemodeextra] = $row['extra_academic_specialisation'];
		$extra_acads[$igraduationcompletedextra] = $row['extra_academic_degree_completed'];
		$extra_acads[$igradationcompletionyearextra] = $row['extra_academic_year_completion'];
		$extra_acads[$igraduationgpaorpercentageextra] = $row['extra_academic_grading_system'];
		$extra_acads[$igraduationclassextra] = $row['extra_academic_class'];
		$extra_acads[$igraduationpercentageextra] = $row['extra_academic_aggregate'];
		$extra_acads[$igraduationgpaobtainedextra] = $row['extra_academic_gpa_obtained'];
		$extra_acads[$igraduationgpamaxextra] = $row['extra_academic_gpa_max'];

		$y = $x;

		$x = $x + 1;

    }


    $workex = "SELECT * FROM  `users_work_experience_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectworkex = mysql_query($workex);

	if ( ! $selectworkex ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectworkex, MYSQL_ASSOC)) {

        $work_experience = $row['work_experience'];
        $employement_type = $row['employement_type'];
        $name_of_organization = $row['name_of_organization'];

		$organization_type = $row['organization_type'];
		$lookup_organisation_type = "SELECT * FROM  `lookup_organisation_type`";
		$lookup_organisation_type_query = mysql_query($lookup_organisation_type);
		while ($row5 = mysql_fetch_array($lookup_organisation_type_query, MYSQL_ASSOC)) {
			if(intval($organization_type) == intval($row5['code'])) {
				$organization_type = $row5['description'];
				break;
			}
		}

		$organization_type_other = $row['organization_type_other'];

		$industry_type = $row['industry_type'];
		$lookup_industry_type = "SELECT * FROM  `lookup_industry_type`";
		$lookup_industry_type_query = mysql_query($lookup_industry_type);
		while ($row6 = mysql_fetch_array($lookup_industry_type_query, MYSQL_ASSOC)) {
			if(intval($industry_type) == intval($row6['code'])) {
				$industry_type = $row6['description'];
				break;
			}
		}

		$started_work_date = $row['started_work_date'];
		if($started_work_date == '0000-00-00') {
			$started_work_date = '';
		} else {
			$started_work_date = date("d-M-Y", strtotime($started_work_date));
		}
		$completed_work_date = $row['completed_work_date'];
		if($completed_work_date == '0000-00-00') {
			$completed_work_date = '';
		} else {
			$completed_work_date = date("d-M-Y", strtotime($completed_work_date));
		}
		$joined_as = $row['joined_as'];
		$current_designation = $row['current_designation'];
		$annual_renumeration = $row['annual_renumeration'];
		$currently_working = $row['currently_working'];
		$roles_and_responsibilty = $row['roles_and_responsibilty'];
		$extra_workex_count = $row['extra_workex_count'];
		$total_work_experience = $row['total_work_experience'];
        
    }

    $workexadd = "SELECT * FROM  `added_work_experience_details` WHERE application_id ='" . $finalapplicationid ."'";

	$selectworkexadd = mysql_query($workexadd);

	if ( ! $selectworkexadd ) {
	  die('Could not enter data: ' . mysql_error());
	}

	$x = 1;

    while ($row = mysql_fetch_array($selectworkexadd, MYSQL_ASSOC)) {
    	$iemployementtype = "employementtype{$x}";
		$iorganizationname = "organizationname{$x}";
		$iorganizationtype = "organizationtype{$x}";
		$iorganizationtypeother = "organizationtypeother{$x}";
		$iindustrytype = "industrytype{$x}";
		$iworkstarted = "workstarted{$x}";
		$iworkcompleted = "workcompleted{$x}";
		$icomapnyjoinedas = "comapnyjoinedas{$x}";
		$icurrentdesignation = "currentdesignation{$x}";
		$iannualrenumeration = "annualrenumeration{$x}";
		$icurrentlyworking = "currentlyworking{$x}";
		$irolesandresponsibility = "rolesandresponsibility{$x}";

		$extra_workex[$iemployementtype] = $row['employement_type'];
		$extra_workex[$iorganizationname] = $row['name_of_organization'];

		$lookup_organisation_type = "SELECT * FROM  `lookup_organisation_type`";
		$lookup_organisation_type_query = mysql_query($lookup_organisation_type);
		$extra_workex[$iorganizationtype] = $row['organization_type'];
		while ($row7 = mysql_fetch_array($lookup_organisation_type_query, MYSQL_ASSOC)) {
			if(intval($extra_workex[$iorganizationtype]) == intval($row7['code'])) {
				$extra_workex[$iorganizationtype] = $row7['description'];
				break;
			}
		}

		$extra_workex[$iorganizationtypeother] = $row['organization_type_other'];

		$extra_workex[$iindustrytype] = $row['industry_type'];
		$lookup_industry_type = "SELECT * FROM  `lookup_industry_type`";
		$lookup_industry_type_query = mysql_query($lookup_industry_type);
		while ($row8 = mysql_fetch_array($lookup_industry_type_query, MYSQL_ASSOC)) {
			if(intval($extra_workex[$iindustrytype]) == intval($row8['code'])) {
				$extra_workex[$iindustrytype] = $row8['description'];
				break;
			}
		}

		$extra_workex[$iworkstarted] = $row['started_work_date'];
		if($extra_workex[$iworkstarted] == '0000-00-00') {
			$extra_workex[$iworkstarted] = '';
		} else {
			$extra_workex[$iworkstarted] = date("d-M-Y", strtotime($extra_workex[$iworkstarted]));
		}
		// $extra_workex[$iworkstarted] = date("d-M-Y", strtotime($extra_workex[$iworkstarted]));
		$extra_workex[$iworkcompleted] = $row['completed_work_date'];
		if($extra_workex[$iworkcompleted] == '0000-00-00') {
			$extra_workex[$iworkcompleted] = '';
		} else {
			$extra_workex[$iworkcompleted] = date("d-M-Y", strtotime($extra_workex[$iworkcompleted]));
		}
		// $extra_workex[$iworkcompleted] = date("d-M-Y", strtotime($extra_workex[$iworkcompleted]));
		$extra_workex[$icomapnyjoinedas] = $row['joined_as'];
		$extra_workex[$icurrentdesignation] = $row['current_designation'];
		$extra_workex[$iannualrenumeration] = $row['annual_renumeration'];
		$extra_workex[$icurrentlyworking] = $row['currently_working'];
		$extra_workex[$irolesandresponsibility] = $row['roles_and_responsibilty'];
	    
	    $x = $x + 1;
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
        $role_model_info = $row['role_model_info'];
		$failure_info = $row['failure_info'];
		$acheivement_as_alumnus = $row['acheivement_as_alumnus'];
		$support_info = $row['support_info'];
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
	

    $status = "SELECT * FROM  `admission_section_status` WHERE application_id ='" . $finalapplicationid ."'";

	$selectstatus = mysql_query($status);

	if ( ! $selectstatus ) {
	  die('Could not enter data: ' . mysql_error());
	}

    while ($row = mysql_fetch_array($selectstatus, MYSQL_ASSOC)) {
        $personal_details_status = $row['personal_details_status'];
		$contact_details_status = $row['contact_details_status'];
		$academic_details_status = $row['academic_details_status'];
		$work_ex_details_status = $row['work_ex_details_status'];
		$reference_details_status = $row['reference_details_status'];
		$score_details_status = $row['score_details_status'];
		$document_details_status = $row['document_details_status'];
		$payment_details_status = $row['payment_details_status'];
    }
		
?>
