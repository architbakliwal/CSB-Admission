

	<input type="hidden" name="columnName_old" value="<?php if( isset($columnDetails) ) { echo $columnDetails['name']; }?>">
	
	<div class="form-group">
    	<label for="columnName" class="col-sm-4 control-label">Column name: <span class="red">*</span></label>
    	<div class="col-sm-8">
      		<input type="text" class="form-control" id="columnName" name="columnName" placeholder="Column name *" value="<?php if( isset($columnDetails) ) { echo $columnDetails['name']; }?>">
    	</div>
  	</div>
  	<div class="form-group">
    	<label for="columnType" class="col-sm-4 control-label">Column type: <span class="red">*</span></label>
    	<div class="col-sm-8 select-margin-bottom-0">
      		<select name="columnType" class="default select-block mbl">
      			<option value="">Choose a column type</option>
      		    <option value="int" <?php if( $columnDetails['type'] == 'int' || $columnDetails['type'] == 'tinyint' || $columnDetails['type'] == 'smallint' || $columnDetails['type'] == 'mediumint' || $columnDetails['type'] == 'bigint' || $columnDetails['type'] == 'float' || $columnDetails['type'] == 'double' || $columnDetails['type'] == 'decimal' ):?>selected<?php endif;?>>Number</option>
      		    <option value="varchar" <?php if( $columnDetails['type'] == 'varchar' && !isset($columnDetails['select']) ):?>selected<?php endif;?>>Small text (255 characters or less)</option>
      		    <?php if( $columnDetails['index'] == 'none' || $columnDetails['index'] == '' ):?>
      		    <option value="text" <?php if( $columnDetails['type'] == 'text' ):?>selected<?php endif;?>>Large text (more then 255 characters)</option>
      		    <option value="date" <?php if( $columnDetails['type'] == 'date' ):?>selected<?php endif;?>>Date (YYYY-MM-DD)</option>
      		    <option value="select" <?php if( $columnDetails['type'] == 'varchar' && isset($columnDetails['select']) ):?>selected<?php endif;?>>Select (choose from given options)</option>
      		    <option value="blob" <?php if( $columnDetails['type'] == 'blob' ):?>selected<?php endif;?>>Binary objects (files or images)</option>
      		    <?php endif;?>
      		</select>
    	</div>
  	</div>
  	<div class="form-group" <?php if( !isset($columnDetails['select']) ):?>style="display: none;"<?php endif;?> >
  		<label for="columnSelect" class="col-sm-4 control-label">Options: <span class="red">*</span></label>
  	 	<div class="col-sm-8 select-margin-bottom-0">
  	 		<?php
  	 			
  	 			if( isset($columnDetails['select']) ) {
  	 				
  	 				$optionArray = json_decode($columnDetails['select'], true);
  	 				$imploded = implode("\n", $optionArray);
  	 			
  	 			} else {
  	 			
  	 				$imploded = '';
  	 			
  	 			}
  	 			
  	 		?>
  	    	<textarea class="form-control" rows="3" id="columnSelect" name="columnSelect" placeholder="Please enter one option per row"><?php echo $imploded;?></textarea>
  	  </div>
  	</div>
  	<div class="form-group">
  		<label for="columnDefault" class="col-sm-4 control-label">Default value:</label>
  		<div class="col-sm-8">
  	  		<input type="text" class="form-control" id="columnDefault" name="columnDefault" placeholder="Default value" value="<?php if( isset($columnDetails) ) { echo $columnDetails['default']; }?>">
  		</div>
  	</div>
  	<?php if( $columnDetails['type'] != 'text' && $columnDetails['type'] != 'blob' ):?>
  	<div class="form-group">
  		<label for="columnIndex" class="col-sm-4 control-label">Index:</label>
  		<div class="col-sm-8 select-margin-bottom-0">
  			<select name="columnIndex" class="default select-block mbl">
  				<option value="">No index please</option>
  				<?php if( $columnDetails['index'] == 'primary' || !isset($hasPrimary) ):?>
  			    <option value="primary" <?php if( $columnDetails['index'] == 'primary' ):?>selected<?php endif;?> >Primary Key</option>
  			    <?php endif;?>
  			    <option value="unique" <?php if( $columnDetails['index'] == 'unique' ):?>selected<?php endif;?> >Unique</option>
  			    <option value="index" <?php if( $columnDetails['index'] == 'index' ):?>selected<?php endif;?> >Index (regular non-unique index)</option>
  			</select>
  		</div>
  	</div>
  	<?php endif;?>
  	<div class="form-group">
  		<label for="columnOffset" class="col-sm-4 control-label">Column position: <span class="red">*</span></label>
  		<div class="col-sm-8 select-margin-bottom-0">
  			<select name="columnOffset" class="default select-block mbl">
  				<option value="">Insert into table...</option>
  			    <option value="offset_-1" <?php if( $columnDetails['offset'] == "0" ):?>selected<?php endif;?>>At the front</option>
  			    <?php $counter = 0;?>
  			    
  			    <?php foreach($tableFields as $field):?>
  			    
  			    	<?php if($field['field'] != $columnDetails['name']):?>
  			    	<option value="offset_<?php echo $counter;?>" <?php if( (($counter+1) == $columnDetails['offset']) || ($counter == 0 && $columnDetails['offset'] == 0) ):?>selected<?php endif;?> >After <?php echo $field['field'];?></option>
  			    	<?php endif;?>
  			    	
  			    	<?php $counter++;?>
  			    	
  			    <?php endforeach?>
  			</select>
  		</div>
  	</div>
  	
  	<?php if( $table_engine == 'InnoDB' ):?>
  	
  	<hr>
  	
  	<div class="alert alert-error">
  		<button type="button" class="close fui-cross" data-dismiss="alert"></button>
  		<h4><span class="fui-alert"></span> Warning</h4>
  	  	<p>
  	  		By connecting this field to another table, <b>Databased</b> might need to modify this column where it finds invalid values.
  	  	</p>
  	  	<p>
  	  		By connecting this column to another table, this column can only hold values from the selected table > column (Databased will automatically generate the drop down select for these values).
  	  	</p>
  	</div>
  	
  	<div class="form-group">
  		<label for="connectTo" class="col-sm-4 control-label">Connect to: </label>
  		<div class="col-sm-8 select-margin-bottom-0">
  			<?php //print_r($tables);
  				//echo $columnDetails['foreign_key']['foreign_key'];
  			?>
  			<select name="connectTo" class="default select-block mbl">
  				<option value="">No connection...</option>
  				
  				<?php foreach( $tables as $table_=>$rows ):?>
  				
  					<?php if( $table_ != $table ):?>
  				
  						<?php foreach( $rows as $row ):?>
  						
  							<?php
  								if( isset($columnDetails['foreign_key']) ) {
  								
  									$temp = explode(".", $columnDetails['foreign_key']['foreign_key']);
  									
  									if( $temp[0] == $table_ && $columnDetails['foreign_key']['use_column'] == $row['field'] ) {
  									
  										$selected = 'yes';
  									
  									} else {
  									
  										$selected = 'no';
  									
  									}
  								
  								} else {
  								
  									$selected = 'no';
  								
  								}
  							?>
  					
  							<option value="<?php echo $table_;?>.<?php echo $row['field'];?>" <?php if( $selected == 'yes' ):?>selected<?php endif;?> ><?php echo $table_;?> => <?php echo $row['field'];?></option>
  					
  						<?php endforeach;?>
  					
  					<?php endif;?>
  				
  				<?php endforeach;?>
  				
  			</select>
  		</div>
  	</div>
  	
  	<?php endif;?>
  	