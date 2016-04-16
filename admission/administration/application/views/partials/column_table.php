<table class="table table-striped table-hover" id="columnTable">
	<thead>
		<tr>
			<th width="30px">
				<label class="checkbox no-label toggle-all fieldNameAllLabel" id="fieldNameAllLabel" for="checkbox-table-0">
					<input type="checkbox" class="fieldNameAll" value="" id="checkbox-table-0" data-toggle="checkbox" <?php if(count($this->session->userdata($theTable)) == count($tableFields)):?>checked<?php endif;?>>
				</label>
			</th>
			<th width="150px">Field name</th>
			<th width="150px">Column type</th>
			<th>Index</th>
			<th width="175px"><?php if($this->usermodel->hasTablePermission("alter", $theTable)):?>Actions<?php endif;?></th>
		</tr>
	</thead>
	<tbody>
		<?php $counter = 1;?>
		<?php foreach($tableFields as $field):?>
		<tr>
			<td>
				<?php if($counter >= 1):?><label class="checkbox no-label <?php if(in_array($field['field'], $this->session->userdata($theTable))):?>checked<?php endif;?> fieldNameLabel" for="checkbox-table-<?php echo $counter;?>">
					<input type="checkbox" value="<?php echo $theTable?>.<?php echo $field['field']?>" id="checkbox-table-<?php echo $counter;?>" data-toggle="checkbox" class="fieldName" <?php if(in_array($field['field'], $this->session->userdata($theTable))):?>checked<?php endif;?>>
				</label><?php endif;?>
			</td>
			<td>
				<span class="columnLabel" id="<?php echo $field['field'];?>">
					<?php echo $field['field'];?>
				</span>
			</td>
			<td>
				<?php if( $field['type'] == 'int' ):?>
				Number
				<?php elseif( $field['type'] == 'varchar' ):?>
				Small text
				<?php elseif( $field['type'] == 'text' ):?>
				Big text
				<?php elseif( $field['type'] == 'blob' ):?>
				File
				<?php elseif( $field['type'] == 'date' ):?>
				Date
				<?php endif;?>
			</td>
			<td>
				<?php if( $field['index'] == 'primary' ):?><span class="label label-primary">primary key</span><?php endif;?>
				<?php if( $field['index'] == 'unique' ):?><span class="label label-default">unique index</span><?php endif;?>
				<?php if( $field['index'] == 'index' ):?><span class="label label-default">regular index</span><?php endif;?>
			</td>
			<td>
				<?php if($this->usermodel->hasTablePermission("alter", $theTable)):?>
				<a href="#editColumnModal" id="column#<?php echo $field['field'];?>" class="btn btn-xs btn-info editColumn" data-toggle="modal"><span class="fui-new"></span> Edit</a> <a href="<?php echo site_url('columns/delete/'.$theTable."/".$field['field']);?>" type="button" class="btn btn-xs btn-danger deleteCloumn"><span class="fui-cross-inverted"></span> Delete</a>
				<?php endif;?>
			</td>
		</tr>
		<?php $counter++;?>
		<?php endforeach;?>
	</tbody>
</table>