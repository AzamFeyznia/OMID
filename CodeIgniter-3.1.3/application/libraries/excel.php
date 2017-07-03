<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/26/2017
 * Time: 10:04 AM
 */

 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
*  =======================================
*  Author     : Muhammad Surya Ikhsanudin
*  License    : Protected
*  Email      : mutofiyah@gmail.com
*
*  Dilarang merubah, mengganti dan mendistribusikan
*  ulang tanpa sepengetahuan Author
*  =======================================
*/
require_once APPPATH."/third_party/PHPExcel/Classes/PHPExcel.php";

class Excel extends PHPExcel {
    public function __construct() {
        parent::__construct();
    }
}