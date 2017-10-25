
<div class="table-responsive">
<label><?php echo $this->lang->line('view_app_header'); ?></label>
	<?php echo form_open('Admin/view_reg_users'); ?>
	<div class="form-group">
		<div class="col-xs-3">
			
			<select name="limit" id="limit" class="form-control">
				<?php  $limits = ($this->input->post('limit')) ? $this->input->post('limit') : '';
				$limit = array();
					for($i = 10; $i<=50; $i+=5) {
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
        <th><?php echo $this->lang->line('applicant_full_name'); ?></th>
        <th><?php echo $this->lang->line('applicant_email'); ?></th>
         <th><?php echo $this->lang->line('applicant_address'); ?></th>
         <th><?php echo $this->lang->line('applicant_mobile'); ?></th>
        <th>Options</th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Admin/create_job'); ?>
      <tr class="info">
        <td><small><?php echo $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name; ?></small></td>
        <td><small><?php echo $result->user_email; ?></small></td>
        <td><small><?php echo $result->current_address; ?></small></td>
        <td><small><?php echo $result->mobile; ?></small></td>
        <td align="center"><input type="hidden" name="id" value="<?php echo $result->user_id; ?>" />
			<?php echo anchor("Admin/view_reg_cv/".$result->user_id, 'CV'); ?>
			</td>
        <td><?=anchor("Admin/delete_applicant/".$result->user_id,"Delete",array('onclick' => "return confirm('Do you want delete all records of  $result->first_name  $result->last_name ?')"))?>
		   </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
      

    </tbody>
  </table>
</div>
</div>
