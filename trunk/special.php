<?php
#[专题管理]
require_once("global.php");

$id = intval($id);
if(!$id)
{
	Error("操作非法：找不到相关数据","index.php");
}

$C_One = $CF->build("onepage");
$C_One->set("condition","id='".$id."' AND ifcheck='1'");
$rs = $C_One->GetOnepage("one");

if(!$rs)
{
	Error("找不到相关数据","index.php");
}
$site_title = $rs["subject"]." - ".$system["sitename"];

$subject = $rs["subject"];
$style = $rs["style"];
$content = $rs["content"];

#[自定义TPL]
$tplfile = $rs["tpl"] && file_exists($TPL->tpldir."/".$rs["tpl"].".".$TPL->ext) ? $rs["tpl"] : "special";

$sideindex=1;
$C_One->set("condition","ifcheck='1' AND (groupid='".$rs["groupid"]."' OR groupid='0')");
$tmp_catelist = $C_One->GetOnepage("all");
if($tmp_catelist)
{
	foreach($tmp_catelist AS $key=>$value)
	{
		$value['sideindex'] = $sideindex++;
		$value["target"] = $value["url"] ? " target='_blank'" : "";
		$value["url"] = $value["url"] ? $value["url"] : "special.php?id=".$value["id"];
		$catelist[] = $value;
	}
}
#[导航栏]
$lead_menu[0]["url"] = "special.php?id=".$id;
$lead_menu[0]["name"] = $subject;

$TPL->p($tplfile);
REWRITE();
?>