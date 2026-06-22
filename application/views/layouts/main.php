<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cranbrook College | Admin</title>

    <!-- Bootstrap -->
    <link href="<?=base_url('assets/')?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?=base_url('assets/')?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?=base_url('assets/')?>vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- FullCalendar -->
    <link href="<?=base_url('assets/')?>vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">

    <!-- iCheck -->
    <link href="<?=base_url('assets/')?>vendors/iCheck/skins/flat/_all.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="<?=base_url('assets/')?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="<?=base_url('assets/')?>vendors/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?=base_url('assets/')?>build/css/custom.min.css" rel="stylesheet">

    <!-- Datatables -->

    <link href="<?=base_url('assets/')?>vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- jQuery -->
    <link href="<?=base_url('assets/')?>vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?=base_url('assets/')?>vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>css/bootstrap-duallistbox.min.css" rel="stylesheet">
    <link href="<?=base_url('assets/')?>css/hover-min.css" rel="stylesheet">
    <!--    ChartJS-->
    <script src="<?=base_url('assets/')?>vendors/Chart.js/dist/Chart.bundle.js"></script>


    <script src="<?=base_url('assets/')?>vendors/jquery/dist/jquery.min.js"></script>

    <!--    Toastr-->
    <script type="text/javascript" src="<?=base_url('assets/')?>toastr/toastr.min.js"></script>
    <link href="<?=base_url('assets/')?>toastr/toastr.min.css" rel="stylesheet">
    <style>
        .buttons-html5{
            position: relative;
            display: inline-block;
            box-sizing: border-box;
            margin-right: 0.333em;
            margin-bottom: 0.333em;
            padding: 0.5em 1em;
            border: 1px solid rgba(0,0,0,0.3);
            border-radius: 2px;
            cursor: pointer;
            font-size: 0.88em;
            line-height: 1.6em;
            color: black;
            white-space: nowrap;
            overflow: hidden;
            background-color: rgba(0,0,0,0.1);
            background: -webkit-linear-gradient(top, rgba(230,230,230,0.1) 0%, rgba(0,0,0,0.1) 100%);
            background: -moz-linear-gradient(top, rgba(230,230,230,0.1) 0%, rgba(0,0,0,0.1) 100%);
            background: -ms-linear-gradient(top, rgba(230,230,230,0.1) 0%, rgba(0,0,0,0.1) 100%);
            background: -o-linear-gradient(top, rgba(230,230,230,0.1) 0%, rgba(0,0,0,0.1) 100%);
            background: linear-gradient(to bottom, rgba(230,230,230,0.1) 0%, rgba(0,0,0,0.1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='rgba(230, 230, 230, 0.1)', EndColorStr='rgba(0, 0, 0, 0.1)');
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            text-decoration: none;
            outline: none;
            text-overflow: ellipsis;
        }
        .fc-title{
            color: white !important;
        }
        .fc-time{
            color: white !important;
        }
        .tag-red {

            line-height: 1;
            background: #da4f49 !important;
            color: #fff !important;
        }
        .tag-orange {

            line-height: 1;
            background: orange !important;
            color: #fff !important;
        }
        .tag-blue {

            line-height: 1;
            background: dodgerblue !important;
            color: #fff !important;
        }
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
        @media only screen and (min-width: 451px) {
            .img-class{
                height: 230px !important; 
            }
           /* #menu_toggle{
                display: none;
            }*/
        }
        @media only screen and (max-width: 812px) {
            /* For mobile phones: */
            .img-class{
                height: 50px !important; 
            }
            #menu_toggle{
                display: block;
            }
        }
        
    </style>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title">
                    <a href="#" class="site-title"><img src="<?=base_url('assets/images/cranbrook-college-logo3.png')?>" style="width: 100%"></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix" style="display: none">
                    <div class="profile_info" style="text-align: center">
                        <span>Welcome <i class="fa fa-smile-o"></i> <i style="color: white"><?=$this->session->userdata('name')?></i></span>
                        <h2 style="text-align: left" hidden><?=$this->session->userdata('name')?></h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu Items</h3>
                        <ul class="nav side-menu">
                            <li class="<?php if($this->uri->segment(1) == "dashboard"){echo 'active ';}?>">
                                <a href="<?=base_url('dashboard')?>"><i class="fa fa-pie-chart"></i> Dashboard </a>
                            </li>
                            <?php if(in_array('time_table',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "time-table"){echo 'active ';}?>"><a><i class="fa fa-clock-o"></i> Time Table <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "time-table"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('time-table')?>"><i class="fa fa-clock-o"></i> Time Table</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('admission',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "admission"){echo 'active ';}?>">
                                <a href="<?=base_url('admission')?>"><i class="fa fa-plus"></i> Admission </a>
                            </li>
                            <?php }if(in_array('manage_student_attendance',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "attendance-register" || $this->uri->segment(1) == "attendance-report" ||$this->uri->segment(1) == "attendance-sheet"){echo 'active ';}?>"><a><i class="fa fa-list"></i> Attendance <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "attendance-register" || $this->uri->segment(1) == "attendance-report" || $this->uri->segment(1) == "attendance-sheet"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('attendance-register')?>"> Attendance Register</a></li>
                                    <li><a href="<?=base_url('attendance-report')?>"> Attendance Report</a></li>
                                     <li><a href="<?=base_url('attendance-sheet')?>"> Attendance Sheet</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('fee_module',$this->data['permits']) || in_array('pay_fee',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "fee-collect" || $this->uri->segment(1) == "fee-defaulters" || $this->uri->segment(1) == "fee-paid" || $this->uri->segment(1) == "fee-defaulters-report"){echo 'active ';}?>">
                                <a><i class="fa fa-dollar"></i> Fee <span class="badge badge-warning badge-roundless"><?=$this->data['defaulter_fee']?></span><span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "fee"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('fee-collect')?>"> Collect Fee <span class="badge badge-info badge-roundless"><?=$this->data['collect_fee']?></span></a></li>
                                    <li><a href="<?=base_url('fee-defaulters')?>"> Fee Defaulters <span class="badge badge-warning badge-roundless"><?=$this->data['defaulter_fee']?></span></a></li>
                                    <?php if(in_array('pay_fee',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('fee-paid')?>"> Paid Fee</a></li>
                                    <?php }?>
                                    <li><a href="<?=base_url('fee-defaulter-report')?>"> Fee Defaulters Report</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('allow_students',$this->data['permits']) || in_array('admission',$this->data['permits']) ){?>
                            <li class="<?php if($this->uri->segment(1) == "student" || $this->uri->segment(1) == "admission"){echo 'active ';}?>"><a><i class="fa fa-users"></i> Students <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "student" || $this->uri->segment(1) == "admission"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('student')?>"><i class="fa fa-users"></i> All Students</a></li>
                                    <?php if(in_array('admission',$this->data['permits']) ){?>
                                    <li><a href="<?=base_url('admission')?>"><i class="fa fa-plus"></i> Add New</a></li>
                                    <?php }?>
                                    <li><a href="<?=base_url('deleted-student')?>"><i class="fa fa-user-times"></i> Deleted Students <span class="badge badge-primary badge-roundless"><?=$this->data['deleted_stds']?></span></a></li>
                                    <li><a href="http://www.cranbrookcollege.uk/students/" target="_blank"><i class="fa fa-external-link-square"></i> Open Student Panel</a></li>
                                </ul>                            
                            </li>
                            <?php }if(in_array('allow_accounts',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "account-daily-expenses" || $this->uri->segment(1) == "account-teacher-salary"
                            || $this->uri->segment(1) == "student-payment-report"|| $this->uri->segment(1) == "payment-report"
                            || $this->uri->segment(1) == "accounts-transactions" || $this->uri->segment(1) == "cash-report"
                            || $this->uri->segment(1) == "expense-report"){echo 'active ';}?>"><a><i class="fa fa-money"></i> Accounts <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "account-daily-expenses" || $this->uri->segment(1) == "account-teacher-salary"
                                || $this->uri->segment(1) == "student-payment-report" || $this->uri->segment(1) == "payment-report"
                                || $this->uri->segment(1) == "accounts-transactions" || $this->uri->segment(1) == "cash-report"
                                || $this->uri->segment(1) == "expense-report"){echo 'block ';}?>">
                                    <?php if(in_array('manage_daily_expenses',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('account-daily-expenses')?>"> Daily Expenses</a></li>
                                    <?php }?>
                                    <li><a href="<?=base_url('account-teacher-salary')?>"> Teacher Salaries <span class="badge badge-danger badge-roundless">new</span></a></li>
                                    <li><a href="<?=base_url('student-payment-report')?>"> Students Payment Report</a></li>
                                    <li><a href="<?=base_url('payment-report')?>"> Payment Report</a></li>
                                    <?php if(in_array('view_account_transactions',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('accounts-transactions')?>"> View Transactions</a></li>
                                    <?php }?>
                                    <li><a href="<?=base_url('cash-report')?>"> Cash Report</a></li>
                                    <li><a href="<?=base_url('expense-report')?>"> Expense Report</a></li>
                                </ul>                            
                            </li>
                            <?php }if(in_array('allow_examination',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "test-schedules"){echo 'active ';}?>"><a><i class="fa fa-table"></i> Examination <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "test-schedules"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('test-schedules')?>"> Test Schedules</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('allow_reports',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "reports" || $this->uri->segment(1) == "reports"){echo 'active ';}?>"><a><i class="fa fa-bar-chart-o"></i> Reports <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "reports"){echo 'block ';}?>">
                                    <li style="padding-left: 5px"  class="<?php if($this->uri->segment(1) == "reports" || $this->uri->segment(1) == "reports"){echo 'active ';}?>"><a><i class="fa fa-chart-line"></i> Student Reports <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "weekly-report" || $this->uri->segment(1) == "progress-report" || $this->uri->segment(1) == "student-list"){echo 'block ';}?>">
                                            <li><a href="<?=base_url('weekly-report')?>"> Weekly</a></li>
                                            <li><a href="<?=base_url('progress-report')?>"> Progress</a></li>
                                            <li><a href="<?=base_url('student-list')?>"> Student List</a></li>
                                        </ul>
                                    </li>
                                    <li style="padding-left: 5px"  class="<?php if($this->uri->segment(1) == "topper-report" 
                                        || $this->uri->segment(1) == "weekly-evaluation"){echo 'active ';}?>"><a><i class="fa fa-chart-line"></i> Class Reports <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "topper-report"
                                        || $this->uri->segment(1) == "weekly-evaluation"){echo 'block ';}?>">
                                            <li><a href="<?=base_url('topper-report')?>"> Toppers Report</a></li>
                                            <li><a href="<?=base_url('weekly-evaluation')?>"> Weekly Evaluation</a></li>
                                        </ul>
                                    </li>
                                    <li style="padding-left: 5px" class="<?php if($this->uri->segment(1) == "teacher-evaluation"){echo 'active ';}?>"><a><i class="fa fa-chart-line"></i> Teacher Reports <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "teacher-evaluation"){echo 'block ';}?>">
                                            <li><a href="<?=base_url('teacher-evaluation')?>"> Teacher Evaluation</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <?php }if(in_array('manage_teachers',$this->data['permits']) || in_array('manage_employees',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "teachers" || $this->uri->segment(1) == "employees" || $this->uri->segment(1) == "employee-add"){echo 'active ';}?>"><a><i class="fa fa-users"></i> Employee <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "teacher"||$this->uri->segment(1) == "employees" || $this->uri->segment(1) == "employee-add"){echo 'block ';}?>">
                                    <?php if(in_array('manage_teachers',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('teacher')?>"> All Teachers</a></li>
                                    <li><a href="http://www.cranbrookcollege.uk/teachers/" target="_blank"><i class="fa fa-external-link-square"></i> Open Techer Panel</a></li>
                                    <?php }if(in_array('manage_employees',$this->data['permits'])){?>
                                    <li style="padding-left: 5px"  class="<?php if($this->uri->segment(1) == "employee-add"){echo 'active ';}?>"><a><i class="fa fa-chart-line"></i> Other Employee <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "employee-add"){echo 'block ';}?>">
                                            <li><a href="<?=base_url('employee-add')?>"><i class="fa fa-user-plus"></i> Add Employee</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="<?=base_url('employees')?>"> All Employees</a></li>
                                    <?php }?>
                                </ul>                            
                            </li>
                            <?php }if(in_array('allow_cource_material',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "course-manage" || $this->uri->segment(1) == "course-add"){echo 'active ';}?>"><a><i class="fa fa-tasks"></i> Course Material <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "course-manage" || $this->uri->segment(1) == "course-add"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('course-add')?>"> Add Course</a></li>
                                    <li><a href="<?=base_url('course-manage')?>"> All Courses</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('manage_library',$this->data['permits']) || in_array('library_assign_books',$this->data['permits']) ){?>
                            <li class="<?php if($this->uri->segment(1) == "library-books" || $this->uri->segment(1) == "library-assign-books"){echo 'active ';}?>"><a><i class="fa fa-book"></i> Library <span class="badge badge-danger badge-roundless">New</span><span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "library-books" || $this->uri->segment(1) == "library-assign-books"){echo 'block ';}?>">
                                    <?php if(in_array('manage_library',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('library-books')?>"> Manage Library</a></li>
                                    <?php }if(in_array('library_assign_books',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('library-assign-books')?>"> Assign Books</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <?php }if(in_array('allow_users',$this->data['permits']) || in_array('user-add',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "users" || $this->uri->segment(1) == "users"){echo 'active ';}?>">
                                <a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "users"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('users')?>"><i class="fa fa-users"></i> All Users</a></li>
                                    <li><a href="<?=base_url('user-add')?>"><i class="fa fa-user-plus"></i> Add New</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('allow_parents',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "parents" || $this->uri->segment(1) == "parents"){echo 'active ';}?>"><a><i class="fa fa-user-secret"></i> Parents/Gaurdians <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "parents"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('parents')?>"><i class="fa fa-user-secret"></i> All Parents/Gaurdians</a></li>
                                    <li><a href="http://www.cranbrookcollege.uk/guardians/" target="_blank"><i class="fa fa-external-link-square"></i> Open Gaurdian Panel</a></li>
                                </ul>
                            </li>
                            <?php }if(in_array('tools',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "student-import" || $this->uri->segment(1) == "student-export" 
                                || $this->uri->segment(1) == "classes-export"){echo 'active ';}?>"><a><i class="fa fa-wrench"></i> Tools <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "import"){echo 'block ';}?>">
                                    <li class="<?php if($this->uri->segment(1) == "student-import"){echo 'active ';}?>"><a>Import <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "student-import"){echo 'block ';}?>">
                                            <li style="padding-left: 10px"><a href="<?=base_url('student-import')?>"> Students</a></li>
                                        </ul>
                                    </li>
                                    <li class="<?php if($this->uri->segment(1) == "student-export" || $this->uri->segment(1) == "classes-export"){echo 'active ';}?>"><a>Emport <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "student-export" || $this->uri->segment(1) == "classes-export"){echo 'block ';}?>">
                                            <li style="padding-left: 10px"><a href="<?=base_url('student-export')?>"> Students</a></li>
                                            <li style="padding-left: 10px"><a href="<?=base_url('classes-export')?>"> Classes</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <?php }if(in_array('change_app_settings',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "app-setting" || $this->uri->segment(1) == "subject-manage" 
                                || $this->uri->segment(1) == "class-manage" || $this->uri->segment(1) == "batches-manage"
                                || $this->uri->segment(1) == "histroy" || $this->uri->segment(1) == "account-setting"
                                || $this->uri->segment(1) == "fee-setting" || $this->uri->segment(1) == "cal-setting"
                                || $this->uri->segment(1) == "sms-setting" || $this->uri->segment(1) == "custom-style"
                                || $this->uri->segment(1) == "translation"){echo 'active ';}?>"><a><i class="fa fa-gears"></i> Settings <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "app-setting" 
                                || $this->uri->segment(1) == "subject-manage" || $this->uri->segment(1) == "class-manage" 
                                || $this->uri->segment(1) == "batches-manage" || $this->uri->segment(1) == "histroy"
                                || $this->uri->segment(1) == "account-setting" || $this->uri->segment(1) == "fee-setting"
                                || $this->uri->segment(1) == "fine"|| $this->uri->segment(1) == "cal-setting" 
                                || $this->uri->segment(1) == "sms-setting" || $this->uri->segment(1) == "custom-style" 
                                || $this->uri->segment(1) == "translation"){echo 'block ';}?>">
                                    <?php if(in_array('change_app_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('app-setting')?>"> General</a></li>
                                    <?php }if(in_array('batches-manage',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('batches-manage')?>"> Batches/Years/Session</a></li>
                                    <?php }if(in_array('subject-manage',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('subject-manage')?>"> Subjects</a></li>
                                    <?php }if(in_array('class-manage',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('class-manage')?>"> Classes</a></li>
                                    <?php }if(in_array('history',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('history')?>"> History</a></li>
                                    <?php }if(in_array('account-setting',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('account-setting')?>"> Accounts</a></li>
                                    <?php }if(in_array('change_fee_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('fee-setting')?>"> Fee</a></li>
                                    <?php }if(in_array('change_app_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('fine')?>"> Fine</a></li>
                                    <?php }if(in_array('change_calendar_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('cal-setting')?>"> Calendar</a></li>
                                    <?php }if(in_array('change_sms_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('sms-setting')?>"> SMS</a></li>
                                    <?php }if(in_array('change_app_settings',$this->data['permits'])){?>
                                    <li><a href="<?=base_url('custom-style')?>"> Custom Style</a></li>
                                    <?php }if(in_array('change_app_settings',$this->data['permits'])){?>
                                    <li hidden><a href="<?=base_url('translations')?>"> Translations</a></li>
                                    <?php }?>
                                </ul>
                            </li>
                            <?php }if(in_array('sales-and-marketing',$this->data['permits'])){?>
                            <li hidden class="<?php if($this->uri->segment(1) == "report-bug"){echo 'active ';}?>">
                                <a href="<?=base_url('report-bug')?>"><i class="fa fa-line-chart"></i> Sales and Marketing </a>
                            </li>
                            <?php }if(in_array('project_manage',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "project-manage" || $this->uri->segment(1) == "project-add"
                            || $this->uri->segment(1) == "project-edit"){echo 'active ';}?>">
                                <a href="<?=base_url('project-manage')?>"><i class="fa fa-line-chart"></i> Projects </a>
                            </li>
                            <?php }if(in_array('call_log',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "call-log" || $this->uri->segment(1) == "contact-edit"
                            || $this->uri->segment(1) == "contact-edit"){echo 'active ';}?>"><a><i class="fa fa-question-circle"></i> CRM <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "call-log" || $this->uri->segment(1) == "contact-add"
                                || $this->uri->segment(1) == "contact-edit"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('call-log')?>"> Call Log</a></li>
                                </ul>
                            </li>
                            <?php } if(in_array('lms',$this->data['permits'])){?>
                            <li hidden class="<?php if($this->uri->segment(1) == "how-to-start" || $this->uri->segment(1) == "report-bug"){echo 'active ';}?>"><a><i class="fa fa-question-circle"></i> LMS <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "how-to-start" || $this->uri->segment(1) == "report-bug"){echo 'block ';}?>">
                                    <li><a href="<?=base_url('report-bug')?>"> Online Lesson</a></li>
                                    <li><a href="<?=base_url('report-bug')?>"> Affiliation & Accerditation</a></li>
                                    <li><a href="<?=base_url('report-bug')?>"> Approved Course</a></li>
                                </ul>
                            </li>
                            <?php } if(in_array('report_bug',$this->data['permits'])){?>
                            <li class="<?php if($this->uri->segment(1) == "how-to-start" || $this->uri->segment(1) == "report-bug"){echo 'active ';}?>"><a><i class="fa fa-question-circle"></i> Help <span class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: <?php if($this->uri->segment(1) == "how-to-start" || $this->uri->segment(1) == "report-bug"){echo 'block ';}?>">
                                    <li hidden><a href="<?=base_url('how-to-start')?>"> How to start?</a></li>
                                    <li><a href="<?=base_url('report-bug')?>"> Report a bug</a></li>
                                </ul>
                            </li>
                            <?php }  ?>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                    <ul class=" navbar-right">
                        <li class="nav-item dropdown open" style="padding-left: 15px;">
                            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                <?php if($this->session->userdata('img')){ ?>
                                <img src="<?=base_url('uploads/'.$this->session->userdata('img'))?>" alt="<?=$this->session->userdata('name')?>_image"><?=$this->session->userdata('name')?>
                                <?php }else{
                                    echo '<img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">';
                                } ?>
                            </a>
                            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="<?=base_url('profile')?>"><i class="fa fa-user"></i> Profile</a>
                                <a hidden class="dropdown-item"  href="<?=base_url('support')?>"><i class="fa fa-envelope"></i> My Inbox</a>
                                <a class="dropdown-item"  href="<?=base_url('login/logout')?>"><i class="fa fa-sign-out"></i> Log Out</a>
                            </div>
                        </li>
                        <li hidden role="presentation" class="nav-item dropdown open">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <span class="badge bg-green"><?php if (isset($_SESSION['site_id'])) { echo $this->data['tot_messages'];}?></span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                                <?php if (isset($_SESSION['id'])) {
                                    if (empty($this->data['messages'])) { ?>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span>
                                            <span>Your inbox is empty</span>
                                        </span>
                                    </a>
                                </li>
                                <?php }else{
                                 foreach ($this->data['messages'] as $m){ ?>
                                <li class="nav-item">
                                    <a class="dropdown-item">
                                        <span class="image" hidden><img src="<?=base_url('uploads/')?>1.jpg" alt="Profile Image"></span>
                                        <span>
                                            <span><?=$m['user_f_name'].' '.$m['user_l_name']?></span>
                                            <span class="time"><?=date('Y-m-d h:i A',strtotime($m['date_created']))?></span>
                                        </span>
                                        <span class="message"><?=$m['message']?></span>
                                    </a>
                                </li>
                                <?php } }}?>
                                <li class="nav-item" hidden>
                                    <div class="text-center">
                                        <a href="#" class="dropdown-item">
                                            <strong>See All Messages</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <!-- <h3><?php echo  ucfirst($this->uri->segment(1))?></h3> -->
                    </div>

                </div>

                <div class="clearfix"></div>

                <?php	if(isset($_view) && $_view)
                    $this->load->view($_view);
                ?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Cranbrook Collage - Powered By <a href="#">Hafiz Hassan</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<!-- Bootstrap -->
<script src="<?=base_url('assets/')?>vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/')?>vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?=base_url('assets/')?>vendors/nprogress/nprogress.js"></script>
<!-- ECharts -->
<script src="<?=base_url('assets/')?>vendors/echarts/dist/echarts.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/echarts/map/js/world.js"></script>


<script src="<?=base_url('assets/')?>vendors/iCheck/icheck.min.js"></script>
<!-- Switchery -->
<script src="<?=base_url('assets/')?>vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="<?=base_url('assets/')?>vendors/select2/dist/js/select2.full.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="<?=base_url('assets/')?>vendors/moment/min/moment.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->
<script src="<?=base_url('assets/')?>vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url('assets/')?>js/jquery.bootstrap-duallistbox.min.js"></script>
<!-- Custom Theme Scripts -->
<!-- FullCalendar -->
<script src="<?=base_url('assets/')?>vendors/fullcalendar/dist/fullcalendar.min.js"></script>


<!-- Datatables -->
<script src="<?=base_url('assets/')?>vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?=base_url('assets/')?>vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/jszip/dist/jszip.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/pdfmake/build/vfs_fonts.js"></script>
<!-- morris.js -->
<script src="<?=base_url('assets/')?>vendors/raphael/raphael.min.js"></script>
<script src="<?=base_url('assets/')?>vendors/morris.js/morris.min.js"></script>
<script src="<?=base_url('assets/')?>build/js/custom.js"></script>

<script>
    $(document).ready(function() {
        $('#export').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
	    $('#datatable2').dataTable();
        $('#datatable3').dataTable();
    } );
    $('.select2').select2()
    $('.date_picker').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('.time_picker').datetimepicker({
        format: 'hh:mm A'
    });
    $('.dual_listbox').bootstrapDualListbox();
</script>
</body>
</html>

