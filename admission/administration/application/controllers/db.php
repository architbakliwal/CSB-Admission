<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->model('tablemodel');
		$this->load->model('dbmodel');
		$this->load->model('usermodel');
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
		$this->data['tables'] = $this->tablemodel->listAll(false);
				
	}
	
	
	/*
		main function for the table page, displays the first table in a database if none is provided
	*/
	
	public function index($table = '', $clearSearch = false) 
	{
		
		//search reset?
		
		if( $clearSearch == true ) {
		
			$this->session->unset_userdata('searchItems');
			
			redirect(site_url("db/".$table), 'location');
		
		} 
		
		//do we have any search parameters?
		
		if( isset( $_POST['columns'] ) && $_POST['table'] == $table ) {
		
			unset($_POST['columns'][0]);
			unset($_POST['selectors'][0]);
			unset($_POST['values'][0]);
			
			//unset old items
			$this->session->unset_userdata('searchItems');
			
			//phpinfo();
				
			$counter = 1;
			
			$searchItems = array();
				
			foreach( $_POST['columns'] as $col ) {
			
				if( $col != '' && isset( $_POST['operators'][$counter] ) && $_POST['operators'][$counter] != '' && isset( $_POST['values'][$counter] ) && $_POST['values'][$counter] != '' ) {
									
					$temp = array();
					$temp['column'] = $col;
					$temp['operator'] = $_POST['operators'][$counter];
					$temp['value'] = $_POST['values'][$counter];
				
					$searchItems[] = $temp;
					
				}
				
				$counter++;
			
			}
			
			if( count($searchItems) > 0 ) {
		
				$this->session->set_userdata('searchItems', $searchItems);
						
				$this->session->set_userdata('searchItems_table', $_POST['table']);
			
			}
			
			redirect(site_url("db/".$table), 'location');
		}
										
		//check if the table exists
		
		if( $table != '' && !$this->tablemodel->exists($table) ) {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "It appears you're trying to load a non-existing table. Please contact your administrator at <a href='mailto".$this->config->item('support_email')."'>".$this->config->item('support_email')."</a> if the problem persists.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}	
			
		$this->data['tables'] = $this->tablemodel->listAll(false);
				
		$this->data['tabless'] = $this->tablemodel->tablesPlusColumns();
																
		if($table == "" && count($this->data['tables']) > 0) {
		
			$this->data['theTable'] = $this->data['tables'][0]['table'];
							
			$this->data['tableFields'] = $this->tablemodel->getFieldsFor($this->data['tables'][0]['table']);
						
			//fields incl FK data
			$this->data['tableFields_'] = $this->tablemodel->getFieldsFK($this->data['tables'][0]['table']);
			
			
			
		} else {
		
			$this->data['theTable'] = $table;
			
			if( count($this->data['tables']) > 0 ) {//only if our db has tables
			
				$this->data['tableFields'] = $this->tablemodel->getFieldsFor($table);
				
				//fields incl FK data
				$this->data['tableFields_'] = $this->tablemodel->getFieldsFK($table);
				
			}
		
		}
		
		if( count($this->data['tables']) > 0 ) {
		
			$this->data['table_engine'] = $this->tablemodel->getEngine($this->data['theTable']);
		
		}
		
		//any fields registered with the session?
		if(!$this->session->userdata($this->data['theTable'])) {
		
			$sessionFields = array();
		
			if( count($this->data['tables']) > 0 ) {//only if our db has tables
		
				foreach($this->data['tableFields'] as $field) {
			
					array_push($sessionFields, $field['field']);
			
				}
			
			}
			
			//delete old session data
			$this->session->unset_userdata($this->data['theTable']);
			
			$this->session->set_userdata($this->data['theTable'], $sessionFields);
		
		}
		
		//$this->session->sess_destroy();
		
		//print_r($this->session->userdata($this->data['theTable']));
		
		//die("<br><br>".$this->data['theTable']);
		
		$this->data['page'] = "data";
		
		
		//does the user have update rights?
		if( $this->usermodel->hasTablePermission("update", $this->data['theTable']) ) {
		
			$this->data['tableUpdateAllowed'] = 'yes';
		
		} else {
		
			$this->data['tableUpdateAllowed'] = 'no';
		
		}
		
		
		//does the user have insert rights?
		if( $this->usermodel->hasTablePermission("insert", $this->data['theTable']) ) {
		
			$this->data['tableInsertAllowed'] = 'yes';
		
		} else {
		
			$this->data['tableInsertAllowed'] = 'no';
		
		}
			
				
		//does the user have delete table rights?
		if( $this->usermodel->hasDBPermission("drop") || $this->usermodel->ownsTable($this->data['theTable']) ) {
		
			$this->data['tableDropAllowed'] = 'yes';
		
		} else {
		
			$this->data['tableDropAllowed'] = 'no';
		
		}
				
		
		//does this table have a primary key set?
		
		if( count($this->data['tables']) > 0 ) {//only if our db has tables
		
			if( $this->tablemodel->getPrimaryKey($this->data['theTable']) ) {
			
				$this->data['hasPrimary'] = true;
				
				$temp = $this->tablemodel->getPrimaryKey($this->data['theTable']);
				
				$this->data['primaryKey'] = $temp->name;
								
			} else {
			
				$this->data['hasPrimary'] = false;
			
			}
			
			//the number of records in the table
			
			$this->data['nrOfFields'] = $this->tablemodel->nrOfFields($this->data['theTable']);
					
		}
		
		$this->load->view('table/table', $this->data);
	
	}
	
	
	/*
		ajax call
		adds column to the data view
	*/
	
	public function addField() 
	{//add field to data view
			
		$temp = explode(".", $_GET['field']);
		
		$table = $temp[0];
		$fieldToAdd = $temp[1];
		
		if($fieldToAdd == 'all') {
		
			//delete old session data
			$this->session->unset_userdata($table);
			
			$fields = $this->tablemodel->getFieldsFor($table);
			
			$sessionFields = array();
			
			foreach($fields as $field) {
			
				array_push($sessionFields, $field['field']);
			
			}
			
			$this->session->set_userdata($table, $sessionFields);
		
		} else {
		
			if($this->session->userdata($table)) {
		
				//sessionFields already exists
		
				if(!in_array($fieldToAdd, $this->session->userdata($table))) {
		
					$sessionFields = $this->session->userdata($table);
			
					array_push($sessionFields, $fieldToAdd);
			
					$this->session->set_userdata($table, $sessionFields);
		
				}
		
			} else {
		
				//no fields registered with the session yet
				$sessionFields = array();
				$sessionFields[0] = $fieldToAdd;
			
				$this->session->set_userdata($table, $sessionFields);
		
			}
		
		}
			
	}
	
	
	/*
	
		ajax call
		removes columns from the data view
	
	*/
	
	public function removeField() 
	{
				
		$temp = explode(".", $_GET['field']);
		
		$table = $temp[0];
		$fieldToRemove = $temp[1];
		
		if($fieldToRemove == 'all') {//remove all fields
		
			//delete old session data
			$this->session->unset_userdata($table);
			
			$newSessionFields = array();
			
			$fields = $this->tablemodel->getFieldsFor($table);
			
			array_push($newSessionFields, $fields[0]['field']);
			
			$this->session->set_userdata($table, $newSessionFields);
					
		
		} else {//remove only single field
								
			if($this->session->userdata($table)) {
						
				//sessionFields already exists
		
				if(in_array($fieldToRemove, $this->session->userdata($table))) {
					
					$sessionFields = $this->session->userdata($table);
				
					//delete old session data
					$this->session->unset_userdata($table);
				
					$newSessionFields = array();
				
					foreach($sessionFields as $field) {
				
						if($field != $fieldToRemove) {
					
							array_push($newSessionFields, $field);
					
						}
				
					}
				
					$this->session->set_userdata($table, $newSessionFields);
				
				}
						
			}
		
		}
						
	}
	
	
	/*
		ajax call
		
		updates a single cell
	*/
	
	public function saveField($table = '', $column = '') 
	{
	
		$column = urldecode($column);
	
		$return = array();//array to send back to the browser
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $column == '' || $column == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		//make sure this user is allowed to edit fields
		if( !$this->usermodel->hasTablePermission('update', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
							
		$this->form_validation->set_rules('indexName', 'indexName', 'trim|required|xss_clean');
		
		//does this column have any custom restrictions?
		
		$columnRestrictions = $this->tablemodel->getColumnRestrictions($table, $column, 'string');
		
		if( $columnRestrictions !=  false ) {
				
			$this->form_validation->set_rules('val', 'Value', "trim|required|xss_clean|".$columnRestrictions);
		
		} else {
		
			$this->form_validation->set_rules('val', 'Value', 'trim|required|xss_clean');
		
		}
		
		$this->form_validation->set_rules('index', 'Index', 'trim|required|xss_clean');		
		
		
		if ($this->form_validation->run() == FALSE) {
		
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {
		
			//are we dealing with a primary key?
			
			$key = $this->tablemodel->getPrimaryKey($table);
			
			if( $key->name == $column && !$this->tablemodel->primaryAllowed($table, $key->name, $_POST['val']) ) {
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "You have entered a duplicate value as primary key value. Please eneter a unique value for all primary key columns";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
					
			$this->tablemodel->updateField($column, $_POST['val'], $_POST['indexName'], $_POST['index'], $table);
				
			$this->data['success_message_heading'] = "Success!";
			$this->data['success_message'] = "Your data has been saved!";
							
			$return['response_code'] = 1;
			$return['success_message'] = $this->load->view("partials/message_success", $this->data, true);
			
				
		}
		
		echo json_encode($return);
		
	}
	
	
	/*
		ajax call
		
		returns a single database record (record being a selection of cells)
	*/
	
	public function getRecord($table = '', $indexName = '', $recordID = '', $param = 'editrecord') 
	{
		
		$indexName = urldecode($indexName);
		$recordID = urldecode($recordID);
		
	
		$return = array();//data to send back the client
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $indexName == '' || $indexName == 'undefined' || $recordID == '' || $recordID == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		//make sure this user is allowed to select fields
		if( !$this->usermodel->hasTablePermission('select', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
				
		//return the record
			
		$return = array();//data to send back the client
			
		$return['response_code'] = 1;
			
		$recordArray = array();
			
		$recordArray['recordData'] = $this->dbmodel->getRecord($table, $indexName, $recordID);
		$recordArray['theTable'] = $table;
		$recordArray['indexName'] = $indexName;
		$recordArray['recordID'] = $recordID;
		
		if( $param == 'editrecord' ) {
			
			$recordArray['mode'] = 'edit';
			$return['record'] = $this->load->view('partials/record', $recordArray, true);
		
		} elseif( $param == 'viewrecord' ) {
		
			$recordArray['mode'] = 'view';
			$return['record'] = $this->load->view('partials/viewrecord', $recordArray, true);
		
		}
			
		echo json_encode($return);
		
	
	}
	
	
	/*
		ajax call
		
		updates a single record
	*/
	
	public function updateRecord($table = '', $indexName = '', $recordID = '')
	{
		
		$indexName = urldecode($indexName);
		$recordID = urldecode($recordID);
	
	
		$return = array();//array to send back to the browser
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $indexName == '' || $indexName == 'undefined' || $recordID == '' || $recordID == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//make sure this user is allowed to select fields
		if( !$this->usermodel->hasTablePermission('update', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		//grab all fields in this db
				
		$allFields = $this->tablemodel->getFieldsFK($table);;
		
		foreach($allFields as $field) {
			
			//do we have any custom restrictions?
			$columnRestrictions = $this->tablemodel->getColumnRestrictions($table, $field['field'], 'string');
			
			if( $columnRestrictions !=  false ) {
									
				if( $field['type'] == 'int' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|numeric|'.$columnRestrictions);
				
				} elseif( $field['type'] == 'varchar' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|'.$columnRestrictions);
				
				}
			
			} else {
			
				if( $field['type'] == 'int' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|numeric|max_length['.$field['max_length'].']');
				
				} elseif( $field['type'] == 'varchar' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|max_length['.$field['max_length'].']');
				
				}
			
			}
		
		}
		
		if ($this->form_validation->run() == FALSE) {
			
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {
		
			
			//primary key check
			
			$key = $this->tablemodel->getPrimaryKey($table);
			
			foreach( $allFields as $field ) {
			
				if( $field['field'] == $key->name && isset($_POST[$field['field']]) && !$this->tablemodel->primaryAllowed($table, $key->name, $_POST[$field['field']]) ) {
				
					$this->data['error_message_heading'] = "Ouch!";
					$this->data['error_message'] = "You have entered a duplicate value as primary key value. Please eneter a unique value for all primary key columns";
					
					$return['response_code'] = 2;
					
					$return['message'] = $this->load->view('partials/message_error', $this->data, true);
					
					die(json_encode($return));
				
				}
			
			}		
		
			$this->dbmodel->updateRecord($table, $indexName, $recordID, $_POST);
			
			//return success message
			$this->data['success_message_heading'] = "Hooray!";
			$this->data['success_message'] = "Congrats! Your record was saved successfully!";
						
			
		
			$return['response_code'] = 1;
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
		
		}
			
		echo json_encode($return);
		
	
	}
	
	
	/*
		ajax call
		
		created a new record for given table in given database
	*/
	
	public function newRecord($table)
	{
	
		$return = array();//array to send back to the browser
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//is this user allowed to edit columns?
		if( !$this->usermodel->hasTablePermission('insert', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//set some rules
		
		//grab all fields in this db
				
		$allFields = $this->tablemodel->getFieldsFK($table);;
		
		foreach($allFields as $field) {
		
			//do we have any custom restrictions?
			$columnRestrictions = $this->tablemodel->getColumnRestrictions($table, $field['field'], 'string');
			
			if( $columnRestrictions !=  false ) {
									
				if( $field['type'] == 'int' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|numeric|'.$columnRestrictions);
				
				} elseif( $field['type'] == 'varchar' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|'.$columnRestrictions);
				
				}
			
			} else {
			
				if( $field['type'] == 'int' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|numeric|max_length['.$field['max_length'].']');
				
				} elseif( $field['type'] == 'varchar' ) {
				
					$this->form_validation->set_rules($field['field'], $field['field'], 'trim|xss_clean|max_length['.$field['max_length'].']');
				
				}
			
			}
		
		}
		
		
		if ($this->form_validation->run() == FALSE) {
			
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {
		
		
			//all is well, let's add the record
						
			$this->dbmodel->newRecord($table, $_POST);
			
			
			//sucess message
			//return success message
			$this->data['success_message_heading'] = "Hooray!";
			$this->data['success_message'] = "Congrats! Your record was inserted successfully!";
			
			
			//return empty new record form as well
			$return['newrecordform'] = $this->load->view('partials/newrecordform', array('tableFields_'=>$allFields, 'theTable'=>$table), true);
				
			
			$return['response_code'] = 1;
			
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
		
		}
		
		
		echo json_encode($return);
	
	}
	
	
	/*
		delete a record in the given db/table
	*/
	
	public function deleteRecord($table, $recordID)
	{
		
		$recordID = urldecode($recordID);
		
	
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $recordID == '' || $recordID == 'undefined') {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
		
		//is this user allowed to update fields?
		if( !$this->usermodel->hasTablePermission('delete', $table) ) {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "You don't have permission to do this.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
				
		$this->dbmodel->deleteRecord($table, $recordID);
		
		
		
		$this->session->set_flashdata('success_message', "The record has been permanently deleted.");
		
		redirect('/db/'.$table, "refresh");
	
	}
	
	
	/*
		ajax call
		
		creates a new table
	*/
	
	public function newTable()
	{
	
		$return = array();//array to send back to the browser
		
		
		//is this user allowed to add tables?
		if( !$this->usermodel->hasDBPermission('create') ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		$this->form_validation->set_rules('tableName', 'Table name', 'trim|required|xss_clean|alpha_dash');
		
		//rules for the columns
		
		$c = 1;
		
		foreach( $_POST['columns'] as $col ) {
		
			if( $c > 1 ) {
		
				$this->form_validation->set_rules("columns[$c][columnName]", "Column $c: Column name", 'trim|required|xss_clean|alpha_dash|callback_column_check');
				$this->form_validation->set_rules("columns[$c][columnType]", "Column $c: Column type", 'trim|required|xss_clean');
			
			}
			
			$c++;
		}
		
		//rules for first column
		$this->form_validation->set_rules("columns[1][columnName]", "Column 1: Column name", 'trim|required|xss_clean|alpha_dash|callback_column_check');
		
		
		if ($this->form_validation->run() == FALSE) {
		
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {			
		
			//check to see if the table aleady exists
			
			if( $this->tablemodel->exists($_POST['tableName']) ) {
			
				//table already exists
				
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "The table name <b>".$_POST['tableName']."</b> is already taken. Please use a unqiue name.";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
			
			
			//check to make sure all the column names are unique
			
			if( !$this->tablemodel->uniqueColumns($_POST['columns']) ) {
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "All column names <b>must be unqiue</b>. Please double check your column names";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
			
		
			//create the new table
			
			
			
			$this->tablemodel->newTable($_POST);
			
			
			//return success message
			$this->data['success_message_heading'] = "Hooray!";
			$this->data['success_message'] = "Congrats! Your new table was created successfully! Click the button below to reload the page<br><a href='".site_url('db/'.$_POST['tableName'])."' class='btn btn-info btn-embossed'>reload page</a>";
							
				
			
			$return['response_code'] = 1;
			
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
		
		}
		
		echo json_encode($return);
	
	}
	
	
	/*
		custom validation method to make sure no MySQL reserved names are used for the database name
	*/
	
	public function column_check($str)
	{
	
		if ($str == 'column') {
		
			$this->form_validation->set_message('column_check', 'The %s field can not be the word "column"');
			return FALSE;
		
		} else {
			
			return TRUE;
				
		}
	
	}
	
	
	/*
		deletes table from database
	*/
	
	public function deleteTable($table)
	{
	
		$return = array();//array to send back to the browser
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined') {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
		
		//is this user allowed to delete tables?
		if( !$this->usermodel->hasDBPermission('drop') && !$this->usermodel->ownsTable($table) ) {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "You don't have permission to do this.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
						
		//any referencing tables?
		if( $this->tablemodel->getReferencedTables($table) != false ) {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "You can not delete this table right now, as it has column referenced by other tables. Please see below which tables and columns are referencing this table:<br><br><ul>";
			
			$tempArray = $this->tablemodel->getReferencedTables($table);
			
			foreach( $tempArray as $arr ) {
			
				$temp['error_message'] .= "<li><b>".$arr['table']."</b> => ".$arr['column']."</li>";
			
			}
			
			$temp['error_message'] .= "</ul><br>You will need to remove these references before you can delete this table.<br><a href='".site_url('db/'.$table)."' class='btn btn-info btn-block'><span class='fui-arrow-left'></span> Return to ".$table."</a>";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		} 
		
		
		
		$this->tablemodel->deleteTable($table);
		
		//all done, redirect back
		$this->session->set_flashdata('success_message', "The table has been permanently deleted.");
		
		redirect('/db/', "refresh");
	
	}
	
	
	/*
		retrieve cell data
	*/
	
	public function getCell($table = '', $column = '', $recordID = '')
	{
	
		
		
		$column = urldecode($column);
		$recordID = urldecode($recordID);
	
		
		$return = array();//array to send back to the browser
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $column == '' || $column == 'undefined' || $recordID == '' || $recordID == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//is this user allowed to select records?
		if( !$this->usermodel->hasTablePermission('select', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
						
		$cell = $this->dbmodel->getCell($table, $column, $recordID);
		
		$return['cell'] = $this->load->view('partials/cell', array('cell'=>$cell), true);
		
		echo json_encode($return);
	
	}
	
	/*
		updates a table
	*/
	
	public function updateTable($table = '')
	{
		
		$this->data = array();
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined') {
			
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
		//is this user allowed to select records?
		if( !$this->usermodel->hasDBPermission('drop') && !$this->usermodel->ownsTable($table) ) {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "You don't have permission to do this.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
		$this->form_validation->set_rules('tableName', 'Table name', 'trim|required|xss_clean|alpha_dash');
		
		
		if ($this->form_validation->run() == FALSE) {
		
			//no good
			$this->session->set_flashdata('error_message', "Something went wrong with the data you entered, please see below:<br>".validation_errors());
			
			redirect("/db/".$table, 'refresh');
			
		
		} else {				
			
			//check to see if the table aleady exists
				
			if( $this->tablemodel->exists($_POST['tableName']) ) {
				
				$this->session->set_flashdata('error_message', "The table name ".$_POST['tableName']." is already taken, please choose a different table name.");
				
				redirect("/db/".$table, 'refresh');
				
			}
			
			//all good, update
			
			$this->tablemodel->updateTable($table, $_POST);
			
			$this->session->set_flashdata('success_message', "The table was successfully updated.");
			
			redirect("/db/".$_POST['tableName'], 'refresh');
			
		}
			
	}
	
	
	public function uploadCsv()
	{		
	
		//return array
		$return = array();
		
		
		//some form validation
		
		$this->form_validation->set_rules('tableName', 'Table name', 'trim|required|xss_clean|alpha_dash');
		
		if ($this->form_validation->run() == FALSE) {
		
			//no good
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
			
		
		} else {		
			
			//check to make sure the table name does not exist yet
			
			if( $this->tablemodel->exists($_POST['tableName']) ) {
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "The table name must be unqiue; it appears the table name ".$_POST['tableName']." is already taken.";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
			
	
			$config['upload_path'] = './tmp/';
			$config['allowed_types'] = 'csv';

			$this->load->library('upload', $config);
			
			
			//check to see if the /tmp folder is writable
			

			if ( ! $this->upload->do_upload('thefile')) {
		
				//ouch, something's wrong!
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "Something went wrong with the file you were trying to upload: <br>".$this->upload->display_errors();
			
				$return['response_code'] = 2;
			
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
				die(json_encode($return));
			
			
			} else {
		
				//all good, we can now process the file
				
				//create the new table
				
				
				//grab the file data
				$fileData = $this->upload->data();
								
				
				$this->load->library('csvreader');
				
				//set the dilimiter
				
				//guess the delimiter by examinating the first three lines
				
				$suggestedDilimiter = $this->csvreader->guessDelimiter(base_url().'tmp/'.$fileData['file_name']);
								
				
				if( isset($_POST['separateColumns']) && $_POST['separateColumns'] != '' ) {
				
					//is the requested dilimiter different from the sniffed one?
					
					if( $suggestedDilimiter != $_POST['separateColumns'] ) {
					
						$this->data['error_message_heading'] = "Ouch!";
						$this->data['error_message'] = "It appears the value you've choses for the <b>Columns separated by</b> field does not match the delimiter detected by <b>Databased</b>. To prevent errors, we can't create the table. We suggest to leave the <b>Columns separated by</b> field empty and try again.";
						
						$return['response_code'] = 2;
						
						$return['message'] = $this->load->view('partials/message_error', $this->data, true);
						
						die(json_encode($return));
					
					} else {
				
						$dilimiter = $_POST['separateColumns'];
					
					}
				
				} else {
				
					$dilimiter = $suggestedDilimiter;
				
				}
				
				
				//set the enclosure
				if( isset($_POST['encloseColumns']) && $_POST['encloseColumns'] != '' ) {
				
					$enclosure = $_POST['encloseColumns'];
				
				} else {
				
					$enclosure = '"';
				
				}
				
				
				//check if the first rown contains the columns				
				if( isset($_POST['columns']) && $_POST['columns'] == 'yes' ) {
				
					//use the first row as column names
					
					$file = fopen(base_url()."tmp/".$fileData['file_name'],"r");
					
					$firstRow = fgetcsv($file, 1000, $dilimiter, $enclosure);										
										
					fclose($file);
					
					$this->tablemodel->createTableforCSV( $_POST['tableName'], $firstRow, $fileData, true, $dilimiter, $enclosure );
					
				
				} else {
				
					//create our own column names
					
					$file = fopen(base_url()."tmp/".$fileData['file_name'],"r");
										
					$firstRow = fgetcsv($file, 1000, $dilimiter, $enclosure);
										
					fclose($file);
					
					$cols = array();
					
					$counter = 0;
					
					foreach( $firstRow as $row ) {
					
						$cols[$counter] = "Column_".$counter;
						
						$counter++;
					
					}
					
					$this->tablemodel->createTableforCSV( $_POST['tableName'], $cols, $fileData, false, $dilimiter, $enclosure );
				
				}
				
				//remove file
				unlink($fileData['full_path']);
		
			}
			
			//return success message
			$this->data['success_message_heading'] = "Hooray!";
			$this->data['success_message'] = "Congrats! Your new table was created successfully! Click the button below to reload the page<br><a href='".site_url('db/'.$_POST['tableName'])."' class='btn btn-info btn-embossed'>reload page</a>";				
			
			$return['response_code'] = 1;
			
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
			
			die(json_encode($return));
			
		}
	
	}
	
	
	/*
		imports CSV data into an existing table
	*/
	
	public function importCsv()
	{
	
		//return array
		$return = array();
		
		
		$config['upload_path'] = './tmp/';
		$config['allowed_types'] = 'csv';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('thefile')) {
		
			//ouch, something's wrong!
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong with the file you were trying to upload: <br>".$this->upload->display_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
			
			
		} else {
		
			//grab the file data
			$fileData = $this->upload->data();
			
			$this->load->library('csvreader');
			
			$suggestedDilimiter = $this->csvreader->guessDelimiter(base_url().'tmp/'.$fileData['file_name']);
			
			
			if( isset($_POST['separateColumns']) && $_POST['separateColumns'] != '' ) {
			
				//is the requested dilimiter different from the sniffed one?
				
				if( $suggestedDilimiter != $_POST['separateColumns'] ) {
				
					$this->data['error_message_heading'] = "Ouch!";
					$this->data['error_message'] = "It appears the value you've choses for the <b>Columns separated by</b> field does not match the delimiter detected by <b>Databased</b>. To prevent errors, we can't create the table. We suggest to leave the <b>Columns separated by</b> field empty and try again.";
					
					$return['response_code'] = 2;
					
					$return['message'] = $this->load->view('partials/message_error', $this->data, true);
					
					die(json_encode($return));
				
				} else {
			
					$dilimiter = $_POST['separateColumns'];
				
				}
			
			} else {
			
				$dilimiter = $suggestedDilimiter;
			
			}
			
			
			//set the enclosure
			if( isset($_POST['encloseColumns']) && $_POST['encloseColumns'] != '' ) {
			
				$enclosure = $_POST['encloseColumns'];
			
			} else {
			
				$enclosure = '"';
			
			}			
			
			$res = $this->tablemodel->importCSV($_POST['tableName'], $fileData, $dilimiter, $enclosure);
			
			//remove file
			unlink($fileData['full_path']);
			
			if( $res ==  true ) {
				
				//success message
				$this->data['success_message_heading'] = "Hooray!";
				$this->data['success_message'] = "Congrats! Your data was imported successfully! Click the button below to reload the page<br><a href='".site_url('db/'.$_POST['tableName'])."' class='btn btn-info btn-embossed'>reload page</a>";				
				
				$return['response_code'] = 1;
				
				$return['message'] = $this->load->view('partials/message_success', $this->data, true);
				
				die(json_encode($return));
			
			} elseif( $res == false ) {
				
				//error message
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "We can not import your data right now. This is most likely due to your CSV file being wrongly formatted (the number of fields might not match the numnber of columns in your table) or it could be that the primary key field contains values already present in your Databased table. Please review your CSV file and try again.";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
	
		}
	
	}
				
}

/* End of file db.php */
/* Location: ./application/controllers/db.php */