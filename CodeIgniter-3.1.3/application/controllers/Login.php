<?php

class Login extends CI_Controller {

      function __construct() {
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
      }

      public function index() {
         $this->load->helper('form');
         $this->load->helper('url');

          if($this->session->userdata('LoggedIn'))
          {
              $SessionData = $this->session->userdata('LoggedIn');
              $AccountType = $SessionData['PersonTypeId'];
              //$this->load->view('welcome');
              redirect(ucfirst($AccountType).'/Dashboard', 'refresh');
              //redirect(base_url() . 'index.php?'.$AccountType.'/Dashboard', 'refresh');

          }

         $this->load->view('OMID/Login');
      }



      public function CheckInfo() {

         $this->load->library('form_validation');
         $this->load->library('session');

         $this->form_validation->set_rules('Email', 'ایمیل', 'trim|required|valid_email',
             array(
                 'required' => 'وارد کردن %s الزامی است.',
                 'valid_email' => '%s  وارد شده صحیح نیست.'
             )
         );

         $this->form_validation->set_rules('Password', 'کلمه عبور', 'trim|required',
             array('required' => 'وارد کردن %s الزامی است.'));


         $this->form_validation->set_rules('AccountType', 'ورود به عنوان', 'callback_LoginInfoCheck');

         if ($this->form_validation->run() == FALSE) {
             $this->load->view('OMID/Login');
         }
         else
         {
             redirect('Login', 'refresh');
         }



      }


      public function LoginInfoCheck()
      {

         $this->load->model('LoginModel');

         $data = array(
             'Email' => $this->input->post('Email'),
             'PSWD1' => $this->input->post('Password'),
             'PersonTypeId' => $this->input->post('AccountType')

         );

         $user =$this->LoginModel->CheckInfo($data);

         if($user)
         {
            $SessionArray = array();
            foreach($user as $row)
            {
               $SessionArray = array(
                   'UserId' => $row->UserId,
                   'Email' => $row->Email,
                   'PersonTypeId' => $row->PersonTypeId
               );
               $this->session->set_userdata('LoggedIn', $SessionArray);
            }
            return TRUE;
         }
         else{
            $this->form_validation->set_message('LoginInfoCheck', 'ایمیل یا کلمه عبور وارد شده معتبر نیست.');
            return false;
         }





      }



    function Logout()
    {
        $this->session->unset_userdata('LoggedIn');
        $this->session->sess_destroy();
        $this->session->set_flashdata('LogoutNotification', 'LoggedOut');
        redirect(base_url().'index.php/Login' , 'refresh');
    }


	  

   }
?>
