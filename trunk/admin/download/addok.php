<?php
#=====================================================================
#	Filename: admin/download/addok.php
#	Note	: 存储下载信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-28
#=====================================================================
$r_url = "admin.php?file=download&act=add";
$array["cateid"] = intval($cateid) ? intval($cateid) : Error("请选择分类",$r_url);
$array["subject"] = $subject ? $STR->safe($subject) : Error("标题不能为空",$r_url);
$array["style"] = $STR->safe($style);
$array["ifcheck"] = isset($ifcheck) ? 1: 0;
$array["istop"] = isset($istop) ? 1: 0;
$array["isvouch"] = isset($isvouch) ? 1: 0;
$array["isbest"] = isset($isbest) ? 1: 0;
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
$id = $C_Msg->SetMsg($array);
$r_url_2 = "admin.php?file=download&act=list";
$id ? Error("添加成功",$r_url_2) : Error("添加失败",$r_url);
?>