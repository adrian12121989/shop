		<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>

	<h3>Here you can view the report of all registered devices.</h3>
	<br><br>
	<h4 style = "color:#0003FF">Please select date range to view report.</h4>
	<?php echo form_open('Home/registered_device_report_pdf', 'class = "form-horizontal role = "form""');?>
	
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<br>
			<?php echo (form_error('to') != '') ? '<div style = "color:#FF0000">' . form_error('to') . '</div>' : ''; ?>
			<label for = "from">From Date:*</label>
			<input type = "text" class = "form-control" name = "from" id = "from">
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<br>
			<?php echo (form_error('to') != '') ? '<div style = "color:#FF0000">' . form_error('to') . '</div>' : ''; ?>
		<label for = "from">To Date:*</label>	
		<input type = "text" class = "form-control" name = "to" id = "to">
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<br><br>
			<button type = "submit" class = "btn btn-info">Generate Report</button>
			</div>
		</div>
	
	<?php echo form_close();?>
