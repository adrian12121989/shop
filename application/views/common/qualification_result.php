

	<?php if($query->num_rows() > 0) { ?>
	<div class="alert alert-success">Congrats..! You are here now!
	</div>

 <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('level_education'); ?></th>
        <th><?php echo $this->lang->line('course_name'); ?></th>
        <th><?php echo $this->lang->line('institute_name'); ?></th>
        <th><?php echo $this->lang->line('certificate'); ?></th>
        <th>Options</th>
        
      </tr>
    </thead>
    <?php } else { echo '<div class="alert alert-info">No any Academic Qualification submited, click the link below to add your academic qualifications</div>'; } ?>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/delete_academic'); ?>
      <tr class="info">
        <td><small><?php echo $result->edu_level; ?></small></td>
        <td><small><?php echo ($result->course != 'other') ? $result->course : $result->course_mention; ?></small></td>
        <td><small><?php echo ($result->institute != 'other') ? $result->institute : $result->institute_mention; ?></small></td>
        <td><small><a href="<?php echo base_url('index.php/Jobs/viewcertificate/'. $result->cert_dir_name . '/' . $result->cert_name); ?>"><?php echo $result->cert_name; ?></a></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->academic_id; ?>" />
			<?php echo anchor("Jobs/qualification/".$result->academic_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Jobs/delete_academic/".$result->academic_id,"Delete",array('onclick' => "return confirm('Do you want delete $result->edu_level record?')"))?>
			<!--<button type="submit" onclick="goBack()" name="action" value="Delete" class="btn btn-danger">Delete</button>
			
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button>--></td>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <tr>
		  <td>
			  <a href="qualification" class="active" >Add New</a>
			  </td>
			  </tr>

    </tbody>
  </table>
</div>
</div>
