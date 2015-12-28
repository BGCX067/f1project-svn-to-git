<?php
#=====================================================================
#	Filename: include/module/category.qgmod.php
#	Note	: 根据当前分类ID得到相应的层级分类
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-09-18
#=====================================================================
if(!$cateid)
{
	return false;
}
#[限制最多显示三级目录]
$layer = $layer>3 ? 3 : ($layer<1 ? 1 : $layer);
#[得到缓存文件]
$md5 = $cateid."_".$layer;
$cache_file = "data/cache/category_".$md5.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include($cache_file);
	return $catelist;
}
global $DB,$FS,$CF;
$C_Category = $CF->build("category");
if(!$rs)
{
	$condition = "id='".$cateid."' AND ifcheck='1'";
	$rs = $C_Category->GetCategory("one",$condition);
	if(!$rs)
	{
		return false;
	}
}
#[判断是否是根目录]
$rootid = $rs["rootid"] ? $rs["rootid"] : $cateid;
$condition = "ifcheck='1' AND rootid='".$rootid."'";
$rslist = $rslist ? $rslist : $C_Category->GetCategory("all",$condition);
if(!$rslist)
{
	return false;
}
$tmp_catelist = array();
foreach($rslist AS $key=>$value)
{
	$tmp_catelist[$value["id"]] = $value;
}
$catelist = array();
if($rootid == $cateid)
{
	foreach($rslist AS $key=>$value)
	{
		if($value["parentid"] == $cateid)
		{
			$value["layerid"] = 1;
			$value["space"] = "";
			$catelist[] = $value;
		}
	}
}
else
{
	$son_status = false;
	foreach($rslist AS $key=>$value)
	{
		if($value["parentid"] == $cateid)
		{
			$son_status = true;
			$son_cate[] = $value;
		}
	}
	if($son_status)
	{
		foreach($rslist AS $key=>$value)
		{
			if($rs["parentid"] == $value["parentid"])
			{
				$value["layerid"] = 1;
				$value["space"] = "";
				$catelist[] = $value;
				if($value["id"] == $cateid)
				{
					foreach($son_cate AS $k=>$v)
					{
						if($v["parentid"] == $cateid)
						{
							$v["layerid"] = 2;
							$v["space"] = "　　";
							$catelist[] = $v;
						}
					}
				}
			}
		}
	}
	else
	{
		#[得到同级分类]
		if($rs["parentid"] != $rs["rootid"])
		{
			$p_p_id = $tmp_catelist[$rs["parentid"]]["parentid"];
			foreach($rslist AS $key=>$value)
			{
				if($value["parentid"] == $p_p_id)
				{
					$value["layerid"] = 1;
					$value["space"] = "";
					$catelist[] = $value;
					if($value["id"] == $rs["parentid"])
					{
						foreach($rslist AS $k=>$v)
						{
							if($v["parentid"] === $rs["parentid"])
							{
								$v["layerid"] = 2;
								$v["space"] = "　　";
								$catelist[] = $v;
							}
						}
					}
				}
			}
		}
		else
		{
			foreach($rslist AS $key=>$value)
			{
				if($value["parentid"] == $rs["parentid"])
				{
					$value["layerid"] = 1;
					$value["space"] = "";
					$catelist[] = $value;
				}
			}
		}
	}
}
if($catelist)
{
	$FS->Write($catelist,$cache_file,"catelist");
}
return $catelist;
?>