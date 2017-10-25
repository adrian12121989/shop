
<?php
	$jobTypes = array('Contract', 'Full Time', 'Part Time', 'Research Project');
	$location = array('Morogoro', 'other');
	//$jobCategories = array('IT & Telcom', 'Engineering', 'Management', 'Bussness', 'Legal', 'Agriculture', 'Veterinary Medicine');
	?>
<?php if($this->session->flashdata('flash_message')) { ?>

<div class="alert alert-info" role="alert">
	<?php echo $this->session->flashdata('flash_message'); ?>
	<?php }; ?>
	
	<?php if(isset($query) || isset($update_error)) { ?>
		<div class="alert alert-success" ><?php echo $this->lang->line('job_create_form_instruction_2'); ?></div>
		<?php } else { ?>
	<p class="lead" ><?php echo $this->lang->line('job_create_form_instruction_1'); ?></p>
	<?php } ?>

		<?php echo form_open('Admin/create_job', 'class="form-horizontal" role="form"') ; ?>
		<div class="form-group">
			<div class="col-xs-5">
			<?php echo (form_error('title') != "") ? '<div class="alert alert-danger">' . form_error('title') . '</div>' : ""; ?>
			<label for=""><?php echo $this->lang->line('job_title'); ?></label>
			<?php if(isset($query)) {
				foreach($query->result() as $j) { ?>
					<input type="text" name="title" value="<?php echo $j->job_title; ?>" class="form-control" placeholder="Enter title" />
					<?php } } else { ?>
			<input type="text" name="title" value="<?php echo $this->input->post('title'); ?>" class="form-control" placeholder="Enter title" />
			<?php } ?>
			</div>
			<div class="col-xs-5">
			<?php echo (form_error('job_desc') != "") ? '<div class="alert alert-danger">' . form_error('job_desc') . '</div>' : ""; ?>
			<label for="job_desc"><?php echo $this->lang->line('job_desc'); ?></label>
			<?php if(isset($query)) {
				foreach($query->result() as $j) { ?>
					<textarea name="job_desc" id="job_desc" class="form-control"><?php echo $j->job_desc; ?></textarea>
					<?php } } else { ?>
			<textarea name="job_desc" id="job_desc" class="form-control"><?php echo $this->input->post('job_desc'); ?></textarea>
			<?php } ?>
			</div>
			</div>
			
			<div class="form-group">
				<div class="col-xs-5">
			<?php echo (form_error('type_id') != "") ? '<div class="alert alert-danger">' . form_error('type_id') . '</div>' : ""; ?>
				<label for="type_id"><?php echo $this->lang->line('type'); ?></label>
				<select name="type_id" class="form-control">
					<?php //foreach($types->result() as $row): ?>
					<option value="">--Select--</option>
					<?php $type = ($this->input->post('type_id')) ? $this->input->post('type_id') : '';
					if(isset($query)) {
						foreach($query->result() as $j) {
							foreach($jobTypes as $t) {
						echo ($t == $j->job_type) ? '<option value="'.$t.'" selected="selected">' . $t .'</option>' : '<option value="'.$t.'">'. $t .'</option>';
					}
				}
			}
				else {
					foreach($jobTypes as $t)
					{ 
						echo ($t == $type) ? '<option value="'.$t.'" selected="selected">' . $t .'</option>' : '<option value="'.$t.'">'. $t .'</option>';
					}
				}
					?>
					</select>
				</div>
				
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
			<?php echo (form_error('loc_id') != "") ? '<div class="alert alert-danger">' . form_error('loc_id') . '</div>' : ""; ?>
				<label for="loc_id"><?php echo $this->lang->line('loc'); ?></label>
				<select name="loc_id" class="form-control">
					<option value="">select location</option>
					<?php $locations = ($this->input->post('loc_id')) ? $this->input->post('loc_id') : '';
					if(isset($query)) {
						foreach($query->result() as $j) {
							foreach($location as $l) {
						echo ($l == $j->location) ? '<option value="'.$l.'" selected="selected">' . $l .'</option>' : '<option value="'.$l.'">'. $l .'</option>';
					}
				}
			}
			else {
					foreach($location as $l)
					{ 
						echo ($l == $locations) ? '<option value="'.$l.'" selected="selected">' . $l .'</option>' : '<option value="'.$l.'">'. $l .'</option>';
					}
				}
					?>
					</select>
				</div>
				
						<div class="col-xs-5">
							<label for="sunset_d"><?php echo $this->lang->line('job_sunset_date'); ?></label>
							<?php if(isset($query)) {
								foreach($query->result() as $j) { ?>
							<input type="text" name="sunset_date" id="sunset" value="<?php echo $j->sunset_date; ?>" class="form-control" />
							<?php } } else { ?>	
							<input type="text" name="sunset_date" id="sunset" value="<?php echo $this->input->post('sunset_date'); ?>" class="form-control" />
							<?php } ?>
							
					</div>	
					</div>
					
					<div class="form-group">
						<div class="col-xs-5">
						<?php echo (form_error('job_name') != "") ? '<div class="alert alert-danger">' . form_error('job_name') . '</div>' : ""; ?>
						<label for="job_advertiser_name"><?php echo $this->lang->line('job_advertiser_name'); ?></label>
						<?php if(isset($query)) {
								foreach($query->result() as $j) {?>
								<input type="text" name="job_name" value="<?php echo $j->job_name; ?>" class="form-control" />
								<?php } } else { ?>
						<input type="text" name="job_name" value="<?php echo $this->input->post('job_name'); ?>" class="form-control" />
						<?php } ?>
						</div>
						
						<div class="col-xs-5">
						<?php echo (form_error('job_email') != "") ? '<div class="alert alert-danger">' . form_error('job_email') . '</div>' : ""; ?>
						<label for="job_advertiser_email"><?php echo $this->lang->line('job_advertiser_email'); ?></label>
						<?php if(isset($query)) {
								foreach($query->result() as $j) { ?>
								<input type="text" name="job_email" value="<?php echo $j->job_email; ?>" class="form-control" />
								<?php } } else { ?>
						<input type="text" name="job_email" value="<?php echo $this->input->post('job_email'); ?>" class="form-control" />
						<?php } ?>
						</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-5">
						<?php echo (form_error('job_phone') != "") ? '<div class="alert alert-danger">' . form_error('job_phone') . '</div>' : ""; ?>
						<label for="job_advertiser_phone"><?php echo $this->lang->line('job_advertiser_phone'); ?></label>
						<?php if(isset($query)) {
								foreach($query->result() as $j) { ?>
						<input type="text" name="job_phone" value="<?php echo $j->job_phone; ?>" class="form-control" />
						<?php } } else { ?>
							<input type="text" name="job_phone" value="<?php echo $this->input->post('job_phone'); ?>" class="form-control" />
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
					<input type="hidden" name="id" value="<?php echo $j->job_id; ?>" />
					<button type="submit" name="action" class="btn btn-success" value="Update" ><?php echo $this->lang->line('common_form_element_update'); ?></button>
					or <a href="create_job">Add New Job</a>
					<?php } } else { ?>
			<button type="submit" class="btn btn-success" ><?php echo $this->lang->line('common_form_element_go'); ?></button>
			<?php } } ?>
			</div>
			</div>
			<?php echo form_close(); ?>
	</div>

