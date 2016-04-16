<!-- Modal -->
<div class="modal fade" id="newTableModal" tabindex="-1" role="dialog" aria-labelledby="newTableModal" aria-hidden="true">

	<div class="modal-dialog">
	
    	<div class="modal-content">
    	
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id=""><span class="fui-list-small-thumbnails"></span> Add Table</h4>
      		</div>
      		
      		<div class="modal-body">
      		
      			<ul class="nav nav-tabs nav-append-content">
      				<li class="active"><a href="#build">Build table</a></li>
     				<li><a href="#import">Import data</a></li>
    			</ul> <!-- /tabs -->
      			
      			<div class="tab-content">
      			
     				<div class="tab-pane active" id="build">
     				
     					<form class="form-horizontal" role="form" id="newTableForm" method="post" action="<?php echo site_url('db/newTable');?>">
     					
     						<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
     						
     						<div class="form-group">
     					    	<label for="tableName" class="col-sm-3 control-label">Table name: <span class="red">*</span></label>
     					    	<div class="col-sm-9">
     					      		<input type="text" class="form-control" id="tableName" name="tableName" placeholder="Table name *">
     					    	</div>
     					  	</div>
     					  	
     					  	<div class="form-group">
     					    	<label for="inputPassword3" class="col-sm-3 control-label">Columns: <span class="red">*</span></label>
     					    	<div class="col-sm-9 select-margin-bottom-0">
     					      		
     					      		<div class="panel-group" id="columnAccordion">
     					      			
     					      			<!-- templ -->
     					      			<div class="panel panel-default" style="display: none;" id="newColumn_templ">
     					      				<div class="panel-heading">
     					      			  		<h4 class="panel-title">
     					      			    		<a data-toggle="collapse" data-parent="#columnAccordion" href="#collapse">
     					      			      			<b>Column 1</b> <span class="pull-right">(click to expand)</span>
     					      			    		</a>
     					      			  		</h4>
     					      				</div>
     					      				<div id="collapse" class="panel-collapse collapse">
     					      			  		<div class="panel-body">
     					      			    		
     					      			    		<div class="form-group">
     					      			    		  	<input type="text" class="form-control columName" name="" placeholder="Column name *">
     					      			    		</div>
     					      			    		<div class="form-group">
     					      			    		  	<select name="" class="default select-block mbl columnType">
     					      			    		  		<option value="">Choose a column type</option>
     					      			    		  		<option value="int">Number</option>
     					      			    		  		<option value="varchar">Small text (255 characters or less)</option>
     					      			    		  		<option value="text">Large text (more then 255 characters)</option>
     					      			    		  		<option value="date">Date (YYYY-MM-DD)</option>
     					      			    		  		<option value="blob">Binary objects (files or images)</option>
     					      			    		  		<option value="select">Select (choose from given options)</option>
     					      			    		  	</select>
     					      			    		</div>
     					      			    		<div class="form-group" style="display: none;">
     					      			    		    <textarea class="form-control columnSelect" rows="3" id="columnSelect" name="columnSelect" placeholder="<?php echo $this->lang->line('table_popup_column_options_label')?>"></textarea>
     					      			    		</div>
     					      			    		<div class="form-group">
     					      			    			<input type="text" class="form-control columnDefault" name="" placeholder="Default value">
     					      			    		</div>
     					      			    		<div class="form-group">
     					      			    			<select name="" class="default select-block mbl columnIndex" placeholder="Index?">
     					      			    				<option value="">No index please</option>
     					      			    				<option value="unique">Unique</option>
     					      			    				<option value="index">Index (regular non-unique index)</option>
     					      			    			</select>
     					      			    		</div>
     					      			    		
     					      			  		</div><!-- /.panel-body -->
     					      				</div><!-- /.panel-collape -->
     					      			</div><!-- /.panel -->
     					      			<!-- /templ -->
     					      			
     					      			<div class="panel panel-default">
     					      		    	<div class="panel-heading">
     					      		      		<h4 class="panel-title">
     					      		        		<a data-toggle="collapse" data-parent="#columnAccordion" href="#collapse1">
     					      		          			<b>Column 1</b> <span class="pull-right">(click to expand)</span>
     					      		        		</a>
     					      		      		</h4>
     					      		    	</div>
     					      		    	<div id="collapse1" class="panel-collapse collapse in">
     					      		      		<div class="panel-body">
     					      		      		
     					      		      			<div class="alert alert-info">
     					      		      				<button type="button" class="close fui-cross" data-dismiss="alert"></button>
     					      		      			  	The first column of your new table will automatically be setup as the primary key of the new table. We suggest you also set this column to "auto-increment".
     					      		      			</div>
     					      		        		
     					      		        		<div class="form-group">
     					      		        		  	<input type="text" class="form-control columName" id="columnName" name="columns[1][columnName]" placeholder="Column name *">
     					      		        		</div>
     					      		        		<label class="checkbox" for="auto-increment">
     					      		        			<input type="checkbox" value="yes" name="auto-increment" id="auto-increment" data-toggle="checkbox" checked>
     					      		        			Set column to "auto-increment"?  	
     						      		      		</label>
     					      		        		      			      		        			
     					      		      		</div><!-- /.panel-body -->
     					      		    	</div><!-- /.panel-collape -->
     					      		  	</div><!-- /.panel -->
     					      		  	
     					      		</div><!-- /.panel-group -->
     					      		      			      		
     					      		<a href="#" class="addColumnLink" id="addColumnLink"><span class="fui-plus"></span> Add Another Column</a>
     					      		
     					    	</div><!-- /.col-sm-9 -->
     					  	</div><!-- /.form-group -->
     					  	
     					  	<?php if( $this->usermodel->hasDBPermission("create") && !$this->ion_auth->is_admin() ):?>
     					  	<div class="form-group">
     					  	
     					  		<label for="tableName" class="col-sm-3 control-label">Permissions: <span class="red">*</span></label>
     					  		<div class="col-sm-9">
     					  			<label class="radio no-top-padding">
     					  				<input type="radio" name="share" id="optionsRadios1" value="private" data-toggle="radio" checked>
     					  			  	Keep this table private (only you + admins will have access)
     					  			</label>
     					  			<label class="radio no-top-padding">
     					  			  	<input type="radio" name="share" id="optionsRadios2" value="group" data-toggle="radio">
     					  			  	Share with my group (<?php 
     					  			  	
     					  			  		$tempp = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->id)->result();
     					  			  		
     					  			  		echo $tempp[0]->description;
     					  			  		
     					  			  	?>)
     					  			</label>
     					  			<label class="radio no-top-padding">
     					  			  	<input type="radio" name="share" id="optionsRadios3" value="all" data-toggle="radio">
     					  			  	Share with everyone
     					  			</label>
     					  		</div>
     					  	
     					  	</div><!-- /.form-group -->
     					  	<?php endif;?>
     					  	
     					</form>
     					
     				</div><!-- /.tab-pane -->
      			
    				<div class="tab-pane" id="import">
    				
    					<div class="alert alert-info">
    						<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    					  	<p>
    					  		Use the form below to import a CSV file from your computer. <b>Databased</b> will turn this file into a table after uploading it.
    					  	</p>
    					</div>
    				
     					<form enctype="multipart/form-data" method="post" id="uploadForm" action="<?php echo site_url("db/uploadCsv")?>">
     					
     						<div class="form-group">
     							
     							<input type="text" name="tableName" class="form-control" id="tableName" placeholder="Table name">
     						
     						</div><!-- /.form-group -->
     					
     						<div class="form-group">
     						
     							<div class="fileinput fileinput-new" data-provides="fileinput">
     								<div class="input-group">
     									<div class="form-control uneditable-input" data-trigger="fileinput">
     										<span class="fui-clip fileinput-exists"></span>
     										<span class="fileinput-filename"></span>
     									</div>
     									<span class="input-group-btn btn-file">					    	
     										<span class="btn btn-default fileinput-new" data-role="select-file">Select file</span>
     										<span class="btn btn-default fileinput-exists" data-role="change">
     											<span class="fui-gear"></span>&nbsp;&nbsp;Change
     										</span>
     										<input type="file" name="thefile" id="thefile">
     										<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">
     											<span class="fui-trash"></span>&nbsp;&nbsp;Remove
     										</a>					    	
     									</span>					    
     								</div><!-- /.input-group -->
     							</div><!-- /.fileinput -->
     							
     						</div><!-- /.form-group -->
     						
     						<div class="form-group">
     						
     							<label class="checkbox" for="columns">
     								<input type="checkbox" name="columns" value="yes" id="columns" data-toggle="checkbox">
     							  	First row contains column names
     							</label>
     						
     						</div><!-- /.form-group -->
     						
     						<div class="panel-group margin-bottom-15" id="accordion">
     						
     							<div class="panel panel-default">
     						    	<div class="panel-heading">
     						      		<h4 class="panel-title">
     						        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
     						          			<span class="fui-gear"></span> Advanced options
     						        		</a>
     						      		</h4>
     						    	</div>
     						    	<div id="collapseOne" class="panel-collapse collapse">
     						      		<div class="panel-body">
     						        		
     						        		<div class="form-group">
     						        		
     						        			<label>Columns separated by (default is ','):</label>
     						        			<input type="text" class="form-control" name="separateColumns" id="separateColumns" placeholder="," value="">
     						        		
     						        		</div><!-- /.form-group -->
     						        		
     						        		<div class="form-group">
     						        		
     						        			<label>Columns enclosed by (single character, default is '"'):</label>
     						        			<input type="text" class="form-control" name="encloseColumns" id="encloseColumns" placeholder='"' value=''>
     						        		
     						        		</div><!-- /.form-group -->
     						        		
     						        		<!--<div class="form-group">
     						        		
     						        			<label>Lines terminated with ("\n", "\r\n" or "\r"):</label>
     						        			<input type="text" class="form-control" name="newLine" id="newLine" placeholder="\n" value=''>
     						        		
     						        		</div>--><!-- /.form-group -->
     						        		
     						      		</div>
     						    	</div>
     						  	</div><!-- /.panel -->
     						  
     						</div><!-- /.panel-group -->
     						
     						<?php if( $this->usermodel->hasDBPermission("create") && !$this->ion_auth->is_admin() ):?>
     						<div class="form-group clearfix">
     						
     							<label for="tableName" class="col-sm-3 control-label">Permissions: <span class="red">*</span></label>
     							<div class="col-sm-9">
     								<label class="radio no-top-padding">
     									<input type="radio" name="share" id="optionsRadios1" value="private" data-toggle="radio" checked>
     								  	Keep this table private (only you + admins will have access)
     								</label>
     								<label class="radio no-top-padding">
     								  	<input type="radio" name="share" id="optionsRadios2" value="group" data-toggle="radio">
     								  	Share with my group (<?php 
     								  	
     								  		$tempp = $this->ion_auth->get_users_groups($this->ion_auth->user()->row()->id)->result();
     								  		
     								  		echo $tempp[0]->description;
     								  		
     								  	?>)
     								</label>
     								<label class="radio no-top-padding">
     								  	<input type="radio" name="share" id="optionsRadios3" value="all" data-toggle="radio">
     								  	Share with everyone
     								</label>
     							</div>
     						
     						</div><!-- /.form-group -->
     						<?php endif;?>
     					
     					</form>
     					
     				</div><!-- /.tab-pane -->
     				
    			</div> <!-- /tab-content -->
      		        		
      		</div><!-- /.modal-body -->
      		
      		<div class="modal-footer">
      			
      			<button type="button" class="btn btn-info btn-embossed" id="newTableModal_addtable">Add table</button>
      			<button type="button" class="btn btn-info btn-embossed" id="newTableModal_import">Import file and create table</button>
        		<button type="button" class="btn btn-default btn-embossed" id="newTableModal_close" data-dismiss="modal">Close window</button>
        		
      		</div>
      		
    	</div><!-- /.modal-content -->
    	
  	</div><!-- /.modal-dialog -->
  	
</div><!-- /.modal -->
