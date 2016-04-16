<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("shared/head");?>
</head>
<body>

	<?php $this->load->view("shared/nav");?>
	
    <div class="container main extra-top-padding">
    
    	<div class="row">
    	
    		<div class="col-md-8 col-md-offset-2" id="mainContent">
    		
    			<?php if($dbs):?>
    		
    			<h3 class="text-center">Choose a database to work on:</h3>
    			
    			<hr>
    		
    			<div class="panel-group" id="dbAccordion">
    			  	
    			  	<?php else:?>
    			  	
    			  		<?php if( $this->ion_auth->is_admin() ):?>
    			  		<div class="alert alert-error">
    			  			<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			  	  		<h4>Oh no! There aren't any databases to work with!</h4>
    			  	  		<p>
    			  	  			Databased is not currently handling any databases. If this is a new installation, please proceed to the Database section and activate one or more existing MySQL databases or create one or more databases from scratch.
    			  	  		</p>
    			  	  		<a href="<?php echo site_url('admin/db');?>" class="btn btn-info btn-wide">Manage Databases</a>
    			  		</div>
    			  		<?php else:?>
    			  		<div class="alert alert-error">
    			  			<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			  			<h4>Oh no! There aren't any databases to work with!</h4>
    			  			<p>
    			  				Databased is not currently handling any databases or you haven't been given access to any databases. Please contact of the administrators or contact <a href="mailto:<?php echo $this->config->item('support_email');?>"><?php echo $this->config->item('support_email');?></a>
    			  			</p>
    			  		</div>
    			  		<?php endif;?>
    			  	
    			  	<?php endif;?>
    			  	
    			</div><!-- /.panel-group -->
    			    			    			
    		</div><!-- /.col-md-9 -->
    		
    	</div><!-- /.row -->
    	
    </div>
    <!-- /.container -->
    
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
    <script src="<?php echo base_url();?>js/dbapp/dbapp_users.js"></script>
  </body>
</html>
