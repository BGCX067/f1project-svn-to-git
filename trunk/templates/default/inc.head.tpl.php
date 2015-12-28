<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{:$site_title}<!-- if($system[seotitle]) --> - {:$system[seotitle]}<!-- end --></title>
<meta name="keywords" content="{:$system[keywords]}">
<meta name="description" content="{:$system[description]}">

<script type="text/javascript" src="images/base.js"></script>
<script src="images/ac_runactivecontent.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="images/main.css" media="screen" charset="utf-8" />


<style>
#board {
	background-image: url(images/board-bg.gif);
	height: 152px;
	font-size: 12px;
	color: #6e6e6e;
	position: relative;
	top: 0;
	background-repeat: no-repeat;
	background-position: center top;
}
#board a {
	color: #6e6e6e;
}
#board a:hover {
	text-decoration: underline;
}
#col-3-1 {
	width: 248px;
	float: left;
	position: relative;
}
#col-3-2 {
	width: 264px;
	float: left;
	position: relative;
}
#col-3-3 {
	width: 446px;
	float: left;
	position: relative;
}
#news-home {
	margin: 35px 0 0 15px;
}
#events-home {
	margin: 32px 0 0 10px;
}
#events-home li {
	clear: both;
}
#events-home img {
	margin: 0 5px 0 0;
	float: left;
}
#events-home a {
	font-size: 13px;
	color: #535353;
	font-weight: bold;
}
#events-home p {
	margin: 2px 0 0 0;
	line-height: 150%;
}
.more {
	float: left;
	text-indent: -20000em;
	width: 40px;
	height: 15px;
	position: absolute;
	top: 11px;
	left: 200px;
}
#col-3-2 .more {
	left: 215px;
}
#col-3-3 .more {
	left: 245px;
}
#dealers-home { width: 146px; height: 21px; float: left; text-indent: -20000em; position: absolute; background-image: url(images/dealers-locator.jpg); background-repeat: no-repeat; top: 10px; left: 295px; z-index: 100; display: block; line-height: 21px; text-align: center; }
#dealers-home:hover { background-position: 0 -21px; }

#dealers-home li ul { display: none; }

#vehicles-direct { width: 120px; height: 120px; position: absolute; top: 32px; left: 326px; z-index: 50; }
#vehicles-direct li { width: 120px; float: left; clear: both; }
#vehicles-direct a { width: 120px; height: 30px; display: block; float: left; text-indent: -20000em; background-image: url(images/vehicles-direct-menu.jpg); }
#vd-1 { background-position: 0 0; }
#vd-1:hover, #vd-1.on { background-position: 0 -120px;; }
#vd-2 { background-position: 0 -30px; }
#vd-2:hover, #vd-2.on { background-position: 0 -150px;; }
#vd-3 { background-position: 0 -60px; }
#vd-3:hover, #vd-3.on { background-position: 0 -180px;; }
#vd-4 { background-position: 0 -90px; }
#vd-4:hover, #vd-4.on { background-position: 0 -210px;; }

#vehicles-direct-pic { width: 330px; height: 120px; position: absolute; left: 1px; top: 32px; background-image: url(images/vehicles-direct-pic.jpg); }
.vd-1 { background-position: 0 0; }
.vd-2 { background-position: 0 -120px; }
.vd-3 { background-position: 0 -240px; }
.vd-4 { background-position: 0 -360px; }

</style>

</head>

<body>
<div id="layout">
<div id="head"><a id="logo" href="/">广物福昌</a>
<div class="menu">
			<ul>			
				<li ><a href="home.php">首页<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				<li><a href="special.php/18.html">福昌之窗<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
					<li><a href="special.php/2.html" title="公司介绍">公司介绍</a></li>
					<li><a href="special.php/15.html" title="企业荣誉">企业荣誉</a></li>
					<li><a href="special.php/3.html" title="团队活动">团队活动</a></li>
					</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				<li><a href="list.php/1.html">新闻中心<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
					<li><a href="list.php/1.html" title="最新资讯">最新消息</a></li>
					<li><a href="list.php/5-1.html" title="活动快讯">活动快讯</a></li>
					</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				<li><a href="special.php/23.html">产品展示<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
					<li><a href="special.php/20.html" title="嘉年华">嘉年华</a></li>
					<li><a href="special.php/21.html" title="福克斯">福克斯</a></li>
					<li><a href="special.php/22.html" title="蒙迪欧-致胜">蒙迪欧-致胜</a></li>
					<li><a href="special.php/23.html" title="S-MAX">S-MAX</a></li>
					</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				<li><a href="special.php/19.html">招贤纳士<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>
				
				
				<li><a href="special.php/16.html">尊贵服务<!--[if IE 7]><!--></a><!--<![endif]-->
				<!--[if lte IE 6]><table><tr><td><![endif]-->
					<ul>
					<li><a href="special.php/12.html" title="购车服务">购车服务</a></li>
					<li><a href="special.php/11.html" title="保险理赔">保险理赔</a></li>
					<li><a href="special.php/10.html" title="售后服务">售后服务</a></li>
					</ul>
				<!--[if lte IE 6]></td></tr></table></a><![endif]-->
				</li>				
			</ul>
</div>

</div>