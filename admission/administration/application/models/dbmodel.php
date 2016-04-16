<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DbModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->model('tablemodel');
        $this->load->model('usermodel');
        
    }
    
    
    /*
    	returns data for a single cell
    */
    
    public function getCell($table, $column, $recordID)
    {
    
    	$cellArray = array();
    	
    
    	//get the primary key for this table
    	    	
    	$primaryKey = $this->tablemodel->getPrimaryKey($table)->name;
    	
    	
    	//value
    	
    	$cellArray['column'] = $column;
    	
    	$tempp = $this->db->from($table)->where($primaryKey, $recordID)->get()->result();
    	
    	$cellArray['value'] = $tempp[0]->$column;
    
    	
    	//max_length and type
    	
    	$columns = $this->db->field_data($table);
    	
    	foreach( $columns as $col ) {
    	
    		if( $col->name == $column ) {
    		
    			$cellArray['type'] = $col->type;
    			$cellArray['max_length'] = $col->max_length;
    		
    		}
    	
    	}
    	
    	
    	//possible FK data
    	if( $this->tablemodel->hasFK($table, $column) ) {
    	    		    			
    		//grab the relation from the db
    		
    		$query = $this->db->from('dbapp_relations')->where('dbapp_relations_source_table', $table)->where('dbapp_relations_source_field', $column)->get();
    		
    		if( $query->num_rows() ) {
    			
    			$relation = $query->row();
    		
    			$cellArray['reference_table'] = $relation->dbapp_relations_reference_table;
    			$cellArray['reference_table_key'] = $relation->dbapp_relations_reference_field;
    			$cellArray['use_column'] = $relation->dbapp_relations_reference_use;
    		    			
    			//grab the referenced data
    			$referencedData = $this->db->select($cellArray['reference_table_key'])->select($cellArray['use_column'])->from($cellArray['reference_table'])->order_by($cellArray['use_column'])->get()->result_array();
    		
    		
    			$cellArray['referenced_data'] = $referencedData;
    		
    		}
    		    	
    	}
    	
    	//get additional columndata
    	$cellArray['additional_data'] = $this->tablemodel->getColumnDetails($table, $column);
    	
    	return $cellArray;
    	
    }
    
    
    /*
    	returns a single record
    */
    
    public function getRecord($table, $indexName, $recordID) 
    {
    
    	$tempp = $this->db->from($table)->where($indexName, urldecode($recordID))->get()->result_array();
    
    	$record = $tempp[0];
    	
    	$return = array();
    	    	    	
    	foreach( $record as $col=>$val ) {
    	
    		$temp = array();
    		
    		$temp['val'] = $val;
    	
    		//find possible foreign keys
    		if( $this->tablemodel->hasFK($table, $col) ) {
    		    			    			
    			//grab the relation from the db
    			
    			$relation = $this->db->from('dbapp_relations')->where('dbapp_relations_source_table', $table)->where('dbapp_relations_source_field', $col)->get()->row();
    			
    			if( $relation ) {
    			
    				$temp['reference_table'] = $relation->dbapp_relations_reference_table;
    				$temp['reference_table_key'] = $relation->dbapp_relations_reference_field;
    				$temp['use_column'] = $relation->dbapp_relations_reference_use;
    			    			
    				//grab the referenced data
    				$referencedData = $this->db->select($temp['reference_table_key'])->select($temp['use_column'])->from($temp['reference_table'])->order_by($temp['use_column'])->get()->result_array();
    			
    			
    				$temp['referenced_data'] = $referencedData;
    			
    			}		
    		
    		}
    		
    		//get additional columndata
    		$temp['additional_data'] = $this->tablemodel->getColumnDetails($table, $col);
    		
    		$return[$col] = $temp;
    		    		    	
    	}
    	    	
    	return $return;
    
    }
    
    
    /*
    	updates a single record
    */
    
    public function updateRecord($table, $indexName, $recordID, $data)
    {
    	
    	$this->db->where($indexName, $recordID);
    	$this->db->update($table, $data);
    	    
    }
    
    
    /*
    	creates a new record in the given db/table
    */
    
    public function newRecord($table, $data)
    {
    
    	//remove the empties
    	
    	foreach( $data as $key=>$value ) {
    	
    		if( $value == '' ) {
    			
    			//unset( $data[$key] );
    		
    		}
    	
    	}    	
    
    	$this->db->insert($table, $data);
    
    	
    	//update the ownership table	
    	$newRecordID = $this->db->insert_id();
    	
    	$user = $this->ion_auth->user()->row();
    	
    	$data = array(
    		'dbapp_users_records_userid' => $user->id,
    	   	'dbapp_users_records_table' => $table,
    	   	'dbapp_users_records_recordid' => $newRecordID
    	);
    	
    	$this->db->insert('dbapp_users_records', $data); 
    
    }
    
    
    /*
    	deletes a record from the given table in the given db
    */
    
    public function deleteRecord($table, $recordID)
    {
    
    	//get the primary key for this table
    	    	    	
    	$field = $this->tablemodel->getPrimaryKey($table);
    	
    	
    	//if there's any foreign keys pointing to this value, we'll need to destroy 
    	
    	$config['hostname'] = $this->db->hostname;
    	$config['username'] = $this->db->username;
    	$config['password'] = $this->db->password;
    	$config['database'] = "information_schema";
    	$config['dbdriver'] = 'mysql';
    	$config['dbprefix'] = '';
    	$config['pconnect'] = FALSE;
    	$config['db_debug'] = TRUE;
    	$config['cache_on'] = FALSE;
    	$config['cachedir'] = '';
    	$config['char_set'] = 'utf8';
    	$config['dbcollat'] = 'utf8_general_ci';
    	$config['swap_pre'] = '';
    	$config['autoinit'] = TRUE;
    	$config['stricton'] = FALSE;
    	
    	if( $this->db->port != '' ) {
    	
    		$config['port'] = $this->db->port;
    	
    	}
    	
    	$this->theDB2 = $this->load->database($config, TRUE);
    	
    	$query = $this->theDB2->query("SELECT *
    	FROM
    	  KEY_COLUMN_USAGE
    	WHERE
    	  REFERENCED_TABLE_NAME = '$table'
    	  AND REFERENCED_COLUMN_NAME = '".$field->name."'
    	  AND TABLE_SCHEMA = '".$this->db->database."';");
    	
    	foreach( $query->result() as $row ) {
    	
    		//this ought to be recursive
    		
    		$field2 = $this->tablemodel->getPrimaryKey($row->TABLE_NAME);
    		
    		$query2 = $this->theDB2->query("SELECT *
    		FROM
    		  KEY_COLUMN_USAGE
    		WHERE
    		  REFERENCED_TABLE_NAME = '".$row->TABLE_NAME."'
    		  AND REFERENCED_COLUMN_NAME = '".$field2->name."'
    		  AND TABLE_SCHEMA = '".$this->db->database."';");
    		      		    		  
    		foreach( $query2->result() as $row2 ) {
    		
    			$referencingTable = $row2->TABLE_NAME;
    			$referencingColumn = $row2->COLUMN_NAME;
    			
    			//get referencing ID's
    			
    			$q = $this->db->from($row->TABLE_NAME)->where($row->COLUMN_NAME, $recordID)->get();
    			
    			foreach( $q->result_array() as $r ) {
    			
    				$this->db->where($referencingColumn, $r[$referencingColumn]);
    				$this->db->delete($referencingTable);
    			
    			}
    			    		
    		}
    		    	    		
    		$this->db->where($row->COLUMN_NAME, $recordID);
    		$this->db->delete($row->TABLE_NAME); 
    	
    	}
    	    	
    	/*
    	$relations = $this->db->from('dbapp_relations')->where('dbapp_relations_database', $db)->where('dbapp_relations_reference_table', $table)->where('dbapp_relations_reference_field', $field->name)->get();
    	
    	
    	if( $relations->num_rows() > 0 ) {
    	
    		//we've got an FK, double check
    		if( $this->tablemodel->hasFK( $relations->row()->dbapp_relations_source_table, $relations->row()->dbapp_relations_source_field ) ) {
    		
    			//we can't have any referencing values pointing this the record to be deleted, do we have any?
    			
    			
    			$query = $this->theDB->from($relations->row()->dbapp_relations_source_table)->where($relations->row()->dbapp_relations_source_field, $recordID)->get();
    			
    			//die( $this->theDB->last_query() );
    			    			
    			if( $query->num_rows() > 0 ) {
    			    			
    				//ok, we have some records with the value to be deleted, we'll need to fix that up
    				
    				//get the default value for this problem records
    				
    				$q = $this->theDB->query("SHOW FULL COLUMNS FROM `".$relations->row()->dbapp_relations_source_table."`");
    				
    				foreach( $q->result() as $row ) {
    				
    					if( $row->Field == $relations->row()->dbapp_relations_source_field ) {
    					
    						$default = $row->Default;
    					
    					}
    				
    				}
    				
    				//we'll need to make sure the default for this column is a valid ID for the referenced table
    				
    				$q = $this->theDB->from($relations->row()->dbapp_relations_reference_table)->where($relations->row()->dbapp_relations_reference_field, $default)->get();
    				    				    				
    				if( $q->num_rows() > 0 ) {
    					
    					//this value can be used!
    					
    					$data = array(
    						$relations->row()->dbapp_relations_source_field => $default
    					);
    				
    				} else {
    				
    					//we cant use the default value, so we'll go for the next best thing
    					    					
    					$val = $this->tablemodel->getKeyValue($relations->row()->dbapp_relations_reference_table, $recordID);
    					
    					$data = array(
    						$relations->row()->dbapp_relations_source_field => $val
    					);
    					    					    					    				
    				}
    				
    				$this->theDB->where($relations->row()->dbapp_relations_source_field, $recordID);
    				$this->theDB->update($relations->row()->dbapp_relations_source_table, $data);
    				    			
    			}
    		
    		}
    	
    	}
    	*/
    	
    	//destroy possible FKs
    	$this->tablemodel->destroyForeignKey($table, $field->name);
    	
    
    	$this->db->where($field->name, $recordID);
    	$this->db->delete($table);
    	
    	
    	//delete from dbapp_users_records
    	$this->db->where("dbapp_users_records_table", $table);
    	$this->db->where("dbapp_users_records_recordid", $recordID);
    	$this->db->delete("dbapp_users_records");
    	
    	
    	//delete from dbapp_relations
    
    }
           
}