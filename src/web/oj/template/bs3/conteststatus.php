<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里可以参加包括ACM、NOI在内的各种C/C++/java程序比赛，也可以DIY举办各类程序比赛活动！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo "比赛状态 - C语言网";?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
    <?php require_once("template/$OJ_TEMPLATE/contestnav.php");?>
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
      <div class="col-lg-9">
        <div class="content_box">
                <div class="div_box_body1">
                    <div class="contest_msg_title"><p><?php echo $view_title?></p></div>
                    <font>【状态:
                        　<?php
                        if ($view_private=='0')
                            echo "<span class=blue>公开</span>";
                        else
                            echo "&nbsp;&nbsp;<span class=red>私有</span>";
                        ?>
                        　<?php
                        if ($now>$end_time)
                            echo "<span class=red>已结束</span>";
                        else if ($now<$start_time)
                            echo "<span class=red>等待中</span>";
                        else
                            echo "<span class=red>进行中</span>";
                        ?>】
                    </font>
                <!-- </div>
                <div class="div_box_body1"> -->
                <div class="contest_msg_status">
                    
                    <!-- 　　 -->
                    开始时间: <font color=#993399><?php echo $view_start_time?></font>
                    　　
                    结束时间: <font color=#993399><?php echo $view_end_time?></font>
                    　　
                    <div style="display: inline-block;float: right;width: 210px;">服务器时间: <font id=nowdate></font></div>
                </div>
                </div>
        <!-- </div>
        <div class="content_box"> -->
<!-- <div align=center class="input-append">
<?php 
$cactive=1;

?>
<form id=simform class=form-inline action="status.php" method="get">
<input class="form-control" type=text size=10 name=problem_id placeholder="题号" value='<?php echo htmlspecialchars($problem_id, ENT_QUOTES)?>'>
<input class="form-control" type=text size=10 name=user_id placeholder="昵称" value='<?php echo htmlspecialchars($user_id, ENT_QUOTES)?>'>
<?php if (isset($cid)) echo "<input type='hidden' name='cid' value='$cid'>";?>
<?php echo $MSG_LANG?>:<select class="form-control" size="1" name="language">
<?php if (isset($_GET['language'])) $language=intval($_GET['language']);
else $language=-1;
if ($language<0||$language>=count($language_name)) $language=-1;
if ($language==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
$i=0;
foreach ($language_name as $lang){
if ($i==$language)
echo "<option value=$i selected>$language_name[$i]</option>";
else
echo "<option value=$i>$language_name[$i]</option>";
$i++;
}
?>
</select>
<?php echo $MSG_RESULT?>:<select class="form-control" size="1" name="jresult">
<?php if (isset($_GET['jresult'])) $jresult_get=intval($_GET['jresult']);
else $jresult_get=-1;
if ($jresult_get>=12||$jresult_get<0) $jresult_get=-1;
/*if ($jresult_get!=-1){
$sql=$sql."AND `result`='".strval($jresult_get)."' ";
$str2=$str2."&jresult=".strval($jresult_get);
}*/
if ($jresult_get==-1) echo "<option value='-1' selected>All</option>";
else echo "<option value='-1'>All</option>";
for ($j=0;$j<12;$j++){
$i=($j+4)%12;
if ($i==$jresult_get) echo "<option value='".strval($jresult_get)."' selected>".$jresult[$i]."</option>";
else echo "<option value='".strval($i)."'>".$jresult[$i]."</option>";
}
echo "</select>";
?>
</select>
<?php if(isset($_SESSION['administrator'])||isset($_SESSION['source_browser'])){
if(isset($_GET['showsim']))
$showsim=intval($_GET['showsim']);
else
$showsim=0;
echo "SIM:
<select id=\"appendedInputButton\" class=\"form-control\" name=showsim onchange=\"document.getElementById('simform').submit();\">
<option value=0 ".($showsim==0?'selected':'').">All</option>
<option value=50 ".($showsim==50?'selected':'').">50</option>
<option value=60 ".($showsim==60?'selected':'').">60</option>
<option value=70 ".($showsim==70?'selected':'').">70</option>
<option value=80 ".($showsim==80?'selected':'').">80</option>
<option value=90 ".($showsim==90?'selected':'').">90</option>
<option value=100 ".($showsim==100?'selected':'').">100</option>
</select>";
/* if (isset($_GET['cid']))
echo "<input type=hidden name=cid value='".$_GET['cid']."'>";
if (isset($_GET['language']))
echo "<input type=hidden name=language value='".$_GET['language']."'>";
if (isset($_GET['user_id']))
echo "<input type=hidden name=user_id value='".$_GET['user_id']."'>";
if (isset($_GET['problem_id']))
echo "<input type=hidden name=problem_id value='".$_GET['problem_id']."'>";
//echo "<input type=submit>";
*/
}
echo "<input type=submit class='form-control btn btn-primary' value='$MSG_SEARCH'></form>";
?>
</div> -->
<!-- <hr style="border:0px;"/> -->

<table id=result-tab class="table table-striped content-box-header table_style_new table_style_contest" align=center>
<thead>
<tr class='toprow' >
<th width="12%"><?php echo $MSG_RUNID?>
<th><?php echo '昵称'?>
<th><?php echo $MSG_PROBLEM?>
<th width="15%"><?php echo $MSG_RESULT?>
<th><?php echo $MSG_MEMORY?>
<th><?php echo $MSG_TIME?>
<th><?php echo $MSG_LANG?>
<th width="10%"><?php echo $MSG_CODE_LENGTH?>
<th width="20%" class="text-center"><?php echo $MSG_SUBMIT_TIME?>
</tr>
</thead>
<tbody>
<?php
$cnt=0;
foreach($view_status as $row){
if ($cnt)
echo "<tr class='oddrow'>";
else
echo "<tr class='evenrow'>";
foreach($row as $table_cell){
echo "<td>";
echo "\t".$table_cell;
echo "</td>";
}
echo "</tr>";
$cnt=1-$cnt;
}
?>
</tbody>
</table>

<div class="text-center">
<?php echo "<a class='btn btn-primary' href=status.php?".$str2.">第一页</a>&nbsp;&nbsp;";
if (isset($_GET['prevtop']))
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".intval($_GET['prevtop']).">上一页</a>&nbsp;&nbsp;";
else
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".($top+20).">上一页</a>&nbsp;&nbsp;";
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".$bottom."&prevtop=$top>下一页</a>";
?>
<hr style="height:20px;border:0px;">
</div>
        </div>
      </div>
      <div class="col-lg-3">
          <!-- <div class="content_box">
            <div><p class="div_box_head_2">服务器时间</p></div>
            <div class="div_box_body1">
              <p style="font-size: 36px;color: #333;text-align: center;" id=nowtime></p>
              　<span style="font-size: 14px;color: #666;float: right;" id=nowdate></span>
            </div>
          </div> -->
          <div class="content_box div_contest_descrp">
              <div><p class="div_box_head_2">比赛公告</p></div>
              <div class="div_box_body2">
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
                      <li><a style="border-left: 6px solid #4071FD;font-weight: bolder;" href='status.php?cid=<?php echo $view_cid?>'>提交状态</a></li>
                      <li><a href='contestrank.php?cid=<?php echo $view_cid?>'>比赛排名</a></li>
                      <li><a href='contestrank-oi.php?cid=<?php echo $view_cid?>'>OI赛制排名</a></li>
                      <li><a href='conteststatistics.php?cid=<?php echo $view_cid?>'>综合统计</a></li>
                  </ul>
          </div>
      </div>
    </div> <!-- /container -->
    </div> <!-- /wrap-->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	   
<script>
var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
//alert(diff);
function clock()
{
var x,h,m,s,n,xingqi,y,mon,d;
var x = new Date(new Date().getTime()+diff);
y = x.getYear()+1900;
if (y>3000) y-=1900;
mon = x.getMonth()+1;
d = x.getDate();
xingqi = x.getDay();
h=x.getHours();
m=x.getMinutes();
s=x.getSeconds();
n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
//alert(n);
document.getElementById('nowdate').innerHTML=n;
setTimeout("clock()",1000);
}
clock();
</script>  
<script type="text/javascript">
var i=0;
var judge_result=[<?php
foreach($judge_result as $result){
echo "'$result',";
}
?>''];
//alert(judge_result[0]);
function auto_refresh(){
	var tb=window.document.getElementById('result-tab');
//alert(tb);
	var rows=tb.rows;
	for(var i=1;i<rows.length;i++){
		var cell=rows[i].cells[3].children[0].innerHTML;
		rows[i].cells[3].className="td_result";
	//	alert(cell);
		var sid=rows[i].cells[0].innerHTML;
	        for(var j=0;j<4;j++){
			if(cell.indexOf(judge_result[j])!=-1){
//			   alert(sid);
			   fresh_result(sid);
			}
		}
	}
}
function findRow(solution_id){
var tb=window.document.getElementById('result-tab');
var rows=tb.rows;
for(var i=1;i<rows.length;i++){
var cell=rows[i].cells[0];
// alert(cell.innerHTML+solution_id);
if(cell.innerHTML==solution_id) return rows[i];
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
var tb=window.document.getElementById('result-tab');
var row=findRow(solution_id);
//alert(row);
var r=xmlhttp.responseText;
var ra=r.split(",");
// alert(r);
// alert(judge_result[r]);
var loader="<img width=18 src=image/loader.gif>";
row.cells[3].innerHTML="<span class='btn btn-warning'>"+judge_result[ra[0]]+"</span>"+loader;
row.cells[4].innerHTML=ra[1];
row.cells[5].innerHTML=ra[2];
if(ra[0]<4)
window.setTimeout("fresh_result("+solution_id+")",2000);
else
window.location.reload();
}
}
xmlhttp.open("GET","status-ajax.php?solution_id="+solution_id,true);
xmlhttp.send();
}
//<?php if ($last>0&&$_SESSION['user_id']==$_GET['user_id']) echo "fresh_result($last);";?>
//alert(123);
   var hj_ss="<select class='http_judge form-control' length='2' name='result'>";
	for(var i=0;i<10;i++){
   		hj_ss+="	<option value='"+i+"'>"+judge_result[i]+" </option>";
	}
   hj_ss+="</select>";
   hj_ss+="<input name='manual' type='hidden'>";
   hj_ss+="<input class='http_judge form-control' size=5 title='输入判定原因与提示' name='explain' type='text'>";
   hj_ss+="<input class='http_judge btn' name='manual' value='确定' type='submit'>";

auto_refresh();
$(".http_judge_form").append(hj_ss);
$(".http_judge_form").submit(function (){
   var sid=this.children[0].value;
   $.post("xktms/problem_judge.php",$(this).serialize(),function(data,textStatus){
   		if(textStatus=="success")window.setTimeout("fresh_result("+sid+")",1000);
	})
   return false;
});
$(".td_result").mouseover(function (){
//   $(this).children(".btn").hide(300);
   $(this).children(".http_judge_form").show(600);
});
$(".http_judge_form").hide();
</script>
  </body>
</html>
