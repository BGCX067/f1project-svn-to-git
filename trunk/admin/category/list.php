<?php
#=====================================================================
#	Filename: admin/category/list.php
#	Note	: 分类列表
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-12
#=====================================================================
$C_Category = $CF->build("category");
#[显示所有菜单]
$rslist = $C_Category->GetCategory("all");
include_once(SYSTEM_ROOT."/class/catetree.php");
$CT = new CateTree($rslist);
$catelist = $CT->Tree();
$catetype = $C_Category->GetCateTypeList();
$TPL->p("list","category");
?>