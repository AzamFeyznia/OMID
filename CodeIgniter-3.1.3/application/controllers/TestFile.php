<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/1/2017
 * Time: 8:22 AM
 */

class TestFile extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->database();

    }

    public function index() {

       //$this->load->view('ImageUploadTest/ClearTest');
        //$this->load->view('StudentView');
        //$this->load->view('TestCheckBoxView');
        $this->load->view('ImportTestView');

    }


}
?>
