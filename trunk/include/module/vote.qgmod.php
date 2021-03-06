<?php
#============================
#	Filename: vote.qgmod.php
#	Note	: 投票模块管理
#	Version : 2.0
#	Author  : qinggan
#	Update  : 2008-3-25
#============================
global $FS,$CF;
$cache_file = "data/cache/vote_".$vote_id.".php";#[缓存文件]
$check_status = false;
if($iscache)
{
	$check_status = CheckCache($cache_file);#[判断缓存文件的存储状态]
}
if($check_status)
{
	include($cache_file);
	return $vote;
}
$C_Vote = $CF->build("vote");
$voteRs = $C_Vote->GetVote("one","id='".$vote_id."' AND voteid='0'");
if(!$voteRs)
{
	return false;
}
#[判断是否有投票，如果更改状态为true]
$vote["id"] = $vote_id;
$vote["subject"] = $voteRs["subject"];#[投票的主题]
$vote["type"] = $voteRs["vtype"];#[投票的类型,pl为多选，single为单选]
unset($voteRs);
$vote_rslist = $C_Vote->GetVote("all","voteid='".$vote_id."'");
if(!$vote_rslist || count($vote_rslist)<1)
{
	return false;
}
$vote_list = array();
foreach($vote_rslist AS $key=>$value)
{
	#[投票的单选框或复选框]
	if($vote["type"] == "pl")
	{
		$value["vote_input"] = "<input type='checkbox' name='voteid[]' value='".$value["id"]."'";

	}
	else
	{
		$value["vote_input"] = "<input type='radio' name='voteid' value='".$value["id"]."'";
	}
	if($value["ifcheck"])
	{
		$value["vote_input"] .= " checked";
	}
	$value["vote_input"] .= ">";
	$vote_list[] = $value;
}
$vote["list"] = $vote_list;
unset($vote_rslist,$vote_list);
if($vote)
{
	$FS->Write($vote,$cache_file,"vote");
}
unset($cache_file);
return $vote;
?>