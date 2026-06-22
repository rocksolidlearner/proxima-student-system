<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */
 
class Dashboard extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model','dashboard');
        $this->load->model('Attendance_model');
        $this->load->library('pdf');
    }

    function index()
    {
        $data['_view'] = 'index';
        $this->load->view('layouts/main',$data);
    }

    function student_view()
    {
        $data['results'] = $this->dashboard->get_all_students();
        // echo "<pre>";print_r($data['results']);exit();
        $data['_view'] = 'student_view';
        $this->load->view('layouts/main',$data);            
    }

    function assignments($id)
    {
        $data['class'] = $this->dashboard->get_class($id);
        $data['results'] = $this->dashboard->get_all_assignments($id);
        $data['_view'] = 'assignments';
        $this->load->view('layouts/main',$data);            
    }

    function material()
    {
        $data['results'] = $this->dashboard->get_all_notes();

        $data['_view'] = 'material';
        $this->load->view('layouts/main',$data);            
    }

    function lecture()
    {
        $data['results'] = $this->dashboard->get_all_lectures();

        $data['_view'] = 'weekly_lecture';
        $this->load->view('layouts/main',$data);            
    }

    function notes()
    {
        $data['results'] = $this->dashboard->get_all_notes();
        
        $data['_view'] = 'teacher_notes';
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
            foreach ($_POST['attendance'] as $key => $at){
                date_default_timezone_set('Asia/Karachi');
                $date = date('Y-m-d',strtotime($_POST['day']));
                $month = date('m',strtotime($_POST['day']));
                $exist_data = $this->Attendance_model->get_exist_attendance($key,$month);
                
                if (empty($exist_data)){
                    $params = array(
                        'student_id' => $key,
                        'date_created' => $date,
                    );
                    $attend_id = $this->Attendance_model->add_attendance($params);
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
                    $this->Attendance_model->add_day($days);
                    echo 'Your attendance mark';
                }else{
                    $day =  $_POST['day'];
                    $exist_day= $this->Attendance_model->get_exist_day($exist_data['id'],$day);
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
                        $this->Attendance_model->add_day($days);
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
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $title = 'Student Attendance Report';
            $month = date('m',strtotime($_POST['date']));
            $this->generate_pdf($_POST['class_id'],$title,$_POST['date'],null,$_POST['attend_status'],'Yes');
            $_SESSION['pdf_file'] = 'student_attendance_report_'.date('d-M-Y');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
            force_download($name, $data);
            $_SESSION['pdf_file'] = '';
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'attendance/report';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function attendance_sheet()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['class'] = $this->dashboard->get_class($_POST['class_id']);
            $data['from_date'] = $_POST['from_date'];
            $data['to_date'] = $_POST['to_date'];
            $data['students'] = $this->dashboard->get_attendance_report($_POST['from_date'],null,$_POST['class_id'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_classes();
            $data['month'] = strtotime($_POST['from_date']);
            $data['month1'] = strtotime($_POST['from_date']);
            $last_date = date("m/t/Y", strtotime($_POST['from_date']));
            $data['end'] = strtotime($_POST['to_date']);
            $data['end1'] = strtotime($_POST['to_date']);
            $now = time(); // or your date as well
            $your_date = strtotime($_POST['from_date']);
            $datediff = $now - $your_date;
            $data['days'] = round($datediff / (60 * 60 * 24));

            // echo "<pre>";print_r($data['students']);exit;

            $data['_view'] = 'attendance/sheet';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $title = 'Student Attendance Report';
            $month = date('m',strtotime($_POST['date']));
            $this->generate_pdf($_POST['class_id'],$title,$_POST['date'],null,$_POST['attend_status'],'Yes');
            $_SESSION['pdf_file'] = 'student_attendance_report_'.date('d-M-Y');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
            force_download($name, $data);
            $_SESSION['pdf_file'] = '';
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
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $title = 'Student Weekly Report';
            $this->generate_pdf($class['cid'],$title,$_POST['from_date'],$_POST['to_date']);
            $_SESSION['pdf_file'] = 'student_weekly_report_'.date('d-M-Y-h-m');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
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
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $title = 'Student Progress Report';
            $this->generate_pdf($class['cid'],$title,$_POST['from_date'],$_POST['to_date']);
            $_SESSION['pdf_file'] = 'student_progress_report_'.date('d-M-Y-h-m');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
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
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $title = 'Student List Report';
            $this->generate_pdf($_POST['class_id'],$title);
            $_SESSION['pdf_file'] = 'student_list_report_'.date('d-M-Y-h-m');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_classes();
            
            $data['_view'] = 'reports/student_list';
            $this->load->view('layouts/main',$data); 
        }           
    }
    
    function generate_pdf($id,$title,$fdate=null,$tdate=null,$status=null,$attendance=null)
    {
        if ($fdate && $tdate) {
            $data['students'] = $this->dashboard->get_student($id,$fdate,$tdate);
        }elseif(empty($attendance)){
            $data['students'] = $this->dashboard->get_student($id);
        }
        $data['title'] = $title;
        if ($attendance) {
            $data['students'] = $this->dashboard->get_attendance_report($fdate,$status,$id);
            $html_content = $this->load->view('attendance/download_list', $data,true);
        }else{
            $html_content = $this->load->view('reports/download_list', $data,true);
        }
        $this->pdf->create($html_content, $_SESSION['pdf_file']);
    }

    function teacher_update()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('phone','phone','required');
        $this->form_validation->set_rules('employee_name','Name','required');
        $this->form_validation->set_rules('email','email','required');
    
        if($this->form_validation->run())     
        {
            $params = array(
                'employee_name' => $this->input->post('employee_name'),
                'short_name' => $this->input->post('short_name'),
                'email' =>  $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
            );
            if ($this->input->post('date_joining')) {
                $params['date_joining'] = $this->input->post('date_joining');
            }
            $this->dashboard->update_teacher($params);
        
            $this->session->set_flashdata('success', 'Teacher updated successfully.');
            redirect('profile');
        }else{
            redirect('profile'); 
        }
            
    }

    function profile()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('cpassword','Current Password','required');
        $this->form_validation->set_rules('newpassword','New Password','required');
        $this->form_validation->set_rules('againpassword','New Password again','required');
        
        if($this->form_validation->run())     
        {   
            if ($this->session->userdata('password') != md5($_POST['cpassword'])) {
               $this->session->set_flashdata('info', 'Current Password is not correct.');
                redirect('profile');
            }else{
                if ($_POST['newpassword'] != $_POST['againpassword']) {
                    $this->session->set_flashdata('info', 'Agin Password is not matched.');
                    redirect('profile');
                }else{
                    $params = array(
                        'password' => md5($this->input->post('againpassword')),
                    );
                    
                    $pass_id = $this->dashboard->update_account($params);
                    $this->session->set_flashdata('success', 'Password updated successfully.');
                    redirect('profile');
                }
            }
                
        }else{
            $data['teacher'] = $this->dashboard->get_teacher();
            $data['_view'] = 'profile';
            $this->load->view('layouts/main',$data);   
        }
    }

}
