<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tasks</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                    <li >
                        <a href="<?=base_url('task-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add</button></a>
                    </li>
                    <?php } ?>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 5%">SR</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                                    <th style="width: 10%">Actions</th>
                                    <?php } ?>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($tasks as $c){
                                $c_id = urlencode(base64_encode($c['id'])); ?>
                                <tr>
                                    <td><?=$c['id']?></td>
                                    <td><?=$c['title']?></td>
                                    <td><?=$c['description']?></td>
                                    <?php if($this->session->userdata('role')== SUPERADMIN || $this->session->userdata('role')== ADMIN){ ?>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-warning btn-sm" href="<?=base_url('task-edit/'.$c_id)?>" title="Edit"><i class="fa fa-pencil"></i> </a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="confirmation(<?=$c['id']?>)" title="Delete"><i class="fa fa-trash"></i> </a>
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
                            url: "<?=site_url('task-remove/');?>"+id,
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