<div class="table-responsive">
	<?php if($application->num_rows() > 0) { ?>
	<?php echo form_open('Jobs/myApplication'); ?>
	<div class="form-group">
		<div class="col-xs-3">
			
			<select name="limit" id="limit" class="form-control">
				<?php  $limits = ($this->input->post('limit')) ? $this->input->post('limit') : '';
				$limit = array();
					for($i = 5; $i<=20; $i+=5) {
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
        <th><?php echo $this->lang->line('job_title'); ?></th>
        <th><?php echo $this->lang->line('job_name'); ?></th>
         <th><?php echo $this->lang->line('job_type'); ?></th>
         <th><?php echo $this->lang->line('location'); ?></th>
         <th><?php echo $this->lang->line('application_date'); ?></th>
         <th><?php echo $this->lang->line('application_status'); ?></th>
        
      </tr>
    </thead>
    <br />
    <?php } else { echo '<div class="alert alert-info">Currently, you don\'t have applied any job!</div>'; } ?>
    <tbody>
		
	<?php foreach($application->result() as $result) { ?>
		<?php echo form_open('Admin/create_job'); ?>
      <tr class="info">
        <td><small><?php echo $result->job_title; ?></small></td>
        <td><small><?php echo $result->job_name; ?></small></td>
        <td><small><?php echo $result->job_type; ?></small></td>
        <td><small><?php echo $result->location; ?></small></td>
        <td><small><?php echo $result->applied_date; ?></small></td>
        <?php if(isset($call_interview)) {
			 foreach($call_interview->result() as $info) {
			$available[] = $info->job_id;
			}
			if(in_array($result->job_id, $available))
			{
				foreach($call_interview->result() as $info) {
					if($info->job_id == $result->job_id) {
			 ?>
			 <td width="40%"><a href="#<?php echo $info->job_id; ?>" class="" data-toggle="collapse">Call For Interview!</a>
        <div id="<?php echo $info->job_id; ?>" class="collapse">
        <label>Interview Description</label>
        <ul style="list-style-type: none; padding-left: 0">
        <p><li>Institution:  <?php echo $info->job_name; ?></li>
				<li>Location:  <?php echo $info->location; ?></li>
				<li>E-mail:  <?php echo $info->called_by; ?></li>
				<li>Date:  <?php echo $info->interview_date; ?></li></p>
				</ul>
				<?php echo $info->description; ?>
				</div>
			<?php } } } else {  ?></td>
        <td><small>Recieved</small>
        <input type="hidden" name="id" value="<?php echo $result->job_id; ?>" /></td>
			<?php } }
				else { ?>
					<td><small>Recieved</small>
					<input type="hidden" name="id" value="<?php echo $result->job_id; ?>" /></td>
					<?php } ?>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
  
    </tbody>
  </table>
</div>
</div>
