
<?php
if(! defined('BASEPATH')) exit('No direct sc ript success allowed');
	
		class Job_Model extends CI_Model
		{
			public function username_exist($username)
			{
				$this->db->where('user_email', $username);
				return $result =  $this->db->get('user');
			}
		}
				
				
