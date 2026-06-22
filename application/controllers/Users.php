<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 16/12/2020
 * Time: 10:00 PM
 */
 
class Users extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of users
     */
    function index()
    {
        $data['users'] = $this->admin->get_all_records('users');
        
        $data['_view'] = 'user/index';
        $this->load->view('layouts/main',$data);
    }

    function profile()
    {
        $data['_view'] = 'profile';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add()
    {   
        $this->load->library('form_validation');

	    $this->form_validation->set_rules('email','email','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run())    
        {
            $permit = implode(',',$this->input->post('permission'));
                $params = array(
    				'name' => $this->input->post('name'),
    				'username' => $this->input->post('username'),
                    'password' => md5($this->input->post('password')),
                    'email' =>  $this->input->post('email'),
                    'role' => ADMIN,
                    'is_admin' => $this->input->post('is_admin'),
    				'status' => $this->input->post('status'),
                    'permissions' => $permit,
                );
                $admin_id = $this->admin->add_record('users',$params);
               
                $this->session->set_flashdata('success', 'User added successfully.'); 
                redirect('user-manage'); 
        }
        else
        {           

            $data['_view'] = 'user/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a user
     */
    function edit($u_id)
    {   
        $id = base64_decode(urldecode($u_id));
        // check if the user exists before trying to edit it
        $data['user'] = $this->user->get_user($id);
        
        if(isset($data['user']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('email','email','required');
            $this->form_validation->set_rules('username','Username','required');
            
			if($this->form_validation->run())     
            {   $permit = implode(',',$this->input->post('permission'));
                // echo'<pre>';print_r($permit);exit;
                $params = array(
                    'name' => $this->input->post('name'),
    				'username' => $this->input->post('username'),
                    'email' =>  $this->input->post('email'),
                    'is_admin' => $this->input->post('is_admin'),
                    'permissions' => $permit,
    				'status' => $this->input->post('status'),
                );

                if($this->input->post('password')){
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

                $this->admin->update_record('users',$id,$params);
              
                $this->session->set_flashdata('success', 'User updated successfully.'); 
                redirect('user-manage');
            }
            else
            {
                $data['_view'] = 'user/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The user you are trying to edit does not exist.');
    } 

    /*
     * Deleting user
     */
    function remove($id)
    {
        $user = $this->admin->get_record('users',$id);

        // check if the user exists before trying to delete it
        if(isset($user['id']))
        {
            $this->user->delete_user($id);
            redirect('user-manage');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
}
