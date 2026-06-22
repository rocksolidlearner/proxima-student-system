<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Calendar Settings</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
                <?php echo form_open('cal-setting'); ?>
				<div class="row">
					<div class="col-md-4">
						<label class="control-label">Weekly Fixed Holidays</label>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="monday" id="monday" value="<?=ACTIVE?>" <?php if($results['monday'] == ACTIVE){ echo'checked';}?>/> Monday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="tuesday" id="tuesday" value="<?=ACTIVE?>" <?php if($results['tuesday'] == ACTIVE){ echo'checked';}?>/> Tuesday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="wednesday" id="wednesday" value="<?=ACTIVE?>" <?php if($results['wednesday'] == ACTIVE){ echo'checked';}?>/> Wednesday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="thursday" id="thursday" value="<?=ACTIVE?>" <?php if($results['thursday'] == ACTIVE){ echo'checked';}?>/> Thursday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="friday" id="friday" value="<?=ACTIVE?>" <?php if($results['friday'] == ACTIVE){ echo'checked';}?>/> Friday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="saturday" id="saturday" value="<?=ACTIVE?>" <?php if($results['saturday'] == ACTIVE){ echo'checked';}?>/> Saturday
							</p>
							<p style="margin-bottom: 8px">
								<input type="checkbox" class="flat" name="sunday" id="sunday" value="<?=ACTIVE?>" <?php if($results['sunday'] == ACTIVE){ echo'checked';}?>/> Sunday
							</p>
                        </div>
					</div>
					<div class="col-md-4">
						<label class="control-label">Set permanent fixed holidays </label>
					</div>
					<div class="col-md-8 text-right">
						<button type="submit" class="btn btn-success">
							<i class="fa fa-check"></i> Save
						</button>
					</div>
				</div>
                <?php echo form_close(); ?>
			</div>		
		</div>
    </div>
</div>