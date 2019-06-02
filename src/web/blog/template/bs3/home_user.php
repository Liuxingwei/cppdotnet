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
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/blog.css?version=190113">
    <script src="<?php echo $url_oj."template/$OJ_TEMPLATE/js/"?>echarts.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    	
    <div class="container" id="body">
        <div class="row row_user">
            <div class="col-lg-3">
                <div class="mod_blog">
                    <div class="photo mod_left">
                        <h4 class="user_nick" style="text-align: center;"><?php echo getNickByid($user_id);?></h4>
                        <br>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo "<p style='font-size: 12px;text-align: center;'><a style='float :left;' href='".$url_oj."modifypage.php'>修改资料</a>　<a style='float :right;' href='".$url_oj."changepassword.php'>修改密码</a></p>";
                            }
                            else {
                                echo "<p style='font-size: 12px;text-align: center;'><a href='".$url_oj."mail.php?to_user=$user_id'>私信TA</a></p>";
                            }

                            if ($user_id!="dotcpp_admin" && isset($_SESSION['administrator'])) {
                                echo "<p style='font-size: 12px;text-align: center;'><a href='".$url_oj."xktms/user_df_change.php?user_id=$user_id&getkey=".$_SESSION['getkey']."'>封禁/解封</a></p>";
                            }
                        ?>
                        <p>用户名：<?php echo $user_id;?></p>
                        <p>访问量：<?php echo $userinfo_scan;?></p>
                        <p>签　名：</p>
                        <p><?php echo $userinfo_autograph;?></p>
                    </div>
                    <!-- <?php 
                      //VIP判断
                      $now=time();

                      $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
                      $result=mysqli_query($mysqli,$sql);
                      $row=mysqli_fetch_object($result);
                      $vip_end=strtotime($row->vip_end);
                      $vip_end_date=date("Y-m-d",$vip_end);
                      if ($vip_end<$now) {
                          $vipstatus="普通用户";
                          $vipstatus_end="";
                      }
                      else {
                          $vipstatus="VIP会员";
                          $vipstatus_end="<p>到期时间：　　".$vip_end_date."</p>";
                      }
                    ?>
                    <div class="mod_left">
                        <p>用户群组：　　<?php echo $vipstatus;?></p>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo $vipstatus_end;
                                echo "<p style='font-size: 12px;text-align: center;margin-bottom: 0px;'><a style='float :left;' href='/vipjoin/'>VIP开通/续期</a>　<a style='float :right;' href='/vipmb/order_user/'>查看我的订单</a></p>";
                            }
                        ?>
                    </div> -->
                    <div class="mod_left">
                    <table class="tab_user">
                        <?php echo "<img class='img_intro' src='".$url_oj."template/$OJ_TEMPLATE/img/icon007.png'>";?>
                        <tr>
                            <td width="35%">等　　级</td>
                            <td><?php echo "<button type='button' class='btn tag_lvl ".$tag_class." btn-xs'>P".$userinfo_lvl."</button>";?></td>
                        </tr>
                        <tr>
                            <td>排　　名</td>
                            <td><?php echo $userinfo_rank;?></td>
                        </tr>
                        <tr>
                            <td>经　　验</td>
                            <td><?php echo $userinfo_exp;?></td>
                        </tr>
                        <tr>
                            <td>参赛次数</td>
                            <td><?php echo $cnt_contest;?></td>
                        </tr>
                        <tr>
                            <td>文章发表</td>
                            <td><?php echo $cnt_blog;?></td>
                        </tr>
                        <tr>
                            <td>年　　龄</td>
                            <td><?php echo $userinfo_age;?></td>
                        </tr>
                        <tr>
                            <td>在职情况</td>
                            <td><?php echo $userinfo_iswork;?></td>
                        </tr>
                        <tr>
                            <td>学　　校</td>
                            <td><?php echo $userinfo_school;?></td>
                        </tr>
                        <tr>
                            <td>专　　业</td>
                            <td><?php echo $userinfo_subject;?></td>
                        </tr>
                        <?php 
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['administrator'])) {
                        ?>
                        <tr>
                            <td>地　　址</td>
                            <td><?php echo $userinfo_address;?></td>
                        </tr>
                        <tr>
                            <td>电　　话</td>
                            <td><?php echo $userinfo_phone;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <?php 
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['user_cpn']) || isset($_SESSION['administrator'])) {
                    ?>
                    <br>
                    <!-- <p class="to_userinfo">　　<a href="<?php echo $url_oj."myvalue.php?user=$user_id";?>">我的竞争力</a></p> -->
                    <?php
                    }
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['administrator'])) {
                    ?>
                    <p><a href="<?php echo "/job/mysend/$user_id";?>">简历投递记录</a></p>
                    <?php } ?>
                    </div>
                    <div class="mod_left">
                        <p class="user_intro">　　自我简介：</p>
                        <p><?php echo $userinfo_intro;?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="mod_blog mod_c">
                    <div id="banner_user">
                        <div class="user_head user_head0">TA的成绩</div><a href="/home/blog/<?php echo $user_id;?>"><div class="user_head">TA的文章</div></a>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo "<a class='user_head1' style='float: right;' href='/blog/edit'>写新文章</a>";
                            }
                        ?>
                    </div>
                    <div class="div_content" style="padding: 20px;">
                        <div style="height: 300px;">
                        		<div class="mod_content content_l" id="pie_prob"></div>
                            <div class="mod_content content_r">
                                <table class="table table-striped">
                                    <tr>
                                        <td>排　　名</td>
                                        <td><?php echo $userinfo_rank;?></td>
                                    </tr>
                                    <tr>
                                        <td>提　　交</td>
                                        <td><?php echo $Submit;?></td>
                                    </tr>
                                    <tr>
                                        <td>正　　确</td>
                                        <td><?php echo $Right;?></td>
                                    </tr>
                                    <tr>
                                        <td>解　　决</td>
                                        <td><?php echo $AC;?></td>
                                    </tr>
                                    
                                    <!-- <tr>
                                        <td>预约次数</td>
                                        <td><?php echo $cnt_order;?></td>
                                    </tr> -->
                                    
                                    <!-- <tr>
                                        <td>评论发表</td>
                                        <td><?php echo $cnt_blogdiscuss;?></td>
                                    </tr>
                                    <tr>
                                        <td>被浏览数</td>
                                        <td><?php echo $cnt_blogscan;?></td>
                                    </tr>
                                    <tr>
                                        <td>获赞次数</td>
                                        <td><?php echo $cnt_blognice;?></td>
                                    </tr> -->
                                    
                                </table>
                            </div>
                        </div>
                        <div>
                            <p>已解决：</p>
                            <script language='javascript'>
                            function p(id){document.write("<a href='<?php echo $url_oj;?>problem"+id+".html'>"+id+" </a>");}
                            <?php
                                $sql="SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`='$user_id' AND `result`=4 ORDER BY `problem_id` ASC";
                                if (!($result=mysqli_query($mysqli,$sql))) echo mysqli_error();
                                while ($row=mysqli_fetch_array($result))
                                echo "p($row[0]);";
                                mysqli_free_result($result);
                            ?>
                            </script>
                        </div>
                    </div>
                </div>
            </div>
    	</div> <!-- /row -->
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>   
    <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/js/blog.js?v=201905061112"></script>
    <script type="text/javascript">
        $(function(){  
            home_scan("<?php echo $user_id;?>");//执行浏览统计函数
            /*//选项卡
            $("#banner_user div.user_head").click(function(){
                $(this).siblings(".user_head").removeClass("user_head0");
                $(this).addClass("user_head0");
            });
            $("#banner_user div.user_head:eq(0)").click(function(){
                $("div.div_content:eq(0)").removeClass("div_content0");
                $("div.div_content:eq(1)").addClass("div_content0");
            });
            $("#banner_user div.user_head:eq(1)").click(function(){
                $("div.div_content:eq(1)").removeClass("div_content0");
                $("div.div_content:eq(0)").addClass("div_content0");
            });*/
        });
    </script>
    <script type="text/javascript">
                var wrong = <?php echo $view_summary[5];?>+
                            <?php echo $view_summary[6];?>+
                            <?php echo $view_summary[7];?>+
                            <?php echo $view_summary[9];?>+
                            <?php echo $view_summary[10];?>+
                            <?php echo $view_summary[11];?>;
                var text_arr = [];
                var pie_arr = [];
                if (<?php echo $view_summary[4];?>!==0) {
                  text_arr.push('正确');
                  pie_arr.push({value:<?php echo $view_summary[4];?>, name:'正确'});
                }
                if (<?php echo $view_summary[5];?>!==0) {
                  text_arr.push('格式错误');
                  pie_arr.push({value:<?php echo $view_summary[5];?>, name:'格式错误'});
                }
                if (<?php echo $view_summary[6];?>!==0) {
                  text_arr.push('答案错误');
                  pie_arr.push({value:<?php echo $view_summary[6];?>, name:'答案错误'});
                }
                if (<?php echo $view_summary[7];?>!==0) {
                  text_arr.push('时间超限');
                  pie_arr.push({value:<?php echo $view_summary[7];?>, name:'时间超限'});
                }
                if (<?php echo $view_summary[9];?>!==0) {
                  text_arr.push('输出超限');
                  pie_arr.push({value:<?php echo $view_summary[9];?>, name:'输出超限'});
                }
                if (<?php echo $view_summary[10];?>!==0) {
                  text_arr.push('运行错误');
                  pie_arr.push({value:<?php echo $view_summary[10];?>, name:'运行错误'});
                }
                if (<?php echo $view_summary[11];?>!==0) {
                  text_arr.push('编译错误');
                  pie_arr.push({value:<?php echo $view_summary[11];?>, name:'编译错误'});
                }
                var myChart = echarts.init(document.getElementById('pie_prob'));
                  option = {
                      tooltip: {
                          trigger: 'item',
                          formatter: "{a} <br/>{b}: {c} ({d}%)"
                      },
                      legend: [{
                          orient: 'vertical',
                          left: 'left',
                          top: 'center',
                          data:text_arr
                      }],
                      series: [
                          {
                              name:'正确情况',
                              type:'pie',
                              selectedMode: 'single',
                              radius: [0, '40%'],

                              label: {
                                  normal: {
                                      position: 'inner'
                                  }
                              },
                              labelLine: {
                                  normal: {
                                      show: false
                                  }
                              },
                              center : ['58%', '50%'],
                              data:[
                                  {value:<?php echo $view_summary[4];?>, name:'正确'},
                                  {value:wrong, name:'错误'}
                              ]
                          },
                          {
                              name:'详细状况',
                              type:'pie',
                              radius: ['54%', '72%'],
                              center : ['58%', '50%'],
                              data:pie_arr
                          }
                      ],
                      color: ['#CC0033','#339900','#CC9900','#3366CC','#9900CC','#66CC66','#CC6600','#666699']
                  };
                  myChart.setOption(option);
                </script>
  </body>
</html>