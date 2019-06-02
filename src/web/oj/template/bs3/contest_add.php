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
      <div>
        <select name="pstart" onchange="getProblem(this.value)">
          <?php
            for($i=0;$i<$page_cnt;$i++){
              echo "<option value='$i'>".(10+$i)."00-".(10+$i)."99</option>";
            }
          ?>
        </select>
        <form action="contest_add2.php" style="display:inline-block;" id="form1">

          <!-- 比赛类型 -->
          <input type="text" name="ctype" value="<?php echo $ctype?>" hidden>
          <!--  -->
          <input type="text" name="p_selected" id="p_selected" value="" hidden>
          <button class="btn btn-primary" type="submit">加入比赛</button>
        </form>
      </div>
      <hr style="border:0px;"/>
        <table class="table table-striped" id="p_table">
            <thead>
              <tr class="toprow">
                <th width=15%>问题编号</th>  
                <th width=85%>标题</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $row_type=0;
                for($i=0;$i<$problem_cnt;$i++){
                  echo $row_type?"<tr class='oddrow'>":"<tr class='evenrow'>";
                  $problem_id=$view_problem[$i]['problem_id'];
                  echo "<td>".$problem_id."<input type='checkbox' value=".$problem_id."></td>";
                  echo "<td> <a href='problem.php?id=".$problem_id."' target='_blank'>".$view_problem[$i]['title']."</a></td>";
                  echo "</tr>";
                  $row_type=1-$row_type;
                }
              ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="document.getElementById('form1').submit();">加入比赛</button>
        <hr style="border:0px;" />
     </div> <!-- /container -->
    </div>
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>
    <script src="template/<?php echo $OJ_TEMPLATE;?>/js/contest_add.js"></script> 
  </body>
</html>
