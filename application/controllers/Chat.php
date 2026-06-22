<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends Admin_Controller {


	public function index()
	{
        $this->load->model('Tbl_user_model');
        $this->load->model('Client_model');

        $data['users'] = $this->Tbl_user_model->get_all_tbl_users();
        $data['clients'] = $this->Client_model->get_all_clients();
        // echo '<pre>';print_r($data['groups']);exit;

        $data['_view'] = 'chat';
        $this->load->view('layouts/main',$data);
	}

	function remove($id)
    {
        $this->Chat_model->remove_message($id);
    }

    function add()
    {
        if(isset($_POST) && count($_POST) > 0){
            $params = array(
                'name' => $_POST['name'],
            );
            $group_id = $this->Chat_model->add_group($params);

            if(isset($_POST['group_participants'])){
                foreach($_POST['group_participants'] as $u){
                    $group[] = array(
                        'group_id' => $group_id,
                        'user_id' => $u,
                    );
                }
                $this->Chat_model->add_group_participants($group);
            }
            redirect('chat');
        }else{
            redirect('chat');
        }
        echo 'Your message is here'.$id;
    }

    function search()
    {
        $users = $this->Tbl_user_model->get_all_search_users($_POST['value']);
        
        echo '<ui class="contacts">';
        foreach ($users as $u){
            if ($u['id'] != $this->session->userdata('id')){
            echo '<li class="chatactive" onclick="get_message('.$u['id'].',1)">';
            echo '<div class="d-flex bd-highlight">';
            echo '<div class="img_cont" style="position: relative;height: 50px;width: 50px;">';
            if ($u['img']){ 
                echo '<img src="'.base_url('uploads/'.$u['img']).'" class="rounded-circle user_img">';
            }else{
                echo '<img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">';
            }
            if ($u['id'] == $_SESSION['id']){
                echo '<span class="online_icon"></span>';
            }
            echo '</div>';
            echo '<div class="user_info" style="margin-top: auto;margin-bottom: auto;margin-left: 15px;">
                <span>'.$u['name'].'</span>';
                if ($u['id'] == $_SESSION['id']){
                    echo '<p>'.$u['name'].' is online</p>';
                }else{
                    echo '<p>'.$u['name'].' is offline</p>';
                }            
            echo'</div></div></li>';
        }}
        echo "</ui>";
    }
}
