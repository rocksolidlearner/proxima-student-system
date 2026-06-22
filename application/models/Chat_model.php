<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */

class Chat_model extends CI_Model {

	function add_message($message,$send_to, $guid)
	{
//        $this->db->where('id',$nickname);
//        $send_to = $this->db->get('tbl_users');
        if (!empty($message)){
            $data = array(
                'message'   => (string) $message,
                'nickname'  => (string) $this->session->userdata('name'),
                'send_by_role' => $this->session->userdata('role'),
                'send_by' => $this->session->userdata('id'),
                'send_to' => $send_to,
                'guid'      => (string) $guid,
                'timestamp' => time(),
            );

            $this->db->insert('messages', $data);
        }
	}

	function get_messages($user_id)
	{ 
        $this->db->select('messages.*,users.name, users.img');
        $this->db->join('users','users.id = messages.send_by','left outer');
        // $this->db->join('clients','clients.id = messages.send_by','left outer');
		// $this->db->where('messages.timestamp >', $timestamp);
        // if($this->session->userdata('role') == CLIENT){
            $this->db->where('messages.send_to',$user_id);
            $this->db->where('messages.send_by', $this->session->userdata('id'));
            $this->db->or_where('messages.send_to', $this->session->userdata('id'));
            $this->db->where('messages.send_by',$user_id);
        // }else{
        //     $this->db->where('messages.send_to',$user_id);
        //     $this->db->or_where('messages.send_by', $this->session->userdata('id'));
        //     $this->db->where('messages.send_to', $this->session->userdata('id'));
        //     $this->db->or_where('messages.send_by',$user_id);
        // }
		$this->db->order_by('messages.timestamp', 'DESC');
		$this->db->limit(100);
        $query = $this->db->get('messages');

		return array_reverse($query->result_array());
    }

    function get_new_messages()
    {
        $this->db->select('messages.*,tbl_users.first_name as user_f_name,tbl_users.last_name as user_l_name');
        $this->db->join('tbl_users','tbl_users.id = messages.send_by','left outer');
        $this->db->where('messages.send_to', $this->session->userdata('id'));
        $this->db->order_by('messages.timestamp', 'DESC');
        $this->db->limit(5);
        $this->db->where('messages.site_id', $_SESSION['site_id']);
        return $this->db->get('messages')->result_array();
    }

    function remove_message($id)
    {
        return $this->db->delete('messages',array('id'=>$id));
    }

}
