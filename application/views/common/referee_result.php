
<?php if($query->num_rows() > 0) { ?>
	<div class="alert alert-success">Congrats..! You are here now!
	</div>

  <div class="table-responsive">     
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('r_institution'); ?></th>
        <th><?php echo $this->lang->line('r_title'); ?></th>
        <th><?php echo $this->lang->line('r_address'); ?></th>
        <th><?php echo $this->lang->line('r_mobile'); ?></th>
         <th><?php echo $this->lang->line('r_email'); ?></th>
        
        <center><th>Options</th></center>
        
      </tr>
    </thead>
    <?php } else { echo '<div class="alert alert-info">You currently have\'nt submited Referees details of your choice! 
	   <br /> Click the link below to add details</div>'; } ?>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/referee'); ?>
      <tr class="info">
        <td><small><?php echo $result->r_institution; ?></small></td>
        <td><small><?php echo $result->r_title; ?></small></td>
        <td><small><?php echo $result->r_address; ?></small></td>
        <td><small><?php echo $result->r_mobile; ?></small></td>
        <td><small><?php echo $result->r_email; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->r_id; ?>" />
			<?php echo anchor("Jobs/referee/".$result->r_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Jobs/delete_referee/".$result->r_id,"Delete",array('onclick' => "return confirm('Do you want delete $result->r_name record?')"))?>
		
        
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <tr>
		  <td>
			  <a href="referee" class="" >Add New</a>
			  </td>
			  </tr>

    </tbody>
  </table>
</div>
</div>
