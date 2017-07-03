<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/11/2017
 * Time: 12:32 PM
 */
?>
<!DOCTYPE html>
<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <style>
        label
        {
            display: inline-block;
            width: 100px;
            vertical-align: middle;
        }

        input
        {
            display: inline-block;
            vertical-align: middle;
        }

        input.ng-invalid
        {
            border: solid red 2px;
        }
    </style>
</head>

<body ng-app="mainModule">
<div ng-controller="mainController">
    <form name="TestImage" id="TestImage">
        <input type="file"  name="flImage" valid-file required accept="image/x-png,image/gif,image/jpeg" ng-model="Image.file" >
        <span ng-if="TestImage.$submitted || TestImage.flImage.$touched" ng-cloak>
    <span class="text-red" ng-show="TestImage.flImage.$valid == false" ng-cloak>عکس الزامی است</span>
  </span>
        <p ng-show="Image.maxSizeError">Max file size exceeded (2000 bytes)</p>
        <button ng-click="uploadDocs()">Upload</button>
    </form>
    <form name="personForm" id="personForm" novalidate>
        <label for="firstNameEdit">First name:</label>
        <input id="firstNameEdit" type="text" name="firstName" ng-model="person.firstName" required /><br />
        <label for="lastNameEdit">Last name:</label>
        <input id="lastNameEdit" type="text" name="lastName" ng-model="person.lastName" required /><br />
        <br />
        <button type="button"
                ng-click="resetForm()"
                ng-disabled="!isPersonChanged()">Reset</button>
    </form>
    <br />
    <strong>TestImage.$pristine =</strong> {{TestImage.$pristine}}<br />
    <strong>TestImage.$untouched =</strong> {{TestImage.$untouched}}<br />
    <strong>TestImage.$valid =</strong> {{TestImage.$valid}}
</div>
<script>angular.module("mainModule", [])

        .directive('validFile', function($parse) {
            return {
                require: 'ngModel',
                restrict: 'A',
                link: function(scope, el, attrs, ngModel) {
                    var model = $parse(attrs.ngModel);
                    var modelSetter = model.assign;
                    var maxSize = 51200; //2000 B
                    el.bind('change', function() {

                        scope.$apply(function() {
                            scope.Image.maxSizeError = false;
                            if (el[0].files.length > 1) {
                                modelSetter(scope, el[0].files);
                            } else {
                                modelSetter(scope, el[0].files[0]);
                            }
                            var fileSize = el[0].files[0].size;
                            if (fileSize > maxSize) {
                                scope.Image.maxSizeError = true;
                            }
                        });
                    });
                }
            }
        })
        .controller("mainController", function ($scope)
        {
            $scope.Image = {};//scope object to hold file details
            $scope.uploadDocs = function() {
                var file = $scope.Image.file;
                console.log(file);
                document.getElementById("TestImage").reset();
            };
            $scope.person = {
                firstName: "John",
                lastName: "Doe"
            };

            var oriPerson = angular.copy($scope.person);

            $scope.resetForm = function ()
            {
                document.getElementById("personForm").reset();
            };

            $scope.isPersonChanged = function ()
            {
                return !angular.equals($scope.person, oriPerson);
            };
        });</script>
</body>
</html>
