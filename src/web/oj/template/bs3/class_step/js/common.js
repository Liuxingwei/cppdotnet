/*!
 * Item Name : pp助手产品站 (pro.25pp.com)
 * Copyright 2012, 25pp.com
 *
 * Creator : X_Pilot(Inv)
 * Created Date : 2012.12.11
 */
var $id = function(id) { return document.getElementById(id); };
var trBase = {};

//trBase 铁人网络JS库 Base 部分，可各个项目、插件通用
(function(pro) {
    base = {
        //浏览器判定
		browVer : typeof($)!='undefined' ? $.browser.version : '',
        isMozilla : (typeof document.implementation != 'undefined') && (typeof document.implementation.createDocument != 'undefined') && (typeof HTMLDocument != 'undefined'),
        isIE : window.ActiveXObject ? true : false,
        isIE6 : (window.ActiveXObject ? true : false) && this.browVer == 6 ? true : false,
        isFirefox : (navigator.userAgent.toLowerCase().indexOf("firefox") != - 1),
        isSafari : (navigator.userAgent.toLowerCase().indexOf("safari") != - 1),
        isOpera : (navigator.userAgent.toLowerCase().indexOf("opera") != - 1),
		isSupportJquery : typeof($)!='undefined' && $ != null,

        //绑定事件
        // @param   obj     Object       绑定对象
        // @param   eType   String       绑定事件的名称
        // @param   fn      Function	 事件触发后执行的函数
        bind : function(obj, eType, fn) {
            if(obj.addEventListener) { 
                obj.addEventListener(eType, fn, false); 
            } else if(obj.attachEvent) { 
                obj.attachEvent("on" + eType, fn); 
            } else { 
                obj["on" + eType] = fn; 
            }
        },

        //阻止事件冒泡
		//@param    e    Event
        stopProp : function(e) {
            var e = e || window.event;
            e.stopPropagation ? e.stopPropagation() : (e.cancelBubble=true);
        },
            
        //设置Cookie变量
		//@param    c_name        String    cookie名称
		//@param    value         String    cookie值
		//@param    expiredays    Int       过期时间(天)
		//@param    path          String    cookie路径
        setCookie : function(c_name, value, expiredays, path) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + expiredays);
            document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString()) + ((path == null) ? "" : ";path=" + path);
        },

        //获取Cookie变量
		//@param    c_name    String    cookie名
        getCookie : function(c_name) {
            if(document.cookie.length > 0) {
                c_start = document.cookie.indexOf(c_name + "=");
                if(c_start != -1) { 
                    c_start = c_start + c_name.length + 1; 
                    c_end = document.cookie.indexOf(";",c_start);
                    if(c_end == -1) { c_end = document.cookie.length; }
                    return unescape(document.cookie.substring(c_start,c_end));
                } 
            }
            return "";
        },
		
		//获取URL参数
		//@param    name    String    参数名
		getQueryString : function(name){
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");  
			var r = (window.location.search || window.location.hash).substr(1).match(reg);  
			if (r!=null) return decodeURI(r[2]); 
			return null; 		
		},
		
		//获取对象样式表
		//@param    obj    Object    元素对象
		getStyle : function(obj){
			return obj.currentStyle || document.defaultView.getComputedStyle(obj, null);
		},
		
		//将普通文本转换为HTML代码
		//@param    text    String    要转换的文本
		htmlEncode : function(text){
			return text.replace(/&amp;/g, '&').replace(/&acute;/g, "\'").replace(/&quot;/g, '"').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/<br>/g, "\n");
		},
		
		//将文本复制到剪贴板
		//@param    text    String    要复制的文本
		//备注：火狐17.0以上版本已经不支持对粘贴板操作，所以此方法无效
		copyClip : function(text){
			if (window.clipboardData) { 
				window.clipboardData.setData("Text", text); 
			} else if (window.netscape) {
				try{
				netscape.security.PrivilegeManager.enablePrivilege('UniversalXPConnect');	
				var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);
				if (!clip) return;
				var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);
				if (!trans) return;
				trans.addDataFlavor('text/unicode');
				var str = new Object(), len = new Object(), str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString), copytext = text;
				str.data = copytext;
				trans.setTransferData("text/unicode", str, copytext.length * 2);
				var clipid = Components.interfaces.nsIClipboard;
				if (!clip) return false;
				clip.setData(trans, null, clipid.kGlobalClipboard);
				}catch(e){
					//console.log("你使用的FF浏览器,复制功能被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'"); 
				}
			}
		},
		
		//获取浏览器尺寸可见区域尺寸
		getWindowSize : function(){
			if (window.innerWidth) {
				winWidth = window.innerWidth;
			} else if ((document.body) && (document.body.clientWidth)) {
				winWidth = document.body.clientWidth;
			}
			if (window.innerHeight) {
				winHeight = window.innerHeight;
			} else if ((document.body) && (document.body.clientHeight)) {
				winHeight = document.body.clientHeight;
			}
			if (document.documentElement && document.documentElement.clientHeight && document.documentElement.clientWidth) {
				winHeight = document.documentElement.clientHeight;
				winWidth = document.documentElement.clientWidth;
			}
			return { height : winHeight, width : winWidth }
		},
		
		//清除字符串左右空格字符
		//@param    text    String
		trim : function(text){
			if (typeof(text) == "string") {
				return text.replace(/^\s*|\s*$/g, "");
			} else {
				return text;
			}		
		},
		
		//判断值是否为空
		//@param    text    String || object || array
		isEmpty : function(val){	
			switch (typeof(val)) {
				case 'string':	
					return val.replace(/^\s\s*/, '' ).replace(/\s\s*$/, '' ).length == 0 ? true : false;
				case 'object':
					return val == null;
				case 'array':
					return val.length == 0;
				default:
					return true;
			}	
		},
		
		//判断值是否为数字
		//@param    val    String
		isNumber : function(val){
			var reg = /^[\d|\.|,]+$/;
			return reg.test(val);		
		},
		
		//判断值是否为整型
		//@param    val    String
		isInt : function(val){
			if (val == "" && val != 0) return false;
			var reg = /^-?\d+$/;
			return reg.test(val);
		},
		
		
		//验证电子邮箱
		//@param    text    String
		isEmail : function(text){
			var reg = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/;
			return reg.test(text);		
		},

		//验证电话区号
		//@param    text    String		
		isTelArea : function(text){
			var reg = /^[\d]{3,4}$/;
			return reg.test(text);		
		},
		
		//验证电话号码
		//@param    text    String		
		isTel : function(text){
			var reg = /^[\d\-\s]{6,13}$/;
			return reg.test(text);		
		},
		
		//验证手机号码
		//@param    text    String		
		isMobile : function(text){
			var reg = /^1[3|4|5|8][0-9]{9}$/;
			return reg.test(text);		
		},		
		
		//文本框获得焦点时清除提示，失去焦点时恢复提示，按回车键的动作
		//@param    obj            object        文本框对象
		//@param    text           String        提示文本
		//@param    color1         String        获得焦点时文字颜色(可选)
		//@param    color2         String        失去焦点时文字颜色(可选)
		//@param	enterAction    Function      绑定按回车键时的动作函数(可选)
		textCue : function(obj, text, color1, color2, enterAction){
			if(!color1) color1 = "#000";
			if(!color2) color2 = "#999";
			obj.value = text;
			obj.style.color = color2;
			obj.onfocus = function() { 
				if(this.value == text) {
					this.value = "";
					this.style.color = color1;
				}
			}
			obj.onblur = function() { 
				if(obj.value == "") {
					obj.value = text;
					obj.style.color = color2;
				}
			}
			if(typeof enterAction != "function") return;
			obj.onkeypress = function(e) {
				var e = e || window.event, ek = e.keyCode || e.which;
				if (ek == 13) enterAction();
			}		
		}
    }
	pro.base = base;
})(trBase);


var proSite = {};

//common
(function(pro) {
    var common = {
	
		//tabs切换
		tabsInit : function(tabName,tabBox){
			var currentIndex = 0;
			var $tabs = $(tabName),$tabsBox = $(tabBox);
			$tabs.click(function(){
				currentIndex = $tabs.index(this);
				if($tabsBox.length > currentIndex){
					showTab();			
				}
				return false;
			})
			$tabs.each(function(){
				if($(this).hasClass('current')){
					currentIndex = $tabs.index(this);
				}
			})			
			if(currentIndex > 0){
				if($tabsBox.length > currentIndex){
					showTab();				
				}
			}
			function showTab(){
					$tabsBox.hide();
					$tabs.removeClass('current');
					$tabsBox.eq(currentIndex).show();
					$tabs.eq(currentIndex).addClass('current')				
			}
		},
	
		//下拉关联 dropDownInit(downBtn,downBox)
		dropDownInit : function(downBtn,downBox){
			var n, i,
			dragDownBtn = $(downBtn),
			dragDownBox = $(downBox), 
			dragDownShow = [];
			for(i=0; i<dragDownBtn.length; i++) { dragDownShow.push(false); }
			dragDownBtn.hover(function() {
				n = dragDownBtn.index($(this));
				dragDownShow[n] = true;
				dragDownBox.eq(n).slideDown(250);
			}, function() {
				dragDownShow[n] = false;
				setTimeout(function() { if(!dragDownShow[n]) dragDownBox.eq(n).slideUp(180); }, 80);
			});
			dragDownBox.hover(function() {
			n = dragDownBox.index($(this));
			dragDownShow[n] = true;
			}, function() {
				dragDownShow[n] = false;
				setTimeout(function() { if(!dragDownShow[n]) dragDownBox.eq(n).slideUp(180); }, 80);
			});			
		},
		
		//获取url参数 getQueryString(parName)
		getQueryString : function(name) {  
			var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)","i");  
			var r = window.location.search.substr(1).match(reg);  
			if (r!=null) return decodeURI(r[2]); 
			return null;  
		}		
    };
    pro.common = common;
})(proSite);


function do_download(Id){     
    var url = "do_download.php?Id="+Id; 
	var outMessage = ""; //建立XMLHttpRequest对象 
	if(window.XMLHttpRequest){  
	xhr = new XMLHttpRequest; 
	}else if(window.ActiveXObject){  
	try{                                                                                                                                                       
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			} 
		} if(xhr){  
		xhr.onreadystatechange = showMessage;  xhr.open("POST",url,true); 
		xhr.send(null); 
		}else{  
		outMsg = "don't create an XMLHttpRequest";
		 }}function showMessage(){ 
		 var outMsg = ""; 
		 if(xhr.readyState == 4){  
		 if(xhr.status == 200){  
		 if(xhr.responseText==1){   
		  //outMsg = "缓存操作成功！";
		  //document.body.removeChild(document.getElementById('bgDiv'));
          //msgObj.removeChild(title);
          //document.body.removeChild(document.getElementById('msgDiv'));
		  //alert(outMsg);  
		   }else{   
		    // outMsg = "更新失败！";
			  //document.body.removeChild(document.getElementById('bgDiv'));
          //msgObj.removeChild(title);
         // document.body.removeChild(document.getElementById('msgDiv'));
			  //alert(outMsg);   
		     }    }else{   
			 outMsg = "Error"; 
			  } }
			
			  }
       