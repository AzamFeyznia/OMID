<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/15/2017
 * Time: 2:01 PM
 */
?>
<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <title>Students</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

    <style>
        .body {
            margin-top: 40px;
        }

    </style>
</head>

<body>


<div ng-app="myApp" ng-controller="myCtrl" >



    <div  ng-controller="AddCtrl" ng-show="AddStu">

        <form name="f1" id="f1" method="post"  enctype="multipart/form-data" >
            <table>

                <tr>
                    <td>
                        Choose File:
                    </td>
                    <td>

                        <div>


                            <input type="file" fileinput="file"  ng-files="getTheFiles($files)" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  name="file" id="AddFile" valid-file required ng-model="Image.file"/>

                            <p style="color:red" ng-show="Image.maxSizeError" ng-if="f1.file.$pristine">حجم فایل بیشتر از 2 مگابایت است.</p>
                        </div>

                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                        <button ng-click="check_credentials()" ng-disabled="f1.file.$invalid || Image.maxSizeError">Import</button>
                    </td>
                </tr>


            </table>
        </form>
        <p>{{codeStatus}}</p>
        <p>{{KeyStatus}}</p>
    </div>







    <div  ng-show="ShowStudents">
        <h3 ng-click="AddStudent()" ng-bind="ShowHideAdd"></h3>
        <form name="f2" method="post"  enctype="multipart/form-data" >
            <button ng-click="testt()">Export(.xlsx)</button>
            <button ng-click="exportCSV()">Export(.csv)</button>
            <button ng-click="exportPDF()">Export(.pdf)</button>
            <label id="BaseUrl" ng-hide="true"><?php echo base_url(); ?></label>
            <p>{{codeStatus}}</p>
            <table border = "1" style="border-collapse: collapse; padding: 5px">
                <tr style="background-color:#f1f1f1">
                    <th>#</th>
                    <th>Name</th>
                    <th>Family</th>
                    <th>Image</th>

                </tr>

                <tr ng-repeat="x in names">

                    <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">{{$index+1}}</td>
                    <td ng-if="$even" style=" padding: 5px">{{$index+1}}</td>


                    <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                        <label >{{x.StudentName}}</label>


                    </td>
                    <td ng-if="$even" style=" padding: 5px">
                        <label>{{x.StudentName}}</label>

                    </td>


                    <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                        <label>{{x.StudentFamily}}</label>

                    </td>
                    <td ng-if="$even" style=" padding: 5px">
                        <label>{{x.StudentFamily}}</label>

                    </td>


                    <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                        <label >{{x.StudentImageName}}</label>

                    </td>
                    <td ng-if="$even" style=" padding: 5px">
                        <label >{{x.StudentImageName}}</label>

                    </td>


                </tr>

            </table>

        </form>

    </div>
</div>

<script src="<?php echo base_url();?>js/ImportTestApp.js"></script>
<script src="<?php echo base_url();?>js/ImportTestMyCtrl.js"></script>
<script src="<?php echo base_url();?>js/ImportTestAddCtrl.js"></script>


</body>

</html>

