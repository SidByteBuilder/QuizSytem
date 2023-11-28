<?php 


class Records_model extends CI_Model {
    
    public function __construct()	
    {
        $this->load->database(); 
    }
    
    public function getAll(){
        
        $this->db->select('a.*,b.name as root_name'); 
        $this->db->from('customers a');
        $this->db->join('root b', 'b.id = a.root_id', 'left'); 
        $query = $this->db->get();
        return $query->result_array();

    }
    public function AddNew($data){
        $add_data = array(
             'name' => $data['name'],
             'root_id' => $data['root_id'],
             'jag_rs' => $data['jag_rs'],
             'jar_rs' => $data['jar_rs']
        );        
        $query = $this->db->insert('customers',$add_data);
    }
    public function editcustomer($id){
        $query = $this->db->get_where('customers',array('cust_id'=>$id));
        return $query->result_array();
    }
    public function updateCustomer($data){

        $update_data = array(
             'name' => $data['name'],
             'root_id' => $data['root_id'],
             'jag_rs' => $data['jag_rs'],
             'jar_rs' => $data['jar_rs']
        );        
        $this->db->where('cust_id', $data['cust_id']);
        $this->db->update('customers', $update_data); 

    }
    public function deletecustomer($id){

            $this->db->where('cust_id', $id);
            $this->db->delete('customers');
    }
    


    // Root Method
    public function getAllRoot(){

        $this->db->order_by("id", "desc");        
        $query = $this->db->get('root');
        return $query->result_array();
    }
    public function AddNewRoot($data){
        $query = $this->db->insert('root',$data);
    }
    public function editroot($id){
        $query = $this->db->get_where('root',array('id'=>$id));
        return $query->result_array();
    }
    public function updateRoot($data){

        $update_data = array(
             'name' => $data['name'],             
        );        
        $this->db->where('id', $data['id']);
        $this->db->update('root', $update_data); 
    }
     public function deleteroot($id){

            $this->db->where('id', $id);
            $this->db->delete('root');
    }


}