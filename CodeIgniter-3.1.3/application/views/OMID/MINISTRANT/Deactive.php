<div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'>
    </script>


    <?php

        //echo validation_errors();
        echo form_error('CurrentPass');
        $attributes = array('id' => 'DeactiveForm');
        echo form_open('Ministrant/CheckDeactiveInfo',$attributes);
        echo "<div>";
        echo "<fieldset>";
        echo "<table border = '0'>";
        echo "<tr>";
        echo "<td>لطفا علت لغو عضویت را انتخاب نمایید:</td>";
        echo "<td><select name='DeactiveReason' id='DeactiveReason'>
                <option value='NOT_SELECTED'".set_select('DeactiveReason', 'NOT_SELECTED', TRUE)." >---</option>
                <option value='TEMPORARY'".  set_select('DeactiveReason', ' TEMPORARY' )." >لغو عضویت، موقت است.</option>
                <option value='MANY_MESSAGES_REQUESTS' ". set_select('DeactiveReason', 'MANY_MESSAGES_REQUESTS')." >پیامها و درخواستهای زیادی دریافت میکنم.</option>
                <option value='DONT_KNOW_HOW_USE' ". set_select('DeactiveReason', 'DONT_KNOW_HOW_USE')." >نحوه استفاده از سیستم را نمی دانم.</option>
                <option value='DONT_FIND_USEFUL' ". set_select('DeactiveReason', 'DONT_FIND_USEFUL')." >برای من مفید نبوده است.</option>
                <option value='PRIVACY_CONCERN' ". set_select('DeactiveReason', 'PRIVACY_CONCERN')." >نگران حریم شخصی ام هستم.</option>
                <option value='ACCOUNT_HACKED' ". set_select('DeactiveReason', 'ACCOUNT_HACKED')." >حساب کاربری من هک شده است.</option>
                <option value='DONT_FEEL_SAFE' ". set_select('DeactiveReason', 'DONT_FEEL_SAFE')." >احساس امنیت نمیکنم</option>
                <option value='HAVE_ANOTHER_ACCOUNT' ". set_select('DeactiveReason', 'HAVE_ANOTHER_ACCOUNT')." >حساب کاربری دیگری دارم.</option>
             

                </select></td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>توضیحات:</td>";
        echo "<td>". form_textarea(array('id'=>'Comment','name'=>'Comment'))."</td>";
        echo "<td>". form_error('DeactiveReason')." </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_button(array('name'=>'Next','content'=>'مرحله بعد','class'=>'next action-button'))."</td>";
    //form_submit(array('id'=>'Deactive','value'=>'لغو عضویت'))
        echo "</tr>";
        echo "</table>";
        echo "</fieldset>";

        echo "<fieldset>";
        echo "<table>";
        echo "<tr>";
        echo "<td>کلمه عبور :</td>";
        echo "<td>". form_password(array('id'=>'CurrentPass','name'=>'CurrentPass'))."</td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> ". form_error('CurrentPass')."</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td> </td>";
        echo "<td>". form_submit(array('name'=>'submit','value'=>'لغو عضویت','class'=>'submit action-button'))."</td>";
        //form_submit(array('id'=>'Deactive','value'=>'لغو عضویت'))
        echo "</tr>";

        echo "</table>";
        echo "</fieldset>";
        echo "</div>";
        echo form_close();



    ?>
</div>
<style>



    #DeactiveForm fieldset {

        border: 0 none;






        /*stacking fieldsets above each other*/
        position: relative;
    }
    /*Hide all except first fieldset*/
    #DeactiveForm fieldset:not(:first-of-type) {
        display: none;
    }





</style>
<script>

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function(){
        if(animating) return false;
        animating = true;

        current_fs = $(this).parent().parent().parent().parent().parent();
        //alert(current_fs);
        next_fs = $(this).parent().parent().parent().parent().parent().next();

        //activate next step on progressbar using the index of next_fs
        //$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function(now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50)+"%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale('+scale+')',
                    'position': 'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function(){
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });



    $(".submit").click(function(){
        $( "#DeactiveForm" ).submit();

    })
</script>

