<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Setting_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get setting by id
     */
    function get_setting($tbl,$id)
    {
        return $this->db->get_where($tbl,array('id'=>$id))->row_array();
    }
    
    /*
     * Get all setting count
     */
    function get_all_setting_count($tbl)
    {
        $this->db->from($tbl);
        return $this->db->count_all_results();
    }
        
    /*
     * Get all setting
     */
    function get_all_setting($tbl)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get($tbl)->result_array();
    }
        
    /*
     * function to add new setting
     */
    function add_setting($tbl,$params)
    {
        $this->db->insert($tbl,$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update setting
     */
    function update_setting($tbl,$id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update($tbl,$params);
    }
    
    /*
     * function to delete setting
     */
    function delete_setting($tbl,$id)
    {
        return $this->db->delete($tbl,array('id'=>$id));
    }
}
