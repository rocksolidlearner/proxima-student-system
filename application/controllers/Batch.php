<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of batches
     */
    function index()
    {
        $data['batches'] = $this->batch->get_all_batches();
        // echo'<pre>';print_r($data['batches']);exit;
        
        $data['_view'] = 'batch/index';
        $this->load->view('layouts/main',$data);
    }
    
    /*
     * Adding a new batch
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('batch_name','Batch Name','required');
        $this->form_validation->set_rules('start_date','Start Date','required');
        $this->form_validation->set_rules('end_date','End Date','required');
        $this->form_validation->set_rules('status','Status','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'batch_name' => $this->input->post('batch_name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'status' => $this->input->post('status'),
            );
            
            $batch_id = $this->admin->add_record('batches',$params);
            $this->session->set_flashdata('success', 'New batch added successfully.'); 
            redirect('batches-manage');
        }
        else
        {            
            redirect('batches-manage');
        }
    }  

    /*
     * Editing a batch
     */
    function edit($c_id)
    {   
        $id = base64_decode(urldecode($c_id));
        // check if the batch exists before trying to edit it
        $data['batch'] = $this->admin->get_record('batches',$id);
        
        if(isset($data['batch']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('batch_name','Batch Name','required');
            $this->form_validation->set_rules('status','Status','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'batch_name' => $this->input->post('batch_name'),
                    'status' => $this->input->post('status'),
                );
                if ($this->input->post('start_date')) {
                    $params['start_date'] = $this->input->post('start_date');
                }
                if ($this->input->post('end_date')) {
                    $params['end_date'] = $this->input->post('end_date');
                }

                $this->admin->update_record('batches',$id,$params); 
                $this->session->set_flashdata('success', 'batch updated successfully.');            
                redirect('batches-manage');
            }
            else
            {
                $data['_view'] = 'batch/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The batch you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $batch = $this->admin->get_record('batches',$id);

        // check if the batch exists before trying to delete it
        if(isset($batch['id']))
        {
            $this->admin->delete_record('batches',$id);
            redirect('batches-manage');
        }
        else
            show_error('The batch you are trying to delete does not exist.');
    }
    
}
