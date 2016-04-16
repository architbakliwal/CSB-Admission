<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Columns extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->library('ion_auth');
		$this->load->model('tablemodel');
		$this->load->model('usermodel');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		if(!$this->ion_auth->logged_in()) {
			
			redirect('/login');
		
		}
		
		$this->data['tables'] = $this->tablemodel->listAll(false);
		
	}
	
	
	/*
		ajax call
		
		return the details for a given table column
	*/
	
	public function getDetails($table = '', $column = '')
	{
	
		$column = urldecode($column);		
		
		$return = array();//array to send back to the browser
	
		//is this user allowed to edit columns?
		if( !$this->usermodel->hasTablePermission('alter', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $column == '' || $column == 'undefined') {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
				
		
		$return['response_code'] = 1;
			
		//get the column details
		
		$columnStuff = array();
		
		$columnStuff['columnDetails'] = $this->tablemodel->getColumnDetails($table, $column);
		
		$columnStuff['tableFields'] = $this->tablemodel->getFieldsFor($table);
		
		$columnStuff['tables'] = $this->tablemodel->tablesPlusColumns();
		
		//check wether or not this table has a primary key set
		
		if( $this->tablemodel->getPrimaryKey($table) ) {
		
			$columnStuff['hasPrimary'] = true;
		
		}
				
		$columnStuff['table'] = $table;
		
		$columnStuff['table_engine'] = $this->tablemodel->getEngine($table);
		
		$columnStuff['column'] = $column;
		
		$return['column'] = $this->load->view('partials/column_edit', $columnStuff, true);
		
		$columnRestrictions = $this->tablemodel->getColumnRestrictions($table, $column);
				
		$return['columnRestrictions'] = $this->load->view('partials/columnrestrictions', array('columnRestrictions'=>$columnRestrictions), true);
				
		$return['columnName'] = $column;
						
		echo json_encode($return);
	
	}
	
	
	/*
		ajax call
		
		updates a columns details
	*/
	
	public function update($table = '')
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
		if( !$this->usermodel->hasTablePermission('alter', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
	
	
		$this->form_validation->set_rules('columnName', 'Column name', 'required|trim|xss_clean|alpha_dash|callback_column_check');
		$this->form_validation->set_rules('columnType', 'Column type', 'required|trim|xss_clean');
		$this->form_validation->set_rules('columnOffset', 'Column position', 'required|trim|xss_clean');
		
		if ($this->form_validation->run() == FALSE) {
			
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {
					
			//check to make sure the new columns name is unique
			
			if( $_POST['columnName'] != $_POST['columnName_old'] && $this->tablemodel->getColumnDetails($table, $_POST['columnName']) ) {//returns false if column does not exist
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "Please make sure you choose a unique column name. Thanks!";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
			
			//if this column is to be used as a relation, we'll need to make sure the column type matches with the primary key type of the referenced table
			
			if( isset($_POST['connectTo']) && $_POST['connectTo'] != '' ) {
			
				$temp = explode(".", $_POST['connectTo']);
				
				$pkey = $this->tablemodel->getPrimaryKey($table)->name;
				
				$pkeyData = $this->tablemodel->getColumnDetails($table, $pkey);
				
				//make sure this is correct
				$_POST['columnType'] = strtolower($pkeyData['type']);
				
			
			} 
			
			//print_r($_POST['restrictions']);
			
			//die('mattijs');
			
			
			//all good, update the column
						
			$columnDetails = $this->tablemodel->updateColumn($table, $_POST['columnName_old'], $_POST);
			
			//column form/details
			
			$columnStuff = array();
			
			$columnStuff['columnDetails'] = $columnDetails;
			
			$columnStuff['tableFields'] = $this->tablemodel->getFieldsFor($table);
			
			$columnStuff['tables'] = $this->tablemodel->tablesPlusColumns();
			
			//check wether or not this table has a primary key set
			
			if( $this->tablemodel->getPrimaryKey($table) ) {
			
				$columnStuff['hasPrimary'] = true;
			
			}
			
			$columnStuff['table'] = $table;
			$columnStuff['table_engine'] = $this->tablemodel->getEngine($table);
			$columnStuff['column'] = $columnDetails['name'];
			
			//the column from
			$return['column'] = $this->load->view('partials/column_edit', $columnStuff, true);
			
			//restrictions
			$columnRestrictions = $this->tablemodel->getColumnRestrictions($table, $columnDetails['name']);
					
			$return['columnRestrictions'] = $this->load->view('partials/columnrestrictions', array('columnRestrictions'=>$columnRestrictions), true);
			
			$return['columnName'] = $columnDetails['name'];
			
			
			//the updates column row to update the table with
			$cData = array();
			$cData['theTable'] = $table;
			$cData['tableFields'] = $this->tablemodel->getFieldsFor($table);
			
			$return['columns'] = $this->load->view("partials/column_table", $cData, true);
			
			//success message
			$this->data['success_message_heading'] = "Hiyaa!";
			$this->data['success_message'] = "The column details have been updated.";
			
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
			
			$return['response_code'] = 1;
				
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
		deletes an entire column from the given table in the given database
	*/
	
	public function delete($table = '', $column = '')
	{
		
		$column = urldecode($column);
	
		
		//make sure we've got all the required db details
		if($table == '' || $table == 'undefined' || $column == '' || $column == 'undefined') {
		
			$temp = array();
			$temp['error_message_heading'] = "Ouch!";
			$temp['error_message'] = "Some database connection details are missing. Please reload the page and try again.";
						
			die( $this->load->view('shared/alert', array('data'=>$temp), true) );
		
		}
		
		//is this user allowed to edit columns?
		if( !$this->usermodel->hasTablePermission('alter', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
	
		//at some point we'd like to implement backing up a column before deleting it
					
		$this->tablemodel->deleteColumn($table, $column);
			
		$this->session->set_flashdata('success_message', 'The column was successfully deleted from <b>'.$table."</b>");
			
		redirect("/db/".$table, "refresh");
		
	
	}
	
	
	/*
		ajax call
		
		creates a new column
	*/
	
	public function addColumn($table = '')
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
		
		
		//is this user allowed to mess around with columns?
		if( !$this->usermodel->hasTablePermission('alter', $table) ) {
		
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "You don't have permission to do this.";
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
			
			die(json_encode($return));
		
		}
		
		
		//now validate the form data
		$this->form_validation->set_rules('columnName', 'Column name', 'required|trim|xss_clean|alpha_dash');
		$this->form_validation->set_rules('columnType', 'Column type', 'required|trim|xss_clean');
		$this->form_validation->set_rules('columnOffset', 'Column position', 'required|trim|xss_clean');
		
		
		if ($this->form_validation->run() == FALSE) {
			
			//something ain't right
			
			$this->data['error_message_heading'] = "Ouch!";
			$this->data['error_message'] = "Something went wrong when trying to save your data, please see the details below:<br>".validation_errors();
			
			$return['response_code'] = 2;
			
			$return['message'] = $this->load->view('partials/message_error', $this->data, true);
		
		} else {
				
			//check to make sure the new columns name is unique
			
			if( $this->tablemodel->getColumnDetails($table, $_POST['columnName']) ) {//returns false if column does not exist
			
				$this->data['error_message_heading'] = "Ouch!";
				$this->data['error_message'] = "Please make sure you choose a unique column name. Thanks!";
				
				$return['response_code'] = 2;
				
				$return['message'] = $this->load->view('partials/message_error', $this->data, true);
				
				die(json_encode($return));
			
			}
			
			//if this column is to be used as a relation, we'll need to make sure the column type matches with the primary key type of the referenced table
			
			if( isset($_POST['connectTo']) && $_POST['connectTo'] != '' ) {
			
				$temp = explode(".", $_POST['connectTo']);
				
				$pkey = $this->tablemodel->getPrimaryKey($temp[0])->name;
												
				$pkeyData = $this->tablemodel->getColumnDetails($temp[0], $pkey);
				
				//make sure this is correct
				$_POST['columnType'] = strtolower($pkeyData['type']);				
			
			} 
			
			
			//all good, update the column
			
			//print_r($_POST['restrictions']);
									
			$this->tablemodel->newColumn($table, $_POST);
			
			//success message
			$this->data['success_message_heading'] = "Hiyaa!";
			$this->data['success_message'] = 'The column has been created. To see your column in the data view, you will need to click the button below to reload the page:<br><a class="btn btn-info btn-embossed" href="'.site_url('db/'.$table).'">reload page</a>';
			
			$return['message'] = $this->load->view('partials/message_success', $this->data, true);
			
			$return['response_code'] = 1;
				
		}
		
		
		echo json_encode($return);
		
	}
	
}

/* End of file columns.php */
/* Location: ./application/controllers/columns.php */