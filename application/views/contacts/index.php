<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
</script>
<style>
    .crm-stat {
        border-radius: 12px;
        padding: 18px 20px;
        color: #fff;
        margin-bottom: 20px;
        min-height: 110px;
    }
    .crm-stat h3,
    .crm-stat p {
        color: inherit;
        margin: 0;
    }
    .crm-stat .crm-count {
        font-size: 30px;
        font-weight: 700;
        margin-top: 10px;
    }
    .crm-actions .btn {
        margin-right: 4px;
        margin-bottom: 4px;
    }
    .label-soft {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }
    .label-soft-blue { background: #e8f1ff; color: #2f6fed; }
    .label-soft-green { background: #e8f8ef; color: #1e8e5a; }
    .label-soft-orange { background: #fff3e5; color: #c77700; }
    .label-soft-red { background: #fdeceb; color: #c53929; }
</style>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="crm-stat" style="background: linear-gradient(135deg, #2f6fed, #5d8df7);">
            <p>Total CRM Contacts</p>
            <div class="crm-count"><?=$crm_summary['total_contacts']?></div>
            <h3>All active contacts</h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="crm-stat" style="background: linear-gradient(135deg, #00a389, #28c3a6);">
            <p>New Leads</p>
            <div class="crm-count"><?=$crm_summary['new_leads']?></div>
            <h3>Fresh pipeline entries</h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="crm-stat" style="background: linear-gradient(135deg, #8c43ff, #b172ff);">
            <p>Customers</p>
            <div class="crm-count"><?=$crm_summary['customers']?></div>
            <h3>Converted contacts</h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="crm-stat" style="background: linear-gradient(135deg, #ff8b3d, #ffb067);">
            <p>Follow Ups Due</p>
            <div class="crm-count"><?=$crm_summary['follow_ups_due']?></div>
            <h3>Needs attention today</h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>CRM Call Log</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('contact-add')?>"><button class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add CRM Contact</button></a>
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
                                    <th>#</th>
                                    <th>Contact</th>
                                    <th>Company</th>
                                    <th>Channel</th>
                                    <th>Status</th>
                                    <th>Priority</th>
                                    <th>Follow Up</th>
                                    <th>Assigned</th>
                                    <th>Last Contact</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($results as $r){
                                    $id = urlencode(base64_encode($r['id']));?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td>
                                        <a href="<?=base_url('contact-edit/'.$id)?>"><strong><?=$r['contact_name'];?></strong></a><br>
                                        <small><?=$r['phone'] ? $r['phone'] : 'No phone'?></small><br>
                                        <small><?=$r['email'] ? $r['email'] : 'No email'?></small>
                                    </td>
                                    <td>
                                        <?=$r['company_name'] ? $r['company_name'] : '-'?><br>
                                        <small><?=$r['contact_role'] ? $r['contact_role'] : 'No role'?></small>
                                    </td>
                                    <td>
                                        <span class="label-soft label-soft-blue"><?=($r['preferred_channel'] ? $r['preferred_channel'] : 'Call')?></span><br>
                                        <small><?=($r['interaction_type'] ? $r['interaction_type'] : 'General')?></small>
                                    </td>
                                    <td><?php if($r['status'] == NEW_LEAD){ ?>
                                            <span class="label-soft label-soft-orange">New Lead</span>
                                        <?php }elseif($r['status'] == CUSTOMER){ ?>
                                            <span class="label-soft label-soft-green">Customer</span>
                                        <?php }else{ ?>
                                            <span class="label-soft label-soft-blue">Open</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $priority = $r['priority'] ? $r['priority'] : 'Medium'; ?>
                                        <span class="label-soft <?=$priority == 'High' ? 'label-soft-red' : ($priority == 'Low' ? 'label-soft-blue' : 'label-soft-orange')?>"><?=$priority?></span>
                                    </td>
                                    <td><?=($r['follow_up_date'] ? $r['follow_up_date'] : '-')?></td>
                                    <td><?=($r['assigned_user_name'] ? $r['assigned_user_name'] : '-')?></td>
                                    <td>
                                        <?=($r['last_contacted_at'] ? $r['last_contacted_at'] : '-')?><br>
                                        <small><?=($r['last_contact_method'] ? $r['last_contact_method'] : 'No activity yet')?></small>
                                    </td>
                                    <td class="crm-actions">
                                        <?php if(!empty($r['phone'])){ ?>
                                            <a href="tel:<?=$r['phone']?>" class="btn btn-xs btn-default" title="Call"><i class="fa fa-phone"></i></a>
                                            <button type="button" class="btn btn-xs btn-success" data-toggle="modal" data-target="#smsModal<?=$r['id']?>" title="Send SMS"><i class="fa fa-comment"></i></button>
                                        <?php } ?>
                                        <?php if(!empty($r['email'])){ ?>
                                            <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#emailModal<?=$r['id']?>" title="Send Email"><i class="fa fa-envelope"></i></button>
                                        <?php } ?>
                                        <a href="<?=base_url('contact-edit/'.$id)?>" class="btn btn-xs btn-info" title="Edit"><i class="fa fa-pencil"></i></a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="smsModal<?=$r['id']?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Send SMS to <?=$r['contact_name']?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <?=form_open('contact-send-sms')?>
                                                    <input type="hidden" name="contact_id" value="<?=$r['id']?>">
                                                    <input type="hidden" name="phone_number" value="<?=$r['phone']?>">
                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="text" class="form-control" value="<?=$r['phone']?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea name="message" rows="4" class="form-control" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Send SMS</button>
                                                <?=form_close()?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="emailModal<?=$r['id']?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Send Email to <?=$r['contact_name']?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <?=form_open('contact-send-email')?>
                                                    <input type="hidden" name="contact_id" value="<?=$r['id']?>">
                                                    <input type="hidden" name="receiver_email" value="<?=$r['email']?>">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control" value="<?=$r['email']?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Subject</label>
                                                        <input type="text" name="subject" class="form-control" value="Follow up from Proxima Global">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Message</label>
                                                        <textarea name="message" rows="5" class="form-control" required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-danger"><i class="fa fa-send"></i> Send Email</button>
                                                <?=form_close()?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
