<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $view_title;?></title>
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="C语言网(www.dotcpp.com)不仅提供C语言，还包括C++、java、算法与数据结构等课程在内的各种入门教程、视频录像、编程经验、编译器教程及软件下载、题解博客，源码分享等优质资源，提倡边学边练边分享，同时提供对口的IT工作，是国内领先实用的综合性编程学习网站！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
   
    <?php include("template/$OJ_TEMPLATE/css.php");?>	   
    <link rel="stylesheet" type="text/css" href="<?php echo "/oj/template/$OJ_TEMPLATE";?>/css/tutorial.css">

    <style type="text/css">
        div.content_qianyan {
            font-size: 16px;
            font-weight: bold;
            line-height: 45px;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php include_once("baidu_js_push.php");?>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    	
    <div class="container" id="body">

      <div class="col-xs-3">
        <div class="content_box content_l">
          <dl class="list_dl">
              <dt class="list_dt dt_sec_101">
                  <span class="_after"></span>
                  第一章 C语言的过去与未来
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                    <?php
                      $selected="";
                      foreach($view_class_101 as $row_101){
                        if ($row_101[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_101[0].html'>$row_101[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_102">
                  <span class="_after"></span>
                  第二章 C语言快速入门
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_102 as $row_102){
                        if ($row_102[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_102[0].html'>$row_102[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_103">
                  <span class="_after"></span>
                  第三章 C语言的数据类型
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_103 as $row_103){
                        if ($row_103[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_103[0].html'>$row_103[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_104">
                  <span class="_after"></span>
                  第四章 C语言中的基本输入输出
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_104 as $row_104){
                        if ($row_104[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_104[0].html'>$row_104[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_105">
                  <span class="_after"></span>
                  第五章 运算符和表达式
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_105 as $row_105){
                        if ($row_105[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_105[0].html'>$row_105[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_106">
                  <span class="_after"></span>
                  第六章 C语句和程序流
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_106 as $row_106){
                        if ($row_106[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_106[0].html'>$row_106[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_107">
                  <span class="_after"></span>
                  第七章 函数
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_107 as $row_107){
                        if ($row_107[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_107[0].html'>$row_107[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_108">
                  <span class="_after"></span>
                  第八章 数组
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_108 as $row_108){
                        if ($row_108[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_108[0].html'>$row_108[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_109">
                  <span class="_after"></span>
                  第九章 指针
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_109 as $row_109){
                        if ($row_109[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_109[0].html'>$row_109[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_110">
                  <span class="_after"></span>
                  第十章 复合结构
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_110 as $row_110){
                        if ($row_110[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_110[0].html'>$row_110[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
              <dt class="list_dt dt_sec_111">
                  <span class="_after"></span>
                  第十一章 预处理
                  <i class="list_dt_icon"></i>
              </dt>
              <dd>
                  <ul class="left_menu">
                      <?php
                      $selected="";
                      foreach($view_class_111 as $row_111){
                        if ($row_111[0]==$class) {
                          $selected="selected";
                          $open='open';
                        }
                        else {
                          $selected="";
                          $open="";
                        }
                        echo "<li class='list_li'><a class='".$selected."' href='/course/c/$row_111[0].html'>$row_111[1]</a></li>";
                      }
                    ?>
                  </ul>
              </dd>
          </dl>
            
        </div>
      </div>
      
      <div class="col-xs-9">
        <div class="content_box">
            <div class="content_r">
                <h4 style="font-weight: bold;font-size: 20px;">
                    <?php echo $tutorial_title;?>
                </h4>
                <div style="float: right;">点击打开<a href="/run/" target="_blank">在线编译器</a>，边学边练。</div>
                <?php if(isset($_SESSION['administrator'])){ ?>
                  <br><br>
                  <div style="float: right;">
                    <a href="/oj/tutorial_redit.php?class=<?php echo $class;?>">重新编辑</a>　
                    <a href="/oj/tutorial_add.php">添加教程</a>
                  </div>
                <?php } ?>
            </div>
            <div class="content_r ueditor_container">
                <div class="ueditor_container"><?php echo $tutorial_content;?></div>
                <div style="height: 44px;">
                <div style="float: right;" class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
                </div>
            </div>
        </div>
      </div>

    </div> <!-- /container -->
    </div> <!-- /wrap -->
<?php require("template/$OJ_TEMPLATE/footer.php");?>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<?php include("template/$OJ_TEMPLATE/js.php");?>
    <!-- 百度分享 -->
    <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":["mshare","qzone","tsina","weixin","renren","tqq","tieba","douban","sqq"],"bdPic":"","bdStyle":"1","bdSize":"32"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

    <script type="text/javascript" src="/oj/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/oj/ueditor/ueditor.all.js"></script>
    <script src="/oj/ueditor/ueditor.parse.js"></script>
    <script type="text/javascript">
        uParse('.ueditor_container', {
            rootPath: '/oj/ueditor/'
        })
    </script>
  </body>
</html>