<?php
#============================
#	Filename: spelist.qgmod.php
#	Note	: 专题列表
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-3-25
#============================
global $FS,$DB,$prefix;
global $CF;
if(!$groupid)
{
	return false;
}
$cache_file = "data/cache/spelist_group_".$groupid.".php";
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);
}
if($check_status)
{
	include($cache_file);
	return $spelist;
}
$C_Onepage = $CF->build("onepage");
$C_Onepage->Set("condition","id='".$groupid."'");
$rs = $C_Onepage->GetOnegroup("one");
if(!$rs)
{
	return false;
}
$spelist["id"] = $rs["id"];
$spelist["groupname"] = $rs["groupname"];
$C_Onepage->Set("condition","groupid='".$groupid."' AND ifcheck='1'");
$C_Onepage->set("fields","id,subject,style,url");
$rslist = $C_Onepage->GetOnepage("all");
if(!$rslist)
{
	return false;
}
foreach($rslist AS $key=>$value)
{
	$value["target"] = $value["url"] ? " target='_blank'" : "";
	$value["url"] = $value["url"] ? $value["url"] : "special.php?id=".$value["id"];
	$tmpSpelist[] = $value;
}
$spelist["list"] = $tmpSpelist;
if($spelist)
{
	$FS->Write($spelist,$cache_file,"spelist");
}
return $spelist;
?>