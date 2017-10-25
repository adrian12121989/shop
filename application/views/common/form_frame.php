
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<link href="/assets/css/screen.css" rel="stylesheet" type="text/css" />

<!--  the following two lines load the jQuery library and JavaScript files -->
<script src="/js/jquery.js" type="text/javascript"></script>
<script src="/js/try.js" type="text/javascript"></script>
<script src="/assets/js/global.js" type="text/javascript"></script>

<title><?php echo $title;?></title>
</head>
<body>
<h4><?php echo $this->lang->line('contact_header'); ?></h4>
<form class="form-horizontal" role="form">
<div class="form-group">
      <div class="col-sm-5"> 
		  <label><?php echo $this->lang->line('p_email'); ?></label>         
        <input type="text" name="p_email" class="form-control" id="username" value="<?php echo $this->session->userdata('user_email'); ?>"
        >
      </div>
      <div class="col-sm-5">
		  <label><?php echo $this->lang->line('p_mobile'); ?></label>          
        <input type="text" name="p_mobile" class="form-control" id="dob" placeholder="(255)">
      </div>
    </div>
    <div class="form-group">
		<div class="col-sm-5">
		  <label><?php echo $this->lang->line('p_current_address'); ?></label>          
        <textarea type="text" name="p_current_address" class="form-control" id="p_postal_address" placeholder="Enter physical address"></textarea>
      </div>
      <div class="col-sm-5">
		  <label><?php echo $this->lang->line('p_permanent_address'); ?></label>          
        <textarea type="text" name="p_permanent_address" class="form-control" id="p_permanent_address" placeholder="Enter permanent physical address"></textarea>
      </div>
	</div>
	<div class="form-group">
      <div class="col-sm-5"> 
		  <label><?php echo $this->lang->line('p_work_telephone'); ?></label>         
        <input type="text" name="p_work_telephone" class="form-control" id="p_work_telephone" placeholder="Enter work telephone">
      </div>
      <div class="col-sm-5">
		  <label><?php echo $this->lang->line('p_country'); ?></label>
		  <select id="pcountry" name="pcountry" class="form-control">
		  <option value="tanzania">Tanzania</option>
		  <option value="other">Other</option> 
		  </select>
		  </div>
      </div>
      <div class="form-group">
      <div class="col-sm-5">
		  <label><?php echo $this->lang->line('p_region'); ?></label>
		  <select name="p_region" id="p_region" class="form-control">
		  <option value="">--select region--</option>
		  <?php foreach($regions as $region) { ?>
		  <option value="<?php echo $region; ?>"><?php echo $region; ?></option>
		  <?php } ?> 
		  </select>
		  </div>
		 <div id="countrymention" class="col-sm-5"> 
		  <label><?php echo $this->lang->line('country_mention'); ?></label>         
        <input type="text" name="country" class="form-control" placeholder="Enter your country">
      </div>
      </div>
	<div class="form-group">       
      <div class="col-sm-5">
        <button type="submit" class="btn btn-md btn-success btn-block">Submit</button>
      </div>
    </div>
</form>
</body>
