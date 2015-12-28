<?php
#=====================================================================
#	Filename: admin/adminer/setpassok.php
#	Note	: 更新管理员密码信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-03
#=====================================================================
$return_url = "admin.php?file=adminer&act=setpass";
$C_Admin = $CF->build("admin");

$old = $STR->safe($old);
$new = $STR->safe($new);
$chk = $STR->safe($chk);
if(!$old || !$new || !$chk)
{
	Error("所有加星号信息均必须填写",$return_url);
}
if($old == $new)
{
	Error("新旧密码是一致的！不需要修改",$return_url);
}
if($new != $chk)
{
	Error("不允许修改，两次密码输入不一致",$return_url);
}

$old_chk = md5($old);
if($old_chk != $_SESSION["admin"]["pass"])
{
	Error("旧密码信息不正确",$return_url);
}

$newpass = md5($new);
$rs = $C_Admin->PassAdmin($newpass,$_SESSION["admin"]["id"]);
if(!$rs)
{
	Error("管理员密码更新失败，请返回",$return_url);
}

#[更新session信息]
$rs = $C_Admin->GetAdmin("one","id='".$_SESSION["admin"]["id"]."'");
$_SESSION["admin"] = $rs;#[更新session信息]

Error("管理员密码更新成功，下次登录请使用新密码",$return_url);
?>