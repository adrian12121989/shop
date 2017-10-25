					<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<h3>Here you can view the report of all sold devices.</h3>
	<br>
	<h4 style = "">Please select date range to view report.</h4>
	<?php  echo form_open('Home/sold_device_report_pdf', 'class="form-horizontal role="form""'); ?>
		<div class = "form-group">
			<div class = "col-sm-4 col-xs-4 col-lg-4">
				<?php echo (form_error('from') != '') ? '<div style = "color:#FF0000">' . form_error('from') . '</div>' : ''; ?>
				<label for = "start" class = "pheading">Start Date*:</label>
				<input type = "text" name = "from" class = "form-control" id = "from">
			 </div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
				<?php echo (form_error('to') != '') ? '<div style = "color:#FF0000">' . form_error('to') . '</div>' : ''; ?>
				<label for = "end date" class = "pheading">End Date*:</label>
				<input type = "text" name = "to" class = "form-control" id = "to">
			 </div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			<br/>
				<button type = "submit" class = "btn btn-info">Generate Report </button>
			</div>
		 </div>
	<?php echo form_close();?>
	
	
		<?php if(isset($no_sold_device)) {?>
			<div class="alert alert-warning">There is no any record found from the date range selected
	</div>	
			<?php } else {?>
	<div class="alert alert-warning">You have not selected any date range
	</div>	
			<?php } ?>



