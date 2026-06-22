<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Parents extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of setting
     */
    function index()
    {    
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password','Password','required');
        
        if($this->form_validation->run())     
        {   
            if ($_POST['password'] != $_POST['cpassword']) {
                $this->session->set_flashdata('info', 'Confirm Password is not matched');
                redirect('parents');
            }else{
                $guardian = array(
                    'password' => md5($this->input->post('password')),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'status' => $this->input->post('status')
                );
                $guardian_id = $this->admin->add_record('guardians',$guardian);
                if($this->input->post('students')){
                    foreach($this->input->post('students') as $std){
                        $params2[] = array(
                            'student_id' => $std,
                            'guardian_id' => $guardian_id,
                        );
                    }
                    $this->parent->std_parent($params2); 
                }
                $this->session->set_flashdata('success', 'Parent added successfully.');
                redirect('parents');
            }
        }else{
            $data['students'] = $this->admin->get_all_records('students');
            $data['parents'] = $this->parent->get_all_parents('guardians');
            // echo'<pre>';print_r($data['parents']);exit;
            $data['_view'] = 'parent/index';
            $this->load->view('layouts/main',$data);
        }
    }

    function edit($pid)
    {
        $id = base64_decode(urldecode($pid));
        $data['parent'] = $this->parent->get_parent($id);
        $data['students'] = $this->admin->get_all_records('students');

        // check if the subject exists before trying to delete it
        if(isset($data['parent']['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('phone','Phone','required');
            $this->form_validation->set_rules('email','Email','required');
            
            if($this->form_validation->run())     
            {
                $params = array(
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'status' => $this->input->post('status')
                );
                $this->admin->update_record('guardians',$id,$params);
                if($this->input->post('students')){
                    $this->parent->delete_parent_std($id);
                    foreach($this->input->post('students') as $std){
                        $params2[] = array(
                            'student_id' => $std,
                            'guardian_id' => $id,
                        );
                    }
                    $this->parent->std_parent($params2); 
                }
                $this->session->set_flashdata('success', 'Parent updated successfully.'); 
                redirect('parents');
            }else{
                $data['_view'] = 'parent/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The parent you are trying to edit does not exist.');
    }

    function edit_model($id)
    {
        $guardian = $this->admin->get_record('guardians',$id);
        // check if the subject exists before trying to delete it
        if(isset($guardian['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Type Password</label>
                <input type="password" name="password" autofocus="true" placeholder="Type new passowrd" class="form-control">  
            </div>';
        }
    }

    function change_password()
    {
        $id = $this->input->post('id');
        $guardian = $this->admin->get_record('guardians',$id);
        if(isset($guardian['id']))
        {
            $params = array(
                'password' => md5($this->input->post('password')),
            ); 
            $this->admin->update_record('guardians',$id,$params);
            $this->session->set_flashdata('success', 'New Password set successfully.');            
            redirect('parents');
        }
    }

}
