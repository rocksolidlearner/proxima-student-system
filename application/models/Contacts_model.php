<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function ensure_crm_columns()
    {
        $columns = array(
            'interaction_type' => "ALTER TABLE contacts ADD COLUMN interaction_type VARCHAR(50) NULL AFTER contact_role",
            'preferred_channel' => "ALTER TABLE contacts ADD COLUMN preferred_channel VARCHAR(50) NULL AFTER interaction_type",
            'priority' => "ALTER TABLE contacts ADD COLUMN priority VARCHAR(20) NULL AFTER preferred_channel",
            'follow_up_date' => "ALTER TABLE contacts ADD COLUMN follow_up_date DATE NULL AFTER priority",
            'assigned_user_id' => "ALTER TABLE contacts ADD COLUMN assigned_user_id INT NULL AFTER follow_up_date",
            'last_contacted_at' => "ALTER TABLE contacts ADD COLUMN last_contacted_at DATETIME NULL AFTER assigned_user_id",
            'last_contact_method' => "ALTER TABLE contacts ADD COLUMN last_contact_method VARCHAR(20) NULL AFTER last_contacted_at",
        );

        foreach ($columns as $field => $query) {
            if (!$this->db->field_exists($field, 'contacts')) {
                $this->db->query($query);
            }
        }
    }

    function get_all_contacts()
    {
        $this->ensure_crm_columns();
        $this->db->select('contacts.*, users.name as assigned_user_name');
        $this->db->from('contacts');
        $this->db->join('users', 'users.id = contacts.assigned_user_id', 'left');
        $this->db->where('contacts.status !=', DELETED);
        $this->db->order_by('contacts.id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_contact($id)
    {
        $this->ensure_crm_columns();
        return $this->db->get_where('contacts', array('id' => $id))->row_array();
    }

    function get_summary()
    {
        $this->ensure_crm_columns();
        $summary = array(
            'total_contacts' => 0,
            'new_leads' => 0,
            'customers' => 0,
            'follow_ups_due' => 0,
        );

        $this->db->from('contacts');
        $this->db->where('status !=', DELETED);
        $summary['total_contacts'] = (int)$this->db->count_all_results();

        $this->db->from('contacts');
        $this->db->where('status', NEW_LEAD);
        $summary['new_leads'] = (int)$this->db->count_all_results();

        $this->db->from('contacts');
        $this->db->where('status', CUSTOMER);
        $summary['customers'] = (int)$this->db->count_all_results();

        $today = date('Y-m-d');
        $this->db->from('contacts');
        $this->db->where('status !=', DELETED);
        $this->db->where('follow_up_date IS NOT NULL', null, false);
        $this->db->where('follow_up_date <=', $today);
        $summary['follow_ups_due'] = (int)$this->db->count_all_results();

        return $summary;
    }

    function get_recent_contacts($limit = 6)
    {
        $this->ensure_crm_columns();
        $this->db->select('contacts.*, users.name as assigned_user_name');
        $this->db->from('contacts');
        $this->db->join('users', 'users.id = contacts.assigned_user_id', 'left');
        $this->db->where('contacts.status !=', DELETED);
        $this->db->order_by('contacts.id', 'desc');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }
}
