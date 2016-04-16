<?php

class tokenCheck {

	public $CI;

	public function checkToken() {
	
		$this->CI = &get_instance();
		
		//do we have form data?
		
		unset( $_GET['_token'] );
		unset( $_POST['_token'] );
		unset( $_REQUEST['_token'] );
				
		/*if( isset($_REQUEST) && count($_REQUEST) > 3 && !isset($_REQUEST['sColumns']) ) {
		
			//we have form data
									
			//do we have a proper token?
			if( isset($_REQUEST['_token']) && $_REQUEST['_token'] == $this->CI->session->userdata('session_id') ) {
			
				//token present and correctly set, destroy it now
				unset($_REQUEST['_token']);
				
				if( isset($_POST['_token']) ) {
					unset( $_POST['_token'] );
				}
				
				if( isset($_GET['_token']) ) {
					unset( $_GET['_token'] );
				}
							
			} else {
			
				//token is missing or faulty, die with error
				die("Invalid token");
			
			}
		
		}*/
		
	}

}

?>