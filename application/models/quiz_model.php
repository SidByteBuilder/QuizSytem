<?php 


class Quiz_model extends CI_Model {
    
    public function __construct()	
    {
        $this->load->database(); 
    }
    public function insertquiz($data){
        $this->db->insert_batch('quiz', $data);
        
    }
    public function getQuizBysubject($id){
        
        $query = $this->db->get_where('quiz',array('sub_id'=>$id));
        return $query->result_array();
        
    }
    public function updatequiz($data,$quiz_id){
        $this->db->where('quiz_id', $quiz_id);
        $this->db->update('quiz', $data); 
        
    }
    public function removeAll($sub_id) {
        $this->db->where('sub_id', $sub_id);
        $this->db->delete('quiz');
    }
}