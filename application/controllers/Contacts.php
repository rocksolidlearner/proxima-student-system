<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller{
    function __construct()
    {
        parent::__construct(); 
    } 

    /*
     * Listing of contact
     */
    function index()
    {
        $data['results'] = $this->admin->get_all_records('contacts');
        
        $data['_view'] = 'contacts/index';
        $this->load->view('layouts/main',$data);
    }  

    /*
     * Adding a new class
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('contact_name','Contact Name','required');
        // $this->form_validation->set_rules('company_name','Company Name','required');
        // $this->form_validation->set_rules('phone','Phone','required');
        // $this->form_validation->set_rules('email','Email','required');
        // $this->form_validation->set_rules('contact_role','Role','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'contact_name' => $this->input->post('contact_name'),
                'date' => $this->input->post('date'),
                'company_name' => $this->input->post('company_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'contact_role' => $this->input->post('contact_role'),
                'notes' => $this->input->post('notes'),
                'status' => $this->input->post('status'),
            );

            $contact_id = $this->admin->add_record('contacts',$params);
           
            $this->session->set_flashdata('success', 'New contact added successfully.'); 
            redirect('call-log');
        }
        else
        {            
            $data['_view'] = 'contacts/add';
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
        $data['contact'] = $this->admin->get_record('contacts',$id);
        // print_r($data['contact']);exit;
        if(isset($data['contact']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('contact_name','contact Name','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
                    'contact_name' => $this->input->post('contact_name'),
                    'company_name' => $this->input->post('company_name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('address'),
                    'contact_role' => $this->input->post('contact_role'),
                    'notes' => $this->input->post('notes'),
                    'status' => $this->input->post('status'),
                );
                if($this->input->post('date')){
                    $params['date'] = $this->input->post('date');
                }

                $this->admin->update_record('contacts',$id,$params);
                 
                $this->session->set_flashdata('success', 'contact updated successfully.');            
                redirect('call-log');
            }
            else
            {
                $data['_view'] = 'contacts/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The contact you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $contact = $this->admin->get_record('contacts',$id);

        // check if the batch exists before trying to delete it
        if(isset($contact['id']))
        {
            $params = array('status' => DELETED);
            $this->admin->update_record('contacts',$id,$params);
            // $this->admin->delete_record($id);
            redirect('call-log');
        }
        else
            show_error('The contact you are trying to delete does not exist.');
    }
    
}
