<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Classes</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                    <li >
                        <a data-toggle="modal" data-target="#addModal" href="<?=base_url('class-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add New Class</button></a>
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
                            <h4 class="modal-title">Add Class</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php echo form_open('class-add'); ?>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Type Of Class <span class="required">*</span></label>
                                        <input type="text" name="class_name" placeholder="Class Name" class="form-control" value="<?php echo $this->input->post('class_name'); ?>" >
                                        <span class="text-danger"><?php echo form_error('class_name');?></span>    
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="col-form-label label-align">Select Batch</label>
                                        <select class="form-control select2" name="batch_id" style="width: 100%">
                                            <option value="">Select Batch</option>
                                            <?php
                                            foreach($batches as $b)
                                            {
                                                $selected = ($b['id'] == $this->input->post('batch_id')) ? ' selected="selected"' : "";

                                                echo '<option value="'.$b['id'].'" '.$selected.'>'.$b['batch_name'].'</option>';
                                            } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('batch_id');?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group"> 
                                        <label class="col-form-label label-align">Subject</label>
                                        <select multiple="multiple" size="10" name="subjects[]" class="form-control dual_listbox" style="height: 150px">
                                            <?php
                                            foreach($subjects as $s)
                                            {
                                                $selected = ($s['id'] == $this->input->post('subjects')) ? ' selected="selected"' : "";

                                                echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
                                            } ?>
                                        </select>   
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
                                    <th>Name</th>
                                    <th>Subjects</th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($classes as $c){
                                $c_id = urlencode(base64_encode($c['id'])); ?>
                                <tr>
                                    <td><?=$c['id']?></td>
                                    <td>
                                        <a href="<?=base_url('class-edit/'.$c_id)?>"><?=$c['class_name']?></a><br>
                                        (<?=$c['stdents']?> students)
                                    </td>
                                    <td><?php foreach($c['subjects'] as $s){
                                        echo $s['subject_name'].', ';
                                    } ?></td>
                                    <!-- <td style="white-space: nowrap">
                                        <a class="btn btn-warning btn-sm" href="<?=base_url('class/edit/'.$c_id)?>" title="Edit"><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="confirmation(<?=$c['id']?>)" title="Delete"><i class="fa fa-trash"></i> </a>
                                    </td> -->
                                </tr>
                                <?php } ?>
                                </tbody>
                            </table>

                            <div class="pull-right">
                                <?php echo $this->pagination->create_links(); ?>
                            </div>
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