SELECT ad.`application_id`,
       ad.`f_name`,
       ad.`l_name`,
       ad.`m_name`,
       ad.`email_id`,
       ad.`mobile_number`,
       ad.`city`,
       ad.`application_status`,
       a.`login_system_email_activation_date` AS 'registered_date'
FROM `login_system_email_activation` a
LEFT JOIN `admission_users` ad ON a.login_system_email_activation_username = ad.application_id
WHERE a.`login_system_email_activation_status` = '1'