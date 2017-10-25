<?php

?>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top"  style = "background-color:  #8B6914" role="navigation">
	<div class="container" style = "background-color: #8B6914; width: auto">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url() ; ?>"><?php //echo $this->lang->line('system_system_name'); ?></a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
			<?php
			
			//echo "<li class=''>" . anchor('Job_Controller/volunteer', 'Volumteer Oportunities') . "</li>";
			//echo "<li class=''>" . anchor('Job_Controller/field', 'Field Practical Training (FPT)') . "</li>";
			?>
				
			</ul>
			<ul class = "nav navbar-nav navbar-right">
				<?php if(!$this->session->userdata('logged_in')) {
					$uri_register = ($this->uri->segment(2) == 'register') ? 'active' : '';
					//echo "<li class='$uri_register'>" . anchor('Home/register', 'Register') . "</li>";
				} else {
					$uri_das = ($this->uri->segment(2) == 'dashboard') ? 'active' : '';
					if($this->session->userdata('access_level') == 4) {
						echo "<li class='$uri_das'>" . anchor('Home/dashboard', 'DVC Office') . "</li>";
					}
					else if($this->session->userdata('access_level') == 3) {
				}
					else {
					echo "<li class='$uri_das'>" . anchor('Home/dashboard', 'Dashboard') . "</li>";
					//$uri_app = ($this->uri->segment(2) == 'myApplication') ? 'active' : '';
					//$uri_job = ($this->uri->segment(2) == 'job_alert') ? 'active' : '';
					//echo ($this->session->userdata('access_level') == 1) ? "<li class='$uri_job'>" . anchor('Home/job_alert', 'Job Alert') . "</li>" : '';
					//echo ($this->session->userdata('access_level') == 1) ? "<li class='$uri_app'>" . anchor('Home/myApplication', 'My Application(s)') . "</li>" : '';
				}
				}
				if(!$this->session->userdata('logged_in')) {
					$uri_login = ($this->uri->segment(2) == 'login') ? 'active' : '';
				//echo "<li class='$uri_login'>" . anchor('Home/login', 'Login') . "</li>";
			} else
			{
				$uri_changep = ($this->uri->segment(2) == 'changepass') ? 'active' : '';
				echo "<li class='$uri_changep'>" . anchor('Home/changepass', 'Change Password') . "</li>";
				echo "<li class=''>" . anchor('Home/logout', 'Logout') . "</li>";
			}
			
			?>
				</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<div class="container theme-showcase" role="main">
