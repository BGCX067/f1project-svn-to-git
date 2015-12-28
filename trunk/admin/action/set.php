<?php
#=====================================================================
#	Filename: admin/action/set.php
#	Note	: 菜单动作管理
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-07
#=====================================================================
$dirlist = admin_dir();
$filename = $STR->safe($filename);
$C_Action = $CF->build("action");
if($filename)
{
	$rslist = $C_Action->GetAction("all","filename='".$filename."'");
	$filelist = admin_file(SYSTEM_ROOT."/admin/".$filename."/");
}
$TPL->p("set","action");
?>