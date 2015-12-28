<?php
#============================
#	Filename: soncate.qgmod.php
#	Note	: 根据当前的分类ID得到下一级的分类ID
#	Version : 2.2
#	Author  : qinggan
#	Update  : 2008-5-11
#============================
global $FS,$CF;
if(!$cateid)
{
	return false;
}
$cache_file = "data/cache/soncate_".$cateid.".php";
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
$C_Category = $CF->build("category");
$catelist = $C_Category->GetCategory("all","parentid='".$cateid."' AND ifcheck='1'");
if(!$catelist)
{
	return false;
}
foreach($catelist AS $key=>$value)
{
	$value["style"] = $value["catestyle"];
	$value["target"] = "";
	$value["url"] = "list.php?id=".$value["id"];
	$catelist[$key] = $value;
}
if($catelist)
{
	$FS->Write($catelist,$cache_file,"catelist");
}
unset($cache_file);
return $catelist;
?>