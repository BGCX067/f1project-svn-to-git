<?php
#=====================================================================
#	Filename: admin/system/sitesetok.php
#	Note	: 存储网站基本信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-14
#=====================================================================
$post = $STR->safe($_POST);
$system = array_merge($system,$post);
$FS->Write($system,SYSTEM_ROOT."/data/system.php","system");
Error("网站信息更新成功","admin.php?file=system&act=siteset");
?>