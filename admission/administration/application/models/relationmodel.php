<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class RelationModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->model('tablemodel');
        $this->load->model('dbmodel');
        
    }
    
    /*
    	creates a new relation
    */
    
    public function createNew($sourceTable, $sourceColumn, $referencedTable, $referencedColumn, $referencedUse)
    {
    	
    	$data = array(
    		'dbapp_relations_source_table' => $sourceTable,
    	   	'dbapp_relations_source_field' => $sourceColumn,
    	   	'dbapp_relations_reference_table' => $referencedTable,
    	   	'dbapp_relations_reference_field' => $referencedColumn,
    	   	'dbapp_relations_reference_use' => $referencedUse
    	);
    	
    	$this->db->insert('dbapp_relations', $data);
    
    }
    
}