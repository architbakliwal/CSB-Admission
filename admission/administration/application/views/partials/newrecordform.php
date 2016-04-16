<form class="form" role="form" method="post" id="newRecordForm" action="<?php echo site_url('db/newRecord/'.$theTable);?>">

	<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
	
	<?php $counter = 0;?>

	<?php foreach($tableFields_ as $field):?>
	
		<?php if($counter >= 0):?>
		
		<div class="form-group">
				
			<?php if( isset($field['additional_data']['index']) && $field['additional_data']['index'] != 'none' ):?>
			<div class="alert alert-error">
				<button type="button" class="close fui-cross" data-dismiss="alert"></button>
			  	<p>
			  		This column set as the following index type: <b class="text-danger"><?php echo $field['additional_data']['index'];?></b>. Be careful with updating this column!
			  	</p>
			  	<?php if(isset($field['additional_data']['auto_increment'])):?>
			  	<p>
			  		This column is set to "<b>auto_increment</b>" and therefor can not be set.
			  	</p>
			  	<?php endif;?>
			</div>
			<?php endif;?>
				
				<?php if( isset($field['referenced_data']) ):?>
				
					<?php if( isset($field['additional_data']['index']) ):?>
					<div class="alert alert-error">
						<button type="button" class="close fui-cross" data-dismiss="alert"></button>
				  		<p>
				  			This column is connected to the table: <b><?php echo $field['reference_table']?></b>, displaying values from column: <b><?php echo $field['use_column'];?></b>.
				  		</p>
					</div>
					<?php endif;?>
				
					<select name="<?php echo $field['field'];?>" id="new_<?php echo $field['field']?>">
						<?php foreach( $field['referenced_data'] as $row ):?>
						<option value="<?php echo $row[$field['reference_table_key']]?>"><?php echo $row[$field['use_column']]?></option>
						<?php endforeach;?>
					</select>
					
				<?php elseif( isset($field['additional_data']['select']) ):?>
				
					<?php
						$optionArray = json_decode($field['additional_data']['select'], true);
					?>
					
					<select name="<?php echo $field['field'];?>" id="new_<?php echo $field['field']?>">
						<?php foreach( $optionArray as $option ):?>
						<option value="<?php echo $option;?>"><?php echo $option;?></option>
						<?php endforeach;?>
					</select>
		
		  		<?php elseif($field['type'] == 'text' || $field['type'] == 'blob'):?>
		  		
		  		<textarea class="form-control" rows="3" placeholder="<?php echo $field['field']?> - <?php echo $field['type'];?>" id="new_<?php echo $field['field']?>" name="<?php echo $field['field'];?>"></textarea>
		  		<label class="checkbox" for="html_<?php echo $field['field'];?>">
		  			<input type="checkbox" value="" id="html#<?php echo $field['field'];?>" data-toggle="checkbox" onchange="redactorfy('#new_<?php echo $field['field']?>')">
		  		  	HTML editor please
		  		</label>
		  		
		  		<?php else:?>
		  		
		  			<?php if( $field['type'] == 'date' ):?>
		  		
		  				<div class="input-group">
		  					<span class="input-group-btn">
		  			  			<button class="btn" type="button"><span class="fui-calendar"></span></button>
		  			  		</span>
		  			  		<input type="text" name="<?php echo $field['field'];?>" placeholder="YYYY-MM-DD" class="form-control date" value="" id="new_<?php echo $field['field']?>" style="position: relative; z-index: 2000;">
		  				</div>
		  		
		  			<?php else:?>
		  		
		  				<?php
		  					if( $field['type'] == 'int' ) {
		  						$type = "number";
		  					} elseif( $field['type'] == 'varchar' ) {
		  						$type = 'string (255 max)';
		  					}
		  				?>
		  		
		  				<textarea class="form-control" <?php if(isset($field['additional_data']['auto_increment'])):?>disabled<?php endif;?> rows="1" placeholder="<?php echo $field['field']?> - <?php echo $type;?>" id="new_<?php echo $field['field']?>" name="<?php echo $field['field']?>"></textarea>
		  		
		  			<?php endif;?>
		  		
		  		<?php endif;?>
		</div><!-- /.form-group -->
		
		<?php endif;?>
	
	<?php $counter++;?>
	
	<?php endforeach;?>
	
</form>