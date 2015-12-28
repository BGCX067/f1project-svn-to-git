<?php
#==================================================================================================
#	Filename: admin/sysmenu/modifyok.php
#	Note	: 添加菜单权限
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#==================================================================================================
$C_Sysmenu = $CF->build("sysmenu");
$r_url = "admin.php?file=sysmenu";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=index");
}

$msg["name"] = $STR->safe($name);
if(!$msg["name"])
{
	Error("名称不能为空",$r_url."&act=modify&id=".$id);
}

$parentid = intval($parentid);
if($parentid)
{
	$rs = $C_Sysmenu->GetSysmenu("one","id='".$parentid."'");
	$msg["rootid"] = $rs["rootid"] ? $rs["rootid"] : $parentid;
	$msg["parentid"] = $rs["rootid"] ? $parentid : 0;
}
else
{
	$msg["rootid"] = 0;
	$msg["parentid"] = 0;
}

$msg["menu_url"] = $STR->safe($menu_url);
$msg["taxis"] = intval($taxis);
$msg["status"] = intval($status);
$C_Sysmenu->SetSysmenu($msg,$id) ? Error("操作成功，要看到整页效果，请刷新后台",$r_url."&act=index") : Error("更新失败",$r_url."&act=modify&id=".$id);
?>