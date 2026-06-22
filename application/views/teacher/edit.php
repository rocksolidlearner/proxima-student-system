<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<!-- <div class="row"> -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Edit Teacher</h2>
                <div class="clearfix"></div>
            </div>
            <?php $id = urlencode(base64_encode($teacher['id']));
             echo form_open_multipart('teacher-edit/'.$id); ?>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="employee_name" value="<?php echo ($this->input->post('employee_name') ? $this->input->post('employee_name') : $teacher['employee_name']); ?>" type="text" class="form-control">
                                <span class="text-danger"><?php echo form_error('employee_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Short Name
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="short_name" value="<?php echo ($this->input->post('short_name') ? $this->input->post('short_name') : $teacher['short_name']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">National ID Card
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="cnic" placeholder="Identity Card Number" value="<?php echo ($this->input->post('cnic') ? $this->input->post('cnic') : $teacher['cnic']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Designation
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="designation" placeholder="Designation name for empoyee" value="<?php echo ($this->input->post('designation') ? $this->input->post('designation') : $teacher['designation']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input type="email"  name="email" value="<?php echo ($this->input->post('email') ? $this->input->post('email') : $teacher['email']); ?>" class="form-control">
                                <span class="text-danger"><?php echo form_error('email');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Cell Number <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input name="phone" value="<?php echo ($this->input->post('phone') ? $this->input->post('phone') : $teacher['phone']); ?>" type="text" id="phone" class="form-control ">
                                <span class="text-danger"><?php echo form_error('phone');?></span>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Date of Joining <span class="required">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8">
                                <input  name="date_joining" placeholder="Date of joining" value="<?=$teacher['date_joining']?>" id="date_picker" class="date_picker form-control" type="text">
                                <span class="text-danger"><?php echo form_error('date_joining');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Address</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="address" placeholder="Home Address" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $teacher['address']); ?>" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Hour Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="hour_salary" placeholder="Per Hour Salary" value="<?php echo ($this->input->post('hour_salary') ? $this->input->post('hour_salary') : $teacher['hour_salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Per Month Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="salary" placeholder="Per Month Salary" value="<?php echo ($this->input->post('salary') ? $this->input->post('salary') : $teacher['salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-4 col-sm-4 label-align">Annual Salary</label>
                            <div class="col-md-8 col-sm-8">
                                <input name="annual_salary" placeholder="Annual Salary" value="<?php echo ($this->input->post('annual_salary') ? $this->input->post('annual_salary') : $teacher['annual_salary']); ?>" type="number" step=".01" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Assigned Classes</label>
                            <select multiple="multiple" size="10" name="classes[]" class="form-control dual_listbox" style="height: 350px">
                                <?php
                                foreach($classes as $c)
                                {
                                    $selected = '';
                                    foreach($tech_cls as $tc){
                                        if($c['id']==$tc['class_id'])
                                        {
                                            $selected ="selected";
                                        }
                                    }
                                    echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['batch_name'].' >> '.$c['class_name'].' (Students '.$c['stdents'].')</option>';
                                } ?>
                            </select>   
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-9 col-sm-6 offset-md-3 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
<!-- </div> -->
