<?php
#=====================================================================
#	Filename: admin/notice/add.php
#	Note	: 添加站内公告
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-06
#=====================================================================
$r_url = "admin.php?file=notice&act=add";
$array["subject"] = $STR->safe($subject) ? $STR->safe($subject) : Error("公告标题不能为空",$r_url);
$array["url"] = $STR->safe($notice_url);
$array["style"] = $STR->safe($style);
$array["content"] = $STR->html($content);
$array["postdate"] = $postdate ? strtotime($postdate) : $system_time;

if(!$array["url"] && !$array["content"])
{
	Error("网址或内容必须有一个不能为空",$r_url);
}

$C_Notice = $CF->build("notice");
$id = $C_Notice->SetNotice($array);
$id ? Error("公告添加成功","admin.php?file=notice&act=list") : Error("公告添加不成功",$r_url);
?>