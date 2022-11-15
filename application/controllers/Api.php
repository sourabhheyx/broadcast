 <?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 300);
class Api extends CI_Controller {
/*
| 1. 
| 2. login - show login page of website
| 3. forgot_password - show forgot page of website
| 4. 
| 5.    
| 6. 
|
*/
	function __construct(){
		parent::__construct();
        $this->load->model('Adminmodel','adminmodel');
        date_default_timezone_set("Asia/Kolkata"); 
        header('Content-type: text/json');
	}
	
//----------------------------Login Api---------------------------------------------//	

  public function schedule_brodcast($last_id=""){
    
         if(!empty($last_id))
          {
              $whr = "and id > $last_id";
          }else{
              $whr ='';
          }
          
         $limit=30;
       
       
        $userdata = $this->adminmodel->custom_query("SELECT id,schedule_date_time,created_by,data_ress FROM `send_schedule` WHERE status=0 and con_status='valid'  order by id desc limit $limit");
        if(!empty($userdata))
        {   
            $udata = array();
            foreach($userdata as $keys =>$val)
            {   
                if(strtotime(date("Y-m-d H:i", strtotime($val['schedule_date_time']))) <= strtotime(date("Y-m-d H:i"))){
                 $user_id = $val['created_by'];
                 $user = $this->adminmodel->custom_query_row("SELECT dsix_api_key  FROM `users` WHERE user_id=$user_id" );    
                if(!empty($user['dsix_api_key'])){
                 $this->send_massages_new($val['data_ress'],$user['dsix_api_key']);
                }
                
                $udata[]=array('id'=>$val['id'],
                             'send_date_time'=>date("Y-m-d H:i:s"),
                             'status'=>1); 
               
                }
            }
            
            $this->db->update_batch('send_schedule', $udata, 'id');
            sleep(3);
            $this->schedule_brodcast($val['id']);
        }
        
        $data["responce"] = true;
        $data["massage"] = $userdata; 
  		        
      
      
       echo json_encode($data); 
          
    }
    
    
    public function get_templates($apikey)
   {
       
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://waba.360dialog.io/v1/configs/templates",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 3000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "d360-api-key: $apikey",
            "postman-token: acb3bf60-e93e-a937-c5a6-0d489d2accb4"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
   }
   
  
   
   public function send_massages_new($arr,$apikey)
   {
         /* Endpoint */
       
        $url = 'https://waba.360dialog.io/v1/messages';
   
        /* eCurl */
        $curl = curl_init($url);
   
        /* Data */
        $data = $arr;
   
        /* Set JSON data to POST */
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            
        /* Define content type */
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'D360-API-KEY:'.$apikey
          
        ));
            
        /* Return json */
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            
        /* make request */
        $response = curl_exec($curl);
             
        /* close curl */

        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
        
     
     }
       
   
   public function send_massages($arr,$apikey)
   {
       $curl = curl_init();
     
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://waba.360dialog.io/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 3000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $arr,
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "d360-api-key: $apikey",
            "postman-token: 4157bd19-eb68-dc0a-2337-592f12dff00b"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $response;
        }
   }
    function broadcast_callback(){
     
     $payload = json_decode(file_get_contents('php://input'), true);
     $name = $payload['name'];
     $result_url = $payload['result_url'];
     $stats = $payload['stats'];
     if( $name && $result_url && $stats){
          $id = $this->adminmodel->insert_rows('broadcasts', [array('name' => $name, 'result_url' => $result_url, 'stats' => json_encode($stats))]);
     }
    }
 
}