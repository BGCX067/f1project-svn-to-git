<?php
#============================
#	Filename: include/module/catelist.qgmod.php
#	Note	: 指定ID的分类
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-08-25
#============================
global $FS,$DB,$prefix;
global $CF;
if(!$cateid)
{
	return false;
}
$type = $type == "onepage" ? "onepage" : "category";
$md5 = substr(md5($cateid."_".$type),9,24);
$cache_file = "data/cache/catelist_".$md5.".php";
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);
}
if($check_status)
{
	include($cache_file);
	return $catelist;
}
if($type == "onepage")
{
	$C_Onepage = $CF->build("onepage");
	$C_Onepage->Set("condition","id IN (".$cateid.") AND ifcheck='1'");
	$C_Onepage->Set("fields","id,subject,url,style");
	$rslist = $C_Onepage->GetOnepage("all");#[取得数据]
	if(!$rslist)
	{
		return false;
	}
	foreach($rslist AS $key=>$value)
	{
		$value["catename"] = $value["subject"];
		$value["target"] = $value["url"] ? " target='_blank'" : "";
		$value["url"] = $value["url"] ? $value["url"] : "special.php?id=".$value["id"];
		$catelist[] = $value;
	}
}
else
{
	$C_Category = $CF->build("category");
	$C_Category->Set("fileds","id,catename,catestyle");
	$condition = "id IN(".$cateid.") AND ifcheck='1'";
	$rslist = $C_Category->GetCategory("all",$condition);
	if(!$rslist)
	{
		return false;
	}
	foreach($rslist AS $key=>$value)
	{
		$value["style"] = $value["catestyle"];
		$value["target"] = "";
		$value["url"] = "list.php?id=".$value["id"];
		$catelist[] = $value;
	}
}
if($catelist)
{
	$FS->Write($catelist,$cache_file,"catelist");
}
return $catelist;
?>