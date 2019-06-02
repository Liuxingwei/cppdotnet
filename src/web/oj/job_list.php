<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "互联网招聘 - C语言网";
	$page_mark="job";

	$user_id=$_SESSION['user_id'];

	$position="";
	$propt="";
	/*$place="";*/
	/*$salary="";*/
	$salary_min="";
	$salary_max="";
	$exp="";
	$edu="";

	//分页
	$sql_page="SELECT count(1) FROM `job_list` WHERE `status`='1'";
	//
	$sql="SELECT `id`,`compname`,`position`,`place`,`propt`,`salary`,`salary_min`,`salary_max`,`release_time` FROM `job_list` WHERE `status`='1'";
	if (isset($_GET['position'])){
		switch ($_GET['position']) {
			case 'cyuyan':
			$position="C语言";
			break;
			case 'cpp':
			$position="C++";
			break;
			case 'java':
			$position="java";
			break;
			case 'qianrushi':
			$position="嵌入式";
			break;
			case 'jiagoushi':
			$position="架构";
			break;
			case 'suanfa':
			$position="算法";
			break;
			case 'qianduan':
			$position="前端";
			break;
			case 'php':
			$position="PHP";
			break;
			case 'dotnet':
			$position=".NET";
			break;
			default:
			$position=htmlentities($_GET['position'],ENT_QUOTES,'UTF-8');  
			break;
		}   
	}
	if (isset($_GET['propt'])){
	        $propt=$_GET['propt'];
    }
    /*if (isset($_GET['salary'])){
	        $salary=$_GET['salary'];
    }*/
    if (isset($_GET['exp'])){
	        $exp=$_GET['exp'];
    }
    if (isset($_GET['edu'])){
	        $edu=$_GET['edu'];
    }
    if (isset($_GET['salary_min'])){
	        $salary_min_view=$_GET['salary_min'];
	        $salary_min=$salary_min_view*1000;
    }
    if (isset($_GET['salary_max'])){
	        $salary_max_view=$_GET['salary_max'];
	        $salary_max=$salary_max_view*1000;
    }

    if ($salary_min!="" && $salary_max!="") {
		$sql=$sql."AND `salary`='2' AND `salary_min`<='$salary_max' AND `salary_max`>='$salary_min'";
		$sql_page=$sql_page."AND `salary`='2' AND `salary_min`<='$salary_max' AND `salary_max`>='$salary_min'";
	}
	if ($salary_min!="" && $salary_max=="") {
    	$sql=$sql."AND `salary`='2' AND `salary_max`>='$salary_min'";
    	$sql_page=$sql_page."AND `salary`='2' AND `salary_max`>='$salary_min'";
    }
    if ($salary_min=="" && $salary_max!="") {
    	$sql=$sql."AND `salary`='2' AND `salary_min`<='$salary_max'";
    	$sql_page=$sql_page."AND `salary`='2' AND `salary_min`<='$salary_max'";
    }

    if ($position!=="") {
    	$sql=$sql."AND `position` LIKE '%".$position."%'";
    	$sql_page=$sql_page."AND `position` LIKE '%".$position."%'";
    }
    if ($propt!=="") {
    	switch ($propt) {
	    	case 1:
				$propt_data="全职";
			break;
			case 2:
				$propt_data="兼职";
			break;
			case 3:
				$propt_data="实习";
			break;
	    }
	    $sql=$sql."AND `propt`='".$propt_data."'";
	    $sql_page=$sql_page."AND `propt`='".$propt_data."'";
    }
    if ($exp!=="") {
    	switch ($exp) {
        	case 0:
				$exp_data="不限";
				break;
			case 1:
				$exp_data="应届生";
				break;
			case 2:
				$exp_data="1年以下";
				break;
			case 3:
				$exp_data="1-3年";
				break;
			case 4:
				$exp_data="3年-5年";
				break;
			case 5:
				$exp_data="5年以上";
				break;
        }
        $sql=$sql."AND `exp`='".$exp_data."'";
        $sql_page=$sql_page."AND `exp`='".$exp_data."'";
    }
	if ($edu!=="") {
		switch ($edu) {
        	case 0:
				$edu_data="不限";
				break;
			case 1:
				$edu_data="专科";
				break;
			case 2:
				$edu_data="本科";
				break;
			case 3:
				$edu_data="硕士";
				break;
			case 4:
				$edu_data="博士";
				break;
        }
        $sql=$sql."AND `edu`='".$edu_data."'";
        $sql_page=$sql_page."AND `edu`='".$edu_data."'";
	}

	//分页
	$page_cnt=20;
	$result_page=mysqli_query($mysqli,$sql_page);
	$row_page=mysqli_fetch_array($result_page);
	$job_cnt=$row_page[0];
	$view_total_page=intval(ceil($job_cnt/$page_cnt));
	if (isset($_GET['page'])) {
	    $page=$_GET['page'];
	}
	else{
	    $page=1;
	}
	//
	$sql=$sql."ORDER BY `release_time` DESC LIMIT ".($page-1)*$page_cnt.",$page_cnt";
	$result=mysqli_query($mysqli,$sql) or die(mysqli_error());

	$usercpn_data=Array();
	$i=0;
	while ($row=mysqli_fetch_object($result)){
		if ($row->salary=='2') {
			$row_salary_min_view=$row->salary_min*0.001;
			$row_salary_max_view=$row->salary_max*0.001;
			$salary_show="<span style='color: green;'>".$row_salary_min_view." - ".$row_salary_max_view." k /月</span>";
		}
		else {
			$salary_show="<span style='color: red;'>面议</span>";
		}
		$usercpn_data[$i]=Array();
		$usercpn_data[$i][0]="<a href='/job/".$row->id.".html'>".$row->position."</a>";
		$usercpn_data[$i][1]=$row->compname;
	    $usercpn_data[$i][2]=$row->place;
	   	$usercpn_data[$i][3]=$row->propt; 
	   	$usercpn_data[$i][4]=$salary_show; 
	   	$usercpn_data[$i][5]=date("Y-m-d",strtotime($row->release_time)); 
		$i++;
	}
	mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="C语言|C++|java|C语言入门|编程入门|C语言编程软件|C语言教程|OJ在线评测|编程比赛|学编程|C++教程|java教程|数据结构|蓝桥杯|ACM|算法入门|编程题库|题解博客|dotcpp网|C语言网
">
    <meta name="description" content="互联网招聘，在线求职，在线招聘。对口、靠谱！">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

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
		.div_box_head_last {
			font-size: 16px;
			border-left: 1px solid #c0cdd9;
			line-height: 28px;
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
			 		<a href="/job/list"><div class="div_box_head div_selected">职位信息</div></a>
			 		<?php if(isset($_SESSION['user_cpn'])) { ?>
			 			<div style="color: #666;" class="div_box_head">投递记录</div>
				 		<div style="color: #666;" class="div_box_head">我的简历</div>
			 		<?php } else { ?>
				 		<a href="/job/mysend/<?php echo $user_id;?>"><div class="div_box_head">投递记录</div></a>
				 		<a href="/oj/resume.php?user_id=<?php echo $user_id;?>"><div class="div_box_head">我的简历</div></a>
			 		<?php } ?>
			 		<a href="/oj/job_release.php" style="float: right;"><div class="div_box_head div_box_head_last">我要招聘</div></a>
			 	</div>
		 	</div>
	 	</div>
    	<div class="col-lg-9">
		    <div class="content_box">
			  	<table class='table table-striped table_style_new'>
			  		<thead>
					<tr class="toprow">
						<td width="28%">需求职位</td>
						<td>公司名称</td>
						<td width="13%">地点</td>
						<td width="8%">性质</td>
						<td width="13%">薪资</td>
						<td width="12%">更新时间</td>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($usercpn_data as $row_tr) {
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
				<div style="height: 80px;margin-right: 20px;">
                    <ul class="pagination pull-right">
                        <?php
                        // echo "<script>console.log('$view_total_page')</script>";
                        // echo "<script>console.log('$page')</script>";
                        
                            if($page==1) echo "<li class='disabled'><span>&laquo;</span></li>";
                            else {
                                echo "<li><a href='/job/list?page=".($page-1);
                                if(isset($_GET['position']) || isset($_GET['propt']) || isset($_GET['exp']) || isset($_GET['edu']) || isset($_GET['salary_min']) || isset($_GET['salary_max'])) {
                                	echo "&position=$position&salary_min=$salary_min&salary_max=$salary_max&propt=$propt&exp=$exp&edu=$edu";
                            	}
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
                            $stardian = "<li><a href='/job/list?page=".($starpag-1);
                            if(isset($_GET['position']) || isset($_GET['propt']) || isset($_GET['exp']) || isset($_GET['edu']) || isset($_GET['salary_min']) || isset($_GET['salary_max'])) {
                            	$stardian.="&position=$position&salary_min=$salary_min&salary_max=$salary_max&propt=$propt&exp=$exp&edu=$edu";
	                        }
                            $stardian.="'>···</a></li>";
                            $enddian = "<li><a href='/job/list?page=".($endpag+1);
                            if(isset($_GET['position']) || isset($_GET['propt']) || isset($_GET['exp']) || isset($_GET['edu']) || isset($_GET['salary_min']) || isset($_GET['salary_max'])) {
                            	$enddian.="&position=$position&salary_min=$salary_min&salary_max=$salary_max&propt=$propt&exp=$exp&edu=$edu";
	                        }
                            $enddian.="'>···</a></li>";
                            if($starpag!=1)echo $stardian;
                            for ($i=$starpag;$i<=$endpag;$i++){
                                if ($i==$page) echo "<li class='active'><a href='#'>".$i."</a></li>";
                                else {
                                    echo "<li><a href='/job/list?page=".$i;
                                    if(isset($_GET['position']) || isset($_GET['propt']) || isset($_GET['exp']) || isset($_GET['edu']) || isset($_GET['salary_min']) || isset($_GET['salary_max'])) {
                                    	echo "&position=$position&salary_min=$salary_min&salary_max=$salary_max&propt=$propt&exp=$exp&edu=$edu";
                                	}
                                    echo "'>".$i."</a></li>";
                                }
                            }
                            if($endpag!=$view_total_page)echo $enddian;
                            if($page==$view_total_page) echo "<li class='disabled'><span>&raquo;</span></li>";
                            else {
                                echo "<li><a href='/job/list?page=".($page+1);
                                if(isset($_GET['position']) || isset($_GET['propt']) || isset($_GET['exp']) || isset($_GET['edu']) || isset($_GET['salary_min']) || isset($_GET['salary_max'])) {
                                	echo "&position=$position&salary_min=$salary_min&salary_max=$salary_max&propt=$propt&exp=$exp&edu=$edu";
                            	}
                                echo "'>&raquo;</a></li>";
                            }
                        ?>
                    </ul>
                </div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="content_box">
				<div><p class="div_box_head_2">搜索职位</p></div>
				<div class="input-append">
			    	<form class="form_search" action="/job/list" method="get">
			    		<div class="form-group">
			    			<input class="form-control div_position" type=text placeholder="职位" name=position value='<?php echo  htmlspecialchars($position, ENT_QUOTES) ?>'>
		    			</div>
		    			<div class="form-group form-inline">
			    			<div class="input-group div_salary">
			                    <input type="tel" min="0" name="salary_min" class="form-control salary_int" placeholder="最低薪资" maxlength="10" value="<?php echo $salary_min_view?>">
			                </div>
			                <lable>k-</lable>
			                <div class="input-group div_salary">
			                    <input type="tel" min="0" name="salary_max" class="form-control salary_int" placeholder="最高薪资" maxlength="10" value="<?php echo $salary_max_view?>">
			                </div>
			                <lable>k</lable>
		                </div>
		                
		                <div class="form-group">
		                	<div class="div_search_select form-inline">
			                <div class="div_input_left">工作性质</div><select class="form-control" name="propt">
			    				<option value="" <?php if ($propt=="") echo "selected"?>>---</option>
			                    <option value="1" <?php if ($propt=="1") echo "selected"?>>全职</option>
			                    <option value="2" <?php if ($propt=="2") echo "selected"?>>兼职</option>
			                    <option value="3" <?php if ($propt=="3") echo "selected"?>>实习</option>
			                </select>
			                </div>
		                </div>
		                <div class="form-group">
			                <div class="div_search_select form-inline">
			    			<div class="div_input_left">工作经验</div><select class="form-control" name="exp">
			    				<option value="" <?php if ($exp=="") echo "selected"?>>---</option>
			    				<option value="0" <?php if ($exp=="0") echo "selected"?>>不限</option>
				                <option value="1" <?php if ($exp=="1") echo "selected"?>>应届生</option>
				                <option value="2" <?php if ($exp=="2") echo "selected"?>>1年以下</option>
				                <option value="3" <?php if ($exp=="3") echo "selected"?>>1-3年</option>
				                <option value="4" <?php if ($exp=="4") echo "selected"?>>3年-5年</option>
				                <option value="5" <?php if ($exp=="5") echo "selected"?>>5年以上</option>
			                </select>
			                </div>
		                </div>
		                <div class="form-group">
			                <div class="div_search_select form-inline">
			    			<div class="div_input_left">学历要求</div><select class="form-control" name="edu">
			    				<option value="" <?php if ($edu=="") echo "selected"?>>---</option>
			    				<option value="0" <?php if ($edu=="0") echo "selected"?>>不限</option>
			                    <option value="1" <?php if ($edu=="1") echo "selected"?>>专科</option>
			                    <option value="2" <?php if ($edu=="2") echo "selected"?>>本科</option>
			                    <option value="3" <?php if ($edu=="3") echo "selected"?>>硕士</option>
			                    <option value="4" <?php if ($edu=="4") echo "selected"?>>博士</option>
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
	<!-- <script type="text/javascript">
        $(function(){
            if ($("#salary_select").val()!="2") {
                $(".salary_int").attr("readonly",true);
            }
            $("#salary_select").change(function(){
            	if ($(this).val()!="2") {
	                $(".salary_int").attr("readonly",true);
	            }
	            else {
	            	$(".salary_int").attr("readonly",false);
	            }
            });
        });
   </script> -->
  </body>
</html>