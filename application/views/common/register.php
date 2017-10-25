	
<?php if(isset($login_fail)): ?>
<div class="alert alert-danger"><?php echo $this->lang->line('admin_login_error'); ?>
</div>
<?php endif; ?>
<?php// echo validation_errors(); ?>

<?php if(isset($message)): ?>
	<div class="alert alert-success"><?php echo $this->lang->line('admin_login_signin_success'); ?>
	</div>
<?php endif; ?>

<div class="">
	<?php echo form_open('Jobs/register', 'class="form-signin" role="form"'); ?>
	<h3 class="form-signin-head">
		<?php echo $this->lang->line('admin_login_header_register'); ?>
		</h3>
		<?php echo (form_error('usr_email') != '') ? '<div class="alert alert-danger">' . form_error('usr_email') . '</div>' : ''; ?>
		<input type="email" name="usr_email" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_email'); ?>"
		 autofocus value = "<?php echo (isset($_POST['usr_email']) ? $_POST['usr_email'] : '') ;?>" /><br/>
		 <?php echo (form_error('usr_email_confirm') != '') ? '<div class="alert alert-danger">' . form_error('usr_email_confirm') . '</div>' : ''; ?>
		<input type="text" name="usr_email_confirm" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_email_confirm'); ?>"
		 autofocus  value = "<?php echo (isset($_POST['usr_email_confirm']) ? $_POST['usr_email_confirm'] : '') ;?>"/><br/>
		 <?php echo (form_error('usr_password') != '') ? '<div class="alert alert-danger">' . form_error('usr_password') . '</div>' : ''; ?>
		<input type="password" name="usr_password" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_password'); ?>"
		  value = "<?php echo (isset($_POST['usr_password']) ? $_POST['usr_password'] : '') ;?>"/>
		
		<?php echo (form_error('usr_password_confirm') != '') ? '<div class="alert alert-danger">' . form_error('usr_password_confirm') . '</div>' : ''; ?>
		<input type="password" name="usr_password_confirm" class="form-control" placeholder="<?php echo $this->lang->line('admin_login_password_confirm'); ?>"
		autofocus />
		<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $this->lang->line('admin_login_signin_register'); ?>
		</button>
		<?php echo form_close(); ?>
	</div>
</div>
</div>
