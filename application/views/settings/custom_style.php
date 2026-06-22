<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12">
      	<div class="x_panel">
            <div class="x_title">
              	<h2>Custom CSS Style</h2>
				<div class="clearfix"></div>
            </div>
			<div class="x_content">
                <?php echo form_open('custom-style'); ?>
				<div class="row">
					<div class="col-md-12">
                    <!-- <label class="control-label">Custom CSS Style</label> -->
                        <div class="form-group">
							<textarea name="description" rows="12" class="form-control"><?=$this->data['setting']['custom_style']?></textarea>
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