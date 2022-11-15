<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    /*++++++++++++++++++start index function++++++++++++++++*/
    public function index()
    {
        $results['tousers'] = $this->adminmodel->getwhere('users');
        $this->load->view('Admin/index',$results);

    }
    /*++++++++++++++++++end index function++++++++++++++++*/

    /*++++++++++++++++++start user_list function++++++++++++++++*/
    
    public function add_enquiry($id="")
    {
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('Name', 'Name','trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'email','trim|required|xss_clean'); 
            $this->form_validation->set_rules('mob', 'Phone Number','xss_clean|trim|numeric|max_length[12]|required');
            $this->form_validation->set_rules('state', 'state', 'trim|required|xss_clean'); 
            $this->form_validation->set_rules('city', 'city', 'trim|required|xss_clean');  
            if($this->form_validation->run()==true){
                $data = array('Name'=>$this->input->post('Name'),
                    'email'=>$this->input->post('email'),
                    'state'=>$this->input->post('state'),
                    'city'=>$this->input->post('city'),
                    'mob'=>$this->input->post('mob'),
                    'address'=>$this->input->post('address'),
                    'price'=>$this->input->post('price'),
                    'description'=>$this->input->post('description'),
                    'activation_date'=>date('Y-m-d',strtotime($this->input->post('activation_date'))),
                    'status'=> '1',
                    'expire_date'=>date('Y-m-d',strtotime($this->input->post('expire_date'))));
                if(!empty($id))
                {
                 $res = $this->adminmodel->update_data('user_info',array('id'=>$id),$data);    
                }else{
                 $res = $this->adminmodel->insert_data('user_info',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Data Inserted Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Data Not Inserted Successfully');
                }
                redirect(base_url('admin/Dashboard/add_enquiry'),'refresh');
                exit; 
            }
            
        }
        
        if(!empty($id))
                {
         $results['pagetitle'] = "Edit User Information";
         $results['update'] = $this->adminmodel->getwheres('user_info',array('id'=>$id));
                }
                else{
         $results['pagetitle'] = "Add  User Information";        
                }
         $results['title'] = " User Information";  
         $results['List'] = " User Information"; 
         $results['data'] = $this->adminmodel->getwhere('user_info');
        $this->load->view('Admin/pages/add-enquiry.php',$results);
    }
     public function Profile()
    {  
              $id = $this->session->userdata['admin_session']['user_id'];
        if($this->input->post())
        {
        
              $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('name', 'name','trim|required|xss_clean');
           $this->form_validation->set_rules('email', 'email','trim|required|xss_clean');
               if($_POST["old_mobile"]!=$_POST["mobile"])
           {
                $this->form_validation->set_rules('mobile', 'mobile','trim|required|xss_clean|is_unique[admin.mobile]');    
           }
       
        
           $this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
        
           
            if($this->form_validation->run()==true){

                $data = array(
                    'password'=>$this->input->post('password'),
                    'name'=>$this->input->post('name'),
                    'username'=>$this->input->post('username'),
                    'email'=>$this->input->post('email'),
                    'mobile'=>$this->input->post('mobile'),
                     );
                     
                     
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('admin',array('user_id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('admin',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
                redirect(base_url('admin/Dashboard/Profile'),'refresh');
                exit; 
            }
               else
            {
                // echo validation_errors();
            }
        }
        
        $results['user'] = "Update Profile";
     
        $results['data'] = $this->adminmodel->getwheres('admin' ,array('user_id'=>$id));
        $this->load->view('Admin/pages/profile.php',$results);

    }
    public function UpdateProfile()
    {
        $id = $this->session->userdata['admin_session']['id'];
        
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('name', 'name','trim|required|xss_clean');
           $this->form_validation->set_rules('mobile', 'mobile','trim|required|xss_clean');
           $this->form_validation->set_rules('passout_year', 'passout_year','trim|required|xss_clean');
           $this->form_validation->set_rules('collage_name', 'collage_name','trim|required|xss_clean');
           $this->form_validation->set_rules('address', 'address','trim|required|xss_clean');
           $this->form_validation->set_rules('email', 'email','trim|required|xss_clean');
           
            if($this->form_validation->run()==true){

              

                $data = array('passout_year'=>$this->input->post('passout_year'),
                    'collage_name'=>$this->input->post('collage_name'),
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'address'=>$this->input->post('address'),
                    'mobile'=>$this->input->post('mobile'),
                     );
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('students',array('id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('students',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
                redirect(base_url('student/Dashboard/UpdateProfile'),'refresh');
                exit; 
            }
         
            
        }
          if(!empty($id))
                {
         $results['user'] = "Edit Uesr";
         $results['updata'] = $this->adminmodel->getwheres('students',array('id'=>$id));
                }
                else{
         $results['user'] = "Add Uesr";        
                }
         $results['user'] = $this->adminmodel->getwheres('students',array('id'=>$id)); 
        $this->load->view('student/UpdateProfile.php',$results);
    }
    
    public function Change_Password()
    {
        $id = $this->session->userdata['admin_session']['id'];
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
           $this->form_validation->set_rules('newpassword', 'newpassword','trim|required|xss_clean');
            if($this->form_validation->run()==true){

                $result = $this->adminmodel->getwheres('students',array('id'=>$id,'password'=>$this->input->post('password')));
                if(!empty($result))
                {
                  $res = $this->adminmodel->update_data('students',array('id'=>$id),array('password'=>$this->input->post('newpassword')));
                  $this->session->set_flashdata('success_message','Password Change Successfully');
                }else{
                   
                   $this->session->set_flashdata('error_message','Invalid Old Password');
                }
                
                redirect(base_url('student/Dashboard/Change_Password'),'refresh');
                exit; 
            }
            
        }
     
        $this->load->view('student/Change_Password.php');
    }

    public function enquiryDelete($id){
        $whr = array('id'=>$id);
        $this->adminmodel->delete('user_info',$whr);
        $this->session->set_flashdata('success_message','Data Deleted Successfully');
        redirect(base_url('admin/Dashboard/add_enquiry'),'refresh');
        exit;
    }
    
   
     
     
     
}