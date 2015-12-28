<?php
#==================================================================================================
#	Filename: admin/sysmenu/index.php
#	Note	: 导航栏默认页
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#==================================================================================================
$C_Sysmenu = $CF->build("sysmenu");#[实例化]

$all_list = $C_Sysmenu->GetSysmenu("all");

foreach($all_list AS $key=>$value)
{
	if(!$value["rootid"])
	{
		$toplist[] = $value;
	}
	else
	{
		if(!$value["parentid"])
		{
			$left_list[] = $value;
		}
		else
		{
			$left_list2[] = $value;
		}
	}
}

unset($all_list);

$menu_list = array();
foreach($toplist AS $key=>$value)
{
	$value["space"] = "";
	$menulist[] = $value;
	foreach($left_list AS $k=>$v)
	{
		if($v["rootid"] == $value["id"])
		{
			if(!$v["parentid"])
			{
				$v["space"] = "　　";
				$menulist[] = $v;
				foreach($left_list2 AS $s=>$y)
				{
					if($y["parentid"] == $v["id"])
					{
						$y["space"] = "　　　　";
						$menulist[] = $y;
					}
				}
			}
		}
	}
}
$TPL->p("index","sysmenu");
?>