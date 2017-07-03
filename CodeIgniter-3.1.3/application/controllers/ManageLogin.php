<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
session_start(); 
class ManageLogin extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
   $this->load->helper(array('form'));
 }
 
 function index()
 {
   if($this->session->userdata('LoggedIn'))
   {
     $SessionData = $this->session->userdata('LoggedIn');
     $data['PersonType'] = $SessionData['PersonType'];
     $data['PersonId'] = $SessionData['PersonId'];
     $this->load->view('Index', $data);
   }
   else
   {
     $this->load->view('LoginView');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('LoggedIn');
   session_destroy();
   $this->load->view('LoginView');
 }
 
}
?>
