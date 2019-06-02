<?php 
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

if (!isset($_GET['class'])) {
    $class="";
    $tutorial_title="C语言入门";
    $tutorial_content="<div class='content_qianyan'><p>　　本套《C语言入门教程》由站长黄老师亲自撰写和设计，主要由C语言基础、配套作业及扩展课三部分组成。</p>
    <p>　　整套课程在理论通俗易懂的前提下，每章都有<a href='/oj/problemset.html'>配套作业</a>，学生可以实时提交并评测、返回结果，强调及时巩固消化、解决重理论轻代码的问题。同时，最后配有结课设计，整体提升学生程序设计尤其解决实际问题的能力。扩展课部分包含<a href='/wp/563.html'>编辑器的断点调试</a>、C语言扩展等知识，让大家养成独立动手解决问题的习惯和兴趣。</p>
    <p>　　本套课程的设计目的是使零基础自学的同学完成全部作业之后可以不低于计算机相关专业C语言的平均水平。</p>
    <p>VC6编辑器的断点调试教程：</p></div>
    <p>　<a href='/wp/431.html'>VC6断点调试之如何下断点(上)<第一篇></a></p>
    <p>　<a href='/wp/449.html'>VC6断点调试之如何下断点(下)<第二篇></a></p>
    <p>　<a href='/wp/489.html'>VC6断点调试之监视变量<第三篇></a></p>
    <p>　<a href='/wp/502.html'>VC6断点调试之条件断点<第四篇></a></p>
    <p>　<a href='/wp/545.html'>VC6断点调试之窗口监视（内存监视、寄存器和栈回溯）<第五篇></a></p>
    <p>　<a href='/wp/554.html'>VC6断点调试之内存断点<第六篇></a></p>";
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

$view_title=$tutorial_title." - C语言教程 - C语言网";

//目录
$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=101 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_101=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
	
	$view_class_101[$cnt][0]=$row->class_id;
	$view_class_101[$cnt][1]=$row->title;
	$cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=102 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_102=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_102[$cnt][0]=$row->class_id;
    $view_class_102[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=103 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_103=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_103[$cnt][0]=$row->class_id;
    $view_class_103[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=104 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_104=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_104[$cnt][0]=$row->class_id;
    $view_class_104[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=105 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_105=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_105[$cnt][0]=$row->class_id;
    $view_class_105[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=106 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_106=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_106[$cnt][0]=$row->class_id;
    $view_class_106[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=107 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_107=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_107[$cnt][0]=$row->class_id;
    $view_class_107[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=108 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_108=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_108[$cnt][0]=$row->class_id;
    $view_class_108[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=109 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_109=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_109[$cnt][0]=$row->class_id;
    $view_class_109[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=110 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_110=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_110[$cnt][0]=$row->class_id;
    $view_class_110[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

$sql="SELECT `class_id`,`title` FROM `tutorial` WHERE `section`=111 ORDER BY `order_id`";
$result=mysqli_query($mysqli,$sql);
$view_class_111=Array();
$cnt=0;
while ($row=mysqli_fetch_object($result)){
    
    $view_class_111[$cnt][0]=$row->class_id;
    $view_class_111[$cnt][1]=$row->title;
    $cnt++;
}
mysqli_free_result($result);

//nav_page_mark
$page_mark="jiaocheng";

require("template/".$OJ_TEMPLATE."/tutorial_c.php");
?>