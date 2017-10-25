
<?php
	$regions = array('Mara', 'Iringa', 'Njombe', 'Dar-Es-Salaam', 'Arusha', 'Dodoma', 'Mwanza', 'Tanga', 'Mbeya', 'Morogoro', 'Pwani');
?>
<?php if(isset($query)) { ?>
	<h4><?php echo $this->lang->line('work_header_edit'); ?></h4>
	<?php } else { ?>
<h4><?php echo $this->lang->line('work_header'); ?></h4>
<?php } ?>
<?php echo '<font color="red">' . validation_errors() . '</fobt>'; ?>
<?php echo form_open('Jobs/experience', 'class="form-horizontal" role="form"'); ?>
	
	<div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('job_title'); ?></label>
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
			<input type="text" name="job_title" value="<?php echo $w->job_title; ?>" class="form-control" id="job_title" placeholder="Enter job tile">
				<?php } } else { ?>
        <input type="text" name="job_title" value="<?php echo $this->input->post('job_title'); ?>" class="form-control" id="job_title" placeholder="Enter job tile">
      <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('supervisor_name'); ?></label>
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
			<input type="text" name="supervisor_name" value="<?php echo $w->sup_name; ?>" class="form-control" id="supervisor_name" placeholder="Your Supervisor's name">
			<?php } } else { ?>
        <input type="text" name="supervisor_name" value="<?php echo $this->input->post('supervisor_name'); ?>" class="form-control" id="supervisor_name" placeholder="Your Supervisor's name">
     <?php } ?>
      </div>
      </div>
      
      <div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('supervisor_mobile'); ?></label> 
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
				<input type="text" name="supervisor_mobile" value="<?php echo $w->sup_mobile; ?>" class="form-control" id="supervisor_mobile" placeholder="Enter mobile phone">
				<?php } } else { ?>
        <input type="text" name="supervisor_mobile" value="<?php echo $this->input->post('supervisor_mobile'); ?>" class="form-control" id="supervisor_mobile" placeholder="Enter mobile phone">
     <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('work_supervisor_address'); ?></label>  
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
				 <input type="text" name="supervisor_address" value="<?php echo $w->sup_address; ?>" class="form-control" id="supervisor_address" placeholder="Enter address">
			<?php } } else { ?>
        <input type="text" name="supervisor_address" value="<?php echo $this->input->post('supervisor_address'); ?>" class="form-control" id="supervisor_address" placeholder="Enter address">
      <?php } ?>
      </div>
      </div>
      
    <div class="form-group">
		<div class="col-xs-5">
		  <label><?php echo $this->lang->line('duties'); ?></label>
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?>  
				  <textarea type="text" name="duties" class="form-control" id="duties" placeholder="Duties & Experience">
        <?php echo $w->duties; ?></textarea>
        <?php } } else { ?>         
        <textarea type="text" name="duties" class="form-control" id="duties" placeholder="Duties & Experience">
        <?php echo $this->input->post('duties'); ?></textarea>
        <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('t_institution'); ?></label> 
		 <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?>  
				 <textarea type="text" name="institution" class="form-control" id="institution" placeholder="Enter institution address address">
        <?php echo $w->institution; ?></textarea>
        <?php } } else { ?>         
        <textarea type="text" name="institution" class="form-control" id="institution" placeholder="Enter institution address address">
        <?php echo $this->input->post('institution'); ?></textarea>
        <?php } ?>
      </div>
	</div>
	
	<div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('start_date'); ?></label> 
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
				<input type="text" name="start_date" value="<?php echo $w->start_date; ?>" class="form-control" id="datepicker" placeholder="dd/mm/yy">
				<?php } } else { ?>
        <input type="text" name="start_date" value="<?php echo $this->input->post('start_date'); ?>" class="form-control" id="datepicker" placeholder="dd/mm/yy">
      <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('end_date'); ?></label> 
		  <?php if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
			<input type="text" name="end_date" value="<?php echo $w->end_date; ?>" class="form-control" id="datepicker_end" placeholder="dd/mm/yy">
					<?php } } else { ?>
        <input type="text" name="end_date" value="<?php echo $this->input->post('end_date'); ?>" class="form-control" id="datepicker_end" placeholder="dd/mm/yy">
     <?php } ?>
      </div>
      </div>
      
      
	<div class="form-group">       
      <div class="col-xs-5">
		  <?php if(isset($update_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $w->w_id; ?>" />
				 <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
		   <?php } else { if(isset($query)) {
			  foreach($query->result() as $w) { ?> 
				<input type="hidden" name="id" value="<?php echo $w->w_id; ?>" />
				 <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
				 <?php } } else  { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Submit</button>
        <?php } } ?>
      </div>
    </div>
</form>
</div>
