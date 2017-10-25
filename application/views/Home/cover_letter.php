<?php

if(isset($cover_letter)) { 
			echo form_open_multipart('Jobs/application'); ?>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<?php foreach($cover_letter->result() as $letter) ?>
			<label class="alert alert-info"><h4 style="font-family: Times New Roman, Times, serif;">Please attach your cover letter for the Application of </h4><b
			 style="text-transform: uppercase; font-family: Times New Roman, Times, serif;" ><?php echo 
			$letter->job_title; ?></b></label>
			
			<input type="file" name="userfile" class="" size="20" />
			<br/>
			<a href="<?php echo base_url('index.php/Jobs/index'); ?>" class="btn btn-info">Cancel</a>
			<input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>" />
			<input type="hidden" name="dep_id" value="<?php echo $this->uri->segment(4); ?>" />
			<button type="submit" name="submit" value="Send" class="btn btn-success" >Send</button>
			</div>
			</div>
			<?php echo form_close(); } ?>	
