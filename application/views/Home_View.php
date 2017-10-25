

<br />
	
<div class="container-fluid">
	
  <div class="col-xs-3 col-md-6 col-lg-4" style="background-color:#FFFFFF;">
	  
	  <?php //echo validation_errors(); ?>
	  
	  
	  
	 <div class="nav nav-pill list-group" style="width: 80%; border: 1px solid green">
	  <h4>Main menu</h4>
	<a href="<?php echo base_url('index.php/Home/dashboard'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'dashboard' ? 'active' : ''; ?>" ><?php echo 'Dashboard'; ?></a>
	<a href="<?php echo base_url('index.php/Home/device_confirm'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'device_confirm' || ($this->uri->segment(2)) == 'device_confirm' || ($this->uri->segment(2)) == 'add_device'  || ($this->uri->segment(2)) == 'view_device' || ($this->uri->segment(2)) == 'sell_device'? 'active' : ''; ?>" > <?php echo 'Manage Devices'; ?></a>
	<?php if($this->session->userdata('access_lvl') == 3) { ?><!--Admistrator Section-->
	<a href="<?php echo base_url('index.php/Admin/manage_system_users'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'manage_system_users' || ($this->uri->segment(2)) == 'add_user' || ($this->uri->segment(2)) == 'access_result' ? 'active' : ''; ?>"> <?php echo 'Manage users'; ?></a>
	<a href="<?php echo base_url('index.php/Home/employees_results'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'employees_results' || ($this->uri->segment(2)) == 'employee_results' ? 'active' : ''; ?>" > <?php echo 'Employees'; ?></a>
	<a href="<?php echo base_url('index.php/Home/device_status'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'device_status' || ($this->uri->segment(2)) == 'view_sold_devices' || ($this->uri->segment(2)) == 'customers'? 'active' : ''; ?>" > <?php echo 'View Business Status'; ?></a>
	<a href="<?php echo base_url('index.php/Home/shop_expenditure_confirm'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'shop_expenditure_confirm' || ($this->uri->segment(2)) == 'view_exp'? 'active' : ''; ?>" > <?php echo 'Manage Shop Expenditure'; ?></a>
	
	<?php } else if($this->session->userdata('access_lvl') == 2) { ?>
	<a href="<?php echo base_url('index.php/Home/view_frecords'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'view_frecords' ? 'active' : ''; ?>" > <?php echo 'View Financial Records'; ?></a>
	<a href="<?php echo base_url('index.php/Home/trush_records'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'trush_records' ? 'active' : ''; ?>" > <?php echo 'View Deleted Financial Records'; ?></a>
	<a href="<?php echo base_url('index.php/Home/trushed_properties'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'trushed_properties' ? 'active' : ''; ?>" > <?php echo 'View Deleted Properties'; ?></a>
	<a href="<?php echo base_url('index.php/Home/view_inventories'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'view_inventories' || ($this->uri->segment(2)) == 'view_inventories' ? 'active' : ''; ?>" > <?php echo 'View Inventory Records'; ?></a>
   <a href="<?php echo base_url('index.php/Home/loan_info'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'loan_info' ? 'active' : ''; ?>" > <?php echo 'Loan Information'; ?></a>
    <?php } else if($this->session->userdata('access_lvl') == 4) { ?>
	<!--<a href="<?php// echo base_url('index.php/Admin/view_reg_users'); ?>" class="list-group-item <?php //echo ($this->uri->segment(2)) == 'view_reg_users' || ($this->uri->segment(2)) == 'view_reg_cv' ? 'active' : ''; ?>" > <?php //echo $this->lang->line('view_users'); ?></a>-->
    <a href="<?php echo base_url('index.php/Admin/manage_system_users'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'manage_system_users' ? 'active' : ''; ?>"> <?php echo $this->lang->line('manage_users'); ?></a>
     <a href="<?php echo base_url('index.php/Admin/add_user'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'add_user' || ($this->uri->segment(2)) == 'access_result' ? 'active' : ''; ?>" > <?php echo $this->lang->line('add_moderator'); ?></a>
	
		<?php } ?>
	<a href="<?php echo base_url('index.php/Home/changepass'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'changepass' ? 'active' : ''; ?>" ><?php echo 'Change Password'; ?></a>
    <a href="<?php echo base_url('index.php/Home/logout'); ?>" class="list-group-item <?php echo ($this->uri->segment(2)) == 'logout' ? 'active' : ''; ?>" ><?php echo 'Log Out'; ?></a>

    <br />
<div class="dropup col-xs-3">
    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">View Device Reports
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
	  
      <?PHP if($this->session->userdata('access_lvl') == 3) { ?>
       
       <li><a href="<?php echo base_url('index.php/Home/registered_device_report') ?>"><font color="green"><b>Registered Devices Report</b></font></a></li> 
       <li><a href="<?php echo base_url('index.php/Home/sold_device_report') ?>"><font color="green"><b>Sold Devices Report</b></font></a></li>
       <li><a href="<?php echo base_url('index.php/Home/device_status_report') ?>"><font color="green"><b>Devices Status Report</b></font></a></li>
        <li><a href="<?php echo base_url('index.php/Home/exp_report') ?>"><font color="green"><b>Expenditure Report</b></font></a></li>
      <?php } ?>
    </ul>
  </div>
	</div>
  </div>
  <div class="col-xs-9 col-md-6 col-lg-8" style="background-color:#ffffff; float:left" id="<?php echo base_url().'index.php/Home/'.$this->uri->segment(2); ?>">
      <style type="text/css"> label { color: green }</style>
     
	
