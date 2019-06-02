<?php require_once("admin-header.php");
if (!(isset($_SESSION['administrator']) || isset($_SESSION['lowlevel_admin']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}

//submit
$sql="SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution`  group by md order by md desc LIMIT 120";
$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
$chart_data_all= array();
while ($row=mysqli_fetch_array($result)){
	$chart_data_all[$row['md']]=$row['c'];
}

//ac
$sql="SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where result=4 group by md order by md desc LIMIT 120";
$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
$chart_data_ac= array();
while ($row=mysqli_fetch_array($result)){
	$chart_data_ac[$row['md']]=$row['c'];
}

//day reg
$sql="SELECT UNIX_TIMESTAMP(date(reg_time))*1000 md,count(1) c FROM `users` group by md order by md desc LIMIT 120";
$result=mysqli_query($mysqli, $sql);
$chart_data_reg=array();
while($row=mysqli_fetch_array($result)){
	$chart_data_reg[$row['md']]=$row['c'];
}

//day login
$sql="SELECT UNIX_TIMESTAMP(date(time))*1000 md,count(distinct `user_id`) c FROM `loginlog` group by md order by md desc LIMIT 120";
$result=mysqli_query($mysqli, $sql);
$chart_data_login=array();
while($row=mysqli_fetch_array($result)){
	$chart_data_login[$row['md']]=$row['c'];
}

//basic info
$sql="SELECT COUNT(1) AS cnt FROM `users`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_reg=$row->cnt;
$sql="SELECT COUNT(1) AS cnt FROM `problem`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_problems=$row->cnt;
$sql="SELECT COUNT(1) AS cnt FROM `solution`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_submit=$row->cnt;

$sql="SELECT COUNT(1) AS cnt FROM `blog` WHERE `status`=1";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_blog=$row->cnt;
$sql="SELECT COUNT(1) AS cnt FROM `users_cpn` WHERE `status`=1";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_cpn=$row->cnt;
$sql="SELECT COUNT(1) AS cnt FROM `job_list` WHERE `status`=1";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$total_job=$row->cnt;

//VIP充值卡统计
$sql="SELECT COUNT(1) AS cnt FROM `vip_paykey`";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$paykey_all=$row->cnt;
mysqli_free_result($result);
$sql="SELECT COUNT(1) AS cnt FROM `vip_paykey` WHERE `status`=0";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$paykey_used=$row->cnt;
mysqli_free_result($result);

$paykey_array_ct=array();
$sql="SELECT distinct `create_time` FROM `vip_paykey` ORDER BY `create_time` DESC LIMIT 20";
$result=mysqli_query($mysqli, $sql);
while ($row=mysqli_fetch_row($result)) {
  $paykey_array_ct[]=$row[0];
}
$paykey_array_ct_cnt=count($paykey_array_ct);

$paykey_array_ct_all=array();
for ($i=0; $i < $paykey_array_ct_cnt; $i++) { 
  $sql="SELECT COUNT(1) as cnt FROM `vip_paykey` WHERE `create_time`='$paykey_array_ct[$i]'";
  $result=mysqli_query($mysqli, $sql);
  $row=mysqli_fetch_object($result);
  $paykey_ct_all=$row->cnt;
  $paykey_array_ct_all[]=$paykey_ct_all;
}

$paykey_array_ct_used=array();
for ($i=0; $i < $paykey_array_ct_cnt; $i++) { 
  $sql="SELECT COUNT(1) as cnt FROM `vip_paykey` WHERE `create_time`='$paykey_array_ct[$i]' AND `status`=0";
  $result=mysqli_query($mysqli, $sql);
  $row=mysqli_fetch_object($result);
  $paykey_ct_used=$row->cnt;
  $paykey_array_ct_used[]=$paykey_ct_used;
}


//近30天统计
$arr_day_total=array();
$arr_day_view=array();
for ($i=30; $i >= 0 ; $i--) { 
  $arr_day_total[]=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))-($i*86400));
  if ($i > 0) {
    $arr_day_view[]=date("Y年m月d日",mktime(0, 0 , 0,date("m"),date('d'),date("Y"))-($i*86400));
  }
}

$reg_day=array();
for ($i=0; $i < 30; $i++) { 
  $sql="SELECT count(user_id) as `cnt` FROM `users` WHERE unix_timestamp(reg_time) >= unix_timestamp('".$arr_day_total[$i]."') AND unix_timestamp(reg_time) < unix_timestamp('".$arr_day_total[$i+1]."')";
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_object($result);
  $reg_day[]=$row->cnt;
  mysqli_free_result($result);
}
$blog_day=array();
for ($i=0; $i < 30; $i++) { 
  $sql="SELECT count(blog_id) as `cnt` FROM `blog` WHERE unix_timestamp(post_time) >= unix_timestamp('".$arr_day_total[$i]."') AND unix_timestamp(post_time) < unix_timestamp('".$arr_day_total[$i+1]."')";
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_object($result);
  $blog_day[]=$row->cnt;
  mysqli_free_result($result);
}
$cpn_day=array();
for ($i=0; $i < 30; $i++) { 
  $sql="SELECT count(cpnuser) as `cnt` FROM `users_cpn` WHERE unix_timestamp(reg_time) >= unix_timestamp('".$arr_day_total[$i]."') AND unix_timestamp(reg_time) < unix_timestamp('".$arr_day_total[$i+1]."')";
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_object($result);
  $cpn_day[]=$row->cnt;
  mysqli_free_result($result);
}
$job_day=array();
for ($i=0; $i < 30; $i++) { 
  $sql="SELECT count(id) as `cnt` FROM `job_list` WHERE unix_timestamp(release_time) >= unix_timestamp('".$arr_day_total[$i]."') AND unix_timestamp(release_time) < unix_timestamp('".$arr_day_total[$i+1]."')";
  $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
  $row=mysqli_fetch_object($result);
  $job_day[]=$row->cnt;
  mysqli_free_result($result);
}
?>
	<link rel="stylesheet" href="../template/<?php echo $OJ_TEMPLATE?>/css/bootstrap.min.css">
	<script language="javascript" type="text/javascript" src="../include/jquery.flot.js"></script>
  <script src="../template/<?php echo $OJ_TEMPLATE?>/js/echarts.min.js"></script>
<body>
	<center>
		<h1>统计数据</h1>
    <h3 class="text-left">基本信息</h3>
    <p class="text-left">网站注册会员数:<?php echo $total_reg;?></p>
    <p class="text-left">总提交量:<?php echo $total_submit; ?></p>
    <p class="text-left">题目数:<?php echo $total_problems; ?></p>
    <p class="text-left">博客总数:<?php echo $total_blog; ?></p>
    <p class="text-left">企业用户数:<?php echo $total_cpn; ?></p>
    <p class="text-left">招聘信息数:<?php echo $total_job; ?></p>
    <p class="text-left">VIP充值卡生成总量:<?php echo $paykey_all; ?></p>
    <p class="text-left">VIP充值卡已使用量:<?php echo $paykey_used; ?></p>
  <h2>充值卡近期统计</h2>
    <table class='table table-striped'>
      <thead>
        <tr class='toprow'>
          <td>日期</td>
          <?php
            foreach($paykey_array_ct as $ct){
              echo "<td>".$ct."</td>";
            }
          ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>生成</td>
          <?php
            foreach($paykey_array_ct_all as $ct_all){
              echo "<td>".$ct_all."</td>";
            }
          ?>
        </tr>
        <tr>
          <td>使用</td>
          <?php
            foreach($paykey_array_ct_used as $ct_used){
              echo "<td>".$ct_used."</td>";
            }
          ?>
        </tr>
      </tbody>
    </table>

  <h2>新用户注册情况（30日内）</h2>
  <div id="user_reg" style="height: 350px;margin-bottom: 20px;">
    <script type="text/javascript">
        var arr_day = <?php echo json_encode($arr_day_view) ?>;
        var arr_reg_day = <?php echo json_encode($reg_day) ?>;
        var textColor = '#999';
        var lineColor = '#999';
        var myChart = echarts.init(document.getElementById('user_reg'));
        var option = {
            tooltip: {
              trigger: 'axis'
            },
            backgroundColor: 'transparent',
            legend: {
              left: '3%',
              data: ['新注册量']
            },
            grid: {
              left: '4%',
              right: '8%'
            },
            xAxis: {
              type: 'category',
              axisTick: {
                show: false,
                alignWithLabel: true
              },
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                },
                margin: 10
              },
              data: arr_day
            },
            yAxis: [{
              position: 'right',
              interval: 9999,
              max: 0,
              axisLine: {
                lineStyle: {
                  color: 'transparent'
                }
              }
            }, {
              type: 'value',
              min: 0,
              position: 'left',
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                }
              },
              splitLine: {
                lineStyle: {
                  type: 'dotted'
                }
              }
            }],
            "dataZoom": [{
                "show": true,
                "height": 30,
                "xAxisIndex": [
                    0
                ],
                bottom: 0,
                "start": 20,
                "end": 100,
                handleIcon: 'path://M306.1,413c0,2.2-1.8,4-4,4h-59.8c-2.2,0-4-1.8-4-4V200.8c0-2.2,1.8-4,4-4h59.8c2.2,0,4,1.8,4,4V413z',
                handleSize: '110%',
                handleStyle:{
                    color:"#DDEEFF",
                    
                },
                   textStyle:{
                    color:"#aaa"},
                   borderColor:"#aaa"
                
                
            }, {
                "type": "inside",
                "show": false,
                "height": 50,
                "start": 1,
                "end": 35
            }],
            series: [{
              name: '新注册量',
              type: 'line',
              yAxisIndex: 1,
              symbolSize: 9,
              hoverAnimation: false,
              itemStyle: {
                normal: {
                  color: '#abbeed'
                },
                emphasis: {
                  color: '#DDD'
                }
              },
              data: arr_reg_day
            }]
          };
           myChart.setOption(option);
      </script>
  </div>
  <h2>新增博客文章（30日内）</h2>
  <div id="blog_new" style="height: 350px;margin-bottom: 20px;">
    <script type="text/javascript">
        var arr_day = <?php echo json_encode($arr_day_view) ?>;
        var arr_blog_day = <?php echo json_encode($blog_day) ?>;
        var textColor = '#999';
        var lineColor = '#999';
        var myChart = echarts.init(document.getElementById('blog_new'));
        var option = {
            tooltip: {
              trigger: 'axis'
            },
            backgroundColor: 'transparent',
            legend: {
              left: '3%',
              data: ['新增文章']
            },
            grid: {
              left: '4%',
              right: '8%'
            },
            xAxis: {
              type: 'category',
              axisTick: {
                show: false,
                alignWithLabel: true
              },
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                },
                margin: 10
              },
              data: arr_day
            },
            yAxis: [{
              position: 'right',
              interval: 9999,
              max: 0,
              axisLine: {
                lineStyle: {
                  color: 'transparent'
                }
              }
            }, {
              type: 'value',
              min: 0,
              position: 'left',
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                }
              },
              splitLine: {
                lineStyle: {
                  type: 'dotted'
                }
              }
            }],
            "dataZoom": [{
                "show": true,
                "height": 30,
                "xAxisIndex": [
                    0
                ],
                bottom: 0,
                "start": 20,
                "end": 100,
                handleIcon: 'path://M306.1,413c0,2.2-1.8,4-4,4h-59.8c-2.2,0-4-1.8-4-4V200.8c0-2.2,1.8-4,4-4h59.8c2.2,0,4,1.8,4,4V413z',
                handleSize: '110%',
                handleStyle:{
                    color:"#DDEEFF",
                    
                },
                   textStyle:{
                    color:"#aaa"},
                   borderColor:"#aaa"
                
                
            }, {
                "type": "inside",
                "show": false,
                "height": 50,
                "start": 1,
                "end": 35
            }],
            series: [{
              name: '新增文章',
              type: 'line',
              yAxisIndex: 1,
              symbolSize: 9,
              hoverAnimation: false,
              itemStyle: {
                normal: {
                  color: '#abbeed'
                },
                emphasis: {
                  color: '#DDD'
                }
              },
              data: arr_blog_day
            }]
          };
           myChart.setOption(option);
      </script>
  </div>
  <h2>新注册企业用户（30日内）</h2>
  <div id="cpn_reg" style="height: 350px;margin-bottom: 20px;">
    <script type="text/javascript">
        var arr_day = <?php echo json_encode($arr_day_view) ?>;
        var arr_cpn_day = <?php echo json_encode($cpn_day) ?>;
        var textColor = '#999';
        var lineColor = '#999';
        var myChart = echarts.init(document.getElementById('cpn_reg'));
        var option = {
            tooltip: {
              trigger: 'axis'
            },
            backgroundColor: 'transparent',
            legend: {
              left: '3%',
              data: ['新企业用户']
            },
            grid: {
              left: '4%',
              right: '8%'
            },
            xAxis: {
              type: 'category',
              axisTick: {
                show: false,
                alignWithLabel: true
              },
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                },
                margin: 10
              },
              data: arr_day
            },
            yAxis: [{
              position: 'right',
              interval: 9999,
              max: 0,
              axisLine: {
                lineStyle: {
                  color: 'transparent'
                }
              }
            }, {
              type: 'value',
              min: 0,
              position: 'left',
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                }
              },
              splitLine: {
                lineStyle: {
                  type: 'dotted'
                }
              }
            }],
            "dataZoom": [{
                "show": true,
                "height": 30,
                "xAxisIndex": [
                    0
                ],
                bottom: 0,
                "start": 20,
                "end": 100,
                handleIcon: 'path://M306.1,413c0,2.2-1.8,4-4,4h-59.8c-2.2,0-4-1.8-4-4V200.8c0-2.2,1.8-4,4-4h59.8c2.2,0,4,1.8,4,4V413z',
                handleSize: '110%',
                handleStyle:{
                    color:"#DDEEFF",
                    
                },
                   textStyle:{
                    color:"#aaa"},
                   borderColor:"#aaa"
                
                
            }, {
                "type": "inside",
                "show": false,
                "height": 50,
                "start": 1,
                "end": 35
            }],
            series: [{
              name: '新企业用户',
              type: 'line',
              yAxisIndex: 1,
              symbolSize: 9,
              hoverAnimation: false,
              itemStyle: {
                normal: {
                  color: '#abbeed'
                },
                emphasis: {
                  color: '#DDD'
                }
              },
              data: arr_cpn_day
            }]
          };
           myChart.setOption(option);
      </script>
  </div>
  <h2>招聘信息发布量（30日内）</h2>
  <div id="job_new" style="height: 350px;margin-bottom: 20px;">
    <script type="text/javascript">
        var arr_day = <?php echo json_encode($arr_day_view) ?>;
        var arr_job_day = <?php echo json_encode($job_day) ?>;
        var textColor = '#999';
        var lineColor = '#999';
        var myChart = echarts.init(document.getElementById('job_new'));
        var option = {
            tooltip: {
              trigger: 'axis'
            },
            backgroundColor: 'transparent',
            legend: {
              left: '3%',
              data: ['招聘信息']
            },
            grid: {
              left: '4%',
              right: '8%'
            },
            xAxis: {
              type: 'category',
              axisTick: {
                show: false,
                alignWithLabel: true
              },
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                },
                margin: 10
              },
              data: arr_day
            },
            yAxis: [{
              position: 'right',
              interval: 9999,
              max: 0,
              axisLine: {
                lineStyle: {
                  color: 'transparent'
                }
              }
            }, {
              type: 'value',
              min: 0,
              position: 'left',
              axisLine: {
                lineStyle: {
                  color: lineColor
                }
              },
              axisLabel: {
                textStyle: {
                  color: textColor
                }
              },
              splitLine: {
                lineStyle: {
                  type: 'dotted'
                }
              }
            }],
            "dataZoom": [{
                "show": true,
                "height": 30,
                "xAxisIndex": [
                    0
                ],
                bottom: 0,
                "start": 20,
                "end": 100,
                handleIcon: 'path://M306.1,413c0,2.2-1.8,4-4,4h-59.8c-2.2,0-4-1.8-4-4V200.8c0-2.2,1.8-4,4-4h59.8c2.2,0,4,1.8,4,4V413z',
                handleSize: '110%',
                handleStyle:{
                    color:"#DDEEFF",
                    
                },
                   textStyle:{
                    color:"#aaa"},
                   borderColor:"#aaa"
                
                
            }, {
                "type": "inside",
                "show": false,
                "height": 50,
                "start": 1,
                "end": 35
            }],
            series: [{
              name: '招聘信息',
              type: 'line',
              yAxisIndex: 1,
              symbolSize: 9,
              hoverAnimation: false,
              itemStyle: {
                normal: {
                  color: '#abbeed'
                },
                emphasis: {
                  color: '#DDD'
                }
              },
              data: arr_job_day
            }]
          };
           myChart.setOption(option);
      </script>
  </div>
  <h3 class="text-left">提交/正确 统计</h3>
    <div id=submission style="width:80%;height:300px" ></div>
    <h3 class="text-left">新用户注册统计</h3>
    <div id=register style="width:80%;height:300px" ></div>
    <h3 class="text-left">日活跃用户统计</h3>
    <div id=loginuser style="width:80%;height:300px" ></div>
    <hr>
  </center>
	<script type="text/javascript">
$(function () {
  var d1 = [];
  var d2 = [];
  <?php
  foreach($chart_data_all as $k=>$d){
  ?>
    d1.push([<?php echo $k?>, <?php echo $d?>]);
  <?php }?>
  <?php
  foreach($chart_data_ac as $k=>$d){
  ?>
    d2.push([<?php echo $k?>, <?php echo $d?>]);
  <?php }?>
  //var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
  // a null signifies separate line segments
  var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];
  $.plot($("#submission"),[
  {label:"提交",data:d1,lines: { show: true }},
  {label:"正确",data:d2,bars:{show:true}} ],{
  grid: {
  backgroundColor: { colors: ["#fff", "#eee"] }
  },
  xaxis: {
  mode: "time",
  max:(new Date()).getTime(),
  min:(new Date()).getTime()-100*24*3600*1000
  }
  });

  //reg
  var dreg=[];
  <?php 
  	foreach($chart_data_reg as $k=>$d){
   ?>
   		dreg.push([<?php echo $k;?>,<?php echo $d;?>]);
   <?php } ?>
 
   $.plot($("#register"),[{label:"注册",data:dreg,lines:{show:true}}],{
  grid: {
  backgroundColor: { colors: ["#fff", "#eee"] }
  },
  xaxis: {
  mode: "time",
  max:(new Date()).getTime(),
  min:(new Date()).getTime()-100*24*3600*1000
  }
  });

   //loginuser
   var dlogin=[];
   <?php 
      foreach($chart_data_login as $k=>$d){
    ?>
        dlogin.push([<?php echo $k;?> ,<?php echo $d;?>]);
    <?php } ?>
    $.plot($("#loginuser"),[{label:"活跃用户数",data:dlogin,lines:{show:true}}],{
  grid: {
  backgroundColor: { colors: ["#fff", "#eee"] }
  },
  xaxis: {
  mode: "time",
  max:(new Date()).getTime(),
  min:(new Date()).getTime()-100*24*3600*1000
  }
  });
});
//alert((new Date()).getTime());
</script>
</body>
<?php require_once('../oj-footer.php');
?>
