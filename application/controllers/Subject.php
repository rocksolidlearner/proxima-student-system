<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Subject extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of subjects
     */
    function index()
    {
        $params['limit'] = RECORDS_PER_PAGE; 
        $params['offset'] = ($this->input->get('per_page')) ? $this->input->get('per_page') : 0;
        
        $config = $this->config->item('pagination');
        $config['base_url'] = site_url('subject/index?');
        $config['total_rows'] = $this->Subject_model->get_all_subjects_count();
        $this->pagination->initialize($config);

        $data['subjects'] = $this->Subject_model->get_all_subjects($params);
        
        $data['_view'] = 'subject/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new subject
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('subject_name','Subject Name','required');
		
		if($this->form_validation->run())     
        {
            $exist = $this->Subject_model->get_exist($_POST['subject_name']);
            if(empty($exist)){
                $params = array(
                    'subject_name' => $this->input->post('subject_name'),
                    'short_name' => $this->input->post('short_name'),
                );

                $subject_id = $this->Subject_model->add_subject($params);
                redirect('subject-manage');
            }else{
                $this->session->set_flashdata('info', 'PLease enter another subject,This subject is already exist.');
                redirect('subject-manage');
            }

        }
        else
        {
            $data['_view'] = 'subject/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a subject
     */
    function edit($s_id)
    {   
        $id = base64_decode(urldecode($s_id));
        // check if the subject exists before trying to edit it
        $data['subject'] = $this->Subject_model->get_subject($id);
        
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

                $this->Subject_model->update_subject($id,$params);            
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
        $subject = $this->Subject_model->get_subject($id);

        // check if the subject exists before trying to delete it
        if(isset($subject['id']))
        {
            $this->Subject_model->delete_subject($id);
            redirect('subject-manage');
        }
        else
            show_error('The subject you are trying to delete does not exist.');
    }
    
}
