<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IssueModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        
        $this->load->model('dbmodel');
        
    }
    
    
    /*
    	performs a system check to make sure we don't have orphan tables or databases
    */
    
    public function systemCheck() 
   	{
    	    	
    	
    	
    }
    
}