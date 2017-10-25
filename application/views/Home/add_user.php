
<?php
$departments = array('Educational Technology', 'ICT Services', 'Training Department');
if(isset($access)) {
?>
<h4><label>Change user credentials</label></h4>
<?php } else { ?>
<h4><?php echo $this->lang->line('add_user_header'); } ?></h4>
<?php echo '<font color="red">' . validation_errors() . '</font>'; ?>
<?php echo form_open('Admin/add_user', 'class="form-horizontal" role="form"'); ?>

<div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo 'First name'; ?></label>
		  <?php if(isset($access)) {
			  foreach($access->result() as $acc) { ?> 
		<input type="text" name="first_name" value="<?php echo $acc->first_name; ?>" class="form-control" id="first_name" value="" placeholder="Enter first name">
           <?php } } else { ?>
        <input type="text" name="first_name" value="<?php echo $this->input->post('first_name'); ?>" class="form-control" id="first_name" value="" placeholder="Enter first name">
      <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo 'Middle Name'; ?></label> 
		  <?php if(isset($access)) {
			  foreach($access->result() as $acc) { ?>
			 <input type="text" name="middle_name" value="<?php echo $acc->middle_name; ?>" class="form-control" id="middle_name" value="" placeholder="enter middle name">
					<?php } } else { ?>
        <input type="text" name="middle_name" value="<?php echo $this->input->post('middle_name'); ?>" class="form-control" id="middle_name" value="" placeholder="enter middle name">
     <?php } ?>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo 'Last Name'; ?></label>
		  <?php if(isset($access)) {
			  foreach($access->result() as $acc) { ?> 
		<input type="text" name="last_name" value="<?php echo $acc->last_name; ?>" class="form-control" id="last_name" value="" placeholder="Enter last name">
           <?php } } else { ?>
        <input type="text" name="last_name" value="<?php echo $this->input->post('last_name'); ?>" class="form-control" id="last_name" value="" placeholder="Enter last name">
      <?php } ?>
      </div>
      
      <div class="col-xs-5 col-md-5 col-lg-5">
		  <label><?php echo 'Department'; ?></label>
		  <select name="department" id="department" class="form-control">
		  <option value="">--select department--</option>
		  <?php /*user need to add new info*/
		  
		   $reg = ($this->input->post('department')) ? $this->input->post('department') : '';
		   
		    /*..user need to edit detail..*/
				  if(isset($category)) {
					  foreach($category->result() as $c) { 
						  foreach($departments as $department) { 
							  if($c->category == $department) {
					echo '<option value="'. $department .'" selected="selected">'. $department .'</option>';
					 } else {
						 echo '<option value="'. $department .'">'. $department .'</option>';
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
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('usr_email'); ?></label>
		  <?php if(isset($access)) {
			  foreach($access->result() as $acc) { ?> 
		<input type="text" name="usr_email" value="<?php echo $acc->username; ?>" class="form-control" id="usr_email" value="" placeholder="Enter user email">
           <?php } } else { ?>
        <input type="text" name="usr_email" value="<?php echo $this->input->post('usr_email'); ?>" class="form-control" id="usr_email" value="" placeholder="Enter user email">
      <?php } ?>
      </div>
      
      <div class="col-xs-5">
		  <label><?php echo 'Confirm E-mail Address'; ?></label> 
		  <?php if(isset($access)) {
			  foreach($access->result() as $acc) { ?>
			 <input type="text" name="confirm_usr_email" value="<?php echo $acc->username; ?>" class="form-control" id="confirm_usr_email" value="" placeholder="Confirm user email">
					<?php } } else { ?>
        <input type="text" name="confirm_usr_email" value="<?php echo $this->input->post('confirm_usr_email'); ?>" class="form-control" id="confirm_usr_email" value="" placeholder="Confirm user email">
     <?php } ?>
      </div>
     </div>
	
	<div class="form-group">
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('user_permision'); ?></label>
		  <select id="permision" name="permision" class="form-control" >
			  <option value="">--select--</option>
		  <?php 
		  $permision = ($this->input->post('permision')) ? $this->input->post('permision') : '';
			foreach($permisions->result() as $permit) {
				if(isset($access)) {
					foreach($access->result() as $acc) { 
						echo ($acc->access_lvl == $permit->access_id) ? '<option value="'. $permit->access_id .'" selected="selected">'. $permit->access_name . '</option>' : 
						'<option value="'. $permit->access_id .'">'. $permit->access_name .'</option>';
					}
				}
					else
					{	
					echo ($permit->access_id == $permision) ? '<option value="'. $permit->access_id .'" selected="selected">'. $permit->access_name . '</option>' : 
						'<option value="'. $permit->access_id .'">'. $permit->access_name .'</option>';
					}
				}
		   ?>
		  </select>
		  </div>
      </div>
    
	<div class="form-group">       
      <div class="col-xs-5">
		  <?php if(isset($update_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
				   <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
		  <?php } else { if(isset($access)) {
			  foreach($access->result() as $accs) { ?>
				  <input type="hidden" name="id" value="<?php echo $accs->user_id; ?>" />
				   <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
				   <?php } } else { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Add</button>
        <?php } } ?>
      </div>
    </div>
<?php echo form_close(); ?>

</div>
