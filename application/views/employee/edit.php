<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<!-- <div class="row"> -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Edit Employee</h2>
                <div class="clearfix"></div>
            </div>
            <?php $id = urlencode(base64_encode($employee['id']));
             echo form_open_multipart('employee-edit/'.$id); ?>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-8">
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="employee_name" value="<?php echo ($this->input->post('employee_name') ? $this->input->post('employee_name') : $employee['employee_name']); ?>" type="text" class="form-control">
                                <span class="text-danger"><?php echo form_error('employee_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Short Name
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="short_name" value="<?php echo ($this->input->post('short_name') ? $this->input->post('short_name') : $employee['short_name']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">National ID Card
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="cnic" placeholder="Identity Card Number" value="<?php echo ($this->input->post('cnic') ? $this->input->post('cnic') : $employee['cnic']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Designation
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="designation" placeholder="Designation name for empoyee" value="<?php echo ($this->input->post('designation') ? $this->input->post('designation') : $employee['designation']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input type="email"  name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $employee['email']); ?>" class="form-control">
                                <span class="text-danger"><?php echo form_error('email');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Cell Number <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $employee['phone']); ?>" type="text" id="phone" class="form-control ">
                                <span class="text-danger"><?php echo form_error('phone');?></span>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Date of Joining <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input  name="date_joining" placeholder="Date of joining" value="<?=$employee['date_joining']?>" id="date_picker" class="date_picker form-control" type="text">
                                <span class="text-danger"><?php echo form_error('date_joining');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Address</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="address" placeholder="Home Address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $employee['address']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Hour Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="hour_salary" placeholder="Per Hour Salary" value="<?php echo ($this->input->post('hour_salary') ? $this->input->post('hour_salary') : $employee['hour_salary']); ?><?php echo $this->input->post('hour_salary'); ?><?php echo ($this->input->post('salary') ? $this->input->post('salary') : $employee['salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Month Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="salary" placeholder="Per Month Salary" value="<?php echo ($this->input->post('salary') ? $this->input->post('salary') : $employee['salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Annual Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="annual_salary" placeholder="Annual Salary" value="<?php echo ($this->input->post('annual_salary') ? $this->input->post('annual_salary') : $employee['annual_salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<!-- </div> -->
