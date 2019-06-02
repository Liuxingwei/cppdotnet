<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "我的竞争力 - C语言网";?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>     
    <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>mycomp.css">
    <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>echarts.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
    if ($user==$_SESSION['user_id'] || isset($_SESSION['administrator']))
            { ?>
          <style type="text/css">
            div#comp {
              height: 540px;
            }
          </style>
    <?php } ?>
    <div class="wrap" style="background-color: rgb(238, 238, 238)">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>     
      <!-- Main component for a primary marketing message or call to action -->
    <div class="banner_h1">
      <div class="h1">
        <h1>我的竞争力</h1>
        <p>　　　　　　——编程实力综合评价</p>
        <p style="text-align: right;font-size: 20px;">
          <?php if (!$_SESSION['user_id']) {
            echo "<a href='/oj/loginpage.php'>登录</a>以便查看自己的评价建议等详细信息。";
          } ?>
        </p>
      </div>
    </div>
    <div class="nav-container">
      <nav>
        <ul>
          <li><a href="#comp" class="selected">基本信息</a></li>
          <li><a href="#prob">刷题情况</a></li>
          <li><a href="#cont">成果评估</a></li>
          <?php 
          if ($user==$_SESSION['user_id'] || isset($_SESSION['administrator']))
            { ?>
          <li><a href="#sugg_rate">评价建议</a></li>
          <?php } ?>
        </ul>
      </nav>
    </div>
    <div class="container">
      <div class="jumbotron" style="min-width: 1140px;padding: 40px 0;">

        <div id="comp" class="div_cont div_mark">
              <h2>基本信息</h2>
                <div id="comp_l">
                    <table class="tab_basic tab_basic_l">
                      <tr>
                        <td width="15%">用 户 名</td>
                        <td width="30%"><?php echo $user?></td>
                        <td width="15%">在职情况</td>
                        <td width="40%"><?php echo $userinfo_iswork?></td>
                      </tr>
                      <tr>
                        <td>昵　　称</td>
                        <td><?php echo $nick?></td>
                        <td>学　　校</td>
                        <td><?php echo $school?></td>
                      </tr>
                      <tr>
                        <td>年　　龄</td>
                        <td><?php echo $userinfo_age?></td>
                        <td>专　　业</td>
                        <td><?php echo $userinfo_subject?></td>
                      </tr>
                      <?php 
                      if ($user==$_SESSION['user_id'] || isset($_SESSION['administrator']))
                              { ?>
                      <tr>
                        <td>电　　话</td>
                        <td><?php echo $phone?></td>
                        <td>邮　　箱</td>
                        <td><?php echo $email?></td>
                      </tr>
                      <tr>
                        <td>地　　址</td>
                        <td colspan="3"><?php echo $address?></td>
                      </tr>
                      <?php } ?>
                    </table>
                    <div class="intro">
                      <p>签　　名</p>
                      <p>　　<?php echo $autograph?></p>
                    </div>
                    <div class="intro">
                      <p>自我简介</p>
                      <p>　　<?php echo $intro?></p>
                    </div>
                </div>
                
                <div id="comp_r">

                  <table class="tab_basic tab_basic_r">
                    <tr>
                      <td>排　　名</td>
                      <td><?php echo $Rank?></td>
                    </tr>
                    <tr>
                      <td>已解决题目</td>
                      <td>共解决<?php echo $AC?>道题目</td>
                    </tr>
                    <tr>
                      <td>参赛积极度</td>
                      <td>注册以来参加了<?php echo $pct_cont_can?>%的比赛</td>
                    </tr>
                    <tr>
                      <td>总代码量</td>
                      <td>累计代码约<?php echo $cnt_leng?>行</td>
                    </tr>
                    <tr>
                      <td>博客文章</td>
                      <td><?php echo "<a href='/home/".$user."'>TA的博客主页</a>";?></td>
                    </tr>
                    <tr>
                      <td>个人简历</td>
                      <td><a href="resume.php?user_id=<?php echo $user;?>">点击查看</a></td>
                    </tr>
                  </table>
                <!-- 五星图
                <script type="text/javascript">
                  var pct_ac = <?php echo round(round(($AC/$prob_cnt),2)*100)?>;
                  var pct_tr=<?php echo round(round(($Right/$Submit),2)*100)?>;
                  var pct_cont_ac=<?php echo $pct_cont_ac;?>;
                  var pct_cont_can=<?php echo $pct_cont_can;?>;
                  var pct_leng=<?php echo round($pct_leng);?>;
                  if (pct_leng>=100) {pct_leng=100;}
                  var myChart = echarts.init(document.getElementById('comp_r'));
                  option = {
                      tooltip: {},
                      legend: {
                          orient: 'vertical',
                          left: 'left',
                          top: 'top',
                          data: ['综合实力五星图']
                      },
                      radar: {
                          // shape: 'circle',
                          radius: '85%',
                          center: ['45%', '52%'],
                          indicator: [
                             { name: '刷题量', max: 100},
                             { name: '题目正确率', max: 100},
                             { name: '赛题通过率', max: 100},
                             { name: '参赛积极度', max: 100},
                             { name: '代码量', max: 100},
                          ]
                      },
                      series: [{

                          type: 'radar',
                          // areaStyle: {normal: {}},
                          data : [
                               {
                                  name : '综合实力五星图',
                                  value : [pct_ac,
                                          pct_tr,
                                          pct_cont_ac,
                                          pct_cont_can,
                                          pct_leng],
                                  areaStyle: {
                                          normal: {
                                              opacity: 0.7,
                                              color: new echarts.graphic.RadialGradient(0.5, 0.5, 1, [
                                                  {
                                                      color: '#B8D3E4',
                                                      offset: 0
                                                  },
                                                  {
                                                      color: '#72ACD1',
                                                      offset: 1
                                                  }
                                              ])
                                          }
                                      }
                              }
                          ]
                      }]
                  };

                  myChart.setOption(option);
                </script> -->
                </div>
        </div>
        <div id="prob" class="div_cont div_mark">
          <h2>刷题情况</h2>
          <div id="prob_3" class="div_sm" style="height: 400px;">
            <h5 style="text-align: center;">近期刷题频率统计</h5>
              <div id="prob_3_d">
                <script type="text/javascript">
                    var arr_month = <?php echo json_encode($arr_month_view) ?>;
                    var arr_sub_month = <?php echo json_encode($Submit_month) ?>;
                    var textColor = '#999';
                    var lineColor = '#999';
                    var myChart = echarts.init(document.getElementById('prob_3_d'));
                    var option = {
                        tooltip: {
                          trigger: 'axis'
                        },
                        backgroundColor: 'transparent',
                        legend: {
                          left: '3%',
                          data: ['提交次数']
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
                          data: arr_month
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
                          name: '提交次数',
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
                          data: arr_sub_month
                        }]
                      };
                       myChart.setOption(option);
                  </script>
              </div>
          </div>
          <div id="prob_2" class="div_sm">
            <div id="prob_2_l">
              <h5 style="text-align: center;">题目各分类详细情况</h5>
              <div id="prob_2_l_d">
                <table id="tab_prob_mark">
                  <tr>
                    <th>类型</th>
                    <th>解决</th>
                    <th>提交</th>
                    <th>正确</th>
                  </tr>
                  <?php
                    for ($i=0; $i < $j; $i++) { 
                      echo "<tr>
                              <td>".$attr_value_view[$i]."</td>
                              <td>".$cnt_prob_ac_mark[$i]."</td>
                              <td>".$cnt_prob_sub_mark[$i]."</td>
                              <td>".$cnt_prob_true_mark[$i]."</td>
                            </tr>";
                    }
                  ?>
                </table>
              </div>
            </div>
            <div id="prob_2_r">
              <h5 style="text-align: center;">题目各分类完成度及正确率</h5>
              <div id="prob_2_r_d">
                <script type="text/javascript">
                  var attr_value_view = <?php echo json_encode($attr_value_view) ?>;
                  var pct_ac_mark = <?php echo json_encode($pct_ac_mark) ?>;
                  var pct_true_mark = <?php echo json_encode($pct_true_mark) ?>;
                  var myChart = echarts.init(document.getElementById('prob_2_r_d'));
                  var option = {
                          color: ['#45a7ca', '#98d5ef'],
                          tooltip: {
                              trigger: 'axis',
                              axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                  type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                              },
                          },
                          legend: {
                              data: ['已解决比率', '提交正确率'],
                              top: '10'
                          },
                          grid: {
                              left: '0%',
                              right: '2%',
                              bottom: '6%',
                              containLabel: true
                          },
                          calculable: true,
                          xAxis: [{
                              type: 'category',
                              data: attr_value_view
                          }],
                          yAxis: [{
                              type: 'value',
                              nameLocation: 'middle',
                              nameGap: 30,
                              nameTextStyle: {
                                  fontWeight: 'bold',
                                  fontSize: '14',
                              }
                          }],
                          dataZoom: [{
                              type: 'inside'
                          }],
                          series: [{
                              name: '已解决比率',
                              type: 'bar',
                              label: {normal: {show: true,formatter: '{c}%'}},
                              barWidth:30,
                              data: pct_ac_mark
                          }, {
                              name: '提交正确率',
                              type: 'bar',
                              label: {normal: {show: true,formatter: '{c}%'}},
                              barWidth:30,
                              data: pct_true_mark
                          }]
                      };
                     myChart.setOption(option);
                </script>
              </div>
            </div>
          </div>
          <div id="prob_1" class="div_sm">
            <div id="prob_1_l">
              <h5 style="text-align: center;">题目完成信息总览</h5>
              <div  id="prob_1_l_d">
                <script type="text/javascript">
                  var ac = <?php echo $AC?>;
                  var prob_cnt = <?php echo $prob_cnt?>;
                  var pct = ac/prob_cnt;
                  var myChart = echarts.init(document.getElementById('prob_1_l_d'));
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
                          subtext: '已解决题目',
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
              </div>
              <!-- <div id="prob_1_l_rate">
                      <script type="text/javascript">
                        var submit = <?php echo $Submit?>;
                        var right = <?php echo $Right?>;
                        var myChart = echarts.init(document.getElementById('prob_1_l_rate'));
                        option = {
                            //color: ['#3398DB'],
                            tooltip: {
                                trigger: 'axis',
                                axisPointer: { // 坐标轴指示器，坐标轴触发有效
                                    type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
                                }
                            },
                            grid: {
                                left: '5%',
                                right: '7%',
                                top: '5%',
                                bottom: '15%',
                                containLabel: true
                            },
                            yAxis: [{
                                type: 'category',
                                data: ['提交', '正确'],
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }],
                            xAxis: [{
                                type: 'value'
                            }],
                            backgroundColor: '#ffffff',
                            series: [{
                                name: '次数',
                                type: 'bar',
                                data: [submit, right],
                                label: {
                                    normal: {
                                        show: true,
                                        position: 'insideRight',
                                        textStyle: {
                                            color: 'white' //color of value
                                        }
                                    }
                                },
                                itemStyle: {
                                    normal: {
                                        color: new echarts.graphic.LinearGradient(0, 0, 1, 0, [{
                                            offset: 0,
                                            color: 'lightBlue' // 0% 处的颜色
                                        }, {
                                            offset: 1,
                                            color: '#3398DB' // 100% 处的颜色
                                        }], false)
                                    }
                                }
                            }]
                        };
                        myChart.setOption(option);
                      </script>
                    </div> -->
            </div>
            <div id="prob_1_r">
              <h5 style="text-align: center;">题目提交结果总览</h5>
              <div id="prob_1_r_d">
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
                var myChart = echarts.init(document.getElementById('prob_1_r_d'));
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
              </div>
            </div>
          </div>
          
        </div>
        <div id="cont" class="div_cont div_mark">
          <h2>成果评估</h2>
          <div id="cont_l">
            <h5>比赛详细情况</h5>
            <div id="cont_l_d">
              <table id="tab_cont">
                <tr>
                  <td>参加次数</td>
                  <td><?php echo $cnt_cont?></td>
                </tr>
                <tr>
                  <td>题目通过率</td>
                  <td><?php echo $pct_cont_ac?>%</td>
                </tr>
              </table>
              <table id="tab_cont_last">
                <tr><th>近期参加比赛</th><th>题目通过率</th></tr>
                <?php
                  foreach ($arr_cont_join_last as $arr_eachcont) {
                    echo "<tr><td><a href='contest".$arr_eachcont[0].".html'>$arr_eachcont[1]</a></td><td>$arr_eachcont[2]%</td></tr>";
                  }
                ?>
              </table>
            </div>

          </div>
          <div id="cont_r">
            <h5>比赛题目通过率详情</h5>
            <div id="cont_r_d" style="height: 400px;">
            <!-- <p style="color: #999;font-size: 32px;margin: 20% 20%;">暂无数据，敬请期待</p> -->
              <script type="text/javascript">
              var cont_last=[];
              var cont_pct=[];
                <?php
                  foreach ($arr_cont_join_last as $arr_eachcont) {
                ?>
                  cont_last.push('<?php echo $arr_eachcont[1];?>');
                  cont_pct.push('<?php echo $arr_eachcont[2];?>');
                <?php } ?>
                var myChart = echarts.init(document.getElementById('cont_r_d'));
                var option = {
                        color: ['#3398DB'],
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                            }
                        },
                        grid: {
                            top: '5%',
                            left: '7%',
                            right: '4%',
                            bottom: '15%',
                            containLabel: true
                        },
                        xAxis : [
                            {
                                type : 'category',
                                data : cont_last,
                                axisLabel: {
                                    "interval": 0, 
                                    "rotate": 15, 
                                    "show": true, 
                                    "splitNumber": 15, 
                                    "textStyle": {
                                        "fontFamily": "微软雅黑", 
                                        "fontSize": 12
                                    }
                                },
                                axisTick: {
                                    alignWithLabel: true
                                }
                            }
                        ],
                        yAxis : [
                            {
                                type : 'value'
                            }
                        ],
                        series : [
                            {
                                name:'题目通过率',
                                type:'bar',
                                barWidth: '60px',
                                label: {normal: {show: true,formatter: '{c}%'}},
                                data:cont_pct
                            }
                        ]
                    };
                myChart.setOption(option);
              </script>
            </div>
          </div>
        </div>
        <?php 
          if ($user==$_SESSION['user_id'] || isset($_SESSION['administrator']))
            { ?>
        <div id="sugg_rate" class="div_cont div_mark">
          <h2>评价建议</h2>
          <div id="sugg_rate_d">
          <p style="color: #666;font-size: 22px;font-weight: bold;">亲爱的<?php echo $nick;?>同学：</p>
          <p>　　通过跟踪您学习和训练的情况，分析得知您目前大约有<?php echo $cnt_leng;?>行代码量，其中基本语法类掌握<?php echo $rate_a;?>，算法与数据结构类掌握<?php echo $rate_b;?>，看到您过去参加过<?php echo $cnt_cont;?>场比赛，成绩<?php echo $rate_cont;?>。</p>
          <p style="color: #666;font-size: 22px;font-weight: bold;">给您的一些建议：</p>
          <p>　　<?php echo $sugg_str;?></p>
          </div>
        </div>
        <?php } ?>
      </div>

  </div> <!-- /container -->
  </div>
  <?php require("template/$OJ_TEMPLATE/footer.php") ?>
  <?php include("template/$OJ_TEMPLATE/js.php");?>
  
  <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>jquery-1.6.4.min.js"></script>
  <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>jquery.scrollTo-1.4.2-min.js"></script>
  <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>waypoints.min.js"></script>
  <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>navbar2.js"></script>

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"260"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

</body>
</html>