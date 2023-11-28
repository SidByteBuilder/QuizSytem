<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('users_model');
        }    
	public function index()
	{
		$this->load->view('admin/index');
	}
        public function admin(){
            echo $this->load->view('admin/admin');
        }
        public function login()
	{
		$this->load->view('admin/login');
	}
        public function logincheck(){
            $_POST['email'];
            $_POST['password'];
            $result = $this->users_model->adminlogincheck($_POST['email'],$_POST['password']);
            echo json_encode($result); 
        }
}
