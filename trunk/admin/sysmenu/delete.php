<?php
#==================================================================================================
#	Filename: admin/sysmenu/delete.php
#	Note	: 删除菜单操作，有子菜单时删除是失败的
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-07
#==================================================================================================
$r_url = "admin.php?file=sysmenu&act=index";
$id = intval($id);
if(!$id)
{
	Error("操用非法",$r_url);
}
$C_Sysmenu = $CF->build("sysmenu");
$rs = $C_Sysmenu->GetSysmenu("one","rootid='".$id."' OR parentid='".$id."'");
if($rs)
{
	Error("当前菜单存在子菜单信息，不允许删除",$r_url);
}
$C_Sysmenu->DelSysmenu($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>