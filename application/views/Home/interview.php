		
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12 alert alert-success" style="font-family: Times New Roman, Times, serif;">
					<?php if(isset($update_success)) { ?>
					<p>Congrats!!.. Call for Interview updated Successfully!</p>
					<p>Short-Listed Candidates will adhere to your interview accordingly as shown below! Thanks!</p>
					NOTE: This information will be deleted automatically from the system immediately after the date mentioned!
					<?php } else { ?>
						Current Call for interview Information
						<?php } ?>
					</div>
				</div>
			<div class="row">
				<div class="col-xs-12 col-md-12 col-lg-12">
			<table class="table" style="font-family: Times New Roman, Times, serif;">
			<thead>
			<tr>
				<th>Date</th>
				<th>Location</th>
				 <th>Description</th>
      </tr>
    </thead>
		<tbody>
			<?php
				 foreach($confirm_interview->result() as $info) { ?>
				<tr>
					<td><?php echo $info->interview_date; ?></td>
					<td><?php echo $info->location; ?></td>
					<td><?php echo $info->description; ?></td>
					<td><a href="<?php echo base_url('index.php/Admin/interview_result/' . $info->info_id); ?>" class="btn btn-info">Change info</a> Or
						<?php echo anchor('Jobs/dashboard', 'No!, Thanks'); ?>
						</td>
					</tr>
					<?php  } ?>
					
			</tbody>
			</table>
				
			</div>
			</div>
			</div>
