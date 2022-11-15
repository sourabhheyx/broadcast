<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        /* check admin is logged in or not*/
           // $this->output->clear_cache();
           if(!$this->session->userdata('user_session'))
            {
                redirect(base_url('user-login'),'refresh');
            }
           
    } 
  
   //-----------------------------------------Add product_type ------------------------------------------------------//
       public function product_type($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('product_type', 'product_type','trim|required|xss_clean');
            if($this->form_validation->run()==true){
             
                $data = array('product_type'=>$this->input->post('product_type'),
                              'product_slug'=> preg_replace('~[^\pL\d]+~u', '-', strtolower($this->input->post('product_type'))),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('product_type',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('product_type',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/product_type'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Product Type";
         $results['update'] = $this->adminmodel->getwheres('product_type',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Product Type";        
                }
         $results['title'] = "Product Type";  
         $results['List'] = "Product Type";
         $results['data'] = $this->adminmodel->getwhere('product_type');

        $this->load->view('user/pages/product_type.php',$results);
    }
    
    
     public function active_product_type($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('product_type',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('product_type',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('product_type',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('user/master/product_type'),'refresh');
            exit;  
        }
    }
    
    public function product_typeDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('product_type',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/product_type'),'refresh');
        exit;
    }
    
   //-----------------------------------------Add category ------------------------------------------------------//
       public function category($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('product_type', 'product_type','trim|required|xss_clean');
           $this->form_validation->set_rules('category', 'category','trim|required|xss_clean');
            if($this->form_validation->run()==true){
                 if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/category/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '100000000000000000000';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
                }else{
                    $image = $this->input->post('oldimage');
                }
                $data = array('user_id'=>$this->session->userdata['user_session']['user_id'],
                              'product_type'=>$this->input->post('product_type'),
                              'category'=>$this->input->post('category'),
                              'image'=>$image,
                              'category_slug'=> preg_replace('~[^\pL\d]+~u', '-', strtolower($this->input->post('category'))),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('category',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('category',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/category'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Category";
         $results['update'] = $this->adminmodel->getwheres('category',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Category";        
                }
         $results['title'] = "Category";  
         $results['List'] = "Category";
         $results['data'] = $this->adminmodel->getwhere('category',array('user_id'=>$this->session->userdata['user_session']['user_id']));
         $results['product_type'] = $this->adminmodel->getwhere('product_type',array('status'=>1));
        $this->load->view('user/pages/category.php',$results);
    }
    
    
     public function active_category($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('category',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('category',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('category',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('user/master/category'),'refresh');
            exit;  
        }
    }
    
    public function categoryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('category',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/category'),'refresh');
        exit;
    }
    
 
   //-----------------------------------------Add subcategory ------------------------------------------------------//
       public function subcategory($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('product_type', 'product_type','trim|required|xss_clean');
           $this->form_validation->set_rules('category_id', 'category_id','trim|required|xss_clean');
           $this->form_validation->set_rules('subcategory', 'subcategory','trim|required|xss_clean');
            if($this->form_validation->run()==true){
                if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/subcategory/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '100000000000000000000';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
                }else{
                    $image = $this->input->post('oldimage');
                }
                $data = array(
                              'user_id'=>$this->session->userdata['user_session']['user_id'],
                              'product_type'=>$this->input->post('product_type'),
                              'category_id'=>$this->input->post('category_id'),
                              'subcategory'=>$this->input->post('subcategory'),
                              'image'=>$image,
                              'subcategory_slug'=> preg_replace('~[^\pL\d]+~u', '-', strtolower($this->input->post('subcategory'))),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('subcategory',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('subcategory',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/subcategory'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Sub Category";
         $results['update'] = $this->adminmodel->getwheres('subcategory',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Sub Category";        
                }
         $results['title'] = "Sub Category";  
         $results['List'] = "Sub Category";
         $results['data'] = $this->adminmodel->getwhere('subcategory',array('user_id'=>$this->session->userdata['user_session']['user_id']));
         $results['product_type'] = $this->adminmodel->getwhere('product_type',array('status'=>1));
         $results['category_id'] = $this->adminmodel->getwhere('category',array('status'=>1,'user_id'=>$this->session->userdata['user_session']['user_id']));
        $this->load->view('user/pages/subcategory.php',$results);
    }
    
    
     public function active_subcategory($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('subcategory',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('subcategory',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('subcategory',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('user/master/subcategory'),'refresh');
            exit;  
        }
    }
    
    public function subcategoryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('subcategory',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/subcategory'),'refresh');
        exit;
    }
    //-----------------------------------------Add order_charge ------------------------------------------------------//
       public function order_charge($id="")
    {
       $res = $this->adminmodel->getwheres('delivery_charge',array('status'=>1,'user_id'=>$this->session->userdata['user_session']['user_id']));
       $id = $res['id'];
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('amount', 'amount','trim|required|xss_clean');
           
            if($this->form_validation->run()==true){
             
                $data = array('amount'=>$this->input->post('amount'),
                              'delivery_charge'=>$this->input->post('delivery_charge'),
                              'user_id'=>$this->session->userdata['user_session']['user_id'],
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('delivery_charge',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('delivery_charge',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/order_charge'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Update Delivery Charge";
         $results['update'] = $this->adminmodel->getwheres('delivery_charge',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Delivery Charge";        
                }
         $results['title'] = "Delivery Charge";  
         $results['List'] = "Delivery Charge";
         $results['data'] = $this->adminmodel->getwhere('delivery_charge',array('status'=>1,'user_id'=>$this->session->userdata['user_session']['user_id']));

        $this->load->view('user/pages/order_charge.php',$results);
    }
    
    
    //-----------------------------------------Add order_limit ------------------------------------------------------//
       public function order_limit($id="")
    {
      
        if($this->input->post())
        {
         
               $count = count($this->input->post('title')); 
               for($i=0; $i < $count; $i++){
               
                $data = array('amount'=>$this->input->post('amount')[$i],
                              'title'=>$this->input->post('title')[$i],
                              'user_id'=>$this->session->userdata['user_session']['user_id'],
                               );
                               
                    if(!empty($this->input->post('id')[$i]))
                    {
                      $res = $this->adminmodel->update_data('order_limit',array('id'=>$this->input->post('id')[$i]),$data);
                    }else{
                      $res = $this->adminmodel->insert_data('order_limit',$data);
                    }
               }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/order_limit'),'refresh');
                exit; 
            
            
            }
        
         $results['pagetitle'] = "Set Order Limit";        

         $results['title'] = "Order Limit";  
         $results['List'] = "Order Limit";
         $results['data'] = $this->adminmodel->getwhere('order_limit',array('user_id'=>$this->session->userdata['user_session']['user_id']));
         $this->load->view('user/pages/order_limit.php',$results);
    }
 //---------------------------------------delivery_area--------------------------------------------------------------//
 
 
         public function delivery_area($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('state_id', 'state_id','trim|required|xss_clean');
    
            if($this->form_validation->run()==true){
                if(!empty($this->input->post('area_name')))
                {
                  $area_name = $this->input->post('area_name');   
                }else{
                  $area_name = "All Areas";  
                }
                if(!empty($this->input->post('pincode')))
                {
                  $pincode = $this->input->post('pincode');   
                }else{
                  $pincode = "All Pincodes";  
                }
                $data = array('state_id'=>$this->input->post('state_id'),
                              'district_id'=>$this->input->post('district_id'),
                              'city_id'=>$this->input->post('city_id'),
                              'area_name'=>$area_name,
                              'pincode'=>$pincode,
                              'user_id'=>$this->session->userdata['user_session']['user_id'],
                              'delivery_charge'=>$this->input->post('delivery_charge'),
                             );
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('area_charges',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('area_charges',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/delivery_area'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Delivery Areas";
         $results['update'] = $this->adminmodel->getwheres('area_charges',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Delivery Area";        
                }
         $results['title'] = "Delivery Area";  
         $results['List'] = "Delivery Area";
         $results['data'] = $this->adminmodel->getwhere('area_charges',array('user_id'=>$this->session->userdata['user_session']['user_id']));
         $results['state'] = $this->adminmodel->getwhere('state',array('status'=>1));
         $results['city'] = $this->adminmodel->getwhere('city',array('status'=>1));
         $results['city_block'] = $this->adminmodel->getwhere('city_block',array('status'=>1));
        $this->load->view('user/pages/delivery_area.php',$results);
    }
    
    
    
    public function delivery_areaDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('area_charges',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/delivery_area'),'refresh');
        exit;
    }
    
    
    public function banner($id ="")
    {   
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            
           if ($this->form_validation->run() == true) 
  		{      
  		    
  		        if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/banner';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '10000000000000000000000000000000000000';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
                }else{
                    $image = $this->input->post('oldimage');
                }
                $data = array('title'=>$this->input->post('title'),
                    'image'=>$image,
                    'user_id'=>$this->session->userdata['user_session']['user_id']
                      );
                          
                 if(!empty($id))
               {
                $res = $this->adminmodel->update_data('banner',array('id'=>$id,'user_id'=>$this->session->userdata['user_session']['user_id']),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('banner',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('user/master/banner'),'refresh');
                exit; 
            }
            
        }
        if(!empty($id))
        {
        $results['title']=" Banner";
        $results['pagetitle']=" Banner";   
        $results['update']=$this->adminmodel->getwheres('banner',array('type'=>'banner'));
        }else{
        $results['title']="Banner";
        $results['pagetitle']="Banner";
        }
        $results['List']="Banner List";
        $results['data']=$this->adminmodel->getwhere('banner',array('user_id'=>$this->session->userdata['user_session']['user_id']));
        $this->load->view('user/pages/banner.php',$results);
    }
    
     public function bannerdelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('banner',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/banner'),'refresh');
        exit;
    }
    
     //-----------------------------------------Add payment_method ------------------------------------------------------//
       public function payment_method($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('payment_mode', 'payment_mode','trim|required|xss_clean');
           $this->form_validation->set_rules('mobile', 'mobile','trim|required|xss_clean');
            if($this->form_validation->run()==true){
                 if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/scannerimage/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['max_size'] = '100000000000000000000';
                $config['file_name'] = $_FILES['image']['name'];
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                
                if($this->upload->do_upload('image')){
                    $uploadData = $this->upload->data();
                    $image = $uploadData['file_name'];
                }else{
                    $image = '';
                }
                }else{
                    $image = $this->input->post('oldimage');
                }
                $data = array('user_id'=>$this->session->userdata['user_session']['user_id'],
                              'payment_mode'=>$this->input->post('payment_mode'),
                              'mobile'=>$this->input->post('mobile'),
                              'scaner_img'=>$image,
                              //'upi'=>$this->input->post('upi'),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('payment_method',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('payment_method',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('user/master/payment_method'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Payment Method";
         $results['update'] = $this->adminmodel->getwheres('category',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Payment Method";        
                }
         $results['title'] = "Payment Method";  
         $results['List'] = "Payment Method";
         $results['data'] = $this->adminmodel->getwhere('payment_method',array('user_id'=>$this->session->userdata['user_session']['user_id']));
        $this->load->view('user/pages/payment_method.php',$results);
    }
    
    
     public function active_payment_method($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('payment_method',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('payment_method',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('payment_method',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('user/master/payment_method'),'refresh');
            exit;  
        }
    }
    
    public function payment_methodDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('payment_method',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/payment_method'),'refresh');
        exit;
    }
    
    
    public function active_time($id){
         $user_id=$this->session->userdata['user_session']['user_id'];
        $this->adminmodel->update_data('delivery_time',array('user_id'=>$user_id),array('status'=>0));
        $whr = array('id'=>$id);
        $data = array('status'=>1);
        $this->adminmodel->update_data('delivery_time',$whr,$data);
        
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('user/master/delivery_time'),'refresh');
        exit;
    }
    
    
    public function delivery_time($id ="")
    {   
        $user_id=$this->session->userdata['user_session']['user_id'];
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('slote_time', 'slote_time','trim|required|xss_clean');
            $this->form_validation->set_rules('type', 'type','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('slote_time'=>$this->input->post('slote_time'),
                    'type'=>$this->input->post('type'),
                    'user_id'=>$user_id,
                    );
                          
                 if(!empty($id))
               {
                $res = $this->adminmodel->update_data('delivery_time',array('id'=>$id),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('delivery_time',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('user/master/delivery_time'),'refresh');
                exit; 
            }
            
        }
        if(!empty($id))
        {
        $results['title']=" Delivery Time";
        $results['pagetitle']=" Delivery Time";   
        $results['update']=$this->adminmodel->getwheres('delivery_time',array('user_id'=>$user_id));
        }else{
        $results['title']="Delivery Time";
        $results['pagetitle']="Delivery Time";
        }
        $results['List']="Delivery Time List";
        $results['data']=$this->adminmodel->getwhere('delivery_time',array('user_id'=>$user_id));
        $this->load->view('user/pages/delivery_time.php',$results);
    }
   
}