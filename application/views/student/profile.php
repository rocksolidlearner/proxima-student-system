<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<style>
.invertblack {
    background-color: #c00 !important;
    color: #fff;
}
.portfolio-stat {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}
.portfolio-timeline-item {
    border-left: 4px solid #2f6fed;
    background: #fff;
    border-radius: 10px;
    margin-bottom: 18px;
    padding: 16px 18px;
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.04);
}
.portfolio-tag {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 999px;
    background: #eef3ff;
    color: #2f6fed;
    font-size: 12px;
    margin: 0 6px 6px 0;
}
</style>
<?php $id = urlencode(base64_encode($student['id'])); ?>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Students <small>Manage/Edit student profile data</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                   
                    <li>
                        <a data-toggle="modal" data-target="#smsModal" href="#"><button class="btn btn-sm btn-success"><i class="fa fa-comment-o"></i> Send SMS</button></a>
                    </li>
                    <li>
                        <a href="<?=base_url('student-remove/'.$student['id'])?>"><button class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i> Delete Student</button></a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#payModal" href="#"><button class="btn btn-sm btn-warning"><i class="fa fa-credit-card"></i> Instant Fee</button></a>
                    </li>
                    <li>
                        <a href="<?=base_url('student-payhistory/'.$id)?>"><button class="btn btn-sm btn-primary"><i class="fa fa-money"></i> Payment History</button></a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#emailModal"  href="#"  title="Send Email"><button class="btn btn-sm btn-danger"><i class="fa fa-envelope"></i> Send Email</button></a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#portfolioModal" href="#"><button class="btn btn-sm btn-info"><i class="fa fa-folder-open"></i> Add ePortfolio</button></a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
        <?php $s_id = urlencode(base64_encode($student['id']));
             echo form_open_multipart('student-profile/'.$s_id); ?>
            <div class="x_content">
                <div class="col-md-3">
                    <label style="cursor: pointer;width: 100%">
                        <img style="width:100%" id="img" src="<?=base_url('uploads/'.$student['picture'])?>" title="" class="tooltips thumbnail" data-original-title="Click me to change photo">
                        <form id="photoForm" name="photoForm">
                            <input type="hidden" name="id" value="<?=$student['id']?>">
                            <input type="file"  name="picture" accept="image/*" id="photo">
                        </form>
                    </label>
                </div>
                <div class="col-md-6">
                    <h2 id="nameh2"><?=$student['std_name']?> <em>(<?=$student['roll_no']?>)</em></h2>
                    <div class="tablesaw-bar tablesaw-mode-stack"></div>
                    <table class="table table-bordered table-striped tablesaw-stack" style="font-size:15px;" id="tablesaw-2584">
                        <tbody>
                        <tr>
                            <td>Class</td>
                            <td id="classspan">17th Edition - CC-1</td>
                        </tr>
                        <tr>
                            <td>Father</td>
                            <td id="gnamespan"><?=$student['father_name']?>	<em>(<?=$student['phone']?>)</em></td>
                        </tr>
                        <tr>
                            <td>Admission Date</td>
                            <td><?=date('d-M-Y',strtotime($student['admission_date']))?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <h2>Adm. #: <?=$student['admission_no']?></h2>
                    <div class="tablesaw-bar tablesaw-mode-stack"></div>
                    <table class="table table-bordered table-striped tablesaw-stack" style="font-size:15px;" id="tablesaw-9039">
                        <tbody>
                        <tr>
                            <td>Tution Fee</td>
                            <td><?=$student['tution_fee']?></td>
                        </tr>
                        <tr>
                            <td>Payable</td>
                            <td><?=$student['admission_no']?></td>
                        </tr>
                        <tr>
                            <td>Today's Attend.</td>
                            <td>N/A</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="clearfix"></div>
                <div class="tablesaw-bar tablesaw-mode-stack"></div>
                <table id="user" class="table table-bordered table-striped tablesaw-stack">
                    <tbody>
                    <tr>
                        <th class="invertblack" colspan="3">
                            <i class="fa fa-chevron-circle-down"></i> Student Information
                            <button style="float: right;margin: 0" type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                        </th>
                    </tr>
                    <tr>
                        <td>Roll Number</td>
                        <td>
                            <input type="text" name="roll_no" value="<?=$student['roll_no']?>" class="form-control">
                        </td>
                        <td><span class="text-muted">Student's roll number if applicable</span></td>
                    </tr>
                    <tr>
                        <td>Tution Fee</td>
                        <td>
                            <input type="number" step=".01" name="tution_fee" value="<?=$student['tution_fee']?>" class="form-control">
                        </td>
                        <td><span class="text-muted">(£<?=$student['tution_fee']?>)Leave it blank if you don't want to assign special fee to this student</span></td>
                    </tr>
                    <tr>
                        <td>Admission Date?</td>
                        <td>
                            <input  name="admission_date" value="<?=$student['admission_date']?>" id="date_picker" class="date_picker form-control" type="text">
                        </td>
                        <td><span class="text-muted">Admission date</span></td>
                    </tr>
                    <tr>
                        <td>Student's Name</td>
                        <td>
                            <input type="text" name="std_name" value="<?=$student['std_name']?>" class="form-control">
                        </td>
                        <td><span class="text-muted">Student's Name</span></td>
                    </tr>
                    <tr>
                        <td>Father Name</td>
                        <td>
                            <input type="text" name="father_name" value="<?=$student['father_name']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted"> Student's Father Name</span></td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>
                            <select class="form-control select2" id="class_id" name="class_id" onchange="get_subject()">
                                <option value="">Select Class</option>
                                <?php foreach($classes as $c)
                                    {
                                        $selected = ($c['id'] == $student['class_id']) ? ' selected="selected"' : "";

                                        echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['class_name'].'</option>';
                                    } ?>
                            </select>
                        </td>
                        <td>
                        <span class="text-muted">Class and year/session or batch</span></td>
                    </tr>
                    <tr>
                        <td>Subjects</td>
                        <td>
                            <?=$std_subject['subject_name']?>
                            <!-- <select hidden class="form-control select2" id="subject_id" name="subject">
                                <option >Select Subject</option>
                                <?php foreach($subjects as $s)
                                    {
                                        $selected = ($s['id'] == $student['subject_id']) ? ' selected="selected"' : "";

                                        echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
                                    } ?>
                            </select> -->
                        </td>
                        <td>
                        <span class="text-muted">Subjects of this student</span></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td>
                            <input  name="dob" value="<?=$student['dob']?>" id="date_picker" class="date_picker form-control" type="text">
                        </td>
                        <td><span class="text-muted"> Date of birth</span></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>
                            <p style="margin-top: 8px">
                                Male
                                <input type="radio" class="flat" name="gender" value="<?=MALE?>"  <?php if($student['gender'] == MALE){echo'checked';} ?>/>
                                Female:
                                <input type="radio" class="flat" name="gender" value="<?=FEMALE?>" <?php if($student['gender'] == FEMALE){echo'checked';} ?>/>
                            </p>
                        </td>
                        <td><span class="text-muted">Gender</span></td>
                    </tr>
                    <tr>
                        <td>
                            Student Category
                        </td>
                        <td>
                            <input type="text" name="std_category" value="<?=$student['std_category']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Student Category
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>
                            <select class="form-control" name="blood_group">
                                <option value="">Unknown</option>
                                <?php $rel=array(
                                    'A+' => 1,
                                    'A-' => 2,
                                    'B+' => 3,
                                    'B-' => 4,
                                    'O+' => 5,
                                    'O-' => 6,
                                    'AB+' => 7,
                                    'AB-' => 8
                                );
                                 foreach($rel as $key => $r)
                                {
                                    $selected = ($r == $student['blood_group']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$r.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                        </td>
                        <td><span class="text-muted"> Blood Group</span></td>
                    </tr>
                    <tr>
                        <td>
                            Birth Place
                        </td>
                        <td>
                            <input type="text" name="birth_place" value="<?=$student['birth_place']?>" class="form-control" placeholder="Birth Place">
                        </td>
                        <td>
                        <span class="text-muted">
                            Birth place
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nationality
                        </td>
                        <td>
                            <input type="text" name="nationality" value="<?=$student['nationality']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Nationality
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Religion
                        </td>
                        <td>
                            <select class="form-control" name="religion">
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
                                    $selected = ($r == $student['religion']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$r.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                        </td>
                        <td>
                        <span class="text-muted">
                            Religion
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Address
                        </td>
                        <td>
                            <input type="text" name="address" value="<?=$student['address']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Address
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            City
                        </td>
                        <td>
                            <input type="text" name="city" value="<?=$student['city']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            City
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            State or Province
                        </td>
                        <td>
                            <input type="text" name="state" value="<?=$student['state']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            State or Province
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Phone number
                        </td>
                        <td>
                            <input type="text" name="phone" placeholder="+44" value="<?=$student['phone']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Landline Number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Mobile number
                        </td>
                        <td>
                            <input type="text" name="mobile" value="<?=$student['mobile']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Valid cell number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email address
                        </td>
                        <td>
                            <input type="email" name="email" value="<?=$student['email']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Valid email address
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="invertblack">
                            <i class="fa fa-chevron-circle-down"></i> Guardian Details
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Guardian name
                        </td>
                        <td>
                            <input type="text" name="guardian_name" value="<?=$guardian['guardian_name']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian name
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Relation
                        </td>
                        <td>
                            <select class="form-control" name="relation">
                                <?php $rel=array(
                                    'Father' => 1,
                                    'Mother' => 2,
                                    'Sister' => 3,
                                    'Brother' => 4,
                                    'Other' => 5
                                );
                                 foreach($rel as $key => $r)
                                {
                                    $selected = ($r == $guardian['relation']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$r.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                        </td>
                        <td>
                        <span class="text-muted">
                            Relation with student
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian NIC number
                        </td>
                        <td>
                            <input type="text" name="cnic" value="<?=$guardian['cnic']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            National Identity Card number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Birthday
                        </td>
                        <td>
                            <input  name="birthday" value="<?=$guardian['birthday']?>" id="date_picker" class="date_picker form-control" type="text">
                        </td>
                        <td>
                        <span class="text-muted">
                            Date of birth
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Education
                        </td>
                        <td>
                            <input type="text" name="education" value="<?=$guardian['education']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian education
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Income
                        </td>
                        <td>
                            <input type="number" step=".01"  name="income" value="<?=$guardian['income']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian income
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Occupation
                        </td>
                        <td>
                            <input type="text" name="occupation" value="<?=$guardian['occupation']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian occupation
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Email
                        </td>
                        <td>
                            <input type="email" name="gemail" value="<?=$guardian['email']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian email address
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Address
                        </td>
                        <td>
                            <input type="text" name="gaddress" value="<?=$guardian['address']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian address
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian City
                        </td>
                        <td>
                            <input type="text" name="gcity" value="<?=$guardian['city']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian city
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian State
                        </td>
                        <td>
                            <input type="text" name="gstate" value="<?=$guardian['state']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian state
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Phone
                        </td>
                        <td>
                            <input type="text" name="gphone" value="<?=$guardian['phone']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian phone number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Guardian Mobile
                        </td>
                        <td>
                            <input type="text" name="gmobile" value="<?=$guardian['mobile']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Guardian mobile number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Emergency Contact Name
                        </td>
                        <td>
                            <input type="text" name="emergency_contact_name" value="<?=isset($guardian['emergency_contact_name']) ? $guardian['emergency_contact_name'] : ''?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Emergency contact full name
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Emergency Relationship
                        </td>
                        <td>
                            <input type="text" name="emergency_contact_relationship" value="<?=isset($guardian['emergency_contact_relationship']) ? $guardian['emergency_contact_relationship'] : ''?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Relationship to the student
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Emergency Contact Phone
                        </td>
                        <td>
                            <input type="text" name="emergency_contact_phone" value="<?=isset($guardian['emergency_contact_phone']) ? $guardian['emergency_contact_phone'] : ''?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Main emergency phone number
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Emergency Contact Email
                        </td>
                        <td>
                            <input type="email" name="emergency_contact_email" value="<?=isset($guardian['emergency_contact_email']) ? $guardian['emergency_contact_email'] : ''?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Emergency contact email address
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="3" class="invertblack">
                            <i class="fa fa-chevron-circle-down"></i> Previous Education
                        </th>
                    </tr>
                    <tr>
                        <td>
                            Institute Name
                        </td>
                        <td>
                            <input type="text" name="institute" value="<?=$student['institute']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Previous Institute name
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Previous Course/Class
                        </td>
                        <td>
                            <input type="text" name="previous_class" value="<?=$student['previous_class']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Previous course or class
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year
                        </td>
                        <td>
                            <input type="text" name="year" value="<?=$student['year']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Previous education year
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Previous Marks
                        </td>
                        <td>
                            <input type="number" name="marks" value="<?=$student['marks']?>" class="form-control">
                        </td>
                        <td>
                        <span class="text-muted">
                            Previous education marks
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="portfolio-stat">
            <small class="text-muted">Portfolio Entries</small>
            <h3><?=$portfolio_summary['total_items']?></h3>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="portfolio-stat">
            <small class="text-muted">Categories Used</small>
            <h3><?=$portfolio_summary['category_count']?></h3>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="portfolio-stat">
            <small class="text-muted">Files Uploaded</small>
            <h3><?=$portfolio_summary['uploads_count']?></h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Student ePortfolio <small>Evidence, reflections, uploads and progress history</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a data-toggle="modal" data-target="#portfolioModal" href="#"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Entry</button></a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php if(!empty($portfolio_items)){ foreach($portfolio_items as $item){ ?>
                    <div class="portfolio-timeline-item">
                        <div class="row">
                            <div class="col-md-9">
                                <h4 style="margin-top: 0;"><?=$item['title']?></h4>
                                <p class="text-muted" style="margin-bottom: 8px;">
                                    <?=date('d-M-Y', strtotime($item['entry_date']))?>
                                    <?php if(!empty($item['created_by_name'])){ ?> | Added by <?=$item['created_by_name']?><?php } ?>
                                </p>
                                <?php if(!empty($item['category'])){ ?><span class="portfolio-tag"><?=$item['category']?></span><?php } ?>
                                <?php if(!empty($item['evidence_type'])){ ?><span class="portfolio-tag"><?=$item['evidence_type']?></span><?php } ?>
                                <?php if(!empty($item['grade'])){ ?><span class="portfolio-tag">Grade: <?=$item['grade']?></span><?php } ?>
                                <?php if(!empty($item['tag_list'])){ foreach(explode(',', $item['tag_list']) as $tag){ $tag = trim($tag); if($tag !== ''){ ?><span class="portfolio-tag"><?=$tag?></span><?php }} } ?>
                                <?php if(!empty($item['summary'])){ ?>
                                    <div style="margin-top: 12px;">
                                        <strong>Summary</strong>
                                        <p><?=nl2br(htmlspecialchars($item['summary'], ENT_QUOTES, 'UTF-8'))?></p>
                                    </div>
                                <?php } ?>
                                <?php if(!empty($item['teacher_note'])){ ?>
                                    <div style="margin-top: 12px;">
                                        <strong>Teacher Note</strong>
                                        <p><?=nl2br(htmlspecialchars($item['teacher_note'], ENT_QUOTES, 'UTF-8'))?></p>
                                    </div>
                                <?php } ?>
                                <?php if(!empty($item['student_reflection'])){ ?>
                                    <div style="margin-top: 12px;">
                                        <strong>Student Reflection</strong>
                                        <p><?=nl2br(htmlspecialchars($item['student_reflection'], ENT_QUOTES, 'UTF-8'))?></p>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-3 text-right">
                                <?php if(!empty($item['file_name'])){ ?>
                                    <a href="<?=base_url('student-portfolio-download/'.$id.'/'.$item['id'])?>" class="btn btn-sm btn-success"><i class="fa fa-download"></i> Download</a>
                                <?php } ?>
                                <a href="<?=base_url('student-portfolio-remove/'.$id.'/'.$item['id'])?>" class="btn btn-sm btn-danger" onclick="return confirm('Remove this ePortfolio entry?')"><i class="fa fa-trash"></i> Remove</a>
                            </div>
                        </div>
                    </div>
                <?php }}else{ ?>
                    <div class="alert alert-info">No ePortfolio entries yet. Add the first evidence item, reflection or assessment record for this student.</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="smsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">SMS Message</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('send-sms'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <!-- <label class="col-form-label label-align">Class <span class="required">*</span></label> -->
                    <select class="form-control select2" name="phone_number" style="width: 100%">
                        <option value="<?=$guardian['phone']?>">Guardian <?=$guardian['phone']?></option>
                        <option value="<?=$student['phone']?>">Student <?=$student['phone']?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('phone_number');?></span>    
                </div>
                <div class="form-group">
                    <textarea name="message" rows="6" class="form-control" style="resize: none;" placeholder="SMS Message type here..."><?php echo $this->input->post('message'); ?></textarea>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Send SMS</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="payModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pay Fee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('student-payfee/'.$id); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?=$student['id']?>">
                    <label class="col-form-label label-align">Amount</label>
                    <input type="number" name="amount" step=".01" placeholder="0.00" autofocus="true" class="form-control">  
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Fee Title</label>
                    <input type="text" name="title" class="form-control">  
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Date</label>
                    <input type="text" name="paid_date" id="date_picker" class="date_picker form-control" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Receipt Number (If Any):</label>
                    <input type="text" name="receipt" class="form-control"> 
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background: ">Cancel</button>
                <button type="submit" name="pay" class="btn btn-info btn-sm">Pay</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="emailModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Send Email</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('send-email'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                <input type="hidden" name="id" value="<?=urlencode(base64_encode($student['id']))?>">
                    <!-- <label class="col-form-label label-align">Class <span class="required">*</span></label> -->
                    <select class="form-control select2" name="receiver_email" style="width: 100%">
                        <!-- <option value="<?=$guardian['email']?>">Guardian <?=$guardian['email']?></option> -->
                        <option value="<?=$student['email']?>">Student Email: <?=$student['email']?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error('receiver_email');?></span>    
                </div>
                <div class="form-group">
                    <textarea name="message" rows="6" class="form-control" style="resize: none;" placeholder="Email Message type here..."><?php echo $this->input->post('message'); ?></textarea>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Send Email</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="portfolioModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add ePortfolio Entry</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?=form_open_multipart('student-portfolio-add/'.$id)?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Entry Date</label>
                            <input type="text" name="entry_date" class="date_picker form-control" value="<?=date('Y-m-d')?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="">Select category</option>
                                <?php foreach($portfolio_categories as $category){ ?>
                                    <option value="<?=$category?>"><?=$category?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Evidence Type</label>
                            <select name="evidence_type" class="form-control">
                                <option value="">Select evidence type</option>
                                <?php foreach($portfolio_evidence_types as $type){ ?>
                                    <option value="<?=$type?>"><?=$type?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Grade / Outcome</label>
                            <input type="text" name="grade" class="form-control" placeholder="A, Pass, Excellent, 85%">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tags</label>
                            <input type="text" name="tag_list" class="form-control" placeholder="reading, teamwork, science fair, presentation">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Summary</label>
                            <textarea name="summary" rows="3" class="form-control" placeholder="Short description of this evidence or achievement"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Teacher Note</label>
                            <textarea name="teacher_note" rows="4" class="form-control" placeholder="Feedback, observation, assessment note"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Student Reflection</label>
                            <textarea name="student_reflection" rows="4" class="form-control" placeholder="Student reflection or personal response"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Upload Evidence File</label>
                            <input type="file" name="portfolio_file" class="form-control">
                            <small class="text-muted">Supported: jpg, png, gif, pdf, doc, docx, xls, xlsx, ppt, pptx, txt, zip</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Save Entry</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            <?=form_close()?>
        </div>
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
