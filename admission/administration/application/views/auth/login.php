<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view("shared/head");?>
</head>
<body>

	<nav class="navbar navbar-default navbar-embossed navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
				<span class="sr-only">Toggle navigation</span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url();?>"><img alt="" src="<?php echo base_url();?>images/icons/box.svg" style="width: 30px;"></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse-01">
			<ul class="nav navbar-nav">			      
				<li><a href="">&nbsp;</a></li>
			 </ul> 		      
		</div><!-- /.navbar-collapse -->
	</nav><!-- /navbar -->
	
    <div class="container main">
    
    	<div class="row">
    	    		
    		<div class="col-md-offset-4 col-md-4">
    		
    			<img alt="" src="<?php echo base_url();?>images/icons/key.svg" style="display: block; margin: 20px auto 40px; width: 100px;">
    			
    			<!--<h3><?php echo lang('login_heading');?></h3>-->
    					
    			<!--<p>
    				<small><?php echo lang('login_subheading');?></small>
    			</p>-->
    					    					
    			<?php if(isset($message) && $message != ''):?>
    			<div class="alert alert-error"><?php echo $message;?></div>
    			<?php endif;?>
    					
    			<form action="<?php echo site_url("auth/login");?>" method="post">
    				
    				<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">	
    				
    				<div class="form-group">
    					<div class="input-group">
    						<span class="input-group-btn">
    						   	<button class="btn" type="submit"><span class="fui-mail"></span></button>
    						</span>
    						<input type="email" id="identity" name="identity" placeholder="Your email" class="form-control">
    					</div>
    				</div>
    						
    				<div class="form-group">
    					<div class="input-group">
    						<span class="input-group-btn">
    						   	<button class="btn" type="submit"><span class="fui-lock"></span></button>
    						</span>
    						<input type="password" id="password" name="password" placeholder="Your password" class="form-control">
    					</div>
    				</div>
    				  	
    				<label class="checkbox" for="remember">
    					<input type="checkbox" value="1" id="remember" data-toggle="checkbox">
    					Remember Me
    				</label>
    					  	    			
    				<button type="submit" class="btn btn-primary btn-embossed btn-block margin-top-20">Log me in please</button>
    					
    			</form>
    			
    			<p class="text-center margin-top-10">
    				<a href="forgot_password" class="small"><?php echo lang('login_forgot_password');?></a>
    			</p>
    		
    		</div><!-- ./col-md-4 -->
    		    	    			
    	</div>
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
  </body>
</html>