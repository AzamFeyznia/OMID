<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>Register</title>



   </head>

   <body dir="rtl">



         <?php
            //echo validation_errors();
            echo form_open('Register/CheckInfo');
            echo "<table border = '0'>";
            echo "<tr>";
            echo "<td>ایمیل:</td>";
            echo "<td>". form_input(array('id'=>'Email','name'=>'Email', 'value'=> set_value('Email')))."</td>";
            echo "<td>". form_error('Email')."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>شماره موبایل:</td>";
            echo "<td>". form_input(array('id'=>'Mobile','name'=>'Mobile', 'value'=> set_value('Mobile')))."</td>";
            echo "<td>". form_error('Mobile')."</td>";
            echo "</tr>";


            echo "<tr>";
            echo "<td>کلمه عبور</td>";
            echo "<td>". form_password(array('id'=>'Password','name'=>'Password'))."</td>";
            echo "<td>". form_error('Password')."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td>تکرار کلمه عبور</td>";
            echo "<td>". form_password(array('id'=>'RepeatedPassword','name'=>'RepeatedPassword'))."</td>";
            echo "<td>". form_error('RepeatedPassword')."</td>";
            echo "</tr>";


            echo "<tr>";
            echo "<td>ثبت نام به عنوان:</td>";
            echo "<td><select name='AccountType'>
            <option value='MINISTRANT'".  set_select('AccountType', 'MINISTRANT', TRUE)." >کارجو</option>
            <option value='EMPLOYER' ". set_select('AccountType', 'EMPLOYER')." >کارفرما</option>
         
            </select></td>";
            echo "<td> </td>";
             echo "</tr>";

            echo "<tr>";
            echo "<td> </td>";
            echo "<td> </td>";
            echo "<td>". form_submit(array('id'=>'Register','value'=>'ثبت نام'))."</td>";
            echo "</tr>";

            echo "</table>";
            echo form_close();

         ?>


   </body>

</html>
