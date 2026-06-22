<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Student<small><i class="fa fa-plus"></i> New Student</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('student/add', array('id' => 'demo-form2','class'=>'form-horizontal form-label-left')); ?>

                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Surname <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input name="surname" value="<?php echo $this->input->post('surname'); ?>" type="text" id="surname" class="form-control ">
                        <span class="text-danger"><?php echo form_error('surname');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">First Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input name="f_name" value="<?php echo $this->input->post('f_name'); ?>" type="text" class="form-control">
                        <span class="text-danger"><?php echo form_error('f_name');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Other Name
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input name="other_name" value="<?php echo $this->input->post('other_name'); ?>" type="text" class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Class <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 ">
                        <select name="class_id" class="form-control select2">
                            <option value="">Select Class</option>
                            <?php
                            foreach($all_classes as $class)
                            {
                                $selected = ($class['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                                echo '<option value="'.$class['id'].'" '.$selected.'>'.$class['name'].'</option>';
                            }
                            ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('class_id');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Username <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text"  name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control">
                        <span class="text-danger"><?php echo form_error('username');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Password <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="password"  name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control">
                        <span class="text-danger"><?php echo form_error('password');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Confrim Password <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="password"  name="cpassword" value="<?php echo $this->input->post('cpassword'); ?>" class="form-control">
                        <span class="text-danger"><?php echo form_error('cpassword');?></span>
                    </div>
                </div>
              
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button class="btn btn-primary" type="reset"><i class="fa fa-times-circle"></i> Reset</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

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
