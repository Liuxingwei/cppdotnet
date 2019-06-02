<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
require_once('./include/my_func.inc.php');

if(!isset($_SESSION['user_id'])){
    $_SESSION['prev_page']=curPageURL();
    // echo "<!-- ".$_SESSION['prev_page']." -->";
}

$now=strftime("%Y-%m-%d %H:%M",time());
$view_title= "讨论 - C语言网";
$pr_flag=false;
$view_discuss=Array();
if(isset($_GET['id'])){
    $id=intval($_GET['id']);
    $sql="SELECT * FROM problem WHERE problem_id=$id";
    $result=mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result)!=1){
        $view_errors="找不到这个问题的评论.";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    $tmprow=mysqli_fetch_object($result);
    $problem_title=$tmprow->title;
    mysqli_free_result($result);
    $on_contest=false;
    if(isset($_SESSION["oncontest"+$id])){
        $view_errors="这个题目在比赛中, 不可讨论.";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);   
    }else{
        $sql="SELECT * FROM `contest_problem` WHERE `problem_id`=$id AND `contest_id` IN (SELECT `contest_id` FROM `contest` WHERE `start_time`<'$now' AND `end_time`>'$now')";
        $result=mysqli_query($mysqli, $sql);
        if(mysqli_num_rows($result)!=0){
            $on_contest=true;
            $_SESSION["oncontest"+$id]=true;
        }
        if($id==1000){
            $on_contest=false;
            if(!isset($_SESSION["oncontest1000"]))$_SESSION["oncontest1000"]=true;   
        }
    }
    if($on_contest){
        $view_errors="这个题目在比赛中, 不可讨论.";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0); 
    }
    $pr_flag=true;
    $sql="SELECT * FROM discuss WHERE problem_id='$id' ORDER BY nice DESC LIMIT 8";
    $result=mysqli_query($mysqli,$sql);
    $view_cnt=0;
    while($row=mysqli_fetch_object($result)){
        $view_discuss[$view_cnt]['discuss_id']=$row->discuss_id;
        $view_discuss[$view_cnt]['nice']=$row->nice;
        $view_discuss[$view_cnt]['content']=$row->content;
        $view_discuss[$view_cnt]['post_time']=$row->post_time;
        $view_discuss[$view_cnt]['nick']=getNickByid($row->user_id);
        $view_discuss[$view_cnt]['user_id']=$row->user_id;
        $view_discuss[$view_cnt]['user_sign']=getSignByid($row->user_id);
        $sql="SELECT user_id, post_time, content, comment_id FROM comment WHERE discuss_id=$row->discuss_id ORDER BY `post_time`";
        $tmpresult=mysqli_query($mysqli, $sql);
        $tmpcnt=0;
        while($tmprow1=mysqli_fetch_object($tmpresult)){
            $view_discuss[$view_cnt]['comment'][$tmpcnt]['nick']=getNickByid($tmprow1->user_id);
            $view_discuss[$view_cnt]['comment'][$tmpcnt]['user_id']=$tmprow1->user_id;
            $view_discuss[$view_cnt]['comment'][$tmpcnt]['post_time']=$tmprow1->post_time;
            $view_discuss[$view_cnt]['comment'][$tmpcnt]['content']=$tmprow1->content;
            $view_discuss[$view_cnt]['comment'][$tmpcnt]['comment_id']=$tmprow1->comment_id;
            $tmpcnt++;
        }
        $view_discuss[$view_cnt]['comment_cnt']=$tmpcnt;
        mysqli_free_result($tmpresult);
        $view_cnt++;
    }
    mysqli_free_result($result);
    $row=$tmprow;
}else{
    $view_errors="找不到这个问题的评论.";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$sql = "SELECT result,COUNT(solution_id) as cnt FROM solution ";
if($pr_flag){
    $sql.="WHERE problem_id=$id ";
}else{
    $sql.="WHERE problem_id IN (SELECT problem_id FROM contest_problem WHERE contest_id=$cid and num=$pid)";
    //wait to finish...
}
$sql.="GROUP BY result";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());
while($obj=mysqli_fetch_object($result)){
    $summary[$obj->result]=$obj->cnt;
}
mysqli_free_result($result);

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/discuss.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>

