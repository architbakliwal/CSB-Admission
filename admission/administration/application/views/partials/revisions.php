<div class="panel-group margin-bottom-15" id="recordRevisions">

	<?php $counter = 1;?>

	<?php foreach($revisions as $stamp=>$rev):?>
	<div class="panel panel-default">
    	<div class="panel-heading">
      		<h4 class="panel-title">
        		<a data-toggle="collapse" data-parent="#recordRevisions" href="#collapse_<?php echo $stamp;?>">
          			<span><?php echo $counter;?></span>&nbsp;&nbsp; <span class="fui-calendar text-primary"></span>&nbsp;&nbsp;<?php echo date("d M Y", $stamp)?> - <?php echo count($rev);?> field(s) - <span>click to expand</span>
        		</a>
      		</h4>
    	</div>
    	<div id="collapse_<?php echo $stamp;?>" class="panel-collapse collapse">
      		<div class="panel-body clearfix">
        		
        		<div class="table-responsive">
        			<table class="table table-bordered recordRevisionTable">
        		    	<thead>
        		      		<tr>
        		        		<th></th>
        		        		<th>Field</th>
        		        		<th>Value</th>
        		      		</tr>
        		    	</thead>
        		    	<tbody>
        		    		<?php foreach($rev as $revision):?>
        		      		<tr>
        		        		<td><label class="checkbox no-label" for="checkbox-table-<?php echo $revision->dbapp_cellrevisions_id;?>"><input type="checkbox" name="cellRevisions[]" value="<?php echo $revision->dbapp_cellrevisions_id;?>" class="revisionPartCheckbox" id="checkbox-table-<?php echo $revision->dbapp_cellrevisions_id;?>" data-toggle="checkbox"></label></td>
        		        		<td><b><?php echo $revision->dbapp_cellrevisions_field;?></b></td>
        		        		<td>
        		        			<div>
        		        				<?php echo $revision->dbapp_cellrevisions_value;?>
        		        			</div>
        		        		</td>
        		      		</tr>
        		      		<?php endforeach;?>
        		    	</tbody>
        		  	</table>
        		</div><!-- /.table-responsive -->
        		
        		<div class="row">
        			
        			<div class="col-md-4 text-left">
        				<a href="<?php echo site_url('revisions/viewRecord/'.$table."/".$indexName."/".$recordID."/".$revision->dbapp_cellrevisions_timestamp);?>" target="_blank" class="btn btn-inverse tt" data-placement="right" title="Click to show the entire value in a new window"><span class="fui-export"></span></a>
        			</div>
        			<div class="col-md-8 text-right">
        				<button type="button" class="btn btn-primary btn-embossed disabled restoreRevisionButton">Restore selected fields</button>
        				<button type="button" class="btn btn-danger btn-embossed deleteRecordRevision" id="<?php echo $revision->dbapp_cellrevisions_timestamp;?>"><span class="fui-cross-inverted"></span></button>  
        			</div>
        		
        		</div><!-- /.row -->
        		 
      		</div>
    	</div>
  	</div><!-- /.panel -->
  	
  	<?php $counter++;?>
  	
  	<?php endforeach;?>
  	
 </div><!-- /.panel -->