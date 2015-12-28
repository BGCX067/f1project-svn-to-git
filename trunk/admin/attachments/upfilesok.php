<?php
#=====================================================================
#	Filename: admin/attachments/upfilesok.php
#	Note	: ˵���ĵ�
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#=====================================================================
#[�����ϴ�]
include(SYSTEM_ROOT."/class/xu.php");
$myUpload = new XUpload_class;

$myUpload->SetOverlayMode(true); // ����ͬ���ļ�
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
			#[��������ͼ]
			$thumbfile = $GD->thumb($mypath.$filename);
			#[����ˮӡͼ]
			$markfile = $GD->mark($mypath.$filename);
		}
		else
		{
			$thumfile = "";
			$markfile = "";
		}

		$tmpname = $tmpname ? $tmpname : $filename;
		#[��tmp��ϢתΪUTF8����]
		$tmpname = $STR->charset($tmpname,"gbk","utf-8");
		$filetype_array = explode(".",$filename);
		$filetype_count = count($filetype_array);
		$filetype = strtolower($filetype_array[$filetype_count-1]);
		#[�����ʱ����]
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