<?php
#============================
#	Filename: nav.qg.php
#	Note	: 导航管理
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-09-20
#============================
function update_nav_file()
{
	global $FS;
	global $CF,$C_Nav;
	if(!$C_Nav)
	{
		$C_Nav = $CF->build("nav");
	}
	$rslist = $C_Nav->GetNav("all");
	$FS->Write($rslist,"data/nav.php","qgnav");
	return true;
}
if($sys_act == "add")
{
	#[显示组分类]
	$C_Category = $CF->build("category");
	$catelist = $C_Category->GetCategory("all");
	$C_Onepage = $CF->build("onepage");
	$spelist = $C_Onepage->GetOnepage("all");
	$TPL->p("add","nav");
}
elseif($sys_act == "addok")
{
	$navtype = $STR->safe($navtype);
	if($navtype == "system")
	{
		$systemid = intval($systemid);
		if(!$systemid)
		{
			Error("请选择一下分类","admin.php?file=nav&act=add");
		}
		$C_Category = $CF->build("category");
		$rs = $C_Category->GetCategory("one","id='".$systemid."'");
		if(!$rs)
		{
			Error("没有找到相关信息...","admin.php?file=nav&act=add");
		}
		$array["name"] = $rs["catename"];
		$array["css"] = $rs["catestyle"];
		$array["url"] = "list.php?id=".$rs["id"];
	}
	elseif($navtype == "special")
	{
		$specialid = intval($specialid);
		if(!$specialid)
		{
			Error("请选择一个专题","admin.php?file=nav&act=add");
		}
		$C_Onepage = $CF->build("onepage");
		$C_Onepage->Set("condition","id='".$specialid."'");
		$rs = $C_Onepage->GetOnepage("one");
		if(!$rs)
		{
			Error("没有找到相关信息...","admin.php?file=nav&act=add");
		}
		$array["name"] = $rs["subject"];
		$array["css"] = $rs["style"];
		$array["url"] = $rs["url"] ? $rs["url"] : "special.php?id=".$rs["id"];
	}
	else
	{
		$array["name"] = $STR->safe($subject);
		$array["css"] = $STR->safe($style);
		$array["url"] = $STR->safe($link);
	}
	$array["target"] = intval($target);
	$array["taxis"] = intval($taxis);
	$C_Nav = $CF->build("nav");
	$status = $C_Nav->SetNav($array);
	update_nav_file();
	Error("导航添加成功...","admin.php?file=nav&act=list");
}
elseif($sys_act == "modify")
{
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法...","admin.php?file=nav&act=list");
	}
	$C_Nav = $CF->build("nav");
	$rs = $C_Nav->GetNav("one","id='".$id."'");
	if(!$rs)
	{
		Error("没有找到信息...","admin.php?file=nav&act=list");
	}
	$TPL->p("modify","nav");
}
elseif($sys_act == "modifyok")
{
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法...","admin.php?file=nav&act=list");
	}
	$array["name"] = $STR->safe($subject);
	$array["url"] = $STR->safe($link);
	$array["css"] = $STR->safe($style);
	$array["target"] = intval($target);
	$array["taxis"] = intval($taxis);
	$C_Nav = $CF->build("nav");
	$status = $C_Nav->SetNav($array,$id);
	update_nav_file();
	Error("导航编辑成功...","admin.php?file=nav&act=list");
}
elseif($sys_act == "delete")
{
	$id = intval($id);
	if(!$id)
	{
		Error("操作非法...","admin.php?file=nav&act=list");
	}
	$C_Nav = $CF->build("nav");
	$C_Nav->DelNav($id);
	update_nav_file();
	Error("操作成功...","admin.php?file=nav&act=list");
}
else
{
	$C_Nav = $CF->build("nav");
	$rslist = $C_Nav->GetNav("all");
	$TPL->p("list","nav");
}
?>