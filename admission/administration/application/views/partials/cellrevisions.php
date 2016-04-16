<!--<div class="row">
		
	<div class="col-md-4"></div>
		
	<div class="col-md-8">
		<div class="form-group">
			<div class="input-group input-group-sm">
			    <span class="input-group-btn">
				    <button type="submit" class="btn"><span class="fui-search"></span></button>
				</span>
			    <input type="search" class="form-control" placeholder="Search revisions" id="revisionsTableSearch">
			</div>
		</div>
	</div>
		
</div>-->

<div class="table-responsive" id="cellRevisionTable">

	<table class="table table-bordered" id="revisionTable">
    	<thead>
      		<tr>
        		<th style="width: 130px;">Date</th>
        		<th>Revision</th>
        		<th style="width: 180px;"></th>
      		</tr>
    	</thead>
    	<tbody>
      		
      		<?php foreach($revisions as $revision):?>
      		<tr>
      			<td><?php echo date("d M Y", $revision->dbapp_cellrevisions_timestamp);?></td>
      			<td>
      				<div class="cell"><?php echo $revision->dbapp_cellrevisions_value;?></div>
      			</td>
      			<td>
      				<a href="<?php echo site_url('revisions/viewCell/'.$revision->dbapp_cellrevisions_id)?>" target="_blank" class="btn btn-xs btn-info tt" data-toggle="tooltip" title="Click to show the entire revision in a new window" data-placement="left"><span class="fui-export"></span></a> <button class="btn btn-xs btn-primary restoreRevision" id="<?php echo $revision->dbapp_cellrevisions_id;?>">Restore</button> <button class="btn btn-xs btn-danger removeRevision" id="<?php echo $revision->dbapp_cellrevisions_id;?>"><span class="fui-cross"></span></button>
      			</td>
      		</tr>
      		<?php endforeach;?>
      		
    	</tbody>
 	</table>
 	
</div><!-- /.table-responsive -->