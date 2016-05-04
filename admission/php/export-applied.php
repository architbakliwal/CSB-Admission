<?php

include dirname( __FILE__ ).'/config/config.php';


$filename = "Applied_applicants";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "SELECT log.`login_system_login_attempts_first_date` AS 'applied_date', a.`application_id`, a.`f_name`, a.`l_name`, a.`m_name`, a.`email_id`, a.`application_status`, p.`user_dob`, p.`age`, p.`gender`, p.`blood_group`, p.`hear_abt_csb`, c.`email_id`, c.`mobile_number`, c.`phone_number`, c.`current_address_line1`, c.`current_address_line2`, c.`current_address_line3`, c.`current_address_city`, c.`current_address_state`, c.`current_address_state_other`, c.`current_address_country`, c.`current_address_pin`, c.`permanent_same_as_current_address`, c.`permanent_address_line1`, c.`permanent_address_line2`, c.`permanent_address_line3`, c.`permanent_address_city`, c.`permanent_address_state`, c.`permanent_address_state_other`, c.`permanent_address_country`, c.`permanent_address_pin`, c.`parent_name`, c.`parent_mobile`, c.`parent_relation`, c.`parent_organisation`, c.`parent_designation`, c.`parent_qualification`, ex.`exam_score`, r.`title_of_refree`, r.`name_of_refree`, r.`organization`, r.`designation`, r.`phone_number`, r.`email_id`, r.`capacity_of_knowing`, doc.`passport_photo`, doc.`resume`, info.`after_mba_plan`, ad.`last_update_date` FROM `admission_users` a LEFT JOIN `login_system_login_attempts` log ON a.application_id = log.login_system_login_attempts_username LEFT JOIN `admission_section_status` ad ON a.application_id = ad.application_id LEFT JOIN `users_personal_details` p ON a.application_id = p.application_id LEFT JOIN `users_contact_details` c ON a.application_id = c.application_id LEFT JOIN `user_exam_score` ex ON a.application_id = ex.application_id LEFT JOIN `users_reference_details` r ON a.application_id = r.application_id LEFT JOIN `users_documents_uploads` doc ON a.application_id = doc.application_id LEFT JOIN `user_additional_info` info ON a.application_id = info.application_id";


$result = mysql_query( $sql );

if ( ! $result ) {
	die( 'Could not enter data: ' . mysql_error() );
}

	
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }   
?>
