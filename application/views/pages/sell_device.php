		<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php $status = array('New','Good', 'Moderate');?>
	<?php $warranty = array('0-5 Months', '6-12 Months', '1-3 Years', '4-6 Years');?>
	<?php if(!isset($device_fetch)){?>
	<h4 class = "pheading">You are About to Sell the Device</h4>
		<?php } else {?>
	<h4 class = "pheading">Update Phone Details to Sell || <?php echo anchor('Home/view_device', 'Abort Transaction'); ?></h4>
	
	<?php } ?>
	<?php echo form_open('Home/sell_device', 'class="form-horizontal", role = "form"');?>
	
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php echo (form_error('dev_name') != '') ? '<div style = "color:#FF0000">'.form_error('dev_name').'</div>': '' ;?>
			<label for = "device_name" class = "">Device Name</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control" placeholder = "Example: Huawei " name = "dev_name" value = "<?php echo $result->dev_name; ?>" disabled = "disabled" >
				<?php }} else {?>
			<input type = "text" class = "form-control" placeholder = "Example: Huawei " name = "dev_name" value = "<?php echo ($this->input->post('dev_name') != '')  ? $_POST['dev_name'] : ''; ?>">
			<?php } ?>
			</div>
		
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php echo (form_error('dev_number') != '') ? '<div style = "color:#FF0000">'.form_error('dev_number').'</div>': '' ;?>
			<label for = "device_number" class = "">Device Number</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control" placeholder = "Example: Y300 " name = "dev_number" value = "<?php echo $result->dev_number;?>" disabled = "disabled">
					<?php }} else {?>
					
			<input type = "text" class = "form-control" placeholder = "Example: Y300 " name = "dev_number" value = "<?php echo ($this->input->post('dev_number')) ? $this->input->post('dev_number') : '';?>">
			<?php } ?>
			</div>
		
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php echo (form_error('dev_price') != '') ? '<div style = "color:#FF0000">'.form_error('dev_price').'</div>': '' ;?>
			<label for = "device_price" class = "">Device Minimum Price</label>
			<?php if(isset($device_fetch)) {?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control"  name = "dev_price" placeholder = "Example: 600000" value = "<?php echo $result->dev_price;?>" disabled = "disabled">
				<?php } } else {?>
			<input type = "text" class = "form-control"  name = "dev_price" placeholder = "Example: 600000" value = "<?php echo ($this->input->post('dev_price')) ? $this->input->post('dev_price') : '';?>">
			<?php } ?>
			</div>
		
		</div>
		
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php echo (form_error('sell_price') != '') ? '<div style = "color:#FF0000">'.form_error('sell_price').'</div>': '' ;?>
			<label for = "selling_price">Selling Price</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
		<input type = "text" name = "sell_price" class = "form-control" Placeholder = "Example: 1000000" value = "<?php echo $result->sold_amount; ?>">
				<?php } }  else {?>
			<input type = "text" name = "sell_price" class = "form-control" Placeholder = "Example: 1000000" value = "<?php echo ($this->input->post('sell_price')) ? $this->input->post('sell_price') : ''; ?>">
			<?php } ?>
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php echo (form_error('fname') != '') ? '<div style = "color:#FF0000">'.form_error('fname').'</div>': '' ;?>
			<label for = "fname" >Customer First Name</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
			<input type = "text" name = "fname" Placeholder = "Example: loveness" class = "form-control" value = "<?php echo $result->fname;?>">
				<?php } } else {?>
			<input type = "text" name = "fname" Placeholder = "Example: loveness" class = "form-control" value = "<?php echo ($this->input->post('fname')) ? $this->input->post('fname') : '';?>">
			<?php } ?>
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<label for = "fname" >Customer Last Name</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
			<input type = "text" name = "lname" Placeholder = "Example: sanga " class = "form-control" value = "<?php echo $result->lname;?>">
				<?php } } else {?>
			<input type = "text" name = "lname" Placeholder = "Example: sanga " class = "form-control" value = "<?php echo ($this->input->post('lname')) ? $this->input->post('lname') : '';?>">
			<?php } ?>
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<label for = "phone_number">Customer Phone Number</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
		<input type = "text" name = "cphone" class = "form-control" placeholder = "Example: 0714854114" value = "<?php echo $result->cphone;?>">
					<?php } } else {?>
			<input type = "text" name = "cphone" class = "form-control" placeholder = "Example: 0714854114" value = "<?php echo ($this->input->post('cphone')) ? $this->input->post('cphone'): '';?>">
		<?php } ?>
		</div>
	<div class = "col-sm-4 col-xs-4 col-lg-4">
			<label for = "phone_number">Email Address(Optional)</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
		<input type = "text" name = "cemail" class = "form-control" placeholder = "Example: france@gmail.com" value = "<?php echo $result->cemail;?>">
					<?php } } else {?>
			<input type = "text" name = "cemail" class = "form-control" placeholder = "Example: france@gmail.com" value = "<?php echo ($this->input->post('cemail')) ? $this->input->post('cemail'): '';?>">
		<?php } ?>
		</div>
	<div class = "col-sm-4 col-xs-4 col-lg-4">
			<label for = "selcome">Selcome Message(Optional)</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result){?>
			<textarea class = "form-control" name = "selcom" placeholder = "Example: mpesa 3425636728"><?php echo $result->selcom;?></textarea>
					<?php } } else {?>
			<textarea class = "form-control" name = "selcom" placeholder = "Example: mpesa 3425636728"><?php echo ($this->input->post('selcom')) ? $this->input->post('selcom') : '';?></textarea>
			<?php } ?>
			</div>
		</div>
		
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<?php if(isset($device_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
			<button type="submit" name = "action"  value = "Update" class="btn btn-md btn-success btn-block">Click to sell device</button>
		  <?php } else { if(isset($device_fetch)) { 
			  foreach($device_fetch as $p) { ?>
				<input type="hidden" name="id" value="<?php echo $p->dev_id; ?>" />
			<button type="submit" name = "action"  value = "Update" class="btn btn-md btn-success btn-block">Click to sell device</button>
			<?php }
			} else { ?>
       <button type="submit" class="btn btn-md btn-success btn-block">Add Device</button>
			<?php }
			} ?>
		</div>
	</div>
	<?php echo form_close();?>
	</div>

