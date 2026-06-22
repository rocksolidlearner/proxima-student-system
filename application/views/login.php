<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Cranbrook College-Login</title>
      <!-- Meta tags -->
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="keywords" content="Cranbrook College-Login"/>
      <script>
         addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
      </script>
      <!-- Meta tags -->
      <link rel="stylesheet" href="<?=base_url('assets/login/')?>css/flexslider.css" type="text/css" media="screen" property="" />
      <!--flexslider-->
      <!--stylesheets-->
      <link href="<?=base_url('assets/')?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
      <link href="<?=base_url('assets/login/')?>css/style.css" rel='stylesheet' type='text/css' media="all">
      <!--//style sheet end here-->
      <link href="//fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
   </head>
   <body>
      <h1 class="header-w3l-agile">
         Cranbrook College Sign In
      </h1>
      <div class="slid-bothside">
         <div class="slid-left-w3">
            <div class="w3layouts_main_grid_left">
               <section class="slider">
                  <div class="flexslider">
                     <div class="flex-viewport" style="overflow: hidden; position: relative;">
                        <ul class="slides" style="width: 1000%; transition-duration: 0s; transform: translate3d(-332px, 0px, 0px);">
                           <li class="clone" style="width: 332px; float: left; display: block;">
                              <div class="w3ls_main_grid_left_grid three">
                              </div>
                           </li>
                           <li style="width: 332px; float: left; display: block;" class="flex-active-slide">
                              <div class="w3ls_main_grid_left_grid one">
                              </div>
                           </li>
                           <li class="" style="width: 332px; float: left; display: block;">
                              <div class="w3ls_main_grid_left_grid two">
                              </div>
                           </li>
                           <li class="" style="width: 332px; float: left; display: block;">
                              <div class="w3ls_main_grid_left_grid three">
                              </div>
                           </li>
                           <li style="width: 332px; float: left; display: block;" class="clone">
                              <div class="w3ls_main_grid_left_grid one">
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </section>
            </div>
         </div>
         <div class="slid-right-w3">
            <div class="main">
               <div class="its-sign-in">
                  <h2>Sign in Your Account</h2>
                  <?php if($this->session->flashdata('error')){?>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Error!</strong> <?=$this->session->flashdata('error')?>
                    </div>
                    <?php } ?>
               </div>
               <?=form_open('login/do_login')?>
               <div class="form-left-w3l">
                  <input type="email" name="email" placeholder="Email / Username" required="">
               </div>
               <div class="form-right-w3ls ">
                  <input type="password" name="password" placeholder="Password" id="password" required="">
               </div>
               
               <div class="btnn">
               <div class="clear"></div>
                  <button type="submit">Sign in</button><br>
                  <div class="clear"></div>
               </div>
               <div class="rem-pass-agile">
                  <div class="right-side">
                    <a href="http://www.cranbrookcollege.uk/teachers" class="for"><i class="fa fa-sign-in"></i> Teacher Login</a>
                  </div>
                  <div class="right-side">
                    <a href="http://www.cranbrookcollege.uk/guardians" class="for"><i class="fa fa-sign-in"></i> Guardian Login</a>
                  </div>
                  <div class="right-side">
                    <a href="http://www.cranbrookcollege.uk/students" class="for"><i class="fa fa-sign-in"></i> Student Login</a>
                  </div>
                  
               </div>
			   <?=form_close()?>
            </div>
         </div>
      </div>
      <!-- <div class="copy">
         <p>&copy;2021 CranbrookCollege. All Rights Reserved</p>
      </div> -->
      <!--js working-->
      <script src='<?=base_url('assets/login/')?>js/jquery-2.2.3.min.js'></script>
      <!--//js working-->
      <!-- flexSlider -->
      <script defer src="<?=base_url('assets/login/')?>js/jquery.flexslider.js"></script>
      <script>
         $(window).load(function(){
           $('.flexslider').flexslider({
         	animation: "slide",
         	start: function(slider){
         	  $('body').removeClass('loading');
         	}
           });
         });
      </script>
      <!-- //flexSlider -->
   </body>
</html>