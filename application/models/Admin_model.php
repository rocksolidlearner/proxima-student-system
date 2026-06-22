<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Admin_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function login($tbl,$params)
    {
        return $this->db->get_where($tbl,$params)->row_array();
    }
    
    /*
     * Get record by id
     */
    function get_record($tbl,$id)
    {
        return $this->db->get_where($tbl,array('id'=>$id))->row_array();
    }
    
    /*
     * Get all record count
     */
    function get_all_record_count($tbl)
    {
        $this->db->from($tbl);
        return $this->db->count_all_results();
    }
        
    /*
     * Get all record
     */
    function get_all_records($tbl)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get($tbl)->result_array();
    }
        
    /*
     * function to add new record
     */
    function add_record($tbl,$params)
    {
        $this->db->insert($tbl,$params);
        return $this->db->insert_id();
    }

    function add_batch_record($tbl,$params)
    {
        $this->db->insert_batch($tbl,$params);
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

    function delete_special_record($tbl,$column,$id)
    {
        return $this->db->delete($tbl,array($column=>$id));
    }
}
