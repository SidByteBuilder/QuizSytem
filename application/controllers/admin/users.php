<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('users_model');
        }    

  	public function index()
  	{  
           $data['users'] = $this->users_model->getAll(); 
           echo $this->load->view('admin/users',$data);
  	}  
        public function addUsers(){
          
         echo $this->load->view('admin/add_users');
                
        }
        public function insert(){
          
          $user = $this->users_model->emailexits($_POST['email']); 
          if($user > 0){
              echo "Email id already exits!";
          }else{
              $this->users_model->addnewusers($_POST); 
              echo "Successfully Added New User";
          }    
        }
        public function editUser($id=false){            
             $data['users'] = $this->users_model->getUserById($id); 
             echo $this->load->view('admin/edit_users',$data);
        }
        public function update(){
            
             $this->users_model->update($_POST); 
             echo "Successfully Updated User";
        }
        public function deleteuser($id){
                $data = $this->users_model->deleteuser($id); 
                echo "Successfuly Deleted Users";
        }
       
        
}
