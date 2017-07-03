<?php

$SessionData = $this->session->userdata('LoggedIn');

?>
<div id="row">
    <div id="col-md-12 col-sm-12 clearfix" style="text-align:center;">
        <h2 style="font-weight:200; margin:0px;"><?php echo 'امید';?></h2>
    </div>
    <!-- Raw Links -->
    <div id="col-md-12 col-sm-12 clearfix ">

        <ul id="list-inline links-list pull-left"
            <!-- Language Selector -->
            <li id="dropdown language-selector" >
                <!-- <a href="#" id="dropdown-toggle" data-toggle="dropdown" data-close-others="true">-->
                    <i id="entypo-user"></i> <?php if($SessionData['PersonTypeId']=='MINISTRANT') echo 'کارجو';
                                                    elseif($SessionData['PersonTypeId']=='EMPLOYER') echo 'کارفرما';
                                                    echo ", ".$SessionData['Email'];?>
                <!--  </a>-->

                <ul id="dropdown-menu <?php //if ($text_align == 'right-to-left') echo 'pull-right'; else echo 'pull-left';?>">
                    <li>
                        <a  href="<?php echo base_url();?>index.php?<?php echo $SessionData['PersonTypeId'];?>/manage_profile">
                            <i id="entypo-info"></i>
                            <span><?php echo 'ویرایش پروفایل';?></span>
                        </a>
                    </li>

                    <li>
                        <a  href="<?php echo base_url();?>index.php/Ministrant/CooperationRequests">
                            <i id="entypo-info"></i>
                            <span><?php echo 'درخواستهای همکاری با من';?></span>
                        </a>
                    </li>

                    <li>
                        <a  href="<?php echo base_url();?>index.php/<?php echo $SessionData['PersonTypeId'];?>/ChangePassword">
                            <i id="entypo-key"></i>
                            <span><?php echo 'تغییر رمز ورود';?></span>
                        </a>
                    </li>
                </ul>

            </li>
        </ul>


        <ul id="list-inline links-list pull-right" >

            <!-- Language Selector ???		-->


            <li ">
                <a href="<?php echo base_url();?>index.php/Login/Logout" >
                    خروج <i id="entypo-logout right"></i>
                </a>
            </li>
        </ul>
    </div>

</div>
<div style="border-top:1px solid ;background-color: #7D1935;height: 3px;"></div>
