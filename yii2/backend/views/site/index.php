<?php
$this->title = 'Yii2 Admin 欢迎登录';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12 col-sm-10">
        <h4 class="blue">
            <span class="middle"><i class="fa fa-desktop light-blue bigger-110"></i></span>
            系统信息
        </h4>

        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> 操作系统  </div>
                <div class="profile-info-value">
                    <span><?=$system?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 服务器软件 </div>

                <div class="profile-info-value">
                    <span><?=$server?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> MySQL版本 </div>

                <div class="profile-info-value">
                    <span><?=$mysql?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> PHP版本 </div>

                <div class="profile-info-value">
                    <span><?=$php?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Yii版本 </div>
                <div class="profile-info-value">
                    <span><?=$yii?></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> 上传文件 </div>
                <div class="profile-info-value">
                    <span><?=$upload?></span>
                </div>
            </div>
        </div>
        <div class="hr hr-8 dotted"></div>
        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-name"> 个人主页 </div>
                <div class="profile-info-value">
                    <a target="_blank" href="http://user.qzone.qq.com/821901008">http://user.qzone.qq.com/821901008</a>
                </div>
            </div>
            <div class="profile-info-row">
                <div class="profile-info-name">
                    <i class="fa fa-github-square" aria-hidden="true"></i>
                    GitHub
                </div>
                <div class="profile-info-value">
                    <a href="https://github.com/myloveGy" target="_blank">https://github.com/myloveGy</a>
                </div>
            </div>
        </div>

        <h4 class="red">
            <span class="middle"><i class="fa fa-exclamation-triangle light-red bigger-110" aria-hidden="true"></i></span>
            警告信息
        </h4>

        <div class="profile-user-info">
            <div class="profile-info-row">
                <div class="profile-info-value red">
                    <span>禁止把源码给予（或出售）第三方，会失去售后和永久更新; 如果您的网站出现问题，请记住您的操作，方便技术处理; 有任何技术或运营问题，请及时联系在线客服或是售后服务</span>
                </div>
            </div>
        </div>
    </div><!-- /.col -->

<!--    <div class="space-6"></div>-->
<!--    <div class="col-sm-7 infobox-container">-->
<!--        <div class="infobox infobox-green">-->
<!--            <div class="infobox-icon">-->
<!--                <i class="ace-icon fa fa-comments"></i>-->
<!--            </div>-->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-data-number">32</span>-->
<!--                <div class="infobox-content">comments + 2 reviews</div>-->
<!--            </div>-->
<!--            <div class="stat stat-success">8%</div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-blue">-->
<!--            <div class="infobox-icon">-->
<!--                <i class="ace-icon fa fa-twitter"></i>-->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-data-number">11</span>-->
<!--                <div class="infobox-content">new followers</div>-->
<!--            </div>-->
<!---->
<!--            <div class="badge badge-success">-->
<!--                +32%-->
<!--                <i class="ace-icon fa fa-arrow-up"></i>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-pink">-->
<!--            <div class="infobox-icon">-->
<!--                <i class="ace-icon fa fa-shopping-cart"></i>-->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-data-number">8</span>-->
<!--                <div class="infobox-content">new orders</div>-->
<!--            </div>-->
<!--            <div class="stat stat-important">4%</div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-red">-->
<!--            <div class="infobox-icon">-->
<!--                <i class="ace-icon fa fa-flask"></i>-->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-data-number">7</span>-->
<!--                <div class="infobox-content">experiments</div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-orange2">-->
<!--            <!-- #section:pages/dashboard.infobox.sparkline -->
<!--            <div class="infobox-chart">-->
<!--                <span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>-->
<!--            </div>-->
<!---->
<!--            <!-- /section:pages/dashboard.infobox.sparkline -->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-data-number">6,251</span>-->
<!--                <div class="infobox-content">pageviews</div>-->
<!--            </div>-->
<!---->
<!--            <div class="badge badge-success">-->
<!--                7.2%-->
<!--                <i class="ace-icon fa fa-arrow-up"></i>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-blue2">-->
<!--            <div class="infobox-progress">-->
<!--                <!-- #section:pages/dashboard.infobox.easypiechart -->
<!--                <div class="easy-pie-chart percentage" data-percent="42" data-size="46">-->
<!--                    <span class="percent">42</span>%-->
<!--                </div>-->
<!---->
<!--                <!-- /section:pages/dashboard.infobox.easypiechart -->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <span class="infobox-text">traffic used</span>-->
<!---->
<!--                <div class="infobox-content">-->
<!--                    <span class="bigger-110">~</span>-->
<!--                    58GB remaining-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="space-6"></div>-->
<!---->
<!--        <!-- #section:pages/dashboard.infobox.dark -->
<!--        <div class="infobox infobox-green infobox-small infobox-dark">-->
<!--            <div class="infobox-progress">-->
<!--                <!-- #section:pages/dashboard.infobox.easypiechart -->
<!--                <div class="easy-pie-chart percentage" data-percent="61" data-size="39">-->
<!--                    <span class="percent">61</span>%-->
<!--                </div>-->
<!---->
<!--                <!-- /section:pages/dashboard.infobox.easypiechart -->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <div class="infobox-content">Task</div>-->
<!--                <div class="infobox-content">Completion</div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-blue infobox-small infobox-dark">-->
<!--            <!-- #section:pages/dashboard.infobox.sparkline -->
<!--            <div class="infobox-chart">-->
<!--                <span class="sparkline" data-values="3,4,2,3,4,4,2,2"></span>-->
<!--            </div>-->
<!---->
<!--            <!-- /section:pages/dashboard.infobox.sparkline -->
<!--            <div class="infobox-data">-->
<!--                <div class="infobox-content">Earnings</div>-->
<!--                <div class="infobox-content">$32,000</div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="infobox infobox-grey infobox-small infobox-dark">-->
<!--            <div class="infobox-icon">-->
<!--                <i class="ace-icon fa fa-download"></i>-->
<!--            </div>-->
<!---->
<!--            <div class="infobox-data">-->
<!--                <div class="infobox-content">Downloads</div>-->
<!--                <div class="infobox-content">1,205</div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="vspace-12-sm"></div>-->

</div><!-- /.row -->
