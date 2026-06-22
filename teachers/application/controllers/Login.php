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
        if($this->session->userdata("email")){
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function do_login(){
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('password','Password','required');
        if($this->form_validation->run())
        {
            $params = array(
                'password' => md5($this->input->post('password')),
                'email' => $this->input->post('email'),
                'role' => TEACHER
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
                $this->session->set_flashdata('error', 'Username / Password combination does not exist');
                redirect('login', 'refresh');
            }
        } else {
            redirect('login', 'refresh');
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
