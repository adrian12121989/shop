<style type="text/css">
.img {
	background-image: url("upload/profile.jpeg");
}
</style>

<h4 style="font-family: Times New Roman, Times, serif;"><?php echo "You have successfully logged in as ". '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?></h4>

 
		  <?php if(isset($query)): ?>
			<br />
			<?php foreach ($query->result() as $row) : ?>
			<img src="<?php echo base_url() . 'upload/' . $row->img_dir_name . '/' . $row->img_name; ?>"  width = "165" height = "165" class = "img-circle"/>
			<?php endforeach;  ?>
			<?php  endif; ?>
			
			
	
	<?php if(isset($success) && $success == true): ?>
	<div class="alert alert-success">
		<strong><?php echo $this->lang->line('common_form_elements_error_notify'); ?></strong>
		<?php echo $this->lang->line('encode_encode_now_error'); ?>
		<?php echo $fail; ?>
		
		<?php endif; ?>
		<?php if(isset($fail))
		{
			echo '<div class="alert alert-danger">Invalid image!</div>';
		}?>
		<?php echo form_open_multipart('Home/do_upload'); ?>
		<input type="file" name="userfile" size="20" />
		<?php if(isset($query)){?>
			<button type="submit" class="btn btn-success" value="upload" >Change profile Photo</button>
			<?php } else {?>
		<button type="submit" class="btn btn-success" value="upload" >Change Profile Photo</button>
		<?php } ?>
		<?php echo form_close(); ?>		
		
		</div>
