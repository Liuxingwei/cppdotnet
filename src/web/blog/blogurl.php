<?php
require_once('include/db_info.inc.php');
require_once('include/setlang.php');
require_once('include/my_func.inc.php');

$sql="SELECT `blog_id`,`user_id` FROM `blog`";
$result=mysqli_query($mysqli,$sql) or die(mysqli_error());


$str="";
$i=0;
while ($row=mysqli_fetch_array($result)){
    $str.= "https://www.dotcpp.com/blog/".$row['blog_id'].".html https://blog.dotcpp.com/".$row['user_id']."/".$row['blog_id']."<br>";
    $i++;
}
mysqli_free_result($result);


/*$blogurl = fopen('/var/blogurl/blogurl.txt',"a+");
fwrite($blogurl, $str);
fclose($blogurl);*/

echo $str;
?>