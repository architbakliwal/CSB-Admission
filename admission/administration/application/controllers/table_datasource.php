<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table_datasource extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('Datatables');
		$this->load->model('tablemodel');
		$this->load->model('usermodel');
		$this->load->helper('html_helper');
		//$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('encrypt');
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		} 
		
	}
		
	
	/*
		ajax call
		
		used by jquery's datatables plugin to load a db table
	*/

	public function index($table)
	{
		
		$this->load->database();		
				
		//get primary key for this table
		$primaryKey = $this->tablemodel->getPrimaryKey($table);
		
		if($this->session->userdata($table)) {
		
			//we've got columns registered with this session
			
			$fields = $this->db->list_fields($table);
			
			$temp = array();
			
			foreach ($fields as $field) {
			
			   	if(in_array($field, $this->session->userdata($table))) {
			   	
			   		array_push($temp, $field);
			   
			   	}
			
			} 
			
			$allColumnsString = implode(", ", $temp);
			
		
		} else {
		
			//no columns with session, display all
			$fields = $this->tablemodel->getFieldsFor($table);
			
			$fieldNames = array();
			
			foreach($fields as $field) {
			
				array_push($fieldNames, $field['field']);
			
			}
			
			$allColumnsString = implode(", ", $fieldNames);
			
		}
		
		$this->datatables->set_DB( $this->load->database('default', TRUE) );
						
		$this->datatables->select($allColumnsString);
		$this->datatables->from($table);
		
		
						
		if( $this->tablemodel->isPrivate($table) && !$this->ion_auth->is_admin() ) {
		
			$this->datatables->join($this->db->database.'.dbapp_users_records', $table.".".$primaryKey->name." = dbapp_users_records.dbapp_users_records_recordid", 'left');
		
			$user = $this->ion_auth->user()->row();
		
			$this->datatables->where('dbapp_users_records_userid', $user->id);
		
		}
			
		//do we have any search items set?
		
		if( $this->session->userdata('searchItems') != '' && $this->session->userdata('searchItems_table') == $table ) {
		
			$searchItems = $this->session->userdata('searchItems');
			
			foreach( $searchItems as $item ) {
			
				if( $item['operator'] == 'LIKE' ) {
				
					$this->datatables->like($item['column'], $item['value'], 'none');
				
				} elseif( $item['operator'] == 'LIKE%%' ) {
				
					$this->datatables->like($item['column'], $item['value'], 'both');
				
				} elseif( $item['operator'] == 'NOT LIKE%%' ) {
				
					$this->datatables->not_like($item['column'], $item['value']);
				
				} elseif( $item['operator'] == 'NOT LIKE' ) {
				
					$this->datatables->not_like($item['column'], $item['value']);
				
				} else {
			
					$this->datatables->where($item['column'].' '.$item['operator'], $item['value']);
				
				}
			
			}
		
		}
				
		
		if( $primaryKey != false ) {
				
			if( $this->usermodel->hasTablePermission("update", $table) ) {
					
				//$this->datatables->edit_column($primaryKey->name, '<span class="recordID" id="record_$1">$1</span> <span class="pull-right tableCrud"><a href="#recordModal" id="record_$1" class="crudEdit" title="Edit this record" data-placement="right" data-toggle="modal"><span class="fui-new"></span></a>&nbsp;&nbsp;<a href="#" class="crudDel" id="$1" title="Delete this record" data-placement="right"><span class="fui-cross-inverted"></span></a></span>', $primaryKey->name);
			
				$this->datatables->add_column('actions', '<span class="recordID" id="record_$1"></span> <span class="pull-right tableCrud"><a href="#recordModal" id="record_$1" class="crudEdit" title="Edit this record" data-placement="right" data-toggle="modal"><span class="fui-new"></span></a>&nbsp;&nbsp;<a href="#" class="crudDel" id="$1" title="Delete this record" data-placement="right"><span class="fui-cross-inverted"></span></a></span>', $primaryKey->name);
		
			} else {
					
				//$this->datatables->edit_column($primaryKey->name, '<span class="recordID" id="record_$1">$1</span> <span class="pull-right tableCrud"><a href="#recordViewModal" id="record_$1" class="crudView" title="View this record" data-placement="right" data-toggle="modal"><span class="fui-export"></span></a></span>', $primaryKey->name);
			
				$this->datatables->add_column('actions', '<span class="recordID" id="record_$1"></span> <span class="pull-right tableCrud"><a href="#recordViewModal" id="record_$1" class="crudView" title="View this record" data-placement="right" data-toggle="modal"><span class="fui-export"></span></a></span>', $primaryKey->name);
		
			}
			
		
			echo $this->datatables->generate();
		
		}
				
	}
}

/* End of file table.php */
/* Location: ./application/controllers/table.php */