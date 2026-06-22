 <!--
  * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 1/1/2021  -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Parent/Guaridan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?=base_url('assets/');?>css/bootstrap.css" rel='stylesheet' type='text/css' />
  <link href="<?=base_url('assets/');?>css/fontawesome-all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <script src="<?=base_url('assets/')?>js/jquery.min.js"></script>
  <!--Toastr-->
  <script type="text/javascript" src="<?=base_url('assets/')?>toastr/toastr.min.js"></script>
  <link href="<?=base_url('assets/')?>toastr/toastr.min.css" rel="stylesheet">
  <style>
    .navbar-dark,.navbar-brand{
      padding: 0;
    }
    .dropdown-menu{
      padding-top: 0;
      margin-top: 0;
    }
  .fakeimg {
    height: 200px;
    background: #aaa;
  }
  .active{
    background-color: #e02222 !important;
  }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="<?=base_url('website')?>"><img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" width="200px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav" style="width: 85%">
      <li class="nav-item dropdown <?php if($this->uri->segment(1) == "dashboard" || $this->uri->segment(1) == "profile"){echo 'active ';}?>">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dashboard
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
          <a class="dropdown-item <?php if($this->uri->segment(1) == "dashboard"){echo 'active ';}?>" href="<?=base_url('dashboard')?>">Home</a>
          <a class="dropdown-item <?php if($this->uri->segment(1) == "profile"){echo 'active ';}?>" href="<?=base_url('profile')?>">Profile</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle <?php if($this->uri->segment(1) == "weekly" || $this->uri->segment(1) == "progress"){echo 'active ';}?>" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Report
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <a class="dropdown-item <?php if($this->uri->segment(1) == "weekly-report"){echo 'active ';}?>" href="<?=base_url('weekly-report')?>">Student weekly Report</a>
          <a class="dropdown-item <?php if($this->uri->segment(1) == "progress-report"){echo 'active ';}?>" href="<?=base_url('progress-report')?>">Student Progress Report</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"></i> <?=$this->session->userdata('guardian_name')?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
          <a class="dropdown-item <?php if($this->uri->segment(1) == "profile"){echo 'active ';}?>" href="<?=base_url('profile')?>"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="<?=base_url('login/logout')?>"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </div>
      </li>
    </ul>
  </div>  
</nav> 
<?php                    
    if(isset($_view) && $_view)
        $this->load->view($_view);
?>  
<script src="<?=base_url('assets/');?>js/jquery-2.2.3.min.js"></script>
<script src="<?=base_url('assets/');?>js/bootstrap.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";
 
$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});

  </script>

</body>
</html>
