<?php 


class Users_model extends CI_Model {
    
    public function __construct()	
    {
        $this->load->database(); 
    }
    
    public function getAll(){
        $this->db->select('*'); 
        $this->db->from('users');        
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addnewusers($data){  
        
        $data['password'] = md5($data['password']);
        $query = $this->db->insert('users',$data);
        return $this->db->insert_id();
    }
    public function emailexits($email){   
        $query = $this->db->get_where('users',array('email'=>$email));
        return $query->num_rows();
    }   
    public function getUserById($id){
          $query = $this->db->get_where('users',array('uid'=>$id));
          return $query->result_array();
    }
    public function update($data){
        
        $update_data = array(
             'firstname' => $data['firstname'],
             'lastname' => $data['lastname'],
             'email' => $data['email'],
             'password' => md5($data['password']),
             'city' => $data['city'],
             'state' => $data['state'],
             'country' => $data['country'],
             'phone' => $data['phone'],
        );        
        $this->db->where('uid', $data['uid']);
        $this->db->update('users', $update_data); 
    }
    public function deleteuser($id){
        
        $this->db->where('uid', $id);
        $this->db->delete('users');
    }
    public function adminlogincheck($email,$password){
        
          $this->db->where('email', $email);
          $this->db->where('password', md5($password));
          $query=$this->db->get('admin_user');
          return $query->result_array();
          
    }
     public function logincheck($email,$password){
        
          $this->db->where('email', $email);
          $this->db->where('password', md5($password));
          $query=$this->db->get('users');
          return $query->result_array();
          
    }
    public function changepassword($uid,$newpassword){
        
        $update_data = array(
            "password" => md5($newpassword)
        );
        $this->db->where('uid', $uid);
        $this->db->update('users', $update_data); 
    }
    
    
    
}