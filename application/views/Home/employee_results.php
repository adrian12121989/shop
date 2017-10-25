
<div class="table-responsive">
<label><?php echo $this->lang->line('manage_users_header'); ?></label>
	
      
  <table class="table">
	  
    <thead>

      <tr>
        <th><?php echo 'First Name'; ?></th>
         <th><?php echo 'Middle Name'; ?></th>
          <th><?php echo 'Last Name'; ?></th>
           <th><?php echo 'Department Name'; ?></th>
        <th><center>Options</center></th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($result->result() as $result) { ?>
		<?php echo form_open('Admin/create_job'); ?>
      <tr class="info">
		  
        <td><small><?php echo $result->first_name; ?></small></td>
          
        <td><small><?php echo $result->middle_name; ?></small></td>
          
        <td><small><?php echo $result->last_name; ?></small></td>
          
        <td><small><?php echo $result->department; ?></small></td>
        <td align="center"><input type="hidden" name="id" value="<?php echo $result->emp_id; ?>" />
			<?php echo anchor("Admin/add_employees/".$result->emp_id, 'Edit'); ?>
			</td>
			<td>
			
         
		   </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      

    </tbody>
  </table>
</div>
</div>
