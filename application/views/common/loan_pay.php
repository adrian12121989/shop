			<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
			</div>
			<?php if(isset($edit)) {?>
			<h3>Update Loan Payment Information</h3>
				<?php } else {?>
		<h3>Loan Payment Information</h3>
		<?php } ?>
		<?php echo form_open('Home/loan_pay', 'class="form-horizontal" role="form"');?>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<label for = "employee">Employee Name:*</label>
				<?php echo (form_error('employee') != '') ?'<div style = "color:#FF0000">'.form_error('employee').'</div>' : '';?>
				<select name = "employee" class = "form-control" name = "employee">
					<option value = "">--Select Employee Name--</option>
					
					<?php
					if(isset($edit)){
						foreach($edit as $record){
							foreach($employees as $emp){
								if($record->pname == $emp->emp_id){
								echo '<option value = "'.$record->pname.'" selected = "selected">'.$record->first_name.' '.
								$record->middle_name.' '.$record->last_name.'</option>';	
								}else{
								echo '<option value = "'.$emp->emp_id.'">'.$emp->first_name.' '.$emp->middle_name.' '.
								$emp->last_name.'</option>';
								}
							}
						}
					}else{
						$emp = ($this->input->post('employee'))? $this->input->post('employee') : '';
						foreach($employees as $record){
							if($record->emp_id == $emp){
								echo '<option value = "'.$record->emp_id.'" selected = "selected">'.$record->first_name.' '.
								$record->middle_name.' '.$record->last_name.'</option>';
							}else{
								echo '<option value = "'.$record->emp_id.'">'.$record->first_name.' '.$record->middle_name.' '.
								$record->last_name.'</option>';
							}
						}
					}
					?>
					
					
					
					</select>
				</div>
			</div>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<label for = "loan_desc">Loan Description:*</label>
				<?php echo (form_error('loan_desc') != '') ?'<div style = "color:#FF0000">'.form_error('loan_desc').'</div>' : '';?>
				<?php if(isset($edit)){?>
					<?php foreach($edit as $rec){?>
				<textarea class = "form-control" name = "loan_desc"><?php echo $rec->ppurpose ;?></textarea>		
					<?php } }  else {?>
				<textarea class = "form-control" name = "loan_desc"></textarea>
				<?php } ?>
				</div>
			</div>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<label for = "loan_desc">Amount:*</label>
				<?php echo (form_error('amount') != '') ?'<div style = "color:#FF0000">'.form_error('amount').'</div>' : '';?>
				<?php if(isset($edit)) {?>
				<?php foreach($edit as $rec){?>
				<input type = "text" name = "amount" class = "form-control" value = "<?php echo $rec->pamount ;?>">	
					<?php } } else {?>
				<input type = "text" name = "amount" class = "form-control">
				<?php } ?>
				</div>
			</div>
		
		<div class = "form-group">
			<div class = "col-sm-5 col-xs-5 col-lg-5">
				<?php if(isset($edit)) {?>
					<?php foreach($edit as $rec){?>
						<input type = "hidden" name = "pay_id" value = "<?php echo $rec->pay_id ;?>">
					<button type="submit" name = "action" value = "Update" class="btn btn-mds btn-primary btn-block">Update</button>	
					<?php } }  else {?>
				<button type="submit" class="btn btn-mds btn-primary btn-block">Submit</button>
				<?php } ?>
				</div>
			</div>
		
		<?php echo form_close();?>

