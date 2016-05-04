<?php

/*	--------------------------------------------------
	:: FORM FRAMEWORK PRO WITH AJAX LANGUAGE
	-------------------------------------------------- */

	error_reporting(0);

	// Site Configuration
    	
    $lang['website_title']		                        = 'CRESCENT SCHOOL OF BUSINESS – APPLICATION FORM FOR BATCH STARTING IN '.$year; 
    $lang['website_author']		                        = ''.$company.' - Admissions Team'; 
	$lang['website_description']		                = 'CRESCENT SCHOOL OF BUSINESS – APPLICATION FORM FOR BATCH STARTING IN '.$year;
	$lang['website_keywords']		                    = 'CRESCENT SCHOOL OF BUSINESS – APPLICATION FORM FOR BATCH STARTING IN '.$year;
	
	// Activation processor
	
    $lang['activation_successful']                      = '<div class="activate-success-message"><i class="icon-checkmark"></i>Congratulations '.$_POST['useremail'].' your account was activated with success, you can login now</div>';
    $lang['activation_unsuccessful']                    = '<div class="activate-error-message"><i class="icon-checkmark"></i>Error while activating your account. Please try again.<div>';
	$lang['activation_already_active']		            = '<div class="activate-error-message"><i class="icon-close"></i>Your account is already activated.</div>'; 
	$lang['activation_link_expire']		                = '<div class="activate-error-message"><i class="icon-close"></i>Your activation link is expired, please activate the account again</div>'; 
    $lang['activation_wrong_link_or_email']             = '<div class="activate-error-message"><i class="icon-close"></i>Either your confirmation token or your email is incorrect.</div>';

	// Activation form
	
	$lang['activation_form_title']                      = 'Activation of your Account';
    $lang['activation_link_login']		                = 'Login your Account'; 
    $lang['activation_link_resend_activation_token']    = 'Resend Activation Token';

	// Complete Registration processor
	
	$lang['complete_registration_wrong_security_token'] = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>';
    $lang['complete_registration_error']	            = '<div class="error-message"><i class="icon-close"></i>Error while registration, try again or contact support.</div>'; 
    $lang['complete_registration_success']	            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations your email address was successfully added</div>';    
	$lang['complete_registration_duplicate_email']      = '<div class="error-message"><i class="icon-close"></i>This email address id already in use.</div>';
	
	// Complete Registration form
	
	$lang['form_complete_registration_title']           = 'Complete your Registration';
    $lang['form_complete_registration_placeholder_useremail'] = 'Enter your Email Address'; 
    $lang['form_complete_registration_button']          = 'Complete registration and proceed to Dashboard';
    $lang['form_complete_registration_link_login']	    = 'Login your Account'; 
	
	// Dashboard Form
	
	$lang['dashboard_title']		                    = 'CRESCENT SCHOOL OF BUSINESS – APPLICATION FORM FOR BATCH STARTING IN '.$year;
	$lang['application_id']		                    	= 'Application ID: ';
	$lang['dashboard_subtitle_password']		        = 'Update your Password';
	$lang['dashboard_subtitle_email']		            = 'Update your Email';
	$lang['dashboard_subtitle_username']		        = 'Update your Username';
	$lang['dashboard_subtitle_account']		            = 'Update your Account Info';
	$lang['dashboard_subtitle_social_account']		    = 'Update your Social Account Info';
	$lang['dashboard_form_logout']		                = 'Logout';
	$lang['dashboard_form_back']		                = 'Back';
	$lang['dashboard_update_your_account']		        = 'Update your Account Info'; 
	$lang['dashboard_update_your_username']		        = 'Update your Account Username'; 
	$lang['dashboard_update_your_email']		        = 'Update your Account Email';
	$lang['dashboard_update_your_password']		        = 'Change password'; 
	$lang['dashboard_copyright_info']                   = '&copy; '.$year.' <a href="'.$website.'" target="_blank">'.$company.'</a> All Rights Reserved';


	// Section

	$lang['section_personal']		                    = 'Personal Details';
	$lang['section_contact']		                    = 'Contact Details';
	$lang['section_academic']		                    = 'Academic Qualifications';
	$lang['section_workex']		                    	= 'Work Experience';
	$lang['section_exam_score']		                    = 'Exam Score';
	$lang['section_reference']		                    = 'References';
	$lang['section_additional_info']		            = 'Additional Information';
	$lang['section_docs']		                    	= 'Document Uploads';

	
	// Update Password Form
	
	$lang['update_password_wrong_security_token']       = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
	$lang['update_password_successful']		            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your password was updated successfully</div>'; 
	$lang['update_password_unsuccessful']	            = '<div class="error-message"><i class="icon-close"></i>There is an error when updating your Password</div>';	
	$lang['update_password_placeholder_password']		= 'Insert your new Password'; 
	$lang['update_password_placeholder_retype_password']= 'Retype your updated Password';
	$lang['update_password_button']		                = 'Update your Password';
	
	// Update Email Form
	
	$lang['update_email_wrong_security_token']          = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
	$lang['update_email_successful']		            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your email was updated successfully</div>'; 
	$lang['update_email_unsuccessful']	                = '<div class="error-message"><i class="icon-close"></i>There is an error when updating your Email</div>';	
	$lang['update_email_already_taken']	                = '<div class="error-message"><i class="icon-close"></i>Attention this email is already taken</div>';	
	$lang['update_email_placeholder_email']		        = 'Insert your new Email'; 
	$lang['update_email_button']		                = 'Update your Email';
	
	// Update Username Form
	
	$lang['update_username_wrong_security_token']       = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
	$lang['update_username_successful']		            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your username was updated successfully</div>'; 
	$lang['update_username_unsuccessful']	            = '<div class="error-message"><i class="icon-close"></i>There is an error when updating your Username</div>';	
	$lang['update_username_already_taken']	            = '<div class="error-message"><i class="icon-close"></i>Attention this username is already taken</div>';	
	$lang['update_username_placeholder_username']		= 'Insert your new Username'; 
	$lang['update_username_button']		                = 'Update your Username';
	
	// Update Account Form
	
	$lang['update_account_wrong_security_token']        = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
	$lang['update_account_successful']		            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your account info was updated successfully</div>'; 
	$lang['update_account_unsuccessful']	            = '<div class="error-message"><i class="icon-close"></i>There is an error when updating your Account info</div>';	
	$lang['update_account_placeholder_firstname']		= 'Insert your new Firstname'; 
	$lang['update_account_placeholder_lastname']		= 'Insert your new Lastname'; 
	$lang['update_account_button']		                = 'Update your Account Info';
	
	// Update Social Account Form
	
	$lang['update_social_account_wrong_security_token']     = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
	$lang['update_social_account_successful']		        = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your social account info was updated successfully</div>'; 
	$lang['update_social_account_unsuccessful']	            = '<div class="error-message"><i class="icon-close"></i>There is an error when updating your Social Account info</div>';	
	$lang['update_social_account_already_taken']	        = '<div class="error-message"><i class="icon-close"></i>Attention this email is already taken</div>';	
	$lang['update_social_account_placeholder_firstname']    = 'Insert your new First Name'; 
	$lang['update_social_account_placeholder_email']		= 'Insert your new Email'; 
	$lang['update_social_account_placeholder_provider']		= 'Insert your new Provider'; 
	$lang['update_social_account_placeholder_provider_uid']	= 'Insert your new Provider UID';
	$lang['update_social_account_placeholder_display_name']	= 'Insert your new Display Name'; 
	$lang['update_social_account_placeholder_profile_url']	= 'Insert your new Profile URL';
	$lang['update_social_account_button']		            = 'Update your Social Account Info';
	
	// Forgot Password processor
	 
    $lang['forgot_wrong_security_token']                = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
    $lang['forgot_account_locked']			            = '<div class="error-message"><i class="icon-close"></i>Attention! Your account is Locked. Please try after 60 minutes or contact supprt</div>'; 
    $lang['forgot_account_subject']			            = 'Change your Password'; 	
	$lang['forgot_successful']		                    = '<div class="success-message"><i class="icon-checkmark"></i>Your request for changing password was successful! A confirmation email has been sent to '.$_POST['useremail'].' with link to change your password</div>'; 
	$lang['forgot_unsuccessful']	                    = '<div class="error-message"><i class="icon-close"></i>There is an error when sending email '.$mail->ErrorInfo;'</div>';	
	$lang['forgot_missing_member']		                = '<div class="error-message"><i class="icon-close"></i>We don´t have any member with this email '.$_POST['useremail'].'</div>'; 
	$lang['forgot_account_still_blocked']               = '<div class="error-message"><i class="icon-close"></i>Attention! Your Account is still Blocked</div>'; 
	$lang['forgot_failed_connect_with_db']	            = '<div class="error-message"><i class="icon-close"></i>There are an error when connect to database</div>';
	$lang['forgot_failed_connect_with_smtp']	        = '<div class="error-message"><i class="icon-close"></i>There are an error when connect to smtp server</div>';
	
	// Forgot Password form
	 
    $lang['form_forgot_title']		                    = 'Forgot your Password'; 
	$lang['form_forgot_placeholder_useremail']		    = 'Enter your Email Address'; 
	$lang['form_forgot_placeholder_captcha']		    = 'Enter Verification Code';
	$lang['form_forgot_button_forgot']		            = 'Request New Password'; 
	$lang['form_forgot_link_login']		                = 'Login your Account';
    $lang['form_forgot_link_resend_activation_token']   = 'Resend Activation Token';
	
    // Index page
	 
    $lang['index_title']		                        = 'CRESCENT SCHOOL OF BUSINESS</br></br>Online Application Form '.$year; 
	$lang['index_register_your_account']		        = 'Register'; 
	$lang['index_login_your_account']		            = 'Login'; 
	$lang['index_forgot_your_password']		            = 'Forgot your Password';	
	$lang['index_resend_activation_token']		        = 'Resend Activation Token';	
	$lang['index_copyright_info']		                = '&copy; '.$year.' <a href="'.$website.'" target="_blank">'.$company.'</a> All Rights Reserved';
	
	// Login processor
	 
    $lang['login_wrong_security_token']                 = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
    $lang['login_account_success']			            = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! You have successfully login in your account. Please wait while we redirect.</div>'; 
    $lang['login_no_session']			                = '<div class="error-message"><i class="icon-close"></i>Attention! Please enter Username and Password</div>'; 
	$lang['login_account_still_locked']		            = '<div class="error-message"><i class="icon-close"></i>Attention! Your Account is still Blocked</div>'; 
	$lang['login_account_not_activated']	            = '<div class="error-message"><i class="icon-close"></i>Attention! Your account is not activated yet</div>';	
	$lang['login_incorrect_information']		        = '<div class="error-message"><i class="icon-close"></i>Attention! Please enter your correct login information</div>'; 
	$lang['login_account_blocked']                      = '<div class="error-message"><i class="icon-close"></i>Attention! Your account is Locked for 60 Minutes</div>'; 
	
	// Login social processor
	 
	$lang['login_social_duplicate_email']		        = '<div class="error-message"><i class="icon-close"></i>Attention this email '.$email.' returned by the provider already exist in our database</div>'; 
	$lang['login_social_no_session']		            = '<div class="error-message"><i class="icon-close"></i>Hello you not have any session created</div>';
	$lang['login_social_unknown_result']		        = '<div class="error-message"><i class="icon-close"></i>Hello some error happen because we don´t find any result</div>';	
	$lang['login_social_hybrid_error']		            = '<div class="error-message"><i class="icon-close"></i>Unspecified error</div>'; 
	$lang['login_social_hybrid_conf_error']		        = '<div class="error-message"><i class="icon-close"></i>Hybriauth configuration error</div>';
    $lang['login_social_hybrid_not_conf_provider']      = '<div class="error-message"><i class="icon-close"></i>Provider not properly configured</div>'; 
    $lang['login_social_hybrid_unknown_provider']       = '<div class="error-message"><i class="icon-close"></i>Unknown or disabled provider</div>';
    $lang['login_social_hybrid_not_credentials']        = '<div class="error-message"><i class="icon-close"></i>Missing provider application credentials</div>'; 
	$lang['login_social_hybrid_login_failed']		    = '<div class="error-message"><i class="icon-close"></i>Authentication failed. The user has canceled the authentication or the provider refused the connection</div>'; 
	$lang['login_social_hybrid_request_profile_failed']	= '<div class="error-message"><i class="icon-close"></i>User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again</div>';	
	$lang['login_social_hybrid_not_connected']		    = '<div class="error-message"><i class="icon-close"></i>User not connected to the provider</div>'; 
	
	// Logout processor
	 
	$lang['logout_social_hybrid_error']		            = '<div class="error-message"><i class="icon-close"></i>Unspecified error</div>'; 
	$lang['logout_social_hybrid_conf_error']		    = '<div class="error-message"><i class="icon-close"></i>Hybriauth configuration error</div>';
    $lang['logout_social_hybrid_not_conf_provider']     = '<div class="error-message"><i class="icon-close"></i>Provider not properly configured</div>'; 
    $lang['logout_social_hybrid_unknown_provider']      = '<div class="error-message"><i class="icon-close"></i>Unknown or disabled provider</div>';
    $lang['logout_social_hybrid_not_credentials']       = '<div class="error-message"><i class="icon-close"></i>Missing provider application credentials</div>'; 
	$lang['logout_social_hybrid_login_failed']		    = '<div class="error-message"><i class="icon-close"></i>Authentication failed. The user has canceled the authentication or the provider refused the connection</div>'; 
	$lang['logout_social_hybrid_request_profile_failed']= '<div class="error-message"><i class="icon-close"></i>User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again</div>';	
	$lang['logout_social_hybrid_not_connected']		    = '<div class="error-message"><i class="icon-close"></i>User not connected to the provider</div>'; 
	
	// Login form
	 
    $lang['form_login_title']		                    = 'Login your Account'; 
    $lang['form_login_placeholder_username']			= 'Enter your Username'; 
	$lang['form_login_placeholder_password']		    = 'Enter your Password'; 
	$lang['form_login_placeholder_captcha']		        = 'Enter Verification Code';
	$lang['form_login_button_login']		            = 'Login your Account'; 
	$lang['form_login_link_register']		            = 'Register your Account'; 
    $lang['form_login_link_forgot_password']     	    = 'Forgot Password'; 
	$lang['form_login_resend_activation_token']  	    = 'Resend Activation Token';
	
    // New Password form
	 
    $lang['form_new_password_title']		            = 'Change your Password'; 
	$lang['form_new_password_placeholder_password']		= 'Enter your new Password'; 
	$lang['form_new_password_placeholder_retype_password'] = 'Repeat your new Password'; 	
	$lang['form_new_password_button_new_password']		= 'Change your Password'; 
	$lang['form_new_password_link_login']		        = 'Login your Account';

	// New Password processor
   
    $lang['new_password_wrong_security_token']          = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 	
    $lang['new_password_successful']                    = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations '.$_POST['useremail'].' your password was successfully changed</div>';
	$lang['new_password_unsuccessful']		            = '<div class="error-message"><i class="icon-close"></i>Attention! Error occured while changng your password. Pleas try again.</div>'; 
	$lang['new_password_link_expire']		            = '<div class="error-message"><i class="icon-close"></i>Your password change link is expired. Please try again.</div>'; 
    $lang['new_password_wrong_link_email_or_token']     = '<div class="error-message"><i class="icon-close"></i>The email id you have entered is incorrect.</div>';
    $lang['new_password_wrong_link_or_email']           = '<div class="error-message"><i class="icon-close"></i>Email id or security token is incorrect.</div>';

	// Register processor
	 
    $lang['account_creation_wrong_security_token']		= '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
   	$lang['account_creation_subject']				    = 'Activate your account';
	$lang['account_creation_successful']				= '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your registration was successfully! A confirmation email has been sent to '.$_POST['useremail'].' with link to activate your Account</div>';
	$lang['account_creation_unsuccessful']				= '<div class="error-message"><i class="icon-close"></i>There is an Error when sending activation email </br>Please wait for few minutes and click <a href="' .$baseurl.'resend.php?lang=">Resend Activation Link</a></div>';
	$lang['account_creation_duplicate_email']			= '<div class="error-message"><i class="icon-close"></i>There is already a member with this email '.$_POST['useremail'].'</div>'; 
	$lang['account_creation_duplicate_username']		= '<div class="error-message"><i class="icon-close"></i>There is already a member with this username '.$_POST['username'].'</div>'; 
	$lang['account_creation_failed_connect_with_db']	= '<div class="error-message"><i class="icon-close"></i>There is an error when connect to database</div>';	
	$lang['account_creation_failed_connect_with_smtp']	= '<div class="error-message"><i class="icon-close"></i>There is an error when connect to smtp server</div>';	

	// Register form
	 
    $lang['form_register_title']		                = 'Register your Account'; 
	$lang['form_register_placeholder_firstname']		= 'Enter your First Name'; 
	$lang['form_register_placeholder_lastname']		    = 'Enter your Last Name'; 
	$lang['form_register_placeholder_middlename']		= 'Enter your Middle Name'; 
    $lang['form_register_placeholder_username']			= 'Enter your Username'; 
	$lang['form_register_placeholder_useremail']		= 'Enter your Email Address'; 
	$lang['form_register_placeholder_password']		    = 'Enter your Password'; 
    $lang['form_register_placeholder_retype_password']  = 'Repeat your Password'; 
    $lang['form_register_placeholder_captcha']		    = 'Enter Verification Code';
	$lang['form_register_terms_of_service']			    = 'By proceeding, you agree with <a href="' .$baseurl.'terms.php" target="_blank">Terms & Conditions</a>'; 
	$lang['form_register_button_register']		        = 'Register your Account'; 
	$lang['form_register_link_login']		            = 'Login your Account'; 
    $lang['form_register_link_forgot_password']     	= 'Forgot Password'; 
	$lang['form_register_resend_activation_token']  	= 'Resend Activation Token';
	
	// Resend activation Token processor
	 
    $lang['resend_activation_token_wrong_security_token']      = '<div class="error-message"><i class="icon-close"></i>Attention! Security Token is not Valid</div>'; 
    $lang['resend_activation_token_account_locked']			   = '<div class="error-message"><i class="icon-close"></i>Attention! Your account is Locked for 60 Minutes</div>'; 
    $lang['resend_activation_account']           			   = 'Activate your Account'; 
	$lang['resend_activation_token_successful']		           = '<div class="success-message"><i class="icon-checkmark"></i>Congratulations! Your request for a new activation link was successfully! A confirmation email has been sent to '.$_POST['useremail'].' with link to activate your Account</div>'; 
	$lang['resend_activation_token_unsuccessful']	           = '<div class="error-message"><i class="icon-close"></i>There is an error when sending email '.$mail->ErrorInfo;'</div>';	
	$lang['resend_activation_token_missing_member']		       = '<div class="error-message"><i class="icon-close"></i>We don´t have any member with this email '.$_POST['useremail'].'</div>'; 
	$lang['resend_activation_token_account_still_blocked']     = '<div class="error-message"><i class="icon-close"></i>Attention! Your Account is still Blocked</div>'; 
	$lang['resend_activation_token_account_already_active']    = '<div class="error-message"><i class="icon-close"></i>Attention! Your Account is already active</div>'; 	
	$lang['resend_activation_token_failed_connect_with_db']	   = '<div class="error-message"><i class="icon-close"></i>There is an error when connect to database</div>';	
	$lang['resend_activation_token_failed_connect_with_smtp']  = '<div class="error-message"><i class="icon-close"></i>There is an error when connect to smtp server</div>';	
	
	// Resend activation Token form
	 
    $lang['form_resend_activation_token_title']		           = 'Resend Activation Token'; 
	$lang['form_resend_activation_token_placeholder_useremail'] = 'Enter your Email Address';
    $lang['form_resend_activation_token_placeholder_captcha']  = 'Enter Verification Code';	
	$lang['form_resend_activation_token_button']		       = 'Resend Activation Token'; 
	$lang['form_resend_activation_token_link_login']		   = 'Login your Account'; 
    $lang['form_resend_activation_token_link_forgot_password'] = 'Forgot Password'; 
	
	// Automessage email activation
	 
    $lang['automessage_activation_title']		               = 'Hello '.$GLOBALS['finalfirstname'] . ' ' . $GLOBALS['finallastname']; 
	$lang['automessage_activation_introdution']		           = 'Please verify your account by clicking on the below link.'; 
	$lang['automessage_activation_link']		               = 'Verify Your Account'; 
    $lang['automessage_activation_mistake']                    = 'If you did not register in our website, please ignore this email.<br>For more information, please visit our support center';
	
	// Automessage forgot password
	 
    $lang['automessage_forgot_password_title']		           = 'Hello '.$finalusername;
	$lang['automessage_forgot_password_introdution']		   = 'Please change your password by clicking on the below link.'; 
	$lang['automessage_forgot_password_link']		           = 'Change your Password'; 
    $lang['automessage_forgot_password_mistake']               = 'If you did not register in our website, please ignore this email.<br>For more information, please visit our support center';
	
?>