<?php
#[公告信息]
require_once("global.php");
$C_Notice = $CF->build("notice");
$rslist = $C_Notice->GetNotice("list","",0,100);#[取得最新100条信息]
#[标题头]
$site_title = "站内公告 - ".$system["sitename"];
#[向导栏]
$lead_menu[0]["url"] = "#";
$lead_menu[0]["name"] = "站内公告";
$TPL->p("notice");
REWRITE();
?>