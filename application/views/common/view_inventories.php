<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	   <?php echo ($this->session->flashdata('property_confirm')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_confirm').'</div>' : '';?> 
	    <?php echo ($this->session->flashdata('trushed')) ? '<div class = "alert alert-success">'.$this->session->flashdata('trushed').'</div>' : '';?> 
     <?php echo ($this->session->flashdata('property_update')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_update').'</div>' : '';?>
      <?php echo ($this->session->flashdata('property')) ? '<div class = "alert alert-danger">'.$this->session->flashdata('property').'</div>' : '';?>   
  
  <?php echo anchor('Home/property', 'Add New  Property Record'); ?>
  <?php if(isset($inventories)){?>
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
		
	<?php foreach($inventories as $result) { ?>
		<?php echo form_open('Home/property'); ?>
      <tr class="info">
        <td><small><?php echo $result->item_name; ?></small></td>
        <td><small><?php echo $result->item_category; ?></small></td>
        <td><small><?php echo $result->work_status; ?></small></td>
        <td><small><?php echo $result->item_value; ?></small></td>
         <td><small><?php echo $result->location; ?></small></td>
          <td><small><?php echo $result->custodian; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->item_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button>
			</td>
			<?php if($this->session->userdata('access_lvl') == 3){?>
       <td><?php echo anchor('Home/trush_inventory/'.$result->item_id, 'Delete', array('onclick' => "return confirm('Are you sure yuou want to remove $result->item_name ?') ;" ));?></td>
      <?php } ?>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no property registered!!!!</div>
		<?php } ?>
  </table>
</div>
