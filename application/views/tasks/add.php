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
                <h2><i class="fa fa-plus"></i> New Task</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="padding-top: 10px">
                <?php echo form_open('task-add'); ?>
                <div class="col-md-6 col-sm-12">
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-3 label-align">Title <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-9">
                            <div class="input-group">
                                <input type="text" name="title" class="form-control" value="<?php echo $this->input->post('title'); ?>" >
                                <span class="text-danger"><?php echo form_error('title');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-3 label-align">Description</label>
                        <div class="col-md-10 col-sm-9">
                            <div class="input-group">
                                <textarea name="description" rows="14" class="form-control" style="resize: none;"><?php echo $this->input->post('description'); ?></textarea>
                                <span class="text-danger"><?php echo form_error('description');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-3 label-align">Due Date <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-9">
                            <input  name="due_date" value="<?php echo $this->input->post('due_date'); ?>" id="date_picker" class="date_picker form-control" type="text">
                            <span class="text-danger"><?php echo form_error('due_date');?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h6>Select Staffs</h6>
                    <div class="item form-group">
                        <select multiple="multiple" size="10" name="staffs[]" class="form-control dual_listbox" style="height: 150px">
                            <?php
                            foreach($staffs as $s)
                            {
                                if($s['role'] == STAFF){
                                $selected = ($s['id'] == $this->input->post('staffs')) ? ' selected="selected"' : "";

                                echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['name'].'</option>';
                            }}?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h6>Select Clients</h6>
                    <div class="item form-group">
                        <select multiple="multiple" size="10" name="clients[]" class="form-control dual_listbox" style="height: 150px">
                            <?php
                            foreach($clients as $c)
                            {
                                $selected = ($c['id'] == $this->input->post('clients')) ? ' selected="selected"' : "";

                                echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['name'].'</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-12 col-sm-12 text-right">
                            <button hidden class="btn btn-primary" type="reset"><i class="fa fa-times-circle"></i> Reset</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

