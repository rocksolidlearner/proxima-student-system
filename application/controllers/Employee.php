<?php

class Employee extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of employees
     */
    function index()
    {
        $data['employees'] = $this->dashboard->get_all_employees(EMPLOYEE);
        
        $data['_view'] = 'employee/index';
        $this->load->view('layouts/main',$data);
    }
    /*
     * Adding a new employee
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('employee_name','Name','required');
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('phone','Phone','required');
		
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
                'role' => EMPLOYEE,
            );

            $employee_id = $this->admin->add_record('employees',$params);
            $this->session->set_flashdata('success', 'New Employee added successfully');
            redirect('employees');
        }
        else{
            
            $data['_view'] = 'employee/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a employee
     */
    function edit($t_id)
    {   
        $id = base64_decode(urldecode($t_id));
        // check if the employee exists before trying to edit it
        $data['employee'] = $this->admin->get_record('employees',$id);
        // echo "<pre>";print_r($data['employee']);exit();
        
        if(isset($data['employee']['id']))
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
            
                $this->session->set_flashdata('success', 'employee updated successfully.');           
                redirect('employees');
            }
            else
            {
                $data['_view'] = 'employee/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The employee you are trying to edit does not exist.');
    }

    function update_status($id,$status)
    {
        $params = array(
            'status' => $status,
        );
        $this->admin->update_record('employees',$id,$params);
        $this->session->set_flashdata('success', 'Updated Status successfu.');           
        redirect('employees');
    }

    function permission($id)
    {
        $params = array(
            'permission' => $_POST['status'],
        );
        $this->admin->update_record('employees',$id,$params);
    }
    /*
     * Deleting employee
     */
    function remove($id)
    {
        $employee = $this->admin->get_record('employees',$id);

        // check if the employee exists before trying to delete it
        if(isset($employee['id']))
        {
            $this->admin->delete_record('employees',$id);
            redirect('employees');
        }
        else
            show_error('The employee you are trying to delete does not exist.');
    }
    
}
