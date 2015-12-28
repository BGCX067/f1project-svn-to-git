<?php
#============================
#	Filename: link.qgmod.php
#	Note	: 友情链接模块
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-08-27
#============================
global $FS,$DB,$prefix;
global $CF,$STR;
$groupid = intval($groupid);
if(!$groupid)
{
	return false;
}
$type = strtolower($type);
if($type != "pic" && $type != "txt" && $type != "all")
{
	$type = "all";
}
$md5 = substr(md5($groupid."_".$type),9,24);
$cache_file = "data/cache/link_".$md5.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include($cache_file);
	return $list;
}
$C_Link = $CF->build("link");
$condition = "typeid='".$groupid."'";
if($type == "pic")
{
	$condition .= " AND picture !=''";
}
elseif($type == "txt")
{
	$condition .= " AND (picture='' OR picture is NULL)";
}
$C_Link->Set("condition",$condition);
$list = $C_Link->GetLink("all");
if(!$list)
{
	return false;
}
if($list)
{
	$FS->Write($list,$cache_file,"list");
}


return $list;
?>