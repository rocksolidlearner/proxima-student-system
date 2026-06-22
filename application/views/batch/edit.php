<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-pencil"></i> Edit Batch </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $c_id = urlencode(base64_encode($batch['id']));
                 echo form_open_multipart('batch-edit/'.$c_id); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Batch Name <span class="required">*</span></label>
                            <input type="text" name="batch_name" placeholder="Enter unique batch name" class="form-control" value="<?=($this->input->post('batch_name') ? $this->input->post('batch_name') : $batch['batch_name']);?>" >
                            <span class="text-danger"><?php echo form_error('batch_name');?></span>    
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Starting Date</label>
                            <input type="text" name="start_date" value="<?=$batch['start_date']?>" placeholder="Select session's starting date" id="date_picker" class="date_picker form-control">
                            <span class="text-danger"><?php echo form_error('start_date');?></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Ending Date</label>
                            <input type="text" name="end_date" value="<?=$batch['end_date']?>" placeholder="Select session's ending date" id="date_picker" class="date_picker form-control">
                            <span class="text-danger"><?php echo form_error('start_date');?></span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Active</label>
                            <select class="form-control" name="status">
                                <?php $status = array('Yes' => 'Yes','No'=>'No');
                                foreach($status as $key => $v)
                                {
                                    $selected = ($v == $batch['status']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                                } ?>
                            </select>
                            <span class="text-danger"><?php echo form_error('status');?></span>    
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

