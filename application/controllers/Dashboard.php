<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */
 
class Dashboard extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model','dashboard');
            
    }

    function index()
    {
    	$data['subjects'] = $this->dashboard->get_all_subjects();

        $data['_view'] = 'index';
        $this->load->view('layouts/main',$data);
    }

    function assignments()
    {
        if (isset($_POST) && count($_POST)>0) {
            echo "<pre>";print_r($_POST);exit();
        }else{
            $data['subjects'] = $this->dashboard->get_all_subjects();
            
            $data['_view'] = 'assignments';
            $this->load->view('layouts/main',$data); 
        }
    }

    function change_password()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('cpassword','Current Password','required');
        $this->form_validation->set_rules('newpassword','New Password','required');
        $this->form_validation->set_rules('againpassword','New Password again','required');
        
        if($this->form_validation->run())     
        {   
            if ($this->session->userdata('password') != md5($_POST['cpassword'])) {
               $this->session->set_flashdata('info', 'Current Password is not correct.');
                redirect('change-password');
            }else{
                if ($_POST['newpassword'] != $_POST['againpassword']) {
                    $this->session->set_flashdata('info', 'Agin Password is not matched.');
                    redirect('change-password');
                }else{
                    $params = array(
                        'password' => md5($this->input->post('againpassword')),
                    );
                    
                    $pass_id = $this->dashboard->update_account($params);
                    $this->session->set_flashdata('success', 'Password updated successfully.');
                    redirect('change-password');
                }
            }
                
        }else{
            $data['_view'] = 'change_password';
            $this->load->view('layouts/main',$data);   
        }
            
    }

    function profile()
    {
        $data['_view'] = 'profile';
        $this->load->view('layouts/main',$data);   
    }

}
