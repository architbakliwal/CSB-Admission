<!-- Modal -->
<form class="form-horizontal" role="form" id="columnEditForm" method="post" action="<?php echo site_url('columns/update/'.$theTable);?>">
<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">
<div class="modal fade" id="editColumnModal" tabindex="-1" role="dialog" aria-labelledby="columnModal" aria-hidden="true">

	<div class="modal-dialog">
	
    	<div class="modal-content">
    	
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        		<h4 class="modal-title" id=""><span class="fui-list-numbered"></span> Edit column: <span id="theColumnName"></span></h4>
      		</div>
      		
      		<div class="modal-body">
      		
      			
      			
      			<ul class="nav nav-tabs nav-append-content">
      			 	<li class="active"><a href="#column__tab1">Column details</a></li>
      			 	<li><a href="#column__tab3">Restrictions</a></li>
     			</ul> <!-- /tabs -->
      			
      			<div class="tab-content">
      			
     				<div class="tab-pane active" id="column__tab1">
      			    	
      			    	<div id="columnEditWrapper"></div>
      			    	
     				</div>
     				
     				<div class="tab-pane" id="column__tab3">
     				
     					<div class="alert alert-info">
     						<button type="button" class="close fui-cross" data-dismiss="alert"></button>
     					  	<h4>Column restrictions</h4>
     					  	<p>
     					  		There are a variety of restrictions you set on each column. To learn more about the available restrictions, please click the button below:
     					  	</p>
     					  	<a href="<?php echo site_url('doc/columnrestrictions');?>" class="btn btn-info btn-wide" target="_blank">Available restrictions <span class="fui-export"></span></a>
     					</div>
     				 	
     				 	<div id="columnRestrictionsWrapper"></div>
     				 	
     				</div>
      			      			
     			</div> <!-- /tab-content -->
      			
      		</div><!-- /.modal-body -->
      		
      		<div class="modal-footer">
      			
      			<button type="button" class="btn btn-info btn-embossed" id="columnModal_savecolumn">Update column</button>
        		<button type="button" class="btn btn-default btn-embossed" id="columnModal_close" data-dismiss="modal">Close window</button>
        		
      		</div>
      		
    	</div><!-- /.modal-content -->
    	
  	</div><!-- /.modal-dialog -->
  	
</div><!-- /.modal -->
</form>
