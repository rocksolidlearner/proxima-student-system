<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Student_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get student by id
     */
    function get_student($id)
    {
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        $this->db->where('students.id', $id);
        return $this->db->get_where('students')->row_array();
    }

    function get_std_admission_no($adm_no)
    {
        return $this->db->get_where('students',array('admission_no' => $adm_no))->row_array();
    }

    function get_fee($id)
    {
        $this->db->where('status !=', DELETED);
        $this->db->where('status',DEFAULTER);
        return $this->db->get_where('fee',array('student_id' => $id))->row_array();
    }

    function get_parent($id)
    {
        $this->db->where('id', $id);
        $data = $this->db->get_where('guardians')->row_array();
        $this->db->where('guardian_id', $id);
        $data['stds'] = $this->db->get_where('std_guardians')->result_array();
        return $data;
    }

    function get_std_guardian($id)
    {
        $this->db->select('std_guardians.*,guardians.*');
        $this->db->join('guardians', 'guardians.id=std_guardians.guardian_id','left outer');
        $this->db->where('student_id', $id);
        return $this->db->get_where('std_guardians')->row_array();
    } 

    function get_admission_no()
    {
        return $this->db->select('admission_no')
        ->order_by('admission_no',"desc")
        ->limit(1)
        ->get('students')->row();
    }
    /*
     * Get all students count
     */
    function get_all_students_count()
    {
        $this->db->from('students');
        return $this->db->count_all_results();   
    }

    function get_parent_childs_count()
    {
        $this->db->select('COUNT(std_guardians.student_id) as total_stds');
        $this->db->join('guardians', 'guardians.id=std_guardians.guaridans_id','left outer');
        $this->db->from('std_guardians');
        return $this->db->count_all_results();
    }

    /*
     * Get all students
     */
    function get_all_students($deleted=null,$class_id=null,$subject_id=null,$f_date=null,$to_date=null)
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('students.*,classes.class_name,classes.batch_id,(SELECT batch_name from batches where batches.id=classes.batch_id) as batch_name,
        guardians.guardian_name,guardians.phone as gphone,guardians.relation')
            ->join('classes', 'classes.id=students.class_id','left outer')
            ->join('std_guardians', 'std_guardians.student_id=students.id','left outer')
            ->join('guardians', 'guardians.id=std_guardians.guardian_id','left outer');
        if($deleted){
            $this->db->where('students.status',$deleted);
        }else{
            $this->db->where('students.status',ACTIVE); 
        }
        if($class_id){
            $this->db->where('students.class_id',$class_id);
        }
        if ($subject_id) {
            $this->db->join('student_subjects', 'student_subjects.student_id=students.id','left outer');
            $this->db->where('student_subjects.subject_id',$subject_id);
        }
        if ($f_date) {
            $this->db->where('students.admission_date  BETWEEN "'.$f_date.'" AND "'.$to_date.'"');
        }
        return $this->db->get('students')->result_array();
    }

    function get_all_parents()
    {
        $this->db->order_by('id', 'desc');
        $data = $this->db->get('guardians')->result_array();
        foreach($data as $key=> $g){
            $this->db->select('COUNT(std_guardians.student_id) as total_stds');
            $this->db->where('guardian_id',$g['id']);
            $data[$key]['stds']=$this->db->get('std_guardians')->row_array();
        }
        return $data;
    }

    function get_student_by_class($class_id)
    {
        $this->db->order_by('id', 'desc');
        $this->db->select('students.*,classes.class_name');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        $this->db->where('students.class_id',$class_id);
        return $this->db->get('students')->result_array();
    }
    
    function std_parent($params)
    {
        $this->db->insert_batch('std_guardians',$params);
        // return $this->db->insert_id();
    }
    
    /*
     * function to update student
     */
    function update_std_guardian($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('guardians',$params);
    }

    function update_fee($id,$params)
    {
        $this->db->where('student_id',$id);
        return $this->db->update('fee',$params);
    }
    
    /*
     * function to delete student
     */
    function delete_student($id)
    {
        $this->db->delete('std_guardians',array('student_id'=>$id));
        return $this->db->delete('students',array('id'=>$id));
    }

    function delete_parent_std($id)
    {
        return $this->db->delete('std_guardians',array('guardian_id'=>$id));
    }
}
