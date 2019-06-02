<?php 
  
 $content = ob_get_contents();//把详情页内容赋值给$content变量 
 file_put_contents($statis_file,$content);//写入内容到对应静态文件中 

 ob_end_flush();//输出详情页信息 
  
?>     