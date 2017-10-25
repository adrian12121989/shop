	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
			</div>
		<?php echo ($this->session->flashdata('grant_updt')) ? '<div class = "alert alert-success">'.$this->session->flashdata('grant_updt').'</div>': '';?>
		<?php echo ($this->session->flashdata('pay_add')) ? '<div class = "alert alert-success">'.$this->session->flashdata('pay_add').'</div>': '';?>
		<?php echo ($this->session->flashdata('pay_con')) ? '<div class = "alert alert-success">'.$this->session->flashdata('pay_con').'</div>': '';?>
		<?php echo ($this->session->flashdata('borrow_con')) ? '<div class = "alert alert-success">'.$this->session->flashdata('borrow_con').'</div>': '';?>
	<?php echo ($this->session->flashdata('borrow_add')) ? '<div class = "alert alert-success">'.$this->session->flashdata('borrow_add').'</div>': '';?>
	<?php echo ($this->session->flashdata('pay_added')) ? '<div class = "alert alert-success">'.$this->session->flashdata('pay_added').'</div>': '';?>
	<h2>Here you can manage the loan information</h2>
	<br/>
	<table class = "table">
		<tr>
			<th style = "color:#FF0000"><?php echo anchor('Home/grant_loan_result', 'Grant New Loan');?></th>
			<th><?php echo anchor('Home/pay_loan_result', 'Loan Payment');?></th>
			</tr>
		</table>
