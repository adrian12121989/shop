
<?php if($query->num_rows() > 0) { ?>
	<div class="alert alert-success">Congrats..! You are here now!
	</div>

  <div class="table-responsive">        
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('training_institution'); ?></th>
        <th><?php echo $this->lang->line('job_title'); ?></th>
        <th><?php echo $this->lang->line('supervisor'); ?></th>
        <th><?php echo $this->lang->line('start_date'); ?></th>
         <th><?php echo $this->lang->line('end_date'); ?></th>
        
        <center><th>Options</th></center>
        
      </tr>
    </thead>
    <?php } else { echo '<div class="alert alert-info">You currently have\'nt submited your work experience! <br /> Click the link below to add experience</div>'; } ?>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/experience'); ?>
      <tr class="info">
        <td><small><?php echo $result->institution; ?></small></td>
        <td><small><?php echo $result->job_title; ?></small></td>
        <td><small><?php echo $result->sup_name; ?></small></td>
        <td><small><?php echo $result->start_date; ?></small></td>
        <td><small><?php echo $result->end_date; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->w_id; ?>" />
			<?php echo anchor("Jobs/experience/".$result->w_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Jobs/delete_experience/".$result->w_id,"Delete",array('onclick' => "return confirm('Do you want delete this record?')"))?>
		 
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <tr>
		  <td>
			  <a href="experience" class="" >Add New</a>
			  </td>
			  </tr>

    </tbody>
  </table>
</div>
</div>
