	
	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	   <?php echo ($this->session->flashdata('property_confirm')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_confirm').'</div>' : '';?> 
     <?php echo ($this->session->flashdata('property_update')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_update').'</div>' : '';?>
      <?php echo ($this->session->flashdata('property')) ? '<div class = "alert alert-warning">'.$this->session->flashdata('property').'</div>' : '';?>   
	 <div class = "form-group">
		 <div class = "col-sm-12 col-xs-12 col-lg-12">
			 <?php if($this->session->userdata('access_lvl') == 3){?>
	  <h5><?php echo anchor('Home/shop_expenditure', 'Add New Expenditure');?></h5>
	  <?php } ?>
	  </div>
	 </div>
	 
	  <div class = "form-group">
			    <?php echo form_open('Home/search_expd', 'class="form-inline", role = "form"');?>
		 <div class = "col-sm-5 col-xs-5 col-lg-5">
			<h3 style = "color:black">Registered Devices:</h3>
		  </div>
		<div class = "col-sm-7 col-xs-7 col-lg-7">
		 <div class = "col-sm-6 col-xs-6 col-lg-6">
			  <input type = "text" name = "search" placeholder = "Search Phone" class = "form-control">
			  </div>
		<div class = "col-sm-6 col-xs-6 col-lg-6">
			  <button type = "submit" class = "btn btn-info">Search</button>
			  </div>
			 </div>
		  <?php echo form_close();?>
	  </div>
  <?php if(isset($expd)){?>
  <table class="table table-hover; table table-bordered">
    <thead>
		
      <tr>
        <th style = "background-color:#7F7F7F"><?php echo 'Expenditure Name'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Paid To'; ?></th>
          <th style = "background-color:#7F7F7F"><?php echo 'Amount'; ?></th>
          <th style = "background-color:#7F7F7F"><?php echo 'Date'; ?></th>
          <th style = "background-color:#7F7F7F"><?php echo 'Registered By'; ?></th>
           <th style = "background-color:#7F7F7F"><?php echo 'Delete'; ?></th>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($expd as $result) { ?>
		<?php echo form_open('Home/add_device'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->exp_name); ?></small></td>
        <td><small><?php echo ucwords($result->payee_name); ?></small></td>
        <td><small><?php echo number_format($result->amount); ?></small></td>
        <td><small><?php echo $result->exp_date; ?></small></td>
        <td><small><?php echo ucwords($result->exp_by); ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->exp_id; ?>" />
       
			<?=anchor("Home/delete_exp/".$result->exp_id,"Delete",array('onclick' => "return confirm('Are you sure you want to remove  $result->exp_name from list?')"))?>
     
      </td>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } if(isset($no_expd)){?>
		<div class = "alert alert-success">Currently there is no property registered!!!!</div>
		<?php } ?>
  </table>
   <?php echo $links; ?>
</div>


