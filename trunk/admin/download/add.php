<?php
#=====================================================================
#	Filename: admin/download/add.php
#	Note	: 添加下载操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-28
#=====================================================================
$C_Category = $CF->build("category");
$rslist = $C_Category->GetCategory("all","catetype='download' AND ifcheck='1'");
if(!$rslist)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}
include_once(SYSTEM_ROOT."/class/catetree.php");
$CT = new CateTree($rslist);
$catelist = $CT->Tree();
if(count($catelist)<1)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}
$TPL->p("add","download");
?>