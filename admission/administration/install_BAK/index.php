<?php

error_reporting(E_NONE); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}
		
		sleep(8);
		
		//create admin user
		$database->create_admin($_POST, $_POST['email'], $_POST['password_admin']);

		// If no errors, redirect to registration page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      $redir .= "://".$_SERVER['HTTP_HOST'];
      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      $redir = str_replace('install/','',$redir); 
			header( 'Location: done.php') ;
		}
		
		

	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. <b>All fields below are required to install Sent API.</b>');
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
	    <title>Databased Personal Installation</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	    <!-- Loading Bootstrap -->
	    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
	
	    <!-- Loading Flat UI -->
	    <link href="../css/flat-ui.css" rel="stylesheet">
	    <link href="../css/style.css" rel="stylesheet">
	
	    <link rel="shortcut icon" href="../images/favicon.ico">
	
	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
	    <!--[if lt IE 9]>
	      <script src="../js/html5shiv.js"></script>
	      <script src="../js/respond.min.js"></script>
	    <![endif]-->
	    <style>
	    h5.smaller {
	    	font-size: 20px;
	    	margin-bottom: 20px;
	    }
	    </style>
	</head>
	<body>
	
	<div class="container">
	
		<div class="row">
		
			<?php if(is_writable($db_config_path)){?>
		
			<div class="col-md-4 col-md-offset-4">
			
				<div class="text-center">
					
					<img src="../images/icons/box.svg" style="width: 80px; margin-bottom: 20px; margin-top: 30px;" src="Sent API">
				
				</div>
				
				<?php if( isset($message) ):?>
				<div class="alert alert-error">
					<button type="button" class="close fui-cross" data-dismiss="alert"></button>
				  	<?php echo $message;?>
				</div>
				<?php endif?>
						
				<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				
					<h5 class="smaller"><span class="fui-gear"></span> Database Configuration</h5>
				
					<div class="form-group">
				    	<input type="text" class="form-control" id="hostname" name="hostname" value="<?php if( isset($_POST['hostname']) ){echo $_POST['hostname'];}else{echo "localhost";}?>" placeholder="Hostname">
				  	</div>
				  	<div class="form-group">
				    	<input type="text" class="form-control" id="username" name="username" value="<?php if( isset($_POST['username']) ){echo $_POST['username'];}?>" placeholder="Username">
				  	</div>
				  	<div class="form-group">
				  		<input type="password" class="form-control" id="password" name="password" value="<?php if( isset($_POST['username']) ){echo $_POST['password'];}?>" placeholder="Password">
				  	</div>
				  	<div class="form-group">
				  		<input type="text" class="form-control" id="database" name="database" value="<?php if( isset($_POST['database']) ){echo $_POST['database'];}?>" placeholder="Database name">
				  	</div>
				  	
				  	<hr>
				  	
				  	<h5 class="smaller"><span class="fui-user"></span> Admin User Setup</h5>
				  	
				  	<div class="form-group">
				  		<input type="text" class="form-control" id="email" name="email" value="<?php if( isset($_POST['email']) ){echo $_POST['email'];}?>" placeholder="Email address">
				  	</div>
				  	<div class="form-group">
				  		<input type="password" class="form-control" id="password_admin" name="password_admin" value="<?php if( isset($_POST['password_admin']) ){echo $_POST['password_admin'];}?>" placeholder="Password">
				  	</div>
				  	
				  	<button type="submit" class="btn btn-primary btn-embossed btn-block" id="submitButton">Install <b>Databased</b></button>
				  	
				  	<br><br>
				  	
				</form>
							
			</div><!-- /.col-md-6 -->
			
			<?php } else { ?>
			<div class="col-md-6 col-md-offset-3">
			
				<div class="text-center">
					
					<img src="../images/icons/box.svg" style="width: 80px; margin-bottom: 20px; margin-top: 30px;" src="Sent API">
				
				</div>
				
				<div class="alert alert-error">
					<button type="button" class="close fui-cross" data-dismiss="alert"></button>
					<p>
					Please make the application/config/database.php file writable.
					<br><strong>Example</strong>:<br /><code>chmod 777 application/config/database.php</code></p>
				</div>
			</div>
			<?php } ?>
		
		</div><!-- /.row -->
	
	</div><!-- /.container -->
	<script src="../js/jquery-1.8.3.min.js"></script>
	<script>
	$(function(){
	
		$('button#submitButton').click(function(){
		
			$(this).addClass('disabled');
		
		})
	
	})
	</script>
	</body>
</html>