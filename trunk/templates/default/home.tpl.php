<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head -->

	<div id="content-layout" class="home">
		<ul id="quicklink">
			<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','434','height','25','wmode','transparent','src','../images/quicklink','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','images/quicklink' ); //end AC code
</script>
			<noscript>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="434" height="25">
				<param name="movie" value="../images/quicklink.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<embed wmode="transparent" src="images/quicklink.swf" width="434" height="25" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>
			</object>
			</noscript>
		</ul>
		<div>
			<img src="images/index.jpg"> 
		</div>
		<div id="board">
			<div id="col-3-1">
				<ul id="news-home">
				<!-- run:$list = QGMOD_MSGLIST(1,"32","new","3") -->

				<!-- $list[msglist] AS $key=>$value -->
				
							      <li>{:$value[postdate]}<br />
&nbsp;&nbsp;&nbsp;<a href="{:$value[url]}"{:$value[target]}">{:$value[cut_subject]}</a></li>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="3"></td>
  </tr>
</table>
<!-- end -->
						     
							</ul>
	<!-- run:unset($msglist) -->
	
				<a class="more" href="list.php/1.html">更多</a> </div>
			<div id="col-3-2">
				<ul id="events-home">
			<!-- run:$list = QGMOD_MSGLIST(6,"22","new","2") -->
			<!-- $list[msglist] AS $key=>$value -->
                <li ><a href="{:$value[url]}"{:$value[target]}"><img src="images/news/img-car4.jpg" alt="" />{:$value[cut_subject]}</a></li>
                <p>{:$value[clou]}</p>
                <!-- end -->
				</ul>
				<a class="more" href=list.php/5-1.html"">更多</a> </div>
			<div id="col-3-3">
				<a id="dealers-home" href="special.php/23.html">- 经销商所在城市 -</a>
				<div id="vehicles-direct-pic"></div>
				<ul id="vehicles-direct">
					<li><a id="vd-1" href="special.php/20.html">嘉年华</a></li>
					<li><a id="vd-2" href="special.php/21.html">福克斯</a></li>
					<li><a id="vd-3" href="special.php/22.html">蒙迪欧-致胜</a></li>
					<li><a id="vd-4" href="special.php/23.html">s-max</a></li>
				</ul>
				<a class="more" href="#">更多</a> </div>
		</div>
	</div>
	<div id="foot">
		<ul id="foot-menu">
			<li class="first"><a href="index.php">首页</a></li>
			<li><a href="http://www.ford.com.cn/servlet/ContentServer?pagename=DFY/CN" target="_blank">福特中国</a></li>
			<li><a href="http://www.gdqc.com.cn/" target="_blank">广物汽贸</a></li>
			<li><a href="index.php" target="_blank">广物福昌</a></li>
			<li><a href="">联系我们</a></li>
			<li><a href="">隐私政策声明</a></li>
			<li class="last"><a href="">网站地图</a></li>
			<li class="dropdown"><a href="#">- 相关链接 -</a>
				<ul>
					<li><a href="http://www.ford.com.cn/servlet/ContentServer?cid=1178860906492&pagename=Page&site=FCN&c=DFYPage" target="_blank">嘉年华</a></li>
					<li><a href="http://www.ford-focus.com.cn/" target="_blank">福克斯</a></li>
					<li><a href="http://www.fordmondeo.com.cn/" target="_blank">蒙迪欧-致胜</a></li>
					<li><a href="http://www.fords-max.com.cn/" target="_blank">s-max</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<script>
	var vd = document.getElementById("vehicles-direct");
	var vdpic = document.getElementById("vehicles-direct-pic");
	var vdlinks = vd.getElementsByTagName("a");
	for (i=0; i<vdlinks.length; i++) {
		vdlinks[i].onmouseover=function() {
			vdpic.className = this.id;
			this.className = "on";
		}
		vdlinks[i].onmouseout=function() {
			this.className = "";
		}
	}
</script>


<!-- inc:inc.foot -->
