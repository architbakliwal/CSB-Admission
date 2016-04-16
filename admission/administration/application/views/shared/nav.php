
<?php 
	if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
	    $baseurl = 'http://127.0.0.1/CSBAdmission/';
	} else {
	    $baseurl = 'http://csbedu.in/admission/';
	}
?>
<nav class="navbar navbar-default navbar-embossed navbar-fixed-top" role="navigation" id="topNav">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
			<span class="sr-only">Toggle navigation</span>
		</button>
		<a class="navbar-brand" href="<?php echo base_url();?>"><img alt="" src="<?php echo base_url();?>images/icons/box.svg" style="width: 30px;"></a>
	</div>
	<div class="collapse navbar-collapse" id="navbar-collapse-01">
		<ul class="nav navbar-nav">
			
			<li class="<?php if($page == 'data'){echo "active";}?> dropdown">
				<a href="<?php echo site_url('db');?>" class="dropdown-toggle" data-toggle="dropdown"><span class="fui-list"></span> <?php if( isset($theTable) ){echo $theTable;}else{echo "My Tables";}?> <b class="caret"></b></a>
				<span class="dropdown-arrow dropdown-arrow-inverse"></span>
				<ul class="dropdown-menu dropdown-inverse">
					<?php foreach( $tables as $table ):?>
					<li>
						<a href="<?php echo site_url('db/'.$table['table'])?>"><?php echo $table['table']?></a>
					</li>
					<?php endforeach;?>
				</ul>
			</li>
		
			<?php if($this->usermodel->adminUsers()):?><li <?php if($page == 'users'):?>class="active"<?php endif;?>><a href="<?php echo site_url('users');?>"><span class="fui-user"></span> Users</a></li><?php endif;?>
			<?php if($this->usermodel->adminUsers()):?><li <?php if($page == 'roles'):?>class="active"<?php endif;?>><a href="<?php echo site_url('roles');?>"><span class="fui-myspace"></span> Roles & permissions</a></li><?php endif;?>

			<li><a href="<?php echo $baseurl . 'php/export-registered.php' ?>" target="_blank"><span class="fui-export"></span> Export Registered Applicants</a></li>
			<li><a href="<?php echo $baseurl . 'php/export-applied.php' ?>" target="_blank"><span class="fui-export"></span> Export Applied Applicants</a></li>
			<li><a href="<?php echo $baseurl . '/download_uploads.php' ?>" target="_blank"><span class="fui-export"></span> Download All Documents</a></li>
		</ul>
		
      	<ul class="nav navbar-nav navbar-right">
      		<li class="dropdown">
      	    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Hi, <?php echo $this->ion_auth->user()->row()->first_name;?> <b class="caret"></b></a>
      	    	<span class="dropdown-arrow dropdown-arrow-inverse"></span>
      	    	<ul class="dropdown-menu dropdown-inverse">
      	      		<li><a href="<?php echo site_url('account');?>">My Account</a></li>
      	      		<li class="divider"></li>
      	      		<li><a href="<?php echo site_url('logout');?>">Logout</a></li>
      	    	</ul>
      	  	</li>
      	  	<li>
      	  		<a href="<?php echo site_url('logout');?>"><span class="visible-sm visible-xs">Logout<span class="fui-exit"></span></span><span class="visible-md visible-lg"><span class="fui-exit"></span></span></a>
      	  	</li>
      	</ul>
	</div><!-- /.navbar-collapse -->
</nav><!-- /navbar -->