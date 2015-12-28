<?php
#=====================================================================
#	Filename: admin/onepage/groupset.php
#	Note	: 存储分类组信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$id = intval($id);
$r_url = "admin.php?file=onepage&act=list";
$array["groupname"] = $groupname ? $STR->safe($groupname) : Error("名称不能为空",$r_url);
$C_Onepage = $CF->build("onepage");
$C_Onepage->Set("table",$prefix."onegroup");#[重设组]
if($id)
{
	$C_Onepage->SetOnegroup($array,$id) ? Error("更新成功",$r_url) : Error("更新失败",$r_url);
}
else
{
	$C_Onepage->SetOnegroup($array) ? Error("添加成功",$r_url) : Error("添加失败",$r_url);
}
?>