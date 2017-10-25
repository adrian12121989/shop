
<div class="table-responsive">

	<?php echo form_open('Admin/job_result'); ?>
	<div class="form-group">
		<div class="col-xs-3">
			
			<select name="limit" id="limit" class="form-control">
				<?php  $limits = ($this->input->post('limit')) ? $this->input->post('limit') : '';
				$limit = array();
					for($i = 3; $i<=20; $i+=3) {
						$limit[] = $i;
						}
						foreach($limit as $l) {
						echo ($l == $limits) ? '<option value="'.$l.'" selected="selected">'.$l.'</option>' : '<option value="'.$l.'">'.$l.'</option>';
					}
						?>
					</select>
					
			</div>
			<div class="col-xs-2">
			<button type="submit" class="form-control btn btn-default">Go</button>
			</div>
		</div>
		<?php echo form_close(); ?>
      
  <table class="table">
	  
    <thead>
		<tr>
		  <td>
			  <a href="create_job" class="" >Add New</a>
			  </td>
			  </tr>
      <tr>
        <th><?php echo $this->lang->line('job_title'); ?></th>
        <th><?php echo $this->lang->line('job_desc'); ?></th>
         <th><?php echo $this->lang->line('job_sunset_date'); ?></th>
         <th><?php echo $this->lang->line('posted_date'); ?></th>
        <th>Options</th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Admin/create_job'); ?>
      <tr class="info">
        <td><small><?php echo $result->job_title; ?></small></td>
        <td><small><?php echo $result->job_desc; ?></small></td>
        <td><small><?php echo $result->sunset_date; ?></small></td>
        <td><small><?php echo $result->posted_date; ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->job_id; ?>" />
			<?php echo anchor("Admin/create_job/".$result->job_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Admin/delete_job/".$result->job_id,"Delete",array('onclick' => "return confirm('Do you want delete this record?')"))?>
		   </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      

    </tbody>
  </table>
</div>
</div>
