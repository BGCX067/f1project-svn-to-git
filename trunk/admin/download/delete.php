<?php
#=====================================================================
#	Filename: admin/download/delete.php
#	Note	: 删除文章操作
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=download&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Msg = $CF->build("msg");
$C_Msg->set("condition","id='".$id."'");
$rs = $C_Msg->GetMsg("one");
if(!$rs)
{
	Error("找不到相关数据",$r_url);
}
$C_Msg->DelMsg($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
?>