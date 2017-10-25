	<?php
	
		class SiteController extends CI_Controller{
			public function index(){
				$this->load->library('pagination');
				$this->load->library('table');
				$this->table->set_heading('Id', 'Title', 'Content');
				$config['base_url'] = 'http://localhost/pagenation/index.php/SiteController/index';
				$config['total_rows'] = $this->db->get('data')->num_rows();
				$config['per_page'] = 5;
				$config['num_links'] = 10;
				
				$this->pagination->initialize($config);
				
				$data['records'] = $this->db->get('data',$config['per_page'], $this->uri->segment(3));
				$this->load->view('SiteView', $data);
			}
		}
	
	?>
