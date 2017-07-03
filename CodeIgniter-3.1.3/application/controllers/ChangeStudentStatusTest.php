<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/13/2017
 * Time: 12:19 PM
 */

class ChangeStudentStatusTest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {



    }

    public function GetStudents(){
        $query = $this->db->get("Students");
        $records = $query->result();
        foreach($records as $row)
        {
            $row->Status=$row->Status ? true : false;
        }
        echo json_encode($records);
    }

    public function GetStudentsLimit(){


    }

    public function UpdateStudents(){
        $this->load->model('StudentModelTest');
        $data = json_decode(file_get_contents("php://input"));


        $UpdateData = array(
                'Status' => $data->Status

        );
        $this->StudentModelTest->update($UpdateData,$data->StudentId);








        //echo "************************Information Was Updated in DataBase****************";*/

    }



    public function DeleteStudents(){
        $this->load->model('StudentModelTest');

        $id = $this->input->get_post("id");


        $ImageName = $this->input->get_post("ImageName");
        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/images/upload/';
        $target_file = $filePath. basename($ImageName);
        unlink($target_file);

        if($this->StudentModelTest->delete($id)){
            //echo "************************Information Was Inserted in DataBase****************";
        }
    }



}