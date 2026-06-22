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
        return $this->db->get_where('guardians',$params)->row_array();
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
        
    /*
     * Get all tbl_account
     */
    function get_all_childs()
    {
        // $this->db->order_by('id', 'desc');
        $this->db->select('std_guardians.*,students.std_name,students.roll_no,classes.class_name');
        $this->db->join('students', 'students.id=std_guardians.student_id');
        $this->db->join('classes', 'classes.id=students.class_id');
        $this->db->where('std_guardians.guardian_id',$this->session->userdata('id'));
        
        return $this->db->get('std_guardians')->result_array();
    }
    /*
     * function to add new post
     */
    function add_job($params)
    {
        $this->db->insert('jobs',$params);
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
        return $this->db->update('guardians',$params);
    }
    
    /*
     * function to delete post
     */
    function delete_job($id)
    {
        return $this->db->delete('jobs',array('id'=>$id));
    }
}
