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
                <h2>Course</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a href="<?=base_url('course-add')?>"><button class="btn btn-sm btn-info"><i class="fa fa-plus"></i> Add Course</button></a>
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
                                    <th>Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i=1; foreach($courses as $c){
                                    $id = urlencode(base64_encode($c['id']));?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><a href="<?=base_url('course-edit/'.$id)?>"><?=$c['course_name'];?></a></td>
                                </tr>
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