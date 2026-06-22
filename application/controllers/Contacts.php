<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Contacts_model', 'contacts');
        $this->contacts->ensure_crm_columns();
    }

    private function get_contact_params()
    {
        return array(
            'contact_name' => $this->input->post('contact_name'),
            'date' => $this->input->post('date') ? $this->input->post('date') : date('Y-m-d'),
            'company_name' => $this->input->post('company_name'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'address' => $this->input->post('address'),
            'contact_role' => $this->input->post('contact_role'),
            'interaction_type' => $this->input->post('interaction_type'),
            'preferred_channel' => $this->input->post('preferred_channel'),
            'priority' => $this->input->post('priority'),
            'follow_up_date' => $this->input->post('follow_up_date') ? $this->input->post('follow_up_date') : null,
            'assigned_user_id' => $this->input->post('assigned_user_id') ? $this->input->post('assigned_user_id') : null,
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status') ? $this->input->post('status') : NEW_LEAD,
        );
    }

    private function get_crm_form_data()
    {
        return array(
            'users' => $this->admin->get_all_records('users'),
            'interaction_types' => array('Call', 'SMS', 'Email', 'Meeting', 'Follow Up'),
            'preferred_channels' => array('Call', 'SMS', 'Email', 'WhatsApp'),
            'priorities' => array('Low', 'Medium', 'High'),
        );
    }

    private function getSmsBody($message)
    {
        $header = trim((string)$this->data['sms_setting']['sms_header']);
        $footer = trim((string)$this->data['sms_setting']['sms_footer']);
        $parts = array();

        if ($header !== '') {
            $parts[] = $header;
        }
        $parts[] = trim((string)$message);
        if ($footer !== '') {
            $parts[] = $footer;
        }

        return trim(implode("\n", $parts));
    }

    private function getVoodooOriginator()
    {
        $originator = trim((string)$this->data['sms_setting']['sms_header']);
        if ($originator === '') {
            $originator = 'Cranbrook';
        }

        return substr(preg_replace('/[^A-Za-z0-9]/', '', $originator), 0, 11);
    }

    private function normalizeVoodooDestination($phoneNumber)
    {
        $phoneNumber = trim((string)$phoneNumber);
        $phoneNumber = preg_replace('/[^\d+]/', '', $phoneNumber);

        if (strpos($phoneNumber, '00') === 0) {
            return '+' . substr($phoneNumber, 2);
        }

        if (strpos($phoneNumber, '+') === 0) {
            return $phoneNumber;
        }

        if (strpos($phoneNumber, '0') === 0) {
            return '+44' . substr($phoneNumber, 1);
        }

        if (strlen($phoneNumber) === 10) {
            return '+44' . $phoneNumber;
        }

        return $phoneNumber;
    }

    private function parseVoodooResponse($output)
    {
        $result = array(
            'status' => '',
            'error' => '',
        );

        $decodedJson = json_decode($output, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedJson)) {
            $result['status'] = isset($decodedJson['status']) ? strtolower((string)$decodedJson['status']) : '';
            $result['error'] = isset($decodedJson['error']) ? trim((string)$decodedJson['error']) : '';
            return $result;
        }

        $xml = @simplexml_load_string($output);
        if ($xml !== false) {
            $resultCode = isset($xml->result) ? trim((string)$xml->result) : '';
            $resultText = isset($xml->resultText) ? trim((string)$xml->resultText) : '';
            $result['status'] = $resultCode === '0' || strtolower($resultText) === 'ok' ? 'success' : 'error';
            $result['error'] = $result['status'] === 'success' ? '' : $resultText;
        }

        return $result;
    }

    /*
     * Listing of contact
     */
    function index()
    {
        $data['results'] = $this->contacts->get_all_contacts();
        $data['crm_summary'] = $this->contacts->get_summary();
        $data['_view'] = 'contacts/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new class
     */
    function add()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('contact_name','Contact Name','required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');

        if($this->form_validation->run())
        {
            $this->admin->add_record('contacts', $this->get_contact_params());
            $this->session->set_flashdata('success', 'New CRM contact added successfully.');
            redirect('call-log');
        }
        else
        {
            $data = $this->get_crm_form_data();
            $data['_view'] = 'contacts/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a batch
     */
    function edit($c_id)
    {   
        $id = base64_decode(urldecode($c_id));
        // check if the batch exists before trying to edit it
        $data['contact'] = $this->contacts->get_contact($id);
        // print_r($data['contact']);exit;
        if(isset($data['contact']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('contact_name','contact Name','required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		
			if($this->form_validation->run())
            {
                $this->admin->update_record('contacts',$id,$this->get_contact_params());
                 
                $this->session->set_flashdata('success', 'CRM contact updated successfully.');
                redirect('call-log');
            }
            else
            {
                $data = array_merge($data, $this->get_crm_form_data());
                $data['_view'] = 'contacts/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The contact you are trying to edit does not exist.');
    } 

    /*
     * Deleting batch
     */
    function remove($id)
    {
        $contact = $this->admin->get_record('contacts',$id);

        // check if the batch exists before trying to delete it
        if(isset($contact['id']))
        {
            $params = array('status' => DELETED);
            $this->admin->update_record('contacts',$id,$params);
            // $this->admin->delete_record($id);
            redirect('call-log');
        }
        else
            show_error('The contact you are trying to delete does not exist.');
    }

    function sendSMS()
    {
        $contactId = (int)$this->input->post('contact_id');
        $phoneNumber = trim((string)$this->input->post('phone_number'));
        $message = trim((string)$this->input->post('message'));

        if ($phoneNumber === '') {
            $this->session->set_flashdata('error', 'Contact phone number is missing.');
            redirect('call-log');
        }

        if ($message === '') {
            $this->session->set_flashdata('error', 'SMS message is required.');
            redirect('call-log');
        }

        $smsBody = $this->getSmsBody($message);
        if ($this->data['sms_setting']['gateway'] == VOODOOSMS) {
            if (empty($this->data['sms_setting']['sms_username']) || empty($this->data['sms_setting']['sms_password'])) {
                $this->session->set_flashdata('error', 'Voodoo SMS settings are incomplete.');
                redirect('call-log');
            }

            $query = http_build_query(array(
                'uid' => $this->data['sms_setting']['sms_username'],
                'pass' => $this->data['sms_setting']['sms_password'],
                'dest' => $this->normalizeVoodooDestination($phoneNumber),
                'orig' => $this->getVoodooOriginator(),
                'msg' => $smsBody,
                'format' => 'JSON',
            ));
            $ch = curl_init('https://www.voodoosms.com/vapi/server/sendSMS?' . $query);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            $output = curl_exec($ch);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($output === false) {
                $this->session->set_flashdata('error', 'Voodoo SMS request failed: ' . $curlError);
                redirect('call-log');
            }

            $result = $this->parseVoodooResponse($output);
            if (!empty($result['error']) || (isset($result['status']) && $result['status'] === 'error')) {
                $this->session->set_flashdata('error', 'Voodoo SMS error: ' . $result['error']);
                redirect('call-log');
            }
        } else {
            $this->session->set_flashdata('error', 'Please configure the SMS gateway first.');
            redirect('call-log');
        }

        if ($contactId > 0) {
            $this->admin->update_record('contacts', $contactId, array(
                'last_contacted_at' => date('Y-m-d H:i:s'),
                'last_contact_method' => 'SMS',
            ));
        }

        $this->session->set_flashdata('success', 'SMS sent successfully.');
        redirect('call-log');
    }

    function send_email()
    {
        $contactId = (int)$this->input->post('contact_id');
        $receiverEmail = trim((string)$this->input->post('receiver_email'));
        $message = trim((string)$this->input->post('message'));
        $subject = trim((string)$this->input->post('subject'));

        if ($receiverEmail === '') {
            $this->session->set_flashdata('error', 'Contact email is missing.');
            redirect('call-log');
        }

        if ($message === '') {
            $this->session->set_flashdata('error', 'Email message is required.');
            redirect('call-log');
        }

        $this->load->library('email');
        $this->email->from($this->data['setting']['email'], 'Proxima Global');
        $this->email->to($receiverEmail);
        $this->email->subject($subject !== '' ? $subject : 'New update from Proxima Global');
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->message(nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')));

        if (!$this->email->send()) {
            $this->session->set_flashdata('error', 'Email could not be sent.');
            redirect('call-log');
        }

        if ($contactId > 0) {
            $this->admin->update_record('contacts', $contactId, array(
                'last_contacted_at' => date('Y-m-d H:i:s'),
                'last_contact_method' => 'Email',
            ));
        }

        $this->session->set_flashdata('success', 'Email sent successfully.');
        redirect('call-log');
    }
}
