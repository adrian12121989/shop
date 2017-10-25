

	<?php if($query->num_rows() > 0) { ?>
	<div class="alert alert-success">Congrats..! You are here now!
	</div>

   <div class="table-responsive">     
  <table class="table">
    <thead>
      <tr>
       
        <th>Attachment for</th>
        <th>Attachment name</th>
        <th>Options</th>
        
      </tr>
    </thead>
    <?php } else { echo '<div class="alert alert-info">No any Other Attachment submited, click the link below to add other attachment</div>'; } ?>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/other_attachment'); ?>
      <tr class="info">
        <td><small><?php echo $result->attachment_for; ?></small></td>
        <td><small><a href="<?php echo base_url('index.php/Jobs/viewcertificate/'. $result->attach_dir_name . '/' . $result->attach_name); ?>"><?php echo $result->attach_name; ?></a></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->other_id; ?>" />
			<?php echo anchor("Jobs/other_attachment/".$result->other_id, 'Edit'); ?>
			</td>
        <td><?=anchor("Jobs/delete_attachment/".$result->other_id,"Delete",array('onclick' => "return confirm('Do you want delete $result->attachment_for record?')"))?>
			</td>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      <tr>
		  <td>
			  <a href="other_attachment" class="active" >Add New</a>
			  </td>
			  </tr>

    </tbody>
  </table>
</div>
</div>
