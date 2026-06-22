<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Classes extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of classes
     */
    function index()
    {
        $data['classes'] = $this->Class_model->get_all_classes();
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['batches'] = $this->batch->get_all_batches();
        // echo'<pre>';print_r($data['classes']);exit;
        
        $data['_view'] = 'class/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new class
     */
    function add()
    {   
        $this->load->library('form_validation');

        $this->form_validation->set_rules('class_name','Class Name','required');
        $this->form_validation->set_rules('batch_id','Batch','required');
        $this->form_validation->set_rules('status','status','required');
		
		if($this->form_validation->run())     
        {   
            $params = array(
                'class_name' => $this->input->post('class_name'),
                'batch_id' => $this->input->post('batch_id'),
                'status' => $this->input->post('status'),
            );
            
            $class_id = $this->Class_model->add_class($params);
            if($this->input->post('subjects')){
                foreach($this->input->post('subjects') as $s){
                    $subjects[]= array(
                        'class_id' => $class_id,
                        'subject_id' => $s
                    );
                }
                $this->Class_model->add_class_subject($subjects);
            }
            $this->session->set_flashdata('success', 'New Class added successfully.'); 
            redirect('class-manage');
        }
        else
        {            
            redirect('classes');
        }
    }  

    function export()
    {
        $data['classes'] = $this->Class_model->get_all_classes();
        $data['subjects'] = $this->Subject_model->get_all_subjects();
        $data['batches'] = $this->batch->get_all_batches();
        
        $data['_view'] = 'class/export';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Editing a class
     */
    function edit($c_id)
    {   
        $id = base64_decode(urldecode($c_id));
        // check if the class exists before trying to edit it
        $data['class'] = $this->Class_model->get_class($id);
        
        if(isset($data['class']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('class_name','Class Name','required');
            $this->form_validation->set_rules('batch_id','Batch','required');
            $this->form_validation->set_rules('status','status','required');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'class_name' => $this->input->post('class_name'),
                    'batch_id' => $this->input->post('batch_id'),
                    'status' => $this->input->post('status'),
                );

                $this->Class_model->update_class($id,$params); 
                
                if($this->input->post('subjects')){
                    $this->Class_model->delete_class_subject($id); 
                    foreach($this->input->post('subjects') as $s){
                        $subjects[] = array(
                            'class_id' => $id,
                            'subject_id' => $s
                        );
                    }
                    $this->Class_model->add_class_subject($subjects);
                }
                $this->session->set_flashdata('success', 'Class updated successfully.');            
                redirect('classes');
            }
            else
            {
                $data['subjects'] = $this->Subject_model->get_all_subjects();
                $data['batches'] = $this->batch->get_all_batches();

                $data['_view'] = 'class/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The class you are trying to edit does not exist.');
    } 

    /*
     * Deleting class
     */
    function remove($id)
    {
        $class = $this->Class_model->get_class($id);

        // check if the class exists before trying to delete it
        if(isset($class['id']))
        {
            $this->Class_model->delete_class($id);
            redirect('class-manage');
        }
        else
            show_error('The class you are trying to delete does not exist.');
    }
    
}
