<?php
#=====================================================================
#	Filename: admin/attachments/list.php
#	Note	: 列表文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-28
#=====================================================================
$page_url = "admin.php?file=attachments&act=list";
$psize = 30;
$pageid = intval($pageid);
$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
#[显示图片列表]
$condition = "";
$keywords = $STR->safe($keywords);
if($keywords)
{
	$page_url .= "&keywords=".rawurlencode($keywords);
	$condition = " tmpname LIKE '%".$keywords."%'";
}
$C_Upfile = $CF->build("upfile");
$get_count = $C_Upfile->NumUpfile($condition);

$rslist = $C_Upfile->GetUpfile("list",$condition,$offset,$psize);
if(!$rslist)
{
	Error("暂时没有相关附件，请先上传","admin.php?file=attachments&act=upfiles");
}
$pagelist = page($page_url,$get_count,$psize,$pageid);#[获取页数信息]
$filelist = array();
foreach($rslist AS $key=>$value)
{
	$value["postdate"] = date("Y-m-d H:i:s",$value["postdate"]);#[上传时间]
	if(strtolower(substr($value["folder"],0,7)) != "http://" && file_exists($value["folder"].$value["filename"]))
	{
		$filesize = filesize($value["folder"].$value["filename"]);
		if($value["thumbfile"] && file_exists($value["folder"].$value["thumbfile"]))
		{
			$filesize += filesize($value["folder"].$value["thumbfile"]);
			$value["thumb"] = $value["folder"].$value["thumbfile"];
		}
		if($value["markfile"] && file_exists($value["folder"].$value["markfile"]))
		{
			$filesize += filesize($value["folder"].$value["markfile"]);
			$value["mark"] = $value["folder"].$value["markfile"];
		}
		$value["filesize"] = $STR->num_format($filesize);
		#[检测附件是否是图片]
		if(strpos("jpg,gif,png",substr($value["filename"],-3)) !== false)
		{
			$value["thumb"] = $value["thumb"] ? $value["thumb"] : ($value["mark"] ? $value["mark"] : $value["folder"].$value["filename"]);
			$piclist[] = $value;
		}
		else
		{
			$attlist[] = $value;
		}
	}
	else
	{
		$extlist[] = $value;
	}
}
$_SESSION["return_url"] = $page_url."&pageid=".$pageid;
$TPL->p("list","attachments");
?>