<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/2/2017
 * Time: 7:18 PM
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
            .thumbnail {
                max-width: 200px; max-height: 150px; line-height: 20px; margin-bottom: 5px;
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
                                <div>
                                    <img ng-src="<?php echo base_url('images/text.png'); ?>" class="thumbnail" ng-hide="filepreview"/>
                                    <img ng-src="{{filepreview}}" class="thumbnail" ng-show="filepreview"/>
                                </div>
                                <div>


                                    <input type="file" fileinput="file" filepreview="filepreview" ng-files="getTheFiles($files)" accept="image/x-png,image/gif,image/jpeg" name="file" id="AddFile" valid-file required ng-model="Image.file"/>

                                    <p style="color:red" ng-show="Image.maxSizeError" ng-if="f1.file.$pristine">حجم عکس بیشتر از 2 مگابایت است.</p>
                                    <button ng-click="RemoveImage()" ng-show="filepreview" name="remove">Remove</button>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td>

                            </td>
                            <td>
                                <button ng-click="check_credentials()" ng-disabled="f1.file.$invalid || Image.maxSizeError || !filepreview">ADD</button>
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
                    <p>{{codeStatus}}</p>
                    <table border = "1" style="border-collapse: collapse; padding: 5px">
                        <tr style="background-color:#f1f1f1">
                            <th>#</th>
                            <th>Name</th>
                            <th>Family</th>
                            <th>Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                        <tr ng-repeat="x in names">

                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">{{$index+1}}</td>
                            <td ng-if="$even" style=" padding: 5px">{{$index+1}}</td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                                <label ng-hide="$index==SelectedRow" >{{x.StudentName}}</label>
                                <input name="name" ng-model="x.StudentName"  ng-show="$index==SelectedRow" >

                            </td>
                            <td ng-if="$even" style=" padding: 5px">
                                <label ng-hide="$index==SelectedRow">{{x.StudentName}}</label>
                                <input name="name" ng-model="x.StudentName"  ng-show="$index==SelectedRow">
                            </td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                                <label ng-hide="$index==SelectedRow" >{{x.StudentFamily}}</label>
                                <input name="family" ng-model="x.StudentFamily"  ng-show="$index==SelectedRow" >
                            </td>
                            <td ng-if="$even" style=" padding: 5px">
                                <label ng-hide="$index==SelectedRow" >{{x.StudentFamily}}</label>
                                <input name="family" ng-model="x.StudentFamily"  ng-show="$index==SelectedRow" >
                            </td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                                <div>
                                    <img ng-src="<?php echo base_url(''); ?>images/upload/{{x.StudentImageName}}" class="thumbnail"  ng-hide="filepreview && $index==SelectedRow" />
                                    <img ng-src="{{filepreview}}" class="thumbnail" ng-show="filepreview && $index==SelectedRow"/>
                                </div>

                                <input type="file" fileinput="file"  filepreview="filepreview" ng-files="getTheFiles($files)" accept="image/x-png,image/gif,image/jpeg" name="file" valid-file  ng-model="Image.file" ng-show="$index==SelectedRow"/>
                                <button ng-click="filepreview=false;RemoveImage();" ng-show="$index==SelectedRow" name="remove">Remove</button>
                                <p style="color:red" ng-show="Image.maxSizeError && $index==SelectedRow" ng-if="f2.file.$pristine">حجم عکس بیشتر از 2 مگابایت است.</p>
                            </td>
                            <td ng-if="$even" style=" padding: 5px">
                                <div>
                                    <img ng-src="<?php echo base_url(''); ?>images/upload/{{x.StudentImageName}}" class="thumbnail" ng-hide="filepreview && $index==SelectedRow"/>
                                    <img ng-src="{{filepreview}}" class="thumbnail" ng-show="filepreview && $index==SelectedRow"/>
                                </div>
                                <input type="file" fileinput="file" filepreview="filepreview" ng-files="getTheFiles($files)" accept="image/x-png,image/gif,image/jpeg" name="file" valid-file  ng-model="Image.file" ng-show="$index==SelectedRow"/>
                                <button ng-click="filepreview=false;RemoveImage();" ng-show="$index==SelectedRow" name="remove">Remove</button>
                                <p style="color:red" ng-show="Image.maxSizeError && $index==SelectedRow" ng-if="f2.file.$pristine">حجم عکس بیشتر از 2 مگابایت است.</p>
                            </td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">


                                <h5 ng-hide="$index==SelectedRow" ng-click="EditStudents($index)">Edit</h5>
                                <button ng-show="$index==SelectedRow" ng-disabled=" Image.maxSizeError" ng-click=" Image.maxSizeError = false;SaveStudents(x)">Save</button>
                            </td>
                            <td ng-if="$even" style=" padding: 5px">

                                <h5 ng-hide="$index==SelectedRow" ng-click="EditStudents($index)">Edit</h5>
                                <button ng-show="$index==SelectedRow" ng-disabled=" Image.maxSizeError" ng-click="Image.maxSizeError = false;SaveStudents(x)">Save</button>
                            </td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px"><h5 ng-click="DeleteStudents(x)">Delete</h5></td>
                            <td ng-if="$even" style=" padding: 5px"><h5 ng-click="DeleteStudents(x)">Delete</h5></td>

                        </tr>

                    </table>

                </form>

            </div>
        </div>

        <script src="<?php echo base_url();?>js/app.js"></script>
        <script src="<?php echo base_url();?>js/myCtrl.js"></script>
        <script src="<?php echo base_url();?>js/AddCtrl.js"></script>


    </body>

</html>

