<?php
ini_set("display_errors","On");
 $cache_time=10; 
 $OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");

if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_SESSION['user_id'];
//VIP判断
$now=time();

$sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$vip_end_c=strtotime($row[0]);
$sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$vip_end_cpp=strtotime($row[0]);
$sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$vip_end_suanfa=strtotime($row[0]);
if ($vip_end_c<$now && $vip_end_cpp<$now && $vip_end_suanfa<$now) {
    $view_errors="<p style='text-align: center;font-size: 18px;'>学习成果功能仅对开通VIP课程的用户开放。<br><br>开通VIP课程，即刻体验!</p><h4 style='text-align: center;margin-top: 80px;'><a href='/vipmb/order_check/'><button class='btn btn-primary'>开通VIP会员</button></a></h4>";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
mysqli_free_result($result);

 // check user
$user=$_GET['user'];
if (!is_valid_user_name($user)){
	echo "找不到这个用户!";
	exit(0);
}
$view_title=$user ."@".$OJ_NAME;
$user_mysql=mysqli_real_escape_string($mysqli,$user);
$sql="SELECT `school`,`email`,`nick`,`user_sign`,`user_intro`,`phone`,`address` FROM `users` WHERE `user_id`='$user_mysql'";
$result=mysqli_query($mysqli,$sql);
$row_cnt=mysqli_num_rows($result);
if ($row_cnt==0){ 
	$view_errors= "找不到这个用户!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
}

$row=mysqli_fetch_object($result);
$school=$row->school;
$email=$row->email;
$nick=$row->nick;
$autograph=$row->user_sign;
$intro=$row->user_intro;
$phone=$row->phone;
$address=$row->address;
mysqli_free_result($result);

if(isset($_GET['defunct'])){
	require_once('include/check_get_key.php');
	$defunct=$_GET['defunct']=='Y'?'Y':'N';
	$sql="UPDATE `users` SET `defunct`='$defunct'";
	mysqli_query($mysqli, $sql);
}
//defunct?
$sql="SELECT `defunct` FROM `users` WHERE `user_id`='$user'";
// echo "<!-- $sql -->";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$defunct=$row->defunct=='Y'?true:false;

// count solved
$sql="SELECT count(DISTINCT problem_id) as `ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$AC=$row->ac;
mysqli_free_result($result);
//题目完成数组
$sql="SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4 ORDER BY `problem_id` ASC";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$prob_ac=array();
while ($row=mysqli_fetch_array($result)) {
	$prob_ac[]=$row['problem_id'];
}
mysqli_free_result($result);
//提交数组
$sql="SELECT problem_id FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$prob_sub=array();
while ($row=mysqli_fetch_array($result)) {
$prob_sub[]=$row['problem_id'];
}
mysqli_free_result($result);
//正确数组
$sql="SELECT problem_id FROM `solution` WHERE `user_id`='".$user_mysql."' AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$prob_true=array();
while ($row=mysqli_fetch_array($result)) {
$prob_true[]=$row['problem_id'];
}
mysqli_free_result($result);

//题目分类名称
$attr_value=array();
$attr_value_view=array();
$sql="SELECT attr_value FROM `others`";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
while ($row=mysqli_fetch_array($result)) {
	$attr_value[]=$row['attr_value'];
}
mysqli_free_result($result);
//各分类信息
$k=count($attr_value);
$prob_mark=array();
$prob_ac_mark=array();
$prob_sub_mark=array();
$prob_true_mark=array();
$cnt_prob_ac_mark=array();
$cnt_prob_mark=array();
$pct_ac_mark=array();
$cnt_prob_sub_mark=array();
$cnt_prob_true_mark=array();
$pct_true_mark=array();
$j=0;
for ($i=0; $i < $k ; $i++) { 
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=".$i;
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark_every=array();
	while ($row=mysqli_fetch_array($result)) {
		$prob_mark_every[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	if (count($prob_mark_every)!==0) {
		$prob_ac_mark[]=array_intersect($prob_ac,$prob_mark_every);
		$prob_sub_mark[]=array_intersect($prob_sub,$prob_mark_every);
		$prob_true_mark[]=array_intersect($prob_true, $prob_mark_every);
		$cnt_prob_ac_mark[]=count($prob_ac_mark[$j]);
		$cnt_prob_mark[]=count($prob_mark_every);
		$pct_ac_mark[]=round(($cnt_prob_ac_mark[$j]/$cnt_prob_mark[$j]) ,2)*100;
		$cnt_prob_sub_mark[]=count($prob_sub_mark[$j]);
		$cnt_prob_true_mark[]=count($prob_true_mark[$j]);
		$pct_true_mark[]=round(($cnt_prob_true_mark[$j]/$cnt_prob_sub_mark[$j]) ,2)*100;
		$j+=1;
		$attr_value_view[]=$attr_value[$i];
	}
}

	/*//C语言练习题
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=0";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark0=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark0[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark0=array_intersect($prob_ac,$prob_mark0);
	$prob_sub_mark0=array_intersect($prob_sub,$prob_mark0);
	$prob_true_mark0=array_intersect($prob_true, $prob_mark0);
	$cnt_prob_ac_mark0=count($prob_ac_mark0);
	$cnt_prob_mark0=count($prob_mark0);
	$pct_ac_mark0=round(($cnt_prob_ac_mark0/$cnt_prob_mark0) ,2)*100;
	$cnt_prob_sub_mark0=count($prob_sub_mark0);
	$cnt_prob_true_mark0=count($prob_true_mark0);
	$pct_true_mark0=round(($cnt_prob_true_mark0/$cnt_prob_sub_mark0) ,2)*100;
	//计算机二级考试
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=1";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark1=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark1[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark1=array_intersect($prob_ac,$prob_mark1);
	$prob_sub_mark1=array_intersect($prob_sub,$prob_mark1);
	$prob_true_mark1=array_intersect($prob_true, $prob_mark1);
	$cnt_prob_ac_mark1=count($prob_ac_mark1);
	$cnt_prob_mark1=count($prob_mark1);
	$pct_ac_mark1=round(($cnt_prob_ac_mark1/$cnt_prob_mark1) ,2)*100;
	$cnt_prob_sub_mark1=count($prob_sub_mark1);
	$cnt_prob_true_mark1=count($prob_true_mark1);
	$pct_true_mark1=round(($cnt_prob_true_mark1/$cnt_prob_sub_mark1) ,2)*100;
	//ACM入门
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=2";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark2=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark2[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark2=array_intersect($prob_ac,$prob_mark2);
	$prob_sub_mark2=array_intersect($prob_sub,$prob_mark2);
	$prob_true_mark2=array_intersect($prob_true, $prob_mark2);
	$cnt_prob_ac_mark2=count($prob_ac_mark2);
	$cnt_prob_mark2=count($prob_mark2);
	$pct_ac_mark2=round(($cnt_prob_ac_mark2/$cnt_prob_mark2) ,2)*100;
	$cnt_prob_sub_mark2=count($prob_sub_mark2);
	$cnt_prob_true_mark2=count($prob_true_mark2);
	$pct_true_mark2=round(($cnt_prob_true_mark2/$cnt_prob_sub_mark2) ,2)*100;
	//NOI/ACM大赛题
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=3";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark3=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark3[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark3=array_intersect($prob_ac,$prob_mark3);
	$prob_sub_mark3=array_intersect($prob_sub,$prob_mark3);
	$prob_true_mark3=array_intersect($prob_true, $prob_mark3);
	$cnt_prob_ac_mark3=count($prob_ac_mark3);
	$cnt_prob_mark3=count($prob_mark3);
	$pct_ac_mark3=round(($cnt_prob_ac_mark3/$cnt_prob_mark3) ,2)*100;
	$cnt_prob_sub_mark3=count($prob_sub_mark3);
	$cnt_prob_true_mark3=count($prob_true_mark3);
	$pct_true_mark3=round(($cnt_prob_true_mark3/$cnt_prob_sub_mark3) ,2)*100;
	//蓝桥杯训练
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=6";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark6=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark6[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark6=array_intersect($prob_ac,$prob_mark6);
	$prob_sub_mark6=array_intersect($prob_sub,$prob_mark6);
	$prob_true_mark6=array_intersect($prob_true, $prob_mark6);
	$cnt_prob_ac_mark6=count($prob_ac_mark6);
	$cnt_prob_mark6=count($prob_mark6);
	$pct_ac_mark6=round(($cnt_prob_ac_mark6/$cnt_prob_mark6) ,2)*100;
	$cnt_prob_sub_mark6=count($prob_sub_mark6);
	$cnt_prob_true_mark6=count($prob_true_mark6);
	$pct_true_mark6=round(($cnt_prob_true_mark6/$cnt_prob_sub_mark6) ,2)*100;
	//名校训练
	$sql="SELECT problem_id FROM `problem` WHERE `mark`=7";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$prob_mark7=array();
	while ($row=mysqli_fetch_array($result)) {
	$prob_mark7[]=$row['problem_id'];
	}
	mysqli_free_result($result);
	$prob_ac_mark7=array_intersect($prob_ac,$prob_mark7);
	$prob_sub_mark7=array_intersect($prob_sub,$prob_mark7);
	$prob_true_mark7=array_intersect($prob_true, $prob_mark7);
	$cnt_prob_ac_mark7=count($prob_ac_mark7);
	$cnt_prob_mark7=count($prob_mark7);
	$pct_ac_mark7=round(($cnt_prob_ac_mark7/$cnt_prob_mark7) ,2)*100;
	$cnt_prob_sub_mark7=count($prob_sub_mark7);
	$cnt_prob_true_mark7=count($prob_true_mark7);
	$pct_true_mark7=round(($cnt_prob_true_mark7/$cnt_prob_sub_mark7) ,2)*100;
*/
//总题量
$sql="SELECT count(*) FROM `problem`";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($result);
$prob_cnt=intval($row[0]);
mysqli_free_result($result);

//比赛信息
$sql="SELECT DISTINCT `contest_id` FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_array($result);
$cont_join=array();
while ($row=mysqli_fetch_array($result)) {
	if ($row['contest_id']!=0) {
		$cont_join[]=$row['contest_id'];
	}
}
mysqli_free_result($result);
$cnt_cont=count($cont_join);//参加比赛次数

/*$sql="SELECT count(solution_id) as `cont_tr` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `contest_id`>0 AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$cnt_cont_tr=$row->cont_tr;//比赛题目正确次数
mysqli_free_result($result);
$sql="SELECT count(solution_id) as `cont_sub` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `contest_id`>0";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$cnt_cont_sub=$row->cont_sub;//比赛题目提交次数
mysqli_free_result($result);
$pct_cont_tr=round(($cnt_cont_tr/$cnt_cont_sub) ,2)*100;//比赛题目正确率*/
$sql="SELECT count(DISTINCT problem_id,contest_id) as `cont_ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `contest_id`>0 AND `result`=4";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$cnt_cont_ac=$row->cont_ac;//比赛题目通过次数

$cnt_cont_prob=0;
for ($i=0; $i < $cnt_cont; $i++) { 
	$sql="SELECT count(problem_id) FROM `contest_problem` WHERE `contest_id`='".$cont_join[$i]."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	$cnt_cont_prob+=$row[0];						//参加过的比赛题目总数
	mysqli_free_result($result);
}
$pct_cont_ac=round(($cnt_cont_ac/$cnt_cont_prob) ,2)*100;

rsort($cont_join);
$cont_join_last=array_slice($cont_join,0,5);
sort($cont_join_last);
$cnt_cont_join_last=count($cont_join_last);

$arr_cont_join_last=array();
for ($i=0; $i < $cnt_cont_join_last; $i++) { 
	$sql="SELECT `title` FROM `contest` WHERE `defunct`='N' AND `contest_id`='".$cont_join_last[$i]."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	$cnt_title=$row[0];
	mysqli_free_result($result);
	$sql="SELECT count(problem_id) FROM `contest_problem` WHERE `contest_id`='".$cont_join_last[$i]."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	$row_cnt_prob=$row[0];
	mysqli_free_result($result);
	$sql="SELECT count(DISTINCT problem_id,contest_id) as `cont_ac` FROM `solution` WHERE `user_id`='".$user_mysql."' AND `contest_id`='".$cont_join_last[$i]."' AND `result`=4";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_object($result);
	$row_cnt_ac=$row->cont_ac;
	mysqli_free_result($result);
	$row_pct_ac=round(($row_cnt_ac/$row_cnt_prob) ,2)*100;   //每场比赛题目通过率
	$arr_row=array();
	$arr_row[]=$cont_join_last[$i];
	$arr_row[]=$cnt_title;
	$arr_row[]=$row_pct_ac;
	$arr_cont_join_last[]=$arr_row;
}
	//用户注册时间
	$sql="SELECT `reg_time` FROM `users` WHERE `user_id`='".$user_mysql."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	$time_reg=$row[0];
	mysqli_free_result($result);
	//注册后的比赛参与
	$sql="SELECT count(1) FROM `contest` WHERE `defunct`='N' AND `start_time`>'".$time_reg."'";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_array($result);
	$cnt_cont_can=$row[0];
	$pct_cont_can=round(($cnt_cont/$cnt_cont_can) ,2)*100;        //参与积极度

//近期提交情况
$arr_month_start=array();
$arr_month_view=array();
for ($i=24; $i >= 0 ; $i--) { 
	$arr_month_start[]=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m")-$i,1,date("Y")));
	if ($i > 0) {
		$arr_month_view[]=date("Y年m月",mktime(0, 0 , 0,date("m")-$i,1,date("Y")));
	}
}

$Submit_month=array();
for ($i=0; $i < 24; $i++) { 
	$sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_mysql."' AND unix_timestamp(in_date) >= unix_timestamp('".$arr_month_start[$i]."') AND unix_timestamp(in_date) < unix_timestamp('".$arr_month_start[$i+1]."')";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
	$row=mysqli_fetch_object($result);
	$Submit_month[]=$row->Submit;
	mysqli_free_result($result);
}
// count submission
$sql="SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$row=mysqli_fetch_object($result);
$Submit=$row->Submit;
mysqli_free_result($result);
// update solved 
$sql="UPDATE `users` SET `solved`='".strval($AC)."',`submit`='".strval($Submit)."' WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql);
$sql="SELECT count(*) as `Rank` FROM `users` WHERE `solved`>$AC";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$Rank=intval($row[0])+1;

 if (isset($_SESSION['administrator'])){
$sql="SELECT * FROM `loginlog` WHERE `user_id`='$user_mysql' order by `time` desc LIMIT 0,10";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$view_userinfo=array();
$i=0;
for (;$row=mysqli_fetch_row($result);){
	$view_userinfo[$i]=$row;
	$i++;
}
echo "</table>";
mysqli_free_result($result);
}
$sql="SELECT result,count(1) as cnt FROM solution WHERE `user_id`='$user_mysql'  AND result>=4 group by result order by result";
	$result=mysqli_query($mysqli,$sql);
	$view_userstat=array();
	$i=0;
	$view_summary[4]=$view_summary[5]=$view_summary[6]=$view_summary[7]=$view_summary[9]=$view_summary[10]=$view_summary[11]=0;
	while($row=mysqli_fetch_array($result)){
		$view_userstat[$i++]=$row;
		$view_summary[intval($row[0])]=intval($row[1]);
	}
	$Right=$view_summary[4];
	mysqli_free_result($result);

$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql'   group by md order by md desc ";
	$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
	$chart_data_all= array();
//echo $sql;
    
	while ($row=mysqli_fetch_array($result)){
		$chart_data_all[$row['md']]=$row['c'];
    }
    
$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM `solution` where  `user_id`='$user_mysql' and result=4 group by md order by md desc ";
	$result=mysqli_query($mysqli,$sql);//mysql_escape_string($sql));
	$chart_data_ac= array();
//echo $sql;
    
	while ($row=mysqli_fetch_array($result)){
		$chart_data_ac[$row['md']]=$row['c'];
    }
  
  mysqli_free_result($result);


//代码量
$sql="SELECT solution_id FROM `solution` WHERE `user_id`='".$user_mysql."'";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
$prob_sub=array();
while ($row=mysqli_fetch_array($result)) {
	$solution_sub[]=$row['solution_id'];
}
mysqli_free_result($result);
$cnt_leng=0;
foreach ($solution_sub as $solution_id) {
	$sql="SELECT length(source)-length(replace(source,CHAR(10),'')) FROM source_code WHERE solution_id=".$solution_id;
	$result=mysqli_query($mysqli,$sql);
	$row=mysqli_fetch_array($result);
	$cnt_leng+=$row[0]+1;
}
$pct_leng=($cnt_leng/30000)*100;
mysqli_free_result($result);


$sql="SELECT * FROM `users` WHERE `user_id`='$user'";
$result=mysqli_query($mysqli, $sql);
if($row=mysqli_fetch_object($result)){
	$userinfo_reg_time=$row->reg_time;
	$userinfo_subject=$row->subject;
	$userinfo_phone=$row->phone;
	$userinfo_address=$row->address;
	$userinfo_age=intval($row->age);
	$userinfo_work_field=$row->field;
	if($row->is_work=='0'){
		$userinfo_iswork='学生';
	}else if($row->is_work=='1'){
		$userinfo_iswork='在职';
	}else{
		$userinfo_iswork='待业';
	}
	$userinfo_last_nick_time=$row->last_nick_time;
}

//sugg&rate

//变量
$rate_cont1="优秀";
$rate_cont2="较好";
$rate_cont3="马马虎虎";
$rate_cont4="不太理想";

$rate_prob_1="非常好";
$rate_prob_2="良好";
$rate_prob_3="一般";

$sugg_str="";
$sugg_str_0sub="您的做题量较少，建议您先学习基础教程，然后配合作业进行循序渐进的训练。";
$str3="加大训练量吧！一定要亲自上机敲代码提交并且通过哦，量变引起质变！";
$str2="加大训练，注重算法、数据结构方面题的训练，提高内功！记住：程序 = 算法 + 数据机构！";
$str1="您的表现很不错，可以考虑朝算法的路线发展哦！";
$str_cont="尽量多多参与比赛吧！";

	//基础语法题评价
	$pct_prob_ac_type1=($cnt_prob_ac_mark0+$cnt_prob_ac_mark1)/($cnt_prob_mark0+$cnt_prob_mark1);
	if ($pct_prob_ac_type1>=0.7) {
		$rate_a=$rate_prob_1;
	}
	else if ($pct_prob_ac_type1<0.3) {
		$rate_a=$rate_prob_3;
	}
	else {
		$rate_a=$rate_prob_2;
	}
	//算法数据结构题评价
	$pct_prob_ac_type2=($cnt_prob_ac_mark2+$cnt_prob_ac_mark3+$cnt_prob_ac_mark6+$cnt_prob_ac_mark7)/($cnt_prob_mark2+$cnt_prob_mark3+$cnt_prob_mark6+$cnt_prob_mark7);
	if ($pct_prob_ac_type2>=0.7) {
		$rate_b=$rate_prob_1;
	}
	else if ($pct_prob_ac_type2<0.3) {
		$rate_b=$rate_prob_3;
	}
	else {
		$rate_b=$rate_prob_2;
	}
	//比赛成绩
	if ($pct_cont_ac>=90) {
		$rate_cont=$rate_cont1;
	}
	else if ($pct_cont_ac>=70&&$pct_cont_ac<90) {
		$rate_cont=$rate_cont2;
	}
	else if ($pct_cont_ac>=50&&$pct_cont_ac<70) {
		$rate_cont=$rate_cont3;
	}
	else {
		$rate_cont=$rate_cont4;
	}
	//提交达标判断
	if ($Submit<150) {
		$sugg_str=$sugg_str_0sub;
	}
	else {
		if ($cnt_leng>=20000) {//代码达到一定值
			if ($rate_a==$rate_prob_1&&$rate_b==$rate_prob_1) {
				$sugg_str=$str1;
				if ($pct_cont_can<=60) {
					$sugg_str.=$str_cont;
				}
			}
			else {
				$sugg_str=$str2;
				if ($pct_cont_can<=60) {
					$sugg_str.=$str_cont;
				}
			}
		}
		else {//代码未到一定值
			if ($rate_a==$rate_prob_3||$rate_b==$rate_prob_3) {
				$sugg_str=$str3;
				if ($pct_cont_can<=60) {
					$sugg_str.=$str_cont;
				}
			}
			else {
				$sugg_str=$str2;
				if ($pct_cont_can<=60) {
					$sugg_str.=$str_cont;
				}
			}
		}
	}
	//整体



/////////////////////////Template
require("template/".$OJ_TEMPLATE."/myvalue.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');


?>