<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title;?></title>   
    <?php include("template/$OJ_TEMPLATE/css.php");?> 
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/vipclass.css">   
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/class_step/css/class_step.css"> 
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/accordion.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .vhead {
        display: inline-block;
        padding: 5px 15px;
        font-size: 20px;
        color: #666;
      }
      .vhead0 {
        color: #333;
        font-weight: bolder;
      }
      .div_content0 {
        display: none;
      }

      .hard_label {
        font-size: 14px;
        padding: 3px 6px;
      }
      .img_quest {
        vertical-align: bottom;
        width: 22px;
        height: 22px;
      }
      .text_quest {
        font-size: 16px;
        color: #666;
        background: #efefef;
        border: 1px solid #ddd;
        padding: 5px;
      }
      .content_r{
        border-radius: 0px;
        border: 1px solid #ddd;
        box-shadow: 0px 0px 10px 3px #ccc;
      }

      .a_link {
        color: #FFF;
        font-weight: bold;
        text-decoration: none;
      }
      .a_link:hover,.a_link:visited,.a_link:active,.a_link:focus {
        color: #FFF;
        text-decoration: none;
      }

    </style>
  </head>

  <body>
    <div class="wrap class_bg" style="min-width: 1360px;">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>     
      <!-- Main component for a primary marketing message or call to action -->
      
    <div class="container" id="body" style="width: 1360px;">

      <div class="col-xs-3" style="width: 21.5%;">
        <div class="content_box content_l">
          <?php include("template/$OJ_TEMPLATE/inc_vip_".$subject_vip."_temp.php");?> 
            
        </div>
      </div>
      
      <div class="col-xs-9" style="width: 64.2666667%;">
        <div class="content_box content_r">
            <div>
              <div class="class_head"></div>
              <p style="text-align: left;font-weight: bold;padding: 20px 30px;margin: 0px; color: #999;font-size: 18px;">
              <?php 
                  echo $text_subject." - ".$title;
              ?>
                <a class="rlink" href="/oj/myvalue.php?user=<?php echo $user_id;?>" style="float: right;">
                  <button class="btn btn-primary" style="border-radius: 0px;position: relative;bottom: 3px;">我的学习成果</button>
                </a>
              </p>
            </div>
          <div class="content" style="padding: 0px 20px;margin-top: 0px;">

              <div id="step_script" class="class_content">
                  <?php 
                    if ($locked!=0) {
                      echo "<h4>您尚未解锁本课，请完成上一课习题进行解锁！</h4>";
                    } 
                    else {
                  ?>

                  <div class="step">
                      <div class="step_top">
                        <ul>
                            <a href="javascript:void(0);" class="tab_step1"><li class="on" style="border-left: 1px solid #ddd;">1、课程概述</li></a>
                            <a href="javascript:void(0);" class="tab_step2"><li>2、视频讲解</li></a>
                            <a href="javascript:void(0);" class="tab_step3"><li>3、课后习题</li></a>
                          </ul>
                      </div>
                      <div class="step_content">
                          <div class="ctbig">
                              <div class="step1" >
                                  <?php $descrp = preg_replace('/\n/','<br>',$descrp); ?>
                                  <div class="div_content">
                                    <div class="class_descrp"><?php echo $descrp;?></div>
                                  </div>
                              </div>
                              <div  class="step2">
                                  <div class="div_content">

                                      <div class="video" id="CuPlayer">
                                        <script type="text/javascript">
                                        <!--
                                        var vID        = "c1";                   //vID
                                        var vWidth     = "780";                  //宽度设定，配合CSS实现
                                        var vHeight    = "450";                  //高度设定，配合CSS实现
                                        var vFile      = "/player/CuSunV4set.xml";       //配置文件地址:支持五种广告设定
                                        var vPlayer    = "/player/player.swf?v=4.0";     //播放器文件地址
                                        var vPic       = "/player/images/Cyuyan.jpg";        //视频缩略图
                                        var vCssurl    = "/player/css/videos.min.css";   //CSS文件
                                        var vAutoPlay  = "no";                  //是否自动播放
                                        var vEndTime   = 0;                      //预览时间(秒数),默认为0
                                        /*var vLogoPath  = "images/logo.png";      //Logo地址*/
                                        var vPlayMod   = 0;                      //播放模式优先级,默认=0,html5优先=1,flash优先=2
                                        var vMp4url    = "<?php echo $video;?>";//视频文件地址推荐用mp4文件(h264编码)
                                        //-->
                                        </script>
                                        <script class="CuPlayerVideo" data-mce-role="CuPlayerVideo" type="text/javascript" src="/player/js/player.min.js"></script>
                                      </div>

                                  </div>
                              </div>
                              <div  class="step3">
                                  <div class="div_content">
                                    <!-- 解锁下一课 -->
                                    <?php 
                                      echo $alert_quest;
                                    ?>
                                    <table id='problemset' class='table table-striped table_style_new' style="border: 1px solid #DDD;">
                                      <thead>
                                          <tr class='toprow' style="background: #F5F5F5;color: #666;">
                                              <th>题　目</th>
                                              <th width='50'></th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      $cnt=0;
                                      foreach($view_problemset as $row){
                                          if ($cnt)
                                              echo "<tr class='oddrow'>";
                                          else
                                              echo "<tr class='evenrow'>";
                                          foreach($row as $table_cell){
                                              echo "<td>";
                                              echo $table_cell;
                                              echo "</td>";
                                          }
                                          echo "</tr>";
                                          $cnt=1-$cnt;
                                      }
                                      ?>
                                      </tbody>
                                    </table>

                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <?php } ?>
              </div>
          </div>

          <!-- <div class="div_box_body1">
            <p>C语言网在线学习系统 - 第<?php echo $class;?>课</p>
          </div>
          <div class="div_box_body1">
            <div class="vhead vhead0">课程概述</div>>
            <div class="vhead">视频讲解</div>>
            <div class="vhead">课后习题</div>
          </div>
          <div class="div_content" style="margin: auto;margin-bottom: 20px; width: 95%;background: #F5F5F5">这里是课程描述<br><?php echo $descrp;?></div>
          <div class="div_content div_content0" style="margin: auto;margin-bottom: 20px; width: 95%;">

            <div class="flowplayer" data-swf="/oj/flowplayer/flowplayer.swf" data-ratio="0.4167">
              <video>
                 <source type="video/mp4" src="/oj/vip_video/003.mp4">
              </video>
           </div>

          </div>
          <div class="div_content div_content0" style="margin: auto;width: 95%;">
            <table id='problemset' class='table table-striped table_style_new'>
              <thead>
                  <tr class='toprow'>
                      <th width='50'></th>
                      <th>题　目</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $cnt=0;
              foreach($view_problemset as $row){
                  if ($cnt)
                      echo "<tr class='oddrow'>";
                  else
                      echo "<tr class='evenrow'>";
                  foreach($row as $table_cell){
                      echo "<td>";
                      echo $table_cell;
                      echo "</td>";
                  }
                  echo "</tr>";
                  $cnt=1-$cnt;
              }
              ?>
              </tbody>
            </table>
          </div> -->
        </div>
        <?php if(isset($_SESSION['administrator'])){ ?>
          <div id="classmodify">
            <a href="/oj/vipclass_modify.php?class=<?php echo $class;?>"><button class="btn btn-primary">编辑本课</button></a>
            <a href="/oj/vipclass_add.php"><button class="btn btn-primary">添加课程</button></a>
          </div>
        <?php } ?>
      </div>
      <div class="col-xs-2" style="width: 14.2333333%;">
          <div class="content_box content_r content_rr">
            <div style="padding: 15px;border-bottom: 1px solid #CCC;">
              <p style="text-align: center;font-size: 16px;">VIP学习系统<br><?php echo $text_subject;?><br>使用期至</p>
              <p style="text-align: center;font-weight: bold;"><?php echo $vip_end_date;?></p>
              <p style='font-size: 12px;text-align: center;margin-bottom: 0px;'><a style='float :left;' href='/vipmb/order_check/'>开通/续期</a>　<a style='float :right;' href='/vipmb/order_user/'>查看订单</a></p>
            </div>
            <div style="padding: 15px;color: #666;font-size: 12px;">
              <?php
                $view_study_msg=file_get_contents($OJ_SAE?"saestor://web/study_msg.txt":"./xktms/study_msg.txt");
                echo $view_study_msg;
              ?>
            </div>
          </div>
      </div>

<!-- <div class="sliderbar-tz">
  <div class="sliderbar-tz-title"><i></i>通知公告</div>
  <div class="sliderbar-tz-body">
    <?php
      $view_study_msg=file_get_contents($OJ_SAE?"saestor://web/study_msg.txt":"./xktms/study_msg.txt");
      echo $view_study_msg;
    ?>
  </div>
</div> -->
      
    </div> <!-- /container -->
    </div> <!-- /wrap -->
<?php require("template/$OJ_TEMPLATE/footer.php");?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>

  <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/class_step/js/jquery-1.8.2.min.js"></script>
  <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/class_step/js/teiron.library.min.js"></script>
  <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/class_step/js/common.js"></script>
  <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/class_step/js/class_step.js"></script>
  <!--为了浏览器兼容性jqeury版本推荐使用1.12.0，其他版本会出现不支持某些浏览器-->
  <script type="text/javascript">
      $(".list_dt").on("click",function () {
          $('.list_dd').stop();
          $(this).siblings("dt").removeAttr("id");
          if($(this).attr("id")=="open"){
              $(this).removeAttr("id").siblings("dd").css("display","none");
          }else{
              $(this).attr("id","open").next().css("display","block").siblings("dd").css("display","none");
          }
      });
  </script>
  <script src="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/js/sliderbar-tz1.js"></script>
  <script type="text/javascript">
    $(function(){
      $('.sliderbar-tz').sliderBar({
            open : true,           
            top : 200,             
            width : 200,           
            theme : 'blue',       
            position : 'right'      
      });
    });
  </script>
  <!-- <script type="text/javascript">
    //选项卡
    $("div.vhead").click(function(){
        $(this).siblings(".vhead").removeClass("vhead0");
        $(this).addClass("vhead0");
    });
    $("div.vhead:eq(0)").click(function(){
        $("div.div_content").siblings(".div_content").addClass("div_content0");
        $("div.div_content:eq(0)").removeClass("div_content0");
    });
    $("div.vhead:eq(1)").click(function(){
        $("div.div_content").siblings(".div_content").addClass("div_content0");
        $("div.div_content:eq(1)").removeClass("div_content0");
    });
    $("div.vhead:eq(2)").click(function(){
        $("div.div_content").siblings(".div_content").addClass("div_content0");
        $("div.div_content:eq(2)").removeClass("div_content0");
    });
  </script> -->
  </body>
</html>