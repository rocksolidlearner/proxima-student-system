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
                <h2><i class="fa fa-pencil"></i> Edit Parent/Guardian </h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php $pid = urlencode(base64_encode($parent['id']));
                 echo form_open_multipart('parent-edit/'.$pid); ?>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <input type="hidden" name="id" value="'.$id.'">
                            <label class="col-form-label label-align">Phone</label>
                            <input type="text" name="phone" autofocus="true" placeholder="Valid Phone Number" class="form-control" value="<?=$parent['phone']?>" >    
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Email Address</label>
                            <input type="email" name="email" placeholder="Email Address" class="form-control" value="<?=$parent['email']?>" >    
                        </div>
                        <div class="form-group">
                            <label class="col-form-label label-align">Active</label>
                            <select class="form-control" name="status">
                                <?php $rel=array(
                                    'Yes' => 'Yes',
                                    'No' => 'No',
                                );
                                foreach($rel as $key => $r)
                                {
                                    $selected = ($r == $parent['status']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$r.'" '.$selected.'>'.$key.'</option>';
                                }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="form-group">
                            <label class="col-form-label label-align">Select Students</label>
                            <select multiple="multiple" size="10" name="students[]" class="form-control dual_listbox" style="height: 150px">';
                            <?php foreach($students as $std){
                                $selected = '';
                                foreach($parent['stds'] as $pstd){
                                    if($std['id']==$pstd['student_id'])
                                    $selected = "selected";
                                }
                                echo'<option value="'.$std['id'].'" '.$selected.'>'.$std['std_name'].'</option>';
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
                    <div class="col-md-3 col-sm-3"></div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

