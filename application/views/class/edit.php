<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Upload File </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $c_id = urlencode(base64_encode($class['id']));
                 echo form_open_multipart('class-edit/'.$c_id); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group">
                            <label class="col-form-label label-align">Type Of Class <span class="required">*</span></label>
                            <input type="text" name="class_name" placeholder="Class Name" class="form-control" value="<?=($this->input->post('class_name') ? $this->input->post('class_name') : $class['class_name']);?>" >
                            <span class="text-danger"><?php echo form_error('class_name');?></span>    
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Select Batch</label>
                            <select class="form-control select2" name="batch_id" style="width: 100%">
                                <option value="">Select Batch</option>
                                <?php
                                foreach($batches as $b)
                                {
                                    $selected = ($b['id'] == $class['batch_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$b['id'].'" '.$selected.'>'.$b['batch_name'].'</option>';
                                } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('batch_id');?></span>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Active</label>
                            <select class="form-control" name="status">
                                <?php $status = array('Yes' => 'Yes','No'=>'No');
                                foreach($status as $key => $v)
                                {
                                    $selected = ($v == $class['status']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('status');?></span>    
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="form-group"> 
                            <label class="col-form-label label-align">Subject</label>
                            <select multiple="multiple" size="10" name="subjects[]" class="form-control dual_listbox" style="height: 150px">
                                <?php
                                foreach($subjects as $s)
                                {
                                    foreach ($class['subjects'] as $v) {
                                        if ($v['class_id'] == $class['id']) {
                                            $selected = 'selected';
                                        }
                                    }
                                    echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
                                } ?>
                            </select>   
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group text-right">
                    <div class="col-md-9 col-sm-9 offset-md-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
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

