
var fcpn = 0;
var fadd = 0;
var fphone = 0;
var findst = 0;
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

$stage = $("#stage");
$size = $("#size");

/*验证码判断*/
$("#tijiao").click(function(){
	if ($stage.val()==0) {
		alert("请选择企业发展阶段！");
	}
	else if ($size.val()==0) {
		alert("请选择企业规模！");
	}
	else {
		if(fcpn+fphone+fadd+findst == 0){
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
			alert("请根据提示完善信息！\n"
				+fcpn+"\n"+femail+"\n");		
		}
	}
	
});