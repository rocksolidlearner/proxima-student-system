<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login/index';

$route['dashboard'] = "dashboard/index";
$route['change-password'] = "dashboard/change_password";
$route['profile'] = "dashboard/profile";
$route['teacher-assignments'] = "dashboard/assignments";
$route['download-form'] = "login/download_form";

$route['logout'] = "login/logout";

$route['stripePost']['post'] = "StripeController/stripePost";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
