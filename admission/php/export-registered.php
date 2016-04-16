<?php

include dirname( __FILE__ ).'/config/config.php';


$filename = "Registered_applicants";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection   
$sql = "SELECT ad.`application_id`, ad.`f_name`, ad.`l_name`, ad.`m_name`, ad.`email_id`, ad.`mobile_number`, ad.`city`, ad.`application_status`, a.`login_system_email_activation_date` AS 'registered_date' FROM `login_system_email_activation` a LEFT JOIN `admission_users` ad ON a.login_system_email_activation_username = ad.application_id WHERE a.`login_system_email_activation_status` = '1'";


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
