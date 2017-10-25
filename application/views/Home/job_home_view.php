<script>
$(function() {
    
    //autocomplete
    $("#auto").autocomplete({
        source: "Jobs/get_job"
    });                

});
</script>
<div class="table-responsive">
      <?php if(isset($error)) { 
			echo '<div class="alert alert-danger">'.$this->lang->line('user_info_help').'</div>'; } 
			
			?>
	<?php echo form_open('Jobs/index'); ?>
	<div class="form-group">
		<div class="col-xs-2">
			
			<select name="limit" id="limit" class="form-control">
				<?php  $limits = ($this->input->post('limit')) ? $this->input->post('limit') : '';
				$limit = array();
					for($i = 10; $i<=25; $i+=5) {
						$limit[] = $i;
						}
						foreach($limit as $l) {
						echo ($l == $limits) ? '<option value="'.$l.'" selected="selected">'.$l.'</option>' : '<option value="'.$l.'">'.$l.'</option>';
					}
						?>
					</select>
					
			</div>
			<div class="col-xs-1">
			<button type="submit" class="form-control btn btn-default">Go</button>
			</div>
			<div class="col-xs-4 navbar-right">
				
		<label for="auoto"></label>
	
		<input type="text" id="auto" class="form-control" placeholder="Search Job">
				</div>
		</div>
		<?php echo form_close(); ?>
    
         
  <table class="table" style="font-family: Times New Roman, Times, serif;">
    <thead>
      <tr>
        <th><?php echo '<font color="green">'.$this->lang->line('job_type') .'</font>'; ?></th>
        <th><?php echo '<font color="green">'.$this->lang->line('job_title') . ' and ' .$this->lang->line('job_desc') . '</font>'; ?></th>
        <th><?php echo '<font color="green">'.$this->lang->line('posted_date') .'</font>'; ?></th>
         <th><?php echo '<center><font color="green">'. $this->lang->line('job_sunset_date') .'</font></center>'; ?></th>
        
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($query->result() as $result) { ?>
		<?php echo form_open('Jobs/application'); ?>
      <tr class="info">
		  <td style="width: 10%"><?php echo $result->job_type; ?></td>
        <td><a href="#<?php echo $result->job_id; ?>" class="" data-toggle="collapse"><?php echo $result->job_title; ?></a>
        <div id="<?php echo $result->job_id; ?>" class="collapse">
        <label>Job Description & Qualifications</label>
        <ul style="list-style-type: none ">
        <p><li>Institution:  <?php echo $result->job_name; ?></li>
				<li>Location:  <?php echo $result->location; ?></li>
				<li>E-mail:  <?php echo $result->job_email; ?></li></p>
				</ul>
        <small><?php echo $result->job_desc; ?></small>
        </div></div>
        <td style="width: 15%"><small><?php echo $result->posted_date; ?></small></td>
        <td align="center"><small><?php echo $result->sunset_date; ?></small></td>
        <td>
        <?php if(isset($user)) { 
			
			foreach($user->result() as $row) {  
				$users[] = $row->job_id;
			}
				if(in_array($result->job_id, $users)) {  ?>
				<font color="green">Application sent</font>
				<?php } else {  ?>
					<input type="hidden" name="id" value="<?php echo $result->job_id; ?>" />
			<!--<button type="submit" name="action" value="Apply" class="btn btn-info">Apply</button>-->
			<?php echo anchor("Jobs/application/".$result->job_id . '/' . $result->dep_id, 'Apply'); ?>
				<?php  }
				} else { ?>
				<input type="hidden" name="id" value="<?php echo $result->job_id; ?>" />
			<!--<button type="submit" name="action" value="Apply" class="btn btn-info">Apply</button>-->
			<?php echo anchor("Jobs/application/".$result->job_id . '/' . $result->dep_id, 'Apply'); ?>
			<?php } ?></td>
        
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>

    </tbody>
  </table>
</div>
