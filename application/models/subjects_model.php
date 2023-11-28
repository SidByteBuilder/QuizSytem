<?php 


class Subjects_model extends CI_Model {
    
    public function __construct(){
        
        $this->load->database(); 
    }
    public function getAllSubjects(){
        $this->db->select('*'); 
        $this->db->from('subjects');        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function AddNewSubject($data) {
         $query = $this->db->insert('subjects',$data);
    }
    public function editsubject($id){
        $query = $this->db->get_where('subjects',array('id'=>$id));
        return $query->result_array();
    }
    public function updateSubject($data) {
       $update_data = array(
             'name' => $data['name'],  
             'description' => $data['description']
        );        
        $this->db->where('id', $data['sub_id']);
        $this->db->update('subjects', $update_data); 
    }
      public function deletesubject($id){

            $this->db->where('id', $id);
            $this->db->delete('subjects');
    }

}