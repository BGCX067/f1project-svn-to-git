<?php
#=====================================================================
#	Filename: admin/attachments/upfiles.ok.php
#	Note	: 附件上传并写入文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$up_array = array(1,2,3,4,5);
$C_Upfile = $CF->build("upfile");
foreach($up_array AS $key=>$value)
{

	$tmpname = $UP->name("iframeUpload_".$value);#[客户端文件名]
	$setname = $STR->safe($_POST["setname_".$value]);#[设置名称]
	$filename = $UP->up("iframeUpload_".$value,$system_time."_".$value);
	if($filename)
	{
		$extfile = strtolower(substr($filename,-3));
		if($extfile)
		{
			if(strpos($system["filestype"],$extfile) === false)
			{
				if($filename)
				{
					$FS->Delete($mypath.$filename);
				}
				Error("请不要上传不支持的附件格式","admin.php?file=attachments&act=upfiles");
			}
		}
		else
		{
			if($filename)
			{
				$FS->Delete($mypath.$filename);
			}
			Error("附件不允许为空！","admin.php?file=attachments&act=upfiles");
		}
		if($setname)
		{
			if($extfile == ".gz")
			{
				$tmpname = $setname.".tar.gz";
			}
			else
			{
				$tmpname = $setname.".".$extfile;
			}
		}
		else
		{
			$tmpname = $filename;
		}
		#[获取当前服务器信息]
		$mypath = $UP->getpath();
		if($filename)
		{
			if(strpos("jpg,gif,png",$extfile) !== false)
			{
				$thumbfile = $GD->thumb($mypath.$filename);
				$markfile = $GD->mark($mypath.$filename);
			}
			else
			{
				$thumfile = "";
				$markfile = "";
			}
			$filetype_array = explode(".",$filename);
			$filetype_count = count($filetype_array);
			$filetype = strtolower($filetype_array[$filetype_count-1]);
			#[上传的文件写入数据库中]
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
}
Error("附件上传成功！","admin.php?file=attachments&act=upfiles");
?>