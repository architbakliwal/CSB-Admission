<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->model('tablemodel');
		$this->load->model('dbmodel');
		$this->load->model('usermodel');
		$this->load->model('rolemodel');
		$this->load->model('issuemodel');
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
		$this->data['tables'] = $this->tablemodel->listAll(false);
		
	}

	public function index()
	{
				
		//system check
		
		$this->issuemodel->systemCheck();
		
			
		$this->data['page'] = "dashboard";
		
		
		$this->load->view('dashboard', $this->data);
	
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */