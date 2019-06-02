<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再讨论!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
if(!isset($_POST['id'])){
    $view_errors="错误的题目编号";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$id=intval($_POST['id']);
$sql="SELECT problem_id FROM problem WHERE problem_id=$id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    $view_errors="错误的题目编号";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
mysqli_free_result($result);

$user_id=$_SESSION['user_id'];

$dismsg=mysqli_real_escape_string($mysqli,trim($_POST['dismsg']));
if($dismsg==""|| $dismsg==null){
    echo '<script>alert("Content can not empty!!!");history.go(-1);</script>';
    exit(0);
}


$now=strftime("%Y-%m-%d %X",time()-10);
$sql="SELECT `post_time` from `discuss` where `user_id`='$user_id' and post_time>'$now' order by `post_time` desc limit 1";
$res=mysqli_query($mysqli,$sql);
if (mysqli_num_rows($res)==1){
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('10秒内只能发表一次讨论!!!\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}
mysqli_free_result($result);

$sql = "INSERT INTO discuss (content , status, nice, problem_id, user_id, post_time) VALUES ('$dismsg', 1, 0, $id, '$user_id', NOW())";
$result=mysqli_query($mysqli, $sql);
echo "<script>window.location.href='discuss$id.html'</script>";
//redrict to discuss.php
//
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
