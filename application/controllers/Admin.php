<?php
	if(! defined('BASEPATH')) exit('Requested script is not available');
	
	class Admin extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model('Job_Model');
			$this->lang->load('en_admin', 'english');
			$this->load->helper('url');
			$this->load->helper(array('string'));
			$this->load->library('form_validation');
			$this->load->library('image_lib');
			$this->load->model('Admin_model');
			$this->load->library('pagination');
			$this->load->library('table');
			//$this->load->controler('Image');
		}
		public function index()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('Admin_panel');
			$this->load->view('common/footer');
		}
		
		public function approve()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$this->Admin_model->dvc_approve($this->uri->segment(3), $this->uri->segment(4));
				redirect('Admin/view_applications');
		}
		
		public function view_reg_cv()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$id = $this->uri->segment(3);
			
			$short_list = $this->Admin_model->short_list_active($id, $this->uri->segment(4));
			if($short_list->num_rows() > 0)
			{
				$data = array('cv' => $this->Job_Model->view_cv($id), 'cv_work' => 
			$this->Job_Model->view_cv_work($id), 'cv_train' => $this->Job_Model->view_cv_train($id),
				'cv_ref' => $this->Job_Model->view_cv_ref($id), 'Home' => $this->Admin_model->job_position($this->uri->segment(3), $this->uri->segment(4)),
				'short_list' => $this->Admin_model->short_list_active($id, $this->uri->segment(4)));
			} else {
			$data = array('cv' => $this->Job_Model->view_cv($id), 'cv_work' => 
			$this->Job_Model->view_cv_work($id), 'cv_train' => $this->Job_Model->view_cv_train($id),
				'cv_ref' => $this->Job_Model->view_cv_ref($id), 'Home' => $this->Admin_model->job_position($this->uri->segment(3), $this->uri->segment(4)));
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('cv/viewCV', $data);
			$this->load->view('common/footer');
			
		}
		
		public function short_list()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3) and $this->uri->segment(4))
			{
				if($this->Admin_model->short_list($this->uri->segment(3), $this->uri->segment(4)))
				{
					redirect('Admin/view_reg_cv/' .$this->uri->segment(3) .'/'. $this->uri->segment(4));
				}
			}
		}
		
		public function delete_user()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Admin_model->user_delete($id);
				
				redirect('Admin/manage_system_users');
				exit();
			}
		}
		
		public function add_user()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			if($this->uri->segment(4))
			{
				
				$result['access'] = $this->Admin_model->edit_access($id);
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('Home/add_user', $result);
				$this->load->view('common/footer');
			}
			else
			{ 
				$this->form_validation->set_rules('first_name', 'first name', 'required|min_length[1]|max_length[125]');
				$this->form_validation->set_rules('middle_name', 'middle name', 'required|min_length[1]|max_length[125]');
				$this->form_validation->set_rules('last_name', 'last name', 'required|min_length[1]|max_length[125]');
				$this->form_validation->set_rules('department', 'department', 'required|min_length[1]|max_length[125]');
				if($this->input->post('action') == 'Update')
					$this->form_validation->set_rules('usr_email', 'user email', 'required|valid_email|min_length[1]|max_length[125]');
				else
			$this->form_validation->set_rules('usr_email', 'user email', 'required|valid_email|is_unique[users.username]|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('confirm_usr_email', 'confirm_user email', 'required|valid_email|matches[usr_email]|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('permision', 'permision', 'required|min_length[1]|max_length[125]');
			
			if($this->form_validation->run() == FALSE)
			{
				if($this->uri->segment(3)) {
				$id = $this->uri->segment(3);
				$access = array('category' => $this->Admin_model->get_user_category($id),'permisions' => $this->Admin_model->get_access(), 'access' => $this->Admin_model->edit_access($id));
			} else {
				if($this->input->post('action') == 'Update')
				$access = array('permisions' => $this->Admin_model->get_access(), 'update_error' => '');
				else
				$access = array('permisions' => $this->Admin_model->get_access());
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('Home/add_user', $access);
				$this->load->view('common/footer');
			}
			else
			{
				if($this->input->post('action') == 'Update') {
					$get_password = $this->Admin_model->get_pass($this->input->post('id'));
					foreach($get_password->result() as $pass)
					{
						$password = $pass->password;
					}
				}else {
					
					//create random password here
					//do {
			
						$ran_password = random_string('alnum', 8);
						
					//send email to user
					$user = $this->input->post('confirm_usr_email');
							$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://smtp.googlemail.com', 'smtp_port' => 465,
												'smtp_user' => 'matoke12@gmail.com', 'smtp_pass' => 'muyenjwa',
												'mailtype' => 'html', 'charset' => 'utf8', 'wordwrap' => TRUE);
												
								$this->load->library('email', $config);
								$this->email->set_newline("\r\n");
									
									$this->email->from('matoke12@gmail.com', '4G EXPERIENCE');
									$this->email->to($user);
									
									$this->email->subject('Financial Management  System: User Password ');
									$this->email->message('Dear, : ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' Please use
									your email ' . $this->input->post('confirm_usr_email') . ' and Password ' .$ran_password. ' to login into FMS system, you are recomended to change your password
									after the first login, Thanks!');
									
									$email = $this->email->send();
									
								if($email) {
								$password = sha1($ran_password);
								
								} else {
										show_error($this->email->print_debugger());
										exit();
									}
				        }
				$access_data = array('first_name' => $this->input->post('first_name'), 'middle_name' => $this->input->post('middle_name'), 
				'last_name' => $this->input->post('last_name'), 'category' => $this->input->post('department'), 'username' => $this->input->post('usr_email'),
				 'password' => $password, 'access_lvl' => $this->input->post('permision'));
					
					if($this->input->post('action') == 'Update')
					{
						//$access = $this->input->post('permision');
						$id = $this->input->post('id');
						if($this->Admin_model->Update_user_access($access_data, $id))
						{
							$data['access'] = $this->Admin_model->update_result($id);
			
							$this->load->view('nav/top_nav');
							$this->load->view('common/login_header');
							$this->load->view('common/header');
							$this->load->view('Home_View');
							$this->load->view('Home/update_access_result', $data);
							$this->load->view('common/footer');
						}
					}
					else {
					if($this->Admin_model->access_lvl($access_data))
					{
						redirect('Admin/access_result');
					}
				}
			}
			
		}
	}
	
	public function  add_employees()
	{
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
			}
					
			$this->form_validation->set_rules('first_name','first name','required');
			$this->form_validation->set_rules('middle_name','middle name','required');
			$this->form_validation->set_rules('last_name','last name','required');
			$this->form_validation->set_rules('department','department','required');
			$this->form_validation->set_rules('usr_email','email address','required|valid_email');
			$this->form_validation->set_rules('phone_number','phone number','required');
			
			if($this->form_validation->run()==FALSE)
			{
				if($this->uri->segment(3))
				{
					$emp_id=$this->uri->segment(3);
					$emp_results['emp_id']=$this->Admin_model->edit_employees($emp_id);
				}
				else {
				$emp_results = '';
			}	
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('Home/add_employee', $emp_results);
				$this->load->view('common/footer');
			}
		else
		{
			$employees=array('user_id'=>$this->session->userdata('user_id'),'first_name'=>$this->input->post('first_name'),'middle_name'=>$this->input->post('middle_name'),
			'last_name'=>$this->input->post('last_name'),'department'=>$this->input->post('department'),'email'=>$this->input->post('usr_email'),
			'phone_number'=>$this->input->post('phone_number'));
			if($this->Admin_model->add_employees($employees))
			{
				redirect('Admin/employee_results');
			}
		
		}
	
	}
	
	public function employee_results()
	{
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}	
		$employee['result'] = $this->Admin_model->employee_results();
			
		$this->load->view('nav/top_nav');
		$this->load->view('common/login_header');
		$this->load->view('common/header');
		$this->load->view('Home_View');
		$this->load->view('Home/employee_results', $employee);
		$this->load->view('common/footer');
			
			
	}
	
	public function change_usr_pass()
	{
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$id = $this->uri->segment(3);
			//create random pass and send to email
			$ran_password = random_string('alnum', 8);
						
			$username = $this->Admin_model->fetch_user_email($id);
			foreach($username->result() as $email)
			{
				$user = $email->username;
			}
			$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://smtp.googlemail.com', 'smtp_port' => 465,
							'smtp_user' => 'matoke12@gmail.com', 'smtp_pass' => 'muyenjwa',
							'mailtype' => 'html', 'charset' => 'utf8', 'wordwrap' => TRUE);
												
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
									
			$this->email->from('matoke12@gmail.com', 'CICT');
			$this->email->to($user);
									
			$this->email->subject('Financial Management Information System: Updated User Password ');
			$this->email->message('Congrats, : ' . $this->input->post('first_name') . ' ' . $this->input->post('last_name') . ' Your updated
			 password is: ' .$ran_password. ' and you are recomended to change your password
				after the first login, Thanks!');
									
			$email = $this->email->send();
									
			if($email) {
				$password = sha1($ran_password);
								
			} else {
				show_error($this->email->print_debugger());
				exit();
			}
			
		if($this->Admin_model->update_user_password($id, $password))
		{	        
			$data['access'] = $this->Admin_model->update_result($id);
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/update_passwd_result', $data);
			$this->load->view('common/footer');
		}
	}
		
	public function manage_system_users()
	{
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
		$data['system_users'] = $this->Admin_model->manage_system_users();
			
		$this->load->view('nav/top_nav');
		$this->load->view('common/login_header');
		$this->load->view('common/header');
		$this->load->view('Home_View');
		$this->load->view('Home/manage_users', $data);
		$this->load->view('common/footer');
	}
	
		public function view_applications()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
				$config['base_url'] = base_url() . 'index.php/Admin/view_applications';
				
				$row = $this->Admin_model->count_application(0, 0);
				$config['total_rows'] = $row->num_rows();
				$config['per_page'] = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 3;;
				$config['num_links'] = 5;

				$config['full_tag_close'] = '</ul></div><!--pagination-->';
				$config['first_link'] = '&laquo; First';
				$config['first_tag_open'] = '<li class="prev page">';
				$config['first_tag_close'] = '</li>';
				$config['last_link'] = 'Last &raquo;';
				$config['last_tag_open'] = '<li class="next page">';
				$config['last_tag_close'] = '</li>';
				$config['next_link'] = 'Next &rarr;';
				$config['next_tag_open'] = '<li class="next page">';
				$config['next_tag_close'] = '</li>';
				$config['prev_link'] = '&larr; Prev';
				$config['prev_tag_open'] = '<li class="prev page">';
				$config['prev_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li class="page">';
				$config['num_tag_close'] = '</li>';
				// $config['display_pages'] = FALSE;
				// 
				$config['anchor_class'] = 'follow_link';

				
				
				$this->pagination->initialize($config);
				
			$job_title = ($this->input->post('jobtitle')) ? $this->input->post('jobtitle') : 0;
			$start = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
			if($this->input->post('department') != '')
				$department = $this->Admin_model->view_applications($config['per_page'], $start, $this->input->post('department'));
			else
				$department = $this->Admin_model->view_applications($config['per_page'], $start, 0);
			
			$data = array('query' => $department,
					'job_title' => $this->Admin_model->view_job_by_title());
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/view_applications', $data);
			$this->load->view('common/footer');
		}
		
		public function worker_shortlist()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			/*$this->form_validation->set_rules('usr_email', 'user email', 'required|valid_email|is_unique[user.user_email]|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('confirm_usr_email', 'confirm_user email', 'required|valid_email|matches[usr_email]|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('permision', 'permision', 'required|min_length[1]|max_length[125]');*/
				
				$user_exists = $this->Admin_model->worker_exists($this->input->post('usr_email'));
				if($user_exists->num_rows() > 0)
				{
					foreach($user_exists->result() as $worker)
					{
						$user = $worker->user_id;
					}
					$worker_assigned = $this->Admin_model->assigned($user);
					if($worker_assigned->num_rows() > 0)
					{
						$this->Admin_model->forwarded_to_dept($this->input->post('id'));
						
						redirect('Admin/worker_shortlist_result');
						exit();
					}
					else {
						$data = array('user_id' => $user, 'dep_id' => $this->input->post('id'), 'full_name' => $this->input->post('full_name'));
						
						$this->Admin_model->worker_shortlist($data);
						
						$this->Admin_model->forwarded_to_dept($this->input->post('id'));
						
						redirect('Admin/worker_shortlist_result');
					}
				}
				else {		
				$access_data = array('user_email' => $this->input->post('usr_email'), 'user_password' => sha1('SUAPASSWORD'), 'access_level' => 2);
				if($this->Admin_model->access_lvl($access_data))
					{
						$result = $this->Admin_model->access_result();
						if($result->num_rows() > 0)
						{
							foreach($result->result() as $user) {
								$user = $user->user_id;
							}
						}
						$data = array('user_id' => $user, 'dep_id' => $this->input->post('id'), 'full_name' => $this->input->post('full_name'));
						
						$this->Admin_model->worker_shortlist($data);
						
						$this->Admin_model->forwarded_to_dept($this->input->post('id'));
						
						redirect('Admin/worker_shortlist_result');
					}
			}
			
		}
	
		public function worker_shortlist_result()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$data['result'] = $this->Admin_model->access_result();
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/worker_shortlist', $data);
			$this->load->view('common/footer');
		}
			
		
		public function short_listed()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3) and $this->uri->segment(4))
			{
				$this->Admin_model->unshortlist($this->uri->segment(3), $this->uri->segment(4));
			}	
			$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title());
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/short_listed', $data);
			$this->load->view('common/footer');
		}
		
		public function interview()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
				$this->form_validation->set_rules('interview_date', 'date', 'required|min_length[1]|max_length[125]');
				$this->form_validation->set_rules('location', 'location', 'required|min_length[1]|max_length[125]');
				$this->form_validation->set_rules('description', 'description', 'required|min_length[1]|max_length[325]');
				
				if($this->form_validation->run() == FALSE)
				{
					if($this->input->post('action') == 'Update') {
						$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title(),
						'update_error' => '');
					} else {
					$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title());
					}
					$this->load->view('nav/top_nav');
					$this->load->view('common/login_header');
					$this->load->view('common/header');
					$this->load->view('Home_View');
					$this->load->view('Home/short_listed', $data);
					$this->load->view('common/footer');
					
				}
				else {
					$data = array('interview_date' => $this->input->post('interview_date'), 'location' => $this->input->post('location'),
						'description' => $this->input->post('description'));
						
						if($this->input->post('action') == 'Update')
						{
							$id = $this->input->post('id');
							if($this->Admin_model->update_interview($data, $id))
							{
								$data = array('update_success' => '', 'confirm_interview' => $this->Admin_model->fetch_interview());
								$this->load->view('nav/top_nav');
								$this->load->view('common/login_header');
								$this->load->view('common/header');
								$this->load->view('Home_View');
								$this->load->view('Home/interview', $data);
								$this->load->view('common/footer');
							}
						}
						else 
						{
						if($this->Admin_model->insert_interview($data))
						{
							$candidate = $this->Admin_model->fetch_shortlisted();
							if($candidate->num_rows() > 0)
							{
								$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://smtp.googlemail.com', 'smtp_port' => 465,
												'smtp_user' => 'matoke12@gmail.com', 'smtp_pass' => 'muyenjwa',
												'mailtype' => 'html', 'charset' => 'utf8', 'wordwrap' => TRUE);
												
								$this->load->library('email', $config);
								$this->email->set_newline("\r\n");
							
								foreach($candidate->result() as $shortlisted)
								{
									$info_id = $this->Admin_model->fetch_interview();
									foreach($info_id->result() as $info)
									{
										$last_id = $info->info_id;
										$date = $info->interview_date;
										$location = $info->location;
										$description = $info->description;
									}
									
									$this->email->from('matoke12@gmail.com', 'CICT');
									$this->email->to($shortlisted->user_email);
									
									$this->email->subject('Center for Information & Communication Technology: Call for Interview on ');
									$this->email->message('Date of Interview is: ' . $date . ' at ' . $location . ' ' . $description);
									
									$email = $this->email->send();
									
									$this->Admin_model->save_candidates(array('user_id' => $shortlisted->user_id, 'job_id' => $shortlisted->job_id,
									'info_id' => $last_id, 'date_called' => date('Y-m-d'), 'called_by' => $this->session->userdata('user_email')));
								}
								if($email) {
								$this->Admin_model->update_user_application();
								} else {
										show_error($this->email->print_debugger());
										exit();
									}
							}
							else {
								$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title(),
									'listed_error' => '');
			
								$this->load->view('nav/top_nav');
								$this->load->view('common/login_header');
								$this->load->view('common/header');
								$this->load->view('Home_View');
								$this->load->view('Home/short_listed', $data);
								$this->load->view('common/footer');
							}
								
							redirect('Admin/interview_result');
						}
					}
				}
			}
			
		public function interview_result()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3)) {
				if($this->Admin_model->fetch_interview())
				{
					$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title(),
									'change_interview' => $this->Admin_model->fetch_interview());
				}
			} else {
			$data = array('listed' => $this->Admin_model->short_listed(), 'job_title' => $this->Admin_model->view_job_by_title(),
									'confirm_interview' => $this->Admin_model->fetch_interview());
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/short_listed', $data);
			$this->load->view('common/footer');
		}
		
		public function all_interview()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$data = array('confirm_interview' => $this->Admin_model->fetch_all_interview());
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/interview', $data);
			$this->load->view('common/footer');
		}
		
		public function retrieve_job_department()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
			}
			
			$job_title = $this->input->post('department');
			 $data['job_title'] = $this->Admin_model->retrieve_job_by_title($job_title);
			 
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/view_applications', $data);
			$this->load->view('common/footer');
		}
		
		public function access_result()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$data['access'] = $this->Admin_model->access_result();
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/user_access', $data);
			$this->load->view('common/footer');
		}
			
		public function create_job()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$job_id = $this->uri->segment(3);
				$categories = array('query' => $this->Admin_model->admin_job_edit($job_id), 'category' => $this->Admin_model->get_categories());
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('Home/create', $categories);
				$this->load->view('common/footer');
			}
			else
			{
			$this->form_validation->set_rules('title', 'job title', 'required|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('job_desc', 'job description', 'required|min_length[1]|max_length[3000]');
			$this->form_validation->set_rules('dep_id', 'category', 'required|min_length[1]|max_length[11]');
			$this->form_validation->set_rules('type_id', 'job type', 'required|min_length[1]|max_length[11]');
			$this->form_validation->set_rules('loc_id', 'location', 'required|min_length[1]|max_length[11]');
			$this->form_validation->set_rules('job_name', 'job name/company', 'required|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('job_email', 'email', 'required|valid_email|xss_clean|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('job_phone', 'phone', 'required|min_length[1]|max_length[125]');
			$this->form_validation->set_rules('sunset_date', 'sunset date', 'required|min_length[1]|max_length[11]');
			
			
			$categories['category'] = $this->Admin_model->get_categories();
			
			if($this->form_validation->run() == FALSE)
			{
				if($this->input->post('action') == 'Update')
				{
					$categories = array('category' => $this->Admin_model->get_categories(), 'update_error' => '');
				}
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('Home/create', $categories);
				$this->load->view('common/footer');
			}
			else
			{
				$createdby = $this->session->userdata('user_id');
				$job_data = array('dep_id' => $this->input->post('dep_id'), 'job_title' => $this->input->post('title'), 'job_desc' => $this->input->post('job_desc'),
					'job_type' => $this->input->post('type_id'), 'location' => $this->input->post('loc_id'),
					'job_name' => $this->input->post('job_name'), 'job_email' => $this->input->post('job_email'), 'job_phone' => $this->input->post('job_phone'),
					'sunset_date' => $this->input->post('sunset_date'), 'created_by' => $createdby, 'posted_date' => date('Y-m-d H:i:s a'));
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$job_id = $this->input->post('id');
						$this->Admin_model->update_job($job_data, $job_id);
						
						redirect('Home');
					}
					else 
					{
					if($this->Admin_model->job_details($job_data))
					{
						
						$candidate = $this->Job_Model->Home_alert();
							if($candidate->num_rows() > 0)
							{
								$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://smtp.googlemail.com', 'smtp_port' => 465,
												'smtp_user' => 'matoke12@gmail.com', 'smtp_pass' => 'muyenjwa',
												'mailtype' => 'html', 'charset' => 'utf8', 'wordwrap' => TRUE);
												
								$this->load->library('email', $config);
								$this->email->set_newline("\r\n");
							
								foreach($candidate->result() as $alert)
								{	
									$this->email->from('matoke12@gmail.com', 'SUA');
									$this->email->to($alert->alert_email);
									
									$this->email->subject('Job Alert matching your interest ');
									$this->email->message($alert->job_desc);
									
									$email = $this->email->send();
								}
								if(!$email) {
										show_error($this->email->print_debugger());
										exit();
									}
						}
						redirect('Admin/job_edit');
					}
				}
			}
		}
	}


		public function cover_letter($user_id)
		{
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/other_attachment');
			$this->load->view('common/footer');
		}
		public function job_edit()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$user_id = $this->session->userdata('user_id');
			
			
			$categories = array('query' => $this->Admin_model->job_edit($user_id), 'category' => $this->Admin_model->get_categories());
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/create', $categories);
			$this->load->view('common/footer');
			
		}
		
		public function delete_job()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Admin_model->delete_job($id);
				
				redirect('Admin/job_result');
				exit();
			}
		}
		
		public function view_reg_users()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 10;
			
			$view_users['query'] = $this->Admin_model->view_reg_users($limit);
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/view_reg_users', $view_users);
			$this->load->view('common/footer');
		}
		
		public function job_result()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 3;
			
			$job_results['query'] = $this->Admin_model->job_result($limit);
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/view_job', $job_results);
			$this->load->view('common/footer');
		}
			
	}
