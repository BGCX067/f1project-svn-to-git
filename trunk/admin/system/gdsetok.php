<?php
#=====================================================================
#	Filename: admin/system/gdsetok.php
#	Note	: 存储GD信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-15
#=====================================================================
$post = $STR->safe($_POST);
$system = array_merge($system,$post);
$FS->Write($system,SYSTEM_ROOT."/data/system.php","system");
Error("信息更新成功","admin.php?file=system&act=gdset");
?>