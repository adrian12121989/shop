
		<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
<div class = "form-group">
	<div class = "col-xs-6 col-sm-6 col-lg-6">
		<h4><?php echo anchor('Home/add_device', 'Register New Device');?></h4>
		</div>
		<div class = "col-xs-6 col-sm-6 col-lg-6">
			<h4><?php echo anchor('Home/view_device', 'View Existing Devices');?></h4>
		</div>
	</div>
