<script type="text/javascript">
    <?php if($this->session->flashdata('success')){  ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    <?php } ?>
    <?php if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Projects</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('project-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Project</button></a>
                    </li>
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Short Term Project</h2>
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($projects as $p){
                                    $id = urlencode(base64_encode($p['id']));
                                    if($p['type']==SHORT_TERM){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><a href="<?=base_url('project-edit/'.$id)?>"><?=$p['project_name'];?></a></td>
                                    <td><?php switch($p['status']){
                                            case START:
                                                echo'Start';
                                                break;
                                            case PENDING:
                                                echo'Pending';
                                                break;
                                            case COMPLETE:
                                                echo'Complete';
                                                break;
                                        }?></td>
                                </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h2>Medium Term Project</h2>
                        <div class="card-box table-responsive">
                            <table id="datatable2" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($projects as $p){
                                    $id = urlencode(base64_encode($p['id']));
                                    if($p['type']==MEDIUM_TERM){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><a href="<?=base_url('project-edit/'.$id)?>"><?=$p['project_name'];?></a></td>
                                    <td><?php switch($p['status']){
                                            case START:
                                                echo'Start';
                                                break;
                                            case PENDING:
                                                echo'Pending';
                                                break;
                                            case COMPLETE:
                                                echo'Complete';
                                                break;
                                        }?></td>
                                </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h2>Long Term Project</h2>
                        <div class="card-box table-responsive">
                            <table id="datatable3" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($projects as $p){
                                    $id = urlencode(base64_encode($p['id']));
                                    if($p['type']==LONG_TERM){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><a href="<?=base_url('project-edit/'.$id)?>"><?=$p['project_name'];?></a></td>
                                    <td><?php switch($p['status']){
                                            case START:
                                                echo'Start';
                                                break;
                                            case PENDING:
                                                echo'Pending';
                                                break;
                                            case COMPLETE:
                                                echo'Complete';
                                                break;
                                        }?></td>
                                </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#more').click(function(){
            $('#newdep').html('');
            $('#newdep').append('<input type="text" name="department_name" autofocus="true" placeholder="New Department Name" class="form-control">');
        });
        $('#more1').click(function(){
            $('#newdep1').html('');
            $('#newdep1').append('<input type="text" name="department_name" autofocus="true" placeholder="New Department Name" class="form-control">');
        })
    });
</script>