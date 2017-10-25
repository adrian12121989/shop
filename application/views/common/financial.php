<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<?php
	$Income = array('Short Course', 'Hiring of Facilities', 'Training', 'Payment of Debts', 'Payment of Milage');
	$Exp = array('Purchase of Equipments', 'Payment of wages/salary', 'Purchase of clean items', 'Payment to university\'s consultus fee',
			'Loan grating');
			
  if(isset($query)) { 
	  echo "<h4>".  "Update Financial Information"  . "</h4>"; 
	  } 
	  else { 
  echo "<h4>Fiancial Information</h4>"; 
  }
   echo '<font color="red">' . validation_errors() . '</font>';
   
   echo form_open('Home/financial', 'class="form-horizontal role="form""'); ?>
  <!--<form class="form-horizontal" role="form">-->
  <div class="form-group">
	  <div class="col-xs-5 col-md-5 col-lg-5">
		  <label>Financial Category</label>
		 <?php $incomes = ($this->input->post('fcategory')) ? $this->input->post('fcategory') : ''; ?>
		  <select name="fcategory" id="fcategory" class="form-control">
			 <?php if(isset($query)) {
					  foreach($query->result() as $q) { 
						if($q->fcategory == 'income category') { ?>
						 <option value="income category" selected="selected">Income Category</option>
						 <option value="exp category" >Expenditure Category</option>
						 <?php } else { ?>
							 <option value="exp category" selected="selected">Expenditure Category</option>
							 <option value="income category" >Income Category</option>
							 <?php } 
							 }
							} else { ?>
						  
			  <option value="">--Select category--</option>
			  <?php if($incomes == 'income category') {  ?>
			  <option value="income category" selected="selected">Income Category</option>
			  <option value="exp category" >Expenditure Category</option>
			  <?php } else if($incomes == 'exp category') { ?>
			  <option value="exp category" selected="selected">Expenditure Category</option>
			  <option value="income category" >Income Category</option>
			  <?php } else  { ?>
			   <option value="income category" >Income Category</option>
			   <option value="exp category" >Expenditure Category</option>
			   <?php } } ?>
			  </select>
		  </div>
		  
		  <div class="col-xs-5 col-md-5 col-lg-5" id="exp"> 
		  <label><?php echo 'Expenditure_name'; ?></label> 
		  <select name="exp" class="form-control" id="Exp">
			  <option value="">--select exp name--</option>
			 <?php 
				$exps = ($this->input->post('exp')) ? $this->input->post('exp') : '';
				
				/*..user need to edit details..*/
				  if(isset($query)) {
					  foreach($query->result() as $q) {
						  //$exp[] = ''; 
						  foreach($Exp as $name) {
					if($q->exp_name == $name) {
				echo '<option value="'. $name .'" selected="selected">'. $name . '</option>'; 
				}else
				{
					echo ($name == $exps) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
				}
			}
			if($q->exp_name == "other") {
			  echo '<option value="other" selected="selected">Other</option>';
			   } else { if($q->exp_name == '' || $q->exp_name != 'other') { echo '<option value="other">Other</option>'; }} 
		}
	}/*end of editing details*/
	
	else {
				
				/*user need to add new info*/
				  $exp[] = ''; foreach($Exp as $name) {
					echo ($name == $exps) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
			}
		
			  ?>
			  <?php if($exps == "other") { ?>
			  <option value="other" selected="selected">Other</option>
			  <?php } else { if($exps == '' || $exps != 'other') { echo '<option value="other">Other</option>'; }} 
			  
			  /* end of adding new info */ } ?>
			  
			   </select>
      </div>
      
	  </div>
    <div class="form-group">
		<div class="col-xs-5 col-md-5 col-lg-5" id="income"> 
		  <label><?php echo 'Income_name'; ?></label> 
		  <select name="income" class="form-control" id="Income">
			  <option value="">--select income name--</option>
			 <?php 
				$incomes = ($this->input->post('income')) ? $this->input->post('income') : '';
				
				/*..user need to edit details..*/
				  if(isset($query)) {
					  foreach($query->result() as $q) {
						  //$income[] = ''; 
						  foreach($Income as $name) {
					if($q->income_name == $name) {
				echo '<option value="'. $q->income_name .'" selected="selected">'. $q->income_name . '</option>'; 
				}else
				{
					echo ($name == $incomes) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
				}
			}
			if($q->income_name == "other") {
			  echo '<option value="other" selected="selected">Other</option>';
			   } else { if($q->income_name == '' || $q->income_name != 'other') { echo '<option value="other">Other</option>'; }} 
		}
	}/*end of editing details*/
	
	else {
				
				/*user need to add new info*/
				  $income[] = ''; foreach($Income as $name) {
					echo ($name == $incomes) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
			}
		
			  ?>
			  <?php if($incomes == "other") { ?>
			  <option value="other" selected="selected">Other</option>
			  <?php } else { if($incomes == '' || $incomes != 'other') { echo '<option value="other">Other</option>'; }} 
			  
			  /* end of adding new info */ } ?>
			  
			   </select>
      </div>
      
      <div class="col-xs-5 col-md-5 col-lg-5" id="otherExp">
			<label>Specify other Expnditure</label>
			<?php if(isset($query)) {
				foreach($query->result() as $i) { ?>
				<input type="text" name="otherExp" value="<?php echo $i->otherExp; ?>" class="form-control" placeholder="Please specify">
		<?php } } else { ?>
			<input type="text" name="otherExp" value="<?php echo $this->input->post('otherExp'); ?>" class="form-control" placeholder="Please specify">
			<?php } ?>
			</div>
      
    <div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Description'; ?></label>
		  <?php if(isset($query)) {
				foreach($query->result() as $i) { ?>
			 <textarea type="text" name="description" class="form-control" placeholder="Enter financial description">
		  <?php echo ($i->fcategory=='income category') ? $i->idescription : $i->description; ?></textarea>
					<?php } } else { ?>
		  <textarea type="text" name="description" class="form-control" placeholder="Enter financial description">
		  <?php echo $this->input->post('description'); ?></textarea>
		  <?php } ?>
      </div>
    </div>
    <div class="form-group">
		<div class="col-xs-5 col-md-5 col-lg-5" id="otherIncome">
			<label>Specify other income</label>
			 <?php if(isset($query)) {
				foreach($query->result() as $i) { ?>
				<input type="text" name="otherIncome" value="<?php echo $i->otherIncome; ?>" class="form-control" placeholder="Please specify">
		<?php } } else { ?>
			<input type="text" name="otherIncome" value="<?php echo $this->input->post('otherIncome'); ?>" class="form-control" placeholder="Please specify">
			<?php } ?>
			</div>
		<div class="col-xs-5 col-md-5 col-lg-5" id="staff">
			<label>Name of Employee</label>
			<select name="staff" class="form-control" id = "staff">
				<option value="">--Select name--</option>
				<?php 
					
					$emp = ($this->input->post('staff')) ? $this->input->post('staff'): '';
					
					foreach($emp_data as $employee){
						if(isset($query)){
							foreach($query as $detail){
								echo ($detail->iemployee_id == $employee->emp_id) ? '<option value = "'.$employee->emp_id.'" selected = "selected">'.$employee->first_name.' '.$employee->last_name.'</option>':
								'<option value = "'.$employee->emp_id.'">'.$employee->first_name.' '.$employee->last_name.'</option>';
							}
						}else{
						echo ($employee->emp_id == $emp) ? '<option value = "'.$employee->emp_id.'" selected = "selected">'.$employee->first_name.' '.$employee->last_name.'</option>': 
						'<option value = "'.$employee->emp_id.'">'.$employee->first_name.' '. $employee->last_name.'</option>';
					}
				}
					
				?>
				</select>
			</div>
		</div>
    <div class="form-group">
      <div class="col-xs-5 col-md-5 col-lg-5"> 
		  <label><?php echo 'Amount'; ?></label>
		   <?php if(isset($query)) {
					  foreach($query->result() as $p) { ?> 
				<input type="text" name="amount" value="<?php echo ($p->fcategory=='income category') ? $p->iamount : $p->amount; ?>" class="form-control" id="amount" placeholder="eg. 45,000">
         <?php }
         } else { ?>
        <input type="text" name="amount" value="<?php echo $this->input->post('amount'); ?>" class="form-control" id="amount" placeholder="eg. 45,000">
      <?php } ?>
      </div>
      <div class="col-xs-5 col-md-5 col-lg-5" id="payer"> 
		  <label><?php echo 'Payer'; ?></label> 
		  <?php if(isset($query)) {
					  foreach($query->result() as $p) { ?> 
			<input type="text" name="payer" value="<?php echo $p->payer; ?>" class="form-control" placeholder="Received from">
    <?php } } else { ?>	        
        <input type="text" name="payer" value="<?php echo $this->input->post('payer'); ?>" class="form-control" id="payer" placeholder="Received from">
      <?php }  ?>
      </div>
    </div>
    
     <div class="form-group">
       <div class="col-xs-5 col-md-5 col-lg-5" id="payee"> 
		  <label><?php echo 'Payee'; ?></label> 
		  <?php if(isset($query)) {
					  foreach($query->result() as $p) { ?> 
			<input type="text" name="payee" value="<?php echo $p->payee; ?>" class="form-control">
    <?php } } else { ?>	        
        <input type="text" name="payee" value="<?php echo $this->input->post('payee'); ?>" class="form-control" id="payee" placeholder="Received from">
      <?php } ?>
      </div>
		<div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Receipt Number.'; ?></label>
		   <?php if(isset($query)) {
					  foreach($query->result() as $p) { ?>
		<input type="text" name="receipt" value="<?php echo ($p->fcategory=='income category') ? $p->ireceipt_no : $p->receipt_no; ?>" class="form-control" id="receipt" placeholder="Enter receipt invoice number">
      <?php } 
      } else { ?>
        <input type="text" name="receipt" value="<?php echo $this->input->post('receipt'); ?>" class="form-control" id="receipt" placeholder="Enter receipt invoice number">
      <?php } ?>
      </div>
    </div>
    
     
    <div class="form-group">       
      <div class="col-xs-5 col-md-5 col-lg-5">
		  <?php if(isset($update_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
			<button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
			
		  <?php } else { if(isset($query)) { 
			  foreach($query->result() as $p) { ?>
				<input type="hidden" name="id" value="<?php echo ($p->fcategory == 'income category') ? $p->income_id : $p->exp_id; ?>" />
			<button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
			<?php }
			} else { ?>
        <button type="submit" class="btn btn-mds btn-success btn-block">Submit</button>
				
			<?php }
			} ?>
      </div>
    
  <?php echo form_close(); ?>
  </div>
  </div>
  </div>

