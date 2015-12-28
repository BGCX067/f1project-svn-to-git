<?php
#==================================================================================================
#	Filename: admin/sysmenu/add.php
#	Note	: 添加系统菜单
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-06
#==================================================================================================
$r_url = "admin.php?file=sysmenu&act=list";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url);
}
$C_Sysmenu = $CF->build("sysmenu");
$rs = $C_Sysmenu->GetSysmenu("one","id='".$id."'");
if($rs["rootid"] && $rs["parentid"])
{
	$all_list = $C_Sysmenu->GetSysmenu("all","parentid=0");
	if($all_list)
	{
		foreach($all_list AS $key=>$value)
		{
			if(!$value["rootid"])
			{
				$value["space"] = "";
				foreach($all_list AS $k=>$v)
				{
					if($v["rootid"] == $value["id"])
					{
						//$v["space"] = "　　";
						$value["soncatearray"][] = $v;
					}
				}
				$menulist[] = $value;
			}
		}
	}
}
else
{
	if($rs["rootid"])
	{
		$menulist = $C_Sysmenu->GetSysmenu("all","rootid='0'");
	}
}

$TPL->p("modify","sysmenu");
?>