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

        if (!$this->db->field_exists('private_note', 'student_portfolios')) {
            $this->db->query("ALTER TABLE student_portfolios ADD COLUMN private_note TEXT NULL AFTER teacher_note");
        }
    }

    function get_by_student($studentId, $filters = array())
    {
        $this->ensure_table();
        $this->db->select('student_portfolios.*, users.name as created_by_name');
        $this->db->from('student_portfolios');
        $this->db->join('users', 'users.id = student_portfolios.created_by', 'left');
        $this->db->where('student_id', $studentId);
        if (!empty($filters['category'])) {
            $this->db->where('category', $filters['category']);
        }
        if (!empty($filters['evidence_type'])) {
            $this->db->where('evidence_type', $filters['evidence_type']);
        }
        if (!empty($filters['tag'])) {
            $this->db->like('tag_list', $filters['tag']);
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('title', $filters['search']);
            $this->db->or_like('summary', $filters['search']);
            $this->db->or_like('teacher_note', $filters['search']);
            $this->db->or_like('private_note', $filters['search']);
            $this->db->or_like('student_reflection', $filters['search']);
            $this->db->group_end();
        }
        if (!empty($filters['from_date'])) {
            $this->db->where('entry_date >=', $filters['from_date']);
        }
        if (!empty($filters['to_date'])) {
            $this->db->where('entry_date <=', $filters['to_date']);
        }
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

    function update($id, $params)
    {
        $this->ensure_table();
        return $this->db->update('student_portfolios', $params, array('id' => $id));
    }

    function remove($id)
    {
        return $this->db->delete('student_portfolios', array('id' => $id));
    }

    function get_filter_options($studentId)
    {
        $items = $this->get_by_student($studentId);
        $categories = array();
        $evidenceTypes = array();
        $tags = array();

        foreach ($items as $item) {
            if (!empty($item['category'])) {
                $categories[$item['category']] = $item['category'];
            }
            if (!empty($item['evidence_type'])) {
                $evidenceTypes[$item['evidence_type']] = $item['evidence_type'];
            }
            if (!empty($item['tag_list'])) {
                foreach (explode(',', $item['tag_list']) as $tag) {
                    $tag = trim($tag);
                    if ($tag !== '') {
                        $tags[$tag] = $tag;
                    }
                }
            }
        }

        sort($categories);
        sort($evidenceTypes);
        sort($tags);

        return array(
            'categories' => $categories,
            'evidence_types' => $evidenceTypes,
            'tags' => $tags,
        );
    }

    function get_recent_entries($limit = 6)
    {
        $this->ensure_table();
        $this->db->select('student_portfolios.*, students.std_name, students.admission_no, users.name as created_by_name');
        $this->db->from('student_portfolios');
        $this->db->join('students', 'students.id = student_portfolios.student_id', 'left');
        $this->db->join('users', 'users.id = student_portfolios.created_by', 'left');
        $this->db->order_by('student_portfolios.entry_date', 'desc');
        $this->db->order_by('student_portfolios.id', 'desc');
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    function get_global_summary()
    {
        $this->ensure_table();
        $items = $this->db->get('student_portfolios')->result_array();
        $students = array();
        $withFiles = 0;

        foreach ($items as $item) {
            $students[$item['student_id']] = true;
            if (!empty($item['file_name'])) {
                $withFiles++;
            }
        }

        return array(
            'total_entries' => count($items),
            'students_covered' => count($students),
            'files_uploaded' => $withFiles,
        );
    }
}
