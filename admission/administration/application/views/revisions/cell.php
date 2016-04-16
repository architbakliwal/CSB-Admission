<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Databased</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="<?php echo base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="<?php echo base_url();?>custom/style.less" rel="stylesheet/less">
    <script> /* Provisory for dev environment: */ localStorage.clear(); </script>
    <script src="<?php echo base_url();?>js/less.js"></script>

    <link rel="shortcut icon" href="<?php echo base_url();?>images/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="<?php echo base_url();?>js/html5shiv.js"></script>
    <![endif]-->
    
    <link href="<?php echo base_url();?>css/datatables.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/redactor/redactor.css" rel="stylesheet">
</head>
<body>
	
    <div class="container main">
    
    	<div class="row">
    	
    		<div class="col-sm-offset-2 col-md-8">
    		
    			<div class="table-responsive">
    				<table class="table">
    			    	<tbody>
    			    		<tr>
    			    			<td style="width: 125px;"><b>Field:</b></td>
    			    			<td><?php echo $revision->dbapp_cellrevisions_field;?></td>
    			    		</tr>
    			    		<tr>
    			    			<td style="width: 125px;"><b>Date:</b></td>
    			    			<td><?php echo date("d M Y", $revision->dbapp_cellrevisions_timestamp);?></td>
    			    		</tr>
    			    		<tr>
    			    			<td style="width: 125px;"><b>Revision:</b></td>
    			    			<td><?php echo $revision->dbapp_cellrevisions_value;?></td>
    			    		</tr>
    			    	</tbody>
    			  </table>
    			</div>
    		
    		</div><!-- /.col-md-6 -->
    	
    	</div><!-- /.row -->
    		
    </div>
    <!-- /.container -->
  </body>
</html>
