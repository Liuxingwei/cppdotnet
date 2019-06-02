
var fuid = 1;
var fnick = 0;
var fpswd = 1;
var frpswd = 1;
var fschool = 0;
var femail = 0;
var fdrag = 1;
/*用户名判断*/
$uid = $("#user_id");
$uidxx = $("#user_id_xx");
$uid.blur(function(){
	if($uid.val()==""){
		$uidxx.css("color","#FF6600");
		$uidxx.html("用户名不能为空！");
		fuid = 1;
	}else if(!(/^([A-Za-z0-9]+)?$/.test($uid.val()))){
		$uidxx.css("color","#FF6600");
		$uidxx.html("请输入英文或数字！");
		fuid = 1;
	}else if($uid.val().length<3){
		$uidxx.css("color","#FF6600");
		$uidxx.html("用户名太短(用户名在3~15个字符之间)");
		fuid = 1;
	}else if($uid.val().length>15){
		$uidxx.css("color","#FF6600");
		$uidxx.html("用户名太长(用户名在3~15个字符之间)");
		fuid = 1;
	}else{
		$uidxx.html("");
		$.ajax({
			cache:false, type:"post",
			url:"register_user_id.php?user_id="+$uid.val(), 
			async:true, dataType:"html", 
			error:function (request) {
				alert("服务器访问失败，请检查网络连接！");
				fuid = 1;
			}, 
			success:function (data) {
				if(data=="0"){
					$uidxx.css("color","#FF6600");
					$uidxx.html("用户名已存在！");
					fuid = 1;
				}else{
					$uidxx.css("color","#00FFFF");
					$uidxx.html("用户名可用！");
					fuid = 0;
				}
				
			}
		});
	}
})

/*昵称判断*/
$nick = $("#nick");
$nickxx = $("#nick_xx");
$nick.blur(function(){
	if($nick.val().length>0){
		if($nick.val().length>30){
			$nickxx.css("color","#FF6600");
			$nickxx.html("昵称太长(昵称在1~10个字符之间)！");
			fnick = 1;
		}else if(!(/^([A-Za-z0-9\u4e00-\u9fa5]+)?$/.test($nick.val()))){
			$nickxx.css("color","#FF6600");
			$nickxx.html("请输入汉字英文或数字！");
			fnick = 1;
		}else{
			$nickxx.css("color","#00FFFF");
			$nickxx.html("昵称可用！");
			fnick = 0;
		}
	}else{
		$nickxx.html("");
		fnick = 0;
	}
})

/*密码判断*/
$pswd = $("#pswd");
$pswdxx = $("#pswd_xx");
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

	/*学校判断*/
$school = $("#school");
$schoolxx = $("#school_xx");
$school.blur(function(){
	if($school.val().length>0){
		if($school.val().length>20){
			$schoolxx.css("color","#FF6600");
			$schoolxx.html("学校名称限制20字内！");
			fschool = 1;
		}
		else {
			$schoolxx.css("color","#00FFFF");
			$schoolxx.html("学校名可用！");
			fschool = 0;
		}
	}else{ 
		$schoolxx.html("");
		fschool = 0;
	}
})

/*email判断*/
$email = $("#email");
$emailxx = $("#email_xx");
$email.blur(function(){
	if($email.val().length>0){
		var pattern = /^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/;  
	    if (!pattern.test($email.val())) {  
	    	$emailxx.css("color","#FF6600");
	        $emailxx.html("请输入正确的邮箱地址.");
			femail = 1;
	    }else{
	    	$emailxx.css("color","#00FFFF");
			$emailxx.html("email可用！");
			femail = 0;
	    }	
	}else{
		$emailxx.html("");
		femail = 0;
	} 
})

/*验证码判断*/
$("#tijiao").click(function(){
	if(fuid+fnick+fpswd+frpswd+fschool+femail+fdrag == 0){
		$.ajax({
			cache:false, type:"post",
			url:"register_yzm.php?vcode="+$("#vcode").val(), 
			async:true, dataType:"text", 
			error:function (request) {
				alert("服务器访问失败，请重新提交");
				
			}, 
			success:function (data) {
				if(data=="0") {
					alert("验证码错误");
					
					$("#img_vcode").click();
				}
				else $("#form").submit();
			}
		});
	}else{
		alert("请按提示正确填写信息并通过验证！");	
			
	}
});