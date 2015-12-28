<?php
#=====================================================================
#	Filename: admin/picture/plset.php
#	Note	: 说明文档
#	Version : 3.0
#	Author  : qinggan
#	Update  : 2008-07-13
#=====================================================================
$r_url = "admin.php?file=picture&act=list";
$idlist = $STR->safe($idlist);#[获取IDlist]
if(!$idlist)
{
	Error("操作非法",$r_url);
}
$qgtype = $STR->safe($qgtype);
$C_Msg = $CF->build("msg");
if($qgtype == "delete")
{
	$idarray = explode(",",$idlist);
	foreach($idarray AS $key=>$value)
	{
		$value = intval($value);
		if($value)
		{
			$C_Msg->DelMsg($value);
		}
	}
	Error("批量删除主题完成！",$r_url);
}
else
{
	$sql = "UPDATE ".$prefix."msg SET ";
	switch ($qgtype)
	{
		case "top":
			$sql .= "istop='1'";
			$tmsg = "置顶";
		break;
		case "vouch":
			$sql .= "isvouch='1'";
			$tmsg = "推荐";
		break;
		case "best":
			$sql .= "isbest='1'";
			$tmsg = "精华";
		break;
		case "dtop":
			$sql .= "istop='0'";
			$tmsg = "取消置顶";
		break;
		case "dvouch":
			$sql .= "isvouch='0'";
			$tmsg = "取消推荐";
		break;
		case "dbest":
			$sql .= "isbest='0'";
			$tmsg = "取消精华";
		break;
		case "check":
			$sql .= "ifcheck='1'";
			$tmsg = "审核";
		break;
		case "dcheck":
			$sql .= "ifcheck='0'";
			$tmsg = "未审核";
		break;
		case "taxis":
			$max_taxis = $C_Msg->GetMaxTaxis();
			$sql .= "taxis='".($max_taxis+1)."'";
			$tmsg = "排序提前";
		break;
		default :
			$sql .= "isbest='1'";
			$tmsg = "精华";
		break;
	}
	$sql .= " WHERE id in(".$idlist.")";
	$C_Msg->Query($sql);
	Error("批量 <span style='color:red;'>".$tmsg."</span> 操作完成！",$r_url);
}
?>