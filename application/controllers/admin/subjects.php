<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subjects extends CI_Controller {

            public function __construct(){
                parent::__construct();
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->model('subjects_model');
            }    
            public function index(){             
              $data['subjects'] = $this->subjects_model->getAllSubjects(); 
              echo $this->load->view('admin/subjects',$data);
  	    }
            public function addUpdateSubject() {
                
              if(isset($_POST['id']) && !empty($_POST['id'])){ 
                    $this->subjects_model->updateSubject($_POST); 
                    echo "Successfully Updated Subject";
                }else{
                    $this->subjects_model->AddNewSubject($_POST); 
                    echo "Successfully Added New Subject";
                }   
                  
            }            
            public function editsubject($id) {
                  $data = $this->subjects_model->editsubject($id); 
                  echo json_encode($data);                 
            }
            public function deletesubject($id){
                $data = $this->subjects_model->deletesubject($id); 
                echo "Successfuly Deleted Subject";
            }
           

            
}
