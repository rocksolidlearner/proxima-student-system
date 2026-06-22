<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<!-- <div class="row"> -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus"></i> Add Teacher</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('teacher-add', array('id' => 'demo-form2','class'=>'form-horizontal form-label-left')); ?>
                <div class="row">
                    <div class="col-md-8">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="employee_name" placeholder="Teacher name required" value="<?php echo $this->input->post('employee_name'); ?>" type="text" class="form-control">
                                <span class="text-danger"><?php echo form_error('employee_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Short Name
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="short_name" placeholder="Short name for empoyee" value="<?php echo $this->input->post('short_name'); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">National ID Card
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="cnic" placeholder="Identity Card Number" value="<?php echo $this->input->post('cnic'); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Designation
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="designation" placeholder="Designation name for empoyee" value="<?php echo $this->input->post('designation'); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Email Address <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input type="email" placeholder="Email address" name="email" value="<?php echo $this->input->post('email'); ?>" class="form-control">
                                <span class="text-danger"><?php echo form_error('email');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Cell Number<span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="phone" placeholder="+44" maxlength="15" value="<?php echo $this->input->post('phone'); ?>" type="text" class="form-control">
                                <span class="text-danger"><?php echo form_error('phone');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Date of Joining <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input  name="date_joining" placeholder="Date of joining" value="<?php echo $this->input->post('date_joining'); ?>" id="date_picker" class="date_picker form-control" type="text">
                                <span class="text-danger"><?php echo form_error('date_joining');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Address</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="address" placeholder="Home Address" value="<?php echo $this->input->post('address'); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Hour Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="hour_salary" placeholder="Per Hour Salary" value="<?php echo $this->input->post('hour_salary'); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Month Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="salary" placeholder="Per Month Salary" value="<?php echo $this->input->post('salary'); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Annual Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="annual_salary" placeholder="Annual Salary" value="<?php echo $this->input->post('annual_salary'); ?>" type="number" step=".01" class="form-control">
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

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
<!-- </div> -->

<script>

    function get_img() {
        $('#prof_img').click();
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    } 

</script>
