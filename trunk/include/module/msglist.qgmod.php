<?php
#============================
#	Filename: include/module/msglist.qgmod.php
#	Note	: 取得分类的文章列表
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-08-25
#============================
global $FS,$DB,$prefix;
global $CF,$STR;
if(!$cateid)
{
	return false;
}
$md5 = substr(md5($cateid."_".$length."_".$orderby."_".$limit),9,24);
$cache_file = "data/cache/msglist_".$md5.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include($cache_file);
	return $list;
}
$list = array();#[目标]
$C_Category = $CF->build("category");
if(strpos(",article,picture,download,product,",",".$cateid.",") !== false)
{
	#[取得所有分类ID]
	$C_Category->Set("fields","id");
	$condition = "ifcheck='1' AND catetype='".$cateid."'";
	$idlist = $C_Category->GetCategory("all",$condition);
	if(!$idlist)
	{
		return false;
	}
	$myidArray = array();
	foreach($idlist AS $key=>$value)
	{
		$myidArray[] = $value["id"];
	}
	$myId = implode(",",$myidArray);
	$list["url"] = "list.php?type=".$cateid;#[读取类型]
	$subCateId = $myId;#[得到主题的ID]
}
else
{
	$myId = $cateid;
	if(strpos($cateid,",") === false)
	{
		#[得到分类信息]
		$C_Category->Set("fields","catename");
		$condition = "ifcheck='1' AND id='".$myId."'";
		$rs = $C_Category->GetCategory("one",$condition);
		if(!$rs)
		{
			return false;
		}
		$list["catename"] = $rs["catename"];
	}
	$list["url"] = "list.php?id=".$myId;
}
$list["id"] = $myId;
$list["cateid"] = $myId;
#[调用模块类，传递相关参数]
$C_Module = $CF->build("module");
$rslist = $C_Module->GetMsgList($myId,$orderby,$limit);
if(!$rslist)
{
	unset($list);
	return false;
}


foreach($rslist AS $key=>$value)
{
	$value["cut_subject"] = $length>0 ? $STR->cut($value["subject"],$length,"…") : $value["subject"];
	$value["thumb"] = ($value["thumb"] && file_exists($value["thumb"])) ? $value["thumb"] : "";
	$value["target"] = $value["url"] ? " target='_blank'" : "";
	$value["url"] = $value["url"] ? $value["url"] : "msg.php?id=".$value["id"];
	$value["postdate"] = date("Y-m-d",$value["postdate"]);
	$value["clou"] = $value["clou"];
	$list["msglist"][$key] = $value;
}

if($list)
{
	$FS->Write($list,$cache_file,"list");
}
return $list;
?>