<?php
#============================
#	Filename: notice.qgmod.php
#	Note	: 公告模块
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-3-25
#============================
global $FS,$DB,$prefix;
global $CF,$STR;
$md5 = substr(md5($title_length."_".$msg_length."_".$limit),9,24);
$cache_file = "data/cache/notice_".$md5.".php";
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);
}
if($check_status)
{
	include($cache_file);
	return $notice;
}
$C_Notice = $CF->build("notice");
$limit = $limit>0 ? $limit : 10;
$rslist = $C_Notice->GetNotice("list","",0,$limit);
if(!$rslist)
{
	return false;
}
foreach($rslist AS $key=>$value)
{
	$value["target"] = $value["url"] ? " target='_blank'" : "";
	if($value["content"])
	{
		$value["content"] = preg_replace("/<.*?>/is","",$value["content"]);
		if($value["content"] && $msg_length>0)
		{
			$value["content"] = $STR->cut($value["content"],$msg_length,"……");
		}
	}
	else
	{
		$value["content"] = $value["url"] ? $value["url"] : "";
	}
	$value["cut_subject"] = $title_length>0 ? $STR->cut($value["subject"],$title_length,"…") : $value["subject"];
	$value["url"] = $value["url"] ? $value["url"] : "notice.php#".$value["id"];
	$notice[] = $value;
}
unset($rslist);
if($notice)
{
	$FS->Write($notice,$cache_file,"notice");
}
return $notice;
?>