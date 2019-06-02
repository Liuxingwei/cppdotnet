<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if (!isset($_GET['class'])) {
    $class="";
    $tutorial_title="C++入门";
    $tutorial_content="<div class='content_qianyan'><p>　　这套《C++入门教程》由站长黄老师亲自撰写和设计，面向有C语言基础的同学，如果还没有学习过C语言可以点击这里先学习<a href='http://www.dotcpp.com/course/c/'>C语言</a>。</p>
    <p>　　C++课程配套的编译器采用CodeBlocks，也可以继续使用VC6编译器及其他编译器，<a href='http://www.dotcpp.com/wp/818.html'>CodeBlocks使用教程及下载地址</a>。</p>
    <p>　　整套课程在理论通俗易懂的前提下，每章都有配套作业，大家可以实时提交并评测、返回结果，强调及时巩固消化、解决重理论轻代码的问题。同时，最后配有结课设计，整体提升程序设计尤其解决实际问题的能力。</p>
    <p>　　本套课程的设计目的是理解C++基本语法，重点为面向对象程序设计的精髓思想。</p></div>";
}
else {
    $class=$_GET['class'];

//内容
$sql="SELECT * FROM `tutorial` WHERE `class_id`=$class";
$result=mysqli_query($mysqli,$sql);
$row=mysqli_fetch_object($result);
$tutorial_title=$row->title;
$tutorial_content=$row->content;
mysqli_free_result($result);

}

$view_title=$tutorial_title." - C++教程 - C语言网";

//目录
$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=201 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_201=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
	
	$view_class_201[$cnt][0]=$row->class_id;
	$view_class_201[$cnt][1]=$row->title;
	$cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=202 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_202=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_202[$cnt][0]=$row->class_id;
    $view_class_202[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=203 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_203=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_203[$cnt][0]=$row->class_id;
    $view_class_203[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=204 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_204=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_204[$cnt][0]=$row->class_id;
    $view_class_204[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=205 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_205=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_205[$cnt][0]=$row->class_id;
    $view_class_205[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=206 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_206=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_206[$cnt][0]=$row->class_id;
    $view_class_206[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

//nav_page_mark
$page_mark="jiaocheng";

require("template/".$OJ_TEMPLATE."/tutorial_cpp.php");
?>