	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php
		$loan = array('Loan Borrowing', 'Loan Payment');	
	?>
	<?php if(isset($edit)) {?>
	<h3>Update Loan Information</h3>
		<?php } else {?>
	<h3>Loan Information</h3>
	<?php } ?>
	<?php echo form_open('Home/loan_records', 'class="form-horizontal" role="form"');?>
	
		<div class = "form-group">
			
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php echo (form_error('lcategory'))? '<div style = "color:#FF0000">'.form_error('lcategory').'</div>' : '';?>
				<label for = "category">Select Category:*</label>
				<select name = "lcategory" class = "form-control">
					<option value = "">--Select Loan Category--</option>
					<?php 
					
					if(isset($edit)){
						foreach($edit as $record){
							foreach($loan as $rec){
								
							if($record->bcategory == $rec){
								echo '<option value = "'.$record->bcategory.'" selected = "selected">'.$record->bcategory.'</option>';
							}elseif($record->pcategory == $rec){
								echo '<option value = "'.$record->pcategory.'" selected = "selected">'.$record->pcategory.'</option>';
							}
								else {
								echo '<option value = "'.$rec.'">'.$rec.'</option>';
							}
						}
						
					}
					}else{
					$lon = ($this->input->post('lcategory'))?  $this->input->post('lcategory'): '';
					foreach($loan as $record){
						if($record == $lon){
							echo '<option value = "'.$record.'" selected = "selected">'.$record.'</option>';
						}else{
							echo '<option value = "'.$record.'">'.$record.'</option>';
						}
					}
				}
					
				?>
					</select>
			 </div>
			 </div>
			 
			<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php echo (form_error('employee'))? '<div style = "color:#FF0000">'.form_error('employee').'</div>' : '';?>
				<label for = "category">Employee Name:*</label>
				<select name = "employee" class = "form-control">
					<option value = "">--Select Employee Name--</option>
					
					<?php
					if(isset($edit)){
						foreach($edit as $record){
							foreach($employees as $rec){
								if($record->bname == $rec->emp_id || $record->pname == $rec->emp_id){
							echo '<option value = "'.$rec->emp_id.'" selected = "selected">'.$rec->first_name.' '.$rec->middle_name.' '.$rec->last_name.'</option>';	
								}
								
								else{
							echo '<option value = "'.$rec->emp_id.'">'.$rec->first_name.' '.$rec->middle_name.' '.$rec->last_name.'</option>';	
								}
							}
						}
					}else{
					$emp = ($this->input->post('employee')) ? $this->input->post('employee') : '';
					foreach($employees as $record){
						if($record->emp_id == $emp){
							echo '<option value = "'.$record->emp_id.'" selected = "selected">'.$record->first_name.' '.$record->middle_name.' '.$record->last_name.'</option>';
						}else{
							echo '<option value = "'.$record->emp_id.'">'.$record->first_name.' '.$record->middle_name.' '.$record->last_name.'</option>';
						}
					}
				}
					
					
					?>
					
					
					</select>
			 </div>
			</div>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php echo (form_error('loan_desc'))? '<div style = "color:#FF0000">'.form_error('loan_desc').'</div>' : '';?>
				<label for = "loan_desc">Loan Description:*</label>
				<?php if(isset($edit)){?>
					<?php foreach($edit as $record){?>
						<?php if($record->bcategory == "Loan Borrowing"){?>
				<textarea name = "loan_desc" class = "form-control"><?php echo $record->bpurpose;?></textarea>		
							<?php } elseif($record->pcategory == "Loan Payment"){?>
				<textarea name = "loan_desc" class = "form-control"><?php echo $record->ppurpose;?></textarea>
								<?php } ?>
						<?php } ?>
					<?php } else {?>
				<textarea name = "loan_desc" class = "form-control"><?php echo ($this->input->post('loan_desc')) ? $this->input->post('loan_desc') : '';?></textarea>
				<?php } ?>
				</div>
			</div>
		
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php echo (form_error('amount'))? '<div style = "color:#FF0000">'.form_error('amount').'</div>' : '';?>
				<label for = "loan_amount">Amount:*</label>
				<?php if(isset($edit)) {?>
					<?php foreach($edit as $record) {?>
						<?php if($record->bcategory == "Loan Borrowing"){?>
				<input type = "text" name = "amount" class = "form-control" value = "<?php echo $record->bamount;?>">			
							<?php } elseif($record->pcategory == "Loan Payment"){ ?>
				<input type = "text" name = "amount" class = "form-control" value = "<?php echo $record->pamount;?>">
						<?php } } ?>
					<?php } else {?>
				<input type = "text" name = "amount" class = "form-control" value = "<?php echo ($this->input->post('amount')) ? $this->input->post('amount') : '';?>">
				<?php } ?>
				</div>
			</div>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php if(isset($edit)) {?>
					<?php foreach($edit as $record){?>
						<?php if($record->bcategory == "Loan Borrowing"){?>
				<input type = "hidden" name = "loan_id" value = "<?php echo ($record->borrow_id);?>">
				
				<?php } elseif($record->pcategory == "Loan Payment"){?>
				<input type = "hidden" name = "loan_id" value = "<?php echo ($record->pay_id);?>">
				<?php } ?>
				<button type="submit" name = "action" value = "Update" class="btn btn-mds btn-primary btn-block">Update</button>
				<?php } ?>
					<?php } else {?>
				<button type="submit" class="btn btn-mds btn-primary btn-block">Submit</button>
				<?php } ?>
				</div>
			</div>
		
	<?php echo form_close();?>
	
	
