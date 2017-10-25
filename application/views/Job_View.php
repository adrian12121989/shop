	<br />		
<div class="page-header">
	<h3>
		<?php echo form_open('job_Controller/index'); ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="input-gorup">
					<input type="text" class="" name="search_string" placeholder="<?php echo $this->lang->line('jobs_view_search'); ?>"
					<span class="input-group-btn">
						<button class="btn btn-success" type="submit"><?php echo $this->lang->line('jobs_view_search'); ?></button>
						</span> 
				</div>
				</div>
			</div>
			<?php echo form_close(); ?>
			</h3>
	</div>
	
	<table class="table table-hover">
		
			
		</table>
