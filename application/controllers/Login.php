<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 16/12/2020
 * Time: 10:00 PM
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model','admin');
    }

    public function index()
    {
        if($this->session->userdata("role")){
            redirect('dashboard');
        } else {
            $this->load->view('login');
        }
    }

    public function do_login()
    {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('password','Password','required');
            $params = array(
                'password' => md5($this->input->post('password')),
                'email' => $this->input->post('email')
            );
            if($this->form_validation->run()){
                $data =  $this->admin->login('users',$params);
                // $std =  $this->Student_model->login($paramss);
                // print_r($tech);exit();
                if($data){
                    $token = $this->getToken(10);
                    $this->session->set_userdata($data);
                    $_SESSION['token'] = $token;
                    $update = array(
                        'token' => $token,
                    );
                    $this->admin->update_record('users',$this->session->userdata('id'),$update);
                    redirect('dashboard');
                }else {
                    $this->session->set_flashdata('error', 'Email / Password combination does not exist');
                    redirect('login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('error', 'Email / Password required');
                redirect('login', 'refresh');
            }
    }

    // Generate token
    public function getToken($length)
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); // edited
        for ($i=0; $i < $length; $i++) {
          $token .= $codeAlphabet[random_int(0, $max-1)];
        }
        return $token;
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
