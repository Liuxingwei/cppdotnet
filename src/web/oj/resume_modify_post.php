<?php 
require_once("./include/db_info.inc.php");
require_once("./include/my_func.inc.php");
require_once("./lang/cn.php");

if(!isset($_SESSION['user_id'])){
    $view_errors="请<a href=loginpage.php>登录</a>后再添加简历信息!";
    require("template/".$OJ_TEMPLATE."/error.php");
    exit(0);
}

$user_id=$_SESSION['user_id'];
$err_str="";
$err_cnt=0;
$len;
$name=trim($_POST['name']);
$age=trim($_POST['age']);
$sex=trim($_POST['sex']);
$birth=trim($_POST['birth']);
$address=trim($_POST['address']);
$email=trim($_POST['email']);
$phone=trim($_POST['phone']);
$school=trim($_POST['school']);
$edu=trim($_POST['edu']);
$gra=trim($_POST['gra']);
$prize=$_POST['prize'];
$skill=$_POST['skill'];
$lang=$_POST['lang'];
$jobs=$_POST['jobs'];
$descrp=$_POST['descrp'];

$vcode=trim($_POST['vcode']);
if($OJ_VCODE&&($vcode!= $_SESSION["vcode"]||$vcode==""||$vcode==null) ){
	$_SESSION["vcode"]=null;
	$err_str=$err_str."验证码错误!\\n";
	$err_cnt++;
}
if ($err_cnt>0){
	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	print "<script charset='utf-8' language='javascript'>\n";
	print "alert('";
	print $err_str;
	print "');\n history.go(-1);\n</script>";
	exit(0);
}

/*//判断文件上传是否出错
if($_FILES["file"]["error"])
{
    echo $_FILES["file"]["error"];
}
else
{
    //控制上传文件的类型，大小
    if($_FILES["file"]["size"]<512000)
    {
        //找到文件存放的位置
        $filename = "./oj/upload_photo/".date("YmdHis").$_FILES["file"]["name"];
         
        //转换编码格式
        $filename = iconv("UTF-8","gb2312",$filename);
         
        //判断文件是否存在
        if(file_exists($filename))
        {
            echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
			echo "<script charset='utf-8' >alert('文件已存在!')</script>";
			echo "<script charset='utf-8' language='javascript'>\n";
			echo "history.go(-2);\n";
			echo "</script>";
			exit(0);
        }
        else
        {
            //保存文件
            move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
        }
    }
    else
    {
        echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' >alert('图片大小超限或格式错误!')</script>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
		exit(0);
    }
}*/
$filename="";
$sql="SELECT `user_id` FROM `resume` WHERE `user_id`='$user_id'";
$result=mysqli_query($mysqli,$sql);
$rows_cnt=mysqli_num_rows($result);
mysqli_free_result($result);
if ($rows_cnt<1) {
	$sql="INSERT INTO `resume`("
	."`user_id`,`name`,`age`,`sex`,`birth`,`address`,`email`,`phone`,`school`,`edu`,`gra`,`prize`,`skill`,`lang`,`jobs`,`descrp`,`photo`)"
	."VALUES('".$user_id."','".$name."','".$age."','".$sex."','".$birth."','".$address."','".$email."','".$phone."','".$school."','".$edu."','".$gra."','".$prize."','".$skill."','".$lang."','".$jobs."','".$descrp."','".$filename."')";
	mysqli_query($mysqli,$sql);// or die("Insert Error!\n");.
}
else {
	$sql="UPDATE `resume` SET"
		."`name`='".$name."',"
		."`age`='".$age."',"
		."`sex`='".$sex."',"
		."`birth`='".$birth."',"
		."`address`='".$address."',"
		."`email`='".$email."',"
		."`phone`='".$phone."',"
		."`school`='".$school."',"
		."`edu`='".$edu."',"
		."`gra`='".$gra."',"
		."`prize`='".$prize."',"
		."`skill`='".$skill."',"
		."`lang`='".$lang."',"
		."`jobs`='".$jobs."',"
		."`descrp`='".$descrp."',"
		."`photo`='".$filename."'"
		."WHERE `user_id`='".$user_id."'";
	mysqli_query($mysqli,$sql); // or die("Insert Error!\n");
}

	echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
	echo "<script charset='utf-8' >alert('编辑成功!')</script>";
	echo "<script charset='utf-8' language='javascript'>\n";
	echo "history.go(-2);\n";
	echo "</script>";

?>