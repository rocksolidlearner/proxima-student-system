<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>User Profile</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar" hidden>
                                <!-- Current avatar -->
                                <img class="img-responsive avatar-view" src="<?=base_url('uploads/'.$this->session->userdata('img'))?>" width="200px" height="100px" alt="Profile Picture" title="Profile Picture">
                            </div>
                        </div>
                        <h3><?=$this->session->userdata('name')?></h3>

                        <ul class="list-unstyled user_data">
                            <li><i class="fa fa-envelope"></i> <?=$this->session->userdata('email')?></li>
                            <li>
                                <?php if($this->session->userdata('gender') == MALE){
                                    echo'<i class="fa fa-male"></i> Male';
                                }else{
                                    echo'<i class="fa fa-female"></i> Female';
                                }?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-9 col-sm-9">
                        <?php echo form_open_multipart('profile/update_profile', array('id' => 'demo-form2','class'=>'form-horizontal form-label-left'));
                        if ($this->session->userdata('role') ==SUPERADMIN || $this->session->userdata('role') ==ADMIN) { ?>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="name" value="<?=$this->session->userdata('name') ?>" type="text" class="form-control ">
                                <span class="text-danger"><?php echo form_error('name');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Username
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="username" value="<?=$this->session->userdata('username'); ?>" type="text" class="form-control"> 
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="email" value="<?=$this->session->userdata('email'); ?>" type="email" id="first-name" class="form-control ">
                                <span class="text-danger"><?php echo form_error('email');?></span>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Password
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input name="password" type="password" id="password" class="form-control ">
                                <span class="text-danger"><?php echo form_error('password');?></span>
                            </div>
                        </div>
                    <?php } ?>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Profile Picture
                            </label>
                            <div class="col-md-2 col-sm-2 ">
                                <input  name="img" onchange="readURL(this);" id="prof_img" class="date-picker form-control"  type="file" style="display: none">
                                <i onclick="get_img()" class="fa fa-camera fa-3x" style="opacity: .7; cursor: pointer"></i>
                            </div>
                            <div class="col-md-3 col-sm-3 ">
                                <img src="<?=base_url('uploads/'.$this->session->userdata('img'))?>" style="width: 100px;height: 100px;box-shadow: 0px 0px 15px lightgray" id="blah" class="img-responsive img-circle"/>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check-circle"></i> Submit</button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
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
