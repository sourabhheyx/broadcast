<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quiz_model extends CI_Model {
	public function insert($data = array(),$tableName){
      $insert = $this->db->insert($tableName,$data);
       if($insert){
        return $this->db->insert_id();
      }else{
        return false;    
      }
    }
 public function get_que($que_id){
		    $sts=1;
		    $this->db->select('*');
		    $this->db->from('AddQuestion');
		    $this->db->where('id',$que_id); 
		    $this->db->where('status', 1);
		    $query=$this->db->get();		  
		    return $query->result();
    }	
public function get_que_ans($que_id){
       $this->db->select('AddQuestion.*, solvequestion.que_ans as ans')
     ->from('AddQuestion')
     ->join('solvequestion', 'solvequestion.Que_id = AddQuestion.id') 
     ->where('solvequestion.Que_id', $que_id);
      $query = $this->db->get();
      $res   = $query->result();  
   
      return $res;
    }
// select exam_summary 
public function get_exam_data(){
			$sts=1;
		    $this->db->select('*');
		    $this->db->from('student_report');		  
		    $this->db->where('status', 1);
		    $query=$this->db->get();		  
		    return $query->result();
}    
// update  question
   public function updata($s_id,$data){
			    $this->db->where('s_id',$s_id);
			    $this->db->update('solvequestion',$data);
			    return true;
 			 } 
   public function updata_q_status($level_id,$student_id,$Qdata){
               
			    $this->db->where('level_sub_id',$level_id);
			    $this->db->where('student_id',$student_id);
			    $this->db->where('QStatus','1');
			    $this->db->update('solvequestion', $Qdata);  
			 // print_r($this->db->last_query()); die();
			    return true;
 			 }  

  //select data 
    public function selectdata()  {
      $sts=1;
      $this->db->select('*');
      $this->db->from('AddQuestion');
      $this->db->where('status',$sts);
      $query=$this->db->get();   
      return $query->result();
  }  
  

	public function countRow(){
		 return $this->db->count_all_results('AddQuestion');		
	}

//select data 
    public function select_que_time($level_sub_id,$student_id)  {
      $sts=1;
      $this->db->select('time');
      $this->db->from('solvequestion');
      $this->db->where('status',$sts);
      $this->db->where('student_id',$level_sub_id);
      $query=$this->db->get();   
      return $query->result();
  }  
	
}

	
	