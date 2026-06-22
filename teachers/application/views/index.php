<div class="container" style="margin:30px 0;max-width: 100%;">
  <div class="row">
    <!-- <div class="col-sm-1"></div> -->
  	<div class="col-md-12">
  		<h2 style="color: gray">Dashboard</h2>
      <div class="box" style="box-shadow: 0 0 5px gray;border-bottom: 15px solid #4b8df8">
        <div class="box-header">
          <h5 class="box-title" style="margin-bottom: 20px;background-color: #4b8df8;padding: 10px;color: #fff"><i class="fa fa-list"></i> View Profile</h5>
        </div>
        <div class="box-body" style="padding: 10px">
          <div class="row">
            <div class="col-md-3 text-right">
              <label>Teacher Name</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" disabled class="form-control" name="cpassword" value="<?=$this->session->userdata('employee_name')?>">
                <span class="text-danger"><?php echo form_error('cpassword');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Short Name</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" disabled class="form-control" name="short_name" value="<?=$this->session->userdata('short_name')?>">
                <span class="text-danger"><?php echo form_error('short_name');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Email Address</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" disabled class="form-control" name="email" value="<?=$this->session->userdata('email')?>">
                <span class="text-danger"><?php echo form_error('email');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Cell Number</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" disabled class="form-control" name="phone" value="<?=$this->session->userdata('phone')?>">
                <span class="text-danger"><?php echo form_error('phone');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Date of Joining</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" disabled class="form-control" name="joining_date" value="<?=date('d-M-Y',strtotime($this->session->userdata('date_joining')))?>">
                <span class="text-danger"><?php echo form_error('joining_date');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Address</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <textarea disabled name="address" class="form-control" rows="3" style="resize: none;"><?=$this->session->userdata('address')?></textarea>
              </div>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3 text-right">
              <label>Salary</label>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="text" disabled class="form-control" name="salary" value="<?=$this->session->userdata('salary')?>">
                <span class="text-danger"><?php echo form_error('salary');?></span>
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
      </div>
  	</div>
  </div>
</div>
