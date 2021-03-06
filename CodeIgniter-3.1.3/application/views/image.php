<!DOCTYPE html>
<html ng-app="plunker">

<head>
  <meta charset="utf-8" />
  <title>AngularJS Plunker</title>
  <script>document.write('<base href="' + document.location + '" />');</script>
  <link rel="stylesheet" href="style.css" />
  <script data-require="angular.js@1.0.x" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js" data-semver="1.0.8"></script>
  <script> var app = angular.module('plunker', []); </script>
  <script src="upload.js"></script>
  <script src="app.js"></script>
</head>

<div ng-controller="UploadController ">
  <form>
    <input type="file" ng-file-select="onFileSelect($files)" >
    <!--  <input type="file" ng-file-select="onFileSelect($files)" multiple> -->

  </form>
  <b>Preview:</b><br />
  <i ng-hide="imageSrc">No image choosed</i>
  <img ng-src="{{imageSrc}}" /><br/>
  <b>Progress:</b>
  <progress value="{{progress}}"></progress>
</div>

</html>