/**
 * Created by Lenovo on 3/12/2017.
 */


app.controller('myCtrl',function($scope, $http,$rootScope) {
    //Show Students List
    $scope.ShowStudents=true;
   //For Showing/Hiding Add Student Form
    $scope.AddStu=false;
    $scope.ShowHideAdd="Click for Adding Student";

    //For Editing Image File
    $scope.FileIsChanged=0;

    //For Testing Results
    $scope.codeStatus = "";
    $scope.KeyStatus = "";

    //
    $scope.Image = {};

    //For Sending Data to Server
    var method = 'POST';
    var formdata = new FormData();

    //Update Student List in WebPage According to DataBase Records
    $scope.UpdateList=function(){
        $http.get("../index.php/AddStudentTest/GetStudents").then(function(response){
            $rootScope.names=response.data;
        }, function(response){
            $scope.Statuss=response.statusText;
        });
    };

    $scope.UpdateList();

    //Show/Hide Add Student Form
    $scope.AddStudent= function(){
        $scope.AddStu=!$scope.AddStu;
        if($scope.AddStu)
            $scope.ShowHideAdd="Click for Hiding Add Student  Form ";
        else
            $scope.ShowHideAdd="Click for Adding Student";

    }

    //Specify Which Row Must be Edited
    $scope.EditStudents=function(index){
        $scope.SelectedRow = index;

    };

    //Add File to FormData Array to Send it
    $scope.getTheFiles = function ($files) {
        $scope.FileIsChanged=0;
        //console.log($files);
        angular.forEach($files, function (value, key) {
            formdata.append(key, value);

        });
    };

    //Send Data to Controller and Save Edits to DataBase
    $scope.SaveStudents=function(Student){

        //Reset SelectedRow
        $scope.SelectedRow = -1;

        //Controller Address
        var url = '../index.php/AddStudentTest/UpdateStudents';

        //Add Data to FormData Array
        formdata.append('name',Student['StudentName']);
        formdata.append('family', Student['StudentFamily']);
        formdata.append('id', Student['StudentId']);
        formdata.append('ImageName', Student['StudentImageName']);


        //Check If File Is Edited Or Not
        if(!formdata.get(0) )
            $scope.FileIsChanged=-1;

        //Add Data to FormData Array
        formdata.append('FileIsChanged',  $scope.FileIsChanged);

        //Send Http Request to Controller
        $http({
            method: method,
            url: url,
            data: formdata,
            headers: { 'Content-Type': undefined},
            transformRequest: angular.identity
        }).then(function success(response) {
                $scope.codeStatus = response.data;
                $scope.UpdateList();

            },
            function error(response) {
                $scope.codeStatus = response.statusText || "Request failed";
                $scope.UpdateList();

            });

    };


    //Delete Student
    $scope.DeleteStudents=function(Student){
        //Controller Address
        var url = '../index.php/AddStudentTest/DeleteStudents';

        //Add Data to FormData Array
        formdata.append('id', Student['StudentId']);
        formdata.append('ImageName', Student['StudentImageName'])

        //Send Http Request to Controller
        $http({
            method: method,
            url: url,
            data: formdata,
            headers: { 'Content-Type': undefined},
            transformRequest: angular.identity
        }).then(function success(response) {
                $scope.codeStatus = response.data;
                $scope.UpdateList();
            },
            function error(response) {
                $scope.codeStatus = response.statusText || "Request failed";
            });

    };

    //Remove Image in Edit Mode
    $scope.RemoveImage=function(){
        $scope.FileIsChanged=-1;
        $scope.Image.maxSizeError = false;


    };

});
