<div>
    <?php

    echo "<table border = '0'>";
    echo form_open('Ministrant/NewEducationalInfo/');
    echo "<tr>";
    echo "<td>". form_submit(array('id'=>'New','value'=>'جدید'))."</td>";
    echo "</tr>";
    echo form_close();

    echo "<tr>";
    echo "<td>";
    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>مقطع</th>";
    echo "<th> رشته تحصیلی</th>";
    echo "<th> نام موسسه</th>";
    echo "<th> کشور</th>";
    echo "<th> سال شروع</th>";
    echo "<th> سال پایان</th>";
    echo "<th> معدل</th>";
    echo "</tr>";
    $index=1;

    foreach($EducationalInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->DegreeName."</td>";
        echo "<td>".$row->StudyFieldName."</td>";
        echo "<td>".$row->InstituteName."</td>";
        echo "<td>".$row->CountryName."</td>";
        echo "<td>".$row->StartYear."</td>";
        echo "<td>".$row->EndYear."</td>";
        echo "<td>".$row->GPA."</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    ?>
</div>

