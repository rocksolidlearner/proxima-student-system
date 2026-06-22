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
                <h2>Paid Fee</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <?php echo form_open('fee-paid'); ?>
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
                                    <th>Fee Title</th>
                                    <th>Fee</th>
                                    <th>Dates</th>
                                    <th>Receipt</th>
                                    <th style="width: 5%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($fee as $f){
                                $f_id = urlencode(base64_encode($f['id'])); ?>
                                <tr>
                                    <td>R.No: <?=$f['roll_no']?><br>
                                        <a href="<?=site_url('student-profile/'.$f_id)?>"><b><?=$f['std_name']?></b></a><br>
                                        Class: <I><a href="#"><?=$f['class_name'].'-'.$f['batch_name']?></a></I><br>
                                    </td>
                                    <td><b><?=$f['title']?></b><br>
                                        <?=$f['description']?>
                                    </td>
                                    <td>Amount: <?=$f['amount']?><br>
                                        Fine: <?=$f['fine']?>
                                    </td>
                                    <td><b>Due:</b> <?=date('d-M-Y',strtotime($f['due_date']))?><br>
                                        <b>Last:</b> <?=date('d-M-Y',strtotime($f['last_date']))?><br>
                                        <b>Paid at:</b> <?=date('d-M-Y',strtotime($f['paid_date']))?>
                                    </td>
                                    <td><?=$f['receipt']?></td>
                                    <td style="white-space: nowrap">
                                        <a class="btn btn-success btn-sm" href="<?=base_url('fee-printt/'.$f['id'])?>" title="Print" style="width: 100%"><i class="fa fa-print"></i> Print</a>
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
    
</script>