<?php
require_once('./include/db_info.inc.php');
require_once('./include/my_func.inc.php');
// require_once('oj/include/cache_start.php');
$opMysql=$_POST['submit'];
$lastPage="livemgn.php";
if($opMysql=='添加')
{
	$state=$_POST['state'];
	$content=$_POST['content'];
	$teacher=$_POST['teacher'];
	$date=$_POST['date'];
	$url=$_POST['url'];
	
	$sql="alter table liveshow auto_increment=1";
	mysqli_query($mysqli,$sql);
	$sql="insert into liveshow(state,content,teacher,date,url) values('$state','$content','$teacher','$date','$url')";
	if(mysqli_query($mysqli,$sql)){
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("可以的,添加成功！");
			  window.location="'.$lastPage.'";
			  </script>';
	}else{
		//echo "添加失败".mysql_error(); //调试用 
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("添加失败了呢");
			  window.location="'.$lastPage.'";
			  </script>';
	}
}
else if($opMysql=='删除'){
	$id=$_POST['id'];
	$sql="select count(*) from liveshow where id=$id";
	$sqlCheckId=mysqli_query($mysqli,$sql);  //检查该输入id是否存在
	$checkResult=mysqli_fetch_array($sqlCheckId);  //获得返回值，大于0说明存在，否则不存在
	if($checkResult['count(*)']>0)
	{
			$sql="delete from liveshow where id=$id";
			if(mysqli_query($mysqli, $sql))
			{
				mysqli_query($mysqli, "update liveshow set id=id-1 where id>$id");
				echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
				print "<script charset='utf-8' language='javascript'>\n";
				print 'alert("恭喜删除成功！");
			  	window.location="'.$lastPage.'";
			  	</script>';
			}
			else
			{
				//echo "删除失败！！"; //调试用
				echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
				print "<script charset='utf-8' language='javascript'>\n";
				print 'alert("手速太快,导致删除失败了");
			  	window.location="'.$lastPage.'";
			  	</script>';
			}
	}
	else
	{
		//echo "删除失败！！"; //调试用
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("删除失败了,请检查id");
			  window.location="'.$lastPage.'";
			  </script>';
	}
}else if($opMysql=='更改'){
	$id=$_POST['id'];
	$state=$_POST['state'];
	$content=$_POST['content'];
	$teacher=$_POST['teacher'];
	$date=$_POST['date'];
	$url=$_POST['url'];
	$sql="select count(*) from liveshow where id=$id";
	$sqlCheckId=mysqli_query($mysqli, $sql);  //检查该输入id是否存在
	$checkResult=mysqli_fetch_array($sqlCheckId);  //获得返回值，大于0说明存在，否则不存在
	if($checkResult['count(*)']>0)
	{
			$sql="update liveshow set state='$state',content='$content',teacher='$teacher',date='$date',url='$url' where id=$id";
			if(mysqli_query($mysqli, $sql))
			{
				echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
				print "<script charset='utf-8' language='javascript'>\n";
				print 'alert("嗨呀！更改成功！");
			  	window.location="'.$lastPage.'";
			  	</script>';
			}
			else
			{
				//echo "更改失败！！"; //调试用
				echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
				print "<script charset='utf-8' language='javascript'>\n";
				print 'alert("手速太快,更改失败了");
			  	window.location="'.$lastPage.'";
			  	</script>';
			}
	}
	else
	{
		//echo "更改失败！！"; //调试用
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		print "<script charset='utf-8' language='javascript'>\n";
		print 'alert("更改失败了,请检查id");
			  window.location="'.$lastPage.'";
			  </script>';
	}
}
?>