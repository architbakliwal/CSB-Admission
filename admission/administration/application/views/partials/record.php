<form action="<?php echo site_url('db/updateRecord/'.$theTable."/".$indexName."/".$recordID);?>" method="post" id="recordForm">

	<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">

	<div class="panel-group margin-bottom-15" id="recordDetails">
	
		<?php
			$counter = 0;
		?>

		<?php foreach($recordData as $field=>$value):?>
		
		<?php if($counter >= 0):?>
		<div class="panel panel-default">
    		<div class="panel-heading">
      			<h4 class="panel-title">
        			<a data-toggle="collapse" data-parent="#recordDetails" href="#collapse_<?php echo $field;?>">
          				<?php echo $field;?>
        			</a>
      			</h4>
    		</div>
    		<div id="collapse_<?php echo $field;?>" class="panel-collapse collapse">
      			<div class="panel-body">
      			
      				<?php if( isset($value['additional_data']['index']) && $value['additional_data']['index'] != 'none' ):?>
      				<div class="alert alert-error">
      					<button type="button" class="close fui-cross" data-dismiss="alert"></button>
      				  	<p>
      				  		This column set as the following index type: <b class="text-danger"><?php echo $value['additional_data']['index'];?></b>. Be careful with updating this column!
      				  	</p>
      				  	<?php if(isset($value['additional_data']['auto_increment'])):?>
      				  	<p>
      				  		This column is set to "<b>auto_increment</b>" and therefor can not be updated.
      				  	</p>
      				  	<?php endif;?>
      				</div>
      				<?php endif;?>
      			      			
      				<?php if( !isset($value['reference_table']) ):?>
      				      			
      					<?php if(strlen($value['val']) > 255):?>
      			
      						<textarea name="<?php echo $field;?>" class="form-control" rows="3" placeholder="Enter your text here" id="<?php echo $field?>-text" placeholder="Enter your text here"><?php echo $value['val'];?></textarea>
      						<label class="checkbox" for="html_<?php echo $field;?>">
      							<input type="checkbox" value="" id="html#<?php echo $field;?>text" data-toggle="checkbox" onchange="redactorfy('#<?php echo $field?>-text')">
      				  			HTML editor please
      						</label>
      			
      					<?php else:?>
      					
      						<?php
      						
      							//check if this is a date field
      						
      							$temp = explode("-", $value['val']);
      							
      							if( count($temp) == 3 ):
      						
      						?>
      						
      							<div class="input-group">
      								<span class="input-group-btn">
      							  		<button class="btn" type="button"><span class="fui-calendar"></span></button>
      							  	</span>
      							  	<input type="text" name="<?php echo $field;?>" class="form-control date" value="<?php echo $value['val'];?>" id="<?php echo $field?>-text" style="position: relative; z-index: 2000;">
      							</div>
      							
      						<?php elseif( isset($value['additional_data']['select']) ):?>
      						
      							<?php
      								$optionArray = json_decode($value['additional_data']['select'], true);
      							?>
      							
      							<select name="<?php echo $field;?>" id="<?php echo $field?>-text">
      								<?php foreach( $optionArray as $option ):?>
      								<option <?php if( $value['val'] == $option ):?>selected<?php endif;?> value="<?php echo $option;?>"><?php echo $option;?></option>
      								<?php endforeach;?>
      							</select>
      						
      						<?php else:?>
      			
      							<textarea <?php if(isset($value['additional_data']['auto_increment'])):?>disabled<?php endif;?> name="<?php echo $field;?>" class="form-control" rows="1" placeholder="Enter your text here" id="<?php echo $field?>-text"><?php echo $value['val'];?></textarea>
      							<?php if(!isset($value['additional_data']['auto_increment'])):?>
      							<label class="checkbox" for="html_<?php echo $field;?>">
      							<input type="checkbox" value="" id="html#<?php echo $field;?>text" data-toggle="checkbox" onchange="redactorfy('#<?php echo $field?>-text')">
      				  		HTML editor please
      							</label>
      							<?php endif;?>
      						
      						<?php endif;?>
      			
      					<?php endif;?>
      				
      				<?php else:?>
      				      				
      					<select name="<?php echo $field;?>" id="<?php echo $field?>-text">
      						<?php foreach( $value['referenced_data'] as $row ):?>
      						<option value="<?php echo $row[$value['reference_table_key']]?>" <?php if( $row[$value['reference_table_key']] == $value['val'] ):?>selected<?php endif;?>><?php echo $row[$value['use_column']]?></option>
      						<?php endforeach;?>
      					</select>
      				
      				<?php endif;?>
        		
      			</div>
    		</div>
		</div><!-- /.panel -->
		<?php endif;?>
		
		<?php $counter++;?>
		
		<?php endforeach;?>
		
	</div><!-- .panel-group -->

</form>