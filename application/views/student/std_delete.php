<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
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
                        <a href="<?=base_url('admission')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Student</button></a>
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
                                    <th>Class</th>
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
                                            <?=$s['class_name'].'<br>';?>
                                            <?='Admission Date: '.date('d-M-Y',strtotime($s['admission_date'])).'<br>';?>
                                        </td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?=base_url('student-restore/'.$s['id'])?>" title="Restore"><i class="fa fa-refresh"></i></a>
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
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Change Student Class</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('student-class'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label label-align">Class <span class="required">*</span></label>
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
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
