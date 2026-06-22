<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<style>
.iradio_flat-green{
    margin-left: 5px;
}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus"></i> New Project</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('project-add'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Project Name <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="project_name" class="form-control" value="<?php echo $this->input->post('project_name'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('project_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Project Type</label>
                            <div class="col-sm-9">
                                <select name="type" class="form-control">
                                    <?php $types=array(
                                        'Short Term' => SHORT_TERM,
                                        'Medium Term' => MEDIUM_TERM,
                                        'Long Term' => LONG_TERM,
                                        );
                                    foreach($types as $key => $t)
                                    {
                                        $selected = ($t == $this->input->post('type')) ? ' selected="selected"' : "";

                                        echo '<option value="'.$t.'" '.$selected.'>'.$key.'</option>';
                                    } ?>
                                </select>
                            </div>   
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Start Date</label>
                            <div class="col-sm-9">
                                <input type="text" name="start_date" id="date_picker" class="date_picker form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">End Date</label>
                            <div class="col-sm-9">
                                <input type="text" name="end_date" id="date_picker" class="date_picker form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Status</label>
                            <div class="col-sm-9">
                                <p style="margin-top: 8px">
                                    <?php $status=array(
                                        'Start' => START,
                                        'Pending' => PENDING,
                                        'Complete' => COMPLETE,
                                        );
                                    foreach($status as $key => $st)
                                    {
                                        $selected = ($st == $this->input->post('status')) ? ' selected="selected"' : "";

                                        echo '<input type="radio" class="flat" name="status" value="'.$st.'"/> '.$key;
                                    } ?>
                                </p>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label">Description</label>
                            <textarea name="description" rows="7" class="form-control" style="resize: none;" placeholder="Description..."><?php echo $this->input->post('description'); ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="ln_solid"></div>
                        <div class="item form-group text-right">
                            <div class="col-md-9 col-sm-9 offset-md-3">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    function get_img() {
        $('#prof_img').click();
    }
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

