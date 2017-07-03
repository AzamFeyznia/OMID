<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/1/2017
 * Time: 8:31 AM
 */
class StudentModelTest extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        if ($this->db->insert("Students", $data)) {
            return true;
        }
    }

    public function update($data,$OldStudentId) {
        $this->db->set($data);
        $this->db->where("StudentId", $OldStudentId);
        $this->db->update("Students", $data);
    }


    public function delete($StudentId) {
        if ($this->db->delete("Students", "StudentId = ".$StudentId)) {
            return true;
        }
    }


}
?>
