<?php

class Teacher extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of teachers
     */
    function index()
    {
        $data['teachers'] = $this->dashboard->get_all_employees(TEACHER);
        // echo'<pre>';print_r($data['teachers']);exit;
        $data['_view'] = 'teacher/index';
        $this->load->view('layouts/main',$data);
    }
    /*
     * Adding a new teacher
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('phone','phone','required');
        $this->form_validation->set_rules('employee_name','Name','required');
        $this->form_validation->set_rules('email','email','required');
        $this->form_validation->set_rules('date_joining','Date of joining','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'employee_name' => $this->input->post('employee_name'),
                'short_name' => $this->input->post('short_name'),
                'cnic' => $this->input->post('cnic'),
                'designation' => $this->input->post('designation'),
                'email' =>  $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'date_joining' => $this->input->post('date_joining'),
                'address' => $this->input->post('address'),
                'hour_salary' => $this->input->post('hour_salary'),
                'salary' => $this->input->post('salary'),
                'annual_salary' => $this->input->post('annual_salary'),
                'role' => TEACHER,
            );

            $teacher_id = $this->admin->add_record('employees',$params);
            $this->session->set_flashdata('success', 'New techer added successfully');
            redirect('teacher');
        }
        else{
            
            $data['_view'] = 'teacher/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    function edit_model($id)
    {
        $teacher = $this->admin->get_record('employees',$id);
        // check if the subject exists before trying to delete it
        if(isset($teacher['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Type Password</label>
                <input type="password" name="password" autofocus="true" placeholder="Type new passowrd" class="form-control">  
            </div>';
        }
    }

    function change_password()
    {
        $id = $this->input->post('id');
        $teacher = $this->admin->get_record('employees',$id);
        if(isset($teacher['id']))
        {
            $params = array(
                'password' => md5($this->input->post('password')),
            ); 
            $this->admin->update_record('employees',$id,$params);
            $this->session->set_flashdata('success', 'New Password set successfully.');            
            redirect('teacher');
        }
    }

    /*
     * Editing a teacher
     */
    function edit($t_id)
    {   
        $id = base64_decode(urldecode($t_id));
        // check if the teacher exists before trying to edit it
        $data['teacher'] = $this->admin->get_record('employees',$id);
        // echo "<pre>";print_r($data['teacher']);exit();
        
        if(isset($data['teacher']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('phone','phone','required');
            $this->form_validation->set_rules('employee_name','Name','required');
            $this->form_validation->set_rules('email','email','required');
            $this->form_validation->set_rules('date_joining','Date of joining','required');
		
			if($this->form_validation->run())     
            {
                $params = array(
					'employee_name' => $this->input->post('employee_name'),
                    'short_name' => $this->input->post('short_name'),
                    'cnic' => $this->input->post('cnic'),
                    'designation' => $this->input->post('designation'),
                    'email' =>  $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'date_joining' => $this->input->post('date_joining'),
                    'address' => $this->input->post('address'),
                    'hour_salary' => $this->input->post('hour_salary'),
                    'salary' => $this->input->post('salary'),
                    'annual_salary' => $this->input->post('annual_salary'),
                );

                $this->admin->update_record('employees',$id,$params);
                if($this->input->post('classes')){
                    $this->admin->delete_special_record('teacher_classes','teacher_id',$id);
                    foreach($this->input->post('classes') as $c){
                        $classes[]= array(
                            'teacher_id' => $id,
                            'class_id' => $c
                        );
                    }
                    $this->admin->add_batch_record('teacher_classes',$classes);
                }
            
                $this->session->set_flashdata('success', 'Teacher updated successfully.');           
                redirect('teacher');
            }
            else
            {
                $data['classes'] = $this->Class_model->get_all_classes();
                $data['tech_cls'] = $this->admin->get_all_records('teacher_classes');
                
                $data['_view'] = 'teacher/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The teacher you are trying to edit does not exist.');
    }

    function update_status($id,$status)
    {
        $params = array(
            'status' => $status,
        );
        $this->admin->update_record('employees',$id,$params);
        $this->session->set_flashdata('success', 'Updated Status successfu.');           
        redirect('teacher/index');
    }

    /*
     * Deleting teacher
     */
    function remove($id)
    {
        $teacher = $this->admin->get_record('employees',$id);

        // check if the teacher exists before trying to delete it
        if(isset($teacher['id']))
        {
            $this->admin->delete_record('employees',$id);
            redirect('teacher');
        }
        else
            show_error('The teacher you are trying to delete does not exist.');
    }
    
}
