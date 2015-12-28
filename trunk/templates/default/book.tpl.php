<?php if(!defined("PHPOK_SET")){exit("Access Denied");}?>
<!-- inc:inc.head2 -->
	<div id="content-layout">
		<div id="side">
		<h2 id="com" class="title">广物福昌</h2>
			<ul id="side-op">
				<li><a id="side-1"  href="driver.php" >试驾</a></li>
				<li><a id="side-2" class="on" href="book.php" >维修</a></li>
							
			</ul>
</div>

<div id="main">
			<ul id="quicklink">
				<script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','434','height','25','wmode','transparent','src','images/quicklink','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','images/quicklink' ); //end AC code
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
			<h1 id="abouttoyota" class="topbanner">广物福昌</h1>
			<div id="terrace"></div>
		  <div id="content">
		    <div align="center">
		      <table border="0" cellpadding="0" cellspacing="0" class="TableMain">
                <tr>
                  <td width="577" align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" class="ContentComFont">

<script type="text/javascript">
function qgcheckaddbook()
{
	var username = $("qgusername").value;
	var email = $("email").value;
	if(!username)
	{
		alert("姓名不能为空！");
		$("qgusername").focus();
		return false;
	}
	if(!email)
	{
		alert("邮箱不能为空！");
		$("email").focus();
		return false;
	}
	var str_reg=/^\w+((-\w+)|(\.\w+))*\@{1}\w+\.{1}\w{2,4}(\.{0,1}\w{2}){0,1}/ig;
	if (email.search(str_reg) == -1)
	{
		alert("邮箱格式正确！");
		$("email").value = "";
		$("email").focus();
		return false;
	}
	var subject = $("subject").value;
	if(!subject)
	{
		alert("主题不允许为空！");
		$("subject").focus();
		return false;
	}
	var content = $("content").value;
	if(!content)
	{
		alert("留言内容不允许为空！");
		return false;
	}
	$("qgsubmit").disabled = true;
	return true;
}
</script>


	<!-- $book_list AS $key=>$value -->
	<div class="global_sub"><div class="incbg">{:$value[user]} 先生/小姐 <span style="font-size:11px;">({:$value[postdate]})</span></div></div>
	<div class="border_no_top">
		<div style="padding:3px;">{:$value[content]}</div>
		<!-- if($value[reply]) -->
		<div style="padding:5px;">
			<div style="border:1px #D2DFE6 dashed;padding:5px;"><span style="color:red;">管理员回复：</span>{:$value[reply]}</div>
		</div>
		<!-- end -->
		<div align="right"><a href="#addbook" style="color:darkred;">感谢顾客支持!</a>&nbsp; &nbsp;</div>
	</div>
	<div class="space_between"><div class="space_between"></div></div>
	<!-- end -->

	<!-- if($pagelist) --><div align="right">{:$pagelist}</div><!-- end -->

	<!-- 发布新留言 -->
	<a name="addbook"></a>
	<div class="global_sub">添加新留言</div>
	<div class="border_no_top">
		<div>
		<table width="99%">
		<form method="post" action="book.php?act=addok" onsubmit="return qgcheckaddbook()">
		<!-- if($_SESSION["qg_sys_user"]) -->
		<input type="hidden" name="qgusername" id="qgusername" value="{:$_SESSION[qg_sys_user][user]}">
		<input type="hidden" name="email" id="email" value="{:$_SESSION[qg_sys_user][email]}">
		<tr>
			<td width="10%" align="right"><span style="color:red;">*</span> 姓名：</td>
			<td>{:$_SESSION[qg_sys_user][user]}</td>
		</tr>
		<!-- else -->
		<tr>
			<td width="15%" align="right"><span style="color:red;">*</span> 姓名：</td>
			<td><input type="text" name="qgusername" id="qgusername" /></td>
		</tr>
		<tr>
			<td align="right"><span style="color:red;">*</span> 邮箱：</td>
			<td><input type="text" name="email" id="email" /></td>
		</tr>
		<!-- end -->
		<tr>
			<td align="right"><span style="color:red;">*</span> 联系电话：</td>
			<td><input type="text" name="phone" id="phone" /></td>
		</tr>
		<tr>
			<td align="right"><span style="color:red;">*</span> 联系地址：</td>
			<td><input type="text" name="address" id="address" /></td>
		</tr>
		<tr>
			<td align="right">维修型号：</td>
			<td>
			<select name="subject">
			<option value="嘉年华" >嘉年华</option>
			<option value="福克斯" >福克斯</option>
			<option value="蒙迪欧-致胜" >蒙迪欧-致胜</option>
			<option value="S-MAX" >S-MAX</option>
			</select>
			</td>
		</tr>
		<tr>
			<td align="right"><span style="color:red;">*</span> 内容：</td>
			<td><textarea name="content" id="content" style="width:90%;height:100px;"></textarea></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="发表留言" class="button" /></td>
		</tr>
		</form>
		</table>
		</div>
	</div>

           <div align="left"></div></td>
                </tr>
                
                <tr>
                  <td align="center" class="ContentComFont">&nbsp;</td>
                </tr>
              </table>
		    </div>
		  </div>
		</div>
		<div id="custom-1"></div>
		<div id="custom-2"></div>
		<div id="custom-3"></div>
	</div>



<!-- inc:inc.foot2 -->