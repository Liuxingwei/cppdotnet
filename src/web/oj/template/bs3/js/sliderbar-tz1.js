(function ($) {
    $.fn.extend({
        "sliderBar": function (options) {
            // 使用jQuery.extend 覆盖插件默认参数
            var opts = $.extend(
                {} ,
                $.fn.sliderBar.defalutPublic ,
                options
            );

            // 这里的this 就是 jQuery对象，遍历页面元素对象
            // 加个return可以链式调用
            return this.each(function () {
                //获取当前元素 的this对象 
                var $this = $(this);  

                $this.data('open', opts.open);

                privateMethods.initSliderBarCss($this, opts);

                switch(opts.position){
                    case 'right' : privateMethods.showAtRight($this, opts); break;
                    case 'left'  : privateMethods.showAtLeft($this, opts); break;
                }
                
            });
        }
    });

    // 默认公有参数
    $.fn.sliderBar.defalutPublic = {
        open : true,           // 默认是否打开，true打开，false关闭
        top : 200,             // 距离顶部多高
        width : 260,           // body内容宽度
        height : 200,          // body内容高度
        theme : 'green',       // 主题颜色
        textborder : '#DDD',
        background : '#FFF',
        position : 'left'      // 显示位置，有left和right两种
    }

    var privateMethods = {
        initSliderBarCss : function(obj, opts){
            obj.css({
                'width': opts.width+'px',
                'min-height' : opts.height+20+'px',
                'top' : opts.top+'px',
                'border' : '1px solid '+opts.textborder,
                'background-color': opts.background,
                'position':'fixed',
                'font-family':'Microsoft Yahei',
                'z-index': '9999',
                'box-shadow': '5px 5px 10px #ddd'
            }).find('.sliderbar-tz-body').css({
                'width': opts.width+'px',
                'min-height' : opts.height+'px',
                'position':'relative',
                'padding':'10px 15px',
                'overflow-x':'hidden',
                'overflow-y':'auto',
                'font-family':'Microsoft Yahei',
                'font-size' : '16px'
            });

            var titleCss = {
                'width':'25px',
                'height':'105px',
                'position':'absolute',
                'top':'-1px',
                'display':'block',
                'background-color': opts.theme,
                'font-size': '13px',
                'padding':'8px 4px 0px 5px',
                'color':'#fff',
                'cursor': 'pointer',
                'font-family':'Microsoft Yahei'
            }

            obj.find('.sliderbar-tz-title').css(titleCss).find('i').css({
                'font-size': '15px'
            });
        },
        showAtLeft : function(obj, opts){
            if(opts.open){
                obj.css({left:'0px'});
                obj.find('.sliderbar-tz-title').css('right','-25px').find('i').attr('class','fa fa-chevron-circle-left');
            }else{
                obj.css({left:-opts.width-22+'px'});
                obj.find('.sliderbar-tz-title').css('right','-25px').find('i').attr('class','fa fa-chevron-circle-right');
            }

            obj.find('.sliderbar-tz-title').click(function(){
                if(obj.data('open')){
                    obj.animate({left:-opts.width-22+'px'}, 500);
                    $(this).find('i').attr('class','fa fa-chevron-circle-right');
                }else{
                    obj.animate({left:'0px'}, 500);
                    $(this).find('i').attr('class','fa fa-chevron-circle-left');
                }
                obj.data('open',obj.data('open') == true ? false : true);
            });
        },
        showAtRight : function(obj, opts){
            if(opts.open){
                obj.css({right:'0px'});
                obj.find('.sliderbar-tz-title').css('right', opts.width+'px').find('i').attr('class','fa fa-chevron-circle-right');
            }else{
                obj.css({right:'25px'});
                obj.find('.sliderbar-tz-title').css('right', opts.width+20+'px').find('i').attr('class','fa fa-chevron-circle-left');
            }

            obj.find('.sliderbar-tz-title').click(function(){
                if(obj.data('open')){
                    obj.animate({right:-opts.width+'px'}, 500);
                    $(this).find('i').attr('class','fa fa-chevron-circle-left');
                }else{
                    obj.animate({right:'0px'}, 500);
                    $(this).find('i').attr('class','fa fa-chevron-circle-right');
                }
                obj.data('open',obj.data('open') == true ? false : true);
            });
        }
    };
})(jQuery)