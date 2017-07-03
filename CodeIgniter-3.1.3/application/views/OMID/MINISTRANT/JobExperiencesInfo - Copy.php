<div>
    <?php
    echo "<table border = '0'>";
    echo "<tr>";
    echo "<td>";
    
    echo "</td>";
    echo "</tr>";

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>گروه شغلی</th>";
    echo "<th> مهارت</th>";
    echo "<th> کارفرما</th>";
    echo "<th> کشور</th>";
    echo "<th> شهر</th>";
    echo "<th> تاریخ شروع</th>";
    echo "<th> تاریخ پایان</th>";
    echo "</tr>";
    $index=1;

    foreach($JobExperiencesInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->JobGroupName."</td>";
        echo "<td>".$row->SkillName."</td>";
        echo "<td>".$row->EmployerName."</td>";
        echo "<td>".$row->CountryName."</td>";
        echo "<td>".$row->StateName."- ".$row->CityName."</td>";
        echo "<td>".$row->StartMonth."- ".$row->StartYear."</td>";
        echo "<td>".$row->EndMonth."- ".$row->EndYear."</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    echo "</table>";
    ?>
</div>

