<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function save_image($data)
	{
		do {
			
			$img_url_code = random_string('alnum', 8);
			$this->db->where('img_code = ', $img_url_code);
			$this->db->from('profileimage');
			$num = $this->db->count_all_results();
			
			} while ($num >= 1);
			
			$query = "INSERT INTO profileimage(user_id, img_code, img_name, img_dir_name) VALUES(?, ?, ?, ?)";
			$result = $this->db->query($query, array($data['user_id'], $img_url_code, $data['img_name'], $data['img_dir_name']));
			
			if($result)
			{
				return $img_url_code;
			} else
			{
				return false;
			}
		}
		
		function save_letter($data)
		{
			
			$query = "INSERT INTO cover_letter(user_id, job_id, user_letter, letter_dir_name) VALUES(?, ?, ?, ?)";
			$result = $this->db->query($query, array($data['user_id'], $data['job_id'], $data['user_letter'], $data['letter_dir_name']));
			
			if($result)
			{
				return $result;
			} else
			{
				return false;
			}
		}
		
		public function other_attachment($data)
		{
			$query = "INSERT INTO other_attachment(user_id, attachment_for, attach_name, attach_dir_name) VALUES(?, ?, ?, ?)";
			$result = $this->db->query($query, array($data['user_id'], $data['attachment_for'], $data['attach_name'], $data['attach_dir_name']));
			
			if($result)
			{
				return $result;
			} else
			{
				return false;
			}
		}
		
		public function update_attachment($data, $id)
		{
			$query = "UPDATE other_attachment SET attachment_for = ?, attach_name = ?, attach_dir_name = ? WHERE other_id = " . $id;
			$result = $this->db->query($query, array($data['attachment_for'], $data['attach_name'], $data['attach_dir_name']));
			
			if($result)
			{
				return $result;
			} else
			{
				return false;
			}
		}
		
		function fetch_images($user_id)
		{
			$query = "SELECT * FROM profileimage WHERE user_id = ?";
			$result = $this->db->query($query, array($user_id));
			$count = count($result);
			if($count > 0 || !empty($count))
			{
				return $result;
			}else
			{
				return false;
			}
		}
		
		function fetch_attachment($user_id)
		{
			$query = "SELECT * FROM other_attachment WHERE user_id = ?";
			return $result = $this->db->query($query, array($user_id));
			/*$count = count($result);
			if($count > 0 || !empty($count))
			{
				return $img_url_code;
			}else
			{
				return false;
			}*/
		}
		
		function user_img_exist($user_id)
		{
			$this->db->where('user_id', $user_id);
			$result = $this->db->get('profileimage');
			
			if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		public function update_image($update_data, $user_id)
		{
			$this->db->where('user_id', $user_id);
			return $this->db->update('profileimage', $update_data);
		}
		
		function user_letter($user_id, $job_id)
		{
			$this->db->where('user_id', $user_id);
			$this->db->where('job_id', $job_id);
			$result = $this->db->get('cover_letter');
			
			if($result)
			{
				return $result;
			}
			else
			{
				return false;
			}
		}
		
	}
?>
