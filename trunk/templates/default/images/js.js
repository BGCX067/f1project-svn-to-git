//-------常用的JS
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
	document.write("<style type='text/css'>body{overflow-y:scroll;}</style>");
}

var qgbody = (document.documentElement) ? document.documentElement : document.body


//设为首页
function sethome(obj,url)
{
	try
	{
		obj.style.behavior='url(#default#homepage)';
		obj.sethomepage(url);
	}
	catch(e)
	{
		if(window.netscape)
		{
			try
			{
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}
			catch(e)
			{
				alert("感谢您光临本站\n\n　　无法正确设为主页上，请您手动进行设置！\n\n　　给您带来不便还请见谅...");
				return false;
			}
			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref('browser.startup.homepage',url);
		}
	}
	return false;
}

//加入收藏
function setfav(url,sitename)
{
	try
	{
		window.external.AddFavorite(url,sitename)
	}
	catch (e)
	{
		try
        {
            window.sidebar.addPanel(sitename,url,"");
        }
        catch (e)
        {
            alert("感谢您光临本站\n\n\t您好，您的操作: 加入收藏 失败，请您使用Ctrl+D进行添加");
			return false;
        }
	}
	return true;
}

//document.getElementById的简写
function $(id)
{
	return document.getElementById(id);
}

//网页跳转
function tourl(url)
{
	window.location.href=url;
}

//设定多长时间运行某个动作脚本
function timeset(time,act)
{
	time = parseInt(time);
	if(time < 1)
	{
		return false;
	}
	else
	{
		if(time < 10)
		{
			time = time*1000;
		}
		window.setTimeout(act,time);
	}
}

//邮箱检测
function checkemail(email)
{
	if(email.search(/^\w+((-\w+)|(\.\w+))*\@\w+((-\w+)|(\.\w+))*\.\w+$/) != -1)
	{
		return true;
	}
	else
	{
		return false;
	}
}

/*调用flash代码*/
function flash(file,width,height,div_id)
{
	//----------插入flash代码
	var fcode = "";
	fcode += '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" ';
	fcode += 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,40,0" ';
	fcode += 'width="'+width+'" height="'+height+'">';
	fcode += '<param name="movie" value="'+file+'" type="application/x-shockwave-flash">';
	fcode += '<param name="wmode" value="transparent"><param name="quality" value="high">';
	fcode += '<embed src="'+file+'" wmode="transparent" quality="high" ';
	fcode += 'pluginspage="http://www.macromedia.com/go/getflashplayer" ';
	fcode += 'type="application/x-shockwave-flash" width="'+width+'" height="'+height+'">';
	fcode += '</embed></object>';
	if(div_id)
	{
		$(div_id).innerHTML = fcode;
	}
	else
	{
		document.write(fcode);
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
