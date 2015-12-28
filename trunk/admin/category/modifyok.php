<?php
#=====================================================================
#	Filename: admin/category/modifyok.php
#	Note	: 分类编辑存档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
function LoopUpdateCategory($rootid,$parentid)
{
	if(is_array($parentid))
	{
		$pid = implode(",",$parentid);
	}
	else
	{
		$pid = intval($parentid);
	}
	if($pid)
	{
		global $C_Category;
		$rs = $C_Category->GetCategory("all","parentid IN(".$pid.")");
		if($rs)
		{
			$array = array();
			foreach($rs AS $key=>$value)
			{
				$array[] = $value["id"];
			}
			$updateId = implode(",",$array);
			$C_Category->UpdateCateRoot($rootid,$updateId);
			LoopUpdateCategory($rootid,$array);
		}
	}
	return true;
}
$r_url = "admin.php?file=category";
$id = intval($id);
if(!$id)
{
	Error("操作非法",$r_url."&act=list");
}


$array["catename"] = $STR->safe($catename);
$array["catestyle"] = $STR->safe($catestyle);
$array["catetype"] = $STR->safe($catetype);
$array["tpl_index"] = $STR->safe($tpl_index);
$array["tpl_list"] = $STR->safe($tpl_list);
$array["tpl_msg"] = $STR->safe($tpl_msg);
$array["ifcheck"] = isset($ifcheck) ? 1 : 0;
$array["taxis"] = intval($taxis);
$array["keywords"] = $STR->safe($keywords);
$array["description"] = $STR->safe($description);
$array["psize"] = intval($psize);
$array["note"] = $STR->safe($note);

$cateid = intval($cateid);
$C_Category = $CF->build("category");
$rs = $C_Category->GetCategory("one","id='".$id."'");
if($rs["parentid"] != $cateid)
{
	if($cateid)
	{
		$array["parentid"] = $cateid;
		if($cateid == $rs["parentid"])
		{
			$array["rootid"] = $rs["rootid"];
		}
		else
		{
			$newRoot = $C_Category->GetCategory("one","id='".$cateid."'");
			$array["rootid"] = $newRoot["rootid"] ? $newRoot["rootid"] : $cateid;
		}
	}
	else
	{
		$array["rootid"] = 0;
		$array["parentid"] = 0;
	}
	#[更新当前的父子关系]
	$C_Category->UpdateCateSon($id,$array["rootid"],$array["parentid"]);
	if($rs["rootid"] == $array["rootid"])
	{
		#[仅要更改父子关系]
		$C_Category->UpdateCateParent($id,$array["parentid"]);
	}
	else
	{
		if($array["rootid"])
		{
			$C_Category->UpdateCateRoot($array["rootid"],$id);
			LoopUpdateCategory($array["rootid"],$array["parentid"]);
		}
		else
		{
			$C_Category->UpdateCateRoot($id,$id);
			LoopUpdateCategory($id,$id);
		}
	}
}
else
{
	$array["rootid"] = $rs["rootid"];
	$array["parentid"] = $cateid;
}
$C_Category->SetCategory($array,$id) ? Error("数据更新成功",$r_url."&act=list") : Error("数据更新失败",$r_url."&act=modify&id=".$id);
?>