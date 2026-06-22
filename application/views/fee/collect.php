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
                <h2>Collect Fee</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php echo form_open('fee-collect'); ?>
                    <li>
                        <button type="submit" name="download" class="btn btn-sm btn-info"><i class="fa fa-download"></i> Download PDF</button>
                    </li>
                    <?php echo form_close(); ?>
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
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Fine</th>
                                    <th>Due Date</th>
                                    <th>Last Date</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($fee as $f){
                                $f_id = urlencode(base64_encode($f['id'])); ?>
                                <tr>
                                    <td>R.No: <?=$f['roll_no']?><br>
                                        <a href="<?=site_url('student-profile/'.$f_id)?>"><b><?=$f['std_name']?></b></a><br>
                                        Class: <a href="#"><?=$f['class_name'].'-'.$f['batch_name']?></a><br>
                                    </td>
                                    <td><b><?=$f['title']?></b><br>
                                        <?=$f['description']?>
                                    </td>
                                    <td><?=$f['amount']?></td>
                                    <td><?=$f['fine']?></td>
                                    <td><?=date('d-M-Y',strtotime($f['due_date']))?></td>
                                    <td><?=date('d-M-Y',strtotime($f['last_date']))?></td>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-success btn-sm" href="#" onclick="pay_fee(<?=$f['id']?>)" title="Pay" style="width: 100%"><i class="fa fa-check"></i> Pay</a><br>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="confirmation(<?=$f['id']?>)" title="Delete" style="width: 100%"><i class="fa fa-trash"></i> Delete</a><br>
                                        <a class="btn btn-info btn-sm" href="#" onclick="edit_fee(<?=$f['id']?>)" title="Edit" style="width: 100%"><i class="fa fa-pencil"></i> Edit</a><br>
                                        <a class="btn btn-success btn-sm" href="<?=base_url('fee-print/'.$f['id'])?>" title="Print" style="width: 100%"><i class="fa fa-print"></i> Print</a>
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
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Fee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('fee-edit'); ?>
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
<div class="modal fade" id="payModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pay Fee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('fee-edit'); ?>
            <!-- Modal body -->
            <div class="modal-body" id="pay_data"></div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" name="print" class="btn btn-success btn-sm">Print</button>
                <button type="submit" name="pay" class="btn btn-info btn-sm">Pay</button>
                <button type="submit" name="pay_print" class="btn btn-success btn-sm">Pay & Print</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
<script>
    function edit_fee(id) {
		$('#editModal').modal();
		$.ajax({
            url: "<?=base_url('fee/edit_model/')?>"+id+"/<?=COLLECT?>",
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
            }
        });
    }
    function pay_fee(id) {
		$('#payModal').modal();
		$.ajax({
            url: "<?=base_url('fee/pay_model/')?>"+id+"/<?=COLLECT?>",
            success: function (data) {
                console.log('success');
                $('#pay_data').html(data);
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
                        url: "<?=site_url('fee-remove/');?>"+id,
                        success: function (response) {
                            toastr.success('success',response);
                        }
                    });
                });
            }
        });
    }
</script>