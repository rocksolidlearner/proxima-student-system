<?php
/* 
 * developed by: mau5tech.com
 * https://mau5tech.com/
 */
 
class Profile extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {
        $data['_view'] = 'profile';
        $this->load->view('layouts/main',$data);
    }

    function update_profile()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name','Name','required');
        $this->form_validation->set_rules('email','Email','required');
        

        if($this->form_validation->run()) 
        {
            $params = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
            );

            if ($this->input->post('username')) {
                $params['username'] = $this->input->post('username');
            }

            if ($this->input->post('password')) {
                $params['password'] = md5($this->input->post('password'));
            }
            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $this->load->library('upload',$config);
            if(!empty($_FILES['img']['name'])){
                $this->upload->do_upload('img');
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $params['img']= $upload_data['file_name'];
            }
            $this->admin->update_record('users',$this->session->userdata('id'), $params);
            $this->session->set_userdata($this->admin->get_record('users',$this->session->userdata('id')));
            redirect('profile');
        } else {
            
            redirect('profile');
            
        }
    }
}
