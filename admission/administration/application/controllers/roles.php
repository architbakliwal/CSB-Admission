<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->model('tablemodel');
		$this->load->model('dbmodel');
		$this->load->model('rolemodel');
		$this->load->model('usermodel');
		
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
		loads and dipslays a user role
	*/
	
	public function index($role = "")
	{
	
		$this->data['page'] = "roles";
		
		if( $this->rolemodel->getDefault() ) {
		
			$this->data['defaultRole'] = $this->rolemodel->getDefault();
		
		}
		
		//get the ion_auth groups
		$this->data['roles'] = $this->ion_auth->groups()->result();
		
		//tables
		$this->data['tables'] = $this->tablemodel->listAll(false);
		
								
		//got a role?
		if($role != '') {
		
			$this->data['theRole'] = $this->rolemodel->getRole($role);
		
		}
						
		$this->load->view('roles/roles', $this->data);
	
	}
	
	
	/*
		creates a new user role
	*/
	
	public function create()
	{
	
		$this->form_validation->set_rules('role', 'Role', 'trim|required|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
		
			$this->session->set_flashdata('error_message', "Something went wrong with the data you entered, please see below:<br>".validation_errors());
			
			redirect("/roles/", "refresh");
		
		} else {
		
			$userName = $this->rolemodel->newRole($_POST);
			
			$this->session->set_flashdata('success_message', 'The new user role was created successfully! Yeah!');
			
			redirect("/roles/".$userName, "refresh");
		
		}
	
	}
	
	
	/*
		updates an existing user role
	*/
	
	public function update() 
	{
	
		if(isset($_POST['permissions']) && isset($_POST['roleID']) && $_POST['roleID'] != '1') {
		
			$userName = $this->rolemodel->updatePermissions($_POST['permissions'], $_POST['roleID']);
			
			$this->session->set_flashdata('success_message', 'The user role was updated successfully! Yeah!');
			
			redirect("/roles/".$userName, "refresh");
		
		} elseif(isset($_POST['roleName']) && $_POST['roleID'] != '1') {
		
			$userName = $this->rolemodel->updateRole($_POST);
			
			$this->session->set_flashdata('success_message', 'The user role was updated successfully! Yeah!');
			
			redirect("/roles/".$userName, "refresh");
		
		} else {
		
			//important data is missing
			
			$this->session->set_flashdata('error_message', "It appears some important data is missing and we couldn't update the role. Please try again. If you keep gettig this error message, please contact support.");
			
			redirect("/roles/", "refresh");
		
		}
	
	}
	
	
	/*
		deletes a user role
	*/
	
	public function delete($roleID = '')
	{
	
		if($roleID != '') {
		
			//do we have a default role?
			
			if( !$this->rolemodel->getDefault() ) {
			
				$this->session->set_flashdata('error_message', "Please choose a DEFAULT role before deleting one.");
				
				redirect("/roles/", "refresh");
			
			}
			
			//set users to the default role
			
			$defaultRole = $this->rolemodel->getDefault();
			
			$data = array(
				'group_id' => $defaultRole->id
			);
			
			$this->db->where('group_id', $roleID);
			$this->db->update('dbapp_users_groups', $data); 
		
		
		
			$this->rolemodel->deleteRole($roleID);
			
			
			//we also need to make sure that the new MySQL permissions are applied to existing users
			
			//grab all users who have this role
			
			$users = $this->db->from('dbapp_users_groups')->where('group_id', $defaultRole->id)->join('dbapp_users', 'dbapp_users_groups.user_id = dbapp_users.id')->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result();
			
						
			
			foreach($users as $user) {
			
				$permissions = json_decode($user->permissions, true);
			
				$this->rolemodel->applyPermissions($permissions, $user->mysql_user);
				    		
			}
						
			$this->session->set_flashdata('success_message', 'The user role was deleted successfully! Yeah!');
			
			redirect("/roles", "refresh");
		
		}
	
	}
	
}

/* End of file roles.php */
/* Location: ./application/controllers/roles.php */