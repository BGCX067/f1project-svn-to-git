<?php
#=====================================================================
#	Filename: admin/onepage/groupdel.php
#	Note	: 删除组操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-8-24
#=====================================================================
$r_url = "admin.php?file=onepage&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Onepage = $CF->build("onepage");
$C_Onepage->set("condition","groupid='".$id."'");
$rs = $C_Onepage->GetOnepage("one");
if($rs)
{
	Error("组已经存在内容，请返回……",$r_url);
}
$C_Onepage->Set("table",$prefix."onegroup");
$C_Onepage->DelOnegroup($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>