<?php
#[内容信息]
require_once("global.php");
$id = intval($id);
#[如果不存在ID时]
if(!$id || $id == "0")
{
	Error("找不到相关信息","index.php");
}

$C_Msg = $CF->build("msg");
$C_Msg->set("condition","id='".$id."' AND ifcheck='1'");

$rs = $C_Msg->GetMsg("one");

$article = $C_Msg->GetMsgC($id);

$content = $article['content'];
$postdate = date("Y-m-d" ,$article['postdate']);
$subject = $article['subject'];


#[将DIV转成 p 的属性，这样子做是为了防止 DIV不完整造成的冲突]
$content = preg_replace("/<div/isU","<p style='margin-top:0px;margin-bottom:0px;padding:0px;line-height:200%;'",$content);
$content = preg_replace("/<\/div>/isU","</p>",$content);

#[取得分类]
$cateid = $rs["cateid"];
$C_Cate = $CF->build("category");
$rs_c = $C_Cate->GetCategory("one","id='".$cateid."' AND ifcheck='1'");
if(!$rs_c)
{
	Error("找不到相关信息","index.php");
}

#[取得分类的关键字]
if($rs_c["keywords"]) $system["keywords"] = $rs_c["keywords"];
if($rs_c["description"]) $system["description"] = $rs_c["description"];
#[得到该数的所有的分类菜单]
$rootid = $rs_c["rootid"] ? $rs_c["rootid"] : $cateid;
$condition = "ifcheck='1' AND (rootid='".$rootid."' OR id='".$rootid."' OR parentid='".$rootid."')";
$catelist = $C_Cate->GetCategory("all",$condition);

$menulist = menu_list($catelist,$cateid);
$thiscate = QGMOD_CATEGORY($cateid,true,$rs_c,$catelist);
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

$tplfile = $rs_c["tpl_msg"] && file_exists($TPL->tpldir."/".$rs_c["tpl_msg"].".".$TPL->ext) ? $rs_c["tpl_msg"] : $rs_c["catetype"].".msg";

$tplfile = $rs["tplfile"] && file_exists($TPL->tpldir."/".$rs["tplfile"].".".$TPL->ext) ? $rs["tplfile"] : $tplfile;

if(!$tplfile)
{
	$tplfile = $rs_c["catetype"].".msg";
}

$C_Msg->AddHits($id);

define("QGMSG_CATEID",$cateid);
$TPL->p($tplfile);
REWRITE();
?>