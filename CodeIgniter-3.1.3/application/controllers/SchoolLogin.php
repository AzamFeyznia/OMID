<?php
//session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class SchoolLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper(array('form'));
   
   
 }
 
 function index()
 {
     if($this->session->userdata('LoggedIn'))
   {
   
     $this->load->view('test');
   }
   else
   {
     $this->load->view('LoginView');
   }
   
 }

function LogOut()
 {
   $this->session->unset_userdata('LoggedIn');
   session_destroy();
   $this->load->view('LoginView');
 }
 
}
?>
