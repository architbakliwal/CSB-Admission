<!-- Modal -->
<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('columns/addColumn/'.$theTable);?>" id="newColumnForm">
<div class="modal fade" id="newColumnModal" tabindex="-1" role="dialog" aria-labelledby="newColumnModal" aria-hidden="true">

	<div class="modal-dialog">
	
    	<div class="modal-content">
    	
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id="fieldModalLabel"><span class="fui-list-numbered"></span> Add Column</h4>
      		</div>
      		
      		<div class="modal-body">
      		
      			<ul class="nav nav-tabs nav-append-content">
      				<li class="active"><a href="#newColumnModal_tab1">Column details</a></li>
      				<li><a href="#newColumnModal_tab2">Restrictions</a></li>
      			</ul> <!-- /tabs -->
      			
      			<div class="tab-content">
      			
      				<div class="tab-pane fade in active" id="newColumnModal_tab1">
      			    	
      			    	<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
      			    		
      			    	<div class="form-group">
      			    	   	<label for="columnName" class="col-sm-3 control-label">Column name: <span class="red">*</span></label>
      			    	    <div class="col-sm-9">
      			    	      	<input type="text" class="form-control" id="columnName" name="columnName" placeholder="Column name *">
      			    	    </div>
      			   		</div>
      			  		<div class="form-group">
      			    		<label for="columnType" class="col-sm-3 control-label">Column type: <span class="red">*</span></label>
      			    	   	<div class="col-sm-9 select-margin-bottom-0">
      			    	      	<select name="columnType" class="default select-block mbl">
      			    	      		<option value="">Choose a column type</option>
      			    	      		<option value="int">Number</option>
      			    	      		<option value="varchar">Small text (255 characters or less)</option>
      			    	      		<option value="text">Large text (more then 255 characters)</option>
      			    	      		<option value="date">Date (YYYY-MM-DD)</option>
      			    	      		<option value="select">Select (choose from given options)</option>
      			    	      		<option value="blob">Binary objects (files or images)</option>
      			    	      	</select>
      			    	    </div>
      			  		</div>
      			  		<div class="form-group" style="display: none;">
      			  			<label for="columnSelect" class="col-sm-3 control-label">Options: <span class="red">*</span></label>
      			  		 	<div class="col-sm-9 select-margin-bottom-0">
      			  		    	<textarea class="form-control" rows="3" id="columnSelect" name="columnSelect" placeholder="Please enter one option per row"></textarea>
      			  		  </div>
      			  		</div>
      			    	<div class="form-group">
      			    	  	<label for="columnDefault" class="col-sm-3 control-label">Default value:</label>
      			    	  	<div class="col-sm-9">
      			    	  	  	<input type="text" class="form-control" id="columnDefault" name="columnDefault" placeholder="Default value">
      			    	  	</div>
      			 		</div>
      			    	<div class="form-group">
      			    		<label for="columnIndex" class="col-sm-3 control-label">Index:</label>
      			    	  	<div class="col-sm-9 select-margin-bottom-0">
      			    	  		<select name="columnIndex" class="default select-block mbl">
      			    	  			<option value="">No index please</option>
      			    	  			<?php if( !isset($hasPrimary) ):?>
      			    	  			<option value="primary">Primary Key</option>
      			    	  			<?php endif;?>
      			    	  			<?php if( $nrOfFields == 0 ):?>
      			    	  			<option value="unique">Unique</option>
      			    	  			<?php endif;?>
      			    	  			<option value="index">Index (regular non-unique index)</option>
      			    	  		</select>
      			    	  	</div>
      			  		</div>
      			    	<div class="form-group">
      			    		<label for="columnOffset" class="col-sm-3 control-label">Col position: <span class="red">*</span></label>
      			    	  	<div class="col-sm-9 select-margin-bottom-0">
      			    	  		<select name="columnOffset" class="default select-block mbl">
      			    	  			<option value="">Insert into table...</option>
      			    	  			<option value="end">At the end</option>
      			    	  			<?php $counter = 0;?>
      			    	  				
      			    	  			<?php foreach($tableFields as $field):?>
      			    	  			<option value="offset_<?php echo $counter;?>">After <?php echo $field['field'];?></option>
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
      			    	  		By connecting this column to another table, <b>Databased</b> might need to modify this column where it finds invalid values.
      			    	  	</p>
      			    	  	<p>
      			    	  		By connecting this column to another table, this column can only hold values from the selected table > column (Databased will automatically generate the drop down select for these values).
      			    	  	</p>
      			    	</div>
      			    	  	
      			    	<div class="form-group">
      			    	  	<label for="connectTo" class="col-sm-3 control-label">Connect to: </label>
      			    	  	<div class="col-sm-9 select-margin-bottom-0">
      			    	  		<select name="connectTo" class="default select-block mbl">
      			    	  			<option value="">No connection ...</option>
      			    	  				
      			    	  			<?php foreach( $tabless as $table_=>$rows ):?>
      			    	  				
      			    	  				<?php if( $table_ != $theTable ):?>
      			    	  				
      			    	  					<?php foreach( $rows as $row ):?>
      			    	  						
      			    	  						<option value="<?php echo $table_;?>.<?php echo $row['field'];?>"><?php echo $table_;?> => <?php echo $row['field'];?></option>
      			    	  					
      			    	  					<?php endforeach;?>
      			    	  					
      			    	  				<?php endif;?>
      			    	  				
      			    	  			<?php endforeach;?>
      			    	  				
      			    	  		</select>
      			    	  	</div>
      			   		</div>
      			    	  	
      			   		<?php endif;?>
      			    	       		    	            		    	
      				</div>
      			
      			    <div class="tab-pane fade" id="newColumnModal_tab2">
      			    
      			    	<div class="alert alert-info">
      			    		<button type="button" class="close fui-cross" data-dismiss="alert"></button>
      			    	  	<h4>Column restrictions</h4>
      			    	  	<p>
      			    	  		There are a variety of restrictions you set on each column. To learn more about the available restrictions, please click the button below:
      			    	  	</p>
      			    	  	<a href="<?php echo site_url('doc/columnrestrictions');?>" class="btn btn-info btn-wide" target="_blank">Available restrictions <span class="fui-export"></span></a>
      			    	</div>
      			    
      			    	<?php $this->load->view("partials/columnrestrictions");?>
      			    	      			 		
      				</div>
      			
      			</div> <!-- /tab-content -->
        		
      		</div><!-- /.modal-body -->
      		
      		<div class="modal-footer">
      			
      			<button type="button" class="btn btn-info btn-embossed" id="newColumnModal_addcolumn">Add column</button>
        		<button type="button" class="btn btn-default btn-embossed" id="newColumnModal_close" data-dismiss="modal">Close window</button>
        		
      		</div>
      		
    	</div><!-- /.modal-content -->
    	
  	</div><!-- /.modal-dialog -->
  	
</div><!-- /.modal -->
</form>
