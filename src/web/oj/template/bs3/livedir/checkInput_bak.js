function checkInput(result){  //jquery解决方案
				return result;  //这个函数用来返回是否提交表单的抉择值
			}
		$(function(){
			$("form").submit(function(){ 
				var getState=$("select").val();
				var getContent=$("input[name='content']").val();
				var getTeacher=$("input[name='teacher']").val();
				var getDate=$("input[name='date']").val();
				var getID=$("input[name='id']").val();
				var getUrl=$("input[name='url']").val();
				if(getContent=='')
				{
					alert("视频简介不能为空");
					$("input[name='content']").focus();
					return checkInput(false);
				}
				if(getTeacher=='')
				{
					alert("老师姓名不能为空");
					$("input[name='teacher']").focus();
					return checkInput(false);
				}
				if(getDate=='')
				{
					alert("日期不能为空");
					$("input[name='date']").focus();
					return checkInput(false);
				}
				if(getID=='')
				{
					alert("编号不能为空");
					$("input[name='id']").focus();
					return checkInput(false);
				}
				if(getState=='录像')
				{
					if(getUrl=='')
					{
						alert("录像的链接不能为空");
						$("input[name='url']").focus();
						return checkInput(false);
					}
				}
			})
			})