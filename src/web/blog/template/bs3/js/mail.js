$("#tijiao").click(function(){
	var to_user=$.trim($("#to_user").val());
	var to_title=$.trim($("#to_title").val());
	var to_content=$.trim($("#to_content").val());
	if(to_user==''){
		alert('收件人id不能为空!!!');
		return;
	}
	if(to_title==''){
		alert('标题不能为空!!!');
		return;
	}
	if(to_content==''){
		alert('内容不能为空!!!');
		return ;
	}
	$("#form").submit();
});