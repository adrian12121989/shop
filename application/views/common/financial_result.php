

 
	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<?php echo ($this->session->flashdata('financial_add')) ? '<div class = "alert alert-warning">'.$this->session->flashdata('financial_add').'</div>' : '';?>	
<?php echo ($this->session->flashdata('update_financial')) ? '<div class = "alert alert-success">'.$this->session->flashdata('update_financial').'</div>' : '';?>
<?php echo ($this->session->flashdata('confirm_financial')) ? '<div class = "alert alert-success">'.$this->session->flashdata('confirm_financial').'</div>' : '';?>
<div class="table-responsive"> 
	
	<?php if($this->uri->segment(2) != 'view_frecords') 
		echo anchor('Home/financial', 'Add New Record'); ?>
		<?php if(isset($query)) {?>
  <table class="table" >
    <thead>
      <tr>
        <th><?php echo 'Financial name'; ?></th>
        <?php if($this->uri->segment(2) != 'view_frecords') { ?>
        <th><?php echo 'Description'; ?></th>
        <?php } ?>
        <th><?php echo 'Amount'; ?></th>
        <th><?php echo 'Payer'; ?></th>
        <th><?php echo 'Receipt no.'; ?></th>
        <th><?php echo 'Recorded Date'; ?></th>
        <?php if($this->uri->segment(2) == 'view_frecords') { ?>
		 <th><?php echo 'Created By'; ?></th>
         <?php } if($this->uri->segment(2) != 'view_frecords' and $this->session->userdata('access_lvl') != 2) { ?>
        <th>Option</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($query as $result) { ?>
		<?php echo form_open('Home/financial'); ?>
      <tr class="info">
        <td><small><?php echo ($result->fcategory=='income category') ? (($result->income_name == 'other') ? $result->otherIncome : $result->income_name) : (($result->exp_name == 'other') ? $result->otherExp : $result->exp_name); ?></small></td>
        <?php if($this->uri->segment(2) != 'view_frecords') { ?>
        <td><small><?php echo ($result->fcategory=='income category') ? $result->idescription : $result->description; ?></small></td>
        <?php } ?>
        <td><small><?php echo ($result->fcategory=='income category') ? $result->iamount :  $result->amount; ?></small></td>
        <td><small><?php echo ($result->fcategory=='income category') ? $result->payer : $result->payee; ?></small></td>
        <td align="center"><small><?php echo ($result->fcategory=='income category') ? $result->ireceipt_no :  $result->receipt_no; ?></small></td>
        <td><small><?php echo ($result->fcategory=='income category') ? $result->irecord_date :  $result->record_date; ?></small></td>
        <?php if($this->uri->segment(2) == 'view_frecords') { ?>
			<td><small><?php echo $result->last_name; ?></small></td>
			<?php } ?>
        <td>
        <?php if($this->uri->segment(2) != 'view_frecords' or $this->session->userdata('access_lvl') == 3) { 
				if($this->uri->segment(2) != 'trush_records' and $this->session->userdata('access_lvl') != 2) { ?>
			
			<?php } } if($this->uri->segment(2) == 'view_frecords' and $this->session->userdata('access_lvl') == 3) { ?>
				<input type="hidden" name="id" value="<?php echo $result->record_id; ?>"/>
				<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
			<td><?=anchor("Home/delete_financial/".$result->record_id,"Delete",array('onclick' => "return confirm('Do you want delete this record?')"))?>
			</td>
			<?php } 
			
			if($this->uri->segment(2) == 'view_frecords' and $this->session->userdata('access_lvl') == 2) { ?>
			<td>
				<input type="hidden" name="id" value="<?php echo $result->record_id; ?>" />
				 <button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button>
			</td>
			<?php }
			
			if($this->uri->segment(2) == 'trush_records' and $this->session->userdata('access_lvl') == 2) { ?>
			<td>
				<?=anchor("Home/financial_okay/".$result->record_id,"Okay!!!",array('onclick' => "return confirm('By clicking OK it means there is no proplem with deleted financial information !!!')"))?>
			</td>
			<?php }
			
			else {
				if($this->uri->segment(2) != 'view_frecords' and $this->uri->segment(2) != 'trush_records' ) { ?>
			 <td>
				 <input type="hidden" name="id" value="<?php echo $result->record_id; ?>" />
				 <button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
				<td> <?=anchor("Home/confirm_financial/".$result->record_id,"Confirm",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
			</td>
			<?php } } ?>
        
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <?php } else {?>
		  <div class = "alert alert-success">There is no financial record registered</div>
     <?php } ?>

    </tbody>
  </table>
</div>
<?php echo $links;?>
</div>

