<?php
#============================
#	Filename: np.qgmod.php
#	Note	: 上下主题功能
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-09-13
#============================
if(!$id)
{
	return false;
}
if($iscache)
{
	$cachefile = "data/np_cache/";
	$length = strlen($id);
	if($length>5)
	{
		$cachefile .= substr($id,0,2)."/".substr($id,2,2)."/".substr($id,4,2)."/";
	}
	elseif($length>3 && $length<=5)
	{
		$cachefile .= substr($id,0,2)."/".substr($id,2,2)."/";
	}
	elseif($length>1 && $length<=3)
	{
		$cachefile .= substr($id,0,2)."/";
	}
	elseif($length<2)
	{
		$cachefile .= $id."/";
	}
	$cachefile .= substr(md5($id."_".$cateid."_".$type."_".$limit),9,16).".php";
	#[判断缓存是否超时]
	$check_status = CheckCache($cachefile);
	if($check_status)
	{
		include($cachefile);
		return $rslist;
		break;
	}
}
#[读取当前主题下的信息]
global $DB,$prefix;
global $FS,$CF;
#[查询条件]
$condition = "id".($type == "N" ? "<" : ">")."'".$id."'";
if($cateid)
{
	$condition .= " AND cateid='".$cateid."'";
}
$condition .= " AND ifcheck='1'";
$C_Msg = $CF->build("msg");
$C_Msg->Set("condition",$condition);
$C_Msg->Set("orderby","taxis DESC,id ".($type=="N" ? "DESC" : "ASC"));
$C_Msg->Set("offset",0);
$C_Msg->Set("psize",$limit);
$rslist = $C_Msg->GetMsg("list");
if(!$rslist)
{
	return false;
}
foreach($rslist AS $key=>$value)
{
	$value["target"] = $value["url"] ? " target='_blank'" : "";
	$value["url"] = $value["url"] ? $value["url"] : "msg.php?id=".$value["id"];
	$rslist[$key] = $value;
}
if($type == "P")
{
	krsort($rslist);
}
if($iscache && $cachefile && $rslist)
{
	$FS->write($rslist,$cachefile,"rslist");
}
return $rslist;
?>