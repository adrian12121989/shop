
		
	<?php foreach($access->result() as $result) {
		//echo form_open('Admin/add_user');
			if($result->access_lvl == 3)
			{
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve updated <b>('.$result->first_name. ' ' . $result->last_name . '</b> password! The updated password has been sent to <b>' .
				$result->username.'.)</b><br /> 
					'.$result->first_name. ' will be able to perform the following activities
						<ul>
						<li>Manage Users(Add, Edit, Delete)</li>
						<li>Manage Records(Add, Edit, Delete)</li>
						<li>Manage Invetory(Add, Edit, Delete)</li>
						<li>View all reports
						</ul><</div>';
			} 
			 else if($result->access_lvl == 2) {
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve updated <b>('.$result->first_name. ' ' . $result->last_name . '</b> password! The updated password has been sent to <b>' .
				$result->username.'.)</b><br /> 
				Now '.$result->first_name. ' has some of Admin privileges</p>
					and will be able to perform the following activities
						<ul>
						<li>Add financial Records(Add, Edit, Delete)</li>
						<li>Add Invetory records</li>
						<li>View all reports</li>
						</ul></div>';
					}
				else {
				echo '<div class="alert alert-success"><p>Congrats!.. You\'ve updated <b>('.$result->first_name. ' ' . $result->last_name . '</b> password! The updated password has been sent to <b>' .
				$result->username.'.)</b><br /> 
					'.$result->first_name. ' will be able to perform the following activities
						<ul>
						<li>Add financial records</li>
						<li>Add invetory records and,</li>
						<li>View cash collected amount</li>
						</ul></div><p>';
					}
				
			echo '<div><input type="hidden" name="id" value="'.$result->user_id.'"></div>';
			echo '<div><a href="'. base_url('index.php/Admin/add_user/' . $result->user_id).'" class="btn btn-info">Change Permision</a> Or 
					<a href="'.base_url('index.php/Home/dashboard').'">No!.. Thanks</a></div>';
					
			//echo form_close();
      } ?>
     
</div>
   
