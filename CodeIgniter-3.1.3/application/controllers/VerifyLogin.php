<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class VerifyLogin extends CI_Controller {

function __construct()
 {
   parent::__construct();
   $this->load->model('SchoolLoginModel','',TRUE);
 }

 function index()
 {
     if($this->session->userdata('LoggedIn'))
   {
   
     $this->load->view('test');
   }
   else
   {
       $this->load->helper('security');
       $this->load->library('form_validation');

       $this->form_validation->set_rules('UserName', 'نام کاربری', 'trim|required|xss_clean');
       $this->form_validation->set_rules('Password', 'کلمه عبور', 'trim|required|xss_clean|callback_ValidateUser[UserName]');

       if($this->form_validation->run() == FALSE)
       {

         $this->load->view('LoginView');
       }
       else
       {

         $this->load->view('test');




     }
 }
 }

 function ValidateUser($PasswordValue,$UserNameFieldName)
 {
     $data = array(
            'AccountName' => $this->input->post($UserNameFieldName),
            'PSWD1' => $PasswordValue
         );

   $result = $this->SchoolLoginModel->CheckInfo($data);

   if($result)
   {
       $SessionArray = array();
     foreach($result as $row)
     {
       $SessionArray = array(
         'PersonType' => $row->PersonTypeId,
         'PersonId' => $row->PersonId
       );
       $this->session->set_userdata('LoggedIn', $SessionArray);
     }
 
     return TRUE;
   }
   
    $this->form_validation->set_message('ValidateUser', 'نام کاربری یا کلمه عبور اشتباه است');
     return FALSE;
   
 
}
}
?>
