<?php 
require("admin-header.php");

$dir = '/var/www/staticfiles';//要删除的目录
 $dh = opendir( $dir ) or die('打开目录失败');//打开目录
 while(($file=readdir($dh))!==false){ //循环读取目录中
    if ( $file != '.' && $file != '..'  ) {
 
      unlink( $dir . '/' . $file ); //删除文件 
      echo "删除".$file."！\n";
    }  
 }
 echo "操作成功！";

require("../oj-footer.php");

?>