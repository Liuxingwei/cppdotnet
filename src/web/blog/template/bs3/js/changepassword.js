$pswd = $("#npswd");
$pswdxx = $("#npswd_xx");
$pswd.blur(function(){
	if($pswd.val()==""){
		$pswdxx.css("color","#FF6600");
		$pswdxx.html("密码不能为空！");
		fpswd = 1;
	}else if($pswd.val().length<6){
		$pswdxx.css("color","#FF6600");
		$pswdxx.html("密码必须不少于6位！");
		fpswd = 1;
	}else{
		$pswdxx.css("color","#00FFFF");
		$pswdxx.html("密码可用！");
		fpswd = 0;
	}
})

	/*密码确认判断*/
$rpswd = $("#rpswd");
$rpswdxx = $("#rpswd_xx");
$rpswd.blur(function(){
	if($pswd.val()==""){
		$rpswdxx.css("color","#FF6600");
		$rpswdxx.html("确认密码不能为空!");
		frpswd = 1;
	}else if($pswd.val()!=$rpswd.val()){
		$rpswdxx.css("color","#FF6600");
		$rpswdxx.html("两次密码不一致！");
		frpswd = 1;
	}else{
		$rpswdxx.css("color","#00FFFF");
		$rpswdxx.html("密码一致！");
		frpswd = 0;
	}
})