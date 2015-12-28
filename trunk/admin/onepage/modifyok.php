<?php
#=====================================================================
#	Filename: admin/onepage/modifyok.php
#	Note	: 存储编辑的单页面信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=onepage";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}
$array["subject"] = $subject ? $STR->safe($subject) : Error("名称不能为空",$r_url."&act=modify&id=".$id);
$array["style"] = $STR->safe($style);
$array["content"] = $STR->html($content);
$array["url"] = $STR->safe($onepage_url);
$array["taxis"] = intval($taxis);
$array["ifcheck"] = isset($ifcheck) ? 1 : 0;
$array["tpl"] = $STR->safe($onepage_tpl);
$array["groupid"] = intval($groupid);
if(!$array["url"] && !$array["content"])
{
	Error("网址或内容必须有一个不能为空",$r_url."&act=modify&id=".$id);
}

$C_Onepage = $CF->build("onepage");
$C_Onepage->SetOnepage($array,$id) ? Error("更新成功",$r_url."&act=list") : Error("更新失败",$r_url."&act=modify&id=".$id);
?>