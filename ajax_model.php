<?php

class Ajax_model extends CI_Model
{
    public function suspend($id)
    {
        $data=array('suspend'=>'Y');
      $this->db->where('id',$id);
      if($this->db->update('users',$data))
      {
          return true;
      }
      else{
          return false;
      }
      
    }
    
     public function approve($id)
    {
        $data=array('waitingforapprovel'=>'Y','paid'=>'Y');
      $this->db->where('id',$id);
      if($this->db->update('users',$data))
      {
          return true;
      }
      else{
          return false;
      }
      
    }
    
    
     public function approve_id($id)
    {
        $data=array('waitingforapprovel'=>'Y');
      $this->db->where('id',$id);
      if($this->db->update('users',$data))
      {
          return true;
      }
      else{
          return false;
      }
      
    }
    
    public function unsuspend($id)
    {
        $data=array('suspend'=>'N');
      $this->db->where('id',$id);
      if($this->db->update('users',$data))
      {
          return true;
      }
      else{
          return false;
      }
      
    }
    public function delete($id)
    {
      $this->db->where('id',$id);
      if($this->db->delete('users'))
      {
          return true;
      }
      else{
          return false;
      }
      
    }
    
     public function refer_count($id)
    {
        
      if($query=$this->db->query("select * from users where referby=(select uid from users where id='$id')"))
      {
          return $query->num_rows();
      }
      else{
          return false;
      }
        
    }
    public function refer_details($id)
    {
        
      if($query=$this->db->query("select * from users where referby=(select uid from users where id='$id')"))
      {
          return $query->result();
      }
      else{
          return false;
      }
        
    }
    public function check_pass($pass)
    {
        $id=$this->session->userdata('admin');
        if($query=$this->db->query("select * from admin where id='$id' and pass='$pass'"))
        {
            return $query->num_rows();
        }
        else{
            return false;
        }
    }
    
    public function pending_payment()
    {
        if($query=$this->db->query("select * from users where paid='N' and waitingforapprovel='Y'"))
        {
            return $query->result();
        }
        else{
            return false;
        }
    }
     public function pending_approvel()
    {
        if($query=$this->db->query("select * from users where waitingforapprovel='Y'"))
        {
            return $query->result();
        }
        else{
            return false;
        }
    }
}