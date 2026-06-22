<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Schedule extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of subjects
     */
    function index()
    {
        if (isset($_POST) && count($_POST) > 0) {
            if(isset($_POST['id'])){
                $params =array('status' => DELETED);
                $this->admin->update_record('schedule_subjects',$_POST['id'],$params);
                $this->session->set_flashdata('success', 'Schedule record deleted successfully.');
                redirect('test-schedules'); 
            }elseif(isset($_POST['schedule_id'])){
                $params =array(
                    'total_marks' => '',
                    'week' => '',
                    'passing_marks' => '',
                );
                $this->schedule->update_marks($_POST['schedule_id'],$params);
                $marks = $this->schedule->get_mark($_POST['schedule_id']);
                $paramss =array('marks' => '');
                $this->schedule->update_marksheet($marks['id'],$paramss);
                $this->session->set_flashdata('success', 'Mark sheet empty successfully.');
                redirect('test-schedules'); 
            }else{
                $data['from_date'] = $_POST['from_date'];
                $data['to_date'] = $_POST['to_date'];
                $data['schedules'] = $this->schedule->get_all_schedules($_POST['from_date'],$_POST['to_date'],$_POST['class_id']);
                $data['results'] = $this->admin->get_all_records('classes');
                // echo "<pre>";print_r($data['schedules']);exit;

                $data['_view'] = 'schedule/schedule_test';
                $this->load->view('layouts/main',$data);
            }
            
        }else{
            $data['results'] = $this->admin->get_all_records('classes');
            $data['schedules'] = $this->schedule->get_all_schedules();
            
            $data['_view'] = 'schedule/schedule_test';
            $this->load->view('layouts/main',$data);
        }
    }

    /* 
    * add schedule
    */
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('schedule_name','Schedule Name','required');
        
        if($this->form_validation->run())     
        {
            $params =array(
                'schedule_name' => $this->input->post('schedule_name'),
                'class_id' => $this->input->post('class_id'),
                'from_date' => $this->input->post('from_date'),
                'to_date' => $this->input->post('to_date'),
                'status' => ACTIVE
            );

            $schedule_id = $this->admin->add_record('schedules',$params);
            if($this->input->post('days')){
                foreach($_POST['days'] as $key => $v){
                    foreach($_POST['subject_id'] as $key1 => $v1){
                        foreach($_POST['teacher_id'] as $key2 => $v2){
                            if($key == $key1 && $key1 == $key2){
                                $paramss[] =array(
                                    'schedule_id' => $schedule_id,
                                    'day' => $v,
                                    'subject_id' => $v1,
                                    'teacher_id' => $v2
                                );
                            }
                        }
                    }
                }
            }
            $this->admin->add_batch_record('schedule_subjects',$paramss);
            $this->session->set_flashdata('success', 'New Schedule created successfully.');
            redirect('test-schedules'); 
        }else{
            $data['classes'] = $this->admin->get_all_records('classes');
            $data['subjects'] = $this->admin->get_all_records('subjects');
            $data['teachers'] = $this->admin->get_all_records('employees');
            
            $data['_view'] = 'schedule/add';
            $this->load->view('layouts/main',$data);
        }
    }

    function paid()
    {
        if (isset($_POST['download'])) {
            $std=$this->fee->get_student(null,PAID);
            $title = 'Paid Fee Student List';
            $pdf_file = 'paid_fee_student_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee(PAID);
            
            $data['_view'] = 'fee/paid';
            $this->load->view('layouts/main',$data);
        }
    }

    function generate_pdf($std,$title,$file)
    {
        $data['students'] = $std;
        $data['title'] = $title;

        $html_content = $this->load->view('fee/download_list', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    /*
     * Editing a fee
     */
    function marksheet($sid)
    {   
        $id = base64_decode(urldecode($sid));
        // check if the fee exists before trying to edit it
        $data['schedule'] = $this->schedule->get_schedule($id);
        // echo'<pre>';print_r($data['schedule']);exit;
        if(isset($data['schedule']['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('total_marks','Total Marks','required');
            $this->form_validation->set_rules('passing_marks','Passing Marks','required');
            
            if($this->form_validation->run())     
            {
                $params = array(
                    'schedule_subject_id' => $id,
                    'total_marks' => $this->input->post('total_marks'),
                    'week' => $this->input->post('week'),
                    'passing_marks' => $this->input->post('passing_marks'),
                );
                // echo'<pre>';print_r($params);
                // echo'<br><pre>';print_r($_POST);exit;
                $marks_id = $this->admin->add_record('marks',$params);
                if($this->input->post('marks')){
                    foreach($_POST['marks'] as $key => $v){
                        foreach($_POST['std'] as $key1 => $v1){
                            if($key == $key1){
                                $paramss[] =array(
                                    'marks_id' => $marks_id,
                                    'student_id' => $v1,
                                    'marks' => $v,
                                );
                            }
                        }
                    }
                }
                $this->admin->add_batch_record('marks_std',$paramss);
                if($this->input->post('marks2')){
                    foreach($_POST['marks2'] as $key => $v){
                        foreach($_POST['std2'] as $key1 => $v1){
                            if($key == $key1){
                                $paramss2[] =array(
                                    'marks_id' => $marks_id,
                                    'student_id' => $v1,
                                    'marks' => $v,
                                );
                            }
                        }
                    }
                }
                $this->admin->add_batch_record('marks_std',$paramss2);
                $this->session->set_flashdata('success', 'Marksheet updated successfully.'); 
                redirect('test-schedules');
            }else{
                $data['_view'] = 'schedule/marksheet';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The test schedule you are trying to edit does not exist.');
    } 

    function print_fee($id){
        $pdf_file = 'Receipt-'.$id.'_'.date('d-M-Y');
        $this->print_pdf($id,$pdf_file,null);
        $this->load->helper('download');
        $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
        $name = $pdf_file. ".pdf";
        force_download($name, $data);
    }

    function print_pdf($id,$file,$history=null)
    {
        $data['fee'] = $this->fee->get_fee($id);
        $data['title'] = 'Fee Receipt';
        $data['total'] = $data['fee'] ['fine']+$data['std'] ['amount'];
        if($history){
            $data['history'] = $history;
        }else{
            $data['history'] = '';
        }

        $html_content = $this->load->view('fee/print', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    /*
     * Deleting subject
     */
    function remove($id)
    {
        $fee = $this->admin->get_record('fee',$id);

        // check if the subject exists before trying to delete it
        if(isset($fee['id']))
        {
            $params = array(
                'status' => DELETED,
                'deleted_by' => $this->session->userdata('id')
            );
            $this->admin->update_record('fee',$id,$params);
            echo'Fee deleted successfully.';
            // redirect('fee-collect');
        }
        else
            // show_error('The fee you are trying to delete does not exist.');
            echo'The fee you are trying to delete does not exist.';
    }
    
}
