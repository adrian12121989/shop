<style type="text/css">
.hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 3px;
} 
</style>
<?php if($this->session->userdata('access_lvl') > 1) { 
	//foreach($jobs->result() as $job) { ?>
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				
			</div>
			</div>
			<?php 
			if($this->session->userdata('access_level') == 2) { ?>
			<div class="row">
				<?php echo form_open('Admin/short_list'); ?>
				<div class="col-xs-12 col-md-12 col-lg-12 text-right">
					<?php if(isset($short_list)) {
						foreach($short_list->result() as $active) { 
							echo ($active->application_status == 1) ? '<h4 class="alert alert-success" style="font-family: Times New Roman, Times, serif;">
							Candidate Short-Listed successfully</h4>' : '<h4 alert alert-danger>Something went wrong!</h4>'; 
							} }
							else { ?>
					<?=anchor("Admin/short_list/".$job->user_id . '/' . $job->job_id,"Short-List this Candidate",
					array('onclick' => "return confirm('Are you confortable to short list this Candidate? NOTE: This action will not be reversed!')")) ?>
					<?php } ?>
					</div>
					<?php echo form_close(); ?>
				</div>
<?php }  }
if(isset($cv_error))
{
	echo '<div class="alert alert-danger">'. $this->lang->line('cv_error') . '</div>';
} else {
	foreach($cv->result() as $row) ?>
<hr class="hr">

<div class="row">
	</div>
	<div class="col-xs-4 col-md-4 col-lg-4">
		<ul style="list-style-type: none; text-transform: capitalize; font-size: 1em; padding-left: 0">
			<li><?php echo $row->irecord_date .'</li>'; 
				echo '<li>' . $row->ireceipt_no . '</li>';
				echo '<li>' . $row->payer . '</li>'; 
				if($row->income_name == "other")
				$income = $row->otherIncome;
				else
				$income = $row->income_name;
				echo '<li>' . $income  . '</li>';
				echo '<li>' . $row->idescription . '</li>';
				echo '<li>' . $row->iamount . '</li>';
				
				?>
		</ul>
	</div>
	
</div>
<hr class="hr">
	<?php } ?>
</div>


       
