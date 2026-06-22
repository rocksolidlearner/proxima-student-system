<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
</script>
<style>
    td.danger{
        background-color: #ffb8c4 !important
    }
    td.success{
        background-color: #7aaa29 !important
    }
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Time Table</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#ShiftModal"><i class="fa fa-clock-o"></i> Manage Shifts</button>
                    </li>
                    <li>
                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Time Table</button>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Classes</th>
                                    <th>Entries</th>
                                    <th>Teachers</th>
                                    <th>Subjects</th>
                                    <th style="width: 10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($timetables as $t){
                                $t_id = urlencode(base64_encode($t['id'])); ?>
                                <tr>
                                    <td><a href="#"><?=$t['class_name']?></a></td>
                                    <td><?=$t['shift_name']?></td>
                                    <td><?=$t['employee_name']?></td>
                                    <td><?=$t['subject_name']?></td>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-info btn-sm" id="print" onclick="get_print()" href="#" title="Print"><i class="fa fa-print"></i> </a>
                                     </td>
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Manage Shift Modal -->
<div class="modal fade" id="ShiftModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?=$total_sifts?></h4>
                <div class="text right">
                    <button class="btn btn-success btn-sm" data-toggle="collapse" data-target="#addShift"><i class="fa fa-plus"></i> Add Shift</button>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
            </div>
            <div class="modal-body">
                <?php echo form_open('shift-add'); ?>
                <div class="row collapse" id="addShift">
                    <div class="col-md-3 col-sm-3">
                        <label>Shift Name<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="text" name="shift_name" class="form-control" placeholder="e.g Shift1" required value="<?php echo $this->input->post('shift_name'); ?>" >
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <label>Start Time<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="text" name="start_time" max="23:00" id="start_time" class="time_picker form-control">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <label>End Time<span class="text-danger">*</span></label>
                        <div class="form-group">
                            <input type="text" name="end_time" id="end_time" class="time_picker form-control">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label></label>
                        <div class="form-group" style="margin-top: 7px">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Time</th>
                        <th>Used In</th>
                        <th style="width: 10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($shifts as $s){?>
                    <tr>
                        <td><?=$s['id']?></td>
                        <td><?=$s['shift_name']?></td>
                        <td><?=$s['start_time'].' - '.$s['end_time']?></td>
                        <td>0</td>
                        <td style="white-space: nowrap">
                            <button class="btn btn-danger btn-sm" onclick="confirmation(<?=$s['id']?>)"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!-- Add Time Table Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body" style="overflow-x: scroll">
                <div class="row">
                    <div class="col-md-3 col-sm-12 text-right">
                        <div class="form-group">
                            <label>Select Class</label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <select name="class_id" id="class_id" class="form-control select2" style="width: 100%">
                                <option value="">== Select Class ==</option>
                                <?php
                                foreach($classes as $class)
                                {
                                    $selected = ($class['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$class['id'].'" '.$selected.'>'.$class['class_name'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 14%">Shift</th>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Web</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($shift_days as $s){?>
                    <tr id="tr_shift_<?=$s['id']?>" data-id="<?=$s['id']?>">
                        <td><?='<b>'.$s['id'].'. '.$s['shift_name'].'</b><br>'.
                        $s['start_time'].' > '.$s['end_time']?></td>
                        <?php foreach($s['days'] as $d){ 
                            if($d['day'] == MON){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=MON?>)" id="subject_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != MON){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=MON?>)" id="subject_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=MON?>)" id="subject_id_<?=MON?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }
                         foreach($s['days'] as $d){ 
                            if($d['day'] == TUE){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=TUE?>)" id="subject_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != TUE){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=TUE?>)" id="subject_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=TUE?>)" id="subject_id_<?=TUE?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }foreach($s['days'] as $d){ 
                            if($d['day'] == WED){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=WED?>)" id="subject_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != WED){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=WED?>)" id="subject_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=WED?>)" id="subject_id_<?=WED?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php } foreach($s['days'] as $d){ 
                            if($d['day'] == THU){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=THU?>)" id="subject_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != THU){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=THU?>)" id="subject_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=THU?>)" id="subject_id_<?=THU?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }foreach($s['days'] as $d){ 
                            if($d['day'] == FRI){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=FRI?>)" id="subject_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != FRI){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=FRI?>)" id="subject_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=FRI?>)" id="subject_id_<?=FRI?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }foreach($s['days'] as $d){ 
                            if($d['day'] == SAT){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SAT?>)" id="subject_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != SAT){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SAT?>)" id="subject_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SAT?>)" id="subject_id_<?=SAT?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }foreach($s['days'] as $d){ 
                            if($d['day'] == SUN){?>
                        <td class="success">
                            <select name="teacher_id" id="teacher_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $d['teacher_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SUN?>)" id="subject_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $d['subject_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }elseif($d['day'] != SUN){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SUN?>)" id="subject_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }}
                        if(empty($s['days'])){?>
                        <td class="danger">
                            <select name="teacher_id" id="teacher_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%;">
                                <option value="">== Teacher ==</option>
                                <?php foreach($teachers as $t)
                                {
                                    if($t['role']==TEACHER){
                                    $selected = ($t['id'] == $this->input->post('teacher_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$t['id'].'" '.$selected.'>'.$t['employee_name'].'</option>';
                                    }
                                }?>
                            </select>
                            <select name="subject_id" onchange="save_record(<?=$s['id']?>,<?=SUN?>)" id="subject_id_<?=SUN?>_<?=$s['id']?>" class="form-control select2" style="width: 100%">
                                <option value="">== Subject ==</option>
                                <?php foreach($subjects as $subj)
                                {
                                    $selected = ($subj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$subj['id'].'" '.$selected.'>'.$subj['subject_name'].'</option>';
                                }?>
                            </select>
                        </td>
                        <?php }?>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- //End Modal -->
<script>
       function get_print() {
            var pageTitle = 'Timetable',
                stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
                win = window.open('', 'Print', 'width=500,height=300');
            win.document.write('<html><head><title>' + pageTitle + '</title>' +
                '<link rel="stylesheet" href="' + stylesheet + '">' +
                '</head><body>' + $('.table')[0].outerHTML + '</body></html>');
            win.document.close();
            win.print();
            win.close();
            return false;
        }
    function save_record(shift_id,day) {
        var class_id = $('#class_id').val();
        var teacher_id = $('#teacher_id_'+day+'_'+shift_id).val();
        var subject_id = $('#subject_id_'+day+'_'+shift_id).val();
        
        $.ajax({
            url: "<?=site_url('timetable/save_timetable');?>",
            type:"POST",
            data:{
                shift_id:shift_id,
                class_id:class_id,
                teacher_id:teacher_id,
                subject_id:subject_id,
                day:day
            },
            success: function (data) {
                toastr.success('success',"Save record successfully.");
            }
        });
    }
    $(function(){
        $("#class_id").change(function(){
            console.log($(this).val());
            $('#mon_').removeClass('danger');
            $('#mon_'+<?=$s['id']?>).addClass('success');
            $('#teacher_id_'+<?=$s['id']?>).removeAttr('disabled');
            
        });
    });
</script>
<script>
    $(function(){
        $("#class_id").change(function(){
            $('#teacher_id').val();
            // $.ajax({
            //     url: "<?=site_url('shift-remove/');?>"+id,
            //     success: function (data) {
            //         toastr.success('success',"Shift deleted successfully.");
            //         $('#ShiftModal').modal('hide');
            //     }
            // });
        });
    });
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationRevertYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationRevertYes").click(function(){
                        $.ajax({
                            url: "<?=site_url('shift-remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Shift deleted successfully.");
                                $('#ShiftModal').modal('hide');
                            }
                        });
                    });
                }
            });
    }
</script>