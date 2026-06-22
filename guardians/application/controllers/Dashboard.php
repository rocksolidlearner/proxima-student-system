<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */
 
class Dashboard extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model','dashboard');
        $this->load->library('pdf');
    }

    function index()
    {
    	$data['childs'] = $this->dashboard->get_all_childs();

        $data['_view'] = 'index';
        $this->load->view('layouts/main',$data);
    }

    function weekly_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $data['students'] = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_childs();
            $data['_view'] = 'reports/weekly';
            $this->load->view('layouts/main',$data);
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $title = 'Student Weekly Report';
            $this->generate_pdf($class['cid'],$title,$_POST['from_date'],$_POST['to_date']);
            $_SESSION['pdf_file'] = 'student_weekly_report_'.date('d-M-Y-h-m');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_childs();
            
            $data['_view'] = 'reports/weekly';
            $this->load->view('layouts/main',$data); 
        }           
    }

    function progress_report()
    {
        if (isset($_POST['view']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $data['students'] = $this->dashboard->get_student($class['cid'],$_POST['from_date'],$_POST['to_date']);
            $data['results'] = $this->dashboard->get_all_childs();
            $data['_view'] = 'reports/progress';
            $this->load->view('layouts/main',$data);
            // redirect('student-list');
        }elseif (isset($_POST['download']) && count($_POST) > 0) {
            $class = $this->dashboard->get_class($_POST['student_id']);
            $title = 'Student Progress Report';
            $this->generate_pdf($class['cid'],$title,$_POST['from_date'],$_POST['to_date']);
            $_SESSION['pdf_file'] = 'student_progress_report_'.date('d-M-Y-h-m');
            $this->load->helper('download');
            $data = file_get_contents(site_url() . 'uploads/'.$_SESSION['pdf_file']. ".pdf");
            $name = $_SESSION['pdf_file']. ".pdf";
            force_download($name, $data);
        }else{
            $data['results'] = $this->dashboard->get_all_childs();
            $data['_view'] = 'reports/progress';
            $this->load->view('layouts/main',$data); 
        }           
    }
    
    function generate_pdf($id,$title,$fdate=null,$tdate=null)
    {
        if ($fdate) {
            $data['students'] = $this->dashboard->get_student($id,$fdate,$tdate);
        }else{
            $data['students'] = $this->dashboard->get_student($id);
        }
        $data['title'] = $title;

        $html_content = $this->load->view('reports/download_list', $data,true);
        $this->pdf->create($html_content, $_SESSION['pdf_file']);
    }


    function profile()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('cpassword','Current Password','required');
        $this->form_validation->set_rules('newpassword','New Password','required');
        $this->form_validation->set_rules('againpassword','New Password again','required');
        
        if($this->form_validation->run())     
        {   
            if ($this->session->userdata('password') != md5($_POST['cpassword'])) {
               $this->session->set_flashdata('info', 'Current Password is not correct.');
                redirect('profile');
            }else{
                if ($_POST['newpassword'] != $_POST['againpassword']) {
                    $this->session->set_flashdata('info', 'Agin Password is not matched.');
                    redirect('profile');
                }else{
                    $params = array(
                        'password' => md5($this->input->post('againpassword')),
                    );
                    
                    $pass_id = $this->dashboard->update_account($this->session->userdata('id'),$params);
                    $this->session->set_flashdata('success', 'Password updated successfully.');
                    redirect('profile');
                }
            }
                
        }else{
            $data['_view'] = 'profile';
            $this->load->view('layouts/main',$data);   
        }
            
    }

}
