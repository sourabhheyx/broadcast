<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
    /*++++++++++++++++++start index function++++++++++++++++*/
    public function index()
    {
        $results['data'] = '';
        $results['contact'] = $this->adminmodel->getwhere('contact_details' ,array('created_by'=>$this->session->userdata['user_session']['user_id']));
        $results['send_report'] = $this->adminmodel->getwhere('send_report' ,array('created_by'=>$this->session->userdata['user_session']['user_id']));
        $results['delivered'] = $this->adminmodel->getwhere('send_schedule',
        array('created_by'=>$this->session->userdata['user_session']['user_id'],
        'status'=>1,
        'con_status'=>'valid'
        
        ));
        
        $results['failed'] = $this->adminmodel->getwhere('send_schedule',
        array('created_by'=>$this->session->userdata['user_session']['user_id'],
        'status'=>1,
        'con_status !='=>'valid'
        ));
        
        $results['outgoing'] = $this->adminmodel->getwhere('send_schedule',
        array('created_by'=>$this->session->userdata['user_session']['user_id'],
        'status'=>1
        ));
        
        
        $this->load->view('user/index',$results);

    }
    /*++++++++++++++++++end index function++++++++++++++++*/


     public function Profile()
    {  
        $id = $this->session->userdata['user_session']['user_id'];
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

              if(!empty($_FILES['image']['name'])){
                $config['upload_path'] = 'uploads/users/';
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
          

                $data = array(
                    'password'=>$this->input->post('password'),
                    'dsix_api_key'=>$this->input->post('dsix_api_key'),
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'mobile'=>$this->input->post('mobile'),
                    'image'=>$image,
                     );
                     
                     
                if(!empty($id))
                {
                  $res = $this->adminmodel->update_data('users',array('user_id'=>$id),$data);
                }else{
                $res = $this->adminmodel->insert_data('users',$data);
                }
                if($res){
                    
                     
                    $this->session->set_flashdata('success_message','Your info Update Successfully');
                }else{
                    $this->session->set_flashdata('error_message','Your info Update Not Successfully');
                }
              
                redirect(base_url('user/Dashboard/Profile'),'refresh');
                exit; 
            }
               else
            {
                // echo validation_errors();
            }
        }
        
        $results['user'] = "Update Profile";
     
        $results['data'] = $this->adminmodel->getwheres('users' ,array('user_id'=>$id));
        $this->load->view('user/pages/profile.php',$results);

    }
   
    public function change_password()
    {
        $id = $this->session->userdata['user_session']['id'];
        if($this->input->post())
        {
           $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
           $this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
           $this->form_validation->set_rules('newpassword', 'newpassword','trim|required|xss_clean');
            if($this->form_validation->run()==true){

                $result = $this->adminmodel->getwheres('users',array('id'=>$id,'password'=>$this->input->post('password')));
                if(!empty($result))
                {
                  $res = $this->adminmodel->update_data('users',array('id'=>$id),array('password'=>$this->input->post('newpassword')));
                  $this->session->set_flashdata('success_message','Password Change Successfully');
                }else{
                   
                   $this->session->set_flashdata('error_message','Invalid Old Password');
                }
                
                redirect(base_url('user/dashboard/change_Password'),'refresh');
                exit; 
            }
            
        }
     
        $this->load->view('users/pages/change_password.php');
    }

  
}