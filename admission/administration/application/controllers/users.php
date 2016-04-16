<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->model('tablemodel');
		$this->load->model('dbmodel');
		$this->load->model('usermodel');
		$this->load->model('rolemodel');
		$this->load->library('encrypt');
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
		//can this user/role manage users?
		if(!$this->usermodel->adminUsers()) {
		
			die("<h1>Access denied</h1>");
		
		}
		
		$this->data['tables'] = $this->tablemodel->listAll(false);
				
	}
	
	
	/*
		loads/displays a user
	*/

	public function index($userID = "")
	{
	
		$this->data['page'] = "users";
		
		//get all users
		$this->data['users'] = $this->usermodel->getAll();
		
		//get roles
		$this->data['roles'] = $this->rolemodel->getAll();
					
		if($userID != "") {
		
			$this->data['theUser'] = $this->usermodel->getUser($userID);
		
		}
		
		$this->load->view('users/users', $this->data);
	
	}
	
	
	/*
		creates a new user
	*/
	
	public function create() 
	{
	
		$this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('group', 'Role', 'trim|required|xss_clean');
		
		
		if ($this->form_validation->run() == FALSE) {
		
			$this->session->set_flashdata('error_message', "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors());
			
			redirect("/users/", "refresh");
		
		} else {
		
			$userID = $this->usermodel->newUser($_POST);
			
			$this->session->set_flashdata('success_message', 'The user was created successfully! Yeah!');
			
			
			//send email
			$this->load->library('email');
			
			$this->email->from($this->config->item('support_email'), $this->config->item('support_name'));
			$this->email->to($_POST['email']); 
			
			$this->email->subject('Your new Databased account');
			$this->email->message( $this->load->view('auth/email/new', array('email'=>$_POST['email'], 'password'=>$_POST['password']), true ) );	
			
			$this->email->send();
			
			//echo $this->email->print_debugger();
			
			redirect("/users/".$userID, "refresh");
		
		}
	
	}
	
	
	/*
		updates the login details (email address + password) for a user
	*/
	
	public function updateLogin($userID)
	{
	
		$this->data['page'] = "users";
		
		//get all users
		$this->data['users'] = $this->usermodel->getAll();
		
		//get roles
		$this->data['roles'] = $this->rolemodel->getAll();
		
		$this->data['theUser'] = $this->usermodel->getUser($userID);
	
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
		
			$this->load->view('users/users', $this->data);
			
		} else {
		
			$data = array(
				'email' => $_POST['email'],
				'username' => $_POST['email'],
				'password' => $_POST['password']
			);
			
			$this->ion_auth->update($userID, $data);
		
			$this->session->set_flashdata('success_message', 'The email address / password were updated successfully! Yeah!');
			
			redirect("/users/".$userID, "refresh");
			
		}
	
	}
	
	
	/*
		updates other user information for a user
	*/
	
	public function update($userID)
	{
	
		$this->data['page'] = "users";
		
		//get all users
		$this->data['users'] = $this->usermodel->getAll();
		
		//get roles
		$this->data['roles'] = $this->rolemodel->getAll();
		
		$this->data['theUser'] = $this->usermodel->getUser($userID);
		
		$this->form_validation->set_rules('firstname', 'First name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('group', 'User role', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
		
			$this->load->view('users/users', $this->data);
			
		} else {
		
			$data = array(
				'first_name' => $_POST['firstname'],
				'last_name' => $_POST['lastname'],
				'company' => $_POST['company'],
				'phone' => $_POST['phone']
			);
			
			$this->ion_auth->update($userID, $data);
		
			//update user role/group
			$data = array(
				'group_id' => $_POST['group']
			);
			
			$this->db->where('user_id', $userID);
			$this->db->update('dbapp_users_groups', $data);
			
			//if the new role is Adminisiatrtor, we'll need to take of the MySQL site of things
			
			if( $_POST['group'] == 1 ) {
						
				$this->usermodel->makeAdmin($userID);
			
			} 
		
			$this->session->set_flashdata('success_message', 'The profile details were successfully updated. Yeah!');
			
			redirect("/users/".$userID, "refresh");
			
		}
	
	}
	
	
	/*
		deletes a user and all associated data from the app
	*/
	
	public function delete($userID)
	{
	
		//only allow this if this user had user admin rights
		
		if( $this->usermodel->adminUsers() && $userID != 1 ) {
		
			
			$this->usermodel->deleteUser($userID);
			
			$this->session->set_flashdata('success_message', "The selected user and all it's associated data were permanently deleted.");
			
			redirect('/users/', "refresh");
			
		
		} else {
		
			die("<h1>Not allowed</h1>");
		
		}
	
	}
	
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */