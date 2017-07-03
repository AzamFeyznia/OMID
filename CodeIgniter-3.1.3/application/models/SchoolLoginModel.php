<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class SchoolLoginModel extends CI_Model
{
 public function CheckInfo($data) {
        $this -> db -> select('PersonTypeId, PersonId');
        $this -> db -> from('SysAccounts');
        $this->db->where("UserName", $data['AccountName']);
        $this->db->where("Pswd1", SHA1(MD5($data['PSWD1'])));
        $this->db->where("Disabled", "NO");
        
        $query = $this->db->get();
        if ($query->num_rows() == 1){
            return $query->result();
         }
         return false;
      }
}
?>
