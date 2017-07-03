<div id="SidebarMenu" name="SidebarMenu">
    <header id="LogoEnv" name="LogoEnv">

        <!-- logo -->
        <div id="Logo" name="Logo" style=" ">
            <?php
                $this->db->db_select('omidservice');
                $this->db->where("Email", $SessionData['Email']);
                $Employer = $this->db->get("employerinfo")->result();
                $ImageAddress='NoPhoto.png';
                foreach ($Employer as $row)
                {
                    if($row->ImageName)
                        $ImageAddress= 'Employer/Basic/'.$row->ImageName;
                }
            ?>
            <a href="<?php echo base_url();?>">
                <img src="<?php echo base_url();?>images/OMID/<?php echo $ImageAddress;?>"  style="max-height:200px;"/>
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
            <a href="<?php echo base_url();?>index.php/EMPLOYER/Dashboard">
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
                    <a href="<?php echo base_url();?>index.php?admin/student_add">
                        <span><i id="entypo-dot"></i> <?php echo 'اطلاعات اولیه';?></span>
                    </a>
                </li>

                <!-- CONTACT INFO -->
                <li class="<?php //if($page_name == 'student_information')echo 'opened active';?> ">
                    <a href="#">
                        <span><i id="entypo-dot"></i> <?php echo 'اطلاعات تماس';?></span>
                    </a>
                </li>


            </ul>
        </li>


        <!-- MY OPPORTUNITY -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php/EMPLOYER/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'فرصتهای شغلی من';?></span>
            </a>
        </li>


        <!-- COOPERATION REQUESTS -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'درخواستهای همکاری من';?></span>
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
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'لغو عضویت';?></span>
            </a>
        </li>


        <!-- CHANGE PASSWORD -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'تغییر رمز ورود';?></span>
            </a>
        </li>

        <!-- EXIT -->
        <li class="<?php //if($PageName == 'Dashboard')echo 'active';?> ">
            <a href="<?php echo base_url();?>index.php?MINISTRANT/Dashboard">
                <i id="entypo-gauge"></i>
                <span><?php echo 'خروج';?></span>
            </a>
        </li>

    </ul>


</div>