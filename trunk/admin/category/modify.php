<?php
#=====================================================================
#	Filename: admin/category/modify.php
#	Note	: 分类信息编辑
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=category";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}

$C_Category = $CF->build("category");
$rs = $C_Category->GetCategory("one","id='".$id."'");
if(!$rs)
{
	Error("找不到相关数据",$r_url."&act=list");
}
#[得到类别]
$catetype = $rs["catetype"];
$rslist = $C_Category->GetCategory("all","catetype='".$catetype."' AND id!='".$id."' AND ifcheck='1'");
if($rslist)
{
	include_once(SYSTEM_ROOT."/class/catetree.php");
	$CT = new CateTree($rslist);
	$catelist = $CT->Tree();
}

$TPL->p("modify","category");
?>