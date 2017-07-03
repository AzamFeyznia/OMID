<?php
   class Register extends CI_Controller {

      function __construct() {
         parent::__construct();
         $this->load->helper('url');
         $this->load->database();
      }

      public function index() {
         $this->load->helper('form');
         $this->load->helper('url');
         $this->load->view('OMID/Register');
      }



      public function CheckInfo()
      {
         $this->load->library('form_validation');

         $AccountType = $this->input->post('AccountType');
         $this->db->db_select('omidservice');

         if ($AccountType == 'MINISTRANT') {

            $this->form_validation->set_rules('Email', 'ایمیل', 'trim|required|valid_email|is_unique[ministrantpersonalinfo.Email]',
                array(
                    'required' => 'وارد کردن %s الزامی است.',
                    'valid_email' => '%s  وارد شده صحیح نیست.',
                    'is_unique' => '%s  وارد شده تکراری است.'
                )
            );

            $this->form_validation->set_rules('Mobile', 'شماره موبایل', 'trim|required|exact_length[11]|regex_match[/09*/]|numeric|is_unique[ministrantpersonalinfo.Mobile]',
                array(
                    'required' => 'وارد کردن %s الزامی است.',
                    'exact_length' => '%s  وارد شده صحیح نیست.',
                    'regex_match' => '%s  وارد شده صحیح نیست.',
                    'numeric' => '%s  وارد شده صحیح نیست.',
                    'is_unique' => '%s  وارد شده تکراری است.'

                )
            );
         }

         elseif ($AccountType=='EMPLOYER') {
            $this->form_validation->set_rules('Email', 'ایمیل', 'trim|required|valid_email|is_unique[employerinfo.Email]',
                array(
                    'required' => 'وارد کردن %s الزامی است.',
                    'valid_email' => '%s  وارد شده صحیح نیست.',
                    'is_unique' => '%s  وارد شده تکراری است.'
                )
            );

            $this->form_validation->set_rules('Mobile', 'شماره موبایل', 'trim|required|exact_length[11]|regex_match[/09*/]|numeric|is_unique[employerinfo.ContactPersonMobile]',
                array(
                    'required' => 'وارد کردن %s الزامی است.',
                    'exact_length' => '%s  وارد شده صحیح نیست.',
                    'regex_match' => '%s  وارد شده صحیح نیست.',
                    'numeric' => '%s  وارد شده صحیح نیست.',
                    'is_unique' => '%s  وارد شده تکراری است.'

                )
            );
         }



         $this->form_validation->set_rules('Password', 'کلمه عبور', 'trim|required',
             array('required' => 'وارد کردن %s الزامی است.'));

         $this->form_validation->set_rules('RepeatedPassword', 'تکرار کلمه عبور', 'trim|required|matches[Password]',
             array(
                 'required' => 'مقدار وارد شده صحیح نیست.' ,
                 'matches' => 'کلمه های عبور وارد شده باهم تطابق ندارند.'
             )
         );

         if ($this->form_validation->run() == FALSE) {
            $this->load->view('OMID/Register');
         }
         else
         {

            $this->load->model('RegisterModel');

            $this->db->db_select('omidframework');

            $data = array(
                'Email' => $this->input->post('Email'),
                'Mobile' => $this->input->post('Mobile'),
                'PSWD1' => SHA1(MD5($this->input->post('Password'))),
                'PersonTypeId' => $this->input->post('AccountType')
            );

            $user =$this->RegisterModel->InsertUserInfo($data);
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

                  $dir=FCPATH."/images/OMID/".$row->PersonTypeId."/".$row->UserId;
                   mkdir($dir);

               }
            }
              // $this->load->view('Welcome',$data);

            $this->db->db_select('omidservice');

            if ($AccountType == 'MINISTRANT') {
               $data = array(
                   'Email' => $this->input->post('Email'),
                   'Mobile' => $this->input->post('Mobile')
               );
               $this->RegisterModel->InsertMinistrantInfo($data);

            }

            elseif ($AccountType=='EMPLOYER') {
               $data = array(
                   'Email' => $this->input->post('Email'),
                   'ContactPersonMobile' => $this->input->post('Mobile')
               );
               $this->RegisterModel->InsertEmployerInfo($data);
            }



            redirect('Login', 'refresh');
         }



      }
	  

   }
?>
