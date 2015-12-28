<?php
#=====================================================================
#	Filename: admin/attachments/linkok.php
#	Note	: 添加附件数据入库
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$r_url = "admin.php?file=attachments&act=link";
$tmpname = $STR->safe($tmpname);
$fold_file = $STR->safe($fold_file);
$filename = basename($fold_file);
if(!$tmpname || !$fold_file || !$filename)
{
	Error("信息不完整",$r_url);
}

#[判断后面三位或是后六位]
$ext = strtolower(substr($tmpname,-3));
$ext_f = strtolower(substr($filename,-3));
$ext_f = $ext == ".gz" ? "tar.gz" : $ext;
$tmpname = $ext_f != $ext ? $tmpname.".".$ext_f : $tmpname;

#[禁用添加带脚本的文件，如果要取消该功能，可以去掉此判断]
if(strpos(",php,.js,asp,jsp,.py,asa,htm,tml,tmp,",$ext_f) !== false)
{
	Error("禁止添加脚本文件，这可能会给您带来安全问题",$r_url);
}

$mypath = str_replace($filename,"",$fold_file);
if(strtolower(substr($mypath,0,7)) != "http://")
{
	$mypath = "upfiles/".$mypath;
}
$postdate = $postdate ? strtotime($postdate) : $system_time;
#[取得文件类型]
$filetype_array = explode(".",$filename);
$filetype_count = count($filetype_array);
$filetype = strtolower($filetype_array[$filetype_count-1]);

#[组成数组]
$array["filetype"] = $filetype;
$array["tmpname"] = $tmpname;
$array["filename"] = $filename;
$array["folder"] = $mypath;
$array["postdate"] = $postdate;


#[将信息写入数据库中]
$C_Upfile = $CF->build("upfile");
$status = $C_Upfile->SetUpfile($array) ? "添加成功" : "添加失败";
Error($status,$r_url);
?>