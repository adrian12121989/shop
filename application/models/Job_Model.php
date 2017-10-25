	<?php
	if(! defined('BASEPATH')) exit('No direct sc ript success allowed');
	
		class Job_Model extends CI_Model
		{
			public function call_interview($user_id)
			{
				$this->db->select('*');
				$this->db->from('call_for_interview');
				$this->db->join('interview_info', 'interview_info.info_id = call_for_interview.info_id', 'left');
				$this->db->join('jobs', 'jobs.job_id = call_for_interview.job_id', 'left');
				$this->db->where('call_for_interview.user_id', $user_id);
				return $this->db->get();
			}
			
			public function not_update_img($id)
			{
				$sql = "SELECT * FROM academic WHERE academic_id = " . $id;
				return $this->db->query($sql);
			}
			public function user_application($limit, $user_id)
			{
				$sql = "SELECT * FROM jobs, user_application WHERE jobs.job_id=user_application.job_id AND user_application.user_id = ? ORDER BY app_id DESC LIMIT " . $limit;
				return $this->db->query($sql, array($user_id));
			}
			
			public function job_results($limit)
			{
				$sql = "SELECT * FROM jobs WHERE DATE(NOW()) >= DATE(sunset_date) ORDER BY job_id DESC LIMIT " . $limit;
				return $this->db->query($sql);
			}
			
			public function get_job($search)
			{
				$this->db->select('job_title');
				$this->db->like('job_title', $search);
				$query = $this->db->get('jobs');
				if($query->num_rows() > 0)
				{
					foreach($query->result_array() as $row)
					{
						$row_set[] = htmlentities(stripslashes($row['job_title']));
					}
					echo json_encode($row_set);
				}
			}
			
			public function application_data($app_data)
			{
				return $this->db->insert('user_application', $app_data);
			}
			
			public function alert_details($job_alert)
			{
				return $this->db->insert('job_alert', $job_alert);
			}
			
			public function alert_edit($user_id)
			{
				$sql = 'SELECT * FROM job_alert WHERE user_id = ? ORDER BY alert_id DESC LIMIT 1';
				$alert_edit = $this->db->query($sql, array($user_id));
				if($alert_edit)
				{
					return $alert_edit;
				}
				else
				{
					return false;
				}
					
			}
			
			public function jobs_alert()
			{
				$sql = "SELECT * FROM jobs, job_alert WHERE jobs.dep_id = job_alert.dep_id ORDER BY job_id DESC LIMIT 1";
				return $this->db->query($sql);
			}
			
			public function update_alert($job_alert, $alert_id)
			{
				$this->db->where('alert_id', $alert_id);
				return $this->db->update('user_application', $job_alert);
			}
			
			public function user_applied($user_id)
			{
				$sql = "SELECT * FROM user_application WHERE user_id = ? ";
				return $this->db->query($sql, array($user_id));
			}
			
			public function user_info_exist($user_id)
			{
				$sql = "SELECT * FROM academic, p_details, contacts, refarees WHERE academic.user_id = ? AND p_details.user_id = ? AND 
				contacts.user_id = ? AND refarees.user_id = ? ";
				return $this->db->query($sql, array($user_id, $user_id, $user_id, $user_id));
			}
			
			public function income_report()
			{
				$sql = "SELECT * FROM record, income WHERE record.income_id = income.income_id and confirmed = 1";
				
				return $this->db->query($sql);
			}
			
			public function view_cv_work($user_id)
			{
				$sql = "SELECT * FROM user, w_experience
				WHERE user.user_id = ? AND w_experience.user_id = ? ";
				return $this->db->query($sql, array($user_id, $user_id));
			}
			
			public function view_cv_train($user_id)
			{
				$sql = "SELECT * FROM user, training
				WHERE user.user_id = ? AND training.user_id =? ";
				return $this->db->query($sql, array($user_id, $user_id));
			}
			
			public function view_cv_ref($user_id)
			{
				$sql = "SELECT * FROM user, refarees
				WHERE user.user_id = ? AND refarees.user_id =? ";
				return $this->db->query($sql, array($user_id, $user_id));
			}
			
			public function qualification($qualification_data)
			{
				return $this->db->insert('academic', $qualification_data);
			}
			
			public function qualification_update($qualification_data, $acc_id)
			{
				$this->db->where('academic_id', $acc_id);
				return $this->db->update('academic', $qualification_data);
			}
			
			public function referee($referee_data)
			{
				return $this->db->insert('refarees', $referee_data);
			}
			public function referee_update($referee_data, $r_id)
			{
				$this->db->where('r_id', $r_id);
				return $this->db->update('refarees', $referee_data);
			}
			
			public function training($training_data)
			{
				return $this->db->insert('training', $training_data);
			}
			public function training_update($training_data, $training_id)
			{
				$this->db->where('training_id', $training_id);
				return $this->db->update('training', $training_data);
			}
			
			public function experience_update($experience_data, $w_id)
			{
				$this->db->where('w_id', $w_id);
				return $this->db->update('w_experience', $experience_data);
			}
			
			public function experience($experience_data)
			{
				return $this->db->insert('w_experience', $experience_data);
			}
			
			public function property($property_data)
			{
				return $this->db->insert('invetory', $property_data);
			}
			public function property_update($property_data, $invetory_id)
			{
				$this->db->where('item_id', $invetory_id);
				return $this->db->update('invetory', $property_data);
			}
			
			public function financial($financial_data, $financial_id)
			{
				if($financial_id == 'income category')
				return $this->db->insert('income', $financial_data);
				else
				return $this->db->insert('expenditure', $financial_data);
			}
			
			public function last_income($financial_id)
			{
				if($financial_id == 'income category')
				$sql = 'SELECT * FROM income ORDER BY income_id DESC LIMIT 1';
				else
				$sql = 'SELECT * FROM expenditure ORDER BY exp_id DESC LIMIT 1';
				return $this->db->query($sql);
			}
			
			public function record_income($record_income)
			{
				return $this->db->insert('record', $record_income);
			}
			
			public function financial_update($incomes_data, $record_id, $fcategory)
			{
				if($fcategory == 'income category') {
				$this->db->where('income_id', $record_id);
				return $this->db->update('income', $incomes_data);
				}
				else
				{
					$this->db->where('exp_id', $record_id);
					return $this->db->update('expenditure', $incomes_data);
				}
			}
			
			public function referee_delete($id)
			{
				$this->db->where('r_id', $id);
				return $this->db->delete('refarees');
			}
			
			public function financial_delete($id)
			{
				$this->db->set('trush', 1);
				$this->db->where('record_id', $id);
				$this->db->update('record');
				
			}
			
			public function financial_permanet_delete($id)
			{
				//$this->db->where('income_id', $id);
				$this->db->delete('record', array('record_id' => $id));
				
			}
			
			public function financial_confirm($id)
			{
				$this->db->set('confirmed', 1);
				$this->db->where('record_id', $id);
				$this->db->update('record');
				
			}
			
			public function property_confirm($id)
			{
				$this->db->set('confirmed', 1);
				$this->db->where('item_id', $id);
				$this->db->update('invetory');
				
			}
			
			public function attachment_delete($id)
			{
				$this->db->where('other_id', $id);
				return $this->db->delete('other_attachment');
			}
			
			public function training_delete($id)
			{
				$this->db->where('training_id', $id);
				return $this->db->delete('training');
			}
			
			public function experience_delete($id)
			{
				$this->db->where('w_id', $id);
				return $this->db->delete('w_experience');
			}
			
			public function referee_results($user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM refarees WHERE user_id = ?';
			
				$query = $this->db->query($sql, array($user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function training_results($user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM training WHERE user_id = ?';
			
				$query = $this->db->query($sql, array($user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function property_results($user_id)
			{	
				//prepare the database query
				//$sql = 'SELECT * FROM invetory WHERE confirmed = 0 AND user_id = ?';
			
				//$query = $this->db->query($sql, array($user_id));
				//if($query)
				//{
					//return $query;
				//}
				//else
				//{
				//	return false;
				//}
				$this->db->where('confirmed', 0);
				$this->db->where('user_id', $user_id);
				$results = $this->db->get('invetory');
				if($results->num_rows() > 0){
					return $results->result();
				}else{
					return $results->result();
				}
				
			}
			
			//count results
			public function count_inventory($user_id){
				$this->db->where('confirmed', 0);
				$this->db->where('user_id', $user_id);
				return $this->db->count_all('invetory');
		}
			
			public function experience_results($user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM w_experience WHERE user_id = ?';
			
				$query = $this->db->query($sql, array($user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function financial_results($user_id)
			{	
				//prepare the database query
				//$sql = 'SELECT * FROM income';
				$this->db->select('*');
				$this->db->from('record');
				$this->db->join('income', 'record.income_id = income.income_id', 'left');
				$this->db->join('expenditure', 'record.exp_id = expenditure.exp_id', 'left');
				$this->db->order_by('irecord_date', 'desc');
				$this->db->where('confirmed', 0);
				$this->db->where('user_id', $user_id);
				$query = $this->db->get();
				if($query)
				{
					return $query->result();
				}
				else
				{
					return $query->result();
				}
				
			}
			
			public function view_frecords($trush, $limit, $offset)
			{	
				$this->db->select('*');
				$this->db->from('record');
				$this->db->join('income', 'record.income_id = income.income_id', 'left');
				$this->db->join('expenditure', 'record.exp_id = expenditure.exp_id', 'left');
				$this->db->join('users', 'record.user_id = users.user_id', 'left');
				$this->db->order_by('irecord_date','desc');
				$this->db->order_by('record_date','desc');
				$this->db->where('confirmed', 1);
				$this->db->limit($limit, $offset);
				if($trush == 'trush_records')
				$this->db->where('trush', 1);
				else
				$this->db->where('trush', 0);
				$query = $this->db->get();
				if($query)
				{
					return $query->result();
				}
				else
				{
					return $query->result();
				}
				
			}
			
			//deleting the income and income at once
			public function delete_financial_permanent($record_id){
				$sql = "DELETE i, r FROM income i JOIN record r ON i.income_id = r.income_id  WHERE r.record_id = ? ";
				$results = $this->db->query($sql, array($record_id));
				if($results){
					return $results;
				}else{
					return false;
				}
			}
			
			//deleting the income and expenditure at once
			public function delete_financial_permanent_exp($record_id){
				$sql = "DELETE e, r FROM expenditure e JOIN record r ON e.exp_id = r.exp_id  WHERE r.record_id = ? ";
				$results = $this->db->query($sql, array($record_id));
				if($results){
					return $results;
				}else{
					return false;
				}
			}
			
			//view all of the financial records which are deleted pagination
			public function count_all_deleted_frecord(){
				$this->db->where('trush', 1);
				return $this->db->count_all('record');
			}
			//view all of the financial information for pagination
			public function count_all_frecord(){
				$this->db->where('trush', 0);
				return $this->db->count_all('record');
			}
			
			//
			
			public function acc_result($user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM academic WHERE user_id = ?';
			
				$query = $this->db->query($sql, array($user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function acc_edit($id, $user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM academic WHERE academic_id = ? AND user_id = ?';
			
				$query = $this->db->query($sql, array($id, $user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function attachment_edit($id, $user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM other_attachment WHERE other_id = ? AND user_id = ?';
			
				$query = $this->db->query($sql, array($id, $user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function referee_edit($id, $user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM refarees WHERE r_id = ? AND user_id = ?';
			
				$query = $this->db->query($sql, array($id, $user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function experience_edit($id, $user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM w_experience WHERE w_id = ? AND user_id = ?';
			
				$query = $this->db->query($sql, array($id, $user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function financial_edit($id)
			{	
				//prepare the database query
				//$sql = 'SELECT * FROM record, income, expenditure WHERE income_id = ?';
				$this->db->select('*');
				$this->db->from('record');
				$this->db->join('income', 'record.income_id = income.income_id', 'left');
				$this->db->join('expenditure', 'record.exp_id = expenditure.exp_id', 'left');
				$this->db->where('record_id', $id);
				$query = $this->db->get();
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function property_edit($id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM invetory WHERE item_id = ?';
			
				$query = $this->db->query($sql, array($id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function training_edit($id, $user_id)
			{	
				//prepare the database query
				$sql = 'SELECT * FROM training WHERE training_id = ? AND user_id = ?';
			
				$query = $this->db->query($sql, array($id, $user_id));
				if($query)
				{
					return $query;
				}
				else
				{
					return false;
				}
				
			}
			
			public function register_form($register)
			{
				return $this->db->insert('user', $register);
			}
			
			public function login_form($email)
			{	
				//prepare the database query
				$this->db->where('username', $email);
			
				$query = $this->db->get('users');
				
				return $query;
			}
			
			public function user_exist($id)
			{	
				//prepare the database query
				$this->db->where('user_id', $id);
			
				$result = $this->db->get('record');
				
				return $result;
			}
			
			public function user_property_exist($id)
			{	
				//prepare the database query
				$this->db->where('user_id', $id);
			
				$result = $this->db->get('invetory');
				
				return $result;
			}
			
			public function change_pass($old_password, $user_id)
			{
				$query = 'SELECT * FROM users WHERE password = ? AND user_id = ?';
				$results = $this->db->query($query, array($old_password, $user_id));
				if($results)
				{
					return $results;
				}
				else
				{
					return false;
				}
			}
			
			public function update_pass($new_password, $user_id)
			{
				
				$query = 'UPDATE users SET password = ? WHERE user_id = ?';
				$result = $this->db->query($query, array($new_password, $user_id));
				if($result)
				{
					return $result;
				}
				else
				{
					return false;
				}
			}
			
		//fetch all invetories for admin 
		public function fetch_all_inventories($limit, $offset){
			$this->db->where('confirmed', 1);
			$this->db->where('trush', 0);
			$this->db->limit($limit, $offset);
			$results = $this->db->get('invetory');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//trush the inventories
		public function trush_inventory($id){
			$this->db->set('trush',1);
			$this->db->where('item_id', $id);
			return $this->db->update('invetory');
		}
		
		//view all deleted properties
		public function trushed_properties($limit, $offset){
			$this->db->where('trush',1);
			$this->db->limit($limit, $offset);
			$results = $this->db->get('invetory');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//delete permanent the inventory
		public function okay_property($item_id){
			$this->db->where('trush',1);
			$this->db->where('item_id', $item_id);
			return $this->db->delete('invetory');
		}
		//count all inventory rows for pagination
		public function count_all_inventory(){
			$this->db->where('trush',0);
			return $this->db->count_all('invetory');
		}
		
		//manager viewing deleted inventories pagination
		public function count_all_deleted_inventories(){
			$this->db->where('trush',1);
			return $this->db->count_all('invetory');
		}
		
		
		//report generating for inventory 
		public function inventory_report($from, $to){
			$where = "date >= '".$from."' AND date <= '".$to."'";
			$this->db->where($where);
			$results = $this->db->get('invetory');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
	//income report
		public function income_report_pdf($from, $to){
			$where = "irecord_date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where($where);
			$results = $this->db->get('income');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		
		//finalizing with loan report
		public function loan($data, $category){
			if($category == 'Loan Borrowing'){
				return $this->db->insert('borrow', $data);
			}else{
				return $this->db->insert('pay', $data);
			}
		}
		
		//for editing the borrowed money
		public function select_borrow($user_id){
			$this->db->select('*');
			$this->db->from('borrow', 'pay');
			$this->db->join('employees','borrow.bname = employees.emp_id','pay.pname = employees.emp_id','left');
			$this->db->where('confirm', 0);
			$this->db->where('buser_id', $user_id);
			$results = $this->db->get();
			if($results->num_rows() > 0){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//confirming borrowing
		public function confirm_borrow($id){
			$this->db->set('confirm', 1);
			$this->db->where('borrow_id', $id);
			return $this->db->update('borrow');
		}
		
		public function borrow_edit($id, $category){
			if($category == "Loan Borrowing"){
				$this->db->select('*');
				$this->db->from('borrow');
				$this->db->join('employees','borrow.bname = employees.emp_id', 'left');
				$this->db->where('borrow_id', $id);
				$query = $this->db->get();
				if($query)
				{
					return $query->result();
				}
				else
				{
					return $query->result();
				}
			}
		else{
			$this->db->select('*');
				$this->db->from('pay');
				$this->db->join('employees','pay.pname = employees.emp_id', 'left');
				$this->db->where('pay_id', $id);
				$query = $this->db->get();
				if($query)
				{
					return $query->result();
				}
				else
				{
					return $query->result();
				}
		}
	}
			
		//updating the loan records
		public function update_loan($data, $category, $loan_id){
			if($category == 'Loan Borrowing'){
				$this->db->where('borrow_id', $loan_id);
				return $this->db->update('borrow', $data);
			}else{
				$this->db->where('pay_id', $loan_id);
				return $this->db->update('pay', $data);
			}
		}
		
		//payment issues
		//for editing the borrowed money
		public function select_pay($user_id){
			$this->db->select('*');
			$this->db->from('pay');
			$this->db->join('employees','pay.pname = employees.emp_id', 'left');
			$this->db->where('confirmed', 0);
			$this->db->where('user_id', $user_id);
			$results = $this->db->get();
			if($results->num_rows() > 0){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//----------------now complete loan allocation---------------//
		//selecting all employees
		public function select_all_employees(){
			$query = $this->db->get('employees');
			if($query->num_rows() > 0){
				return $query->result();
			}else{
				return false;
			}
		}
		
		//inserting the borrowed amount of money
		public function insert_borrow($data){
			return $this->db->insert('borrow', $data);
		}
		
		//displaying current inserted borrow
		public function select_borrow_confirm($user_id){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->join('employees', 'employees.emp_id = borrow.bname', 'left');
			$this->db->where('confirm', 0);
			$this->db->where('buser_id', $user_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//for editing the data
		public  function edit_loan_borrow($borrow_id){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->join('employees', 'employees.emp_id = borrow.bname', 'left');
			$this->db->where('borrow_id', $borrow_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//updating the borrow
		public function update_borrow($data, $borrow_id){
			$this->db->where('borrow_id', $borrow_id);
			return $this->db->update('borrow', $data);
		}
		//updating the pay
		public function update_pay($data, $pay_id){
			$this->db->where('pay_id', $pay_id);
			return $this->db->update('pay', $data);
		}
		
		//selcet all from borrow for id comparison
		public function select_borrow_id(){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->where('confirm', 1);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//iserting the payment records
		public function insert_payment($data){
			return $this->db->insert('pay', $data);
		}
		
		public function select_pay_confirm($user_id){
			$this->db->select('*');
			$this->db->from('pay');
			$this->db->join('employees', 'employees.emp_id = pay.pname', 'left');
			$this->db->where('confirmed', 0);
			$this->db->where('puser_id', $user_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//confirm loan payment
		public function confirm_loan_pay($id){
			$this->db->set('confirmed', 1);
			$this->db->where('pay_id', $id);
			return $this->db->update('pay');
		}
		
		//check if the user has payed already the first payment
		public function check_first_payment($emp_id){
			$this->db->select('*');
			$this->db->from('pay');
			$this->db->where('pname', $emp_id);
			$this->db->where('confirmed', 1);
			$results = $this->db->get();
			if($results){
				return $results;
			}else{
				return false;
			}
		}
		
		//updating the current loan information
		public function update_pay_loan($data, $id){
			$this->db->where('pname', $id);
			return $this->db->update('pay', $data);
		}
		
		//grant loan select for pdf report
		public function grant_loan_select_report($from, $to){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->join('employees', 'employees.emp_id = borrow.bname', 'left');
			$where = "date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where('confirm', 1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//grant payment select for pdf report
		public function pay_loan_select_report($from, $to){
			$this->db->select('*');
			$this->db->from('pay');
			$this->db->join('employees', 'employees.emp_id = pay.pname', 'left');
			$where = "pdate BETWEEN '".$from."' AND '".$to."'";
			$this->db->where('confirmed', 1);
			$this->db->where($where);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		//expenditure report
		public function expenditure_report_pdf($from, $to){
			$where = "record_date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where($where);
			$results = $this->db->get('expenditure');
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//loan status everything is here
		public function create_loan_report_pdf($from, $to){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->join('employees', 'employees.emp_id = borrow.bname', 'left');
			$this->db->join('pay', 'pay.pname = borrow.bname', 'left');
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//income and expenditure report
		public function select_income_expenditure_report($from, $to){
			$this->db->select('*');
			$this->db->from('record');
			$this->db->join('income', 'record.income_id = income.income_id', 'left');
			$this->db->join('expenditure', 'record.exp_id = expenditure.exp_id', 'left');
			$where = "date BETWEEN '".$from."' AND '".$to."'";
			$this->db->where($where);
			$results = $this->db->get();
			if($results->num_rows() > 0){
				return $results->result();
			}else{
				return $results->result();
			}
		}
		
		//check if he/she borrowed the money
		public function check_first_borrowed($emp_id){
			$this->db->select('*');
			$this->db->from('borrow');
			$this->db->where('bname', $emp_id);
			$this->db->where('confirm', 1);
			$results = $this->db->get();
			if($results){
				return $results;
			}else{
				return false;
			}
		}
		//updating the current grant loan information
		public function update_borrow_loan($data, $id){
			$this->db->where('bname', $id);
			return $this->db->update('borrow', $data);
		}
		
		//edit payment
		public  function edit_loan_paid($pay_id){
			$this->db->select('*');
			$this->db->from('pay');
			$this->db->join('employees', 'employees.emp_id = pay.pname', 'left');
			$this->db->where('pay_id', $pay_id);
			$results = $this->db->get();
			if($results){
				return $results->result();
			}else{
				return $results->result();
			}
		}
	}

	?>
