<?php 
$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=201 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_201=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_201[$cnt][0]=$row->class_id;
    $view_class_201[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=202 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_202=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_202[$cnt][0]=$row->class_id;
    $view_class_202[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=203 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_203=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_203[$cnt][0]=$row->class_id;
    $view_class_203[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=204 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_204=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_204[$cnt][0]=$row->class_id;
    $view_class_204[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=205 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_205=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_205[$cnt][0]=$row->class_id;
    $view_class_205[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=206 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_206=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_206[$cnt][0]=$row->class_id;
    $view_class_206[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=207 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_207=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_207[$cnt][0]=$row->class_id;
    $view_class_207[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$open_201=$open_202=$open_203=$open_204=$open_205=$open_206=$open_207="";
switch ($section) {
    case 201:
        $open_201="open";
        break;
    case 202:
        $open_202="open";
        break;
    case 203:
        $open_203="open";
        break;
    case 204:
        $open_204="open";
        break;
    case 205:
        $open_205="open";
        break;
    case 206:
        $open_206="open";
        break;
    case 207:
        $open_207="open";
        break;
}
?>