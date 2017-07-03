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



      public function CheckPersonalInfo($MinistrantId='',$NumberOfFiles='') {

         $this->DocumentsInfo['FileName']="EMPTY";

         $this->load->library('form_validation');

         //$this->form_validation->set_rules('MilitaryServiceStatus', 'وضعیت نظام وظیفه', 'callback_MilitaryServiceInfoCheck');
         //$this->form_validation->set_rules('DayOfBirth', 'تاریخ تولد', 'callback_DayOfBirthCheck');
         $this->form_validation->set_rules('UserImage', 'عکس', 'callback_ImageCheck['.$MinistrantId.']');
         $this->form_validation->set_rules('Documents', 'مدارک شناسایی', 'callback_DocumentsCheck['.$NumberOfFiles.']');



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

             if($this->DocumentsInfo['FileName']!="EMPTY"){
                 $MinistrantData['DocumentsFolder'] =$this->DocumentsInfo['FileName'];
                 $MinistrantData['NumberOfFiles'] =$this->DocumentsInfo['count'];
                 //var_dump($this->DocumentsInfo['FileName']);
             }

             if($this->input->post('RemovedImage')){
                 $MinistrantData['ImageName'] =NULL;

                 $SessionData = $this->session->userdata('LoggedIn');
                 $filePath='images/OMID/Ministrant/'.$SessionData['UserId'].'/Personal/'.$this->input->post('RemovedImage');
                 unlink($filePath);

             }
             elseif(!empty($_FILES['UserImage']['name'])){
                 $MinistrantData['ImageName'] =$this->UserImageInfo['FileName'];
             }
             //var_dump($this->input->post('RemovedImage'));

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
        if(!empty($_FILES['UserImage']['name'])) {

            $SessionData = $this->session->userdata('LoggedIn');
            $dir=FCPATH."/images/OMID/".$SessionData['PersonTypeId']."/".$SessionData['UserId'].'/Personal';
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $config['upload_path'] = $dir;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 200;
            $config['file_name'] = $MinistrantId;
            $config['overwrite'] = TRUE;
            //$config['max_height']           = 1000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('UserImage')) {
                $error = array('error' => $this->upload->display_errors());

                //var_dump($error);
                if ($_FILES['UserImage']['error'] != 4) {


                    $this->form_validation->set_message('ImageCheck', 'لطفا عکس مناسب انتخاب نمایید.');
                    return false;
                }
                return true;

            }
            $data = array('upload_data' => $this->upload->data());
            $UploadFiles['FileName']=$data['upload_data']['file_name'];
            $this->UserImageInfo=$UploadFiles;

        }

        return true;

    }

    public function DocumentsCheck($str,$NumberOfFiles)
    {
        if(!empty($_FILES['Documents']['name'])) {

            $UploadFiles['FileName']="";
            $UploadFiles['count']=0;
            $DocumentsFolder=$this->input->post('DocumentsFolder');
            if($NumberOfFiles && $DocumentsFolder){
                $UploadFiles['count']=$NumberOfFiles;
                $UploadFiles['FileName']=$DocumentsFolder;
            }


            $filesCount = count($_FILES['Documents']['name']);
            if(($filesCount+$UploadFiles['count'])>4){
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
                $this->upload->initialize($config);


                if (!$this->upload->do_upload('Document')) {
                    $error = array('error' => $this->upload->display_errors());

                    if ($_FILES['Document']['error'] != 4) {

                        $this->form_validation->set_message('DocumentsCheck', 'لطفا عکس مناسب انتخاب نمایید.');
                        return false;
                    }
                    return true;

                }


                $data = array('upload_data' => $this->upload->data());
                $UploadFiles['FileName']=$UploadFiles['FileName']."***".$data['upload_data']['file_name'];
                $UploadFiles['count']++;



            }
            $this->DocumentsInfo=$UploadFiles;
            return true;


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
        if($city)
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



    function NewJobExperiencesInfo()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'NewJobExperiencesInfo';
        $PageData['PageTitle'] = 'تجربیات شغلی';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');



        $PageData['Countries'] =  $this->MinistrantModel->GetCountries();
        $PageData['States'] =  $this->MinistrantModel->GetStates();
        $DefaultValues=$this->MinistrantModel->GetDefaultJobValues($Email);
        $PageData['MinistrantId']=$DefaultValues[0]->MinistrantId;
        if($DefaultValues[0]->JobStateId){
            $PageData['DefaultStateId']=$DefaultValues[0]->JobStateId;
            $PageData['Cities'] =  $this->MinistrantModel->GetCities($PageData['DefaultStateId']);
            if($DefaultValues[0]->JobCityId)
                $PageData['DefaultCityId']=$DefaultValues[0]->JobCityId;
        }
        elseif ($DefaultValues[0]->MinistrantStateId){
            $PageData['DefaultStateId']=$DefaultValues[0]->MinistrantStateId;
            $PageData['Cities'] =  $this->MinistrantModel->GetCities($PageData['DefaultStateId']);
            if($DefaultValues[0]->MinistrantCityId)
                $PageData['DefaultCityId']=$DefaultValues[0]->MinistrantCityId;
        }

        $PageData['ServiceCategories'] =  $this->MinistrantModel->GetServiceCategories();
        if($DefaultValues[0]->SkillId){
            $DefaultServiceCategoryJobGroup =  $this->MinistrantModel->GetDefaultServiceCategoryJobGroupId($DefaultValues[0]->SkillId);
            if($DefaultServiceCategoryJobGroup[0]->ServiceCategoryId){
                $PageData['DefaultServiceCategoryId']=$DefaultServiceCategoryJobGroup[0]->ServiceCategoryId;
                $PageData['JobGroups'] =  $this->MinistrantModel->GetJobGroups($PageData['DefaultServiceCategoryId']);
                if($DefaultServiceCategoryJobGroup[0]->JobGroupId){
                    $PageData['DefaultJobGroupId']=$DefaultServiceCategoryJobGroup[0]->JobGroupId;
                    $PageData['Skills'] =  $this->MinistrantModel->GetSkills($PageData['DefaultJobGroupId']);
                    $PageData['DefaultSkillId']=$DefaultValues[0]->SkillId;
                }
            }


        }

//var_dump($DefaultValues[0]);

        $this->load->view('OMID/index', $PageData);
    }


    function UpdateJobGroups($ServiceCategoryId)
    {

        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        $JobGroup= $this->MinistrantModel->GetJobGroups($ServiceCategoryId);
        $ServiceCategoryJobGroups="<option value='NOT_SELECTED'set_select('JobGroupId','NOT_SELECTED', TRUE) >---</option>
";
        if($JobGroup)
            foreach($JobGroup as $row) {

                $ServiceCategoryJobGroups.="<option value='".$row->JobGroupId."'  set_select('JobGroupId',". $row->JobGroupId.")</option>".$row->JobGroupName;
            }


        echo $ServiceCategoryJobGroups;



    }


    public function CheckNewJobExperiencesInfo($MinistrantId='',$Mobile='') {

        $this->load->library('form_validation');
        $this->db->db_select('omidservice');

        if($this->input->post('CityId')!='NOT_SELECTED') {
            $this->form_validation->set_rules('CityId', 'شهر', 'callback_CityIdCheck[' . $this->input->post('StateId') . ']');
            $this->form_validation->set_rules('CountryId', 'کشور', 'callback_CountryIdCheck');
        }


        $this->form_validation->set_rules('SkillId', 'مهارت', 'required|callback_SkillIdCheck[' . $this->input->post('JobGroupId') . ']');
        $this->form_validation->set_rules('ServiceCategoryId', 'دسته', 'callback_ServiceCategoryIdCheck');



        $this->form_validation->set_rules('Phone', 'شماره تلفن', 'trim|regex_match[/0*/]|numeric',
            array(

                'regex_match' => '%s  وارد شده صحیح نیست.',
                'numeric' => '%s  وارد شده صحیح نیست.'

            )
        );

        if($this->input->post('EndYear')!='NOT_SELECTED' && $this->input->post('EndMonth')!='NOT_SELECTED' && $this->input->post('StartYear')!='NOT_SELECTED' && $this->input->post('StartMonth')!='NOT_SELECTED')

            $this->form_validation->set_rules('EndYear', 'تاریخ پایان', 'callback_EndYearCheck');




        if ($this->form_validation->run() == FALSE) {
            $this->NewJobExperiencesInfo();

        }
        else
        {

            $this->load->model('MinistrantModel');
            $this->db->db_select('omidservice');


            $ServiceData = array(
                'SkillId' => $this->input->post('SkillId'),
                'MinistrantId' => $MinistrantId
            );


            $Service=$this->MinistrantModel->InsertServiceInfo($ServiceData);
            if($Service[0]->ServiceId){


            $JobExperienceData = array(
                'ServiceId' => $Service[0]->ServiceId,
                'EmployerName' => $this->input->post('Employer'),
                'EmployerPhone' => $this->input->post('Phone'),
                'EmployerAddress' => $this->input->post('Address'),
                'CountryId' => ($this->input->post('CountryId')=='NOT_SELECTED')?NULL:$this->input->post('CountryId'),
                'StateId' => ($this->input->post('StateId')=='NOT_SELECTED')?NULL:$this->input->post('StateId'),

                'CityId' => ($this->input->post('CityId')=='NOT_SELECTED')?NULL:$this->input->post('CityId'),
                'StartYear' => ($this->input->post('StartYear')=='NOT_SELECTED')?NULL:$this->input->post('StartYear'),
                'StartMonth' => ($this->input->post('StartMonth')=='NOT_SELECTED')?NULL:$this->input->post('StartMonth'),

                'EndYear' => ($this->input->post('EndYear')=='NOT_SELECTED')?NULL:$this->input->post('EndYear'),
                'EndMonth' => ($this->input->post('EndMonth')=='NOT_SELECTED')?NULL:$this->input->post('EndMonth'),
                'NotOverYet' => ($this->input->post('NotOverYet')=='accept')?1:0,
                'Comment' => $this->input->post('Comment')
            );


            $this->MinistrantModel->InsertJobExperienceInfo($JobExperienceData);



            redirect('Ministrant/NewJobExperiencesInfo', 'refresh');
            }
        }



    }

    public function CountryIdCheck()
    {
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');


        if($this->MinistrantModel->CheckCountry($this->input->post('CountryId')))
            return true;

        $this->form_validation->set_message('CountryIdCheck', 'کشور معتبر نیست.');
        return false;


    }

    public function SkillIdCheck($SkillId, $JobGroupId)
    {
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');


        if($this->MinistrantModel->CheckSkillId($SkillId,$JobGroupId))
            return true;

        $this->form_validation->set_message('SkillIdCheck', 'مهارت معتبر نیست.');
        return false;


    }

    public function ServiceCategoryIdCheck()
    {
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');


        if($this->MinistrantModel->CheckServiceCategoryId($this->input->post('ServiceCategoryId'),$this->input->post('JobGroupId')))
            return true;

        $this->form_validation->set_message('ServiceCategoryId', 'گروه شغلی معتبر نیست.');
        return false;


    }

    public function EndYearCheck()
    {
        $StartMonth=$this->input->post('StartMonth');
        $StartYear=$this->input->post('StartYear');
        $EndMonth=$this->input->post('EndMonth');
        $EndYear=$this->input->post('EndYear');

        if($EndMonth < $StartMonth && $EndYear> $StartYear)
            return true;

        if($EndMonth > $StartMonth && $EndYear>= $StartYear)
            return true;

        $this->form_validation->set_message('EndYearCheck', 'تاریخ پایان، معتبر نیست.');
        return false;


    }


    function UpdateSkills($JobGroupId)
    {

        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');
        $Skill= $this->MinistrantModel->GetSkills($JobGroupId);
        $JobGroupSkills="<option value='NOT_SELECTED'set_select('SkillId','NOT_SELECTED', TRUE) >---</option>
";
        if($Skill)
            foreach($Skill as $row) {

                $JobGroupSkills.="<option value='".$row->SkillId."'  set_select('SkillId',". $row->SkillId.")</option>".$row->SkillName;
            }


        echo $JobGroupSkills;



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

    function NewEducationalInfo()
    {
        if (!$this->session->userdata('LoggedIn'))
            redirect('Login', 'refresh');



        $PageData['PageName']  = 'NewEducationalInfo';
        $PageData['PageTitle'] = 'اطلاعات تحصیلی';

        $SessionData = $this->session->userdata('LoggedIn');
        $Email = $SessionData['Email'];
        $this->load->model('MinistrantModel');
        $this->db->db_select('omidbaseinfo');



        $PageData['Countries'] =  $this->MinistrantModel->GetCountries();
        $PageData['States'] =  $this->MinistrantModel->GetStates();
        $DefaultValues=$this->MinistrantModel->GetDefaultEducationValues($Email);
        $PageData['MinistrantId']=$DefaultValues[0]->MinistrantId;
        if($DefaultValues[0]->educationStateId){
            $PageData['DefaultStateId']=$DefaultValues[0]->educationStateId;
            $PageData['Cities'] =  $this->MinistrantModel->GetCities($PageData['DefaultStateId']);
            if($DefaultValues[0]->educationCityId)
                $PageData['DefaultCityId']=$DefaultValues[0]->educationCityId;
        }
        elseif ($DefaultValues[0]->MinistrantStateId){
            $PageData['DefaultStateId']=$DefaultValues[0]->MinistrantStateId;
            $PageData['Cities'] =  $this->MinistrantModel->GetCities($PageData['DefaultStateId']);
            if($DefaultValues[0]->MinistrantCityId)
                $PageData['DefaultCityId']=$DefaultValues[0]->MinistrantCityId;
        }

        $PageData['Degrees'] =  $this->MinistrantModel->GetDegrees();



//var_dump($DefaultValues[0]);

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
