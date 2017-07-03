<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>Login</title>



   </head>

   <body dir="rtl">



         <?php
            //echo validation_errors();
            echo form_error('AccountType');
            echo form_open('Login/CheckInfo');
            echo "<table border = '0'>";
            echo "<tr>";
            echo "<td>ایمیل:</td>";
            echo "<td>". form_input(array('id'=>'Email','name'=>'Email', 'value'=> set_value('Email')))."</td>";
            echo "<td>". form_error('Email')."</td>";
            echo "</tr>";



            echo "<tr>";
            echo "<td>کلمه عبور</td>";
            echo "<td>". form_password(array('id'=>'Password','name'=>'Password'))."</td>";
            echo "<td>". form_error('Password')."</td>";
            echo "</tr>";


            echo "<tr>";
            echo "<td>ورود به عنوان:</td>";
            echo "<td><select name='AccountType'>
            <option value='MINISTRANT'".  set_select('AccountType', 'MINISTRANT', TRUE)." >کارجو</option>
            <option value='EMPLOYER' ". set_select('AccountType', 'EMPLOYER')." >کارفرما</option>
         
            </select></td>";
            echo "<td> </td>";
             echo "</tr>";

            echo "<tr>";
            echo "<td> </td>";
            echo "<td> </td>";
            echo "<td>". form_submit(array('id'=>'Login','value'=>'ورود'))."</td>";
            echo "</tr>";

            echo "</table>";
            echo form_close();

         ?>


   </body>

</html>
