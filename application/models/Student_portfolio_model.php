<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_portfolio_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function ensure_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS student_portfolios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            student_id INT NOT NULL,
            title VARCHAR(255) NOT NULL,
            entry_date DATE NOT NULL,
            category VARCHAR(100) NULL,
            tag_list VARCHAR(255) NULL,
            evidence_type VARCHAR(100) NULL,
            summary TEXT NULL,
            teacher_note TEXT NULL,
            student_reflection TEXT NULL,
            grade VARCHAR(50) NULL,
            file_name VARCHAR(255) NULL,
            created_by INT NULL,
            created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        $this->db->query($sql);
    }

    function get_by_student($studentId)
    {
        $this->ensure_table();
        $this->db->select('student_portfolios.*, users.name as created_by_name');
        $this->db->from('student_portfolios');
        $this->db->join('users', 'users.id = student_portfolios.created_by', 'left');
        $this->db->where('student_id', $studentId);
        $this->db->order_by('entry_date', 'desc');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_summary($studentId)
    {
        $items = $this->get_by_student($studentId);
        $categories = array();
        $withFiles = 0;

        foreach ($items as $item) {
            if (!empty($item['category'])) {
                $categories[$item['category']] = true;
            }
            if (!empty($item['file_name'])) {
                $withFiles++;
            }
        }

        return array(
            'total_items' => count($items),
            'category_count' => count($categories),
            'uploads_count' => $withFiles,
        );
    }

    function add($params)
    {
        $this->ensure_table();
        $this->db->insert('student_portfolios', $params);
        return $this->db->insert_id();
    }

    function get($id)
    {
        $this->ensure_table();
        return $this->db->get_where('student_portfolios', array('id' => $id))->row_array();
    }

    function remove($id)
    {
        return $this->db->delete('student_portfolios', array('id' => $id));
    }
}
