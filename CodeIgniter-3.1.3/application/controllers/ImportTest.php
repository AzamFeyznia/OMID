<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/15/2017
 * Time: 1:01 PM
 */
class ImportTest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {

        $this->load->model('StudentModelTest');



        $maxSizeError = $this->input->get_post("maxSizeError");
        if($maxSizeError){
            echo "لطفا فایل صحیح آپلود نمایید";
            return;
        }
        $path = $_FILES[0]['name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);

          if($ext!="csv" || $ext!="xlsx" || $ext!="xls"){
              echo "لطفا فایل صحیح آپلود نمایید";
              return;
          }





        if($_FILES[0]["size"] > 0) {
            if ($ext == "csv"){
                $file = fopen($_FILES[0]["tmp_name"], "r");


                while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $InsertData = array(
                        'StudentName' => $emapData[0],
                        'StudentFamily' => $emapData[1],
                        'StudentImageName' => $emapData[2]

                    );
                $this->StudentModelTest->insert($InsertData);


                 }
            }
            else{
                require_once 'PHPExcel/Classes/PHPExcel.php';
                $objReader = PHPExcel_IOFactory::createReader('Excel2007');
                $objReader->setReadDataOnly(true);

                $objPHPExcel = $objReader->load($_FILES[0]["tmp_name"]);
                $objWorksheet = $objPHPExcel->getActiveSheet();

                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();

                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

                for ($row = 1; $row <=$highestRow; $row++) {

                        $InsertData = array(
                            'StudentName' => $objWorksheet->getCellByColumnAndRow(0, $row)->getValue(),
                            'StudentFamily' => $objWorksheet->getCellByColumnAndRow(1, $row)->getValue(),
                            'StudentImageName' => $objWorksheet->getCellByColumnAndRow(2, $row)->getValue()

                        );

                    $this->StudentModelTest->insert($InsertData);
                    //accept=".csv"

                }

            }
        }














        //if($this->StudentModelTest->insert($InsertData)){
            //echo "************************Information Was Inserted in DataBase****************";
        //}

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

    public function ExportStudents(){

        $directoryPath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/*';
        $files = glob($directoryPath);
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }

        $query = $this->db->get("Students");
        $records = $query->result();
        foreach($records as $row)
        {
            $row->Status=$row->Status ? true : false;
        }
        require_once 'PHPExcel/Classes/PHPExcel.php';

        require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Disposition: attachment; filename=\"results.xlsx\"");
        //header("Cache-Control: max-age=0");




        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

        //$objWriter->save("php://output");
        $fileName='MyExcel_'.date('d_M_Y',time()).'.xlsx';
        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/'.$fileName;

        $objWriter->save($filePath);
        echo $fileName;



    }


    public function ExportStudentsCSV(){

        $directoryPath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/*';
        $files = glob($directoryPath);
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }

        $query = $this->db->get("Students");
        $records = $query->result();
        foreach($records as $row)
        {
            $row->Status=$row->Status ? true : false;
        }
        require_once 'PHPExcel/Classes/PHPExcel.php';

        require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Disposition: attachment; filename=\"results.xlsx\"");
        //header("Cache-Control: max-age=0");




        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');

        //$objWriter->save("php://output");
        $fileName='MyExcel_'.date('d_M_Y',time()).'.csv';
        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/'.$fileName;

        $objWriter->save($filePath);
        echo $fileName;



    }



    public function ExportStudentsPDF(){
        $rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
        $rendererLibrary = 'dompdf';
        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/application/controller/dompdf/';
        $rendererLibraryPath = $filePath . $rendererLibrary;


        $directoryPath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/*';
        $files = glob($directoryPath);
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }

        $query = $this->db->get("Students");
        $records = $query->result();
        foreach($records as $row)
        {
            $row->Status=$row->Status ? true : false;
        }
        require_once 'PHPExcel/Classes/PHPExcel.php';

        require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';


        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");

        $objPHPExcel->setActiveSheetIndex(0);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach($query->result() as $data)
        {
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);

        //header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        //header("Content-Disposition: attachment; filename=\"results.xlsx\"");
        //header("Cache-Control: max-age=0");




        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

        //$objWriter->save("php://output");
        $fileName='MyExcel_'.date('d_M_Y',time()).'.pdf';
        $filePath='C:/xampp/htdocs/CodeIgniter-3.1.3/Exports/'.$fileName;

        $objWriter->save($filePath);
        echo $fileName;



    }










}