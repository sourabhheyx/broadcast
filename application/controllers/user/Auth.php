<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
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
        $this->load->model('adminmodel');
	}




	/* 2. show login page of website*/
	public function index(){
        $data['abc'] = '';
        if($this->session->userdata('user_session')) {
       
          redirect(base_url('user-dashboard'),'refresh');    
           
        }

        if($this->input->post()){
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'PAssword', 'trim|required|xss_clean|callback_check_database');
            $this->form_validation->set_error_delimiters('<p class="alert alert-danger" style="color:red;">', '</p>');
            if($this->form_validation->run() === TRUE)
            { 
                $data['user_data'] = $this->session->userdata('user_session');
                
                if($this->input->post('checkbox')) {
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                   setcookie("junaid-hassan-alvi[username]", $username, time() + (86400 * 30), "/");
                    setcookie("junaid-hassan-alvi[password]", $password, time() + (86400 * 30), "/");
                }else{
                    $username ='';
                    $password ='';
                   setcookie("junaid-hassan-alvi[username]", $username, time() - 3600,"/");
                   setcookie("junaid-hassan-alvi[password]", $password, time() - 3600,"/");
                }
                   if($this->session->has_userdata('redirect')) {
					    
                        redirect(base_url($this->session->redirect),'refresh');
                    } else {
                        redirect(base_url('user-dashboard'),'refresh');    
                    } 
               

            }
        }
		$this->load->view('user/pages/login',$data);
	}


    public function register(){
        $data['abc'] = '';
        

         if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('first_name', 'First Name','trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name','trim|required|xss_clean');
            
            $this->form_validation->set_rules('email', 'Email','trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'password','trim|required|xss_clean|max_length[8]');
            
            $this->form_validation->set_rules('username', 'username', 'trim|required|xss_clean|is_unique[users.username]');  
            if($this->form_validation->run()==true){
                $reffer_code = preg_replace('~[^\pL\d]+~u', '', strtolower($this->input->post('first_name'))).rand(11,99);
                $data = array('name'=>$this->input->post('first_name').' '.$this->input->post('first_name'),
                    'email'=>$this->input->post('email'),
                    'password'=>$this->input->post('password'),
                    'refferal_by'=>$this->input->post('referral'),
                    'reffer_code'=>$reffer_code,
                    'username'=>$this->input->post('username'),
                    'status'=>1,);
                    
                 
                 $res = $this->adminmodel->insert_data('users',$data);
                
                
                if($res){
                    $result = $this->adminmodel->getwheres('users',array('user_id'=>$res));
                    $this->session->set_userdata('user_session',$result);
                    $this->session->set_flashdata('success_message','User registration Successfully');
                
                }else{
                    $this->session->set_flashdata('error_message','User Not registration Successfully');
                }
                   if($this->session->has_userdata('redirect')) {
					    
                        redirect(base_url($this->session->redirect),'refresh');
                    } else {
                        redirect(base_url(),'refresh');    
                    } 
                exit; 
            }
            
        }
        $this->load->view('front/registration',$data);
    }
    
    
    public function referral(){
        $data['abc'] = '';
        
          if(!$this->session->userdata('user_session')){
			    if (!empty($_SERVER['QUERY_STRING'])) {
                    $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
                } else {
                    $uri = uri_string();
                }
			    $this->session->set_userdata('redirect', $uri);
				redirect(base_url('login'),'refresh');    	
			}
    
        $this->load->view('front/referral',$data);
    }
    
    
    public function forgot(){
        $data['abc'] = '';
        

         if($this->input->post())
        {
            $this->form_validation->set_error_delimiters('<p class="text-red">', '</p>');
            $this->form_validation->set_rules('username', 'Email','trim|required');

            if($this->form_validation->run()==true){

                 $result = $this->adminmodel->getwheres('users',array('email'=>$this->input->post('username')));
                if($result){
                  
                    $this->session->set_flashdata('success_message','Password send successfully');
                    
                    redirect(base_url('login'),'refresh');
                    exit;
                
                }else{
                    $this->session->set_flashdata('error_message','User Email not register');
                }
                 
            }
            
        }
        $this->load->view('front/forgot',$data);
    }
    /*----- end of login-----------*/

    /*----------chack password validation from database.----------*/
	function check_database($password)
    {
       //Field validation succeeded.&nbsp; Validate against database
       $user_name = $this->input->post('username');
       $result = $this->adminmodel->getwheres('users',array('email'=>$user_name,'password'=>$password));

       if($result)
       {    
            if(($password) == $result['password']){
                    unset($result['password']);

                    $this->session->set_userdata('user_session',$result);
                    return true;
            }else{
                $this->form_validation->set_message('check_database', 'Invalid username password');
                return false;
            }
        }else{
            $this->form_validation->set_message('check_database', 'Invalid username password');
            return false;
        }
    }
    /*-----------End check_database--------------*/

    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    /*-----3. show forgot page of website------*/
    public function forgot_password(){
        if($this->session->userdata('wash_time_user')) {
            redirect(base_url('user-dashboard'),'refresh');
        }
        $data['msg'] = false;
        if($this->input->post()){
            $this->form_validation->set_rules('email', $this->lang->line('Email_Id'), 'trim|required|valid_email|callback_checkforgotpass');
            if($this->form_validation->run() === TRUE)
            {
                $token_id = md5($this->input->post('email').time());
                /* creating mail content*/
                $subject = $this->lang->line('wash_time');
                $content = "<h2>".$this->lang->line('Forgot_Password')."</h2>";
                $content .= "<p>".$this->lang->line('click_link_create_new_pass')."</p>";
                $content .= "<a href='". base_url('user/create-new-password/'.$token_id.'') ."'>".$this->lang->line('Click_here')."</a>";

                /* calling send mail functionn */
                //$res = $this->adminmodel->sendmail('worthfcfc321@gmail.com','worthfcfc123','Wash Time',$this->input->post('email'),$subject,$content);
                $res = $this->adminmodel->sendmail2($this->input->post('email'),$subject,$content);


                /////////// $res = $this->adminmodel->sendmail2($this->input->post('email'),$subject,$content);
                if(!$res){
                    $this->session->set_flashdata('message', $this->lang->line('Try Again!'));
                    redirect(base_url('user-forgot-password'),'refresh');
                    exit;  
                }else{
                  /* set flash session dataa*/
                    $this->session->set_flashdata('message', $this->lang->line('sent_link_register_email'));
                    redirect(base_url('user-forgot-password'),'refresh');
                    exit;  
                }
                
            }
        }
        $this->load->view('user/forgotpass', $data);
    }

    /*----------chack Email validation from database.----------*/
    function checkforgotpass($email){
        if($this->session->userdata('wash_time_user')) {
            redirect(base_url('admin-dashboard'),'refresh');
        }
        $where = array(
                'email'=>$email,
                'status'=>'active',
            );
        $result = $this->adminmodel->getwheres('user',$where);
        if(!empty($result))
        {
            $token_id = md5($email.time());   /* generate token id for a/c confirm url */
            $where = array('id'=>$result['id']);
            $upd = array( 'token_id' => $token_id);
            $res = $this->adminmodel->update_data('user',$where,$upd);
            if($res){
                return true;
            }else{
                $this->form_validation->set_message('checkforgotpass', $this->lang->line('try_again_letter'));
                return false;
            }
        }else{
            $this->form_validation->set_message('checkforgotpass', $this->lang->line('invalid_id_or_inactive'));
            return false;
        }
    }
    /*----------End checkforgotpass----------*/

    /*------create new password use for changeing the password------*/
    public function create_new_password($token_id=0){
        if($this->session->userdata('wash_time_user')) {
            redirect(base_url('user-dashboard'),'refresh');
        }
        $data['msg'] = false;
        $chk1 = array(
            'token_id' => $token_id
        );
        $check_token = $this->adminmodel->getSingle('user',$chk1);
        if($check_token){
            if($this->input->post()){
                $this->form_validation->set_rules('password', $this->lang->line('Password'), 'required|matches[cpassword]|min_length[6]');
                $this->form_validation->set_rules('cpassword', $this->lang->line('Confirm_Password'), 'required');
                $this->form_validation->set_message('matches',$this->lang->line('pass_not_matched'));
                if($this->form_validation->run() === TRUE){
                    $upd = array(
                            'password'=>$this->input->post('password'),
                            'token_id'=>''
                        );
                    $this->adminmodel->update_data('user',$chk1,$upd);
                        /* set flash session dataa*/
                    $this->session->set_flashdata('message', $this->lang->line('new_pass_created'));
                    redirect(base_url('user-login'),'refresh');
                    exit;
                }
            }
            $this->load->view('user/create-new-password', $data);
        }else{
            $data['msg'] = $this->lang->line('Expired_link');
            $this->load->view('user/url_exp', $data);
        }
    }

    public function generate_building_id(){

        if($this->input->post()){

            $this->form_validation->set_rules('building_id', 'Building ID', 'trim|numeric|xss_clean|callback_check_building_id');  
            if($this->form_validation->run() === TRUE)
            {
                $building_id = $this->input->post('building_id');
                $user_id = $this->session->userdata('id');
                $name = $this->session->userdata('name');
                $upd = array(
                        'building_id'=>$building_id,
                    );
                $where = array('id'=>$user_id);
                $res = $this->adminmodel->update_data('user',$where,$upd);

                if($res){
                    $data = $this->session->userdata('wash_time_user');
                    $data['building_id'] = $building_id;
                    $this->session->set_userdata('wash_time_user',$data);
                    $result = $this->adminmodel->delete('invite_user',array('email'=>$this->session->userdata('email')));
                    insert_admin_notifications($building_id,'New user',$name.' just create new account.');

                }
                redirect(base_url('user-dashboard'),'refresh');   
            }
        }

        $this->load->view('user/generate-user-id');
    }
    /*--------End of create_new_password-----------*/

    function check_building_id($building_id)
    {
       
       $result = $this->adminmodel->getwheres('admin',array('id'=>$building_id));
       if($result)
       { 
        return true;
        }else{
            $this->form_validation->set_message('check_building_id', 'Insert only valid Building Id');
            return false;
        }
    }
    function logout()
    {
        
        $this->session->unset_userdata('user_session');
         redirect(base_url(),'refresh');
    }
     public function broadcast_callback(){
        # code...
        // array(
        //     'name'=>'New',
        //     'result_url'=> base_url().'user/broadcast_callback',
        //     'stats' => array(
        //         'sent' => 0,
        //         'delivered' => 0,
        //         'failed' => 0,
        //         'pending' => 0,
        //         'scheduled' => 0,
        //         'cancelled' => 0,
        //     ),
        // )
       
        if(!$this->input->post()) {
            echo json_encode(array('status' => 'failed'));
            die;
        }
        $data = array(
            'name' => $this->input->post('name'),
            'result_url' => $this->input->post('result_url'),
            'stats' => $this->input->post('stats')
           );
        $r = $this->adminmodel->insert('broadcast_list',$data);
        $this->response($r); 

    }
    
}