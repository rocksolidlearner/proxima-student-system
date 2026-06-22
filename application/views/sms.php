<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Billing</h2>
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
                                    <th style="width: 5%">ID</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>City</th>
                                    <th>Postal Code</th>
                                    <th>Country</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                <?php foreach($customers as $c){
                                // $f_id = urlencode(base64_encode($f['id'])); 
                                ?>
                                <tr>
                                    <td><?=$c->id?></td>
                                    <td><?=$c->given_name?></td>
                                    <td><?=$c->email?></td>
                                    <td><?=$c->phone_number?></td>
                                    <td><?=$c->city?></td>
                                    <td><?=$c->postal_code?></td>
                                    <td><?=$c->country_code?></td>
                                    <td><?=date('M d, Y',strtotime($c->created_at))?></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="<?=base_url('billing/create')?>" title="Create New Customer"><i class="fa fa-check"></i></a>
                                        <a class="btn btn-info btn-sm" href="<?=base_url('billing/payment/100')?>" title="Payment"><i class="fa fa-money"></i></a>
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
    function confirmation(id)
    {
        toastr.error("<button type='button' id='confirmationRevertYes'  class='btn btn-success btn-sm' style='margin-left: 40px; margin-top: 20px'><i class='fa fa-check'></i> YES</button><button type='button' class='btn btn-danger btn-sm' style='margin-top: 20px'><i class='fa fa-close'></i> NO</button>",'Are you sure to delete record?',
            {
                closeButton: false,
                allowHtml: true,
                onShown: function (toast) {
                    $("#confirmationRevertYes").click(function(){
                        $.ajax({
                            url: "<?=site_url('forum/remove/');?>"+id,
                            success: function (data) {
                                toastr.success('success',"Forum deleted successfully.");
                                $("#result").html(data);
                            }
                        });
                    });
                }
            });
    }
</script>