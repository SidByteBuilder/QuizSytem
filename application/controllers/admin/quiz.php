<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz extends CI_Controller {
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('quiz_model');
            $this->load->model('subjects_model');
        }    
	public function index()
	{ 
            $data['subjects'] = $this->subjects_model->getAllSubjects(); 
            echo $this->load->view('admin/quiz',$data);
	}
        public function addquiz($id){
             $data['sub_id']=$id; 
             $data['quiz'] = $this->quiz_model->getQuizBysubject($id); 
             $this->load->view('admin/add_quiz',$data);
        }
        public function update(){
           $this->quiz_model->removeAll($_POST['sub_id']);
            if(isset($_POST['updated']) && count($_POST['updated']) > 0){
               
                $i=0;
               foreach($_POST['updated'] as $key => $quiz){
                   
                   $quiz_list[$i]['quiz'] = $quiz[0];
                   $quiz_list[$i]['sub_id'] = $_POST['sub_id'];
                   $choices = $quiz[1].','.$quiz[2].','.$quiz[3].','.$quiz[4];
                   $quiz_list[$i]['choices'] = $choices;
                   $quiz_list[$i]['ans'] = $quiz[5];  
                   $i++;
                   
               }
               $this->quiz_model->insertquiz($quiz_list); 
           }
           if(isset($_POST['field_name']) && count($_POST['field_name']) > 0){               
               
               foreach($_POST['field_name'] as $key => $quiz){                   
                   $quiz_list1[$key]['quiz'] = $quiz[0];
                   $quiz_list1[$key]['sub_id'] = $_POST['sub_id'];
                   $choices = $quiz[1].','.$quiz[2].','.$quiz[3].','.$quiz[4];
                   $quiz_list1[$key]['choices'] = $choices;
                   $quiz_list1[$key]['ans'] = $quiz[5];    
               }
               $this->quiz_model->insertquiz($quiz_list1); 
           }
           echo "Successfully Saved quiz";
           
       }
}
