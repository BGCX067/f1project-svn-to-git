<?php
#=========================================================================================
#	Filename: admin/notice/delete.php
#	Note	: 删除站内公告
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

$tishi_msg = $C_Notice->DelNotice($id) ? "公告删除成功" : "公告删除失败";
Error($tishi_msg,"admin.php?file=notice&act=list");
?>