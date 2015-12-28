<?php
#=====================================================================
#	Filename: admin/open/viewpic.php
#	Note	: 图片预览
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$id = intval($id);
if(!$id)
{
	Error("参数传递错误！");
}
$C_Upfile = $CF->build("upfile");
$rs = $C_Upfile->GetUpfile("one","id='".$id."'");
if(strpos("jpg,gif,png",$rs["filetype"]) !== false)
{
	$ispicture = true;
}
else
{
	$ispicture = false;
}
if(!file_exists($rs["folder"].$rs["filename"]))
{
	Error("文件不存在！");
}
$qgfilename = $rs["folder"].$rs["filename"];
$thumb = $rs["thumbfile"] ? $rs["folder"].$rs["thumbfile"] : false;
$mark = $rs["markfile"] ? $rs["folder"].$rs["markfile"] : false;
$TPL->p("viewpic","open");
?>