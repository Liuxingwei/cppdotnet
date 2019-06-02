var cntdown=0;
function getCCode(){
	if(cntdown==0){
		$.ajax({
			url:'ajax_send_mail_code.php',
			type:'POST',
			data:{
				'type':'mail_verify',
				'mail':$("#mail").val()
			},
			success:function(data){
				console.log(data);
				if(data.indexOf('true')!=-1){
					alert('发送成功!快去邮箱查收吧!');
					$("#getCheckCode").attr('disabled','disabled');

				}else if(data.indexOf('time limit')!=-1){
					alert('60s内只能发送一次!!!');
				}
			}
		});
		cntdown=50;
	}else{
		$("#getCheckCode").text("重新发送(" + cntdown + ")");		
		cntdown--;
		// if(cntdown==0){
		// 	$("#getCheckCode").attr('disabled','');
		// 	return;
		// }
	}
	setTimeout(getCCode(),10000);
};