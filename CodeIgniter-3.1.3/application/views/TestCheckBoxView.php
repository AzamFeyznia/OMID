<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 3/13/2017
 * Time: 12:06 PM
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


                <form name="f2" method="post" >
                    <p>{{codeStatus}}</p>
                    <table border = "1" style="border-collapse: collapse; padding: 5px">
                        <tr style="background-color:#f1f1f1">
                            <th>#</th>
                            <th>Name</th>
                            <th>Family</th>
                            <th>Active/Deactive</th>
                        </tr>

                        <tr ng-repeat="x in names track by $index">

                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">{{$index+1}}</td>
                            <td ng-if="$even" style=" padding: 5px">{{$index+1}}</td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                                {{x.StudentName}}

                            </td>
                            <td ng-if="$even" style=" padding: 5px">
                                {{x.StudentName}}

                            </td>


                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">
                               {{x.StudentFamily}}

                            </td>
                            <td ng-if="$even" style=" padding: 5px">
                                {{x.StudentFamily}}
                            </td>

                            <td ng-if="$odd" style="background-color:#f1f1f1; padding: 5px">

                                <input type="checkbox" ng-model="x.Status" name="status"  ng-click="stateChanged(x,$index)"/>
                                <label>فعال</label>
                                <h3 ng-show="$index==SelectedRow">{{StuStatus}}</h3>


                            </td>
                            <td ng-if="$even" style=" padding: 5px">

                                <input type="checkbox" ng-model="x.Status" name="status"  ng-click="stateChanged(x,$index)"/>
                                <label>فعال</label>
                                <h3 ng-show="$index==SelectedRow">{{StuStatus}}</h3>

                            </td>


                        </tr>

                    </table>

                </form>


        </div>

        <script src="<?php echo base_url();?>js/CheckBoxApp.js"></script>


    </body>

</html>

