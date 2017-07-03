/**
 * Created by Lenovo on 3/12/2017.
 */

app.controller('AddCtrl', function($scope, $http,$rootScope) {
    //For Sending Data to Server
    var method = 'POST';
    var url = '../index.php/ImportTest';

    //For Testing Results
    $scope.codeStatus = "";
    $scope.KeyStatus = "";

    $scope.Image = {};

    var formdata = new FormData();

    // Adding File to FormData() Array in order to send it
    $scope.getTheFiles = function ($files) {

        //console.log($files);
        angular.forEach($files, function (value, key) {
            formdata.append(key, value);

        });
    };

    //Sending Data to Server
    $scope.check_credentials = function() {
        //Check File Size Is Lower Than Maximum Size

        var file = $scope.Image.file;
        console.log(file);


        formdata.append('maxSizeError', $scope.Image.maxSizeError);


        //Send Http Request To Controller
        $http({
            method: method,
            url: url,
            data: formdata,
            headers: { 'Content-Type': undefined},
            transformRequest: angular.identity
        }).then(function success(response) {
                $scope.codeStatus = response.data;
                $scope.f1.$pristine = true;

                //Update Student List in WebPage
                $http.get("../index.php/ImportTest/GetStudents").then(function(response){
                    $rootScope.names=response.data;
                }, function(response){
                    $rootScope.Statuss=response.statusText;
                });
            },
            function error(response) {
                $scope.codeStatus = response.statusText || "Request failed";
            });


        //Reset Form
        document.getElementById("f1").reset();

        //Reset Image Preview
        $scope.filepreview=false;

    };






});
