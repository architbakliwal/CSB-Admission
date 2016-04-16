<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("shared/head");?>
</head>
<body>

	<?php $this->load->view("shared/nav");?>
	
    <div class="container main extra-top-padding">
    
    	<div class="row">
    	
    		<div class="col-md-3 visible" id="sidebar">
    		
    			<ul class="nav nav-list margin-bottom-20">
    			    <li class="nav-header"><b>Databased</b> roles <span class="label label-primary"><?php echo count($roles)?></span></li>
    			    <?php foreach($roles as $role):?>
    			    <li <?php if(isset($theRole) && $theRole->name == $role->name):?>class="active"<?php endif;?>>
    			    	<a href="<?php echo site_url('roles/'.$role->name);?>">
    			        	<span class="fui-myspace"></span> <?php echo $role->description;?>
    			      	</a>
    			    </li>
    			    <?php endforeach;?>
    			</ul>
    			
    			<?php if(count($roles) <= 4):?>
    			<div class="alert alert-success">
    				<button data-dismiss="alert" class="close fui-cross" type="button"></button>
    			    	Seem a bit empty up there? Click the button below to add a role.
    			</div>
    			<?php endif;?>
    			    			
    			<a href="#newRole" data-toggle="modal" class="btn btn-info btn-embossed btn-block btn-embossed"><span class="fui-plus"></span> Create New Role</a>
    			
    		</div><!-- /.col-md-3 -->
    		<div class="col-md-9" id="mainContent">
    		
    			<?php if($this->session->flashdata('error_message')):?>
    			<div class="alert alert-error">
    				<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    				<h4>Ouch!</h4>
    			  	<?php echo $this->session->flashdata('error_message');?>
    			</div>
    			<?php endif;?>
    			
    			<?php if($this->session->flashdata('success_message')):?>
    			<div class="alert alert-success">
    				<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    				<h4>Joy!</h4>
    			  	<?php echo $this->session->flashdata('success_message');?>
    			</div>
    			<?php endif;?>
    		
    			<?php if(isset($theRole)):?>
    			<ul class="nav nav-tabs nav-append-content">
    				<li class="active"><a href="#permissionTab"><span class="fui-lock"></span> Database Permissions</a></li>
    			    <?php if($theRole->name != 'Administrator'):?>
    			    <li><a href="#moreTab"><span class="fui-gear"></span> Other</a></li>
    			    <?php endif;?>
    			</ul> <!-- /tabs -->
    			
    			<div class="tab-content">
    			
    				<div class="tab-pane active" id="permissionTab">
    				
    					<h4>Configure database and table permissions</h4>
    					
    					<hr>
    					
    					<?php if($theRole->name == 'Administrator'):?>
    					<div class="alert">
    						<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    					  	<h4>Please note</h4>
	    					<p>
	    						The <b>Administrator</b> role always has access to every database and table. This can not be changed. To limit users' access, please create separate roles for these users.
	    					</p>
    					</div>
    					<?php else:?>

    					<?php endif;?>
    					
    					
    					<?php
    					
    						$permissions = json_decode($theRole->permissions, true);
    						
    					
    					?>
    				
    					<form action="<?php echo site_url('roles/update');?>" method="post">
    					
    						<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
    					
    						<input type="hidden" name="roleID" value="<?php echo $theRole->id;?>">
    				  								  									  								
  							<div class="table-responsive">
  								<table class="table permissionTable">
  									<thead>
  										<tr>
  											<th style="width: 35px;">
  												<label class="checkbox no-label toggle-all" for="permAll">
  													<input type="checkbox" value="" id="permAll" data-toggle="checkbox" <?php if($theRole->name == 'Administrator'):?>checked<?php endif;?>>
  												</label>
  								     		</th>
  											<th>Permission</th>
  										</tr>
  									</thead>
  									<tbody>
  										<tr>
  											<td>
  												<label class="checkbox no-label" for="create">
  													<input type="checkbox" value="yes" id="_create" data-toggle="checkbox" name="permissions[create]" <?php if(isset($permissions['create']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  												</label>
  											</td>
  											<td>Create tables within this database</td>
  										</tr>
  								   		<tr>
  											<td>
  												<label class="checkbox no-label" for="drop">
  													<input type="checkbox" value="yes" id="drop" data-toggle="checkbox" name="permissions[drop]" <?php if(isset($permissions['drop']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  												</label>
  											</td>
  											<td>Delete tables within this database</td>
  										</tr>
  									</tbody>
  								</table>
  							</div><!-- /.table-responsive -->
  								        		
  							<div class="panel-group" id="__tables">
  								        		
  							<?php if(isset($tables)):?>
  								        			
  							<?php foreach($tables as $table):?>
  							<div class="panel panel-default">
  								<div class="panel-heading">
  									<h4 class="panel-title">
  										<a data-toggle="collapse" data-parent="#__tables" href="#__<?php echo $table['table']?>">
  											Table: <?php echo $table['table']?>
  										</a>
  									</h4>
  								</div>
  								<div id="__<?php echo $table['table']?>" class="panel-collapse collapse">
  									<div class="panel-body">
  								        		        		
  										<div class="table-responsive">
  											<table class="table permissionTable">
  												<thead>
  													<tr>
  														<th style="width: 35px;">
  															<label class="checkbox no-label toggle-all" for="permAll">
  																<input type="checkbox" value="" id="permAll" data-toggle="checkbox" <?php if($theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</th>
  								  						<th>Permission</th>
  													</tr>
  												</thead>
  												<tbody>
  													<tr>
  														<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_select">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_select" name="permissions[<?php echo $table['table']?>][select]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['select']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</td>
  														<td>Read records from this table</td>
  													</tr>
  													<tr>
  														<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_delete">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_delete" name="permissions[<?php echo $table['table']?>][delete]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['delete']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</td>
  														<td>Delete records from this table</td>
  													</tr>
  													<tr>
  														<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_insert">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_insert" name="permissions[<?php echo $table['table']?>][insert]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['insert']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</td>
  								    					<td>Insert records into this table</td>
  													</tr>
  													<tr>
  														<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_update">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_update" name="permissions[<?php echo $table['table']?>][update]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['update']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</td>
  														<td>Update records within this table</td>
  													</tr>
  													<tr>
  														<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_alter">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_alter" name="permissions[<?php echo $table['table']?>][alter]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['alter']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  														</td>
  														<td>Add/edit/remove columns within this table</td>
  													</tr>
  													<tr>
  								    					<td>
  															<label class="checkbox no-label" for="<?php echo $table['table']?>_private">
  																<input type="checkbox" value="yes" id="<?php echo $table['table']?>_alter" name="permissions[<?php echo $table['table']?>][private]" data-toggle="checkbox" <?php if(isset($permissions[$table['table']]['private']) || $theRole->name == 'Administrator'):?>checked<?php endif;?>>
  															</label>
  								    					</td>
  														<td>Users can access only their own records</td>
  													</tr>
  												</tbody>
 											</table>
 										</div><!-- /.table-responsive -->
  								        		        		
  									</div><!-- /.panel-body -->
  								</div><!-- /.panel-collapse -->
 							</div><!-- /.panel -->
  							<?php endforeach;?>
  								        		  	
  							<?php endif;?>
  								        		  	  						
  						</div>
  						  						
  						<br>		      	
  						
  						<?php if($theRole->name != 'Administrator'):?>
  						<div class="form-group">
  							<button type="submit" class="btn btn-info btn-embossed">Save Permissions</button>
  						</div>
  						<?php endif;?>
  						
  						</form>
  						
   					</div><!-- /#permissionTab -->
    			
    				<?php if($theRole->name != 'Administrator'):?>
   					<div class="tab-pane" id="moreTab">
   					
   						<h4>Configure other details for this role</h4>
   						
   						<hr>
   						
   						<form class="form-horizontal" role="form" action="<?php echo site_url('roles/update');?>" method="post">
   							<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
   							<input type="hidden" name="roleID" value="<?php echo $theRole->id;?>">
   							<div class="form-group">
   						    	<label for="roleName" class="col-sm-offset-1 col-sm-2 control-label">Role name <span class="red">*</span></label>
   						    	<div class="col-sm-8">
   						      		<input type="text" class="form-control" name="roleName" id="roleName" placeholder="Role name *" value="<?php echo $theRole->description;?>">
   						    	</div>
   						  	</div>
   						  	<div class="form-group">
   						  		<label for="roleDescription" class="col-sm-offset-1 col-sm-2 control-label">Description </label>
   						  		<div class="col-sm-8">
   						  			<textarea class="form-control" rows="4" name="roleDescription" id="roleDescription" placeholder="Please provide a description here"><?php echo $theRole->descr;?></textarea>
   						  		</div>
   						  	</div>
   						  	<div class="form-group">
   						  		<div class="col-sm-offset-1 col-sm-2"></div>
   						  		<div class="col-sm-8">
   						  			<label class="checkbox" for="admin_users" style="padding-top: 0px;">
   						  			  <input type="checkbox" value="yes" id="admin_users" name="admin_users" data-toggle="checkbox" <?php if($theRole->admin_users == 1):?>checked<?php endif;?>>
   						  			  Allow user administration?
   						  			</label>
   						  		</div>
   						  	</div>
   						  	<div class="form-group">
   						  		<div class="col-sm-offset-1 col-sm-2"></div>
   						  		<div class="col-sm-8">
   						  			<label class="checkbox" for="default" style="padding-top: 0px;">
   						  			  <input type="checkbox" value="1" id="default" name="default" data-toggle="checkbox" <?php if($theRole->default == 1):?>checked<?php endif;?>>
   						  			  Set as default role?
   						  			</label>
   						  		</div>
   						  	</div>
   						  	<div class="form-group">
   						    	<div class="col-sm-offset-3 col-sm-8">
   						      		<button type="submit" class="btn btn-info btn-embossed">Update role</button>
   						    	</div>
   						  	</div>
   						</form>
   						
   						<hr>
   						
   						<br>
   						
   						<div class="alert">
   							<button type="button" class="close fui-cross" data-dismiss="alert"></button>
   							<h4>Delete this user role</h4>
   							<?php if( isset($defaultRole) && $theRole->id != $defaultRole->id ):?>
   								<p>
   									Deleting this, or any other user role, means that users who are currently assigned this role, will no longer have ANY ACCESS to ANY DATA. You will need to manually assign another role to these users.
   								</p>
   								<a href="<?php echo site_url('roles/delete/'.$theRole->id);?>" class="btn btn-danger btn-embossed">I understand, please delete this role</a>
   							<?php else:?>
   								
   								<?php if( isset($defaultRole) && $theRole->id == $defaultRole->id ):?>
   								<p>You can not delete the current DEFAULT role.</p>
   								<?php else:?>
   								<p>
   									Before deleting any user role, you will need to assign one role as the DEFAULT role. This way we know what role to assign to users when their current role is being deleted.
   								</p>
   								<?php endif;?>
   								
   							<?php endif;?>
   						</div>
   						
   					</div><!-- /#moreTab -->
   					<?php endif;?>
    			
  				</div> <!-- /tab-content -->
  				
  				<?php endif;?>
    			
    		</div><!-- /.col-md-9 -->
    	</div><!-- /.row -->
    </div>
    <!-- /.container -->
    
    <?php $this->load->view("roles/includes/modal_newrole");?>

    <!-- Load JS here for greater good =============================-->
    <script src="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-select.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-switch.js"></script>
    <script src="<?php echo base_url();?>js/flatui-checkbox.js"></script>
    <script src="<?php echo base_url();?>js/flatui-radio.js"></script>
    <script src="<?php echo base_url();?>js/jquery.tagsinput.js"></script>
    <script src="<?php echo base_url();?>js/jquery.placeholder.js"></script>
    <script src="<?php echo base_url();?>js/application.js"></script>
    <script src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>js/TableTools.min.js"></script>
    <script src="<?php echo base_url();?>js/ZeroClipboard.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-datatables.js"></script>
    <script src="<?php echo base_url();?>js/datatables.plugins.js"></script>
    <script src="<?php echo base_url();?>assets/redactor/redactor.js"></script>
    <script src="<?php echo base_url();?>js/dbapp/dbapp_roles.js"></script>
  </body>
</html>
