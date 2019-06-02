$(document).ready(function(){
	$(".stu_expand").each(function(){
			$(this).hide();
		});
	$(".work_expand").hide();
	switch($("#is_work").val()){
			case '0':
				$(".stu_expand").each(function(){
					$(this).show();
				});
				break;
			case '1':
				$(".work_expand").show();
				break;
			case '2':
				break;
	};
	$("#is_work").change(function(){
		$(".stu_expand").each(function(){
			$(this).hide();
		});
		$(".work_expand").hide();
		switch($("#is_work").val()){
			case '0':
				$(".stu_expand").each(function(){
					$(this).show();
				});
				break;
			case '1':
				$(".work_expand").show();
				break;
			case '2':
				break;
		};
	});
});
function nick_change_check(){
	if($("#nnick").val()!=$("#onick").val()){
		var ans = confirm("确定要修改昵称? 三个月内仅可修改一次哦.");
		return ans;
	}
}
/*昵称判断*/
var fnick = 0;
$nick = $("#nnick");
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
		$nickxx.html("确定要修改昵称? 三个月内仅可修改一次哦.");
		fnick = 0;
	}
})

$("#email").focusout(function(){
	// console.log('focusout');
	if($("#email").val()!=$("#oemail").val()){
		$("#goverify").attr('href','verifymail.php?mail='+$("#email").val());
		$("#goverify").removeClass('btn-success');
		$("#goverify").addClass('btn-warning');
		$("#goverify").text('去验证');
	}
});

$("#tijiao").click(function(){
	if(fnick == 0){
		$("#form").submit();
	}else{
		alert("请根据提示修改资料！");		
	}
});