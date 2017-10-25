	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php if(isset($edit_exp)) {?>
		<h3>Update Expenditure Information</h3>
		<?php } else {?>
	<h3>Add New Expenditure</h3>
	<?php } ?>
	<?php echo form_open('Home/shop_expenditure', 'class = "form-horizontal", role = "form"');?>
	
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('ename') != '') ? '<div style = "color:#FF0000">' . form_error('ename') . '</div>' : ''; ?>
			<label for = "exp_name">Expenditure Name</label>
			<?php if(isset($edit_exp)){?>
				<?php foreach($edit_exp as $result) {?>
			<input type = "text" name = "ename" class = "form-control" placeholder = "Example: Salary" value = "<?php echo $result->exp_name;?>">
				<?php }  } else {?>
			<input type = "text" name = "ename" class = "form-control" placeholder = "Example: Salary">
			<?php } ?>
			</div>
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('epay') != '') ? '<div style = "color:#FF0000">' . form_error('epay') . '</div>' : ''; ?>
			<label for = "exppay">Paid To</label>
			<?php if(isset($edit_exp)){?>
				<?php foreach($edit_exp as $result) {?>
			<input type = "text" name = "epay" class = "form-control" placeholder = "Example: damson daniel" value = "<?php echo $result->payee_name; ?>">
					<?php } } else {?>
			<input type = "text" name = "epay" class = "form-control" placeholder = "Example: damson daniel">
			<?php } ?>
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('eamount') != '') ? '<div style = "color:#FF0000">' . form_error('eamount') . '</div>' : ''; ?>
			<label for = "amount">Amount</label>
			<?php if(isset($edit_exp)){?>
				<?php foreach($edit_exp as $result) {?>
			<input type = "text" name = "eamount" class = "form-control" placeholder = "Example: 150000" value = "<?php echo $result->amount?>">
					<?php } } else {?>
			<input type = "text" name = "eamount" class = "form-control" placeholder = "Example: 150000">
			<?php } ?>
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php if(isset($edit_exp)){?>
		<input type = "hidden" name = "id" value = "<?php echo $result->exp_id;?>">
		<button type = "submit" name = "action" value = "Update" class = "btn btn-md btn-info btn-block">Update Expenditure Information</button>
				<?php } else {?>
			<button type = "submit" class = "btn btn-md btn-info btn-block">Add Expenditure</button>
			<?php } ?>
			</div>
		</div>
	
	<?php echo form_close();?>
