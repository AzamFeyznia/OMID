/**
 * Created by Lenovo on 3/12/2017.
 */
var app=angular.module('myApp',[]);


app.controller('myCtrl',function($scope, $http) {


    $scope.SelectedRow = -1;
    $scope.codeStatus = "";
    $scope.StuStatus = "";


    $scope.UpdateList = function () {
        $http.get("../index.php/ChangeStudentStatusTest/GetStudents").then(function (response) {
            $scope.names = response.data;
        }, function (response) {
            $scope.codeStatus = response.statusText;
        });
    };
    $scope.UpdateList();


    $scope.stateChanged = function (Student, index) {
        $scope.SelectedRow = index;


        if(Student['Status']){
            $scope.StuStatus="فعال شد";

        }
        else {
            $scope.StuStatus="غیرفعال شد";

        }
        $scope.codeStatus =Student['Status'];

        var url = '../index.php/ChangeStudentStatusTest/UpdateStudents';
        var method = 'POST';

        $http({
            method: method,
            url: url,
            data: Student
        }).then(function success(response) {
                $scope.codeStatus = response.data;
                $scope.UpdateList();


            },
            function error(response) {
                $scope.codeStatus = response.statusText || "Request failed";
                $scope.UpdateList();

            });


    };
});