<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get record by id
     */
    function get_record($tbl,$id)
    {
        return $this->db->get_where($tbl,array('id'=>$id))->row_array();
    }

    function get_class($id)
    {
        $this->db->select('students.*,classes.id as cid,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        return $this->db->get_where('students',array('students.id' => $id))->row_array();
    }

    function get_student($id=null,$fdate=null,$tdate=null)
    {
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        if ($id) {
            $this->db->where('students.class_id',$id);
        }
        if ($fdate) {
            $this->db->where('DATE(students.date_created) >=',$fdate);
            $this->db->where('DATE(students.date_created) <=',$tdate);
        }
        return $this->db->get('students')->result_array();
    }

    function get_attendance_report($date,$status=null,$class_id,$to_date=null)
    {
        if ($to_date) {
            $this->db->select('attendance.*,students.std_name,students.class_id,students.roll_no,students.father_name,students.phone,classes.class_name');
            $this->db->join('students', 'students.id = attendance.student_id','left outer');
            $this->db->join('classes', 'classes.id = students.class_id','left outer');
            $this->db->where('students.class_id', $class_id);
            $this->db->order_by('attendance.date_created', 'asc');
            $this->db->where('attendance.date_created  BETWEEN "'.$date.'" AND "'.$to_date.'"');
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
        }else{
            $this->db->select('attendance.*,students.std_name,students.class_id,
            students.roll_no,students.father_name,students.phone,classes.class_name,attendance_days.status');
            $this->db->join('students', 'students.id = attendance.student_id','left outer');
            $this->db->join('classes', 'classes.id = students.class_id','left outer');
            $this->db->join('attendance_days', 'attendance_days.attend_id = attendance.id','left outer');
            if ($status) {
                $this->db->where('attendance_days.status', $status);
            }
            $this->db->where('students.class_id', $class_id);
            $this->db->order_by('attendance.date_created', 'asc');
            $this->db->where('attendance_days.day', $date);
            $data = $this->db->get('attendance')->result_array();
        }
        
        return $data;
    }

    function get_course_data($tbl,$id)
    {
        $this->db->where('course_id',$id);
        return $this->db->get($tbl)->result_array();
    }
    
    /*
     * Get all record count
     */
    function get_all_record_count($tbl)
    {
        $this->db->from($tbl);
        return $this->db->count_all_results();
    }

    function get_total_fee()
    {
        $this->db->select('SUM(amount) as total_fee');
        $this->db->where('status',PAID);
        return $this->db->get('fee')->row_array();
    }

    function get_total_expenses()
    {
        $this->db->select('SUM(amount) as total_expenses');
        return $this->db->get('expenses')->row_array();
    }
        
    /*
     * Get all record
     */
    function get_all_employees($role)
    {
        $this->db->order_by('id', 'desc')
                ->select('employees.*,(SELECT COUNT(class_id) from teacher_classes where teacher_id=employees.id) as classes')
               ->where('role', $role);
        return $this->db->get('employees')->result_array();
    }

    function get_all_books()
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('books.*,departments.department_name');
        $this->db->join('departments', 'departments.id=books.department_id');
        return $this->db->get('books')->result_array();
    }

    function get_assign_books()
    {
        $this->db->select('book_assign.*,students.std_name,books.book_name');
        $this->db->join('students', 'students.id=book_assign.student_id');
        $this->db->join('books', 'books.id=book_assign.book_id');
        return $this->db->get('book_assign')->result_array();
    }

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

    function get_all_student()
    {
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id');
        return $this->db->get('students')->result_array();
    }

    function get_all_classes()
    {
        $this->db->order_by('class_name','asc');
        return $this->db->get('classes')->result_array();
    }

    function get_all_timetables()
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('time_tables.*,classes.class_name,subjects.subject_name,
        employees.employee_name,tt_shifts.shift_name')
                ->join('classes', 'classes.id=time_tables.class_id')
                ->join('employees', 'employees.id=time_tables.teacher_id')
                ->join('subjects', 'subjects.id=time_tables.subject_id')
                ->join('tt_shifts', 'tt_shifts.id=time_tables.shift_id');
        return $this->db->get('time_tables')->result_array();
    }

    function get_all_shifts()
    {
        $this->db->order_by('id', 'desc');
        $data= $this->db->get('tt_shifts')->result_array();
        foreach($data as $key => $v){
            $this->db->where('shift_id',$v['id']);
            $data[$key]['days']=$this->db->get('time_tables')->result_array();
        }
        return $data;
    }

    function get_all_projects($type=null)
    {
        $this->db->order_by('id', 'desc');
        if($type){
        $this->db->where('type', $type);
        }
        return $this->db->get('projects')->result_array();
    }

        
    /*
     * function to add new record
     */
    function add_record($tbl,$params)
    {
        $this->db->insert($tbl,$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update record
     */
    function update_record($tbl,$id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update($tbl,$params);
    }
    
    /*
     * function to delete record
     */
    function delete_record($tbl,$id)
    {
        return $this->db->delete($tbl,array('id'=>$id));
    }

    function delete_course_data($tbl,$id)
    {
        return $this->db->delete($tbl,array('course_id'=>$id));
    }
}
