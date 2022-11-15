<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adminmodel extends CI_Model {

/* ************* add insert data *************** */
	function insert_data($table,$data)
	{ 
     	$this->db->insert($table,$data);
		$num = $this->db->insert_id();
		return $num;
	}
	
	function insert_rows($table,$data) {
        $this->db->insert_batch($table,$data);
    }
	
/* ************* add insert num row data *************** */
	function insert_data_num($table,$data)
	{ 
     	$query = $this->db->insert($table,$data);
		$num = $query->num_rows();
		return $num;
	}
/* ************* custom_query_num_row data *************** */	


    public function custom_query_num_row($query)
	{
		return $this->db->query($query)->num_rows();
	}
	
	
	public function custom_query($query)
	{
		return $this->db->query($query)->result_array();
	}
	
	public function custom_query_row($query)
	{
		return $this->db->query($query)->row_array();
	}
/* ************* update data *************** */		
	function update_data($table,$where,$data)
	{
		$this->db->where($where);
		$update = $this->db->update($table,$data);
		
		if($update){ 
		return TRUE;
		}
		else
		{ 
			return FALSE;
		}
	}
	
	
	function update_rows($table,$where,$data) {
        $this->db->update_batch($table,$where,$data);
    }
	
	
		function getCount($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result_array();
		$num = $data->num_rows();
		if($num){
			return $num;
		}
		else
		{
			return false;
		}
	}
/*get count for pagination */
	function get_count($table1,$table2,$id1,$id2,$column='',$where,$orderby)
	{	
		if($column !='')
		{
			$this->db->select($column);	
		}
		else
		{
			$this->db->select('*');
		}
		$this->db->from($table1);		  
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);
		if($where !='')
		{
			foreach ($where as $key => $value)				
			{	
			  $this->db->or_like("$key", "$value");		
     		}	
			//$this->db->where($where);	
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');	
		}
		
		$que = $this->db->get();
		return $que->num_rows();	
	}
/* ************* get single   data *************** */	
	function getSingle($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result_array();
		$num = $data->num_rows();
		if($num){
			return $get;
		}
		else
		{ 
			return false;
		}
	}
/* ************* get all data as where class *************** */	
	function getwhere($table,$where=false,$orderby=false)
	{
		if($where){
			$this->db->where($where);
		}
		if($orderby){
			$this->db->order_by($orderby);
		}
		$data = $this->db->get($table); 
		$get = $data->result_array();
		//print_r($get); die;
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}
	
	function Getparent($value)
	{
	    if($value)
	    {
	        
	  	$this->db->where($value);  
	    }
	   $p1 = $this->db->get($value);
       $p2 = $this->db->get($p1);
      $p3 = $this->db->get($p2);
      $p4 = $this->db->get($p3);
      $p5 = $this->db->get($p4); 
	   $get = $data->results_array();
		
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

	function getwheress($table,$where=true)
	{
		if($where){
			$this->db->where($where);
		}
		
		$data = $this->db->get($table); 
		$get = $data->results_array();
		//print_r($get); die;
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

	function getwhere_between($table,$where=false,$wheres=false)
	{
		if($where){
			$this->db->where($where);
		}
		if($wheres){
			$this->db->where_in('email',$wheres);
		}
		//$this->db->order_by("id","desc");
		$data = $this->db->get($table); 
		$get = $data->result_array();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

	/***********/

	function role_exists($table,$where)
  {
    $this->db->where($where);
    $query = $this->db->get($table);
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
}
	/*********/
/* ************* get all data as where class *************** */	
	function getwheres($table,$where=false)
	{
		if($where){
			$this->db->where($where);
		}
		$data = $this->db->get($table); 
		$get = $data->row_array();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}
	function getwheres_limit($table,$where=false,$limit)
	{
		if($where){
			$this->db->where($where);
		}
		$this->db->limit($limit);
		$data = $this->db->get($table); 
		$get = $data->row_array();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}
	
	
	function getwherescount($table,$where=false)
	{	
		$this->db->select("id");
		if($where){
			$this->db->where($where);
		}
		$data = $this->db->get($table); 
		$get = $data->result_array();
		if($get){
			return count($get);
		}else{
			return 0;
		}
	}
/* ************* get all data as where class order by *************** */	
	function getwheres_orderby($table,$where,$orderby)
	{
		$this->db->where($where);
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
				
		}
		$data = $this->db->get($table); 
		$get = $data->result_array();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}
/* ************* get all data as where class getwhere_limit *************** */	
	function getwhere_limit($table,$where,$limit,$orderby)
	{
		$this->db->where($where);
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
				
		}
		$this->db->limit($limit);
		$data = $this->db->get($table); 
		
		$get = $data->result_array();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}
/***************End getwhere_limit*******************************/


 public function selectorganizer ($search) {
    $condition = "search = '" . $search . "'";
    $this->db->select('*');
    $this->db->from('admission');
    $this->db->where($condition);
    $query = $this->db->get();
    return $result = $query->result();
} 

/***************Start Get All Data******************************/
	function getdata($table)
	{
		$this->db->select("*");
		$data = $this->db->get($table);
		$get_data = $data->result_array();
		if($get_data)
		{
			return $get_data;
		}
		else
		{
			return false;
		}
	}


	function getdatas($table,$where = true)
	{


		$this->db->select("*");
		if($where){
			$this->db->where($where);
		}
		$data = $this->db->get($table);
		$get_data = $data->result_array();
		if($get_data)
		{
			return $get_data;
		}
		else
		{
			return false;
		}
	}
/***************End Get All Data*******************************/

/***************Start Get All Data orderby******************************/
	function getdata_orderby($table, $orderby)
	{
		$this->db->select("*");
		if($orderby !='')
		{
			$this->db->order_by($orderby,'ASC');
				
		}
		$data = $this->db->get($table);
		$get_data = $data->result_array();
		if($get_data)
		{
			return $get_data;
		}
		else
		{
			return false;
		}
	}
/***************End Get All Data orderby*******************************/

/* ************* Delete data *************** */	
	function delete($table,$where){
	    $this->db->where($where);
		// $this->db->limit('1');
		$del = $this->db->delete($table);

		if($del){
			return true;
		}else{
			return false;
		}
	}
/* ************End Delete Data **************** */


/*************Query two table join *******************/
	public function get_data_twotable_column_where($table1,$table2,$id1,$id2,$column='',$where,$orderby='')
	{
		if($column !='')
		{
			$this->db->select($column);	
		}
		else
		{
			$this->db->select('*');
		}
		$this->db->from($table1);		  
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);
		if($where !='')
		{
			$this->db->where($where);	
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
				
		}
		$que = $this->db->get();
		
		return $que->result_array();		
	}
/************End Join Two Table*******************/

/*************Query two table join limit *******************/
	public function get_data_twotable_column_where_limit($table1,$table2,$id1,$id2,$column='',$where,$orderby,$limit)
	{
		if($column !='')
		{
			$this->db->select($column);	
		}
		else
		{
			$this->db->select('*');
		}
		$this->db->from($table1);		  
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);
		if($where !='')
		{
			$this->db->where($where);	
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');
			$this->db->limit($limit);	
		}
		$que = $this->db->get();
		return $que->result_array();		
	}
/************End Join Two Table limit*******************/

/*************Query two table join *******************/
	public function get_data_twotable_like($table1,$table2,$id1,$id2,$column='',$where,$orderby,$num, $offset)
	{
		if($column !='')
		{
			$this->db->select($column);	
		}
		else
		{
			$this->db->select('*');
		}
		$this->db->from($table1);		  
		$this->db->join($table2,$table2.'.'.$id2.'='.$table1.'.'.$id1);
		if($where !='')
		{
			foreach ($where as $key => $value)				
			{	
			  $this->db->or_like("$key", "$value");		
     		}	
		}
		if($orderby !='')
		{
			$this->db->order_by($orderby,'DESC');	
		}
		if($num !='')
		{
			$this->db->limit($num,$offset);
		}
		if($offset !='' and $num !='')
		{
			$this->db->limit($num,$offset);
		}
		$que = $this->db->get();
		return $que->result_array();		
	}
/************End Join Two Table*******************/

/* ************* Start Join  data  for title subtitle *************** */	
    function sendmail($useremail,$pass,$username,$to,$subject,$content){
    	$this->load->library('email');

		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = $useremail;
        $config['smtp_pass']    = $pass;
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // text or html
        $config['validation'] = TRUE; // bool whether to validate email or not
        $config['charset'] = 'iso-8859-1';      

        $this->email->initialize($config);

        $this->email->from($useremail, $username);
        $this->email->to($to); 

        $this->email->subject($subject);
        $this->email->message($content);  

        if($this->email->send()){
        	return true;
        }else{
        	return false;
        }
    }

    function sendmail2($to,$subject,$content){
    	
        $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1;charset=UTF-8" . "\r\n";
		$headers .= "From: Wash Time <info@washtime.com>" . "\r\n" .
		"Reply-To: info@washtime.com" . "\r\n" .
		"X-Mailer: PHP/" . phpversion();

        if(mail($to,$subject,$content,$headers)){
        	return true;
        }else{
        	return false;
        }
    }
    function uploadfile($filename) {
      $config1 = array(
      'upload_path' => "./uploads/scheme",
      'allowed_types' => "pdf|png|jpg",
      // 'max_size' => 0,
      'overwrite' => false
      );
      $this->load->library('upload');
      $this->upload->initialize($config1);
      if ($this->upload->do_upload($filename)) {
	      $uploadimg = $this->upload->data();
	      $uimg = $uploadimg['file_name'];
	      return array('status'=>1,'path'=>$uimg);
      } else {
	      $uimg = '';
	      $error = array('error' => $this->upload->display_errors());
	      return array('status'=>0,'msg'=>$this->upload->display_errors());
      }
   }

   function destroy_session(){

   		/* logout from facebook */
   		$this->load->library('facebook');
    	$this->facebook->destroySession();
   
        session_start();
        $_SESSION = array();
        unset($_SESSION);
        session_destroy();

	}
	function get_query_result_array($sql)
	{
		
		$query = $this->db->query($sql);
		
		if($query->num_rows > 0){
			$records = $query->result_array();
			return $records;
		}
		else { return false; }
	}

	function get_query_row_array($sql)
	{
		
		$query = $this->db->query($sql);
		
		if($query->num_rows > 0){
			$records = $query->row_array();
			return $records;
		}
		else { return false; }
	}

/* ************* End Join  data  for title subtitle *************** */	


	function update_profile_pic($filename) {
	  $config1 = array(
	  'upload_path' => "./uploads/profile-pic",
	  'allowed_types' => "jpg|png|jpeg",
	  // 'max_size' => 0,
	  'overwrite' => false
	  );
	  $this->load->library('upload');
	  $this->upload->initialize($config1);
	  if ($this->upload->do_upload($filename)) {
	      $uploadimg = $this->upload->data();
	      $uimg = $uploadimg['file_name'];
	      return array('status'=>1,'path'=>$uimg);
	  } else {
	      $uimg = '';
	      $error = array('error' => $this->upload->display_errors());
	      return array('status'=>0,'msg'=>$this->upload->display_errors());
	  }
	}
	function update_blog_pic($filename) {
	  $config1 = array(
	  'upload_path' => "./uploads/knowledge_series/",
	  'allowed_types' => "jpg|png|jpeg",
	  // 'max_size' => 0,
	  'overwrite' => false
	  );
	  //print_r($config1);die();
	  $this->load->library('upload');
	  $this->upload->initialize($config1);
	  if ($this->upload->do_upload($filename)) {
	      $uploadimg = $this->upload->data();
	      $uimg = $uploadimg['file_name'];
	      return array('status'=>1,'path'=>$uimg);
	  } else {
	      $uimg = '';
	      $error = array('error' => $this->upload->display_errors());
	      return array('status'=>0,'msg'=>$this->upload->display_errors());
	  }
	}
	function update_banner_pic($filename) {
	  $config1 = array(
	  'upload_path' => "./uploads/banners1/",
	  'allowed_types' => "jpg|png|jpeg",
	  // 'max_size' => 0,
	  'overwrite' => false
	  );
	  //print_r($config1);die();
	  $this->load->library('upload');
	  $this->upload->initialize($config1);
	  if ($this->upload->do_upload($filename)) {
	      $uploadimg = $this->upload->data();
	      $uimg = $uploadimg['file_name'];
	      return array('status'=>1,'path'=>$uimg);
	  } else {
	      $uimg = '';
	      $error = array('error' => $this->upload->display_errors());
	      return array('status'=>0,'msg'=>$this->upload->display_errors());
	  }
	}
	
	function update_cover_pic($filename) {
	  $config1 = array(
	  'upload_path' => "./uploads/cover-pic",
	  'allowed_types' => "jpg|png|jpeg",
	  // 'max_size' => 0,
	  'overwrite' => false
	  );
	  $this->load->library('upload');
	  $this->upload->initialize($config1);
	  if ($this->upload->do_upload($filename)) {
	      $uploadimg = $this->upload->data();
	      $uimg = $uploadimg['file_name'];
	      return array('status'=>1,'path'=>$uimg);
	  } else {
	      $uimg = '';
	      $error = array('error' => $this->upload->display_errors());
	      return array('status'=>0,'msg'=>$this->upload->display_errors());
	  }
	}

	/*------------------start payment_info_list-------------------*/

  

}
/* End of file home.php */
/* Location: ./application/model/home.php */


	
	