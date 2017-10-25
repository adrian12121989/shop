
		
	<?php foreach($access->result() as $result) {
		//echo form_open('Admin/add_user');
			if($result->access_lvl == 3)
			{
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve added <b>('.$result->first_name. ' ' . $result->last_name . '</b> and will be able to login 
				into the system using<b> ' .$result->username.'.)</b> and the generated password sent to the user\'s email!<br /> 
				'.$result->first_name. ' will be able to perform the following activities
						<ul>
						<li>Adding new devices</li>
						<li>Doing Expenditures</li>
						<li>Full Control of the Bussiness</li>
						</ul></div>';
			} 
			else if($result->access_lvl == 2) {
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve added <b>('.$result->first_name. ' ' . $result->last_name . '</b> and will be able to login 
				into the system using<b> ' .$result->username.'.)</b> and the generated password sent to the user\'s email!<br />
				'.$result->first_name. ' has some of Admin privileges</p>
					and will be able to perform the following activities
						<ul>
						<li>Only Selling the Devices</li>
						
						</ul></div>';
					}
				else {
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve added <b>('.$result->first_name. ' ' . $result->last_name . '</b> This user will be able to login 
				into the system using<b> ' .$result->username.'.)</b>and the generated password sent to the user email!<br /> 	
				'.$result->first_name. ' will be able to perform the following activities
						<ul>
						<li>Only Selling the Devices</li>
						</ul></div>';
					}
				
			echo '<div><input type="hidden" name="id" value="'.$result->user_id.'"></div>';
			echo '<div><a href="'. base_url('index.php/Admin/add_user/' . $result->user_id).'" class="btn btn-info">Change Permision</a> Or 
					<a href="'.base_url('index.php/Jobs/dashboard').'">No!.. Thanks</a></div>';
					
			//echo form_close();
      } ?>
     
</div>
   
