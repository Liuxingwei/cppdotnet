<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $problem_title?> - 讨论 - C语言网</title>  
    <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>echarts.js"></script>
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
    <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/css/problem.css">
    <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/css/discuss.css">

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
    <div id="banner">
        <div class="container">
        <h1><?php 
                $PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $id=$row->problem_id;
                if($pr_flag)echo "问题 ".$row->problem_id.": ".$row->title;
                else echo "问题 ".$PID[$pid].": ".$row->title;
            ?></h1>
                <p>时间限制: <?php echo $row->time_limit; ?>Sec 内存限制: <?php echo $row->memory_limit; ?>MB 提交: <?php echo $row->submit; ?> 解决: <?php echo $row->accepted; ?></p>
        </div>
    </div>
    <div class="container" id="body">
        <div class="row">
            <div class="col-lg-9">
                <?php
                foreach($view_discuss as $tmprow){
                ?>
                    <div class="discuss_msg">
                        <div>
                             <div class="col-lg-2 text-center"> <a href="userinfo.php?user=<?php echo $tmprow['user_id'];?>"> <?php echo $tmprow['nick'];?></a></div>
                             <div class="col-lg-10 user_sign" title="<?php echo $tmprow['user_sign'];?>" ><?php echo $tmprow['user_sign'];?></div>
                        </div>                        
                        <div>
                            <pre class="dis_content col-lg-10 col-lg-offset-2"><?php echo htmlentities($tmprow['content'],ENT_QUOTES,"UTF-8");?></pre>
                        </div>
                        <div class="bottom_right">
                            <?php echo $tmprow['post_time'];?> | 
                            <button  class="btn btn-link" onclick="dis_nice(this,<?php echo $tmprow['discuss_id'];?>)">赞<?php if($tmprow['nice']!=0) echo "(".$tmprow['nice'].")";?></button> | 
                            <button class="btn btn-link comment_cnt" name="<?php echo $tmprow['discuss_id'];?>" id="<?php echo $tmprow['discuss_id'];?>" onclick="showComment(this);">评论<?php if($tmprow['comment_cnt']!=0) echo "(".$tmprow['comment_cnt'].")";?></button> |
                            <!-- title=恶意举报会被系统封禁哦 -->
                            <button class="btn btn-link" onclick="dis_inform(<?php echo $tmprow['discuss_id'] ?>);" >举报</button>
                            <?php if(isset($_SESSION['administrator'])){
                                require_once("include/set_get_key.php");
                             ?>

                                 | <a class="btn btn-link" href="xktms/discuss_del.php?discuss_id=<?php echo $tmprow['discuss_id'];?> &getkey=<?php echo $_SESSION['getkey']?>">删除</a>
                            <?php } ?>
                        </div>
                        <div hidden class="well" style="position:absolute;width:100%;">
                            <div class="comment_show">
                                <?php
                                if($tmprow['comment_cnt']!=0){
                                foreach($tmprow['comment'] as $comment_row){
                                ?>
                                <div>
                                    <p>
                                        <a href="userinfo.php?user=<?php echo $comment_row['user_id'];?>"><?php echo $comment_row['nick'];?></a>
                                        <span style="color:#888"><?php echo $comment_row['post_time'];?></span>
                                        <?php if($comment_row['user_id']!=$_SESSION['user_id']) {
                                                $to_user=$comment_row['user_id'];
                                            ?>
                                            | <button class="btn btn-link" onclick="reply_to(this,'<?php echo getNickByid($to_user);?>','<?php echo $to_user;?>')" >回复</button> 
                                        <?php } ?>
                                        | <button class="btn btn-link" onclick="com_inform(<?php echo $comment_row['comment_id'];?>);" >举报</button> 
                                        <?php if(isset($_SESSION['administrator'])){
                                          require_once("include/set_get_key.php");
                                        ?>
                                        | <a class="btn btn-link" href="xktms/discuss_del.php?comment_id=<?php echo $comment_row['comment_id'];?> &getkey=<?php echo $_SESSION['getkey']?>">删除</a>
                                        <?php } ?>
                                    </p><p><?php echo htmlentities($comment_row['content'],ENT_QUOTES,"UTF-8");?></p></div>
                                <?php 
                                }}
                                ?>
                            </div>
                            <!-- <form action="postcomment.php" method="post"> -->
                            <div>
                                <div class="form-group col-lg-11">
                                    <input type="text" max="30" class="comment_msg form-control" placeholder="说点什么...">
                                    <span class="reply_to_user"></span>
                                    <input type="text" hidden>
                                </div>
                                <div class="form-group col-lg-1">
                                    <button type="submit" class="btn btn-primary" onclick="comment_submit(this,<?php echo $tmprow['discuss_id'];?>)">提交</button>
                                </div>
                            <!-- </form> -->
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <div style="height: 80px;">
                <ul class="pagination pull-right">
                 <?php
                    if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                    else {
                        echo "<li><a href='discuss.php?id=".$id."&page=".($page-1)."'>&laquo;</a></li>";
                    }
                    $maxpag = 5;
                    $view_total_page = (int)$view_total_page;
                    $midpag = (int)($maxpag/2);
                    $starpag = 1;
                    $endpag = $view_total_page;
                    if($view_total_page>$maxpag){
                        $starpag = $page - $midpag;
                        $endpag = $page + $midpag;
                        if($starpag<=0){
                            $starpag = 1;
                            $endpag = $maxpag;
                        }
                        if($endpag>$view_total_page){
                            $endpag = $view_total_page;
                            $starpag =  $endpag - $maxpag + 1;
                        }
                    }
                    $stardian = "<li><a href='discuss.php?id=".$id."&page=".($starpag-1)."'>···</a></li>";
                    $enddian = "<li><a href='discuss.php?id=".$id."&page=".($endpag+1)."'>···</a></li>";
                    if($starpag!=1)echo $stardian;
                    for ($i=$starpag;$i<=$endpag;$i++){
                        if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                        else {
                            echo "<li><a href='discuss.php?id=".$id."&page=".$i."'>".$i."</a></li>";
                        }
                    }
                    if($endpag!=$view_total_page)echo $enddian;
                    if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                    else {
                        echo "<li><a href='discuss.php?id=".$id."&page=".($page+1)."'>&raquo;</a></li>";
                    }
                ?>
                </ul>
                </div>
                <form action="postdiscuss.php" method="post" onsubmit="return isDismsgEmpty(this);" id="disForm">
                    <div>
                        <textarea id="dis_edit" name="dismsg" cols="30" rows="10" style="width:100%"></textarea>
                    </div>
                    <hr style="border:0px;"/>
                    <input name="id" type="text" value="<?php echo $id;?>" hidden>
                    <div style="clear:both;">
                       <div class="form-group pull-right"><button class="btn btn-primary">提交</button></div>
                    </div> 
                </form>
            </div> <!-- /col-lg-9 -->
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12 pie_panel text-center">
                        <p class="text-center pie_panel_head">通过率</p>
                        <?php
                             if($row->accepted==0)
                                 $acrate=0;
                             else
                                 $acrate=$row->accepted/$row->submit;
                        ?>
                        <div id="chartCanvas1" style="height: 250px;"></div>
                        <!-- <p class="text-center" style="color:#888">解决:<?php echo $acrate;?>%</p>
                        <div class="chart_container">
                            <canvas id="chartCanvas1" height="300%" width="300%">Your web-browser does not support the HTML5 canvas element.</canvas>
                        </div> -->
                    </div>
                    <?php
                        if(!isset($summary[4]))$summary[4]=0;
                        if(!isset($summary[5]))$summary[5]=0;
                        if(!isset($summary[6]))$summary[6]=0;
                        if(!isset($summary[7]))$summary[7]=0;
                        if(!isset($summary[9]))$summary[9]=0;
                        if(!isset($summary[10]))$summary[10]=0;
                        if(!isset($summary[11]))$summary[11]=0;
                    ?>
                    <div class="col-lg-12 pie_panel">
                        <p class="text-center pie_panel_head">统计</p>
                        <!--<pclass="text-center"style="color:#888">解决:74%</p>-->
                        <!-- <div class="chart_container">
                            <canvas id="chartCanvas2" height="300%" width="300%">Your web-browser does not support the HTML 5canvas element.</canvas>
                        </div> -->
                        <?php 
                            if($summary[4]==$summary[5] && $summary[5]==$summary[6] && $summary[6]==$summary[7] && $summary[7]==$summary[9] && $summary[9]==$summary[10] && $summary[10]==$summary[11])
                                echo '<p class="text-center" style="padding-top:100px;padding-bottom:100px;color:#666;font-size:35px;">暂无提交数据</p>';
                            else
                                echo '<div id="chartCanvas2" style="height:300px;"></div>';
                         ?>
                    <!-- </div>
                    <div class="col-lg-12"> -->
                        <table class="table">
                            
                            <tr>
                                <td>　提交</td>
                                <td><?php echo $row->submit; ?></td>
                            </tr>
                            <tr>
                                <td>　正确</td>
                                <td><?php echo $summary[4]; ?></td>
                            </tr>
                            <tr>
                                <td>　格式错误</td>
                                <td><?php echo $summary[5]; ?></td>
                            </tr>
                            <tr>
                                <td>　答案错误</td>
                                <td><?php echo $summary[6]; ?></td>
                            </tr>
                            <tr>
                                <td>　时间超限</td>
                                <td><?php echo $summary[7]; ?></td>
                            </tr>
                            <tr>
                                <td>　输出超限</td>
                                <td><?php echo $summary[9]; ?></td>
                            </tr>
                            <tr>
                                <td>　运行错误</td>
                                <td><?php echo $summary[10]; ?></td>
                            </tr>
                            <tr>
                                <td>　编译错误</td>
                                <td><?php echo $summary[11]; ?></td>
                            </tr>
                        </table>
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
    <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.pie.js"></script>	    
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/discuss.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/awesomechart.js"></script>
    <!-- <script type="text/javascript">
        var ue = UE.getEditor('dis_edit',{
            toolbars: [
                ['undo', 'redo', 'emotion',]
            ],
            initialFrameHeight:240
        });
    </script> -->
    <script type="text/javascript">
        var pct = <?php echo $acrate;?>;
        var myChart = echarts.init(document.getElementById('chartCanvas1'));
        var percent = pct.toFixed(2);
        function getData() {
          return [{
              value: percent,
              itemStyle: {
                  normal: {
                      color: '#87CEFA',
                      shadowBlur: 10,
                      shadowColor: '#87CEFA'
                  }
              }
          }, {
              value: 1 - percent,
              itemStyle: {
                  normal: {
                      color: '#F8F8FF'
                  }
              }
          }];
        }
        option = {
          title: {
              text: Math.round(percent * 100) + '%',
              subtext: '正确率',
              x: 'center',
              y: 'center',
              textStyle: {
                  color: '#f2c967',
                  fontSize: 26
              },
              subtextStyle: {
                  color: '#3da1ee',
                  fontSize: 18
              }
          },
          animation: true,
          series: [{
              type: 'pie',
              radius: ['56%', '62%'],
              silent: true,
              label: {
                  normal: {
                      show: false,
                  }
              },
              data: [{
                  itemStyle: {
                      normal: {
                          color: '#3da1ee',
                          shadowBlur: 2,
                          shadowColor: '#3da1ee'
                      }
                  }
              }]
          }, {
              name: 'main',
              type: 'pie',
              radius: ['70%', '82%'],
              label: {
                  normal: {
                      show: false
                  }
              },
              data: getData()
          }]
        };
        myChart.setOption(option);
    </script>
    <script type="text/javascript">
        var wrong = <?php echo $summary[5];?>+
                    <?php echo $summary[6];?>+
                    <?php echo $summary[7];?>+
                    <?php echo $summary[9];?>+
                    <?php echo $summary[10];?>+
                    <?php echo $summary[11];?>;
        var text_arr = [];
        var pie_arr = [];
        if (<?php echo $summary[4];?>!==0) {
          text_arr.push("正确");
          pie_arr.push({value:<?php echo $summary[4];?>, name:"正确"});
        }
        if (<?php echo $summary[5];?>!==0) {
          text_arr.push("格式错误");
          pie_arr.push({value:<?php echo $summary[5];?>, name:"格式错误"});
        }
        if (<?php echo $summary[6];?>!==0) {
          text_arr.push("答案错误");
          pie_arr.push({value:<?php echo $summary[6];?>, name:"答案错误"});
        }
        if (<?php echo $summary[7];?>!==0) {
          text_arr.push("时间超限");
          pie_arr.push({value:<?php echo $summary[7];?>, name:"时间超限"});
        }
        if (<?php echo $summary[9];?>!==0) {
          text_arr.push("输出超限");
          pie_arr.push({value:<?php echo $summary[9];?>, name:"输出超限"});
        }
        if (<?php echo $summary[10];?>!==0) {
          text_arr.push("运行错误");
          pie_arr.push({value:<?php echo $summary[10];?>, name:"运行错误"});
        }
        if (<?php echo $summary[11];?>!==0) {
          text_arr.push("编译错误");
          pie_arr.push({value:<?php echo $summary[11];?>, name:"编译错误"});
        }
        var myChart = echarts.init(document.getElementById("chartCanvas2"));
          option = {
              tooltip: {
                  trigger: "item",
                  formatter: "{a} <br/>{b}: {c} ({d}%)"
              },
              series: [
                  {
                      name:"正确情况",
                      type:"pie",
                      selectedMode: "single",
                      radius: [0, "30%"],

                      label: {
                          normal: {
                              position: "inner"
                          }
                      },
                      labelLine: {
                          normal: {
                              show: false
                          }
                      },
                      center : ["55%", "50%"],
                      data:[
                          {value:<?php echo $summary[4];?>, name:"正确"},
                          {value:wrong, name:"错误"}
                      ]
                  },
                  {
                      name:"详细状况",
                      type:"pie",
                      radius: ["40%", "55%"],
                      center : ["55%", "50%"],
                      data:pie_arr
                  }
              ]
          };
          myChart.setOption(option);
    </script>

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    
  </body>
</html>
