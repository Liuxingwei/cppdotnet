<?php
$cache_time=30;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/setlang.php');

//登录及会员判断
if (isset($_GET['id'])){
    $id=intval($_GET['id']);   
    $id_p=$id;
}
if (isset($_GET['cid']) && isset($_GET['pid'])){
    $cid=intval($_GET['cid']);
    $pid=intval($_GET['pid']);
    $sql="SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=$cid AND `num`=$pid";
    $result=mysqli_query($mysqli,$sql);
    $row=mysqli_fetch_object($result);
    mysqli_free_result($result);
    $id_p=$row->problem_id;
}
$sql="SELECT `vip` FROM `problem` WHERE `problem_id`=$id_p AND `defunct`='N'";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
mysqli_free_result($result);
$isvprob=$row->vip;
if ($isvprob==1) {
    if(!isset($_SESSION['user_id'])){
        $view_errors="该题为VIP专享，仅对VIP会员开放，请<a href=loginpage.php>登录</a>!";
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
        $view_errors="VIP题目仅对VIP会员开放!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    mysqli_free_result($result);
}

$now=strftime("%Y-%m-%d %H:%M",time());
if (isset($_GET['cid'])) $ucid="&cid=".intval($_GET['cid']);
else $ucid="";
require_once("./include/db_info.inc.php");

if(isset($OJ_LANG)){
        require_once("./lang/$OJ_LANG.php");
}
require_once("./include/const.inc.php");
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
}else if (isset($_GET['cid']) && isset($_GET['pid'])){
        // contest
        $cid=intval($_GET['cid']);
        $pid=intval($_GET['pid']);

        if (!isset($_SESSION['administrator']))
                $sql="SELECT langmask,private,defunct FROM `contest` WHERE `defunct`='N' AND `contest_id`=$cid AND `start_time`<='$now'";
        else
                $sql="SELECT langmask,private,defunct FROM `contest` WHERE `defunct`='N' AND `contest_id`=$cid";
        $result=mysqli_query($mysqli,$sql);
        $rows_cnt=mysqli_num_rows($result);
        $row=mysqli_fetch_row($result);
        $contest_ok=true;
        if ($row[1] && !isset($_SESSION['c'.$cid])) $contest_ok=false;
        if ($row[2]=='Y') $contest_ok=false;
        if (isset($_SESSION['administrator'])) $contest_ok=true;
                               
       
        $ok_cnt=$rows_cnt==1;              
        $langmask=$row[0];
        mysqli_free_result($result);
        if ($ok_cnt!=1){
                // not started
                $view_errors=  "找不到这个比赛!!!";
       
                require("template/".$OJ_TEMPLATE."/error.php");
                exit(0);
        }else{
                // started
                $sql="SELECT * FROM `problem` WHERE `defunct`='N' AND `problem_id`=(
                        SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=$cid AND `num`=$pid
                        )";
        }
        // public
        if (!$contest_ok){
       
                $view_errors= "不合法!!!";
                require("template/".$OJ_TEMPLATE."/error.php");
                exit(0);
        }
        $co_flag=true;
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
           $sql="SELECT  contest.`contest_id` , contest.`title`,contest_problem.num FROM `contest_problem`,`contest` WHERE contest.contest_id=contest_problem.contest_id and `problem_id`=$id and defunct='N'  ORDER BY `num`";
           //echo $sql;
           $result=mysqli_query($mysqli,$sql);
           if($i=mysqli_num_rows($result)){
              $view_errors.= "这个问题在以下的比赛进行中:<br>";
                   for (;$i>0;$i--){
                                $row=mysqli_fetch_row($result);
                                $view_errors.= "<a href=contest".$row[0]."_problem".$row[2].".html>$row[0]:$row[1]</a><br>";
                               
                        }
                                 
                               
                }else{
                        $view_title= "<title>问题未找到!</title>";
                        $view_errors.= "<h2>找不到这个问题!</h2>";
                }
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

//summary
$sql = "SELECT result,COUNT(solution_id) as cnt FROM solution ";
if($pr_flag){
    $sql.="WHERE `problem_id`=$id ";
}else{
    $sql.="WHERE `problem_id`=$id AND `contest_id`=$cid ";
    $row->submit=0;
    $row->accepted=0;
    //wait to finish...
}
$sql.="GROUP BY result";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
while($obj=mysqli_fetch_object($result)){
    $summary[$obj->result]=$obj->cnt;
    if(!$pr_flag){
        // echo " <script>console.log('".$obj->result."')</script> ";
        if($obj->result==4)$row->accepted=$obj->cnt;
        $row->submit+=$obj->cnt;
    }
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
$row=$tmpRow;

//lang for load source code
$source_lang=0;
if(isset($_GET['lang'])){
    $source_lang=intval($_GET['lang']);
    if($source_lang<0)$source_lang=0;
}
$on_contest=false;
//problem is on contest
$sql="SELECT * FROM `contest_problem` WHERE `problem_id`=$id AND `contest_id` IN (SELECT `contest_id` FROM `contest` WHERE `start_time`<'$now' AND `end_time`>'$now')";
$result=mysqli_query($mysqli, $sql) or die(mysqli_error());
if(mysqli_num_rows($result)!=0){
    $on_contest=true;
    $_SESSION["oncontest"+$id]=true;
}
if($id==1000){
    $on_contest=false;
    if(!isset($_SESSION["oncontest1000"]))$_SESSION["oncontest1000"]=true;   
}

mysqli_free_result($result);

/////////////////////////Template
if (isset($_GET['id'])){
    require("template/".$OJ_TEMPLATE."/problem.php");
}else if (isset($_GET['cid']) && isset($_GET['pid'])){
    require("template/".$OJ_TEMPLATE."/problem_contest.php");
}
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');

/*//静态化
  require_once('include/cache-static_end.php');
//*/

?>

