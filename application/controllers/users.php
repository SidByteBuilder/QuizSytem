<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('users_model');
            $this->load->library('session');
        }    
	public function addnew(){
          
          $user = $this->users_model->emailexits($_POST['email']); 
          if($user > 0){              
              $data['login']=false;
              $data['message']="Email id already exits!";
               echo json_encode($data); 
          }else{
              $id = $this->users_model->addnewusers($_POST); 
              $this->session->set_userdata('userlogin', 'true');
               $this->session->set_userdata('userid', $id);
              $data['login']=true;
              $data['message']="Successfully Added New User";
              echo json_encode($data); 
              
              
          }    
        }
        public function changepassword(){
            if(!$this->session->userdata('userlogin')){header("location:login");}
            $user = $this->users_model->changepassword($this->session->userdata('userid'),$_POST['password']);   
            echo "Successfully Changed Your Password!";
        }
}
