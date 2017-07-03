/**
 * Created by Lenovo on 3/12/2017.
 */
var app=angular.module('myApp',[]);

//For Sending File to Server
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

//For Previewing File before Upload
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

//Check If Image File Size Is Less Than Maximum File Size or Not
app.directive('validFile', function($parse) {
    return {
        require: 'ngModel',
        restrict: 'A',
        link: function(scope, el, attrs, ngModel) {
            var model = $parse(attrs.ngModel);
            var modelSetter = model.assign;
            var maxSize = 51200; //Set Maximum File Size in Byte
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


/*
app.controller('AddCtrl', function($scope, $http,$rootScope) {

    var method = 'POST';
    var url = '../index.php/AddStudentTest';
    $scope.codeStatus = "";
    $scope.KeyStatus = "";

    $scope.Image = {};

    var formdata = new FormData();
    $scope.getTheFiles = function ($files) {

        //console.log($files);
        angular.forEach($files, function (value, key) {
            formdata.append(key, value);

        });
    };



    $scope.check_credentials = function() {

        var file = $scope.Image.file;
        console.log(file);

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
                $scope.f1.$pristine = true;

                $http.get("../index.php/AddStudentTest/GetStudents").then(function(response){
                    $rootScope.names=response.data;
                }, function(response){
                    $rootScope.Statuss=response.statusText;
                });
            },
            function error(response) {
                $scope.codeStatus = response.statusText || "Request failed";
            });



        document.getElementById("f1").reset();
        $scope.filepreview=false;

    };

    $scope.ch = function() {


        $scope.filepreview=false;
        $scope.Image.maxSizeError = false;



    };

});

*/



/*
app.controller('myCtrl',function($scope, $http,$rootScope) {
    $scope.ShowStudents=true;
    $scope.AddStu=false;
    $scope.FileIsChanged=0;
    $scope.ShowHideAdd="Click for Adding Student";

    $scope.codeStatus = "";
    $scope.KeyStatus = "";

    $scope.Image = {};




    $scope.UpdateList=function(){
        $http.get("../index.php/AddStudentTest/GetStudents").then(function(response){
            $rootScope.names=response.data;
        }, function(response){
            $scope.Statuss=response.statusText;
        });
    };
    $scope.UpdateList();

    $scope.AddStudent= function(){
        $scope.AddStu=!$scope.AddStu;
        if($scope.AddStu)
            $scope.ShowHideAdd="Click for Hiding Add Student  Form ";
        else
            $scope.ShowHideAdd="Click for Adding Student";

    }
    $scope.EditStudents=function(index){
        $scope.SelectedRow = index;

    };

    var method = 'POST';


    var formdata = new FormData();

    $scope.getTheFiles = function ($files) {
        $scope.FileIsChanged=0;
        //console.log($files);
        angular.forEach($files, function (value, key) {
            formdata.append(key, value);

        });
    };

    $scope.SaveStudents=function(Student){

        $scope.SelectedRow = -1;
        var url = '../index.php/AddStudentTest/UpdateStudents';


        formdata.append('name',Student['StudentName']);
        formdata.append('family', Student['StudentFamily']);
        formdata.append('id', Student['StudentId']);
        formdata.append('ImageName', Student['StudentImageName']);

        if(!formdata.get(0) )
            $scope.FileIsChanged=-1;
        formdata.append('FileIsChanged',  $scope.FileIsChanged);
        $scope.codeStatus=$scope.FileIsChanged;

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




    $scope.DeleteStudents=function(Student){
        var url = '../index.php/AddStudentTest/DeleteStudents';

        formdata.append('id', Student['StudentId']);
        formdata.append('ImageName', Student['StudentImageName'])


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

    $scope.RemoveImage=function(){
        $scope.FileIsChanged=-1;
        $scope.Image.maxSizeError = false;


    };







});
    */