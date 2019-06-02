function readyForSubmit(){
	// $("input[type=checkbox]").each(function(){
	if($(this).is(':checked')){
		var p_selected = $("#p_selected");
		if(p_selected.val().indexOf($(this).val())==-1)
			p_selected.val(p_selected.val()+$(this).val()+",");
	}else{
		var p_selected = $("#p_selected");
		if(p_selected.val().indexOf($(this).val())!=-1){
			var tmpvar=p_selected.val();
			p_selected.val(tmpvar.replace($(this).val()+",",''));
		}
	}
	// console.log($("#p_selected").val());
	// });
}
$("input[type=checkbox]").click(readyForSubmit);
function getProblem(page){
	page=parseInt(page)+10;
	page*=100;
	if(page<1000)page=1000;
	var url="getproblem.php?pstart="+page;
	// console.log("changed");
	
	// readyForSubmit();

	// console.log($("#p_selected").val());
	$.ajax({
	    'url': url,
	    'type': "GET",
	    'success': function(data){
	        var strs=new Array();
	        strs=data.split("\n");
	        var tbdy=$("#p_table>tbody");
	        tbdy.html("");
	        var tmpcnt=0;
	        for(var i=0;i<strs.length;i++){
	        	if(strs[i].substring(0,1)=="|"){
	        		var tbdy_content=tbdy.html();
	        		tbdy_content+=tmpcnt?"<tr class='oddrow'>":"<tr class='evenrow'>";
	        		tbdy_content+="<td>"+page+"<input type='checkbox' ";
	        		if($("#p_selected").val().indexOf(page+"")!=-1)
	        			tbdy_content+=" checked='checked' ";

					tbdy_content+=" value="+page+"></td><td><a href='problem.php?id="+page+"' target='_blank'>"+strs[i].substring(1)+"</a></td></tr>";
					tbdy.html(tbdy_content);
	        		tmpcnt=1-tmpcnt;
	        		page++;
	        	}
	        }
	        $("input[type=checkbox]").click(readyForSubmit);
	    }
	});
}



fc_title = 1;
$c_title = $("#c_title");
/*$c_titlexx = $("#c_title_xx");*/
$c_title.blur(function(){
	if(!(/^([A-Za-z0-9\u4e00-\u9fa5]+)?$/.test($c_title.val()))){
		/*$c_titlexx.css("color","#FF6600");
		$c_titlexx.html("请输入英文或数字！");*/
		fc_title = 1;
	}
	else{
		fc_title = 0;
	}
})

$("#tijiao").click(function(){
	if (fc_title==0) {
		$("#form").submit();
	}
	else{
		alert("比赛名称请勿输入符号！");
	}
});