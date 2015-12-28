<?php
#=====================================================================
#	Filename: admin/book/delete.php
#	Note	: 删除留言操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================

$r_url = "admin.php?file=driver&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Driver = $CF->build("driver");

$rs = $C_Driver->GetBook("one","id='".$id."'");

if(!$rs)
{
	Error("找不到相关数据",$r_url);
}
$C_Driver->DelBook($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>