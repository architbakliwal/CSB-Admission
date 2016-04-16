<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view("shared/head");?>
</head>
<body>

	<?php $this->load->view("shared/nav");?>
    <?php 
        if($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
            $baseurl = 'http://127.0.0.1/CSBAdmission/';
        } else {
            $baseurl = 'http://csbedu.in/admission/';
        }
    ?>
	
    <div class="container main">
        
    	<div class="row">
    		
    		<div class="col-md-12" id="mainContent">
    		
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
    		
    			<ul class="nav nav-tabs nav-append-content">
    				
    				<li class="active"><a href="#tab1" class="tt" data-delay="1500" data-placement="bottom" title="Show data in the <?php echo $theTable;?> table"><span class="fui-list"></span> Table data</a></li>
    			    
    			    <?php if( isset($tableFields) ):?>
    			    <li><a href="#tab2" class="tt" data-delay="1500" data-placement="bottom" title="Show, hide and manage columns in the <?php echo $theTable;?> table"><span class="fui-list-columned"></span> Table columns</a></li>
    			    <?php endif;?>
    			    
    			    <li><a href="#tab4"><span class="fui-gear"></span> More</a></li>
    			
    			</ul> <!-- /tabs -->
    			
    			<div class="tab-content">
    			
    				<div class="tab-pane fade in active" id="tab1">
    			    	
    			    	<?php if( isset($tableFields) && $hasPrimary ):?>
    			    	<div class="row">
    			    			
    			    		<div class="col-md-6">
    			    			
    			    			<?php if( $tableInsertAllowed == 'yes' ):?>
    			    			<a href="#newRecordModal" data-toggle="modal" class="btn btn-info btn-embossed btn-embossed"><span class="fui-plus"></span> Create new record</a>
    			    			<a href="#importDataModal" data-toggle="modal" class="btn btn-default btn-embossed btn-embossed"><span class="fui-upload"></span> Import data</a>
    			    			<?php endif;?>
    			    			
    			    		</div>
    			    			
    			    		<div class="col-md-6">
    			    		
    			    			<div class="form-group select-margin-bottom-0">
    			    				<div class="input-group filterBar">
    			    					
    			    					<?php if( $this->session->userdata('searchItems') != '' && $this->session->userdata('searchItems_table') == $theTable ):?>
    			    					
    			    					<span class="input-group-btn">
    			    					    <button type="submit" class="btn disabled"><span class="fui-search"></span></button>
    			    					</span>
    			    					<input type="search" class="form-control disabled" placeholder="Using advanced search items" id="zeTableSearch" disabled>
    			    					<div class="input-group-btn">
    			    						<a href="<?php echo site_url("db/".$theTable."/true")?>" class="btn btn-default" id=""><span class="fui-cross-inverted"></span> Reset search</a>
    			    						<button class="btn btn-default" type="button" id="toggleAdvancedSearch"><span class="fui-gear"></span></button>
    			    					</div>
    			    					
    			    					<?php else:?>
    			    					
    			    					<span class="input-group-btn">
    			    					    <button type="submit" class="btn"><span class="fui-search"></span></button>
    			    					</span>
    			    					<input type="search" class="form-control" placeholder="Search table" id="zeTableSearch">
    			    					<div class="input-group-btn">
    			    						<button class="btn btn-default" type="button" id="toggleAdvancedSearch"><span class="fui-gear"></span> More options</button>
    			    					</div>
    			    					
    			    					<?php endif;?>
    			    				
    			    				    
    			    				</div>
    			    			</div><!-- /.form-group -->
    			    			
    			    			<div class="advancedSearchForm_wrapper" id="advancedSearchForm_wrapper">
    			    			    			    			
    			    				<form class="clearfix" role="form" id="advancedSearchForm" action="<?php echo site_url("db/".$theTable);?>" method="post">
    			    				
    			    					<input type="hidden" name="table" value="<?php echo $theTable;?>">
    			    				
    			    					<div class="clearfix">
    			    						<h5 class="pull-left"><span class="fui-search"></span> Advanced search panel</h5>
    			    						<a href="#" class="pull-right small" id="hideAdvancedSearch"><span class="fui-cross"></span> hide</a>
    			    					</div>
    			    					
    			    					<hr>
    			    					
    			    					<div class="panel-group margin-bottom-15" id="advancedSearch_accordion">
    			    					
    			    						<!-- templ -->
    			    						<div class="panel panel-default" style="display: none;" id="newSearchItem_templ">
    			    							<div class="panel-heading">
    			    						  		<h4 class="panel-title">
    			    						    		<a data-parent="#advancedSearch_accordion" href="#as_collapse0">
    			    						      			<b class="item">Search item 1</b> <span class="pull-right">(toggle visibility)</span>
    			    						    		</a>
    			    						  		</h4>
    			    							</div>
    			    							<div id="as_collapse0" class="panel-collapse collapse in">
    			    						  		<div class="panel-body">
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-0">
    			    						    			<div class="col-sm-6">
    			    						    				<div class="mbl margin-bottom-0">
    			    						    					<select name="columns[]" class="select-block selector" placeholder="Choose column">
    			    						    						<option value="">Choose column</option>
    			    						    				  		<?php foreach( $tableFields as $field ):?>
    			    						    				  		<option value="<?php echo $field['field'];?>"><?php echo $field['field'];?></option>
    			    						    				  		<?php endforeach;?>
    			    						    				  	</select>
    			    						    				</div>
    			    						    			</div>
    			    						    			<div class="col-sm-6">
    			    						    				<div class="mbl margin-bottom-0">
    			    						    				  	<select name="operators[]" class="select-block selector" placeholder="Choose operator">
    			    						    				  		<option value="">Choose operator</option>
    			    						    				    	<option value="=">Equals</option>
    			    						    				    	<option value="!=">Does not equal</option>
    			    						    				    	<option value="LIKE%%">Contains</option>
    			    						    				    	<option value="NOT LIKE%%">Does not contain</option>
    			    						    				    	<option value="<">Less then (&lt;)</option>
    			    						    				    	<option value=">">Greater then (&gt;)</option>
    			    						    				    	<option value="<=">Equals or less then (&lt;=)</option>
    			    						    				    	<option value=">=">Equals or greater (&gt;=)</option>
    			    						    				  	</select>
    			    						    				</div>
    			    						    			</div>
    			    						    			
    			    						    		</div>
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-15">
    			    						    			<div class="col-sm-12">
    			    						    				<input type="text" class="form-control" id="inputEmail3" placeholder="Value" name="values[]">
    			    						    			</div>
    			    						    		</div>
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-0">
    			    						    			<div class="col-sm-12">
    			    						    				<a href="" class="pull-right text-danger small removeAsItem"><span class="fui-cross-inverted"></span> Remove item</a>
    			    						    			</div>
    			    						    		</div>
    			    						    		
    			    						  		</div>
    			    							</div>
    			    						</div>
    			    						<!-- /templ -->
    			    						
    			    						<?php if( $this->session->userdata('searchItems') ):?>
    			    						
    			    						<?php 
    			    							$counter = 1;
    			    						?>
    			    						
    			    						<?php foreach( $this->session->userdata('searchItems') as $searchItem ):?>
    			    						
    			    						<div class="panel panel-default">
    			    							<div class="panel-heading">
    			    						  		<h4 class="panel-title">
    			    						    		<a data-parent="#advancedSearch_accordion" href="#as_collapse<?php echo $counter;?>">
    			    						      			<b class="item">Search item <?php echo $counter;?></b> <span class="pull-right">(toggle visibility)</span>
    			    						    		</a>
    			    						  		</h4>
    			    							</div>
    			    							<div id="as_collapse<?php echo $counter;?>" class="panel-collapse collapse in">
    			    						  		<div class="panel-body">
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-0">
    			    						    			<div class="col-sm-6">
    			    						    				<div class="mbl margin-bottom-0">
    			    						    					<select name="columns[]" class="select-block selector" placeholder="Choose column">
    			    						    						<option value="">Choose column</option>
    			    						    				  		<?php foreach( $tableFields as $field ):?>
    			    						    				  		<option value="<?php echo $field['field'];?>" <?php if( $searchItem['column'] == $field['field'] ):?>selected<?php endif;?>><?php echo $field['field'];?></option>
    			    						    				  		<?php endforeach;?>
    			    						    				  	</select>
    			    						    				</div>
    			    						    			</div>
    			    						    			<div class="col-sm-6">
    			    						    				<div class="mbl margin-bottom-0">
    			    						    				  	<select name="operators[]" class="select-block selector" placeholder="Choose operator">
    			    						    				  		<option value="">Choose operator</option>
    			    						    				  		
    			    						    				  		<option value="=" <?php if( $searchItem['operator'] == '=' ):?>selected<?php endif;?>>Equals</option>
    			    						    				  		<option value="!=" <?php if( $searchItem['operator'] == '!=' ):?>selected<?php endif;?>>Does not equal</option>
    			    						    				  		<option value="LIKE%%" <?php if( $searchItem['operator'] == 'LIKE%%' ):?>selected<?php endif;?>>Contains</option>
    			    						    				  		<option value="NOT LIKE%%" <?php if( $searchItem['operator'] == 'NOT LIKE%%' ):?>selected<?php endif;?>>Does not contain</option>
    			    						    				  		<option value="<" <?php if( $searchItem['operator'] == '<' ):?>selected<?php endif;?>>Less then (&lt;)</option>
    			    						    				  		<option value=">" <?php if( $searchItem['operator'] == '>' ):?>selected<?php endif;?>>Greater then (&gt;)</option>
    			    						    				  		<option value="<=" <?php if( $searchItem['operator'] == '<=' ):?>selected<?php endif;?>>Equals or less then (&lt;=)</option>
    			    						    				  		<option value=">=" <?php if( $searchItem['operator'] == '>=' ):?>selected<?php endif;?>>Equals or greater (&gt;=)</option>
    			    						    				  	</select>
    			    						    				</div>
    			    						    			</div>
    			    						    			
    			    						    		</div>
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-15">
    			    						    			<div class="col-sm-12">
    			    						    				<input type="text" class="form-control" id="inputEmail3" placeholder="Value" name="values[]" value="<?php echo $searchItem['value']?>">
    			    						    			</div>
    			    						    		</div>
    			    						    		
    			    						    		<div class="form-group clearfix margin-bottom-0">
    			    						    			<div class="col-sm-12">
    			    						    				<?php if( $counter > 1 ):?>
    			    						    				<a href="" class="pull-right text-danger small removeAsItem"><span class="fui-cross-inverted"></span> Remove item</a>
    			    						    				<?php endif;?>
    			    						    			</div>
    			    						    		</div>
    			    						    		
    			    						  		</div>
    			    							</div>
    			    						</div><!-- /.panel -->
    			    						
    			    						<?php $counter++;?>
    			    							
    			    						<?php endforeach;?>
    			    						
    			    						<?php else:?>
    			    					
    			    						<div class="panel panel-default">
    			    					    	<div class="panel-heading">
    			    					      		<h4 class="panel-title">
    			    					        		<a data-parent="#advancedSearch_accordion" href="#as_collapseOne">
    			    					          			<b class="item">Search item 1</b> <span class="pull-right">(toggle visibility)</span>
    			    					        		</a>
    			    					      		</h4>
    			    					    	</div>
    			    					    	<div id="as_collapseOne" class="panel-collapse collapse in">
    			    					      		<div class="panel-body">
    			    					        		
    			    					        		<div class="form-group clearfix margin-bottom-0">
    			    					        			<div class="col-sm-6">
    			    					        				<div class="mbl margin-bottom-0">
    			    					        					<select name="columns[]" class="select-block selector" placeholder="Choose column">
    			    					        						<option value="">Choose column</option>
    			    					        				  		<?php foreach( $tableFields as $field ):?>
    			    					        				  		<option value="<?php echo $field['field'];?>"><?php echo $field['field'];?></option>
    			    					        				  		<?php endforeach;?>
    			    					        				  	</select>
    			    					        				</div>
    			    					        			</div>
    			    					        			<div class="col-sm-6">
    			    					        				<div class="mbl margin-bottom-0">
    			    					        				  	<select name="operators[]" class="select-block selector" placeholder="Choose operator">
    			    					        				  		<option value="">Choose operator</option>
    			    					        				  		<option value="=">Equals</option>
    			    					        				  		<option value="!=">Does not equal</option>
    			    					        				  		<option value="LIKE%%">Contains</option>
    			    					        				  		<option value="NOT LIKE%%">Does not contain</option>
    			    					        				  		<option value="<">Less then (&lt;)</option>
    			    					        				  		<option value=">">Greater then (&gt;)</option>
    			    					        				  		<option value="<=">Equals or less then (&lt;=)</option>
    			    					        				  		<option value=">=">Equals or greater (&gt;=)</option>
    			    					        				  	</select>
    			    					        				</div>
    			    					        			</div>
    			    					        			
    			    					        		</div>
    			    					        		
    			    					        		<div class="form-group clearfix margin-bottom-15">
    			    					        			<div class="col-sm-12">
    			    					        				<input type="text" class="form-control" id="inputEmail3" placeholder="Value" name="values[]">
    			    					        			</div>
    			    					        		</div>
    			    					        		
    			    					        		<div class="form-group clearfix margin-bottom-0">
    			    					        			<div class="col-sm-12">
    			    					        				
    			    					        			</div>
    			    					        		</div>
    			    					        		
    			    					      		</div>
    			    					    	</div>
    			    					  	</div><!-- /.panel -->
    			    					  	
    			    					  	<?php endif;?>
    			    					  	
    			    					</div>
    			    				
    			    			  		<div class="form-group clearfix">
    			    			      		<button type="submit" class="btn btn-info btn-embossed">Apply search items</button>
    			    			      		<a href="<?php echo site_url("db/".$theTable."/true")?>" class="btn btn-danger btn-embossed">Clear search</a>
    			    			      		<a href="" class="addColumnLink pull-right" id="addSearchItem"><span class="fui-plus"></span> Add search item</a>
    			    			  		</div>
    			    				</form>
    			    			
    			    			</div><!-- /.advancedSearchForm_wrapper -->
    			    			
    			    		</div><!-- /.col-md-6 -->
    			    			
    			    	</div><!-- /.row -->
                    </br>
                        <div class="row">
                                
                            <div class="col-md-6">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="form-group select-margin-bottom-0" id="pdfDownload">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Application ID" id="pdfDownload-text">
                                        <div class="input-group-btn">
                                            <input type="text" value="<?php echo $baseurl . 'secure/application/document/go/document_admin.php' ?>" id="pdfDownload-link-val" hidden/>
                                            <a href="#" target="_blank" id="pdfDownload-link">Download PDF</a>
                                        </div>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-6 -->

                        </div><!-- /.row -->

    			    	
    			    	<hr>
    			    	<?php endif;?>
    			    	
    			    	<?php if( isset($tableFields) && $hasPrimary ):?>
    			    	<div class="table-responsive" id="zeTable">
    			    		<table class="table table-bordered table-striped table-hover <?php if(isset($tableUpdateAllowed) && $tableUpdateAllowed == 'yes'):?>allowedTable<?php else:?>notAllowedTable<?php endif;?>" id="table">
    			    		    <thead>
    			    		    	<tr>
    			    		    		<th>actions</th>
    			    		    		<?php $colCounter = 0;?>
    			    		    		<?php foreach($tableFields as $field):?>
    			    		    			<?php if(in_array($field['field'], $this->session->userdata($theTable))):?>
    			    		    			<th><?php echo $field['field'];?></th>
    			    		    			<?php $colCounter++;?>
    			    		    			<?php endif;?>
    			    		    		<?php endforeach;?>
    			    		    	</tr>
    			    		    </thead>
    			    		 	<tbody>
    			    		      
    			    		    </tbody>
    			    		</table>
    			   		</div><!-- /.table-responsive -->
    			   		<?php else:?>
    			   			
    			   			<?php if( isset($hasPrimary) && $hasPrimary == false ):?>
    			   			
    			   			<div class="alert alert-error">
    			   				<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			   				<h4>Error: no primary key is set</h4>
    			   				<p>
    			   					It appears there no primary key set on this table. For Databased to function properly, you will need to define a primary key.
    			   				</p>
    			   			</div>
    			   			
    			   			<?php else:?>
    			   		
    			   			<div class="alert alert-error">
    			   		  		<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			   		  		<h4>Error: no tables in database</h4>
    			   		  		<p>
    			   		  			It appears there are not tables in this database. Click click the green button at the bottom of the page to start creating tables.
    			   		  		</p>
    			   			</div>
    			   			<?php endif;?>
    			   		
    			   		<?php endif;?>
    			    	
    				</div>
    			
    				<?php if( isset($tableFields) ):?>
    			    <div class="tab-pane fade" id="tab2">
    			    
    			    	<div class="alert alert-info">
    			    		<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			    		<h4>Important!</h4>
    			    		<p>
    			    			Choose which columns you would like to include in your data view. Once finished, click the button below to reload the data view and apply the selected columns.
    			    		</p>
    			    		<a href="" class="btn btn-default btn-embossed">Reload data view</a> 
    			    		<?php if($this->usermodel->hasTablePermission("alter", $theTable)):?><a href="#newColumnModal" class="btn btn-info btn-embossed" data-toggle="modal">Create new column</a><?php endif;?>
    			    	</div>
    			    	    			    	
    			    	<?php
    			    		$cData = array();
    			    		$cData['theTable'] = $theTable;
    			    		$cData['tableFields'] = $tableFields;
    			    	?>
    			    	
    			    	<?php $this->load->view("partials/column_table", $cData);?>
    			    	
    			    	<?php if( count($tableFields) > 10 ):?>
    			    	<div class="alert alert-info">
    			    		<a href="" class="btn btn-default btn-embossed">Reload data view</a> <a href="#newColumnModal" class="btn btn-info btn-embossed" data-toggle="modal">Create new column</a>
    			    	</div>
    			    	<?php endif;?>
    			    	
    			  	</div>
    			  	<?php endif;?>
    			    
    			    <div class="tab-pane fade" id="tab4">
    			    
    			    	<hr>
    			    	
    			    	<?php if( $tableDropAllowed == 'yes' ):?>
    			    	
    			    	<div class="alert alert-error">
    			    		<button type="button" class="close fui-cross" data-dismiss="alert"></button>
    			    	  	<h4>Delete this table</h4>
    			    	  	<p>
    			    	  		To permanently delete this table, click the button below. Please note that this will result in all data, including meta data being permanently deleted. The only way to undo this later, is by restoring a backup of the database.
    			    	  	</p>
    			    	  	<a href="<?php echo site_url('db/deleteTable/'.$theTable);?>" class="btn btn-danger btn-wide" id="deleteTableLink">Permanently delete table</a>
    			    	</div><!-- /.alert -->
    			    	
    			    	<hr>
    			    	
    			    	<?php endif;?>
    			    	
    			    	<?php if( $tableDropAllowed == 'yes' ):?>
    			    
    			    	<div class="row">
    			    	
    			    		<div class="col-md-9">
    			    		
    			    			<form action="<?php echo site_url('db/updateTable/'.$theTable);?>" method="post" class="form-horizontal">
    			    			
    			    				<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
    			    			
    			    				<div class="form-group">
    			    					<label for="tableName" class="col-sm-offset-1 col-sm-2 control-label">Table name <span class="red">*</span></label>
    			    					<div class="col-sm-8">
    			    				  		<input type="text" class="form-control" name="tableName" id="tableName" placeholder="Table name" value="<?php echo $theTable;?>">
    			    					</div>
    			    				</div>
    			    				
    			    				<div class="form-group">
    			    					<div class="col-sm-offset-3 col-sm-8">
    			    						<button type="submit" class="btn btn-info btn-embossed">Update table</button>
    			    					</div>
    			    				</div>
    			    			
    			    			</form>
    			    		
    			    		</div><!-- /.col-md-9 -->
    			    	
    			    	</div><!-- /.row -->
    			    	
    			    	<?php endif;?>
    			    
    			    </div><!-- /.tab-pane -->
    			        			        			    
    			</div> <!-- /tab-content -->
    			
    		</div><!-- /.col-md-9 -->
    	</div>
    </div>
    <!-- /.container -->
    
    <!-- <div class="bottomTabs">
    
    	<ul>
    		<li><b>TABLES <span class="fui-document"></span></b></li>
    		<li>
    			<?php if( $this->usermodel->hasDBPermission("create") ):?>
    			<a href="#newTableModal" data-toggle="modal" class="addTable"><span class="fui-plus"></span></a>
    			<?php endif;?>
    		</li>
    		<?php foreach($tables as $table):?>
    		<li <?php if($table['table'] == $theTable):?>class="active"<?php endif;?>>
    			<a href="<?php echo site_url('db/'.$table['table']);?>"><?php echo $table['table'];?></a>
    		</li>
    		<?php endforeach;?>
    	</ul>	
    
    </div> --><!-- /.bottomTabs -->
    
    <?php if( isset($tableFields) ):?>
    <?php $this->load->view("table/includes/modal_cell");?>
    
    <?php $this->load->view("table/includes/modal_record");?>
    
    <?php $this->load->view("table/includes/modal_viewrecord");?>
    
    <?php $this->load->view("table/includes/modal_newrecord");?>
    
    <?php $this->load->view("table/includes/modal_newcolumn");?>
    
    <?php $this->load->view("table/includes/modal_editcolumn");?>
    <?php endif;?>
    
    <?php $this->load->view("table/includes/modal_newtable");?>
    
    <?php $this->load->view("table/includes/modal_importdata");?>

    <!-- Load JS here for greater good =============================-->
    <script src="<?php echo base_url();?>js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-select.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-switch.js"></script>
    <script src="<?php echo base_url();?>js/flatui-fileinput.js"></script>
    <script src="<?php echo base_url();?>js/flatui-checkbox.js"></script>
    <script src="<?php echo base_url();?>js/flatui-radio.js"></script>
    <script src="<?php echo base_url();?>js/jquery.tagsinput.js"></script>
    <script src="<?php echo base_url();?>js/jquery.placeholder.js"></script>
    <script src="<?php echo base_url();?>js/application.js"></script>
    <script src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>js/dataTables.colReorder.min.js"></script>
    <script src="<?php echo base_url();?>js/TableTools.min.js"></script>
    <script src="<?php echo base_url();?>js/ZeroClipboard.js"></script>
    <script src="<?php echo base_url();?>js/bootstrap-datatables.js"></script>
    <script src="<?php echo base_url();?>js/datatables.plugins.js"></script>
    <script src="<?php echo base_url();?>js/jquery.form.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery.autosize.min.js"></script>
    <script src="<?php echo base_url();?>assets/redactor/redactor.js"></script>
    <script src="<?php echo base_url();?>assets/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>js/ajaxfileupload.js"></script>
    <script src="<?php echo base_url();?>js/jquery.query-object.js"></script>

    <?php if( isset($tableFields) ):?>
    <script>
    
    var allFields = new Array();
    
    <?php foreach($tableFields as $field):?>
    
    field = new Array();
    field['type'] = '<?php echo $field['type'];?>';
    field['max_length'] = <?php echo ($field['max_length'] != '')? $field['max_length']: 0;?>;
    
    allFields['<?php echo $field['field']?>'] = field;
    
    <?php endforeach;?>
    
    var _theTable = "<?php echo $theTable; ?>";
    var _tableUpdateAllowed = "<?php echo $tableUpdateAllowed;?>";
    
    var _fieldName;				//the field name of the clicked cell
    var _fieldValue;			//the field value
    var _rowIndex;				//the index value
    var _rowIndexName;			//the index name
    var _theDIV; 				//the clicked div wrapped around the td
    
    <?php
    	
    	$tempURL = site_url();
    	
    	$tempURL = rtrim($tempURL, "/");
    	
    ?>
    
    var _BASE_URL = "<?php echo $tempURL;?>";
    
    var _BASE_URLL = "<?php echo base_url();?>";//used for file paths
    
    var table = $('#table');
    
    var _colCounter = <?php if(isset($colCounter)) {echo $colCounter;} else {echo "0";}?>;//the number of visiable columns
    
    var fieldModal = $('#fieldModal');
    
    var _TOKEN = "<?php echo $this->session->userdata('session_id');?>";
    
    var _tablePrimaryKey = "<?php if($hasPrimary) {echo $primaryKey;} else {echo 0;}?>";
    
    var _theDeleteRevisionButton = '';
    
    var _columnToEdit = "";//contains the column name when the edit column modal is shown
            
    </script>
    <?php endif;?>
    <?php if( isset($tableFields) && $hasPrimary ):?>
    <script src="<?php echo base_url();?>js/dbapp/dbapp_table.js"></script>
    <script src="<?php echo base_url();?>js/dbapp/dbapp_table_cell.js"></script>
    <script src="<?php echo base_url();?>js/dbapp/dbapp_table_record.js"></script>
    <?php endif;?>
    <?php if( isset($tableFields) ):?>
    <script src="<?php echo base_url();?>js/dbapp/dbapp_table_columns.js"></script>
    <?php endif;?>
  	<script src="<?php echo base_url();?>js/dbapp/dbapp_table_new.js"></script>
  </body>
</html>
