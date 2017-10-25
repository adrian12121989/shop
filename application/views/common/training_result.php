
<?php if($query->num_rows() > 0) { ?>
	<div class="alert alert-success">Congrats..! You are here now!
	</div>

  <div class="table-responsive">        
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('description'); ?></th>
        <th><?php echo $this->lang->line('training_institution'); ?></th>
        <th><?php echo $this->lang->line('supervisor'); ?></th>
        <th><?php echo $this->lang->line('start_date'); ?></th>
         <th><?php echo $this->lang->line('end_date'); ?></th>
        
        <center><th>Options</th></center>
        
      </tr>
    </thead>
   <?php } else { echo '<div class="alert alert-info">You currently have\'nt submited your training & workshop details! 
	   <br /> Click the link below to add details</div>'; } ?>
  
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/training'); ?>
      <tr class="info">
        <td><small><?php echo $result->description; ?></small></td>
        <td><small><?php echo $result->t_institution; ?></small></td>
        <td><small><?php echo $result->supervisor_address; ?></small></td>
        <td><small><?php echo $result->start_date; ?></small></td>
        <td><small><?php echo $result->end_date; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->training_id; ?>" />
			<?php echo anchor("Jobs/training/".$result->training_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Jobs/delete_training/".$result->training_id,"Delete",array('onclick' => "return confirm('Do you want delete this record?')"))?>
			
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <tr>
		  <td>
			  <a href="training" class="" >Add New</a>
			  </td>
			  </tr>

    </tbody>
  </table>
</div>
</div>
