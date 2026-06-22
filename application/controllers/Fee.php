<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Fee extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of subjects
     */
    function index()
    {
        if (isset($_POST['download'])) {
            $std=$this->fee->get_student(null,COLLECT);
            $title = 'Collect Fee Student List';
            $pdf_file = 'collect_fee_student_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee(COLLECT);
            
            $data['_view'] = 'fee/collect';
            $this->load->view('layouts/main',$data);
        }
    }

    function defaulters()
    {
        if (isset($_POST['download'])) {
            $std=$this->fee->get_student(null,DEFAULTER);
            $title = 'Fee Defaulter Student List';
            $pdf_file = 'defaulter_student_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee(DEFAULTER);
            $data['students'] = $this->admin->get_all_records('students');
            
            $data['_view'] = 'fee/defaulters';
            $this->load->view('layouts/main',$data);
        }
    }

    function paid()
    {
        if (isset($_POST['download'])) {
            $std=$this->fee->get_student(null,PAID);
            $title = 'Paid Fee Student List';
            $pdf_file = 'paid_fee_student_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee(PAID);
            
            $data['_view'] = 'fee/paid';
            $this->load->view('layouts/main',$data);
        }
    }

    function defaulter_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['results'] = $this->admin->get_all_records('classes');
            $data['students'] = $this->fee->get_student($_POST['class_id'],$_POST['status']);
            // echo "<pre>";print_r($data['students']);exit;
            $data['_view'] = 'fee/defaulter_report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $std=$this->fee->get_student($_POST['class_id'],$_POST['status']);
            $title = 'Fee Defaulter Student List';
            $pdf_file = 'defaulter_student_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee();
            $data['results'] = $this->admin->get_all_records('classes');
            
            $data['_view'] = 'fee/defaulter_report';
            $this->load->view('layouts/main',$data);
        }
    }

    function generate_pdf($std,$title,$file)
    {
        $data['students'] = $std;
        $data['title'] = $title;

        $html_content = $this->load->view('fee/download_list', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    /*
     * modal
     */
    function edit_model($id,$page)
    {
        $fee = $this->admin->get_record('fee',$id);
        // check if the subject exists before trying to delete it
        if(isset($fee['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="page" value="'.$page.'">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Amount</label>
                <input type="number" name="amount" step=".01" autofocus="true" class="form-control" value="'.$fee['amount'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Fine</label>
                <input type="number" name="fine" step=".01" class="form-control" value="'.$fee['fine'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Desciption</label>
                <textarea name="description" class="form-control" rows="7" style="resize: none">"'.$fee['description'].'" </textarea>  
            </div>';
        }
    }

    function pay_model($id,$page)
    {
        $fee = $this->admin->get_record('fee',$id);
        // check if the subject exists before trying to delete it
        if(isset($fee['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="page" value="'.$page.'">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Fee Title</label>
                <input type="text" name="title" class="form-control" value="'.$fee['title'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Amount</label>
                <input type="number" name="amount" step=".01" autofocus="true" class="form-control" value="'.$fee['amount'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Date</label>
                <input type="text" name="paid_date" id="date_picker" class="date_picker form-control" required>
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Receipt Number (If Any):</label>
                <input type="text" name="receipt" class="form-control"> 
            </div>';
        }
    }

    /*
     * Editing a fee
     */
    function edit()
    {   
        $id = $this->input->post('id');
        // check if the fee exists before trying to edit it
        $fee = $this->admin->get_record('fee',$id);
        
        if(isset($fee['id']))
        {
            if(isset($_POST['pay']) && count($_POST) >0){
                $params = array(
                    'title' => $this->input->post('title'),
                    'amount' => $this->input->post('amount'),
                    'paid_date' => $this->input->post('paid_date'),
                    'status' => PAID
                );
                if($this->input->post('receipt')){
                    $params['receipt'] =$this->input->post('receipt');
                }else{
                    $params['receipt'] = 'CBC-'.random_int(1000,100000);
                }

                $this->admin->update_record('fee',$id,$params);
                $params2 = array(
                    'fee_id' => $id,
                );
                $this->admin->add_record('transections',$params2);
                $this->session->set_flashdata('success', 'Fee Paid successfully.'); 
                if($this->input->post('page')==COLLECT){
                    redirect('fee-collect');
                }else{
                    redirect('fee-defaulters');
                }
            }else{
                $params = array(
                    'amount' => $this->input->post('amount'),
                    'fine' => $this->input->post('fine'),
                    'description' => $this->input->post('description'),
                );

                $this->admin->update_record('fee',$id,$params);
                $this->session->set_flashdata('success', 'Fee updated successfully.'); 
                if($this->input->post('page')==COLLECT){
                    redirect('fee-collect');
                }else{
                    redirect('fee-defaulters');
                }
            }
        }
        else
            show_error('The fee you are trying to edit does not exist.');
    } 

    function print_fee($id){
        $pdf_file = 'Receipt-'.$id.'_'.date('d-M-Y');
        $this->print_pdf($id,$pdf_file,null);
        $this->load->helper('download');
        $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
        $name = $pdf_file. ".pdf";
        force_download($name, $data);
    }

    function printt_fee($id){
        $pdf_file = 'Receipt-'.$id.'_'.date('d-M-Y');
        $this->print_pdf($id,$pdf_file,ACTIVE);
        $this->load->helper('download');
        $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
        $name = $pdf_file. ".pdf";
        force_download($name, $data);
    }

    function print_pdf($id,$file,$history=null)
    {
        $data['fee'] = $this->fee->get_fee($id);
        $data['title'] = 'Fee Receipt';
        $data['total'] = $data['fee']['fine']+$data['fee']['amount'];
        if($history){
            $data['history'] = $history;
        }else{
            $data['history'] = '';
        }

        $html_content = $this->load->view('fee/print', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    /*
     * Deleting subject
     */
    function remove($id)
    {
        $fee = $this->admin->get_record('fee',$id);

        // check if the subject exists before trying to delete it
        if(isset($fee['id']))
        {
            $params = array(
                'status' => DELETED,
                'deleted_by' => $this->session->userdata('id')
            );
            $this->admin->update_record('fee',$id,$params);
            echo'Fee deleted successfully.';
            // redirect('fee-collect');
        }
        else
            // show_error('The fee you are trying to delete does not exist.');
            echo'The fee you are trying to delete does not exist.';
    }
    
}
