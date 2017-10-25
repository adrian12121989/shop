<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<?php if(isset($trushed_properties)) {?>
	<h4 style = "color:#008000">List of Deleted Properties.</h4>
	
		<div class="table-responsive" >  
			
			  <table class="table">
						<thead>
							  <tr>
								<th>Property Name</th>
								<th>Working Status</th>
								<th>Location</th>
								<th>Item Value</th>
								<th>Custodian</th>
							  </tr>
						</thead>
						<tbody>
						
							
								<?php foreach($trushed_properties as $detail) {?>
						<?php echo form_open('Home/property');?> 
							  <tr class = "info">
								<td><?php echo $detail->item_name;?></td>
								<td><?php echo $detail->work_status;?></td>
								<td><?php echo $detail->location;?></td>
								<td><?php echo $detail->item_value;?></td>
								<td><?php echo $detail->custodian;?></td>
								<td><?=anchor("Home/okay_property/".$detail->item_id,"Okay!!!",array('onclick' => "return confirm('By clicking OK it means there is no proplem with deleted property!!!')"))?></td>
							  </tr>
						<?php echo form_close();?>
				  <?php } ;?>
				 
				  <?php } else {?>
					  <div class = "alert alert-success">Currently there is no property deleted by the admin</div>
					  <?php } ?>
						</tbody>
				  </table>
				   <?php echo $links; ?>
			
		  </div>
	
	
	
	



