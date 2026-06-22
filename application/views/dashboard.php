<script>
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
</script>
<style>
    .dash-card {
        border-radius: 14px;
        padding: 20px;
        color: #fff;
        min-height: 120px;
        margin-bottom: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }
    .dash-card h4,
    .dash-card p,
    .dash-card a {
        color: inherit;
    }
    .dash-card .count {
        font-size: 30px;
        font-weight: 700;
        margin: 8px 0;
    }
    .dash-quick a {
        margin: 0 8px 8px 0;
    }
    .mini-stat {
        background: #fff;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }
    .mini-stat h3 {
        margin: 8px 0 0;
    }
</style>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <h2>Dashboard</h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dash-card" style="background: linear-gradient(135deg, #2f6fed, #5d8df7);">
            <p>Total Students</p>
            <div class="count"><?=$tot_stds?></div>
            <a href="<?=base_url('student')?>">Open student list</a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dash-card" style="background: linear-gradient(135deg, #00a389, #28c3a6);">
            <p>Revenue</p>
            <div class="count"><?=$this->data['setting']['currency_symbol'].' '.number_format($fee['total_fee'],2)?></div>
            <a href="<?=base_url('fee-defaulters')?>"><?=date('F Y')?></a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dash-card" style="background: linear-gradient(135deg, #ff8b3d, #ffb067);">
            <p>Expenses</p>
            <div class="count"><?=$this->data['setting']['currency_symbol'].' '.number_format($expense['total_expenses'],2)?></div>
            <a href="<?=base_url('account')?>">Open accounts</a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dash-card" style="background: linear-gradient(135deg, #8c43ff, #b172ff);">
            <p>Profit</p>
            <div class="count"><?=$this->data['setting']['currency_symbol'].' '.$profit?></div>
            <a href="<?=base_url('dashboard')?>">Live summary</a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>CRM Contacts</p>
            <h3><?=$crm_summary['total_contacts']?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>New Leads</p>
            <h3><?=$crm_summary['new_leads']?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>Customers</p>
            <h3><?=$crm_summary['customers']?></h3>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>Follow Ups Due</p>
            <h3><?=$crm_summary['follow_ups_due']?></h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>ePortfolio Entries</p>
            <h3><?=$portfolio_summary_global['total_entries']?></h3>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>Students With Entries</p>
            <h3><?=$portfolio_summary_global['students_covered']?></h3>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="mini-stat">
            <p>Portfolio Files</p>
            <h3><?=$portfolio_summary_global['files_uploaded']?></h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-bolt"></i> Quick Actions</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content dash-quick">
                <a href="<?=base_url('admission')?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Student</a>
                <a href="<?=base_url('contact-add')?>" class="btn btn-info"><i class="fa fa-phone"></i> Add CRM Contact</a>
                <a href="<?=base_url('call-log')?>" class="btn btn-default"><i class="fa fa-address-book"></i> Open Call Log</a>
                <a href="<?=base_url('sms-setting')?>" class="btn btn-success"><i class="fa fa-comment"></i> SMS Settings</a>
                <a href="<?=base_url('attendance-register')?>" class="btn btn-warning"><i class="fa fa-check-square-o"></i> Attendance</a>
            </div>
        </div>
    </div>
    <div class="col-md-7 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-address-book"></i> Recent CRM Activity</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Follow Up</th>
                                <th>Assigned</th>
                                <th>Last Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_contacts)){ foreach($recent_contacts as $contact){ ?>
                                <tr>
                                    <td>
                                        <strong><?=$contact['contact_name']?></strong><br>
                                        <small><?=$contact['company_name'] ? $contact['company_name'] : '-'?></small>
                                    </td>
                                    <td><?=$contact['status'] == NEW_LEAD ? 'New Lead' : ($contact['status'] == CUSTOMER ? 'Customer' : 'Open')?></td>
                                    <td><?=$contact['follow_up_date'] ? $contact['follow_up_date'] : '-'?></td>
                                    <td><?=$contact['assigned_user_name'] ? $contact['assigned_user_name'] : '-'?></td>
                                    <td><?=$contact['last_contact_method'] ? $contact['last_contact_method'] : 'No activity yet'?></td>
                                </tr>
                            <?php }}else{ ?>
                                <tr>
                                    <td colspan="5" class="text-center">No CRM contacts yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-folder-open"></i> Recent ePortfolio Activity</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Entry</th>
                                <th>Category</th>
                                <th>Evidence</th>
                                <th>Date</th>
                                <th>Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_portfolio_entries)){ foreach($recent_portfolio_entries as $entry){ ?>
                                <tr>
                                    <td>
                                        <strong><?=$entry['std_name'] ? $entry['std_name'] : 'Student'?></strong><br>
                                        <small><?=$entry['admission_no'] ? $entry['admission_no'] : '-'?></small>
                                    </td>
                                    <td>
                                        <?=$entry['title']?><br>
                                        <small><?=$entry['grade'] ? 'Outcome: '.$entry['grade'] : '-'?></small>
                                    </td>
                                    <td><?=$entry['category'] ? $entry['category'] : '-'?></td>
                                    <td><?=$entry['evidence_type'] ? $entry['evidence_type'] : '-'?></td>
                                    <td><?=$entry['entry_date'] ? date('d-M-Y', strtotime($entry['entry_date'])) : '-'?></td>
                                    <td><?=$entry['created_by_name'] ? $entry['created_by_name'] : '-'?></td>
                                </tr>
                            <?php }}else{ ?>
                                <tr>
                                    <td colspan="6" class="text-center">No ePortfolio activity yet.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
