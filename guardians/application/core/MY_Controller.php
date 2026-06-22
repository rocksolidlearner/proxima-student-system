<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */

class Admin_Controller extends CI_Controller {

    var $data;
    public function __construct() {
        parent::__construct();

        if(!$this->session->userdata("password")){
            redirect('login');
        }
        if($this->session->userdata("role") !=GUARDIAN){
            redirect('login/logout');
        }
    }
}