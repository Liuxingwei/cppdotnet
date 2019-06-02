<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="在线编程|在线编译|在线写代码|在线写C语言|在线写C++|在线写Java|在线写Python|在线写php">
    <meta name="description" content="支持多语言，可以在线写代码，编译、调试运行的在线编译解释器">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("../oj/template/$OJ_TEMPLATE/css.php");?>	    

    <style type="text/css">
      .container-fluid {
        padding: 0px;
      }
      .btn {
        border-radius: 0px;
        border: 0px;
      }
      #result {
        color: #F8F8F2;
      }
      /*div.toptip {
        display: none;
      }*/
      .div_area_code,.div_inoutput,.div_input,.div_output {
          padding: 0px;
        }
      .div_area_code {
        height: 50%;
        padding-bottom: 5px;
      }
      .div_inoutput {
        height: 35%;
      }
      .div_input {
        height: 30%;
        padding-bottom: 5px;
      }
      .div_output {
        height: 60%;
      }
      .area_code {
        height: 100%;
      }
      .area_input {
        height: 100%;
      }
      .area_output {
        height: 100%;
      }
      @media (min-width: 992px) {
        .div_area_code,.div_inoutput,.div_input,.div_output {
          padding: 0px;
          height: auto;
        }
        .div_area_code {
          padding-right: 5px;
        }
        .area_code {
          height: 814px;
        }
        .area_input {
          height: 309px;
        }
        .area_output {
          height: 500px;
        }
      }
    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="background: #333333;height: 100%;">
    
    <div class="container-fluid" style="height: 100%;">
        
      <!-- Main component for a primary marketing message or call to action -->
 <center style="height: 100%;">
<?php
if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
{
$OJ_EDITE_AREA=false;
}
if($OJ_EDITE_AREA){
?>
<script language="Javascript" type="text/javascript" src="/oj/edit_area/edit_area_full.js"></script>
<?php }?>
<form style="height: 100%;" id=frmSolution action="compiler_ol_submit.php" method="post" class="form-inline">

<div style="background: #272822; margin-bottom: 5px; min-height: 50px;line-height: 50px;">

<div class="col-md-6" style="color: #F8F8F2;font-size: 16px;font-weight: bold;text-align: left;">
  Dotcpp在线编译　
<select style="background: #4b4b4b; color: #F8F8F2;vertical-align: baseline;" name="language" id="language" onchange="reloadtemplate(this.options[this.options.selectedIndex].value);" class="form-control">
    <option value="0"<?php if($lastlang==0) echo ' selected';?>>C</option>
    <option value="1"<?php if($lastlang==1) echo ' selected';?>>C++</option>
    <option value="3"<?php if($lastlang==3) echo ' selected';?>>Java</option>
    <option value="6"<?php if($lastlang==6) echo ' selected';?>>Python</option>
    <option value="7"<?php if($lastlang==7) echo ' selected';?>>PHP</option>
</select>
　<input style="vertical-align: baseline;" id=TestRun class="btn btn-primary" type=button value="运行" onclick=do_test_run();>　<input style="vertical-align: baseline;" type=reset class="btn btn-danger" value="重置">　<span id=result></span>
</div>

<!-- <div class="col-md-4 col-md-offset-4" style="text-align: right;color: #F8F8F2;font-size: 16px;">

</div> -->

</div>

<div class="col-md-6 div_area_code">
<pre class="area_code" style="border-radius: 0px; border: 0px; font-size: 14px;" cols=180 rows=20 id="source"><?php echo htmlentities($view_src,ENT_QUOTES,"UTF-8")?></pre>
</div>
<input type=hidden id="hide_source" name="source" value=""/>



<div class="col-md-6 div_inoutput">

<div class="col-md-12 div_input">
<textarea class="area_input" style="width:100%; background: #272822; color: #F8F8F2; border: 0px;" cols=40 id="input_text" name="input_text" placeholder="输入..."></textarea>
</div>
<div class="col-md-12 div_output">
<textarea class="area_output" style="width:100%; background: #272822; color: #F8F8F2; border: 0px;" cols=40 id="out" name="out" placeholder="输出..."></textarea>
</div>

</div>

</form>
</center>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("../oj/template/$OJ_TEMPLATE/js.php");?>	   
 <script>
var sid=0;
var i=0;
var judge_result=[<?php
foreach($judge_result as $result){
echo "'$result',";
}
?>''];
function print_result(solution_id)
{
sid=solution_id;
$("#out").load("/oj/status-ajax_t.php?tr=1&solution_id="+solution_id);
}
function fresh_result(solution_id)
{
sid=solution_id;
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
var tb=window.document.getElementById('result');
var r=xmlhttp.responseText;
var ra=r.split(",");
// alert(r);
// alert(judge_result[r]);
var loader="<img width=18 src=/oj/image/loader.gif>";
var tag="span";
/*if(ra[0]<4) tag="span disabled=true";
else tag="a";*/
{
	if(ra[0]==11)
	
	tb.innerHTML="<"+tag+">"+judge_result[ra[0]]+"</"+tag+">";
	else
	tb.innerHTML="<"+tag+">"+judge_result[ra[0]]+"</"+tag+">";
}
if(ra[0]<4)tb.innerHTML+=loader;
if(ra[0]<4)
window.setTimeout("fresh_result("+solution_id+")",2000);
else
window.setTimeout("print_result("+solution_id+")",20);
}
}
xmlhttp.open("GET","/oj/status-ajax_t.php?solution_id="+solution_id,true);
xmlhttp.send();
}
function getSID(){
var ofrm1 = document.getElementById("testRun").document;
var ret="0";
if (ofrm1==undefined)
{
ofrm1 = document.getElementById("testRun").contentWindow.document;
var ff = ofrm1;
ret=ff.innerHTML;
}
else
{
var ie = document.frames["frame1"].document;
ret=ie.innerText;
}
return ret+"";
}
var count=0;
/*function do_submit(){
if(typeof(eAL) != "undefined"){ eAL.toggle("source");eAL.toggle("source");}
var mark="<?php echo isset($id)?'problem_id':'cid';?>";
var problem_id=document.getElementById(mark);
if(mark=='problem_id')
problem_id.value='<?php echo $id?>';
else
problem_id.value='<?php if (isset($cid))echo $cid?>';
document.getElementById("frmSolution").target="_self";
<?php if($OJ_LANG=="cn") echo "if(checksource(document.getElementById('source').value))";?>
document.getElementById("frmSolution").submit();
}*/
var handler_interval;
function do_test_run(){
if( handler_interval) window.clearInterval( handler_interval);
var loader="<img width=18 src=/oj/image/loader.gif>";
var tb=window.document.getElementById('result');
var source=$("#source").val();
if(typeof(editor) != "undefined") {
  source=editor.getValue();
        $("#hide_source").val(source);
}
if($("#hide_source").val().length<10) return alert("too short!");
tb.innerHTML=loader;

/*var mark="<?php echo isset($id)?'problem_id':'cid';?>";
var problem_id=document.getElementById(mark);
problem_id.value=-problem_id.value;*/
document.getElementById("frmSolution").target="testRun";
//document.getElementById("frmSolution").submit();
$.post("/oj/compiler_ol_submit.php?ajax",$("#frmSolution").serialize(),function(data){fresh_result(data);});
document.getElementById("TestRun").disabled=true;
/*document.getElementById("Submit").disabled=true;
problem_id.value=-problem_id.value;*/
count=20;
handler_interval= window.setTimeout("resume();",1000);
}
function resume(){
count--;
/*var s=document.getElementById('Submit');*/
var t=document.getElementById('TestRun');
if(count<0){
/*s.disabled=false;*/
t.disabled=false;
/*s.value="<?php echo $MSG_SUBMIT?>";*/
t.value="<?php echo "运行"?>";
if( handler_interval) window.clearInterval( handler_interval);
}else{
/*s.value="<?php echo $MSG_SUBMIT?>("+count+")";*/
t.value="<?php echo "运行"?>("+count+")";
window.setTimeout("resume();",1000);
}
}

function switchLang(lang){
    var langnames=new Array("c_cpp","c_cpp","pascal","java","ruby","sh","python","php","perl","csharp","objectivec","vbscript","scheme","c_cpp","c_cpp","lua","javascript","golang");
    editor.getSession().setMode("ace/mode/"+langnames[lang]);
}
function reloadtemplate(lang){
   console.log("lang="+lang);
   document.cookie="lastlang="+lang.value;
   //alert(document.cookie);
   var url=window.location.href;
   var i=url.indexOf("sid=");
   if(i!=-1) url=url.substring(0,i-1);
  /*if(confirm("该操作将重置已编辑的代码，确定这么做吗？"))
       document.location.href=url;*/
   switchLang(lang);
}

</script>
<script src="/oj/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="/oj/src-noconflict/ext-language_tools.js"></script>
<script>
    ace.require("ace/ext/language_tools");
    var editor = ace.edit("source");
    editor.setTheme("ace/theme/monokai");/*monokai vibrant_ink*/
    switchLang(<?php echo $lastlang ?>);
    editor.setOptions({
      enableBasicAutocompletion: true,
      enableSnippets: true,
      enableLiveAutocompletion: true
    });
   reloadtemplate($("#language").val()); 
</script> 
<script type="text/javascript">
$(document).ready(function (){
  editor.setValue('#include<stdio.h>\nint main()\n{\n\tprintf("**************************\\n");\n\tprintf("dotcpp.com\\n");\n\tprintf("**************************\\n");\n\treturn 0;\n}');
  editor.gotoLine(1);
});
</script>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
  </body>
</html>
