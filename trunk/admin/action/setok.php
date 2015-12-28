<?php
#=====================================================================
#	Filename: admin/action/setok.php
#	Note	: 更新操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-07
#=====================================================================
$id = intval($id);
$msg["filename"] = $STR->safe($i_filename);
$msg["action"] = $STR->safe($action);
$msg["name"] = $STR->safe($name);
$C_Action = $CF->build("action");
$r_url = "admin.php?file=action&act=set&filename=".$msg["filename"];
if($id)
{
	$C_Action->SetAction($msg,$id) ? Error("更新权限成功",$r_url) : Error("更新权限失败",$r_url);
}
else
{
	$C_Action->SetAction($msg) ? Error("添加权限成功",$r_url) : Error("添加权限失败",$r_url);
}
?>