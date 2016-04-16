<div class="panel-group margin-bottom-15 columnRestrictions" id="columnRestrictions">

	<!-- templ -->
	<div class="panel panel-default template" style="display: none;" id="newRestrictionTempl">
		<div class="panel-heading">
	  		<h4 class="panel-title">
	    		<a data-toggle="collapse" data-parent="#columnRestrictions" href="#restriction1">
	      			Restriction <b></b>
	    		</a>
	  		</h4>
		</div>
		<div id="" class="panel-collapse collapse in">
	  		<div class="panel-body">
	  		      			    		  		
	  			<div class="form-group">
	  				<label for="value" class="col-sm-3 control-label">Restriction: </label>
	  				<div class="col-sm-9 select-margin-bottom-0">
	    				<select class="default select-block mbl restriction">
	    					<option value="">Select a restriction</option>
	    					<option value="required">required</option>
	    					<option value="min_length" class="value">min_length</option>
	    					<option value="max_length" class="value">max_length</option>
	    					<option value="exact_length" class="value">exact_length</option>
	    					<option value="greater_than" class="value">greater_than</option>
	    					<option value="less_than" class="value">less_than</option>
	    					<option value="alpha">alpha</option>
	    					<option value="alpha_numeric">alpha_numeric</option>
	    					<option value="alpha_dash">alpha_dash</option>
	    					<option value="numeric">numeric</option>
	    					<option value="integer">integer</option>
	    					<option value="is_natural">is_natural</option>
	    					<option value="is_natural_no_zero">is_natural_no_zero</option>
	    					<option value="valid_email">valid_email</option>
	    					<option value="valid_emails">valid_emails</option>
	    					<option value="valid_ip">valid_ip</option>
	    				</select>
	    			</div>
	    		</div>
	    		
	    		<div class="form-group">
	    			<label for="value" class="col-sm-3 control-label">Value: </label>
	    			<div class="col-sm-9">
	    		  		<input type="number" id="value" value="" placeholder="Value" class="form-control value" disabled>
	    		  	</div>
	    		</div>
	    			
	    		<hr>
	    			
	    		<div class="form-group margin-bottom-0">
	    			<div class="col-sm-12">
	    				<a href="#" class="btn btn-embossed btn-sm btn-danger pull-right delRestriction">remove restriction</a>
	    			</div>
	    		</div><!-- /.form-group -->
	    		      			    		    		
	  		</div>
		</div>
	</div>
	<!-- /templ -->
	
	<?php if( !isset($columnRestrictions) || $columnRestrictions == false ):?>
	
	<!-- no restrictions yet -->
	
	<div class="panel panel-default">
    	<div class="panel-heading">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#columnRestrictions" href="#restriction1">
          			Restriction <b>1</b>
        		</a>
      		</h4>
    	</div>
    	<div id="" class="panel-collapse collapse in">
      		<div class="panel-body">
      			      			    	      			
      			<div class="form-group">
      				<label for="value" class="col-sm-3 control-label">Restriction: </label>
      				<div class="col-sm-9 select-margin-bottom-0">
        				<select name="restrictions[1][restriction]" class="default select-block mbl restriction">
        					<option value="">Select a restriction</option>
        					<option value="required">required</option>
        					<option value="min_length" class="value">min_length</option>
        					<option value="max_length" class="value">max_length</option>
        					<option value="exact_length" class="value">exact_length</option>
        					<option value="greater_than" class="value">greater_than</option>
        					<option value="less_than" class="value">less_than</option>
        					<option value="alpha">alpha</option>
        					<option value="alpha_numeric">alpha_numeric</option>
        					<option value="alpha_dash">alpha_dash</option>
        					<option value="numeric">numeric</option>
        					<option value="integer">integer</option>
        					<option value="is_natural">is_natural</option>
        					<option value="is_natural_no_zero">is_natural_no_zero</option>
        					<option value="valid_email">valid_email</option>
        					<option value="valid_emails">valid_emails</option>
        					<option value="valid_ip">valid_ip</option>
        				</select>
        			</div>
        		</div>
        		
        		<div class="form-group">
        			<label for="value" class="col-sm-3 control-label">Value: </label>
        			<div class="col-sm-9">
        		  		<input type="number" name="restrictions[1][value]" id="value" value="" placeholder="Value" class="form-control value" disabled>
        		  	</div>
        		</div>
        			
        		<hr>
        		
        		<div class="form-group margin-bottom-0">
        			<div class="col-sm-12">
        				<a href="#" class="btn btn-embossed btn-sm btn-danger pull-right delRestriction">remove restriction</a>
        			</div>
        		</div><!-- /.form-group -->
        		      			    	        		
      		</div>
    	</div>
  	</div><!-- /.panel -->
  	
  	<?php else:?>
  	
  	<!-- show existing restrictions -->
  	
  		<?php $counter = 1;?>
  		
  		<?php foreach( $columnRestrictions as $restriction ):?>
  		
  		<div class="panel panel-default">
  			<div class="panel-heading">
  		  		<h4 class="panel-title">
  		    		<a data-toggle="collapse" data-parent="#columnRestrictions" href="#restriction1">
  		      			Restriction <b><?php echo $counter?></b>
  		    		</a>
  		  		</h4>
  			</div>
  			<div id="" class="panel-collapse collapse in">
  		  		<div class="panel-body">
  		  		
  		  			<?php 
  		  			
  		  				$temp = explode("[", $restriction);
  		  				
  		  				$restriction = $temp[0];
  		  				
  		  				if( isset($temp[1]) ) {
  		  				  		  				
  		  					$value = substr($temp[1], 0, -1);
  		  				
  		  				}
  		  			
  		  			?>
  		  			      			    	      			
  		  			<div class="form-group">
  		  				<label for="value" class="col-sm-3 control-label">Restriction: </label>
  		  				<div class="col-sm-9 select-margin-bottom-0">
  		    				<select name="restrictions[<?php echo $counter?>][restriction]" class="default select-block mbl restriction">
  		    					<option value="">Select a restriction</option>
  		    					<option value="required" <?php if($restriction == 'required'):?>selected<?php endif;?> >required</option>
  		    					<option value="min_length" class="value" <?php if($restriction == 'min_length'):?>selected<?php endif;?>>min_length</option>
  		    					<option value="max_length" class="value" <?php if($restriction == 'max_length'):?>selected<?php endif;?>>max_length</option>
  		    					<option value="exact_length" class="value" <?php if($restriction == 'exact_length'):?>selected<?php endif;?>>exact_length</option>
  		    					<option value="greater_than" class="value" <?php if($restriction == 'greater_than'):?>selected<?php endif;?>>greater_than</option>
  		    					<option value="less_than" class="value" <?php if($restriction == 'less_than'):?>selected<?php endif;?>>less_than</option>
  		    					<option value="alpha" <?php if($restriction == 'alpha'):?>selected<?php endif;?>>alpha</option>
  		    					<option value="alpha_numeric" <?php if($restriction == 'alpha_numeric'):?>selected<?php endif;?> >alpha_numeric</option>
  		    					<option value="alpha_dash" <?php if($restriction == 'alpha_dash'):?>selected<?php endif;?>>alpha_dash</option>
  		    					<option value="numeric" <?php if($restriction == 'numeric'):?>selected<?php endif;?>>numeric</option>
  		    					<option value="integer" <?php if($restriction == 'integer'):?>selected<?php endif;?>>integer</option>
  		    					<option value="is_natural" <?php if($restriction == 'is_natural'):?>selected<?php endif;?>>is_natural</option>
  		    					<option value="is_natural_no_zero" <?php if($restriction == 'is_natural_no_zero'):?>selected<?php endif;?>>is_natural_no_zero</option>
  		    					<option value="valid_email" <?php if($restriction == 'valid_email'):?>selected<?php endif;?>>valid_email</option>
  		    					<option value="valid_emails" <?php if($restriction == 'valid_emails'):?>selected<?php endif;?>>valid_emails</option>
  		    					<option value="valid_ip" <?php if($restriction == 'valid_ip'):?>selected<?php endif;?>>valid_ip</option>
  		    				</select>
  		    			</div>
  		    		</div>
  		    		
  		    		<div class="form-group">
  		    			<label for="value" class="col-sm-3 control-label">Value: </label>
  		    			<div class="col-sm-9">
  		    		  		<input type="number" name="restrictions[<?php echo $counter?>][value]" id="value" value="<?php if(isset($value)){echo $value;}?>" placeholder="Value" class="form-control value" <?php if( !isset($value) ):?>disabled<?php endif;?>>
  		    		  	</div>
  		    		</div>
  		    		
  		    		<?php 
  		    			if( isset($value) ) {
  		    			
  		    				unset($value);
  		    			
  		    			}
  		    		?>
  		    			
  		    		<hr>
  		    		
  		    		<div class="form-group margin-bottom-0">
  		    			<div class="col-sm-12">
  		    				<a href="#" class="btn btn-sm btn-embossed btn-danger pull-right delRestriction">remove restriction</a>
  		    			</div>
  		    		</div><!-- /.form-group -->
  		    		      			    	        		
  		  		</div>
  			</div>
  		</div><!-- /.panel -->
  		
  		<?php $counter++;?>
  		<?php endforeach;?>
  	
  	
  	<?php endif;?>
  	      			    	  	
</div><!-- /.panel-group / -->

<a href="#" class="addColumnLink margin-bottom-15 addRestrictionLink" id=""><span class="fui-plus"></span> Add another restriction</a>