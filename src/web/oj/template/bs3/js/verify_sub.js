
var fcpn = 0;
var femail = 0;
var fpswd = 1;
var frpswd = 1;
var fadd = 1;
var fphone = 1;
var findst = 1;
/*var fstage = 1;
var fsize = 1;*/

/*公司名称判断*/
$cpn = $("#compname");
$cpnxx = $("#compname_xx");
$cpn.blur(function(){
	if($cpn.val()==""){
		$cpnxx.css("color","#FF6600");
		$cpnxx.html("公司名称不能为空！");
		fcpn = 1;
	}else if(!(/^[\u4E00-\u9FA5A-Za-z0-9\(\)\（\）]+$/.test($cpn.val()))){
		$cpnxx.css("color","#FF6600");
		$cpnxx.html("格式错误！");
		fcpn = 1;
	}else{
		$cpnxx.html("");
		fcpn = 0;
	}
})

/*登录邮箱判断*/
$email = $("#email");
$emailxx = $("#email_xx");
$email.blur(function(){
	if($email.val()==""){
		$emailxx.css("color","#FF6600");
		$emailxx.html("登录邮箱不能为空！");
		femail = 1;
	}else if(!(/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test($email.val()))){
		$emailxx.css("color","#FF6600");
		$emailxx.html("邮箱格式错误！");
		femail = 1;
	}else{
		$emailxx.html("");
		$.ajax({
			cache:false, type:"post",
			url:"register_cpn_email.php?email="+$email.val(), 
			async:true, dataType:"html", 
			error:function (request) {
				alert("服务器访问失败，请检查网络连接！");
				femail = 1;
			}, 
			success:function (data) {
				if(data=="0"){
					$emailxx.css("color","#FF6600");
					$emailxx.html("邮箱已存在！");
					femail = 1;
				}else{
					$emailxx.css("color","#00FFFF");
					$emailxx.html("");
					femail = 0;
				}
				
			}
		});
	}
})

/*地址判断*/
$add = $("#address");
$addxx = $("#address_xx");
$add.blur(function(){
	if($add.val()==""){
		$addxx.css("color","#FF6600");
		$addxx.html("地址不能为空！");
		fadd = 1;
	}else{
		$addxx.css("color","#00FFFF");
		$addxx.html("");
		fadd = 0;
	}
})

/*电话判断*/
$phone = $("#phone");
$phonexx = $("#phone_xx");
$phone.blur(function(){
	if($phone.val()==""){
		$phonexx.css("color","#FF6600");
		$phonexx.html("电话不能为空！");
		fphone = 1;
	}else{
		$phonexx.css("color","#00FFFF");
		$phonexx.html("");
		fphone = 0;
	}
})

/*所属行业判断*/
$indst = $("#industry");
$indstxx = $("#industry_xx");
$indst.blur(function(){
	if($indst.val()==""){
		$indstxx.css("color","#FF6600");
		$indstxx.html("所属行业不能为空！");
		findst = 1;
	}else if(!(/^[\u4E00-\u9FA5A-Za-z0-9]+$/.test($indst.val()))){
		$indstxx.css("color","#FF6600");
		$indstxx.html("请输入汉字！");
		findst = 1;
	}else{
		$indstxx.css("color","#00FFFF");
		$indstxx.html("");
		findst = 0;
	}
})

/*发展阶段判断*/
$stage = $("#stage");
/*$stagexx = $("#stage_xx");
$stage.blur(function(){
	if($stage.val()==0){
		$stagexx.css("color","#FF6600");
		$stagexx.html("请选择发展阶段！");
		fstage = 1;
	}else{
		$stagexx.css("color","#00FFFF");
		$stagexx.html("");
		fstage = 0;
	}
})*/

/*企业规模判断*/
$size = $("#size");
/*$sizexx = $("#size_xx");
$size.blur(function(){
	if($size.val()==0){
		$sizexx.css("color","#FF6600");
		$sizexx.html("请选择企业规模！");
		fsize = 1;
	}else{
		$sizexx.css("color","#00FFFF");
		$sizexx.html("");
		fsize = 0;
	}
})*/

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
		$pswdxx.html("");
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
		$rpswdxx.html("");
		frpswd = 0;
	}
})

/*验证码判断*/
$("#tijiao").click(function(){
	if ($stage.val()==0) {
		alert("请选择企业发展阶段！");
	}
	else if ($size.val()==0) {
		alert("请选择企业规模！");
	}
	else {
		if(fpswd+frpswd+fcpn+femail+fphone+fadd+findst == 0){
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
			alert("请根据提示完善信息！");		
		}
	}
	
});