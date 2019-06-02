<?php
        require_once('./include/db_info.inc.php');
        require_once('./include/setlang.php');
        $view_title= "密码找回 - C语言网";

require_once("./include/const.inc.php");
require_once("./include/my_func.inc.php");
if (isset($_SESSION['user_id'])){
    echo '<script>window.location.href="../"</script>';
    exit(1);
}
$lost_user_id=$_POST['user_id'];
$lost_key=$_POST['lost_key'];
    $vcode=trim($_POST['vcode']);
    if($lost_user_id==$_SESSION['lost_user_id']&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
                echo "<script language='javascript'>\n";
                echo "alert('Verify Code Wrong!');\n";
                echo "history.go(-1);\n";
                echo "</script>";
                exit(0);
    }
  if(get_magic_quotes_gpc()){
        $lost_user_id=stripslashes($lost_user_id);
        $lost_key=stripslashes($lost_key);
  }
  $sql=" update `users` set password='".pwGen($lost_key)."'WHERE `user_id`='".mysqli_real_escape_string($mysqli,$lost_user_id)."'";
  if(

   $_SESSION['lost_user_id']==$lost_user_id &&
   $_SESSION['lost_key']==$lost_key
  ){
         $result=mysqli_query($mysqli,$sql);
    $view_errors="密码已经重置为邮件中的口令了,去 <a href=loginpage.php>登录</a>";
  }else{
         $view_errors="Password Reset Fail";
  }


  require("template/".$OJ_TEMPLATE."/error.php");
/////////////////////////Template

/////////////////////////Common foot
?>
