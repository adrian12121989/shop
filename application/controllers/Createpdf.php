<?php

class Createpdf extends CI_Controller
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
			$this->load->model('Image_model');
	}
	
	
	public function pdf()
	{
		$this->load->helper('pdf_helper');
		/*
			---- ---- ---- ----
			your code here
			---- ---- ---- ----
		*/
		/*$data['query'] = $this->Job_Model->job_results();
	
			
			$this->load->view('nav/top_nav');
			$this->load->view('common/login_header');
			$this->load->view('common/header');*/
			$this->load->view('pdfreport');
			$this->load->view('common/footer');
	}
	
	
}

?>
