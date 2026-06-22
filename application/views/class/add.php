<script type="text/javascript">
    <?php if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
    <?php } ?>
</script>
<div class="row">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-plus"></i> New Class</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php echo form_open('class/add'); ?>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align">Name <span class="required">*</span></label>
                    <div class="col-md-5 col-sm-5">
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" value="<?php echo $this->input->post('name'); ?>" >
                            <span class="text-danger"><?php echo form_error('name');?></span>
                        </div>
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group">
                    <div class="col-md-6 col-sm-6 offset-md-3">
                        <button class="btn btn-primary" type="reset"><i class="fa fa-times-circle"></i> Reset</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
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

