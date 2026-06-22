<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray;margin-bottom: 20px">Profile</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #35aa47">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #35aa47;padding: 10px;color: #fff"><i class="fa fa-list"></i> Change password</h5>
        </div>
        <?php echo form_open('profile'); ?>
        <div class="box-body" style="padding: 10px">
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Current Password</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="cpassword" placeholder="Current Password">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                  </div>
                </div>
                <span class="text-danger"><?php echo form_error('cpassword');?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>New Password</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                  <input type="password" name="newpassword" class="form-control" placeholder="New Password">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                  </div>
                </div>
                <span class="text-danger"><?php echo form_error('newpassword');?></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Current Password</label>
            </div>
            <div class="col-md-4">
                <div class="input-group mb-3">
                  <input type="password" name="againpassword" class="form-control" placeholder="New Password Again">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                  </div>
                </div>
                <span class="text-danger"><?php echo form_error('againpassword');?></span>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-8 col-sm-12 text-center">
              <button type="submit" class="btn btn-primary"> Submit</button>
              <button class="btn btn-default"> Cancel</button>
            </div>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
  	</div>
  </div>
</div>
