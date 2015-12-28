<?php
#==================================================================================================
#	Filename: admin/adminer/delete.php
#	Note	: 删除管理员数据
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-07
#==================================================================================================
$id = intval($id);
if(!$id)
{
	Error("操作非法","index.php?file=adminer");
}
$C_adminer = $C_factory->build("adminer");
$rs = $C_adminer->del($id);
$tishi = $rs ? "管理员删除成功" : "管理员删除失败";
Error($tishi,"index.php?file=adminer");
?>