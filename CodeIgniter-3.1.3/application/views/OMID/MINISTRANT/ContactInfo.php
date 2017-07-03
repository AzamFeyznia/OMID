<div>
    <?php

    foreach($ContactInfo as $row){
        //echo validation_errors();
        echo form_open('Ministrant/CheckContactInfo/'.$row->MinistrantId.'/'.$row->Mobile);
        echo "<table border = '0'>";
        echo "<tr>";
        echo "<td>استان:</td>";
        echo "<td><select name='StateId' onchange='GetCity(this.value)'>
                <option value='NOT_SELECTED'".set_select('StateId', 'NOT_SELECTED', (!$row->StateId)?TRUE:False)." >---</option>
";

        foreach($States as $Srow){
            echo "<option value='".$Srow->StateId."'".  set_select('StateId', $Srow->StateId , ($row->StateId==$Srow->StateId)?TRUE:False)."</option>".$Srow->StateName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>شهر:</td>";
        echo "<td><select name='CityId' id='CityId'>
                <option value='NOT_SELECTED'".set_select('CityId', 'NOT_SELECTED', (!$row->CityId)?TRUE:False)." >---</option>
";

        foreach($Cities as $Crow){
            echo "<option value='".$Crow->CityId."'".  set_select('CityId', $Crow->CityId , ($row->CityId==$Crow->CityId)?TRUE:False)."</option>".$Crow->CityName;
        }

        echo "</select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('CityId')."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>آدرس:</td>";
        echo "<td>". form_textarea(array('id'=>'Address','name'=>'Address', 'value'=> $row->Address))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>موبایل:</td>";
        echo "<td>". form_input(array('id'=>'Mobile','name'=>'Mobile', 'value'=> $row->Mobile))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('Mobile')."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>تلفن:</td>";
        echo "<td>". form_input(array('id'=>'Phone','name'=>'Phone', 'value'=> $row->Phone))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_error('Phone')." </td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>ایمیل:</td>";
        echo "<td>". form_input(array('id'=>'Email','name'=>'Email', 'value'=> $row->Email, 'readonly'=>'true'))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_error('Email')." </td>";
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
    }


    ?>
</div>

<script>
    function GetCity(StateId)
    {
        var url = 'UpdateCities/'+ StateId;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("CityId").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();


    }
</script>