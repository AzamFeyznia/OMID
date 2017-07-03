<div>
    <?php
    echo "<fieldset>";
    echo "<legend>دوره های آموزشی:</legend>";

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>گروه شغلی</th>";
    echo "<th> مهارت</th>";
    echo "<th> نام دوره</th>";
    echo "<th> سال برگزاری</th>";
    echo "<th> طول دوره</th>";
    echo "<th> برگزارکننده</th>";
    echo "<th> گواهی</th>";
    echo "</tr>";
    $index=1;

    foreach($TrainingInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->JobGroupName."</td>";
        echo "<td>".$row->SkillName."</td>";
        echo "<td>".$row->TrainingName."</td>";
        echo "<td>".$row->TrainingYear."</td>";
        echo "<td>".$row->Duration."</td>";
        echo "<td>".$row->HeldBy."</td>";
        echo "<td>".$row->Certificate."</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    echo "</fieldset>";




    echo "<fieldset>";
    echo "<legend>نرم افزار:</legend>";

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>گروه شغلی</th>";
    echo "<th> مهارت</th>";
    echo "<th> نام نرم افزار</th>";
    echo "<th> سطح تخصص</th>";
    echo "</tr>";
    $index=1;

    foreach($SoftwaresInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->JobGroupName."</td>";
        echo "<td>".$row->SkillName."</td>";
        echo "<td>".$row->SoftwareName."</td>";
        echo "<td>".$row->LevelOfExpertise."</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    echo "</fieldset>";



    echo "<fieldset>";
    echo "<legend>زبان خارجی:</legend>";

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>عنوان</th>";
    echo "<th> سطح تخصص</th>";
    echo "</tr>";
    $index=1;

    foreach($LanguagesInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->LanguageName."</td>";
        echo "<td>".$row->LevelOfExpertise."</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    echo "</fieldset>";
    ?>
</div>

