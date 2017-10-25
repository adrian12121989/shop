
	<?php echo ($this->session->flashdata('loggedout')) ? '<div class = "alert alert-success">'.$this->session->flashdata('loggedout').'</div>' : '';?>

<?php if(isset($login_fail)): ?>
<div class="alert alert-danger"><center><?php echo $this->lang->line('admin_login_error'); ?></center>
</div>
<?php endif; ?>
<?php //echo validation_errors(); ?>
<?php if(isset($message)): ?>
<div class="alert alert-success"><center><?php echo $this->lang->line('user_registered'); ?></center>
</div>
<?php endif; ?>


	<?php echo form_open('Home/login', 'class="form-signin" role="form"'); ?>
	<h3 class="form-signin-head">
		<?php echo $this->lang->line('admin_login_header_login'); ?>
		</h3>
		 <?php echo (form_error('usr_email') != '') ? '<div style="color:#FF0000">' . form_error('usr_email') . '</div>' : ''; ?>
		<input type="text" name="usr_email" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_email'); ?>"
		 autofocus   value = "<?php echo (isset($_POST['usr_email']) ? $_POST['usr_email'] : '') ;?>"/><br/>
		  <?php echo (form_error('usr_password') != '') ? '<div style="color:#FF0000">' . form_error('usr_password') . '</div>' : ''; ?>
		<input type="password" name="usr_password" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_password'); ?>"
		 />
		<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $this->lang->line('admin_login_signin_login'); ?>
		</button>
		<?php echo form_close(); ?>
	
