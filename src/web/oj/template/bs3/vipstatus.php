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
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/vipclass.css"> 
    <link rel="stylesheet" href="<?php echo $url_oj."template/$OJ_TEMPLATE";?>/css/accordion.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      a.rlink {
        text-decoration: none;
        color: #999;
      }
      a.rlink:hover {
        color: #00baff;
      }
    </style>
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
        <div class="content_box content_r">
          <div>
            <div class="class_head"></div>
            <p style="text-align: left;font-weight: bold;padding: 20px 30px;margin: 0px; color: #999;font-size: 18px;">
              近期提交结果状态　　<?php echo "<a class='rlink' href='/vipstudy_".$subject_vip."/problem/?id=".$id."&class=".$class."'>返回习题</a>";?>
              <a class="rlink" href="/oj/myvalue.php?user=<?php echo $user_id;?>" style="float: right;">
                <button class="btn btn-primary" style="border-radius: 0px;position: relative;bottom: 3px;">我的学习成果</button>
              </a>
            </p>
          </div>

<!-- <hr style="border:0px;"/> -->
<div id=center>
<table id=result-tab class="table table-striped content-box-header table_style_new" align=center style="font-size:14px;">
<thead>
<tr class='toprow'>
<th ><?php echo $MSG_RUNID?>
<th ><?php echo '昵称'?>
<th ><?php echo $MSG_PROBLEM?>
<th ><?php echo $MSG_RESULT?>
<th width="8%"><?php echo $MSG_MEMORY?>
<th width="7%"><?php echo $MSG_TIME?>
<th width="7%"><?php echo $MSG_LANG?>
<th width="10%"><?php echo $MSG_CODE_LENGTH?>
<th width="20%" class="text-center"><?php echo $MSG_SUBMIT_TIME?>
<!-- <th ><?php echo $MSG_JUDGER?> -->
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
      </div> <!-- col-xs-9 -->
      
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
</html>
