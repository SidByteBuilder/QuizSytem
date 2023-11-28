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
            $this->load->view('quiz',$data);
	}
        public function subject($id)
	{ 
           
            $quizs = $this->quiz_model->getQuizBysubject($id); 
            $i=0;
            foreach($quizs as $q){
            $quiz[$i]['question']=$q['quiz'];
            $quiz[$i]['choices']=explode(",", $q['choices']);
            $quiz[$i]['correctAnswer']=$q['ans'];
            $i++;
            }
            
            $data['quiz'] = json_encode($quiz);
           
            $this->load->view('quizlist',$data);
	}
       
}
