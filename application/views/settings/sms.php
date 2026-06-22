<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<style>
	.twillio,.voodoosms{
		display: none;
	}
</style>
<div class="row">
    <div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>SMS Settings</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
                <?php echo form_open('sms-setting'); ?>
				<div class="row">
					<div class="col-md-4">
						<label class="control-label">SMS Gateway</label>
						<div class="form-group">
							<select class="form-control" name="gateway" id="gateway">
								<option value="">-- No gateway --</option>
								<?php $gateway = array(
									'Twillio' => TWILLIO,
									'Voodoosms' => VOODOOSMS,
									);
								foreach($gateway as $key => $v)
								{
									$selected = ($v == $this->data['sms_setting']['gateway']) ? ' selected="selected"' : "";

									echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
								} ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 voodoosms">
                    	<label class="control-label">VoodooSMS API Username</label>
                        <div class="form-group">
							<input type="text" name="sms_username" value="<?=$this->data['sms_setting']['sms_username']?>" class="form-control" id="sms_username">
                        </div>
					</div>
					<div class="col-md-4 voodoosms">
                    	<label class="control-label">VoodooSMS API Password</label>
                        <div class="form-group">
							<input type="text" name="sms_password" value="<?=$this->data['sms_setting']['sms_password']?>" class="form-control" id="sms_password">
                        </div>
					</div>
					<div class="col-md-4 twillio">
                    	<label class="control-label">Twillio API SID</label>
                        <div class="form-group">
							<input type="text" name="twillio_sid" value="<?=$this->data['sms_setting']['twillio_sid']?>" class="form-control" id="twillio_sid">
                        </div>
					</div>
					<div class="col-md-4 twillio">
                    	<label class="control-label">Twillio API AUTH</label>
                        <div class="form-group">
							<input type="text" name="twillio_auth" value="<?=$this->data['sms_setting']['twillio_auth']?>" class="form-control" id="twillio_auth">
                        </div>
					</div>
					<div class="col-md-4 twillio">
                    	<label class="control-label">Twillio Phone Number</label>
                        <div class="form-group">
							<input type="text" name="twillio_phone" value="<?=$this->data['sms_setting']['twillio_phone']?>" class="form-control" id="twillio_phone">
                        </div>
					</div>
					
					<div class="col-md-4 twillio">
                    	<label class="control-label">SMS Header</label>
                        <div class="form-group">
							<input type="text" name="sms_header" value="<?=$this->data['sms_setting']['sms_header']?>" class="form-control" id="sms_header">
                        </div>
					</div>
					<div class="col-md-4 twillio">
                    	<label class="control-label">SMS Footer</label>
                        <div class="form-group">
							<input type="text" name="sms_footer" value="<?=$this->data['sms_setting']['sms_footer']?>" class="form-control" id="sms_footer">
                        </div>
					</div>
					<div class="col-md-12 text-right">
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
<script>
	$(function() {
		if ($('#gateway').val() == <?=TWILLIO?>) {
			$('.voodoosms').hide(500);
			$('.twillio').show(500);
		}else if ($('#gateway').val() == <?=VOODOOSMS?>){
			$('.twillio').hide(500);
			$('.voodoosms').show(500);
		}else{
			$('.voodoosms').hide(500);
			$('.twillio').hide(500);
		}
		$('#gateway').change(function() {
			if ($(this).val() == <?=TWILLIO?>) {
				$('.voodoosms').hide(500);
				$('.twillio').show(500);
			}else if ($(this).val() == <?=VOODOOSMS?>){
				$('.twillio').hide(500);
				$('.voodoosms').show(500);
			}else{
				$('.voodoosms').hide(500);
				$('.twillio').hide(500);
			}
		})
	})
</script>