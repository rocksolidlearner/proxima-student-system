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
    <link href="<?=base_url('assets/')?>vendors/animate.css/animate.min.css" rel="stylesheet">

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
</style>
<body class="login">
    <div class="login_wrapper" style="margin-top: 0">
        <div class="animate form login_form">
            <section class="login_content">
                <img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" style="margin-bottom: 20px">
                <?=form_open('login/do_login')?>
                
                    <h1 style="color: #fff">Login Here</h1>
                <?php if($this->session->flashdata('error')){?>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> <?=$this->session->flashdata('error')?>
                    </div>
                <?php } ?>
                    <div>
                        <input type="text" class="form-control" name="email" placeholder="Email / Username" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success btn-block submit" href="index.html">Log in</button>
                        <!--<a class="reset_pass" href="#">Lost your password?</a>-->
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
</html>
