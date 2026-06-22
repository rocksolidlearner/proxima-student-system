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
                <h2>Assign Book</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('library-books')?>"><button class="btn btn-sm btn-success"><i class="fa fa-list"></i> Manage Library</button></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addModal" ><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Assign Book</button></a>
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
                                    <th>Student</th>
                                    <th>Book</th>
                                    <th>Street No.</th>
                                    <th>City, State Country</th>
                                    <th>Postal Code</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($assign_books as $b){?>
                                <tr>
                                    <td><?=$b['std_name'];?></td>
                                    <td><?=$b['book_name']?></td>
                                    <td><?=$b['street']?></td>
                                    <td><?=$b['city'].', '.$b['state'].' '.$b['country']?></td>
                                    <td><?=$b['post_code']?></td>
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
                <h4 class="modal-title">Assign Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('library-assign-books'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label>Select Student</label>
                    <select name="student_id" class="form-control select2" style="width: 100%" required>
                        <option value="">Select Student</option>
                        <?php foreach($students as $std){
                            echo'<option value="'.$std['id'].'">'.$std['std_name'].'</option>';
                        }?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Book</label>
                    <select name="book_id" class="form-control select2" style="width: 100%" required>
                        <option value="">Select Book</option>
                        <?php foreach($books as $b){
                            echo'<option value="'.$b['id'].'">'.$b['book_name'].'</option>';
                        }?>
                    </select>
                </div>
                <h4>Address</h4>
                <hr>
                <div class="form-group">
                    <label class="col-form-label label-align">Street</label>
                    <input type="text" name="street" class="form-control" required value="<?php echo $this->input->post('street'); ?>" >
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">City</label>
                            <input type="text" name="city" class="form-control" required value="<?php echo $this->input->post('city'); ?>" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Post Code</label>
                            <input type="number" maxlength="5" name="post_code" class="form-control" required value="<?php echo $this->input->post('post_code'); ?>" >
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">State</label>
                            <input type="text" name="state" class="form-control" required value="<?php echo $this->input->post('state'); ?>" >
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Country</label>
                            <input type="text" name="country" class="form-control" required value="<?php echo $this->input->post('country'); ?>" >
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