<?php
/**
 * Created by PhpStorm.
 * User: chusa
 * Date: 5/2/2019
 * Time: 5:47 PM
 */

class Admin_Controller extends CI_Controller {

    var $data;
    public function __construct() {
        parent::__construct();
            $this->load->model('Admin_model','admin');
            $this->load->model('Student_model','student');
            $this->load->model('Student_model','parent');
            $this->load->model('Setting_model','setting');
            $this->load->model('Fee_model','fee');
            $this->load->model('Account_model','account');
            $this->load->model('Schedule_model','schedule');
            $this->load->model('Dashboard_model','dashboard');
            $this->load->model('Attendance_model','attendance');
            $this->load->model('Batch_model','batch');
            $this->load->model('Class_model');
            $this->load->model('Subject_model');
            $this->load->model('User_model','user');
    
        if(!$this->session->userdata("role")){
            redirect('login');
        }
        $this->data['user'] = $this->admin->get_record('users',$this->session->userdata('id'));
        $this->data['deleted_stds'] = count($this->student->get_all_students(DELETED));
        // if ($_SESSION['token'] != $this->data['user']['token']) {
        //      redirect('login/logout');
        // }
        $this->data['setting'] = $this->setting->get_setting('setting_page',ACTIVE);
        $this->data['sms_setting'] = $this->setting->get_setting('setting_sms',ACTIVE);
        $this->data['permits'] = explode(',',$this->session->userdata('permissions'));
        
        $date = new DateTime("now", new DateTimeZone('Asia/Karachi') );
        $current_date = $date->format('m/d/Y');

        $this->data['collect_fee'] = $this->fee->get_all_fee_count(COLLECT);
        $this->data['defaulter_fee'] = $this->fee->get_all_fee_count(DEFAULTER);

        $fee = $this->admin->get_all_records('fee');

        foreach($fee as $f){
            if($f['last_date'] < date('Y-m-d') && $f['status'] != PAID){
                $params = array('status' => DEFAULTER);
                $this->admin->update_record('fee',$f['id'],$params);
            }
        }

        $employee = $this->admin->get_all_records('employees');

        foreach($employee as $emp){
            if($emp['role']==TEACHER){
                if(empty($this->account->get_salary($emp['id']))){
                    $params = array(
                        'employee_id' => $emp['id'],
                        'salary_month' => date('Y-m-d')
                    );
                    $salary_id = $this->admin->add_record('salaries',$params);
                }
            }
        }
        
    }
}