<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cranbrook College-Login</title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/')?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Animate.css -->
    <!-- <link href="<?=base_url('assets/')?>vendors/animate.css/animate.min.css" rel="stylesheet"> -->

    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/')?>build/css/custom.min.css" rel="stylesheet">
</head>
<style type="text/css">
.login_form {
    background: url(<?=base_url('assets/images/bg-white-lock.png')?>) repeat;
    width: 360px;
    padding: 30px;
    margin-top: 50px;
    box-shadow: 0 0 10px #FFF;
}
.alert{
    padding: 5px !important;
}
</style>
<body class="login">
    <div class="login_wrapper" style="margin-top: 0">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" style="margin-bottom: 20px">
                <?=form_open_multipart('login/do_login')?>
                
                    <h1 id="title" style="color: #fff">New Learners</h1>
                <?php if($this->session->flashdata('success')){?>
                    <div class="alert alert-success alert-dismissible " role="alert">
                        <p><?=$this->session->flashdata('success')?></p>
                    </div>
                <?php }if($this->session->flashdata('error')){?>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <p><?=$this->session->flashdata('error')?></p>
                    </div>
                <?php } ?>
                    <div>
                        <input type="text" class="form-control" name="admission_no" placeholder="Admission Number" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                    </div>
                    <div id="form">
                        <button type="submit" class="btn btn-success btn-block submit">Log in</button>
                        <button class="btn btn-primary btn-block" onclick="new_learner()">New Register</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <p style="color: #fff">© <?=date('Y')?> All Rights Reserved. Cranbrook College</p>
                        </div>
                    </div>
                <?=form_close()?>
            </section>
        </div>

    </div>
</body>
<script src="<?=base_url('assets/');?>js/jquery-2.2.3.min.js"></script>
<script>
$(function () {
    $('.login_wrapper').find('.alert').hide(10000);
    $('#down').click(function () {
        console.log('click');
        $(this).hide(2000);
        $('#adm_file').show(1000);
    })
})
function new_learner() {
    $('#title').text('New Learners');
    $('.form-control').hide();
    $('#form').html('<a href="<?=base_url('download-form')?>" id="down" onclick="uploadFile()" title="Download Application Form" class="btn btn-info" style="width: 100%;text-decoration: none;font-size: medium;margin-bottom: 10px">Application Form</a>'+
    '<div id="adm_file" style="margin: 10px 0;display: none"><input type="file" class="form-control" name="admission_file" style="line-height: 1.9;padding: 0"/></div>'+
    '<button type="submit" class="btn btn-success" name="submit_form" style="width: 100%;">Submit</button>'+
    '<p style="color: #fff;margin:0;text-align: left">1. Click "Application Form" Download PDF Form <br>2. Fill the PDF form<br>3. Upload Your PDF Filled Form<br>4. Submit Your Application');
}
function uploadFile() {
    $('#down').hide(2000);
    $('#adm_file').show(1000);
}
</script>
</html>
