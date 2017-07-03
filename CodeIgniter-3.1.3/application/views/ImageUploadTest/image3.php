<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/5/2017
 * Time: 11:45 AM
 */
?>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <title>Students</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body ng-app="myApp" ng-controller="Ctrl">
<form name="TestImage">
<input type="file"  name="flImage" valid-file required accept="image/x-png,image/gif,image/jpeg" ng-model="Image.file" >
<span ng-if="TestImage.$submitted || TestImage.flImage.$touched" ng-cloak>
    <span class="text-red" ng-show="TestImage.flImage.$valid == false" ng-cloak>عکس الزامی است</span>
  </span>
<p ng-show="Image.maxSizeError">Max file size exceeded (2000 bytes)</p>
<button ng-click="uploadDocs()">Upload</button>
</form>

<script>

    angular.module('myApp', [])

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
        .controller('Ctrl', ['$scope', function($scope) {
            $scope.Image = {};//scope object to hold file details
            $scope.uploadDocs = function() {
                var file = $scope.Image.file;
                console.log(file);
            };
        }]);
</script>
</body>
</html>
