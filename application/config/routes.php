<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';

$route['time-table'] = 'timetable/index';
$route['time-table'] = 'timetable/index';
$route['shift-add'] = 'timetable/add_shift';
$route['shift-remove/(:any)'] = 'timetable/remove_shift/$1';

$route['attendance-register'] = "dashboard/attendance_register";
$route['attendance-report'] = "dashboard/attendance_report";
$route['attendance-sheet'] = "dashboard/attendance_sheet";

$route['fee-collect'] = 'fee/index';
$route['fee-defaulters'] = 'fee/defaulters';
$route['fee-paid'] = 'fee/paid';
$route['fee-defaulter-report'] = 'fee/defaulter_report';
$route['fee-edit'] = 'fee/edit';
$route['fee-print/(:any)'] = 'fee/print_fee/$1';
$route['fee-printt/(:any)'] = 'fee/printt_fee/$1';
$route['fee-remove/(:any)'] = 'fee/remove/$1';

$route['student'] = 'student/index';
$route['deleted-student'] = 'student/deleted_std';
$route['download-student'] = 'student/download';
$route['admission'] = 'student/add';
$route['student-profile/(:any)'] = 'student/profile/$1';
$route['student-portfolio-add/(:any)'] = 'student/add_portfolio/$1';
$route['student-portfolio-edit/(:any)/(:num)'] = 'student/edit_portfolio/$1/$2';
$route['student-portfolio-download/(:any)/(:num)'] = 'student/portfolio_download/$1/$2';
$route['student-portfolio-remove/(:any)/(:num)'] = 'student/portfolio_remove/$1/$2';
$route['student-portfolio-export/(:any)'] = 'student/portfolio_export/$1';
$route['student-payfee/(:any)'] = 'student/payfee/$1';
$route['student-payhistory/(:any)'] = 'student/pay_history/$1';
$route['student-edit/(:any)'] = 'student/edit/$1';
$route['update-class'] = 'student/update_class';
$route['send-sms'] = 'student/sendSMS';
$route['send-email'] = 'student/send_email';
$route['student-remove/(:any)'] = 'student/remove/$1';
$route['student-restore/(:any)'] = 'student/update_status/$1';
$route['student-import'] = 'student/import';
$route['student-export'] = 'student/export';
$route['classes-export'] = 'student/export_class';

$route['account-daily-expenses'] = 'account/index';
$route['account-teacher-salary'] = 'account/salary';
$route['student-payment-report'] = 'account/student_payment';
$route['payment-report'] = 'account/payment_report';
$route['accounts-transactions'] = 'account/transection';
$route['cash-report'] = 'account/cash_report';
$route['expense-report'] = 'account/expense_report';
$route['expense-edit'] = 'account/edit';
$route['account-print/(:any)'] = 'account/print_fee/$1';
$route['account-printt/(:any)'] = 'account/printt_fee/$1';
$route['account-remove/(:any)'] = 'account/remove/$1';

$route['test-schedules'] = 'schedule/index';
$route['schedule-add'] = 'schedule/add';
$route['mark-sheet/(:any)'] = 'schedule/marksheet/$1';
$route['schedule-remove/(:any)'] = 'schedule/remove/$1';

$route['weekly-report'] = "dashboard/weekly_report";
$route['progress-report'] = "dashboard/progress_report";
$route['student-list'] = "dashboard/student_list";
$route['topper-report'] = "dashboard/topper_report";
$route['weekly-evaluation'] = "dashboard/weekly_evaluation";
$route['teacher-evaluation'] = "dashboard/teacher_evaluation";

$route['teacher'] = 'teacher/index';
$route['teacher-add'] = 'teacher/add';
$route['teacher-password'] = 'teacher/change_password';
$route['teacher-edit/(:any)'] = 'teacher/edit/$1';
$route['teacher-remove/(:any)'] = 'teacher/remove/$1';

$route['employees'] = 'employee/index';
$route['employee-add'] = 'employee/add';
$route['employee-edit/(:any)'] = 'employee/edit/$1';
$route['employee-remove/(:any)'] = 'employee/remove/$1';

$route['library-books'] = 'library/index';
$route['library-assign-books'] = 'library/assign';
$route['book-edit'] = 'library/edit';
$route['book-remove/(:any)'] = 'library/remove/$1';

$route['user-manage'] = 'users/index';
$route['user-add'] = 'users/add';
$route['user-edit/(:any)'] = 'users/edit/$1';
$route['user-remove/(:any)'] = 'users/remove/$1';

$route['schedule'] = 'calendar/index';

$route['parents'] = 'parents/index';
$route['parent-password'] = 'parents/change_password';
$route['parent-edit/(:any)'] = 'parents/edit/$1';

$route['course-manage'] = 'course/index';
$route['course-add'] = 'course/add';
$route['course-edit/(:any)'] = 'course/edit/$1';
$route['course-remove/(:any)'] = 'course/remove/$1';

$route['subject-manage'] = 'subject/index';
$route['subject-add'] = 'subject/add';
$route['subject-edit/(:any)'] = 'subject/edit/$1';
$route['subject-remove/(:any)'] = 'subject/remove/$1';

$route['batches-manage'] = 'batch/index';
$route['batch-add'] = 'batch/add';
$route['batch-edit/(:any)'] = 'batch/edit/$1';
$route['batch-remove/(:any)'] = 'batch/remove/$1';

$route['class-manage'] = 'classes/index';
$route['class-add'] = 'classes/add';
$route['class-edit/(:any)'] = 'classes/edit/$1';
$route['class-remove/(:any)'] = 'classes/remove/$1';

$route['billing-manage'] = 'billing/index';
$route['view-detail/(:any)'] = 'billing/view/$1';

$route['document-manage'] = 'document/index';
$route['document-add'] = 'document/add';
$route['document-edit/(:any)'] = 'document/edit/$1';
$route['document-remove/(:any)'] = 'document/remove/$1';
$route['document-download/(:any)'] = 'document/download/$1';

$route['app-setting'] = 'setting/index';
$route['history'] = 'setting/history';
$route['account-setting'] = 'setting/account';
$route['account-setting-edit'] = 'setting/account_edit';
$route['account-setting-remove/(:any)'] = 'setting/account_remove/$1';
$route['fee-setting'] = 'setting/fee';
$route['fine'] = 'setting/fine';
$route['fine-edit'] = 'setting/fine_edit';
$route['fine-remove/(:any)'] = 'setting/fine_remove/$1';
$route['cal-setting'] = 'setting/calendar';
$route['sms-setting'] = 'setting/sms';
$route['custom-style'] = 'setting/custom_style';

// Extra modules
$route['project-manage'] = 'project/index';
$route['project-add'] = 'project/add';
$route['project-edit/(:any)'] = 'project/edit/$1';
$route['project-remove/(:any)'] = 'project/remove/$1';

$route['call-log'] = 'contacts/index';
$route['contact-add'] = 'contacts/add';
$route['contact-edit/(:any)'] = 'contacts/edit/$1';
$route['contact-remove/(:any)'] = 'contacts/remove/$1';
$route['contact-send-sms'] = 'contacts/sendSMS';
$route['contact-send-email'] = 'contacts/send_email';
// end

$route['report-bug'] = 'help/report_bug';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
