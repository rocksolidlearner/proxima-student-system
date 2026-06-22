<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Library Books</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('library-assign-books')?>"><button class="btn btn-sm btn-success"><i class="fa fa-book"></i> Assign Books</button></a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addModal" ><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Book</button></a>
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
                                    <th>Book Name</th>
                                    <th>Department</th>
                                    <th>Qty</th>
                                    <th>Assigned</th>
                                    <th>Availabe Qty</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($books as $b){?>
                                <tr>
                                    <td><a href="#" onclick="get_book(<?=$b['id']?>)"><?=$b['book_name'];?></a></td>
                                    <td><?=$b['department_name']?></td>
                                    <td><?=$b['book_qty']?></td>
                                    <td>0</td>
                                    <td><?=$b['available_qty']?></td>
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
                <h4 class="modal-title">Save Book</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('library-books'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label label-align">Book Name</label>
                    <input type="text" name="book_name" autofocus="true" placeholder="Type Book Name" class="form-control" required value="<?php echo $this->input->post('book_name'); ?>" >
                    <span class="text-danger"><?php echo form_error('book_name');?></span>    
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-10">
                            <label class="col-form-label label-align">Deparment</label>
                            <select class="form-control select2" name="department_id" style="width: 100%">
                                <option value="">Select Department</option>
                                <?php
                                foreach($departments as $d)
                                {
                                    $selected = ($d['id'] == $this->input->post('department_id')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$d['id'].'" '.$selected.'>'.$d['department_name'].'</option>';
                                } ?>
                            </select>
                            <div id="newdep" style="margin-top: 5px"></div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" id="more" style="border-radius: 50%;border: 1px solid lightgray;margin-top: 30px"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Book Quantity</label>
                    <input type="number" required name="book_qty" class="form-control" value="1">    
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
            <?php echo form_open('book-edit'); ?>
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
	function get_book(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('library/edit_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
                $('.select2').select2();
            }
        });
	}
    $(function(){
        $('#more').click(function(){
            $('#newdep').html('');
            $('#newdep').append('<input type="text" name="department_name" autofocus="true" placeholder="New Department Name" class="form-control">');
        });
        $('#more1').click(function(){
            $('#newdep1').html('');
            $('#newdep1').append('<input type="text" name="department_name" autofocus="true" placeholder="New Department Name" class="form-control">');
        })
    });
</script>