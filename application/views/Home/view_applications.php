
<div class="table-responsive">
	<?php if($query->num_rows() > 0) { ?>
<label><?php echo $this->lang->line('view_application_header'); ?></label>
	<?php if($this->session->userdata('access_level') > 2) {
		echo form_open('Admin/view_applications'); ?>
	<div class="row">
		<div class="col-xs-5 col-md-5 col-lg-5">
			
			<!--<select name="limit" id="limit" class="form-control">
				<?php  /*$limits = ($this->input->post('limit')) ? $this->input->post('limit') : '';
				$limit = array();
					for($i = 3; $i<=10; $i+=3) {
						$limit[] = $i;
						}
						foreach($limit as $l) {
						echo ($l == $limits) ? '<option value="'.$l.'" selected="selected">'.$l.'</option>' : '<option value="'.$l.'">'.$l.'</option>';
					}
						*/?>
					</select>-->
				<input type="text" name="search" id="term" class="form-control" placeholder="Search department name"/>
					
			</div>
			<div class="col-xs-1 col-md-1 col-lg-1 text-right" style="padding-right: 0">
				</div>
			<div class="col-xs-4 col-md-4 col-lg-4 text-right">
				<?php $jobs = ($this->input->post('department')) ? $this->input->post('department') : ''; ?>
				<select name="department" id="dep_id" class="form-control">
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
		<?php echo form_close(); } ?>
		<?php 
		 if($this->input->post('department') != '' and $this->session->userdata('access_level') == 3)
					 {
							 foreach($job_title->result() as $result) { 
								 if($result->dep_id == $this->input->post('department'))
									{
							echo 'Head of this Department';
							 echo form_open('Admin/worker_shortlist', 'class="form-horizontal" role="form"');
							 echo '<div class="form-group">';
							 echo '<div class="col-xs-5 col-md-5 col-lg-5">';
							 echo '<label>Full name</label>';
							 echo '<input type="text" class="form-control" name="full_name" value="'. $result->head_name.'">';
							 echo '</div>';
							 echo '<div class="col-xs-5 col-md-5 col-lg-5">';
							 echo '<label>E-mail</label>';
							 echo '<input type="text" class="form-control" name="usr_email" value="'. $result->head_email.'">';
							 echo '</div>';
							 echo '</div>';
							 echo '<div class="form-group">';
							 echo '<div class="col-xs-5 col-md-5 col-lg-5">';
							 echo '<input type="hidden" name="id" value="'.$result->dep_id.'">';
							 echo '<button type="submit" class="btn btn-success">Asign to shortilist</button>';
							 echo '</div>';
							 echo '</div>';
							 echo form_close();
						 }
						 }
					 }?>
      
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
		<?php foreach($query->result() as $result) { ?>
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
			</td>
			<?php if($this->session->userdata('access_level') == 4) { ?>
				 <td align="center">
			<?=anchor("Admin/approve/".$result->user_id . '/' . $result->job_id,"Approve",
					array('onclick' => "return confirm('Are you confortable to approve this application? The application will be sent automatically to the Human Resources Office! NOTE: This action will not be reversed!')")) ?>
						</td>
			<?php } ?>
          </tr>
       
            <?php echo form_close(); ?>
      <?php } 
       ?>
      

    </tbody>
  </table>
  </div>
   <div class="row">
	   <div class="col-xs-12, col-md-12 col-lg-12 text-center">
		   <ul class="pagination pagination-md">
		   <li>
		   <?php echo $this->pagination->create_links(); ?>
		   </li>
		   </ul>
		   </div>
	   </div>
	   <?php } else { 
		   echo '<div class="alert alert-info">Currently there is no any application recieved! Thanks</div>';
	   }
		   ?>
</div>
</div>
