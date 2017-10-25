<?php

class Ajax extends CI_Controller {

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
			//$this->load->controler('Image');
		}
  
  public function index()
  {
	  $this->load->view('common/form_frame');
  }

  public function username_taken()
  {
    $this->load->model('MUser', '', TRUE);
    $username = trim($_POST['username']);
    // if the username exists return a 1 indicating true
    if ($this->MUser->username_exists($username)) {
      echo '1';
    }
  }

}

/* End of file ajax.php */
