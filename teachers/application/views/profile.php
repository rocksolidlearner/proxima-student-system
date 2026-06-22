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
  	<div class="col-md-12">
  		<h2 style="color: gray;margin-bottom: 20px">Profile</h2>
      <div class="row">
        <div class="col-md-6">
          <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
            <div class="box-header">
              <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> View Profile</h5>
            </div>
            <?php echo form_open('teacher-update'); ?>
            <div class="box-body" style="padding: 10px">
              <div class="row">
                <div class="col-md-6">
                  <label>Teacher Name</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="employee_name" value="<?=$teacher['employee_name']?>">
                    <span class="text-danger"><?php echo form_error('employee_name');?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Short Name</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="short_name" value="<?=$teacher['short_name']?>">
                    <span class="text-danger"><?php echo form_error('short_name');?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Email Address</label>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email" value="<?=$teacher['email']?>">
                    <span class="text-danger"><?php echo form_error('email');?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Cell Number</label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="phone" value="<?=$teacher['phone']?>">
                    <span class="text-danger"><?php echo form_error('phone');?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Date of Joining (<?=date('d-M-Y',strtotime($teacher['date_joining']))?>)</label>
                  <div class="form-group">
                    <input type="date" class="form-control" name="date_joining">
                    <span class="text-danger"><?php echo form_error('date_joining');?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Address</label>
                  <div class="form-group">
                    <textarea name="address" class="form-control" rows="3" style="resize: none;"><?=$teacher['address']?></textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12 col-sm-12 text-right">
                  <button class="btn btn-default"> Cancel</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #35aa47">
            <div class="box-header">
              <h5 class="box-title" style="margin-bottom: 20px;background-color: #35aa47;padding: 10px;color: #fff"><i class="fa fa-key"></i> Change password</h5>
            </div>
            <?php echo form_open('profile'); ?>
            <div class="box-body" style="padding: 10px">
              <div class="row">
                <div class="col-md-3 text-right">
                  <label>Current Password</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group mb-3">
                      <input type="password" class="form-control" name="cpassword" placeholder="Current Password">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                      </div>
                    </div>
                    <span class="text-danger"><?php echo form_error('cpassword');?></span>
                </div>
                <div class="col-md-3 text-right">
                  <label>New Password</label>
                </div>
                <div class="col-md-8">
                    <div class="input-group mb-3">
                      <input type="password" name="newpassword" class="form-control" placeholder="New Password">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-lock"></i> </span>
                      </div>
                    </div>
                    <span class="text-danger"><?php echo form_error('newpassword');?></span>
                </div>
                <div class="col-md-3 text-right">
                  <label>Current Password</label>
                </div>
                <div class="col-md-8">
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
                <div class="col-md-12 col-sm-12 text-center">
                  <button type="submit" class="btn btn-primary"> Save</button>
                  <button class="btn btn-default"> Cancel</button>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
  	</div>
  </div>
</div>
