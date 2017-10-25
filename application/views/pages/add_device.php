	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php $status = array('New','Good', 'Moderate');?>
	<?php $warranty = array('0-5 Months', '6-12 Months', '1-3 Years', '4-6 Years');?>
	<?php if(isset($device_fetch)){?>
	<h4 class = "pheading">Update Device Information</h4>
		<?php } else {?>
	<h4 class = "pheading">Register New Device Information</h4>
	<?php } ?>
	<?php echo form_open('Home/add_device', 'class="form-horizontal", role = "form"');?>
	
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('dev_name') != '') ? '<div style = "color:#FF0000">'.form_error('dev_name').'</div>': '' ;?>
			<label for = "device_name" class = "">Device Name</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control" placeholder = "Example: Huawei " name = "dev_name" value = "<?php echo $result->dev_name; ?>">
				<?php }} else {?>
			<input type = "text" class = "form-control" placeholder = "Example: Huawei " name = "dev_name" value = "<?php echo ($this->input->post('dev_name') != '')  ? $_POST['dev_name'] : ''; ?>">
			<?php } ?>
			</div>
		
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('dev_number') != '') ? '<div style = "color:#FF0000">'.form_error('dev_number').'</div>': '' ;?>
			<label for = "device_number" class = "">Device Number</label>
			<?php if(isset($device_fetch)){?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control" placeholder = "Example: Y300 " name = "dev_number" value = "<?php echo $result->dev_number;?>">
					<?php }} else {?>
					
			<input type = "text" class = "form-control" placeholder = "Example: Y300 " name = "dev_number" value = "<?php echo ($this->input->post('dev_number')) ? $this->input->post('dev_number') : '';?>">
			<?php } ?>
			</div>
		
		</div>
		
		<div class = "form-group">
			
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('dev_price') != '') ? '<div style = "color:#FF0000">'.form_error('dev_price').'</div>': '' ;?>
			<label for = "device_price" class = "">Device Price</label>
			<?php if(isset($device_fetch)) {?>
				<?php foreach($device_fetch as $result) {?>
			<input type = "text" class = "form-control"  name = "dev_price" placeholder = "Example: 600000" value = "<?php echo $result->dev_price;?>">
				<?php } } else {?>
			<input type = "text" class = "form-control"  name = "dev_price" placeholder = "Example: 600000" value = "<?php echo ($this->input->post('dev_price')) ? $this->input->post('dev_price') : '';?>">
			<?php } ?>
			</div>
			
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('dev_warranty') != '') ? '<div style = "color:#FF0000">'.form_error('dev_warranty').'</div>': '' ;?>
			<label for = "device_warranty" class = "">Device Warranty</label>
			<select name = "dev_warranty" class = "form-control">
				<option value = "">--Select Device Warranty</option>
				<?php
				
				$war = ($this->input->post('dev_warranty')) ? $this->input->post('dev_warranty'): '';
				if(isset($device_fetch)){
					foreach($device_fetch as $result){
						foreach($warranty as $value){
							if($result->dev_warranty == $value){
								echo '<option value = "'.$result->dev_warranty.'" selected = "selected">'.$result->dev_warranty.'</option>';
							}else{
								echo ($value == $war) ? '<option value = "'.$value.'" selected = "selected">'.$value : 
								'<option value = "'.$value.'">'.$value;
							}
						}
					}
					
				}else{
				foreach($warranty as $value){
					echo ($value == $war) ? '<option value = "'.$value.'" selected = "selected">'.$value.'</option>' : 
					'<option value = "'.$value.'">'.$value.'</option>';
				}
			}
				
				?>
				</select>
			</div>
		
		</div>
		
		<div class = "form-group">
			
			<div class = "col-sm-5 col-lg-5 col-xs-5">
				<label for = "device_imei" class = "">Device Imei</label>
				<?php if(isset($device_fetch)){?>
					<?php foreach($device_fetch as $result){?>
				<input type = "text" name = "dev_imei" class = "form-control" value = "<?php echo $result->dev_imei;?>"
				placeholder = "Example: 123456628726256526">		
					<?php } } else {?>
				<input type = "text" name = "dev_imei" class = "form-control" value = "<?php echo ($this->input->post('dev_imei')) ? $this->input->post('dev_imei') : '';?>"
				placeholder = "Example: 123456628726256526">
				<?php } ?>
				</div>
			
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php echo (form_error('dev_status') != '') ? '<div style = "color:#FF0000">'.form_error('dev_status').'</div>': '' ;?>
			<label for = "device_work_status" class = "">Device Working Status</label>
			<select name = "dev_status" class = "form-control" id = "dev_status">
				<option value = "">--Select Device Working Status</option>
				<?php
				  $dev_stats = ($this->input->post('dev_status'))? $this->input->post('dev_status') : '';
					if(isset($device_fetch)){
						foreach($device_fetch as $result){
							foreach($status as $value){
								if($result->dev_status == $value){
									echo '<option value = "'.$result->dev_status.'" selected = "selected">'.$result->dev_status.'</option>';
								}else{
									echo ($value == $dev_stats) ? '<option value = "'.$value.'" selected = "selected">' : 
									'<option value = "'.$value.'">'.$value;
								}
							}
						}
					}else{
					
					foreach($status as $dev){
						echo ($dev == $dev_stats) ? '<option value = "'.$dev.'" selected = "selected">'.$dev.'</option>': 
						'<option value = "'.$dev.'">'.$dev.'</option>';
					}
				}
				
				?>
				</select>
			</div>
		
		</div>
		
	<div class = "form-group">
		<div class = "col-sm-5 col-xs-5 col-lg-5">
			<?php if(isset($device_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
			<button type="submit" name = "action"  value = "Update" class="btn btn-md btn-success btn-block">Update Device Information</button>
			
		  <?php } else { if(isset($device_fetch)) { 
			  foreach($device_fetch as $p) { ?>
				<input type="hidden" name="id" value="<?php echo $p->dev_id; ?>" />
			<button type="submit" name = "action"  value = "Update" class="btn btn-md btn-success btn-block">Update Device Information</button>
			<?php }
			} else { ?>
       <button type="submit" class="btn btn-md btn-success btn-block">Add Device</button>
			<?php }
			} ?>
		</div>
	</div>
	<?php echo form_close();?>
	</div>
