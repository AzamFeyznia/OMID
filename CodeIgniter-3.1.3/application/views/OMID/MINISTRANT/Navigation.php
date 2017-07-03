<div id="SidebarMenu" name="SidebarMenu">
    <header id="LogoEnv" name="LogoEnv">

        <!-- logo -->
        <div id="Logo" name="Logo" style=" ">
            <?php
                $this->db->db_select('omidservice');
                $this->db->where("Email", $SessionData['Email']);
                $Ministrant = $this->db->get("ministrantpersonalinfo")->result();
                $ImageAddress='NoPhoto.png';
                foreach ($Ministrant as $row)
                {
                    if($row->ImageName)
                    $ImageAddress= 'Ministrant/'.$SessionData['UserId'].'/Personal/'.$row->ImageName;
                }
            ?>
            <a href="<?php echo base_url();?>">
                <img src="<?php echo base_url();?>/images/OMID/<?php echo $ImageAddress;?>"  style="height:128px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div id="SidebarCollapse" name="SidebarCollapse" style="height: 33px;">
            <a href="#" id="SidebarCollapseIconWithAnimation" name="SidebarCollapseIconWithAnimation">

                <i id="EntypoMenu" name="EntypoMenu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div id="SidebarMobileMenu-VisibleXs" name="SidebarMobileMenu-VisibleXs">
            <a href="#" id="WithAnimation" name="WithAnimation">
                <i id="EntypoMenu" name="EntypoMenu"></i>
            </a>
        </div>
    </header>


    <div style="border-top:1px solid ;background-color: #7D1935;height: 3px;"></div>

    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->

        <!-- DASHBOARD -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'داشبورد';?></span>
            </a>
        </li>



        <!-- USER -->
        <li class="<?php /*if($PageName == 'UserInfo' ||
            $page_name == 'student_information' ||
            $page_name == 'student_marksheet')
            echo 'opened active has-sub';*/?> ">
            <a href="#">
                <i id="fa fa-group"></i>
                <span><?php echo'اطلاعات کاربری';?></span>
            </a>
            <ul>
                <!-- PERSONAL INFO -->
                <li class="<?php //if($PageName == 'student_add')echo 'active';?> ">
                    <a href="<?php echo base_url();?>index.php/Ministrant/PersonalInfo">
                        <span><i id="entypo-dot"></i> <?php echo 'اطلاعات فردی';?></span>
                    </a>
                </li>

                <!-- CONTACT INFO -->
                <li class="<?php //if($page_name == 'student_information')echo 'opened active';?> ">
                    <a href="<?php echo base_url();?>index.php/Ministrant/ContactInfo">
                        <span><i id="entypo-dot"></i> <?php echo 'اطلاعات تماس';?></span>
                    </a>
                </li>

                <!-- JOB EXPERIENCES -->
                <li class="<?php //if($page_name == 'student_marksheet')echo 'opened active';?> ">
                    <a href="<?php echo base_url();?>index.php/Ministrant/JobExperiencesInfo">
                        <span><i id="entypo-dot"></i> <?php echo 'تجربیات شغلی';?></span>
                    </a>

                </li>


                <!-- EDUCATIONAL INFORMATION -->
                <li class="<?php //if($page_name == 'student_marksheet')echo 'opened active';?> ">
                    <a href="<?php echo base_url();?>index.php/Ministrant/EducationalInfo">
                        <span><i id="entypo-dot"></i> <?php echo 'اطلاعات تحصیلی';?></span>
                    </a>

                </li>


                <!-- CAPABILITIES -->
                <li class="<?php //if($page_name == 'student_marksheet')echo 'opened active';?> ">
                    <a href="<?php echo base_url();?>index.php/Ministrant/Capabilities">
                        <span><i id="entypo-dot"></i> <?php echo 'توانمندی ها';?></span>
                    </a>

                </li>
            </ul>
        </li>


        <!-- MY SKILLS -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/Ministrant/MySkills">
                <i id="entypo-gauge"></i>
                <span><?php echo 'مهارتهای من';?></span>
            </a>
        </li>


        <!-- COOPERATION REQUESTS -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/Ministrant/CooperationRequests">
                <i id="entypo-gauge"></i>
                <span><?php echo 'درخواستهای همکاری با من';?></span>
            </a>
        </li>

        <!-- INTERESTS -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'علاقمندیها';?></span>
            </a>
        </li>


        <!-- INTRODUCE TO FRIENDS -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'معرفی به دوستان';?></span>
            </a>
        </li>


        <!-- DEACTIVE -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/Ministrant/Deactive">
                <i id="entypo-gauge"></i>
                <span><?php echo 'لغو عضویت';?></span>
            </a>
        </li>


        <!-- CHANGE PASSWORD -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/Ministrant/ChangePassword">
                <i id="entypo-gauge"></i>
                <span><?php echo 'تغییر رمز ورود';?></span>
            </a>
        </li>

        <!-- EXIT -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/Login/Logout">
                <i id="entypo-gauge"></i>
                <span><?php echo 'خروج';?></span>
            </a>
        </li>

    </ul>


</div>
<div id="SidebarCollapse" name="SidebarCollapse" style="height: 573px;">
    <a href="#" id="SidebarCollapseIconWithAnimation" name="SidebarCollapseIconWithAnimation">

        <i id="EntypoMenu" name="EntypoMenu"></i>
    </a>
</div>
