<?php
#============================
#	Filename: special.qgmod.php
#	Note	: 专题内容模块
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-3-25
#============================
global $FS,$DB,$prefix;
global $CF;#[加载工厂]
$cache_file = "data/cache/special_".$special_id.".php";#[缓存信息]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);
}
if($check_status)
{
	include_once($cache_file);
	return $special;
}
$C_Onepage = $CF->build("onepage");
$C_Onepage->Set("condition","id='".$special_id."' AND ifcheck='1'");
$special = $C_Onepage->GetOnepage("one");#[取得数据]
if(!$special)
{
	return false;
}
$special["subject"] = str_replace("'","",$special["subject"]);
$special["sub_content"] = str_replace("'","",$special["sub_content"]);
$special["content"] = str_replace("'","",$special["content"]);
$special["target"] = $special["url"] ? " target='_blank'" : "";
$special["url"] = $special["url"] ? $special["url"] : "special.php?id=".$special_id;
#[将数据写入缓存]
if($special)
{
	$FS->Write($special,$cache_file,"special");
}
return $special;
?>