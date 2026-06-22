<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Account extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
    } 

    /*
     * Listing of subjects
     */
    function index()
    {
        if (isset($_POST) && count($_POST)>0) {
            $params = array(
                'account_head_id' => $this->input->post('account_head_id'),
                'detail' => $this->input->post('detail'),
                'amount' => $this->input->post('amount'),
                'expense_date' => $this->input->post('expense_date'),
            );
            if($this->input->post('receipt')){
                $params['receipt'] =$this->input->post('receipt');
            }else{
                $params['receipt'] = 'EXP-'.random_int(1000,100000);
            }

            $expense_id = $this->admin->add_record('expenses',$params);
            $params2 = array(
                'expense_id' => $expense_id,
            );
            $this->admin->add_record('transections',$params2);
            $this->session->set_flashdata('success', 'New expense added successfully.'); 
            redirect('account-daily-expenses');
        }else{
            $data['heads'] = $this->admin->get_all_records('setting_account');
            $data['expenses'] = $this->admin->get_all_records('expenses');
            
            $data['_view'] = 'account/expense';
            $this->load->view('layouts/main',$data);
        }
    }

    function salary()
    {
        if (isset($_POST) && count($_POST) > 0) {
            $id = $_POST['id'];
            if(isset($_POST['deduction'])){
                $params = array(
                    'deduction' => $_POST['deduction'],
                    'description' => $_POST['description'],
                    'paid_salary' => date('Y-m-d')
                );
            }else{
                $params = array('paid_salary' => date('Y-m-d'),'status' => PAID);
            }
            $this->admin->update_record('salaries',$id,$params);
            $params2 = array(
                'salary_id' => $id,
            );
            $this->admin->add_record('transections',$params2);
            if(isset($_POST['deduction'])){
                $this->session->set_flashdata('success', 'Deduction paid successfully.'); 
            }else{
                $this->session->set_flashdata('success', 'Salary paid successfully.'); 
            }
            redirect('account-teacher-salary');
        }else{
            $data['results'] = $this->account->get_all_salaries();
            
            $data['_view'] = 'account/salary';
            $this->load->view('layouts/main',$data);
        }
    }

    function student_payment()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['students'] = $this->account->get_std_payment_report($_POST['student_id'],$_POST['from_date'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_student();
            
            $data['_view'] = 'account/std_payment';
            $this->load->view('layouts/main',$data);
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $std = $this->account->get_std_payment_report($_POST['student_id'],$_POST['from_date'],$_POST['to_date']);
            $info = $this->student->get_student($_POST['student_id']);
            $title = 'Payment report for <b>'.$info['std_name'].'</b> S/O <b>'.$info['father_name'].'</b><br>
                    Class <b>'.$info['class_name'].'</b> Roll # <b>'.$info['roll_no'].'</b><br>
                    Report from <b>'.$_POST['from_date'].'</b> to <b>'.$_POST['to_date'].'</b>';
            $pdf_file = 'student_payment_report_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_student();
            
            $data['_view'] = 'account/std_payment';
            $this->load->view('layouts/main',$data); 
        }
    }

    function payment_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['results'] = $this->admin->get_all_records('classes');
            $data['students'] = $this->account->get_payment_report($_POST['class_id'],$_POST['month'],$_POST['year']);
            // echo "<pre>";print_r($data['students']);exit;
            $data['_view'] = 'account/payment_report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $std=$this->account->get_payment_report($_POST['class_id'],$_POST['month'],$_POST['year']);
            $class = $this->admin->get_record('classes',$_POST['class_id']);
            $title = 'Payment report for Class: '.$class['class_name'].' '.$_POST['month'].'-'.$_POST['year'].'';
            $pdf_file = 'student_payment_list_'.date('d-M-Y-h-m-s');
            $this->generate_pdf($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['fee'] = $this->fee->get_all_fee();
            $data['results'] = $this->admin->get_all_records('classes');
            
            $data['_view'] = 'account/payment_report';
            $this->load->view('layouts/main',$data);
        }
    }

    function transection()
    {
        if (isset($_POST) && count($_POST)>0) {
            $params = array(
                'status' => DELETED
            );

            $this->admin->update_record('transections',$_POST['id'],$params);
            $this->session->set_flashdata('success', 'Transection delted successfully.'); 
            redirect('accounts-transactions');
        }else{
            $data['transections'] = $this->account->get_all_transections();
            // echo'<pre>';print_r($data['transections']);exit;
            $data['_view'] = 'account/transection';
            $this->load->view('layouts/main',$data);
        }
    }

    function cash_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['students'] = $this->account->get_cash_report($_POST['from_date'],$_POST['to_date']);
            
            $data['_view'] = 'account/cash_report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $std = $this->account->get_cash_report($_POST['from_date'],$_POST['to_date']);
            $title = 'Cash Report from <b>'.$_POST['from_date'].'</b> to <b>'.$_POST['to_date'].'</b>';
            $pdf_file = 'cash_report_'.date('d-M-Y-h-m-s');
            $this->generate_pdf_report($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            
            $data['_view'] = 'account/cash_report';
            $this->load->view('layouts/main',$data); 
        }
    }

    function expense_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $data['students'] = $this->account->get_expense_report($_POST['head_id'],$_POST['from_date'],$_POST['to_date']);
            $data['heads'] = $this->admin->get_all_records('setting_account');
            
            $data['_view'] = 'account/expense_report';
            $this->load->view('layouts/main',$data);
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $std = $this->account->get_expense_report($_POST['head_id'],$_POST['from_date'],$_POST['to_date']);
            $title = 'Expense Report from <b>'.$_POST['from_date'].'</b> to <b>'.$_POST['to_date'].'</b>';
            $pdf_file = 'expense_report_'.date('d-M-Y-h-m-s');
            $this->generate_expense_report($std,$title,$pdf_file);
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
            $name = $pdf_file. ".pdf";
            force_download($name, $data);
        }else{
            $data['heads'] = $this->admin->get_all_records('setting_account');
            
            $data['_view'] = 'account/expense_report';
            $this->load->view('layouts/main',$data); 
        }
    }

    function generate_pdf($std,$title,$file)
    {
        $data['students'] = $std;
        $data['title'] = $title;

        $html_content = $this->load->view('account/download_list', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    function generate_pdf_report($std,$title,$file)
    {
        $data['students'] = $std;
        $data['title'] = $title;

        $html_content = $this->load->view('account/download_report', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    function generate_expense_report($std,$title,$file)
    {
        $data['students'] = $std;
        $data['title'] = $title;

        $html_content = $this->load->view('account/expense_download', $data,true);
        $this->pdf->create_fee($html_content, $file);
    }

    /*
     * modal
     */
    function edit_model($id)
    {
        $record = $this->admin->get_record('expenses',$id);
        $heads = $this->admin->get_all_records('setting_account');
        // check if the subject exists before trying to delete it
        if(isset($record['id']))
        {
            echo '<div class="form-group">
                <label class="col-form-label label-align">Select Head</label>
                <select class="form-control select2" name="account_head_id" style="width: 100%">';
                foreach($heads as $h)
                {
                    $selected = ($h['id'] == $record['account_head_id']) ? ' selected="selected"' : "";

                    echo '<option value="'.$h['id'].'" '.$selected.'>'.$h['account_head'].'</option>';
                } 
            echo'</select>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Expense Detail</label>
                <input type="text" name="detail" class="form-control" value="'.$record['detail'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Amount</label>
                <input type="number" name="amount" step=".01" class="form-control" value="'.$record['amount'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Date ('.$record['expense_date'].')</label>
                <input type="text" name="expense_date" id="date_picker" class="date_picker form-control">
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Receipt Number (If Any):</label>
                <input type="text" name="receipt" value="'.$record['receipt'].'" class="form-control"> 
            </div>';
        }
    }

    function edit_salary($id)
    {
        $record = $this->admin->get_record('salaries',$id);
        // check if the subject exists before trying to delete it
        if(isset($record['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Deduction</label>
                <input type="text" name="deduction" step=".01" class="form-control" value="'.$record['deduction'].'" >  
            </div>
            <div class="form-group">
                <label class="col-form-label label-align">Description</label>
                <input type="text" name="description" class="form-control" value="'.$record['description'].'" >  
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
        $record = $this->admin->get_record('expenses',$id);
        
        if(isset($record['id']))
        {
            if(isset($_POST) && count($_POST) >0)
            {
                $params = array(
                    'account_head_id' => $this->input->post('account_head_id'),
                    'detail' => $this->input->post('detail'),
                    'amount' => $this->input->post('amount'),
                );
                if($this->input->post('expense_date')){
                    $params['expense_date'] =$this->input->post('expense_date');
                }
                if($this->input->post('receipt')){
                    $params['receipt'] =$this->input->post('receipt');
                }else{
                    $params['receipt'] = 'EXP-'.random_int(1000,100000);
                }

                $this->admin->update_record('expenses',$id,$params);
                $this->session->set_flashdata('success', 'Expense update successfully.'); 
                redirect('account-daily-expenses');
            }else{
                redirect('account-daily-expenses');
            }
            
        }
        else
            show_error('The expense you are trying to edit does not exist.');
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
        $data['total'] = $data['fee'] ['fine']+$data['std'] ['amount'];
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
        $record = $this->admin->get_record('expenses',$id);

        // check if the subject exists before trying to delete it
        if(isset($record['id']))
        {
            $this->admin->delete_record('expenses',$id);
            $expenses = $this->admin->get_all_records('expenses');
            foreach($expenses as $e){
                echo'<tr>
                <td>'.$e['id'].'</td>
                <td>'.$e['expense_date'].'</td>
                <td>'.$e['account_head_id'].'</td>
                <td>'.$e['detail'].'</td>
                <td>'.$e['amount'].'</td>
                <td style="white-space: nowrap">
                    <a class="btn btn-danger btn-sm" href="#" onclick="confirmation('.$e['id'].')" title="Delete"><i class="fa fa-trash"></i></a>
                    <a class="btn btn-info btn-sm" href="#" onclick="edit_record('.$e['id'].')" title="Edit"><i class="fa fa-pencil"></i></a>
                </td>
            </tr>';
            }
        }
        else
            // show_error('The fee you are trying to delete does not exist.');
            echo'The expense you are trying to delete does not exist.';
    }
    
}
