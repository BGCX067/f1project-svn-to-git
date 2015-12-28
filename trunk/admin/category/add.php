<?php
#=====================================================================
#	Filename: admin/category/add.php
#	Note	: 添加分类
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-12
#=====================================================================
$C_Category = $CF->build("category");
$catetype = $C_Category->GetCateTypeList();

$TPL->p("add","category");
?>