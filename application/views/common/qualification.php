
<?php
	$institutions = array('Sokoine University of Agricutlture', 'University of Dar-Es-Salaam', 'Dar-Es-Salaam Institutte of Technology',
		'University of Dodoma');
	$levels = array('PhD, Doctor of Phylosophy', 'Master\'s Degree', 'Postgraduate Degree', 'Undergraduate Degree(Barchelor)',
		'Advanced Diploma', 'Ordinry Diploma', 'Certificate');
	$courses = array('BSc. in Informatics', 'BSc. in Computer Science', 'BSc. in Computer Engineering', 'BSc. in Agriculture General',
		'BSc. in Agricultural Engineering', 'BA. in Tourixs Management', 'BA. in Rural Development', 'BSc with Education(Informatics and Mathematics)');

?>
	<?php if(isset($query)) { ?>
		<h4><?php echo $this->lang->line('qualification_header_update'); ?></h4>
		<?php } else { ?>
  <h4><?php echo $this->lang->line('qualification_header'); ?></h4>
  <?php } ?>
  <font color="red"><?php echo validation_errors(); ?></font>
  <?php echo form_open_multipart('Jobs/qualification', 'class="form-horizontal" role="form"') ?>
    <div class="form-group">
		<div class="col-xs-5">
		<label><?php echo $this->lang->line('level_education'); ?></label>    
		  <select name="level_edu" id="level_edu" class="form-control">
			  <option value="">--select--</option>
			  
				<?php $lvl = ($this->input->post('level_edu')) ? $this->input->post('level_edu') : ''  ?>
				
				<!--user need data to edit-->
				  <?php if(isset($query)) {
					  foreach($query->result() as $q) { ?>
						 <?php foreach($levels as $level) { 
						 if($q->edu_level == $level) { ?>
				  <option value="<?php echo $q->edu_level; ?>" selected="selected"><?php echo $q->edu_level; ?></option>
				   <?php } else { ?>
					   <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
				  <?php } } ?>
				  	<?php if ($q->edu_level == 'ACSEE') { ?>
				   <option value="ACSEE" selected="selected">A-Level</option>
				   <?php } else { ?>
					  <?php if ($q->edu_level == 'CSEE') { ?>
				   <option value="CSEE" selected="selected">O-Level</option>
				   <?php }} ?>
				   <?php if($q->edu_level == "CSEE") { ?>
				   <option value="ACSEE">A-Level</option>
				   <?php } else { ?>
				    <option value="CSEE">O-Level</option>
				    <?php } if($q->edu_level == '' || ($q->edu_level != 'ACSEE' and $q->edu_level != 'CSEE')) 
				    { 
						echo '<option value="ACSEE">A-Level</option>'; 
					}
				 } ?>
				  <?php }  //end of edited data
					
					else { ?>
					  
					  <!--form validation--User need to insert data-->
					<?php foreach($levels as $level) { 
						if($level == $lvl) { ?>
					<option value="<?php echo $level; ?>" selected="selected"><?php echo $level; ?></option>
					 <?php } else { ?>
					 <option value="<?php echo $level; ?>"><?php echo $level; ?></option>
				  <?php }}  ?>
				  <?php if ($lvl == 'ACSEE') { ?>
				   <option value="ACSEE" selected="selected">A-Level</option>
				   <?php } else { ?>
					  <?php if ($lvl == 'CSEE') { ?>
				   <option value="CSEE" selected="selected">O-Level</option>
				   <?php }} ?>
				   <?php if($lvl == "CSEE") { ?>
				   <option value="ACSEE">A-Level</option>
				   <?php } else { ?>
				    <option value="CSEE">O-Level</option>
				    <?php } if($lvl == '') { echo '<option value="ACSEE">A-Level</option>'; } } ?>
				    <!--end of form validation-->
			   </select>
      </div> 
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('institute_name'); ?></label> 
		  <select name="institute" id="pcountry" class="form-control">
			  <option value="">--select institution--</option>
			 <?php 
				$institutes = ($this->input->post('institute')) ? $this->input->post('institute') : '';
				
				/*..user need to edit details..*/
				  if(isset($query)) {
					  foreach($query->result() as $q) {
						  //$institute[] = ''; 
						  foreach($institutions as $name) {
					if($q->institute == $name) {
				echo '<option value="'. $q->institute .'" selected="selected">'. $q->institute . '</option>'; 
				}else
				{
					echo ($name == $institutes) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
				}
			}
			if($q->institute == "other") {
			  echo '<option value="other" selected="selected">Other</option>';
			   } else { if($q->institute == '' || $q->institute != 'other') { echo '<option value="other">Other</option>'; }} 
		}
	}/*end of editing details*/
	
	else {
				
				/*user need to add new info*/
				  $institute[] = ''; foreach($institutions as $name) {
					echo ($name == $institutes) ? '<option value="'. $name .'" selected="selected">'. $name . '</option>'
					 : '<option value="'. $name .'">'. $name .'</option>';
			}
		
			  ?>
			  <?php if($institutes == "other") { ?>
			  <option value="other" selected="selected">Other</option>
			  <?php } else { if($institutes == '' || $institutes != 'other') { echo '<option value="other">Other</option>'; }} 
			  
			  /* end of adding new info */ } ?>
			  
			   </select>
      </div>
      
    </div>
    
     <div class="form-group">
      <div class="col-xs-5"> 
		  <label><?php echo $this->lang->line('course_name'); ?></label> 
		  <select name="course" id="pcourse" class="form-control">
			  <option value="">--select your course--</option>
			  <?php 
			  $cours = ($this->input->post('course')) ? $this->input->post('course') : '';
			  
			  /*..user need to edit detail..*/
				  if(isset($query)) {
					  foreach($query->result() as $q) { 
						  foreach($courses as $course) { 
							  if($q->course == $course) {
					echo '<option value="'. $q->course .'" selected="selected">'. $q->course .'</option>';
					 } else {
						 echo ($course == $cours) ? '<option value="'. $course .'" selected="selected">'. $course .'</option>' :
					'<option value="'. $course .'">'. $course .'</option>';
						}
					}
					if($q->course == "other") {
					echo '<option value="other" selected="selected">Other</option>';
			  } else { if($q->course == '' || $q->course != 'other') { echo '<option value="other">Other</option>'; }}
			}
		}  /*..end of editing..*/
		else {
				
				/*user need to add new info*/
			  foreach($courses as $course) { 
				echo ($course == $cours) ? '<option value="'. $course .'" selected="selected">'. $course .'</option>' :
					'<option value="'. $course .'">'. $course .'</option>';
					}
			    if($cours == "other") {
					echo '<option value="other" selected="selected">Other</option>';
			  } else { if($cours == '' || $cours != 'other') { echo '<option value="other">Other</option>'; }} 
			 }
			  /*..end of new info..*/
			  ?>
			   </select>
      </div>
      
      <div class="col-xs-5" id="countrymention"> 
		  <label><?php echo $this->lang->line('institute_name_mention'); ?></label> 
		  <?php if(isset($query)) {
					  foreach($query->result() as $q) { ?>        
        <input type="text" name="institute_mention" class="form-control" value="<?php echo $q->institute_mention; ?>" id="countrymention" placeholder="Enter institution name">
      <?php } } else { ?>
      <input type="text" name="institute_mention" class="form-control" value="<?php echo $this->input->post('institute_mention'); ?>" id="countrymention" placeholder="Enter institution name">
    <?php } ?>
      </div>
     
    </div>
    
     <div class="form-group"> 
		 
		<div class="col-xs-5" id="coursemention"> 
		  <label><?php echo $this->lang->line('course_mention'); ?></label>
		 <?php if(isset($query)) {
					  foreach($query->result() as $q) { ?>           
        <input type="text" name="course_mention" class="form-control" value="<?php echo $q->course_mention; ?>" id="course_mention" placeholder="eg. BSc. in Informatics">
      <?php } } else { ?>
		  <input type="text" name="course_mention" class="form-control" value="<?php echo $this->input->post('course_mention') ?>" id="course_mention" placeholder="eg. BSc. in Informatics">
    <?php } ?>
      </div>
		  
		<div class="col-xs-2"> 
		  <label><?php echo $this->lang->line('acc_time_start'); ?></label>
		  <select name="acc_time_start" class="form-control" id="acc_time_start">
			  <option value="">--From--</option>
			  <?php $years = ($this->input->post('acc_time_start')) ? $this->input->post('acc_time_start') : '';
			  
			  if(isset($query)) {
					foreach($query->result() as $q) { 
						$year = array(); for($i = 1994; $i <= date('Y')-2; $i++) {
							$year[] = $i; } 
						foreach($year as $y) {
							if($q->acc_time_start == $y) {
			echo '<option value="'. $q->acc_time_start .'" selected="selected">'. $q->acc_time_start .'</option>';  
		   }
		   else
		   {
			//echo ($y == $years) ? '<option value="'. $y .'" selected="selected">'. $y .'</option>' :       
					echo '<option value="'. $y .'" >'. $y .'</option>';
				}    
		 }
	 } 
 } else {
			$year = array(); for($i = 1994; $i <= date('Y')-2; $i++) {
			  $year[] = $i; } 
			  foreach($year as $y) {
				echo ($y == $years) ? '<option value="'. $y .'" selected="selected">'. $y .'</option>' :       
					'<option value="'. $y .'" >'. $y .'</option>';
				}
        } ?>
        </select>
        
      </div> 
      <div class="col-xs-2"> 
		  <label><?php echo $this->lang->line('acc_time_end'); ?></label>         
         <select name="acc_time_end" class="form-control" id="acc_time_end">
			  <option value="">--To--</option>
			  <?php $years = ($this->input->post('acc_time_end')) ? $this->input->post('acc_time_end') : '';
			  
			  if(isset($query)) {
				foreach($query->result() as $q) {
					$year = array(); 
					for($i = 1995; $i <= date('Y'); $i++) {
						$year[] = $i; } foreach($year as $y) {
							if($q->acc_time_end == $y) { 
			echo '<option value="'. $q->acc_time_end .'" selected="selected">'. $q->acc_time_end .'</option>';  
		  }
		  else
		  {
			 // echo ($y == $years) ? '<option value="'. $y .'" selected="selected">'. $y .'</option>' :         
					echo '<option value="' .$y .'" >' .$y .'</option>';
			}
		}
	}
} else { 
		 $year = array(); for($i = 1995; $i <= date('Y'); $i++) {
			  $year[] = $i; } foreach($year as $y) { 
				echo ($y == $years) ? '<option value="'. $y .'" selected="selected">'. $y .'</option>' :         
					'<option value="' .$y .'" >' .$y .'</option>';
			}
        } ?>
        </select>
      </div> 
		 
      </div>
    <!--<div class="form-group">        
      <div class="col-xs-offset-2 col-xs-10">
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
      </div>
    </div>-->
    
    <div class="form-group"> 
		
		 <div class="col-xs-5">
		  
		  <label><?php echo $this->lang->line('country'); ?></label> 
		  <select name="country" id="qcountry" class="form-control">
	
			  <?php if(isset($query)) {
				foreach($query->result() as $q) {
					echo '<option value="' .$q->country .'" selected="selected">' . $q->country .'</option>';
					echo ($q->country == "other") ? '<option value="Tanzania">Tanzania</option>' : '<option value="other">Other</option>';
					} 
				}else {
					echo '<option value="Tanzania" selected="selected">Tanzania</option>'; 
				echo ($this->input->post('country') == "other") ? '<option value="other" selected="selected">Other</option>' :
			  '<option value="other">Other</option>';  
			  }
			  ?>
		</select>
      </div>
      <div class="col-xs-5">
		  <?php if(isset($fail))
				{
					echo '<div class="alert alert-danger">No file selected or invalid file</div>';
				}
				?>
		  <label><?php echo $this->lang->line('acc_attachment'); ?></label>
		  <?php if(isset($update_error)) { ?>
			  <select name="file" id="file" class="form-control">
				  <?php foreach($update_error->result() as $err)
					echo '<option value="'.$this->input->post('file').'" selected="selected">'.$this->input->post('file').'</option>'; 
					echo ($this->input->post('file') != 'other') ? '<option value="other">Change attachment</option>' :
						'<option value="'.$err->cert_name.'" >'.$err->cert_name.'</option>'
					?>
					
					</select>
					
					<div class="col-xs-5" id="changefile">
		  <input type="file" name="userfile" class="" size="20" id="changefile" />
		  </div>
		 <?php } else { if(isset($query)) {
				foreach($query->result() as $q) {  ?>
					<select name="file" id="file" class="form-control">
					<option value="<?php echo $q->cert_name; ?>" selected="selected"><?php echo $q->cert_name; ?></option>
					<option value="other">Change attachment</option>
					</select>
					<?php } ?>
					<div class="col-xs-5" id="changefile">
		  <input type="file" name="userfile" class="" size="20" id="changefile" />
		  </div>
					 <?php } else { ?>  
		 <input type="file" name="userfile" class="" size="20" />
		 <?php } } ?>
		<!--<button type="submit" class="btn btn-block btn-default" value="upload" >Upload</button>-->
      </div>
      </div>
      
      
      <div class="form-group">
		  
      <div class="col-xs-5" id="countrynew"> 
		  <label><?php echo $this->lang->line('country_mention'); ?></label>
		  <?php if(isset($query)) {
				foreach($query->result() as $q) { ?>         
        <input type="text" name="country_mention" class="form-control" value="<?php echo $q->country_mention; ?>" id="countrynew" placeholder="Enter country">
      <?php } } else { ?>
      <input type="text" name="country_mention" class="form-control" value="<?php echo $this->input->post('country_mention') ?>"
				id="autocomplete-ajax" style="background: transparent;" placeholder="Enter country">
	<?php } ?>
      </div> 
      <div class="col-xs-5" id="index"> 
		  <label><?php echo $this->lang->line('index_no'); ?></label>
		  <?php if(isset($query)) {
					  foreach($query->result() as $q) {   ?>        
        <input type="text" name="index" class="form-control" value="<?php echo $q->index_no; ?>" id="index" placeholder="eg. S0999-0030">
      <?php } } else { ?>
		  <input type="text" name="index" class="form-control" value="<?php echo $this->input->post('index'); ?>" id="index" placeholder="eg. S0999-0030">
     <?php } ?>
      </div>
      </div>
      <div class="form-group">       
      <div class="col-xs-5">
		  <?php if(isset($update_error)) { ?>
			  <input type="hidden" name="id" value="<?php echo $this->input->post('id'); ?>" />
			  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
		  <?php } else { if(isset($query)) { 
			  foreach($query->result() as $q) { ?>
			  <input type="hidden" name="id" value="<?php echo $q->academic_id; ?>" />
			  <button type="submit" name="action" value="Update" class="btn btn-md btn-success btn-block">Update</button>
			  <?php }} else { ?>
        <button type="submit" name="submit" value="Submit" class="btn btn-md btn-success btn-block">Submit</button>
        <?php } } ?>
      </div>
    </div>
  <?php echo form_close(); ?>
</div>
