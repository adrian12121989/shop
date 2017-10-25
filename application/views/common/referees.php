
<?php if(isset($query)) { ?>
	<h4><?php echo $this->lang->line('r_header_edit'); ?></h4>
	<?php } else { ?>
<h4><?php echo $this->lang->line('r_header'); ?></h4>
<?php } ?>
<?php echo '<font color="red">'. validation_errors() .'</font>'; ?>
<?php echo form_open('Jobs/referee', 'class="form-horizontal" role="form"'); ?>

<div class="form-group">
	<div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('r_name'); ?></label> 
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				<input type="text" name="r_name" value="<?php echo $r->r_name; ?>" class="form-control" id="r_name" placeholder= "Enter full name" />
			<?php } } else { ?>
        <input type="text" name="r_name" value="<?php echo $this->input->post('r_name'); ?>" class="form-control" id="r_name" placeholder= "Enter full name" />
      <?php } ?>
      </div>
      
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('r_title'); ?></label> 
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				<input type="text" name="r_title" value="<?php echo $r->r_title; ?>" class="form-control" id="r_title" placeholder= "Enter title" />
			<?php } } else { ?>
        <input type="text" name="r_title" value="<?php echo $this->input->post('r_title'); ?>" class="form-control" id="r_title" placeholder= "Enter title" />
      <?php } ?>
      </div>
      
    </div>
    
    <div class="form-group">
		<div class="col-xs-5">
		  <label><?php echo $this->lang->line('r_institution'); ?></label>
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				 <input type="text" name="r_institution" value="<?php echo $r->r_institution; ?>" class="form-control" id="r_institution" placeholder="Enter insitution">
				<?php  } } else { ?>
        <input type="text" name="r_institution" value="<?php echo $this->input->post('r_institution'); ?>" class="form-control" id="r_institution" placeholder="Enter insitution">
     <?php } ?>
      </div>
      
		<div class="col-xs-5">
		  <label><?php echo $this->lang->line('r_address'); ?></label>
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				 <input type="text" name="r_address" value="<?php echo $r->r_address; ?>" class="form-control" id="r_address" placeholder="Enter physical address">
					<?php } } else { ?>
        <input type="text" name="r_address" value="<?php echo $this->input->post('r_address'); ?>" class="form-control" id="r_address" placeholder="Enter physical address">
     <?php } ?>
      </div>
	</div>
	
	<div class="form-group">
		<div class="col-xs-5">
		  <label><?php echo $this->lang->line('r_mobile'); ?></label>
		   <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				 <input type="text" name="r_mobile" value="<?php echo $r->r_mobile; ?>" class="form-control" id="r_mobile" placeholder="eg. 755237904">
					<?php } } else { ?>
        <input type="text" name="r_mobile" value="<?php echo $this->input->post('r_mobile'); ?>" class="form-control" id="r_mobile" placeholder="eg. 755237904">
      <?php } ?>
      </div>
      
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('r_email'); ?></label>
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				 <input type="text" name="r_email" value="<?php echo $r->r_email; ?>" class="form-control" id="r_email" placeholder="Enter email">
					<?php } } else { ?>
        <input type="text" name="r_email" value="<?php echo $this->input->post('r_email'); ?>" class="form-control" id="r_email" placeholder="Enter email">
     <?php } ?>
      </div>
      </div>
      
	<div class="form-group">       
      <div class="col-xs-5">
		  <?php if(isset($query)) { 
			  foreach($query->result() as $r) { ?> 
				  <input type="hidden" name="id" value="<?php echo $r->r_id; ?>" />
				   <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
				   <?php } } else { ?>
        <button type="submit" class="btn btn-md btn-success btn-block">Submit</button>
        <?php } ?>
      </div>
    </div>
<?php echo form_close(); ?>
</div>
