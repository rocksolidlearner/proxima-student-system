<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Timetable extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of subjects
     */
    function index()
    {
        $data['total_sifts'] = 'Total: '.$this->admin->get_all_record_count('tt_shifts');
        $data['shifts'] = $this->admin->get_all_records('tt_shifts');
        $data['shift_days'] = $this->dashboard->get_all_shifts();
        $data['classes'] = $this->admin->get_all_records('classes');
        $data['teachers'] = $this->admin->get_all_records('employees');
        $data['subjects'] = $this->admin->get_all_records('subjects');
        $data['timetables'] = $this->dashboard->get_all_timetables();
        // echo'<pre>';print_r($data['shift_days']);exit;
        $data['_view'] = 'timetable/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new shift
     */
    function add_shift()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('shift_name','Shift Name','required');
		
		if($this->form_validation->run())     
        {
            $params = array(
                'shift_name' => $this->input->post('shift_name'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
            );

            $subject_id = $this->admin->add_record('tt_shifts',$params);
            $this->session->set_flashdata('success', 'New Shift added successfully.');
            redirect('time-table');
        }else {
            $this->session->set_flashdata('error', 'please try again.');
            redirect('time-table');
        }
    } 
    
    function save_timetable()
    {   
        // echo"<pre>";print_r($_POST);exit;
        if(isset($_POST) && count($_POST) > 0)     
        {
            $params = array(
                'shift_id' => $this->input->post('shift_id'),
                'class_id' => $this->input->post('class_id'),
                'teacher_id' => $this->input->post('teacher_id'),
                'subject_id' => $this->input->post('subject_id'),
                'day' => $this->input->post('day')
            );

            $timetable_id = $this->admin->add_record('time_tables',$params);
            
        }
        // else {
            // $this->session->set_flashdata('error', 'please try again.');
            // redirect('time-table');
        // }
    } 

    /*
     * Editing a subject
     */
    function edit($s_id)
    {   
        $id = base64_decode(urldecode($s_id));
        // check if the subject exists before trying to edit it
        $data['subject'] = $this->admin->get_subject($id);
        
        if(isset($data['subject']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('subject_name','Subejct Name','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
                    'subject_name' => $this->input->post('subject_name'),
                    'short_name' => $this->input->post('short_name'),
                );

                $this->admin->update_subject($id,$params);            
                redirect('subject-manage');
            }
            else
            {

                $data['_view'] = 'subject/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The subject you are trying to edit does not exist.');
    } 

    /*
     * Deleting subject
     */
    function remove($id)
    {
        $record = $this->admin->get_record('time_tables',$id);

        // check if the subject exists before trying to delete it
        if(isset($record['id']))
        {
            $this->admin->delete_record('time_tables',$id);
        }
        else
            show_error('The time table you are trying to delete does not exist.');
    }

    function remove_shift($id)
    {
        $record = $this->admin->get_record('tt_shifts',$id);

        // check if the subject exists before trying to delete it
        if(isset($record['id']))
        {
            $this->admin->delete_record('tt_shifts',$id);
        }
        else
            show_error('The shift you are trying to delete does not exist.');
    }
    
}
