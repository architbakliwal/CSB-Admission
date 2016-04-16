<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Doc extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
	}
	
	public function columnRestrictions()
	{
	
		$this->data['page'] = "Documentation - Column Restrictions";
		
		$this->load->view('doc/columnrestrictions', $this->data);
	
	}

	public function index()
	{
				
		
	
	}
	
}

/* End of file doc.php */
/* Location: ./application/controllers/doc.php */