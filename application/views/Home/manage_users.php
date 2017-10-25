
	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<center><font color="green" size="+1">System Users</font></center>
<div class="table-responsive">
      
  <table class="table">
	  
    <thead>
	<?php echo anchor('Admin/add_user', 'Add new user'); ?>
      <tr>
		  <th><?php echo 'first name'; ?></th>
		   <th><?php echo 'last name'; ?></th>
        <th><?php echo $this->lang->line('usr_email'); ?></th>
         <th><?php echo 'department'; ?></th>
        <th><center>Options</center></th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($system_users->result() as $result) { ?>
		<?php echo form_open('Admin/create_job'); ?>
      <tr class="info">
		  <?php if($this->session->userdata('username') == $result->username) { ?>
			  
		  <?php } else { ?>
		<td><small><?php echo $result->first_name; ?></small></td>
		<td><small><?php echo $result->last_name; ?></small></td>
        <td><small><?php echo $result->username; ?></small></td>
        <td><small><?php echo $result->category; ?></small></td>
        <td align="center"><input type="hidden" name="id" value="<?php echo $result->user_id; ?>" />
			<?php echo anchor("Admin/add_user/".$result->user_id, 'Edit'); ?>
			</td>
			<td>
			<td><?=anchor("Admin/change_usr_pass/".$result->user_id,"Change password",array('onclick' => "return confirm('Do you want change password for  $result->first_name? NOTE: The updated password of this user will be sent to $result->username')"))?>
		
				</td>
        <td><?=anchor("Admin/delete_user/".$result->user_id,"Delete",array('onclick' => "return confirm('Do you want delete all records of  $result->username ?')"))?>
		   </tr>
       
            <?php } echo form_close(); ?>
      <?php } ?>
      

    </tbody>
  </table>
</div>
</div>
