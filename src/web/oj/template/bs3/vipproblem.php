<?php 
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
    <link rel="stylesheet" href="/oj/template/<?php echo $OJ_TEMPLATE;?>/css/problem.css">
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/vipclass.css"> 
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/accordion.css">
  <style type="text/css">
      .content_r{
        border-radius: 0px;
        border: 1px solid #ddd;
        box-shadow: 0px 0px 10px 3px #ccc;
      }
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
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
      <div class="content_r">
          <!-- <div class="div_box_body1">
        <p>C语言网在线学习系统 - 第<?php echo $class;?>课</p>
      </div> -->
        <div>
          <div class="class_head"></div>
          <p style="text-align: left;font-weight: bold;padding: 20px 30px;margin: 0px; color: #999;font-size: 18px;">
            <?php 
                $PID="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $id=$row->problem_id;
                if($pr_flag)echo "问题 ".$row->problem_id.": ".$row->title;
                else echo "问题 ".$PID[$pid].": ".$row->title;
            ?>
            <a class="rlink" href="/oj/myvalue.php?user=<?php echo $user_id;?>" style="float: right;">
              <button class="btn btn-primary" style="border-radius: 0px;position: relative;bottom: 3px;">我的学习成果</button>
            </a>
          </p>
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
                <div class="col-xs-2" style="padding-left:0px;">
                    <select name="language" id="lang_chose" class="form-control">
                        <option value="0"<?php if($source_lang==0) echo ' selected';?>>C</option>
                        <option value="1"<?php if($source_lang==1) echo ' selected';?>>C++</option>
                        <option value="3"<?php if($source_lang==3) echo ' selected';?>>Java</option>
                    </select>
                </div>
                <div class="col-xs-2">
                    <button class="btn btn-primary light_blue form-control" onclick="set_lan();">代码重置</button>
                </div>
            <!-- </form> -->
        </div>
        <div id="editor" class="col-xs-12"><?php if(isset($view_src) && $view_src!="")echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></div>
        <script src="/oj/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
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
                <form action="/oj/submit.php" method="post" onsubmit="fillSource()">

                    <?php if(isset($_GET['id'])){?>
                        <input name="id" type="text" value="<?php echo $id; ?>"  hidden>
                        <?php if(isset($_GET['class'])){?>
                        <input name="class" type="text" value="<?php echo $class; ?>"  hidden>
                        <input name="subject" type="text" value="<?php echo $subject_vip; ?>"  hidden>
                    <?php }} else {?>
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
                        <a href="/oj/xktms/problem_edit.php?id=<?php echo $id?>&getkey=<?php echo $_SESSION['getkey']?>" >编辑</a>
                        <a href="/oj/xktms/quixplorer/index.php?action=list&dir=<?php echo $row->problem_id?>&order=name&srt=yes" >测试数据</a>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
        </div>

        </div>
      </div>
      </div>

      <div class="col-xs-2" style="width: 14.2333333%;">
          <div class="content_box content_r">
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
      
    </div> <!-- /container -->
    </div> <!-- /wrap -->
<?php require("template/$OJ_TEMPLATE/footer.php");?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>
<script src="template/<?php echo $OJ_TEMPLATE;?>/js/problem.js?v=201904160313"></script>
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