<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
class Dashboard extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contacts_model', 'contacts');
    }

    function index()
    {
        $data['tot_stds'] = $this->admin->get_all_record_count('students');
        $data['expense'] = $this->dashboard->get_total_expenses();
        $data['fee'] = $this->dashboard->get_total_fee();
        $data['profit'] = number_format($data['fee']['total_fee']-$data['expense']['total_expenses'],2);
        $data['crm_summary'] = $this->contacts->get_summary();
        $data['recent_contacts'] = $this->contacts->get_recent_contacts(8);
        $data['_view'] = 'dashboard';
        $this->load->view('layouts/main',$data);
    }

    function attendance_register()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $data['attendance_date'] = $_POST['date'];
            $data['students'] = $this->dashboard->get_student($_POST['class_id']);
            $data['results'] = $this->dashboard->get_all_classes();
            $data['_view'] = 'attendance/register';
            $this->load->view('layouts/main',$data);
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'attendance/register';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function save_attendance()
    {
        if (isset($_POST) && count($_POST) > 0) {
            // echo'<pre>';print_r($_POST);exit;
            foreach ($_POST['attendance'] as $key => $at){
                date_default_timezone_set('Asia/Karachi');
                $date = date('Y-m-d',strtotime($_POST['day']));
                $month = date('m',strtotime($_POST['day']));
                $exist_data = $this->attendance->get_exist_attendance($key,$month);
                
                if (empty($exist_data)){
                    $params = array(
                        'student_id' => $key,
                        'date_created' => $date,
                    );
                    $attend_id = $this->attendance->add_attendance($params);
                    $day = $_POST['day'];
                    if (date('D') == 'Sun'){
                        $days = array(
                            'attend_id' => $attend_id,
                            'day' => $day,
                            'status' => 'H',
                        );
                    }else{
                        $days = array(
                            'attend_id' => $attend_id,
                            'day' => $day,
                            'status' => $at,
                        );
                    }
                    $this->attendance->add_day($days);
                    echo 'Your attendance mark';
                }else{
                    $day =  $_POST['day'];
                    $exist_day= $this->attendance->get_exist_day($exist_data['id'],$day);
                    if (empty($exist_day)){
                        if (date('D',strtotime($_POST['day'])) == 'Sun'){
                            $days = array(
                                'attend_id' => $exist_data['id'],
                                'day' => $day,
                                'status' => 'H',
                            );
                        }else{
                            $days = array(
                                'attend_id' => $exist_data['id'],
                                'day' => $day,
                                'status' => $at,
                            );
                        }
                        $this->attendance->add_day($days);
                        echo 'Your attendance mark';
                    }else{
                        echo 'Today your attendance already mark';
                    }

                }
            }
        }
    }

    function attendance_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['attendance_date'] = $_POST['date'];
            $data['students'] = $this->dashboard->get_attendance_report($_POST['date'],$_POST['attend_status'],$_POST['class_id']);
            $data['results'] = $this->dashboard->get_all_classes();
            // echo "<pre>";print_r($data['students']);exit;
            $data['_view'] = 'attendance/report';
            $this->load->view('layouts/main',$data);
        }if (isset($_POST['absent']) && count($_POST) > 0) {
            $data['attendance_date'] = $_POST['date'];
            $data['students'] = $this->dashboard->get_attendance_report($_POST['date'],'A',$_POST['class_id']);
            $data['results'] = $this->dashboard->get_all_classes();
            // echo "<pre>";print_r($data['students']);exit;
            $data['_view'] = 'attendance/report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $stds = $this->dashboard->get_attendance_report($_POST['date'],$_POST['attend_status'],$_POST['class_id']);
            $title = 'Student Attendance Report';
            $month = date('m',strtotime($_POST['from_date']));
            
            $pdf_file = 'student_attendance_report_'.date('d-M-Y');
            $this->generate_pdf($stds,$title,$pdf_file,'Yes');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'attendance/report';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function attendance_sheet()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['class'] = $this->Class_model->get_class($_POST['class_id']);
            $data['from_date'] = $_POST['from_date'];
            $data['to_date'] = $_POST['to_date'];
            $data['students'] = $this->dashboard->get_attendance_report($_POST['from_date'],null,$_POST['class_id'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_classes();
            $data['month'] = strtotime($_POST['from_date']);
            $data['month1'] = strtotime($_POST['from_date']);
            $data['month2'] = strtotime($_POST['from_date']);
            $last_date = date("m/t/Y", strtotime($_POST['from_date']));
            $data['end'] = strtotime($_POST['to_date']);
            $data['end1'] = strtotime($_POST['to_date']);
            $data['end2'] = strtotime($_POST['to_date']);
            $now = time(); // or your date as well
            $your_date = strtotime($_POST['from_date']);
            $datediff = $now - $your_date;
            $data['days'] = round($datediff / (60 * 60 * 24));

            // echo "<pre>";print_r($data['students']);exit;

            $data['_view'] = 'attendance/sheet';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $stds = $this->dashboard->get_attendance_report($_POST['from_date'],null,$_POST['class_id'],$_POST['to_date']);
            $title = 'Student Attendance Sheet';
            $month = date('m',strtotime($_POST['from_date']));
            
            $pdf_file = 'student_attendance_sheet_'.date('d-M-Y');
            $this->generate_pdf($stds,$title,$pdf_file,'Yes');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'attendance/sheet';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function weekly_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $data['students'] = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_student();
            $data['_view'] = 'reports/weekly';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $stds = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $title = 'Student Weekly Report';
            $pdf_file = 'student_weekly_report_'.date('d-M-Y-h-m');
            $this->generate_pdf($stds,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_student();
            
            $data['_view'] = 'reports/weekly';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function progress_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $data['students'] = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_student();
            $data['_view'] = 'reports/progress';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $stds = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $title = 'Student Progress Report';
            $pdf_file = 'student_progress_report_'.date('d-M-Y-h-m');
            $this->generate_pdf($stds,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_student();
            $data['_view'] = 'reports/progress';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function student_list()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['students'] = $this->dashboard->get_student($_POST['class_id']);
            $data['results'] = $this->dashboard->get_all_classes();
            $data['_view'] = 'reports/student_list';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $stds = $this->dashboard->get_student($_POST['class_id'],$_POST['from_date'],$_POST['to_date']);
            $title = 'Student List Report';
            $pdf_file = 'student_list_report_'.date('d-M-Y-h-m');
            $this->generate_pdf($stds,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'reports/student_list';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function topper_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            // echo'<pre>';print_r($data['marks']);exit;
            $data['results'] = $this->admin->get_all_records('classes');

            $data['_view'] = 'reports/topper_report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            $data['title'] = 'Toppers Report <br>'.$_POST['from_date'].' to '.$_POST['to_date'];
            $pdf_file = 'topper_report_'.date('d-M-Y-h-m');
            
            $html_content = $this->load->view('reports/download_topper', $data,true);
            
            $this->pdf->create($html_content, $pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->admin->get_all_records('classes');
            
            $data['_view'] = 'reports/topper_report';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function weekly_evaluation()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            $data['results'] = $this->admin->get_all_records('classes');
            $data['_view'] = 'reports/weekly_evaluation';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->admin->get_record('classes',$_POST['class_id']);
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            $data['title'] = 'Weekly Evaluation Report <br>Week: - <br>
            Class: '.$class['class_name'].' '.$_POST['from_date'].' to '.$_POST['to_date'];
            $pdf_file = 'weekly_evaluation_report_'.date('d-M-Y-h-m');
            
            $html_content = $this->load->view('reports/download_weekly', $data,true);
            
            $this->pdf->create($html_content, $pdf_file);
            // $this->generate_weekly_pdf($stds,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->admin->get_all_records('classes');
            
            $data['_view'] = 'reports/weekly_evaluation';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function teacher_evaluation()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            $data['results'] = $this->admin->get_all_records('classes');
            $data['subjects'] = $this->admin->get_all_records('subjects');

            $data['_view'] = 'reports/teacher_evaluation';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->admin->get_record('classes',$_POST['class_id']);
            $subject = $this->admin->get_record('subjects',$_POST['subject_id']);
            $data['marks'] = $this->schedule->get_topper_report($_POST);
            $data['title'] = 'Teacher Evaluation Report <br>Teacher: - <br>
            Subject: '.$subject['subject_name'].' - Class: '.$class['class_name'].' <br>
            Dates from '.$_POST['from_date'].' to '.$_POST['to_date'];
            $pdf_file = 'teacher_evaluation_report_'.date('d-M-Y-h-m');
            
            $html_content = $this->load->view('reports/download_weekly', $data,true);
            
            $this->pdf->create($html_content, $pdf_file);
            // $this->generate_weekly_pdf($stds,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->admin->get_all_records('classes');
            $data['subjects'] = $this->admin->get_all_records('subjects');
            
            $data['_view'] = 'reports/teacher_evaluation';
            $this->load->view('layouts/main',$data); 
        }           
    }
    
    function generate_pdf($std,$title,$pdf_file,$attendance=null)
    { 
        $data['students'] = $std;
      
        $data['title'] = $title;
        if ($attendance) {
            $html_content = $this->load->view('attendance/download_list', $data,true);
        }else{
            $html_content = $this->load->view('reports/download_list', $data,true);
        }
        $this->pdf->create($html_content, $pdf_file);
    }
    
}
