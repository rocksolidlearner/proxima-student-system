<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model','dashboard');
    }

    public function index() {
        if($this->session->userdata("admission_no")){
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }

    function download_form()
    {
        $this->load->helper('download');
        // $data = file_get_contents(base_url('uploads/documents/Application_form_21.pdf'));
        force_download('assets/Application_form_21.pdf', NULL);
        // force_download('Application_form_21.pdf', $data);
    }

    public function do_login(){
        if(isset($_POST['submit_form']) && count($_POST) >0){
            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload',$config);
            if(!empty($_FILES['admission_file']['name'])){
                $this->upload->do_upload('admission_file');
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $params=array(
                    'admission_file'=> $upload_data['file_name']
                );
                $admission_id = $this->dashboard->new_learners($params);
            }
            $this->session->set_flashdata('success', 'Your Admission Form submit successfully, contact you later');
            redirect('login', 'refresh');
        }else{
            $this->load->library('form_validation');

            $this->form_validation->set_rules('admission_no','Admission Number','required');
            $this->form_validation->set_rules('password','Password','required');
            if($this->form_validation->run())
            {
                $params = array(
                    'password' => md5($this->input->post('password')),
                    'admission_no' => $this->input->post('admission_no')
                );
                $data = $this->dashboard->login($params);
                if($data){
                    $this->session->set_userdata($data);
                    $params = array(
                        'token' => ACTIVE,
                        // 'login_date' => date('Y/m/d h:i:s a')
                    );

                    $this->dashboard->update_account($params);
                    redirect('dashboard');
                    
                }else{
                    $this->session->set_flashdata('error', 'Admission Number / Password combination does not exist');
                    redirect('login', 'refresh');
                }
            } else {
                redirect('login', 'refresh');
            }
        }
    }

    public function logout() {
         $params = array(
            'token' => INACTIVE,
        );

        $this->dashboard->update_account($params);
        $this->session->sess_destroy();
        redirect('login');
    }

}
