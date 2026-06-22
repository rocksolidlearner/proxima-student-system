<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of batches
     */
    function index()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('book_name','Book Name','required');
        $this->form_validation->set_rules('book_qty','Quatity','required');
		
		if($this->form_validation->run())     
        {   
            if (empty($this->input->post('department_id'))) {
               $params1 = array(
                'department_name' => $this->input->post('department_name'),
                ); 
                $dept_id = $this->admin->add_record('departments',$params1);
            }else{
               $dept_id  =  $this->input->post('department_id');
            }
            
            $params = array(
                'book_name' => $this->input->post('book_name'),
                'book_qty' => $this->input->post('book_qty'),
                'department_id' => $dept_id,
                'available_qty' => $this->input->post('book_qty'),
            );
            
            $book_id = $this->admin->add_record('books',$params);
            $this->session->set_flashdata('success', 'New book added successfully.'); 
            redirect('library-books');
        }else
        {
            $data['books'] = $this->dashboard->get_all_books();
            $data['departments'] = $this->admin->get_all_records('departments');
            // echo'<pre>';print_r($data['batches']);exit;
            $data['_view'] = 'library/index';
            $this->load->view('layouts/main',$data);
        }
    }  

    function assign()
    {
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
                'student_id' => $this->input->post('student_id'),
                'book_id' => $this->input->post('book_id'),
                'street' => $this->input->post('street'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'post_code' => $this->input->post('post_code'),
                'country' => $this->input->post('country'),
            );

            $this->admin->add_record('book_assign',$params); 
            $this->session->set_flashdata('success', 'Book assign successfully.');            
            redirect('library-books');
        }
        else
        {
            $data['assign_books'] = $this->dashboard->get_assign_books();
            $data['students'] = $this->admin->get_all_records('students');
            $data['books'] = $this->admin->get_all_records('books');

            $data['_view'] = 'library/assign';
            $this->load->view('layouts/main',$data);
        }
    }

    function edit_model($id)
    {
        $book = $this->admin->get_record('books',$id);
        $departments = $this->admin->get_all_records('departments');
        // check if the subject exists before trying to delete it
        if(isset($book['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Book Name</label>
                <input type="text" name="book_name" autofocus="true" placeholder="Type Book Name" class="form-control" value="'.$book['book_name'].'" >  
            </div>
            <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="col-form-label label-align">Deparment</label>
                            <select class="form-control select2" name="department_id" style="width: 100%">
                                <option value="">Select Department</option>';
                                foreach($departments as $d)
                                {
                                    $selected = ($d['id'] == $book['department_id']) ? ' selected="selected"' : "";

                                    echo '<option value="'.$d['id'].'" '.$selected.'>'.$d['department_name'].'</option>';
                                }
            echo '          </select>
                            <div id="newdep1" style="margin-top: 5px"></div>
                        </div>
                        <div class="col-sm-2" hidden>
                            <button type="button" class="btn btn-default" id="more1" style="border-radius: 50%;border: 1px solid lightgray;margin-top: 30px"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>';

            echo '<div class="form-group">
                    <label class="col-form-label label-align">Book Quantity</label>
                    <input type="number" required value="'.$book['book_qty'].'" name="book_qty" class="form-control" value="1">    
                </div>';
        }
    }

    /*
     * Editing a batch
     */
    function edit()
    {   
        $id = $this->input->post('id');
        // check if the batch exists before trying to edit it
        $data['book'] = $this->admin->get_record('books',$id);
        
        if(isset($data['book']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('book_name','Book Name','required');
            $this->form_validation->set_rules('book_qty','Quatity','required');
		
			if($this->form_validation->run())     
            {   
                if (empty($this->input->post('department_id'))) {
                   $params1 = array(
                        'department_name' => $this->input->post('department_name'),
                    ); 
                    $dept_id = $this->admin->add_record('departments',$params1);
                }else{
                   $dept_id  =  $this->input->post('department_id');
                }
                $params = array(
                    'book_name' => $this->input->post('book_name'),
                    'book_qty' => $this->input->post('book_qty'),
                    'department_id' => $dept_id,
                    'available_qty' => $this->input->post('book_qty'),
                );

                $this->admin->update_record('books',$id,$params); 
                $this->session->set_flashdata('success', 'Book updated successfully.');            
                redirect('library-books');
            }
            else
            {
                $this->session->set_flashdata('error', 'Book is not updated.');            
                redirect('library-books');
            }
        }
        else
            show_error('The book you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $book = $this->admin->get_record($id);

        // check if the batch exists before trying to delete it
        if(isset($book['id']))
        {
            $this->admin->delete_record($id);
            redirect('library-books');
        }
        else
            show_error('The book you are trying to delete does not exist.');
    }
    
}
