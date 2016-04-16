<!-- modal -->
<form class="form" role="form" method="post" action="<?php echo site_url('roles/create');?>" id="newRoleForm">
<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
<div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title"><span class="fui-myspace"></span> Create new role</h4>
      		</div>
      		<div class="modal-body">
      		
        		<div class="form-group">
        			<input type="text" class="form-control" name="role" id="role" placeholder="Role name *">
        		</div>
        		
        		<div class="form-group">
        			<textarea class="form-control" name="roleDescr" id="roleDescr" placeholder="Description" rows="3"></textarea>
        		</div>
        		
        		<div class="form-group">
        			<label class="checkbox" for="_admin_users" style="padding-top: 0px;">
        			  <input type="checkbox" value="yes" id="_admin_users" name="admin_users" data-toggle="checkbox">
        			  Allow user administration?
        			</label>
        		</div>
        		
        		<div class="form-group">
        			<label class="checkbox" for="default" style="padding-top: 0px;">
        			  <input type="checkbox" value="1" id="default" name="default" data-toggle="checkbox">
        			  Set as default role?
        			</label>
        		</div>
        		
        		<hr>
        		<div class="form-group">
        		  	
        			<h6>Configure database and table permissions</h6>
        		  			
        		  			        	<div class="table-responsive">
        		  			        		<table class="table permissionTable">
        		  			        			<thead>
        		  			        		    	<tr>
        		  			        		      		<th style="width: 35px;">
        		  			        		      			<label class="checkbox no-label toggle-all" for="permAll">
        		  			        		      				<input type="checkbox" value="" id="permAll" data-toggle="checkbox">
        		  			        		      			</label>
        		  			        		      		</th>
        		  			        		      		<th>Permission</th>
        		  			        		    	</tr>
        		  			        		    </thead>
        		  			        		    <tbody>
        		  			        		    	<tr>
        		  			        		      		<td>
        		  			        		      			<label class="checkbox no-label" for="_create">
        		  			        		      				<input type="checkbox" value="yes" id="_create" data-toggle="checkbox" name="permissions[create]">
        		  			        		      			</label>
        		  			        		      		</td>
        		  			        		      		<td>Create tables within this database</td>
        		  			        		    	</tr>
        		  			        		    	<tr>
        		  			        		    		<td>
        		  			        		    			<label class="checkbox no-label" for="_drop">
        		  			        		    				<input type="checkbox" value="yes" id="_drop" data-toggle="checkbox" name="permissions[drop]">
        		  			        		    			</label>
        		  			        		    		</td>
        		  			        		    		<td>Delete tables within this database</td>
        		  			        		    	</tr>
        		  			        		    </tbody>
        		  			        		</table>
        		  			        	</div><!-- /.table-responsive -->
        		  			        		
        		  			        	<div class="panel-group" id="_tables">
        		  			        		
        		  			        		<?php if(isset($tables)):?>
        		  			        			
        		  			        		<?php foreach($tables as $table):?>
        		  			        		<div class="panel panel-default">
        		  			        		    <div class="panel-heading">
        		  			        		      	<h4 class="panel-title">
        		  			        		        	<a data-toggle="collapse" data-parent="#_tables" href="#table_<?php echo $table['table']?>">
        		  			        		          		Table: <?php echo $table['table']?>
        		  			        		        	</a>
        		  			        		      	</h4>
        		  			        		    </div>
        		  			        		   	<div id="table_<?php echo $table['table']?>" class="panel-collapse collapse">
        		  			        		      	<div class="panel-body">
        		  			        		        		
        		  			        		        	<div class="table-responsive">
        		  			        		        		<table class="table permissionTable">
        		  			        		        			<thead>
        		  			        		        		    	<tr>
        		  			        		        		      		<th style="width: 35px;">
        		  			        		        		      			<label class="checkbox no-label toggle-all" for="permAll">
        		  			        		        		      				<input type="checkbox" value="" id="permAll" data-toggle="checkbox">
        		  			        		        		      			</label>
        		  			        		        		      		</th>
        		  			        		        		      		<th>Permission</th>
        		  			        		        		    	</tr>
        		  			        		        		    </thead>
        		  			        		        		    <tbody>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_select">
        		  			        		        		    				<input type="checkbox" value="yes" id="<?php echo $table['table']?>_select" name="permissions[<?php echo $table['table']?>][select]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Read records from this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_delete">
        		  			        		        		    				<input type="checkbox" value="yes" id="<?php echo $table['table']?>_delete" name="permissions[<?php echo $table['table']?>][delete]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Delete records from this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_insert">
        		  			        		        		    				<input type="checkbox" value="yes" id="<?php echo $table['table']?>_insert" name="permissions[<?php echo $table['table']?>][insert]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Insert records into this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_update">
        		  			        		        		    				<input type="checkbox" value="yes" id="<?php echo $table['table']?>_update" name="permissions[<?php echo $table['table']?>][update]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Update records within this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_alter">
        		  			        		        		    				<input type="checkbox" value="yes" id="<?php echo $table['table']?>_alter" name="permissions[<?php echo $table['table']?>][alter]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Add/edit/remove columns within this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    	<tr>
        		  			        		        		    		<td>
        		  			        		        		    			<label class="checkbox no-label" for="<?php echo $table['table']?>_private">
        		  			        		        		    				<input type="checkbox" value="yes" id="" name="permissions[<?php echo $table['table']?>][private]" data-toggle="checkbox">
        		  			        		        		    			</label>
        		  			        		        		    		</td>
        		  			        		        		    		<td>Users can only access his or her records in this table</td>
        		  			        		        		    	</tr>
        		  			        		        		    </tbody>
        		  			        		       			</table>
        		  			        		        	</div><!-- /.table-responsive -->
        		  			        		        		
        		  			        		      	</div>
        		  			        			</div>
        		  			        		</div>
        		  			        		<?php endforeach;?>
        		  			        		  	
        		  			        		<?php endif;?>
        		  			        		  	
        		  			        	</div><!-- /.panel-group -->
        		  			        		        		  	
        		  	</div><!-- /.form-group -->
        		
        		
      		</div><!-- /.modal-body -->
      		<div class="modal-footer">
        		<button type="submit" class="btn btn-info btn-embossed">Save New Role</a>
        		<button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel</button>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>