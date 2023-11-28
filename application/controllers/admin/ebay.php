<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ebay extends CI_Controller {
    
        public function __construct(){
            parent::__construct();
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->model('ebay_model');
        }          
        public function synchronize()
        {            
            
             $sellerId='search-merch';
            
             $requestXmlBody=$this->getRequestXml($sellerId,1);
             $headers = $this->EbayHeaders('findItemsAdvanced');            
             $response = $this->sendHttpRequest($requestXmlBody,$headers);
             $responseDoc = simplexml_load_string($response);
             $data_arr = $this->objectsIntoArray($responseDoc);       
             if($data_arr['ack'] == 'Success') 
             {
               if(isset($data_arr['searchResult']['item'])) 
               {
                  if(isset($data_arr['searchResult']['item'][0]))
                  {
                      $item = $data_arr['searchResult']['item'];
                  }
                  else{
                     $item = array($data_arr['searchResult']['item']);
                  }                                    
                  $import = $this->import_items($item);
              }
             
            }
        
        }
        public function getRequestXml($seller,$page)
        {
        //echo 'get request xml called with page-->'.$page.'<br />';
           $requestXml= '<?xml version="1.0" encoding="UTF-8"?>
                <findItemsAdvancedRequest xmlns="http://www.ebay.com/marketplace/search/v1/services">
                 <keywords></keywords>
                <itemFilter>
                <name>Seller</name>
                <value>'.trim($seller).'</value>
                </itemFilter>
                <itemFilter>
                <name>ListingType</name>
                <value>FixedPrice</value>
                </itemFilter>
                <itemFilter>
                <name>HideDuplicateItems</name>
                <value>true</value>
                </itemFilter>
                <paginationInput>
                <pageNumber>'.$page.'</pageNumber>
                <entriesPerPage>200</entriesPerPage>
                </paginationInput>
                <outputSelector>PictureURLSuperSize</outputSelector>
                <outputSelector>PictureURLLarge</outputSelector>
                
                </findItemsAdvancedRequest>';  
           return $requestXml; 
        }
        
	public function objectsIntoArray($arrObjData, $arrSkipIndices = array()) {

        $arrData = array();

            // if input is object, convert into array
            if (is_object($arrObjData)) {
                $arrObjData = get_object_vars($arrObjData);
            }

            if (is_array($arrObjData)) {
                foreach ($arrObjData as $index => $value) {
                    if (is_object($value) || is_array($value)) {
                        $value = $this->objectsIntoArray($value, $arrSkipIndices); // recursive call
                    }
                    if (in_array($index, $arrSkipIndices)) {
                        continue;
                    }
                    $arrData[$index] = $value;
                }
            }
            return $arrData;
            
        }
        
        public  function EbayHeaders($verb){

            $config['app_name']="sahycart-06ea-4a54-b6bf-bf7c8f18b0bd";
            $config['global_id']="EBAY-US";

            if(empty($config['global_id']) || empty($config['app_name'])) die('eBay Account not Configured');
            
            $headers = array(
                    'X-EBAY-SOA-SERVICE-NAME:FindingService',
                    'X-EBAY-SOA-OPERATION-NAME:findItemsAdvanced',
                    'X-EBAY-SOA-SERVICE-VERSION:1.12.0',
                    'X-EBAY-SOA-GLOBAL-ID:'.$config['global_id'],
                    'X-EBAY-SOA-SECURITY-APPNAME:'.$config['app_name'],//sahycart-06ea-4a54-b6bf-bf7c8f18b0bd',
                    'X-EBAY-SOA-REQUEST-DATA-FORMAT:XML'
            ); 

            return $headers;
        }        
        function sendHttpRequest($requestXmlBody,$headers)
        {  
                $con = curl_init();
                curl_setopt($con, CURLOPT_POSTFIELDS, $requestXmlBody);
                curl_setopt($con, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($con, CURLOPT_POST, 1);
                curl_setopt($con, CURLOPT_URL, 'http://svcs.ebay.com/services/search/FindingService/v1');
                curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($con, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($con, CURLOPT_SSL_VERIFYPEER, 0);

                $response = curl_exec($con);             
                return $response;
        }
        public function import_items($items){
            
            foreach ($items as $item){                
               // echo "<pre>";                
               // print_r($item);
               if($this->ebay_model->itemExits($item['itemId'])){
                    
                    $product['item_id'] = $item['itemId'];                             
                    $product['qty'] = $this->getsingle($item['itemId']);                
                    $product['updated_at'] = date("Y-m-d H:i:s");   
                    $this->ebay_model->updateItem($product); 
                    
               }else{
                   
                    $product['title'] = $item['title'];                 
                    $product['item_id'] = $item['itemId'];                 
                    $product['qty'] = $this->getsingle($item['itemId']);                
                    $product['is_active'] = $item['sellingStatus']['sellingState'];                
                    $product['start_time'] = date("Y-m-d H:i:s",strtotime($item['listingInfo']['startTime']));                                
                    $product['end_time'] = date("Y-m-d H:i:s",strtotime($item['listingInfo']['endTime']));
                    $product['updated_at'] = date("Y-m-d H:i:s");   
                    $product['created_at'] = date("Y-m-d H:i:s");                                
                    $this->ebay_model->additem($product); 
                   
               }
               
            }
            
            
        }
        public function getsingle($item_id)
        {        
            $config['app_name']="sahycart-06ea-4a54-b6bf-bf7c8f18b0bd";
            $config['global_id']="EBAY-US";
            
            if(empty($config['global_id']) || empty($config['app_name'])) die('eBay Account not Configured');
                
            $passurl="http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=XML&appid=".$config['app_name']."&siteid=0&version=515&ItemID=".$item_id."&IncludeSelector=Variations,Description,Details,ItemSpecifics,ShippingCosts";
      
            $responseXml= file_get_contents($passurl);
            $responseDoc = new DomDocument();
            $responseDoc->loadXML($responseXml);
      
            $qty = $responseDoc->getElementsByTagName('Quantity')->item(0)->nodeValue;
            return $qty;
        }
}
