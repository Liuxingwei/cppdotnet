<?php 
  $url=basename($_SERVER['REQUEST_URI']);
  $dir=basename(getcwd());
  if($dir=="oj") {
    $path_fix="/oj/";
    $path_fix_require="";
  }
  elseif ($dir=="blog") {
    $url_oj_home="https://www.dotcpp.com";
    $url_oj="https://www.dotcpp.com/oj/";
    $path_fix="/";
  }
  else {
    $path_fix="oj/";
    $path_fix_require="oj/";
  }
  // echo "<script>console.log('".$url."');</script>";
?>
<style type="text/css">
  .toptip{
    padding-left: 10px;
    height: 48px;
    line-height: 48px;
    background-image: none;
  }
</style>

      <!-- Static navbar -->
      <header id="header" class="header">
        <div id="nav-header" class="navbar" style="margin-bottom: 0px;">
         <ul class="nav">
        <?php $ACTIVE='current_page_item'?>
              <!-- style="height:52px;color:white;line-height:52px;" -->
              <li ><a style="background-color:#262835;" href="<?php echo $url_oj_home?>">C语言网</a></li>
              <li class="<?php if ($url=='livelist.html') echo  $ACTIVE;?>"><a href="<?php echo $url_oj?>livelist.html"><?php echo $MSG_LIVE ?></a></li>
              <li class="menu-item-has-children <?php if ($page_mark=='jiaocheng') echo $ACTIVE;?>"><a href="#">教程</a>
                <ul class="sub-menu">
                    <li><a href="<?php echo $url_oj_home?>/course/c/">C语言教程</a></li>
                    <li><a href="<?php echo $url_oj_home?>/course/cpp/">C++教程</a></li>
                </ul>
              </li>
              <li class=""><a href="<?php echo $url_oj_home?>/wp/">资源</a></li>
              <li class="<?php if ($url=='/') echo $ACTIVE;?>"><a href="/">博客</a></li>
              <li class="menu-item-has-children <?php if ($url=='problemset.html' || $url=='status.html' || $url=='ranklist.html') echo $ACTIVE;?>"><a href="<?php echo $url_oj; ?>">训练</a>                
                <ul class="sub-menu">
                    <li><a href="<?php echo $url_oj; ?>problemset.html">题库</a></li>
                    <li><a href="<?php echo $url_oj; ?>status.html">状态</a></li>
                    <li><a href="<?php echo $url_oj; ?>ranklist.html">排名</a></li>
                </ul>
            </li>
              <li class="<?php if ($page_mark=='bisai') echo $ACTIVE;?>"><a href="<?php echo $url_oj?>contest.html"><?php echo $MSG_CONTEST?></a></li>
              <li class="<?php if ($page_mark=='job') echo $ACTIVE;?>"><a href="<?php echo $url_oj_home?>/job/list">工作</a></li>
<?php if(isset($_GET['cid'])){
  $cid=intval($_GET['cid']);
?>
<?php }?>
        
        <li class="nav_li_right">
      <ul>
<script src="<?php echo "/template/$OJ_TEMPLATE/profile.php?".rand();?>" ></script>
              
        </ul>
        </li>
        </ul>
        </div>
<?php
//滚动栏存在
$gundong="1";

if ($gonggao=="0") {
  $gundong="0";
}

if ($gundong=="1") {

  if($dir=="oj") {
    if(file_exists("../oj/xktms/msg.txt"))
    $view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"../oj/xktms/msg.txt");
  }  
  else $view_marquee_msg=file_get_contents("../oj/xktms/msg.txt");
?>
      <div class="toptip"> 
            <img src="/template/<?php echo $OJ_TEMPLATE;?>/img/guangbo.png" style="float: left;padding: 9px;">
            <ul style="margin-top: 0px;"><?php echo $view_marquee_msg;?></ul> 
      </div> 
      
<?php } ?>
</header>

<?php 
if($OJ_ONLINE){
    require_once('include/online.php');
    $on = new online();
}
 ?>