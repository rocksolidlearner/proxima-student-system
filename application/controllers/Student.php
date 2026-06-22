<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
require FCPATH.'assets/api/autoload.php';
use Twilio\Rest\Client;

class Student extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Subject_model');
        $this->load->model('Class_model','class');
        $this->twilio = null;
        $this->from = isset($this->data['sms_setting']['twillio_phone']) ? $this->data['sms_setting']['twillio_phone'] : '';
        if (
            !empty($this->data['sms_setting']['gateway']) &&
            (int)$this->data['sms_setting']['gateway'] === TWILLIO &&
            !empty($this->data['sms_setting']['twillio_sid']) &&
            !empty($this->data['sms_setting']['twillio_auth'])
        ) {
            $this->twilio = new Client($this->data['sms_setting']['twillio_sid'], $this->data['sms_setting']['twillio_auth']);
        }
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

        // Voodoo SMS sender IDs are short; keep alphanumeric sender IDs concise.
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
            'raw_type' => 'text',
        );

        $decodedJson = json_decode($output, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedJson)) {
            $result['status'] = isset($decodedJson['status']) ? strtolower((string)$decodedJson['status']) : '';
            $result['error'] = isset($decodedJson['error']) ? trim((string)$decodedJson['error']) : '';
            $result['decoded'] = $decodedJson;
            $result['raw_type'] = 'json';
            return $result;
        }

        $xml = @simplexml_load_string($output);
        if ($xml !== false) {
            $resultCode = isset($xml->result) ? trim((string)$xml->result) : '';
            $resultText = isset($xml->resultText) ? trim((string)$xml->resultText) : '';
            $result['status'] = $resultCode === '0' || strtolower($resultText) === 'ok' ? 'success' : 'error';
            $result['error'] = $result['status'] === 'success' ? '' : $resultText;
            $result['decoded'] = array(
                'result' => $resultCode,
                'resultText' => $resultText,
            );
            $result['raw_type'] = 'xml';
        }

        return $result;
    }

    /*
     * Listing of students
     */
    function index()
    {   
        if (isset($_POST) && count($_POST) > 0) {
            $data['students'] = $this->student->get_all_students(null,$_POST['class_id'],$_POST['subject_id'],$_POST['from_date'],$_POST['to_date']);
        }else{
            $data['students'] = $this->student->get_all_students(); 
        }
        $data['classes'] = $this->admin->get_all_records('classes');
        $data['subjects'] = $this->admin->get_all_records('subjects');
        
        // $data['messages'] = $this->twilio->messages->read([], 20);
        // $data['std_subject'] = $this->Subject_model->get_std_subject($id);
       // echo'<pre>';print_r($data['classes']);exit;
        $data['_view'] = 'student/index';
        $this->load->view('layouts/main',$data);
    }

    function deleted_std()
    {   
        $data['students'] = $this->student->get_all_students(DELETED);
        $data['classes'] = $this->admin->get_all_records('classes');
        
        $data['_view'] = 'student/std_delete';
        $this->load->view('layouts/main',$data);
    }

    function download()
    {
        $pdf_file = 'student_list_'.date('d-M-Y-h-m');
        $data['students'] = $this->dashboard->get_student();
        $data['title'] = 'Student List';
        $html_content = $this->load->view('student/download_list', $data,true);
        $this->pdf->create($html_content, $pdf_file);
        // $this->generate_pdf($stds,$title,$pdf_file);
        $this->load->helper('download');
        $data = file_get_contents(site_url() . 'uploads/pdf_files/'.$pdf_file. ".pdf");
        $name = $pdf_file. ".pdf";
        force_download($name, $data);
    }

    function generate_pdf($std,$title,$pdf_file)
    { 
        
    }

    function profile($sid)
    {
        $id = base64_decode(urldecode($sid));
        $this->student->ensure_guardian_emergency_columns();
        $data['student'] = $this->admin->get_record('students',$id);
        $data['guardian'] = $this->student->get_std_guardian($id);
        $data['classes'] = $this->admin->get_all_records('classes');
        $data['std_subject'] = $this->Subject_model->get_std_subject($id);
        $data['subjects'] = $this->Subject_model->get_subject_by_class($data['student']['class_id']);
        // echo "<pre>";print_r($data['student']);exit();
        
        $this->load->library('form_validation');

        // $this->form_validation->set_rules('admission_no','Admission No.','required');
        $this->form_validation->set_rules('roll_no','Roll Number','required');
        $this->form_validation->set_rules('std_name','Student Full Name','required');
        $this->form_validation->set_rules('father_name','Father Name','required');
        // $this->form_validation->set_rules('class_id','Class','required');
        
        if($this->form_validation->run())     
        {
            $params = array(
                'class_id' => $this->input->post('class_id'),
                'roll_no' => $this->input->post('roll_no'),
                'tution_fee' => $this->input->post('tution_fee'),
                'admission_date' => $this->input->post('admission_date'),
                'std_name' => $this->input->post('std_name'),
                'father_name' => $this->input->post('father_name'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'std_category' => $this->input->post('std_category'),
                'blood_group' => $this->input->post('blood_group'),
                'birth_place' => $this->input->post('birth_place'),
                'nationality' => $this->input->post('nationality'),
                'religion' => $this->input->post('religion'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'institute' => $this->input->post('institute'),
                'previous_class' => $this->input->post('previous_class'),
                'year' => $this->input->post('year'),
                'marks' => $this->input->post('marks'),
            );
            $config['upload_path'] = 'uploads';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|';
            $this->load->library('upload',$config);
            if(!empty($_FILES['picture']['name'])){
                $this->upload->do_upload('img');
                $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                $params['picture']= $upload_data['file_name'];
            }
            $student_id = $this->admin->update_record('students',$id,$params);
            $guardian = array(
                'guardian_name' => $this->input->post('guardian_name'),
                'relation' => $this->input->post('relation'),
                'cnic' => $this->input->post('cnic'),
                'birthday' => $this->input->post('birthday'),
                'education' => $this->input->post('education'),
                'income' => $this->input->post('income'),
                'occupation' => $this->input->post('occupation'),
                'address' => $this->input->post('gaddress'),
                'city' => $this->input->post('gcity'),
                'state' => $this->input->post('gstate'),
                'phone' => $this->input->post('gphone'),
                'mobile' => $this->input->post('gmobile'),
                'email' => $this->input->post('gemail'),
                'emergency_contact_name' => $this->input->post('emergency_contact_name'),
                'emergency_contact_relationship' => $this->input->post('emergency_contact_relationship'),
                'emergency_contact_phone' => $this->input->post('emergency_contact_phone'),
                'emergency_contact_email' => $this->input->post('emergency_contact_email'),
            );
            $guardain_id = $this->student->update_std_guardian($data['guardian']['guardian_id'],$guardian);
            // if ($this->input->post('subject_id')) {
            //     $subjects = array(
            //         'subject_id' => $this->input->post('subject_id'),
            //     );
            //     $this->admin->update_record('student_subjects',$id,$subjects);
            // }
            $this->session->set_flashdata('success', 'Student profile updated successfully.');
            redirect('student');
        }else{
            $data['_view'] = 'student/profile';
            $this->load->view('layouts/main',$data);
        }
    }

    function get_subjects()
    {
        $subjects = $this->Subject_model->get_subject_by_class($_POST['class_id']);
        if (!empty($subjects)) {
            foreach ($subjects as $s) {
                $selected = ($s['id'] == $this->input->post('subject_id')) ? ' selected="selected"' : "";

                echo '<option value="'.$s['id'].'" '.$selected.'>'.$s['subject_name'].'</option>';
            }
        }
    }

    /*
     * Adding a new student
     */
    function add()
    {   
        $this->load->library('form_validation');
        $this->student->ensure_guardian_emergency_columns();

		$this->form_validation->set_rules('admission_no','Admission No.','required');
        $this->form_validation->set_rules('roll_no','Roll Number','required');
		$this->form_validation->set_rules('monthly_fee','Monthly Tution Fee','required');
		$this->form_validation->set_rules('std_name','Student Full Name','required');
        $this->form_validation->set_rules('father_name','Father Name','required');
        $this->form_validation->set_rules('guardian_phone','Guardian Phone','required');
		// $this->form_validation->set_rules('class_id','Class','required');
		
		if($this->form_validation->run())     
        {
            // echo"<pre>";print_r($_POST);exit;
            $desc = 'Payable created at admission time <br>Current Month<br>
            Tution Fee: '.$this->data['setting']['currency_symbol'].' '.$this->input->post('tution_fee').'<br>
            Admission Fee: '.$this->data['setting']['currency_symbol'].' '.$this->input->post('admission_fee').'<br>
            Annual Funds: '.$this->data['setting']['currency_symbol'].' '.$this->input->post('annual_fund').'<br>
            Practical Charges: '.$this->data['setting']['currency_symbol'].' '.$this->input->post('practical_charges').'<br>
            Test Session Fee: '.$this->data['setting']['currency_symbol'].' '.$this->input->post('test_fee');
            $params = array(
                'admission_no' => $this->input->post('admission_no'),
                'password' => md5($this->input->post('admission_no')),
                'class_id' => $this->input->post('class_id'),
                'roll_no' => $this->input->post('roll_no'),
                'monthly_fee' => $this->input->post('monthly_fee'),
                'tution_fee' => $this->input->post('tution_fee'),
                'admission_fee' => $this->input->post('admission_fee'),
                'annual_fund' => $this->input->post('annual_fund'),
                'practical_charges' => $this->input->post('practical_charges'),
                'test_fee' => $this->input->post('test_fee'),
                'admission_date' => $this->input->post('admission_date'),
                'std_name' => $this->input->post('std_name'),
                'father_name' => $this->input->post('father_name'),
                'dob' => $this->input->post('dob'),
                'gender' => $this->input->post('gender'),
                'std_category' => $this->input->post('std_category'),
                'blood_group' => $this->input->post('blood_group'),
                'birth_place' => $this->input->post('birth_place'),
                'nationality' => $this->input->post('nationality'),
                'religion' => $this->input->post('religion'),
                'address' => $this->input->post('address'),
                'city' => $this->input->post('city'),
                'state' => $this->input->post('state'),
                'phone' => $this->input->post('phone'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'institute' => $this->input->post('institute'),
                'previous_class' => $this->input->post('previous_class'),
                'year' => $this->input->post('year'),
                'marks' => $this->input->post('marks'),
                'role' => STUDENT,
                'status' => ACTIVE,
            );
            $student_id = $this->admin->add_record('students',$params);
            $guardian = array(
                'guardian_name' => $this->input->post('guardian_name'),
                'relation' => $this->input->post('relation'),
                'phone' => $this->input->post('guardian_phone'),
                'cnic' => $this->input->post('cnic'),
                'birthday' => $this->input->post('birthday'),
                'education' => $this->input->post('education'),
                'income' => $this->input->post('income'),
                'occupation' => $this->input->post('occupation'),
                'address' => $this->input->post('gaddress'),
                'city' => $this->input->post('gcity'),
                'state' => $this->input->post('gstate'),
                'mobile' => $this->input->post('gmobile'),
                'email' => $this->input->post('gemail'),
                'emergency_contact_name' => $this->input->post('emergency_contact_name'),
                'emergency_contact_relationship' => $this->input->post('emergency_contact_relationship'),
                'emergency_contact_phone' => $this->input->post('emergency_contact_phone'),
                'emergency_contact_email' => $this->input->post('emergency_contact_email'),
                'role' => GUARDIAN,
            );
            $guardian_id = $this->admin->add_record('guardians',$guardian);

            $std_g = array(
                'student_id' => $student_id,
                'guardian_id' => $guardian_id,
            );
            $stdg_id = $this->admin->add_record('std_guardians',$std_g);
            if ($this->input->post('subject_id')) {
                $subjects = array(
                    'student_id' => $student_id,
                    'subject_id' => $this->input->post('subject_id'),
                );
                $this->admin->add_record('student_subjects',$subjects);
            }
            $fee = array(
                'student_id' => $student_id,
                'title' => 'Admission Fee',
                'description' => $desc,
                'due_date' => $this->input->post('admission_date'),
                'last_date' => $this->input->post('admission_date'),
            );
            $this->admin->add_record('fee',$fee);
            $this->session->set_flashdata('success', 'New Admission submit successfully.');
            redirect('student');
        }else
        {
            $data['std'] = $this->student->get_admission_no();
            $data['classes'] = $this->admin->get_all_records('classes');
            $data['subjects'] = $this->admin->get_all_records('subjects');

            $data['_view'] = 'student/admission';
            $this->load->view('layouts/main',$data);
        }
    }

    function import()
    { 
        if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
                for($row=2; $row<=$highestRow; $row++)
                {
                    $status = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $admission_no = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $class_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $roll_no = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $fee = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $admission_date = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $std_name = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $father_name = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $dob = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $gender = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $relation = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $guardian_phone = $worksheet->getCellByColumnAndRow(11, $row)->getValue();

                    $std = $this->student->get_std_admission_no($admission_no);
                    if(empty($std)){
                        $data = array(
                            'admission_no' => $admission_no,
                            'password' => md5($admission_no),
                            'roll_no' => $roll_no,
                            'class_id' => $class_id,
                            'monthly_fee' => $fee,
                            'admission_date' => $admission_date,
                            'std_name' => $std_name,
                            'father_name' => $father_name,
                            'dob' => $dob,
                            'gender' => $gender,
                            'status' => $status,
                            'role' => STUDENT,
                            'status' => ACTIVE,
                        );
                        $student_id = $this->admin->add_record('students',$data);
                        $guardian = array(
                            'relation' => $relation,
                            'phone' => $guardian_phone,
                            'role' => GUARDIAN,
                        );
                        $guardian_id = $this->admin->add_record('guardians',$guardian);
                        $std_g = array(
                            'student_id' => $student_id,
                            'guardian_id' => $guardian_id,
                        );
                        $stdg_id = $this->admin->add_record('std_guardians',$std_g);
                        $desc = 'Payable created at admission time <br>Current Month<br>
                        Total Fee: '.$this->data['setting']['currency_symbol'].' '.$fee;
                        $fee = array(
                            'student_id' => $student_id,
                            'title' => 'Admission Fee',
                            'description' => $desc,
                            'due_date' => $admission_date,
                            'last_date' => $admission_date,
                        );
                        $this->admin->add_record('fee',$fee);
                    }   
                }
            }
            $this->session->set_flashdata('success', "Excelsheet Data uploaded Successfully");
            redirect('student');
        }else{
            $data['_view'] = 'student/import';
            $this->load->view('layouts/main',$data);
        }
    }

    function export()
    { 
        $data['students'] = $this->student->get_all_students();
        $data['classes'] = $this->admin->get_all_records('classes');

        $data['_view'] = 'student/export';
        $this->load->view('layouts/main',$data);
    }

    function export_class()
    { 
        $data['classes'] = $this->Class_model->get_all_classes();
        // echo'<pre>';print_r($data['classes']);exit;
        if(isset($_POST) && count($_POST)>0){
            $data['students'] = $this->student->get_all_students(null,$_POST['class_id']);
        }else{
            $data['students'] = '';
        }
        $data['_view'] = 'student/export_class';
        $this->load->view('layouts/main',$data);
    }

    function update_class()
    {
        $id=$this->input->post('id');
        $params = array(
            'class_id' => $this->input->post('class_id'),
        );
        $this->admin->update_record('students',$id,$params);
        $this->session->set_flashdata('success', 'Updated Student Class successfuly.');           
        redirect('student');
    }

    function sendSMS()
    {
        $phone_number = trim((string)$this->input->post('phone_number'));
        $message = trim((string)$this->input->post('message'));

        if ($phone_number === '') {
            $this->session->set_flashdata('info', 'Student phone number is missing!');
            redirect('student');
        }

        if ($message === '') {
            $this->session->set_flashdata('info', 'SMS message is required!');
            redirect('student');
        }

        $smsBody = $this->getSmsBody($message);

        if ($this->data['sms_setting']['gateway'] == TWILLIO) {
            if (empty($this->twilio) || empty($this->from)) {
                $this->session->set_flashdata('info', 'Twilio SMS settings are incomplete.');
                redirect('student');
            } else {
                $send_message = $this->twilio->messages->create(
                    $phone_number,
                    [
                        'from' =>  $this->from,
                        'body' => $smsBody
                    ]
                );
                if ($send_message->sid) {
                    $this->session->set_flashdata('success', 'New message sent!');
                    redirect('student');
                }
            }
        }elseif ($this->data['sms_setting']['gateway'] == VOODOOSMS) {
            if (empty($this->data['sms_setting']['sms_username']) || empty($this->data['sms_setting']['sms_password'])) {
                $this->session->set_flashdata('info', 'Voodoo SMS settings are incomplete.');
                redirect('student');
            } else {
                $normalizedPhoneNumber = $this->normalizeVoodooDestination($phone_number);
                $query = http_build_query(array(
                    'uid' => $this->data['sms_setting']['sms_username'],
                    'pass' => $this->data['sms_setting']['sms_password'],
                    'dest' => $normalizedPhoneNumber,
                    'orig' => $this->getVoodooOriginator(),
                    'msg' => $smsBody,
                    'format' => 'JSON',
                ));
                $url = 'https://www.voodoosms.com/vapi/server/sendSMS?'.$query;
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
                $output = curl_exec($ch);
                $curlError = curl_error($ch);
                curl_close($ch);

                if ($output === false) {
                    $this->session->set_flashdata('info', 'Voodoo SMS request failed: '.$curlError);
                    redirect('student');
                }

                $result = $this->parseVoodooResponse($output);
                $status = isset($result['status']) ? strtolower((string)$result['status']) : '';
                $error = isset($result['error']) ? trim((string)$result['error']) : '';
                if ($error !== '' || $status === 'error' || $status === 'failed') {
                    $this->session->set_flashdata('info', 'Voodoo SMS error: '.($error !== '' ? $error : 'message not accepted by gateway.'));
                    redirect('student');
                }

                $this->session->set_flashdata('success', 'New message sent!');
                redirect('student');
            }

        } else {
            $this->session->set_flashdata('info', 'Please configure an SMS gateway first.');
            redirect('student');
        }
            
    }

    function payfee($sid)
    {   
        $id = base64_decode(urldecode($sid));
        // check if the fee exists before trying to edit it
        $fee = $this->student->get_fee($id);
        
        if(isset($fee['id']))
        {
            if(isset($_POST) && count($_POST) >0){
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

                $this->student->update_fee($id,$params);
                $params2 = array(
                    'fee_id' => $fee['id'],
                );
                $this->admin->add_record('transections',$params2);
                $this->session->set_flashdata('success', 'Fee Paid successfully.'); 
                $data['fee'] = $this->fee->get_fee($fee['id']);
                $data['title'] = 'Fee Receipt';
                $data['total'] = $data['fee'] ['fine']+$data['std'] ['amount'];    
                $data['history'] = '';
                $html_content = $this->load->view('fee/print', $data,true);
                $this->pdf->create_fee($html_content, $file);
                redirect('student-profile/'.$sid);
            }else{
                
                redirect('student-profile/'.$id);
            }
        }
        else
            show_error('The fee you are trying to edit does not exist.');
    } 

    function pay_history($sid)
    {
        $id = base64_decode(urldecode($sid));
        // check if the fee exists before trying to edit it
        $fee = $this->student->get_fee($id);

        $data['fee'] = $this->fee->get_fee($fee['id']);
        $pdf_file = 'Receipt-'.$id.'_'.date('d-M-Y');
        $data['title'] = 'Fee Receipt';
        $data['total'] = $data['fee']['fine']+$data['fee'] ['amount'];    
        $data['history'] = ACTIVE;
        // echo"pre>";print_r($data['fee']);exit;
        $html_content = $this->load->view('fee/print', $data,true);
        $this->pdf->create_fee($html_content, $pdf_file);
        $this->load->helper('download');
        $content = file_get_contents(site_url() . 'uploads/pdf_fee/'.$pdf_file. ".pdf");
        $name = $pdf_file. ".pdf";
        force_download($name, $content);
        redirect('student-profile/'.$sid);
    }

    function send_email(){
        if(isset($_POST) && count($_POST)>0){
            $from_email = $this->data['setting']['email'];
            $mail_to = $_POST['receiver_email'];
            // $mail_to = "hafizhassan229@gmail.com";
            // $pass = "hafiz36";
            //Load email library
            $mail=urlencode(base64_encode($mail_to));
            $this->load->library('email');
            $this->email->from($from_email, 'cranbrookcollege.uk');
            $this->email->to($mail_to);
            $this->email->subject('New alert');
            $msg = "<div style='padding:40px 100px;margin: 20px;'>
                <h2 style='margin:20px;font-weight:bold'>New Message</h2>
                <hr>
                <p style='font-weight:bold;font-size: medium'>".$_POST['message']."</p>
                <p style='font-weight:bold;font-size: medium'>Please visit this <a href='http://www.cranbrookcollege.uk/'>Click me</a><br>Email: ".$mail_to."</p>
                </div>";
            $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            $this->email->set_header('Content-type', 'text/html');
            $this->email->message($msg);
            $this->email->send();
            $this->session->set_flashdata('success', 'Email send successfully.'); 
            redirect('student-profile/'.$_POST['id']);
        }else{

        }
    }

    function update_status($id)
    {
        $params = array(
            'status' => ACTIVE,
        );
        $this->admin->update_record('students',$id,$params);
        $this->session->set_flashdata('success', 'Student restore successfuly.');
        redirect('student');
    }

    /*
     * Deleting student
     */
    function remove($id)
    {
        $student = $this->admin->get_record('students',$id);

        // check if the student exists before trying to delete it
        if(isset($student['id']))
        {
            $params = array(
                'status' => DELETED,
            );
            $this->admin->update_record('students',$id,$params);
            // $this->student->delete_student($id);
            $this->session->set_flashdata('success', 'Student deleted successfully.');
            redirect('student');
        }
        else
            show_error('The student you are trying to delete does not exist.');
    }

}
