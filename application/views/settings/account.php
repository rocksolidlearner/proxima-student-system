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
                <h2>Account Settings</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addModal" ><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Head</button></a>
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
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Head</th>
                                    <th style="width: 10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($accounts as $ac){?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><a href="#" onclick="get_account(<?=$ac['id']?>)"><?=$ac['account_head']?></a></td>
                                    <td><a href="<?=base_url('account-setting-remove/'.$ac['id'])?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <?php }?>
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
                <h4 class="modal-title">Add Head</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('account-setting'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label label-align">Type head</label>
                    <input type="text" name="account_head" autofocus="true" placeholder="Account Head" class="form-control" value="<?php echo $this->input->post('account_head'); ?>" >
                    <span class="text-danger"><?php echo form_error('account_head');?></span>    
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Save Changes</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Head</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('account-setting-edit'); ?>
            <!-- Modal body -->
            <div class="modal-body" id="edit_data"></div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Save Changes</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
<script>
    // Sate, city
	function get_account(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('setting/edit_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
            }
        });
	}
</script>