<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
        toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } if($this->session->flashdata('error')){?>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Users <small>Add New User</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('user-add', array('id' => 'demo-form2','class'=>'form-horizontal form-label-left')); ?>
                <div class="col-md-6">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control ">
                            <span>Admin's Username</span>
                            <span class="text-danger"><?php echo form_error('username');?></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Password <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input name="password" placeholder="Password" value="<?php echo $this->input->post('password'); ?>" type="password" id="password" class="form-control ">
                            <span>Type admin's password</span>
                            <span class="text-danger"><?php echo form_error('password');?></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Name <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input type="text" name="name" placeholder="Administrator'r Name" value="<?php echo $this->input->post('name'); ?>" id="name" class="form-control ">
                            <span>Administrator's full name. e.g. Anjum Ali Khan</span>
                            <span class="text-danger"><?php echo form_error('name');?></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Email Address <span class="required">*</span>
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input type="email" name="email" value="<?php echo $this->input->post('email'); ?>" id="email" placeholder="Admin Email" class="form-control ">
                            <span class="text-danger"><?php echo form_error('email');?></span>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">is Administrator
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <select name="is_admin" class="form-control" id="is_admin">
                                <?php   $types = array(
                                            "No" =>'No',
                                            "Yes"=>'Yes',
                                        );
                                foreach ($types as $key => $value) {
                                $selected = ($key == $this->input->post('is_admin')) ? ' selected="selected"' : "";
                                echo '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Active Admin
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <select name="status" class="form-control" id="status">
                                <?php   $status = array(
                                            "Yes"=>'Yes',
                                            "No" =>'No', 
                                        );
                                foreach ($status as $key => $value) {
                                $selected = ($key == $this->input->post('status')) ? ' selected="selected"' : "";
                                echo '<option value="'.$value.'" '.$selected.'>'.$key.'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-form-label label-align">User Permissions</label>
                        <select multiple="multiple" size="10" name="permission[]" class="form-control dual_listbox" style="height: 330px">
                            <?php $permissions =array(
                            'Time Table' => 'time_table',
                            'Date Sheet/Schedule' => 'datesheet',
                            'Schedule Module' => 'allow_schedule',
                            'Can Add New Admission' => 'admission',
                            'Manage Student Attendance' => 'manage_student_attendance',
                            'Students Module' => 'allow_students',
                            'Accounts Module' => 'allow_accounts',
                            'View Account Transactions' => 'view_account_transactions',
                            'Examinations Module' => 'allow_examination',
                            'Reports Module' => 'allow_reports',
                            'Library Module' => 'allow_library',
                            'Library &gt;&gt; Manage Library' => 'manage_library',
                            'Library &gt;&gt; Assign Books' => 'library_assign_books',
                            'Users Module' => 'allow_users',
                            'Parents Module' => 'allow_parents',
                            'Allow Fee Module' => 'fee_module',
                            'Can Pay Fee' => 'pay_fee',
                            'Tools' => 'tools',
                            'Allow Course Material Module' => 'allow_cource_material',
                            'Can Change Application Settings' => 'change_app_settings',
                            'SMS Allowed' => 'sms_section',
                            'Can Change SMS Settings' => 'change_sms_settings',
                            'Can Change Fee Settings' => 'change_fee_settings',
                            'Can Change Calendar Settings' => 'change_calendar_settings',
                            'Batches Manage' => 'batches-manage',
                            'Subject Manage'=>'subject-manage',
                            'Class Manage' => 'class-manage',
                            'History' => 'history',
                            'Can Manage Daily Expenses' => 'manage_daily_expenses',
                            'Can Delete/Edit Daily Expenses' => 'delete_edit_daily_expenses',
                            'Manage Teachers' => 'manage_teachers',
                            'Manage Employees' => 'manage_employees',
                            'Manage Teacher Salaries' => 'manage_teacher_salary',
                            'Project Module' => 'project_manage',
                            'CRM Module' => 'call_log',
                            'Allow Help' => 'report_bug'
                        );
                        foreach($permissions as $key => $p)
                        {
                                $selected = ($p == $this->input->post('permission')) ? ' selected="selected"' : "";

                                echo '<option value="'.$p.'" '.$selected.'>'.$key.'</option>';
                            } ?>
                        </select>   
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ln_solid"></div>
                    <div class="item form-group text-right">
                        <div class="col-md-9 col-sm-9 offset-md-3">
                            <button hidden class="btn btn-primary" type="reset"><i class="fa fa-times-circle"></i> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
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


