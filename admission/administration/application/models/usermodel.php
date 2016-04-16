<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('ion_auth');
        $this->load->model('rolemodel');
        
    }
    
    
    /*
    	returns all app users
    */
    
    public function getAll() 
    {
        
    	return $this->db->from('dbapp_users')->get()->result();
    
    }
    
    
    /*
    	returns a single app user
    */
    
    public function getUser($userID)
    {
    
    	$tempp = $this->db->from('dbapp_users')->where('dbapp_users.id', $userID)->join('dbapp_users_groups', 'dbapp_users.id = dbapp_users_groups.user_id')->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result(); 
    
    	return $tempp[0];
    	
    }
    
    
    /*
    	creates a new app user
    */
    
    public function newUser($data)
    {
    
    	$additional_data = array();
    	$additional_data['first_name'] = $data['firstname'];
    	$additional_data['last_name'] = $data['lastname'];
    	$additional_data['company'] = $data['company'];
    	$additional_data['phone'] = $data['phone'];
    	
    	$newUserId = $this->ion_auth->register($data['email'], $data['password'], $data['email'], $additional_data, $group = array($data['group']));
    	    	
    	    	
    	//set MySQL permissions
    	
    	//grab permissions for this user role
    	
    	$tempp = $this->db->from('dbapp_groups')->where('id', $data['group'])->get()->result();
    	
    	$permissions = json_decode($tempp[0]->permissions, true);
    	
    	
    	//apply permissions to the new user, if it's not an admin
    	
    	if( $data['group'] == 1 ) {
    	
    		$this->makeAdmin($newUserId);
    	
    	}
    	
    	return $newUserId;
    
    }
    
    
    
    /*
    	verify that the current user has access to the given database
    */
    
    public function hasAccessToDb($db)
    {
    
    	//if the user had admin role, it's alright
    	if ($this->ion_auth->is_admin()) {
    		return true;
    	}
    	
    
    	$user = $this->ion_auth->user()->row();
    	
    	$tempp = $this->db->from('dbapp_users_groups')->where('user_id', $user->id)->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result();
    
    	$group = $tempp[0];
    	
    	$permissions = json_decode($group->permissions, true);
    	
    	foreach($permissions as $dbb=>$array) {
    	
    		if($dbb == $db) {
    		
    			return true;
    		
    		}
    	
    	}
    	
    	return false;
    
    }
    
    /*
    	verify that the current user has privileges to a database
    */
    
    public function hasDBPermission($permission)
    {
    
    	//if the user had admin role, it's alright
    	if ($this->ion_auth->is_admin()) {
    		return true;
    	}
    	
    	$user = $this->ion_auth->user()->row();
    	
    	$tempp = $this->db->from('dbapp_users_groups')->where('user_id', $user->id)->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result();
    		
    	$group = $tempp[0];
    			
    	$permissions = json_decode($group->permissions, true);
    	    		    	    	
    	if(isset($permissions[$permission])) {
    	    		
    		return true;
    		
    	}
    		
    	return false;
    
    }
    
    
    /*
    	checks if the current user owns this tab;e
    */
    
    public function ownsTable($table) 
    {
    
    	$userTables = $this->ion_auth->user()->row()->tables;
    	
    	if( $userTables != '' ) {
    	
    		$tables = json_decode($userTables, true);
    		
    		foreach( $tables as $t ) {
    		    			
    			if( $t == $table ) {
    			
    				return true;
    			
    			}
    		
    		}
    	
    	}
    	
    	return false;
    
    }
    
    
    
    /*
    	verify that the current user has access to the given table
    */
    
    public function hasTablePermission($permission, $table) 
    {
    	    	
    	//if the user had admin role, it's alright
    	if ($this->ion_auth->is_admin()) {
    		return true;
    	}
    	
    	
    	//if this table belongs to the user return true
    	
    	if ( $this->usermodel->ownsTable($table) ) {
    	
    		return true;
    	
    	}
    	    	
    	$user = $this->ion_auth->user()->row();
    	    	    	
    	$tempp = $this->db->from('dbapp_users_groups')->where('user_id', $user->id)->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result();
    	    		
    	$group = $tempp[0];
    	    			
    	$permissions = json_decode($group->permissions, true);
    	    	    	    	
    	if(isset($permissions[$table][$permission])) {
    		    		
    		return true;
    		
    	}
    		
    	return false;
    
    }
    
    
    /*
    	verify that the current user is allowed admnistrate users
    */
    
    public function adminUsers()
    {
    
    	//if the user had admin role, it's alright
    	if ($this->ion_auth->is_admin()) {
    		return true;
    	}
    
    	$userID = $this->ion_auth->user()->row()->id;
    	
    	$tempp = $this->db->from('dbapp_users_groups')->where('user_id', $userID)->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get()->result();
    	    	
    	if( $tempp[0]->admin_users == 1 ) {
    	
    		return true;
    	
    	} else {
    	
    		return false;
    	
    	}
    
    }
    
    
    /*
    	deletes a user from the system, incl associated data
    */
    
    public function deleteUser($userID)
    {
    	
    	$mysqlUser = $this->ion_auth->user($userID)->row()->mysql_user;
    	    	    	
    	//delete the user account
    	
    	$this->ion_auth->delete_user($userID);
    	
    	//delete mysql user
    	$this->db->query("REVOKE ALL PRIVILEGES, GRANT OPTION FROM '$mysqlUser'@'".$this->db->hostname."'");
    	$this->db->query("DROP USER '".$mysqlUser."'@'".$this->db->hostname."';");
    	
    }
    
    
    /*
    	makes user super admin
    */
    
    public function makeAdmin($userID)
    {
    
    	$mysqlUser = $this->ion_auth->user($userID)->row()->mysql_user;
    	
    	$this->db->query("GRANT ALL PRIVILEGES ON *.* TO '$mysqlUser'@'".$this->db->hostname."' WITH GRANT OPTION");
    	
    	    
    }
    
}