<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        /* check admin is logged in or not*/
           // $this->output->clear_cache();
           if(!$this->session->userdata('admin_session'))
            {
                redirect(base_url('admin-login'),'refresh');
            }
           
    } 
  
//-----------------------------------------Add country ------------------------------------------------------//
       public function country($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('country', 'country','trim|required|xss_clean');
            if($this->form_validation->run()==true){
            
                $data = array('country'=>$this->input->post('country'),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('country',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('country',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('admin/master/country'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Country";
         $results['update'] = $this->adminmodel->getwheres('country',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Country";        
                }
         $results['title'] = "Country";  
         $results['List'] = "Country";
         $results['data'] = $this->adminmodel->getwhere('country');

        $this->load->view('Admin/pages/country.php',$results);
    }
    
    
     public function active_country($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('country',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('country',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('country',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('admin/master/country'),'refresh');
            exit;  
        }
    }
    
    public function countryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('country',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/country'),'refresh');
        exit;
    }
    
   
 //-----------------------------------------Add state ------------------------------------------------------//
       public function state($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('country_id', 'country_id','trim|required|xss_clean');
           $this->form_validation->set_rules('state', 'state','trim|required|xss_clean');
            if($this->form_validation->run()==true){
            
                $data = array('country_id'=>$this->input->post('country_id'),
                              'state'=>$this->input->post('state'),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('state',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('state',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('admin/master/state'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit State";
         $results['update'] = $this->adminmodel->getwheres('state',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add State";        
                }
         $results['title'] = "State";  
         $results['List'] = "State";
         $results['data'] = $this->adminmodel->getwhere('state');
         $results['country'] = $this->adminmodel->getwhere('country',array('status'=>1));
         $this->load->view('Admin/pages/state.php',$results);
    }
    
    
     public function active_state($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('state',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('state',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('state',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('admin/master/state'),'refresh');
            exit;  
        }
    }
    
    public function stateDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('state',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/state'),'refresh');
        exit;
    }
      
    //-----------------------------------------Add district ------------------------------------------------------//
       public function district($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('country_id', 'country_id','trim|required|xss_clean');
           $this->form_validation->set_rules('state_id', 'state_id','trim|required|xss_clean');
           $this->form_validation->set_rules('city', 'city','trim|required|xss_clean');
            if($this->form_validation->run()==true){
            
                $data = array('country_id'=>$this->input->post('country_id'),
                              'state_id'=>$this->input->post('state_id'),
                              'city'=>$this->input->post('city'),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('city',array('id'=>$id),$data);
                }else{
                  $res = $this->adminmodel->insert_data('city',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('admin/master/district'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit District";
         $results['update'] = $this->adminmodel->getwheres('city',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add District";        
                }
         $results['title'] = "District";  
         $results['List'] = "District";
         $results['data'] = $this->adminmodel->getwhere('city');
         $results['country'] = $this->adminmodel->getwhere('country',array('status'=>1));
         $results['state'] = $this->adminmodel->getwhere('state',array('status'=>1));
         $this->load->view('Admin/pages/city.php',$results);
    }
    
    
     public function active_city($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('city',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('city',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('city',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('admin/master/district'),'refresh');
            exit;  
        }
    }
    
    public function cityDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('city',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/district'),'refresh');
        exit;
    }
      
   
   
     //-----------------------------------------Add city Block ------------------------------------------------------//
       public function city_block($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('country_id', 'country_id','trim|required|xss_clean');
           $this->form_validation->set_rules('state_id', 'state_id','trim|required|xss_clean');
           $this->form_validation->set_rules('city_id', 'city_id','trim|required|xss_clean');
           $this->form_validation->set_rules('block', 'block','trim|required|xss_clean');
           $this->form_validation->set_rules('pincode', 'pincode','trim|required|xss_clean');
            if($this->form_validation->run()==true){
            
                $data = array('country_id'=>$this->input->post('country_id'),
                              'state_id'=>$this->input->post('state_id'),
                              'city_id'=>$this->input->post('city_id'),
                              'block'=>$this->input->post('block'),
                              'pincode'=>$this->input->post('pincode'),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('city_block',array('id'=>$id),$data);
                }else{
                  $res = $this->adminmodel->insert_data('city_block',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('admin/master/city_block'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit City Block";
         $results['update'] = $this->adminmodel->getwheres('city_block',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add City Block";        
                }
         $results['title'] = "City";  
         $results['List'] = "City";
         $results['data'] = $this->adminmodel->getwhere('city_block');
         $results['country'] = $this->adminmodel->getwhere('country',array('status'=>1));
         $results['state'] = $this->adminmodel->getwhere('state',array('status'=>1));
         $results['city'] = $this->adminmodel->getwhere('city',array('status'=>1));
         $this->load->view('Admin/pages/city_block.php',$results);
    }
    
    
     public function active_city_block($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('city_block',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('city_block',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('city_block',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('admin/master/city_block'),'refresh');
            exit;  
        }
    }
    
    public function city_blockDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('city_block',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/city_block'),'refresh');
        exit;
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
              
               redirect(base_url('admin/master/product_type'),'refresh');
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

        $this->load->view('Admin/pages/product_type.php',$results);
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
            redirect(base_url('admin/master/product_type'),'refresh');
            exit;  
        }
    }
    
    public function product_typeDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('product_type',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/product_type'),'refresh');
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
                $data = array('product_type'=>$this->input->post('product_type'),
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
              
               redirect(base_url('admin/master/category'),'refresh');
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
         $results['data'] = $this->adminmodel->getwhere('category');
         $results['product_type'] = $this->adminmodel->getwhere('product_type',array('status'=>1));
        $this->load->view('Admin/pages/category.php',$results);
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
            redirect(base_url('admin/master/category'),'refresh');
            exit;  
        }
    }
    
    public function categoryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('category',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/category'),'refresh');
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
                $data = array('product_type'=>$this->input->post('product_type'),
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
              
               redirect(base_url('admin/master/subcategory'),'refresh');
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
         $results['data'] = $this->adminmodel->getwhere('subcategory');
         $results['product_type'] = $this->adminmodel->getwhere('product_type',array('status'=>1));
         $results['category_id'] = $this->adminmodel->getwhere('category',array('status'=>1));
        $this->load->view('Admin/pages/subcategory.php',$results);
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
            redirect(base_url('admin/master/subcategory'),'refresh');
            exit;  
        }
    }
    
    public function subcategoryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('subcategory',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/subcategory'),'refresh');
        exit;
    }
    
//-----------------------------------------Add membership ------------------------------------------------------//
       public function membership($id="")
    {
      
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
           $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           $this->form_validation->set_rules('product_upload', 'product_upload','trim|required|xss_clean');
           $this->form_validation->set_rules('membership_type', 'membership_type','trim|required|xss_clean');
           $this->form_validation->set_rules('membership_amt', 'membership_amt','trim|required|xss_clean');
            if($this->form_validation->run()==true){
            
                $data = array('title'=>$this->input->post('title'),
                              'description'=>$this->input->post('description'),
                              'product_upload'=>$this->input->post('product_upload'),
                              'membership_type'=>$this->input->post('membership_type'),
                              'membership_amt'=>$this->input->post('membership_amt'),
                              'date'=>date("Y-m-d"),
                              'status'=>'1',);
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('membership',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('membership',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
               redirect(base_url('admin/master/membership'),'refresh');
                exit; 
            }
            
        }
          if(!empty($id))
                {
         $results['pagetitle'] = "Edit Membership";
         $results['update'] = $this->adminmodel->getwheres('membership',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add Membership";        
                }
         $results['title'] = "Membership";  
         $results['List'] = "Membership";
         $results['data'] = $this->adminmodel->getwhere('membership');

        $this->load->view('Admin/pages/membership.php',$results);
    }
    
    
     public function active_membership($id){
        $whr = array('id'=>$id);
        $admition = $this->adminmodel->getwheres('membership',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('membership',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('membership',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','Data Updated Successfully');
            redirect(base_url('admin/master/membership'),'refresh');
            exit;  
        }
    }
    
    public function membershipDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('membership',$whr);
        $this->session->set_flashdata('news_message','Data Deleted Successfully');
        redirect(base_url('admin/master/membership'),'refresh');
        exit;
    }
    
     
    
}