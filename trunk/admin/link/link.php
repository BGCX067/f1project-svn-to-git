<?php
#=====================================================================
#	Filename: admin/link/link.php
#	Note	: 友情链接
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-04-23
#=====================================================================
$C_Link = $CF->build("link");

#[取得组列表]
$tmp_grouplist = $C_Link->GetGroup();
$grouplist = array();
if($tmp_grouplist)
{
	foreach($tmp_grouplist AS $key=>$value)
	{
		$grouplist[$value["id"]] = $value["typename"];
	}
}

#[添加链接]
if($sysact == "set")
{
	$id = intval($id);
	if($id)
	{
		$C_Link->Set("condition","id='".$id."'");
		$rs = $C_Link->GetLink("one");
	}
	$TPL->p("set","link");
}
elseif($sysact == "setok")
{
	$r_url = "admin.php?file=link&act=set";
	$array["typeid"] = intval($typeid);
	$array["name"] = $STR->safe($name);
	$array["url"] = $STR->safe($qgurl);
	$array["picture"] = $STR->safe($picture);
	$array["taxis"] = intval($taxis);
	$array["width"] = intval($width);
	$array["height"] = intval($height);
	if($id)
	{
		if(!$array["name"] || !$array["url"])
		{
			Error("名称和链接不能为空",$r_url."&id=".$id);
		}
		$C_Link->SetLink($array,$id) ? Error("链接编辑成功","admin.php?file=link&act=list") : Error("更新失败",$r_url."&id=".$id);
	}
	else
	{
		if(!$array["name"] || !$array["url"])
		{
			Error("名称和链接不能为空",$r_url);
		}
		$C_Link->SetLink($array) ? Error("添加成功","admin.php?file=link&act=list") : Error("添加失败",$r_url);
	}
}
elseif($sysact == "delete")
{
	$r_url = "admin.php?file=link&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法",$r_url);
	}
	$C_Link->DelLink($id) ? Error("删除成功",$r_url) : Error("删除失败",$r_url);
}
elseif($sysact == "delgroup")
{
	$r_url = "admin.php?file=link&act=list";
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法",$r_url);
	}
	#[判断内容是存在]
	$C_Link->Set("condition","typeid='".$id."'");
	$rs = $C_Link->GetLink("one");
	if($rs)
	{
		Error("当前组已经有相关内容了，请先删除内容再删除组",$r_url);
	}
	$C_Link->DelGroup($id) ? Error("组删除成功",$r_url) : Error("删除失败",$r_url);
}
elseif($sysact == "setgroup")
{
	$r_url = "admin.php?file=link&act=list";
	$id = intval($id);
	$typename = $STR->safe($typename);
	if($id)
	{
		$C_Link->SetGroup($typename,$id) ? Error("更新成功",$r_url) : Error("更新失败",$r_url);
	}
	else
	{
		$C_Link->SetGroup($typename) ? Error("添加组成功",$r_url) : Error("添加组失败",$r_url);
	}
}
else
{
	$psize = 30;
	$page_url = "admin.php?file=link&act=list";
	$pageid = intval($pageid);
	$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
	#[判断是否有分类]
	$typeid = intval($typeid);
	$condition = "1=1";
	if($typeid)
	{
		$condition .= " AND typeid='".$typeid."'";
	}
	$keywords = $STR->safe($keywords);
	if($keywords)
	{
		$condition .= " AND name LIKE '%".$keywords."%'";
	}
	$C_Link->Set("condition",$condition);
	$count = $C_Link->NumLink();
	$pagelist = page($page_url,$count,$psize,$pageid);
	$tmplist = $C_Link->GetLink("list",$offset,$psize);
	if(!$tmplist)
	{
		$tmplist = array();
	}
	foreach($tmplist AS $key=>$value)
	{
		$value["typename"] = $grouplist[$value["typeid"]] ? $grouplist[$value["typeid"]] : "未选择组";
		$rslist[] = $value;
	}
	$TPL->p("list","link");
}
?>