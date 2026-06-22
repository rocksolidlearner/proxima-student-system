<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Account_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get fee by id
     */
    function get_salary($id)
    {
        return $this->db->get_where('salaries',array('employee_id'=>$id,'MONTH(salary_month)'=>date('m')))->row_array();
    }

    function get_std_payment_report($std_id,$fdate,$todate)
    {
        // $this->db->select('fee.*,students.roll_no,students.std_name,students.father_name');
        // $this->db->join('students', 'students.id=fee.student_id');
        
        $this->db->where('paid_date BETWEEN "'.$fdate.'" AND "'.$todate.'"')
                ->where('student_id', $std_id);
        
        return $this->db->get('fee')->result_array();
    }

    function get_payment_report($class_id,$month,$year)
    {
        $this->db->select('fee.*,students.class_id');
        $this->db->join('students', 'students.id=fee.student_id','left outer');
        
        $this->db->where('MONTH(paid_date)',$month)
                ->where('YEAR(paid_date)',$year)
                ->where('students.class_id', $class_id);
        
        return $this->db->get('fee')->result_array();
    }

    function get_all_transections()
    {
        $this->db->select('transections.*,fee.title,fee.receipt,fee.amount as fee_amount,fee.paid_date,
        expenses.detail,expenses.expense_date,expenses.amount as expense_amount,salaries.salary_month,salaries.paid_salary,
        salaries.employee_id,salaries.deduction,employees.salary');
        $this->db->join('fee', 'fee.id=transections.fee_id','left outer');
        $this->db->join('expenses', 'expenses.id=transections.expense_id','left outer');
        $this->db->join('salaries', 'salaries.id=transections.salary_id','left outer');
        $this->db->join('employees', 'employees.id=salaries.employee_id','left outer');
        $this->db->where('transections.status !=',DELETED);
        $this->db->order_by('transections.id','desc');
        return $this->db->get('transections')->result_array();
    }

    function get_cash_report($fdate,$todate)
    {
        $this->db->select('transections.*,fee.title,fee.receipt,fee.amount,
        fee.paid_date,fee.student_id,students.std_name');
        $this->db->join('fee', 'fee.id=transections.fee_id','left outer');
        $this->db->join('students', 'students.id=fee.student_id','left outer');
        $this->db->where('transections.status !=',DELETED);
        $this->db->where('fee.paid_date BETWEEN "'.$fdate.'" AND "'.$todate.'"');
        return $this->db->get('transections')->result_array();
    }

    function get_expense_report($head_id,$fdate,$todate)
    {
        $this->db->select('transections.*,expenses.detail,expenses.account_head_id,expenses.receipt,expenses.expense_date,expenses.amount');
        $this->db->join('expenses', 'expenses.id=transections.expense_id','left outer');
        $this->db->where('transections.status !=',DELETED);
        $this->db->where('expenses.expense_date BETWEEN "'.$fdate.'" AND "'.$todate.'"');
        $this->db->where('expenses.account_head_id',$head_id);
        return $this->db->get('transections')->result_array();
    }

    function get_student($status=null)
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
    function get_all_salaries($status=null)
    {
        $this->db->select('salaries.*,employees.employee_name,employees.salary');
        $this->db->join('employees', 'employees.id=salaries.employee_id','left outer');
        $this->db->order_by('salaries.id', 'desc');
        if($status){
            $this->db->where('salaries.status',$status);
        }
        $this->db->where('salaries.status !='.PAID);
        return $this->db->get('salaries')->result_array();
    }
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
