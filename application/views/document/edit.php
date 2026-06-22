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
                <h2><i class="fa fa-upload"></i> Edit Document</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $c_id = urlencode(base64_encode($document['id']));
                 echo form_open_multipart('document-edit/'.$c_id); ?>
                <div class="col-md-6 col-sm-12">
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Upload Document
                        </label>
                        <div class="col-md-9 col-sm-9">
                            <input hidden name="title" class="form-control">
                            <input name="file_name" id="file_name" class="date-picker form-control"  type="file">
                            <label><?=$document['file_name']?></label>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Description</label>
                        <div class="col-md-9 col-sm-9">
                            <div class="input-group">
                                <textarea name="description" rows="7" class="form-control" style="resize: none;"><?php echo ($this->input->post('description') ? $this->input->post('description') : $document['description']); ?></textarea>
                                <span class="text-danger"><?php echo form_error('description');?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <h6>Select Clients</h6>
                    <div class="item form-group">
                        <select multiple="multiple" size="10" name="clients[]" class="form-control dual_listbox" style="height: 220px">
                            <?php
                            foreach($clients as $c)
                            {
                                $selected = '';
                                foreach($document['clients'] as $tc){
                                    if($c['id'] == $tc['client_id']){
                                        $selected="selected";
                                    }
                                }

                                echo '<option value="'.$c['id'].'" '.$selected.'>'.$c['name'].'</option>';
                            }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-9 col-sm-9 offset-md-3 text-right">
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

