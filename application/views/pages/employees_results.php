	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	
  <?php echo anchor('Home/add_employees', 'Add New Employee Information'); ?>
  <h3 style = "color:#008000">Manage Employees Information</h3>
  <?php if(isset($yes_employees)){?>
  <table class="table">
    <thead>
		
      <tr>
        <th><?php echo 'First Name'; ?></th>
        <th><?php echo 'Middle Name'; ?></th>
        <th><?php echo 'Last Name'; ?></th>
        <th><?php echo 'Phone Number'; ?></th>
        <th><?php echo 'Position'; ?></th>
        <th>Option</th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($yes_employees as $result) { ?>
		<?php echo form_open('Home/add_employees'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->first_name); ?></small></td>
        <td><small><?php echo ucwords($result->middle_name); ?></small></td>
        <td><small><?php echo ucwords($result->last_name); ?></small></td>
        <td><small><?php echo '(0)'.$result->phone_number; ?></small></td>
        <td><small><?php echo ucwords($result->position); ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->emp_id; ?>" />
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button></td>
        <td><?=anchor("Home/remove_employee/".$result->emp_id,"Delete",array('onclick' => "return confirm('Are you sure you want to remove this employee?')"))?>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no any employee registered!!!!</div>
		<?php } ?>
  </table>
  
</div>
