<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$SessionData = $this->session->userdata('LoggedIn');
     
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	
	<title>سیستم مدیریت مدرسه | داشبورد</title>
    
	<meta charset="utf-8">
	
	

	<!--//Includes Necessary Modules-->
	
</head>
<body >
        <div style="width: 100%; overflow: hidden;">
            <div style=" overflow: hidden;">
                
                    <?php include $SessionData['PersonType'].'/Menu.php';?>	
            </div>
            <div style=" overflow: hidden;">

                            <?php include 'Header.php';?>

               <h3 style="margin:20px 0px; color:#818da1; font-weight:200;">
                                    <?php echo $SessionData['PersonType']." DASHBOARD";?>
               </h3>

                            <?php include $SessionData['PersonType']."/Dashboard.php";?>

                            <?php include 'footer.php';?>

            </div>
		
        </div>
	
   <!-- //Includes Necessary Modules-->
    
</body>
</html>