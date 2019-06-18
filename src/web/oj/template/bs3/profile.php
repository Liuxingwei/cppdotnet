<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
	if(isset($_SERVER['HTTP_REFERER']))$dir=basename(dirname($_SERVER['HTTP_REFERER']));
	else $dir="";
	if($dir!="") $path_fix="/oj/";
	else $path_fix="oj/";
	require_once("../../include/db_info.inc.php");
	if(isset($OJ_LANG)){
		require_once("../../lang/$OJ_LANG.php");
	}else{
		require_once("../../lang/en.php");
	}
    function checkmail(){
	$mysqli=$GLOBALS['mysqli'];		
		$now=strftime("%Y-%m-%d %X",time()-30*60*60*24);		
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysqli_query($mysqli,$sql);
		if(!$result) return false;
		$row=mysqli_fetch_row($result);
		$cnt=$row[0];
		mysqli_free_result($result);
		//broadcast
		$sql="SELECT `mail_id` FROM `mail` WHERE `to_user`='br' AND `in_date`>'$now'";
		// echo "<script>console.log(\""+$sql+"\")</script>";
		// echo $sql;
		$result=mysqli_query($mysqli, $sql);
		while($row=mysqli_fetch_object($result)){
			$sql="SELECT * FROM `broadcast` WHERE `mail_id`='$row->mail_id' AND `user_id`='".$_SESSION['user_id']."'";
			// echo $sql;
			$tmp_result=mysqli_query($mysqli, $sql);
			if(!mysqli_num_rows($tmp_result))
				$cnt++;
		}
		$retmsg="站内信(".$cnt.")";
		
		return $retmsg;
	}
//	require_once __DIR__ . '/../../include/mysqli.php';
	require_once __DIR__ . '/../../include/distribution.class.php';
	$distribution = new Distribution();
	$profile='';
		if (isset($_SESSION['user_id'])){
				$sid=$_SESSION['user_id'];
				$mail=checkmail();
				if ($mail)
				$profile.= "<li><a href=".$path_fix."mail.php>$mail</a></li>";
                $profile.= "<li class='menu-item-has-children'><a href='#'><span id='profile'>Login</span><span class='caret'></span></a>";
                $profile.= "<ul class='sub-menu' id='profile_drop_out' role='menu'>";
				$profile.= "<li><a href='/home/".$sid."'>我的主页</a></li>";
				$profile.= "<li><a href='".$path_fix."status.php?user=$sid'><span id=red>刷题记录</span></a></li>";
				/*$profile.= "<li><a href='".$path_fix."myvalue.php?user=$sid'><span id=red>我的竞争力</span></a></li>";*/
				$profile.= "<li><a href='".$path_fix."resume.php?user_id=$sid'><span id=red>我的简历</span></a></li>";
				$profile.= "<li><a href='/vipjoin/'><span id=red>VIP学习系统</span></a></li>";
                if ($distribution->checkPermission($_SESSION['user_id'])) {
                    $profile .= "<li><a href='" . $path_fix . "distribution.php?user_id=" . $sid . "'><span id=red>分销统计</span></a></li>";
                }
				$profile.= "<li><a href=".$path_fix."logout.php>$MSG_LOGOUT</a></li>";
                $profile.="</ul></li>";
            }else if(isset($_SESSION['user_cpn'])){
				$profile.= "<li class='menu-item-has-children'><a href='#'><span id='profile_cpn'>Login</span><span class='caret'></span></a>";
				$profile.= "<ul class='sub-menu' id='profile_drop_out' role='menu'>";
				$profile.= "<li><a href=/job/cpn>企业信息</a></li>";
				$profile.= "<li><a href=".$path_fix."job_release.php>发布招聘</a></li>";
				$profile.= "<li><a href=".$path_fix."logout.php>$MSG_LOGOUT</a></li>";
                $profile.="</ul></li>";
			}else{
                if ($OJ_WEIBO_AUTH){
				    $profile.= "<li><a href=".$path_fix."login_weibo.php>$MSG_LOGIN(WEIBO)</a></li>&nbsp;";
                }
                if ($OJ_RR_AUTH){
				    $profile.= "<li><a href=".$path_fix."login_renren.php>$MSG_LOGIN(RENREN)</a></li>&nbsp;";
                }
                if ($OJ_QQ_AUTH){
                    $profile.= "<li><a href=".$path_fix."login_qq.php>$MSG_LOGIN(QQ)</a></li>&nbsp;";
                }
				$profile.= "<li><a href=".$path_fix."loginpage.php>$MSG_LOGIN</a></li>&nbsp;";
				if($OJ_LOGIN_MOD=="dotcpp"){
					$profile.= "<li><a href=".$path_fix."registerpage.php>$MSG_REGISTER</a></li>&nbsp;";
				}
				$profile.= "<li><a href=".$path_fix."loginpage_cpn.php>企业入口</a></li>&nbsp;";
			}
			if (isset($_SESSION['administrator']) || isset($_SESSION['problem_editor']) || isset($_SESSION['lowlevel_admin'])){
           $profile.= "<li><a href=".$path_fix."xktms/>$MSG_ADMIN</a></li>&nbsp;";
			
			}
	 //  $profile.="</ul></li>";
		?>
document.write("<?php echo ( $profile);?>");
<?php if (isset($_SESSION['nick'])) {?>
document.getElementById("profile").innerHTML="<?php echo  isset($_SESSION['nick'])?$_SESSION['nick']:$MSG_LOGIN  ?>";
<?php } ?>
<?php if (isset($_SESSION['user_cpn'])) {?>
document.getElementById("profile_cpn").innerHTML="<?php echo  isset($_SESSION['user_cpn'])?$_SESSION['user_cpn']:$MSG_LOGIN  ?>";
<?php } ?>
