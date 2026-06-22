<?php
/* 
 * Developed by Hafiz Hassan 
 * Phon# +92303 7859398
 * Date: 2/7/2020
 */
 
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get job by id
     */
    function login($params)
    {
        return $this->db->get_where('employees',$params)->row_array();
    }

    function get_teacher()
    {
        return $this->db->get_where('employees',array('id' => $this->session->userdata('id')))->row_array();
    }

    function get_class($id)
    {
        $this->db->select('students.*,classes.id as cid,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id');
        return $this->db->get_where('students',array('students.id' => $id))->row_array();
    }

    function get_student($id,$fdate=null,$tdate=null)
    {
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id');
        $this->db->where('students.class_id',$id);
        if ($fdate) {
            $this->db->where('DATE(students.date_created) >=',$fdate);
            $this->db->where('DATE(students.date_created) <=',$tdate);
        }
        return $this->db->get('students')->result_array();
    }

    function get_attendance_report($date,$status=null,$class_id,$to_date=null)
    {
        $this->db->select('attendance.*,students.std_name,students.class_id,students.roll_no,students.father_name,students.phone,classes.class_name');
        $this->db->join('students', 'students.id = attendance.student_id','left outer');
        $this->db->join('classes', 'classes.id = students.class_id','left outer');
        $this->db->where('students.class_id', $class_id);
        if ($to_date) {
            $this->db->where('attendance.date_created >=', $date);
            $this->db->where('attendance.date_created <=', $to_date);
        }else{
            $this->db->where('attendance.date_created', $date);
        }
        $this->db->order_by('attendance.date_created', 'asc');
        // $this->db->group_by('attendance_days.attend_id');
        // $this->db->group_by('attendance.student_id');
        $data = $this->db->get('attendance')->result_array();
        foreach ($data as $key => $v) {
            $this->db->where('attend_id',$v['id']);
            if ($status) {
                $this->db->where('attendance_days.status', $status);
            }
            $data[$key]['days']=$this->db->get('attendance_days')->result_array();
        }
        return $data;
    }
        
    /*
     * Get all tbl_account
     */
    function get_all_students()
    {
        $this->db->order_by('id', 'class_name');
        $data =  $this->db->get('classes')->result_array();
        foreach ($data as $key => $v) {
            $this->db->where('class_id',$v['id']);
            $data[$key]['students']=$this->db->get('students')->result_array();
        }
        return $data;
    }

    function get_all_assignments($id)
    {
        $this->db->select('assignments.*,classes.class_name,subjects.subject_name');
        $this->db->join('classes', 'classes.id=assignments.class_id');
        $this->db->join('subjects', 'subjects.id=assignments.subject_id');
        $this->db->where('assignments.student_id',$id);
        return $this->db->get('assignments')->result_array();
    }

    function get_all_lectures()
    {
        $this->db->select('time_tables.*,tt_shifts.shift_name,tt_shifts.start_time,tt_shifts.end_time');
        $this->db->join('tt_shifts', 'tt_shifts.id=time_tables.shift_id');
        $this->db->where('time_tables.teacher_id',$this->session->userdata('id'));
        return $this->db->get('time_tables')->result_array();
    }

    function get_all_notes()
    {
        $this->db->select('teacher_notes.*,classes.class_name,students.std_name');
        $this->db->join('students', 'students.id=teacher_notes.student_id');
        $this->db->join('classes', 'classes.id=students.class_id');
        $this->db->where('teacher_notes.teacher_id',$this->session->userdata('id'));
        return $this->db->get('teacher_notes')->result_array();
    }

    function get_all_student()
    {
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id');
        // $this->db->where('teacher_notes.teacher_id',$this->session->userdata('id'));
        return $this->db->get('students')->result_array();
    }

    function get_all_classes()
    {
        $this->db->order_by('class_name','asc');
        // $this->db->where('teacher_notes.teacher_id',$this->session->userdata('id'));
        return $this->db->get('classes')->result_array();
    }
    
    /*
     * function to update post
     */
    function update_teacher($params)
    {
        $this->db->where('id',$this->session->userdata('id'));
        return $this->db->update('employees',$params);
    }

    function update_account($params)
    {
        $this->db->where('id',$this->session->userdata('id'));
        return $this->db->update('employees',$params);
    }
}
