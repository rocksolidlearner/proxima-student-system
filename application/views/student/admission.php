<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"> -->
<style>
/**
 * Panels
 */
/*** General styles ***/
.panel {
  box-shadow: none;
}
.panel-heading {
  border-bottom: 0;
}
.panel-title {
  font-size: 17px;
  background-color: #a00;
  color: #fff;
  padding: 10px 5px; 
}
#new{
    background-color: #4b8df8;
    color: #fff;
}
.panel-title > small {
  font-size: .75em;
  color: #999999;
}
.panel-body *:first-child {
  margin-top: 0;
}
.panel-footer {
  border-top: 0;
}

.panel-default > .panel-heading {
    color: #333333;
    background-color: transparent;
    border-color: rgba(0, 0, 0, 0.07);
}

form label {
    color: #999999;
    font-weight: 400;
}
@media (min-width: 768px) {
  .form-horizontal .control-label {
    text-align: right;
    margin-bottom: 0;
    padding-top: 7px;
  }
}

.profile__contact-info-icon {
    float: left;
    font-size: 18px;
    color: #999999;
}
.profile__contact-info-body {
    overflow: hidden;
    padding-left: 20px;
    color: #999999;
}
.profile-avatar {
  width: 200px;
  position: relative;
  margin: 0px auto;
  margin-top: 196px;
  border: 4px solid #f3f3f3;
}
</style>
<div class="row">
  <div class="col-md-12 col-sm-12">
  <?php echo form_open('admission', array('id' => 'demo-form2','class'=>'form-horizontal')); ?>
        <div hidden class="panel panel-default x_panel">
          <div class="panel-body text-center">
           <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar">
          </div>
        </div>
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h4 class="panel-title" id="new"><i class="fa fa-user"></i> New Admission</h4>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Admission No.</label>
                    <div class="col-sm-9">
                        <input type="number" name="admission_no" class="form-control" value="<?php if(!empty($std->admission_no)){echo $std->admission_no+1;}else{ echo 1;}?>" placeholder="Unique Admission Number">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Select Class</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" id="class_id" name="class_id" onchange="get_subject()">
                            <option selected="">Select Class</option>
                            <?php foreach($classes as $c)
                                {
                                    $selected = ($c['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['class_name'].'</option>';
                                } ?>
                        </select>
                        <span class="text-danger"><?php echo form_error('class_id');?></span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Subjects For This Students</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" name="subject_id" id="subject">
                            <option selected="">Select Subject</option>
                        </select>
                        <span>If you will not select any subject then all subjects will load from selected class </span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Roll Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="roll_no" class="form-control" placeholder="Roll Number">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Monthly Tution Fee</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" name="monthly_fee" value="0.00" class="form-control" placeholder="Monthly Tution Fee">
                        <span>This fee will be charge every month</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2nd -->
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h4 class="panel-title">Fees (These fees will charge only at admission time) </h4>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Tution Fee</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" value="0" name="tution_fee" class="form-control" placeholder="Tution Fee">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Admission Fee</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" value="0.00" name="admission_fee" class="form-control" placeholder="Admission Fee">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Annual Fund</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" value="0" name="annual_fund" class="form-control" placeholder="Anual Fund">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Practicals Charges</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" value="0" name="practical_charges" class="form-control" placeholder="Practicals Charges">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Test Session Fee</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" value="0" name="test_fee" class="form-control" placeholder="Test Session Fee">
                    </div>
                </div>
            </div>
        </div>
        <!-- 3rd -->
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h4 class="panel-title">Student <i class="fa fa-angle-double-right"></i> Personal Details </h4>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Admission Date</label>
                    <div class="col-sm-9">
                        <input type="text" name="admission_date" value="<?=date('Y-m-d')?>" id="date_picker" class="date_picker form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Student's Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="std_name" class="form-control" placeholder="Student's Full Name">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Father Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="father_name" class="form-control" placeholder="Father Name">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Date Of Birth</label>
                    <div class="col-sm-9">
                        <input type="text" name="dob" placeholder="Date Of Birth" id="date_picker" class="date_picker form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Gender</label>
                    <div class="col-sm-9">
                        <p style="margin-top: 8px">
                            Male
                            <input type="radio" class="flat" name="gender" value="<?=MALE?>" checked />
                            Female:
                            <input type="radio" class="flat" name="gender" value="<?=FEMALE?>" />
                        </p>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Student Category</label>
                    <div class="col-sm-9">
                        <input type="text" name="std_category" class="form-control" value="General" placeholder="Student Category">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Blood Group</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" name="blood_group">
                            <option value=''>Unknown</option>
                            <?php $bgroups=array(
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-'
                            );
                                foreach($bgroups as $key => $r)
                            {

                                echo '<option value="'.$r.'">'.$key.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Birth Place</label>
                    <div class="col-sm-9">
                        <input type="text" name="birth_place" value="<?=$this->input->post('birth_place'); ?>" class="form-control" placeholder="Birth Place">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Nationality</label>
                    <div class="col-sm-9">
                        <input type="text" name="nationality" value="<?=$this->input->post('nationality'); ?>" class="form-control" placeholder="Nationality">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Religion</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" name="religion">
                            <option value=''>Select Religion</option>
                            <?php $rel=array(
                                'Islam' => 1,
                                'Sikh' => 2,
                                'Hindu' => 3,
                                'Charishchen' => 4,
                                'Other' => 5
                            );
                                foreach($rel as $key => $r)
                            {

                                echo '<option value="'.$r.'">'.$key.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- 4th -->
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h3 class="panel-title">Student Contact Details</h3>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="address" class="form-control" placeholder="Address">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" name="city" class="form-control" placeholder="City">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">State or Province</label>
                    <div class="col-sm-9">
                        <input type="text" name="state" class="form-control" placeholder="State or Province">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="phone" class="form-control" placeholder="+44" value="+44">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Mobile Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="mobile" class="form-control" placeholder="+44" value="+44">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Email Address</label>
                    <div class="col-sm-9">
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                </div>
            </div>
        </div>
        <!-- 5th Guardian-->
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h3 class="panel-title">Guardian Details</h3>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Full Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="guardian_name" class="form-control" placeholder="Guardian Full Name">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Relation</label>
                    <div class="col-sm-9">
                        <select class="form-control select2" name="relation">
                            <?php $rel=array(
                                    'Father' => 'Father',
                                    'Mother' => 'Mother',
                                    'Uncle' => 'Uncle',
                                    'Aunt' => 'Aunt',
                                    'Brother' => 'Brother',
                                    'Sister' => 'Sister',
                                    'Neighbour' => 'Neighbour',
                                    'Other' => 'Other'
                                );
                            foreach($rel as $key => $r)
                            {

                                echo '<option value="'.$r.'">'.$key.'</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Guardian's Mobile Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="guardian_phone" class="form-control" placeholder="+44" value="+44">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Birth of Birth</label>
                    <div class="col-sm-9">
                        <input type="text" name="birthday" value="<?=$this->input->post('birthday'); ?>" id="date_picker" class="date_picker form-control" placeholder="Birthday of Guardian">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">National ID Card</label>
                    <div class="col-sm-9">
                        <input type="text" name="cnic" value="<?=$this->input->post('cnic'); ?>" class="form-control" placeholder="National ID Card">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Education</label>
                    <div class="col-sm-9">
                        <input type="text" name="education" class="form-control" placeholder="Education">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Income</label>
                    <div class="col-sm-9">
                        <input type="text" name="income" class="form-control" placeholder="Income">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Occupation</label>
                    <div class="col-sm-9">
                        <input type="text" name="occupation" class="form-control" placeholder="Occupation">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Email Address</label>
                    <div class="col-sm-9">
                        <input type="email" name="gemail" class="form-control" placeholder="Email Address">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" name="gaddress" class="form-control" placeholder="Address">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">City</label>
                    <div class="col-sm-9">
                        <input type="text" name="gcity" class="form-control" placeholder="City">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">State</label>
                    <div class="col-sm-9">
                        <input type="text" name="gstate" class="form-control" placeholder="State">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Phone Number</label>
                    <div class="col-sm-9">
                        <input type="text" name="gmobile" class="form-control" placeholder="+44" value="+44">
                    </div>
                </div>
            </div>
        </div>
        <!-- 6th -->
        <div class="panel panel-default x_panel">
            <div class="panel-heading">
            <h3 class="panel-title">Previous Education</h3>
            </div>
            <div class="panel-body">
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Institution Name</label>
                    <div class="col-sm-9">
                        <input type="text" name="institute" class="form-control" placeholder="Institution Name">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Course/Class</label>
                    <div class="col-sm-9">
                        <input type="text" name="previous_class" class="form-control" placeholder="Course/Class">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Year</label>
                    <div class="col-sm-9">
                        <input type="text" name="year" class="form-control" placeholder="Year">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-sm-3 control-label">Total Marks</label>
                    <div class="col-sm-9">
                        <input type="text" name="marks" class="form-control" placeholder="Total Marks">
                    </div>
                </div>
                <div class="item form-group text-right">
                    <div class="col-sm-12 col-sm-offset-2">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
  </div>
</div>
<script>
    function get_subject() {
        var class_id = $('#class_id').val();
        $.ajax({
            url: "<?=base_url('student/get_subjects')?>",
            type: "POST",
            data: {class_id:class_id},
            success: function (data) {
                console.log(data);
                $('#subject').html(data);
            }
        });
    }
</script>