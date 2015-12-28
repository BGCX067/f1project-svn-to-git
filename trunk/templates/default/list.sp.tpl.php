<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head3 -->

<div id="content-layout">
		<div id="side">
			<h2 id="news" class="title">新闻中心</h2>
			<ul id="side-news">
				<li><a id="side-1" class="on" href="list.php/5-1.html">活动快讯</a></li>
				<li><a id="side-2"  href="list.php/1.html"">最新消息</a></li>
			</ul>
		</div>
			<div id="main">
			<ul id="quicklink">
				<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','434','height','25','wmode','transparent','src','../images/quicklink','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','../images/quicklink' ); //end AC code
</script>
			<noscript>
			<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="434" height="25">
				<param name="movie" value="../images/quicklink.swf" />
				<param name="quality" value="high" />
				<param name="wmode" value="transparent" />
				<embed wmode="transparent" src="../images/quicklink.swf" width="434" height="25" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>
			</object>
			</noscript>
			</ul>
			<h1 id="event" class="topbanner">活动快讯</h1>
			<div id="terrace"></div>
		  <div id="content">
		    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="TableMain">
		     <!-- $msglist AS $key=>$value -->
		    <tr>
                <td width="100"><img src="{:$value[thumb]}" alt="" width="167" height="53" /></td>
                <td width="470" background="images/news/bg.gif" class="ContentComFont">&nbsp;&nbsp;&nbsp;&nbsp;  <a href="msg.php?id={:$value[id]}" title="{:$value[subject]}" style="{:$value[style]}"><strong>{:$value[cut_subject]}</strong></a></td>
                <td width="101" background="images/news/bg.gif" class="ContentComFont">{:$value[postdate]}</td>
                <td width="4"><img src="images/news/bottom.gif" alt="" width="9" height="53" /></td>
              </tr>
              <tr background="images/news/bg.gif">
			  
                <td height="25" colspan="4"><img src="images/news/line.gif" alt="" width="666" height="4" /></td>
              </tr>
		    <!-- end -->
     		
			</table>
			<br>
                <div align="center">{:$pagelist}</div> 		 
			</div>
		</div>
		<div id="custom-1"></div>
		<div id="custom-2"></div>
		<div id="custom-3"></div>
	</div>
			
<!-- inc:inc.foot2 -->