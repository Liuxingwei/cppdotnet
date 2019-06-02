<?php
////////////////////////////Common head
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$url_oj="../oj/";
if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=".$url_oj."loginpage.php>登录</a>后再提交!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}
$user_id=$_SESSION['user_id'];

/*账号封禁状态*/
$sql="SELECT `defunct` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_array($result);
if ($row[0]=='Y') {
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('该账号已被封禁!!!\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}
mysqli_free_result($result);

/*当日发表限制*/
$time_today_0=date("Y-m-d H:i:s",strtotime(date("Y-m-d",time())));
$sql="SELECT count(1) AS today_cnt FROM `blog` WHERE `user_id`='$user_id' AND `post_time`>'$time_today_0'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
if ($row->today_cnt>=10) {
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('超过每日发表数量!!!\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}
/*新用户限制*/
$sql="SELECT `user_lvl` FROM `users` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli, $sql);
$row=mysqli_fetch_object($result);
$user_lvl=$row->user_lvl;
if ($user_lvl<3) {
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('您的账号等级太低无法发表文章，请达到P3等级(EXP>500)再来吧！\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}


if (isset($_POST['blog_id'])) {
    $blog_id=$_POST['blog_id'];
    $sql="SELECT user_id FROM blog WHERE blog_id=$blog_id";
    $result=mysqli_query($mysqli, $sql);
    $row=mysqli_fetch_array($result);
    if ($user_id!==$row[0]) {
        echo '<script>alert("无权操作!!!");history.go(-1);</script>';
        exit(0);
    }
}
/*管理员加精*/
elseif (isset($_GET['blog_id'])) {
    $blog_id=$_GET['blog_id'];
    if(!(isset($_SESSION['administrator']) || isset($_SESSION['lowlevel_admin']))){
        echo '<script>alert("无权操作!!!");history.go(-1);</script>！';
        exit(1);
    }
    $sql="UPDATE `blog` SET"
        ."`hq`='1'"
        ."WHERE `blog_id`='".$blog_id."'";
    mysqli_query($mysqli,$sql) or die("Update Error!\n");
    echo '<script>alert("操作成功!!!");history.go(-1);</script>！';
    exit(0);
}
/*管理员加精结束*/
else {
    $id=0;
    if(isset($_POST['id'])){
        $id=intval($_POST['id']);
        $sql="SELECT problem_id FROM problem WHERE problem_id=$id";
        $result=mysqli_query($mysqli, $sql);
        if(mysqli_num_rows($result)!=1){
            $view_errors="错误的题目编号";
            require("template/".$OJ_TEMPLATE."/error.php");
            exit(0);
        }
        mysqli_free_result($result);
    }
}

$title=mysqli_real_escape_string($mysqli,$_POST['title']);
$content=mysqli_real_escape_string($mysqli,$_POST['content']);
if ($_POST['hq']&&$_POST['hq']==-1) {
    $hq=-1;
}
else {
    $hq=0;
}

if (!isset($_POST['language'])) {
    $language=-1;
}
else {
    $language=$_POST['language'];
}

if(strlen($title)<15 || $title==null){
    echo '<script>alert("标题太短!!!");history.go(-1);</script>';
    exit(0);
}
if(strlen($content)<150 || $content==null){
    echo '<script>alert("内容字数太少!!!");history.go(-1);</script>';
    exit(0);
}

$now=strftime("%Y-%m-%d %X",time()-10);
$sql="SELECT `post_time` from `blog` where `user_id`='$user_id' and post_time>'$now' order by `post_time` desc limit 1";
$res=mysqli_query($mysqli,$sql);
if (mysqli_num_rows($res)==1){
    echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
    print "<script charset='utf-8' language='javascript'>\n";
    print "alert('10秒内只能发表一次!!!\\n');\n";
    print "history.go(-1);\n</script>";
    exit(0);
}
mysqli_free_result($result);

if (isset($_POST['blog_id'])) {
    $sql_hq="SELECT `hq` FROM `blog` WHERE `blog_id`='$blog_id'";
    $result_hq=mysqli_query($mysqli, $sql_hq);
    $row_hq=mysqli_fetch_array($result_hq);
    if ($row_hq[0]!=0) {
        $hq=$row_hq[0];
    }
    $sql="UPDATE `blog` SET"
        ."`title`='".$title."',"
        ."`content`='".$content."',"
        ."`language`='".$language."',"
        ."`hq`='".$hq."',"
        ."`post_time`=NOW()"
        ."WHERE `blog_id`='".$blog_id."'";
    mysqli_query($mysqli,$sql) or die("Update Error!\n");
}
else {
    $sql = "INSERT INTO blog (title, content, language, status, hq, nice, problem_id, user_id, post_time) VALUES ('$title', '$content', '$language', 1, '$hq', 0, '$id', '$user_id', NOW())";
    $result=mysqli_query($mysqli, $sql);
}
//统计文章总数

    $sql="SELECT count(1) AS blog_cnt FROM blog WHERE user_id='$user_id'";
    $result=mysqli_query($mysqli,$sql);
    $arr_blog_cnt=mysqli_fetch_object($result);
    $blog_cnt=$arr_blog_cnt->blog_cnt;

    $sql="UPDATE `users` SET `blog_cnt`='$blog_cnt' WHERE `user_id`='$user_id'";
    $result=mysqli_query($mysqli,$sql);

print "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />\n";
print "<script>alert('发表成功!!!\\n');</script>";

if(isset($_POST['blog_id'])) {
    echo "<script>window.location.href='/blog/".$blog_id.".html'</script>";
}
else {
    if ($id!==0) {
        echo "<script>window.location.href='/blog/alist".$id."'</script>";
    }
    else {
        echo "<script>window.location.href='/home/".$user_id."'</script>";
    }
}


//redrict to discuss.php
//
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>