<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="训练场状态 在线评测动态">
    <meta name="description" content="训练场问题提交实时动态.">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $view_title?></title>  
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
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
      <div class="col-lg-9">
        <div class="content_box">


<!-- <hr style="border:0px;"/> -->
<div id=center>
<table id=result-tab class="table table-striped content-box-header table_style_new" align=center style="font-size:14px;">
<thead>
<tr class='toprow'>
<th width="11%"><?php echo $MSG_RUNID?>
<th width="12%"><?php echo '昵称'?>
<th width="7%"><?php echo $MSG_PROBLEM?>
<th width="16%"><?php echo $MSG_RESULT?>
<th width="7%"><?php echo $MSG_MEMORY?>
<th width="1%"><!-- <?php echo $MSG_TIME?> -->
<th width="8%"><?php echo $MSG_LANG?>
<th width="10%"><?php echo $MSG_CODE_LENGTH?>
<th width="20%" class="text-center"><?php echo $MSG_SUBMIT_TIME?>
<th ><?php echo $MSG_JUDGER?>
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
<div class="text-center" style="padding-bottom:20px;">
<?php echo "<a class='btn btn-primary' href=status.php?".$str2.">第一页</a>&nbsp;&nbsp;";
if (isset($_GET['prevtop']))
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".intval($_GET['prevtop']).">上一页</a>&nbsp;&nbsp;";
else
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".($top+20).">上一页</a>&nbsp;&nbsp;";
echo "<a class='btn btn-primary' href=status.php?".$str2."&top=".$bottom."&prevtop=$top>下一页</a>";
?>
</div>
        </div> <!-- content_box -->
      </div> <!-- col-lg-9 -->
      <div class="col-lg-3">
            <div class="content_box">
                <div><p class="div_box_head_2">结果查询</p></div>
                <div align=center class="input-append">
                    <form id=simform style="margin: 20px;" action="status.php" method="get">
                    <div class="form-group">
                      <input class="form-control" type=text placeholder="题号" size=10 name=problem_id value='<?php echo  htmlspecialchars($problem_id, ENT_QUOTES) ?>'>
                    </div>
                    <div class="form-group">
                      <input class="form-control" type=text placeholder="昵称" size=10 name=user_id value='<?php echo  htmlspecialchars($user_id, ENT_QUOTES) ?>'>
                    </div>
                    <?php if (isset($cid)) echo "<div class='form-group'><input type='hidden' name='cid' value='$cid'></div>";?>
                    <div class="form-group form-inline">
                      <div class="div_input_left" style="width: 30%;"><?php echo $MSG_LANG?></div><select style="width: 70%;" class="form-control" name="language">
                      <?php if (isset($_GET['language'])) $language=intval($_GET['language']);
                      else $language=-1;
                      if ($language<0||$language>=count($language_name)) $language=-1;
                      if ($language==-1) echo "<option value='-1' selected>All</option>";
                      else echo "<option value='-1'>All</option>";
                      $i=0;
                      $language_name_oj=Array();
                      $language_name_oj[]=$language_name[0];
                      $language_name_oj[]=$language_name[1];
                      $language_name_oj[]=$language_name[3];
                      $language_name_oj[]=$language_name[6];
                      $language_name_oj[]=$language_name[7];
                      foreach ($language_name_oj as $lang){
                      switch ($i) {
                        case 2:
                          $k=3;
                          break;
                        case 3:
                          $k=6;
                          break;
                        case 4:
                          $k=7;
                          break;
                        default:
                          $k=$i;
                          break;
                      }
                      if ($k==$language)
                      echo "<option value=$k selected>$language_name_oj[$i]</option>";
                      else
                      echo "<option value=$k>$language_name_oj[$i]</option>";
                      $i++;
                      }
                      ?>
                      </select>
                    </div>
                    <div class="form-group form-inline">
                      <div class="div_input_left" style="width: 30%;"><?php echo $MSG_RESULT?></div><select style="width: 70%;" class="form-control" name="jresult">
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
                    </div>
                    <?php if(isset($_SESSION['administrator'])||isset($_SESSION['source_browser'])){
                    if(isset($_GET['showsim']))
                    $showsim=intval($_GET['showsim']);
                    else
                    $showsim=0;
                    echo "<div class='form-group'>SIM:
                    <select id=\"appendedInputButton\" class=\"form-control\" name=showsim onchange=\"document.getElementById('simform').submit();\">
                    <option value=0 ".($showsim==0?'selected':'').">All</option>
                    <option value=50 ".($showsim==50?'selected':'').">50</option>
                    <option value=60 ".($showsim==60?'selected':'').">60</option>
                    <option value=70 ".($showsim==70?'selected':'').">70</option>
                    <option value=80 ".($showsim==80?'selected':'').">80</option>
                    <option value=90 ".($showsim==90?'selected':'').">90</option>
                    <option value=100 ".($showsim==100?'selected':'').">100</option>
                    </select></div>";
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
                    echo "<div class='form-group'><input type=submit class='form-control btn btn-primary' value='$MSG_SEARCH'></div></form>";
                    ?>
                    <!-- ===========================================form================================= -->
                </div>
            </div>
            <div class="content_box">
                <div id="classification_content">
                    <a href="#" class="active">题目类型</a><a href="#">题目难度</a>
                    <ul class="nav nav-stacked nav-pills text-center">
                        <li><a href="problemset.php">全部问题</a></li>
                        <li><a href="problemset.php?mark=0"><?php echo $mark_name[0];?></a></li>
                        <li><a href="problemset.php?mark=1"><?php echo $mark_name[1];?></a></li>
                        <li><a href="problemset.php?mark=2"><?php echo $mark_name[2];?></a></li>
                        <li><a href="problemset.php?mark=3"><?php echo $mark_name[3];?></a></li>
                        <li><a href="problemset.php?mark=4"><?php echo $mark_name[4];?></a></li>
                        <li><a href="problemset.php?mark=5"><?php echo $mark_name[5];?></a></li>
                        <li><a href="problemset.php?mark=6"><?php echo $mark_name[6];?></a></li>
                        <li><a href="problemset.php?mark=7"><?php echo $mark_name[7];?></a></li>
                    </ul>
                    <ul class="nav nav-stacked nav-pills text-center" hidden>
                        <li><a href="problemset.php">全部问题</a></li>
                        <li><a href="problemset.php?difficulty=0"><?php echo $difficulty_name[0];?></a></li>
                        <li><a href="problemset.php?difficulty=1"><?php echo $difficulty_name[1];?></a></li>
                        <li><a href="problemset.php?difficulty=2"><?php echo $difficulty_name[2];?></a></li>
                        <li><a href="problemset.php?difficulty=3"><?php echo $difficulty_name[3];?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
    <script src="template/<?php echo $OJ_TEMPLATE; ?>/js/problemset.js"></script>  
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
