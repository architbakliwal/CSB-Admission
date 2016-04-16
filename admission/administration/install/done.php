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
		
			<div class="col-md-6 col-md-offset-3">
			
				<br><br>
				
				<?php
				
					$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
					$redir .= "://".$_SERVER['HTTP_HOST'];
					$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
					$redir = str_replace('install/','',$redir); 
				
				?>
				
				<div class="alert alert-success">
					<button type="button" class="close fui-cross" data-dismiss="alert"></button>
				  	<h4>All done, yeah!</h4>
				  	<p>
				  		You're all set! <b>Databased</b> has been successfully installed. You can now continue to login to your application
				  	</p>
				  	<p>
				  		Please don't forget to <b>DELETE</b> the /install folder.
 				  	</p>
				  	<a href="<?php echo $redir;?>index.php/login" class="btn btn-primary btn-wide btn-embossed"><span class="fui-lock"></span>&nbsp;&nbsp;Log into <b>Databased</b></a>
				</div>
			
			</div><!-- /.col-md-6 -->
		
		</div><!-- /.row -->
	
	</div><!-- /.container -->

	</body>
</html>