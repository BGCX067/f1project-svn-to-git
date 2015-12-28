<?php if(!defined("PHPOK_SET")) exit("Powered By PhpOk.Com");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{:$system[sitename]}</title>
<meta name="keywords" content="{:$system[keywords]},qinggan,phpok">
<meta name="description" content="{:$system[description]} - PHPOK.COM">
<link rel="stylesheet" type="text/css" href="images/css.css" />
<script type="text/javascript" src="images/js.js"></script>
</head>
<body>
<div align="center">
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div>&nbsp;</div>
	<div class="error">
		<div>{:$error_msg}</div>
		<!-- if($error_url) -->
		<div class="space_between"></div>
		<div class="space_between"></div>
		<div><a href="{:$error_url}">如果您的网站无法在 <span style="color:red;font-weight:bold;">{:$error_time}</span> 后跳转，请点这里</a></div>
		<!-- end -->
	</div>
</div>
<!-- if($error_url && $error_time && $error_time != 0) -->
<script type="text/javascript">
var href="{:$error_url}";
timeset("{:$error_time}","tourl('"+href+"')");
</script>
<!-- end -->
</body>
</html>