<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<style>
.panel_toolbox > li > a{
    padding: 0 !important;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Students</h2>
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
                            <table id="export" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Admission_number</th>
                                    <th>Class</th>
                                    <th>roll</th>
                                    <th>fee</th>
                                    <th>admission_date</th>
                                    <th>name</th>
                                    <th>father_name</th>
                                    <th>dob</th>
                                    <th>gender</th>
                                    <th>guardian_name</th>
                                    <th>guardian_relation</th>
                                    <th>cell</th>
                                    <th>guardian_cell</th>
                                    <th>active</th>
                                </tr>
                                </thead>
                                <tbody id="students">
                                <?php $fee=0; foreach($students as $s){
                                    $s_id = urlencode(base64_encode($s['id']));
                                    $fee += $s['tution_fee']+$s['monthly_fee']+$s['admission_fee']+
                                    $s['annual_fund']+$s['test_fee']+$s['practical_charges'];
                                 ?>
                                    <tr>
                                        <td><?=$s['admission_no']; ?></td>
                                        <td><?=$s['class_name']; ?></td>
                                        <td><?=$s['roll_no']; ?></td>
                                        <td><?=$fee; ?></td>
                                        <td><?=$s['admission_date']; ?></td>
                                        <td><?=$s['std_name']; ?></td>
                                        <td><?=$s['father_name']; ?></td>
                                        <td><?=$s['dob']; ?></td>
                                        <td><?php if($s['gender']==MALE){echo'M';}else{echo'F';} ?></td>
                                        <td><?=$s['guardian_name']; ?></td>
                                        <td><?=$s['relation']?></td>
                                        <td><?=$s['phone']; ?></td>
                                        <td><?=$s['gphone']; ?></td>
                                        <td><?=$s['status']; ?></td>
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
