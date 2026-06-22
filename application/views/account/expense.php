<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
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
                <h2>Manage Daily Expenses</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a data-toggle="modal" data-target="#addModal" href="#"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Expense</button></a>
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
                                    <th>Date</th>
                                    <th>Head</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($expenses as $e){?>
                                <tr>
                                    <td><?=$e['id']?></td>
                                    <td><?=$e['expense_date']?></td>
                                    <td><?=$e['account_head_id']?></td>
                                    <td><?=$e['detail']?></td>
                                    <td><?=$e['amount']?></td>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-danger btn-sm" href="#" onclick="confirmation(<?=$e['id']?>)" title="Delete"><i class="fa fa-trash"></i></a>
                                        <a class="btn btn-info btn-sm" href="#" onclick="edit_record(<?=$e['id']?>)" title="Edit"><i class="fa fa-pencil"></i></a>
                                    </td>
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
</div>
<!-- The Modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('account-daily-expenses'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-form-label label-align">Select Head</label>
                    <select class="form-control select2" name="account_head_id" style="width: 100%">
                        <?php foreach($heads as $h)
                        {
                            $selected = ($h['id'] == $this->input->post('account_head_id')) ? ' selected="selected"' : "";

                            echo '<option value="'.$h['id'].'" '.$selected.'>'.$h['account_head'].'</option>';
                        } ?>
                    </select>
                    <span class="text-danger"><?php echo form_error('account_head_id');?></span>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Expense Detail <span class="required">*</span></label>
                    <input type="text" name="detail" class="form-control" value="<?php echo $this->input->post('detail'); ?>" >
                    <span class="text-danger"><?php echo form_error('detail');?></span>    
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Amount</label>
                    <input type="number" name="amount" step=".01" autofocus="true" class="form-control" value="'.$fee['amount'].'" >  
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Expense Date</label>
                    <input type="text" name="expense_date" id="date_picker" class="date_picker form-control" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Receipt Number (If Any):</label>
                    <input type="text" name="receipt" class="form-control"> 
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Expense</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('expense-edit'); ?>
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
    function edit_record(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('account/edit_model/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
                $('.date_picker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            }
        });
    }
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationRevertYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
        {
            closeButton: false,
            allowHtml: true,
            onShown: function (toast) {
                $("#confirmationRevertYes").click(function(){
                    $.ajax({
                        url: "<?=site_url('account/remove/');?>"+id,
                        success: function (response) {
                            toastr.success('success','Expense deleted successfully.');
                            $('#result').html(response);
                        }
                    });
                });
            }
        });
    }
</script>