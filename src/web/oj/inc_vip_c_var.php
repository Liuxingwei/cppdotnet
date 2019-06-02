<?php 
$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=101 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_101=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_101[$cnt][0]=$row->class_id;
    $view_class_101[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=102 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_102=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_102[$cnt][0]=$row->class_id;
    $view_class_102[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=103 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_103=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_103[$cnt][0]=$row->class_id;
    $view_class_103[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=104 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_104=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_104[$cnt][0]=$row->class_id;
    $view_class_104[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=105 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_105=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_105[$cnt][0]=$row->class_id;
    $view_class_105[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=106 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_106=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_106[$cnt][0]=$row->class_id;
    $view_class_106[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=107 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_107=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_107[$cnt][0]=$row->class_id;
    $view_class_107[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=108 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_108=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_108[$cnt][0]=$row->class_id;
    $view_class_108[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=109 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_109=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_109[$cnt][0]=$row->class_id;
    $view_class_109[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=110 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_110=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_110[$cnt][0]=$row->class_id;
    $view_class_110[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=111 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_111=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_111[$cnt][0]=$row->class_id;
    $view_class_111[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `vipclass` WHERE `section`=112 ORDER BY `lock_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_112=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_112[$cnt][0]=$row->class_id;
    $view_class_112[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$open_101=$open_102=$open_103=$open_104=$open_105=$open_106=$open_107=$open_108=$open_109=$open_110=$open_111=$open_112="";
switch ($section) {
    case 101:
        $open_101="open";
        break;
    case 102:
        $open_102="open";
        break;
    case 103:
        $open_103="open";
        break;
    case 104:
        $open_104="open";
        break;
    case 105:
        $open_105="open";
        break;
    case 106:
        $open_106="open";
        break;
    case 107:
        $open_107="open";
        break;
    case 108:
        $open_108="open";
        break;
    case 109:
        $open_109="open";
        break;
    case 110:
        $open_110="open";
        break;
    case 111:
        $open_111="open";
        break;
    case 112:
        $open_112="open";
        break;
}
?>