<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>All Teachers</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li>
                    <a href="<?=base_url('teacher-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add teacher</button></a>
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
                                <th>ID</th>
                                <th>Name</th>
                                <th>Cell</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Joining Date</th>
                                <th>Classes</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count=1; foreach($teachers as $emp){
                                $id = urlencode(base64_encode($emp['id']));
                                ?>
                                <tr>
                                    <td><?=$count++;?><br><a href="#" onclick="get_teacher(<?=$emp['id']?>)"><i class="fa fa-key"></i> </a></td>
                                    <td><a href="<?php echo site_url('teacher-edit/'.$id); ?>"><?php echo $emp['employee_name']; ?></a></td>
                                    <td><?php echo $emp['phone']; ?></td>
                                    <td><?php echo $emp['email']; ?></td>
                                    <td><?php echo $emp['address']; ?></td>
                                    <td><?php echo $emp['date_joining']; ?></td>
                                    <td><?php echo $emp['classes']; ?></td>
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
<!-- The Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Teacher Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('teacher-password'); ?>
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
    function get_teacher(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('teacher/edit_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
                $('.select2').select2();
            }
        });
	}
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationYes").click(function(){
                        $.ajax({
                            url: "<?=site_url('teacher/remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Teacher deleted successfully.");
                                // $('#teachers').html(data);
                            }
                        });
                    });
                }
            });
    }
</script>
