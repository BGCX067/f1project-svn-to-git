<?php
#=====================================================================
#	Filename: admin/category/delete.php
#	Note	: 删除分类操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=category&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Category = $CF->build("category");
$rs = $C_Category->GetCategory("one","id='".$id."'");
if(!$rs)
{
	Error("找不到相关数据",$r_url);
}
$C_Msg = $CF->build("msg");
$condition = "cateid='".$id."'";
$C_Msg->Set("condition",$condition);
$msglist = $C_Msg->GetMsg("one");
if($msglist)
{
	Error("当前分类已有信息，不允许删除",$r_url);
}

#[如果存在子分类]
$sonCate = $C_Category->GetCategory("one","parentid='".$id."' OR rootid='".$id."'");
if($sonCate)
{
	Error("当前分类存在子分类，不允许删除",$r_url);
}

$C_Category->DelCategory($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>