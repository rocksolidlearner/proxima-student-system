<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends Admin_Controller{
    function __construct()
    {
        parent::__construct(); 
    } 

    /*
     * Listing of course
     */
    function index()
    {

        $data['courses'] = $this->admin->get_all_records('courses');

        $data['_view'] = 'course/index';
        $this->load->view('layouts/main',$data);
    }  

    /*
     * Adding a new class
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('course_name','Course Name','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'course_name' => $this->input->post('course_name'),
                'description' => $this->input->post('description'),
            );

            $course_id = $this->admin->add_record('courses',$params);
            $config['upload_path'] = 'uploads/course_files';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|txt|ppt|zip|xlsx|csv';
            $this->load->library('upload',$config);
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                $this->upload->initialize($config);
                $this->upload->do_upload();
                $upload_data = $this->upload->data();
                $paramsf[]=array(
                    'course_id' => $course_id,
                    'uploaded_file'=> $upload_data['file_name']);
            }
            $this->admin->add_batch_record('course_files',$paramsf);
            if($this->input->post('classes')){
                foreach($this->input->post('classes') as $c){
                    $classes[]= array(
                        'course_id' => $course_id,
                        'class_id' => $c
                    );
                }
                $this->admin->add_batch_record('course_classes',$classes);
            }
            if($this->input->post('subjects')){
                foreach($this->input->post('subjects') as $s){
                    $subjects[]= array(
                        'course_id' => $course_id,
                        'subject_id' => $s
                    );
                }
                $this->admin->add_batch_record('course_subjects',$subjects);
            }
            $this->session->set_flashdata('success', 'New Course added successfully.'); 
            redirect('course-manage');
        }
        else
        {            
            $data['classes'] = $this->admin->get_all_records('classes');
            $data['subjects'] = $this->admin->get_all_records('subjects');

            $data['_view'] = 'course/add';
            $this->load->view('layouts/main',$data);
        }
    } 

    /*
     * Editing a batch
     */
    function edit($c_id)
    {   
        $id = base64_decode(urldecode($c_id));
        // check if the batch exists before trying to edit it
        $data['course'] = $this->admin->get_record('courses',$id);
        $data['c_class'] = $this->dashboard->get_course_data('course_classes',$id);
        $data['c_subject'] = $this->dashboard->get_course_data('course_subjects',$id);
        
        if(isset($data['course']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('course_name','Course Name','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
                    'course_name' => $this->input->post('course_name'),
                    'description' => $this->input->post('description'),
                );

                $this->admin->update_record('courses',$id,$params);
                $config['upload_path'] = 'uploads/course_files';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|txt|ppt|zip|xlsx|csv';
                $this->load->library('upload',$config);
                if($_FILES['userfile']['name']){
                    $this->dashboard->delete_course_data($id);
                    $files = $_FILES;
                    $cpt = count($_FILES['userfile']['name']);
                    for($i=0; $i<$cpt; $i++)
                    {           
                        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                        $this->upload->initialize($config);
                        $this->upload->do_upload();
                        $upload_data = $this->upload->data();
                        $paramsf[]=array(
                            'course_id' => $course_id,
                            'uploaded_file'=> $upload_data['file_name']);
                    }
                    $this->admin->add_batch_record('course_files',$paramsf);
                }
                if($this->input->post('classes')){
                    $this->dashboard->delete_course_data('course_classes',$id);
                    foreach($this->input->post('classes') as $c){
                        $classes[]= array(
                            'course_id' => $id,
                            'class_id' => $c
                        );
                    }
                    $this->admin->add_batch_record('course_classes',$classes);
                }
                if($this->input->post('subjects')){
                    $this->dashboard->delete_course_data('course_subjects',$id);
                    foreach($this->input->post('subjects') as $s){
                        $subjects[]= array(
                            'course_id' => $id,
                            'subject_id' => $s
                        );
                    }
                    $this->admin->add_batch_record('course_subjects',$subjects);
                } 
                $this->session->set_flashdata('success', 'Course updated successfully.');            
                redirect('course-manage');
            }
            else
            {
                $data['classes'] = $this->admin->get_all_records('classes');
                $data['subjects'] = $this->admin->get_all_records('subjects');

                $data['_view'] = 'course/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The course you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $course = $this->admin->get_record('courses',$id);

        // check if the batch exists before trying to delete it
        if(isset($course['id']))
        {
            $params = array('status' => DELETED);
            $this->admin->update_record('courses',$id,$params);
            // $this->admin->delete_record($id);
            redirect('course-manage');
        }
        else
            show_error('The course you are trying to delete does not exist.');
    }
    
}
