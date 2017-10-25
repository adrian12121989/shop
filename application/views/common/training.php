
<?php
	$regions = array('Mara', 'Iringa', 'Njombe', 'Dar-Es-Salaam', 'Arusha', 'Dodoma', 'Mwanza', 'Tanga', 'Mbeya', 'Morogoro', 'Pwani');
?>
<?php if(isset($query)) { ?>
	<h4><?php echo $this->lang->line('training_header_update'); ?></h4>
	<?php } else { ?>
<h4><?php echo $this->lang->line('training_header'); ?></h4>
<?php } ?>
<?php echo '<font color="red">'. validation_errors() . '</font>'; ?>
<?php echo form_open('Jobs/training', 'class="form-horizontal" role="form"'); ?>

    <div class="form-group">
		<div class="col-xs-5">
		  <label><?php echo $this->lang->line('description'); ?></label>
		  <?php if(isset($query)) { 
			  foreach($query->result() as $t) { ?>
			    <textarea type="text" name="description" class="form-control" id="description" placeholder="Enter your training description">
        <?php echo $t->description; ?></textarea> 
        <?php } } else { ?>       
        <textarea type="text" name="description" class="form-control" id="description" placeholder="Enter your training description">
        <?php echo $this->input->post('description'); ?></textarea>
        <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('t_institution'); ?></label> 
		  <?php if(isset($query)) { 
			  foreach($query->result() as $t) { ?> 
				 <textarea type="text" name="institution" class="form-control" id="institution" placeholder="Enter institution address address">
        <?php echo $t->t_institution; ?></textarea>
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
					foreach($query->result() as $t) { ?>
				<input type="text" name="start_date" value="<?php echo $t->start_date; ?>" class="form-control" id="datepicker" placeholder="dd/mm/yy">
					<?php } } else { ?>
        <input type="text" name="start_date" value="<?php echo $this->input->post('start_date'); ?>" class="form-control" id="datepicker" placeholder="dd/mm/yy">
     <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('end_date'); ?></label> 
		  <?php if(isset($query)) { 
					foreach($query->result() as $t) { ?>
				 <input type="text" name="end_date" value="<?php echo $t->end_date; ?>" class="form-control" id="datepicker_end" placeholder="dd/mm/yy">
					<?php } } else { ?>
        <input type="text" name="end_date" value="<?php echo $this->input->post('end_date'); ?>" class="form-control" id="datepicker_end" placeholder="dd/mm/yy">
     <?php } ?>
      </div>
      </div>
      
      <div class="form-group">
		 <div class="col-xs-5">
		  <label><?php echo $this->lang->line('supervisor_address'); ?></label> 
		   <?php if(isset($query)) { 
					foreach($query->result() as $t) { ?> 
				<textarea type="text" name="supervisor" class="form-control" id="supervisor" placeholder="Enter name and address">
				 <?php echo $t->supervisor_address; ?></textarea>
				<?php } } else { ?>
        <textarea type="text" name="supervisor" class="form-control" id="supervisor" placeholder="Enter name and address">
        <?php echo $this->input->post('supervisor'); ?></textarea>
        <?php } ?>
      </div>
      <div class="col-xs-5">
		  <label><?php echo $this->lang->line('attachment'); ?></label>      
		 <input type="file" name="userfile" class="" size="20" />
		<!--<button type="submit" class="btn btn-block btn-default" value="upload" >Upload</button>-->
      </div>
      </div>
      
	<div class="form-group">       
      <div class="col-xs-5">
		  <?php if(isset($query)) { 
			  foreach($query->result() as $t) { ?>
				  <input type="hidden" name="id" value="<?php echo $t->training_id; ?>" />
				  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
				 <?php } } else { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Submit</button>
        <?php } ?>
      </div>
    </div>
</form>
</div>
