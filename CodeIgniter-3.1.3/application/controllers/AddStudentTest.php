<?php
class AddStudentTest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {


        $this->load->model('StudentModelTest');

        $name = $this->input->get_post("name");

        $family = $this->input->get_post("family");

        $maxSizeError = $this->input->get_post("maxSizeError");
        if($maxSizeError){
            echo "لطفا عکس صحیح آپلود نمایید";
            return;
        }


        $StudentId=$this->GetStudentsLimit();


        $target_dir = getcwd();

        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/images/upload/';
        $ImageName=$_FILES[0]["name"];
        $target_file = $filePath.$StudentId  . basename($ImageName);
        move_uploaded_file($_FILES[0]["tmp_name"], $target_file);

        $InsertData = array(
            'StudentName' => $name,
            'StudentFamily' => $family,
            'StudentImageName' => $StudentId . $ImageName

        );



        if($this->StudentModelTest->insert($InsertData)){
            //echo "************************Information Was Inserted in DataBase****************";
        }

    }

    public function GetStudents(){
        $query = $this->db->get("Students");
        $records = $query->result();
        echo json_encode($records);
    }

    public function GetStudentsLimit(){

        $StudentId=1;
        $query = $this->db->query("select * from INFORMATION_SCHEMA.TABLES where TABLE_SCHEMA='studentproject' and TABLE_NAME   = 'students' ");

        foreach ($query->result() as $row)
        {
            $StudentId= $row->AUTO_INCREMENT;

        }
        return $StudentId;
    }

    public function UpdateStudents(){
        $this->load->model('StudentModelTest');

        $name = $this->input->get_post("name");
        $family = $this->input->get_post("family");
        $id = $this->input->get_post("id");
        $FileIsChanged = $this->input->get_post("FileIsChanged");




        if($FileIsChanged!=-1){
            if($_FILES[$FileIsChanged]["size"]>51200){
                echo "حجم فایل بیشتر از 2 مگابایت است.";
                return;
            }

            $ImageName = $this->input->get_post("ImageName");
            $target_dir = getcwd();
            $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/images/upload/';
            $target_file = $filePath . basename($ImageName);
            unlink($target_file);

            $ImageName=$_FILES[$FileIsChanged]["name"];
            $target_file = $filePath.$id  . basename($ImageName);
            move_uploaded_file($_FILES[$FileIsChanged]["tmp_name"], $target_file);
            $UpdateData = array(
                'StudentName' => $name,
                'StudentFamily' => $family,
                'StudentImageName' => $id . $ImageName

            );
            $this->StudentModelTest->update($UpdateData,$id);

        }
        else{

            $UpdateData = array(
                'StudentName' => $name,
                'StudentFamily' => $family

            );
            $this->StudentModelTest->update($UpdateData,$id);

        }






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
?>
