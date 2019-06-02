<!DOCTYPE html>
<!--
 *=============Dragon be here!==========/
 * 　　　┏┓　　　┏┓
 * 　　┏┛┻━━━┛┻┓
 * 　　┃　　　　　　　┃
 * 　　┃　　　━　　　┃
 * 　　┃　┳┛　┗┳　┃
 * 　　┃　　　　　　　┃
 * 　　┃　　　┻　　　┃
 * 　　┃　　　　　　　┃
 * 　　┗━┓　　　┏━┛
 * 　　　　┃　　　┃神兽保佑
 * 　　　　┃　　　┃代码无BUG！
 * 　　　　┃　　　┗━━━┓
 * 　　　　┃　　　　　　　┣┓
 * 　　　　┃　　　　　　　┏┛
 * 　　　　┗┓┓┏━┳┓┏┛
 * 　　　　　┃┫┫　┃┫┫
 * 　　　　　┗┻┛　┗┻┛
 * ━━━━━━神兽出没━━━━━━
 -->
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="蓝桥杯ACM训练实时评测系统，看懂教程后来这里训练吧，在线提交，实时评测，边学边练！成就大神之路！">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title><?php echo $view_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    
<link rel="stylesheet" href="/oj/template/<?php echo $OJ_TEMPLATE; ?>/css/problemset.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        table.table_style_new>tbody>tr>td:first-child+td+td+td,table.table_style_new>tbody>tr>td:first-child+td+td+td+td {
            text-align: right;
        }
    </style>
  </head>

  <body>
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
        <div class="col-lg-9">
            <div class="content_box">
                <div><!-- class="row" -->
                    <table id='problemset' class='table table-striped table_style_new'>
                    <thead>
                        <tr class='toprow'>
                            <th width='50'></th>
                            <th width='60' >题　目</th>
                            <th></th>
                            <th width='25%'></th>
                            <th width='10%'></th>
                            <th style="cursor:hand" width=100 >解决/提交</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cnt=0;
                    foreach($view_problemset as $row){
                        if ($cnt)
                            echo "<tr class='oddrow'>";
                        else
                            echo "<tr class='evenrow'>";
                        foreach($row as $table_cell){
                            echo "<td>";
                            echo $table_cell;
                            echo "</td>";
                        }
                        echo "</tr>";
                        $cnt=1-$cnt;
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
                <div style="height: 80px;margin-right: 20px;">
                    <ul class="pagination pull-right">
                        <?php
                        // echo "<script>console.log('$view_total_page')</script>";
                        // echo "<script>console.log('$page')</script>";
                        
                            if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                            else {
                                echo "<li><a href='/oj/problemset.php?page=".($page-1);
                                if(isset($difficulty)) echo "&difficulty=$difficulty";
                                if(isset($mark_)) echo "&mark=$mark_";
                                if(isset($search)) echo "&search=$search";
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
                            $stardian = "<li><a href='/oj/problemset.php?page=".($starpag-1);
                            if(isset($difficulty)) $stardian.="&difficulty=$difficulty";
                            if(isset($mark_)) $stardian.="&mark=$mark_";
                            if(isset($search)) $stardian.="&search=$search";
                            $stardian.="'>···</a></li>";
                            $enddian = "<li><a href='/oj/problemset.php?page=".($endpag+1);
                            if(isset($difficulty)) $enddian.="&difficulty=$difficulty";
                            if(isset($mark_)) $enddian.="&mark=$mark_";
                            if(isset($search)) $enddian.="&search=$search";
                            $enddian.="'>···</a></li>";
                            if($starpag!=1)echo $stardian;
                            for ($i=$starpag;$i<=$endpag;$i++){
                                if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                                else {
                                    echo "<li><a href='/oj/problemset.php?page=".$i;
                                    if(isset($difficulty)) echo "&difficulty=$difficulty";
                                    if(isset($mark_)) echo "&mark=$mark_";
                                    if(isset($search)) echo "&search=$search";
                                    echo "'>".$i."</a></li>";
                                }
                            }
                            if($endpag!=$view_total_page)echo $enddian;
                            if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                            else {
                                echo "<li><a href='/oj/problemset.php?page=".($page+1);
                                if(isset($difficulty)) echo "&difficulty=$difficulty";
                                if(isset($mark_)) echo "&mark=$mark_";
                                if(isset($search)) echo "&search=$search";
                                echo "'>&raquo;</a></li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="content_box">
                <div><p class="div_box_head_2">题目搜索</p></div>
                <form action="problemset.php" style="margin:20px;" id="search_form">
                    <div class="form-group">
                        <input type="text" placeholder="搜索" class="form-control" name="search" id="search_input" <?php if(isset($search)) echo "value=".htmlspecialchars($search, ENT_QUOTES); ?>>
                    </div>
                    <div class="form-group">
                        
                        <!-- <select name="type_chose" id="type_chose" class="form-control div_inline_5">
                            <option value="id" <?php if(!isset($search)) echo 'selected';?>>题号</option>
                            <option value="search" <?php if(isset($search)) echo 'selected';?>>标题</option>
                        </select> -->
                        
                        
                        <button class="btn btn-primary form-control div_inline_5" type="submit">搜索</button>
                        
                    </div>
                </form>
            </div>
            <div class="content_box">
                <div><p class="div_box_head_2">题目编号</p></div>
                <form action="problem.php" style="margin:20px;">
                    <div class="form-group">
                        <input type="text" placeholder="题号" class="form-control" name="id">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary form-control div_inline_5" type="submit">进入</button>
                    </div>
                </form>
            </div>

            <?php if (isset($_SESSION['administrator'])) {?>
            <div class="content_box">
                <div><p class="div_box_head_2">题目标签</p></div>
                <?php echo $view_category?>
            </div>
            <?php } ?>

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
    </div> <!-- /container -->
    <!-- <div id="classification">
        <div id="classification_content">
            <a href="#" class="active">难度</a>
            <a href="#">标签</a>
            <ul class="nav nav-stacked nav-pills text-center">
                <li><a href="/oj/problemset.php">全部问题</a></li>
                <li><a href="/oj/problemset.php?difficulty=0"><?php echo $difficulty_name[0];?></a></li>
                <li><a href="/oj/problemset.php?difficulty=1"><?php echo $difficulty_name[1];?></a></li>
                <li><a href="/oj/problemset.php?difficulty=2"><?php echo $difficulty_name[2];?></a></li>
                <li><a href="/oj/problemset.php?difficulty=3"><?php echo $difficulty_name[3];?></a></li>
            </ul>
            <ul class="nav nav-stacked nav-pills text-center" hidden>
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
        </div>
        <div id="classification_hint" class="light_blue">
            题目分类
        </div>
    </div> -->
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	
    <script src="template/<?php echo $OJ_TEMPLATE; ?>/js/problemset.js"></script>    
<!-- <script type="text/javascript" src="include/jquery.tablesorter.js"></script> -->
<!-- <script type="text/javascript">
$(document).ready(function()
{
$("#problemset").tablesorter();
}
);
</script> -->

<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

</body>
</html>
