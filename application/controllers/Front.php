<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {

function __construct()
    {
        parent::__construct();
        $this->load->model('adminmodel');
    } 
    
    
	public function index($shopid ="")
	{   
	    redirect(base_url('user-dashboard'),'refresh');    
	}

	public function about_us($shopid ="")
	{   
	    $results['data'] = $this->adminmodel->getwheres('websetting',array('type'=>'web'));
		$this->load->view('front/about-us',$results);
	}
	
	public function contact_us($shopid ="")
	{   
	    $results['data'] = $this->adminmodel->getwheres('websetting',array('type'=>'web'));
		$this->load->view('front/contact',$results);
	}

	

	
	
	
}
