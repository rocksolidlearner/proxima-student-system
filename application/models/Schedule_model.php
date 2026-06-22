<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Schedule_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get schedule by id
     */
    function get_schedule($id)
    {
        $this->db->select('schedule_subjects.*,schedules.from_date,classes.class_name,classes.batch_id,
        (SELECT batch_name from batches where batches.id=classes.batch_id) as batch_name,
        subjects.subject_name,marks.total_marks,marks.passing_marks,marks.week,marks.id as mark_id,
        employees.employee_name');
        $this->db->join('schedules', 'schedules.id=schedule_subjects.schedule_id','left outer')
                ->join('classes', 'classes.id=schedules.class_id','left outer')
                ->join('subjects', 'subjects.id=schedule_subjects.subject_id','left outer')
                ->join('marks', 'marks.schedule_subject_id=schedule_subjects.schedule_id','left outer')
                ->join('employees', 'employees.id=schedule_subjects.teacher_id','left outer')
                ->where('schedule_subjects.id', $id);
        $data = $this->db->get_where('schedule_subjects')->row_array();
        
        $this->db->select('marks_std.*,students.std_name')
                ->join('students', 'students.id=marks_std.student_id','left outer')
                ->where('marks_std.marks_id', $data['mark_id']);
        $data['std_marks'] = $this->db->get('marks_std')->result_array();
        
        return $data;
    }

    function get_topper_report($filter)
    {
        $this->db->select('schedule_subjects.*,schedules.from_date,classes.class_name,classes.batch_id,
        (SELECT batch_name from batches where batches.id=classes.batch_id) as batch_name,
         marks.total_marks,marks.id as marks_id');
        $this->db->join('schedules', 'schedules.id=schedule_subjects.schedule_id','left outer')
                ->join('classes', 'classes.id=schedules.class_id','left outer')
                ->join('marks', 'marks.schedule_subject_id=schedule_subjects.schedule_id','left outer');
        if($filter['class_id']){
            $this->db->where('schedules.class_id', $filter['class_id']);
        }
        if(isset($filter['subject_id'])){
            $this->db->where('schedule_subjects.subject_id', $filter['subject_id']);
        }
        if($filter['from_date'] || $filter['to_date']){
            $this->db->where('schedules.from_date  BETWEEN "'.$filter['from_date'].'" AND "'.$filter['to_date'].'"');
        }
        if($filter['order_by1']=='tmarks'){
            $this->db->order_by('marks.total_marks', $filter['order_by']);
        }
            // $this->db->order_by('schedules.id', $filter['order_by']);
        $data = $this->db->get('schedule_subjects')->result_array();
        // echo'<pre>';print_r($data);exit;
        foreach($data as $key => $d){
            $this->db->select('marks_std.*,students.std_name')
                    ->join('students', 'students.id=marks_std.student_id','left outer')
                    ->where('marks_std.marks_id', $d['marks_id']);
            if($filter['order_by1']=='name'){
                $this->db->order_by('students.std_name', $filter['order_by']);
            }
            // if($filter['marks']){
            //     $this->db->where('marks_std.marks >=', $filter['marks']);
            // }
            $data[$key]['std_marks'] = $this->db->get('marks_std')->result_array();
        }
        return $data;
    }

    function get_mark($id)
    {
        return $this->db->get_where('marks',array('schedule_subject_id'=>$id))->row_array();
    }
    /*
     * Get all schedules count
     */
    function get_all_schedules_count()
    {
        $this->db->from('schedules');
        return $this->db->count_all_results();   
    }

    /*
     * Get all schedules
     */
    function get_all_schedules($fdate=null,$tdate=null,$class_id=null)
    {
        $this->db->order_by('id', 'desc')
                ->select('schedule_subjects.*,schedules.schedule_name,schedules.from_date,schedules.to_date,
        classes.class_name,subjects.subject_name,
        (SELECT COUNT(student_id) from student_subjects where student_subjects.subject_id=schedule_subjects.subject_id) as total_stds,
        employees.employee_name')
            ->join('schedules', 'schedules.id=schedule_subjects.schedule_id','left outer')
            ->join('classes', 'classes.id=schedules.class_id','left outer')
            ->join('subjects', 'subjects.id=schedule_subjects.subject_id','left outer')
            ->join('employees', 'employees.id=schedule_subjects.teacher_id','left outer');
        if($class_id){
            $this->db->where('schedules.class_id',$class_id);   
        }
        if($fdate){
            $this->db->where('schedules.from_date BETWEEN "'.$fdate.'"');
            // $this->db->where('schedules.from_date >= "',$fdate);
        }
        if($tdate){
            $this->db->where('schedules.to_date BETWEEN "'.$tdate.'"');
            // $this->db->where('schedules.to_date <= "',$tdate);
        }
        $this->db->where('schedule_subjects.status !=',DELETED);
        return $this->db->get('schedule_subjects')->result_array();
    }
    
    /*
     * function to update schedule
     */
    function update_marks($id,$params)
    {
        $this->db->where('schedule_subject_id',$id);
        return $this->db->update('marks',$params);
    }

    function update_marksheet($id,$params)
    {
        $this->db->where('marks_id',$id);
        return $this->db->update('marks_std',$params);
    }
    
    /*
     * function to delete schedule
     */
    function delete_schedule($id)
    {
        $this->db->delete('std_guardians',array('schedule_id'=>$id));
        return $this->db->delete('schedules',array('id'=>$id));
    }

    function delete_parent_std($id)
    {
        return $this->db->delete('std_guardians',array('guardian_id'=>$id));
    }
}
