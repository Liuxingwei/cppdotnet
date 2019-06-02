<?php 
// $arg = $_GET['arg'];//参数
$exp_time = 3600;//静态文件有效期
if(file_exists($statis_file)){ 
 $file_ctime =filectime($statis_file);//文件创建时间 
 if($file_ctime+$exp_time>time()){//如果没过期 
  echo file_get_contents($statis_file);//输出静态文件内容 

  exit; 
 }else{//如果已过期 
  unlink($statis_file);//删除过期的静态页文件 

 } 
}

 ob_start(); 
  
?> 