<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
        date_default_timezone_set("Asia/Kolkata");
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
        
        $this->load->view('Admin/index');

    }
    /*++++++++++++++++++end index function++++++++++++++++*/
//---------------------------- User Function---------------------------------------------//
    
    public function Adduser($id="")
    {
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('name', 'Full Name','trim|required|xss_clean');
            if($id==""){
            $this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'password','trim|required|xss_clean');
            $this->form_validation->set_rules('mobile', 'Phone Number','xss_clean|trim|numeric|max_length[10]|required|is_unique[users.mobile]');
            }else{
            $this->form_validation->set_rules('mobile', 'Phone Number','xss_clean|trim|numeric|max_length[10]|required');   
            }
            
            if($this->form_validation->run()==true){
                $reffer_code = preg_replace('~[^\pL\d]+~u', '', strtolower($this->input->post('name'))).rand(11,99);
                $data = array('name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'password'=>$this->input->post('password'),
                    'mobile'=>$this->input->post('mobile'),
                    'reffer_code'=>$reffer_code,
                    'address'=>$this->input->post('address'),
                    'dsix_api_key'=>$this->input->post('dsix_api_key'),
                    'monthly_contact'=>$this->input->post('monthly_contact'),
                    'status'=>1,);
                    
                if($id !=""){
                 $res = $this->adminmodel->update_data('users',array('user_id'=>$id),$data);   
                }else{ 
                 $res = $this->adminmodel->insert_data('users',$data);
                
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
                redirect(base_url('admin/user/AllUser'),'refresh');
                exit; 
            }
            
        }
        if($id != "")
        {
            $results['update'] = $this->adminmodel->getwheres('users' ,array('user_id'=>$id));
            $results['pagetitle']='Edit User';
            $results['title']='Edit User';
        }else{
            $results['pagetitle']='Add User';
            $results['title']='Add User';   
        }
        $results['data'] = $this->adminmodel->getwhere('users');
        $results['List']='User List';
        $this->load->view('Admin/pages/Adduser.php',$results);
    }
    
    public function active_user($id){
        $whr = array('user_id'=>$id);
        $admition = $this->adminmodel->getwheres('users',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('users',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('users',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','review Status Added Successfully');
            redirect(base_url('admin/User/Adduser'),'refresh');
            exit;  
        }
    }
    
    public function userDelete($id){
        $whr = array('user_id'=>$id);
        $this->adminmodel->delete('users',$whr);
        $this->session->set_flashdata('success_message','Reviews Deleted Successfully');
        redirect(base_url('admin/User/Adduser'),'refresh');
        exit;
    }
    
    public function AllUser()
    {  
        
        $results['pagetitle']='view User';
        $results['title']='view User';
        $results['List']='view User List';
        $results['data'] = $this->adminmodel->getwhere('users');
        $this->load->view('Admin/pages/userslist.php',$results);

    }

     public function referrals()
    {  
        
        $results['pagetitle']='User Referrals';
        $results['title']='User Referrals';
        $results['List']='User List Referrals';
        $results['data'] = $this->adminmodel->getwhere('users',array('refferal_by !='=> ''));
        $this->load->view('Admin/pages/referrals.php',$results);

    }

    public function loan_applications()
    {  
        
        $results['pagetitle']='User Loan Application';
        $results['title']='User Loan Application';
        $results['List']='User List Loan Application';
        $results['data'] = $this->adminmodel->getwhere('loan_application',array('complete_status'=> 1));
        $this->load->view('Admin/pages/loan_applications.php',$results);

    }

     public function payments()
    {  
        
        $results['pagetitle']='User Payment History';
        $results['title']='User Payment History';
        $results['List']='User Payment History';
        $results['data'] = $this->adminmodel->getwhere('payment_history');
        $this->load->view('Admin/pages/payments.php',$results);

    }

     public function payments_request()
    {  
        
        $results['pagetitle']=' User Payment Request';
        $results['title']=' User Payment Request';
        $results['List']=' User Payment Request';
        $results['data'] = $this->adminmodel->getwhere('payments_request');
        $this->load->view('Admin/pages/payments_request.php',$results);

    }


    public function wallet_history()
    {  
        
        $results['pagetitle']=' User Wallet History';
        $results['title']=' User Wallet History';
        $results['List']=' User Wallet History';
        $results['data'] = $this->adminmodel->getwhere('wallet_history');
        $this->load->view('Admin/pages/wallet_history.php',$results);

    }
    
   
    


   
    
    
////--------------------------------add_permission---------------------------------------//

    public function add_permission($id="")
    {
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('user_id', 'user_id','trim|required|xss_clean');
            $this->form_validation->set_rules('menu_id', 'menu_id','trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'status','trim|required|xss_clean');
            if($this->form_validation->run()==true){
                $data = array('user_id'=>$this->input->post('user_id'),
                              'menu_id'=>$this->input->post('menu_id'),);
                  
                if($this->input->post('status') == '2'){
                 
                 $getmenulist = $this->adminmodel->getwhere('submenu',array('menu_id'=>$this->input->post('menu_id')));
  		       if(!empty($getmenulist))
  		       {
  		           foreach($getmenulist as $key => $vals)
  		           {
  		             $this->adminmodel->delete('permission',array('sub_id'=>$vals['sub_id'],'user_id'=>$this->input->post('user_id')));  
  		           }
  		       }
                     
                 $this->adminmodel->delete('permission',$data); 
                 echo  $this->input->post('status');
                }else{ 
                  $this->adminmodel->insert_data('permission',$data);
                 echo  $this->input->post('status');
                }
                
                exit; 
            }
            
        }
        if($id != "")
        {
            $results['update'] = $this->adminmodel->getwheres('permission' ,array('user_id'=>$id));
            $results['pagetitle']='Edit User Permission';
            $results['title']='Edit User Permission';
        }else{
            $results['pagetitle']='Add User Permission';
            $results['title']='Add User Permission';   
        }
        if($this->session->userdata['admin_session']['type'] == '0'){
        $results['data'] = $this->adminmodel->getwhere('admin' ,array('type'=>1));
        }else{
        $results['data'] = $this->adminmodel->getwhere('admin' ,array('type'=>2,'addedby'=>$this->session->userdata['admin_session']['user_id']));    
        }
        $results['List']='User List';
        $this->load->view('Admin/pages/add_permission.php',$results);
    }
    
    public function add_subpermission($id="")
    {
        if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('user_id', 'user_id','trim|required|xss_clean');
            $this->form_validation->set_rules('menu_id', 'menu_id','trim|required|xss_clean');
            $this->form_validation->set_rules('status', 'status','trim|required|xss_clean');
            if($this->form_validation->run()==true){
                $data = array('user_id'=>$this->input->post('user_id'),
                              'sub_id'=>$this->input->post('menu_id'),);
                  
                if($this->input->post('status') == '2'){
                 $this->adminmodel->delete('permission',$data); 
                 echo  $this->input->post('status');
                }else{ 
                  $this->adminmodel->insert_data('permission',$data);
                 echo  $this->input->post('status');
                }
                
                exit; 
            }
            
        }
        if($id != "")
        {
            $results['update'] = $this->adminmodel->getwheres('permission' ,array('user_id'=>$id));
            $results['pagetitle']='Edit User Permission';
            $results['title']='Edit User Permission';
        }else{
            $results['pagetitle']='Add User Permission';
            $results['title']='Add User Permission';   
        }
        if($this->session->userdata['admin_session']['type'] == '0'){
        $results['data'] = $this->adminmodel->getwhere('admin' ,array('type'=>1));
        }else{
        $results['data'] = $this->adminmodel->getwhere('admin' ,array('type'=>2,'addedby'=>$this->session->userdata['admin_session']['user_id']));    
        }
        $results['List']='User List';
        $this->load->view('Admin/pages/add_permission.php',$results);
    }
    
     public function activeuser($id){
        $whr = array('user_id'=>$id);
        $admition = $this->adminmodel->getwheres('users',$whr); 
        if( $admition['status'] == '1'){
            $data = array('status'=>'0');
            $res = $this->adminmodel->update_data('users',$whr,$data);
        }else{
            $data = array('status'=>'1');
            $res = $this->adminmodel->update_data('users',$whr,$data);
        }
        if($res){
            $this->session->set_flashdata('success_message','user Status Change Successfully');
            redirect(base_url('admin/User/AllUser'),'refresh');
            exit;  
        }
    }
    
     //---------------------------- User Function---------------------------------------------//
    
   
    public function userspermission($id="")
    {
        if($this->input->post())
        {   
             if($this->input->post('status') == 0)
             {
             $res = $this->adminmodel->delete('order_status_sms_per',array('order_status'=>$this->input->post('order_status'),'user_id'=>$this->input->post('user_id')));   
             exit;    
             }else{
             $data = array('user_id'=>$this->input->post('user_id'),'order_status'=>$this->input->post('order_status'));
             $res = $this->adminmodel->insert_data('order_status_sms_per',$data);   
             exit;
             }
        }
        
        $results['pagetitle']='User List';
        $results['title']='User List';   
        $results['data'] = $this->adminmodel->getwhere('users' ,array('status'=>1));
        $results['List']='User List';
        $this->load->view('Admin/pages/userspermission.php',$results);
    }
 
 
     
}