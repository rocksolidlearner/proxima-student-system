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
                <h2>View Transactions</h2>
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
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount In</th>
                                    <th>Amount Out</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($transections as $e){?>
                                <tr>
                                    <td><?=$e['id']?></td>
                                    <?php if($e['expense_id']){
                                    echo '<td>'.$e['expense_date'].'</td>
                                    <td>'.$e['detail'].'</td>
                                    <td>0.00</td>
                                    <td>'.$e['expense_amount'].'</td>';
                                    }elseif($e['salary_id']){
                                        $r = $e['salary']-$e['deduction'];
                                        echo '<td>'.$e['paid_salary'].'</td>
                                        <td>Salary: '.date('F ,Y',strtotime($e['salary_month'])).'</td>
                                        <td>0.00</td>
                                        <td>'.$r.'</td>';
                                    }elseif($e['fee_id']){
                                        echo '<td>'.$e['paid_date'].'</td>
                                        <td>'.$e['title'].', Student Fee, Paid Fee ID: '.$e['fee_id'].', Receipt #: '.$e['receipt'].'</td>
                                        <td>'.$e['fee_amount'].'</td>
                                        <td>0.00</td>';
                                    }?>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-danger btn-sm" href="#" onclick="get_record_id(<?=$e['id']?>)" title="Delete Transection"><i class="fa fa-trash"></i> Delete</a>
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
                <h4 class="modal-title">Transection</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('accounts-transactions'); ?>
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="id" id="transection_id">
                <p>Are you sure you want to delete this transaction?</p>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Yes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<!-- //End Modal -->
<script>
    function get_record_id(id) {
		$('#editModal').modal();
		$('#transection_id').val(id);
    }
</script>