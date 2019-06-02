<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="蓝桥杯ACM训练实时评测系统，看懂教程后来这里训练吧，在线提交，实时评测，边学边练！成就大神之路！">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

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
        
	<table id="tab_ranklist" class="table table-striped text-center table_style_new">
    <thead>
    <!-- 
    <tr><td colspan=3 align=left>
    <a href=ranklist.php?scope=d>Day</a>
    <a href=ranklist.php?scope=w>Week</a>
    <a href=ranklist.php?scope=m>Month</a>
    <a href=ranklist.php?scope=y>Year</a>
    </td></tr>
    -->
    <tr class='toprow'>
    <td width=10% align=center><b><?php echo $MSG_Number?></b>
    <td width=20% align=center><b><?php echo $MSG_NICK?></b>
    <td align=center><b><?php echo '签名'?></b>
    <!-- <td width=7% align=center><b><?php echo '解决'?></b>
    <td width=7% align=center><b><?php echo $MSG_SUBMIT?></b>
    <td width=9% align=center><b><?php echo '参赛次数'?></b>
    <td width=9% align=center><b><?php echo '发表文章'?></b> -->
    <td width=10% align=center><b><?php echo '经验值'?></b>
    </tr>
    </thead>
    <tbody>
    <?php
    $cnt=0;
    foreach($view_rank as $row){
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
<div class="text-enter" style="height: 80px;margin-right: 20px;">
    <ul class="pagination pull-right">

<?php
// for($i = 0; $i <$view_total ; $i += $page_size) {
//     echo "<a href='./ranklist.php?start=" . strval ( $i ).($scope?"&scope=$scope":"") . "'>";
//     echo strval ( $i + 1 );
//     echo "-";
//     echo strval ( $i + $page_size );
//     echo "</a>&nbsp;";
//     if ($i % 250 == 200)
//     echo "<br>";
// }
if($current_page<5){
    $tmp_cnt=min(9,$view_total);
    for ($i=1;$i<=$tmp_cnt;$i++){
        echo "<li ";
        if($i==$current_page) echo "class='active'";
        if($i==9){
            echo "><a href='ranklist.php?start=".(($i-1)*$page_size).$userid_page;
            echo "'>...</a></li>";
        }
        else{
            echo "><a href='ranklist.php?start=".(($i-1)*$page_size).$userid_page;
            echo "'>".$i."</a></li>";
        }
    }
}else if($current_page>$view_total-5){
    echo "<li><a href='problemset.php?page=".($view_total-8).$userid_page;
    echo "'>...</a></li>";
    for($i=$view_total_page-7;$i<=$view_total;$i++){
        echo "<li ";
        if($i==$current_page) echo "class='active'";
        echo "><a href='ranklist.php?start=".(($i-1)*$page_size).$userid_page;
        echo "'>".$i."</a></li>";
    }
}else{
    echo "<li><a href='ranklist.php?start=".($current_page-4).$userid_page;
    echo "'>...</a></li>";
    for($i=3;$i>=0;$i--){
        echo "<li ";
        if($current_page-$i==$current_page) echo "class='active'";
        echo "><a href='ranklist.php?start=".(($current_page-$i-1)*$page_size).$userid_page;
        echo "'>".($current_page-$i)."</a></li>";
    }
    // $tmp_cnt=min($view_total_page-$page, 4);
    for($i=1;$i<4;$i++){
        echo "<li><a href='ranklist.php?start=".(($current_page+$i-1)*$page_size).$userid_page;
        echo "'>".($current_page+$i)."</a></li>";   
    }
    echo "<li><a href='ranklist.php?start=".(($current_page+4-1)*$page_size).$userid_page;
    echo "'>...</a></li>";
}


?>
         </ul>
        </div> <!-- pagination -->

            </div> <!-- content_box -->
        </div> <!-- col-lg-9 -->
        <div class="col-lg-3">
            <div class="content_box">
                <div><p class="div_box_head_2">用户搜索</p></div>

                <form class="form-inline" action="ranklist.php" style="margin:20px;" id="search_form">
                    <div class="form-group" style="width: 100%;">
                        <input style="width: 100%;" type="text" placeholder="用户" class="form-control" name="user_id" id="search_input" <?php if(isset($user_id)) echo "value=".htmlspecialchars($user_id, ENT_QUOTES); ?>>
                    </div>
                    <div class="form-group form-inline" style="width: 100%;">
                        
                        <button class="btn btn-primary form-control" style="width: 100%;margin-top: 30px;" type="submit">搜索</button>

                    </div>
                </form>
                <div style="margin: 20px;">
                        <a href="/oj/ranklist.html"><button class="btn btn-primary form-control" style="width: 100%;margin-top: 10px;">清除搜索</button></a>
                </div>
            </div>
            <div class="content_box">
                <div id="classification_content">
                    <a href="#" class="active">题目类型</a><a href="#">题目难度</a>
                    <ul class="nav nav-stacked nav-pills text-center">
                        <li><a href="problemset.php">全部问题</a></li>
                        <li><a href="problemset.php?mark=0"><?php echo $mark_name[0];?></a></li>
                        <li><a href="problemset.php?mark=1"><?php echo $mark_name[1];?></a></li>
                        <li><a href="problemset.php?mark=2"><?php echo $mark_name[2];?></a></li>
                        <li><a href="problemset.php?mark=3"><?php echo $mark_name[3];?></a></li>
                        <li><a href="problemset.php?mark=4"><?php echo $mark_name[4];?></a></li>
                        <li><a href="problemset.php?mark=5"><?php echo $mark_name[5];?></a></li>
                        <li><a href="problemset.php?mark=6"><?php echo $mark_name[6];?></a></li>
                        <li><a href="problemset.php?mark=7"><?php echo $mark_name[7];?></a></li>
                    </ul>
                    <ul class="nav nav-stacked nav-pills text-center" hidden>
                        <li><a href="problemset.php">全部问题</a></li>
                        <li><a href="problemset.php?difficulty=0"><?php echo $difficulty_name[0];?></a></li>
                        <li><a href="problemset.php?difficulty=1"><?php echo $difficulty_name[1];?></a></li>
                        <li><a href="problemset.php?difficulty=2"><?php echo $difficulty_name[2];?></a></li>
                        <li><a href="problemset.php?difficulty=3"><?php echo $difficulty_name[3];?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- /container -->
    </div> <!-- /wrap -->
   <?php require("template/$OJ_TEMPLATE/footer.php") ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	 
    <script src="template/<?php echo $OJ_TEMPLATE; ?>/js/problemset.js"></script>     
  </body>
</html>
