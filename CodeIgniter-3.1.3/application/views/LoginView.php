<!DOCTYPE html>
<html lang = "en">

   <head>
      <meta charset = "utf-8">
      <title>Login</title>
      <script language="JavaScript" src="md5.js"></script>


   </head>

   <body dir="rtl">

     <script type='text/javascript'>

           var hash=calcMD5("input string");
           alert(hash);
     </script>

         <?php
            echo validation_errors(); 
            echo form_open('VerifyLogin');
            echo "<table border = '0'>";
            echo "<tr>";
            echo "<td><label for='UserName'>نام کاربری</label></td>";
            echo "<td>". form_input(array('id'=>'UserName','name'=>'UserName'))."</td>";
            echo "</tr>";


            echo "<tr>";
            echo "<td><label for='Passward'>کلمه عبور</label></td>";
            echo "<td>". form_password(array('id'=>'Password','name'=>'Password'))."</td>";
            echo "</tr>";

            echo "<tr>";
            echo "<td> </td>";
            echo "<td>". form_submit(array('id'=>'submit','value'=>'ورود'))."</td>";
            echo "</tr>";

            echo "</table>";
            echo form_close();

         ?>


   </body>

</html>
