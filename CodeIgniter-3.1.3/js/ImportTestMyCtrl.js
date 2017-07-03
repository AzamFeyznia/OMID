/**
 * Created by Lenovo on 3/12/2017.
 */


app.controller('myCtrl',function($scope, $http,$rootScope) {
    //Show Students List
    $scope.ShowStudents=true;
   //For Showing/Hiding Add Student Form
    $scope.AddStu=false;
    $scope.ShowHideAdd="Click for Adding Student";


    $scope.FileName;
    $scope.ShowDownloadLink=false;

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

    $scope.testt = function() {
        $http.get("../index.php/ImportTest/ExportStudents").then(function(response){
           // $scope.FileName=response.data;
            //$scope.ShowDownloadLink=true;
            var anchor = angular.element('<a/>');

            var FileURL=document.getElementById("BaseUrl").innerHTML+"Exports/"+response.data;


            anchor.attr({
                href:FileURL ,
                target: '_blank',
                download: 'StudentList.xlsx'
            })[0].click();
        }, function(response){
            $scope.Statuss=response.statusText;
        });


    };

    $scope.exportCSV = function() {
        $http.get("../index.php/ImportTest/ExportStudentsCSV").then(function(response){
            // $scope.FileName=response.data;
            //$scope.ShowDownloadLink=true;
            var anchor = angular.element('<a/>');

            var FileURL=document.getElementById("BaseUrl").innerHTML+"Exports/"+response.data;


            anchor.attr({
                href:FileURL ,
                target: '_blank',
                download: 'StudentList.xlsx'
            })[0].click();
        }, function(response){
            $scope.Statuss=response.statusText;
        });


    };


    $scope.exportPDF = function() {
        $http.get("../index.php/ImportTest/ExportStudentsPDF").then(function(response){
            // $scope.FileName=response.data;
            //$scope.ShowDownloadLink=true;
            var anchor = angular.element('<a/>');

            var FileURL=document.getElementById("BaseUrl").innerHTML+"Exports/"+response.data;


            anchor.attr({
                href:FileURL ,
                target: '_blank',
                download: 'StudentList.xlsx'
            })[0].click();
        }, function(response){
            $scope.Statuss=response.statusText;
        });


    };

    //Show/Hide Add Student Form
    $scope.AddStudent= function(){
        $scope.AddStu=!$scope.AddStu;
        if($scope.AddStu)
            $scope.ShowHideAdd="Click for Hiding Add Student  Form ";
        else
            $scope.ShowHideAdd="Click for Adding Student";

    }




});
