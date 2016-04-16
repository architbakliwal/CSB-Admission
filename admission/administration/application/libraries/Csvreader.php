<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CSVReader {

    var $fields;            /** columns names retrieved after parsing */ 
    var $separator;    /** separator used to explode each line */
    var $enclosure;    /** enclosure used to decorate each field */

    var $max_row_size = 4096;    /** maximum row size to be used for decoding */

    function parse_file($p_Filepath, $columns) {
    
    	//some help
    	ini_set("auto_detect_line_endings", true);

        $file = fopen($p_Filepath, 'r');
        
        //make sure our column names are save
        $saveCols = array();
        
        foreach( $columns as $col ) {
        
        	$saveCols[] = preg_replace("/[^a-z0-9_]+/i", "", $col);
        
        } 
        
        $this->fields = $saveCols;
                        
        $keys_values = $this->fields;

        $content    =   array();
        $keys   =   $this->escape_string($keys_values);
        
        $i  =   1;
        while( ($row = fgetcsv($file, $this->max_row_size, $this->separator, $this->enclosure)) != false ) { 
                   
            if( $row != null ) { // skip empty lines
            
                $values = $row;
                                
                if(count($keys) == count($values)){
                
                    $arr    =   array();
                    $new_values =   array();
                    $new_values =   $this->escape_string($values);
                    
                    for($j=0;$j<count($keys);$j++){
                    
                        if($keys[$j] != ""){
                        
                            $arr[$keys[$j]] =   $new_values[$j];
                            
                        }
                        
                    }

                    $content[$i]=   $arr;
                    $i++;
                    
                }
                
            }
            
        }
        fclose($file);
        return $content;
    }

    function escape_string($data){
        $result =   array();
        foreach($data as $row){
            $result[]   =   str_replace('"', '',$row);
        }
        return $result;
    } 
    
    
    public function guessDelimiter($file)
    {
    
    	//some help
    	ini_set("auto_detect_line_endings", true);
    	
    	$handle = fopen($file,"r");
    	
    	$candidates = array(',', ';', "\t");
    	
    	foreach ($candidates as $candidatekey => $candidate) {
    	
    		$lastcnt = 0;
    	
    		$c = 0;
    	
    		while( $c < 3 ) {
    	
    			$line = fgets($handle);
    			    			
    			$thiscnt = substr_count($line, $candidate);
    			
    			if (($thiscnt == 0) || ($thiscnt != $lastcnt) && ($lastcnt != 0)) {
    				unset($candidates[$candidatekey]);
    			   	break;
    			}
    	
    			$c++;
    	
    		}
    	
    	}
    	    	
    	return array_shift($candidates);
    
    }
    
}