<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
  <meta name="description" content="C语言网(www.dotcpp.com)不仅提供C语言，还包括C++、java、算法与数据结构等课程在内的各种入门教程、视频录像、编程经验、编译器教程及软件下载、题解博客，源码分享等优质资源，提倡边学边练边分享，同时提供对口的IT工作，是国内领先实用的综合性编程学习网站！">
  <title>在线课堂-编程在线学习 - C语言网</title>
  <?php include("template/$OJ_TEMPLATE/css.php");?>
  <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/livedir/video-js/video-js.min.css">
  <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/livedir/ccl/style.min.css" />
  <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/livedir/css/danmu.css"/>

  <script src="//cdn.bootcss.com/socket.io/1.4.5/socket.io.js"></script>
  <script src="https://rawgit.com/yunba/yunba-javascript-sdk/master/yunba-js-sdk.js"></script>
  <script src="//cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>

  <!-- If you'd like to support IE8 -->
  <script src="template/<?php echo $OJ_TEMPLATE;?>/livedir/video-js/ie8/videojs-ie8.min.js"></script>

  <script src="template/<?php echo $OJ_TEMPLATE;?>/livedir/ccl/CommentCoreLibrary.min.js"></script>
</head>
<body>
	<div class="wrap">
          <!-- Static navbar -->
      
  <?php include("template/$OJ_TEMPLATE/nav.php");?>

  <div class="container-fluid" style="margin-top:20px;position:relative;z-index:0;">

    <div class="row">
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
      <div class="col-lg-8 col-md-10 col-xs-12 my-col">
      	


        <div id='my-player' class='abp'>
          <div id='my-comment-stage' class='container'>
          <div id="live-video" class="video-js vjs-default-skin vjs-big-play-centered" webkit-playsinline style="display: none;background-color: #fff;">
            <div id='player' >
		    			<script type="text/javascript" charset="utf-8" src="http://yuntv.letv.com/player/live/blive.js"></script>
		    			<script>
		        		var player = new CloudLivePlayer();
		       		 	player.init({activityId:"A2017070600000aj"});
		    			</script>
						</div>
            
          </div>
          </div>
        </div>
        
        
       
      </div>
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
      <div class="col-lg-8 col-md-10 col-xs-0 my-col">
        <div class="panel panel-success">
          <div class="panel-body">
            <form id="form-status" class="form">
              <button type="button" class="btn btn-success disabled my-btn-block">
                <span class="glyphicon glyphicon-refresh glyphicon-spin" aria-hidden="true"></span>
                <span id="span-status">正在加载所需文件...</span>
              </button>
            </form>
            <form id="form-info" class="form" style="display: none">
              <button type="button" class="btn btn-success  my-btn-block">
                <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                在线
                <span id="online-number" class="badge">0</span>
              </button>
              <button type="button" class="btn btn-success  my-btn-block">
                <span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span>
                获赞
                <span id="like-number" class="badge">0</span>
              </button>
              <button id="btn-like" type="button" class="btn btn-danger pull-right my-btn-block" onclick="setTimeout((function(me){me.disabled=true;return function(){me.disabled=false;};})(this),10000);">
                <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                点赞
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
    </div>

    <div class="row">
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
      <div class="col-lg-8 col-md-10 col-xs-0 my-col">
        <div class="panel panel-success">
          <div class="panel-heading">弹幕</div>
          <div class="panel-body">
            <form class="form-inline">
              <label for="bullet-type">类型</label>
              <select id="bullet-type" class="form-control">
                <option>下端滚动</option>
                <option>上端滚动</option>
                <option>底部固定</option>
                <option>顶部固定</option>
         
              </select>
              <label for="bullet-color">颜色</label>
              <select id="bullet-color" class="form-control">
              	<option value="ffffff">白色</option>
                <option value="ff0000">红色</option>
                <option value="00ff00">绿色</option>
                <option value="00e3e3">蓝色</option>
                <option value="ff79bc">粉色</option>
                <option value="ffff37">黄色</option>
              </select>
              <!--<input id="bullet-color" type="text" class="form-control" value="ff0000">-->
              
              <label for="bullet-text">内容</label>
              <input id="bullet-text" type="text" class="form-control" value="hello world！">
              <button id="btn-send" type="button" class="btn btn-danger pull-right my-btn-block" disabled="true" onclick="setTimeout((function(me){me.disabled=true;return function(){me.disabled=false;};})(this),5000);">
                <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                发送
              </button>
            </form>
          </div>
         
        </div>
      </div>
      <div class="col-lg-2 col-md-1 col-xs-0 my-col"></div>
    </div>

  </div><!--container-fluid-->
</div><!--wrap-->
 <?php require("template/$OJ_TEMPLATE/footer.php") ?>

  <script type="text/javascript">
    window.HELP_IMPROVE_VIDEOJS = false;
  </script>
  <?php include("template/$OJ_TEMPLATE/js.php");?>
  <script src="template/<?php echo $OJ_TEMPLATE;?>/livedir/video-js/video.min.js"></script>
  <script src="template/<?php echo $OJ_TEMPLATE;?>/livedir/video-js/videojs-contrib-hls.min.js"></script>
  <script src="template/<?php echo $OJ_TEMPLATE;?>/livedir/main.js"></script>
<script>
  $(".menu-item-has-children").mouseover(function(){
    $(this).css("background-color","#3061dd");
    $(this).find(".sub-menu").show();
  });
$(".menu-item-has-children").mouseout(function(){
  $(this).find(".sub-menu").hide();
  $(this).css("background-color","transparent");
  $(".current_page_item").css("background-color","#3061dd");
});
</script>
  
</body>
</html>
