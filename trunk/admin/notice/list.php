<?php
#=========================================================================================
#	Filename: admin/notice/list.php
#	Note	: 站内公告
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-06
#=========================================================================================
$C_Notice = $CF->build("notice");
$C_Notice->Set("fields","id,subject,url,postdate");

#[公告列表]
$rslist = $C_Notice->GetNotice("all");

#[显示列表]
$TPL->p("list","notice");
?>