<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends Admin_Controller{
    function __construct()
    {
        parent::__construct(); 
    } 

    /*
     * Listing of project
     */
    function index()
    {
        $data['projects'] = $this->dashboard->get_all_projects();
        
        $data['_view'] = 'project/index';
        $this->load->view('layouts/main',$data);
    }  

    /*
     * Adding a new class
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('project_name','project Name','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'project_name' => $this->input->post('project_name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'description' => $this->input->post('description'),
                'type' => $this->input->post('type'),
                'status' => $this->input->post('status'),
            );

            $project_id = $this->admin->add_record('projects',$params);
           
            $this->session->set_flashdata('success', 'New project added successfully.'); 
            redirect('project-manage');
        }
        else
        {            
            $data['_view'] = 'project/add';
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
        $data['project'] = $this->admin->get_record('projects',$id);
        // print_r($data['project']);exit;
        if(isset($data['project']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('project_name','project Name','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
                    'project_name' => $this->input->post('project_name'),
                    'description' => $this->input->post('description'),
                    'type' => $this->input->post('type'),
                    'status' => $this->input->post('status'),
                );
                if($this->input->post('start_date')){
                    $params['start_date'] = $this->input->post('start_date');
                }
                if($this->input->post('end_date')){
                    $params['end_date'] = $this->input->post('end_date');
                }

                $this->admin->update_record('projects',$id,$params);
                 
                $this->session->set_flashdata('success', 'Project updated successfully.');            
                redirect('project-manage');
            }
            else
            {
                $data['_view'] = 'project/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The project you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $project = $this->admin->get_record('projects',$id);

        // check if the batch exists before trying to delete it
        if(isset($project['id']))
        {
            $params = array('status' => DELETED);
            $this->admin->update_record('projects',$id,$params);
            // $this->admin->delete_record($id);
            redirect('project-manage');
        }
        else
            show_error('The project you are trying to delete does not exist.');
    }
    
}
