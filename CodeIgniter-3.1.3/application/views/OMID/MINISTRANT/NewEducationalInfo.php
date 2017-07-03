<div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
    </script>

    <?php

        //echo validation_errors();
        echo form_open('Ministrant/CheckNewEducationalInfo/'.$MinistrantId);
        echo "<table border = '0'>";

        echo "<tr>";
        echo "<td>مقطع:</td>";
        echo "<td><select name='DegreeId' onchange='GetStudyField(this.value)'>
                        <option value='NOT_SELECTED'".set_select('DegreeId', 'NOT_SELECTED',TRUE)." >---</option>
        ";

        foreach($Degrees as $Drow){
            echo "<option value='".$Drow->DegreeId."'".  set_select('DegreeId', $Drow->DegreeId)."</option>".$Drow->DegreeName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_error('DegreeId')." </td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>گروه شغلی:</td>";
        echo "<td><select name='JobGroupId' id='JobGroupId' onchange='GetSkill(this.value)'>
                    <option value='NOT_SELECTED'".set_select('JobGroupId', 'NOT_SELECTED', (!$DefaultJobGroupId)?TRUE:False)." >---</option>
    ";

        foreach($JobGroups as $Jrow){
            echo "<option value='".$Jrow->JobGroupId."'".  set_select('JobGroupId', $Jrow->JobGroupId , ($DefaultJobGroupId==$Jrow->JobGroupId)?TRUE:False)."</option>".$Jrow->JobGroupName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>مهارت:</td>";
        echo "<td><select name='SkillId' id='SkillId'>
                    <option value='NOT_SELECTED'".set_select('SkillId', 'NOT_SELECTED', (!$DefaultSkillId)?TRUE:False)." >---</option>
    ";

        foreach($Skills as $Skillrow){
            echo "<option value='".$Skillrow->SkillId."'".  set_select('SkillId', $Skillrow->SkillId , ($DefaultSkillId==$Skillrow->SkillId)?TRUE:False)."</option>".$Skillrow->SkillName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('SkillId')."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>کارفرما:</td>";
        echo "<td>". form_input(array('id'=>'Employer','name'=>'Employer', 'value'=> set_value('Employer')))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>تلفن:</td>";
        echo "<td>". form_input(array('id'=>'Phone','name'=>'Phone', 'value'=> set_value('Phone')))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_error('Phone')." </td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>آدرس:</td>";
        echo "<td>". form_textarea(array('id'=>'Address','name'=>'Address', 'value'=> set_value('Address')))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";



        echo "<tr>";
        echo "<td>کشور:</td>";
        echo "<td><select name='CountryId' onchange='GetState(this.value)'>
                    <option value='NOT_SELECTED'".set_select('CountryId', 'NOT_SELECTED')." >---</option>
    ";

        foreach($Countries as $Crow){
            echo "<option value='".$Crow->CountryId."'".  set_select('CountryId', $Crow->CountryId , ('ایران'==$Crow->CountryName)?TRUE:False)."</option>".$Crow->CountryName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>  ". form_error('CountryId')."</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>استان:</td>";
        echo "<td><select name='StateId' id='StateId' onchange='GetCity(this.value)'>
                <option value='NOT_SELECTED'".set_select('StateId', 'NOT_SELECTED', (!$DefaultStateId)?TRUE:False)." >---</option>
";

        foreach($States as $Srow){
            echo "<option value='".$Srow->StateId."'".  set_select('StateId', $Srow->StateId , ($DefaultStateId==$Srow->StateId)?TRUE:False)."</option>".$Srow->StateName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>شهر:</td>";
        echo "<td><select name='CityId' id='CityId'>
                <option value='NOT_SELECTED'".set_select('CityId', 'NOT_SELECTED', (!$DefaultCityId)?TRUE:False)." >---</option>
";

        foreach($Cities as $Cityrow){
            echo "<option value='".$Cityrow->CityId."'".  set_select('CityId', $Cityrow->CityId , ($DefaultCityId==$Cityrow->CityId)?TRUE:False)."</option>".$Cityrow->CityName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('CityId')."</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>تاریخ شروع:</td>";

        echo "<td><select name='StartMonth'>
                    <option value='NOT_SELECTED'".set_select('StartMonth', 'NOT_SELECTED', TRUE)." >---</option>
    ";
        for($i=1;$i<13;$i++){
            echo "<option value='".$i."'".  set_select('StartMonth', $i ,False)."</option>".$i;
        }

        echo "</select><br/>ماه</td>";

        echo "<td><select name='StartYear'>
                    <option value='NOT_SELECTED'".set_select('StartYear', 'NOT_SELECTED', TRUE)." >---</option>
    ";
        for($i=1346;$i<1396;$i++){
            echo "<option value='".$i."'".  set_select('StartYear', $i , False)."</option>".$i;
        }

        echo "</select><br/>سال</td>";
        echo "<td> </td>";
        echo "<td></td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>تاریخ پایان:</td>";

        echo "<td><select name='EndMonth'>
                        <option value='NOT_SELECTED'".set_select('EndMonth', 'NOT_SELECTED', TRUE)." >---</option>
        ";
        for($i=1;$i<13;$i++){
            echo "<option value='".$i."'".  set_select('EndMonth', $i ,False)."</option>".$i;
        }

        echo "</select><br/>ماه</td>";

        echo "<td><select name='EndYear'>
                        <option value='NOT_SELECTED'".set_select('EndYear', 'NOT_SELECTED', TRUE)." >---</option>
        ";
        for($i=1346;$i<1396;$i++){
            echo "<option value='".$i."'".  set_select('EndYear', $i , False)."</option>".$i;
        }

        echo "</select><br/>سال</td>";
        echo "<td>".form_checkbox('NotOverYet', 'accept')."در حال حاضر مشغول به فعالیت هستم.</td>";
        echo "<td>". form_error('EndYear')." </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>توضیحات:</td>";
        echo "<td>". form_textarea(array('id'=>'Comment','name'=>'Comment', 'value'=> set_value('Comment')))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


    echo "<tr>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_submit(array('id'=>'Save','value'=>'ذخیره'))."</td>";
        echo "</tr>";
        echo "</table>";
        echo form_close();



    ?>
</div>

<script>
    function GetCity(StateId)
    {
        var url = '../UpdateCities/'+ StateId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CityId").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();


    }

    function GetState(CountryId)
    {
        if(CountryId=='NOT_SELECTED'){
            document.getElementById("StateId").selectedIndex = 0;
            document.getElementById("StateId").disabled = true;

            document.getElementById("CityId").selectedIndex = 0;
            document.getElementById("CityId").disabled = true;
        }

        else{
            document.getElementById("StateId").value="<?php echo ($DefaultStateId)?$DefaultStateId:'NOT_SELECTED'; ?>";
            document.getElementById("StateId").disabled = false;

            document.getElementById("CityId").value="<?php echo ($DefaultCityId)?$DefaultCityId:'NOT_SELECTED'; ?>";
            document.getElementById("CityId").disabled = false;
        }

    }
    function GetJobGroup(ServiceCategoryId)
    {
        var url = '../UpdateJobGroups/'+ ServiceCategoryId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("JobGroupId").innerHTML = this.responseText;
                GetSkill(document.getElementById("JobGroupId").value);
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();


    }

    function GetSkill(JobGroupId)
    {
        var url = '../UpdateSkills/'+ JobGroupId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("SkillId").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();


    }

</script>