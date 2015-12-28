<?php
#=====================================================================
#	Filename: admin/open/upok.php
#	Note	: 上传附件动作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-03
#=====================================================================
$r_url = rawurldecode($STR->safe($return_url));
$C_Upfile = $CF->build("upfile");
$tmpname = $UP->name("upfilename");#[客户端文件名]
$filename = $UP->up("upfilename",$system_time);
if(!$filename)
{
	Error("上传附件失败，请检查……",$r_url);
}
$array["filetype"] = $UP->FileType($filename);#[文件类型]
$array["tmpname"] = $tmpname;#[文件名称]
$array["filename"] = $filename;#[文件]
$array["folder"] = $UP->getpath();
$array["thumbfile"] = $array["markfile"] = "";#[初始缩略图及水印图的初始值]
if(strpos("jpg,gif,png",$array["filetype"]) !== false)
{
	#[生成缩略图及水印图]
	$array["thumbfile"] = $GD->thumb($array["folder"].$filename);
	$array["markfile"] = $GD->mark($array["folder"].$filename);
}
$array["postdate"] = $system_time;
$C_Upfile->SetUpfile($array);
Error("文件上传成功",$r_url);
?>