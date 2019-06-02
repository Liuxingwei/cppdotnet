<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

////////////////////////////Common head
$cache_time=2;
$OJ_CACHE_SHARE=false;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');
$view_title= "训练场状态_在线评测动态 - C语言网";
	
if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);
        
require_once("./include/my_func.inc.php");
if(isset($OJ_LANG)){
    require_once("./lang/$OJ_LANG.php");
}
require_once("./include/const.inc.php");

if($OJ_TEMPLATE!="classic") 
	$judge_color=Array("btn gray","btn btn-sm btn-info","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-success","btn btn-sm btn-danger","btn btn-sm btn-danger","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-warning","btn btn-sm btn-info");

$str2="";
$lock=false;
$lock_time=date("Y-m-d H:i:s",time());
$sql="SELECT * FROM `solution` WHERE problem_id>0 ";
if (isset($_GET['cid'])){
        $cid=intval($_GET['cid']);
        $sql=$sql." AND `contest_id`='$cid' and num>=0 ";
        $str2=$str2."&cid=$cid";
        $sql_lock="SELECT `start_time`,`title`,`end_time` FROM `contest` WHERE `contest_id`='$cid'";
        $result=mysqli_query($mysqli,$sql_lock) or die(mysqli_error($mysqli));
        $rows_cnt=mysqli_num_rows($result);
        $start_time=0;
        $end_time=0;
        if ($rows_cnt>0){
                $row=mysqli_fetch_array($result);
                $start_time=strtotime($row[0]);
                $title=$row[1];
                $end_time=strtotime($row[2]);       
        }
        $lock_time=$end_time-($end_time-$start_time)*$OJ_RANK_LOCK_PERCENT;
  //$lock_time=date("Y-m-d H:i:s",$lock_time);
        $time_sql="";
        //echo $lock.'-'.date("Y-m-d H:i:s",$lock);
        if(time()>$lock_time&&time()<$end_time){
          //$lock_time=date("Y-m-d H:i:s",$lock_time);
          //echo $time_sql;
           $lock=true;
        }else{
           $lock=false;
        }
        
        //require_once("contest-header.php");
}else{
        //require_once("oj-header.php");
  if(isset($_SESSION['administrator'])
	||isset($_SESSION['source_browser'])
	||(isset($_SESSION['user_id'])
	&&(isset($_GET['user_id'])&&$_GET['user_id']==$_SESSION['user_id']))
  ){
      if ($_SESSION['user_id']!="guest")
      		$sql="SELECT * FROM `solution` WHERE contest_id is null ";
  }else{
      $sql="SELECT * FROM `solution` WHERE problem_id>0 and contest_id is null ";
  }
}
$start_first=true;
$order_str=" ORDER BY `solution_id` DESC ";



// check the top arg
if (isset($_GET['top'])){
        $top=strval(intval($_GET['top']));
        if ($top!=-1) $sql=$sql."AND `solution_id`<='".$top."' ";
}

// check the problem arg
$problem_id="";
if (isset($_GET['problem_id'])&&$_GET['problem_id']!=""){
	
	if(isset($_GET['cid'])){
		$problem_id=htmlentities($_GET['problem_id'],ENT_QUOTES,'UTF-8');
		$num=strpos($PID,$problem_id);
		$sql=$sql."AND `num`='".$num."' ";
        $str2=$str2."&problem_id=".$problem_id;
        
	}else{
        $problem_id=strval(intval($_GET['problem_id']));
        if ($problem_id!='0'){
                $sql=$sql."AND `problem_id`='".$problem_id."' ";
                $str2=$str2."&problem_id=".$problem_id;
        }
        else $problem_id="";
	}
}
// check the user_id arg
$user_id="";

if (isset($_GET['user'])) {
    $user=htmlentities($_GET['user'],ENT_QUOTES,'UTF-8');
    if ($user!=""){
        $sql=$sql."AND (`user_id` = '".$user."')";
        if ($str2!="") {
            $str2=$str2."&";
        }
        $str2=$str2."user=".$user;
    }
}
else {
    if (isset($_GET['user_id'])){
            $user_id=htmlentities($_GET['user_id'],ENT_QUOTES,'UTF-8');
            if ($user_id!=""){
                    // $sql=$sql."AND (`user_id` LIKE '".$user_id."'  OR `nick` LIKE '".$user_id."') ";
                    $sql=$sql."AND (`user_id` LIKE '%".$user_id."%' OR `user_id` IN (SELECT `user_id` FROM users WHERE nick LIKE '%".$user_id."%'))";
                    if ($str2!="") $str2=$str2."&";
                    $str2=$str2."user_id=".$user_id;
            }else $user_id="";
    }
}
if (isset($_GET['language'])) $language=intval($_GET['language']);
else $language=-1;

if ($language>count($language_ext) || $language<0) $language=-1;
if ($language!=-1){
        $sql=$sql."AND `language`='".strval($language)."' ";
        $str2=$str2."&language=".$language;
}
if (isset($_GET['jresult'])) $result=intval($_GET['jresult']);
else $result=-1;

if ($result>12 || $result<0) $result=-1;
if ($result!=-1&&!$lock){
        $sql=$sql."AND `result`='".strval($result)."' ";
        $str2=$str2."&jresult=".$result;
}



/*if($OJ_SIM){
        $old=$sql;
        $sql="select * from ($sql order by solution_id desc limit 1000) solution left join `sim` on solution.solution_id=sim.s_id WHERE 1 ";
        if(isset($_GET['showsim'])&&intval($_GET['showsim'])>0){
                $showsim=intval($_GET['showsim']);
                $sql="select * from ($old ) solution 
                     left join `sim` on solution.solution_id=sim.s_id WHERE result=4 and sim>=$showsim limit 1000";
                $sql="SELECT * FROM ($sql) `solution`
                        left join(select solution_id old_s_id,user_id old_user_id from solution limit 1000) old
                        on old.old_s_id=sim_s_id WHERE  old_user_id!=user_id and sim_s_id!=solution_id ";
                $str2.="&showsim=$showsim";
        }
        //$sql=$sql.$order_str." LIMIT 20";
}*/






$sql=$sql.$order_str." LIMIT 20";
// echo " <script>console.log(\"".$sql."\")</script> ";



if($OJ_MEMCACHE){
	require("./include/memcache.php");
	$result = mysql_query_cache($sql);// or die("Error! ".mysqli_error());
	if($result) $rows_cnt=count($result);
	else $rows_cnt=0;
}else{
		
	$result = mysqli_query($mysqli,$sql);// or die("Error! ".mysqli_error());
	if($result) $rows_cnt=mysqli_num_rows($result);
	else $rows_cnt=0;
}
$top=$bottom=-1;
$cnt=0;
if ($start_first){
        $row_start=0;
        $row_add=1;
}else{
        $row_start=$rows_cnt-1;
        $row_add=-1;
}

$view_status=Array();

$last=0;
for ($i=0;$i<$rows_cnt;$i++){
if($OJ_MEMCACHE)
        $row=$result[$i];
else
        $row=mysqli_fetch_array($result);
        //$view_status[$i]=$row;
        if($i==0&&$row['result']<4) $last=$row['solution_id'];

	
		if ($top==-1) $top=$row['solution_id'];
        $bottom=$row['solution_id'];
		$flag=(!is_running(intval($row['contest_id']))) ||
                        isset($_SESSION['source_browser']) ||
                        isset($_SESSION['administrator']) || 
                        (isset($_SESSION['user_id'])&&!strcmp($row['user_id'],$_SESSION['user_id']));

        $cnt=1-$cnt;
	

        $view_status[$i][0]=$row['solution_id'];
       
        if ($row['contest_id']>0) {
                $view_status[$i][1]= "<a href='contestrank.php?cid=".$row['contest_id']."&user_id=".$row['user_id']."#".$row['user_id']."'>".getNickByid($row['user_id'])."</a>";
        }else{
                $view_status[$i][1]= "<a href='userinfo.php?user=".$row['user_id']."'>".getNickByid($row['user_id'])."</a>";
        }

       if ($row['contest_id']>0) {
                $view_status[$i][2]= "<div class=center><a href='contest".$row['contest_id']."_problem".$row['num'].".html'>";
                if(isset($cid)){
                        $view_status[$i][2].= $PID[$row['num']];
                }else{
                        $view_status[$i][2].= $row['problem_id'];
                }
				$view_status[$i][2].="</div></a>";
        }else{
                $view_status[$i][2]= "<div class=center><a href='problem".$row['problem_id'].".html'>".$row['problem_id']."</a></div>";
        }

    switch($row['result']){
        case 4:
            $MSG_Tips=$MSG_HELP_AC;break;
        case 5:
            $MSG_Tips=$MSG_HELP_PE;break;
        case 6:
            $MSG_Tips=$MSG_HELP_WA;break;
        case 7:
            $MSG_Tips=$MSG_HELP_TLE;break;
        case 8:
            $MSG_Tips=$MSG_HELP_MLE;break;
        case 9:
            $MSG_Tips=$MSG_HELP_OLE;break;
        case 10:
            $MSG_Tips=$MSG_HELP_RE;break;
        case 11:
            $MSG_Tips=$MSG_HELP_CE;break;
        default: $MSG_Tips="";

    }
       
	$view_status[$i][3]="";
        if (intval($row['result'])==11 && ((isset($_SESSION['user_id'])&&$row['user_id']==$_SESSION['user_id']) || isset($_SESSION['source_browser']))){
                $view_status[$i][3].= "<a href='ceinfo.php?sid=".$row['solution_id']."' class='".$judge_color[$row['result']]."'  title='$MSG_Tips'>".$MSG_Compile_Error."";

                if ($row['result']!=4&&isset($row['pass_rate'])&&$row['pass_rate']>0&&$row['pass_rate']<.98)
                                $view_status[$i][3].= (100-$row['pass_rate']*100)."%</a>";
                else
                    $view_status[$i][3].="</a>";

        }else if ((((intval($row['result'])==5||intval($row['result'])==6)&&$OJ_SHOW_DIFF)||$row['result']==10||$row['result']==13) && ((isset($_SESSION['user_id'])&&$row['user_id']==$_SESSION['user_id']) || isset($_SESSION['source_browser']))){
                $view_status[$i][3].= "<a href='reinfo.php?sid=".$row['solution_id']."' class='".$judge_color[$row['result']]."' title='$MSG_Tips'>".$judge_result[$row['result']]."";

                if ($row['result']!=4&&isset($row['pass_rate'])&&$row['pass_rate']>0&&$row['pass_rate']<.98)
                                $view_status[$i][3].= (100-$row['pass_rate']*100)."%</a>";
                else
                    $view_status[$i][3].="</a>";

        }else{
              if(!$lock||$lock_time>$row['in_date']||$row['user_id']==$_SESSION['user_id']){
                /*if($OJ_SIM&&$row['sim']>80&&$row['sim_s_id']!=$row['s_id']) {
                        $view_status[$i][3].= "<span class='".$judge_color[$row['result']]."' title='$MSG_Tips'>*".$judge_result[$row['result']]."";

                        if ($row['result']!=4&&isset($row['pass_rate'])&&$row['pass_rate']>0&&$row['pass_rate']<.98)
                                $view_status[$i][3].= (100-$row['pass_rate']*100)."%</span>";
                        else
                            $view_status[$i][3].="</span>";

                        if( isset($_SESSION['source_browser'])){

                                        $view_status[$i][3].= "<a href=comparesource.php?left=".$row['sim_s_id']."&right=".$row['solution_id']."  class='btn btn-sm btn-info'  target=original>".$row['sim_s_id']."(".$row['sim']."%)</a>";
                        }else{

                                        $view_status[$i][3].= "<span class='btn btn-sm btn-info'>".$row['sim_s_id']."</span>";

                        }
                        if(isset($_GET['showsim'])&&isset($row[13])){
                                        $view_status[$i][3].= "$row[13]";

                        }
                }else{*/

                        $view_status[$i][3]= "<span class='".$judge_color[$row['result']]."' title='$MSG_Tips'>".$judge_result[$row['result']]."";
                        if ($row['result']!=4&&isset($row['pass_rate'])&&$row['pass_rate']>0&&$row['pass_rate']<.98)
                                $view_status[$i][3].= (100-$row['pass_rate']*100)."%</span>";
                        else
                            $view_status[$i][3].="</span>";
                /*}*/
          }else{
              echo "<td>----";
          }

        }

        if(isset($_SESSION['http_judge'])) {
		 $view_status[$i][3].="<form class='http_judge_form form-inline' >
					<input type=hidden name=sid value='".$row['solution_id']."'>";
                 $view_status[$i][3].="</form>";
        }
	            

       
       
        if ($flag){


                if ($row['result']>=4){
                        $view_status[$i][4]= "<div id=center class=red>".$row['memory']."</div>";
                        $view_status[$i][5]= "<div id=center class=red>".$row['time']."</div>";
						//echo "=========".$row['memory']."========";
                }else{
                        $view_status[$i][4]= "---";
                        $view_status[$i][5]= "---";
						
                }
				//echo $row['result'];
                if (!(isset($_SESSION['user_id'])&&strtolower($row['user_id'])==strtolower($_SESSION['user_id']) || isset($_SESSION['source_browser']))){
                        $view_status[$i][6]=$language_name[$row['language']];
                }else{

                        
			if($row["problem_id"]>0){
                        	if (isset($cid)) {
                                	$view_status[$i][6]= "<a target=_self href=\"contest".$cid."_problem".$row['num'].".html?sid=".$row['solution_id']."&lang=".$row['language']."#editor"."\">".$language_name[$row['language']]."</a>";
                        	}else{
                                	$view_status[$i][6]= "<a target=_self href=\"problem".$row['problem_id'].".html?sid=".$row['solution_id']."&lang=".$row['language']."#editor"."\">".$language_name[$row['language']]."</a>";
                        	}
			}
            else {
                $view_status[$i][6]=$language_name[$row['language']];
            }
                }
                if (!(isset($_SESSION['user_id'])&&strtolower($row['user_id'])==strtolower($_SESSION['user_id']) || isset($_SESSION['source_browser']))){
                    $view_status[$i][7]= $row['code_length']." B";
                }
                else {
                    $view_status[$i][7]= "<a target=_blank href=showsource.php?id=".$row['solution_id'].">".$row['code_length']." B</a>";
                }
				
        }else
		{
			$view_status[$i][4]="----";
			$view_status[$i][5]="----";
			$view_status[$i][6]="----";
			$view_status[$i][7]="----";
		}
        $view_status[$i][8]= "<div class='text-center'>".$row['in_date']."</div>";
        switch ($row['judger']) {
            case 'judger_main':
                $row['judger']="judger1";
                break;
            case 'judger110':
                $row['judger']="judger2";
                break;
            default:
                # code...
                break;
        }
        if (!isset($_GET['class']) && !isset($_GET['cid'])) {
            $view_status[$i][9]= $row['judger'];
        }
        
   
   

}
if(!$OJ_MEMCACHE && $result)mysqli_free_result($result);






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

<?php
/////////////////////////Template
if (isset($_GET['cid'])) {
	require("template/".$OJ_TEMPLATE."/conteststatus.php");
}
else {
    //VIP课程部分脚本start
    if (isset($_GET['class'])) {
        $class=$_GET['class'];
        $subject_vip=$_GET['subject'];
        $id=$_GET['id'];
        //所属章节
        $sql="SELECT `section` FROM `vipclass` WHERE `class_id`='$class'";
        $result=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_object($result);
        $section=$row->section;

        switch ($subject_vip) {
            case 'c':
                $sql="SELECT `vip_end` FROM `users` WHERE `user_id`='$user_id'";
                $section_mark=100;
                $lock_id_first=1000;
                $text_subject="C语言课程";
                break;
            case 'cpp':
                $sql="SELECT `vip_end_cpp` FROM `users` WHERE `user_id`='$user_id'";
                $section_mark=200;
                $lock_id_first=2000;
                $text_subject="C++课程";
                break;
            case 'suanfa':
                $sql="SELECT `vip_end_suanfa` FROM `users` WHERE `user_id`='$user_id'";
                $section_mark=300;
                $lock_id_first=3000;
                $text_subject="算法课程";
                break;
        }
        $result=mysqli_query($mysqli,$sql);
        $row=mysqli_fetch_array($result);
        $vip_end=strtotime($row[0]);
        $vip_end_date=date("Y-m-d",$vip_end);
        //全部课程
        require("inc_vip_".$subject_vip."_var.php");

        require("template/".$OJ_TEMPLATE."/vipstatus.php");
    }
    //VIP课程部分脚本end
    else {
        require("template/".$OJ_TEMPLATE."/status.php");
    }
}
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

