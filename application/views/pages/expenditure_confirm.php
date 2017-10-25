		<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
  <div class = "form-group">
	  <div class = "col-sm-6 col-xs-6 col-lg-6">
		  <h5><?php echo anchor('Home/shop_expenditure', 'Add New Expenditure'); ?></h5>
		  </div>
	<div class = "col-sm-6 col-xs-6 col-lg-6">
		<h5><?php echo anchor('Home/view_exp', 'View  Expenditure'); ?></h5>
		  </div>
	  </div>
  
  <?php if(isset($expex)){?>
  <table class="table table-hover; table table-bordered">
    <thead>
      <tr>
        <th style = "background-color:#7F7F7F"><?php echo 'Expenditure Name'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Paid to'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Amount'; ?></th>
         <th style = "background-color:#7F7F7F">Change</th>
         <th style = "background-color:#7F7F7F">Confirm</th>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($expex as $result) { ?>
		<?php echo form_open('Home/shop_expenditure'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->exp_name); ?></small></td>
        <td><small><?php echo ucwords($result->payee_name); ?></small></td>
        <td><small><?php echo number_format($result->amount); ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->exp_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
        <td><?=anchor("Home/exp_confirm/".$result->exp_id,"Confirm",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
      </tr>
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no expenditure transaction conducted!!!!</div>
		<?php } ?>
  </table>
  
</div>


