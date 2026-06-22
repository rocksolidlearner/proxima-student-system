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
                                    <th>Salary Month</th>
                                    <th>Salary</th>
                                    <th>Desuction</th>
                                    <th>Teacher</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($results as $r){ ?>
                                <tr>
                                    <td><?=$r['id']?></td>
                                    <td><?=$r['salary_month']?></td>
                                    <td><?=$r['salary']?></td>
                                    <td><?=$r['deduction']?></td>
                                    <td><?=$r['employee_name']?></td>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-success btn-sm" href="#" onclick="pay_salary(<?=$r['id']?>)" title="Pay Salary"><i class="fa fa-money"></i></a>
                                        <a class="btn btn-info btn-sm" href="#" onclick="edit_record(<?=$r['id']?>)" title="Deduction"><i class="fa fa-angle-double-down"></i></a>
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
                <h4 class="modal-title">Pay Salary</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('account-teacher-salary'); ?>
            <!-- Modal body -->
            <div class="modal-body" id="edit_data"></div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Set Deduction</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                <h4 class="modal-title">Pay Salary</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('account-teacher-salary'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="id" id="salary_id">
                <p>Are you sure you want to pay salary now?<br>
                This action is not reversable.</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" name="pay" class="btn btn-info btn-sm">Pay Salary</button>
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
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
            url: "<?=base_url('account/edit_salary/')?>"+id,
            success: function (data) {
                console.log('success');
                $('#edit_data').html(data);
            }
        });
    }
    function pay_salary(id) {
		$('#payModal').modal();
		$('#salary_id').val(id);
	}
</script>