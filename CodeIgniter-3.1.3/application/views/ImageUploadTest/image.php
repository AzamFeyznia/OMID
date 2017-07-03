<!DOCTYPE html>
<html>
<head>
  <title>Image</title>
  <script src="bower_components/angular/angular.min.js"></script>
  <script src="bower_components/ng-file-upload-shim/ng-file-upload-shim.min.js"></script> <!-- for no html5 browsers support -->
  <script src="bower_components/ng-file-upload-shim/ng-file-upload.min.js"></script>
  <style>
    .thumbnail {
      max-width: 200px; max-height: 150px; line-height: 20px; margin-bottom: 5px;
    }
  </style>
</head>
<body ng-app="fileUpload" ng-controller="MyCtrl">
<form name="myForm">
  <fieldset>
    <legend>Upload on form submit</legend>
    Username:
    <input type="text" name="userName" ng-model="username" size="31" required>
    <i ng-show="myForm.userName.$error.required">*required</i>
    <br>Photo:
    <input type="file" ngf-select ng-model="picFile" name="file"
           accept="image/*" ngf-max-size="2MB" required
           ngf-model-invalid="errorFile">
    <i ng-show="myForm.file.$error.required">*required</i><br>
    <i ng-show="myForm.file.$error.maxSize">File too large
      {{errorFile.size / 1000000|number:1}}MB: max 2M</i>
    <div class="thumbnail">
    <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumbnail">
    </div>
      <button ng-click="picFile = null" ng-show="picFile">Remove</button>
    <br>
    <button ng-disabled="!myForm.$valid"
            ng-click="uploadPic(picFile)">Submit</button>
    <span class="progress" ng-show="picFile.progress >= 0">
        <div style="width:{{picFile.progress}}%"
             ng-bind="picFile.progress + '%'"></div>
      </span>
    <span ng-show="picFile.result">Upload Successful</span>
    <span class="err" ng-show="errorMsg">{{errorMsg}}</span>
  </fieldset>
  <br>
</form>
<script>
  //inject angular file upload directives and services.
  var app = angular.module('fileUpload', ['ngFileUpload']);

  app.controller('MyCtrl', ['$scope', 'Upload', '$timeout', function ($scope, Upload, $timeout) {
    $scope.uploadPic = function(file) {
      file.upload = Upload.upload({
        url: 'https://angular-file-upload-cors-srv.appspot.com/upload',
        data: {username: $scope.username, file: file},
      });

      file.upload.then(function (response) {
        $timeout(function () {
          file.result = response.data;
        });
      }, function (response) {
        if (response.status > 0)
          $scope.errorMsg = response.status + ': ' + response.data;
      }, function (evt) {
        // Math.min is to fix IE which reports 200% sometimes
        file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
      });
    }
  }]);
</script>
</body>
</html>