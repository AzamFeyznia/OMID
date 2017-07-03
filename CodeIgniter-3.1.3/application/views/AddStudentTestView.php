<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2/28/2017
 * Time: 8:46 AM
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>AngularJs Post data with PHP</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>
<body>

    <div ng-app="myApp" ng-controller="myCtrl">
        <form name="f1" method="post"  enctype="multipart/form-data" >
            <table>
                <tr>
                    <td>
                        Name:
                    </td>
                    <td>
                        <input name="name" ng-model="name">
                    </td>
                </tr>
                <tr>
                    <td>
                        Family:
                    </td>
                    <td>
                        <input name="family" ng-model="family">
                    </td>
                </tr>
                <tr>
                    <td>
                        Choose File:
                    </td>
                    <td>
                        <input type="file"   name="file" multiple ng-files="getTheFiles($files)"/>
                    </td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        <button ng-click="check_credentials()">ADD</button>
                    </td>
                </tr>

            </table>
        </form>
        <p>{{codeStatus}}</p>
        <p>{{KeyStatus}}</p>
    </div>
    <script>
        var app=angular.module('myApp',[]);

        app.directive('ngFiles', ['$parse', function ($parse) {

            function fn_link(scope, element, attrs) {
                var onChange = $parse(attrs.ngFiles);
                element.on('change', function (event) {
                    onChange(scope, { $files: event.target.files });
                });
            };

            return {
                link: fn_link
            }
        } ]);


        app.controller('myCtrl',function($scope, $http) {
            var method = 'POST';
            var url = '../index.php/AddStudentTest';
            $scope.codeStatus = "";
            $scope.KeyStatus = "";
            var formdata = new FormData();
            $scope.getTheFiles = function ($files) {
                //console.log($files);
                angular.forEach($files, function (value, key) {
                    formdata.append(key, value);

                });
            };

            $scope.check_credentials = function() {

                formdata.append('name',$scope.name);
                formdata.append('family', $scope.family);

                $http({
                    method: method,
                    url: url,
                    data: formdata,
                    headers: { 'Content-Type': undefined},
                    transformRequest: angular.identity
                }).then(function success(response) {
                        $scope.codeStatus = response.data;
                    },
                    function error(response) {
                        $scope.codeStatus = response.statusText || "Request failed";
                    });

            };
        });
    </script>
</body>
</html>