<?php
#==================================================================================================
#	Filename: admin/adminer/index.php
#	Note	: 管理员列表页
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-05-07
#==================================================================================================
#[取得城市列表]
$C_city = $C_factory->build("city",DAO_BUILD_ORACLE);
$rslist = keytolower($C_city->getcity());
$citylist = array();
foreach((is_array($rslist) ? $rslist : array()) AS $key=>$value)
{
	$citylist[$value["c_city_id"]] = $value["name"];
}
unset($rslist);
$C_adminer = $C_factory->build("adminer");
$pageid = intval($pageid);
$psize = 30;#[每页显示30个管理员]
$count = $C_adminer->amount();
$page_url = "index.php?file=adminer";
$pagelist = page($page_url,$count,$psize,$pageid);
$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
$rslist = keytolower($C_adminer->msg("list","",$offset,$psize));
foreach((is_array($rslist) ? $rslist : array()) AS $key=>$value)
{
	$city_array = array();
	if($value["cityid"])
	{
		$city_array = explode(",",$value["cityid"]);
		if(count($city_array)>0)
		{
			$tmp_city = array();
			foreach($city_array AS $k=>$v)
			{
				$v = trim($v);
				if($v)
				{
					$m = $citylist[$v];
					if($m)
					{
						$tmp_city[] = $m;
					}
				}
			}
			if(count($tmp_city)>0)
			{
				$value["city_name"] = implode(",",$tmp_city);
			}
			else
			{
				$value["city_name"] = "未设置管理城市";
			}
		}
		else
		{
			$value["city_name"] = "未设置管理城市";
		}
	}
	else
	{
		if($value["ifsystem"])
		{
			$value["city_name"] = "可管理所有城市";
		}
		else
		{
			$value["city_name"] = "未设置管理城市";
		}
	}
	$list[] = $value;
}
$TPL->p("list","adminer");
?>