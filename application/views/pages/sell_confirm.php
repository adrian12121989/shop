	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	   <?php echo ($this->session->flashdata('property_confirm')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_confirm').'</div>' : '';?> 
     <?php echo ($this->session->flashdata('property_update')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_update').'</div>' : '';?>
      <?php echo ($this->session->flashdata('property')) ? '<div class = "alert alert-warning">'.$this->session->flashdata('property').'</div>' : '';?>   
  <div class = "form-group">
	  <div class = "col-sm-6 col-xs-6 col-lg-6">
		  <h5><?php echo anchor('Home/add_device', 'Add New Device'); ?></h5>
		  </div>
	<div class = "col-sm-6 col-xs-6 col-lg-6">
		<h5><?php echo anchor('Home/view_device', 'View Existing Devices'); ?></h5>
		  </div>
	  </div>
  
  <?php if(isset($devices)){?>
  <table class="table table-hover; table table-bordered">
    <thead>
      <tr>
        <th style = "background-color:#7F7F7F"><?php echo 'Device Name'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Device Number'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Price'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Selling Price'; ?></th>
         <th style = "background-color:#7F7F7F">Change</th>
         <th style = "background-color:#7F7F7F">Confirm</th>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($devices as $result) { ?>
		<?php echo form_open('Home/sell_device'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->dev_name); ?></small></td>
        <td><small><?php echo ucwords($result->dev_number); ?></small></td>
        <td><small><?php echo number_format($result->dev_price); ?></small></td>
        <td><small><?php echo number_format($result->sold_amount); ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->dev_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
        <td><?=anchor("Home/sell_device_confirm/".$result->dev_id,"Confirm Sell",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
      </tr>
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no property registered!!!!</div>
		<?php } ?>
  </table>
  
</div>

