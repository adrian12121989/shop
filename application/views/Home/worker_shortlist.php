
		
	<?php foreach($result->result() as $result) {
		//echo form_open('Admin/add_user');
			
				echo '<div class="alert alert-success">Succees! E-mail has been sent to to ' . $result->user_email . 'This user will nw be able to shortilist applicants accordingly.</div>';
			echo '<div><input type="hidden" name="id" value="'.$result->user_id.'"></div>';
			echo  '<a href="'.base_url('index.php/Jobs/dashboard').'">Thanks</a></div>';
					
			//echo form_close();
      } ?>
     
</div>
   
