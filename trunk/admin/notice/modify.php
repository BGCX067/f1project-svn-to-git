<?php
#=========================================================================================
#	Filename: admin/notice/modify.php
#	Note	: 编辑站内公告
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-8
#=========================================================================================
$id = intval($id);
if(!$id)
{
	Error("操作非法","admin.php?file=notice&act=list");
}
$C_Notice = $CF->build("notice");
$rs = $C_Notice->GetNotice("one","id='".$id."'");
$content = FckToHtml($rs["content"]);
$TPL->p("modify","notice");
?>