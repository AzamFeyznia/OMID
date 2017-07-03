<div>
    <?php
    include ('jdf.php');

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>گروه شغلی</th>";
    echo "<th> مهارت</th>";
    echo "<th> میزان سابقه کاری مرتبط</th>";
    echo "</tr>";
    $index=1;

    foreach($MySkillsInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->JobGroupName."</td>";
        echo "<td>".$row->SkillName."</td>";
        echo "<td>";
        if($row->NotOverYet && $row->StartMonth && $row->StartYear){
            $row->EndMonth= jdate('n');
            $row->EndYear=jdate('y')+1300;
        }
        if($row->StartMonth && $row->StartYear && $row->EndMonth && $row->EndYear) {

            if ($row->EndMonth < $row->StartMonth) {
                $year = ($row->EndYear - $row->StartYear) - 1;
                if ($year > 0)
                    echo $year . " سال";
                $month = (12 - $row->StartMonth) + $row->EndMonth;
                if ($month > 0 && $year > 0)
                    echo " و ";
                if ($month > 0)
                    echo $month . " ماه";
            } elseif ($row->EndMonth > $row->StartMonth) {
                $year = ($row->EndYear - $row->StartYear);
                if ($year > 0)
                    echo $year . " سال";
                $month = $row->EndMonth - $row->StartMonth;
                if ($month > 0 && $year > 0)
                    echo " و ";
                if ($month > 0)
                    echo $month . " ماه";
            }
        }

        echo "</td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    ?>
</div>

