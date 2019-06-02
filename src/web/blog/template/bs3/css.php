<?php 
	$url_oj="/oj/";
	$dir=basename(getcwd());
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
	if($dir=="blog") $path_fix="/";
?>

<!-- 新 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>bootstrap.min.css">

<!-- 可选的Bootstrap主题文件（一般不用引入） -->
<!-- <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>bootstrap-theme.min.css"> -->

<!-- <link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>local.css"> -->

<link rel="stylesheet" href="<?php echo $path_fix."template/$OJ_TEMPLATE/css/"?>basic.css?v=201904251753">

