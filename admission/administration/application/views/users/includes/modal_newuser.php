<!-- modal -->
<form class="form" role="form" method="post" action="<?php echo site_url('users/create');?>" id="newUserForm">
<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
<div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title"><span class="fui-user"></span> Create new user</h4>
      		</div>
      		<div class="modal-body">
      		
        		<div class="form-group">
        			<input type="text" class="form-control" name="firstname" id="firstname" placeholder="First name *">
        		</div>
        		<div class="form-group">
        			<input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last name *">
        		</div>
        		<div class="form-group">
        			<input type="email" class="form-control" name="email" id="email" placeholder="Email *">
        		</div>
        		<div class="form-group">
        			<input type="password" class="form-control" name="password" id="password" placeholder="Password *">
        		</div>
        		<div class="form-group">
        			<input type="text" class="form-control" name="company" id="company" placeholder="Company">
       			</div>
       			<div class="form-group">
       				<input type="text" class="form-control" name="phone" id="phone" placeholder="Phone">
       			</div>
        		<div class="form-group">
        			<select name="group" id="group" class="default select-block mbl">
        				<option value="">Choose a user role</option>
        			    <?php foreach($roles as $role):?>
        			    <option value="<?php echo $role->id;?>"><?php echo $role->description;?></option>
        			    <?php endforeach;?>
        			</select>
       			</div>
       			        		
      		</div><!-- /.modal-body -->
      		<div class="modal-footer">
        		<button type="submit" class="btn btn-info btn-embossed">Create User</a>
        		<button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Cancel</button>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>