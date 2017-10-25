	<?php
	if(! defined('BASEPATH')) exit('Requested script is not available');
	
	class Home extends CI_Controller
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
			$this->load->library('pagination');
			$this->load->model('Image_model');
			$this->load->model('Admin_model');
			$this->load->model('Device_model');
			//$this->load->controler('Image');
			//loading the pdf library
			$this->load->library("Pdf");
		}
		public function index()
		{
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('auto/header');
			$this->load->view('common/login');
			$this->load->view('common/footer');
		}
		
		public function pdf()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$data = [];
			//load the view and saved it into $html variable
			$job_results = array('cv' => $this->Job_Model->view_cv($this->session->userdata('user_id')), 'cv_work' => 
			$this->Job_Model->view_cv_work($this->session->userdata('user_id')), 'cv_train' => $this->Job_Model->view_cv_train($this->session->userdata('user_id')),
				'cv_ref' => $this->Job_Model->view_cv_ref($this->session->userdata('user_id')));
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$html = $this->load->view('cv/viewCV', $job_results, true);
			$this->load->view('common/footer');
	 
			//this the the PDF filename that user will get to download
			$pdfFilePath = "output_pdf_name.pdf";
	 
			//load mPDF library
			$this->load->library('m_pdf');
	 
		   //generate the PDF from the given html
			$this->m_pdf->pdf->WriteHTML($html);
	 
			//download it.
			$this->m_pdf->pdf->Output($pdfFilePath, "D");        
		}
		
		public function income_report()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$user_id = $this->session->userdata('user_id');
			/*$user_info = $this->Job_Model->user_info_exist($user_id);
			if($user_info->num_rows() > 0 )
			{
			$data = array('cv' => $this->Job_Model->income_report($this->session->userdata('user_id')), 'cv_work' => 
			$this->Job_Model->view_cv_work($this->session->userdata('user_id')), 'cv_train' => $this->Job_Model->view_cv_train($this->session->userdata('user_id')),
				'cv_ref' => $this->Job_Model->view_cv_ref($this->session->userdata('user_id')));
			} else {
				$data['cv_error'] = '';
			}*/
			
			$data = array('cv' => $this->Job_Model->income_report($this->session->userdata('user_id')));
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('reports/income_report', $data);
			$this->load->view('common/footer');
			
		}
		
		public function job_alert()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$this->form_validation->set_rules('dep_id', 'category', 'required|min_length[1]|max_length[11]');
			$this->form_validation->set_rules('job_email', 'email', 'required|valid_email|xss_clean|min_length[1]|max_length[125]');
			
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
				$this->load->view('Home/job_alert', $categories);
				$this->load->view('common/footer');
			}
			else
			{
				$createdby = $this->session->userdata('user_id');
				$job_alert = array('alert_email' => $this->input->post('job_email'), 'user_id' => $createdby, 'dep_id' => $this->input->post('dep_id'));
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$alert_id = $this->input->post('id');
						$this->Job_Model->update_alert($job_alert, $alert_id);
						
						redirect('Home/job_alert');
					}
					else 
					{
					if($this->Job_Model->alert_details($job_alert))
					{
						redirect('Home/alert_edit');
					}
				}
			}
			
		}
	
		
		public function alert_edit()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$user_id = $this->session->userdata('user_id');
			
			
			$categories = array('query' => $this->Job_Model->alert_edit($user_id), 'category' => $this->Admin_model->get_categories());
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/job_alert', $categories);
			$this->load->view('common/footer');
			
		}
		
		public function myApplication()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 5;
			
			$result = $this->Job_Model->call_interview($this->session->userdata('user_id'));
			if($result->num_rows() > 0)
			{
				$data = array('application' => $this->Job_Model->user_application($limit, $this->session->userdata('user_id')),
					'call_interview' => $result);
			}
			else {
				$data['application'] = $this->Job_Model->user_application($limit, $this->session->userdata('user_id'));
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('Home/viewMyapplication', $data);
			$this->load->view('common/footer');
		}
			
		public function viewcertificate()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$this->load->helper('download');
			
			if($this->uri->segment(3) and $this->uri->segment(4))
			{
				$file = base_url('upload/'. $this->uri->segment(3) . '/' . $this->uri->segment(4));
				$data = file_get_contents($file);
			}
			
			$name = $this->uri->segment(4);
			force_download($name, $data);
		}
		
		public function application()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			
			if($this->uri->segment(3) || $this->input->post('submit') == 'Send')
			{
				if($this->input->post('submit') == 'Send') {
					
				$upload_dir = "/var/www/html/shop/upload/";
		
				do {
					$code = random_string('alnum', 8);
					$dirs = scandir($upload_dir);
			
					if(in_array($code, $dirs)) { // Yes there is
					$img_dir_name = false; // Set to false to begin again
			
					} else { // No there isn't
						$img_dir_name = $code; // This is a new name
					}
					} while ($img_dir_name == false);
			
					if(!mkdir($upload_dir.$img_dir_name))
					{
				
						$page_data = array('fail' => $this->lang->line('encode_upload_mkdir_error'), 'success' => false);
				
						$this->load->view('common/header');
						$this->load->view('nav/top_nav');
						$this->load->view('Home_View', $page_data);
						$this->load->view('common/footer');
					}
			
					$config['upload_path'] = $upload_dir.$img_dir_name;
					$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|docx';
					$config['max_size'] = '1000000';
					$config['max_width'] = '10246';
					$config['max_height'] = '7687';
					
					$this->load->library('upload', $config);
			
					if ( ! $this->upload->do_upload()) {
						
						$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 7;
						$page_data = array('fail' => $this->upload->display_errors(), 
							'query' => $this->Job_Model->job_results($limit));
						
						
					}
			
					else {
						$image_data = $this->upload->data();
					
						$user_id = $this->session->userdata('user_id');
						$job_id = $this->input->post('id');
					$page_data['result'] = $this->Image_model->save_letter(array('user_id' => $user_id, 'job_id' => $job_id, 'user_letter' => $image_data['file_name'],
												'letter_dir_name' => $img_dir_name));
					}
				}
				
				$user_id = $this->session->userdata('user_id');
				$job_id = $this->input->post('id');
				$user_info = $this->Job_Model->user_info_exist($user_id);
				if($user_info->num_rows() > 0 )
				{
					//some code for cover letter
					$user_letter = $this->Image_model->user_letter($user_id, $job_id);
					if($user_letter->num_rows() > 0)
					{
						foreach($user_letter->result() as $letter)
						{
							$cover_letter = $letter->user_letter;
						}
					
					$app_data = array('user_id' => $user_id, 'job_id' => $this->input->post('id'), 'dep_id' => $this->input->post('dep_id'), 'cover_letter' => $cover_letter, 'applied_date' => date('Y-m-d H:i:s'));
						
					if($this->Job_Model->application_data($app_data))
					{
						redirect('Home/index');
					}
				}
					else {
						//get cover letter and insert into table cover letter
						//$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 7;
						$user_id = $this->session->userdata('user_id');
						$job_post = array('cover_letter' => $this->Admin_model->job_position($user_id, $this->uri->segment(3)));
						$this->load->view('nav/top_nav');
						$this->load->view('common/login_header');
						$this->load->view('common/header');
						$this->load->view('Home/cover_letter', $job_post);
						$this->load->view('common/footer');
					}
				}
				else
				{
					$limit = ($this->input->post('limit') != '') ? trim($this->input->post('limit')) : 7;
					
					$info_error = array('error' => '', 'query' => $this->Job_Model->job_results($limit));
					$this->load->view('nav/top_nav');
					$this->load->view('common/login_header');
					$this->load->view('common/header');
					$this->load->view('Home/job_home_view', $info_error);
					$this->load->view('common/footer');
				}
			}
		}
		
		public function do_upload()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
		$upload_dir = "/var/www/html/shop/upload/";
		
		do {
			$code = random_string('alnum', 8);
			
			// Scan upload dir for subdir with same name as the code
			$dirs = scandir($upload_dir);
			
			//Look to see if there is already a directory with the name which we store in $code
			
			if(in_array($code, $dirs)) { // Yes there is
			$img_dir_name = false; // Set to false to begin again
			
			} else { // No there isn't
						$img_dir_name = $code; // This is a new name
					}
			} while ($img_dir_name == false);
			
			if(!mkdir($upload_dir.$img_dir_name))
			{
				
				$page_data = array('fail' => $this->lang->line('encode_upload_mkdir_error'), 'success' => false);
				
				$this->load->view('common/header');
				$this->load->view('nav/top_nav');
				$this->load->view('Home_View', $page_data);
				$this->load->view('common/footer');
			}
			
			$config['upload_path'] = $upload_dir.$img_dir_name;
			$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$config['max_size'] = '1000000';
			$config['max_width'] = '10246';
			$config['max_height'] = '7687';
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload()) {
				
				$page_data = array('fail' => $this->upload->display_errors(), 'success' => false);
				
				$this->load->view('common/header');
				$this->load->view('nav/top_nav');
				$this->load->view('Home_View');
				$this->load->view('common/dashboard', $page_data);
				$this->load->view('common/footer');
			}
			
			else {
					$image_data = $this->upload->data();
					
					$user_id = $this->session->userdata('user_id');
					
					$result  = $this->Image_model->user_img_exist($user_id);
					
					if($result->num_rows() > 0)
					{
						$update_data = array('img_name' => $image_data['file_name'],
												'img_dir_name' => $img_dir_name);
						if($this->Image_model->update_image($update_data, $user_id))
						redirect('Home/dashboard');
					}
					else
					{
						$user_id = $this->session->userdata('user_id');
					
					$page_data['result'] = $this->Image_model->save_image(array('user_id' => $user_id, 'img_name' => $image_data['file_name'],
												'img_dir_name' => $img_dir_name));

					$page_data['file_name'] = $image_data['file_name'];
					$page_data['img_dir_name'] = $img_dir_name;
					
						
			if ($page_data['result'] == false) {

					// fail - display image and link
					$page_data = array('fail' => $this->lang->line('encode_upload_general_error'));
					
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View');
					$this->load->view('common/dashboard', $page_data);
					$this->load->view('common/footer');
				}
				/*else {

					// success - display image and link
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View', $page_data);
					$this->load->view('common/footer');
				}*/
				else 
				{
					redirect('Home/dashboard');
					
			}
		}
	}
}
		
		public function financial()
		{
				
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') && $this->input->post('action') == 'Edit')
			{
				
				$id = $this->input->post('id');
				$edit_financial =  array('query' =>$this->Job_Model->financial_edit($id));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('common/header');
				$this->load->view('Home_View');
				$this->load->view('common/financial', $edit_financial);
				$this->load->view('common/footer');
				
			}
			else
			{
			
			/*$result = $this->Job_Model->user_exist($this->session->userdata('user_id'));
				if($result->num_rows() > 0 and ($this->input->post('action') != 'Update' and $this->uri->segment(2) != 'financial'))
				{
					redirect('Home/financial_result');
				}
				else
				{
					//$refresh = header('Refresh: 1; URL=financial');*/
			
			$this->form_validation->set_rules('fcategory', 'category', 'required');
			if($this->input->post('fcategory') == 'exp category')
			$this->form_validation->set_rules('exp', 'expenditure', 'required');
			if($this->input->post('fcategory') == 'income category')
			$this->form_validation->set_rules('income', 'income', 'required');
			if($this->input->post('exp') == 'other')
			$this->form_validation->set_rules('otherExp', 'other expenditure', 'required');
			$this->form_validation->set_rules('description', 'description', 'required');
			if($this->input->post('income') == 'other')
			$this->form_validation->set_rules('otherIncome', 'other income', 'required');
			if($this->input->post('income') == 'Payment of Debts' || $this->input->post('exp') == 'Loan grating')
			$this->form_validation->set_rules('staff', 'employee', 'required');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			if($this->input->post('fcategory') == 'income category')
			$this->form_validation->set_rules('payer', 'payer', 'required');
			if($this->input->post('fcategory') == 'exp category')
			$this->form_validation->set_rules('payee', 'payee', 'required');
			$this->form_validation->set_rules('receipt', 'receipt or invoice', 'required');
	
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				//$id = $this->input->post('id');
				$edit_financial['update_error'] = '';
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial', $edit_financial);
				$this->load->view('common/footer');
			}
			else
			{
				
			if($this->form_validation->run() == FALSE)
			{	$data =  array('emp_data' => $this->Job_Model->select_all_employees());
				$this->load->view('common/header');
				$this->load->view('nav/top_nav');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial', $data);
				$this->load->view('common/footer');
			}
			else
			{
				//income
				 if($this->input->post('fcategory') == 'income category') {
				$user_id = $this->session->userdata('user_id');
				$financial_data = array('iemployee_id' => $this->input->post('staff'),'income_name' => $this->input->post('income'),
					'otherIncome' => $this->input->post('otherIncome'), 'idescription' => $this->input->post('description'), 'iamount' => $this->input->post('amount'),
					'payer' => $this->input->post('payer'), 'ireceipt_no' => $this->input->post('receipt'),
					'irecord_date' => date('Y-m-d H:i:s'), 'iregistered_by' => $this->session->userdata('first_name').', '.$this->session->userdata('last_name'));
				} else
				{
					//expenditure
					$user_id = $this->session->userdata('user_id');
					$financial_data = array('employee_id' => $this->input->post('staff'),'exp_name' => $this->input->post('exp'),
					'otherExp' => $this->input->post('otherExp'), 'description' => $this->input->post('description'), 'amount' => $this->input->post('amount'),
					'payee' => $this->input->post('payee'), 'receipt_no' => $this->input->post('receipt'),
					'record_date' => date('Y-m-d H:i:s'), 'eregistered_by' => $this->session->userdata('first_name').', '.$this->session->userdata('last_name'));
				}
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$record_id = $this->input->post('id');
						$fcategory = $this->input->post('fcategory');
						if($this->Job_Model->financial_update($financial_data, $record_id, $fcategory))
						{
							$data['message_success'] = '';
							$this->session->set_flashdata('update_financial', 'The financial information is successfully updated');
							redirect('Home/financial_result', $data);
				
						}
					}
					else
					{
					$financial_id = $this->input->post('fcategory');
					
					
					if($this->Job_Model->financial($financial_data, $financial_id))
						{
							$get_income = $this->Job_Model->last_income($financial_id);
							foreach($get_income->result() as $income)
							{
								if($financial_id == 'income category')
								$last_id = $income->income_id;
								else
								$last_id = $income->exp_id;
							}
							$user_id = $this->session->userdata('user_id');
							if($financial_id == 'income category')
							$record_income = array('user_id' => $user_id, 'income_id' => $last_id, 'exp_id' => '', 'fcategory' => $financial_id);
							else
							$record_income = array('user_id' => $user_id, 'income_id' => '', 'exp_id' => $last_id, 'fcategory' => $financial_id);
							$this->Job_Model->record_income($record_income);
							
							$data['message_success'] = '';
							$this->session->set_flashdata('financial_add', 'You have created new financial record which is not yet confirmed');
							redirect('Home/financial_result', $data);
						
						}
					}
				}
			}
		}
	
	}
	

		public function referee()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$edit_training['query'] = $this->Job_Model->referee_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/referees', $edit_training);
				$this->load->view('common/footer');
			}
			else
			{
			$this->form_validation->set_rules('r_name', 'Full name', 'required');
			$this->form_validation->set_rules('r_title', 'title', 'required');
			$this->form_validation->set_rules('r_institution', 'title', 'required');
			$this->form_validation->set_rules('r_address', 'address', 'required');
			$this->form_validation->set_rules('r_mobile', 'mobile', 'required');
			$this->form_validation->set_rules('r_email', 'email', 'required|valid_email');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				$id = $this->input->post('id');
				$edit_referee['query'] = $this->Job_Model->referee_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/referees', $edit_referee);
				$this->load->view('common/footer');
			}
			else
			{
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/referees');
				$this->load->view('common/footer');
			}
			else
			{
				$user_id = $this->session->userdata('user_id');
				$referee_data = array('user_id' => $user_id, 'r_name' => $this->input->post('r_name'), 'r_title' => $this->input->post('r_title'),
					'r_institution' => $this->input->post('r_institution'), 'r_address' => $this->input->post('r_address'),
					'r_mobile' => $this->input->post('r_mobile'), 'r_email' => $this->input->post('r_email'));
				
				if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$r_id = $this->input->post('id');
						if($this->Job_Model->referee_update($referee_data, $r_id))
						{
							$data['message_success'] = '';
						
							redirect('Home/referee_result', $data);
				
						}
					}	
				else
				{
				if($this->Job_Model->referee($referee_data))
				{
					$data['message_success'] = '';
						
					redirect('Home/referee_result', $data);
					
				}	
			}
			}
		}
	}
}	
		public function training()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$edit_training['query'] = $this->Job_Model->training_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/training', $edit_training);
				$this->load->view('common/footer');
			}
			else
			{
			$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('institution', 'institution', 'required');
			$this->form_validation->set_rules('start_date', 'start date', 'required');
			$this->form_validation->set_rules('end_date', 'end date', 'required');
			$this->form_validation->set_rules('supervisor', 'supervisor', 'required');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				
				$edit_property['update_error'] = '';
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/training', $training_property);
				$this->load->view('common/footer');
			}
			else
			{
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/training');
				$this->load->view('common/footer');
			}
			else
			{
				$user_id = $this->session->userdata('user_id');
				$training_data = array('user_id' => $user_id, 'description' => $this->input->post('description'),
					't_institution' => $this->input->post('institution'), 'supervisor_address' => $this->input->post('supervisor'),
					'start_date' => $this->input->post('start_date'), 'end_date' => $this->input->post('end_date'));
				
				if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$training_id = $this->input->post('id');
						if($this->Job_Model->training_update($training_data, $training_id))
						{
							$data['message_success'] = '';
						
							redirect('Home/training_result', $data);
				
						}
					}	
				else
				{
					
				if($this->Job_Model->training($training_data))
				{
					$data['message_success'] = '';
						
					redirect('Home/training_result', $data);
					
				}	
				}
			}
		}
	}
}
		
		public function experience()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$edit_experience['query'] = $this->Job_Model->experience_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/work', $edit_experience);
				$this->load->view('common/footer');
			}
			else
			{
			$this->form_validation->set_rules('job_title', 'job tile', 'required');
			$this->form_validation->set_rules('supervisor_name', 'supervisor\'s name', 'required');
			$this->form_validation->set_rules('supervisor_mobile', 'supervisor\'s mobile', 'required');
			$this->form_validation->set_rules('supervisor_address', 'supervisor\'s address', 'required');
			$this->form_validation->set_rules('duties', 'duties', 'required');
			$this->form_validation->set_rules('institution', 'institution', 'required');
			$this->form_validation->set_rules('start_date', 'start date', 'required');
			$this->form_validation->set_rules('end_date', 'end date', 'required');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				$id = $this->input->post('id');
				$edit_property['query'] = $this->Job_Model->experience_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/experience', $edit_property);
				$this->load->view('common/footer');
			}
			else
			{
				
			if($this->form_validation->run() == FALSE)
			{
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/work');
				$this->load->view('common/footer');
			}
			else
			{
				$user_id = $this->session->userdata('user_id');
				$experience_data = array('user_id' => $user_id, 'institution' => $this->input->post('institution'),
					'job_title' => $this->input->post('job_title'), 'sup_name' => $this->input->post('supervisor_name'),
					'duties' => $this->input->post('duties'), 'sup_mobile'  => $this->input->post('supervisor_mobile'),
					'sup_address' => $this->input->post('supervisor_address'), 'start_date' => $this->input->post('start_date'),
					'end_date' => $this->input->post('end_date'));
					
				if($this->input->post('action') and $this->input->post('action') == 'Update')
				{
					$w_id = $this->input->post('id');
					if($this->Job_Model->experience_update($experience_data, $w_id))
					{
						$data['message_success'] = '';
						
						redirect('Home/experience_result', $data);
				
					}
				}	
				else
				{	
					if($this->Job_Model->experience($experience_data))
					{
						$data['message_success'] = '';
						
					redirect('Home/experience_result', $data);
						
					}
				}	
			}	
		}		
	}
}

		
		public function property()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') && $this->input->post('action') == "Edit")
			{
				$id = $this->input->post('id');
				$edit_propertys['query'] = $this->Job_Model->property_edit($id);
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/property', $edit_propertys);
				$this->load->view('common/footer');
			}
			else
			{
				/*$result = $this->Job_Model->user_property_exist($this->session->userdata('user_id'));
				if($result->num_rows() > 0 and $this->input->post('action') != 'Update')
				{
					redirect('Home/property_result');
				}
			else
			{*/
			
			$this->form_validation->set_rules('itemName', 'item name', 'required');
			$this->form_validation->set_rules('p_invetory', 'item category', 'required');
			$this->form_validation->set_rules('itemValue', 'item value', 'required');
			$this->form_validation->set_rules('wstatus', 'working status');
			$this->form_validation->set_rules('location', 'location', 'required');
			$this->form_validation->set_rules('department', 'department', 'required');
			$this->form_validation->set_rules('custodian', 'custodian', 'required');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				
				$edit_property['update_error'] = '';
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/property', $edit_property);
				$this->load->view('common/footer');
			}
			else
			{
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/property');
				$this->load->view('common/footer');
			}
			else {
				$user_id = $this->session->userdata('user_id');
				$property_data = array('user_id' => $user_id, 'item_name' => $this->input->post('itemName'),
					'item_category' => $this->input->post('p_invetory'), 'work_status' => $this->input->post('wstatus'),
					'item_value' => $this->input->post('itemValue'), 'location' => $this->input->post('location'),
					'department' => $this->input->post('department'), 'custodian' => $this->input->post('custodian'),
					'date' =>DATE_FORMAT(date, '%d-%m-%y'), 'registered_by' =>$this->session->userdata('first_name').', '.$this->session->userdata('last_name'));
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$property_id = $this->input->post('id');
						if($this->Job_Model->property_update($property_data, $property_id))
						{
							$data['message_success'] = '';
							$this->session->set_flashdata('property_update', 'The property information is successfully updated');
							redirect('Home/property_result', $data);
				
						}
					}
					else
					{
					if($this->Job_Model->property($property_data))
						{
							$data['message_success'] = '';
							$this->session->set_flashdata('property', 'New property is registered but not yet confirmed');
							redirect('Home/property_result', $data);
						
						}
					}
				}
			}
		}
	}


		public function delete_financial()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->financial_delete($id);
				
				redirect('Home/view_frecords');
				exit();
			}
		}
		
		public function confirm_financial()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->financial_confirm($id);
				$this->session->set_flashdata('confirm_financial', 'You have successfully registered new financial record');
				redirect('Home/financial_result');
				exit();
			}
		}
		
		public function confirm_property()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->property_confirm($id);
				$this->session->set_flashdata('property_confirm', 'You have successfully registered the property');
				redirect('Home/property_result');
				exit();
			}
		}
		
		public function delete_experience()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->experience_delete($id);
				
				redirect('Home/experience_result');
				exit();
			}
		}
		
		public function delete_referee()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->referee_delete($id);
				
				redirect('Home/referee_result');
				exit();
			}
		}
		
		public function delete_training()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->training_delete($id);
				
				redirect('Home/training_result');
				exit();
			}
		}
		
		public function delete_attachment()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$this->Job_Model->attachment_delete($id);
				
				redirect('Home/attachment_result');
				exit();
			}
		}
		
		public function other_attachment()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$attachment['query'] = $this->Job_Model->attachment_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/other_attachment', $attachment);
				$this->load->view('common/footer');
			}
			else
			{
			
			$this->form_validation->set_rules('files', 'attachment for', 'required');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				$id = $this->input->post('id');
				
				$attachment['update_error'] = $this->Job_Model->attachment_edit($id, $this->session->userdata('user_id'));
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/other_attachment', $attachment);
				$this->load->view('common/footer');
			}
			else
			{
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/other_attachment');
				$this->load->view('common/footer');
			}
			else
			{
			
			$upload_dir = "/var/www/html/shop/upload/";
		
		do {
			$code = random_string('alnum', 8);
			
			// Scan upload dir for subdir with same name as the code
			$dirs = scandir($upload_dir);
			
			//Look to see if there is already a directory with the name which we store in $code
			
			if(in_array($code, $dirs)) { // Yes there is
			$img_dir_name = false; // Set to false to begin again
			
			} else { // No there isn't
						$img_dir_name = $code; // This is a new name
					}
			} while ($img_dir_name == false);
			
			if(!mkdir($upload_dir.$img_dir_name))
			{
				
				$page_data = array('fail' => $this->lang->line('encode_upload_mkdir_error'), 'success' => false);
				
					$this->load->view('common/login_header');
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View', $page_data);
					$this->load->view('common/footer');
			}
			
			$config['upload_path'] = $upload_dir.$img_dir_name;
			$config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|odt|docx';
			$config['max_size'] = '1000000';
			$config['max_width'] = '10246';
			$config['max_height'] = '7687';
			
			$this->load->library('upload', $config);
			
			
			$check = ($this->input->post('action') and $this->input->post('action') == 'Update') ?
						$this->input->post('file') == 'other' : $this->input->post('submit') and $this->input->post('submit') == 'Upload';
			
			if ( ! $this->upload->do_upload() and $check ) {
				
				$page_data = array('fail' => $this->upload->display_errors(), 'success' => false, 'update_error' => '');
				
				if($this->input->post('action') and $this->input->post('action') == 'Update')
				{
					$id = $this->input->post('id');
					$page_data = array('fail' => $this->upload->display_errors(), 'success' => false, 'update_error' => 
						$this->Job_Model->attachment_edit($id, $this->session->userdata('user_id')));
				}	
				else {
					$page_data = array('fail' => $this->upload->display_errors(), 'success' => false);
				}
					$this->load->view('common/login_header');
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View');
					$this->load->view('common/other_attachment', $page_data);
					$this->load->view('common/footer');
			}
			
			else {
					$image_data = $this->upload->data();
					
					$user_id = $this->session->userdata('user_id');
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$id = $this->input->post('id');
						
						if($this->input->post('file') != 'other')
						{
							$result = $this->Job_Model->attachment_edit($id, $this->session->userdata('user_id'));
							foreach($result->result() as $row)
							{
								$image_data['file_name'] = $row->attach_name;
								$img_dir_name = $row->attach_dir_name;
							}
						}
							
						$page_data['result'] = $this->Image_model->update_attachment(array('user_id' => $user_id, 'attachment_for' => $this->input->post('files'),
									'attach_name' => $image_data['file_name'], 'attach_dir_name' => $img_dir_name), $id);
					}
					else
					{
					$page_data['result'] = $this->Image_model->other_attachment(array('user_id' => $user_id, 'attachment_for' => $this->input->post('files'),
									'attach_name' => $image_data['file_name'], 'attach_dir_name' => $img_dir_name));
					}
					$page_data['file_name'] = $image_data['file_name'];
					$page_data['img_dir_name'] = $img_dir_name;
					
						
			if ($page_data['result'] == false) {

					// fail - display image and link
					$page_data = array('fail' => $this->lang->line('encode_upload_general_error'));
					
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View');
					$this->load->view('common/other_attachment', $page_data);
					$this->load->view('common/footer');
				}
				/*else {

					// success - display image and link
					$this->load->view('common/header');
					$this->load->view('nav/top_nav');
					$this->load->view('Home_View', $page_data);
					$this->load->view('common/footer');
				}*/
				else 
				{
					redirect('Home/attachment_result');
				}	
			}
		}
	}
}
}		

		
		public function qualification()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			if($this->uri->segment(3))
			{
				$id = $this->uri->segment(3);
				$edit_academic['query'] = $this->Job_Model->acc_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/qualification', $edit_academic);
				$this->load->view('common/footer');
			}
			else
			{
				
			$this->form_validation->set_rules('level_edu', 'level of education', 'required');
			$this->form_validation->set_rules('institute', 'institute name', 'required');
			if($this->input->post('institute') == 'other')
			$this->form_validation->set_rules('institute_mention', 'mention institute name', 'required');
			else
			$this->form_validation->set_rules('institute_mention', 'mention institute name');
			$this->form_validation->set_rules('course', 'course name', 'required');
			if($this->input->post('course') == 'other')
			$this->form_validation->set_rules('course_mention', 'mention course', 'required');
			else
			$this->form_validation->set_rules('course_mention', 'mention course');
			$this->form_validation->set_rules('country', 'country', 'required');
			if($this->input->post('country') == 'other')
			$this->form_validation->set_rules('country_mention', 'country_mention', 'required');
			else
			$this->form_validation->set_rules('country_mention', 'country_mention');
			$this->form_validation->set_rules('acc_time_start', 'start year', 'required');
			$this->form_validation->set_rules('acc_time_end', 'end year', 'required');
			if($this->input->post('level_edu') == 'ACSEE' || $this->input->post('level_edu') == 'CSEE')
			$this->form_validation->set_rules('index', 'index no.', 'required');
			else
			$this->form_validation->set_rules('index', 'index no.');
			
			if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->form_validation->run() == FALSE)
			{
				$id = $this->input->post('id');
				$edit_academic['update_error'] = $this->Job_Model->acc_edit($id, $this->session->userdata('user_id'));
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/qualification', $edit_academic);
				$this->load->view('common/footer');
			}
			else
			{	
				if($this->form_validation->run() == FALSE)
				{
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/qualification');
					$this->load->view('common/footer');
				}
			
			else
			{
					$upload_dir = "/var/www/html/shop/upload/";
		
						do {
							$code = random_string('alnum', 8);
							$dirs = scandir($upload_dir);
							if(in_array($code, $dirs)) { // Yes there is
							$img_dir_name = false; // Set to false to begin again
							} else { // No there isn't
										$img_dir_name = $code; // This is a new name
									}
							} while ($img_dir_name == false);
							
							if(!mkdir($upload_dir.$img_dir_name))
							{
				
								$page_data = array('fail' => $this->lang->line('encode_upload_mkdir_error'), 'success' => false);
								
								$this->load->view('common/login_header');
								$this->load->view('common/header');
								$this->load->view('nav/top_nav');
								$this->load->view('Home_View');
								$this->load->view('common/qualification', $page_data);
								$this->load->view('common/footer');
							}
			
								$config['upload_path'] = $upload_dir.$img_dir_name;
								$config['allowed_types'] = 'gif|jpg|jpeg|png';
								$config['max_size'] = '1000000';
								$config['max_width'] = '10246';
								$config['max_height'] = '7687';
			
								$this->load->library('upload', $config);
								
						$check = ($this->input->post('action') and $this->input->post('action') == 'Update') ?
								$this->input->post('file') == 'other' : $this->input->post('submit') and $this->input->post('submit') == 'Submit';
		
								
								if ( ! $this->upload->do_upload() and $check) {
									
									
									if($this->input->post('action') and $this->input->post('action') == 'Update')
									{
										$id = $this->input->post('id');
										$page_data = array('fail' => $this->upload->display_errors(), 'success' => false, 'update_error' => 
										$this->Job_Model->acc_edit($id, $this->session->userdata('user_id')));
										
									} else {
									$page_data = array('fail' => $this->upload->display_errors(), 'success' => false);
								}
					
									$this->load->view('common/login_header');
									$this->load->view('common/header');
									$this->load->view('nav/top_nav');
									$this->load->view('Home_View');
									$this->load->view('common/qualification', $page_data);
									$this->load->view('common/footer');
							}
								else {
										$image_data = $this->upload->data();
										
										//user do not want to update image but other info
										if($this->input->post('action') and $this->input->post('action') == 'Update' and $this->input->post('file') != 'other')
										{
											$id = $this->input->post('id');
											$result = $this->Job_Model->not_update_img($id);
											foreach($result->result() as $img)
											{
												$image_data['file_name'] = $img->cert_name;
												$img_dir_name = $img->cert_dir_name;
											}
										} 
											
							
				$user_id = $this->session->userdata('user_id');
				$qualification_data = array('user_id' => $user_id, 'edu_level' => $this->input->post('level_edu'), 'course' =>
					$this->input->post('course'), 'course_mention' => $this->input->post('course_mention'), 'country' => $this->input->post('country'),
					'country_mention' => $this->input->post('country_mention'), 'institute' => $this->input->post('institute'),
					'institute_mention' => $this->input->post('institute_mention'),
					'acc_time_end' => $this->input->post('acc_time_end'), 'acc_time_start' => $this->input->post('acc_time_start'),
					'index_no' => $this->input->post('index'), 'cert_name' => $image_data['file_name'], 'cert_dir_name' => $img_dir_name);
					
					if($this->input->post('action') and $this->input->post('action') == 'Update')
					{
						$acc_id = $this->input->post('id');
						if($this->Job_Model->qualification_update($qualification_data, $acc_id))
						{
							$data['message_success'] = '';
						
							redirect('Home/qualification_result', $data);
				
						}
					}
					else
					{
						
						if($this->Job_Model->qualification($qualification_data))
						{
							$data['message_success'] = '';
						
							redirect('Home/qualification_result', $data);
				
						}
					}
				}
			}
		}
	}
}
		
			public function referee_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
						
					$query['query'] = $this->Job_Model->referee_results($this->session->userdata('user_id'));
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/referee_result', $query);
					$this->load->view('common/footer');
					
			}
			
			public function experience_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
						
					$query['query'] = $this->Job_Model->experience_results($this->session->userdata('user_id'));
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/experience_result', $query);
					$this->load->view('common/footer');
					
			}
			
			public function training_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
						
					$query['query'] = $this->Job_Model->training_results($this->session->userdata('user_id'));
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/training_result', $query);
					$this->load->view('common/footer');
					
			}
			
			public function property_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
				if( $query = $this->Job_Model->property_results($this->session->userdata('user_id'))){
					$data['invents'] = $query;
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/property_result', $data);
					$this->load->view('common/footer');
				}else{
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/property_result');
					$this->load->view('common/footer');
				}
					
			}
			
			public function financial_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
						
					if($query = $this->Job_Model->financial_results($this->session->userdata('user_id'))){
					$data['query'] = $query;
					$data['links'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/financial_result', $data);
					$this->load->view('common/footer');
				}else{
					$data['links'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/financial_result', $data);
					$this->load->view('common/footer');
				}
				
			}
			
			public function view_frecords()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/view_frecords/';
				$config['total_rows'] = $this->Job_Model->count_all_frecord();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);	
				
				if($query = $this->Job_Model->view_frecords($this->uri->segment(2), $config['per_page'], $this->uri->segment(3))){
				$data['query'] = $query;
				$data['links'] = $this->pagination->create_links();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial_result', $data);
				$this->load->view('common/footer');
			}else{
				$data['links'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial_result', $data);
				$this->load->view('common/footer');
			}
			}
				
			public function trush_records()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/trush_records/';
				$config['total_rows'] = $this->Job_Model->count_all_deleted_frecord();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);	
				if($query = $this->Job_Model->view_frecords($this->uri->segment(2),$config['per_page'], $this->uri->segment(3))){
				$data['query'] = $query;
				$data['links'] = $this->pagination->create_links();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial_result', $data);
				$this->load->view('common/footer');
			}else{
				$data['links'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/financial_result', $data);
				$this->load->view('common/footer');
			}
		}	
		//
		public function financial_okay(){
			$record_id = $this->uri->segment(3);
			if($this->Job_Model->delete_financial_permanent($record_id)){
				if($this->Job_Model->delete_financial_permanent_exp($record_id)){
				 redirect('Home/trush_records');
				 exit();
			 }
			}
		}	
			
			public function qualification_result()
			{
				if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
					
						
					$query['query'] = $this->Job_Model->acc_result($this->session->userdata('user_id'));
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/qualification_result', $query);
					$this->load->view('common/footer');
					
				
			}
				
		
	
		public function login()
		{	
			if($this->session->userdata('logged_in'))
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/footer');
				
			}else 
			{
				//validating the login form if is empty submited
				$this->form_validation->set_rules('usr_email', ' Email', 'required|valid_email');
				$this->form_validation->set_rules('usr_password', 'Password', 'required');
				
				if($this->form_validation->run() == FALSE)
				{
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('common/login');
					$this->load->view('common/footer');
				}
				else
				{
					$email = $this->input->post('usr_email');
					$password = $this->input->post('usr_password');
			
					$query = $this->Job_Model->login_form($email);
			
					if($query->num_rows() == 1)
					{
						foreach($query->result() as $row)
						{
							//$this->load->library('encrypt');
					
							$hash = sha1($password);
							//$hash = $password;
					
							if($hash != $row->password)
							{
								$msg['login_fail'] = '';
								$this->load->view('nav/top_nav');
								$this->load->view('common/header');
								$this->load->view('common/login_header');
								$this->load->view('common/login', $msg);
								$this->load->view('common/footer');
							}
							else
							{
								$data = array('user_id' => $row->user_id,'first_name'=>$row->first_name, 'last_name'=>$row->last_name, 'username' => $row->username, 'access_lvl' => $row->access_lvl, 'logged_in' => true);
								$this->session->set_userdata($data);
								redirect('Home/dashboard');
							}
			
						}
					}
					else
					{
						$msg['login_fail'] = '';
						$this->load->view('nav/top_nav');
						$this->load->view('common/header');
						$this->load->view('common/login_header');
						$this->load->view('common/login', $msg);
						$this->load->view('common/footer');
					}
				}
			}
		}
		public function changepass()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$this->form_validation->set_rules('old_password', 'old password', 'required');
			$this->form_validation->set_rules('new_password', 'new password', 'required|min_length[8]');
			$this->form_validation->set_rules('confirm_new_password', 'confirm_new password', 'required|matches[new_password]');
				
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/changepass');
				$this->load->view('common/footer');
			}
			else
			{
				$old_password = sha1($this->input->post('old_password'));
				$new_password = sha1($this->input->post('new_password'));
				$confirm_new_password = $this->input->post('confirm_new_password');
				
				$results = $this->Job_Model->change_pass($old_password, $this->session->userdata('user_id'));
				
				if($results->num_rows() == 1)
				{
					$user_id = $this->session->userdata('user_id');

					$result = $this->Job_Model->update_pass($new_password, $user_id);
					
					if($result)
					{
						
						$data['message_success'] = '';
						$this->load->view('nav/top_nav');
						$this->load->view('common/header');
						$this->load->view('common/login_header');
						$this->load->view('Home_View');
						$this->load->view('common/changepass', $data);
						$this->load->view('common/footer');
					}
					else
					{
						$data['message_fail'] = '';
						$this->load->view('nav/top_nav');
						$this->load->view('common/header');
						$this->load->view('common/login_header');
						$this->load->view('Home_View');
						$this->load->view('common/changepass', $data);
						$this->load->view('common/footer');
					}
				}
				else
				{
					$data['old_pass_fail'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/changepass', $data);
					$this->load->view('common/footer');
				}
			}
						
		}	
		
		public function logout()
		{		
			$this->session->sess_destroy();
			$this->session->set_flashdata('loggedout', 'You have successfully created the income record!!!!');
			redirect('Home/login');
			exit();
			
		}
		
		public function dashboard()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$user_id = $this->session->userdata('user_id');
				
			$result = $this->Image_model->fetch_images($user_id);
			if($result->result() > 0)
			{
				$image['query'] = $result;
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/dashboard', $image);
				$this->load->view('common/footer');
			}
			else
			{
				$message['fail'] = '';
				$image['query'] = $result;
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/dashboard');
				$this->load->view('common/footer');
			
			
			
		}
	}
		
		public function attachment_result()
		{
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			
			$user_id = $this->session->userdata('user_id');
				
			$result['query'] = $this->Image_model->fetch_attachment($user_id);
			
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/attachment_result', $result);
				$this->load->view('common/footer');
			
		}
		
		public function register()
		{	
			//setting the validation rules for registration
			$this->form_validation->set_rules('usr_email', ' Email', 'required|valid_email|is_unique[user.user_email]');
			$this->form_validation->set_rules('usr_email_confirm', ' Email Confirmation', 'required|valid_email|matches[usr_email]');
			$this->form_validation->set_rules('usr_password', 'Password', 'required');
			$this->form_validation->set_rules('usr_password_confirm', 'Password Confirmation', 'required|matches[usr_password]');
			
			if($this->form_validation->run() == FALSE)
			{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('common/register');
				$this->load->view('common/footer');
			}
			else 
			{
				$hash = sha1($this->input->post('usr_password'));
				$register = array('user_email' => $this->input->post('usr_email'), 'password' => $hash, 'access_lvl' => 1);
			
				if($this->Job_Model->register_form($register))
				{
					$data['message'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('common/login', $data);
					$this->load->view('common/footer');
				}
				
			}
		}
		
		//viewing all of the inventories
		public function view_inventories(){
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}else{
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/view_inventories/';
				$config['total_rows'] = $this->Job_Model->count_all_inventory();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				$choice = $config["total_rows"] / $config["per_page"];
				$config["num_links"] = floor($choice);
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);				
		if($query = $this->Job_Model->fetch_all_inventories($config['per_page'],$this->uri->segment(3))){
			$data['inventories'] = $query;
			$data['links'] = $this->pagination->create_links();
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/view_inventories', $data);
			$this->load->view('common/footer');
		}else{
			$data['links'] = '';
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/view_inventories', $data);
			$this->load->view('common/footer');
		}
		
	  }
  }
	  
	  //trushing the intentories
	  public function trush_inventory(){
		  if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		  $id = $this->uri->segment(3);
		  if($this->Job_Model->trush_inventory($id)){
			  $this->session->set_flashdata('trushed', 'You have successfully deleted the property');
			  redirect('Home/view_inventories');
			  exit();
		  }
	  }
	  
	  //view all trushed properties
	  public function trushed_properties(){
		  if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/trushed_properties/';
				$config['total_rows'] = $this->Job_Model->count_all_deleted_inventories();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);
		  if($query = $this->Job_Model->trushed_properties($config['per_page'], $this->uri->segment(3))){
		  $data['trushed_properties'] = $query;
		  $data['links'] = $this->pagination->create_links();
		  $this->load->view('nav/top_nav');
		  $this->load->view('common/header');
		  $this->load->view('common/login_header');
		  $this->load->view('Home_View');
		  $this->load->view('common/view_trushed_inventories', $data);
		  $this->load->view('common/footer');
	  }else{
		  $data['links'] = '';
		  $this->load->view('nav/top_nav');
		  $this->load->view('common/header');
		  $this->load->view('common/login_header');
		  $this->load->view('Home_View');
		  $this->load->view('common/view_trushed_inventories', $data);
		  $this->load->view('common/footer');
	  }
	  }
	  
	  public function okay_property(){
		  if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		  $item_id = $this->uri->segment(3);
		  if($this->Job_Model->okay_property($item_id)){
		  redirect('Home/trushed_properties');
		  exit();
	  }
	  }
	  
	//searching the inventory records
  public function search_property(){
	   if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
    if (isset($_GET['term'])){
      $q = strtolower($_GET['term']);
      return $this->Job_model->search_property($q);
    }
  }
  
  //generating all of the reports inventory reports
  public function inventory_report(){
	  if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		$this->load->view('nav/top_nav');
		$this->load->view('common/header');
		$this->load->view('common/login_header');
		$this->load->view('Home_View');
		$this->load->view('common/inventory_report');
		$this->load->view('common/footer');
	}

  
  public function create_inventory_pdf(){
	  if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == FALSE){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/inventory_report');
			$this->load->view('common/footer');
		}else {
	  		$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->inventory_report($from, $to)){
			$data['invents'] = $query;
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/itcb_inventory_report', $data);
			$this->load->view('common/footer');
		}else{
			$data['no_invents'] = '';
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/inventory_report', $data);
			$this->load->view('common/footer');
		}
  }
	  
 }
 
	 //creating the report income report
	 public function create_income_report(){
		 if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/income_report');
			$this->load->view('common/footer');
	}
	
	public function create_income_report_pdf(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/income_report');
			$this->load->view('common/footer');
		}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->income_report_pdf($from, $to)){
			$data['incomes'] = $query;
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/itcb_income_report', $data);
			$this->load->view('common/footer');	
			}else{
			$data['no_incomes'] = '';
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/income_report', $data);
			$this->load->view('common/footer');
			}
		}
	}
	
	//expenditure report
	public function create_expenditure_report(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/expenditure_report');
			$this->load->view('common/footer');
	}
	
	public function create_expenditure_report_pdf(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$this->form_validation->set_rules('from', 'Start Date', 'required');
			$this->form_validation->set_rules('to', 'End Date', 'required');
			if($this->form_validation->run() == false){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/expenditure_report');
			$this->load->view('common/footer');
			}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->expenditure_report_pdf($from, $to)){
			$data['expenditures'] = $query;
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/itcb_expenditure_report', $data);
			$this->load->view('common/footer');
			}else{
			$data['no_expenditures'] = '';
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/expenditure_report', $data);
			$this->load->view('common/footer');
			}
		}
	}
	
	//creating the income and expenditure report 
	public function create_income_exp_report(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/income_expenditure_report');
			$this->load->view('common/footer');
	}
	public function income_expenditure_report_pdf(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/income_expenditure_report');
			$this->load->view('common/footer');
		}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->select_income_expenditure_report($from, $to)){
				$data['income_expenditure'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/itcb_income_expenditure_report', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_income_expenditure'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/income_expenditure_report', $data);
				$this->load->view('common/footer');
			}
			
			
			
		}
	}
	
	public function loan_records(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') and $this->input->post('action') == "Edit"){
				$id = $this->input->post('borrow_id');
				$category = $this->input->post('lcategory');
				$data = array('edit' => $this->Job_Model->borrow_edit($id, $category), 'employees' =>$this->Job_Model->select_all_employees());
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_records', $data);
				$this->load->view('common/footer');
			}else{
				$this->form_validation->set_rules('lcategory', 'Loan Category', 'required');
				$this->form_validation->set_rules('employee', 'Employee Name', 'required');
				$this->form_validation->set_rules('loan_desc', 'Loan Description', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				if($this->form_validation->run() == false){
				$data['employees'] = $this->Job_Model->select_all_employees();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_records', $data);
				$this->load->view('common/footer');
				}else{
				if($this->input->post('lcategory') == 'Loan Borrowing'){
				$data = array('buser_id' => $this->session->userdata('user_id'),'bname'=>$this->input->post('employee'),'bcategory' => $this->input->post('lcategory'),'bamount' =>$this->input->post('amount'), 
				'bpurpose' =>$this->input->post('loan_desc'), 'bregistered_by' => $this->session->userdata('first_name').' '.
				$this->session->userdata('last_name'));
			}else{
				$data = array('user_id' => $this->session->userdata('user_id'),'pname'=>$this->input->post('employee'),'pcategory' => $this->input->post('lcategory'), 'pamount' =>$this->input->post('amount'), 
				'ppurpose' =>$this->input->post('loan_desc'), 'registered_by' => $this->session->userdata('first_name').' '.
				$this->session->userdata('last_name'));
			}	$category = $this->input->post('lcategory');
				$loan_id = $this->input->post('loan_id');
				if($this->Job_Model->update_loan($data, $category, $loan_id)){
					redirect('Home/loan_result');
				}else{
				if($this->Job_Model->loan($data,$category)){
				redirect('Home/loan_result');
			}
		}
		
	}
}
}
	
	public function loan_result(){
			if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$user_id = $this->session->userdata('user_id');
				$data['loan'] = $this->Job_Model->select_borrow($user_id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_results', $data);
				$this->load->view('common/footer');
	}
	
	//confirming borrowing
		public function confirm_borrow(){
			if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
			$id = $this->uri->segment(3);
			if($this->Job_Model->confirm_borrow($id)){
				$this->session->set_flashdata('borrow_con', 'You have successfully registered the amount of money borrowed');
				redirect('Home/loan_info');
			}
		}
		
	//payment issues
	public function pay_result(){
			if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$user_id = $this->session->userdata('user_id');
				$data['loan'] = $this->Job_Model->select_pay($user_id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_results_pay', $data);
				$this->load->view('common/footer');
	}
	
	//all loan information are here
	public function loan_info(){
		if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_info');
				$this->load->view('common/footer');
	}
	
	//grant loan
	public function grant_loan(){
		if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				if($this->input->post('action') and $this->input->post('action') == "Edit"){
				$borrow_id = $this->input->post('borrow_id');
				$data = array('edit' => $this->Job_Model->edit_loan_borrow($borrow_id), 'employees' => $this->Job_Model->select_all_employees());
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan', $data);
				$this->load->view('common/footer');
				}else{
				$this->form_validation->set_rules('employee', 'Employee Name', 'required');
				$this->form_validation->set_rules('loan_desc', 'Loan Description', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				if($this->input->post('action') and $this->input->post('action') == "Update" and $this->form_validation->run() == FALSE){
				$data_error['borrow_error'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan', $data_error);
				$this->load->view('common/footer');
				}else{
				if($this->form_validation->run() == false){
				$data['employees'] = $this->Job_Model->select_all_employees();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan', $data);
				$this->load->view('common/footer');
			}else{
				$emp_id = $this->input->post('employee');
				$cash = $this->input->post('amount');
				$borrow = $this->Job_Model->check_first_borrowed($emp_id);
				if($borrow->num_rows() > 0){
					foreach($borrow->result() as $rec){
						if($rec->bname == $emp_id){
							$old = $rec->bamount;
							$new = $old + $cash;
							$borrow = array('buser_id' => $this->session->userdata('user_id'), 'bname' => $this->input->post('employee'),
										'bpurpose' => $this->input->post('loan_desc'),'bregistered_by' => $this->session->userdata('first_name'). ' '.$this->session->userdata('last_name'),
						                'bamount' => $new
						                );
						    if($this->Job_Model->update_borrow_loan($borrow, $emp_id)){
								$this->session->set_flashdata('borrow_add', 'You have successfully added another loan amount');
								redirect('Home/loan_info');
							} 
						}
					}
				}else{
				$data = array('buser_id' => $this->session->userdata('user_id'), 'bname' => $this->input->post('employee'),
				 'bpurpose' => $this->input->post('loan_desc'),'bregistered_by' => $this->session->userdata('first_name'). ' '.$this->session->userdata('last_name'),'bamount' => $this->input->post('amount'));
				if($this->input->post('action') and $this->input->post('action') == "Update"){
					$borrow_id = $this->input->post('borrow_id');
					if($this->Job_Model->update_borrow($data, $borrow_id)){
						$this->session->set_flashdata('grant_updt', 'You have successfully updated the loan details');
						redirect('Home/loan_info');
					}
				}else {
				if($this->Job_Model->insert_borrow($data)){
					$this->session->set_flashdata('grant_add', 'You have successfully registered the loan information');
					redirect('Home/grant_loan_result');
				}
			}
		}
	}
	}
	}
	}
	
	//grnt loan result
	public function grant_loan_result(){
		if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$user_id = $this->session->userdata('user_id');
				$data['grant'] = $this->Job_Model->select_borrow_confirm($user_id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan_result', $data);
				$this->load->view('common/footer');
	}
	
	//loan payment
	public function loan_pay(){
		if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				if($this->input->post('action') and $this->input->post('action') == "Edit"){
					$pay_id  = $this->input->post('pay_id');
					$data = array('edit' => $this->Job_Model->edit_loan_paid($pay_id), 'employees' => $this->Job_Model->select_all_employees());
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('common/loan_pay', $data);
					$this->load->view('common/footer');
				}else{
				$this->form_validation->set_rules('employee', 'Employee Name', 'required');
				$this->form_validation->set_rules('loan_desc', 'Loan Description', 'required');
				$this->form_validation->set_rules('amount', 'Amount', 'required');
				if($this->form_validation->run() == false){
				$data['employees'] = $this->Job_Model->select_all_employees();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_pay', $data);
				$this->load->view('common/footer');
			}else{
				$data =  $this->Job_Model->select_borrow_id();
				$loan_id = $this->input->post('employee');
				$amount = $this->input->post('amount');
				$loans = $this->Job_Model->check_first_payment($loan_id);
				if($loans->num_rows() > 0){
				foreach($loans->result() as $rec){
					if($rec->pname == $loan_id){
							$balance = $rec->borrowed;
							$old = $rec->pamount;
							$pamount = $this->input->post('amount');
							$new = $old + $pamount;
							$payment = array('puser_id' =>$this->session->userdata('user_id'), 'pname' => $loan_id, 
					                 'ppurpose' => $this->input->post('loan_desc'), 'pamount' => $new,
					                 'borrowed' => $balance,
					                 'pregistered_by' =>$this->session->userdata('first_name'). ' '.$this->session->userdata('last_name')
					                  );
					        if($this->Job_Model->update_pay_loan($payment, $loan_id)){
								$this->session->set_flashdata('pay_add', 'You have successfully updated the amount of money paid');
					         redirect('Home/loan_info');
						 }
					}
				}
			}else{
				foreach($data as $record){
				if($record->bname == $loan_id){
					$balance = $record->bamount;
					$payment = array('puser_id' =>$this->session->userdata('user_id'), 'pname' => $loan_id, 
					                 'ppurpose' => $this->input->post('loan_desc'), 'pamount' => $this->input->post('amount'),
					                 'borrowed' => $balance,
					                 'pregistered_by' =>$this->session->userdata('first_name'). ' '.$this->session->userdata('last_name')
					                  );
				if($this->input->post('action') == "Update"){
					$pay_id = $this->input->post('pay_id');
					if($this->Job_Model->update_pay($payment, $pay_id)){
						$this->session->set_flashdata('pay_update', 'You have successfully updated the paid amount');
						redirect('Home/pay_loan_result');
					}
				}else{
					$this->Job_Model->insert_payment($payment);
					$this->session->set_flashdata('pay_added', 'You have successfully registered the amount of money paid');
						redirect('Home/pay_loan_result');
				}
			}
		}
		}
			
			
			
		}
	}
	}
	
	//pay loan result
	public function pay_loan_result(){
		if(!$this->session->userdata('logged_in'))
				{
					redirect('Home/login');
					exit();
				}
				$user_id = $this->session->userdata('user_id');
				$data['loan'] = $this->Job_Model->select_pay_confirm($user_id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/pay_loan_result',$data);
				$this->load->view('common/footer');
	}
	
	//loan payment confirm
	public function confirm_loan_pay(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Job_Model->confirm_loan_pay($id)){
			$this->session->set_flashdata('pay_con', 'You have successfully registered the amount of money paid');
			redirect('Home/loan_info');
		}
	}
	
	//loan report
	public function loan_report(){
		if(!$this->session->userdata('logged_in'))
			{
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_report');
				$this->load->view('common/footer');
	}
	
	//generate grant loan report 
	public function grant_loan_report(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/grant_loan_report');
			$this->load->view('common/footer');
	}
	//grant loan report pdf
	public function grant_loan_report_pdf(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/grant_loan_report');
			$this->load->view('common/footer');
		}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->grant_loan_select_report($from, $to)){
				$data['grant_loan'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/itcb_grant_loan_report', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_granted_loan'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan_report', $data);
				$this->load->view('common/footer');
			}
		}	
	}
	//loan payment
	public function loan_payment_report(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_payment_result');
				$this->load->view('common/footer');
		}
	
	//payment loan report pdf
	public function pay_loan_select_report_pdf(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_payment_result');
				$this->load->view('common/footer');
		}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->pay_loan_select_report($from, $to)){
				$data['pay_loan'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/itcb_pay_loan_report', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_granted_loan'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/grant_loan_report', $data);
				$this->load->view('common/footer');
			}
		}
	}
	
	//generate loan status report in pdf
	public function create_loan_report_pdf(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'Start Date', 'required');
		$this->form_validation->set_rules('to', 'End Date', 'required');
		if($this->form_validation->run() == false){
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('common/login_header');
			$this->load->view('Home_View');
			$this->load->view('common/loan_report');
			$this->load->view('common/footer');
		}else{
			$from = $this->input->post('from');
			$to = $this->input->post('to');
			if($query = $this->Job_Model->create_loan_report_pdf($from, $to)){
				$data['loan_status'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/itcb_loan_status', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_loan_status'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('common/loan_report', $data);
				$this->load->view('common/footer');
			}
		}
		
	}
	
	
	//here is all about the financial management system for phone shop
	//----------------------------------------------------------------------------------------------//
	public function device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device');
				$this->load->view('common/footer');
	}
	
	public function add_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') && $this->input->post('action') == "Edit"){
				$id = $this->input->post('id');
				$data['device_fetch'] = $this->Device_model->edit_device($id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/add_device', $data);
				$this->load->view('common/footer');
			}else{
			$this->form_validation->set_rules('dev_name', 'device name', 'required');
			$this->form_validation->set_rules('dev_number', 'device number', 'required');
			$this->form_validation->set_rules('dev_price', 'device price', 'required');
			$this->form_validation->set_rules('dev_warranty', 'device warranty', 'required');
			$this->form_validation->set_rules('dev_imei', 'device imei', 'required');
			$this->form_validation->set_rules('dev_status', 'device working status', 'required');
			if($this->input->post('action') && $this->input->post('action') == "Update" && $this->form_validation->run() == FALSE){
				$data['device_error'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/add_device', $data);
				$this->load->view('common/footer');
			}else {
			if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/add_device');
				$this->load->view('common/footer');
			}else{
				$data = array(
							   'duser_id' =>$this->session->userdata('user_id'),
				               'dev_name' => $this->input->post('dev_name'),
				               'dev_number' => $this->input->post('dev_number'),
				               'dev_warranty' => $this->input->post('dev_warranty'),
				               'dev_imei' => $this->input->post('dev_imei'),
				               'dev_price' => $this->input->post('dev_price'),
				               'dev_status' => $this->input->post('dev_status'),
				               'registered_by' =>$this->session->userdata('first_name').', '.$this->session->userdata('last_name'),
				               'dev_date' => date('Y-m-d H:i:s'));
				 if($this->input->post('action') && $this->input->post('action') == "Update"){
					 $id = $this->input->post('id');
					 if($this->Device_model->update_device($data, $id)){
						 redirect('Home/device_confirm');
					 }
				 }else{
				if( $this->Device_model->add_device($data)){
					$this->session->set_flashdata('dev', 'Please Confirm to register the device!!!');
					redirect('Home/device_confirm');
				}
			}
				
			}
		}
	}
	}
	
	public function device_confirm(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			$user_id = $this->session->userdata('user_id');
			$query = $this->Device_model->device_confirm($user_id);
			if($query){
				$data['devices'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_confirm', $data);
				$this->load->view('common/footer');
			}else{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_confirm');
				$this->load->view('common/footer');
			}
	}
	
	public function confirmed_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Device_model->confirmed_device($id)){
			redirect('Home/device_confirm');
		}
	}
	
	public function view_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/view_device';
				$config['total_rows'] = $this->Device_model->count_all_devices();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);
				$page = $this->uri->segment(3);
				if($results = $this->Device_model->view_device($config['per_page'],$page)){
					$data = array('remain' =>$this->Device_model->count_sold_remain() ,'devices' => $results,'total' => $this->Device_model->device_total(), 'sold' => $this->Device_model->count_all_devices(), 'links' => $this->pagination->create_links());
					//$data['links'] = $this->pagination->create_links();
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_device', $data);
					$this->load->view('common/footer');
				}else{
				$data = array( 'links' => '', 'no_view' => '','remain' =>$this->Device_model->count_sold_remain());
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/view_device', $data);
				$this->load->view('common/footer');
			}
	}
	
	public function search_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$dev_name = $this->input->post('search');
				if(isset($dev_name) and !empty($dev_name)){
					$data = array('devices' => $this->Device_model->search_seller($dev_name), 'remain' =>$this->Device_model->count_sold_remain() ,'links' => '', 'total' => $this->Device_model->count_all_devices());
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_device', $data);
					$this->load->view('common/footer');
				}else{
					redirect('Home/view_device');
				}
		}
	
	public function search_sold_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$dev_name = $this->input->post('search');
				if(isset($dev_name) and !empty($dev_name)){
					$data = array('sold' => $this->Device_model->search_sold_dev($dev_name), 'links' => '','remain' =>$this->Device_model->count_sold_remain() );
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_sold_devices', $data);
					$this->load->view('common/footer');
				}else{
					
					redirect('Home/view_sold_devices');
				}
		}
	
	public function delete_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Device_model->delete_device($id)){
			redirect('Home/view_device');
		}
	}
	//selling devices
	public function sell_device(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') and $this->input->post('action') == "Edit"){
				$id = $this->input->post('id');
				$data['device_fetch'] = $this->Device_model->edit_device($id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sell_device', $data);
				$this->load->view('common/footer');
			}else{
				$id = $this->uri->segment(3);
				$data['device_fetch'] = $this->Device_model->edit_device($id);
				$this->form_validation->set_rules('sell_price', 'Selling Price', 'required');
				$this->form_validation->set_rules('fname', 'First Name', 'required');
				$this->form_validation->set_rules('lname', 'Last Name', 'required');
				$this->form_validation->set_rules('cphone', 'Customer Phone Number', 'required');
				
				if($this->form_validation->run() == false){
					if($this->input->post('action') == 'Update')
					{
						$data = array('device_fetch' => $this->Device_model->edit_device($id));
					}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sell_device', $data);
				$this->load->view('common/footer');
				}else{
				$dev_id = $this->input->post('id');
				$datas = array( 
								'sold_amount' => $this->input->post('sell_price'),
							   'sold_by' => $this->session->userdata('first_name').','.$this->session->userdata('last_name'),
							   'fname' => $this->input->post('fname'),
							   'lname' => $this->input->post('lname'),
							   'cphone' => $this->input->post('cphone'),
							   'cemail' => $this->input->post('cemail'),
							   'selcom' => $this->input->post('selcom'),
							   'sold_date' =>  date('Y-m-d H:i:s'));
							   
				if($this->Device_model->update_device($datas, $dev_id)){
					//$suser_id = $this->session->userdata('suser_id');
					$id = $this->input->post('id');
					//$user_id = $this->session->userdata('user_id');
			
			$query = $this->Device_model->sell_confirm($id);
			if($query){
				$data['devices'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sell_confirm', $data);
				$this->load->view('common/footer');
			}else{
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sell_confirm');
				$this->load->view('common/footer');
			}
		}
			
	}

			
 }
 }
		
	public function sell_device_confirm(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Device_model->update_sold($id)){
			redirect('Home/view_device');
		}
	}
	
	//device status
	public function device_status(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$data = array('total_devices' => $this->Device_model->count_reg_devices(), 'sold_devices' => $this->Device_model->count_sold_devices(),
		               'sumregistered' => $this->Device_model->all_reg_dev());
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_status', $data);
				$this->load->view('common/footer');
			
	}
	
	public function view_sold_devices(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/view_sold_devices';
				$config['total_rows'] = $this->Device_model->count_sold_devices();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);
				$page = $this->uri->segment(3);
			    if($results = $this->Device_model->sold_devices($config['per_page'], $page)){
			    $data['sold'] = $results;
			    $data['links'] = $this->pagination->create_links();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/view_sold_devices', $data);
				$this->load->view('common/footer');
			}else{
				$data = array('links' => '');
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/view_sold_devices', $data);
				$this->load->view('common/footer');
			}
		}
		
		public function delete_sold_confirm(){
			$id = $this->uri->segment(3);
			if($this->Device_model->delete_sold_confirm($id)){
				redirect('Home/view_sold_devices');
			}
		}
		
		public function registered_device_report(){
				if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/registered_device_report');
				$this->load->view('common/footer');
			}
		
		public function registered_device_report_pdf(){
				if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->form_validation->set_rules('from', 'start date', 'required');
				$this->form_validation->set_rules('to', 'end date', 'required');
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/registered_device_report');
				$this->load->view('common/footer');
				}else{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				
				if($results = $this->Device_model->registered_device_report($from, $to)){
				$data['devices'] = $results;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/registered_device_report_pdf', $data);
				$this->load->view('common/footer');
				}else{
				$data['no_device'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/registered_device_report', $data);
				$this->load->view('common/footer');
				}
			}
		}
		
		public function sold_device_report(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sold_device_report');
				$this->load->view('common/footer');
		}
		
		public function sold_device_report_pdf(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->form_validation->set_rules('from', 'start date', 'required');
				$this->form_validation->set_rules('to', 'end date', 'required');
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sold_device_report');
				$this->load->view('common/footer');
				}else{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				
				if($results = $this->Device_model->sold_device_report($from, $to)){
				$data['sold_devices'] = $results;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sold_device_report_pdf', $data);
				$this->load->view('common/footer');
				}else{
				$data['no_sold_device'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/sold_device_report', $data);
				$this->load->view('common/footer');
				}
			}
		}
		
		public function device_status_report(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_status_report');
				$this->load->view('common/footer');
			}
		
		public function device_status_report_pdf(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->form_validation->set_rules('from', 'start date', 'required');
				$this->form_validation->set_rules('to', 'end date', 'required');
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_status_report');
				$this->load->view('common/footer');
				}else{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				if($results = $this->Device_model->reg_dev($from, $to)){
				$data['devices_status'] = $results;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_status_report_pdf', $data);
				$this->load->view('common/footer');
				}else{
				$data['no_device_status'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/device_status_report', $data);
				$this->load->view('common/footer');
				}
			}
		}
		
		//employees
		public function add_employees(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}	
				if($this->input->post('action') and $this->input->post('action') == "Edit"){
					$id = $this->input->post('id');
					if($query = $this->Device_model->edit_employee($id)){
						$data['edit_emp'] = $query;
						$this->load->view('nav/top_nav');
						$this->load->view('common/header');
						$this->load->view('common/login_header');
						$this->load->view('Home_View');
						$this->load->view('pages/add_employee', $data);
						$this->load->view('common/footer');
					}
				}else{
				$this->form_validation->set_rules('fname', 'first name', 'required');
				$this->form_validation->set_rules('mname', 'middle name', 'required');
				$this->form_validation->set_rules('lname', 'last name', 'required');
				$this->form_validation->set_rules('phone', 'phone number', 'required');
				if($this->input->post('action') and $this->input->post('action') and $this->form_validation->run() == false){
					$data['add_error'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/add_employee', $data);
					$this->load->view('common/footer');
				}else{
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/add_employee');
				$this->load->view('common/footer');
			}else{
				$data = array( 
								'user_id'     => $this->session->userdata('user_id'),
								'first_name'  => $this->input->post('fname'),
				               'middle_name'  => $this->input->post('mname'),
				               'last_name'    => $this->input->post('lname'),
				               'position'     => $this->input->post('position'),
				               'phone_number' => $this->input->post('phone'));
				 $id = $this->input->post('id');
				 if($this->input->post('action') and $this->input->post('action') == "Update"){
					 if($this->Device_model->update_employee($data, $id)){
						 redirect('Home/employees_results');
					 }
				 }else{
				if($this->Device_model->add_employee($data)){
					redirect('Home/employees_results');
				} 
			}
		}
	}
		}
	}
		
		public function employees_results(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				if($query = $this->Device_model->list_of_employees()){
				$data['yes_employees'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/employees_results', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_employee'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/employees_results', $data);
				$this->load->view('common/footer');
			}
				
		}
		
		public function remove_employee(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			$id = $this->uri->segment(3);
			if($this->Device_model->delete_employee($id)){
				redirect('Home/employees_results');
			}
		}
		
		public function shop_expenditure(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			if($this->input->post('action') and $this->input->post('action') == "Edit"){
				$id = $this->input->post('id');
				$data['edit_exp'] = $this->Device_model->edit_exp($id);
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/expenditure', $data);
				$this->load->view('common/footer');
			}else{
				$this->form_validation->set_rules('ename', 'expenditure name', 'required');
				$this->form_validation->set_rules('epay', 'paid to', 'required');
				$this->form_validation->set_rules('eamount', 'amount', 'required');
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/expenditure');
				$this->load->view('common/footer');
		}else{
			$data = array(
						'euser_id' => $this->session->userdata('user_id'),
						'exp_name' => $this->input->post('ename'),
						'payee_name' => $this->input->post('epay'),
						'amount' => $this->input->post('eamount'),
						'exp_by' => $this->session->userdata('first_name').' '.$this->session->userdata('last_name')
						);
			if($this->input->post('action') and $this->input->post('action') == "Update"){
				$id = $this->input->post('id');
				if($this->Device_model->update_exp($data, $id)){
					redirect('Home/shop_expenditure_confirm');
				}
			}else{
			if($this->Device_model->add_exp($data)){
				redirect('Home/shop_expenditure_confirm');
			}
		}
		}
	}
	}
	
	public function shop_expenditure_confirm(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$id = $this->session->userdata('user_id');
				if($query = $this->Device_model->expenditure_editing($id)){
				$data['expex'] = $query;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/expenditure_confirm',$data);
				$this->load->view('common/footer');
			}else{
				$data['no_expex'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/expenditure_confirm',$data);
				$this->load->view('common/footer');
			}
	}
	
	public function exp_confirm(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Device_model->confirm_update($id)){
		redirect('Home/shop_expenditure_confirm');
	}
	}
	
	public function exp_report(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/exp_report');
				$this->load->view('common/footer');
	}
	
	public function exp_report_pdf(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$this->form_validation->set_rules('from', 'start date', 'required');
				$this->form_validation->set_rules('to', 'end date', 'required');
				if($this->form_validation->run() == false){
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/exp_report');
				$this->load->view('common/footer');
				}else{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				if($results = $this->Device_model->exp_rep($from, $to)){
				$data['exp'] = $results;
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/exp_report_pdf', $data);
				$this->load->view('common/footer');
				}else{
				$data['no_exp'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/exp_report', $data);
				$this->load->view('common/footer');
				}
			}
	}
	
	public function customers(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			$config = array();
				$config['base_url'] = base_url().'index.php/Home/customers';
				$config['total_rows'] = $this->Device_model->count_sold_devices();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);
				$page = $this->uri->segment(3);
			if($query = $this->Device_model->customers_list($config['per_page'] = 5, $page)){
				$data['customers'] = $query;
				$data['links'] = $this->pagination->create_links();
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/customers', $data);
				$this->load->view('common/footer');
			}else{
				$data['no_customers'] = '';
				$data['links'] = '';
				$this->load->view('nav/top_nav');
				$this->load->view('common/header');
				$this->load->view('common/login_header');
				$this->load->view('Home_View');
				$this->load->view('pages/customers', $data);
				$this->load->view('common/footer');
			}
		}
		
		public function delete_customer(){
				if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
			$id = $this->uri->segment(3);
			if($this->Device_model->delete_sold_confirm($id)){
				redirect('Home/customers');
			}
		}
		
		public function search_customers(){
		if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$dev_name = $this->input->post('search');
				if(isset($dev_name) and !empty($dev_name)){
					$data = array('customers' => $this->Device_model->search_customers($dev_name), 'links' => '',);
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/customers', $data);
					$this->load->view('common/footer');
				}else{
					
					redirect('Home/customers');
				}
		}
	
	public function view_exp(){
				if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$config = array();
				$config['base_url'] = base_url().'index.php/Home/view_exp';
				$config['total_rows'] = $this->Device_model->count_exp();
				$config['per_page'] = 5;
				$config['num_links'] = 1;
				$data['message'] = '';
				//config for bootstrap pagination class integration 
				$config['full_tag_open'] = '<ul class="pagination">';
				$config['full_tag_close'] = '</ul>';
				$config['first_link'] = false;
				$config['last_link'] = false;
				$config['first_tag_open'] = '<li>';
				$config['first_tag_close'] = '</li>';
				$config['prev_link'] = '&laquo';
				$config['prev_tag_open'] = '<li class="prev">';
				$config['prev_tag_close'] = '</li>';
				$config['next_link'] = '&raquo';
				$config['next_tag_open'] = '<li>';
				$config['next_tag_close'] = '</li>';
				$config['last_tag_open'] = '<li>';
				$config['last_tag_close'] = '</li>';
				$config['cur_tag_open'] = '<li class="active"><a href="#">';
				$config['cur_tag_close'] = '</a></li>';
				$config['num_tag_open'] = '<li>';
				$config['num_tag_close'] = '</li>';
				$this->pagination->initialize($config);
				$page = $this->uri->segment(3);
			if($query = $this->Device_model->select_exp($config['per_page'] = 5, $page)){
				$data['expd'] = $query;
				$data['links'] = $this->pagination->create_links();
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_exp', $data);
					$this->load->view('common/footer');
				}else{
					$data['no_expd'] = '';
					$data['links'] = '';
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_exp', $data);
					$this->load->view('common/footer');
				}
	}
	
	public function delete_exp(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
		$id = $this->uri->segment(3);
		if($this->Device_model->delete_exp($id)){
			redirect('Home/view_exp');
		}
	}
	
	public function search_expd(){
			if(!$this->session->userdata('logged_in')){
				redirect('Home/login');
				exit();
			}
				$dev_name = $this->input->post('search');
				if(isset($dev_name) and !empty($dev_name)){
					$data = array('expd' => $this->Device_model->search_exp($dev_name), 'links' => '',);
					$this->load->view('nav/top_nav');
					$this->load->view('common/header');
					$this->load->view('common/login_header');
					$this->load->view('Home_View');
					$this->load->view('pages/view_exp', $data);
					$this->load->view('common/footer');
				}else{
					
					redirect('Home/view_exp');
				}	
	}
	
}
	
	?>
