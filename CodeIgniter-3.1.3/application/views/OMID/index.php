<?php

   $SessionData = $this->session->userdata('LoggedIn');

?>

<!DOCTYPE html>
<html lang = "en">

   <head>

      <title><?php echo 'امید';?> | <?php echo $PageTitle;?></title>
      <meta charset = "utf-8">
      <meta name="description" content="Job Manager- OMID " />
      <meta name="author" content="AzamFeyznia, MiladRanaei" />




   </head>

   <body dir="rtl">


<!--#EBDEF0-->
         <div style="width: 100%; overflow: hidden;background-color: #F5F3EE">
            <div style="  float: right;width: 20%;">

               <?php include $SessionData['PersonTypeId'].'/Navigation.php';?>
            </div>

             <div style="height: 165px; float: right;width: 80%;   ">

               <?php include 'Header.php';?>


               <h3 style="margin:20px 0px; color:#4A96AD; font-weight:200;">
                   <?php echo $PageTitle;?>
               </h3>


               <?php include $SessionData['PersonTypeId'].'/'.$PageName.'.php';?>

               <?php include 'footer.php';?>

            </div>

         </div>
         <?php //include 'modal.php';?>
         <?php //include 'includes_bottom.php';?>


   </body>

</html>
