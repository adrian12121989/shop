		<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	
	 <div class = "form-group">
			    <?php echo form_open('Home/search_sold_device', 'class="form-inline", role = "form"');?>
		 <div class = "col-sm-5 col-xs-5 col-lg-5">
			<h3>List of all sold devices</h3>
		  </div>
		<div class = "col-sm-7 col-xs-7 col-lg-7">
		 <div class = "col-sm-6 col-xs-6 col-lg-6">
			  <input type = "text" name = "search" placeholder = "Search Sold Phone" class = "form-control">
			  </div>
		<div class = "col-sm-6 col-xs-6 col-lg-6">
			  <button type = "submit" class = "btn btn-info">Search</button>
			  </div>
			 </div>
		  <?php echo form_close();?>
	  </div>
		
  <?php if(isset($sold)){?>
  <table class="table table-hover; table table-bordered">
    <thead>
      <tr>
        <th style = "background-color:#7F7F7F"><?php echo 'Name'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Number'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Imei Number'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Minimum Price'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Selling Price'; ?></th>
         <th style = "background-color:#7F7F7F">Confirm</th>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($sold as $result) { ?>
		<?php echo form_open('Home/view_sold_devices'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->dev_name); ?></small></td>
        <td><small><?php echo ucwords($result->dev_number); ?></small></td>
        <td><small><?php echo ucwords($result->dev_imei); ?></small></td>
        <td><small><?php echo number_format($result->dev_price); ?></small></td>
        <td><small><?php echo number_format($result->sold_amount); ?></small></td>
        <td><?=anchor("Home/delete_sold_confirm/".$result->dev_id,"Okay!!!!",array('onclick' => "return confirm('By clicking OK you agree with the recorded information!')"))?>
      </tr>
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } else {?>
		<div class = "alert alert-success">Currently there is no device sold!!!!</div>
		<?php } ?>
  </table>
  <?php echo $links ;?>
</div>


