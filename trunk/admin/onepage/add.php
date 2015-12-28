<?php
#=====================================================================
#	Filename: admin/onepage/add.php
#	Note	: 添加单页面
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$C_Onepage = $CF->build("onepage");
$grouplist = $C_Onepage->GetOnegroup("all");
$TPL->p("add","onepage");
?>