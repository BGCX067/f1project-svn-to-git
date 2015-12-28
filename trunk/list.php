<?php
require_once("global.php");
$id = intval($id);
#[如果不存在ID时]
if(!$id || $id == "0")
{
	Error("找不到相关信息","index.php");
}

$C_Cate = $CF->build("category");
$rs = $C_Cate->GetCategory("one","id='".$id."' AND ifcheck='1'");
if(!$rs)
{
	Error("找不到相关信息","index.php");
}

#[获取当前菜单下的关键字及描述]
if($rs["keywords"]) $system["keywords"] = $rs["keywords"];
if($rs["description"]) $system["description"] = $rs["description"];
#[得到该数的所有的分类菜单]
$rootid = $rs["rootid"] ? $rs["rootid"] : $id;
$condition = "ifcheck='1' AND (rootid='".$rootid."' OR id='".$rootid."' OR parentid='".$rootid."')";
$catelist = $C_Cate->GetCategory("all",$condition);

#[TMP_CATELIST]
$tmp_catelist = array();
foreach($catelist AS $key=>$value)
{
	$tmp_catelist[$value["id"]] = $value;
}

$menulist = menu_list($catelist,$id);

#[标题头和向导栏]
$sitetitle_list = array();
foreach($menulist AS $key=>$value)
{
	$sitetitle_list[] = $value["catename"];
	$temp = array();
	$temp["url"] = "list.php?id=".$value["id"];
	$temp["name"] = $value["catename"];
	$lead_menu[$key] = $temp;
	unset($temp);
}
$site_title = implode(" - ",$sitetitle_list)." - ".$system["sitename"];
unset($menulist);
$lead_menu = array_reverse($lead_menu);


#[如果使用封面页功能，直接加载封面模板]
if($rs["tpl_index"] && file_exists($TPL->tpldir."/".$rs["tpl_index"].".".$TPL->ext))
{
	$TPL->p($rs["tpl_index"]);
	REWRITE();
	exit;
}

$tplfile = $rs["tpl_list"] && file_exists($TPL->tpldir."/".$rs["tpl_list"].".".$TPL->ext) ? $rs["tpl_list"] : $rs["catetype"].".list";

$psize = $rs["psize"]>0 ? $rs["psize"] : 10;
$pageid = intval($pageid);
$offset = $pageid>0 ? ($pageid-1)*10 : 0;
$page_url = "list.php?id=".$id;
$C_Msg = $CF->build("msg");
#[根据当前分类得到所有子分类ID]
$sonidlist = array();
$sonidlist = get_son_list($catelist,$id);
$idin = trim(implode(",",$sonidlist));
$condition = "ifcheck='1'";
if($idin)
{
	if(strpos(",".$idin.",",",".$id.",") === false)
	{
		$idin .= ",".$id;
	}
	$condition .= " AND cateid in(".$idin.")";
}
else
{
	$idin = $id;
	$condition .= " AND cateid='".$idin."'";
}

$C_Msg->set("condition",$condition);
$C_Msg->set("offset",$offset);
$C_Msg->set("psize",$psize);

$rslist = $C_Msg->GetMsg("list");

if($rslist)
{
	foreach($rslist AS $key=>$value)
	{
		$value["target"] = $value["url"] ? " target='_blank'" : "";
		$value["url"] = $value["url"] ? $value["url"] : "msg.php?id=".$value["id"];
		$value["postdate"] = date("Y-m-d",$value["postdate"]);
		$value["cut_subject"] = $value["subject"];
		$value["catename"] = $value["cateid"] && $tmp_catelist[$value["cateid"]] ? $tmp_catelist[$value["cateid"]]["catename"] : $rs["catename"];
		#[如果存在图片]
		$msglist[] = $value;
	}
}


$C_Msg->set("fields","count(id)");
$count = $C_Msg->GetCount();#[取得数量]
$pagelist = page($page_url,$count,10,$pageid);

//var_dump($pagelist);

#[管理左侧分类]
$thiscate = QGMOD_CATEGORY($id,true,$rs,$catelist);
$catelist = array();
if($thiscate)
{
	foreach($thiscate AS $key=>$value)
	{
		$value["url"] = "list.php?id=".$value["id"];
		$value["subject"] = $value["catename"];
		$value["target"] = "";
		$catelist[$key] = $value;
	}
}

define("QGMSG_CATEID",$id);

$TPL->p($tplfile);
REWRITE();
?>