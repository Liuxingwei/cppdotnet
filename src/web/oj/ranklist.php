<?php
$OJ_CACHE_SHARE=false;
$cache_time=30;
require_once('./include/cache_start.php');
require_once('./include/db_info.inc.php');
require_once('./include/setlang.php');

/*//静态化
if (isset($_GET['start'])) {
  $str_start="_start".intval($_GET['start']);
}
else {
  $str_start="";
}

$statis_file = "../staticfiles/paiming".$str_start.".html";//对应静态页文件

require_once('include/cache-static_start.php');

//*/

$view_title= "排行榜 - C语言网";

if(!isset($_SESSION['user_id']))if(isset($_SESSION['prev_page']))unset($_SESSION['prev_page']);

$scope="";
if(isset($_GET['scope']))
        $scope=$_GET['scope'];
if($scope!=""&&$scope!='d'&&$scope!='w'&&$scope!='m')
        $scope='y';

$rank = 0;
if(isset( $_GET ['start'] ))
$rank = intval ( $_GET ['start'] );
$current_page=$rank/50 +1;
if(isset($OJ_LANG)){
        require_once("./lang/$OJ_LANG.php");
}
$page_size=50;
//$rank = intval ( $_GET ['start'] );
if ($rank < 0)
    $rank = 0;

$sql = "SELECT `user_id`,`nick`,`user_sign`,/*`solved`,`submit`,*/`user_exp`,`user_lvl` FROM `users` ORDER BY `user_exp` DESC,`solved` DESC,submit,reg_time  LIMIT  " . strval ( $rank ) . ",$page_size";

if($scope){
        $s="";
        switch ($scope){
                case 'd':
                        $s=date('Y').'-'.date('m').'-'.date('d');
                        break;
                case 'w':
                        $monday=mktime(0, 0, 0, date("m"),date("d")-(date("w")+7)%8+1, date("Y"))                                                            ;
                        //$monday->subDays(date('w'));
                        $s=strftime("%Y-%m-%d",$monday);
                        break;
                case 'm':
                        $s=date('Y').'-'.date('m').'-01';
                        ;break;
                default :
                        $s=date('Y').'-01-01';
        }
        //echo $s."<-------------------------";
        $sql="SELECT users.`user_id`,`nick`,`user_sign`,/*s.`solved`,t.`submit`,*/`user_exp`,`user_lvl` FROM `users`
                        right join
                        (select count(distinct problem_id) solved ,user_id from solution where in_date>str_to_date('$s','%Y-%m-%d') and result=4 group by user_id order by user_exp desc,solved desc limit " . strval ( $rank ) . ",$page_size) s on users.user_id=s.user_id
                        left join
                        (select count( problem_id) submit ,user_id from solution where in_date>str_to_date('$s','%Y-%m-%d') group by user_id order by submit desc limit " . strval ( $rank ) . ",".($page_size*2).") t on users.user_id=t.user_id
                ORDER BY s.`solved` DESC,t.submit,reg_time  LIMIT  0,50
         ";
//                      echo $sql;
}

if(isset($_GET['user_id']) && $_GET['user_id']!=""){
   $user_id=mysqli_real_escape_string($mysqli,trim($_GET['user_id']));
   $sql = "SELECT `user_id`,`nick`,`user_sign`,/*`solved`,`submit`,*/`user_exp`,`user_lvl` FROM `users` WHERE `user_id` LIKE '%".$user_id."%' OR `user_id` IN (SELECT `user_id` FROM `users` WHERE `nick` LIKE '%".$user_id."%' ) ORDER BY `user_exp` DESC,`solved` DESC,submit,reg_time  LIMIT  " . strval ( $rank ) . ",$page_size";
}
//         $result = mysql_query ( $sql ); //mysqli_error();
if($OJ_MEMCACHE){
        require("./include/memcache.php");
        $result = mysql_query_cache($sql) ;//or die("Error! ".mysqli_error());
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}else{

        $result = mysqli_query($mysqli,$sql) or die("Error! ".mysqli_error());
        if($result) $rows_cnt=mysqli_num_rows($result);
        else $rows_cnt=0;
}
$view_rank=Array();
$i=0;
for ( $i=0;$i<$rows_cnt;$i++ ) {
        if($OJ_MEMCACHE)
                $row=$result[$i];
        else
                $row=mysqli_fetch_array($result);
        $rank ++;

        /*//blog_cnt
        $sql="SELECT count(blog_id) as cnt_blog FROM `blog` WHERE `user_id`='".$row['user_id']."' AND `status`=1";
        $result_blog=mysqli_query($mysqli,$sql) or die(mysqli_error());
        while ($arr_blog=mysqli_fetch_array($result_blog)) {
            $cnt_blog=$arr_blog['cnt_blog'];
        }
        mysqli_free_result($result_blog);
        //contest
        $sql="SELECT count(DISTINCT contest_id) as cnt_contest FROM `solution` WHERE `user_id`='".$row['user_id']."'";
        $result_contest=mysqli_query($mysqli,$sql) or die(mysqli_error());
        while ($arr_contest=mysqli_fetch_array($result_contest)) {
            $cnt_contest=$arr_contest['cnt_contest'];
        }
        mysqli_free_result($result_contest);*/

        

        $user_lvl = $row['user_lvl'];
        $tag_class = "tag_p".$user_lvl;
        $tr_class = "tr_p".$user_lvl;

        $view_rank[$i][0]=  $rank;
        $view_rank[$i][1]=  "<div style='text-align: left;'><a href='userinfo.php?user=" . $row['user_id'] . "'><button type='button' class='btn tag_lvl ".$tag_class." btn-xs'>P".$user_lvl."</button> ".htmlentities ( $row['nick'] ,ENT_QUOTES,"UTF-8")."</a>" ."</div>";
        $view_rank[$i][2]=  "<div class=center>" . htmlentities ( $row['user_sign'] ,ENT_QUOTES,"UTF-8") ."</div>";
        $view_rank[$i][3]=  "<div class=center>". $row['user_exp'] ."</div>";
        /*$view_rank[$i][3]=  "<div class=center><a href='status.php?user_id=".$row['user_id']."&jresult=4'>". $row['solved'] . "</a>" ."</div>";
        $view_rank[$i][4]=  "<div class=center><a href='status.php?user_id=".$row['user_id']."'>". $row['submit'] ."</a>"."</div>";
        $view_rank[$i][5]=  "<div class=center>". $cnt_contest ."</div>";
        $view_rank[$i][6]=  "<div class=center>". $cnt_blog ."</div>";*/

        /*if ($row['submit'] == 0)
                $view_rank[$i][5]= "0.000%";
        else
                $view_rank[$i][5]= sprintf ( "%.03lf%%", 100 * $row['solved'] / $row['submit'] );*/

//                      $i++;
}

if(!$OJ_MEMCACHE)mysqli_free_result($result);

if(isset($_GET['user_id']) && $_GET['user_id']!=""){
    $sql = "SELECT count(1) as `mycount` FROM `users` WHERE `user_id` LIKE '%".$user_id."%' OR `user_id` IN (SELECT `user_id` FROM `users` WHERE `nick` LIKE '%".$user_id."%' )";
    $userid_page="&user_id=".$user_id;
}
else {
    $sql = "SELECT count(1) as `mycount` FROM `users`";
    $userid_page="";
}
//        $result = mysql_query ( $sql );
if($OJ_MEMCACHE){
  // require("./include/memcache.php");
        $result = mysql_query_cache($sql);// or die("Error! ".mysqli_error());
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}else{

        $result = mysqli_query($mysqli,$sql);// or die("Error! ".mysqli_error());
        if($result) $rows_cnt=mysqli_num_rows($result);
        else $rows_cnt=0;
}
if($OJ_MEMCACHE)
        $row=$result[0];
else
        $row=mysqli_fetch_array($result);
        echo mysqli_error($mysqli);
//$row = mysql_fetch_object ( $result );
        $view_total=$row['mycount'];

//              mysql_free_result ( $result );

if(!$OJ_MEMCACHE)  mysqli_free_result($result);



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

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/ranklist.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');

/*//静态化
  require_once('include/cache-static_end.php');
//*/

?>
