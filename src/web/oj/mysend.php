<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
    require_once('./include/my_func.inc.php');
	require_once('./include/setlang.php');
	$url_oj="/oj/";
	$view_title= "投递记录 - C语言网";

	$user_id=$_GET['user_id'];
	$nick=getNickByid($user_id);
	if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_cpn'])){
        $view_errors="您尚未登录，请先<a href=".$url_oj."loginpage.php>登录</a>！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if(isset($_SESSION['user_cpn'])){
        $view_errors="您所在用户组错误！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }
    if (isset($_SESSION['user_id']) && $user_id!=$_SESSION['user_id'] && !isset($_SESSION['administrator'])) {
    	$view_errors="无权查看！";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }

	$sql="SELECT `job_id`,`send_time` FROM `resume_send` WHERE `user_id`='".$user_id."' ORDER BY `send_time` DESC";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$arr_send=Array();
	$i=0;
	while ($row=mysqli_fetch_object($result)) {
	 	$job_id=$row->job_id;
	 	$send_time=$row->send_time;
	 	$sql_job="SELECT `compname`,`position` FROM `job_list` WHERE `id`='".$job_id."'";
		$result_job=mysqli_query($mysqli,$sql_job) or die(mysqli_error());
		$row_job=mysqli_fetch_object($result_job);
		$compname=$row_job->compname;
		$position=$row_job->position;
		$arr_send[$i][0]="<a href='/job/".$job_id.".html'>".$position."</a>";
		$arr_send[$i][1]=$compname;
		$arr_send[$i][2]=$send_time;
	 	$i+=1;
	}

	mysqli_free_result($result);
?>
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
    <style type="text/css">
    	td {
    		font-size: 16px;
    		padding: 2px;
    	}
    	/*搜索*/
		.form_search {
			margin: 20px;
		}
		.div_salary {
			width: 42%;
		}
		.div_search_select select.form-control {
			width: 68%;
		}
    </style>
  </head>
  <body>
  <div class="wrap">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
    <div class="container" id="body">
    	<div style="padding: 0px 15px;">
	    	<div class="content_box">
		    	<div class="box_head">
			 		<a href="/job/list"><div class="div_box_head">职位信息</div></a>
			 		<?php if(isset($_SESSION['user_cpn'])) { ?>
			 			<div style="color: #666;" class="div_box_head div_selected">投递记录</div>
				 		<div style="color: #666;" class="div_box_head">我的简历</div>
			 		<?php } else { ?>
				 		<a href="/job/mysend/<?php echo $user_id;?>"><div class="div_box_head div_selected">投递记录</div></a>
				 		<a href="/oj/resume.php?user_id=<?php echo $user_id;?>"><div class="div_box_head">我的简历</div></a>
			 		<?php } ?>
			 	</div>
		 	</div>
	 	</div>
    	<div class="col-lg-9">
			<div class="content_box">
			  	<table class='table table-striped table_style_new'>
			  		<thead>
					<tr class="toprow">
						<td width="40%"><span style="font-weight: bold;"><?php echo $nick;?>的投递记录</span></td>
						<td width="40%">公司名称</td>
						<td width="20%">投递时间</td>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($arr_send as $row_tr) {
							echo "<tr>";
							foreach ($row_tr as $row_td) {
								echo "<td>";
				                echo $row_td;
				                echo "</td>";
							}
						echo "</tr>";
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="content_box">
				<div><p class="div_box_head_2">搜索职位</p></div>
				<div class="input-append">
			    	<form class="form_search" action="/job/list" method="get">
			    		<div class="form-group">
			    			<input class="form-control div_position" type=text placeholder="职位" name=position>
		    			</div>
		    			<div class="form-group form-inline">
			    			<div class="input-group div_salary">
			                    <input type="tel" min="0" name="salary_min" class="form-control salary_int" placeholder="最低薪资" maxlength="10">
			                </div>
			                <lable>k-</lable>
			                <div class="input-group div_salary">
			                    <input type="tel" min="0" name="salary_max" class="form-control salary_int" placeholder="最高薪资" maxlength="10">
			                </div>
			                <lable>k</lable>
		                </div>
		                
		                <div class="form-group">
		                	<div class="div_search_select form-inline">
			                <div class="div_input_left">工作性质</div><select class="form-control" name="propt">
			    				<option value="" <?php if ($propt=="") echo "selected"?>>---</option>
			                    <option value="1" <?php if ($propt=="全职") echo "selected"?>>全职</option>
			                    <option value="2" <?php if ($propt=="兼职") echo "selected"?>>兼职</option>
			                    <option value="3" <?php if ($propt=="实习") echo "selected"?>>实习</option>
			                </select>
			                </div>
		                </div>
		                <div class="form-group">
			                <div class="div_search_select form-inline">
			    			<div class="div_input_left">工作经验</div><select class="form-control" name="exp">
			    				<option value="" <?php if ($exp=="") echo "selected"?>>---</option>
			    				<option value="0" <?php if ($exp=="不限") echo "selected"?>>不限</option>
				                <option value="1" <?php if ($exp=="应届生") echo "selected"?>>应届生</option>
				                <option value="2" <?php if ($exp=="1年以下") echo "selected"?>>1年以下</option>
				                <option value="3" <?php if ($exp=="1-3年") echo "selected"?>>1-3年</option>
				                <option value="4" <?php if ($exp=="3年-5年") echo "selected"?>>3年-5年</option>
				                <option value="5" <?php if ($exp=="5年以上") echo "selected"?>>5年以上</option>
			                </select>
			                </div>
		                </div>
		                <div class="form-group">
			                <div class="div_search_select form-inline">
			    			<div class="div_input_left">学历要求</div><select class="form-control" name="edu">
			    				<option value="" <?php if ($edu=="") echo "selected"?>>---</option>
			    				<option value="0" <?php if ($edu=="不限") echo "selected"?>>不限</option>
			                    <option value="1" <?php if ($edu=="专科") echo "selected"?>>专科</option>
			                    <option value="2" <?php if ($edu=="本科") echo "selected"?>>本科</option>
			                    <option value="3" <?php if ($edu=="硕士") echo "selected"?>>硕士</option>
			                    <option value="4" <?php if ($edu=="博士") echo "selected"?>>博士</option>
			                </select>
			                </div>
		                </div>
		                <div class="form-group">
			                <input type=submit class='form-control btn btn-primary' value='<?php echo "搜索职位";?>'>
		                </div>
			    	</form>
			    </div>
			</div>
			<!-- <div class="content_box">
                <div><p class="div_box_head_2">求　　职</p></div>
                    <ul class="nav nav-stacked nav-pills text-center">
                    	<li><a href="/job/list">职位信息</a></li>
                    <?php if(isset($_SESSION['user_cpn'])) { ?>
                    	<li><a style="color: #666;" href="">投递记录</a></li>
                    	<li><a style="color: #666;" href="">我的简历</a></li>
			 		<?php } else { ?>
				 		<li><a href="/job/mysend/<?php echo $user_id;?>">投递记录</a></li>
                        <li><a href="/oj/resume.php?user_id=<?php echo $user_id;?>">我的简历</a></li>
			 		<?php } ?>
                    </ul>
            </div>
			<div class="content_box">
                <div><p class="div_box_head_2">招　　聘</p></div>
                    <ul class="nav nav-stacked nav-pills text-center">
                        <li><a href="/oj/job_release.php">发布信息</a></li>
                    </ul>
            </div> -->
		</div>
	</div>
  </div>
  	<?php require("template/$OJ_TEMPLATE/footer.php") ?>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<?php include("template/$OJ_TEMPLATE/js.php");?>	
  </body>
</html>