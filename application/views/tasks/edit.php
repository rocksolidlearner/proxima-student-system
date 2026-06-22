<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> 
<script type="text/javascript">
    bkLib.onDomLoaded(function () {
        nicEditors.allTextAreas()
    });
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Edit Task </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $c_id = urlencode(base64_encode($task['id']));
                 echo form_open_multipart('task-edit/'.$c_id); ?>
                <div class="col-md-6 col-sm-12">
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-2 label-align">Title <span class="required">*</span></label>
                        <div class="col-md-10 col-sm-8">
                            <div class="input-group">
                                <input type="text" name="title" value="<?php echo ($this->input->post('title') ? $this->input->post('title') : $task['title']); ?>" class="form-control">
                                <span class="text-danger"><?php echo form_error('title');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-3 label-align">Description</label>
                        <div class="col-md-10 col-sm-9">
                            <div class="input-group">
                                <textarea name="description" rows="14" class="form-control" style="resize: none;" placeholder="Description..."><?php echo ($this->input->post('description') ? $this->input->post('description') : $task['description']); ?></textarea>
                                <span class="text-danger"><?php echo form_error('description');?></span>
                            </div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-3 label-align">Due Date <span class="required">*</span>
                        </label>
                        <div class="col-md-10 col-sm-9">
                            <input  name="due_date" value="<?=$task['due_date'];?>" id="date_picker" class="date_picker form-control" type="text">
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
                                $selected = '';
                                if($s['role'] == STAFF){
                                    foreach($task['staffs'] as $ts){
                                        if($s['id'] == $ts['staff_id']){
                                            $selected="selected";
                                        }
                                    }
                                echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['name'].'</option>';
                                }   
                            }?>
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
                                $selected = '';
                                foreach($task['clients'] as $tc){
                                    if($c['id'] == $tc['client_id']){
                                        $selected="selected";
                                    }
                                }
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

