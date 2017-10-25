
<?php
	$jobTypes = array('Contract', 'Full Time', 'Part Time', 'Research Project');
	$location = array('Morogoro', 'other');
	//$jobCategories = array('IT & Telcom', 'Engineering', 'Management', 'Bussness', 'Legal', 'Agriculture', 'Veterinary Medicine');
	?>
<?php if($this->session->flashdata('flash_message')) { ?>

<div class="alert alert-info" role="alert">
	<?php echo $this->session->flashdata('flash_message'); ?>
	<?php }; ?>
		<label>Select your Department of Interest for Job alert</label>
		<?php echo form_open('Jobs/job_alert', 'class="form-horizontal" role="form"') ; ?>
			
			<div class="form-group">
				
				<div class="col-xs-5">
			<?php echo (form_error('dep_id') != "") ? '<div class="alert alert-danger">' . form_error('dep_id') . '</div>' : ""; ?>
				<label for="dep_id"><?php echo $this->lang->line('cat'); ?></label>
				<select name="dep_id" class="form-control">
					<option value="">--select--</option>
					<?php $cat = ($this->input->post('dep_id')) ? $this->input->post('dep_id') : '';
					
					if(isset($query)) {
						foreach($query->result() as $j) {
							foreach($category->result() as $row) {
							echo ($row->dep_id == $j->dep_id) ? '<option value="'.$row->dep_id .'" selected="selected">'.$row->name .'</option>' :
							'<option value="'.$row->dep_id .'">'.$row->name .'</option>';
						}
					}
				} else {
					 ?>
					
					<?php foreach($category->result() as $row): 
						if($row->dep_id == $cat) { ?>
					<option value="<?php echo $row->dep_id; ?>" selected="selected"><?php echo $row->name; ?></option>
				<?php } else { ?>
					<option value="<?php echo $row->dep_id; ?>"><?php echo $row->name; ?></option>
					<?php } ?>
					<?php endforeach; } ?>
					</select>
				</div>
				</div>
				
				
					<div class="form-group">
						
						<div class="col-xs-5">
						<?php echo (form_error('job_email') != "") ? '<div class="alert alert-danger">' . form_error('job_email') . '</div>' : ""; ?>
						<label for="job_advertiser_email"><?php echo $this->lang->line('job_advertiser_email'); ?></label>
						<?php if(isset($query)) {
								foreach($query->result() as $j) { ?>
								<input type="text" name="job_email" value="<?php echo $j->alert_email; ?>" class="form-control" />
								<?php } } else { ?>
						<input type="text" name="job_email" value="<?php echo $this->session->userdata('user_email'); ?>" class="form-control" />
						<?php } ?>
						</div>
						</div>
						
				
		<div class="form-group">
			<div class="col-xs-5">
				<?php if(isset($update_error)) { ?>
						<input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
					<button type="submit" name="action" class="btn btn-success" value="Update" ><?php echo $this->lang->line('common_form_element_update'); ?></button>
						
				<?php } else { if(isset($query)) {
					foreach($query->result() as $j) { ?>
					<input type="hidden" name="id" value="<?php echo $j->alert_id; ?>" />
					<button type="submit" name="action" class="btn btn-success" value="Update" ><?php echo $this->lang->line('common_form_element_update'); ?></button>
					
					<?php } } else { ?>
			<button type="submit" class="btn btn-success" >Create Job Alert</button>
			<?php } } ?>
			</div>
			</div>
			<?php echo form_close(); ?>
	</div>

