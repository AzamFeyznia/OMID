<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/26/2017
 * Time: 10:18 AM
 */
class Dompdf_lib {

    var $_dompdf = NULL;

    function __construct()
    {
        require_once("dompdf/autoload.inc.php");
        if(is_null($this->_dompdf)){
            $this->_dompdf = new DOMPDF();
        }
    }

    function convert_html_to_pdf($html, $filename ='', $stream = TRUE)
    {
        $this->_dompdf->load_html($html);
        $this->_dompdf->render();
        if ($stream) {
            $this->_dompdf->stream($filename);
        } else {
            return $this->_dompdf->output();
        }
    }

}
?>