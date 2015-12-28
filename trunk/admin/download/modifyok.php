<?php
#=====================================================================
#	Filename: admin/download/modifyok.php
#	Note	: 存储更新的文章信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=download";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}
$r_url .= "&act=modify&id=".$id;

$array["cateid"] = intval($cateid) ? intval($cateid) : Error("请选择分类",$r_url);
$array["subject"] = $subject ? $STR->safe($subject) : Error("标题不能为空",$r_url);
$array["style"] = $STR->safe($style);
$array["ifcheck"] = isset($ifcheck) ? 1: 0;
$array["istop"] = isset($istop) ? 1: 0;
$array["isvouch"] = isset($isvouch) ? 1: 0;
$array["isbest"] = isset($isbest) ? 1: 0;
$array["tpl_msg"] = $STR->safe($tpl_msg);
$array["taxis"] = intval($taxis);
$array["author"] = $STR->safe($author);
$array["postdate"] = $postdate ? strtotime($postdate) : $system_time;
$array["thumb"] = $STR->safe($thumb);
$array["clou"] = $STR->safe($clou);
$array["url"] = $STR->safe($download_url);
$array["content"] = $STR->html($content);
$array["tplfile"] = $STR->safe($tplfile);
$array["hits"] = $STR->safe($hits);

#[下载专用的补充信息]
$array["softsize"] = $STR->safe($softsize);
$array["softlang"] = $STR->safe($softlang);
$array["softsystem"] = $STR->safe($softsystem);
$array["softdemo"] = $STR->safe($softdemo);
$array["softadmin"] = $STR->safe($softadmin);
$array["softemail"] = $STR->safe($softemail);
$array["softother"] = $STR->safe($softother);
$array["softlicense"] = $STR->safe($softlicense);

$C_Msg = $CF->build("msg");
$id = $C_Msg->SetMsg($array,$id);
$r_url_2 = "admin.php?file=download&act=list";
$id ? Error("更新成功",$r_url_2) : Error("更新失败",$r_url);
?>