<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login/index';

$route['dashboard'] = "dashboard/index";

$route['student-view'] = "dashboard/student_view";
$route['assignments/(:any)'] = "dashboard/assignments/$1";

$route['course-material'] = "dashboard/material";
$route['weekly-lecture'] = "dashboard/lecture";
$route['teacher-notes'] = "dashboard/notes";

$route['attendance-register'] = "dashboard/attendance_register";
$route['attendance-report'] = "dashboard/attendance_report";
$route['attendance-sheet'] = "dashboard/attendance_sheet";

$route['weekly-report'] = "dashboard/weekly_report";
$route['progress-report'] = "dashboard/progress_report";
$route['student-list'] = "dashboard/student_list";


$route['teacher-update'] = "dashboard/teacher_update";
$route['profile'] = "dashboard/profile";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
