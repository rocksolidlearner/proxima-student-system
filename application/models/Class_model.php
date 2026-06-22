<?php
/**
 * Created by VScode.
 * User: Hafiz Hassan (+92 303 7859398)
 * Date: 01/1/2021
 * Time: 10:00 PM
 */
 
class Class_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get class by id
     */
    function get_class($id)
    {
        $data= $this->db->get_where('classes',array('id'=>$id))->row_array();
        $this->db->where('class_id',$id);
        $data['subjects'] = $this->db->get('classes_subjects')->result_array(); 
        return $data;
    }
    
    /*
     * Get all classes count
     */
    function get_all_classes_count()
    {
        $this->db->from('classes');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all classes
     */
    function get_all_classes()
    {

        $this->db->order_by('classes.id', 'asc');
        $this->db->select('classes.*,(SELECT COUNT(*) FROM students s WHERE s.class_id = classes.id) as stdents,batches.batch_name');
        $this->db->join('batches', 'batches.id=classes.batch_id','left outer');
        $data= $this->db->get('classes')->result_array(); 
        foreach($data as $key => $v){
            $this->db->select('classes_subjects.*,subjects.subject_name');
            $this->db->join('subjects', 'subjects.id=classes_subjects.subject_id');
            $this->db->where('classes_subjects.class_id',$v['id']);
            $data[$key]['subjects'] = $this->db->get('classes_subjects')->result_array(); 
        }
        return $data;
    }
        
    /*
     * function to add new class
     */
    function add_class($params)
    {
        $this->db->insert('classes',$params);
        return $this->db->insert_id();
    }

    function add_class_subject($params)
    {
        $this->db->insert_batch('classes_subjects',$params);
        // return $this->db->insert_id();
    }
    
    /*
     * function to update class
     */
    function update_class($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('classes',$params);
    }
    
    /*
     * function to delete class
     */
    function delete_class($id)
    {
        $this->db->delete('classes_subjects',array('class_id'=>$id));
        return $this->db->delete('classes',array('id'=>$id));
    }

    function delete_class_subject($id)
    {
        return $this->db->delete('classes_subjects',array('class_id'=>$id));
    }
}
