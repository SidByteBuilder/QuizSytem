<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('users_model');
            $this->load->library('session');
        }    
	public function index(){
            
            if(!$this->session->userdata('userlogin')){header("location:login");}
            
            $data['current_user']=$this->users_model->getUserById($this->session->userdata('userid'));            
            $this->load->view('index',$data);
	}
        public function login(){
           if($this->session->userdata('userlogin')){header("location:index");}
            
          $this->load->view('login');
        }
        public function logincheck(){
            $_POST['email'];
            $_POST['password'];
            $result = $this->users_model->logincheck($_POST['email'],$_POST['password']);
            if(isset($result[0]['email']) && !empty($result[0]['email'])){
                $this->session->set_userdata('userlogin', 'true');
                $this->session->set_userdata('userid', $result[0]['uid']);
            }
            echo json_encode($result); 
        }
        public function logout() {
            $this->session->unset_userdata('userlogin');
            $this->session->unset_userdata('userid');
            redirect(base_url());
        }
}
