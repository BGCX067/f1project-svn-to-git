<?php
#=====================================================================
#	Filename: admin/category/ajax_getcate.php
#	Note	: 说明文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-12
#=====================================================================
$type = $STR->safe($type);
if(!$type)
{
	echo "error";
	exit;
}
$C_Category = $CF->build("category");
$condition = "catetype='".$type."' AND ifcheck='1'";
$rslist = $C_Category->GetCategory("all",$condition);
if($rslist)
{
	include_once(SYSTEM_ROOT."/class/catetree.php");
	$CT = new CateTree($rslist);
	$catelist = $CT->Tree();
}

$TPL->p("ajax_select","category");
?>