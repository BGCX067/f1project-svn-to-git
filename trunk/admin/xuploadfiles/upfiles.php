<?php
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
$list = array();
$list = $FS->Dir("upfiles/xu_temp/");
$return_msg = "";
$system_url = GetSystemUrl();
$C_Upfile = $CF->build("upfile");
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
			$thispic = true;
		}
		else
		{
			$thumfile = "";
			$markfile = "";
			$thispic = false;
		}

		$tmpname = $tmpname ? $tmpname : $filename;
		$filetype = $UP->FileType($filename);
		$array["filetype"] = $filetype;
		$array["tmpname"] = $tmpname;
		$array["filename"] = $filename;
		$array["folder"] = $mypath;
		$array["postdate"] = $system_time;
		$array["thumbfile"] = $thumbfile;
		$array["markfile"] = $markfile;
		$insert_id = $C_Upfile->SetUpfile($array);
		if($thispic)
		{
			$return_msg .= "<div><img src='".$system_url.$mypath.$filename."' border='0'></div>";
		}
		else
		{
			$return_msg .= "<div><a href='dfile.php?id=".$insert_id."'>点此下载文件</a></div>";
		}
	}
}
$return_msg = $return_msg ? $return_msg : "OK";
$myUpload->Out($return_msg);
exit;
?>