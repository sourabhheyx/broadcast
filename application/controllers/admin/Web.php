<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

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
  
    
    public function about_us($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'About'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'About',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'About'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/web/about_us'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']=" About Us";
        $results['pagetitle']=" About Us";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'About'));
        }else{
        $results['title']="About Us";
        $results['pagetitle']="About Us";
        }
        $results['List']="About Us List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'About'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
   
   
      public function aboutDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('web_pages',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/web/about_us'),'refresh');
        exit;
    }
    
    
     public function blog($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'blog'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'blog',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'blog'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/web/blog'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']=" Blog";
        $results['pagetitle']=" Blog";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'blog'));
        }else{
        $results['title']="Blog";
        $results['pagetitle']="Blog";
        }
        $results['List']="Blog List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'blog'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
   
   
      public function blogDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('web_pages',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/Web/blog'),'refresh');
        exit;
    }
    
    public function contect_us($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'contect_us'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'contect_us',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'contect_us'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/web/contect_us'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']=" Contact Us";
        $results['pagetitle']=" Contact Us";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'contect_us'));
        }else{
        $results['title']="Contact Us";
        $results['pagetitle']="Contact Us";
        }
        $results['List']="Contact Us List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'contect_us'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
   
   
      public function WhygateDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('web_pages',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/Web/Whygate'),'refresh');
        exit;
    }
    
     public function Add_Faq($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'FAQ'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'FAQ',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'FAQ'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/Web/Add_Faq'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']=" FAQ";
        $results['pagetitle']="FAQ";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'FAQ'));
        }else{
        $results['title']="FAQ";
        $results['pagetitle']="FAQ";
        }
        $results['List']="FAQ List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'FAQ'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
   
   
      public function FAQDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('web_pages',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/Web/Add_Faq'),'refresh');
        exit;
    }
    
    
    public function Privacypolices($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'Privacypolices'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'Privacypolices',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'Privacypolices'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/Web/Privacypolices'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']=" Privacy polices";
        $results['pagetitle']="Privacy polices";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'Privacypolices'));
        }else{
        $results['title']="Privacy polices";
        $results['pagetitle']="Privacy polices";
        }
        $results['List']="Privacy polices List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'Privacypolices'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
   
   
      public function PrivacypolicesDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('web_pages',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/Web/Privacypolices'),'refresh');
        exit;
    }
    
      
    public function Ourmission($id ="")
    {   $resu=$this->adminmodel->getwheres('web_pages',array('type'=>'Ourmission'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('title', 'title','trim|required|xss_clean');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
                $data = array('title'=>$this->input->post('title'),
                    'description'=>$this->input->post('description'),
                    'type'=>'Ourmission',
                    'status'=>'1',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('web_pages',array('type'=>'Ourmission'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('web_pages',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/Web/Ourmission'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']="Our mission";
        $results['pagetitle']="Our mission";   
        $results['update']=$this->adminmodel->getwheres('web_pages',array('type'=>'Ourmission'));
        }else{
        $results['title']="Our mission";
        $results['pagetitle']="Our mission";
        }
        $results['List']="Our mission List";
        $results['data']=$this->adminmodel->getwhere('web_pages',array('type'=>'Ourmission'));
        $this->load->view('Admin/pages/pages.php',$results);
    }
    
    
     public function slider($id ="")
    {   
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('description', 'description','trim|required|xss_clean');
           if ($this->form_validation->run() == true) 
  		{
  		    
              if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/';
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
  		    
                $data = array('image'=>$image,
                    'description'=>$this->input->post('description'),
                    'status'=>'1',);
                          
                 if(!empty($id))
               {
                $res = $this->adminmodel->update_data('slider',array('id'=>$id),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('slider',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Slider Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Slider Not Inserted Successfully');
                }
                redirect(base_url('admin/Web/slider'),'refresh');
                exit; 
            }
            
        }
        if(!empty($id))
        {
        $results['title']="Slider";
        $results['pagetitle']="Slider";   
        $results['update']=$this->adminmodel->getwheres('slider');
        }else{
        $results['title']="Slider";
        $results['pagetitle']="Slider";
        }
        $results['List']="Slider List";
        $results['data']=$this->adminmodel->getwhere('slider');
        $this->load->view('Admin/pages/Slider.php',$results);
    }
    
      public function SliderDelete($id ="")
    {  
        $whr = array('id'=>$id);
        $this->adminmodel->delete('slider',$whr);
        $this->session->set_flashdata('success_message','Slider Deleted Successfully');
        redirect(base_url('admin/Web/slider'),'refresh');
        exit;
    }
    
    
    public function webview($id ="")
    {   
        
        $resu=$this->adminmodel->getwheres('websetting',array('type'=>'web'));
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('web_name', 'web_name','trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'phone','trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email','trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'address','trim|required|xss_clean');
            $this->form_validation->set_rules('footer', 'footer','trim|required|xss_clean');
            $this->form_validation->set_rules('fee_charges', 'fee_charges','trim|required|xss_clean');
            
           if ($this->form_validation->run() == true) 
  		{
  		    
              if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/';
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
  		    
                $data = array('logo'=>$image,
                    'web_name'=>$this->input->post('web_name'),
                    'phone'=>$this->input->post('phone'),
                    'email'=>$this->input->post('email'),
                    'address'=>$this->input->post('address'),
                    'footer'=>$this->input->post('footer'),
                    'fee_charges'=>$this->input->post('fee_charges'),
                    'minimum_withdrow'=>$this->input->post('minimum_withdrow'),
                    'reffral_amt'=>$this->input->post('reffral_amt'),
                    
                    'type'=>'web',);
                          
                 if(!empty($resu))
               {
                $res = $this->adminmodel->update_data('websetting',array('type'=>'web'),$data);   
               }else{ 
                $res = $this->adminmodel->insert_data('websetting',$data);
               }
                if($res){
                    $this->session->set_flashdata('success_message','Setting Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Setting Not Inserted Successfully');
                }
                redirect(base_url('admin/web/webview'),'refresh');
                exit; 
            }
            
        }
        if(!empty($resu))
        {
        $results['title']="Setting";
        $results['pagetitle']="Setting";   
        $results['update']=$this->adminmodel->getwheres('websetting',array('type'=>'web'));
        }else{
        $results['title']="Setting";
        $results['pagetitle']="Setting";
        }
        $results['List']="Setting List";
        $results['data']=$this->adminmodel->getwhere('websetting',array('type'=>'web'));
        $this->load->view('Admin/pages/Webview.php',$results);
    }
    
      public function WebviewDelete($id ="")
    {  
        $whr = array('id'=>$id);
        $this->adminmodel->delete('websetting',$whr);
        $this->session->set_flashdata('success_message','Slider Deleted Successfully');
        redirect(base_url('admin/web/webview'),'refresh');
        exit;
    }
    
}