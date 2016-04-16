<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("shared/head");?>
</head>
<body>
	
    <div class="container main">
    
    	<div class="row">
    	
    		<div class="col-sm-offset-1 col-md-10">
    		
    			<div class="table-responsive">
    				<table class="table table-striped table-bordered">
    					<thead>
    						<tr>
    							<th>Rule</th>
    							<th>Description</th>
    							<th>Example</th>
    						</tr>
    					</thead>
    			    	<tbody>
    			    		<tr>
    			    			<td><b>required</b></td>
    			    			<td>Returns FALSE if the form element is empty.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>min_length</b></td>
    			    			<td>Returns FALSE if the form element is shorter then the parameter value.</td>
    			    			<td>min_length[6]</td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>max_length</b></td>
    			    			<td>Returns FALSE if the form element is longer then the parameter value.</td>
    			    			<td>max_length[12]</td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>exact_length</b></td>
    			    			<td>Returns FALSE if the form element is not exactly the parameter value.</td>
    			    			<td>exact_length[8]</td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>greater_than</b></td>
    			    			<td>Returns FALSE if the form element is less than the parameter value or not numeric.</td>
    			    			<td>greater_than[8]</td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>less_than</b></td>
    			    			<td>Returns FALSE if the form element is greater than the parameter value or not numeric.</td>
    			    			<td>less_than[8]</td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>alpha</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than alphabetical characters.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>alpha_numeric</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than alpha-numeric characters.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>alpha_dash</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than alpha-numeric characters, underscores or dashes.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>numeric</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than numeric characters.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>integer</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than an integer.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>is_natural</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than a natural number: 0, 1, 2, 3, etc.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>is_natural_no_zero</b></td>
    			    			<td>Returns FALSE if the form element contains anything other than a natural number, but not zero: 1, 2, 3, etc.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>valid_email</b></td>
    			    			<td>Returns FALSE if the form element does not contain a valid email address.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>valid_emails</b></td>
    			    			<td>Returns FALSE if any value provided in a comma separated list is not a valid email.</td>
    			    			<td></td>
    			    		</tr>
    			    		<tr>
    			    			<td><b>valid_ip</b></td>
    			    			<td>Returns FALSE if the supplied IP is not valid. Accepts an optional parameter of "IPv4" or "IPv6" to specify an IP format.</td>
    			    			<td></td>
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
