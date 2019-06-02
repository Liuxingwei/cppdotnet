<?php
$cache_time=30;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/setlang.php');

if(isset($OJ_LANG)){
        require_once("./lang/$OJ_LANG.php");
}
require_once("./include/const.inc.php");

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=/oj/loginpage.php>登录</a>后再进行此操作!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_SESSION['user_id'];

$class=$_GET['class'];
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
    $view_errors="VIP题目仅对开通VIP课程的用户开放!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
mysqli_free_result($result);

//所属章节
$sql="SELECT `section` FROM `vipclass` WHERE `class_id`='$class'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$section=$row->section;

if (!$section || $section<$section_mark || $section>($section_mark+100)) {
    $view_errors="课程编号错误!".$subject_vip."-----".$class."-----".$section_mark;
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$pr_flag=false;
$co_flag=false;
if(!isset($_SESSION['user_id'])){
    $_SESSION['prev_page']=curPageURL();
    // echo "<!-- ".$_SESSION['prev_page']." -->";
}
if (isset($_GET['id'])){
        // practice
        $id=intval($_GET['id']);
  //require("oj-header.php");
        if (!isset($_SESSION['administrator']) && $id!=1000&&!isset($_SESSION['contest_creator']))
                // $sql="SELECT * FROM `problem` WHERE `problem_id`=$id AND `defunct`='N' AND `problem_id` NOT IN (
                //                 SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN(
                //                                 SELECT `contest_id` FROM `contest` WHERE `end_time`>'$now' or `private`='1'))
                //                 ";
            $sql="SELECT * FROM `problem` WHERE `problem_id`=$id AND `defunct`='N' ";
        else
            $sql="SELECT * FROM `problem` WHERE `problem_id`=$id";

        $pr_flag=true;
}else{
        $view_errors=  "<title>$MSG_NO_SUCH_PROBLEM</title><h2>$MSG_NO_SUCH_PROBLEM</h2>";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
}
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

       
if (mysqli_num_rows($result)!=1){
    $view_errors="";
    if(isset($_GET['id'])){
      $id=intval($_GET['id']);
           mysqli_free_result($result);
    }else{
            $view_title= "<title>问题未找到!</title>";
            $view_errors.= "<h2>找不到这个问题!</h2>";
    }
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
}else{
        $row=mysqli_fetch_object($result);
        $id=$row->problem_id;
        $view_title= $row->title;
       
}
mysqli_free_result($result);

//source code
$tmpRow=$row;
$view_src="";
// foreach($_GET as $k=>$d){
//     echo "<script>console.log('".$k."=>".$d."')</script>";
// }
if(isset($_GET['sid'])){
        $sid=intval($_GET['sid']);
        $sql="SELECT * FROM `solution` WHERE `solution_id`=".$sid;
        $result=mysqli_query($mysqli,$sql) or die(mysqli_error());
        $row=mysqli_fetch_object($result);
        if ($row && $row->user_id==$_SESSION['user_id']) $ok=true;
        if (isset($_SESSION['source_browser'])) $ok=true;
        mysqli_free_result($result);
        if ($ok==true){
            $sql="SELECT `source` FROM `source_code` WHERE `solution_id`='".$sid."'";
            $result=mysqli_query($mysqli,$sql);
            $row=mysqli_fetch_object($result);
            if($row)
                $view_src=$row->source;
            mysqli_free_result($result);
        }
                        
}


//lang for load source code
$source_lang=0;
if(isset($_GET['lang'])){
    $source_lang=intval($_GET['lang']);
    if($source_lang<0)$source_lang=0;
}
$on_contest=false;


if($id==1000){
    $on_contest=false;
    if(!isset($_SESSION["oncontest1000"]))$_SESSION["oncontest1000"]=true;   
}

mysqli_free_result($result);

//全部课程
require("inc_vip_".$subject_vip."_var.php");

$row=$tmpRow;

/////////////////////////Template

require("template/".$OJ_TEMPLATE."/vipproblem.php");

/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');

?>

