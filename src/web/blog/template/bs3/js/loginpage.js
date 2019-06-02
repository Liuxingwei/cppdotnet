function check_and_login(){
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
				// console.log("error_checkcode");
				$("#img_vcode").click();
			}
			else $("#form").submit();
		}
	});
}
function input_text_submit(evt){
	var evt=evt?evt:(window.event?window.event:null);//兼容IE和FF
	  if (evt.keyCode==13)check_and_login();
}
$("#tijiao").click(function(){
	check_and_login();
});
$("#img_vcode").click();
$("#vcode").val("");