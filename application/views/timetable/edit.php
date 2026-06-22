<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Edit Subject</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $s_id = urlencode(base64_encode($subject['id']));
                 echo form_open_multipart('subject/edit/'.$s_id); ?>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Name</label>
                    <div class="col-md-5 col-sm-5">
                        <div class="input-group">
                            <input type="text" name="subject_name" value="<?php echo ($this->input->post('subject_name') ? $this->input->post('subject_name') : $subject['subject_name']); ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('subject_name');?></span>
                        </div>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Short Name</label>
                    <div class="col-md-5 col-sm-5">
                        <div class="input-group">
                            <input type="text" name="short_name" value="<?php echo ($this->input->post('short_name') ? $this->input->post('short_name') : $subject['short_name']); ?>" class="form-control">
                            <span class="text-danger"><?php echo form_error('short_name');?></span>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group text-right">
                    <div class="col-md-5 col-sm-5 offset-md-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

