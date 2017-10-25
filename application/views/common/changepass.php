
	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<?php if(isset($old_pass_fail)): ?>
<div class="alert alert-danger"><?php echo $this->lang->line('old_pass_fail'); ?>
</div>
<?php endif; ?>
<?php //echo validation_errors(); ?>
<?php if(isset($message_success)): ?>
<div class="alert alert-success"><?php echo $this->lang->line('message_success'); ?>
</div>
<?php endif; ?>

<?php if(isset($message_fail)): ?>
<div class="alert alert-danger"><?php echo $this->lang->line('message_fail'); ?>
</div>
<?php endif; ?>

<div class="">
	<?php echo form_open('Home/changepass', 'class="change-signin" role="form"'); ?>
	<h4 class="form-signin-head">
		<?php echo $this->lang->line('changepass_header'); ?>
		</h4>
		<input type="password" name="old_password" class="form-control" placeholder="<?php echo $this->lang->line('changepass_old'); ?>"
		 autofocus  />
		  <?php echo (form_error('old_password') != '') ? '<div class="alert alert-danger">' . form_error('old_password') . '</div>' : ''; ?>
		<input type="password" name="new_password" class="form-control" placeholder="<?php echo $this->lang->line('changepass_new'); ?>"
		 />
		 <?php echo (form_error('new_password') != '') ? '<div class="alert alert-danger">' . form_error('new_password') . '</div>' : ''; ?>
		<input type="password" name="confirm_new_password" class="form-control" placeholder="<?php echo $this->lang->line('changepass_confirm'); ?>"
		 />
		 <?php echo (form_error('confirm_new_password') != '') ? '<div class="alert alert-danger">' . form_error('confirm_new_password') . '</div>' : ''; ?>

		<button type="submit" class="btn btn-lg btn-primary btn-block"><?php echo $this->lang->line('changepass_signin'); ?>
		</button>
		<?php echo form_close(); ?>
	</div>
</div>
