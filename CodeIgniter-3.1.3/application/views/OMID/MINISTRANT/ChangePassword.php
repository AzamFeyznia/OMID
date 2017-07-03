<div>
    <?php


        //echo validation_errors();
        echo form_open('Ministrant/CheckChangedPasswordInfo');
        echo "<table border = '0'>";
        echo "<tr>";
        echo "<td>کلمه عبور فعلی:</td>";
        echo "<td>". form_password(array('id'=>'CurrentPass','name'=>'CurrentPass'))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('CurrentPass')."</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>کلمه عبور جدید:</td>";
        echo "<td>". form_password(array('id'=>'NewPass','name'=>'NewPass'))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('NewPass')."</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>تکرار کلمه عبور جدید:</td>";
        echo "<td>". form_password(array('id'=>'ConfirmNewPass','name'=>'ConfirmNewPass'))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('ConfirmNewPass')."</td>";
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