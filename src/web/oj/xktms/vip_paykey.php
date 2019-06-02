<?php
require_once("admin-header.php");

require_once("../include/my_func.inc.php");
require_once("../lang/cn.php");

if (isset($_POST['count'])) {

	$type=$_POST['type'];
	$count=$_POST['count'];
	$end_day=$_POST['end_day'];
	$amount=$_POST['amount'];

	switch ($type) {
            case 'c':
                $class_type="C语言VIP课程";
                break;
            case 'cpp':
                $class_type="C++VIP课程";
                break;
            case 'suanfa':
                $class_type="算法VIP课程";
                break;
            default:
                # code...
                break;
        }
	if ($count>1000) {
		echo "<meta http-equiv='Content-Type' content='text/html'; charset='utf-8'>";
		echo "<script charset='utf-8' language='javascript'>\n";
		echo "alert('数量超限!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	}


	$end_time=date('Y-m-d H:i:s',(time()+$end_day*(60*60*24)));
	$create_time=date('Y-m-d',time());

	$array_key=array();

	for ($i=0; $i < $count; $i++) {
	    usleep(10);
	    $t = explode(' ',microtime());
	    $paykey = substr(base_convert(strtr($t[0].$t[1].$t[1],'.',''),10,36),0,18);
	    $array_key[] = $paykey;
		
	}

	$array_key = array_unique($array_key);
	$count_key = count($array_key);

	$sql="INSERT INTO `vip_paykey`(`paykey`,`end_time`,`status`,`type`,`amount`,`create_time`) VALUES";
	$douhao="";
	for ($i=0; $i < $count_key; $i++) { 
		$sql.=$douhao."('".$array_key[$i]."','".$end_time."',1,'".$type."','".$amount."','".$create_time."')";
		$douhao=",";
	}
	mysqli_query($mysqli,$sql);
	
	$keyfile = fopen("keyfile.txt", "w") or die("Unable to open file!");
	$txt = "key到期时间：".$end_time."\n";
	$txt .= "VIP类型：".$class_type.$amount."个月\n";
	for ($i=0; $i < $count_key; $i++) { 
		$txt .= $array_key[$i]."\n";
	}
	fwrite($keyfile, $txt);

	header("location:keyfile.txt");
}
?>

<form style="width: 80%;" method="post" action="#">
	<div class="form-group">
		<label for="" class="col-lg-2 control-label">充值码课程类型：</label>
	    <select name="type" class="form-control">
			<option value="c" selected="selected">C语言</option>
			<option value="cpp">C++</option>
			<option value="suanfa">算法课程</option>
		</select>
	</div>
	<div class="form-group">
		<label for="" class="col-lg-2 control-label">生成充值码数量：</label>
		<div class="col-lg-5"><input type="text" name="count" class="form-control"></div>
    </div>
    <div class="form-group">
		<label for="" class="col-lg-2 control-label">key有效时间/天：</label>
		<div class="col-lg-5"><input type="text" name="end_day" class="form-control"></div>
    </div>
    <div class="form-group">
		<label for="" class="col-lg-2 control-label">VIP有效时间/月：</label>
		<div class="col-lg-5"><input type="text" name="amount" class="form-control"></div>
    </div>
    <div class="form-group">
		<button class="btn btn-primary col-lg-offset-6 light_blue" type="submit">确认</button>
    </div>
</form>

<?php
require("../oj-footer.php");
?>