<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Help extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of help
     */
    function index()
    {    
        $data['_view'] = 'help/how_start';
        $this->load->view('layouts/main',$data);
    }

    function report_bug()
    {    
        $this->load->library('form_validation');
    
        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required');
        
        if($this->form_validation->run())     
        {   
            $params = array(
                'name' => $this->input->post('name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'bug' => $this->input->post('bug'),
            );
            $config['upload_path'] = 'uploads/bugs';
            $config['allowed_types'] = 'jpg|jpeg|png||pdf|txt|docx';
            $this->load->library('upload',$config);
            $this->upload->initialize($config);
            
            if(!empty($_FILES['file']['name'])){
                $this->upload->do_upload('file');
                $uploadData = $this->upload->data();
                $params['attachment'] = $uploadData['file_name'];
            }
            $this->admin->add_record('bug_reports',$params);
            $this->session->set_flashdata('success', 'Bug Report sent successfully.');            
            redirect('report-bug');
        }else{
            $data['_view'] = 'help/report_bug';
            $this->load->view('layouts/main',$data);
        }
    }

}
