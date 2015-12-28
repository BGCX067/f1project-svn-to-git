<?php
#=====================================================================
#	Filename: admin/picture/list.php
#	Note	: 说明文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-12
#=====================================================================
$C_Category = $CF->build("category");
$rslist = $C_Category->GetCategory("all","catetype='picture' AND ifcheck='1'");
if(!$rslist)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}
#[根据ID得到信息]
foreach($rslist AS $key=>$value)
{
	$clist[$value["id"]] = $value["catename"];
}
include_once(SYSTEM_ROOT."/class/catetree.php");
$CT = new CateTree($rslist);
$catelist = $CT->Tree();
if(count($catelist)<1)
{
	Error("没有可用的分类","admin.php?file=category&act=add");
}
$cateid = intval($cateid);
$sonid_array = $CT->SonId($cateid);
#[查询条件]
if(count($sonid_array)<1)
{
	Error("操作异常","admin.php?file=category&act=add");
}
$pageid = intval($pageid);
$psize = 30;
$offset = $pageid>0 ?($pageid-1)*$psize : 0;
$page_url = "admin.php?file=picture&act=list";
if($cateid)
{
	$page_url .= "&cateid=".$cateid;
}

$condition = "cateid IN(".implode(",",$sonid_array).")";
$keywords = $STR->safe($keywords);
if($keywords)
{
	$condition .= " AND subject LIKE '%".$keywords."%'";
	$page_url .= "&keywords=".rawurlencode($keywords);
}
$C_Msg = $CF->build("msg");
$C_Msg->set("fields","id,cateid,subject,style,author,postdate,hits,taxis,thumb,istop,isvouch,isbest,ifcheck,url,s_price");
$C_Msg->set("condition",$condition);
$C_Msg->set("orderby","istop DESC,taxis DESC,postdate DESC,id DESC");
$C_Msg->set("offset",$offset);
$C_Msg->set("psize",$psize);

$rslist = $C_Msg->GetMsg("list");
foreach((is_array($rslist) ? $rslist : array()) AS $key=>$value)
{
	$value["catename"] = $clist[$value["cateid"]];
	$value["thumb"] = ($value["thumb"] && file_exists($value["thumb"])) ? $value["thumb"] : "images/nophoto.gif"
	$msglist[] = $value;
}
unset($rslist);

#[取得总数]
$C_Msg->set("fields","count(id)");
$count = $C_Msg->GetCount();

$pagelist = page($page_url,$count,$psize,$pageid);

$TPL->p("list","picture");
?>