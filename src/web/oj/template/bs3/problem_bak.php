<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
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
    
<?php
//if ($row->spj) echo "&nbsp;&nbsp;<span class=red>Special Judge</span>";
?>
<?php
//echo "$MSG_Description".$row->description;
//echo "$MSG_Input".$row->input;
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
if($row->source=="")$row->source="无";
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
$judge_color=Array("btn gray","btn btn-sm btn-info","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-success","btn btn-sm btn-danger","btn btn-sm btn-danger","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-info");

$sql="SELECT `blog_id`,`title`,`user_id`,`problem_id`,`nice`,`post_time` FROM `blog` WHERE `problem_id`='".$id."' ORDER BY `post_time` DESC LIMIT 3";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

$blog_data=Array();
$i=0;
while ($blog_row=mysqli_fetch_object($result)){
    $blog_data[$i]=Array();
    $blog_data[$i][0]="<td><a style='font-size: 16px;' href='blog_detail.php?blog_id=".$blog_row->blog_id."'>".$blog_row->title."</a><br />";
    $blog_data[$i][1]="<span style='font-size: 12px;float: right;'>作者：<a href='userinfo.php?user=".$blog_row->user_id."'>".getNickByid($blog_row->user_id)."</a>　赞：".$blog_row->nice."</span></td>"; 
    $i++;
}
mysqli_free_result($result);
?>
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">题目描述</div>
                    <div class="panel-body"><?php echo $row->description;?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">输入</div>
                    <div class="panel-body"><?php echo $row->input;?></div>
                </div>
                <div class="panel panel-default"> 
                    <div class="panel-heading">输出</div>
                    <div class="panel-body"><?php echo $row->output?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">样例输入</div>
                    <div class="panel-body"><pre class="sampledata"><?php echo $sinput;?></pre></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">样例输出</div>
                    <div class="panel-body"><pre class="sampledata"><?php echo $soutput;?></pre></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">提示</div>
                    <div class="panel-body"><?php echo $row->hint;?></div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">来源</div>
                    <div class="panel-body"><?php echo nl2br($row->source);?></div>
                </div>
                <div>
                    <!-- <form action="#" class="form-inline"> -->
                        <div class="col-lg-2" style="padding-left:0px;">
                            <select name="language" id="lang_chose" class="form-control">
                                <option value="0"<?php if($source_lang==0) echo ' selected';?>>C</option>
                                <option value="1"<?php if($source_lang==1) echo ' selected';?>>C++</option>
                                <option value="3"<?php if($source_lang==3) echo ' selected';?>>Java</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary light_blue" onclick="set_lan();">代码重置</button>
                        </div>
                    <!-- </form> -->
                </div>
                <div id="editor" class="col-lg-12"><?php if(isset($view_src) && $view_src!="")echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></div>
                <script src="src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
                <script>
                    var editor = ace.edit("editor");
                    var c_prime_code = '#include<stdio.h>\nint main(){\n    int a,b;\n    while(~scanf("%d%d", &a, &b))printf("%d\\n",a+b);\n    return 0;\n}';
                    var cpp_prime_code = '#include<iostream>\nusing namespace std;\nint main(){\n    int a,b;\n    while(cin>>a>>b)cout<<(a+b)<<endl;\n    return 0;\n}';
                    var java_prime_code = 'import java.util.Scanner;\n\npublic class Main {\n\tpublic static void main(String[] args) {\n\t\tScanner scanner = new Scanner(System.in);\n\t\twhile (scanner.hasNext()) {\n\t\t\tint a = scanner.nextInt();\n\t\t\tint b = scanner.nextInt();\n\t\t\tint c = a + b;\n\t\t\tSystem.out.println(c);\n\t\t}\n\t}\n}';
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
                        <form id="form-ajaxsub" action="submit.php" method="post" onsubmit="fillSource()">
                            <?php if(isset($_GET['id'])){?>
                                <input name="id" type="text" value="<?php echo $id; ?>"  hidden>
                                <input name="language" id="language_submit" hidden>
                                <textarea name="source" id="source" hidden></textarea>
                                <button type="button" class="btn btn-primary light_blue" onclick=ajax_submit();>提交</button>
                            <?php }else {?>
                                <input name="cid" type="text" value="<?php echo $cid; ?>"  hidden>
                                <input name="pid" type="text" value="<?php echo $pid; ?>"  hidden>
                                <input name="language" id="language_submit" hidden>
                                <textarea name="source" id="source" hidden></textarea>
                                <button type='submit' class='btn btn-primary light_blue'>提交</button>
                            <?php } ?>
                            <?php
                                if(isset($_SESSION['administrator'])){
                                    require_once("include/set_get_key.php");
                            ?>
                                <a href="xktms/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >编辑</a>
                                <a href="xktms/quixplorer/index.php?action=list&dir=<?php echo $row->problem_id?>&order=name&srt=yes" >测试数据</a>
                            <?php
                            }
                            ?>
                            <a class="btn btn-primary light_blue <?php if($on_contest) echo ' disabled ';?>"  <?php if(!$on_contest)echo "href='discuss$id.html'";else echo" title='这个题目在比赛中, 不可讨论' ";?>>讨论</a>
                        </form>
                    </div>
                </div>
                <?php if(isset($_GET['id'])){?>
                <div>
                  <table id="result_ajax" class="table table-striped">
                    <tr>
                      <td><?php echo $MSG_RUNID?></td>
                      <td><?php echo $MSG_PROBLEM?></td>
                      <td><?php echo $MSG_MEMORY?></td>
                      <td><?php echo $MSG_TIME?></td>
                      <td><?php echo $MSG_LANG?></td>
                      <td><?php echo $MSG_CODE_LENGTH?></td>
                      <td><?php echo $MSG_RESULT?></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                  <div id="ceinfo_ajax"></div>
                  <div>
                    <?php 
                      $id_r=$id-1;
                      $id_n=$id+1;
                    ?>
                    <table class="table">
                      <tr>
                        <td width="15%"><a class="btn btn-primary light_blue" href='problemset.html'>返回题库</a></td>
                        <td width="15%"><a class="btn btn-primary light_blue" href='status.php?user_id=<?php echo $_SESSION['user_id'];?>'>结果记录</a></td>
                        <td width="50%"></td>
                        <td width="10%"><a class="btn btn-primary light_blue" href='problem<?php echo $id_r;?>.html'>上一题</a></td>
                        <td width="10%"><a class="btn btn-primary light_blue" href='problem<?php echo $id_n;?>.html'>下一题</a></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <?php } ?>
            </div><!-- col-9 -->
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
                    <div class="col-lg-12 pie_panel">
                        <p class="text-center pie_panel_head">题解</p>
                        <table class="table">
                            <?php
                                foreach ($blog_data as $row_tr) {
                                    echo "<tr>";
                                    foreach ($row_tr as $row_td) {
                                        echo $row_td;
                                    }
                                echo "</tr>";
                                }
                            ?>
                        </table>
                        <p style="margin: 10px;"><a href="blog_list.php?id=<?php echo $id;?>">更多……</a><a style="float: right;" href="blog_edit.php?id=<?php echo $id;?>">我来写题解</a></p>
                    </div>
                </div><!-- /row-->
            </div><!-- /col-lg-3 -->
        </div><!--/row -->
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
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/problem.js"></script>
    <script type="text/javascript">
      var judge_result=[<?php
      foreach($judge_result as $result){
      echo "'$result',";
      }
      ?>''];
      var judge_color=[<?php
      foreach($judge_color as $result){
      echo "'$result',";
      }
      ?>''];
      function auto_refresh(){
          var td=$("#result_ajax tr:eq(1) td");
        
          var cell=td.eq(6).html();
          td.addClass("td_result");
        //  alert(cell);
          var sid=td.eq(0).html();
          for(var j=0;j<4;j++){
            if(cell.indexOf(judge_result[j])!=-1){
      //         alert(sid);
               fresh_result(sid);
            }
          }
        
      }
      function fresh_result(solution_id)
      {
      var xmlhttp;
      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {
          var td=$("#result_ajax tr:eq(1) td");
          //alert(row);
          var r=xmlhttp.responseText;
          var ra=r.split(",");
          // alert(r);
          // alert(judge_result[r]);
          var loader="<img width=18 src=image/loader.gif>";
          td.eq(6).html("<span class='btn btn-warning'>"+judge_result[ra[0]]+"</span>"+loader);
          td.eq(2).html(ra[1]);
          td.eq(3).html(ra[2]);
          if(ra[0]<4){
            window.setTimeout("fresh_result("+solution_id+")",2000);
          }
          
          else {
            
          /*td.eq(6).html("<span class='"+judge_color[ra[0]]+"'>"+judge_result[ra[0]]+"</span>");*/
          ajax_refresh(solution_id);
          console.log(ra);
          }
      }
      }
      xmlhttp.open("GET","status-ajax.php?solution_id="+solution_id,true);
      xmlhttp.send();
      }
      function refresh_result(data)
      {
        var data=$.parseJSON(data);
        var td=$("#result_ajax tr:eq(1) td");
        td.eq(0).html(data.solution_id);
        td.eq(1).html(data.problem_id);
        td.eq(2).html(data.memory);
        td.eq(3).html(data.time);
        td.eq(4).html(data.language);
        td.eq(5).html(data.code_length);
        td.eq(6).html(data.result);
      }
      function view_result(data)
      {
        if (data=='1') {
          alert("请登录后再提交!");
          return 0;
        }
        else if (data=='31') {
          alert("没有这个题目!");
          return 0;
        }
        else if (data=='21') {
          alert("现在不能提交，因为你没有被邀请或比赛已结束！");
          return 0;
        }
        else if (data=='22') {
          alert("你不能提交,因为你没资格参加这个私有比赛!");
          return 0;
        }
        else if (data=='23') {
          alert("没有这个题目!");
          return 0;
        }
        else if (data=='11') {
          alert("代码太短!");
          return 0;
        }
        else if (data=='12') {
          alert("代码太长!");
          return 0;
        }
        else if (data=='13') {
          alert("10s内只能提交一次代码.....");
          return 0;
        }
        else {
          var data=$.parseJSON(data);
          var td=$("#result_ajax tr:eq(1) td");
          td.eq(0).html(data.solution_id);
          td.eq(1).html(data.problem_id);
          td.eq(2).html(data.memory);
          td.eq(3).html(data.time);
          td.eq(4).html(data.language);
          td.eq(5).html(data.code_length);
          td.eq(6).html(data.result);
          return auto_refresh();
        }
        
        /*var tb=window.document.getElementById('result-ajax');
        var tr=$("#result-ajax tr:eq(1) td:eq(0)");
        var td=tr.td;*/
        /*$("#result-ajax tr:eq(1) td:eq(0)").html(data.solution_id);
        $("#result-ajax tr:eq(1) td:eq(1)").html(data.problem_id);
        $("#result-ajax tr:eq(1) td:eq(2)").html(data.memory);
        $("#result-ajax tr:eq(1) td:eq(3)").html(data.result);*/
        /*tr[1].td[0].innerHTML=data['solution_id'];
        tr[1].td[1].innerHTML=data['problem_id'];
        tr[1].td[2].innerHTML=data['memory'];
        tr[1].td[3].innerHTML=data['result'];*/
      }
      function ajax_refresh(solution_id)
      {
        $.get("prob_ajax_refresh.php?sid="+solution_id,function(data){refresh_result(data)});
      }
      function ajax_submit()
      {
        document.getElementById("source").value=editor.getValue();
        document.getElementById("language_submit").value=document.getElementById("lang_chose").value;
        $.post("submit.php?ajax",$("#form-ajaxsub").serialize(),function(data){view_result(data)});
        /*var td=$("#result_ajax tr:eq(1) td");
        var cell=td.eq(3).html();
        console.log(cell);*/ 
         
      }

        /*function ceinfo_ajax()
        {
            var ce=$("#ceinfo_ajax").html();
            ce.html("<pre class='brush:c;' id='errtxt' ><?php echo $view_reinfo?></pre><div id='errexp'>Explain:</div>");
            return view_ceinfo(sid);
        }
        function view_ceinfo(sid)
        {
            
        }*/
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
              ]
          };
          myChart.setOption(option);
    </script>

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    
  </body>
</html>
