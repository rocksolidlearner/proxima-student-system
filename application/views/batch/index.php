<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Batches/Years/Sessions</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                    <li>
                        <a data-toggle="modal" data-target="#addModal" href="<?=base_url('batch-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add</button></a>
                    </li>
                    <?php } ?>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="addModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Save Batch</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php echo form_open('batch-add'); ?>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Batch Name <span class="required">*</span></label>
                                        <input type="text" name="batch_name" placeholder="Enter unique batch name" class="form-control" value="<?php echo $this->input->post('batch_name'); ?>" >
                                        <span class="text-danger"><?php echo form_error('batch_name');?></span>    
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Starting Date</label>
                                        <input type="text" name="start_date" placeholder="Select session's starting date" id="date_picker" class="date_picker form-control">
                                        <span class="text-danger"><?php echo form_error('start_date');?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Ending Date</label>
                                        <input type="text" name="end_date" placeholder="Select session's ending date" id="date_picker" class="date_picker form-control">
                                        <span class="text-danger"><?php echo form_error('start_date');?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Active</label>
                                        <select class="form-control" name="status">
                                            <?php $status = array('Yes' => 'Yes','No'=>'No');
                                            foreach($status as $key => $v)
                                            {
                                                $selected = ($v == $this->input->post('status')) ? ' selected="selected"' : "";

                                                echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                                            } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('status');?></span>    
                                    </div>
                                </div>
                            </div>            
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <!-- //End Modal -->
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 5%">ID</th>
                                    <th>Batch Name</th>
                                    <th>Session Dates</th>
                                    <th>Students</th>
                                    <th>Active</th>
                                    <th>Classes</th>
                                    <!-- <th>History</th> -->
                                    <!-- <th style="width: 10%">Actions</th> -->
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($batches as $b){
                                $b_id = urlencode(base64_encode($b['id'])); ?>
                                <tr>
                                    <td><?=$b['id']?></td>
                                    <td><a href="<?=base_url('batch-edit/'.$b_id)?>"><?=$b['batch_name']?></a></td>
                                    <td><?=$b['start_date']?> <i class="fa fa-angle-right"></i> <?=$b['end_date']?></td>
                                    <td><?=$b['students']?></td>
                                    <td><?=$b['status']?></td>
                                    <td><?=$b['classes']?></td>
                                    <!-- <td><a href="#">History</a></td> -->
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
<script>
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationRevertYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationRevertYes").click(function(){
                        $.ajax({
                            url: "<?=site_url('class/remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Class deleted successfully.");
                                $("#result").html(data);
                            }
                        });
                    });
                }
            });
    }
</script>