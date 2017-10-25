<?php

	class Dashboard extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('Job_Model');
			$this->lang->load('en_admin', 'english');
		}
		public function index()
		{
			if($)
			$this->load->view('nav/top_nav');
			$this->load->view('common/header');
			$this->load->view('Home_View');
			$this->load->view('common/footer');
		}
	}

?>
