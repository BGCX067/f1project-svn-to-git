<?php
#=====================================================================
#	Filename: admin/article/add.php
#	Note	: 添加文章操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$C_Category = $CF->build("category");
$rslist = $C_Category->GetCategory("all","catetype='article' AND ifcheck='1'");
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
$TPL->p("add","article");
?>