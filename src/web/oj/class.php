<?php
////////////////////////////Common head
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	
///////////////////////////MAIN	
if(isset($_GET['page']))
	$page=intval($_GET['page']);
else
	$page='';


//title for class
////1
if ($page=='101') {
	$view_title="C语言的历史";
}
else if ($page=='102') {
	$view_title="C语言的现在";
}
else if ($page=='103') {
	$view_title="C语言的未来";
}
////2
else if ($page=='201') {
	$view_title="C语言第一个简单例子";
}
else if ($page=='202') {
	$view_title="实例说明";
}
else if ($page=='203') {
	$view_title="本教程的相关说明";
}
////3
else if ($page=='301') {
	$view_title="变量和常量";
}
else if ($page=='302') {
	$view_title="数据类型和关键字";
}
////4
else if ($page=='401') {
	$view_title="字符输出函数putchar";
}
else if ($page=='402') {
	$view_title="字符接收函数getchar";
}
else if ($page=='403') {
	$view_title="格式输出函数printf";
}
else if ($page=='404') {
	$view_title="格式输入函数scanf";
}
////5
else if ($page=='501') {
	$view_title="基本运算符";
}
else if ($page=='502') {
	$view_title="其他运算符";
}
else if ($page=='503') {
	$view_title="表达式和语句";
}
////6
else if ($page=='601') {
	$view_title="表达式和语句";
}
else if ($page=='602') {
	$view_title="多项选择结构";
}
else if ($page=='603') {
	$view_title="分支和跳转";
}
////7
else if ($page=='701') {
	$view_title="函数的定义";
}
else if ($page=='702') {
	$view_title="函数的调用";
}
else if ($page=='703') {
	$view_title="变量的存储类型";
}
////8
else if ($page=='801') {
	$view_title="一维数组的定义和使用";
}
else if ($page=='802') {
	$view_title="二维数组的定义和使用";
}
else if ($page=='803') {
	$view_title="字符数组与字符串";
}
////9
else if ($page=='901') {
	$view_title="地址与指针";
}
else if ($page=='902') {
	$view_title="指针的定义与使用";
}
else if ($page=='903') {
	$view_title="数组与指针";
}
else if ($page=='904') {
	$view_title="字符串与指针";
}
////10
else if ($page=='1001') {
	$view_title="结构体的定义和使用";
}
else if ($page=='1002') {
	$view_title="结构体的高级使用";
}
else if ($page=='1003') {
	$view_title="共用体的定义和使用";
}
else if ($page=='1004') {
	$view_title="关键字typedef的使用";
}
////11
else if ($page=='1101') {
	$view_title="宏定义";
}
else if ($page=='1102') {
	$view_title="文件包含";
}
else if ($page=='1103') {
	$view_title="条件编译";
}
else if ($page=='1104') {
	$view_title="其他与处理命令";
}
else {
	$view_title="C语言入门教程";
}

// echo "<!-- $page -->";
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/class.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
