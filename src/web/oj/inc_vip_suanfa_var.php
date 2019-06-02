<?php 
$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=301 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_301=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_301[$cnt][0]=$row->class_id;
    $view_class_301[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=302 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_302=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_302[$cnt][0]=$row->class_id;
    $view_class_302[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=303 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_303=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_303[$cnt][0]=$row->class_id;
    $view_class_303[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=304 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_304=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_304[$cnt][0]=$row->class_id;
    $view_class_304[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=305 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_305=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_305[$cnt][0]=$row->class_id;
    $view_class_305[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=306 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_306=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_306[$cnt][0]=$row->class_id;
    $view_class_306[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=307 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_307=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_307[$cnt][0]=$row->class_id;
    $view_class_307[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=308 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_308=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_308[$cnt][0]=$row->class_id;
    $view_class_308[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$open_301=$open_302=$open_303=$open_304=$open_305=$open_306=$open_307=$open_308="";
switch ($section) {
    case 301:
        $open_301="open";
        break;
    case 302:
        $open_302="open";
        break;
    case 303:
        $open_303="open";
        break;
    case 304:
        $open_304="open";
        break;
    case 305:
        $open_305="open";
        break;
    case 306:
        $open_306="open";
        break;
    case 307:
        $open_307="open";
        break;
    case 308:
        $open_308="open";
        break;
}
?>