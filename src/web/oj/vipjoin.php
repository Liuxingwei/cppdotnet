<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

/*if (isset($_SESSION['user_id'])) {
    $user_id=$_SESSION['user_id'];
    //VIP判断
    $now=time();

    $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
    $result=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_object($result);
    $vip_end=strtotime($row->vip_end);
    if ($vip_end>=$now) {
        header("location:/vipstudy_c/study/");
        exit(0);
    }
    mysqli_free_result($result);
}*/

$view_title="VIP学习系统|VIP会员 - C语言网"
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title;?></title>   
    <?php include("template/$OJ_TEMPLATE/css.php");?>   
    <style type="text/css">
        .div_headbanner {
            height: 530px;
            background: url(/oj/template/bs3/img/vipjoin_banner.png) no-repeat;
            background-size: 100% 530px;
        }
        .btn_vipjoin_head {
            border: 5px solid #3769ff;
            border-radius: 50px;
            color: #FFF;
            font-size: 22px;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 40px;
            margin-left: 200px;
        }
        .btn_vipjoin_head:hover,.btn_vipjoin_head:focus {
            color: #FFF;
            text-decoration: none;
        }
        .btn_kaitong {
            border: 2px solid #FFF;
            border-radius: 50px;
            color: #FFF;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
            padding: 3px 26px;
        }
        .btn_kaitong:hover,.btn_kaitong:focus {
            color: #FFF;
            text-decoration: none;
        }
        table#tab_class_sub {
            width: 100%;
            border: 1px solid #CCC;
            background: transparent;
        }
        #tab_class_sub td {
            position: relative;
            text-align: center;
            color: #FFF;
        }
        table#taocan {
            width: 100%;
            margin-bottom: 50px;
            background: transparent;
        }
        #taocan tr {
            height: 60px;
        }
        #taocan td {
            color: #FFF;
            text-align: center;
            font-size: 16px;
            line-height: 26px;
            padding: 10px 20px;
            padding-left: 20px;
        }
        #taocan tr:nth-child(1) td {
            font-size: 18px;
            font-weight: bold;
            color: #FFF;
        }
        #taocan td:nth-child(1) {
            font-size: 18px;
            font-weight: bold;
            color: #FFF;
        }

        .right_sub {
            position: absolute;
            text-align: center;
            right: 0px;
            top: 240px;
            width: 85px;
            border: 1px solid #CCC;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .radio_right_sub {
            color: #FFF;
            font-size: 18px;
            padding: 15px;
            cursor: pointer;
        }
        .btnvip {
            margin: 10px 70px;
        }
        .text_join_descrp {
            font-size: 18px;
            font-weight: bold;
            line-height: 80px;
            /*position: relative;
            height: 0px;
            margin: 0px;
            bottom: 65px;*/
            color: #666;
            text-align: center;
            font-family: YouYuan,microsoft yahei,helvetica neue,Helvetica,Arial,sans-serif;
        }

        .textbox01 {
            padding-bottom: 50px;
            width: 60%;
            float: left;
        }
        .btnbox01 {
            float: right;
        }
        .btn_vipjoin:hover,.btn_vipjoin:visited,.btn_vipjoin:focus,.btn_vipjoin:active {
            color: #FFF;
            text-decoration: none;
        }
        .btn_vipjoin {
            margin-bottom: 45px;
            padding: 14px 0px;
            color: #FFF;
            font-size: 22px;
            font-weight: bold;
            display: block;
            height: 62px;
            width: 241px;
            text-align: center;
        }
        .btn_vipjoin01{
            background: url(/oj/template/bs3/img/anniu_10.png) no-repeat;
        }
        .btn_vipjoin02{
            background: url(/oj/template/bs3/img/anniu_20.png) no-repeat;
        }
        .btn_vipjoin03{
            background: url(/oj/template/bs3/img/anniu_30.png) no-repeat;
        }
        .btn_vipjoin04{
            margin: auto;
            padding: 26px;
            margin-top: 50px;
            height: 94px;
            width: 352px;
            background: url(/oj/template/bs3/img/anniu_40.png) no-repeat;
        }
        .dscrp_1 {
            color: #FFF;
            font-size: 40px;
            font-weight: bold;
        }
        .dscrp_2 {
            font-family: microsoft Jhenghei,microsoft yahei,helvetica neue,Helvetica,Arial,sans-serif;
            color: #FFF;
            padding: 5px;
            font-size: 18px;
            font-weight: bold;
            line-height: 25px;
        }
        img.img_dscrp {
            box-shadow: 0px 0px 30px 5px #666;
        }
        .banner00 {
            /*height: 450px;*/
            padding: 50px 20px;
        }
        .banner01 {
            background: #56d4a0;
        }
        .banner02 {
            background: #f28c8c;
        }
        .banner03 {
            background: #5a83ff;
        }
        .banner04 {
            padding: 30px 20px;
            background: url(/oj/template/bs3/img/vip_bg00.png);
        }
        .img_vip_pj {
            width: 50%;
            float: left;
        }
        .img_vip_pj img {
            width: 90%;
            margin: 5%;
        }

        div.list_cmt {
            overflow:hidden;
            height: 600px;
            width: 90%;
            margin: auto;
            box-shadow: 0px 0px 20px 10px #C0C0C0;
        }
        ul.ul_cmt {
            list-style-type: none;
            padding: 0px 15px; 
            background: #F9F9F9;
        }
        li.li_cmt {
            position: relative;
            border-top: 1px solid #e5e5e5;
            padding-left: 80px;
        }
        .div_li_cmt_left img {
            border-radius: 50%;
            width: 100%;
        }
        .div_li_cmt_left {
            position: absolute;
            left: 5px;
            padding: 10px;
            width: 60px;
        }
        .div_li_cmt_right {
            position: relative;
            padding: 10px;
            padding-top: 15px;
        }

        .radio_class {
            font-size: 24px;
            font-weight: bold;
            padding: 50px 120px 30px 120px;
            cursor: pointer;
        }
        .radio_class_selected:before {
            content: '';
            position: absolute;
            height: 5px;
            width: 20%;
            bottom: 70px;
            left: 40%;
            background: #FFF;
        }
    </style>
  </head>

  <body>
    <div class="wrap">
        <?php
            $gonggao="0";
            include("template/$OJ_TEMPLATE/nav.php");?>       
          <!-- Main component for a primary marketing message or call to action -->
        <div class="div_headbanner">
        <div class="container" style="min-width: 1170px;">
            <p style="font-size: 60px;color: #FFF;padding: 60px 0px 30px 0px;text-align: center;">C语言网VIP学习系统</p>
            <div class="textbox01">
                <div>
                <p class="dscrp_1">“名师授课,大道养成”</p>
                    <?php
                    if (!isset($_GET['subject']) || '' == $_GET['subject']) :
                    ?>
                <p class="dscrp_2" style="margin-left: 50px;">　　C语言、C++课程由十年以上编程教学、竞赛、研发经验，前ACM亚洲赛退役选手，人脸识别、云计算领域资深研发工程师黄老师亲自授课。</p>
                <p class="dscrp_2" style="margin-left: 50px;">　　算法课程由前ACM亚洲区域赛金牌退役选手郭老师亲自授课。驰骋亚洲赛多年，除了真金白银的知识干货，更有真传经验传授于你配合对应真题实时检验。</p>
                    <?php
                    elseif ('2001' == $_GET['subject'] || '1001' == $_GET['subject']) :
                    ?>
                        <p class="dscrp_2" style="margin-left: 50px;">　　黄老师：</p>
                        <p class="dscrp_2" style="margin-left: 50px;">　　近十年的C语言研究、辅导、研发经验。 高中、大学时期拥有丰富的程序竞赛经验， ACM亚洲赛退役选手。 工作期间曾就职于多家软件研发公司，涉及云计算与虚拟化、人脸识别、车联网等前沿领域的核心算法设计、C/C++研发工作。也曾兼职数家国内知名培训机构及高校实训讲师，对C/C++学习有深度理解和经验。</p>
                    <?php
                    elseif ('3001' == $_GET['subject']) :
                    ?>
                        <p class="dscrp_2" style="margin-left: 50px;">　　郭老师：</p>
                        <p class="dscrp_2" style="margin-left: 50px;">　　山东省第六界ACM程序设计竞赛金奖<br>　　2014年ACM亚洲区域赛广州赛区铜牌<br>　　2014年ACM亚洲区域赛西安赛区银牌<br>　　2015年ACM亚洲区域赛沈阳赛区银牌<br>　　2015年ACM亚洲区域赛长春赛区金牌<br>　　算法数据结构非常扎实，擅长图论及大模拟，调试纠错能力突出，目前就职于某一线互联网公司</p>
                    <?php
                    endif;
                    ?>
                    <?php
                    if (isset($_GET['ptcode'])) {
                        $ptcodeStr = $_GET['ptcode'];
                    } else {
                        $ptcodeStr = '';
                    }
                    if (!isset($_GET['subject']) && '1001' == $_GET['subject']) :
                    ?>
                    <p><a href="/vipmb/order_check/c/<?=$ptcodeStr?>" class="btn_vipjoin_head">开通续费课程</a></p>
                    <?php
                    elseif (!isset($_GET['subject']) && '2001' == $_GET['subject']) :
                    ?>
                    <p><a href="/vipmb/order_check/cpp/<?=$ptcodeStr?>" class="btn_vipjoin_head">开通续费课程</a></p>
                    <?php
                    elseif (!isset($_GET['subject']) && '3001' == $_GET['subject']) :
                    ?>
                    <p><a href="/vipmb/order_check/suanfa/<?=$ptcodeStr?>" class="btn_vipjoin_head">开通续费课程</a></p>
                    <?php
                    endif;
                    ?>
                </div>
                
            </div>
            <div class="btnbox01">
                <?php
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '1001' == $_GET['subject']) :
                ?>
                <p><a href="/vipstudy_c/study/" class="btn_vipjoin btn_vipjoin01">进入C语言课程</a></p>
                <?php
                endif;
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '2001' == $_GET['subject']) :
                ?>
                <p><a href="/vipstudy_cpp/study/" class="btn_vipjoin btn_vipjoin02">进入C++课程</a></p>
                <?php
                endif;
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '3001' == $_GET['subject']) :
                ?>
                <p><a href="/vipstudy_suanfa/study/" class="btn_vipjoin btn_vipjoin03">进入算法课程</a></p>
                <?php
                endif;
                ?>
            </div>
        </div>
        </div>
        <div style="min-height: 860px;background: #FFF;position: relative;">
<!--            <div class="right_sub">-->
<!--                <a href="/vipmb/order_check/" style="border-top-left-radius: 10px;display: block;padding: 15px;font-size: 18px;color: #828282;background: #FFF;text-decoration: none;">-->
<!--                    <img src="/oj/template/--><?php //echo $OJ_TEMPLATE;?><!--/img/right_kaitong.png">-->
<!--                    <div>开通</div>-->
<!--                </a>-->
<!--                <div class="radio_right_sub radio_right_sub1" style="background: #ffe06e;">C语言</div>-->
<!--                <div class="radio_right_sub radio_right_sub2" style="background: #fc596e;">C++</div>-->
<!--                <div class="radio_right_sub radio_right_sub3" style="background: #6b90ff;border-bottom-left-radius: 10px;">算法</div>-->
<!--            </div>-->
        <div class="container">
            <div style="min-width: 1170px;background: #5a83ff;margin-top: 70px;margin-bottom: 70px;box-shadow: 0px 0px 10px 1px #CCC;">
                <table id="tab_class_sub">
                    <tr>
                        <?php
                        require_once __DIR__ . '/include/distribution.class.php';
                        $distribution = new Distribution();
                        if (!isset($_GET['subject']) || '' == $_GET['subject'] || '1001' == $_GET['subject']) :
                        ?>
                        <td>
                            <div class="radio_class1 radio_class">C语言课程</div>
                            <div style="margin-bottom: 20px;"><a href="/vipmb/order_check/c/'<?=$ptcodeStr?>" class="btn_kaitong">开通</a>
                            <?php
                            if ('1001' == $_GET['subject'] && isset($_SESSION['user_id']) && $distribution->checkPermission($_SESSION['user_id'])) :
                            ?>
                                <a href="javascript:void(0);" style="position: absolute; right: 10px;" class="btn_kaitong create_distribution">我要分销</a>
                            <?php
                            endif;
                            ?>
                            </div>
                        </td>
                        <?php
                        endif;
                        if (!isset($_GET['subject']) || '' == $_GET['subject'] || '2001' == $_GET['subject']) :
                        ?>
                        <td>
                            <div class="radio_class2 radio_class">C++课程</div>
                            <div style="margin-bottom: 20px;"><a href="/vipmb/order_check/cpp/<?=$ptcodeStr?>" class="btn_kaitong">开通</a>
                            <?php
                            if ('2001' == $_GET['subject'] && isset($_SESSION['user_id']) && $distribution->checkPermission($_SESSION['user_id'])) :
                                ?>
                                <a href="javascript:void(0);" style="position: absolute; right: 10px;" class="btn_kaitong create_distribution">我要分销</a>
                            <?php
                            endif;
                            ?>
                            </div>
                        </td>
                        <?php
                        endif;
                        if (!isset($_GET['subject']) || '' == $_GET['subject'] || '3001' == $_GET['subject']) :
                        ?>
                        <td>
                            <div class="radio_class3 radio_class">算法课程</div>
                            <div style="margin-bottom: 20px;"><a href="/vipmb/order_check/suanfa/<?=$ptcodeStr?>" class="btn_kaitong">开通</a>
                            <?php
                            if ('3001' == $_GET['subject'] && isset($_SESSION['user_id']) && $distribution->checkPermission($_SESSION['user_id'])) :
                                ?>
                                <a href="javascript:void(0);" style="position: absolute; right: 10px;" class="btn_kaitong create_distribution">我要分销</a>
                            <?php
                            endif;
                            ?>
                            </div>
                        </td>
                        <?php
                        endif;
                        ?>
                    </tr>
                </table>
                <?php
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '1001' == $_GET['subject']) :
                ?>
                <div class="ctn_class1 ctn_class">
                    
                    <table id="taocan" border="1" bordercolor="#DDD" cellspacing="0" cellpadding="0">
                        <tr class="tr_color">
                            <td width="16%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_neirong.png">
                                <p>内容板块</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_dagang.png">
                                <p>大纲内容</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_mubiao.png">
                                <p>学习目标</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_wancheng.png">
                                <p>完成标准</p>
                            </td>
                        </tr>
                        <tr>
                            <td>标准语法</td>
                            <td>标准C语言全语法</td>
                            <td>熟练掌握C语言标准语法，可以熟练运用编写和开发C语言相关的程序、项目</td>
                            <td>在线提交并评测通过</td>
                        </tr>
                        <tr class="tr_color">
                            <td>实验与探究</td>
                            <td>C语言特性、陷阱和不为人知的现象</td>
                            <td>理解C语言底层原理，培养实验和探究的能力</td>
                            <td>上机实验</td>
                        </tr>
                        <tr>
                            <td>实际解题思路</td>
                            <td>实际问题包括蓝桥杯ACM等在内的真题讲解</td>
                            <td>提梳理思路，锻炼逻辑，分享算法</td>
                            <td>在线提交并评测通过</td>
                        </tr>
                        <tr class="tr_color">
                            <td>项目实践</td>
                            <td>期中作业、期末结课设计</td>
                            <td>从需求分析、详细设计到编码实现。学习软件工程思想，系统的掌握软件开发全周期流程。</td>
                            <td>在线提交评测、老师点评</td>
                        </tr>
                        <tr>
                            <td>扩展课</td>
                            <td>C语言外部调用API、DOS命令等扩展课程</td>
                            <td>延续C语言使用场景，培养软件开发兴趣</td>
                            <td>在线提交评测、老师点评</td>
                        </tr>
                    </table>
                </div>
                <?php
                endif;
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '2001' == $_GET['subject']) :
                ?>
                <div class="ctn_class2 ctn_class">

                    <table id="taocan" border="1" bordercolor="#DDD" cellspacing="0" cellpadding="0">
                        <tr class="tr_color">
                            <td width="16%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_neirong.png">
                                <p>内容板块</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_dagang.png">
                                <p>大纲内容</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_mubiao.png">
                                <p>学习目标</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_wancheng.png">
                                <p>完成标准</p>
                            </td>
                        </tr>
                        <tr>
                            <td>标准语法</td>
                            <td>C++标准语法</td>
                            <td>熟练C++语法，可以熟练编写各种C++程序</td>
                            <td>在线提交并通过</td>
                        </tr>
                        <tr class="tr_color">
                            <td>实验与探究</td>
                            <td>九种访问权限各种调用顺序C++特性等</td>
                            <td>了解C++特性、深度掌握面向对象特点</td>
                            <td>上机实验</td>
                        </tr>
                        <tr>
                            <td>STL库与竞赛</td>
                            <td>C++STL常用库与竞赛入门</td>
                            <td>了解并熟练使用C++的STL库，可以在蓝桥杯或ACM竞赛中熟练使用</td>
                            <td>在线提交并通过</td>
                        </tr>
                        <tr class="tr_color">
                            <td>项目实践</td>
                            <td>结课设计</td>
                            <td>锻炼软件工程思维，具备小型C++项目实践的能力</td>
                            <td>老师一对一点评</td>
                        </tr>
                    </table>
                </div>
                <?php
                endif;
                if (!isset($_GET['subject']) || '' == $_GET['subject'] || '3001' == $_GET['subject']) :
                ?>
                <div class="ctn_class3 ctn_class">

                    <table id="taocan" border="1" bordercolor="#DDD" cellspacing="0" cellpadding="0">
                        <tr class="tr_color">
                            <td width="16%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_neirong.png">
                                <p>内容板块</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_dagang.png">
                                <p>大纲内容</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_mubiao.png">
                                <p>学习目标</p>
                            </td>
                            <td width="28%">
                                <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/td_wancheng.png">
                                <p>完成标准</p>
                            </td>
                        </tr>
                        <tr>
                            <td>数据结构及算法</td>
                            <td>算法初步、各种排序算法、栈和队列、并查集、hash、树与递归、枚举贪心、BFS与DFS、分治、多种动态规划、图的存储计算、最短路问题集合、最小生成树与kruskal、欧几里得及扩展、素数与整除、bellman-ford、spfa以及堆优化、floyd、二分图最大匹配问题、欧拉回路问题、树状数组、线段树、后缀数组等等</td>
                            <td>满足蓝桥杯以及ACM竞赛全部知识点</td>
                            <td>所有知识点对应真题在线提交并通过</td>
                        </tr>
                        <tr class="tr_color">
                            <td>比赛经验</td>
                            <td>比赛经验、题目技巧、团队经验</td>
                            <td>减少失误、提高获奖率</td>
                            <td>讨论交流</td>
                        </tr>
                        <tr>
                            <td>比赛模拟</td>
                            <td>期中和期末两场全真比赛模拟</td>
                            <td>体验比赛感觉</td>
                            <td>在线评测排名</td>
                        </tr>
                    </table>
                </div>
                <?php
                endif;
                ?>
            </div>
        </div> <!-- /container -->
        <div class="banner00 banner01">
            <div class="container" style="min-width: 1170px;">
            <div style="float: left;width: 55%;">
                <p class="dscrp_1" style="margin: 15px;margin-bottom: 80px;">循序渐进，告别假编程！</p>
                <br>
                <p class="dscrp_2" style="margin-left: 20px;">以知识碎片化、最小化原则，每集仅5~10分钟，<br>分布于几十集的VIP小课之中。</p>
                <br>
                <p class="dscrp_2" style="margin-left: 0px;">随学随练，学习进度更容易把控，让你学起来更轻松、平稳，<br>循序渐进，从此告别学习编程盲目探索和不成系统。</p>
            </div>
            <div style="float: left;width: 45%;"><img style="width: 100%;" src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/pc_1.png"></div>
            </div>
        </div>
        <div class="banner00 banner02">
            <div class="container" style="min-width: 1170px;">
            <div style="float: left;width: 45%;"><img style="width: 100%;" src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/pc_2.png"></div>
            <div style="float: left;width: 55%;">
                <p class="dscrp_1" style="margin: 15px;margin-left: 80px;">看懂不算自己的，<br>　　敲出来才是自己的！</p>
                <br><br>
                <p class="dscrp_2" style="margin-left: 85px;">　　注重学生的上机编码能力，在听懂当堂课的情况下，<br>必须完成本堂课对应的习题，在线提交并且通过才可以<br>解锁下一课继续学习。</p>
                
                <p class="dscrp_2" style="margin-left: 85px;">　　除此之外，课程当中还安排了具体题库的解题思路，<br>无论是大学课程、还是参加竞赛、还是从事软件开发，<br>都让同学们完成从理论到实践的完美过度！</p>
                
                <p class="dscrp_2" style="margin-left: 85px;">　　必须会写！杜绝“假程序员”！</p>
            </div>
            </div>
        </div>
        <div class="banner00 banner03" style="color: #FFF;">
            <div class="container" style="min-width: 1170px;">
                <p class="dscrp_1" style="margin: 15px;">　知其然，并知其所以然！授人鱼，授人以渔</p>
                <br>
                <div style="float: left;width: 55%;">
                <p class="dscrp_2" style="margin-left: 0px;">　　课程不仅实战性极强，还安排了不少实验课，<br>涵盖实际开发中的真实问题、痛点问题予以实验教学，<br>鼓励并带大家亲手做实验，“折腾”程序，重现Bug。</p>
                <br>
                <p class="dscrp_2" style="margin-left: 10px;">　　让大家知其然，并知其所以然！授人鱼，并授人以渔！<br>成就真正的IT精英！</p>
                <img class="img_dscrp" style="width: 80%;margin-top: 50px;" src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_weijiesuo.png">
                </div>
                <div style="float: left;width: 45%;">
                    <img class="img_dscrp" style="width: 100%;margin-top: 80px;" src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_zuoyewancheng.png">
                    
                </div>

            </div>
        </div>

        <div class="banner00">
            <div class="container" style="min-width: 1170px;">
                <div style="height: 500px;">
                <div style="float: left;width: 50%;">
                <p class="dscrp_1" style="margin: 15px;margin-left: 50px;color: #4169e1;">学练督答，四位一体</p>
                <br>
                <div class="dscrp_2" style="margin-left: 80px;color: #4f4f4f;font-size: 26px;">
                    <div style="margin: 20px;"><img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_jiaoxue.png"> 完善的教学视频</div>
                    <div style="margin: 20px;"><img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_zuoye.png"> 配套的作业系统</div>
                    <div style="margin: 20px;"><img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_laoshi.png"> 老师跟进督促</div>
                    <div style="margin: 20px;"><img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/vip_fudao.png"> 辅导员答疑</div>
                </div>
                </div>
                <div style="float: left;width: 50%;">
                    <img style="margin-top: 50px;" src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/pcs.png">
                </div>
                </div>
                <p class="dscrp_2" style="margin: 0 50px;padding: 15px; border:2px solid #3769ff; color: #3769ff;font-weight: normal; ;font-size: 31px;text-align: center;">无论身在何处，一台电脑，一根网线，即刻开启"hello world!"</p>
                <p><a href="/vipmb/order_check/" class="btn_vipjoin btn_vipjoin04">开通课程立即进入</a></p>
            </div>
        </div>
        <div class="banner00 banner04">
            <div class="container" style="min-width: 1170px;">
            <p class="dscrp_1" style="margin: 15px;margin-left: 300px;">按时间收费，学费多少由你定！</p>
            
            <p class="dscrp_2" style="margin-left: 360px;">　　面向零基础编程爱好者，按学习时间付费，<br>平均每日学费低至两元！支持随到随学！</p>
            
            <p class="dscrp_2" style="margin-left: 360px;">　　不仅如此，学习优秀的同学，可以推荐工作，<br>学的不好的可以继续重新学习，并且免收重修费！</p>
            
            </div>
        </div>

        <div class="banner00">
            <div class="container" style="min-width: 1170px;">
                <p style="text-align: center;font-size: 24px;font-weight: bold;color: #FFF; width: 200px;padding: 10px 25px;margin: auto; margin-bottom: 35px; text-align: center; background: #4169E1;border-radius: 50px;">学 员 评 价</p>
            <div class="list_cmt">
            <ul class="ul_cmt">
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(1).jpg">
                        <p style="margin-top: 5px;">有****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲的很详细，生动！希望老师还可以更新后面的视频，辛苦老师了！</p>
                        <br>
                        <p style="color: #999;">2018-8-16</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(2).jpg">
                        <p style="margin-top: 5px;">♂****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>这系统太赞了！！！6666666666666</p>
                        <br>
                        <p style="color: #999;">2018-8-6</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(3).jpg">
                        <p style="margin-top: 5px;">努****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>师心如春，润物无声 细致如豪，抽丝剥茧 我心如痴，细嚼慢咽！</p>
                        <br>
                        <p style="color: #999;">2018-8-2</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(4).jpg">
                        <p style="margin-top: 5px;">小****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲的很详细，以前学习不理解的在这里都很容易的理解！</p>
                        <br>
                        <p style="color: #999;">2018-7-25</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(5).jpg">
                        <p style="margin-top: 5px;">奥****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>这些配套作业非常顶用，看了那么多课程都没这些题好使！老师们用心了！</p>
                        <br>
                        <p style="color: #999;">2018-7-21</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(6).jpg">
                        <p style="margin-top: 5px;">K****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲的很好，很详细，可以让人学到好多东西。</p>
                        <br>
                        <p style="color: #999;">2018-7-19</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(7).jpg">
                        <p style="margin-top: 5px;">风****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>不错！！！老师讲课非常清晰，还带有些内涵，我很喜欢。</p>
                        <br>
                        <p style="color: #999;">2018-7-18</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(8).jpg">
                        <p style="margin-top: 5px;">№****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲得挺好的，而且还有练习可以练练手很实际。</p>
                        <br>
                        <p style="color: #999;">2018-7-3</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(9).jpg">
                        <p style="margin-top: 5px;">灰****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲解很具体，由浅至深，对于我们初学者帮助很大！</p>
                        <br>
                        <p style="color: #999;">2018-6-22</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(10).jpg">
                        <p style="margin-top: 5px;">峩****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>通俗易懂，讲的很好，知识点讲的很透彻！</p>
                        <br>
                        <p style="color: #999;">2018-6-14</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(11).jpg">
                        <p style="margin-top: 5px;">念****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲老师讲的很棒 通俗易懂 适合初学者！</p>
                        <br>
                        <p style="color: #999;">2018-5-29</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(12).jpg">
                        <p style="margin-top: 5px;">一****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>老师很贴心，授课风格也很喜欢，这个学练同步系统太赞了！</p>
                        <br>
                        <p style="color: #999;">2018-5-6</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(13).jpg">
                        <p style="margin-top: 5px;">B****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>为你们的努力和坚持点赞！</p>
                        <br>
                        <p style="color: #999;">2018-4-27</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(14).jpg">
                        <p style="margin-top: 5px;">飛****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>黄老师讲的非常好，浅显，易懂。</p>
                        <br>
                        <p style="color: #999;">2018-4-13</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(15).jpg">
                        <p style="margin-top: 5px;">純****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>真的很棒!  课程浅显易懂！作业搭配科学！老师热情答疑！ </p>
                        <br>
                        <p style="color: #999;">2018-3-12</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(16).jpg">
                        <p style="margin-top: 5px;">尬****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲的太通俗易懂了，以前在学校云里雾里，现在看了这个视频就拨开云雾见天明了！</p>
                        <br>
                        <p style="color: #999;">2018-3-9</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(17).jpg">
                        <p style="margin-top: 5px;">W****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>之前不明白的这下都搞明白了，感谢老师！</p>
                        <br>
                        <p style="color: #999;">2018-2-4</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(18).jpg">
                        <p style="margin-top: 5px;">原****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>每节课基本都会有作业，非常贴心! 学完后不经意间已经有一万多行代码量了，非常棒！</p>
                        <br>
                        <p style="color: #999;">2018-1-31</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(19).jpg">
                        <p style="margin-top: 5px;">芙****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>黄老师讲的很好，很详细，对初学者的帮助非常大，易懂，还会继续支持下去！</p>
                        <br>
                        <p style="color: #999;">2018-1-28</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(20).jpg">
                        <p style="margin-top: 5px;">重****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>不能有比这个更好的学习模式了，太爽了，非常有效非常喜欢！</p>
                        <br>
                        <p style="color: #999;">2017-12-20</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(21).jpg">
                        <p style="margin-top: 5px;">诚****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>黄老师讲课很认真，而且很有意思。</p>
                        <br>
                        <p style="color: #999;">2017-12-15</p>
                    </div>
                </li>
                <li class="li_cmt">
                    <div class="div_li_cmt_left">
                        <img src="/oj/template/<?php echo $OJ_TEMPLATE;?>/img/touxiang/timg(22).jpg">
                        <p style="margin-top: 5px;">轻****</p>
                    </div>
                    <div class="div_li_cmt_right">
                        <p>讲得很贴心到位，一步步手把手教，什么也不懂的小白也能听懂！</p>
                        <br>
                        <p style="color: #999;">2017-12-6</p>
                    </div>
                </li>
            </ul>
            </div>
            </div>
        </div>
        
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">分销链接</h4>
                </div>
                <div class="modal-body">
                    <div id="success_create">
                        <div>人人分享、人人分销！<br>
                            分享给对编程感兴趣的朋友！赚取佣金,多级分销，真正躺着也能赚钱！<br>
                            点击复制链接，分享给潜在用户，赚取丰厚佣金！多级分销，躺着也有收益！还等什么？！ 复制开始分销吧!<br><br>
                            分销商交流QQ群：593370304  请备注分销账号<br>
                            收益统计请见：<a href="/oj/distribution.php">分销统计</a></div>
                        <br>
                        <div>分销链接：<span id="distribution_url"></span></div>
                    </div>
                    <div id="error_create">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>
    <!-- /wrap -->
<?php require("template/$OJ_TEMPLATE/footer.php");?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>
<script type="text/javascript">
    $(function(){
        <?php
        if (!isset($_GET['subject']) || '' == $_GET['subject'] || '2001' != $_GET['subject']) :
        ?>
        $(".ctn_class2").attr("hidden",true);
        <?php
        endif;
        if (!isset($_GET['subject']) || '' == $_GET['subject'] || '3001' != $_GET['subject']) :
        ?>
        $(".ctn_class3").attr("hidden",true);
        <?php
        endif;
        ?>
        $(".radio_class1").addClass("radio_class_selected");
        $(".radio_class1").hover(function(){
            $(".radio_class1").addClass("radio_class_selected");
            $(".radio_class2").removeClass("radio_class_selected");
            $(".radio_class3").removeClass("radio_class_selected");
            $(".ctn_class1").attr("hidden",false);
            $(".ctn_class2").attr("hidden",true);
            $(".ctn_class3").attr("hidden",true);
        });
        $(".radio_right_sub1").hover(function(){
            $(".radio_class1").addClass("radio_class_selected");
            $(".radio_class2").removeClass("radio_class_selected");
            $(".radio_class3").removeClass("radio_class_selected");
            $(".ctn_class1").attr("hidden",false);
            $(".ctn_class2").attr("hidden",true);
            $(".ctn_class3").attr("hidden",true);
        });
        
        $(".radio_class2").hover(function(){
            $(".radio_class2").addClass("radio_class_selected");
            $(".radio_class1").removeClass("radio_class_selected");
            $(".radio_class3").removeClass("radio_class_selected");
            $(".ctn_class2").attr("hidden",false);
            $(".ctn_class1").attr("hidden",true);
            $(".ctn_class3").attr("hidden",true);
        });
        $(".radio_right_sub2").hover(function(){
            $(".radio_class2").addClass("radio_class_selected");
            $(".radio_class1").removeClass("radio_class_selected");
            $(".radio_class3").removeClass("radio_class_selected");
            $(".ctn_class2").attr("hidden",false);
            $(".ctn_class1").attr("hidden",true);
            $(".ctn_class3").attr("hidden",true);
        });

        $(".radio_class3").hover(function(){
            $(".radio_class3").addClass("radio_class_selected");
            $(".radio_class2").removeClass("radio_class_selected");
            $(".radio_class1").removeClass("radio_class_selected");
            $(".ctn_class3").attr("hidden",false);
            $(".ctn_class2").attr("hidden",true);
            $(".ctn_class1").attr("hidden",true);
        });
        $(".radio_right_sub3").hover(function(){
            $(".radio_class3").addClass("radio_class_selected");
            $(".radio_class2").removeClass("radio_class_selected");
            $(".radio_class1").removeClass("radio_class_selected");
            $(".ctn_class3").attr("hidden",false);
            $(".ctn_class2").attr("hidden",true);
            $(".ctn_class1").attr("hidden",true);
        });
        $('.create_distribution').click(function () {
            var url = '/oj/ajax_distribution_create.php?subject=<?=isset($_GET['subject']) ? $_GET['subject'] : ''?>';
            <?php
            if (isset($_GET['ptcode'])) {
                echo "url += '&ptcode=" . $_GET['ptcode'] . "';";
            }
            ?>

            $.getJSON(url, function (result) {
                if ('0' != result.code) {
                    $('#error_create').show();
                    $('#error_create').text(result.message);
                    $('#success_create').hide();
                } else {
                    $('#error_create').hide();
                    $('#distribution_url').text(result.data.url);
                    $('#success_create').show()
                }
                $('#myModal').modal('show');
            });

        });
    });
</script>
<script type="text/javascript">
    (function($){
        $('')
        $.fn.myScroll = function(options){
        //默认配置
        var defaults = {
            speed:40,  //滚动速度,值越大速度越慢
            rowHeight:24 //每行的高度
        };
        
        var opts = $.extend({}, defaults, options),intId = [];
        
        function marquee(obj, step){
        
            obj.find("ul.ul_cmt").animate({
                marginTop: '-=1'
            },0,function(){
                    var s = Math.abs(parseInt($(this).css("margin-top")));
                    if(s >= step){
                        $(this).find("li.li_cmt").slice(0, 1).appendTo($(this));
                        $(this).css("margin-top", 0);
                    }
                });
            }
            
            this.each(function(i){
                var sh = opts["rowHeight"],speed = opts["speed"],_this = $(this);
                intId[i] = setInterval(function(){
                    if(_this.find("ul.ul_cmt").height()<=_this.height()){
                        clearInterval(intId[i]);
                    }else{
                        marquee(_this, sh);
                    }
                }, speed);

                _this.hover(function(){
                    clearInterval(intId[i]);
                },function(){
                    intId[i] = setInterval(function(){
                        if(_this.find("ul.ul_cmt").height()<=_this.height()){
                            clearInterval(intId[i]);
                        }else{
                            marquee(_this, sh);
                        }
                    }, speed);
                });
            
            });

        }

    })(jQuery);
</script>
<script type="text/javascript">
    $(function(){
        $("div.list_cmt").myScroll({
            speed:35, //数值越大，速度越慢
            rowHeight:105 //li的高度
        });
    });
</script>
<script>
(function(b,a,e,h,f,c,g,s){b[h]=b[h]||function(){(b[h].c=b[h].c||[]).push(arguments)};
b[h].s=!!c;g=a.getElementsByTagName(e)[0];s=a.createElement(e);
s.src="//s.union.360.cn/"+f+".js";s.defer=!0;s.async=!0;g.parentNode.insertBefore(s,g)})(window,document,"script","_qha",275548,false);
</script>
  </body>
</html>