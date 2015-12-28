<?php
#============================
#	Filename: admin/iframe/fckupfile.ok.php
#	Note	: Fck附件上传管理
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-04-22
#============================
$input_name = $STR->safe($input_name);
if(!$input_name)
{
	$input_name = "content";
}
$system_url = GetSystemUrl();
$tmpname = $UP->Name("upfile_id");#[客户端文件名]
$filename = $UP->Up("upfile_id");
if(!$filename)
{
	$TPL->p("uperror","iframe");
	exit;
}
$mypath = $UP->GetPath();
if(strpos(",jpg,gif,png,",",".substr($filename,-3).",") !== false)
{
	#[获取当前服务器信息]
	$thumbfile = $GD->thumb($mypath.$filename);
	$markfile = $GD->mark($mypath.$filename);
	$ispic = true;
}
else
{
	$thumbfile = "";
	$markfile = "";
	$ispic = false;
}
$filetype = $UP->FileType($filename);
$array["filetype"] = $filetype;
$array["tmpname"] = $tmpname;
$array["filename"] = $filename;
$array["folder"] = $mypath;
$array["postdate"] = $system_time;
$array["thumbfile"] = $thumbfile;
$array["markfile"] = $markfile;

$C_Upfile = $CF->build("upfile");
$insert_id = $C_Upfile->SetUpfile($array);
if($ispic)
{
	$msg = "<img src='".$system_url.$mypath.$filename."' border='0'>";
}
else
{
	$msg = "<a href='dfile.php?id=".$insert_id."'>点此下载附件</a>";
}

$TPL->p("fckupfile.ok","iframe");
exit;
?>