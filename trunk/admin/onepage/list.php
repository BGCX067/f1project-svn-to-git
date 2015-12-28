<?php
#=====================================================================
#	Filename: admin/onepage/list.php
#	Note	: 单页面管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$C_Onepage = $CF->build("onepage");
$C_Onepage->set("fields","id,groupid,subject,style,url,taxis,ifcheck,tpl");
$tmplist = $C_Onepage->GetOnepage("all");
$tmplist = $tmplist ? $tmplist : array();#[如果不存在信息]
$C_Onepage->Set("table",$prefix."onegroup");
$grouplist = $C_Onepage->GetOnegroup("all");
$grouplist = $grouplist ? $grouplist : array();
foreach($grouplist AS $key=>$value)
{
	$glist[$value["id"]] = $value["groupname"];
}
foreach($tmplist AS $key=>$value)
{
	$value["groupname"] = $value["groupid"] && $glist[$value["groupid"]] ? $glist[$value["groupid"]] : "<span style='color:red;'>未分配组</span>";
	$rslist[] = $value;
}
$TPL->p("list","onepage");
?>