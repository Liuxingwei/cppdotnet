<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
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

    <!-- <div class="container"> -->
    <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
     <div class="container" id="body">
      <h1 class=text-center>我创建的比赛</h1>
      <table class="table table-striped" style="font-size:14px;">
        <thead>
          <tr class="toprow">
            <th>比赛编号</th>
            <th width="30%">标题</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>权限</th>
            <th>状态</th>
            <th>编辑</th>
            <!-- <th>日志</th> -->
          </tr>
        </thead>
        <tbody>
            <?php 
              $cnt=1;
              for($i=0;$i<$contest_cnt;$i++){
                $cid=$view_contest[$i]['contest_id'];
                echo $cnt?"<tr class='evenrow'>":"<tr class='oddrow'>";
              ?>

                <td><?php echo $cid; ?></td>
                <td><a href="contest<?php echo $cid; ?>.html"><?php echo $view_contest[$i]['title']; ?></a></td>
                <td><?php echo $view_contest[$i]['start_time']; ?></td>
                <td><?php echo $view_contest[$i]['end_time']; ?></td>
                <td><?php echo $view_contest[$i]['private']?'私有':'公开'; ?></td>
                <td><?php echo $view_contest[$i]['defunct']=='N'?'可用':'停用'; ?></td>
                <td><a href="contest_edit.php?cid=<?php echo $cid; ?>">编辑</a></td>
              </tr>
              <?php
                $cnt=1-$cnt;
              }
               ?>  
        </tbody>
      </table>
     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
</html>
