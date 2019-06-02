<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

//维护更新(默认注释掉，维护中开启)
/*if (!isset($_SESSION['administrator'])) {
    $view_errors="<p style='text-align: center;font-size: 18px;'>VIP在线学习系统正在短暂临时维护，请稍后登录！</p>";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}*/
//

if(!isset($_SESSION['user_id'])){
    header("location:/oj/registerpage.php");
    /*$view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
    require("template/".$OJ_TEMPLATE."/error.php");*/
    exit(0);
}
$user_id=$_SESSION['user_id'];

$subject_vip=$_GET['subject'];

//VIP判断
$now=time();

switch ($subject_vip) {
    case 'c':
        $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
        $section_mark=100;
        $lock_id_first=1000;
        $text_subject="C语言课程";
        break;
    case 'cpp':
        $sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
        $section_mark=200;
        $lock_id_first=2000;
        $text_subject="C++课程";
        break;
    case 'suanfa':
        $sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
        $section_mark=300;
        $lock_id_first=3000;
        $text_subject="算法课程";
        break;
        
}
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_array($result);
$vip_end=strtotime($row[0]);
$vip_end_date=date("Y-m-d",$vip_end);
if ($vip_end<$now) {
    header("location:/vipmb/order_check/");
    /*$view_errors="<p style='text-align: center;font-size: 18px;'>VIP在线学习系统仅对VIP会员开放。<br><br>开通VIP，即刻体验学习系统!</p><h4 style='text-align: center;margin-top: 80px;'><a href='/vipmb/order_check/'><button class='btn btn-primary'>开通VIP会员</button></a></h4>";
    require("template/".$OJ_TEMPLATE."/error.php");*/
    exit(0);
}
mysqli_free_result($result);

//无class参数初始化
if (!isset($_GET['class'])) {
    $sql="SELECT `class_id` FROM `vipclass` WHERE `lock_id`='$lock_id_first'";
    $result=mysqli_query($mysqli, $sql);
    $row=mysqli_fetch_object($result);
    $class=$row->class_id;
}
else {
    $class=$_GET['class'];
}

//所属章节
$sql="SELECT `section` FROM `vipclass` WHERE `class_id`='$class'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$section=$row->section;

if (!$section || $section<$section_mark || $section>($section_mark+100)) {
    $view_errors="课程编号错误!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

//下一课课程ID
$sql="SELECT `lock_id` FROM `vipclass` WHERE `class_id`='$class'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$lock_id=$row->lock_id;
$lock_next=$lock_id+1;
$sql="SELECT `class_id` FROM `vipclass` WHERE `lock_id`='$lock_next'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$class_next=$row->class_id;


//课程解锁判断
if(isset($_SESSION['administrator'])){
    $locked=0;
    $next_locked=0;
}
else {
    if ($lock_id!=$lock_id_first) {
        $sql="SELECT * FROM `users` WHERE `user_id`='".$user_id."' AND find_in_set('".$class."',vipclass_unlock)";
        $result=mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($result) != 0)
        {
            $locked=0;
        }
        else {
            $locked=1;
        }
    }
    else {
        $locked=0;
    }

    $sql="SELECT * FROM `users` WHERE `user_id`='".$user_id."' AND find_in_set('".$class_next."',vipclass_unlock)";
    $result=mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($result) != 0)
    {
        $next_locked=0;
    }
    else {
        $next_locked=1;
    }
}

//课程未锁定时的脚本
if ($locked==0) {

//题目
$sub_arr=Array();
// submit
if (isset($_SESSION['user_id'])){
    $sql="SELECT `problem_id` FROM `solution` WHERE `user_id`='".$_SESSION['user_id']."'".
                                                                           //  " AND `problem_id`>='$pstart'".
                                                                           // " AND `problem_id`<'$pend'".
    	" group by `problem_id`";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));
    while ($row=mysqli_fetch_array($result))
    	$sub_arr[$row[0]]=true;
}

$acc_arr=Array();
// ac
if (isset($_SESSION['user_id'])){
    $sql="SELECT `problem_id` FROM `solution` WHERE `user_id`='".$_SESSION['user_id']."'".
                                                                           //  " AND `problem_id`>='$pstart'".
                                                                           //  " AND `problem_id`<'$pend'".
    	" AND `result`=4".
    	" group by `problem_id`";
    $result=@mysqli_query($mysqli,$sql) or die(mysqli_error());
    while ($row=mysqli_fetch_array($result))
    	$acc_arr[$row[0]]=true;
}

$sql="select * from (SELECT `problem`.`title` as `title`,`problem`.`problem_id` as `pid`,vipclass_problem.num as pnum
	FROM `vipclass_problem`,`problem`
	WHERE `vipclass_problem`.`problem_id`=`problem`.`problem_id` 
	AND `vipclass_problem`.`class_id`=$class ORDER BY `vipclass_problem`.`num` 
	        ) problem
	order by pnum";
$result=mysqli_query($mysqli,$sql);
$view_problemset=Array();

$unlock=0;
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    $view_problemset[$cnt][0]= "<a href='/vipstudy_".$subject_vip."/problem/?id=".$row->pid."&class=".$class."'>$row->title</a>";
	if (isset($sub_arr[$row->pid])){
	    if (isset($acc_arr[$row->pid])) {
	      	$view_problemset[$cnt][1]="<span class='btn hard_label btn_ac label-success'>Y</span>";
        }
	    else {
            $unlock++;
	        $view_problemset[$cnt][1]= "<span class='btn hard_label btn_ac label-danger'>N</span>";
        }
	}else{
        $unlock++;
		$view_problemset[$cnt][1]= "<span class=none> </span>";
	}
	$cnt++;
}
mysqli_free_result($result);

/*解锁下一课*/
                                     
if ($next_locked!=0) {
    if ($unlock==0) {
        $sql="UPDATE users SET vipclass_unlock=CONCAT(vipclass_unlock,'".$class_next.",') WHERE user_id='".$user_id."'";
        mysqli_query($mysqli,$sql) or die("未响应，请重试!\n");
        $alert_quest="<p class='text_quest'><img class='img_quest' src='/oj/template/$OJ_TEMPLATE/img/icon018.png'><span>恭喜您完成课后题目！下一课已解锁！</span></p>";
    }
    else {
        $alert_quest="<p class='text_quest'><img class='img_quest' src='/oj/template/$OJ_TEMPLATE/img/icon019.png'><span>完成本课题目，全部正确即可解锁下一课。</span></p>";
    }
}
else {
    $alert_quest="<p class='text_quest'><img class='img_quest' src='/oj/template/$OJ_TEMPLATE/img/icon018.png'><span>已完成课后题目！</span></p>";
}

}//课程未锁定脚本结束

//视频和描述
$sql="SELECT * FROM `vipclass` WHERE `class_id`=$class";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$title=$row->title;
$descrp=$row->descrp;
$video=$row->video;
mysqli_free_result($result);

$view_title=$title." - VIP在线学习系统 - C语言网";

//全部课程
require("inc_vip_".$subject_vip."_var.php");

require("template/".$OJ_TEMPLATE."/study.php");
?>