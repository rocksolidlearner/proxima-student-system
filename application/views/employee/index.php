<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<!-- <div class="row"> -->
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>All Employees</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('employee-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Employee</button></a>
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
                                    <th>Joining Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count=1; foreach($employees as $emp){
                                    $id = urlencode(base64_encode($emp['id']));
                                 ?>
                                    <tr>
                                        <td><?=$count++;?></td>
                                        <td><a href="<?php echo site_url('employee-edit/'.$id); ?>"><?php echo $emp['employee_name']; ?></a></td>
                                        <td><?php echo $emp['phone']; ?></td>
                                        <td><?php echo $emp['date_joining']; ?></td>
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
<!-- </div> -->
<script>
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
