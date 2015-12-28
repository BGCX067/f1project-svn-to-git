<?php
#=====================================================================
#	Filename: admin/category/addok.php
#	Note	: 将添加的分类写入数据库中
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-7-12
#=====================================================================
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

$r_url = "admin.php?file=category";

if(!$array["catename"])
{
	Error("请填写分类名称",$r_url."&act=add");
}

if(!$array["catetype"])
{
	Error("请设置分类类型",$r_url."&act=add");
}


$C_Category = $CF->build("category");

#[如果有父分类]
$array["rootid"] = 0;
$array["parentid"] = 0;
if($cateid)
{
	$rs = $C_Category->GetCategory("one","id='".$cateid."'");
	if($rs)
	{
		$array["rootid"] = $rs["rootid"] ? $rs["rootid"] : $cateid;
		$array["parentid"] = $cateid;
	}
}

$status = $C_Category->SetCategory($array);
$status ? Error("添加分类成功",$r_url."&act=list") : Error("添加失败",$r_url."&act=add");
?>