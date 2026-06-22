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
                <h2>Parents/Guardians</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="http://www.cranbrookcollege.uk/guardians/" target="_blank"><button class="btn btn-sm btn-success"> Open Guardian Panel</button></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addModal"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Parent/Guardian</button></a>
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
                                    <th>#</th>
                                    <th>(ID) Email - Phone</th>
                                    <th>Students</th>
                                    <th style="width: 10%">Active</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($parents as $p){
                                    $pid = urlencode(base64_encode($p['id']));?>
                                <tr>
                                    <td><?=$i++;?><br><a href="#" onclick="get_parent(<?=$p['id']?>)"><i class="fa fa-key"></i> </a></td>
                                    <td>(<?=$p['id']?>) <a href="<?=base_url('parent-edit/'.$pid)?>"><?=$p['email']?></a><br><?=$p['phone']?>
                                    </td>
                                    <td><?=$p['stds']['total_stds']?></td>
                                    <td><?=$p['status']?></td>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Parent/Guardian</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('parents'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Phone Number</label>
                            <input type="text" name="phone" required autofocus="true" placeholder="Valid Phone Number" class="form-control" value="<?php echo $this->input->post('phone'); ?>" > 
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Email Address</label>
                            <input type="email" name="email" required placeholder="Email Address" class="form-control" value="<?php echo $this->input->post('email'); ?>" > 
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Password</label>
                            <input type="password" name="password" placeholder="Password" required class="form-control" value="<?php echo $this->input->post('password'); ?>"> 
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Confirm Password</label>
                            <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" value="<?php echo $this->input->post('cpassword'); ?>"> 
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Active</label>
                            <select class="form-control" name="status">
                                <?php $rel=array(
                                    'Yes' => 'Yes',
                                    'No' => 'No',
                                );
                                foreach($rel as $key => $r)
                                {
                                    $selected = ($r == $guardian['status']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$r.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Select Students</label>
                            <select multiple="multiple" size="10" name="students[]" class="form-control dual_listbox" style="height: 250px">
                                <?php foreach($students as $std){
                                    $selected = ($std['id'] == $this->input->post('students')) ? ' selected="selected"' : "";
                                    echo'<option value="'.$std['id'].'" '.$selected.'>'.$std['std_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
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
                <h4 class="modal-title">Parent/Guardian Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('parent-password'); ?>
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
    function get_parent(id) {
        $('#editModal').modal();
        $.ajax({
            url: "<?=base_url('parents/edit_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
            }
        });
    }
</script>