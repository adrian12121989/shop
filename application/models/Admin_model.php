<?php
	if(! defined('BASEPATH')) exit('No direct sc ript success allowed');
	
		class Admin_Model extends CI_Model
		{
			public function insert_interview($data)
			{
				$this->db->insert('interview_info', $data);
				$insert_id = $this->db->insert_id();
				return $insert_id;
			}
			
			public function fetch_shortlisted()
			{
				$this->db->select('*');
				$this->db->from('user_application');
				$this->db->join('user', 'user.user_id = user_application.user_id', 'left');
				$this->db->where('application_status = 1');
				$this->db->where('call_interview = 0');
				return $this->db->get();
			}
			
			public function fetch_interview()
			{
				$sql = "SELECT * FROM interview_info ORDER BY info_id DESC LIMIT 1";
				return $this->db->query($sql);
			}
			
			public function fetch_all_interview()
			{
				$sql = "SELECT * FROM interview_info ORDER BY info_id DESC ";
				return $this->db->query($sql);
			}
			
			public function save_candidates($data)
			{
			
				$query = "INSERT INTO call_for_interview(users_id, job_id, info_id, date_called, called_by) VALUES(?, ?, ?, ?, ?)";
				$result = $this->db->query($query, array($data['users_id'], $data['job_id'], $data['info_id'], $data['date_called'], $data['called_by']));
			
				if($result)
				{
					return $result;
				} else
				{
					return false;
				}
			}
			
			public function update_users_application()
			{
				$sql = "UPDATE users_application SET call_interview = 1 WHERE application_status = 1 ";
				return $this->db->query($sql);
			}
			
			public function view_reg_userss($limit)
			{
				$sql = "SELECT * FROM users, p_details, contacts 
				WHERE access_level = 1 AND users.users_id = p_details.users_id AND users.users_id = contacts.users_id LIMIT " . $limit;
				
				return $this->db->query($sql);
			}
			
			public function count_application()
			{
				
				$this->db->select('*');
				$this->db->from('users_application');
				$this->db->join('users', 'users.users_id = users_application.users_id', 'left');
				$this->db->join('p_details', 'users.users_id = p_details.users_id', 'left');
				$this->db->join('jobs', 'users_application.job_id = jobs.job_id', 'left');
				$this->db->where('application_status = 0');
				if($this->session->usersdata('access_level') == 4)
				$this->db->where('dvc_approve = 0');
				else
				$this->db->where('dvc_approve = 1');
				return $this->db->get();
			}
			
			public function view_applications($limit, $start, $dep_id)
			{
				if($limit > 0)
				{
					$this->db->limit($limit, $start);
				}
				$this->db->select('*');
				
				if($this->session->usersdata('access_level') == 2) {
				$this->db->from('users_application, worker_shortlist');
				$this->db->where('worker_shortlist.dep_id = users_application.dep_id');
				$this->db->where('worker_shortlist.users_id=', $this->session->usersdata('user_id'));
				} else
				$this->db->from('user_application');
				$this->db->join('user', 'user.user_id = user_application.user_id', 'left');
				$this->db->join('p_details', 'user.user_id = p_details.user_id', 'left');
				$this->db->join('jobs', 'user_application.job_id = jobs.job_id', 'left');
				
				if($dep_id > 0)
				$this->db->where('user_application.dep_id', $dep_id);
				$this->db->where('application_status = 0');
				if($this->session->userdata('access_level') == 4)
				$this->db->where('dvc_approve = 0');
				else
				$this->db->where('dvc_approve = 1');
				if($this->session->userdata('access_level') == 3) {
				$this->db->where('forwarded_to_dept = 0');
				}
			
				return $this->db->get();
	
			}
			
			public function worker_exists($user_email)
			{
				$this->db->where('username', $user_email);
				return $this->db->get('users');
			}
			
			public function assigned($user)
			{
				$this->db->where('user_id', $user);
				return $this->db->get('worker_shortlist');
			}
			
			public function dvc_approve($user_id, $job_id)
			{
				$sql = "UPDATE user_application SET dvc_approve = 1 WHERE user_id = ? AND job_id = ? ";
				$this->db->query($sql, array($user_id, $job_id));
			}
			
			public function forwarded_to_dept($dep_id)
			{
				$sql = "UPDATE user_application SET forwarded_to_dept = 1 WHERE dep_id = ? ";
				$this->db->query($sql, array($dep_id));
			}
			
			public function short_listed()
			{
				
				$this->db->select('*');
				$this->db->from('user_application');
				$this->db->join('user', 'user.user_id = user_application.user_id', 'left');
				$this->db->join('p_details', 'user.user_id = p_details.user_id', 'left');
				$this->db->join('jobs', 'user_application.job_id = jobs.job_id', 'left');
				$this->db->where('application_status = 1');
				$this->db->where('call_interview = 0');
				return $this->db->get();
	
			}
			
			public function short_list($user_id, $job_id)
			{
				$sql = "UPDATE user_application SET application_status = 1 WHERE user_id = ? AND job_id = ? ";
				return $this->db->query($sql, array($user_id, $job_id));
			}
			
			public function unshortlist($user_id, $job_id)
			{
				$sql = "UPDATE user_application SET application_status = 0 WHERE user_id = ? AND job_id = ? ";
				return $this->db->query($sql, array($user_id, $job_id));
			}
			
			public function short_list_active($user_id, $job_id)
			{
				$this->db->where('user_id', $user_id);
				$this->db->where('job_id', $job_id);
				$this->db->where('application_status = 1');
				return $this->db->get('user_application');
			}
			
			public function view_job_by_title()
			{
				
				$sql = "SELECT DISTINCT head_name, head_email, departments.dep_id, user_application.dep_id, name FROM departments, user_application WHERE user_application.dep_id = departments.dep_id";
				return $this->db->query($sql);
				/*
				$this->db->select('*');
				$this->db->from('departments');
				$this->db->join('user_application', 'user_application.dep_id = departments.dep_id');
				//if($dep_id > 0)
				//$this->db->where('departments.dep_id', $dep_id);
				$this->db->distinct('dep_id');
				return $this->db->get(); */
			}
			
			public function retrieve_job_by_title($job_title)
			{
				$this->db->select('*');
				$this->db->from('user_application');
				$this->db->join('user', 'user.user_id = user_application.user_id', 'left');
				$this->db->join('p_details', 'user.user_id = p_details.user_id', 'left');
				$this->db->join('jobs', 'user_application.job_id = jobs.job_id', 'left');
				
				$this->db->where('user_application.job_id', $job_title);
				return $this->db->get();
			}
			public function job_position($user_id, $id)
			{
				$this->db->select('*');
				$this->db->from('jobs');
				$this->db->join('cover_letter', 'jobs.job_id = cover_letter.job_id AND user_id = ' .$user_id, 'left');
				$this->db->where('jobs.job_id', $id);
				return $this->db->get();
			}
			
			public function manage_system_users()
			{
				$this->db->where('access_lvl > 0');
				return $this->db->get('users');
			}
			
			public function fetch_user_email($id)
			{
				$sql = 'SELECT username FROM users WHERE user_id = ?';
				return $this->db->query($sql, array($id));
			}
			
			public function update_user_password($id, $password)
			{
				$sql = "UPDATE users SET password = ? WHERE user_id = ?";
				return $this->db->query($sql, array($password, $id));
			}
			public function add_employees($employees)
			{
				return $this->db->insert('employees',$employees);
				
			}
			public function update_user_access($access_data, $id)
			{
				$this->db->where('user_id', $id);
				return $this->db->update('users', $access_data);
			}
			public function employee_results()
			{
				$this->db->select('*');
				$this->db->from('employees');
				return $this->db->get();
			}
			
			public function update_result($id)
			{
				$this->db->where('user_id', $id);
				return $this->db->get('users');
			}
			
			public function get_pass($id)
			{
				$this->db->where('user_id', $id);
				return $this->db->get('users');
			}
			public function edit_employees($emp_id)
			{
				$this->db->where ('emp_id',$emp_id);
				return $this->db->get('employees');
			}
			
			public function user_delete($id)
			{
				$this->db->delete('users', array('user_id' => $id));
			}
			
			public function get_categories()
			{ 
				return $this->db->get('users');
			}
			
			public function get_access()
			{
				return $this->db->get('access_lvl');
			}
			public function get_user_category($user_id)
			{
				$sql = 'SELECT category FROM users WHERE user_id = ?';
				return $this->db->query($sql, array($user_id));
			}
			
			public function job_details($job_data)
			{
				return $this->db->insert('jobs', $job_data);
			}
			
			public function access_lvl($access_data)
			{
				return $this->db->insert('users', $access_data);
			}
			
			public function worker_shortlist($data)
			{
				return $this->db->insert('worker_shortlist', $data);
			}
			
			public function access_result()
			{
				$sql = "SELECT * FROM users WHERE access_lvl > 0 ORDER BY user_id DESC LIMIT 1";
				return $this->db->query($sql);
			}
			
			public function job_result($limit)
			{
				$sql = "SELECT * FROM jobs ORDER BY job_id DESC LIMIT " . $limit;
				return $this->db->query($sql);
			}
			
			public function job_edit($users_id)
			{
				$sql = 'SELECT * FROM jobs WHERE created_by = ? ORDER BY job_id DESC LIMIT 1';
				$job_edit = $this->db->query($sql, array($users_id));
				if($job_edit)
				{
					return $job_edit;
				}
				else
				{
					return false;
				}
					
			}
			public function admin_job_edit($job_id)
			{
				$this->db->where('job_id', $job_id);
				$result = $this->db->get('jobs');
				if($result)
				{
					return $result;
				}
				else
				{
					return false;
				}
					
			}
			public function edit_access($id)
			{
				$this->db->where('user_id', $id);
				return $this->db->get('users');
					
			}
			public function update_job($job_data, $job_id)
			{
				$this->db->where('job_id', $job_id);
				return $this->db->update('jobs', $job_data);
			}
			
			public function update_interview($data, $id)
			{
				$this->db->where('info_id', $id);
				return $this->db->update('interview_info', $data);
			}
			
			public function delete_job($job_id)
			{
				$this->db->delete('users_application', array('job_id' => $job_id));
				$this->db->delete('jobs', array('job_id' => $job_id));
			}
		}
