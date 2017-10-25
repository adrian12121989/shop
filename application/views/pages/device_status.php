	<div class="alert alert-success">Welcome <?php echo '<b><i>'. $this->session->userdata['first_name'].' '. $this->session->userdata['last_name']. '</i></b>' ;?>
	</div>
	<div class = "form-group">
		<div class = "col-sm-2 col-xs-2 col-lg-2">
			</div>
			<div class = "col-sm-8 col-xs-8 col-lg-8">
				<h3 style = "color:#8B6914">How  Business is Currently</h3>
			</div>
			<div class = "col-sm-2 col-xs-2 col-lg-2">
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			
			Currently Registered Devices.<br>
			<?php if(isset($total_devices)){?>
				
			 <span class="badge"><?php echo $total_devices;?></span>
			<?php } else {?>
			<span class="badge">0</span>	
				<?php } ?>
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			Sold Devices.<br/>
			<?php if(isset($sold_devices)){?>
				
			<span class="badge"><?php echo $sold_devices;?></span>
			<?php } else {?>
				<span class="badge">0</span>
				<?php } ?>
			</div>
		<div class = "col-sm-4 col-xs-4 col-lg-4">
			Remained Devices.</br>
			<?php if(isset($total_devices) or ($sold_devices)){?>
				<?php $remain = $total_devices - $sold_devices?>
			<span class="badge"><?php echo $remain;?></span>
			<?php } else {?>
			<span class="badge">0</span>	
				<?php } ?>
			</div>
		</div>
	<div class = "form-group">
		<div class = "col-sm-4 col-lg-4 col-xs-4">
			<br><br>
			Registered Devices Total Costs.<br/>
			<?php if(isset($sumregistered)){ $sumreg = 0; ?>
				
				<?php foreach($sumregistered as $result){$sumreg += $result->dev_price; ?>
					
				<?php }  echo '<span class="badge">'.number_format($sumreg).'</span>'; } else {?>
				<span class="badge">0</span>
					<?php } ?>
			</div>
		<div class = "col-sm-4 col-lg-4 col-xs-4">
			<br><br>
			Total Amount of Sold Devices.<br/>
			<?php if(isset($sumregistered)){ $solddev = 0; ?>
				
				<?php foreach($sumregistered as $result){$solddev += $result->sold_amount; ?>
					
				<?php }  echo '<span class="badge">'.number_format($solddev).'</span>'; } else {?>
				<span class="badge">0</span>
					<?php } ?>
			</div>
		<div class = "col-sm-4 col-lg-4 col-xs-4">
			<br><br>
			Total Profit Made.<br/>
			<?php if(isset($sumregistered)){ $sumdif = 0; ?>
				
				<?php foreach($sumregistered as $result){$sumdif += ($result->sold_amount)-($result->dev_price); ?>
					
				<?php }
				if($sumdif < 0){
					echo 'Loss<span class="badge"> '.number_format($sumdif).'</span>';
				}else{
				  echo '<span class="badge">'.number_format($sumdif).'</span>'; } }else {?>
				<span class="badge">0</span>
					<?php } ?>
			</div>
		</div>
		
<div class = "form-group">
	<div class = "col-sm-4 col-xs-4 col-lg-4">
		<br>
			<h3><?php echo anchor('Home/customers', 'Search Customer.');?></h3>
			</div>
		
	<div class = "col-sm-8 col-xs-8 col-lg-8">
		<br>
			<h3><?php echo anchor('Home/view_sold_devices', 'Click Here to View Sold Devices.');?></h3>
			</div>
		</div>
