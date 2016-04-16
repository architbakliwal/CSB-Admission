<?php
    
	/* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth */

	/* ----------------------------------------------------------------------------------------
		HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
	   ---------------------------------------------------------------------------------------- */

	return 
		array(
			"base_url" => "http://your-domain.com/folder/php/hybridauth/", 

			"providers" => array ( 
				"Google" => array ( 
					"enabled" => true,
					"keys"    => array ( "id" => "", "secret" => "" ), 
				),

				"Facebook" => array ( 
					"enabled" => true,
					"keys"    => array ( "id" => "", "secret" => "" ), 
				),

				"Twitter" => array ( 
					"enabled" => true,
					"keys"    => array ( "key" => "", "secret" => "" ) 
				),
			),

			"debug_mode" => false,
			"debug_file" => "",
		);

