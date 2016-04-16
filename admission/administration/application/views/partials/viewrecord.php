<form method="post" id="recordForm">

	<input type="hidden" name="_token" value="<?php echo $this->session->userdata('session_id');?>">

	<div class="panel-group margin-bottom-15" id="recordDetails">
	
		<?php
			$counter = 0;
		?>

		<?php foreach($recordData as $field=>$value):?>
		
		<?php if($counter > 0):?>
		<div class="panel panel-default">
    		<div class="panel-heading">
      			<h4 class="panel-title">
        			<a data-toggle="collapse" data-parent="#recordDetails" href="#collapse_<?php echo $field;?>">
          				<?php echo $field;?>
        			</a>
      			</h4>
    		</div>
    		<div id="collapse_<?php echo $field;?>" class="panel-collapse collapse in">
      			<div class="panel-body">
      				
      				<div class="fieldValue">
      					<?php echo $value['val'];?>
      				</div>
        		
      			</div>
    		</div>
		</div><!-- /.panel -->
		<?php endif;?>
		
		<?php $counter++;?>
		
		<?php endforeach;?>
		
	</div><!-- .panel-group -->

</form>