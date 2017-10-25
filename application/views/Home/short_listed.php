
<div class="table-responsive">
<label>Currently, Shortlisted Candidates</label>
	<?php echo form_open('Admin/view_applications'); ?>
	<div class="row">
		<div class="col-xs-5 col-md-5 col-lg-5">
			
				<input type="text" name="search" id="term" class="form-control" placeholder="Search applicant name"/>
					
			</div>
			<div class="col-xs-1 col-md-1 col-lg-1 text-right" style="padding-right: 0">
				</div>
			<div class="col-xs-4 col-md-4 col-lg-4 text-right">
				<?php $jobs = ($this->input->post('jobtitle')) ? $this->input->post('jobtitle') : ''; ?>
				<select name="jobtitle" id="jobtitle" class="form-control">
					<option value="">Any Department</option>
					<?php
					foreach($job_title->result() as $result) { 
					echo ($result->dep_id == $jobs) ? '<option value="'.$result->name.'" selected="selected">'.$result->name.'</option>' :
					 '<option value="'.$result->dep_id. '">'.$result->name.'</option>';
					}
						?>
					</select>
				</div>
			<div class="col-xs-2 col-md-2 col-lg-2 navbar-right">
			<button type="submit" class=" btn btn-success">Search</button>
			</div>
		</div>
		<?php echo form_close(); ?>
		
		<?php if(isset($confirm_interview)) { ?>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12 alert alert-success" style="font-family: Times New Roman, Times, serif;">
					<p>Congrats!!.. Call for Interview Success!</p>
					<p>Short-Listed Candidates will adhere to your interview accordingly as shown below! Thanks!</p>
					NOTE: This information will be deleted automatically from the system immediately after the date mentioned!
					</div>
				</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12">
			<table class="table" style="font-family: Times New Roman, Times, serif;">
			<thead>
			<tr>
				<th>Date</th>
				<th>Location</th>
				 <th>Description</th>
      </tr>
    </thead>
		<tbody>
			<?php foreach($confirm_interview->result() as $info) { ?>
				<tr>
					<td><?php echo $info->interview_date; ?></td>
					<td><?php echo $info->location; ?></td>
					<td><?php echo $info->description; ?></td>
					</tr>
					<?php $info_id = $info->info_id; } ?>
			</tbody>
			</table>
					<a href="<?php echo base_url('index.php/Admin/interview_result/' . $info_id); ?>" class="btn btn-info">Change info</a> Or
						<?php echo anchor('Jobs/dashboard', 'No!, Thanks'); ?>
			</div>
			</div>
			<br />
			<?php } ?>
			
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
			<?php echo '<font color="red">'. validation_errors() . '</font>'; ?>
			</div>
			</div>
			<?php if($listed->num_rows() > 0 || isset($change_interview)) { ?>
		<div class="row">
			<?php echo form_open('Admin/interview'); ?>
			<div class="col-xs-3 col-md-3 col-lg-3">
				<label style="font-family: Times New Roman, Times, serif;">Call for Interview</label>
				<?php 
					$now = ($this->input->post('interview')) ? $this->input->post('interview') : '';  ?>
				<select name="interview" id="call" class="form-control">
					<?php 
					
					echo ($this->input->post('interview') == 'Yes' || isset($change_interview)) ? '<option value="Yes">Now</option>' : '<option value="No">Not now</option>'; 
					echo ($this->input->post('interview') == '') ? '<option value="Yes">Now</option>' : '<option value="No">Not now</option>'; 
					?>
					</select>
				</div>
				<div id="now">
				<div class="col-xs-3 col-md-3 col-lg-3">
					<label style="font-family: Times New Roman, Times, serif;">Date</label>
					<?php if(isset($change_interview)) {
						foreach($change_interview->result() as $change) { ?>
							<input type="text" name="interview_date" id="sunset" value="<?php echo $change->interview_date; ?>" class="form-control" placeholder="yy-mm-dd" />
					<?php } } else { ?>
					<input type="text" name="interview_date" id="sunset" value="<?php echo $this->input->post('interview_date'); ?>" class="form-control" placeholder="yy-mm-dd" />
					<?php } ?>
					</div>
					<div class="col-xs-3 col-md-3 col-lg-3">
						<label style="font-family: Times New Roman, Times, serif;">Location</label>
						<?php if(isset($change_interview)) {
							foreach($change_interview->result() as $change) { ?>
						<input type="text" name="location" id="location" value="<?php echo $change->location; ?>" class="form-control" placeholder="interview location" />
					<?php } } else { ?>
						<input type="text" name="location" id="location" value="<?php echo $this->input->post('location'); ?>" class="form-control" placeholder="interview location" />
						<?php } ?>
						</div>
						<div class="col-xs-3 col-md-3 col-lg-3">
							<label style="font-family: Times New Roman, Times, serif;">Description</label>
							<?php if(isset($change_interview)) {
								foreach($change_interview->result() as $change) { ?>
									<textarea name="description" class="form-control" id="textarea" placeholder="Describe requirements for Interview" >
							<?php echo $change->description; ?></textarea>
						<?php } } else { ?>
							<textarea name="description" class="form-control" id="textarea" placeholder="Describe requirements for Interview" >
							<?php echo $this->input->post('description'); ?></textarea>
							<?php } ?>
							</div>
							
							<div class="col-xs-3 col-md-3 col-lg-3">
								<?php if(isset($update_error)) { ?>
									<input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
										<button type="submit" name="action" value="Update" class="btn btn-info btn-block">Update</button>
	
								<?php } else { if(isset($change_interview)) {
									foreach($change_interview->result() as $change) { ?>
										<input type="hidden" name="id" value="<?php echo $change->info_id; ?>">
										<button type="submit" name="action" value="Update" class="btn btn-info btn-block">Update</button>
										<?php } } else { ?>
								<button type="submit" name="action" class="btn btn-info btn-block">Send</button>
								<?php } } ?>
								</div>
								
							</div>
							<?php echo form_close(); ?>
			</div>
      
  <table class="table" style="font-family: Times New Roman, Times, serif;">
	  
    <thead>

      <tr>
        <th><?php echo $this->lang->line('applicant_name'); ?></th>
        <th><?php echo $this->lang->line('application_for'); ?></th>
       
         <th><?php echo $this->lang->line('job_type'); ?></th>
         <th><?php echo $this->lang->line('app_date'); ?></th>
        
        
      </tr>
    </thead>
    <tbody>
		<?php foreach($listed->result() as $result) { ?>
		<?php echo form_open('Admin/view_applications'); ?>
      <tr class="info">
        <td><small><?php echo $result->first_name . ' ' . $result->middle_name . ' ' . $result->last_name; ?></small></td>
         <td><a href="#<?php echo $result->job_id; ?>" class="" data-toggle="collapse"><?php echo $result->job_title; ?></a>
        <div id="<?php echo $result->job_id; ?>" class="collapse">
        <label>Job Description & Qualifications</label>
        <ul style="list-style-type: none ">
        <p><li>Institution:  <?php echo $result->job_name; ?></li>
				<li>Location:  <?php echo $result->location; ?></li>
				<li>E-mail:  <?php echo $result->job_email; ?></li>
				<li>Telephone:  <?php echo $result->job_phone; ?></li></p>
				</ul>
        <small><?php echo $result->job_desc; ?></small>
        </div></div>
        <td><small><?php echo $result->job_type; ?></small></td>
        <td><small><?php echo $result->applied_date; ?></small></td>
        <td align="center"><input type="hidden" name="id" value="<?php echo $result->user_id; ?>" />
			<?php echo anchor("Admin/view_reg_cv/".$result->user_id .'/' . $result->job_id, 'applicant cv'); ?>
			</td><td>
			<?=anchor("Admin/short_listed/".$result->user_id . '/' . $result->job_id, "Un-shortlist",
				array('onclick' => "return confirm('Are you confortable to un-short list $result->first_name $result->last_name applied for $result->job_title?')")) ?>
			</td>
          </tr>
       
            <?php echo form_close(); ?>
      <?php } 
       ?>
      

    </tbody>
  </table>
  </div>
  
  <?php } else { ?>
	  <div class="alert alert-info">There is no any current short listed candidates. Thanks!</div>
	  <?php } ?>
	  
  <!-- <div class="row">
	   <div class="col-xs-12, col-md-12 col-lg-12 text-center">
		   <ul class="pagination pagination-md">
		   <li>
		   <?php// echo $this->pagination->create_links(); ?>
		   </li>
		   </ul>
		   </div>
	   </div>-->

</div>
</div>
