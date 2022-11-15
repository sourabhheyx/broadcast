<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        $this->load->library('csvimport');
        /* check admin is logged in or not*/
           // $this->output->clear_cache();
           date_default_timezone_set("Asia/Kolkata");
           if(!$this->session->userdata('user_session'))
            {
                redirect(base_url('user-login'),'refresh');
            }
           
    } 
    /*++++++++++++++++++start users store function++++++++++++++++*/
   
    //---------------------------- User Function---------------------------------------------//
    
    public function upload_contact($id="")
    {


        if($this->input->post())
        {
            
            $path = FCPATH . "uploads/";

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'csv';
            $config['max_size'] = 1024000000;
            $this->load->library('upload', $config);

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();

                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect("users");
                //echo $error['error'];
            } else {

                $file_data = $this->upload->data();
                
                $file_path = base_url() . "uploads/" . $file_data['file_name'];
                
                $csv_data = $this->csvimport->parse_file($file_path);
              
              // Add created and modified date if not include
                $date = date("Y-m-d H:i:s");

                if ($csv_data) {
                    
                    foreach ($csv_data as $row) {

                        $insert_data[] = array(
                                'first_name' => $row['FirstName'],
                                'last_name' => $row['LastName'],
                                'phone' => '+'.$row['PhoneNumber'],
                                'email' => $row['Email'],
                                'tags' => $row['Tags'],
                                'created_by' => $this->session->userdata['user_session']['user_id']
                        );
                
                    }
                    $this->adminmodel->insert_rows('contact_details',$insert_data);
                    $this->con_recru(2500);
                    $this->session->set_flashdata('success_message', "Csv imported successfully");
                    redirect(base_url('user/user/upload_contact'),'refresh');

                } else {
                    $data['error'] = "Error occured";
                    $this->session->set_flashdata('error_message', $data['error']);
                    redirect(base_url('user/user/upload_contact'),'refresh');
                exit; 
            
                }
                
            }
        } 
            
     
        $results['data'] = $this->adminmodel->getwhere('contact_details',array('created_by'=>$this->session->userdata['user_session']['user_id']));
        $results['websetting'] = $this->adminmodel->getwheres('websetting',array('id'=>1));
        $results['List']='Contact Upload Form';
        $results['pagetitle']='Contact Upload Form';
        $results['title']=' Contact Upload Form';
        $this->load->view('user/pages/upload_contact.php',$results);
    }
    
    
    
    public function ContactDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('contact_details',$whr);
        $this->session->set_flashdata('success_message','contact details Deleted Successfully');
        redirect(base_url('user/user/upload_contact'),'refresh');
        exit;
    }
    
    public function contact_list()
    {  
        
        $results['pagetitle']='Contact List';
        $results['title']=' Contact List';
        $results['List']=' Contact List';
        
        if(!empty($_GET['submit_type']))
        {
          // $this->adminmodel->delete('tag_list',array('')); 
        }
        
        if(!empty($_GET['tags']) && empty($_GET['submit_type']))
        {
            $tags = $_GET['tags'];
            $whrs = "and tags LIKE '%".$tags."%'";
        }else{
            $whrs= '';
        }
        $results['data'] = $this->adminmodel->custom_query("SELECT * FROM `contact_details` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." $whrs " );
        
        $results['tags'] = $this->adminmodel->getwhere('tag_list');
        $this->load->view('user/pages/contact_list.php',$results);

    }
    
    public function broadcast_report()
    {  
        
        $results['pagetitle']='Broadcast  Report';
        $results['title']=' Broadcast  Report';
        $results['List']=' Broadcast  Report';
        
       
        if(!empty($_GET['send_date_time']))
        {
            $send_date_time = $_GET['send_date_time'].' 00:00:00';
            $to_date_time = $_GET['send_date_time'].' 23:59:59';
            $whrs = "and send_date_time between '".$send_date_time."' and  '".$to_date_time."'";
        }else{
            $whrs= '';
        }
        
        if(!empty($_GET['send_type']))
        {
            $send_type = $_GET['send_type'];
           
            $whrs1 = "and send_type = '".$send_type."'";
        }else{
            $whrs1= '';
        }
        $results['data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']."   $whrs $whrs1 " );
        
        $results['tags'] = $this->adminmodel->getwhere('tag_list');
        $this->load->view('user/pages/broadcast_report.php',$results);

    }

   
   
    public function add_contact($id="")
    {


        if($this->input->post())
        {
               
               
                 $data = array('first_name'=>$this->input->post('first_name'),
                    'last_name'=>$this->input->post('last_name'),
                    'phone'=>'+91'.$this->input->post('phone'),
                    'email'=>$this->input->post('email'),
                    'tags'=>$this->input->post('tags'),
                    'created_by' => $this->session->userdata['user_session']['user_id']
                   );
                    
                if($id !=""){
                 $res = $this->adminmodel->update_data('contact_details',array('id'=>$id),$data);   
                }else{ 
                 $res = $this->adminmodel->insert_data('contact_details',$data);
                
                }
               
               
                
                if($res){
                    
                    if($id !=""){
                    $this->session->set_flashdata('success_message','User Details Update Successfully');    
                    }else{
                    $this->session->set_flashdata('success_message','User Details Inserted Successfully');
                    }
                }else{
                    $this->session->set_flashdata('error_message','User Not Inserted Successfully');
                }

                $this->con_recru(2500);
                redirect(base_url('user/user/upload_contact'),'refresh');
                exit; 
            
            
        }
        
        $results['update'] = $this->adminmodel->getwheres('contact_details',array('id'=>$id));

        $results['List']='Add Contact Form';
        $results['pagetitle']='Add Contact Form';
        $results['title']=' Add Contact Form';
        $this->load->view('user/pages/update_contact.php',$results);
    }
   
   public function update_contact($id="")
    {


        if($this->input->post())
        {
               
               
                 $data = array('first_name'=>$this->input->post('first_name'),
                    'last_name'=>$this->input->post('last_name'),
                    'phone'=>$this->input->post('phone'),
                    'email'=>$this->input->post('email'),
                    'tags'=>$this->input->post('tags'),
                   );
                    
                if($id !=""){
                 $res = $this->adminmodel->update_data('contact_details',array('id'=>$id),$data);   
                }else{ 
                 $res = $this->adminmodel->insert_data('contact_details',$data);
                
                }
               
               
                
                if($res){
                    
                    if($id !=""){
                    $this->session->set_flashdata('success_message','User Details Update Successfully');    
                    }else{
                    $this->session->set_flashdata('success_message','User Details Inserted Successfully');
                    }
                }else{
                    $this->session->set_flashdata('error_message','User Not Inserted Successfully');
                }

               
                redirect(base_url('user/user/upload_contact'),'refresh');
                exit; 
            
            
        }
        
        $results['update'] = $this->adminmodel->getwheres('contact_details',array('id'=>$id));

        $results['List']='Update Contact Form';
        $results['pagetitle']='Update Contact Form';
        $results['title']=' Update Contact Form';
        $this->load->view('user/pages/update_contact.php',$results);
    }
   
   
   public function add_broadcast($id="")
    {


        if($this->input->post())
        {
               
               
                 $data = array('first_name'=>$this->input->post('first_name'),
                    'last_name'=>$this->input->post('last_name'),
                    'phone'=>$this->input->post('phone'),
                    'email'=>$this->input->post('email'),
                    'tags'=>$this->input->post('tags'),
                   );
                    
                if($id !=""){
                 $res = $this->adminmodel->update_data('contact_details',array('id'=>$id),$data);   
                }else{ 
                 $res = $this->adminmodel->insert_data('contact_details',$data);
                
                }
               
               
                
                if($res){
                    
                    if($id !=""){
                    $this->session->set_flashdata('success_message','User Details Update Successfully');    
                    }else{
                    $this->session->set_flashdata('success_message','User Details Inserted Successfully');
                    }
                }else{
                    $this->session->set_flashdata('error_message','User Not Inserted Successfully');
                }

               
                redirect(base_url('user/user/upload_contact'),'refresh');
                exit; 
            
            
        }
        
        $results['update'] = $this->adminmodel->getwheres('contact_details',array('id'=>$id));

        $results['List']='Broadcast';
        $results['pagetitle']='Broadcast Form';
        $results['title']=' Broadcast Form';
        $results['temp_list']=json_decode($this->get_templates());
        //echo "<pre>";
       // print_r($results['temp_list']);die;
        if(!empty($results['temp_list']->waba_templates)){
        $results['temp_list_res'] = $results['temp_list']->waba_templates;
        }else{
         $results['temp_list_res'] = array();    
        }
        $results['tags'] = $this->adminmodel->custom_query("SELECT tags as tag FROM `contact_details` where created_by = '".$this->session->userdata['user_session']['user_id']."' GROUP by tags");
        $results['contact_details'] = $this->adminmodel->getwhere('contact_details',array('created_by'=>$this->session->userdata['user_session']['user_id']));
        $this->load->view('user/pages/add_broadcast.php',$results);
    }
   
   
   public function get_brodcast_list()
   {
     $url = base_url('images/placeholder_600x400.svg');
     $results['temp_list']=json_decode($this->get_templates());   
     $temp_list_res  = $results['temp_list']->waba_templates;
     $val = $this->input->post('val');
     if(!empty($temp_list_res)) {
                        $id = 0;
                        $components = array();
                      foreach($temp_list_res as $key){
                          
                        if($id == $val) {
                            $components = $key->components;
                            if(!empty($components))
                            {
                                
                                $html = '
                                <input  type="hidden" name="namespace" value="'.$key->namespace.'" >
                                <input  type="hidden" name="name" value="'.$key->name.'" >
                                <input  type="hidden" name="language" value="'.$key->language.'" >
                                <div class="col-md-6">';
                                foreach($components as $keys)
                                {
                                    if($keys->type == 'HEADER')
                                    {
                                        if($keys->format == 'IMAGE')
                                        {
                                        $formates = 'image';    
                                        $html .= '<div class="col-md-12">
                                                  <label>Header Document (Image)</label>
                                                  <input  type="file" name="send_img" required class="form-control" accept="image/*" id="imgInp" onchange="loadFile(event)">
                                                  <input  type="hidden" name="img_type" value="image"  >
                                                </div>';
                                        }else if($keys->format == 'DOCUMENT')
                                        {
                                        $formates = 'doc';    
                                        $html .= '<div class="col-md-12">
                                                  <label>Header Document (DOCUMENT)</label>
                                                  <input  type="file" name="send_img" required class="form-control" accept="application/pdf, application/vnd.ms-excel" >
                                                  <input  type="hidden" name="img_type" value="document" >
                                                </div>';
                                        }else{
                                         $formates = 'video';
                                           $html .= '<div class="col-md-12">
                                                  <label>Header Document (Video)</label>
                                                  <input  type="file" name="send_img" required class="form-control" accept="video/*">
                                                  <input  type="hidden" name="img_type" value="video" >
                                                </div>'; 
                                        }
                                    }
                                    if($keys->type == 'BODY')
                                    {
                                      $texts = $keys->text;  
                                      if(count(explode("{{1}}",$keys->text)) == 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{1}}</label>
                                          <input  type="text" name="parameter[]" required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,1)">
                                        </div>';
                                      }
                                      if(count(explode("{{2}}",$keys->text)) == 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{2}}</label>
                                          <input  type="text" name="parameter[]" required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,2)">
                                        </div>';
                                      }
                                      if(count(explode("{{3}}",$keys->text))== 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{3}}</label>
                                          <input  type="text" name="parameter[]" required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,3)">
                                        </div>';
                                      }
                                      if(count(explode("{{4}}",$keys->text)) == 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{4}}</label>
                                          <input  type="text" name="parameter[]" required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,4)">
                                        </div>';
                                      }
                                      if(count(explode("{{5}}",$keys->text)) == 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{5}}</label>
                                          <input  type="text" name="parameter[]"  required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,5)">
                                        </div>';
                                      }
                                      
                                      if(count(explode("{{6}}",$keys->text)) == 2){    
                                      $html .= '<div class="col-md-12">
                                          <label>Body {{6}}</label>
                                          <input  type="text" name="parameter[]"  required class="form-control" placeholder="Add Parameter Text" onkeyup ="changepera(this.value,6)">
                                        </div>';
                                      }
                                    }
                                }
                                
                               $html .= '</div>
                               
                                <div class="col-md-5">
                                    <div class="form-group">
                                        
                                       <label>Message Preview</label>
                                        <br>';
                                        if(@$formates == 'image'){
                                        $html .='<img id="output" src="'.$url.'" alt="your image" style="width: 185px;" />';
                                        } 
                                        
                                        if(@$formates == 'doc')
                                        {
                                            $html .='<img id="output" src="'.base_url('assest/pdf.png').'" alt="your image" style="width: 120px;" />';
                                        }
                                        if(@$formates == 'video')
                                        {
                                            $html .='<img id="output" src="'.base_url('assest/video.png').'" alt="your image" style="width: 185px;" />';
                                        }
                                        
                                        
                                        $html.='<p id="textpera">'.$texts.'</p>
                    
                                    </div>
                                  </div> ';
                                  
                            echo $html;      
                            }
                            
                        }
                       $id = $id+1; 
                      }
     }
     
   }
   
   public function send_request()
   {
       if($this->input->post())
        {
           
           $scheduleid = $this->adminmodel->custom_query_row("SELECT max(schedule_id) as schedule_id FROM `send_schedule` order by schedule_id DESC" );    
           if(!empty($scheduleid['schedule_id']))
           {
               $schedule_id = $scheduleid['schedule_id']+1;
           }else{
               $schedule_id =1;
           }
           
           if(!empty($_FILES['send_img']['name'])){
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000000000000000000000000000000000000';
                $config['file_name'] = $_FILES['send_img']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('send_img')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
                }else{
                    $image='';
                }
                
                
                
                if(!empty($image))
                {
                   $path =  base_url().'uploads/'.$image; 
                   $headers =     '{
                                    "type": "header",
                                    "parameters": [{
                                            "type": "'.$this->input->post('img_type').'",
                                            "'.$this->input->post('img_type').'": {
                                                "link": "'.$path.'"
                                            }
                                        }
                                    ]
                                },';
                }else{
                    $headers = '';
                }
                if(!empty($this->input->post('parameter')))
                {  
                    $pera = array();
                    for($x = 0; $x < count($this->input->post('parameter')); $x++) {
                       $pera[] = array('type'=>'text',
                                     'text'=>$this->input->post('parameter')[$x]
                                     );
                    }
                }
                
          
                
                  if($this->input->post('send_type') == 'Send Now'){  
                   
                     $send_status = 0;
                  }else{
                     $send_status = 0; 
                  }
                 if(!empty($this->input->post('tags')))
                 {
                     $tags = implode(',', $this->input->post('tags'));
                 }else{
                     $tags = '';
                 }
               
                 if(!empty($this->input->post('schedule_date_time')))
                 {
                     $schedule_date_time =$this->input->post('schedule_date_time');
                 }else{
                     $schedule_date_time ='';
                 }
                
                  $otherress = array('schedule_id'=>$schedule_id,
                                 'broadcast_channel'=>$this->input->post('broadcast_channel'),
                                 'broadcast_name'=>$this->input->post('broadcast_name'),
                                 'target_audience'=>$this->input->post('target_audience'),
                                 'tags'=>$tags,
                                 'masssage_template'=>$this->input->post('masssage_template'),
                                 'send_type'=>$this->input->post('send_type'),
                                 'namespace'=>$this->input->post('namespace'),
                                 'name'=>$this->input->post('name'),
                                 'language'=>$this->input->post('language'),
                                 'image_name'=>$image,
                                 'created_by'=>$this->session->userdata['user_session']['user_id'],
                                 'schedule_date_time'=>$schedule_date_time
                                 );
 
             $send_type= $this->input->post('send_type');
             $namespace = $this->input->post('namespace');
             $name= $this->input->post('name');
             $language = $this->input->post('language');
             $target_audience = $this->input->post('target_audience');
             $limit = 10000;
            $this->message_recru($limit,$target_audience,$send_type,$headers,$pera,$tags,$namespace,$language,$name,$otherress);
              
            $this->session->set_flashdata('success_message','broadcast massage sent Successfully');    
            redirect(base_url('user/user/add_broadcast'),'refresh');
            exit;
          }
          
                 
                
        }
       
   
  function array_to_csv_download($array, $filename = "export.csv", $delimiter = ",")
    {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $f = fopen('php://memory', 'w');
        // loop over the input array
        $line = array("WA ID");
        fputcsv($f, $line, $delimiter);
        foreach ($array as $line) {
            // generate csv lines from the inner arrays
            fputcsv($f, [$line['wa_id']], $delimiter);
        }
        // reset the file pointer to the start of the file
        fseek($f, 0);
        file_put_contents($filename, $f);
        fclose($f);
       
    }
   public function message_recru($limit,$target_audience,$send_type,$headers,$pera,$tags,$namespace,$language,$name,$otherress,$last_id="")
   {
           //echo $limit.','.$target_audience.','.$send_type.','.$headers.','.$pera.','.$tags.','.$namespace.','.$language.','.$name.','.$otherress.','.$last_id;die;
           $created_by = $this->session->userdata['user_session']['user_id'];
          if(!empty($last_id))
          {
              $whr = "and id > $last_id";
          }else{
              $whr ='';
          }
          $contact_details = array();
          if($target_audience == 'all_contact_in_channel'){
              $contact_details = $this->adminmodel->custom_query("SELECT * FROM `contact_details` WHERE  created_by = $created_by and status IS NOT NULL $whr  limit $limit" );
          }else{
              if(!empty($tags))
              {
              $contact_details = $this->adminmodel->custom_query("SELECT * FROM `contact_details` WHERE tags LIKE '%".$tags."%' and created_by = $created_by and status IS NOT NULL $whr  limit $limit" );
              }
              
          }
          $contact_details = array_filter($contact_details, function ($contact) {
            return ($contact['status'] == 'valid');
          });
          $apikey = $this->session->userdata['user_session']['dsix_api_key'];
          $file_name = 'output-'.date("Y-m-d_H-i",time()).'.csv';
          $this->array_to_csv_download($contact_details, $file_name);
          $curl = curl_init();
          $arr = '{
                    "type": "template",
                    "template": {
                        "namespace": "'.$namespace.'",
                        "language": {
                            "policy": "deterministic",
                            "code": "'.$language.'"
                        },
                        "name": "'.$name.'",
                        "components": [ '.$headers.' {
                                "type": "body",
                                "parameters": '.json_encode($pera).'
                            }
                        ]
                    }
                 }';
          $payload = array(
            'file'=> base_url() . $file_name,
            'body' => json_decode($arr,true),
            'api_key' => $apikey
          );

        //   $payload = array(
        //     'namespace' => $namespace,
        //     'lang_code' => $language,
        //     'image_url' => base_url() . 'uploads/' . $otherress['image_name'],
        //     'body_1' => $pera[0]['text'],
        //     'body_2' => $pera[1]['text'],
        //     'api_key' => $apikey,
        //     'template_name' => $otherress['masssage_template'],
        //     'file' => new CURLFILE(base_url() . $file_name)
        // );
          curl_setopt_array($curl, array(
              CURLOPT_URL => 'http://65.0.180.255/api/broadcast',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => json_encode($payload),
              CURLOPT_HTTPHEADER => array('Content-Type: application/json')
          ));
      
          $response = curl_exec($curl);
          $response = json_decode($response,true);
          $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
          curl_close($curl);
          if($httpcode == 200){
              $this->session->set_flashdata('success_message','Broadcasted Successfully');    
              redirect(base_url('user/user/add_broadcast'),'refresh');
              exit;
          }else{
              $this->session->set_flashdata('error_message','Broadcast massage not sent');    
              redirect(base_url('user/user/add_broadcast'),'refresh');
              exit;
          }

        //   if(!empty($contact_details))
        //   {
        //       $insdata = array();
        //       $i =0;
        //        $con= array();
        //       foreach($contact_details as $key)
        //       {
    
        //         $to = $key['wa_id'];
        //         $wa_id = $key['wa_id'];
        //         if($key['status'] == 'valid'){
        //           $arr = '{
        //                 "to": "'.$to.'",
        //                 "type": "template",
        //                 "template": {
        //                     "namespace": "'.$namespace.'",
        //                     "language": {
        //                         "policy": "deterministic",
        //                         "code": "'.$language.'"
        //                     },
        //                     "name": "'.$name.'",
        //                     "components": [ '.$headers.' {
        //                             "type": "body",
        //                             "parameters": '.json_encode($pera).'
        //                         }
        //                     ]
        //                 }
        //             }';
                 
        //               if($send_type == 'Send Now'){  
        //                  //$this->send_massages($arr);
        //               }
        //            $con_status='valid';   
        //            $send_status ='0';
        //          }else{
        //            $con_status='invalid';
        //            $wa_id = $key['phone'];
        //            $arr = '';
        //             $send_status ='1';
        //          }
                 
        //           $insdata[] = array_merge(array('wa_id'=>$wa_id,
        //                              'con_status'=>$con_status,
        //                              'data_ress'=>$arr,
        //                              'status'=>$send_status
        //                              ),$otherress);
                 
        //       }
              
              
        //       $this->message_recru(10000,$target_audience,$send_type,$headers,$pera,$tags,$namespace,$language,$name,$otherress,$key['id']);
        //   }
          
        //   if(!empty($insdata))
        //   {
        //       $this->adminmodel->insert_rows('send_schedule',$insdata);
        //   }
          
       
   }
   
   
   public function con_recru($limit,$last_id="")
   {
          if(!empty($last_id))
          {
              $whr = "and id > $last_id";
          }else{
              $whr ='';
          }
          $created_by = $this->session->userdata['user_session']['user_id'];
          $contact_details = $this->adminmodel->custom_query("SELECT * FROM `contact_details` WHERE  created_by = $created_by and status IS NULL $whr  limit $limit" );
          $con= array();
          if(!empty($contact_details))
          {
              $insdata = array();
              $i =0;
               $con= array();
              foreach($contact_details as $key)
              {
                   $to = $key['phone'];
                   
    
                   $con['blocking'] = "wait";
                   $con['contacts'][] = $to;
                   $con['force_check'] = true; 
                 
              }
              
              
              $this->con_recru(2500,$key['id']);
          }
          
          //echo "<pre>";
          if(!empty($con))
          {
           //echo json_encode($con);
           $ress = json_decode($this->verify_contact($con));
            //print_r($ress->contacts);die;
           if(!empty($ress->contacts))
           {   
               $udata = array();
               foreach($ress->contacts as $key)
               { 
                  if(!empty($key->wa_id))
                  {
                      $wa_id = $key->wa_id;
                  }else{
                      $wa_id = '';
                  }
                  $udata[]=array('phone'=>$key->input,
                                 'wa_id'=>$wa_id,
                                 'status'=>$key->status,
                  
                  ); 
               }
               //print_r($udata);
               $this->db->update_batch('contact_details', $udata, 'phone');
           }
          }
               
   }
   
   public function get_templates()
   {
        $apikey = $this->session->userdata['user_session']['dsix_api_key'];

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://waba.360dialog.io/v1/configs/templates",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
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
   
   
   
   public function verify_contact($con)
   {
         /* Endpoint */
        $apikey = $this->session->userdata['user_session']['dsix_api_key']; 
        $url = 'https://waba.360dialog.io/v1/contacts';
   
        /* eCurl */
        $curl = curl_init($url);
   
        /* Data */
        $data = json_encode($con);
   
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
       
   
   public function verify_con($contact)
   {
       $curl = curl_init();
       $apikey = $this->session->userdata['user_session']['dsix_api_key'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://waba.360dialog.io/v1/contacts",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 300000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "{\n  \"blocking\": \"wait\",\n  \"contacts\": [\n   \"$contact\"\n  ],\n  \"force_check\": true\n}\n",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "d360-api-key: $apikey",
            "postman-token: 9de2de14-0525-5dd1-97f6-b941a35c457e"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
   }
   
   public function send_massages($arr)
   {
       $curl = curl_init();
        $apikey = $this->session->userdata['user_session']['dsix_api_key'];
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://waba.360dialog.io/v1/messages",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30000,
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
   
   public function delivered()
    {  
        
        $results['pagetitle']='Delivered  List';
        $results['title']=' Delivered  List';
        $results['List']=' Delivered  List';
        
       
        
        if(!empty($_GET['schedule_date_time']))
        {
            $send_date_time = $_GET['send_date_time'].' 00:00:00';
            $to_date_time = $_GET['send_date_time'].' 23:59:59';
            $whrs = "and send_date_time between '".$send_date_time."' and  '".$to_date_time."'";
        }else{
            $whrs= '';
        }
        $results['past_data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." and status = 1 and schedule_date_time <= '".date("Y-m-d H:i:s")."' and con_status ='valid' $whrs " );
        
        $results['future_data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." and status = 1 and schedule_date_time >= '".date("Y-m-d H:i:s")."' and con_status ='valid' $whrs " );
        $results['tags'] = $this->adminmodel->getwhere('tag_list');
        $this->load->view('user/pages/broacast_list.php',$results);

    }
    
    public function outgoing()
    {  
        
        $results['pagetitle']='Outgoing  List';
        $results['title']=' Outgoing  List';
        $results['List']=' Outgoing  List';
        
       
        if(!empty($_GET['schedule_date_time']))
        {
            $send_date_time = $_GET['send_date_time'].' 00:00:00';
            $to_date_time = $_GET['send_date_time'].' 23:59:59';
            $whrs = "and send_date_time between '".$send_date_time."' and  '".$to_date_time."'";
        }else{
            $whrs= '';
        }
        $results['past_data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." and status = 1 and schedule_date_time <= '".date("Y-m-d H:i:s")."'  $whrs " );
        
        $results['future_data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." and status = 1 and schedule_date_time >= '".date("Y-m-d H:i:s")."'  $whrs " );
        $results['tags'] = $this->adminmodel->getwhere('tag_list');
        $this->load->view('user/pages/broacast_list.php',$results);

    }
    
    public function failed()
    {  
        
        $results['pagetitle']='Failed  List';
        $results['title']=' Failed  List';
        $results['List']='Failed List';
        
      
        if(!empty($_GET['schedule_date_time']))
        {
            $send_date_time = $_GET['send_date_time'].' 00:00:00';
            $to_date_time = $_GET['send_date_time'].' 23:59:59';
            $whrs = "and send_date_time between '".$send_date_time."' and  '".$to_date_time."'";
        }else{
            $whrs= '';
        }
        $results['past_data'] = $this->adminmodel->custom_query("SELECT * FROM `send_schedule` WHERE created_by = ".$this->session->userdata['user_session']['user_id']." and status = 1 and con_status != 'valid'   $whrs " );
        
        
        $results['tags'] = $this->adminmodel->getwhere('tag_list');
        $this->load->view('user/pages/broacast_list.php',$results);

    }
   
}