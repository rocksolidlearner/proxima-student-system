<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login/index';

$route['dashboard'] = "dashboard/index";

$route['weekly-report'] = "dashboard/weekly_report";
$route['progress-report'] = "dashboard/progress_report";

$route['profile'] = "dashboard/profile";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
