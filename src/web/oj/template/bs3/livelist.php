<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
  <meta name="description" content="C语言网(www.dotcpp.com)不仅提供C语言，还包括C++、java、算法与数据结构等课程在内的各种入门教程、视频录像、编程经验、编译器教程及软件下载、题解博客，源码分享等优质资源，提倡边学边练边分享，同时提供对口的IT工作，是国内领先实用的综合性编程学习网站！">
    <meta name="author" content="">
    
  
    
    <link rel="icon" href="../../favicon.ico">

    <title>在线课堂-编程在线学习 - C语言网</title> 
    
    <?php include("template/$OJ_TEMPLATE/css.php");?>     
    <link rel="stylesheet" href="template/<?php echo $OJ_TEMPLATE;?>/css/problem.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="wrap">
          <!-- Static navbar -->
	    
      <?php include("template/$OJ_TEMPLATE/nav.php");?>

      <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
        
        
        <div class="row">
        	<?php 
        		if(isset($_SESSION['administrator'])){
					   echo '<a href="livemgn.php" class="btn btn-success" id="liveAdmin" target="_blank" >视频后台管理</a>';
				    }
        	?>
        	
            <table id='problemset' class='table table-striped'>
            <thead>
                <tr class='toprow' >
                	<th width="5%">编号</th>
                    <th width='7%'>状态</th>
                    <th>内容</th>
                    <th width='15%'>老师</th>
                    <th width='15%'>时间</th>
                   
                </tr>
            </thead>
            <tbody>
     			<?php
					$pagesize = 15;		//每页显示的留言数
					$page = isset($_GET['page'])?$_GET['page']:1;		//确定页数 page 参数
					$offset = ($page-1)*$pagesize;		//数据指针
					$sql = "SELECT * FROM liveshow ORDER BY id DESC LIMIT  $offset , $pagesize";
					//echo $query_sql;  //输出sql语句，用于调试
					$result = mysqli_query($mysqli,$sql);
					while($values = mysqli_fetch_array($result))
					{
					    echo "<tr ><td>".$values['id']."</td>";
						if($values['state']=='直播')
						{
							echo '<td><a class="center btn hard_label btn-pink liveAccess"  href="live.php" >'.$values['state'].'</a></td>';
						}
						else if($values['state']=='录像')
						{
							echo '<td><a class="center btn hard_label btn-primary videoAccess" href="'.$values["url"].'"  target=_blank>'.$values['state'].'</a></td>';
						}
						if($values['state']=='直播')
						{
							echo '<td><a href="live.php" class="liveAccess" >'.$values['content'].'</a>';
						}
						else if($values['state']=='录像')
						{
							echo '<td><a  href="'.$values["url"].'" target=_blank class="videoAccess">'.$values['content'].'</a>';
						}
						echo "<td>".$values['teacher']."</td>";
						echo "<td>".$values['date']."</td>";
					}
          $sql="SELECT count(*) as count FROM liveshow";
					$count_result= mysqli_query($mysqli,$sql);
					$count_all=mysqli_fetch_array($count_result);
					$pagenum=ceil($count_all['count']/$pagesize);
					
					//输出分页按钮
					echo '<ul class="pagination pull-right">';
		        	 
		        		if ($pagenum > 1)
							{
							    for($i=1;$i<=$pagenum;$i++)
							    {
							        if($i==$page)
							        {
							            echo '<li class="active"><a href="livelist.php?page=',$i,'">',$i,'</a></li>';
							        } else 
							        {
							        	echo '<li ><a href="livelist.php?page=',$i,'">',$i,'</a></li>';		
							        }
							    }
							}	    
		        echo '</ul>';

					?>
        	<!--
        	<tr class='evenrow'>
        		<td>20</td>
        		<td><span class=none>直播</span></td>
        		<td><span class='left'><a href='live.html'>C语言知识点</a></span></td>
        		<td><a class='center btn hard_label btn-light_green 'href='problemset.php?difficulty=0''>黄老师</a></td>
        		<td><span class='center'>2016-8-8</span></td>
        	</tr>
        	<tr class='oddrow'>
        		<td>19</td>
        		<td><span class=none>录播</span></td>
        		<td><span class='left'><a href='http://www.youku.com'>c++语言知识点</a></span></td>
        		<td><a class='center btn hard_label btn-light_green 'href='problemset.php?difficulty=0''>黄老师</a></td>
        		<td><span class='center'>2016-8-7</span></td>
        	</tr>
        	-->
            </tbody>
            </table>
        </div>

     </div> <!-- container-->
   
    </div> <!-- /wrap -->
    <?php require("template/$OJ_TEMPLATE/footer.php") ?>

<?php include("template/$OJ_TEMPLATE/js.php");?>
<script src="template/bs3/js/problemset.js"></script>
<?php 
	if(!isset($_SESSION['user_id'])){
		echo '<script>
				   $(".liveAccess").attr("href","#");
				   $(".liveAccess").click(function(){
						alert("工程师~您还没有登录~");
					});
			  </script>';
	}
?>


<!-- 百度分享 -->
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"6","bdPos":"right","bdTop":"150.5"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

</body>
</html>
<!--not cached-->
