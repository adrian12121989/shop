
	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	   <?php echo ($this->session->flashdata('property_confirm')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_confirm').'</div>' : '';?> 
     <?php echo ($this->session->flashdata('property_update')) ? '<div class = "alert alert-success">'.$this->session->flashdata('property_update').'</div>' : '';?>
      <?php echo ($this->session->flashdata('property')) ? '<div class = "alert alert-warning">'.$this->session->flashdata('property').'</div>' : '';?>   
	 <div class = "form-group">
		 <div class = "col-sm-12 col-xs-12 col-lg-12">
			 <?php if($this->session->userdata('access_lvl') == 3){?>
	  <h5><?php echo anchor('Home/add_device', 'Add New Device');?></h5>
	  <?php } ?>
	  </div>
	 </div>
	 
	 <?php if(isset($remain)){?>
				 Remained Devices to be Sold: <span class="badge"><?php echo $remain;?></span>
				<?php } else {?>
				Remained Devices to be Sold: <span class="badge">0</span>
			<?php } ?>
	 
	  <div class = "form-group">
			    <?php echo form_open('Home/search_device', 'class="form-inline", role = "form"');?>
		 <div class = "col-sm-5 col-xs-5 col-lg-5">
			
			
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
	
  <?php if(isset($devices)){?>
  <table class="table table-hover; table table-bordered">
    <thead>
		
      <tr>
        <th style = "background-color:#7F7F7F"><?php echo 'Name'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo ' Number'; ?></th>
          <th style = "background-color:#7F7F7F"><?php echo 'Imei Number'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Warranty'; ?></th>
         <th style = "background-color:#7F7F7F"><?php echo 'Price'; ?></th>
        <?php if($this->session->userdata('access_lvl') == 3){?>
         <th style = "background-color:#7F7F7F">Change</th>
         <?php } ?>
         <?php if($this->session->userdata('access_lvl') == 3){?>
         <th style = "background-color:#7F7F7F">Remove</th>
		<?php } ?>
		<?php if($this->session->userdata('access_lvl') == 1){?>
		<th style = "background-color:#7F7F7F">Sell </th>
			 <?php }?>
      </tr>
    </thead>
    <tbody>
		
	<?php foreach($devices as $result) { ?>
		<?php echo form_open('Home/add_device'); ?>
      <tr class="info">
        <td><small><?php echo ucwords($result->dev_name); ?></small></td>
        <td><small><?php echo ucwords($result->dev_number); ?></small></td>
        <td><small><?php echo ucwords($result->dev_imei); ?></small></td>
        <td><small><?php echo $result->dev_warranty; ?></small></td>
        <td><small><?php echo number_format($result->dev_price); ?></small></td>
        <td><input type="hidden" name="id" value="<?php echo $result->dev_id; ?>" />
        <?php if($this->session->userdata('access_lvl') == 3){?>
			<button type="submit" name="action" value="Edit" class="btn btn-info">Edit</button>
			</td>
        <td>
			<?=anchor("Home/delete_device/".$result->dev_id,"Delete",array('onclick' => "return confirm('Are you sure you want to remove  $result->dev_name from list?')"))?>
      <?php } else { ?>
		 <?=anchor("Home/sell_device". "/" . $result->dev_id, "Sell",array('onclick' => "return confirm('Are you sure you want to sell   $result->dev_name ?')"))?>
		  <?php } ?>
      </td>
      </tr>
       
            <?php echo form_close(); ?>
      <?php } ?>
    </tbody>
    <?php } if(isset($no_view)){?>
		<div class = "alert alert-success">Currently there is no property registered!!!!</div>
		<?php } ?>
  </table>
   <?php echo $links; ?>
</div>

