<?php
////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$url_oj="../oj/";
if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=".$url_oj."loginpage.php>登录</a>后再讨论!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
if(!isset($_POST['blog_id'])){
    $view_errors="错误的文章编号";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$blog_id=intval($_POST['blog_id']);
$sql="SELECT blog_id FROM blog WHERE blog_id=$blog_id";
$result=mysqli_query($mysqli, $sql);
if(mysqli_num_rows($result)!=1){
    $view_errors="错误的文章编号";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
mysqli_free_result($result);

$user_id=$_SESSION['user_id'];

$dismsg=mysqli_real_escape_string($mysqli,trim($_POST['dismsg']));
if($dismsg==""|| $dismsg==null){
    echo '<script>alert("内容不能为空!!!");history.go(-1);</script>';
    exit(0);
}


$now=strftime("%Y-%m-%d %X",time()-10);
$sql="SELECT `post_time` from `blog_discuss` where `user_id`='$user_id' and post_time>'$now' order by `post_time` desc limit 1";
$res=mysqli_query($mysqli,$sql);
if (mysqli_num_rows($res)==1){
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('10秒内只能发表一次讨论!!!\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}
mysqli_free_result($result);

$sql = "INSERT INTO blog_discuss (content , status, nice, blog_id, user_id, post_time) VALUES ('$dismsg', 1, 0, $blog_id, '$user_id', NOW())";
$result=mysqli_query($mysqli, $sql);
$discuss_id=mysqli_insert_id($mysqli);
$sql="SELECT user_id FROM blog WHERE blog_id=$blog_id";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
if($row && $row->user_id!=$user_id){
    $to_user=$row->user_id;
    $title="您收到了文章评论";
    $content="您的文章收到了新的评论, 快去看看吧.<a href=\"/blog/".$blog_id.".html#blogdis$discuss_id\">传送门</a>";
    $sql = "INSERT INTO `mail` (`to_user`, `from_user`, `title`, `content`, `new_mail`, `reply`, `in_date`, `defunct`) VALUES ('$to_user', 'sy','$title', '$content', 1, 0, NOW(), 'N')";
    // echo $sql;
    mysqli_query($mysqli, $sql);
}

echo "<script>window.location.href='/blog/".$blog_id.".html'</script>";
//redrict to discuss.php
//
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
