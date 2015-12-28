<?php
#=====================================================================
#	Filename: admin/left.php
#	Note	: 系统菜单左侧信息
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-5-31
#=====================================================================
$id = intval($id);
$C_Sysmenu = $CF->build("sysmenu");
if(!$id)
{
	#[获取默认的左侧菜单]
}
else
{
	$condition = " rootid='".$id."' AND status='1'";
	$all_list = $C_Sysmenu->GetSysmenu("all",$condition);
	foreach((is_array($all_list) ? $all_list : array()) AS $key=>$value)
	{
		if(!$value["parentid"])
		{
			$menulist[] = $value;
			foreach($all_list AS $k=>$v)
			{
				if($v["parentid"] == $value["id"])
				{
					$menulist[] = $v;
				}
			}
		}
	}
}
$TPL->p("left");
?>