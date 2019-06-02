<?php 
	$url_oj="/oj/";
	$dir=basename(getcwd());
	if($dir=="blog") $path_fix="/";
?>
<!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>jquery.min.js"></script>

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>bootstrap.min.js"></script>

<!-- <?php
if(file_exists("./xktms/msg.txt"))
$view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"./xktms/msg.txt");

?> -->
<!--<script type="text/javascript"
  src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
</script>
-->
<script type="text/javascript" src="<?php echo $path_fix."template/$OJ_TEMPLATE/js/"?>scrolltoptip.js"></script>
<script>
	var _hmt = _hmt || [];
	(function() {
	  var hm = document.createElement("script");
	  hm.src = "//hm.baidu.com/hm.js?56aab7d208d6169b3fb33801cc12fcbe";
	  var s = document.getElementsByTagName("script")[0]; 
	  s.parentNode.insertBefore(hm, s);
	})();
/* $(document).ready(function(){
  var msg="<marquee  id=broadcast scrollamount=5 scrolldelay=0 onMouseOver='this.stop()' onMouseOut='this.start()'><span style='display: inline-block;padding: 5px 0px;font-size: 16px;border-radius: 30px;background: -webkit-linear-gradient(bottom, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));background: -o-linear-gradient(bottom, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));background: linear-gradient(to top, rgba(48, 97, 253, 1), rgba(48, 97, 253, 0));'>　<?php echo str_replace("\r\n", '', $view_marquee_msg); ?>　</span></marquee>";
  $("#body").prepend(msg);
  $("form").append("<div id='csrf' />");
  $("#csrf").load("csrf.php");
});*/
$(".menu-item-has-children").mouseover(function(){
	$(this).css("background-color","#3061FD");
	$(this).find(".sub-menu").show();
});
$(".menu-item-has-children").mouseout(function(){
	$(this).find(".sub-menu").hide();
	$(this).css("background-color","transparent");
	// $(".current_page_item").css("background-color","#3061dd");
});
</script>

