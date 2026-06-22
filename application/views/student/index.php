<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<style>
.panel_toolbox > li > a{
    padding: 0 !important;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Students</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <div class="item form-group">
                            <div class="col-sm-12">
                                <select class="form-control" name="class" onchange="get_subject(this.id)"> 
                                    <option selected="">Select Class</option>
                                    <option value="1" Selected>ID:1 CC-1=(<?=count($students)?> Students (<?=count($classes)?> Classes)**Active**)</option>
                                </select>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="<?=base_url('admission')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Student</button></a>
                    </li>
                    <li>
                        <a href="<?=base_url('download-student')?>"><button class="btn btn-sm btn-primary"><i class="fa fa-file-pdf-o"></i> Download</button></a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#smsModal" href="#"><button class="btn btn-sm btn-primary"><i class="fa fa-mobile"></i> SMS</button></a>
                    </li>
                    <li>
                        <a data-toggle="modal" data-target="#classModal" href="#"><button class="btn btn-sm btn-primary"><i class="fa fa-graduation-cap"></i> Change Student Class</button></a>
                    </li> 
                    <li hidden>
                        <a href="#"  title="Delete"><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button></a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="col-sm-12 text-right">
                    <a href="#" id="filter" data-toggle="collapse" data-target="#filterR"><i class="fa fa-filter"></i> Filter Result</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    
                    <div id="filterR" class="col-sm-12 collapse">
                        <?=form_open('student');?>
                        <div class="row">
                            <div class="col-md-3 text-right">
                              <label>Admission Dates</label>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                                <input  name="from_date" placeholder="From Date" value="<?=$this->input->post('from_date')?>" id="date_picker" class="date_picker form-control" type="text">
                                <span>Select date range </span>
                                <span class="text-danger"><?php echo form_error('from_date');?></span>
                              </div>
                            </div>
                            <div class="col-md-3">
                              <div class="form-group">
                              <input  name="to_date" placeholder="To Date" value="<?=$this->input->post('to_date')?>" id="date_picker" class="date_picker form-control" type="text">
                                <!-- <span>To</span> -->
                                <span class="text-danger"><?php echo form_error('to_date');?></span>
                              </div>
                            </div>
                        </div>
                        <!-- Select Class -->
                        <div class="row">
                            <div class="col-md-3 text-right">
                              <label>Select Class</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="class_id" class="form-control select2" style="width: 100%">
                                        <option value="">Select Class</option>
                                        <?php
                                        foreach($classes as $c)
                                        {
                                            $selected = ($c['id'] == $this->input->post('class_id')) ? ' selected="selected"' : "";

                                            echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['class_name'].'</option>';
                                        } ?>
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <!-- Select Subject -->
                        <div class="row">
                            <div class="col-md-3 text-right">
                              <label>Select Subject</label>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <select name="subject_id" class="form-control select2" style="width: 100%">
                                        <option value="">Select Subject</option>
                                        <?php
                                        foreach($subjects as $sbj)
                                        {
                                            $selected = ($sbj['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                                            echo '<option value="'.$sbj['id'].'" '.$selected.'>'.$sbj['subject_name'].'</option>';
                                        } ?>
                                    </select>   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Filter Result</button>
                                    <button type="reset" class="btn btn-danger">Clear Filter</button>
                                </div>
                            </div>
                        </div>
                        <?=form_close();?>
                    </div>
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th hidden>
                                    <div class="item form-group">
                                        <p style="margin-top: 8px">
                                            <input type="checkbox" class="flat" name="delt" id="service"/>
                                        </p>
                                    </div>    
                                    </th>
                                    <th>ID</th>
                                    <th>Student Info</th>
                                    <th>Financials</th>
                                    <th>Other</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="students">
                                <?php foreach($students as $s){
                                    $s_id = urlencode(base64_encode($s['id']));
                                 ?>
                                    <tr>
                                        <td hidden><p style="margin-top: 8px">
                                                <input type="checkbox" class="flat" name="" id="service"/>
                                            </p> 
                                        </td>
                                        <td><?php echo $s['id']; ?></td>
                                        <td>
                                            <?='Student Name: <a href="'.site_url('student-profile/'.$s_id).'" class="text-primary" style="font-wight: bold;">'.$s['std_name'].'</a><br>';?>
                                            <?='Roll # '.$s['roll_no'].'<br>';?>
                                            <?='Admission No. '.$s['admission_no'].'<br>';?>
                                            <?='Guardian: '.$s['guardian_name'].'('.$s['gphone'].')<br>';?>
                                        </td>
                                        <td>
                                            <?='Monthly Fee: £'.number_format($s['monthly_fee'],2).'<br>';?>
                                            <?='Payables: £'.number_format($s['class_id'],2).'<br>';?>
                                        </td>
                                        <td>
                                            <?=$s['class_name'].'-'.$s['batch_name'].'<br>';?>
                                            <?='Admission Date: '.date('d-M-Y',strtotime($s['admission_date'])).'<br>';?>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger btn-sm" href="<?=base_url('student-remove/'.$s['id'])?>" title="Delete"><i class="fa fa-trash"></i></a>
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
<!-- The Modal -->
<div class="modal fade" id="classModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change Student Class</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('update-class'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <!-- <label class="col-form-label label-align">Class <span class="required">*</span></label> -->
                    <select class="form-control select2" name="id" style="width: 100%">
                        <option selected="">Select Student</option>
                        <?php foreach($students as $s)
                        {
                                $selected = ($s['id'] == $this->input->post('id')) ? ' selected="selected"' : "";
                                echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['std_name'].'</option>';
                        } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('id');?></span>    
                </div>
                <div class="form-group">
                    <!-- <label class="col-form-label label-align">Class <span class="required">*</span></label> -->
                    <select class="form-control select2" name="class_id" style="width: 100%">
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
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Change Class</button>
            </div>
            <?php echo form_close(); ?>
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
                        <option value="">Select Student</option>
                        <?php foreach($students as $s)
                        {
                                $selected = ($s['id'] == $this->input->post('phone_number')) ? ' selected="selected"' : "";
                                echo '<option value="'.$s['gphone'].'" '.$selected.'>'.$s['std_name'].'</option>';
                        } ?>
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
<!-- //End Modal -->
<script>
    $(function() {
        $('#filter').click(function() {
            if ($(this).html()=='<i class="fa fa-filter"></i> Filter Result') {
                $(this).html('<i class="fa fa-filter"></i> Hide Filter');
            }else{
                $(this).html('<i class="fa fa-filter"></i> Filter Result');
            }
        })
    })
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationYes").click(function(){
                        $.ajax({
                            url: "<?=site_url('student-remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Student deleted successfully.");
                                $('#students').html(data);
                            }
                        });
                    });
                }
            });
    }
</script>
