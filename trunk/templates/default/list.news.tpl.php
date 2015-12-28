<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head3 -->

<div id="content-layout">
		<div id="side">
			<h2 id="news" class="title">新闻中心</h2>
			<ul id="side-news">
				<li><a id="side-1"  href="list.php/5-1.html">活动快讯</a></li>
				<li><a id="side-2" class="on" href="list.php/1.html"">最新消息</a></li>
			</ul>
		</div>
		<div id="main">
			<ul id="quicklink">
				<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','434','height','25','wmode','transparent','src','../images/quicklink','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','../images/quicklink' ); //end AC code
</script>
			<noscript>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="434" height="25">
				<param name="movie" value="images/quicklink.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<embed wmode="transparent" src="images/quicklink.swf" width="434" height="25" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>
			</object>
			</noscript>
			</ul>
			<h1 id="lastnews" class="topbanner">活动快讯</h1>
			<div id="terrace"></div>
		  <div id="content">
		    <ul id="newslist">
		    		  <!-- $msglist AS $key=>$value -->
						      <li><a href="msg.php?id={:$value[id]}" title="{:$value[subject]}" style="{:$value[style]}">{:$value[cut_subject]}　{:$value[postdate]}</a></li>
						     		<!-- end -->
               
                
                 </ul>
                 <br>
                <div align="center">{:$pagelist}</div> 
			</div>
		</div>
		<div id="custom-1"></div>
		<div id="custom-2"></div>
		<div id="custom-3"></div>
		
	</div>
			
<!-- inc:inc.foot2 -->