<?php
#[限制网页访问]
if(!defined("PHPOK_SET")){
	exit("Access Denied");
}
#[数据库信息]
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbData = "jj";

#[数据表前缀]
$prefix = "yui_";
$dbType = "mysql";

#[是否启用调试]
$viewbug = false;

#[是否启用伪静态页功能，使用为true，不使用为false]
$urlRewrite = true;

#[后台是否启用验证码功能，使用为true，不使用为false]
$isCheckCode = true;
?>