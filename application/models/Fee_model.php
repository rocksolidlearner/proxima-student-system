<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Fee_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get fee by id
     */
    function get_fee($id)
    {
        $this->db->select('fee.*,students.roll_no,students.std_name,students.father_name');
        $this->db->join('students', 'students.id=fee.student_id');
        return $this->db->get_where('fee',array('fee.id'=>$id))->row_array();
    }

    function get_student($id=null,$status=null)
    {
        $this->db->select('fee.*,students.roll_no,students.std_name,students.father_name,classes.class_name');
        $this->db->join('students', 'students.id=fee.student_id','left outer');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        if ($id) {
            $this->db->where('students.class_id',$id);
        }
        if ($status==OVERDUE) {
            $this->db->where('fee.last_date <',date('Y-m-d'));
        }
        if($status != OVERDUE){
            $this->db->where('fee.status',$status);
        }
        return $this->db->get('fee')->result_array();
    }
    
    /*
     * Get all fee count
     */
    function get_all_fee_count($status)
    {
        $this->db->from('fee');
        $this->db->where('status',$status);
        return $this->db->count_all_results();
    }
        
    /*
     * Get all fee
     */
    function get_all_fee($status=null)
    {
        $this->db->select('fee.*,students.roll_no,students.std_name,classes.class_name,classes.batch_id,(SELECT batch_name from batches where batches.id=classes.batch_id) as batch_name');
        $this->db->join('students', 'students.id=fee.student_id','left outer');
        $this->db->join('classes', 'classes.id=students.class_id','left outer');
        $this->db->order_by('fee.id', 'asc');
        $this->db->where('fee.status !=', DELETED);
        if($status){
            $this->db->where('fee.status',$status);
        }
        return $this->db->get('fee')->result_array();
    }
        
    /*
     * function to add new fee
     */
    function add_fee($params)
    {
        $this->db->insert('fee',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update fee
     */
    function update_fee($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('fee',$params);
    }
    
    /*
     * function to delete fee
     */
    function delete_fee($id)
    {
        return $this->db->delete('fee',array('id'=>$id));
    }
}
