<?php
#============================
#	Filename: admin/iframe/fckupfile.php
#	Note	: Fck编辑扩展上传控件
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-6-7
#============================
$input_name = $STR->safe($input_name);
if(!$input_name)
{
	$input_name = "content";
}
$TPL->p("fckupfile","iframe");
?>