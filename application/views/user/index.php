<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Users Manage</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li >
                        <a href="<?=base_url('user-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add</button></a>
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
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Last Login</th>
                                    <th>Is Admin</th>
                                    <th>Active</th>
                                    <th style="width: 10%">Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($users as $t){
                                    $u_id = urlencode(base64_encode($t['id'])); 
                                    $date_1 = "2007-03-24";
                                    $date_2 = date('Y-m-d');
                                    $datetime1 = date_create($date_1);
                                    $datetime2 = date_create($date_2);
                                
                                    $interval = date_diff($datetime1, $datetime2);
                                    ?>
                                    <tr>
                                        <td><?php echo $t['id']; ?></td>
                                        <td><a href="<?php echo site_url('user-edit/'.$u_id); ?>" class="text-primary"><?=$t['username']; ?></a></td>
                                        <td><?php echo $t['name']; ?></td>
                                        <td><?php echo $t['email']; ?></td>
                                        <td><?=$interval->format('%d Day %h Hours %i Minute %s Seconds');?></td>
                                        <td><?=$t['is_admin']?></td>
                                        <td><?=$t['status']?></td>
                                        <td>
                                            <?php if ($t['role'] != SUPERADMIN) {?>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmation(<?=$t['id']?>)" title="Delete"><i class="fa fa-trash"></i></a>
                                        <?php } ?>
                                        </td>
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
                            url: "<?=site_url('user-remove/');?>"+id,
                            success: function (data) {
                                toastr.info('info',"User deleted successfully.");
//                                location.reload();
                            }
                        });
                    });
                }
            });
    }
</script>