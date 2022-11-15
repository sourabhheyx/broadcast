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

        /* check admin is logged in or not*/
       // $this->output->clear_cache();

	}




	/* 2. show login page of website*/
	public function index(){
        $data['abc'] = '';
        if($this->session->userdata('admin_session')) {
       
          redirect(base_url('admin-dashboard'),'refresh');    
           
        }

        if($this->input->post()){
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'PAssword', 'trim|required|xss_clean|callback_check_database');
            $this->form_validation->set_error_delimiters('<p class="alert alert-danger" style="color:red;">', '</p>');
            if($this->form_validation->run() === TRUE)
            { 
                $data['user_data'] = $this->session->userdata('admin_session');
                
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
                
                redirect(base_url('admin-dashboard'),'refresh');    

            }
        }
		$this->load->view('Admin/pages/login',$data);
	}
    /*----- end of login-----------*/

    /*----------chack password validation from database.----------*/
	function check_database($password)
    {
       //Field validation succeeded.&nbsp; Validate against database
       $user_name = $this->input->post('username');
       
       

    $result = $this->adminmodel->getwheres('admin',array('email'=>$user_name,'password'=>$password));

       

       if($result)
       {    
            if(($password) == $result['password']){
                    unset($result['password']);

                    $this->session->set_userdata('admin_session',$result);
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
        
        $this->session->unset_userdata('admin_session');
         redirect(base_url('admin-login'),'refresh');
    }
}