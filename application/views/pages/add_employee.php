	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php $pos = array('Admin', 'Seller', 'Worker');?>
	<?php if(isset($edit_emp)){?>
	<h3>Update Employee Information</h3>
		<?php } else {?>
	<h3>Add New Employee</h3>
	<?php } ?>
	<?php echo form_open('Home/add_employees', 'class = "form-horizontal" role = "form"');?>
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('fname') != '') ? '<div style = "color:#FF0000">' . form_error('fname') . '</div>' : ''; ?>
			<label for = "fname">First Name</label>
			<?php if(isset($edit_emp)) {?>
				<?php foreach($edit_emp as $result){?>
		<input type = "text" name = "fname" class = "form-control" value = "<?php echo $result->first_name;?>">
				<?php } }  else {?>
			<input type = "text" name = "fname" class = "form-control" value = "<?php echo ($this->input->post('fname')) ? $this->input->post('fname'): '';?>">
			<?php } ?>
			</div>
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('mname') != '') ? '<div style = "color:#FF0000">' . form_error('mname') . '</div>' : ''; ?>
			<label for = "mname">Middle Name</label>
			<?php if(isset($edit_emp)) {?>
				<?php foreach($edit_emp as $result){?>
				<input type = "text" name = "mname" class = "form-control" value = "<?php echo $result->middle_name;?>">
					<?php } }  else {?>
			<input type = "text" name = "mname" class = "form-control" value = "<?php echo ($this->input->post('mname')) ? $this->input->post('mname'): '';?>">
			<?php } ?>
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('lname') != '') ? '<div style = "color:#FF0000">' . form_error('lname') . '</div>' : ''; ?>
			<label for = "lname">Last Name</label>
			<?php if(isset($edit_emp)) {?>
				<?php foreach($edit_emp as $result){?>
			<input type = "text" name = "lname" class = "form-control" value = "<?php echo $result->last_name;?>">
					<?php } } else {?>
			<input type = "text" name = "lname" class = "form-control" value = "<?php echo ($this->input->post('lname')) ? $this->input->post('lname'): '';?>">
			<?php } ?>
			</div>
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('phone') != '') ? '<div style = "color:#FF0000">' . form_error('phone') . '</div>' : ''; ?>
			<label for = "phone">Phone Number</label>
			<?php if(isset($edit_emp)) {?>
				<?php foreach($edit_emp as $result){?>
			<input type = "text" name = "phone" class = "form-control" value = "<?php echo $result->phone_number;?>">
			<?php } } else {?>
			<input type = "text" name = "phone" class = "form-control" value = "<?php echo ($this->input->post('phone')) ? $this->input->post('phone'): '';?>">
		<?php } ?>
		</div>
	</div>
	
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<label for = "position">Position</label>
			<select name = "position" class = "form-control">
				<option value = "">--Select Position--</option>
				<?php 
				
				$position = ($this->input->post('position'))? $this->input->post('position') : '';
				if(isset($edit_emp)){
					foreach($edit_emp as $result){
						foreach($pos as $value){
							if($result->position == $value){
								echo '<option value = "'.$value.'" selected = "selected">'.$value.'</option>';
							}else{
								echo ($value == $position) ? '<option value = "'.$value.'" selected = "selected">'.$value.'</option>' :
								'<option value = "'.$value.'">'.$value.'</option>';
							}
						}
					}
				}else{
				foreach($pos as $value){
					echo ($value == $position) ? '<option value = "'.$value.'" selected = "selected">'.$value.'</option>' :
					'<option value = "'.$value.'">'.$value.'</option>'; 
				}
			}
				
				?>
				</select>
			</div>
		</div>
	
	<div class = "form-group">
		<div class="col-xs-5 col-md-5 col-lg-5">
		  <?php if(isset($add_error)) { ?>
			   <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
				  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update Employee Info</button>
		  <?php } else { if(isset($edit_emp)) {
			  foreach($edit_emp as $c) { ?>
				  <input type="hidden" name="id" value="<?php echo $c->emp_id; ?>" />
				  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update Employee Info</button>
				  <?php } } else { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Add New Employee</button>
        <?php } } ?>
      </div>
		</div>
	<?php echo form_close();?>
