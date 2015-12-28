<?php
#=====================================================================
#	Filename: admin/picture/add.php
#	Note	: 添加图片操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=picture";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}
$C_Category = $CF->build("category");
$rslist = $C_Category->GetCategory("all","catetype='picture' AND ifcheck='1'");
if(!$rslist)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}
include_once(SYSTEM_ROOT."/class/catetree.php");
$CT = new CateTree($rslist);
$catelist = $CT->Tree();
if(count($catelist)<1)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}

$C_Msg = $CF->build("msg");
$C_Msg->set("condition","id='".$id."'");
$rs = $C_Msg->GetMsg("one");
$article = $C_Msg->GetMsgC($id);
$content = FckToHtml($article['content']);
$TPL->p("modify","picture");
?>