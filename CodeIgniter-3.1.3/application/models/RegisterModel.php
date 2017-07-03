<?php
   class RegisterModel extends CI_Model {

      function __construct() {
         parent::__construct();
      }

      public function InsertUserInfo($data) {

          $this->db->insert('accounts', $data);

          $this->db->where("Email", $data['Email']);
          $this->db->where("PersonTypeId", $data['PersonTypeId']);
          $query = $this->db->get("accounts");
          if ($query->num_rows() == 1){
              return $query->result();
          }

      }

      public function InsertMinistrantInfo($data) {

         $this->db->insert('ministrantpersonalinfo', $data);

      }

      public function InsertEmployerInfo($data) {

         $this->db->insert('employerinfo', $data);

      }

      public function delete($StudentId) {
         if ($this->db->delete("Students", "StudentId = ".$StudentId)) {
            return true;
         }
      }

      public function update($data,$OldStudentId) {
         $this->db->set($data);
         $this->db->where("StudentId", $OldStudentId);
         $this->db->update("Students", $data);
      }
   }
?>
