 <?php
 
 $attachments = array('Curriculum Vitae', 'Birth Certificate', 'Recomendation Letter', 'TCU Certificate', 'other');
 ?>
 <?php echo '<font color="red">'. validation_errors(). '</font>'; ?>
 <?php if(isset($fail))
				{
					echo '<div class="alert alert-danger">Select file or The file is invalid!</div>';
				}?>
 <?php echo form_open_multipart('Jobs/other_attachment', 'class="form-horizontal" role="form"'); ?>
 <div class="form-group">
 <div class="col-xs-5">
		  <?php //if(isset($fail))
				//{
					//echo '<div class="alert alert-danger">No file selected or invalid file</div>';
				//}
				?>
		  <label>Attachment for</label>
		 
					<select name="files" id="files" class="form-control">	
						<option value="">--select--</option>
					<?php $attach = ($this->input->post('files')) ? $this->input->post('files') : '';
					if(isset($query)) {
						foreach($query->result() as $row) {
							foreach($attachments as $attachment) {
							echo ($row->attachment_for == $attachment) ? '<option value="'.$row->attachment_for.'" selected="selected">'.$row->attachment_for.'</option>' : 
							'<option value="'.$attachment.'">'.$attachment.'</option>'; 
						}
					}
				}
				else {
					foreach($attachments as $attachment) { 
						echo ($attachment == $attach) ? '<option value="'.$attachment.'" selected="selected">'.$attachment.'</option>' : 
							'<option value="'.$attachment.'">'.$attachment.'</option>'; 
							}
						}	?>
					</select>
				</div>
				<?php if(isset($update_error)) { 
						foreach($update_error->result() as $err)?>
					<div class="col-xs-5" >
						<label>Your attachment</label>
						<select name="file" id="file" class="form-control">
							<?php
								echo ($this->input->post('file') != 'other') ? '<option value="'.$this->input->post('file').'" selected="selected">'
								.$this->input->post('file').'</option>' : '<option value="other" selected="selected">Change attachment</option>';
								   echo ($this->input->post('file') != 'other') ? '<option value="other">Change attachment</option>' :
										'<option value="'.$err->attach_name.'">'.$err->attach_name.'</option>' 
								   ?>
						</select>
						<span>Select change attachment to update</span>
					</div>
					<div class="col-xs-5" id="changefile">
					<input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
					<input type="file" name="userfile" class="" size="20" id="changefile" />
					</div>
					<div class="col-xs-5">
					<button type="submit" name="action" value="Update" class="btn btn-block btn-success form-control">Update</button>
					</div>
					<?php } 
					else { if(isset($query)) { ?>
					<div class="col-xs-5" >
						<label>Your attachment</label>
						<select name="file" id="file" class="form-control">
							<?php foreach($query->result() as $row) {
								echo '<option value="'.$row->attach_name.'">'.$row->attach_name.'</option>';
								echo '<option value="other">Change attachment</option>';   ?>
						</select>
						<span>Hint: <xsall><font color="green">Select "Change attachment" option to update file</font></xsall></span>
					</div>
					<div class="col-xs-5" id="changefile">
				<input type="hidden" name="id" value="<?php echo $row->other_id; ?>" />
				<input type="file" name="userfile" class="" size="20" id="changefile" />
				</div>
				<br />
				<div class="col-xs-5">
				<button type="submit" name="action" value="Update" class="btn btn-block btn-success form-control">Update</button>
				</div>
		<?php	}
		} 
	 
		else { ?>  
			<label>Attachment</label>
			
			<input type="file" name="userfile" class="" size="20" />
			<br/>
			<div class="col-xs-5">
			<button type="submit" name="submit" value="Upload" class="btn btn-info form-control" >Save</button>
			
		 <?php } } ?>
		</div>
      </div>
<?php echo form_close(); ?>
</div>
