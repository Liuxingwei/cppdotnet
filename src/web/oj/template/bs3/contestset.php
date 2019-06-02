<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="在这里可以参加包括ACM、NOI在内的各种C/C++/java程序比赛，也可以DIY举办各类程序比赛活动！">
    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


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
      <div class="col-lg-9">
        <div class="content_box">
            <div class="box_head">
              <a href="/oj/contest.html"><div class="div_box_head <?php echo $divselected1;?>">标准比赛</div></a>
              <a href="/oj/diycontest.html"><div class="div_box_head <?php echo $divselected2;?>">自主比赛</div></a>
            </div>
        </div>
        <div class="content_box">
          <table class='table table-striped table_style_new'>
          <thead>
          <tr class=toprow><th width=10%>编号<th width=30%>比赛名称<th width=30%>状态<th width=13%><?php if ($ctype!="diy") {?>预约<?php }?><th width=7%>私有<th>举办者</tr>
          </thead>
          <tbody>
          <?php
          $cnt=0;
          foreach($view_contest as $row){
          if ($cnt)
          echo "<tr class='oddrow'>";
          else
          echo "<tr class='evenrow'>";
          foreach($row as $table_cell){
          echo "<td>";
          echo "\t".$table_cell;
          echo "</td>";
          }
          echo "</tr>";
          $cnt=1-$cnt;
          }
          ?>
          </tbody>
          </table>
          <div style="height: 80px;margin-right: 20px;">
            <ul class="pagination pull-right">
                <?php
                    if ($ctype!="main") {
                      $ctypepage=$ctype;
                    }
                    else {
                      $ctypepage="";
                    }
                    if (isset($_GET['last'])) {
                      $last="last&";
                    }
                    else {
                      $last="";
                    }
                    if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                    else {
                        echo "<li><a href='/oj/".$ctypepage."contest.html?".$last."page=".($page-1);
                        echo "'>&laquo;</a></li>";
                    }
                    $maxpag = 7;
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
                    $stardian = "<li><a href='/oj/".$ctypepage."contest.html?".$last."page=".($starpag-1);
                    $stardian.="'>···</a></li>";
                    $enddian = "<li><a href='/oj/".$ctypepage."contest.html?".$last."page=".($endpag+1);
                    $enddian.="'>···</a></li>";
                    if($starpag!=1)echo $stardian;
                    for ($i=$starpag;$i<=$endpag;$i++){
                        if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                        else {
                            echo "<li><a href='/oj/".$ctypepage."contest.html?".$last."page=".$i;
                            echo "'>".$i."</a></li>";
                        }
                    }
                    if($endpag!=$view_total_page)echo $enddian;
                    if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                    else {
                        echo "<li><a href='/oj/".$ctypepage."contest.html?".$last."page=".($page+1);
                        echo "'>&raquo;</a></li>";
                    }
                ?>
            </ul>
        </div>
        </div>
      </div>
      <div class="col-lg-3">
        <!-- <div class="content_box">
          <div><p class="div_box_head_2">服务器时间</p></div>
          <div style="margin: 20px;">
            <p style="font-size: 36px;color: #333;text-align: center;" id=nowtime></p>
            　<span style="font-size: 14px;color: #666;float: right;" id=nowdate></span>
          </div>
        </div> -->
        <div class="content_box">
          <div><p class="div_box_head_2">我的比赛</p></div>
          <ul class="nav nav-stacked nav-pills text-center">
              <li><a href="/oj/allcontest.html">全部比赛</a></li>
              <li><a href="/oj/contest.html?last">近期比赛</a></li>
              <li><a href="/oj/contest_add.php?ctype=diy">创建自主比赛</a></li>
              <?php if(isset($_SESSION['contest_creator']) || isset($_SESSION['administrator'])){ ?>
              <li><a href="/oj/contest_add.php">创建标准比赛</a></li>
              <?php } ?>
              <?php if(isset($_SESSION['user_id'])) { ?>
              <li><a href="/oj/contest_manage.php">管理比赛</a></li>
              <?php } ?>
          </ul>
        </div>
        <div class="content_box">
          <div><p class="div_box_head_2">服务器时间</p></div>
          <div class="div_box_body2"><font id=nowdate></font></div>
        </div>
        <?php
          $difficulty_name=Array("入门题", "普及题", "提高题", "难题");
          if(!isset($_SESSION['mark_name'])){
            $sql = "SELECT attr_value FROM others WHERE attr_name LIKE 'mark%' ORDER BY attr_name";
            $result=mysqli_query($mysqli, $sql);
            $tmpcnt=0;
            while($row = mysqli_fetch_object($result)){
              $mark_name[$tmpcnt]=$row->attr_value;
              $tmpcnt++;
            }
            $_SESSION['mark_name']=$mark_name;
          }else $mark_name=$_SESSION['mark_name'];
        ?>
        <div class="content_box">
            <div id="classification_content">
                <a href="#" class="active">题目类型</a><a href="#">题目难度</a>
                <ul class="nav nav-stacked nav-pills text-center">
                    <li><a href="/oj/problemset.php">全部问题</a></li>
                    <li><a href="/oj/problemset.php?mark=0"><?php echo $mark_name[0];?></a></li>
                    <li><a href="/oj/problemset.php?mark=1"><?php echo $mark_name[1];?></a></li>
                    <li><a href="/oj/problemset.php?mark=2"><?php echo $mark_name[2];?></a></li>
                    <li><a href="/oj/problemset.php?mark=3"><?php echo $mark_name[3];?></a></li>
                    <li><a href="/oj/problemset.php?mark=4"><?php echo $mark_name[4];?></a></li>
                    <li><a href="/oj/problemset.php?mark=5"><?php echo $mark_name[5];?></a></li>
                    <li><a href="/oj/problemset.php?mark=6"><?php echo $mark_name[6];?></a></li>
                    <li><a href="/oj/problemset.php?mark=7"><?php echo $mark_name[7];?></a></li>
                </ul>
                <ul class="nav nav-stacked nav-pills text-center" hidden>
                    <li><a href="/oj/problemset.php">全部问题</a></li>
                    <li><a href="/oj/problemset.php?difficulty=0"><?php echo $difficulty_name[0];?></a></li>
                    <li><a href="/oj/problemset.php?difficulty=1"><?php echo $difficulty_name[1];?></a></li>
                    <li><a href="/oj/problemset.php?difficulty=2"><?php echo $difficulty_name[2];?></a></li>
                    <li><a href="/oj/problemset.php?difficulty=3"><?php echo $difficulty_name[3];?></a></li>
                </ul>
            </div>
        </div>
      </div>
    <!-- <hr style="border:0px;" />
    <?php 
    if(isset($_SESSION['contest_creator']) || isset($_SESSION['administrator']))
        echo '<div class="text-center"><a href="/oj/contest_add.php" class="btn btn-link">创建比赛</a><a href="/oj/contest_manage.php" class="btn btn-link">管理比赛</a></div>';
     ?> -->
 </div> <!-- /container -->
</div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
    <script src="template/<?php echo $OJ_TEMPLATE; ?>/js/problemset.js"></script>  
    <script>
      var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
      //alert(diff);
      function clock()
      {
      var x,h,m,s,n,xingqi,y,mon,d;
      var x = new Date(new Date().getTime()+diff);
      y = x.getYear()+1900;
      if (y>3000) y-=1900;
      mon = x.getMonth()+1;
      d = x.getDate();
      xingqi = x.getDay();
      h=x.getHours();
      m=x.getMinutes();
      s=x.getSeconds();
      n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
      //alert(n);
      document.getElementById('nowdate').innerHTML=n;
      setTimeout("clock()",1000);
      }
      clock();
    </script>   

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

 </body>
</html>
