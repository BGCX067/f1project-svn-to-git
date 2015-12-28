<?php
#============================
#	Filename: search.php
#	Note	: 搜索
#	Version : 3.0Simple
#	Author  : qinggan
#	Update  : 2008-09-21
#============================
require_once("global.php");
$sysact = $STR->safe($act);
if($sysact == "searchok")
{
	$keywords = $s_keywords ? $STR->safe($s_keywords) : $STR->safe($keywords);
	if(!$keywords)
	{
		Error("请填写关键字","index.php");
	}
	#[整理]
	$stype = $STR->safe($stype);
	if($stype)
	{
		$cateid = intval($cateid);
		$C_Category = $CF->build("category");
		$condition = " ifcheck='1' AND catetype='".$stype."'";
		if($cateid)
		{
			$condition .= " AND (id='".$cateid."' OR rootid='".$cateid."' OR parentid='".$cateid."')";
		}
		$catelist = $C_Category->GetCategory("all",$condition);#[取得所有的分类列表]
		if(!$catelist)
		{
			$TPL->p("search");
			REWRITE();
			exit;
		}
		$tmpcatelist = array();
		foreach($catelist AS $key=>$value)
		{
			$tmpcatelist[] = $value["id"];
		}
		$condition = "m.cateid IN(".implode(",",$tmpcatelist).")";
		$condition.= " AND m.subject LIKE '%".$keywords."%'";
		unset($catelist);
	}
	else
	{
		$condition = "m.subject LIKE '%".$keywords."%'";
	}
	#[取得搜索结果]
	$C_Search = $CF->build("search");
	$count = intval($count);
	if(!$count || $count<1)
	{
		$count = $C_Search->GetCount($condition);
	}
	$pageid = intval($pageid);
	$psize = 30;#[每页保留30条搜索]
	$offset = $pageid>0 ? ($pageid-1)*$psize : 0;
	$searchlist = $C_Search->GetSearch($condition,$offset,$psize);
	if(!$searchlist)
	{
		$TPL->p("search");
		REWRITE();
		exit;
	}
	$pageurl = "search.php?act=searchok&keywords=".rawurlencode($keywords);
	$pageurl.= "&stype=".$stype."&count=".$count;
	$pageurl.= "&cateid=".$cateid;
	$pagelist = page($pageurl,$count,$psize,$pageid);#[获取分页的数组]
	#[标题头]
	$site_title = "搜索关键字：".$keywords." - ".$system["sitename"];
	#[向导栏]
	$lead_menu[0]["url"] = $pageurl;
	$lead_menu[0]["name"] = "搜索关键字：".$keywords;
	$TPL->p("search");
	REWRITE();
	exit;
}
elseif($sysact == "searchlink")
{
	$keywords = $s_keywords ? $STR->safe($s_keywords) : $STR->safe($keywords);
	if(!$keywords)
	{
		Error("请填写关键字","index.php");
	}
	$stype = $STR->safe($stype);
	$cateid = intval($cateid);
	$refreshurl = "search.php?act=searchok&keywords=".rawurlencode($keywords)."&stype=".$stype;
	$refreshurl.= "&cateid=".$cateid;
	header("Location:".$refreshurl);
	exit;
}
elseif($sysact == "getcate")
{
	$cateid = intval($cateid);
	$type = $STR->safe($type);
	if(!$type)
	{
		echo "";
		exit;
	}
	$C_Category = $CF->build("category");
	$condition = "ifcheck='1' AND catetype='".$type."'";
	$catelist = $C_Category->GetCategory("all",$condition);#[取得所有的分类列表]
	include_once(SYSTEM_ROOT."/class/catetree.php");
	$CT = new CateTree($catelist);
	$catelist = $CT->Tree();
	if(!$catelist || count($catelist)<1)
	{
		echo "";
		exit;
	}
	$TPL->p("ajax.search_select");
	REWRITE();
	exit;
}
else
{
	$TPL->p("search");
	REWRITE();
	exit;
}
?>