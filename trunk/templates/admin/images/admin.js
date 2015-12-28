//判断浏览器类型
var qgExploer = navigator.appName;
var qgIE;
if(qgExploer == "Microsoft Internet Explorer")
{
	qgIE = "IE";
	if(navigator.appVersion.match(/7./i)!='7.')
	{
		qgIE = "IE6";
	}
}
else
{
	qgIE = "FF";
}

var qgbody = (document.documentElement) ? document.documentElement : document.body;

function $(id)
{
	return document.getElementById(id);
}

function tourl(url)
{
	window.location.href=url;
}


//将网址UrlEncode
function UrlEncode(str)
{
	return transform(str);
}

function transform(s)
{
	var hex=''
	var i,j,t

	j=0
	for (i=0; i<s.length; i++)
	{
		t = hexfromdec( s.charCodeAt(i) );
		if (t=='25')
		{
			t='';
		}
		hex += '%' + t;
	}
	return hex;
}

function hexfromdec(num) {
        if (num > 65535) { return ("err!") }
        first = Math.round(num/4096 - .5);
        temp1 = num - first * 4096;
        second = Math.round(temp1/256 -.5);
        temp2 = temp1 - second * 256;
        third = Math.round(temp2/16 - .5);
        fourth = temp2 - third * 16;
        return (""+getletter(third)+getletter(fourth));
}

function getletter(num) {
        if (num < 10) {
                return num;
        }
        else {
            if (num == 10) { return "A" }
            if (num == 11) { return "B" }
            if (num == 12) { return "C" }
            if (num == 13) { return "D" }
            if (num == 14) { return "E" }
            if (num == 15) { return "F" }
        }
}

//设定多长时间运行
function timeset(time,js)
{
	time = parseInt(time);
	if(time < 1)
	{
		eval(js);
	}
	else
	{
		if(time < 10)
		{
			time = time*1000;
		}
		window.setTimeout(js,time);
	}
}

/*************全选函数***********/
function select_all(id)
{
	if(id && id != "undefined")
	{
		var objs = $(id).getElementsByTagName("input");
	}
	else
	{
		var objs = window.document.getElementsByTagName("input");
	}
	for(var i=0; i<objs.length; i++)
	{
		if(objs[i].type.toLowerCase() == "checkbox" ) objs[i].checked = true;
	}
}
/***************全不选函数***********/
function select_none(id)
{
	if(id && id != "undefined")
	{
		var objs = $(id).getElementsByTagName("input");
	}
	else
	{
		var objs = window.document.getElementsByTagName("input");
	}
	for(var i=0; i<objs.length; i++)
	{
		if(objs[i].type.toLowerCase() == "checkbox" ) objs[i].checked = false;
	}
}
/*****************反选函数**************/
function select_anti(id)
{
	if(id && id != "undefined")
	{
		var objs = $(id).getElementsByTagName("input");
	}
	else
	{
		var objs = window.document.getElementsByTagName("input");
	}
	for(var i=0; i<objs.length; i++)
	{
		if(objs[i].type.toLowerCase() == "checkbox" )
		{
			if(objs[i].checked == true)
			{
				objs[i].checked = false;
			}
			else
			{
				objs[i].checked = true;
			}
		}
	}
}

/*取得复选框的值，并以,合并*/
function join_checkbox()
{
	var idarray = new Array();//定义一个数组
	var cv = document.getElementsByTagName("input");
	var m = 0;
	for(var i=0; i<cv.length; i++)
	{
		if(cv[i].type.toLowerCase() == "checkbox")
		{
			if(cv[i].checked)
			{
				idarray[m] = cv[i].value;
				m++;
			}
		}
	}
	var id = idarray.join(",");
	return id;
}


/*Select 选框的处理*/
function selected_true(idname,optioned)
{
	var obj = $(idname);
	for(i=0;i<obj.length;i++)
	{
		if(obj[i].value == optioned)
		{
			obj[i].selected = true;
		}
	}
}

/*创建ajax对象*/
function add_ajax()
{
	var xmlhttp=null;
	try
	{
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch(e)
	{
		try
		{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(oc)
		{
			xmlhttp=null;
		}
	}
	if(!xmlhttp && typeof XMLHttpRequest != "undefined")
	{
		xmlhttp=new XMLHttpRequest();
	}
    return xmlhttp;
}

/*根据url来处理ajax的信息*/
function get_ajax(url)
{
	var xmlhttp = add_ajax();
	var randname = "rand"+Math.floor(Math.random()*10000);
	var randnum = Math.floor(Math.random()*10000);
	if(url.indexOf("?") != -1)
	{
		url += "&"+randname+"="+randnum;
	}
	else
	{
		url += "?"+randname+"="+randnum;
	}
	xmlhttp.open("GET",url,false);
	xmlhttp.send(null);
	if(xmlhttp.readyState==3)
	{
		alert("数据加载中...");
	}
	else if(xmlhttp.readyState == 4)
	{
		var result = xmlhttp.responseText;
		if(result)
		{
			return result;
		}
		else
		{
			alert("网络原因，请刷新后重新提交");
		}
	}
}

/*Cookie管理*/
function get_cookie(name)
{
	var cookieValue = "";
	var search = name + "=";
	if(document.cookie.length > 0)
	{
		offset = document.cookie.indexOf(search);
		if (offset != -1)
		{
			offset += search.length;
			end = document.cookie.indexOf(";", offset);
			if (end == -1)
			{
				end = document.cookie.length;
			}
			cookieValue = unescape(document.cookie.substring(offset, end));
		}
	}
	return cookieValue;
}

function set_cookie(cookieName,cookieValue,DayValue)
{
	var expire = "";
	var day_value=1;
	if(DayValue!=null)
	{
		day_value=DayValue;
	}
    expire = new Date((new Date()).getTime() + day_value * 86400000);
    expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape(cookieValue) +";path=/"+ expire;
}

function del_cookie(cookieName)
{
	var expire = "";
    expire = new Date((new Date()).getTime() - 1 );
    expire = "; expires=" + expire.toGMTString();
	document.cookie = cookieName + "=" + escape("") +";path=/"+ expire;
}

//插入文件到当前光标处
function insert_txt(c,v)
{
	var obj=$(c);
	if(document.selection)
	{
		obj.focus();
		document.selection.createRange().text = v;
	}
	else
	{
		obj.value = obj.value.slice(0,Obj.selectionStart) + v + obj.value.slice(obj.selectionEnd,obj.value.length);
	}
}

//Layer类
var Layer=
{
	init:function(url,divw,divh,vLeft,vTop)
	{
		Layer.divw = divw>240 ? divw : 240;//弹出窗口的宽，最小为240
		Layer.divh = divh>170 ? divh : 170;//弹出窗口的高，最小为170
		Layer.content = url ? '<iframe width="'+Layer.divw+'px" height="'+Layer.divh+'px" frameborder="0" style="overflow:hidden;" src="'+url+'" id="qgLayerFrameId" name="qgLayerFrameId"></iframe>' : '<iframe width="'+Layer.divw+'px" height="'+Layer.divh+'px" frameborder="0" style="overflow:hidden;" src="about:blank"></iframe>';
		//判断居层的左右上下值
		if(vLeft && vLeft>=Layer.divw)
		{
			Layer.vLeft = vLeft-Layer.divw;
		}
		else
		{
			Layer.vLeft = (qgbody.clientWidth - Layer.divw)/2;
		}
		if(vTop && vTop<Layer.divh)
		{
			Layer.vTop = vTop;
		}
		else
		{
			Layer.vTop = (qgbody.clientHeight-Layer.divh)/2 + qgbody.scrollTop;
			if(divh == 312)
			{
				Layer.vTop = 10;
			}
		}
		Layer.screenConvert();
		Layer.dialogShow();
	},
	over:function()
	{
		Layer.screenOver();
		Layer.dialogOver();
	},/*关闭*/
	screenConvert:function()
	{
		var objScreen = $("ScreenOver");
		if (!objScreen) var objScreen = document.createElement("div");
		objScreen.id = "ScreenOver";
		var oS = objScreen.style;
		var bgww=document.body.offsetWidth;//网页可见区域宽度

		if (window.innerWidth)
		{
			winWidth = window.innerWidth;
		}
		else if ((document.body) && (document.body.clientWidth))
		{
			winWidth = document.body.clientWidth;   //获取窗口高度
		}
		if (window.innerHeight)
		{
			winHeight = window.innerHeight;
		}
		else if ((document.body) && (document.body.clientHeight))
		{
			winHeight = document.body.clientHeight;   //通过深入Document内部对body进行检测，获取窗口大小
		}
		if (document.documentElement  && document.documentElement.clientHeight && document.documentElement.clientWidth)
		{
			winHeight = document.documentElement.clientHeight;
			winWidth = document.documentElement.clientWidth;
		}
		bgwh=document.body.scrollHeight; //滚动条的高度
		if(bgwh>winHeight)
		{
			winHeight=bgwh;
		}
		Layer.winWidth = winWidth;
		Layer.winHeight = winHeight;
		var s_style = "width:100%;height:"+winHeight+"px;";
		s_style += "display:block;left:0px;top:0px;";
		s_style += "position:absolute;z-index:50;";
		s_style += "background:#000;filter:alpha(opacity=45);";
		s_style += "opacity:0.45;";
		oS.cssText = s_style;
		Layer.objScreen = objScreen;
		document.body.appendChild(objScreen);
	},
	screenOver:function()
	{
		var objScreen = $("ScreenOver");
		if (objScreen)
		{
			objScreen.style.display="none";
			document.body.removeChild(objScreen);
		}
	},
	dialogShow:function()
	{
		var Tips=$("qgLayerTips");
		if(!Tips){
			Tips=document.createElement("div");
			Tips.id="qgLayerTips";
			var Tipstyle=Tips.style;
			Tipstyle.position="absolute";
			Tipstyle.height = Layer.divh + "px";
			Tipstyle.width = Layer.divw + "px";
			Tipstyle.background="#FFF";
			Tipstyle.zIndex = "100";
			Tipstyle.top = Layer.vTop + "px";
			Tipstyle.left = Layer.vLeft + "px";
			//Tipstyle.left = (Layer.winWidth - Layer.divw)/2 + "px";
			//Tipstyle.top = (Layer.winHeight - Layer.divh)/2 + "px";
			Tipstyle.padding = "0";
		}else{
			Tips.style.display="";
		}//创建一个弹出框

		var content=$("qgvContentMsg");/*提示框里的调用内容格式*/
		if(!content)
		content=document.createElement("div");
		content.id="qgvContentMsg";
		var cstyle=content.style;
		cstyle.margin="0px";
		cstyle.padding="0px";
		cstyle.width="100%";
		cstyle.zIndex = "90";
		var bottom_msg = "<div style='padding:2px;text-align:left;background:#FFF;border-top:2px solid #EEE;'><input type='button' value='全 选' onclick=\"window.frames['qgLayerFrameId'].select_all()\"> <input type='button' value='反 选' onclick=\"window.frames['qgLayerFrameId'].select_anti()\"> <input type='button' value='不 选' onclick=\"window.frames['qgLayerFrameId'].select_none()\"> <input type='button' value='关 闭' onclick='Layer.over();'> <input type='button' value='提 交' onclick=\"window.frames['qgLayerFrameId'].ok();\" style='color:red;'></div>";
		content.innerHTML=Layer.content+bottom_msg;

		Tips.appendChild(content);
		document.body.appendChild(Tips);
		Drag.init($("qgvContentMsg"),$("qgLayerTips"));
	},
	dialogOver:function()
	{
		var Tips=$("qgLayerTips");
		if(Tips)
		{
			Tips.style.display="none";
			document.body.removeChild(Tips);
		}
	}
}

//----------------移动效果
var Drag = {

	obj : null,

	init : function(o, oRoot, minX, maxX, minY, maxY, bSwapHorzRef, bSwapVertRef, fXMapper, fYMapper)
	{
		o.onmousedown	= Drag.start;

		o.hmode			= bSwapHorzRef ? false : true ;
		o.vmode			= bSwapVertRef ? false : true ;

		o.root = oRoot && oRoot != null ? oRoot : o ;

		if (o.hmode  && isNaN(parseInt(o.root.style.left  ))) o.root.style.left   = "0px";
		if (o.vmode  && isNaN(parseInt(o.root.style.top   ))) o.root.style.top    = "0px";
		if (!o.hmode && isNaN(parseInt(o.root.style.right ))) o.root.style.right  = "0px";
		if (!o.vmode && isNaN(parseInt(o.root.style.bottom))) o.root.style.bottom = "0px";

		o.minX	= typeof minX != 'undefined' ? minX : null;
		o.minY	= typeof minY != 'undefined' ? minY : null;
		o.maxX	= typeof maxX != 'undefined' ? maxX : null;
		o.maxY	= typeof maxY != 'undefined' ? maxY : null;

		o.xMapper = fXMapper ? fXMapper : null;
		o.yMapper = fYMapper ? fYMapper : null;

		o.root.onDragStart	= new Function();
		o.root.onDragEnd	= new Function();
		o.root.onDrag		= new Function();
	},

	start : function(e)
	{
		var o = Drag.obj = this;
		e = Drag.fixE(e);
		var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
		var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
		o.root.onDragStart(x, y);

		o.lastMouseX	= e.clientX;
		o.lastMouseY	= e.clientY;

		if (o.hmode) {
			if (o.minX != null)	o.minMouseX	= e.clientX - x + o.minX;
			if (o.maxX != null)	o.maxMouseX	= o.minMouseX + o.maxX - o.minX;
		} else {
			if (o.minX != null) o.maxMouseX = -o.minX + e.clientX + x;
			if (o.maxX != null) o.minMouseX = -o.maxX + e.clientX + x;
		}

		if (o.vmode) {
			if (o.minY != null)	o.minMouseY	= e.clientY - y + o.minY;
			if (o.maxY != null)	o.maxMouseY	= o.minMouseY + o.maxY - o.minY;
		} else {
			if (o.minY != null) o.maxMouseY = -o.minY + e.clientY + y;
			if (o.maxY != null) o.minMouseY = -o.maxY + e.clientY + y;
		}

		document.onmousemove	= Drag.drag;
		document.onmouseup		= Drag.end;

		return false;
	},

	drag : function(e)
	{
		e = Drag.fixE(e);
		var o = Drag.obj;

		var ey	= e.clientY;
		var ex	= e.clientX;
		var y = parseInt(o.vmode ? o.root.style.top  : o.root.style.bottom);
		var x = parseInt(o.hmode ? o.root.style.left : o.root.style.right );
		var nx, ny;

		if (o.minX != null) ex = o.hmode ? Math.max(ex, o.minMouseX) : Math.min(ex, o.maxMouseX);
		if (o.maxX != null) ex = o.hmode ? Math.min(ex, o.maxMouseX) : Math.max(ex, o.minMouseX);
		if (o.minY != null) ey = o.vmode ? Math.max(ey, o.minMouseY) : Math.min(ey, o.maxMouseY);
		if (o.maxY != null) ey = o.vmode ? Math.min(ey, o.maxMouseY) : Math.max(ey, o.minMouseY);

		nx = x + ((ex - o.lastMouseX) * (o.hmode ? 1 : -1));
		ny = y + ((ey - o.lastMouseY) * (o.vmode ? 1 : -1));

		if (o.xMapper)		nx = o.xMapper(y)
		else if (o.yMapper)	ny = o.yMapper(x)

		Drag.obj.root.style[o.hmode ? "left" : "right"] = nx + "px";
		Drag.obj.root.style[o.vmode ? "top" : "bottom"] = ny + "px";
		Drag.obj.lastMouseX	= ex;
		Drag.obj.lastMouseY	= ey;

		Drag.obj.root.onDrag(nx, ny);
		return false;
	},

	end : function()
	{
		document.onmousemove = null;
		document.onmouseup   = null;
		Drag.obj.root.onDragEnd(	parseInt(Drag.obj.root.style[Drag.obj.hmode ? "left" : "right"]), 
									parseInt(Drag.obj.root.style[Drag.obj.vmode ? "top" : "bottom"]));
		Drag.obj = null;
	},

	fixE : function(e)
	{
		if (typeof e == 'undefined') e = window.event;
		if (typeof e.layerX == 'undefined') e.layerX = e.offsetX;
		if (typeof e.layerY == 'undefined') e.layerY = e.offsetY;
		return e;
	}
};

//-------获取元素的纵坐标
function getTop(e)
{
	var offset=e.offsetTop;
	if(e.offsetParent!=null)
	{
		offset+=getTop(e.offsetParent);
	}
	return offset;
}
//-------获取元素的横坐标
function getLeft(e)
{
	var offset=e.offsetLeft;
	if(e.offsetParent!=null)
	{
		offset+=getLeft(e.offsetParent);
	}
	return offset;
}
