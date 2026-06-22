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
        $this->db->select('students.*,classes.class_name,batches.batch_name');
        $this->db->join('classes', 'classes.id=students.class_id');
        $this->db->join('batches', 'batches.id=classes.batch_id');
        return $this->db->get_where('students',$params)->row_array();
    }
        
    /*
     * Get all tbl_account
     */
    function get_all_subjects()
    {
        // $this->db->order_by('id', 'desc');
        $this->db->select('student_subjects.*,subjects.subject_name,std_assignments.upload_file');
        $this->db->join('subjects', 'subjects.id=student_subjects.subject_id');
        $this->db->join('std_assignments', 'std_assignments.subject_id=student_subjects.subject_id','left outer');
        $this->db->where('student_subjects.student_id',$this->session->userdata('id'));
        
        return $this->db->get('student_subjects')->result_array();
    }
    /*
     * function to add new post
     */
    function new_learners($params)
    {
        $this->db->insert('learners',$params);
        return $this->db->insert_id();
    }

    function add_payment($params)
    {
        $this->db->insert('payments',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update post
     */
    function update_account($params)
    {
        $this->db->where('id',$this->session->userdata('id'));
        return $this->db->update('students',$params);
    }
    
    /*
     * function to delete post
     */
    function delete_job($id)
    {
        return $this->db->delete('jobs',array('id'=>$id));
    }
}
