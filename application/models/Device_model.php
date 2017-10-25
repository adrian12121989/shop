	<?php if(! defined('BASEPATH')) exit('Requested script is not available');
	class Device_model extends CI_Model{
		public function __construct(){
			parent::__construct();
		}
		
		public function add_device($data){
			return $this->db->insert('device', $data);			
		}
		
		public function confirmed_device($id){
			$this->db->set('dev_confirm', 1);
			$this->db->where('dev_id', $id);
			return $this->db->update('device');
		}
		
		public function view_device($limit, $offset){
			$this->db->where('dev_confirm', 1);
			$this->db->where('sold',0);
			$this->db->order_by('dev_date','desc');
			$this->db->limit($limit, $offset);
			$results = $this->db->get('device');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		 public function count_all_devices(){
			 $this->db->where('dev_confirm',1);
			 $this->db->where('sold', 0);
			 return $this->db->count_all_results('device');//use count_all_results to avoid the bootstrap to add extra links that are unnecessary
		 }
		 
		 public function device_total(){
			 $this->db->where('dev_confirm',1);
			 return $this->db->count_all_results('device');
		 }
		 
		 public function count_sold_device(){
			 $this->db->where('sold',1);
			 return $this->db->count_all_results('device');
		 }
		 
		 public function search_seller($dev_name){
			 $this->db->select('*');
			 $this->db->from('device');
			 $this->db->like('dev_name', $dev_name);
			 $this->db->where('sold', 0);
			 $this->db->or_like('dev_number', $dev_name);
			 $this->db->where('sold', 0);
			 $this->db->or_like('dev_price', $dev_name);
			 $this->db->where('sold', 0);
			 $this->db->or_like('dev_imei', $dev_name);
			  $this->db->where('sold', 0);
			 $query = $this->db->get();
			 if($query->num_rows() > 0){
				 return $query->result();
			 }else{
				 return $query->result(); 
			 }
		 }
		 
		 
		  public function search_admin($dev_name){
			 $this->db->select('*');
			 $this->db->from('device');
			 $this->db->like('dev_name', $dev_name);
			 $this->db->where('sold', 0);
			 $this->db->or_like('dev_number', $dev_name);
			 $this->db->where('sold', 0);
			 $this->db->or_like('dev_price', $dev_name);
			 $query = $this->db->get();
			 if($query->num_rows() > 0){
				 return $query->result();
			 }else{
				 return $query->result(); 
			 }
		 }
		 
		  public function search_sold_dev($dev_name){
			 $this->db->select('*');
			 $this->db->from('device');
			 $this->db->like('dev_name', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('dev_number', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('dev_price', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('dev_imei', $dev_name);
			  $this->db->where('sold', 1);
			 $query = $this->db->get();
			 if($query->num_rows() > 0){
				 return $query->result();
			 }else{
				 return $query->result(); 
			 }
		 }
		 
		 
		public function delete_device($id){
			$this->db->where('dev_id', $id);
			return $this->db->delete('device');
		}
		
		public function edit_device($id){
			$this->db->where('dev_id', $id);
			$results = $this->db->get('device');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function update_device($data, $id){
			$this->db->join('users', 'users.user_id = device.suser_id', 'left');
			$this->db->where('dev_id', $id);
			return $this->db->update('device', $data);
		}
		
		public function device_confirm($user_id){
			$this->db->select('*');
			$this->db->from('device');
			$this->db->join('users','users.user_id = device.duser_id', 'left');
			$this->db->where('dev_confirm',0);
			$this->db->order_by('dev_date','desc');
			$this->db->where('duser_id', $user_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function sell_confirm($id){
			$this->db->select('*');
			$this->db->from('device');
			$this->db->where('dev_id', $id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function sell_device($data, $id){
			$this->db->where('dev_id', $id);
			$this->db->set('sold_date', 'NOW()', FALSE);
			return $this->db->set('device', $data);
		}
		
		public function update_sold($id){
			$this->db->where('dev_id', $id);
		    $this->db->set('sold',1);
		    return $this->db->update('device');
		}
		
		//device status
		public function count_reg_devices(){
			$this->db->where('dev_confirm',1);
			return $this->db->count_all_results('device');
		}
		
		public function count_sold_devices(){
			$this->db->where('sold',1);
			return $this->db->count_all_results('device');
		}
		
		public function all_reg_dev(){
			$this->db->where('dev_confirm', 1);
			$results = $this->db->get('device');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function sold_devices($limit, $offset){
			$this->db->where('sold',1);
			$this->db->order_by('sold_date','desc');
			$this->db->limit($limit, $offset);
			$results = $this->db->get('device');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function delete_sold_confirm($id){
			$this->db->where('dev_id', $id);
			return $this->db->delete('device');
		}
		
		public function registered_device_report($from, $to){
			$this->db->select('*');
			$this->db->from('device');
			$where = "dev_date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where('dev_confirm', 1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		 
		 public function sold_device_report($from, $to){
			$this->db->select('*');
			$this->db->from('device');
			$where = "sold_date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where('sold', 1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function reg_dev($from, $to){
			$this->db->select('*');
			$this->db->from('device');
			$where = "dev_date BETWEEN  '".$from."' AND '".$to."'";
			$this->db->where('dev_confirm',1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function add_employee($data){
			return $this->db->insert('employees', $data);
		}
		
		public function list_of_employees(){
			$results  = $this->db->get('employees');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function delete_employee($id){
			$this->db->where('emp_id', $id);
			return $this->db->delete('employees');
		}
		
		public function edit_employee($id){
			$this->db->where('emp_id', $id);
			$results = $this->db->get('employees');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function update_employee($data, $id){
			$this->db->where('emp_id', $id);
			return $this->db->update('employees', $data);
		}
		
		public function select_employees(){
			$query = $this->db->get('employees');
			if($query){
				return $query->result();
			}else{
				return $query->result();
			}
		}
		
		public function add_exp($data){
			return $this->db->insert('exp', $data);
		}
		
		public function expenditure_editing($user_id){
			$this->db->select('*');
			$this->db->from('exp');
			$this->db->join('users', 'users.user_id = exp.euser_id', 'left');
			$this->db->where('confirm', 0);
			$this->db->where('user_id', $user_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		public function edit_exp($id){
			$this->db->select('*');
			$this->db->from('exp');
			$this->db->where('exp_id',$id );
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
	public function update_exp($data, $id){
		$this->db->where('exp_id', $id);
		return $this->db->update('exp', $data);
	}
	public function confirm_update($id){
		$this->db->set('confirm', 1);
		$this->db->where('exp_id', $id);
		return $this->db->update('exp');
	}
	
	public function exp_rep($from, $to){
			$this->db->select('*');
			$this->db->from('exp');
			$where = "exp_date BETWEEN  '".$from."' AND '".$to."'";
			$this->db->where('confirm',1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
	public function customers_list($limit, $offset){
		$this->db->where('sold', 1);
		$this->db->order_by('sold_date', 'DESC');
		$this->db->limit($limit, $offset);
		$results = $this->db->get('device');
		if($results->num_rows() > 0){
			return $results->result();
		}else{
			return $results->result();
		}
	}
	
	public function search_customers($dev_name){
			 $this->db->select('*');
			 $this->db->from('device');
			 $this->db->like('dev_name', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('fname', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('lname', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('dev_imei', $dev_name);
			 $this->db->where('sold', 1);
			 $this->db->or_like('dev_number', $dev_name);
			 $this->db->where('sold', 1);
			 $query = $this->db->get();
			 if($query->num_rows() > 0){
				 return $query->result();
			 }else{
				 return $query->result(); 
			 }
		 }
		
	public function select_exp($limit, $offset){
		$this->db->where('confirm', 1);
		$this->db->order_by('exp_date', 'DESC');
		$this->db->limit($limit, $offset);
		$results = $this->db->get('exp');
		if($results){
			return $results->result();
		}else{
			return $results->result();
		}
	}
	
	public function delete_exp($id){
		$this->db->where('exp_id', $id);
		return $this->db->delete('exp');
	}
	
	public function search_exp($dev_name){
			 $this->db->select('*');
			 $this->db->from('exp');
			 $this->db->like('exp_name', $dev_name);
			 $this->db->where('confirm', 1);
			 $this->db->or_like('payee_name', $dev_name);
			 $this->db->where('confirm', 1);
			 $this->db->or_like('payee_name', $dev_name);
			 $this->db->like('exp_name', $dev_name);
			 $this->db->where('confirm', 1);
			 $this->db->or_like('amount', $dev_name);
			 $this->db->where('confirm', 1);
			 $query = $this->db->get();
			 if($query->num_rows() > 0){
				 return $query->result();
			 }else{
				 return $query->result(); 
			 }
		 }
	public function count_exp(){
		$this->db->where('confirm', 1);
		return $this->db->count_all_results('exp');
	}
	
	public function count_sold_remain(){
		$this->db->where('dev_confirm',1);
		$this->db->where('sold',0);
		return $this->db->count_all_results('device');
	}
}
