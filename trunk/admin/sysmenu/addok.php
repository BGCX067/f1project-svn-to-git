<?php
#==================================================================================================
#	Filename: admin/sysmenu/addok.php
#	Note	: 添加菜单权限
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-12
#==================================================================================================
$r_url = "admin.php?file=sysmenu&act=add";
$msg["name"] = $name ? $STR->safe($name) : Error("名称不允许为空",$r_url);

$C_Sysmenu = $CF->build("sysmenu");
#[显示父级分类]
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
#[更新数据]

$C_Sysmenu->SetSysmenu($msg) ? Error("菜单添加成功，要看到效果请刷新整页",$r_url) : Error("添加失败",$r_url);
?>