<br />
<div class="page-header">
	<h2><?php echo $this->lang->line('system_system_name'); ?></h2>
	</div>
	
	<?php if(isset($result) && $result == true): ?>
		<div class="">
			<strong><?php echo $this->lang->line('encode_encoded_url'); ?></strong>
			<?php echo anchor($result, $result); ?>
			<br />
			<img src="<?php echo base_url() . 'upload/' . $img_dir_name . '/' . $file_name; ?>" width="200"/>
			</div>
			<?php endif; ?>
