<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
require FCPATH.'assets/api/autoload.php';
class Setting extends Admin_Controller{
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
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|ico';

        $this->form_validation->set_rules('website_name','Website Name','required');
        $this->load->library('upload',$config);
        
        if($this->form_validation->run())     
        {   
            $params = array(
                'website_name' => $this->input->post('website_name'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'page_size' => $this->input->post('page_size'),
                'page_orientation' => $this->input->post('page_orientation'),
                'currency_symbol' => $this->input->post('currency_symbol'),
                'currency_decimals' => $this->input->post('currency_decimals'),
                'mark_decimals' => $this->input->post('mark_decimals'),
                'language' => $this->input->post('language'),
                'date_formate' => $this->input->post('date_formate'),
                'dt_formate' => $this->input->post('dt_formate'),
                'lg_date_fromate' => $this->input->post('lg_date_fromate'),
                'lg_dt_formate' => $this->input->post('lg_dt_formate'),
            );
            
            $this->upload->initialize($config);
            if(!empty($_FILES['logo']['name'])){
                $this->upload->do_upload('logo');
                $uploadData = $this->upload->data();
                $params['logo'] = $uploadData['file_name'];
            }
            if(!empty($_FILES['pdf_logo']['name'])){
                $this->upload->do_upload('pdf_logo');
                $uploadData = $this->upload->data();
                $params['pdf_logo'] = $uploadData['file_name'];
            }
            $id = ACTIVE;
            $this->setting->update_setting('setting_page',$id,$params); 
            $this->session->set_flashdata('success', 'Setting updated successfully.');            
            redirect('app-setting');
        }else{
            $data['_view'] = 'settings/app_setting';
            $this->load->view('layouts/main',$data);
        }
    }
    // History
    function history()
    {
        $data['_view'] = 'settings/history';
        $this->load->view('layouts/main',$data);
    }
    // Account Setting
    function account()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('account_head','Type Head','required');
        
        if($this->form_validation->run())     
        {
            $params = array(
                'account_head' => $this->input->post('account_head'),
            );
            $setting_id = $this->setting->add_setting('setting_account',$params);
            $this->session->set_flashdata('success', 'Account head added successfully.');            
            redirect('account-setting');
        }else{
            $data['accounts'] = $this->setting->get_all_setting('setting_account');
            $data['_view'] = 'settings/account';
            $this->load->view('layouts/main',$data);
        }   
    }

    function edit_model($id)
    {
        $ac_setting = $this->setting->get_setting('setting_account',$id);

        // check if the subject exists before trying to delete it
        if(isset($ac_setting['id']))
        {
            echo'<div class="form-group">
                <input type="hidden" name="id" value="'.$id.'">
                <label class="col-form-label label-align">Type head</label>
                <input type="text" name="account_head" autofocus="true" placeholder="Account Head" class="form-control" value="'.$ac_setting['account_head'].'" >
                <span class="text-danger">'.form_error('account_head').'</span>    
            </div>';
        }
    }

    function account_edit()
    {
        $id = $this->input->post('id');
        $ac_setting = $this->setting->get_setting('setting_account',$id);

        // check if the subject exists before trying to delete it
        if(isset($ac_setting['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('account_head','Type Head','required');
            
            if($this->form_validation->run())     
            {
                $params = array(
                    'account_head' => $this->input->post('account_head'),
                );
                $this->setting->update_setting('setting_account',$id,$params);
                $this->session->set_flashdata('success', 'Account head updated successfully.'); 
                redirect('account-setting');
            }else{
                redirect('account-setting'); 
            }
        }
        else
            show_error('The account setting you are trying to edit does not exist.');
    }

    function account_remove($id)
    {
        $setting = $this->setting->get_setting('setting_account',$id);

        // check if the subject exists before trying to delete it
        if(isset($setting['id']))
        {
            $this->setting->delete_setting('setting_account',$id);
            $this->session->set_flashdata('success', 'Account head deleted successfully.'); 
            redirect('account-setting');
        }
        else
            show_error('The account setting you are trying to delete does not exist.');
    }

    // Fine
    function fee()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('invoice_fee_days','Invoice Fee Days','required');
        
        if($this->form_validation->run())     
        {   
            $params = array(
                'invoice_fee_days' => $this->input->post('invoice_fee_days')
            );
            $this->setting->update_setting('setting_page',ACTIVE,$params); 
            $this->session->set_flashdata('success', 'Calendar updated successfully.');            
            redirect('fee-setting');
        }else{
            $data['_view'] = 'settings/fee';
            $this->load->view('layouts/main',$data);
        }
    }

    function fine()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fine_name','Fine Name','required');
        $this->form_validation->set_rules('fine_amount','Fine Amount','required');
         
        if($this->form_validation->run())     
        {
            $params = array(
                'fine_name' => $this->input->post('fine_name'),
                'fine_amount' => $this->input->post('fine_amount'),
                'amount_type' => $this->input->post('amount_type'),
                'fine_implement' => $this->input->post('fine_implement'),
            );
            $setting_id = $this->setting->add_setting('setting_fine',$params);
            $this->session->set_flashdata('success', 'Fine added successfully.');            
            redirect('fine');
        }else{
            $data['results'] = $this->setting->get_all_setting('setting_fine'); 
            $data['_view'] = 'settings/fine';
            $this->load->view('layouts/main',$data);
        }
    }

    function edit_fine_model($id)
    {
        $setting = $this->setting->get_setting('setting_fine',$id);

        // check if the subject exists before trying to delete it
        if(isset($setting['id']))
        {
            echo'<div class="form-group">
                    <input type="hidden" name="id" value="'.$id.'">
                    <label class="col-form-label label-align">Fine Name</label>
                    <input type="text" name="fine_name" autofocus="true" placeholder="Fine Name" class="form-control" value="'.$setting['fine_name'].'">
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Amount</label>
                    <input type="text" name="fine_amount" required placeholder="Amount" class="form-control" value="'.$setting['fine_amount'].'" >
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Amount Type</label>
                    <select class="form-control" name="amount_type">';
                    $types = array(
                        'Percentage %' => PERCENTAGE,
                        'Amount - Fix' => FIX
                    );
                    foreach($types as $key => $v)
                    {
                        $selected = ($v == $setting['amount_type']) ? ' selected="selected"' : "";

                        echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                    }
                echo'</select>
                </div>
                <div class="form-group">
                    <label class="col-form-label label-align">Fine Implementation</label>
                    <select class="form-control" name="fine_implement">';
                    $fines = array(
                        'Daily Apply' => DAILY,
                        'Once' => ONCE
                    );
                    foreach($fines as $key => $v)
                    {
                        $selected = ($v == $setting['fine_implement']) ? ' selected="selected"' : "";

                        echo '<option value="'.$v.'" '.$selected.'>'.$key.'</option>';
                    }
                echo'</select>
                </div>';
        }
    }

    function fine_edit()
    {
        $id = $this->input->post('id');
        $setting = $this->setting->get_setting('setting_fine',$id);

        // check if the subject exists before trying to delete it
        if(isset($setting['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fine_name','Fine Name','required');
            $this->form_validation->set_rules('fine_amount','Fine Amount','required');
            
            if($this->form_validation->run())     
            {
                $params = array(
                    'fine_name' => $this->input->post('fine_name'),
                    'fine_amount' => $this->input->post('fine_amount'),
                    'amount_type' => $this->input->post('amount_type'),
                    'fine_implement' => $this->input->post('fine_implement'),
                );
                $this->setting->update_setting('setting_fine',$id,$params);
                $this->session->set_flashdata('success', 'Fine updated successfully.'); 
                redirect('fine');
            }else{
                redirect('fine'); 
            }
        }
        else
            show_error('The fine you are trying to edit does not exist.');
    }

    function fine_remove($id)
    {
        $setting = $this->setting->get_setting('setting_fine',$id);
        // check if the subject exists before trying to delete it
        if(isset($setting['id']))
        {
            $this->setting->delete_setting('setting_fine',$id);
            $this->session->set_flashdata('success', 'Fine deleted successfully.'); 
            redirect('fine');
        }
        else
            show_error('The fine you are trying to delete does not exist.');
    }
    // Calendar
    function calendar()
    {
        if(isset($_POST) && count($_POST) >0)     
        {
            $params = array(
                'monday' => $this->input->post('monday'),
                'tuesday' => $this->input->post('tuesday'),
                'wednesday' => $this->input->post('wednesday'),
                'thursday' => $this->input->post('thursday'),
                'friday' => $this->input->post('friday'),
                'saturday' => $this->input->post('saturday'),
                'sunday' => $this->input->post('sunday'),
            );
            $setting_id = $this->setting->update_setting('setting_calendar',ACTIVE,$params);
            $this->session->set_flashdata('success', 'Calendar added successfully.');            
            redirect('cal-setting');
        }else{
            $data['results'] = $this->setting->get_setting('setting_calendar',ACTIVE);
            $data['_view'] = 'settings/calendar';
            $this->load->view('layouts/main',$data);
        }
    }
    //SMS  
    function sms()
    {
        if(isset($_POST) && count($_POST) >0)     
        {
            $params = array(
                'gateway' => $this->input->post('gateway'),
                'sms_username' => $this->input->post('sms_username'),
                'sms_password' => $this->input->post('sms_password'),
                'twillio_sid' => $this->input->post('twillio_sid'),
                'twillio_auth' => $this->input->post('twillio_auth'),
                'twillio_phone' => $this->input->post('twillio_phone'),
                'sms_header' => $this->input->post('sms_header'),
                'sms_footer' => $this->input->post('sms_footer')
            );
            $setting_id = $this->setting->update_setting('setting_sms',ACTIVE,$params);
            $this->session->set_flashdata('success', 'SMS setting updated successfully.');            
            redirect('sms-setting');
        }else{
            $data['_view'] = 'settings/sms';
            $this->load->view('layouts/main',$data);
        }
    }
    // Custom Style
    function custom_style()
    {
        if(isset($_POST) && count($_POST) >0)     
        {
            $params = array(
                'custom_style' => $this->input->post('custom_style'),
            );
            $this->setting->update_setting('setting_page',ACTIVE,$params); 
            $this->session->set_flashdata('success', 'Custom style css updated successfully.');            
            redirect('custom-style');
        }else{
            $data['_view'] = 'settings/custom_style';
            $this->load->view('layouts/main',$data);
        }
    }
    // Translation
    function translation()
    {
        $data['_view'] = 'settings/translation';
        $this->load->view('layouts/main',$data);
    }
    // Send SMS on Twillio
    function sendSMS()
    {
        if (isset($_POST['bulk_phone'])) {
            $phone_number = implode(',', $_POST['bulk_phone']);
            $msg = $_POST['message'];
            $count = 0;

            foreach($_POST['bulk_phone'] as $number)
            {
                // $this->send_email($number);
               $count++;
                // $this->twilio->messages->create(
                //     $number,
                //     [
                //         'from' =>  $this->from,
                //         'body' => $msg
                //     ]
                // );
            }
            $this->session->set_flashdata('success', 'New'.$count.' messages sent!'); 
            redirect('settings');
            // return back()->with( 'success', $count . " messages sent!" );
            // echo "<pre>"; print_r($_POST);
        }else{
            // $this->send_email($_POST['phone_number']);
            // Use the client to do fun stuff like send text messages!

            // $send_message = $this->twilio->messages->create(
            //     $_POST['phone_number'],
            //     [
            //         'from' =>  $this->from,
            //         'body' => $_POST['body']
            //     ]
            // );
            // if ($send_message->sid) {
                $this->session->set_flashdata('success', 'New message sent!'); 
                redirect('settings');
            // }
        }
    }


}
