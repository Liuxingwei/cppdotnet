/*验证码判断*/
$("#tijiao").click(function(){
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
});