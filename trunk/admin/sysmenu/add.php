<?php
#==================================================================================================
#	Filename: admin/sysmenu/add.php
#	Note	: 添加系统菜单
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-06-12
#==================================================================================================
$C_Sysmenu = $CF->build("sysmenu");

#[显示根分类及父级分类]
$all_list = $C_Sysmenu->GetSysmenu("all","parentid=0");
if($all_list)
{
	foreach($all_list AS $key=>$value)
	{
		if(!$value["rootid"])
		{
			$value["space"] = "";
			$menulist[] = $value;
			foreach($all_list AS $k=>$v)
			{
				if($v["rootid"] == $value["id"])
				{
					$v["space"] = "　　";
					$menulist[] = $v;
				}
			}
		}
	}
}
$TPL->p("add","sysmenu");
?>