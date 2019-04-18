<?php 
class Admin_model extends CI_Model
{
    public function auth($uname,$pwd)
    {
     
      if($query=$this->db->query("select * from admin where uname='$uname' and pass ='$pwd' "))
      {
        $count=$query->num_rows();
        if($count>0)
        {
            $data=$query->result();
            foreach($data as $dt)
            {
                $id=$this->session->set_userdata('admin',$dt->id);
                return true;
            }
        }
        else{
            return false;
        }
      }
      else{
          return false;
      }
        
    }
    public function select_users()
    {
        if($query=$this->db->query("select * from users "))
        {
            return $query->result();
        }
        else{
            return false;
        }
    }
    public function change_pass($new_p)
    {
        $data=array('pass'=>$new_p);
        $id=$this->session->userdata('admin');
        $this->db->where('id',$id);
        if($this->db->update('admin',$data))
        {
            return true;
        }
        else{
            return false;
        }
    }
}