<?php
#=====================================================================
#	Filename: admin/onepage/modify.php
#	Note	: 单页面信息编辑
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=onepage";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}

$C_Onepage = $CF->build("onepage");
$C_Onepage->set("condition","id='".$id."'");
$rs = $C_Onepage->GetOnepage("one");
if(!$rs)
{
	Error("找不到相关数据",$r_url."&act=list");
}
$fckeditor = FckEditor("content",FckToHtml($rs["content"]),"default","370px","680px");
$C_Onepage->set("condition","");
$grouplist = $C_Onepage->GetOnegroup("all");

$TPL->p("modify","onepage");
?>