<?php
#=====================================================================
#	Filename: admin/attachments/delete.php
#	Note	: 删除图片
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$r_url = $_SESSION["return_url"] ? $_SESSION["return_url"] : "admin.php?file=attachments&act=list";
$id = $STR->safe($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$condition = "id IN(".$id.")";
$C_Upfile = $CF->build("upfile");
$rslist = $C_Upfile->GetUpfile("all",$condition);
if(!$rslist)
{
	Error("没有找到相关资源",$r_url);
}
foreach($rslist AS $key=>$value)
{
	if($value["filename"])
	{
		$FS->Delete($value["folder"].$value["filename"]);
	}
	if($value["thumbfile"])
	{
		$FS->Delete($value["folder"].$value["thumbfile"]);
	}
	if($value["markfile"])
	{
		$FS->Delete($value["folder"].$value["markfile"]);
	}
	$C_Upfile->DelUpfile($value["id"]);
}
Error("附件删除成功",$r_url);
?>