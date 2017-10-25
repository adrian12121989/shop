<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	 
  <?php echo anchor('Home/loan_records', 'Add New  Loan Record'); ?>
  <?php if(isset($loan)){?>
  <table class="table">
    <thead>
		
      <tr>
        <th><?php echo 'Name'; ?></th>
        <th><?php echo 'Amount'; ?></th>
        <th><?php echo 'Purpose'; ?></th>
        <th>Option</th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($loan as $result) { ?>
		<?php echo form_open('Home/loan_records'); ?>
      <tr class="info">
        <td><?php echo $result->first_name.' '.$result->middle_name.' '. $result->last_name; ?></td>
        <td><?php echo $result->bamount; ?></small></td>
        <td><?php echo $result->bpurpose; ?></small></td>
        <td><input type="hidden" name="borrow_id" value="<?php echo $result->borrow_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
        <td><?=anchor("Home/confirm_borrow/".$result->borrow_id,"Confirm",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no any loan information recorded!!!</div>
		<?php } ?>
  </table>
  
</div>
