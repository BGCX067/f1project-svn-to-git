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

#[获取内容]
$r_url = "admin.php?file=notice&act=modify&id=".$id;
$array["subject"] = $STR->safe($subject) ? $STR->safe($subject) : Error("公告标题不能为空",$r_url);
$array["url"] = $STR->safe($notice_url);
$array["style"] = $STR->safe($style);
$array["content"] = $STR->html($content);
$array["postdate"] = $postdate ? strtotime($postdate) : $rs["postdate"];

if(!$array["url"] && !$array["content"])
{
	Error("网址或内容必须有一个不能为空",$r_url);
}

$status = $C_Notice->SetNotice($array,$id);
$status ? Error("公告更新成功","admin.php?file=notice&act=list") : Error("公告更新不成功",$r_url);
?>