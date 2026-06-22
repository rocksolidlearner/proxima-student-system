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
              	<h2>Fee Settings</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
                <?php echo form_open('fee-setting'); ?>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-5">
                    <label class="control-label">Generate fee invoices before specific days:</label>
                        <div class="form-group">
							<input type="number" name="invoice_fee_days" value="<?=$this->data['setting']['invoice_fee_days']?>" class="form-control" id="fee">
                            <span>System will generate invoices before specified days from due date.</span>
                        </div>
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