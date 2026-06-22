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
                <h2><i class="fa fa-plus"></i> New Contact</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open_multipart('contact-add'); ?>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Contact Name <span class="required">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="contact_name" class="form-control" value="<?php echo $this->input->post('contact_name'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('contact_name');?></span>
                            </div>
                        </div>
                        
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Date</label>
                            <div class="col-sm-9">
                                <input type="text" name="date" id="date_picker" class="date_picker form-control">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Company Name</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="company_name" class="form-control" value="<?php echo $this->input->post('company_name'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('company_name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Phone</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="phone" class="form-control" value="<?php echo $this->input->post('phone'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('phone');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Email</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" value="<?php echo $this->input->post('email'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('email');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Role</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" name="contact_role" class="form-control" value="<?php echo $this->input->post('contact_role'); ?>" >
                                </div>
                                <span class="text-danger"><?php echo form_error('contact_role');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-sm-3 label-align">Status</label>
                            <div class="col-sm-9">
                                <p style="margin-top: 8px">
                                    <?php $status=array(
                                        'New Lead' => NEW_LEAD,
                                        'Customer' => CUSTOMER,
                                        );
                                    foreach($status as $key => $st)
                                    {
                                        $selected = ($st == NEW_LEAD) ? ' checked="checked"' : "";

                                        echo '<input type="radio" class="flat" name="status" value="'.$st.'" '.$selected.'/> '.$key;
                                    } ?>
                                </p>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group" style="margin-bottom: 0">
                            <label class="col-form-label">Address</label>
                            <textarea name="address" rows="3" class="form-control" style="resize: none;"><?php echo $this->input->post('address'); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Notes</label>
                            <textarea name="notes" rows="3" class="form-control" style="resize: none;"><?php echo $this->input->post('notes'); ?></textarea>
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

