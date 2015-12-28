<?php
#==================================================================================================
#	Filename: admin/top.php
#	Note	: 后台Top页
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-5-31
#==================================================================================================
#[显示语言包列表]
$C_Sysmenu = $CF->build("sysmenu");

$condition = " rootid='0' AND status='1'";
$rslist = $C_Sysmenu->GetSysmenu("all",$condition);

foreach((is_array($rslist) ? $rslist : array()) AS $key=>$value)
{
	$value["menu_url"] .= strpos($value["menu_url"],"?") !== false ? "&id=".$value["id"] : "?id=".$value["id"];
	$menulist[] = $value;
}

$TPL->p("top");
exit;
?>