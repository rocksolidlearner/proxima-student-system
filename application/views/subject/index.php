<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Subjects</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                    <li>
                        <a data-toggle="modal" data-target="#addModal" href="<?=base_url('subject-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add</button></a>
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
                            <h4 class="modal-title">Add Subject</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <?php echo form_open('subject-add'); ?>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="col-form-label label-align">Type Of Subject <span class="required">*</span></label>
                                <input type="text" name="subject_name" placeholder="Subject" class="form-control" value="<?php echo $this->input->post('subject_name'); ?>" >
                                <span class="text-danger"><?php echo form_error('subject_name');?></span>    
                            </div>
                            <div class="form-group">
                                <label class="col-form-label label-align">Short Name</label>
                                <input type="text" name="short_name" placeholder="Short Name" class="form-control" value="<?php echo $this->input->post('short_name'); ?>" >
                                <span class="text-danger"><?php echo form_error('short_name');?></span>    
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
                                    <th style="width: 20%">Order</th>
                                    <th>Subject</th>
                                    <th>Short Name</th>
                                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                                    <th style="width: 10%">Actions</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($subjects as $s){
                                $s_id = urlencode(base64_encode($s['id'])); ?>
                                <tr>
                                    <td><input type="number" value="<?=$s['display_order']?>" class="form-control input-small" onchange="SaveOrder(<?=$s['id']?>)"></td>
                                    <td><?=$s['subject_name']?></td>
                                    <td><?=$s['short_name']?></td>
                                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-warning btn-sm" href="<?=base_url('subject/edit/'.$s_id)?>" title="Edit"><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="confirmation(<?=$s['id']?>)" title="Delete"><i class="fa fa-trash"></i> </a>
                                    </td>
                                    <?php } ?>
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
                            url: "<?=site_url('subject/remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Subject deleted successfully.");
                                $("#result").html(data);
                            }
                        });
                    });
                }
            });
    }
</script>