<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo $view_title;?></title>   
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
    <link rel="stylesheet" href="<?php echo "/template/$OJ_TEMPLATE";?>/css/blog.css?version=190113">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    	
    <div class="container" id="body">
        <div class="row row_user">
            <div class="col-lg-3">
                <div class="mod_blog">
                    <div class="photo mod_left">
                        <h4 class="user_nick" style="text-align: center;"><?php echo getNickByid($user_id);?></h4>
                        <br>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo "<p style='font-size: 12px;text-align: center;'><a style='float :left;' href='".$url_oj."modifypage.php'>修改资料</a>　<a style='float :right;' href='".$url_oj."changepassword.php'>修改密码</a></p>";
                            }
                            else {
                                echo "<p style='font-size: 12px;text-align: center;'><a href='".$url_oj."mail.php?to_user=$user_id'>私信TA</a></p>";
                            }
                        ?>
                        <p>用户名：<?php echo $user_id;?></p>
                        <p>访问量：<?php echo $userinfo_scan;?></p>
                        <p>签　名：</p>
                        <p><?php echo $userinfo_autograph;?></p>
                    </div>
                    <!-- <?php 
                      //VIP判断
                      $now=time();

                      $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
                      $result=mysqli_query($mysqli,$sql);
                      $row=mysqli_fetch_object($result);
                      $vip_end=strtotime($row->vip_end);
                      if ($vip_end<$now) {
                          $vipstatus="普通用户";
                          $vipstatus_end="";
                      }
                      else {
                          $vipstatus="VIP会员";
                          $vipstatus_end="<p>到期时间：　　".$row->vip_end."</p>";
                      }
                    ?>
                    <div class="mod_left">
                        <p>用户群组：　　<?php echo $vipstatus;?></p>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo $vipstatus_end;
                                echo "<p style='font-size: 12px;text-align: center;margin-bottom: 0px;'><a style='float :left;' href='".$url_oj_home."/vipjoin/'>VIP开通/续期</a>　<a style='float :right;' href='".$url_oj_home."/vipmb/order_user/'>查看我的订单</a></p>";
                            }
                        ?>
                    </div> -->
                    <div class="mod_left">
                    <table class="tab_user">
                        <?php echo "<img class='img_intro' src='/template/$OJ_TEMPLATE/img/icon007.png'>";?>
                        <tr>
                            <td width="35%">等　　级</td>
                            <td><?php echo "<button type='button' class='btn tag_lvl ".$tag_class." btn-xs'>P".$userinfo_lvl."</button>";?></td>
                        </tr>
                        <tr>
                            <td>排　　名</td>
                            <td><?php echo $userinfo_rank;?></td>
                        </tr>
                        <tr>
                            <td>经　　验</td>
                            <td><?php echo $userinfo_exp;?></td>
                        </tr>
                        <tr>
                            <td>参赛次数</td>
                            <td><?php echo $cnt_contest;?></td>
                        </tr>
                        <tr>
                            <td>文章发表</td>
                            <td><?php echo $cnt_blog;?></td>
                        </tr>
                        <tr>
                            <td>年　　龄</td>
                            <td><?php echo $userinfo_age;?></td>
                        </tr>
                        <tr>
                            <td>在职情况</td>
                            <td><?php echo $userinfo_iswork;?></td>
                        </tr>
                        <tr>
                            <td>学　　校</td>
                            <td><?php echo $userinfo_school;?></td>
                        </tr>
                        <tr>
                            <td>专　　业</td>
                            <td><?php echo $userinfo_subject;?></td>
                        </tr>
                        <?php 
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['administrator'])) {
                        ?>
                        <tr>
                            <td>地　　址</td>
                            <td><?php echo $userinfo_address;?></td>
                        </tr>
                        <tr>
                            <td>电　　话</td>
                            <td><?php echo $userinfo_phone;?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <?php 
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['user_cpn']) || isset($_SESSION['administrator'])) {
                    ?>
                    <br>
                    <!-- <p class="to_userinfo">　　<a href="<?php echo $url_oj."myvalue.php?user=$user_id";?>">我的竞争力</a></p> -->
                    <?php
                    }
                          if ($user_id==$_SESSION['user_id'] || isset($_SESSION['administrator'])) {
                    ?>
                    <p><a href="<?php echo $url_oj_home."/job/mysend/$user_id";?>">简历投递记录</a></p>
                    <?php } ?>
                    </div>
                    <div class="mod_left">
                        <p class="user_intro">　　自我简介：</p>
                        <p><?php echo $userinfo_intro;?></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="mod_blog mod_c">
                    <div id="banner_user">
                        <a href="<?php echo $url_oj_home;?>/home/<?php echo $user_id;?>"><div class="user_head">TA的成绩</div></a><div class="user_head user_head0">TA的文章</div>
                        <?php 
                            if ($user_id==$_SESSION['user_id']) {
                                echo "<a class='user_head1' style='float: right;' href='/article/edit'>写新文章</a>";
                            }
                        ?>
                    </div>
                    <div class="div_content" style="padding: 20px;">
                        <table class='table_list'">
                            <?php
                                foreach ($blog_data as $row_tr) {
                                    echo "<tr>";
                                    foreach ($row_tr as $row_td) {
                                        echo $row_td;
                                    }
                                    echo "</tr>";
                                }
                            ?>
                        </table>
                        <div style="height: 80px;">
                        <ul class="pagination pull-right">
                         <?php
                            if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                            else {
                                echo "<li><a href='/".$user_id."/page".($page-1)."'>&laquo;</a></li>";
                            }
                            $maxpag = 5;
                            $view_total_page = (int)$view_total_page;
                            $midpag = (int)($maxpag/2);
                            $starpag = 1;
                            $endpag = $view_total_page;
                            if($view_total_page>$maxpag){
                                $starpag = $page - $midpag;
                                $endpag = $page + $midpag;
                                if($starpag<=0){
                                    $starpag = 1;
                                    $endpag = $maxpag;
                                }
                                if($endpag>$view_total_page){
                                    $endpag = $view_total_page;
                                    $starpag =  $endpag - $maxpag + 1;
                                }
                            }
                            $stardian = "<li><a href='/".$user_id."/page".($starpag-1)."'>···</a></li>";
                            $enddian = "<li><a href='/".$user_id."/page".($endpag+1)."'>···</a></li>";
                            if($starpag!=1)echo $stardian;
                            for ($i=$starpag;$i<=$endpag;$i++){
                                if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                                else {
                                    echo "<li><a href='/".$user_id."/page".$i."'>".$i."</a></li>";
                                }
                            }
                            if($endpag!=$view_total_page)echo $enddian;
                            if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                            else {
                                echo "<li><a href='/".$user_id."/page".($page+1)."'>&raquo;</a></li>";
                            }
                        ?>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
    	</div> <!-- /row -->
    </div> <!-- /container -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>   
    <script src="<?php echo "/template/$OJ_TEMPLATE";?>/js/blog.js?v=201905061112"></script>
    <script type="text/javascript">
        $(function(){  
           home_scan("<?php echo $user_id;?>");//执行浏览统计函数
        });
    </script>
  </body>
</html>