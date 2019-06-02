
//pp助手for ios
(function(pro) {
    var trB = pro.trBase,
        common = pro.common;

    //页面初始化
    $(document).ready(function() {
        $(".banner").InvSlide({ imgEl:".picbox .pic", imgTextBar:false, btnPrevNext:false, indexNum:false, speed:8000 }); 
        $('.download a').click(function() {	window.location = window.location.href.replace('#step_script', '') + '#step_script'; });
        step_script_init();
    });
	
	//step_script的滚动
	function step_script_init() {

		//直接选定tab
		var click1 = $('.tab_step1')
		var click2 = $('.tab_step2')
		var click3 = $('.tab_step3')
		click1.click(function() {
			index = 0;
			showPic(index);
		});
		click2.click(function() {
			index = 1;
			showPic(index);
		});
		click3.click(function() {
			index = 2;
			showPic(index);
		});


		var oNext = $('.right');
		var oPrev = $('.left');
		var oCtbig = $('.ctbig');
		var aBtn = $('.step_top li');
		var sWidth = $('.step_content').width();
		var index = 0;
		//下一页 
		oNext.click(function() {
			index += 1;
			if (index === 3){index = 0;}
			showPic(index);
        });
		//上一页
		oPrev.click(function() {
			index -= 1;
			if (index === -1){index = 2;}
			showPic(index);
        });
		function showPic(index) {
			var nowLeft = -index * sWidth;
			oCtbig.stop(true,false).animate({"left":nowLeft}, 1000);
			aBtn.removeClass('on').eq(index).addClass('on'); 
        };
    }
	
})(proSite);
