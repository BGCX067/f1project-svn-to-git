<?php
#=====================================================================
#	Filename: admin/attachments/upfilesok.php
#	Note	: 说明文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#=====================================================================
#[附件上传]
include(SYSTEM_ROOT."/class/xu.php");
$myUpload = new XUpload_class;

$myUpload->SetOverlayMode(true); // 覆盖同名文件
$myUpload->InitParameters();

if ($myUpload->IsUploadFile())
{
	$filename = $myUpload->CreateFileName("./upfiles/xu_temp","",$_POST['xu_filename']);

	if ($filename != "")
	{
		$filename = $myUpload->SaveToFile($filename);
	}
}
$C_Upfile = $CF->build("upfile");
$list = array();
$list = $FS->Dir("upfiles/xu_temp/");
foreach($list AS $key=>$value)
{
	$value = trim($value);
	if($value)
	{
		$tmpname = basename($value);
		$extfile = substr($value,-3);
		$extfile = strtolower($extfile);
		if($extfile == ".gz")
		{
			$extfile = "tar.gz";
		}

		$filename = $system_time."_".rand(0,100).".".$extfile;
		$mypath = "upfiles/".date("Ym/d/",$system_time);

		$FS->Move($value,$mypath.$filename);

		if(strpos("jpg,gif,png",$extfile) !== false)
		{
			#[生成缩略图]
			$thumbfile = $GD->thumb($mypath.$filename);
			#[生成水印图]
			$markfile = $GD->mark($mypath.$filename);
		}
		else
		{
			$thumfile = "";
			$markfile = "";
		}

		$tmpname = $tmpname ? $tmpname : $filename;
		#[将tmp信息转为UTF8编码]
		$tmpname = $STR->charset($tmpname,"gbk","utf-8");
		$filetype_array = explode(".",$filename);
		$filetype_count = count($filetype_array);
		$filetype = strtolower($filetype_array[$filetype_count-1]);
		#[组成临时数组]
		$tmp_array = array();
		$tmp_array["filetype"] = $filetype;
		$tmp_array["tmpname"] = $tmpname;
		$tmp_array["filename"] = $filename;
		$tmp_array["folder"] = $mypath;
		$tmp_array["postdate"] = $system_time;
		$tmp_array["thumbfile"] = $thumbfile;
		$tmp_array["markfile"] = $markfile;
		$C_Upfile->SetUpfile($tmp_array);
	}
}

$myUpload->Out("PHPOK!");
exit;
?>