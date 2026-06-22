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
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus"></i> New Course Material</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('course-add'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="item form-group">
                            <label class="col-form-label col-md-2 col-sm-3 label-align">Name <span class="required">*</span></label>
                            <div class="col-md-10 col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="course_name" class="form-control" value="<?php echo $this->input->post('course_name'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('course_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-2 col-sm-3 label-align">Description</label>
                            <div class="col-md-10 col-sm-9">
                                <div class="input-group">
                                    <textarea name="description" rows="14" class="form-control" style="resize: none;" placeholder="Description..."><?php echo $this->input->post('description'); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-2 col-sm-3 label-align">File</label>
                            <div class="col-md-10 col-sm-9">
                                <input name="userfile[]" id="file_name" class="form-control"  type="file" multiple="multiple">
                            </div>
                        </div>
                    </div>
                <!-- </div>
                <div class="row"> -->
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Select Class</label>
                            <select multiple="multiple" size="10" name="classes[]" class="form-control dual_listbox" style="height: 150px">
                                <?php
                                foreach($classes as $c)
                                {
                                    $selected = ($c['id'] == $this->input->post('classes')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['class_name'].'</option>';
                                } ?>
                            </select>   
                        </div>
                    <!-- </div>
                    <div class="col-md-6 col-sm-12"> -->
                        <div class="form-group">
                            <label class="col-form-label label-align">Select Subject</label>
                            <select multiple="multiple" size="10" name="subjects[]" class="form-control dual_listbox" style="height: 150px">
                                <?php
                                foreach($subjects as $s)
                                {
                                    $selected = ($s['id'] == $this->input->post('subjects')) ? ' selected="selected"' : "";

                                    echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
                                } ?>
                            </select>   
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

