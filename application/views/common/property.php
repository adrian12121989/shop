<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<?php
	$invetories = array('Furniture', 'Electrical Device', 'Electronic Equipment');
	$locations = array('Main Campus', 'Solomon Malangu Campus(SMC)', 'Computer Center(Town)');
	$departments = array('Educational Technology', 'ICT Services', 'Training Department');
?>
<?php if(isset($query)) { ?>
	<h3>Update Property Information</h3>
	<?php } else {  ?>
<h4>Create New Property Record</h4>
<?php } ?>
<?php echo '<font color="red">' . validation_errors() . '</font>'; ?>
<?php echo form_open('Home/property', 'class="form-horizontal" role="form"'); ?>

<div class="form-group">
      <div class="col-xs-5 col-md-5 col-lg-5"> 
		  <label><?php echo 'Item Name'; ?></label> 
		   <?php if(isset($query)) {
				foreach($query->result() as $c) { ?> 
				<input type="text" name="itemName" value="<?php echo $c->item_name; ?>" class="form-control" id="p_email" value="<?php //echo $this->session->userdata('user_email'); ?>"
        > <?php }} else { ?>       
        <input type="text" name="itemName" value="<?php echo $this->input->post('itemName'); ?>" class="form-control" id="p_email" value="<?php //echo $this->session->userdata('user_email'); ?>"
        >
        <?php } ?>
      </div>
      <div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Item Category'; ?></label>
		  <select name="p_invetory" id="p_invetory" class="form-control">
		  <option value="">--select invetory--</option>
		  <?php /*user need to add new info*/
		  
		   $reg = ($this->input->post('p_invetory')) ? $this->input->post('p_invetory') : '';
		   
		    /*..user need to edit detail..*/
				  if(isset($query)) {
					  foreach($query->result() as $c) { 
						  foreach($invetories as $invetory) { 
							  if($c->item_category == $invetory) {
					echo '<option value="'. $invetory .'" selected="selected">'. $invetory .'</option>';
					 } else {
						 echo ($invetory == $reg) ? '<option value="'. $invetory .'" selected="selected">'. $invetory .'</option>' :
					'<option value="'. $invetory .'">'. $invetory .'</option>';
						}
					}
			}
		}  /*..end of editing..*/
		else {
		   
			  foreach($invetories as $invetory) { 
				echo ($invetory == $reg) ? '<option value="'. $invetory .'" selected="selected">'. $invetory .'</option>' :
					'<option value="'. $invetory .'">'. $invetory .'</option>';
					}
				}
			 
			  /*..end of new info..*/
			  ?>
		  </select>
		  </div>

    </div>
    
	<div class="form-group">
      <div class="col-xs-5 col-md-5 col-lg-5"> 
		  <label><?php echo 'Item Value'; ?></label> 
		  <?php if(isset($query)) {
				foreach($query->result() as $c) { ?>
			<input type="text" name="itemValue" value="<?php echo $c->item_value; ?>"  class="form-control" id="itemValue" placeholder="Enter item value">
         <?php } } else { ?>
                <input type="text" name="itemValue" value="<?php echo $this->input->post('itemValue'); ?>"  class="form-control" id="itemValue" placeholder="Enter item value">
		<?php } ?>
      </div>
      <div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Working Status'; ?></label>
		  <select id="wstatus" name="wstatus" class="form-control">
			  <?php if(isset($query)) {
					  foreach($query->result() as $c) {  
						  echo '<option value="' .$c->work_status .'" selected="selected">' . $c->work_status .'</option>';
				echo ($c->work_status == "Good") ? '<option value="Not Working">Not Working</option>' : '<option value="Good">Good</option>';
					} 
				}else { ?>
		  <?php if($this->input->post('wstatus') != '') { ?>
		 <option value="<?php echo $this->input->post('wstatus'); ?>" selected="selected"><?php echo $this->input->post('wstatus'); ?></option>
				<?php  }
		 echo ($this->input->post('wstatus') == 'Good') ? ' <option value="Not Working">Not Working</option>' : ' <option value="Good">Good</option>'; 
			echo ($this->input->post('wstatus') == '') ? '<option value="Not Working">Not Working</option>' : '';
		}
			 ?> 
		  </select>
		  </div>
      </div>
      <div class="form-group">
		 <div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Location'; ?></label>
		  <select name="location" id="location" class="form-control">
		  <option value="">--select location--</option>
		  <?php /*user need to add new info*/
		  
		   $reg = ($this->input->post('location')) ? $this->input->post('location') : '';
		   
		    /*..user need to edit detail..*/
				  if(isset($query)) {
					  foreach($query->result() as $c) { 
						  foreach($locations as $location) { 
							  if($c->location == $location) {
					echo '<option value="'. $c->location .'" selected="selected">'. $c->location .'</option>';
					 } else {
						 echo ($location == $reg) ? '<option value="'. $location .'" selected="selected">'. $location .'</option>' :
					'<option value="'. $location .'">'. $location .'</option>';
						}
					}
			}
		}  /*..end of editing..*/
		else {
		   
			  foreach($locations as $location) { 
				echo ($location == $reg) ? '<option value="'. $location .'" selected="selected">'. $location .'</option>' :
					'<option value="'. $location .'">'. $location .'</option>';
					}
				}
			 
			  /*..end of new info..*/
			  ?>
		  </select>
		  </div>

      	<div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Department'; ?></label>
		  <select name="department" id="department" class="form-control">
		  <option value="">--select department--</option>
		  <?php /*user need to add new info*/
		  
		   $reg = ($this->input->post('department')) ? $this->input->post('department') : '';
		   
		    /*..user need to edit detail..*/
				  if(isset($query)) {
					  foreach($query->result() as $c) { 
						  foreach($departments as $department) { 
							  if($c->department == $department) {
					echo '<option value="'. $c->department .'" selected="selected">'. $c->department .'</option>';
					 } else {
						 echo ($department == $reg) ? '<option value="'. $department .'" selected="selected">'. $department .'</option>' :
					'<option value="'. $department .'">'. $department .'</option>';
						}
					}
			}
		}  /*..end of editing..*/
		else {
		   
			  foreach($departments as $department) { 
				echo ($department == $reg) ? '<option value="'. $department .'" selected="selected">'. $department .'</option>' :
					'<option value="'. $department .'">'. $department .'</option>';
					}
				}
			 
			  /*..end of new info..*/
			  ?>
		  </select>
		  </div>

      </div>
      
      <div class="form-group">
      <div class="col-xs-5 col-md-5 col-lg-5"> 
		  <label><?php echo 'Custodian Name'; ?></label> 
		  <?php if(isset($query)) {
				foreach($query->result() as $c) { ?>
			<input type="text" name="custodian" value="<?php echo $c->custodian; ?>"  class="form-control" id="custodian" placeholder="Name of whom own item">
         <?php } } else { ?>
                <input type="text" name="custodian" value="<?php echo $this->input->post('custodian'); ?>"  class="form-control" id="custodian" placeholder="Name of whom own item">
		<?php } ?>
      </div>
      </div>
      
	<div class="form-group">       
      <div class="col-xs-5 col-md-5 col-lg-5">
		  <?php if(isset($update_error)) { ?>
			   <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
				  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
		  <?php } else { if(isset($query)) {
			  foreach($query->result() as $c) { ?>
				  <input type="hidden" name="id" value="<?php echo $c->item_id; ?>" />
				  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
				  <?php } } else { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Submit</button>
        <?php } } ?>
      </div>
    </div>
<?php echo form_close(); ?>
</div>
