<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class TableModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        $this->load->library('session');
        $this->load->library('encrypt');
        $this->load->library('ion_auth');
        $this->load->model('usermodel');
        $this->load->model('rolemodel');
        
        if(!$this->ion_auth->logged_in()) {
        	
        	redirect('/login');
        
        }
    }
    
    
    /*
    	lists all tables within a database
    */
    
    public function listAll() 
   	{
        
    	$tables = $this->db->list_tables();
    	    	    		
    	sort($tables);
    	    	
    	$tables_new = array();
    	    	
    	foreach ($tables as $table)
    	{
    	
    		
    	   	    	   	
    	   	//exlclude dbapp tables
    	   	if (strpos($table,'dbapp') === false && $this->usermodel->hasTablePermission("select", $table)) {
    	   	    $temp = array();
    	   	    $temp['table'] = $table;
    	   	        	   	    
    	   	   	array_push($tables_new, $temp); 
    	  	}
    	   	
    	}
    	    	    	    	    	
    	$this->db->close();
    	    	
    	return $tables_new;
    
    }
    
    
    /*
    	returns all tables given a database name
    */
    
    public function listAllFor() 
    {
    
    	//connect to $db database
    	
    	//manual dynamic database connection
    	
    	$config = array();
    	
    	$tempp = $this->db->from('dbapp_databases')->get()->result();
    	
    	$config['hostname'] = $this->db->hostname;
    		
    	
    	if( $this->ion_auth->is_admin() ) {//for admin/root access
    		
    		$config['username'] =  $this->db->username;
    		$config['password'] =  $this->db->password;
    		
    	} else {//regular user access
    	
    		$decrypted_pass = $this->encrypt->decode($this->ion_auth->user()->row()->mysql_pw);
    		
    		$config['username'] = $this->ion_auth->user()->row()->mysql_user;
    		$config['password'] = trim($decrypted_pass);
    		
    	}
    		
    	$config['database'] = $db;
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
    	
    	$this->db = $this->load->database($config, TRUE);
    	
    	$tables = $this->db->list_tables();
    	
    	$this->db->close();
    	
    	return $tables;
    
    }
    
    
    /*
    	list all tables plus columns in array
    */
    
    public function tablesPlusColumns()
    {
    
    	$tables = $this->db->list_tables();
    	
    	$all = array();
    	
    	foreach ($tables as $table) {
    	    	
    		//only do this table if the user has access to it
    		
    		if( $this->usermodel->hasTablePermission('select', $table) && strpos($table, 'dbapp') === false ) {
    		    	
    			$tableArray = array();
    	    	
    	   		$fields = $this->db->field_data($table);
    	   	
    	   		foreach ($fields as $field) {
    	   	    	   		
    	   			$fieldArray = array();
    	   		
    	   	 	 	$fieldArray['field'] = $field->name;
    	   	   		$fieldArray['type'] = $field->type;
    	   	   		$fieldArray['max_length'] = $field->max_length;
    	   	   		$fieldArray['primary_key'] = $field->primary_key;
    	   	   	
    	   	   		array_push($tableArray, $fieldArray);
    	   		}
    	   	
    	   		$all[$table] = $tableArray;
    	   	
    	   	}
    	
    	}
    	
    	return $all;
    
    }
    
    
    /*
    	returns all fields in a given table
    */
    
    public function getFieldsFor($table) 
    {
        
    	$fields = $this->db->field_data($table);
    	
    	$return = array();
    	
    	foreach($fields as $field) {
    	
    		$temp = array();
    		$temp['field'] = $field->name;
    		$temp['type'] = $field->type;
    		$temp['max_length'] = $field->max_length;
    		
    		
    		$indexation = $this->db->query("SHOW KEYS FROM `$table`")->result();
    		
    		foreach($indexation as $index) {
    		
    			if($index->Key_name == "PRIMARY" && $index->Column_name == $field->name) {
    			
    				$temp['index'] = 'primary';
    				
    				break;
    			
    			} elseif($index->Column_name == $field->name && $index->Non_unique == 0) {
    			
    				$temp['index'] = 'unique';
    				
    				break;
    			
    			} elseif($index->Column_name == $field->name && $index->Non_unique == 1) {
    			
    				$temp['index'] = 'index';
    				
    				break;
    			
    			} 
    		
    		}
    		
    		if( !isset($temp['index']) ) {
    			
    			$temp['index'] = 'none';
    		
    		}
    		
    		
    		array_push($return, $temp);
    	
    	}
    	
    	$this->db->close();
    	    	
    	return $return;
    
    }
    
    
    /*
    	returns all fields incl foreign key data
    */
    
    public function getFieldsFK($table)
    {
    	
    	$columns = $this->db->field_data($table);
    	
    	$return = array();
    	    	
    	foreach($columns as $col) {
    	
    		$temp = array();
    		$temp['field'] = $col->name;
    		$temp['type'] = $col->type;
    		$temp['max_length'] = $col->max_length;	
    		
    		//grab the relation from the db
    		
    		if( $this->tablemodel->hasFK($table, $col->name) ) {
    		    		    		
    			$relation = $this->db->from('dbapp_relations')->where('dbapp_relations_source_table', $table)->where('dbapp_relations_source_field', $col->name)->get()->row();
    			
    			if( $relation ) {
    			    		    		
    				$temp['reference_table'] = $relation->dbapp_relations_reference_table;
    				$temp['reference_table_key'] = $relation->dbapp_relations_reference_field;
    				$temp['use_column'] = $relation->dbapp_relations_reference_use;
    		    			
    				//grab the referenced data
    				$referencedData = $this->db->select($temp['reference_table_key'])->select($temp['use_column'])->from($temp['reference_table'])->order_by($temp['use_column'])->get()->result_array();
    		    		
    				$temp['referenced_data'] = $referencedData;
    			
    			}
    		
    		}
    		
    		$temp['additional_data'] = $this->getColumnDetails($table, $col->name);
    		
    		
    		array_push($return, $temp);
    	
    	}
    	
    	$this->db->close();
    	    	
    	return $return;
    
    }
    
    
    /*
    	returns the number of fields in given table
    */
    
    public function nrOfFields($table)
    {
    
    	$query = $this->db->get($table);
    
    	return $query->num_rows();
    	    
    }
    
    
    /*
    	updates a record in a database
    */
    
    public function updateField($field, $value, $indexName, $index, $table) 
    {
    
    	//did the value actually change? If not, no action is needed
    	
    	$tempp = $this->db->from($table)->select($field)->where($indexName, $index)->get()->result_array();
    	
    	if($value != $tempp[0][$field]) {
    
    		$data = array(
    	   		$field => $value
    		);
    	
    		$this->db->where($indexName, $index);
    		$this->db->update($table, $data);
    	
    		$this->db->close();
    	
    	}
    
    }
    
    
    /*
    	returns the primary key for a given table
    */
    
    public function getPrimaryKey($table) 
    {
    
    	$fields = $this->db->field_data($table);
    	
    	$return = array();
    	
    	foreach($fields as $field) {
    	
    		if($field->primary_key == 1) {
    		
    			return $field;
    		
    		}
    	}
    	    	
    	return false;
    
    }
    
    
    /*
    	checks if value for primary key already exists
    */
    
    public function primaryAllowed($table, $primaryKey, $val)
    {
    
    	$query = $this->db->from($table)->where($primaryKey, $val)->get();
    	
    	if( $query->num_rows() > 0 ) {
    	
    		return false;
    	
    	} else {
    	
    		return true;
    	
    	}
    
    }
    
    
    /*
    	returns a valid value for the primary key of the table
    */
    
    public function getKeyValue($table, $not = '')
    {
    	
    	//get the primary key
    	
    	$tempp = $this->getPrimaryKey($table);
    	
    	$keyName = $tempp->name;
    	
    	if( $not != '' ) {
    	
    		//exclude $not
    		
    		foreach( $this->db->get($table)->result() as $row ) {
    		
    			if( $row->$keyName != $not ) {
    			
    				return $row->$keyName;
    			
    			}
    		
    		}
    	
    	} else {
    	
    		$tempp = $this->db->get($table)->result();
    
    		$row = $tempp[0];
    		return $row->$keyName;
    	
    	}
    
    }
    
    
    
    /*
    	returns foreign key for column or false if none exists
    */
    
    public function getForeignKey($table, $column)
    {
    
    	$query = $this->db->query("select concat(table_name, '.', column_name) as 'foreign key',  
    	    concat(referenced_table_name, '.', referenced_column_name) as 'references', CONSTRAINT_NAME as constraint_name from information_schema.key_column_usage where
    	    referenced_table_name is not null && table_name = '$table' && column_name = '$column' && constraint_schema = '".$this->db->database."' && table_schema = '".$this->db->database."'");
    	
    
    	if( $query->num_rows() > 0 ) {
    	
    		$tempp = $query->result();
    	
    		$res = $tempp[0];
    	
    		$temp = array();
    		$temp['foreign_key'] = $res->references;
    		$temp['constraint_name'] = $res->constraint_name;
    		
    		//get some other details
    		
    		$query = $this->db->from('dbapp_relations')->where('dbapp_relations_source_table', $table)->where('dbapp_relations_source_field', $column)->get();
    		
    		//echo $this->db->last_query();
    		
    		if( $query->num_rows() > 0 ) {
    		
    			$tempp = $query->result();
    		
    			$res = $tempp[0];
    			
    			$temp['referenced_table'] = $res->dbapp_relations_reference_table;
    			$temp['referenced_field'] = $res->dbapp_relations_reference_field;
    			$temp['use_column'] = $res->dbapp_relations_reference_use;
    		
    		}
    		
    		//die("array");
    		    			
    		return $temp;
    	
    	} else {
    	
    		//die("false");
    	
    		return false;
    	
    	}
    
    }
    
    
    /*
    	checks wether a foreign key is set for this db/column
    */
    
    public function hasFK($table, $column)
    {
    
    	/*echo "select concat(table_name, '.', column_name) as 'foreign key',  
    		    concat(referenced_table_name, '.', referenced_column_name) as 'references', CONSTRAINT_NAME as constraint_name from information_schema.key_column_usage where
    		    table_name = '$table' && column_name = '$column' && constraint_schema = '".$this->db->database."' && table_schema = '".$this->db->database."'";
    		    
    	die('');*/
    
    	$query = $this->db->query("select concat(table_name, '.', column_name) as 'foreign key',  
    		    concat(referenced_table_name, '.', referenced_column_name) as 'references', CONSTRAINT_NAME as constraint_name from information_schema.key_column_usage where
    		    table_name = '$table' && column_name = '$column' && constraint_schema = '".$this->db->database."' && table_schema = '".$this->db->database."'");
    		    
    	//die( $this->db->last_query() );
    	
    	if( $query->num_rows() > 0 ) {
    		
    		return true;
    		
    	} else {
    	    		
    		return false;
    		
    	}
    
    }
    
    
    /*
    	returns an array of tables referencing the given table
    */
    
    public function getReferencingTables($table)
    {
    	
    	$query = $this->db->query("select REFERENCED_TABLE_NAME from information_schema.key_column_usage where
    	    referenced_table_name is not null && table_name = '$table' && table_schema = '".$this->db->database."'");
    	    
    	        	    
		if( $query->num_rows() > 0 ) {
		
			$return = array();
			
			foreach( $query->result() as $row ) {
			
				array_push($return, $row->REFERENCED_TABLE_NAME);
			
			}
						
			return $return;
		
		} else {
		
			return false;
		
		}
    
    }
    
    
    
    /*
    	returns possible referenced tables + columns
    */
    
    public function getReferencedTables($table)
    {
    
    	$query = $this->db->query("select * from information_schema.key_column_usage where
    	    referenced_table_name is not null && referenced_table_name = '$table' && table_schema = '".$this->db->database."'");
    	    
    	
    	
    	if( $query->num_rows() > 0 ) {
    	
    		$return = array();
    		
    		foreach( $query->result() as $row ) {
    		
    			$temp = array();
    			
    			$temp['table'] = $row->TABLE_NAME;
    			$temp['column'] = $row->COLUMN_NAME;
    		
    			array_push($return, $temp);
    		
    		}
    					
    		return $return;
    	
    	} else {
    	
    		return false;
    	
    	}
    
    }
    
    
    /*
    	takes a source table/column and referenced table and makes sure a foreign key can be setup
    */
    
    public function fixForForeignKey($sourceTable, $sourceColumn, $referencedTable)
    {
    	    	
    	$sourcedTablePrimaryKey = $this->getPrimaryKey($sourceTable)->name;
    	$referencedTablePrimaryKey = $this->getPrimaryKey($referencedTable)->name;
    
    	$query = $this->db->query("select `$sourcedTablePrimaryKey` from `$sourceTable` left join `$referencedTable` on `$sourceTable`.`$sourceColumn` = `$referencedTable`.`$referencedTablePrimaryKey` where `$referencedTable`.`$referencedTablePrimaryKey` is null;");
    	
    	//update
    	
    	foreach( $query->result() as $row ) {
    	
    		$ID = $row->$sourcedTablePrimaryKey;
    		
    		$data = array(
    			$sourceColumn => $this->getKeyValue($referencedTable)
    		);
    		
    		$this->db->where($sourcedTablePrimaryKey, $ID);
    		$this->db->update($sourceTable, $data); 
    	
    	}
    
    }
    
    
    
    /*
    	removes a foreign key if it exists
    */
    
    public function destroyForeignKey($table, $column)
    {
    
    	$fk = $this->getForeignKey($table, $column);
    	
    	if( $fk ) {
    	
    		$this->db->query("alter table `$table` drop foreign key ".$fk['constraint_name']);
    		
    		//die($this->db->last_query());
    		
    		//delete from dbapp_relations
    		
    		$this->db->where('dbapp_relations_source_table', $table);
    		$this->db->where('dbapp_relations_source_field', $column);
    		$this->db->delete('dbapp_relations'); 
    	
    	}
    
    }
    
    
    /*
    	returns an array with column restrictions or false if non-existent
    */
    
    public function getColumnRestrictions($table, $column, $type = 'array')
    {
    
    	$query = $this->db->from('dbapp_columnrestrictions')->where('dbapp_columnrestrictions_table', $table)->where('dbapp_columnrestrictions_column', $column)->get();
    	
    	if( $query->num_rows() > 0 ) {
    	
    		if( $type == 'array' ) {
    		
    			$temp = $query->result();
    	
    			$restrictionString = $temp[0]->dbapp_columnrestrictions_restrictions;
    	
    			$restrictions = explode("|", $restrictionString);
    	
    			return $restrictions;
    		
    		} else {
    		
    			$temp = $query->result();
    			
    			return $temp[0]->dbapp_columnrestrictions_restrictions;
    		
    		}
    	
    	} else {
    	
    		return false;
    	
    	}
    
    }
    
    
    /*
    	returns details for a given column
    */
    
    public function getColumnDetails($table, $column)
    {
        
    	$fields = $this->db->field_data($table);
    	
    	$columnDetails = array();//new array to contain the column details
    	
    	
    	//default data provided by codeigniter
    	foreach ($fields as $field) {
    	
    		if($field->name == $column) {
    	
    	   		$columnDetails['name'] = $field->name;
    	   		$columnDetails['type'] = $field->type;
    	   		$columnDetails['max_length'] = $field->max_length;
    	   		$columnDetails['primary_key'] = $field->primary_key;
    	   
    	   }
    	
    	}
    	
    	//does the column exist?
    	
    	if( !isset($columnDetails['name']) ) {
    	
    		return false;
    	
    	}
    	
    	
    	//grab the default value
    	
    	$tempp = $this->db->query("SELECT COLUMN_DEFAULT FROM information_schema.columns WHERE TABLE_NAME = '$table' AND COLUMN_NAME = '$column' AND TABLE_SCHEMA = '".$this->db->database."'")->result();
    	
    	$columnDetails['default'] = $tempp[0]->COLUMN_DEFAULT;
    	
    	
    	//index?
    	
    	$indexation = $this->db->query("SHOW KEYS FROM `$table`")->result();
    	
    	foreach($indexation as $index) {
    	
    		if($index->Key_name == "PRIMARY" && $index->Column_name == $column) {
    		
    			$columnDetails['index'] = 'primary';
    			
    			//check if the column has auto_increment set
    			
    			$query = $this->db->query("SELECT *
    			FROM INFORMATION_SCHEMA.COLUMNS
    			WHERE TABLE_NAME = '$table'
    			    AND COLUMN_NAME = '$column'
    			    AND TABLE_SCHEMA = '".$this->db->database."'
    			    AND DATA_TYPE = 'int'
    			    AND COLUMN_DEFAULT IS NULL
    			    AND IS_NULLABLE = 'NO'
    			    AND EXTRA like '%auto_increment%'");
    			    
    			 if( $query->num_rows() > 0 ) {
    			 
    			 	$columnDetails['auto_increment'] = '';
    			 
    			 }
    			
    			break;
    		
    		} elseif($index->Column_name == $column && $index->Non_unique == 0) {
    		
    			$columnDetails['index'] = 'unique';
    			
    			break;
    		
    		} elseif($index->Column_name == $column && $index->Non_unique == 1) {
    		
    			$columnDetails['index'] = 'index';
    			
    			break;
    		
    		} 
    	
    	}
    	
    	if( !isset($columnDetails['index']) ) {
    		
    		$columnDetails['index'] = 'none';
    	
    	}
    	
    	//foreign keys?
    	if( $this->getForeignKey($table, $column) ) {
    	
    		$columnDetails['foreign_key'] = $this->getForeignKey($table, $column);
    	
    	}
    	
    	
    	//is this an option column?
    	
    	$query = $this->db->from('dbapp_columnselect')->where('dbapp_columnselect_table', $table)->where('dbapp_columnselect_column', $column)->get();
    	
    	if( $query->num_rows() > 0 ) {
    	
    		$temp = $query->result();
    	
    		$columnDetails['select'] = $temp[0]->dbapp_columnselect_values;
    	
    	}
    	
    	
    	//finally, the column offset
    	
    	$allColumns = $this->db->list_fields($table);
    	
    	$c = 0;
    	
    	foreach($allColumns as $field) {
    	
    		if($field == $column) {
    	   
    	   		$columnDetails['offset'] = $c;
    	   		
    	   		break;
    	   
    	   	}
    	   	
    	   	$c++;
    	
    	}
    	
    	//print_r($columnDetails);
    	
    	//die('');
    	
    	return $columnDetails;
    
    }
    
    
    /*
    	updates a table, name only for now
    */
    
    public function updateTable($table, $data)
    {
    
    	//change table name first
    	
    	$this->db->query("RENAME TABLE `$table` TO `".$data['tableName']."`");
    	
    	
    	//update some dbapp stuff
    	
    	//next: dbapp_relations
    	
    	$udata = array(
    		'dbapp_relations_source_table' => $data['tableName']
    	);
    	
    	$this->db->where('dbapp_relations_source_table', $table);
    	
    	$this->db->update('dbapp_relations', $udata);
    	
    	
    	//dbapp_relations once more
    	
    	$udata = array(
    		'dbapp_relations_reference_table' => $data['tableName']
    	);
    	
    	$this->db->where('dbapp_relations_reference_table', $table);
    	
    	$this->db->update('dbapp_relations', $udata);
    	
    	
    	//dbapp_columnrestrictions
    	
    	$udata = array(
    		'dbapp_columnrestrictions_table' => $data['tableName']
    	);
    	
    	$this->db->where('dbapp_columnrestrictions_table', $table);
    	
    	$this->db->update('dbapp_columnrestrictions', $udata);
    	
    	
    	//dbapp_columnselect
    	
    	$udata = array(
    		'dbapp_columnselect_table' => $data['tableName']
    	);
    	
    	$this->db->where('dbapp_columnselect_table', $table);
    	
    	$this->db->update('dbapp_columnselect', $udata);
    	
    	
    	//update group permissions
    	
    	$groups = $this->db->get('dbapp_groups')->result();
    	    	    	
    	foreach( $groups as $group ) {
    	
    		if( $group->id > 1 ) {//no need to do this for admins
    	
    			$groupPermissions = json_decode($group->permissions, true);
    			
    			foreach( $groupPermissions as $database=>$perms ) {
    			
    				if( isset( $groupPermissions[$database][$table] ) ) {
    					
    					//save the permissions temporarily
    					
    					$temp = $groupPermissions[$database][$table];
    					
    					unset( $groupPermissions[$database][$table] );
    					
    					//put in the permissions under the new table name
    					
    					$groupPermissions[$database][$data['tableName']] = $temp;
    					
    					//update the dbapp_groups table
    					
    					$udata = array(
    						'permissions' => json_encode($groupPermissions)
    					);
    					
    					$this->db->where('id', $group->id);
    					
    					$this->db->update('dbapp_groups', $udata);
    					
    					
    					//now, we'll need to update the MySQL permissions for each user in this group
    					
    					$users = $this->db->from('dbapp_users_groups')->join('dbapp_users', 'dbapp_users_groups.user_id = dbapp_users.id')->where('group_id', $group->id)->get();
    					
    					if( $users->num_rows() > 0 ) {
    					
    						foreach( $users->result() as $user ) {
    						
    							$this->rolemodel->applyPermissions($groupPermissions, $user->mysql_user);
    						        					    					
    						}
    					
    					}
    				
    				}
    			
    			}
    			
    		}
    	
    	}
    	
    	
    	//update private tables if any
    	
    	$users = $this->db->get('dbapp_users')->result();
    	
    	foreach( $users as $user ) {
    	
    		if( $user->tables != '' ) {
    	
    			$tables = json_decode($user->tables, true);
    		    		
    			foreach( $tables as $key=>$t ) {
    		
    				if( $t == $table ) {
    			
    					unset( $tables[$key] );
    				
    					array_push($tables, $data['tableName']);
    					
    					$udata = array(
    						'tables' => json_encode($tables)
    					);
    					
    					$this->db->where('id', $user->id);
    					
    					$this->db->update('dbapp_users', $udata);
    					
    					
    					//permission stuff
    					
    					//revoke for all table
    					$this->db->query("REVOKE ALL PRIVILEGES  ON `".$this->database->database."`.`$table` FROM '".$user->mysql_user."'@'".$this->db->hostname."'");
    					
    					//right for new table
    					$this->db->query("GRANT ALL ON `".$this->database->database."`.`".$data['tableName']."` TO '".$user->mysql_user."'@'".$this->db->hostname."'");
    					
    					$this->db->query("GRANT INSERT ON `".$this->database->database."`.* TO '".$user->mysql_user."'@'".$this->db->hostname."'");
    		    			
    				}
    		
    			}
    		
    		}
    	
    	}
    	    	    
    }
    
    
    /*
    	updates column details
    */
    
    public function updateColumn($table, $column, $data)
    {
    
    	//get the details for this column
    	
    	$columnDetails = $this->getColumnDetails($table, $column);
    	
    	$columnDetailsUpdated = $columnDetails;
    
    	//change the column name?
    	if( $column != $data['columnName'] ) {
    	    	
    		//we'll need to destroy possible FKs before we change the name, if any FK exists and gets dropped, it will recreated automatically further down this function
    		
    		if( $this->hasFK($table, $column) ) {
    		
    			$this->destroyForeignKey($table, $column);
    		
    		}
    		
    	
    		if($columnDetails['max_length'] != '') {
    		
    			$this->db->query("ALTER TABLE `$table` CHANGE `$column` `".$data['columnName']."` ".$columnDetails['type']."(".$columnDetails['max_length'].")");
    			    		
    		} else {
    	
    			$this->db->query("ALTER TABLE `$table` CHANGE `$column` `".$data['columnName']."` ".$columnDetails['type']);
    		
    		}
    		
    		
    		$columnDetailsUpdated['name'] = $data['columnName'];
    		
    		//column names are used to store stuff as well, so we'll need to make some more updates to the db
    		    		
    		
    		//next: dbapp_relations
    		$udata = array(
    			'dbapp_relations_source_field' => $data['columnName']
    		);
    		
    		$this->db->where('dbapp_relations_source_table', $table);
    		
    		$this->db->update('dbapp_relations', $udata);
    		
    		
    		//dbapp_relations again
    		$udata = array(
    			'dbapp_relations_reference_field' => $data['columnName']
    		);
    		
    		$this->db->where('dbapp_relations_reference_table', $table);
    		
    		$this->db->update('dbapp_relations', $udata);
    		
    		
    		//dbapp_columnrestrictions
    		$udata = array(
    			'dbapp_columnrestrictions_column' => $data['columnName']
    		);
    		
    		$this->db->where('dbapp_columnrestrictions_table', $table);
    		
    		$this->db->update('dbapp_columnrestrictions', $udata);
    		
    		
    		//dbapp_columnselect
    		$udata = array(
    			'dbapp_columnselect_column' => $data['columnName']
    		);
    		
    		$this->db->where('dbapp_columnselect_table', $table);
    		
    		$this->db->update('dbapp_columnselect', $udata);
    		
    		
    		
    		//remove old column name from the session and add the new column name if previously registered
    		if( in_array($column, $this->session->userdata($table)) ) {
    			
    			//old column was registered for view with the session
    			$theColumns = $this->session->userdata($table);
    			
    			$this->session->unset_userdata($table);
    			
    			//find the key for the column
    			$key = array_search ($column, $theColumns);
    			
    			//replace with the new column
    			$theColumns[$key] = $columnDetailsUpdated['name'];
    			
    			$this->session->set_userdata($table, $theColumns);
    		
    		}
    	
    	}
    	
    	//change content type?
    	if( $columnDetails['type'] != $data['columnType'] ) {
    	
    		if( $data['columnType'] == 'int' ) {
    			
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` int(11)");
    			
    			$columnDetailsUpdated['max_length'] = 11;
    		
    		} elseif( $data['columnType'] == 'varchar' ) {
    		
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` varchar(255)");
    			
    			$columnDetailsUpdated['max_length'] = 255;
    		
    		} elseif( $data['columnType'] == 'text' ) {
    		
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` text");
    			
    			$columnDetailsUpdated['max_length'] = "";
    		
    		} elseif( $data['columnType'] == 'blob' ) {
    		
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` blob");
    			
    			$columnDetailsUpdated['max_length'] = "";
    		
    		} elseif( $data['columnType'] == 'date' ) {
    		
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` date");
    		
    		} elseif( $data['columnType'] == 'select' ) {
    		
    			$this->db->query("alter table `$table` modify `".$columnDetailsUpdated['name']."` varchar(255)");
    			
    			$columnDetailsUpdated['max_length'] = 255;
    		
    		}
    		
    		$columnDetailsUpdated['type'] = $data['columnType'];
    	
    	}
    	
    	unset($columnDetailsUpdated['select']);
    	
    	//delete possible select values
    	
    	$this->db->where('dbapp_columnselect_table', $table);
    	$this->db->where('dbapp_columnselect_column', $columnDetailsUpdated['name']);
    	$this->db->delete('dbapp_columnselect');
    	
    	if( $data['columnType'] == 'select' ) {
    	
    		$optionArray = preg_split('/\n|\r/', $data['columnSelect'], -1, PREG_SPLIT_NO_EMPTY);
    		    		
    		$insertData = array(
    		   'dbapp_columnselect_table' => $table,
    		   'dbapp_columnselect_column' => $columnDetailsUpdated['name'],
    		   'dbapp_columnselect_values' => json_encode($optionArray)
    		);
    		
    		$this->db->insert('dbapp_columnselect', $insertData);
    		
    		$columnDetailsUpdated['select'] = json_encode($optionArray);
    		$columnDetailsUpdated['type'] = "varchar";
    	
    	}
    	
    	
    	//change default value?
    	if( $columnDetails['default'] != $data['columnDefault'] ) {
    	    	
    		if($columnDetailsUpdated['max_length'] != '') {
    		    		
    			if($data['columnDefault'] == 'null' || $data['columnDefault'] == 'NULL') {
    			
    				$this->db->query("ALTER TABLE `$table` CHANGE `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."( ".$columnDetailsUpdated['max_length']." ) NULL DEFAULT NULL");
    			
    			} else {
    		
    				$this->db->query("ALTER TABLE `$table` CHANGE `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."( ".$columnDetailsUpdated['max_length']." ) NOT NULL DEFAULT '".$data['columnDefault']."'");
    			
    			}
    			    		
    		} else {
    		    		
    			if($data['columnDefault'] == 'null' || $data['columnDefault'] == 'NULL') {
    			
    				$this->db->query("ALTER TABLE `$table` CHANGE `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NULL DEFAULT NULL");
    			
    			} else {
    			
    				$this->db->query("ALTER TABLE `$table` CHANGE `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NOT NULL DEFAULT '".$data['columnDefault']."'");
    		
    			}
    			
    		}
    		
    		$columnDetailsUpdated['default'] = $data['columnDefault'];
    	
    	}
        	    	
    	//change the index situation on this column?
    	if( isset($data['columnIndex']) && $columnDetails['index'] != $data['columnIndex'] ) {
    	    	    	    	
    		//first drop whatever index is currently on this column
    		
    		$query = $this->db->query("SHOW INDEX FROM `$table` WHERE KEY_NAME = '".$columnDetailsUpdated['name']."'")->result();
    		
    		if( count($query) > 0 ) {//has an index
    		
    			$this->db->query("DROP INDEX `".$columnDetailsUpdated['name']."` ON `$table`");
    		
    		}
    		
    		//setup index if needed
    		if( $data['columnIndex'] == 'primary' ) {
    		
    			$this->db->query("ALTER TABLE `$table` ADD PRIMARY KEY ( `".$columnDetailsUpdated['name']."` )");
    			
    			$columnDetailsUpdated['index'] = "primary";
    		
    		} elseif( $data['columnIndex'] == 'unique' ) {
    		
    			$this->db->query("ALTER TABLE `$table` ADD UNIQUE ( `".$columnDetailsUpdated['name']."` )");
    			
    			$columnDetailsUpdated['index'] = "unique";
    		
    		} elseif( $data['columnIndex'] == 'index' ) {
    		
    			$this->db->query("ALTER TABLE `$table` ADD INDEX ( `".$columnDetailsUpdated['name']."` ) ");
    			
    			$columnDetailsUpdated['index'] = "index";
    		
    		} else {
    		
    			$columnDetailsUpdated['index'] = "";
    		
    		}
    		    	
    	}
    	
    	
    	//change the position of the column?
    	
    	$temp = $data['columnOffset'];
    	
    	$ttemp = explode("_", $temp);
    	
    	$newOffset = $ttemp[1];
    	    	
    	if( $columnDetails['offset'] != ($newOffset+1) ) {
    	    	    	    	
    		//get all fields
    		    		
    		$allFields = $this->getFieldsFor($table);
    		    		
    		if($columnDetailsUpdated['max_length'] != '') {
    		
    			if($data['columnDefault'] == 'null' || $data['columnDefault'] == 'NULL') {
    			
    				if( $newOffset == "-1" ) {
    				
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."(".$columnDetailsUpdated['max_length'].") NULL DEFAULT NULL FIRST");
    				
    				} else {
    				
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."(".$columnDetailsUpdated['max_length'].") NULL DEFAULT NULL AFTER ".$allFields[$newOffset]['field']);
    			
    				}
    			
    			} else {
    		
    				if( $newOffset == "-1" ) {
    					
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."(".$columnDetailsUpdated['max_length'].") NOT NULL DEFAULT '".$data['columnDefault']."' FIRST");
    				
    				} else {
    		
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']."(".$columnDetailsUpdated['max_length'].") NOT NULL DEFAULT '".$data['columnDefault']."' AFTER ".$allFields[$newOffset]['field']);
    				
    				}
    			}
    		
    		} else {
    		
    			if($data['columnDefault'] == 'null' || $data['columnDefault'] == 'NULL') {
    			
    				if( $newOffset == "-1" ) {
    				
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NULL DEFAULT NULL FIRST");
    				
    				} else {
    			
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NULL DEFAULT NULL AFTER ".$allFields[$newOffset]['field']);
    				
    				}
    			
    			} else {
    			
    				if( $newOffset == "-1" ) {
    				
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NOT NULL DEFAULT '".$data['columnDefault']."' FIRST");
    				
    				} else {
    		
    					$this->db->query("ALTER TABLE `$table` CHANGE COLUMN `".$columnDetailsUpdated['name']."` `".$columnDetailsUpdated['name']."` ".$columnDetailsUpdated['type']." NOT NULL DEFAULT '".$data['columnDefault']."' AFTER ".$allFields[$newOffset]['field']);
    				
    				}
    		
    			}
    			
    		}
    		    		
    		$columnDetailsUpdated['offset'] = $newOffset;
    		    	    		    		    		    	
    	} else {
    	
    		$columnDetailsUpdated['offset'] = $columnDetails['offset'];
    	
    	}
    	
    	
    	
    	//set a foreign key?
    	
    	if( isset($data['connectTo']) && $data['connectTo'] != '' ) {
    	
    		//only if it doesn't exist yet
    		
    		if( $this->hasFK($table, $column) ) {
    			
    			$this->destroyForeignKey($table, $column);
    		
    		}
    		    		
    		if( !$this->hasFK($table, $column) ) {    			
    		    		    		    		
    			//split up the value into table + column
    			$temp = explode(".", $data['connectTo']);
    			    			
    			$referenceTable = $temp[0];
    			$useColumn = $temp[1];
    			
    			//this will fix up messy values in the source column
    			$this->fixForForeignKey($table, $columnDetailsUpdated['name'], $referenceTable);
    			
    			
    	
    			$key = $this->getPrimaryKey($referenceTable)->name;
    			$fkey = "fk_".$columnDetailsUpdated['name']."_".$referenceTable."_".$key;
    	
    			$this->db->query("ALTER TABLE `$table` ADD CONSTRAINT $fkey FOREIGN KEY (".$columnDetailsUpdated['name'].") REFERENCES ".$referenceTable."($key) ON UPDATE CASCADE ON DELETE NO ACTION");
    			    		
    			$temp = array();
    			$temp['foreign_key'] = $referenceTable.".".$key;
    			$temp['use_column'] = $useColumn;
    		
    			$columnDetailsUpdated['foreign_key'] = $temp;
    			
    			//add relation to database
    			
    			$this->load->model('relationmodel');    			
    			
    			$this->relationmodel->createNew($table, $columnDetailsUpdated['name'], $referenceTable, $key, $useColumn);
    		
    		}
    	
    	} else {
    	
    		//remove foreign keys
    		
    		$this->destroyForeignKey($table, $columnDetailsUpdated['name']);
    		    		
    		unset($columnDetailsUpdated['foreign_key']);
    	
    	}
    	
    	
    	//restrictions
    	
    	//delete old restrictions
    	$this->db->where('dbapp_columnrestrictions_table', $table);
    	$this->db->where('dbapp_columnrestrictions_column', $columnDetailsUpdated['name']);
    	$this->db->delete('dbapp_columnrestrictions'); 
    	
    	if( isset($data['restrictions']) && count($data['restrictions']) > 0 && isset($data['restrictions'][1]['restriction']) && $data['restrictions'][1]['restriction'] != '') {
    	    	
    		$restrictions = array();
    	
    		foreach( $data['restrictions'] as $reArray ) {
    		
    			$restriction = $reArray['restriction'];
    			
    			if( isset($reArray['value']) ) {
    				
    				if( $reArray['value'] == '' ) {
    				
    					$value = "10";
    				
    				} else {
    				
    					$value = $reArray['value'];
    				
    				}
    				
    				$restriction .= "[$value]";
    			
    			}
    			
    			array_push($restrictions, $restriction);
    		
    		}
    		
    		$restrictions = implode("|", $restrictions);
    		
    		//insert into database
    		$data = array(
    		   'dbapp_columnrestrictions_table' => $table,
    		   'dbapp_columnrestrictions_column' => $columnDetailsUpdated['name'],
    		   'dbapp_columnrestrictions_restrictions' => $restrictions
    		);
    		
    		$this->db->insert('dbapp_columnrestrictions', $data); 
    	
    	}
    	
    	
    	//return the updated column details
    	
    	return $columnDetailsUpdated;
    
    }
    
    
    /*
    	deletes an entire column from a given table in a given database
    */
    
    public function deleteColumn($table, $column)
    {
    	
    	//drop possible FKs
    	$this->destroyForeignKey($table, $column);
    
    	$this->db->query("ALTER TABLE `$table` DROP `$column`");
    	
    	
    	//column names are used to store stuff as well, so we'll need to make some more updates to the db
    	
    	
    	//next, dbapp_relations
    	
    	$this->db->where('dbapp_relations_source_table', $table);
    	$this->db->where('dbapp_relations_source_field', $column);
    	$this->db->delete('dbapp_relations');
    	
    	
    	//next, dbapp_relations once more
    
    	$this->db->where('dbapp_relations_reference_table', $table);
    	$this->db->where('dbapp_relations_reference_use', $column);
    	$this->db->delete('dbapp_relations');
    	
    	//next, dbapp_columnrestrictions
    	
    	$this->db->where('dbapp_columnrestrictions_table', $table);
    	$this->db->where('dbapp_columnrestrictions_column', $column);
    	$this->db->delete('dbapp_columnrestrictions');
    	
    	
    	//next, dbapp_columnselect
    	
    	$this->db->where('dbapp_columnselect_table', $table);
    	$this->db->where('dbapp_columnselect_column', $column);
    	$this->db->delete('dbapp_columnselect');    	
    	
    
    }
    
    
    /*
    	creates a new column in the given db/table
    */
    
    public function newColumn($table, $data)
    {
    
    	//determine the data type
    	    	
    	if( $data['columnType'] == 'int' ) {
    	
    		$dataType = "int(11)";
    		
    		if( $data['columnDefault'] != '' ) {
    		
    			$columnDefault = (int) $data['columnDefault'];
    		
    		}
    	
    	} elseif( $data['columnType'] == 'varchar' ) {
    	
    		$dataType = "varchar(255)";
    		
    		if( $data['columnDefault'] != '' ) {
    		
    			$columnDefault = (string) $data['columnDefault'];
    		
    		}
    	
    	} elseif( $data['columnType'] == 'text' ) {
    	
    		$dataType = "text";
    	
    	} elseif( $data['columnType'] == 'blob' ) {
    	
    		$dataType = "blob";
    	
    	} elseif( $data['columnType'] == 'date' ) {
    	
    		$dataType = "date";
    	
    	} elseif( $data['columnType'] == 'select' ) {
    	
    		$dataType = "varchar(255)";
    		
    		//save the options in the database
    		
    		$optionArray = preg_split('/\n|\r/', $data['columnSelect'], -1, PREG_SPLIT_NO_EMPTY);
    		    		
    		$insertData = array(
    		   'dbapp_columnselect_table' => $table,
    		   'dbapp_columnselect_column' => $data['columnName'],
    		   'dbapp_columnselect_values' => json_encode($optionArray)
    		);
    		
    		$this->db->insert('dbapp_columnselect', $insertData);
    	
    	}
    	
    	//if this column is setup as a foreign key, we'll need a proper default value, set to a primary_id value from the referenced table, this will override a manually set default
    	if( isset($data['connectTo']) && $data['connectTo'] != '' ) {
    	
    		$temp = explode(".", $data['connectTo']);
    		
    		$referenceTable = $temp[0];
    		    	
    		$columnDefault = $this->getKeyValue($referenceTable);
    	
    	}
    	
    	//where do we drop in the new column?
    	
    	if( $data['columnOffset'] != 'end' ) {
    	
    		$temp = $data['columnOffset'];
    	
    		$ttemp = explode("_", $temp);
    	
    		$newOffset = $ttemp[1];
    	
    		$allFields = $this->getFieldsFor($table);
    	
    		if( isset($columnDefault) ) {
    	
    			$this->db->query("ALTER TABLE `$table` ADD `".$data['columnName']."` $dataType NOT NULL DEFAULT '".$columnDefault."' after `".$allFields[$newOffset]['field']."`");    		
    	
    		} else {
    	
    			$this->db->query("ALTER TABLE `$table` ADD `".$data['columnName']."` $dataType NOT NULL after `".$allFields[$newOffset]['field']."`");
    	
    		}
    	
    	} else {
    		
    		if( isset($columnDefault) ) {
    		
    				$this->db->query("ALTER TABLE `$table` ADD `".$data['columnName']."` $dataType NOT NULL DEFAULT '".$columnDefault."'");    		
    		
    			} else {
    		
    				$this->db->query("ALTER TABLE `$table` ADD `".$data['columnName']."` $dataType NOT NULL");
    		
    			}
    	
    	}
    	
    	
    	//does the new column need an index? for now, we only allow indexes on int and varchar fields
    	
    	if( $data['columnType'] == 'int' || $data['columnType'] == 'varchar' || $data['columnType'] == 'date' ) {
    	
    		if( $data['columnIndex'] == 'primary' ) {
    	
    			$this->db->query("ALTER TABLE `$table` ADD PRIMARY KEY ( `".$data['columnName']."` )");
    	
    		} elseif( $data['columnIndex'] == 'unique' ) {
    	
    			$this->db->query("ALTER TABLE `$table` ADD UNIQUE ( `".$data['columnName']."` )");
    	
    		} elseif( $data['columnIndex'] == 'index' ) {
    	
    			$this->db->query("ALTER TABLE `$table` ADD INDEX ( `".$data['columnName']."` ) ");
    	
    		}
    	
    	}
    	
    	
    	//set a foreign key?
    	
    	if( isset($data['connectTo']) && $data['connectTo'] != '' ) {
    	
    		//split up the value into table + column
    		$temp = explode(".", $data['connectTo']);
    		
    		$referenceTable = $temp[0];
    		
    		$useColumn = $temp[1];
    	
    		$key = $this->getPrimaryKey($referenceTable)->name;
    		$fkey = "fk_".$data['columnName']."_".$referenceTable."_".$key;
    	
    		$this->db->query("ALTER TABLE `$table` ADD CONSTRAINT $fkey FOREIGN KEY (".$data['columnName'].") REFERENCES ".$referenceTable."($key) ON UPDATE CASCADE ON DELETE NO ACTION");
    		
    		
    		//add relation to database
    		
    		$this->load->model('relationmodel');    		
    		
    		$this->relationmodel->createNew($table, $data['columnName'], $referenceTable, $key, $useColumn);
    	
    		    	
    	}
    	
    	
    	//restrictions
    	
    	if( isset($data['restrictions']) && count($data['restrictions']) > 0 && $data['restrictions'][1]['restriction'] != '') {
    	
    		$restrictions = array();
    	
    		foreach( $data['restrictions'] as $reArray ) {
    		
    			$restriction = $reArray['restriction'];
    			
    			if( isset($reArray['value']) ) {
    				
    				if( $reArray['value'] == '' ) {
    				
    					$value = "10";
    				
    				} else {
    				
    					$value = $reArray['value'];
    				
    				}
    				
    				$restriction .= "[$value]";
    			
    			}
    			
    			array_push($restrictions, $restriction);
    		
    		}
    		
    		$restrictions = implode("|", $restrictions);
    		
    		//insert into database
    		$data = array(
    		   'dbapp_columnrestrictions_table' => $table,
    		   'dbapp_columnrestrictions_column' => $data['columnName'],
    		   'dbapp_columnrestrictions_restrictions' => $restrictions
    		);
    		
    		$this->db->insert('dbapp_columnrestrictions', $data); 
    	
    	}
    	
    	
    	//add the new column to the session so it will show up in the dataview
    		    		
    	$this->session->unset_userdata($table);
    		    	
    
    }
    
    
    /*
    	create new table
    */
    
    public function newTable($data, $forceKey = true)
    {
    
    	//prepare the columns bit
    	
    	$colArray = array();
    	
    	foreach( $data['columns'] as $key=>$col ) {
    	
    		if( $forceKey && $key == 1 ) {
    			
    			//the first column will be set as the primary key for the new table
    			
    			//auto increment?
    			
    			if( isset($data['auto-increment']) && $data['auto-increment'] == 'yes' ) {
    			
    				$colString = "`".$col['columnName']."` int(11) NOT NULL AUTO_INCREMENT, primary key (`".$col['columnName']."`)";
    			
    			} else {
    			
    				$colString = "`".$col['columnName']."` int(11) NOT NULL, primary key (`".$col['columnName']."`)";
    			
    			}
    		
    		} else {
    	
    			$colString = "`".$col['columnName']."` ";
    	
    			//column type
    			if( $col['columnType'] == 'int' ) {
    		
    				$colString .= "int(11) NOT NULL";
    				
    				//column default
    				
    				if( $col['columnDefault'] != '' ) {
    				
    					$columnDefault = (int) $col['columnDefault'];
    				
    					$colString .= " DEFAULT '$columnDefault'";
    				
    				}
    				    		
    			} elseif( $col['columnType'] == 'varchar' ) {
    		
    				$colString .= "varchar(255) NOT NULL";
    				
    				//column default
    				
    				if( $col['columnDefault'] != '' ) {
    				
    					$columnDefault = (string) $col['columnDefault'];
    				
    					$colString .= " DEFAULT '$columnDefault'";
    				
    				}
    			
    			} elseif( $col['columnType'] == 'text' ) {
    		
    				$colString .= "text NOT NULL";
    		
    			} elseif( $col['columnType'] == 'blob' ) {
    		
    				$colString .= 'blob NOT NULL';
    		
    			} elseif( $col['columnType'] == 'date' ) {
    			
    				$colString .= 'date NOT NULL';
    			
    			} elseif( $col['columnType'] == 'select' ) {
    			
    				$colString .= "varchar(255) NOT NULL";
    				
    				$optionArray = preg_split('/\n|\r/', $col['columnSelect'], -1, PREG_SPLIT_NO_EMPTY);
    					    		
    				$insertData = array(
    					'dbapp_columnselect_database' => $this->db->database,
    					'dbapp_columnselect_table' => $data['tableName'],
    					'dbapp_columnselect_column' => $col['columnName'],
    					'dbapp_columnselect_values' => json_encode($optionArray)
    				);
    					
    				$this->db->insert('dbapp_columnselect', $insertData);    				
    			
    			}
    			
    		
    		}
    		
    		array_push($colArray, $colString);
    	
    	}
    	
    	$columns = implode(", ", $colArray);
    	
    	//create the table, set the proper engine type first
    	$this->db->query('SET storage_engine=INNODB');
    	
    	$this->db->query("CREATE TABLE `".$data['tableName']."` (".$columns.")");
    	
    	
    	//if the user is not an admin, we'll need to make sure he/she will have the correct rights to the new table
    	if( !$this->ion_auth->is_admin() ) {
    	
    		$tableName = $data['tableName'];
    		
    		//add table for this user to their db record
    		
    		$privateTables = json_decode($this->ion_auth->user()->row()->tables, true);
    		
    		if( $privateTables == null ) {
    			
    			$privateTables = array();
    		
    		}
    		
    		array_push($privateTables, $tableName);
    		
    		$dataa = array(
    			'tables' => json_encode($privateTables)
    		);
    		
    		$this->db->where('id', $this->ion_auth->user()->row()->id);
    		$this->db->update('dbapp_users', $dataa); 
    		
    		
    		//check what else we need to do
    	
    		if( isset($data['share']) && $data['share'] == 'private' ) {
    		
	    		    	

    		} elseif( isset($data['share']) && $data['share'] == 'group' ) {
    		
    			$tempp = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->id)->result();
    		
    			$group = $tempp[0];
    			
    			//get group permissions
    			
    			$tempp = $this->db->from('dbapp_groups')->where('id', $group->id)->get()->result();
    			
    			$permissions = $tempp[0]->permissions;
    			
    			$permissionsArray = json_decode($permissions, true);
    			
    			//add the new table permissions
    			
    			$temp = array();
    			$temp['select'] = 'yes';
    			$temp['delete'] = 'yes';
    			$temp['insert'] = 'yes';
    			$temp['update'] = 'yes';
    			$temp['alter'] = 'yes';
    			
    			$permissionsArray[$tableName] = $temp;
    			
    			//save to db
    			    			
    			$data = array(
    				'permissions' => json_encode($permissionsArray)
    			);
    			
    			$this->db->where('id', $group->id);
    			$this->db->update('dbapp_groups', $data);    		
    		
    		} elseif( isset($data['share']) && $data['share'] == 'all' ) {
    		
    			//allow for all rols/groups
    			
    			$groups = $this->db->get('dbapp_groups')->result();
    			    			
    			foreach( $groups as $group ) {
    			
    				if( $group->id > 1 ) {
    				    				
    					$permissionsArray = json_decode($group->permissions, true);
    					
    					//add the new table permissions
    					
    					$temp = array();
    					$temp['select'] = 'yes';
    					$temp['delete'] = 'yes';
    					$temp['insert'] = 'yes';
    					$temp['update'] = 'yes';
    					$temp['alter'] = 'yes';
    					
    					$permissionsArray[$tableName] = $temp;
    					
    					//save to db
    					    			
    					$data = array(
    						'permissions' => json_encode($permissionsArray)
    					);
    					
    					$this->db->where('id', $group->id);
    					$this->db->update('dbapp_groups', $data);
    					
    				
    				}
    			
    			}
    			
    		
    		}
    	
    	}
    
    }
    
    
    /*
    	checks to see if a table exists
    */
    
    public function exists($table)
    {
    
    	$query = $this->db->query("SHOW TABLES LIKE '$table'");
    	    	
    	if( $query->num_rows() > 0 ) {
    	
    		return true;
    	
    	} else {
    	
    		return false;
    	
    	}
    
    }
    
    
    /*
    	test to make sure all the column names are unique
    */
    
    public function uniqueColumns($data)
    {
    
    	foreach( $data as $key=>$col ) {
    	
    		$columnName = $col['columnName'];
    		
    		foreach( $data as $k=>$v ) {
    		    		
    			if( $columnName == $v['columnName'] && $key != $k ) {
    			
    				return false;
    			
    			}
    		
    		}
    	
    	}
    	    	
    	return true;
    
    }
    
    
    /*
    	deletes a table from a database
    */
    
    public function deleteTable($table)
    {
    	
    	//destroy possible foreign keys 
    	
    	$fields = $this->getFieldsFor($table);
    	
    	foreach( $fields as $field ) {
    	
    		$this->destroyForeignKey($table, $field['field']);
    	
    	}
    
    	$this->db->query("DROP TABLE `$table`");
    	
    	//delete from group permissions
    	
    	$groups = $this->db->from('dbapp_groups')->get()->result();
    	
    	foreach( $groups as $group ) {
    	
    		if( $group->id > 1 ) {//no need for admin
    	
    			$permissions = json_decode($group->permissions, true);
    			
    			if( isset($permissions[$table]) ) {//this group has permissions set for this table
    		
    				unset($permissions[$table]);
    		
    				$updatedPermissions = json_encode($permissions);
    		
    				//update db
    				$data = array(
    					'permissions' => $updatedPermissions
    				);
    			
    				$this->db->where('id', $group->id);
    				$this->db->update('dbapp_groups', $data);
    				
    			}
    		
    		}
    	
    	}
    	
    	
    	//if this is a user private table, delete from tables column in users table
    	
    	if( $this->usermodel->ownsTable($table) ) {
    	    	
    		$userTables = $this->ion_auth->user()->row()->tables;
    		
    		$tables = json_decode($userTables, true);
    		
    		$newTables = array();
    		
    		foreach( $tables as $t ) {
    			
    			if( $t != $table ) {
    			
    				array_push($newTables, $t);
    			
    			}
    		
    		}
    		
    		//update db
    		$data = array(
    			'tables' => json_encode($newTables)
    		);
    		
    		$this->db->where('id', $this->ion_auth->user()->row()->id);
    		$this->db->update('dbapp_users', $data); 
    		
    	}
    	
    	
    	//we'll need to make some updates to our dbapp tables as well
    	
    	
    	//next, dbapp_relations
    	
    	$this->db->where('dbapp_relations_source_table', $table);
    	$this->db->delete('dbapp_relations');
    	
    	
    	//dbapp_relations once more
    	
    	$this->db->where('dbapp_relations_reference_table', $table);
    	$this->db->delete('dbapp_relations');
    	
    	
    	//next, dbapp_columnrestrictions
    	
    	$this->db->where('dbapp_columnrestrictions_table', $table);
    	$this->db->delete('dbapp_columnrestrictions');
    	
    	
    	//next, dbapp_columnselect
    	
    	$this->db->where('dbapp_columnselect_table', $table);
    	$this->db->delete('dbapp_columnselect');
    	    	
    }
    
    
    /*
    	returns the engine type for a table
    */
    
    public function getEngine($table)
    {
    
    	$query = $this->db->query("SHOW TABLE STATUS WHERE Name = '$table'");
    	
    	$tempp = $query->result();
    	
    	$row = $tempp[0];
    	
    	return $row->Engine;
    
    }
    
    
    
    /*
    	checks to see of the table is private for a given user (role)
    */
    
    public function isPrivate($table) 
    {
    
    	$user = $this->ion_auth->user()->row();
    	
    	//get group info
    	
    	$query = $this->db->from('dbapp_users_groups')->where('user_id', $user->id)->join('dbapp_groups', 'dbapp_users_groups.group_id = dbapp_groups.id')->get();

		if( $query->num_rows() > 0 ) {
		
			$temp = $query->result();
			
			$permissions = json_decode($temp[0]->permissions, true);
			
			if( isset($permissions[$table]['private']) ) {
			
				return true;
			
			} else {
			
				return false;
			
			}
		
		} else {
		
			return false;
		
		}
		    
    }
    
    
    
    /*
    	create a new table structure for an imported CSV file, given the column names (from the first row)
    */
    
    public function createTableforCSV($tableName, $columns, $fileData, $useColumns, $dilimiter, $enclosure)
    {
    
    	$theColumns = array();
    	
    	$counter = 1;
    	
    	foreach( $columns as $column ) {
    		
    		//$theColumns[$counter] = "`".preg_replace("/[^a-z0-9_]+/i", "", $column)."` varchar(255)";
    		
    		$temp = array();
    		$temp['columnName'] = preg_replace("/[^a-z0-9_]+/i", "", $column);
    		$temp['columnType'] = "varchar";
    		$temp['columnDefault'] = "";
    		
    		$theColumns[$counter] = $temp;
    		
    		$counter++;
    		
    	}
    		
    	//columns string for the create table query (includes column definitions)
    	//$theColumns = "(".implode(", ", $theColumns).")";
    		
    	if( isset($_POST['share']) && $_POST['share'] != '' ) {
    	
    		$this->newTable(array('columns' => $theColumns, 'tableName' => $tableName, 'share' => $_POST['share']), false);
    	
    	} else {
    	
    		$this->newTable(array('columns' => $theColumns, 'tableName' => $tableName), false);
    	
    	}
    	    	    	
    	
    	//parse data
    
    	$this->load->library('csvreader');
    	$this->csvreader->separator = $dilimiter;
    	$this->csvreader->enclosure = $enclosure;
    	
    	$res = $this->csvreader->parse_file($fileData['full_path'], $columns);
    	
    	//print_r($res);
    	
    	$this->db->insert_batch($tableName, $res);
    	
    	
    	//pop first item off as it contains the column names
    	if( $useColumns ) {
    	
    		$this->db->query("DELETE FROM `$tableName` WHERE `".preg_replace("/[^a-z0-9_]+/i", "", $columns[0])."` = '".preg_replace("/[^a-z0-9_]+/i", "", $columns[0])."'");
    	
    	}
    	
    	
    	//we'd like a primary key set for this table, can we use the first column?
    	
    	$query = $this->db->query("SELECT count(`".preg_replace("/[^a-z0-9_]+/i", "", $columns[0])."`) as 'count1', count(distinct `".preg_replace("/[^a-z0-9_]+/i", "", $columns[0])."`) as 'count2' FROM `$tableName`");
    	    	
    	$res = $query->result();
    	
    	if( $res[0]->count1 == $res[0]->count2 ) {
    	
    		//the first column holds only unique values, we'll set it as a the primary key
    		
    		$this->db->query("ALTER TABLE `".$tableName."` ADD PRIMARY KEY(`".preg_replace("/[^a-z0-9_]+/i", "", $columns[0])."`)");
    	
    	} else {
    	
    		//first column does not hold unique values, so we'll add an additional column for the primary ID
    		
    		$this->db->query("ALTER TABLE `$tableName` ADD `".$tableName."_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST ");
    	
    	}
    
    }
    
    
   	/*
   		imports CSV data into existing table
	*/
	public function importCSV($tableName, $fileData, $dilimiter, $enclosure)
   	{
   	
   		$columns = $this->db->list_fields($tableName);
   		   		
   		$this->load->library('csvreader');
   		$this->csvreader->separator = $dilimiter;
   		$this->csvreader->enclosure = $enclosure;
   		
   		$res = $this->csvreader->parse_file($fileData['full_path'], $columns);
   		
   		//print_r($res);
   		
   		if( count($res) == 0 ) {
   			return false;
   		}
   		
   		$query = $this->db->insert_batch($tableName, $res);
   		
   		if( $this->db->_error_message() ) {
   			
   			return false;
   		
   		} else {
   		
   			//insert went well, update the record tracking table dbapp_users_records
   			
   			$user = $this->ion_auth->user()->row();
   			
   			$pkey_ = $this->getPrimaryKey($tableName);
   			
   			$pkey = $pkey_->name;
   			
   			$recArray = array();
   			
   			foreach( $res as $r ) {
   			
   				$temp = array();
   				$temp['dbapp_users_records_userid'] = $user->id;
   				$temp['dbapp_users_records_table'] = $tableName;
   				$temp['dbapp_users_records_recordid'] = $r[$pkey];
   			
   				$recArray[] = $temp;
   			
   			}
   			
   			$query = $this->db->insert_batch('dbapp_users_records', $recArray);
   		
   			return true;
   		
   		}
   
   	}
    
}