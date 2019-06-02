<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="蓝桥杯ACM训练实时评测系统，看懂教程后来这里训练吧，在线提交，实时评测，边学边练！成就大神之路！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title." - C语言网"?></title>  
    <script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>echarts.js"></script>
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
    <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/css/problem.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .panel_prob_head {
          padding: 10px 15px;
          background: #E5ECF9;
          border-bottom: 1px solid #ddd;
          font-weight: bold;
          color: #666;
      }
      .panel_prob_body {
          padding: 20px;
      }
      .panel_prob {
          border-bottom: 1px solid #ddd;
      }

      .nextbox {
          z-index: 999;
          position: fixed;
          bottom: 200px;
          margin-left: -100px;
      }
      .nextbox a {
          display: block;
          text-align: center;
          text-decoration: none;
          color: #333;
          margin-bottom: 10px;
          width: 100px;
          line-height: 36px;
          background: #C0D0F0;
          border: 1px solid #A0B0D0;
          border-right: 0px;
      }
      .nextbox a:hover{
          background: #A0B0D0;
      }
    </style>
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
	
<?php
//if ($row->spj) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
?>
<?php
//echo "$MSG_Description".$row->description;
//echo "$MSG_Input".$row->input;5
//echo "$MSG_Output".$row->output;
$sinput=str_replace("<","&lt;",$row->sample_input);
$sinput=str_replace(">","&gt;",$sinput);
$soutput=str_replace("<","&lt;",$row->sample_output);
$soutput=str_replace(">","&gt;",$soutput);
if($row->description=="")$row->description="无";
if($row->input=="")$row->input="无";
if($row->output=="")$row->output="无";
if($sinput=="")$sinput="无";
if($soutput=="")$soutput="无";
if($row->hint=="")$row->hint="无";
//if($row->source=="")$row->source="无";
//if($sinput) {
//echo "<h2>$MSG_Sample_Input</h2>
//<pre class=content><span class=sampledata>".($sinput)."</span></pre>";
//}
//if($soutput){
//echo "<h2>$MSG_Sample_Output</h2>
//<pre class=content><span class=sampledata>".($soutput)."</span></pre>";
//}
//if ($pr_flag||true)
//echo "<h2>$MSG_HINT</h2>
//<div class=content><p>".nl2br($row->hint)."</p></div>";
//if ($pr_flag)
//echo "<h2>$MSG_Source</h2>
//<div class=content><p><a href='problemset.php?search=$row->source'>".nl2br($row->source)."</a></p></div>";
//if ($pr_flag){
//    echo "[<a href='submitpage.php?id=$id'>$MSG_SUBMIT</a>]";
//}else{
//    echo "[<a href='submitpage.php?cid=$cid&pid=$pid&langmask=$langmask'>$MSG_SUBMIT</a>]";
//}
//echo "[<a href='problemstatus.php?id=".$row->problem_id."'>$MSG_STATUS</a>]";
//echo "[<a href='bbs.php?pid=".$row->problem_id."$ucid'>$MSG_BBS</a>]";
?>

            <div class="col-lg-9" style="width: 70%;">

                <div class="content_box">
                    <div style="margin: 20px;">
                        <div class="contest_msg_title">
                        <p style="text-align: left;">
                        <?php 
                            $PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                            $id=$row->problem_id;
                            if($pr_flag)echo "问题 ".$row->problem_id.": ".$row->title;
                            else echo "问题 ".$PID[$pid].": ".$row->title;
                        ?></p>
                        </div>
                            <p>时间限制: <?php echo $row->time_limit; ?>Sec 内存限制: <?php echo $row->memory_limit; ?>MB 提交: <?php echo $row->submit; ?> 解决: <?php echo $row->accepted; ?></p>
                    </div>
                </div>

                <div class="content_box">

                <div class="panel_prob">
                    <div class="panel_prob_head">题目描述</div>
                    <div class="panel_prob_body"><?php echo $row->description;?></div>
                </div>
                <div class="panel_prob">
                    <div class="panel_prob_head">输入</div>
                    <div class="panel_prob_body"><?php echo $row->input;?></div>
                </div>
                <div class="panel_prob"> 
                    <div class="panel_prob_head">输出</div>
                    <div class="panel_prob_body"><?php echo $row->output?></div>
                </div>
                <div class="panel_prob">
                    <div class="panel_prob_head">样例输入</div>
                    <div class="panel_prob_body"><pre class="sampledata"><?php echo $sinput;?></pre></div>
                </div>
                <div class="panel_prob">
                    <div class="panel_prob_head">样例输出</div>
                    <div class="panel_prob_body"><pre class="sampledata"><?php echo $soutput;?></pre></div>
                </div>
                <div class="panel_prob">
                    <div class="panel_prob_head">提示</div>
                    <div class="panel_prob_body"><?php echo $row->hint;?></div>
                </div>
                <div class="panel_prob">
                    <div class="panel_prob_head">标签</div>
                    <div class="panel_prob_body">
                    <!-- <?php echo nl2br($row->source);?> -->
                    <?php
                        if (isset($_SESSION['administrator'])) {
                            if ($row->source!="" || $row->source!=NULL) {
                                $cats=explode(" ",$row->source);
                                foreach($cats as $cat){
                                    if(trim($cat)=="") continue;
                                    echo "<a class='a_gray' style='margin-right:10px;line-height:30px;' href='problemset.php?search=".rawurlencode(htmlentities($cat,ENT_QUOTES,'UTF-8'))."'><button type='button' style='border-radius: 0px;' class='btn btn-primary btn-xs'>".htmlentities($cat,ENT_QUOTES,'utf-8')."</button></a>&nbsp;";
                                }
                            }
                        }
                    ?>
                        
                    </div>
                </div>

                <div style="height: 420px;padding: 15px;">

                <div style="height: 36px;">
                    <!-- <form action="#" class="form-inline"> -->
                        <div class="col-lg-2" style="padding-left:0px;">
                            <select name="language" id="lang_chose" class="form-control">
                                <option value="0"<?php if($source_lang==0) echo ' selected';?>>C</option>
                                <option value="1"<?php if($source_lang==1) echo ' selected';?>>C++</option>
                                <option value="3"<?php if($source_lang==3) echo ' selected';?>>Java</option>
                                <option value="6"<?php if($source_lang==6) echo ' selected';?>>Python</option>
                                <option value="7"<?php if($source_lang==7) echo ' selected';?>>PHP</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary light_blue form-control" onclick="set_lan();">代码重置</button>
                        </div>

                        <div style="float: right;" class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                    <!-- </form> -->
                </div>
                <div id="editor" class="col-lg-12"><?php if(isset($view_src) && $view_src!="")echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></div>
                <script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                <script>
                    var editor = ace.edit("editor");
                    var c_prime_code = '#include<stdio.h>\nint main()\n{\n    int a,b;\n    while(~scanf("%d%d", &a, &b))printf("%d\\n",a+b);\n    return 0;\n}';
                    var cpp_prime_code = '#include<iostream>\nusing namespace std;\nint main()\n{\n    int a,b;\n    while(cin>>a>>b)cout<<(a+b)<<endl;\n    return 0;\n}';
                    var java_prime_code = 'import java.util.Scanner;\n\npublic class Main {\n\tpublic static void main(String[] args) {\n\t\tScanner scanner = new Scanner(System.in);\n\t\twhile (scanner.hasNext()) {\n\t\t\tint a = scanner.nextInt();\n\t\t\tint b = scanner.nextInt();\n\t\t\tint c = a + b;\n\t\t\tSystem.out.println(c);\n\t\t}\n\t}\n}';
                    var Python_prime_code = 'while True:\n\ttry:\n\t\ta,b=map(int,input().strip().split())\n\t\tprint(a+b)\n\texcept:\n\t\tbreak';
                    var PHP_prime_code = '\<?php\n\twhile(fscanf(STDIN, "%d %d", $a, $b) == 2)\n\t\tprint ($a + $b)."\\n";';
                    // editor.setTheme("ace/theme/twilight");
                    editor.session.setMode("ace/mode/c_cpp");
                    //editor.setValue(c_prime_code);
                    if(editor.getValue()==undefined || editor.getValue()=="" || editor.getValue()==null)
                        editor.setValue(c_prime_code);
                    editor.gotoLine(1);
                    // 
                    // editor.session.setMode("ace/mode/java");
                </script>
                <div id="tijiao">
                    <div class="form-group pull-right">
                        <script>
                            function fillSource(){
                                document.getElementById("source").value=editor.getValue();
                                document.getElementById("language_submit").value=document.getElementById("lang_chose").value;
                                return true;
                            }
                        </script>
                        <form action="submit.php" method="post" id="form_prosub" onsubmit="fillSource()">
                            <?php if(isset($_GET['id'])){?>
                                <input name="id" type="text" value="<?php echo $id; ?>"  hidden>
                            <?php }else {?>
                                <input name="cid" type="text" value="<?php echo $cid; ?>"  hidden>
                                <input name="pid" type="text" value="<?php echo $pid; ?>"  hidden>
                            <?php } ?>
                            <input name="language" id="language_submit" hidden>
                            <textarea name="source" id="source" hidden></textarea>
                            <button type="button" id="tijiao" class="btn btn-primary light_blue form-control">提交</button>
                            <?php
                                if(isset($_SESSION['administrator'])){
                                    require_once("include/set_get_key.php");
                            ?>
                                <a href="xktms/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >编辑</a>
                                <a href="xktms/quixplorer/index.php?action=list&dir=<?php echo $row->problem_id?>&order=name&srt=yes" >测试数据</a>
                            <?php
                            }
                            ?>
                        </form>
                    </div>
                </div>

                </div>

                </div>

                <div class="nextbox">
                  <a href="/oj/problem<?php echo ($id-1);?>.html">上一题</a>
                  <a href="/oj/problem<?php echo ($id+1);?>.html">下一题</a>
                </div>

            </div><!-- col-9 -->
            <div class="col-lg-3" style="width: 30%;">

                    <div class="content_box col-lg-12 pie_panel">
                      <div><p class="div_box_head_2">通过率</p></div>
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
                    <div class="content_box col-lg-12 pie_panel">
                      <div><p class="div_box_head_2">统　计</p></div>
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
                    <div class="content_box col-lg-12 pie_panel">
                        <div><p class="div_box_head_2">解题报告</p></div>
                        <ul class="nav nav-stacked nav-pills text-center">
                          <li><a href="/blog/alist<?php echo $id;?>">我要看题解</a></li>
                          <li><a href="/blog/aedit<?php echo $id;?>">我来写题解</a></li>
                        </ul>
                        <!-- <a class="<?php if($on_contest) echo ' disabled ';?>"  <?php if(!$on_contest)echo "href='discuss$id.html'";else echo" title='这个题目在比赛中, 不可讨论' ";?>>我要吐槽我要水</a> -->
                    </div>

            </div><!-- /col-lg-3 -->

     </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
    <script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/flot/jquery.flot.pie.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/awesomechart.js"></script>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/problem.js?v=201904160313"></script>
    <script type="text/javascript" charset='utf-8' language='javascript'>
        var session_user=0;
        <?php if (isset($_SESSION['user_id'])) { ?>
            session_user=1;
        <?php } ?>
        $("#tijiao").click(function(){
            if(session_user==1){
                $("#form_prosub").submit();
            }else{
                alert("请先登录后再提交！");  
            }
        });
    </script>
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
              ],
              color: ['#CC0033','#339900','#CC9900','#3366CC','#9900CC','#66CC66','#CC6600','#666699']
          };
          myChart.setOption(option);
    </script>

<!-- 百度分享 -->
<!-- <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script> -->
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","tieba","douban","sqq"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  </body>
</html>
