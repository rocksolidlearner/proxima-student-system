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
                <h2>Fine Management</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#addModal" ><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Fine</button></a>
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
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Implementation</th>
                                    <th style="width: 10%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($results as $r){?>
                                <tr>
                                    <td><?=$i++;?></td>
                                    <td><a href="#" onclick="get_fine(<?=$r['id']?>)"><?=$r['fine_name']?></a></td>
                                    <td><?=$r['fine_amount'];?></td>
                                    <td><?php switch($r['fine_implement']){ 
                                        case DAILY: echo'Daily Apply';break;
                                        case ONCE: echo'Once';break;
                                        }?></td>
                                    <td><a href="<?=base_url('fine-remove/'.$r['id'])?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
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
                <h4 class="modal-title">Add Fine</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('fine'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label label-align">Fine Name</label>
                    <input type="text" name="fine_name" required autofocus="true" placeholder="Fine Name" class="form-control" value="<?php echo $this->input->post('fine_name'); ?>" >
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Amount</label>
                    <input type="text" name="fine_amount" required placeholder="Amount" class="form-control" value="<?php echo $this->input->post('fine_amount'); ?>" >
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Amount Type</label>
                    <select class="form-control" name="amount_type">
                        <?php $types = array(
                            'Percentage %' => PERCENTAGE,
                            'Amount - Fix' => FIX
                        );
                        foreach($types as $key => $v)
                        {
                            $selected = ($v == $this->input->post('amount_type')) ? ' selected="selected"' : "";

                            echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Fine Implementation</label>
                    <select class="form-control" name="fine_implement">
                        <?php $fines = array(
                            'Daily Apply' => DAILY,
                            'Once' => ONCE
                        );
                        foreach($fines as $key => $v)
                        {
                            $selected = ($v == $this->input->post('fine_implement')) ? ' selected="selected"' : "";

                            echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                        } ?>
                    </select>
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
                <h4 class="modal-title">Edit Fine</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('fine-edit'); ?>
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
	function get_fine(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('setting/edit_fine_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
            }
        });
	}
</script>