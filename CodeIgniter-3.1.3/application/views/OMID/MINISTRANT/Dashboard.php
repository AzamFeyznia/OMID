<div id="row">
    <div id="col-md-8">
        <div id="row">
            <!-- CALENDAR-->
            <div id="col-md-12 col-xs-12">
                <div id="panel panel-primary " data-collapsed="0">
                    <div id="panel-heading">
                        <div id="panel-title">
                            <i id="fa fa-calendar"></i>
                            <?php echo 'رویدادها';?>
                        </div>
                    </div>
                    <div id="panel-body" style="padding:0px;">
                        <div id="calendar-env">
                            <div id="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="col-md-4">
        <div id="row">
            <div id="col-md-12">

                <div id="tile-stats tile-red">
                    <div id="icon"><i id="fa fa-group"></i></div>
                    <!--<div id="num" data-start="0" data-end="<?php $this->db->db_select('omidservice');
                                                                 echo $this->db->count_all('employerinfo');?>"
                         data-postfix="" data-duration="1500" data-delay="0">0</div>-->


                    <h3><?php echo 'کارفرما';?></h3>
                    <p>تعداد کل کارفرمایان
                        <?php $this->db->db_select('omidservice');
                        echo $this->db->count_all('employerinfo');?>
                    </p>
                </div>

            </div>
            <div id="col-md-12">

                <div id="tile-stats tile-green">
                    <div id="icon"><i id="entypo-users"></i></div>
                    <!--<div id="num" data-start="0" data-end="<?php $this->db->db_select('omidservice');
                                                                 echo $this->db->count_all('ministrantpersonalinfo');?>"
                         data-postfix="" data-duration="800" data-delay="0">0</div>-->

                    <h3><?php echo 'کارجو';?></h3>
                    <p>تعداد کل کارجویان
                        <?php $this->db->db_select('omidservice');
                        echo $this->db->count_all('ministrantpersonalinfo');?>
                    </p>
                </div>

            </div>

            <div id="col-md-12">

                <div id="tile-stats tile-blue">
                    <div id="icon"><i id="entypo-chart-bar"></i></div>
                    <?php
                    $this->db->db_select('omidservice');
                    $check	=	array(	'ReqDate' => date('Y-m-d') , 'Status' => '1' );
                    $query = $this->db->get_where('servicerequests' , $check);
                    $RequestToday		=	$query->num_rows();
                    ?>
                    <!--<div class="num" data-start="0" data-end="<?php echo $RequestToday;?>"
                         data-postfix="" data-duration="500" data-delay="0">0</div>-->

                    <h3><?php echo 'درخواستهای همکاری';?></h3>
                    <p>تعداد کل درخواستهای همکاری پذیرفته شده امروز
                        <?php echo $RequestToday;?>
                    </p>
                </div>

            </div>
        </div>
    </div>

</div>


<!--
<script>
    $(document).ready(function() {

        var calendar = $('#notice_calendar');

        $('#notice_calendar').fullCalendar({
            header: {
                left: 'title',
                right: 'today prev,next'
            },

            //defaultView: 'basicWeek',

            editable: false,
            firstDay: 1,
            height: 530,
            droppable: false,

            events: [
                <?php
                $notices	=	$this->db->get('servicerequests')->result_array();
                foreach($notices as $row):
                ?>
                {
                    title: "<?php echo $row['EmployerId'];?>",
                    //start: new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>),
                    //end:	new Date(<?php echo date('Y',$row['create_timestamp']);?>, <?php echo date('m',$row['create_timestamp'])-1;?>, <?php echo date('d',$row['create_timestamp']);?>)
                },
                <?php
                endforeach
                ?>

            ]
        });
    });
</script>
-->

