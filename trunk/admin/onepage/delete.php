<?php
#=====================================================================
#	Filename: admin/onepage/delete.php
#	Note	: 删除分类操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=onepage&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Onepage = $CF->build("onepage");
$rs = $C_Onepage->GetOnepage("one","id='".$id."'");
if(!$rs)
{
	Error("找不到相关数据",$r_url);
}
$C_Onepage->DelOnepage($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>