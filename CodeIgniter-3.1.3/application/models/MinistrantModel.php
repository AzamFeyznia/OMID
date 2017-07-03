<?php
   class MinistrantModel extends CI_Model {

      function __construct() {
         parent::__construct();
      }



      public function GetMinistrantInfo($Email) {
         $this->db->where("Email", $Email);
         $query = $this->db->get("ministrantpersonalinfo");
         return $query->result();
      }

      public function GetCountries() {
         $query = $this->db->get("countries");
         return $query->result();
      }

      public function UpdateMinistrantInfo($MinistrantData,$MinistrantId) {
         $this->db->set($MinistrantData);
         $this->db->where("MinistrantId", $MinistrantId);
         $this->db->update("ministrantpersonalinfo", $MinistrantData);
      }

      public function GetStates() {
         $query = $this->db->get("states");
         return $query->result();
      }

      public function GetCities($StateId) {
         $this->db->where("StateId", $StateId);
         $query = $this->db->get("cities");
         return $query->result();
      }

      public function CheckStateCities($CityId,$StateId) {
         $this->db->where("StateId", $StateId);
         $this->db->where("CityId", $CityId);
         $query = $this->db->get("cities");
         if ($query->num_rows() == 1){
            return true;
         }
         return false;
      }

      public function UpdateUserInfo($UserData,$UserId) {
         $this->db->set($UserData);
         $this->db->where("UserId", $UserId);
         $this->db->update("accounts", $UserData);
      }

      public function GetJobExperiencesInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
         $this->db->join('omidbaseinfo.skills', 'omidservice.presentedservices.SkillId = omidbaseinfo.skills.SkillId');
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidservice.jobexperiencesinfo', 'omidservice.jobexperiencesinfo.ServiceId = omidservice.presentedservices.ServiceId');
         $this->db->join('omidbaseinfo.countries', 'omidservice.jobexperiencesinfo.CountryId = omidbaseinfo.countries.CountryId');
         $this->db->join('omidbaseinfo.states', 'omidservice.jobexperiencesinfo.StateId = omidbaseinfo.states.StateId');
         $this->db->join('omidbaseinfo.cities', 'omidservice.jobexperiencesinfo.CityId = omidbaseinfo.cities.CityId');
         $query = $this->db->get();
         return $query->result();
      }

      public function GetServiceCategories() {
         $query = $this->db->get("servicecategories");
         return $query->result();
      }

      public function GetDefaultServiceCategoryJobGroupId($SkillId) {
         $this->db->select('omidbaseinfo.servicecategories.ServiceCategoryId,omidbaseinfo.jobgroups.JobGroupId');
         $this->db->from('omidbaseinfo.skills');
         $this->db->where("omidbaseinfo.skills.SkillId", $SkillId);
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidbaseinfo.servicecategories', 'omidbaseinfo.jobgroups.ServiceCategoryId = omidbaseinfo.servicecategories.ServiceCategoryId');

         $query = $this->db->get();
         return $query->result();
      }



      public function GetJobGroups($ServiceCategoryId) {
         $this->db->where("ServiceCategoryId", $ServiceCategoryId);
         $query = $this->db->get("jobgroups");
         return $query->result();
      }

      public function GetSkills($JobGroupId) {
         $this->db->where("JobGroupId", $JobGroupId);
         $query = $this->db->get("skills");
         return $query->result();
      }

       public function GetDefaultJobValues($Email) {
           $this->db->select('omidservice.ministrantpersonalinfo.MinistrantId ,SkillId,omidservice.ministrantpersonalinfo.StateId AS MinistrantStateId,omidservice.ministrantpersonalinfo.CityId AS MinistrantCityId,omidservice.jobexperiencesinfo.StateId AS JobStateId,omidservice.jobexperiencesinfo.CityId AS JobCityId',FALSE);
           $this->db->from('omidservice.ministrantpersonalinfo');
           $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
           $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
           $this->db->join('omidservice.jobexperiencesinfo', 'omidservice.jobexperiencesinfo.ServiceId = omidservice.presentedservices.ServiceId');
           $this->db->order_by("omidservice.jobexperiencesinfo.StartYear, omidservice.jobexperiencesinfo.StartMonth ", "desc");
           $this->db->limit(1);

           $query = $this->db->get();
           return $query->result();
       }

      public function CheckCountry($CountryId) {
         $this->db->where("CountryId", $CountryId);
         $query = $this->db->get("countries");
         $country= $query->result();
         if($country[0]->CountryName=='ایران')
            return true;
         return false;
      }

      public function CheckSkillId($SkillId,$JobGroupId) {
         $this->db->where("SkillId", $SkillId);
         $this->db->where("JobGroupId", $JobGroupId);
         $query = $this->db->get("skills");
         return $query->result();

      }

       public function CheckServiceCategoryId($ServiceCategoryId,$JobGroupId) {
           $this->db->where("ServiceCategoryId", $ServiceCategoryId);
           $this->db->where("JobGroupId", $JobGroupId);
           $query = $this->db->get("jobgroups");
           return $query->result();

       }

      public function InsertServiceInfo($ServiceData) {
          $this->db->where($ServiceData);
          $query = $this->db->get("presentedservices");
          if ($query->num_rows() >= 1)
              return $query->result();

         $this->db->insert('presentedservices', $ServiceData);
         $this->db->where($ServiceData);
         $query = $this->db->get("presentedservices");
         return $query->result();
      }

       public function InsertJobExperienceInfo($JobExperienceData) {

           $this->db->insert('jobexperiencesinfo', $JobExperienceData);

       }


      public function GetEducationalInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.educationalinfo', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.educationalinfo.MinistrantId');
         $this->db->join('omidbaseinfo.degrees', 'omidservice.educationalinfo.DegreeId = omidbaseinfo.degrees.DegreeId');
         $this->db->join('omidbaseinfo.studyfields', 'omidservice.educationalinfo.StudyFieldId = omidbaseinfo.studyfields.StudyFieldId');
         $this->db->join('omidbaseinfo.countries', 'omidservice.educationalinfo.CountryId = omidbaseinfo.countries.CountryId');

         $query = $this->db->get();
         return $query->result();
      }

      public function GetDegrees() {

         $query = $this->db->get("degrees");
         return $query->result();
      }


      public function GetDefaultEducationValues($Email) {
         $this->db->select('omidservice.ministrantpersonalinfo.MinistrantId ,DegreeId,omidservice.ministrantpersonalinfo.StateId AS MinistrantStateId,omidservice.ministrantpersonalinfo.CityId AS MinistrantCityId,omidservice.educationalinfo.StateId AS educationStateId,omidservice.educationalinfo.CityId AS educationCityId',FALSE);
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.educationalinfo', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.educationalinfo.MinistrantId');
         $this->db->order_by("omidservice.educationalinfo.StartYear", "desc");
         $this->db->limit(1);

         $query = $this->db->get();
         return $query->result();
      }

      public function InsertDeactiveInfo($DeactiveData) {

         $this->db->insert('deactiveinfo', $DeactiveData);

      }

      public function GetCooperationRequestsInfo($Email) {
         $this->db->select('*,g2j(ReqDate) AS DDate',FALSE);
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
         $this->db->join('omidbaseinfo.skills', 'omidservice.presentedservices.SkillId = omidbaseinfo.skills.SkillId');
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidbaseinfo.cooperationtypes', 'omidservice.presentedservices.CooperationTypeId = omidbaseinfo.cooperationtypes.CooperationTypeId');
         $this->db->join('omidservice.servicerequests', 'omidservice.servicerequests.ServiceId = omidservice.presentedservices.ServiceId');
         $this->db->join('omidbaseinfo.states', 'omidservice.servicerequests.ReqStateId = omidbaseinfo.states.StateId');
         $this->db->join('omidbaseinfo.cities', 'omidservice.servicerequests.ReqCityId = omidbaseinfo.cities.CityId');
         $this->db->join('omidservice.employerinfo', 'omidservice.servicerequests.EmployerId = omidservice.employerinfo.EmployerId');
         $this->db->join('omidbaseinfo.servicecategories', 'omidservice.employerinfo.ActivityId = omidbaseinfo.servicecategories.ServiceCategoryId');
         $this->db->join('omidbaseinfo.employersizes', 'omidservice.employerinfo.EmployerSizeId = omidbaseinfo.employersizes.EmployerSizeId');

          $query = $this->db->get();
         return $query->result();
      }


      public function GetMySkillsInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
         $this->db->join('omidbaseinfo.skills', 'omidservice.presentedservices.SkillId = omidbaseinfo.skills.SkillId');
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidbaseinfo.cooperationtypes', 'omidservice.presentedservices.CooperationTypeId = omidbaseinfo.cooperationtypes.CooperationTypeId');
         $this->db->join('omidservice.jobexperiencesinfo', 'omidservice.jobexperiencesinfo.ServiceId = omidservice.presentedservices.ServiceId');
         $query = $this->db->get();
         return $query->result();
      }

      public function GetTrainingInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
         $this->db->join('omidbaseinfo.skills', 'omidservice.presentedservices.SkillId = omidbaseinfo.skills.SkillId');
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidservice.traininginfo', 'omidservice.traininginfo.ServiceId = omidservice.presentedservices.ServiceId');
         $query = $this->db->get();
         return $query->result();
      }

      public function GetSoftwaresInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.presentedservices', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.presentedservices.MinistrantId');
         $this->db->join('omidbaseinfo.skills', 'omidservice.presentedservices.SkillId = omidbaseinfo.skills.SkillId');
         $this->db->join('omidbaseinfo.jobgroups', 'omidbaseinfo.skills.JobGroupId = omidbaseinfo.jobgroups.JobGroupId');
         $this->db->join('omidservice.softwaresinfo', 'omidservice.softwaresinfo.ServiceId = omidservice.presentedservices.ServiceId');
         $query = $this->db->get();
         return $query->result();
      }

      public function GetLanguagesInfo($Email) {
         $this->db->select('*');
         $this->db->from('omidservice.ministrantpersonalinfo');
         $this->db->where("omidservice.ministrantpersonalinfo.Email", $Email);
         $this->db->join('omidservice.languagesinfo', 'omidservice.ministrantpersonalinfo.MinistrantId = omidservice.languagesinfo.MinistrantId');
         $query = $this->db->get();
         return $query->result();
      }

      public function delete($StudentId) {
         if ($this->db->delete("Students", "StudentId = ".$StudentId)) {
            return true;
         }
      }


   }
?>
