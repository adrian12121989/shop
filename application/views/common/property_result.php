<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	   <?php echo ($this->session->flashdata('property_confirm')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_confirm').'</div>' : '';?> 
     <?php echo ($this->session->flashdata('property_update')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_update').'</div>' : '';?>
      <?php echo ($this->session->flashdata('property')) ? '<div class = "alert alert-warning">'.$this->session->flashdata('property').'</div>' : '';?>   
  
  <?php echo anchor('Home/property', 'Add New  Property Record'); ?>
  <?php if(isset($invents)){?>
  <table class="table">
    <thead>
		
      <tr>
        <th><?php echo 'Property name'; ?></th>
        <th><?php echo 'Category'; ?></th>
        <th><?php echo 'Status'; ?></th>
        <th><?php echo 'Property value'; ?></th>
        <th><?php echo 'Location'; ?></th>
        <th><?php echo 'Custodian'; ?></th>
        <th>Option</th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($invents as $result) { ?>
		<?php echo form_open('Home/property'); ?>
      <tr class="info">
        <td><small><?php echo $result->item_name; ?></small></td>
        <td><small><?php echo $result->item_category; ?></small></td>
        <td><small><?php echo $result->work_status; ?></small></td>
        <td><small><?php echo $result->item_value; ?></small></td>
         <td><small><?php echo $result->location; ?></small></td>
          <td><small><?php echo $result->custodian; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->item_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
        <td><?=anchor("Home/confirm_property/".$result->item_id,"Confirm",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no property registered!!!!</div>
		<?php } ?>
  </table>
  
</div>
