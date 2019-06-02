 <?php
$OJ_CACHE_SHARE=!isset($_GET['cid']);
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
require_once('./include/const.inc.php');
require_once('./include/setlang.php');
$view_title= "编程比赛_日常作业 - C语言网";

if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

	if (isset($_GET['cid'])){
			$cid=intval($_GET['cid']);
			$view_cid=$cid;
		//	print $cid;
			
			
			// check contest valid
			$sql="SELECT * FROM `contest` WHERE `contest_id`='$cid' ";
			$result=mysqli_query($mysqli,$sql);
			$rows_cnt=mysqli_num_rows($result);
			$contest_ok=true;
		        $password="";	
		        if(isset($_POST['password'])) $password=$_POST['password'];
			if (get_magic_quotes_gpc ()) {
			        $password = stripslashes ( $password);
			}
			if ($rows_cnt==0){
				mysqli_free_result($result);
				$view_title= "比赛已经关闭!";
				
			}else{
				$row=mysqli_fetch_object($result);
				$view_title= $row->title;
				if($password!=""&&$password==$row->password) $_SESSION['c'.$cid]=true;
				if ($row->private && !isset($_SESSION['c'.$cid])) $contest_ok=false;
				if ($row->defunct=='Y') $contest_ok=false;
				if (isset($_SESSION['administrator'])) $contest_ok=true;
				$now=time();
				$start_time=strtotime($row->start_time);
				$end_time=strtotime($row->end_time);
				
				// echo " <script>console.log('now:".$now."')</script> ";
				// echo " <script>console.log('start_time:".$start_time."')</script> ";
				if (!isset($_SESSION['administrator']) && $now<$start_time &&!isset($_SESSION["m$cid"])){
					$view_errors="比赛尚未开始，注意比赛开始时间，到时再来参加吧！";
					require("template/".$OJ_TEMPLATE."/error.php");
					exit(0);
				}
			}
			if (!$contest_ok){
            			 $view_errors=  "这是个私有比赛, 输入密码才能查看. <br><a href=contestrank.php?cid=$cid>$MSG_WATCH_RANK</a>";
            			 $view_errors.=  "<form method=post action='contest$cid.html'>$MSG_CONTEST $MSG_PASSWORD:<input class=input-mini type=password name=password><input class='btn btn-primary' type=submit value='提交'></form>";
				require("template/".$OJ_TEMPLATE."/error.php");
				exit(0);
			}
			$sql="select * from (SELECT `problem`.`title` as `title`,`problem`.`problem_id` as `pid`,source as source,contest_problem.num as pnum

		FROM `contest_problem`,`problem`

		WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` 

		AND `contest_problem`.`contest_id`=$cid ORDER BY `contest_problem`.`num` 
                ) problem
                left join (select problem_id pid1,count(1) accepted from solution where result=4 and contest_id=$cid group by pid1) p1 on problem.pid=p1.pid1
                left join (select problem_id pid2,count(1) submit from solution where contest_id=$cid  group by pid2) p2 on problem.pid=p2.pid2
		order by pnum
                
                ";//AND `problem`.`defunct`='N'

		
			$result=mysqli_query($mysqli,$sql);
			$view_problemset=Array();
			
			$cnt=0;
			while ($row=mysqli_fetch_object($result)){
				
				$view_problemset[$cnt][0]="";
				if (isset($_SESSION['user_id'])) 
					$view_problemset[$cnt][0]=check_ac($cid,$cnt);
				if($now<$end_time)
					$view_problemset[$cnt][1]= $PID[$cnt];
				else
					$view_problemset[$cnt][1]= "$row->pid Problem &nbsp;".$PID[$cnt];
				$view_problemset[$cnt][2]= "<a href='contest".$cid."_problem".$cnt.".html'>$row->title</a>";
				$view_problemset[$cnt][3]=$row->source ;
				$view_problemset[$cnt][4]=$row->accepted ;
				$view_problemset[$cnt][5]=$row->submit ;
				$cnt++;
			}
		
			mysqli_free_result($result);

}else{
  $keyword="";
  if(isset($_POST['keyword'])){
      $keyword=mysqli_real_escape_string($mysqli,$_POST['keyword']);
  }
  //echo "$keyword";
  $sql="SELECT * FROM `contest` WHERE `defunct`='N' ORDER BY `contest_id` DESC limit 1000";
  $sql="select *  from contest left join (select * from privilege where rightstr like 'm%') p on concat('m',contest_id)=rightstr where contest.defunct='N' and contest.title like '%$keyword%'  order by contest_id desc limit 1000;";
			$result=mysqli_query($mysqli,$sql);
			
			$view_contest=Array();
			$i=0;
			while ($row=mysqli_fetch_object($result)){
				
				$view_contest[$i][0]= $row->contest_id;
				$view_contest[$i][1]= "<a href='contest$row->contest_id.html'>$row->title</a>";
				$start_time=strtotime($row->start_time);
				$end_time=strtotime($row->end_time);
				$now=time();
				$contest_date=date("Y-m-d",$start_time);
				$order_time=strtotime($contest_date)-25200;
                                
                                
		        $length=$end_time-$start_time;
		        $left=$end_time-$now;
				// past

			  if ($now>$end_time) {
			  	$view_contest[$i][2]= "<span style='color:green'>$MSG_Ended@$row->end_time</span>";
				
				// pending

			  }else if ($now<$start_time){
			  	$view_contest[$i][2]= "<span style='color:blue'>$MSG_Start@$row->start_time</span>&nbsp;";
			    $view_contest[$i][2].= "<span style='color:green'>$MSG_TotalTime".formatTimeLength($length)."</span>";
				// running

			  }else{
			  	$view_contest[$i][2]= "<span style='color:red'> $MSG_Running</font>&nbsp;";
			    $view_contest[$i][2].= "<span style='color:green'> $MSG_LeftTime ".formatTimeLength($left)." </span>";
			  }
				
			  	//order
			  	// if(isset($_SESSION['user_id'])) {
			  		if ($now>$end_time) {
			  			$view_contest[$i][3]= "";
			  		}
			  		else if ($now<$order_time) {
			  			if (isset($_SESSION['user_id'])) {
			  				$user_id_order=$_SESSION['user_id'];
			  				$sql_order="SELECT * FROM `users` WHERE `user_id`='".$user_id_order."' AND find_in_set('".$row->contest_id."',order_contest)";
							$result_order=mysqli_query($mysqli, $sql_order);
							if (mysqli_num_rows($result_order) !==0) {
								$view_contest[$i][3]= "<span style='color:blue'>已预约</span>";
							}
							else {
								$view_contest[$i][3]= "<span style='color:blue'><a href='info_check.php?contest_id=".$row->contest_id."'>可预约</a></span>";
							}
			  			}
			  			else {
			  				$view_contest[$i][3]= "<span style='color:blue'><a href='info_check.php?contest_id=".$row->contest_id."'>可预约</a></span>";
			  			}
			  			
			  		}
			  		else {
			  			$view_contest[$i][3]= "<span style='color:red'>预约已关闭</span>";
			  		}
			  		
			  	//}
			  	/*else {
			  		$view_contest[$i][3]= "";
			  	}*/


				$private=intval($row->private);
				if ($private==0)
	               $view_contest[$i][4]= "<span style='color:blue'>$MSG_Public</span>";
	            else
	                $view_contest[$i][5]= "<span style='color:red'>$MSG_Private</span>";
				$view_contest[$i][6]=getNickById($row->user_id);


		
				$i++;
			}
			
			mysqli_free_result($result);

}


/////////////////////////Template
if(isset($_GET['cid']))
	require("template/".$OJ_TEMPLATE."/contest.php");
else
	require("template/".$OJ_TEMPLATE."/contestset.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
