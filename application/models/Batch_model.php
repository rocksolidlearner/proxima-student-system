<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Batch_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get batche by id
     */
    function get_batche($id)
    {
        return $this->db->get_where('batches',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all batches count
     */
    function get_all_batches_count()
    {
        $this->db->from('batches');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all batches
     */
    function get_all_batches($params = array())
    {
        $this->db->order_by('batch_name', 'asc')
        ->select('batches.*,
        (SELECT COUNT(batch_id) from classes where batch_id=batches.id) as classes');
        $data = $this->db->get('batches')->result_array();
        foreach($data as $key => $d){
            $this->db->select('COUNT(students.id) as total_students');
            $this->db->join('classes','classes.id=students.class_id','left outer');
            $this->db->join('batches','batches.id=classes.batch_id','left outer');
            $this->db->where('classes.batch_id',$d['id']);
            $data[$key]['students']=$this->db->count_all_results('students');
        }
        return $data;
    }
        
    /*
     * function to add new batch
     */
    function add_batch($params)
    {
        $this->db->insert('batches',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update batch
     */
    function update_batch($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('batches',$params);
    }
    
    /*
     * function to delete batch
     */
    function delete_batch($id)
    {
        return $this->db->delete('batches',array('id'=>$id));
    }
}
