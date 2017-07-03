<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/8/2017
 * Time: 12:39 PM
 */
?>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <title>Students</title>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <style>
        .body {
            margin-top: 40px;
        }
        .thumbnail {
            max-width: 200px; max-height: 150px; line-height: 20px; margin-bottom: 5px;
        }
    </style>
</head>

<body>
<div ng-app="fileUpload">
    <div  ng-controller="upload">
        <form name="f1">
        <div class="col-md-6">
            <img ng-src="<?php echo base_url('images/text.png'); ?>" class="thumbnail" ng-hide="filepreview"/>
            <img ng-src="{{filepreview}}" class="thumbnail" ng-show="filepreview"/>
        </div>
        <div class="col-md-6">
            <input type="text" ng-model="person.name" />

            <input type="file" fileinput="file" valid-file required accept="image/x-png,image/gif,image/jpeg" ng-model="person.ProfilePic" ng-if="ebook.ebook_file.st_filename == undefined" filepreview="filepreview"  ng-files="getTheFiles($files)"/>
            <button ng-click="ch()" ng-show="filepreview">Remove</button>
            <button ng-click="">ADD</button>
        </div>
        </form>

        <strong>personForm.$pristine =</strong> {{f1.$pristine}}<br />
        <strong>personForm.$valid =</strong> {{f1.$valid}}

    </div>
</div>
<script>

    var app=angular.module('fileUpload', []);
    app.controller("upload",  function($scope, $http) {
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
        var oriPerson = angular.copy($scope.person);

        $scope.ch = function() {



                $scope.person = angular.copy(oriPerson);
                $scope.f1.$setPristine();


            $scope.filepreview=false;
        });


        app.directive("fileinput", [function() {
            return {
                scope: {
                    fileinput: "=",
                    filepreview: "="
                },
                link: function(scope, element, attributes) {
                    element.bind("change", function(changeEvent) {
                        scope.fileinput = changeEvent.target.files[0];
                        var reader = new FileReader();
                        reader.onload = function(loadEvent) {
                            scope.$apply(function() {
                                scope.filepreview = loadEvent.target.result;
                            });
                        }
                        reader.readAsDataURL(scope.fileinput);
                    });
                }
            }
        }]);

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

</script>
</body>
</html>
