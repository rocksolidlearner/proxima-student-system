<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get user by id
     */
    function get_user($id)
    {
        return $this->db->get_where('users',array('id'=>$id))->row_array();
    }

    function get_user_email($email)
    {
        return $this->db->get_where('users',array('email'=>$email))->row_array();
    }
    
    /*
     * Get all users count
     */
    function get_all_users_count()
    {
        $this->db->from('users');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all users
     */
    function get_all_users($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('users')->result_array();
    }

    function get_all_search_users($value)
    {
        $this->db->order_by('id', 'desc');
        $this->db->like('name', $value);
        return $this->db->get('users')->result_array();
    }
         
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        return $this->db->delete('users',array('id'=>$id));
    }
}
