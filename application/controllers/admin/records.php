<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Records extends CI_Controller {

        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('customer_model');
            $this->load->model('records_model');
        }    

  	   public function index()
  	   {                
              $data['customers'] = $this->customer_model->getAll();               
              echo $this->load->view('records',$data);
  	   }  
       public function view_month_list($id=null){
           

           $data['customer'] = $this->customer_model->getCustomerById($id);  


           $i=0;
           for($year=2016; $year<=2025; $year++){

              for($months=1; $months<=12; $months++){

                  $date = new DateTime();
                  $date->setDate($year, $months, 1);
                  $month= $date->format('Y-m-d');

                  $monthly_list[$i]['month'] = $month;
                  $i++;
             
              }                
             
           }  
           $data['monthly_list'] = $monthly_list;

           echo $this->load->view('view_month_list',$data);

          
       }
}
