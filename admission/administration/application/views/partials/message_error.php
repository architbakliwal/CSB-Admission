<div class="alert alert-error">
	<button type="button" class="close fui-cross" data-dismiss="alert"></button>
  	<?php if(isset($error_message_heading)):?><h4><?php echo $error_message_heading;?></h4><?php endif;?>
  	<p>
  		<?php echo $error_message;?>
  	</p>
</div>