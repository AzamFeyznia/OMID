<div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
    </script>


    <?php

    echo "<table border = '1'>";
    echo "<tr>";
    echo "<th>ردیف</th>";
    echo "<th>گروه شغلی</th>";
    echo "<th> مهارت</th>";
    echo "<th> کارفرما</th>";
    echo "<th> شهر</th>";
    echo "<th> نوع همکاری</th>";
    echo "<th> تعداد روز و ساعت کاری</th>";
    echo "<th> تسهیلات و مزایا</th>";
    echo "<th> سفرهای کاری</th>";
    echo "<th> تاریخ درخواست</th>";
    echo "<th> میزان علاقمندی شما</th>";
    echo "</tr>";
    $index=1;

    foreach($CooperationRequestsInfo as $row){

        echo "<tr>";
        echo "<td>".$index."</td>";
        echo "<td>".$row->JobGroupName."</td>";
        echo "<td>".$row->SkillName."</td>";
        echo "<td><a href='/Employer' id='Employer'>".$row->EmployerName."</a>
              <div class='messagepop pop'>
              <table border = '0'>
                  <tr>
                    <td>سال شروع فعالیت: </td>
                    <td>".$row->EstablishmentYear."</td>
                  </tr>
                  <tr>
                    <td>حوزه فعالیت: </td>
                    <td>".$row->ServiceCategoryName."</td>
                  </tr>
                  <tr>
                    <td>اندازه سازمان: </td>
                    <td>".$row->EmployerSizeTitle."</td>
                  </tr>
                  <tr>
                    <td>نوع فعالیت: </td>
                    <td>";
                        if($row->ActivityType=='EXTERNAL')
                            echo "خارجی";
                        elseif($row->ActivityType=='INTERNAL')
                            echo "داخلی";
                        else
                            echo "داخلی و خارجی";
                    echo "</td>
                  </tr>
              </table>
    
        </div></td>";
        echo "<td>".$row->StateName."- ".$row->CityName."</td>";
        echo "<td>".$row->CooperationTypeName."</td>";
        echo "<td>".$row->WorkingDayes."، ".$row->WorkingHours."</td>";
        echo "<td>".$row->FacilitiesAndBenefits."</td>";
        echo "<td>";
        if ($row->BusinessTrips=='AS_NEEDED')
            echo 'هر زمان که نیاز باشد';
        elseif ($row->BusinessTrips=='OCCASIONALLY')
            echo 'تنها در موارد خاص';
        elseif ($row->BusinessTrips=='AT_ALL')
            echo 'به هیچ وجه';
        else
            echo ' ';
        echo "</td>";
        echo "<td>".$row->DDate."</td>";
        echo "<td> </td>";
        echo "</tr>";

        $index++;

    }

    echo "</table>";
    ?>
</div>
<style>
    a.selected {
        background-color:#1F75CC;
        color:white;
        z-index:100;
    }

    .messagepop {
        background-color:#FFFFFF;
        border:1px solid #999999;
        cursor:default;
        display:none;
        margin-top: 5px;
        position:absolute;
        text-align:right;
        width:200px;
        z-index:50;
        padding: 25px 25px 20px;
    }

    label {
        display: block;
        margin-bottom: 3px;
        padding-left: 15px;
        text-indent: -15px;
    }

    .messagepop p, .messagepop.div {
        border-bottom: 1px solid #EFEFEF;
        margin: 8px 0;
        padding-bottom: 8px;
    }
</style>

<script>

    function deselect(e) {
        $('.pop').slideFadeToggle(function() {
            e.removeClass('selected');
        });
    }

    $(function() {
        $('#Employer').on('click', function() {
            if($(this).hasClass('selected')) {
                deselect($(this));
            } else {
                $(this).addClass('selected');
                $('.pop').slideFadeToggle();
            }
            return false;
        });

        $('.close').on('click', function() {
            deselect($('#Employer'));
            return false;
        });
    });

    $.fn.slideFadeToggle = function(easing, callback) {
        return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
    };
</script>

