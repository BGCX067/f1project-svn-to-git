<?php
#=====================================================================
#	Filename: admin/cache/clear.php
#	Note	: 清空缓存
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-27
#=====================================================================
$FS->Delete("./data/cache/");
$FS->Delete("./data/yui_tplc/");
$FS->Delete("./data/admin_tplc/");
echo "ok";
exit;
?>