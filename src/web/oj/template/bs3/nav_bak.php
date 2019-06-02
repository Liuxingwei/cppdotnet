<?php 
	$url=basename($_SERVER['REQUEST_URI']);
	$dir=basename(getcwd());
	if($dir=="oj") $path_fix="";
	else $path_fix="oj/";
  // echo "<script>console.log('".$url."');</script>";
?>
      <!-- Static navbar -->
      <header id="header" class="header">
        <div id="nav-header" class="navbar" style="margin-bottom: 0px;">
         <ul class="nav">
	      <?php $ACTIVE='current_page_item'?>
              <!-- style="height:52px;color:white;line-height:52px;" -->
              <li ><a style="background-color:#262835;" href="../index.php">C语言网</a></li>
              <li class="<?php if ($url=='index.php') echo $ACTIVE;?>"><a href="/index.php"><?php echo $MSG_HOME ?></a></li>
              <li class="<?php if ($url=='livelist.php') echo  $ACTIVE;?>"><a href="<?php if($dir!="oj")echo 'oj/';?>livelist.php"><?php echo $MSG_LIVE ?></a></li>
              <li class="<?php if ($url=='classc.html') echo $ACTIVE;?>"><a href="<?php if($dir!="oj")echo 'oj/';?>classc.html">教程</a></li>
              <li class=""><a href="../wp/">资源</a></li>
              <li class="menu-item-has-children <?php if ($url=='problemset.php' || $url=='status.php' || $url=='ranklist.php') echo $ACTIVE;?>"><a href="#">训练</a>                
                <ul class="sub-menu">
                    <li><a href="<?php echo $path_fix; ?>problemset.php">题库</a></li>
                    <li><a href="<?php echo $path_fix; ?>status.php">状态</a></li>
                    <li><a href="<?php echo $path_fix; ?>ranklist.php">排名</a></li>
                </ul>
            </li>
              <li class="<?php if ($url=='contest.php') echo $ACTIVE;?>"><a href="<?php echo $path_fix?>contest.html"><?php echo $MSG_CONTEST?></a></li>
<?php if(isset($_GET['cid'])){
	$cid=intval($_GET['cid']);
?>
<?php }?>
        
        <li class="nav_li_right">
	    <ul>
<script src="<?php echo $path_fix."template/$OJ_TEMPLATE/profile.php?".rand();?>" ></script>
              
        </ul>
        </li>
        </ul>
        </div>
<?php
  if($dir=="oj") {
    if(file_exists("./xktms/msg.txt"))
    $view_marquee_msg=file_get_contents($OJ_SAE?"saestor://web/msg.txt":"./xktms/msg.txt");
  }  
  else $view_marquee_msg=file_get_contents($path_fix."xktms/msg.txt");
?>
      <div class="toptip"> 
            <ul style="margin-top: 0px;"><?php echo $view_marquee_msg;?></ul> 
      </div> 
      </header>

<?php 
if($OJ_ONLINE){
    require_once($path_fix.'include/online.php');
    $on = new online();
}
 ?>

