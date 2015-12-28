<?php
#=====================================================================
#	Filename: admin/action/delete.php
#	Note	: 删除动作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#=====================================================================
$r_url = "admin.php?file=action&act=set";
$id = intval($id);
if(!$id)
{
	Error("操作非法","index.php?file=action&act=set");
}
$C_Action = $CF->build("action");
$rs = $C_Action->GetAction("one","id='".$id."'");
if(!$rs)
{
	Error("没有找到该记录",$r_url);
}
$r_url .= "&filename=".$rs["filename"];
$C_Action->DelAction($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>