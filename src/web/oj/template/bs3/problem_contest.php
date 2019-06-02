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
    </style>
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>      
    <?php require_once("template/$OJ_TEMPLATE/contestnav.php");?> 
      <!-- Main component for a primary marketing message or call to action -->
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
?>
        
            <div class="col-lg-9">
                <div class="content_box">
                    <div style="margin: 20px;">
                        <div class="contest_msg_title">
                        <p style="text-align: left;"><?php 
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
                    <div class="panel_prob_head">来源</div>
                    <div class="panel_prob_body"><?php echo nl2br($row->source);?></div>
                </div>

                <div style="height: 415px;padding: 15px;">

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
                        <form action="submit.php" method="post" onsubmit="fillSource()">
                            <?php if(isset($_GET['id'])){?>
                                <input name="id" type="text" value="<?php echo $id; ?>"  hidden>
                            <?php }else {?>
                                <input name="cid" type="text" value="<?php echo $cid; ?>"  hidden>
                                <input name="pid" type="text" value="<?php echo $pid; ?>"  hidden>
                            <?php } ?>
                            <input name="language" id="language_submit" hidden>
                            <textarea name="source" id="source" hidden></textarea>
                            <button type="submit" class="btn btn-primary light_blue form-control">提交</button>
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
            </div><!-- col-9 -->
            <div class="col-lg-3">
                <div class="content_box div_contest_descrp">
                    <div><p class="div_box_head_2">比赛公告</p></div>
                    <div style="margin: 20px;">
                        <div class="contest_msg_descrp">
                            <?php 
                            if ($view_description!="") {
                                echo $view_description;
                            }
                            else {
                                echo "暂无……";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="content_box">
                    <div><p class="div_box_head_2">比赛状况</p></div>
                    <ul class="nav nav-stacked nav-pills text-center">
                        <li><a href='contest<?php echo $view_cid?>.html'>题目列表</a></li>
                        <li><a href='status.php?cid=<?php echo $view_cid?>'>提交状态</a></li>
                        <li><a href='contestrank.php?cid=<?php echo $view_cid?>'>比赛排名</a></li>
                        <li><a href='contestrank-oi.php?cid=<?php echo $view_cid?>'>OI赛制排名</a></li>
                        <li><a href='conteststatistics.php?cid=<?php echo $view_cid?>'>综合统计</a></li>
                    </ul>
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

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
    
  </body>
</html>
