<?php

class Ministrant extends CI_Controller {

      function __construct() {
         parent::__construct();
         $this->load->helper('url');
         $this->load->helper('form');
         $this->load->database();
      }

      public function index() {
         $this->load->helper('form');


          if($this->session->userdata('LoggedIn'))
          {
              $SessionData = $this->session->userdata('LoggedIn');
              $AccountType = $SessionData['PersonTypeId'];
              redirect(ucfirst($AccountType).'/Dashboard', 'refresh');

          }
          else
          {
              redirect('Login', 'refresh');
          }

      }


    function Dashboard()
    {
        if(!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');
        $PageData['PageName']  = 'Dashboard';
        $PageData['PageTitle'] = 'داشبورد کارجو';
        $this->load->view('OMID/index', $PageData);
    }


    function PersonalInfo()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'PersonalInfo';
        $PageData['PageTitle'] = 'اطلاعات فردی';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['PersonalInfo'] =  $this->MinistrantModel->GetMinistrantInfo($Email);

        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        $PageData['Countries'] =  $this->MinistrantModel->GetCountries();


        $this->load->view('OMID/index', $PageData);
    }



      public function CheckPersonalInfo($MinistrantId='') {

         $this->load->library('form_validation');

         $this->form_validation->set_rules('MilitaryServiceStatus', 'وضعیت نظام وظیفه', 'callback_MilitaryServiceInfoCheck');
         $this->form_validation->set_rules('DayOfBirth', 'تاریخ تولد', 'callback_DayOfBirthCheck');
         $this->form_validation->set_rules('UserImage', 'عکس', 'callback_ImageCheck['.$MinistrantId.']');
         $this->form_validation->set_rules('Documents', 'مدارک شناسایی', 'callback_DocumentsCheck');



         if ($this->form_validation->run() == FALSE) {
             $this->PersonalInfo();

         }
         else
         {
             $MinistrantData = array(
                 'MinistrantFirstName' => $this->input->post('FirstName'),
                 'MinistrantLastName' => $this->input->post('LastName'),
                 'Sex' => ($this->input->post('Sex')=='NOT_SELECTED')?NULL:$this->input->post('Sex'),
                 'MaritalStatus' => ($this->input->post('MaritalStatus')=='NOT_SELECTED')?NULL:$this->input->post('MaritalStatus'),
                 'MilitaryServiceStatus' => ($this->input->post('MilitaryServiceStatus')=='NOT_SELECTED')?NULL:$this->input->post('MilitaryServiceStatus'),
                 'YearOfBirth' => ($this->input->post('YearOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('YearOfBirth'),
                 'MonthOfBirth' => ($this->input->post('MonthOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('MonthOfBirth'),
                 'DayOfBirth' =>($this->input->post('DayOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('DayOfBirth'),
                 'NationalityId' => ($this->input->post('NationalityId')=='NOT_SELECTED')?NULL:$this->input->post('NationalityId'),
                 'MinistrantDsc' => $this->input->post('Dsc')
             );

             /*if(!empty($_FILES['Documents']['name'])){
                 $uploadData=$this->input->post('Documents');
                 var_dump($uploadData);
             }*/
             if($this->input->post('RemovedImage')){
                 $MinistrantData['ImageName'] =NULL;
                 $filePath='images/OMID/Ministrant/Personal/'.$MinistrantId;
                 unlink($filePath);

             }
             elseif ($_FILES['UserImage']['error'] != 4){
             $data = array('upload_data' => $this->upload->data());
                 $MinistrantData = array(
                     'MinistrantFirstName' => $this->input->post('FirstName'),
                     'MinistrantLastName' => $this->input->post('LastName'),
                     'Sex' => ($this->input->post('Sex')=='NOT_SELECTED')?NULL:$this->input->post('Sex'),
                     'MaritalStatus' => ($this->input->post('MaritalStatus')=='NOT_SELECTED')?NULL:$this->input->post('MaritalStatus'),
                     'MilitaryServiceStatus' => ($this->input->post('MilitaryServiceStatus')=='NOT_SELECTED')?NULL:$this->input->post('MilitaryServiceStatus'),
                     'YearOfBirth' => ($this->input->post('YearOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('YearOfBirth'),
                     'MonthOfBirth' => ($this->input->post('MonthOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('MonthOfBirth'),
                     'DayOfBirth' =>($this->input->post('DayOfBirth')=='NOT_SELECTED')?NULL:$this->input->post('DayOfBirth'),
                     'NationalityId' => ($this->input->post('NationalityId')=='NOT_SELECTED')?NULL:$this->input->post('NationalityId'),
                     'MinistrantDsc' => $this->input->post('Dsc'),
                     'ImageName' => $data["upload_data"]["file_name"]
                 );
//var_dump($data["upload_data"]["file_name"]);
             }

             else{

             }



             $this->load->model('MinistrantModel');
             $this->db->db_select('omidservice');


             $this->MinistrantModel->UpdateMinistrantInfo($MinistrantData,$MinistrantId);

             redirect('Ministrant/PersonalInfo', 'refresh');
         }



      }


    public function MilitaryServiceInfoCheck()
    {

        if($this->input->post('Sex')=='WOMAN' && $this->input->post('MilitaryServiceStatus')!='EXEMPTED'){
            $this->form_validation->set_message('MilitaryServiceInfoCheck', 'وضعیت نظام وظیفه معتبر نیست.');
            return false;
        }
        return true;

    }

    public function DayOfBirthCheck()
    {

        if($this->input->post('DayOfBirth')>30 && $this->input->post('MonthOfBirth')>6 ){
            $this->form_validation->set_message('DayOfBirthCheck', 'تاریخ تولد معتبر نیست.');
            return false;
        }
        return true;

    }

    public function ImageCheck($str,$MinistrantId)
    {

        $config['upload_path']          = 'images/OMID/Ministrant/Personal/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200;
        $config['file_name']            = $MinistrantId;
        $config['overwrite']            = TRUE;
        //$config['max_height']           = 1000;

        $this->load->library('upload', $config);

        if ( !$this->upload->do_upload('UserImage') ) {
            $error = array('error' => $this->upload->display_errors());

            //var_dump($error);
            if ($_FILES['UserImage']['error'] != 4) {


                $this->form_validation->set_message('ImageCheck', 'لطفا عکس مناسب انتخاب نمایید.');
                return false;
            }

        }

        return true;

    }

    public function DocumentsCheck()
    {
        if(!empty($_FILES['Documents']['name'])) {


            $filesCount = count($_FILES['Documents']['name']);
            if($filesCount>4){
                $this->form_validation->set_message('DocumentsCheck', 'تعداد فایلها، بیشتر از تعداد مجاز است.');
                return false;
            }
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['Document']['name'] = $_FILES['Documents']['name'][$i];
                $_FILES['Document']['type'] = $_FILES['Documents']['type'][$i];
                $_FILES['Document']['tmp_name'] = $_FILES['Documents']['tmp_name'][$i];
                $_FILES['Document']['error'] = $_FILES['Documents']['error'][$i];
                $_FILES['Document']['size'] = $_FILES['Documents']['size'][$i];

                $SessionData = $this->session->userdata('LoggedIn');
                $dir=FCPATH."/images/OMID/".$SessionData['PersonTypeId']."/".$SessionData['UserId'].'/Personal/Documents';
                if (!file_exists($dir)) {
                    mkdir($dir, 0777, true);
                }

                $config['upload_path'] = $dir."/";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = 200;
                $config['file_name'] = $i+1;

                $this->load->library('upload', $config);


                if (!$this->upload->do_upload('Document')) {
                    $error = array('error' => $this->upload->display_errors());


                    if ($_FILES['Document']['error'] != 4) {
                       // var_dump($_FILES['Document']);


                        $this->form_validation->set_message('DocumentsCheck', 'لطفا عکس مناسب انتخاب نمایید.');
                        return false;
                    }

                }


            }


        }
        return true;
    }

    function ContactInfo()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'ContactInfo';
        $PageData['PageTitle'] = 'اطلاعات تماس';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['ContactInfo'] =  $this->MinistrantModel->GetMinistrantInfo($Email);

        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        $PageData['States'] =  $this->MinistrantModel->GetStates();

        foreach($PageData['ContactInfo'] as $row) {
            $this->load->model('MinistrantModel');
            $this->db->db_select('omidbaseinfo');
            $PageData['Cities'] =  $this->MinistrantModel->GetCities($row->StateId);
        }

        $this->load->view('OMID/index', $PageData);
    }


    function UpdateCities($StateId)
    {

        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        $city= $this->MinistrantModel->GetCities($StateId);
        $StateCities="<option value='NOT_SELECTED'set_select('CityId','NOT_SELECTED', TRUE) >---</option>
";
        foreach($city as $row) {

            $StateCities.="<option value='".$row->CityId."'  set_select('CityId',". $row->CityId.")</option>".$row->CityName;
        }

        echo $StateCities;


    }



    public function CheckContactInfo($MinistrantId='',$Mobile='') {

        $this->load->library('form_validation');
        $this->db->db_select('omidservice');

        if($Mobile!=$this->input->post('Mobile'))
            $this->form_validation->set_rules('Mobile', 'شماره موبایل', 'trim|required|exact_length[11]|regex_match[/09*/]|numeric|is_unique[ministrantpersonalinfo.Mobile]',
                array(
                    'required' => 'وارد کردن %s الزامی است.',
                    'exact_length' => '%s  وارد شده صحیح نیست.',
                    'regex_match' => '%s  وارد شده صحیح نیست.',
                    'numeric' => '%s  وارد شده صحیح نیست.',
                    'is_unique' => '%s  وارد شده تکراری است.'

                )
            );



        if($this->input->post('CityId')!='NOT_SELECTED')
            $this->form_validation->set_rules('CityId', 'شهر', 'callback_CityIdCheck['.$this->input->post('StateId').']');
        $this->form_validation->set_rules('Phone', 'شماره تلفن', 'trim|regex_match[/0*/]|numeric',
            array(

                'regex_match' => '%s  وارد شده صحیح نیست.',
                'numeric' => '%s  وارد شده صحیح نیست.'

            )
        );



        if ($this->form_validation->run() == FALSE) {
            $this->ContactInfo();

        }
        else
        {
            $this->load->model('MinistrantModel');
            $this->db->db_select('omidframework');

            $UserData = array(
                'Mobile' => $this->input->post('Mobile'),
                'Email' => $this->input->post('Email')
            );

            $SessionData = $this->session->userdata('LoggedIn');
            $UserId = $SessionData['UserId'];


            $this->MinistrantModel->UpdateUserInfo($UserData,$UserId);


            $this->load->model('MinistrantModel');
            $this->db->db_select('omidservice');

            $MinistrantData = array(
                'Mobile' => $this->input->post('Mobile'),
                'Phone' => $this->input->post('Phone'),
                'Email' => $this->input->post('Email'),
                'StateId' => ($this->input->post('StateId')=='NOT_SELECTED')?NULL:$this->input->post('StateId'),
                'CityId' => ($this->input->post('CityId')=='NOT_SELECTED')?NULL:$this->input->post('CityId'),
                'Address' => $this->input->post('Address')
            );


            $this->MinistrantModel->UpdateMinistrantInfo($MinistrantData,$MinistrantId);



            redirect('Ministrant/ContactInfo', 'refresh');
        }



    }


    function JobExperiencesInfo()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'JobExperiencesInfo';
        $PageData['PageTitle'] = 'تجربیات شغلی';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['JobExperiencesInfo'] =  $this->MinistrantModel->GetJobExperiencesInfo($Email);

        $this->load->view('OMID/index', $PageData);
    }

    function EducationalInfo()
{
    if (!$this->session->userdata('LoggedIn'))
        redirect('Login', 'refresh');



    $PageData['PageName']  = 'EducationalInfo';
    $PageData['PageTitle'] = 'اطلاعات تحصیلی';

    $SessionData = $this->session->userdata('LoggedIn');
    $Email = $SessionData['Email'];
    $this->load->model('MinistrantModel');
    $this->db->db_select('omidservice');
    $PageData['EducationalInfo'] =  $this->MinistrantModel->GetEducationalInfo($Email);
//var_dump($PageData['EducationalInfo'] );
    $this->load->view('OMID/index', $PageData);
}



    function CooperationRequests()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'CooperationRequests';
        $PageData['PageTitle'] = 'درخواستهای همکاری با من';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['CooperationRequestsInfo'] =  $this->MinistrantModel->GetCooperationRequestsInfo($Email);
//var_dump($PageData['CooperationRequestsInfo'] );
       $this->load->view('OMID/index', $PageData);
    }

    function Capabilities()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'Capabilities';
        $PageData['PageTitle'] = 'توانمندی ها';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['TrainingInfo'] =  $this->MinistrantModel->GetTrainingInfo($Email);
        $PageData['SoftwaresInfo'] =  $this->MinistrantModel->GetSoftwaresInfo($Email);
        $PageData['LanguagesInfo'] =  $this->MinistrantModel->GetLanguagesInfo($Email);
//var_dump($PageData['LanguagesInfo'] );
        $this->load->view('OMID/index', $PageData);
    }


    function MySkills()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'MySkills';
        $PageData['PageTitle'] = 'مهارتهای من';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidservice');
        $PageData['MySkillsInfo'] =  $this->MinistrantModel->GetMySkillsInfo($Email);
//var_dump($PageData['MySkillsInfo'] );
        $this->load->view('OMID/index', $PageData);
    }

    function Deactive()
    {
        if(!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');
        $PageData['PageName']  = 'Deactive';
        $PageData['PageTitle'] = 'لغو عضویت';
        $this->load->view('OMID/index', $PageData);
    }

    public function CheckDeactiveInfo() {

        $this->load->library('form_validation');


        $this->form_validation->set_rules('DeactiveReason', 'علت لغو عضویت', 'callback_DeactiveReasonCheck');
        $this->form_validation->set_rules('CurrentPass', 'کلمه عبور', 'callback_PassCheck');



        if ($this->form_validation->run() == FALSE) {
            $this->Deactive();

        }
        else
        {
            $this->load->model('MinistrantModel');
            $this->db->db_select('omidframework');

            $SessionData = $this->session->userdata('LoggedIn');
            $UserId = $SessionData['UserId'];

            $DeactiveData = array(
                'DeactiveReason' => ($this->input->post('DeactiveReason')=='NOT_SELECTED')?NULL:$this->input->post('DeactiveReason'),
                'Comment' => !strlen(trim($this->input->post('Comment')))?NULL:$this->input->post('Comment'),
                'UserId' => $UserId
            );

            $this->MinistrantModel->InsertDeactiveInfo($DeactiveData);

            $UserData = array(
                'Disabled' => 'YES'
            );




            $this->MinistrantModel->UpdateUserInfo($UserData,$UserId);


            redirect('Login/Logout', 'refresh');
        }



    }



    function ChangePassword()
    {
        if(!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');
        $PageData['PageName']  = 'ChangePassword';
        $PageData['PageTitle'] = 'تغییر رمز ورود';
        $this->load->view('OMID/index', $PageData);
    }


    public function CheckChangedPasswordInfo() {

        $this->load->library('form_validation');


        $this->form_validation->set_rules('CurrentPass', 'کلمه عبور فعلی', 'trim|required|callback_PassCheck',
            array('required' => 'وارد کردن %s الزامی است.'));

        $this->form_validation->set_rules('NewPass', 'کلمه عبور جدید', 'trim|required|callback_NewPassCheck',
            array('required' => 'وارد کردن %s الزامی است.'));

        $this->form_validation->set_rules('ConfirmNewPass', 'تکرار کلمه عبور جدید', 'trim|required|matches[NewPass]',
            array(
                'required' => 'مقدار وارد شده صحیح نیست.' ,
                'matches' => 'کلمه های عبور وارد شده باهم تطابق ندارند.'
            )
        );






        if ($this->form_validation->run() == FALSE) {
            $this->ChangePassword();

        }
        else
        {
            $this->load->model('MinistrantModel');
            $this->db->db_select('omidframework');

            $UserData = array(
                'PSWD1' => SHA1(MD5($this->input->post('NewPass')))
            );

            $SessionData = $this->session->userdata('LoggedIn');
            $UserId = $SessionData['UserId'];


            $this->MinistrantModel->UpdateUserInfo($UserData,$UserId);

            $PageData['PageName']  = 'SuccessfulChangedPassword';
            $PageData['PageTitle'] = 'تغییر رمز ورود';


            $this->load->view('OMID/index', $PageData);
        }



    }






    public function CityIdCheck($CityId, $StateId)
    {
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        if($this->MinistrantModel->CheckStateCities($CityId,$StateId))
            return true;

        $this->form_validation->set_message('CityIdCheck', 'شهر معتبر نیست.');
        return false;


    }



    public function PassCheck()
    {

        $this->load->model('LoginModel');

        $SessionData = $this->session->userdata('LoggedIn');

        $data = array(
            'Email' => $SessionData['Email'],
            'PSWD1' => $this->input->post('CurrentPass'),
            'PersonTypeId' => $SessionData['PersonTypeId']

        );

        $user =$this->LoginModel->CheckInfo($data);

        if($user)
        {
            return TRUE;
        }
        else{
            $this->form_validation->set_message('PassCheck', 'کلمه عبور وارد شده معتبر نیست.');
            return false;
        }





    }

    public function NewPassCheck()
    {

        if($this->input->post('CurrentPass')==$this->input->post('NewPass')){
            $this->form_validation->set_message('NewPassCheck', 'لطفا کلمه عبور جدید را وارد کنید.');
            return false;
        }
        return true;

    }

    public function DeactiveReasonCheck()
    {

        if($this->input->post('DeactiveReason')=='NOT_SELECTED' && !strlen(trim($this->input->post('Comment')))){
            $this->form_validation->set_message('DeactiveReasonCheck', 'لطفا علت لغو عضویت را توضیح دهید.');
            return false;
        }
        return true;

    }



}
?>
