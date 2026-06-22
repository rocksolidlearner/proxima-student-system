<style>
    .table1 th,.table1 td{
        border-top: none;
    }
    /* Base for label styling */
    [type="checkbox"]:not(:checked),
    [type="checkbox"]:checked {
        position: absolute;
        left: -9999px;
    }
    [type="checkbox"]:not(:checked) + label,
    [type="checkbox"]:checked + label {
        position: relative;
        padding-left: 1.95em;
        cursor: pointer;
    }

    /* checkbox aspect */
    [type="checkbox"]:not(:checked) + label:before,
    [type="checkbox"]:checked + label:before {
        content: '';
        position: absolute;
        left: 0; top: 0;
        width: 1.25em; height: 1.25em;
        border: 2px solid #ccc;
        background: #fff;
        border-radius: 4px;
        box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
    }
    /* checked mark aspect */
    [type="checkbox"]:not(:checked) + label:after,
    [type="checkbox"]:checked + label:after {
        content: '\2713\0020';
        position: absolute;
        top: .15em; left: .22em;
        font-size: 1.3em;
        line-height: 0.8;
        color: #09ad7e;
        transition: all .2s;
        font-family: 'Lucida Sans Unicode', 'Arial Unicode MS', Arial;
    }
    /* checked mark aspect changes */
    [type="checkbox"]:not(:checked) + label:after {
        opacity: 0;
        transform: scale(0);
    }
    [type="checkbox"]:checked + label:after {
        opacity: 1;
        transform: scale(1);
    }
    /* disabled checkbox */
    [type="checkbox"]:disabled:not(:checked) + label:before,
    [type="checkbox"]:disabled:checked + label:before {
        box-shadow: none;
        border-color: #bbb;
        background-color: #ddd;
    }
    [type="checkbox"]:disabled:checked + label:after {
        color: #999;
    }
    [type="checkbox"]:disabled + label {
        color: #aaa;
    }
    /* accessibility */
    [type="checkbox"]:checked:focus + label:before,
    [type="checkbox"]:not(:checked):focus + label:before {
        border: 2px dotted blue;
    }

    /* hover style just for information */
    label:hover:before {
        border: 2px solid #4778d9!important;
    }
    .panel_toolbox > li#editbtn  > a:hover {
        background: #d39e00;
    }
</style>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Client Info</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <?php if($this->session->userdata('role')== ADMIN || $this->session->userdata('role')== SITE_MANAGER){ ?>
                            <li id="editbtn">
                                <?php $c_id = urlencode(base64_encode($client['id'])); ?>
                                <a class="btn btn-warning btn-sm" href="<?php echo site_url('client/edit/'.$c_id); ?>" title="Edit" style="color: white"><i class="fa fa-pencil"></i></a>
                            </li>
                            <?php }?>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                            <div class="widget widget_tally_box">

                                    <h4>Name: <?=$client['first_name'].' '.$client['last_name']?></h4>
                                    <h4>Phone: <?=$client['phone']?></h4>
                                    <h4>Address: <?=$client['address']?></h4>
                                    <h4>Designation: <?php if($client['designation']== ADULT)
                                        { 
                                            echo "Adult";
                                        }elseif($client['designation']== MINOR){
                                            echo "Minor";
                                        }?>
                                    </h4>
                                    <h4>Emergency Contact: <?=$client['em_contact']?></h4>

                                    <div class="flex">
                                        <ul class="list-inline count2">
                                            <li>
                                                <h3><?=$tot_session?></h3>
                                                <span>Sessions</span>
                                            </li>
                                            <li>
                                                <h3><?=$tot_goals?></h3>
                                                <span>Goals</span>
                                            </li>
                                            <li>
                                                <h3><?=$goal_achives?></h3>
                                                <span>Achieved</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <h4>DOB: <?=$client['dob']?></h4>
                                    <h4>DOJ: <?=$client['doj']?></h4>
                                    <h4>Reauthorization Date: <?=$client['doa']?></h4>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-sm-8">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title" hidden>
                    <h2>Client Sessions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card-box">
                                <table class="table table1">
                                    <tr>
                                        <th>Therapist: </th>
                                        <?php if ($client['assign_type'] == THERAPIST) {
                                            echo '<th>Name</th>';
                                            echo '<td>'.$client['user_fname'].' '.$client['user_lname'].'</td>';
                                            echo '<th>Phone</th>';
                                            echo '<td>'.$client['user_phone'].'</td>';
                                            echo '<th>Email</th>';
                                            echo '<td>'.$client['user_email'].'</td>';
                                        }else{
                                            echo '<th>Name</th>';
                                            echo '<td></td>';
                                            echo '<th>Phone</th>';
                                            echo '<td></td>';
                                            echo '<th>Email</th>';
                                            echo '<td></td>';
                                        } ?>
                                    </tr>
                                    <tr>
                                        <th>Worker: </th>
                                        <?php if (empty($client['user_fname'])) {
                                            echo '<th>Name</th>';
                                            echo '<td>'.$client['w_name'].'</td>';
                                            echo '<th>Phone</th>';
                                            echo '<td>'.$client['w_phone'].'</td>';
                                            echo '<th>Email</th>';
                                            echo '<td></td>';
                                        }elseif ($client['assign_type'] == PRP_WORKER) {
                                            echo '<th>Name</th>';
                                            echo '<td>'.$client['user_fname'].' '.$client['user_lname'].'</td>';
                                            echo '<th>Phone</th>';
                                            echo '<td>'.$client['user_phone'].'</td>';
                                            echo '<th>Email</th>';
                                            echo '<td>'.$client['user_email'].'</td>';
                                        }else{
                                            echo '<th>Name</th>';
                                            echo '<td></td>';
                                            echo '<th>Phone</th>';
                                            echo '<td></td>';
                                            echo '<th>Email</th>';
                                            echo '<td></td>';
                                        } ?>
                                    </tr>
                                    <tr>
                                        <th>Service</th>
                                        <td colspan="6">
                                        <?php foreach ($client['services'] as $s) {
                                            if($s['name']== PRP){ 
                                                echo "PRP, ";
                                            }elseif($s['name']== TBS){
                                                echo "TBS, ";
                                            }elseif($s['name']== MEDICICAL){
                                                echo " Medical";
                                            }
                                        }?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Diagnosis:</th>
                                        <td colspan="6"><?=$client['diagnosis']?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7">
                                            <hr style="margin-bottom: 0;">
                                        </th>
                                    </tr>
                                    <?php if($this->session->userdata('role')== ADMIN || $this->session->userdata('role')== SITE_MANAGER){ ?>
                                    <tr>
                                        <th>Medical Assistance #</th>
                                        <td><?=$client['medical_number']?></td>
                                        <th></th>
                                        <td></td>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Client Notes</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="card-box">
                                    <p>
                                        Low:
                                        <input type="radio" class="flat-blue" name="note_type" id="minor" value="<?=MINOR?>" checked /> &nbsp; | &nbsp;
                                        Medium:
                                        <input type="radio" class="flat-orange" name="note_type" id="medium" value="<?=MEDIUM?>" />   &nbsp;|&nbsp;
                                        High:
                                        <input type="radio" class="flat-red" name="note_type" id="major" value="<?=MAJOR?>" />
                                    </p>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-sm" id="note_disc">
                                        <span class="input-group-btn">
                                          <button type="button" id="note_btn" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Note</button>
                                        </span>
                                    </div>
                                    <div class="ln_solid"></div>

                                    <ul class="list-unstyled timeline" id="notes_list">
                                        <?php foreach ($client_notes as $cn){
                                            $role = '';
                                            if ($cn['role'] == ADMIN){
                                                $role = 'Admin';
                                            }elseif ($cn['role'] == SITE_MANAGER){
                                                $role = 'Site Manager';
                                            }elseif ($cn['role'] == THERAPIST){
                                                $role = 'Therapist';
                                            }elseif ($cn['role'] == PRP_WORKER){
                                                $role = 'PRP Worker';
                                            }
                                            ?>
                                            <li>
                                                <div class="block">
                                                    <div class="tags">
                                                        <?php if ($cn['note_type'] == MAJOR){
                                                            echo '<a class="tag tag-red"><span>High</span></a>';
                                                        }elseif ($cn['note_type'] == MEDIUM){
                                                            echo '<a class="tag tag-orange"><span>Medium</span></a>';
                                                        }elseif ($cn['note_type'] == MINOR){
                                                            echo '<a class="tag tag-blue"><span>Low</span></a>';
                                                        } ?>
                                                    </div>
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a><?=$cn['note']?></a>
                                                        </h2>
                                                        <div class="byline">
                                                            <span><?=date('M d,Y h:i a',strtotime($cn['date_created']))?></span> by <a><?=$cn['first_name'].' '.$cn['last_name'].'('.$role.')'?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-8 col-sm-8">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Client Sessions</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card-box">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Time</th>
                                        <th>Documents</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($appointment as $ap){
                                        $name = '';
                                        if ($ap['prp_worker_id']) {
                                            $prp_worker = $this->Tbl_user_model->get_tbl_user($ap['prp_worker_id']);
                                            $name=$prp_worker['first_name'].' '.$prp_worker['last_name'];
                                        }
    
                                        if($ap['is_group_session'] == 0){?>
                                        <tr>
                                            <td><?=$ap['date']?></td>
                                            <td><?php if($ap['session_type'] == THERAPIST){ 
                                                    echo "Therapist";
                                                }elseif($ap['session_type'] == PRP_WORKER){
                                                    echo "Worker";
                                                }elseif($ap['session_type'] == BILLING){
                                                    echo "Billing";
                                                }elseif($ap['session_type'] == OTHER){
                                                    echo "Other";
                                                }?>
                                            </td>
                                            <td><?=$ap['from_time']?></td>
                                            <td>
                                                <?php foreach($ap['documents'] as $d){ ?>
                                                <a href="<?=base_url('appointment/download/'.$d['file'])?>"><?=$d['file'];?></a><br>
                                            <?php }?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($ap['status'] == SESSION_NOTSTARTED){
                                                    echo '<span class="badge badge-warning">Not Started</span>';
                                                }elseif ($ap['status'] == SESSION_COMPLETED){
                                                    echo '<span class="badge badge-success"><i class="fa fa-check-circle"></i> Completed</span>';
                                                }elseif ($ap['status'] == SESSION_CANCELLED){
                                                    echo '<span class="badge badge-danger"><i class="fa fa-times-circle"></i> Cancelled</span>';
                                                }  ?>
                                            </td>
                                        </tr>
                                    <?php }elseif(isset($ap['sessions'])){
                                        foreach($ap['sessions'] as $s){
                                            $worker = $this->Tbl_user_model->get_tbl_user($s['prp_worker_id'])?>
                                        <tr>
                                            <td><?=$s['date']?></td>
                                            <td><?=$s['therapist_name'].' '.$s['therapist_lname']?></td>
                                            <td><?=$worker['first_name'].' '.$worker['last_name']?></td>
                                            <td>
                                                <?php if($s['status'] != SESSION_NOTSTARTED || $s['status'] !=  SESSION_CANCELLED){
                                                    echo '<span class="badge badge-success">P</span>';
                                                }else{
                                                echo '<span class="badge badge-danger">A</span>';
                                                }?>
    
                                            </td>
                                        </tr>
                                    <?php } }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-4">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Client Goals</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <?php if($this->session->userdata('role') != PRP_WORKER){ ?>
                                <div class="form-group">
                                    <input type="text" name="goal_date" id="goal_date" class="date_picker form-control form-control-sm">
                                </div>
                                <div class="input-group">
                                    <input type="text" name="goal_disc" id="goal_disc" class="form-control form-control-sm" placeholder="Description..">
                                    <span class="input-group-btn">
                                        <button type="button" id="goal_btn" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Goal</button>
                                    </span>
                                </div>
                                <?php } ?>
                                <div class="">
                                    <ul class="to_do" id="goals_list">
                                        <?php foreach($client_goals as $cg){ ?>
                                            <li>
                                                <p>
                                                    <input type="checkbox" id="checkbox<?=$cg['id']?>" onchange="update_status(<?=$cg['id']?>)" <?php if($cg['goal_status'] == COMPLETE){ echo 'checked';} ?>/>
                                                    <label for="checkbox<?=$cg['id']?>"><?=$cg['goal_disc']?></label>
                                                    <button class="btn btn-warning btn-sm" onclick="edit_goal(<?=$cg['id']?>)" id="edit_goal" style="float: right"><i class="fa fa-pencil"></i> </button>
                                                </p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="modal fade" id="goalEdit">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Edit Goal</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal-body" id="editGoal"></div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                                          <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                                        </div>
        
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="col-md-2 col-sm-2">
        <div class="x_panel">
            <h2>Goal Achives</h2>
            <div class="x_content">
                <h3 class="text-center"><?=$goal_achives?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Client Files</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>

                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="card-box">
                                <table class="table table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th style="width: 2%">ID</th>
                                        <th>File</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($appointment as $ap) {
                                    foreach($ap['documents'] as $d){ ?>
                                        <tr>
                                            <td><?=$d['id']; ?></td>
                                            <td><a href="<?=base_url('appointment/download/'.$d['file'])?>"><?=$d['file'];?></a></td>
                                        </tr>
                                    <?php } } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //Add new goal
    $(function () {
        $("#goal_btn").click(function(){
            var client_id = <?=$client['id']?>;
            var goal_date = $('#goal_date').val();
            var goal_disc = $('#goal_disc').val();

            if(goal_disc != '' && goal_date != ''){
                $.ajax({
                    url: "<?=base_url('goal/add')?>",
                    type: "POST",
                    data: {
                        client_id: client_id,
                        goal_date:goal_date,
                        goal_disc:goal_disc,
                    },
                    success: function (data) {
                        toastr.success("Your New Goal set.");
                        $('#goals_list').html(data);
                        $('#goal_date').val('');
                        $('#goal_disc').val('');
                    }
                });
            }else if(goal_date ==''){
                $('#goals_list').html('Please select your goal date');
            }
            else{
                $('#goals_list').html('Please add your goal discription');
            }
        });
    });

    //Edit Goal
    function edit_goal(id) {
        $("#goalEdit").modal();
        $("#editGoal").html(id);
        $.ajax({
            url: "<?=base_url('goal/goal_edit/')?>"+id,
            success: function (data) {
                $("#editGoal").html(data);
                $('.date_picker1').datetimepicker({
                            format: 'YYYY-MM-DD'
                });
            }
        });
    }
    //Add New note
    $(function () {
        $("#note_btn").click(function(){
            var client_id = <?=$client['id']?>;
            var note_type;
            var note = $('#note_disc').val();
            if ($("#minor").is(":checked")) {
                note_type = $('#minor').val();
                console.log('minor');
            }else if ($("#medium").is(":checked")) {
                note_type = $('#medium').val();
                console.log('medium');
            }else if ($("#major").is(":checked")) {
                note_type = $('#major').val();
                console.log('major');
            }
            console.log(note_type);
            $.ajax({
                url: "<?=base_url('Note/add')?>",
                type: "POST",
                data: {
                    client_id: client_id,
                    note_type:note_type,
                    note:note,
                },
                success: function (data) {
                    toastr.success("Your New Note add.");
                    $('#notes_list').html(data);
                    $('#note_disc').val('');
                    $('input.flat-red').iCheck({
                        radioClass: 'iradio_flat-red'
                    });
                    $('input.flat-orange').iCheck({
                        radioClass: 'iradio_flat-orange'
                    });
                    $('input.flat-blue').iCheck({
                        radioClass: 'iradio_flat-blue'
                    });
                }
            });

        });
    });

    //Update Goal Status
    function update_status(id) {
        if ($('#checkbox'+id).is(":checked"))
        {
            var client_id = <?=$client['id']?>;
            var status = "on";

            $.ajax({
                url: "<?=base_url('goal/update_status/')?>"+id,
                type: "POST",
                data: {
                    client_id:client_id,
                    status: status},
                success: function (data) {
                    toastr.success("Your Goal mark complete.");
                    $('#goals_list').html(data);
                }
            });
        }else {
            console.log('off');
        }

    }
</script>